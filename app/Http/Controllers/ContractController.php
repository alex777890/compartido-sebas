<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\TemplateProcessor;
use App\Models\Template;
use App\Models\Contrato;
use App\Models\Coordinacion;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use ZipArchive;
use DOMDocument;
use DOMXPath;

class ContractController extends Controller
{
    public function __construct()
    {
        Settings::setPdfRendererName(Settings::PDF_RENDERER_DOMPDF);
        Settings::setPdfRendererPath(base_path('vendor/dompdf/dompdf'));
    }

    public function index(Request $request)
{
    // filtros simples (opcional): q, coordinacion_id, status, date_from, date_to...
    $query = Contrato::with(['template', 'coordinacion'])->orderBy('created_at', 'desc');

    if ($request->filled('q')) {
        $q = $request->q;
        $query->where('nombre', 'like', "%{$q}%");
    }
    if ($request->filled('coordinacion_id')) {
        $query->where('coordinacion_id', $request->coordinacion_id);
    }
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }
    if ($request->filled('date_from')) {
        $query->whereDate('created_at', '>=', $request->date_from);
    }
    if ($request->filled('date_to')) {
        $query->whereDate('created_at', '<=', $request->date_to);
    }

    $all = $query->get();

    // Agrupar por mes en formato YYYY-MM (por ejemplo "2024-02")
    $allContracts = $all->groupBy(function ($item) {
        return $item->created_at->format('Y-m');
    });

    // Generar etiquetas de mes en español (ej. "febrero 2024")
    $formattedMonths = [];
    foreach ($allContracts->keys() as $monthKey) {
        // $monthKey es "YYYY-MM" -> creamos fecha con dia 1
        try {
            $label = \Carbon\Carbon::parse($monthKey . '-01')->locale('es')->translatedFormat('F Y');
        } catch (\Exception $e) {
            $label = $monthKey;
        }
        $formattedMonths[$monthKey] = ucfirst($label);
    }

    // Últimos contratos (por ejemplo 10 más recientes)
    $recentContracts = $all->sortByDesc('created_at')->take(10);

    $templates = Template::all();
    $coordinaciones = Coordinacion::activas()->get();

    return view('contracts.index', compact('templates', 'coordinaciones', 'recentContracts', 'allContracts', 'formattedMonths'));
}
    public function create($templateId = null)
    {
        $templates = Template::all();
        $selectedTemplate = $templateId ? Template::findOrFail($templateId) : null;
        $coordinaciones = Coordinacion::activas()->get();
        $fields = [];

        if ($selectedTemplate && $selectedTemplate->fields) {
            // fields was saved as structure (name, tipo, valor, etc.)
            $fields = json_decode($selectedTemplate->fields, true) ?? [];
        } elseif ($selectedTemplate) {
            // attempt to extract fields from the docx if DB doesn't have them
            try {
                $filePath = storage_path('app/' . $selectedTemplate->file_path);
                $text = $this->extractTextFromFile($filePath);
                $fields = $this->extraerCamposLlave($text);

                // detect placeholders that are inside table rows with fixed height (signature areas)
                $signaturePlaceholders = $this->detectSignaturePlaceholders($filePath);
                if (!empty($signaturePlaceholders)) {
                    foreach ($signaturePlaceholders as $fullPlaceholder) {
                        if (isset($fields[$fullPlaceholder])) {
                            $fields[$fullPlaceholder]['tipo'] = 'signature';
                        }
                    }
                }
            } catch (\Exception $e) {
                Log::warning('No se pudieron extraer campos directamente del archivo: ' . $e->getMessage());
            }
        }

        return view('contracts.create', compact(
            'templates',
            'selectedTemplate',
            'fields',
            'coordinaciones'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'template_id' => 'required|exists:templates,id',
            'nombre' => 'required|string|max:255',
            'values' => 'required|array',
            'coordinacion_id' => 'required|exists:coordinaciones,id',
        ]);

        $template = Template::findOrFail($request->template_id);
        $values = $request->values; // Example: ['${Nombre_Completo}' => 'Juan', ...]
        $uploadedFiles = $request->file('files', []); // files[FieldName] if any

        Log::info('Valores recibidos del formulario:', $values);

        $filePath = storage_path('app/' . $template->file_path);
        if (!Storage::exists($template->file_path)) {
            Log::error('Archivo de plantilla no encontrado', ['path' => $filePath]);
            return redirect()->back()->withErrors(['error' => 'El archivo de la plantilla no existe.']);
        }

        try {
            $templateProcessor = new TemplateProcessor($filePath);
        } catch (\Exception $e) {
            Log::error('Error al cargar archivo DOCX con TemplateProcessor', [
                'path' => $filePath,
                'error' => $e->getMessage(),
                'code' => $e->getCode()
            ]);
            return redirect()->back()->withErrors(['error' => 'Error al cargar la plantilla: ' . $e->getMessage()]);
        }

        // Load or compute template fields metadata (name + tipo)
        $templateFields = json_decode($template->fields, true) ?? [];
        if (empty($templateFields)) {
            // extract from docx content
            try {
                $text = $this->extractTextFromFile($filePath);
                $templateFields = $this->extraerCamposLlave($text);

                // detect signature placeholders and mark them
                $signaturePlaceholders = $this->detectSignaturePlaceholders($filePath);
                foreach ($signaturePlaceholders as $fullPlaceholder) {
                    if (isset($templateFields[$fullPlaceholder])) {
                        $templateFields[$fullPlaceholder]['tipo'] = 'signature';
                    }
                }
            } catch (\Exception $e) {
                Log::warning('No se pudieron generar metadata de campos desde el archivo: ' . $e->getMessage());
            }
        }

        // Main replacement loop: generic, no hardcoded placeholder names
        foreach ($values as $placeholder => $valor) {
            $name = $this->stripPlaceholder($placeholder); // e.g. Nombre_del_Profesionista

            // determine tipo: try to find in templateFields by matching 'name'
            $fieldTipo = 'texto';
            if (!empty($templateFields)) {
                foreach ($templateFields as $key => $meta) {
                    if (isset($meta['name']) && $meta['name'] === $name) {
                        $fieldTipo = $meta['tipo'] ?? 'texto';
                        break;
                    }
                }
            } else {
                $fieldTipo = $this->inferirTipo($name);
            }

            // handle different tipos generically
            if ($fieldTipo === 'image') {
                // insert uploaded image if provided
                if (isset($uploadedFiles[$name]) && $uploadedFiles[$name]->isValid()) {
                    $stored = $uploadedFiles[$name]->store('signatures');
                    $imagePath = storage_path('app/' . $stored);
                    try {
                        $templateProcessor->setImageValue($name, [
                            'path' => $imagePath,
                            'width' => 250,
                            'height' => 80,
                            'ratio' => false
                        ]);
                        Log::debug("Imagen insertada para placeholder $name desde archivo subido.");
                    } catch (\Exception $e) {
                        Log::error('Error al insertar imagen en template: ' . $e->getMessage(), ['placeholder' => $name]);
                    }
                } elseif ($this->isBase64Image($valor)) {
                    // accept base64 image string
                    $fileName = 'sign_' . uniqid() . '.png';
                    $diskPath = 'signatures/' . $fileName;
                    $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $valor));
                    Storage::put($diskPath, $imageData);
                    $imagePath = storage_path('app/' . $diskPath);
                    try {
                        $templateProcessor->setImageValue($name, [
                            'path' => $imagePath,
                            'width' => 250,
                            'height' => 80,
                            'ratio' => false
                        ]);
                        Log::debug("Imagen insertada para placeholder $name desde base64.");
                    } catch (\Exception $e) {
                        Log::error('Error al insertar imagen base64 en template: ' . $e->getMessage(), ['placeholder' => $name]);
                    }
                } else {
                    Log::warning("No se encontró archivo para placeholder imagen $name.");
                }
            } elseif ($fieldTipo === 'signature') {
                // Generic signature handling WITHOUT hardcoding placeholder names:
                // - Format the name to 1 or 2 lines for the signature cell.
                // - Prefer to use two placeholders if template provides them (Name_L1 and Name_L2).
                // - Otherwise set the single placeholder with a newline (best-effort).
                $two = $this->splitNameIntoTwoLines($valor, 24); // adjust max chars per line if needed

                // check if template contains placeholders with suffix _L1 and _L2 for this name
                $hasL1 = $this->templateContainsPlaceholder($filePath, '${' . $name . '_L1}');
                $hasL2 = $this->templateContainsPlaceholder($filePath, '${' . $name . '_L2}');

                if ($hasL1 || $hasL2) {
                    // set individually only existing ones
                    if ($hasL1) {
                        try {
                            $templateProcessor->setValue($name . '_L1', $two['l1']);
                        } catch (\Exception $e) {
                            Log::error("Error al setValue {$name}_L1: " . $e->getMessage());
                        }
                    }
                    if ($hasL2) {
                        try {
                            $templateProcessor->setValue($name . '_L2', $two['l2']);
                        } catch (\Exception $e) {
                            Log::error("Error al setValue {$name}_L2: " . $e->getMessage());
                        }
                    }
                    Log::debug("Firma reemplazada usando L1/L2 para $name");
                } else {
                    // Best-effort: try to inject a line break. If your version of TemplateProcessor/Word doesn't render it,
                    // consider switching to the L1/L2 approach in the template (recommended).
                    $formatted = $two['l1'] . "\n" . $two['l2'];
                    try {
                        $templateProcessor->setValue($name, $formatted);
                        Log::debug("Firma reemplazada en single placeholder $name (con salto de línea).");
                    } catch (\Exception $e) {
                        Log::error("Error al setValue signature $name: " . $e->getMessage());
                    }
                }
            } else {
                // Plain text
                try {
                    $templateProcessor->setValue($name, trim($valor));
                    Log::debug("Reemplazo aplicado: $name → $valor");
                } catch (\Exception $e) {
                    Log::error('Error al aplicar setValue en TemplateProcessor', [
                        'placeholder' => $name,
                        'error' => $e->getMessage()
                    ]);
                }
            }
        }

        $contractsDir = storage_path('app/contracts');
        if (!File::exists($contractsDir)) {
            File::makeDirectory($contractsDir, 0755, true);
        }

        $generatedFileName = uniqid('contract_') . '.docx';
        $generatedPath = 'contracts/' . $generatedFileName;

        try {
            $templateProcessor->saveAs(storage_path('app/' . $generatedPath));
        } catch (\Exception $e) {
            Log::error('Error al guardar archivo DOCX generado', [
                'path' => storage_path('app/' . $generatedPath),
                'error' => $e->getMessage(),
                'code' => $e->getCode()
            ]);
            return redirect()->back()->withErrors(['error' => 'No se pudo guardar el archivo del contrato: ' . $e->getMessage()]);
        }

        $year = null;
        if (isset($values['${Fecha_de_Inicio}'])) {
            $date = $values['${Fecha_de_Inicio}'];
            try {
                $year = Carbon::parse($date)->year;
            } catch (\Exception $e) {
                Log::warning('Error al parsear fecha', ['date' => $date, 'error' => $e->getMessage()]);
            }
        }
        $coordinacionId = $request->coordinacion_id;
        if (auth()->check() && auth()->user()->role === 'coordinacion') {
            $coordinacionId = auth()->user()->coordinacion_id;
        }
        $contrato = Contrato::create([
            'nombre' => $request->nombre,
            'template_id' => $template->id,
            'data' => json_encode($values),
            'generated_file' => $generatedPath,
            'year' => $year,
            'coordinacion_id' => $coordinacionId,
        ]);
        return redirect()->route('contracts.show', $contrato->id)->with('success', 'Contrato creado.');
    }

    public function show($id)
    {
        $contrato = Contrato::with('coordinacion')->findOrFail($id);
        return view('contracts.show', compact('contrato'));
    }

    public function edit($id)
    {
        $contrato = Contrato::findOrFail($id);
        $template = $contrato->template;
        $fields = json_decode($template->fields, true);
        $values = json_decode($contrato->data, true);
        $infoRelevante = $this->getRelevantInfo($contrato);
        $coordinaciones = Coordinacion::activas()->get();

        return view('contracts.edit', compact(
            'contrato',
            'template',
            'fields',
            'values',
            'infoRelevante',
            'coordinaciones'
        ));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'values' => 'required|array',
            'coordinacion_id' => 'required|exists:coordinaciones,id',
        ]);

        $contrato = Contrato::findOrFail($id);
        $template = $contrato->template;
        $values = $request->values;
        $uploadedFiles = $request->file('files', []);

        $filePath = storage_path('app/' . $template->file_path);
        if (!Storage::exists($template->file_path)) {
            Log::error('Archivo de plantilla no encontrado', ['path' => $template->file_path]);
            return redirect()->back()->withErrors(['error' => 'El archivo de la plantilla no existe.']);
        }

        try {
            $templateProcessor = new TemplateProcessor($filePath);
        } catch (\Exception $e) {
            Log::error('Error al cargar archivo DOCX con TemplateProcessor', [
                'path' => $filePath,
                'error' => $e->getMessage(),
                'code' => $e->getCode()
            ]);
            return redirect()->back()->withErrors(['error' => 'Error al cargar la plantilla: ' . $e->getMessage()]);
        }

        $templateFields = json_decode($template->fields, true) ?? [];
        if (empty($templateFields)) {
            try {
                $text = $this->extractTextFromFile($filePath);
                $templateFields = $this->extraerCamposLlave($text);
                $signaturePlaceholders = $this->detectSignaturePlaceholders($filePath);
                foreach ($signaturePlaceholders as $fullPlaceholder) {
                    if (isset($templateFields[$fullPlaceholder])) {
                        $templateFields[$fullPlaceholder]['tipo'] = 'signature';
                    }
                }
            } catch (\Exception $e) {
                Log::warning('No se pudieron generar metadata de campos desde el archivo: ' . $e->getMessage());
            }
        }

        // Reuse the same generic replacement logic as store()
        foreach ($values as $placeholder => $valor) {
            $name = $this->stripPlaceholder($placeholder);

            $fieldTipo = 'texto';
            if (!empty($templateFields)) {
                foreach ($templateFields as $key => $meta) {
                    if (isset($meta['name']) && $meta['name'] === $name) {
                        $fieldTipo = $meta['tipo'] ?? 'texto';
                        break;
                    }
                }
            } else {
                $fieldTipo = $this->inferirTipo($name);
            }

            if ($fieldTipo === 'image') {
                if (isset($uploadedFiles[$name]) && $uploadedFiles[$name]->isValid()) {
                    $stored = $uploadedFiles[$name]->store('signatures');
                    $imagePath = storage_path('app/' . $stored);
                    try {
                        $templateProcessor->setImageValue($name, [
                            'path' => $imagePath,
                            'width' => 250,
                            'height' => 80,
                            'ratio' => false
                        ]);
                        Log::debug("Imagen (update) insertada para placeholder $name.");
                    } catch (\Exception $e) {
                        Log::error('Error al insertar imagen en template (update): ' . $e->getMessage(), ['placeholder' => $name]);
                    }
                } elseif ($this->isBase64Image($valor)) {
                    $fileName = 'sign_' . uniqid() . '.png';
                    $diskPath = 'signatures/' . $fileName;
                    $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $valor));
                    Storage::put($diskPath, $imageData);
                    $imagePath = storage_path('app/' . $diskPath);
                    try {
                        $templateProcessor->setImageValue($name, [
                            'path' => $imagePath,
                            'width' => 250,
                            'height' => 80,
                            'ratio' => false
                        ]);
                        Log::debug("Imagen (update) insertada desde base64 para placeholder $name.");
                    } catch (\Exception $e) {
                        Log::error('Error al insertar imagen base64 en template (update): ' . $e->getMessage(), ['placeholder' => $name]);
                    }
                } else {
                    Log::warning("No se encontró archivo para placeholder imagen $name en update.");
                }
            } elseif ($fieldTipo === 'signature') {
                $two = $this->splitNameIntoTwoLines($valor, 24);
                $hasL1 = $this->templateContainsPlaceholder($filePath, '${' . $name . '_L1}');
                $hasL2 = $this->templateContainsPlaceholder($filePath, '${' . $name . '_L2}');

                if ($hasL1 || $hasL2) {
                    if ($hasL1) {
                        try {
                            $templateProcessor->setValue($name . '_L1', $two['l1']);
                        } catch (\Exception $e) {
                            Log::error("Error al setValue {$name}_L1 (update): " . $e->getMessage());
                        }
                    }
                    if ($hasL2) {
                        try {
                            $templateProcessor->setValue($name . '_L2', $two['l2']);
                        } catch (\Exception $e) {
                            Log::error("Error al setValue {$name}_L2 (update): " . $e->getMessage());
                        }
                    }
                    Log::debug("Firma reemplazada usando L1/L2 (update) para $name");
                } else {
                    $formatted = $two['l1'] . "\n" . $two['l2'];
                    try {
                        $templateProcessor->setValue($name, $formatted);
                        Log::debug("Firma reemplazada en single placeholder $name (con salto de línea) (update).");
                    } catch (\Exception $e) {
                        Log::error("Error al setValue signature $name (update): " . $e->getMessage());
                    }
                }
            } else {
                try {
                    $templateProcessor->setValue($name, trim($valor));
                    Log::debug("Reemplazo aplicado (update): $name → $valor");
                } catch (\Exception $e) {
                    Log::error('Error al aplicar setValue en TemplateProcessor (update)', [
                        'placeholder' => $name,
                        'error' => $e->getMessage()
                    ]);
                }
            }
        }

        $generatedPath = $contrato->generated_file;

        try {
            $templateProcessor->saveAs(storage_path('app/' . $generatedPath));
        } catch (\Exception $e) {
            Log::error('Error al guardar archivo DOCX', [
                'path' => storage_path('app/' . $generatedPath),
                'error' => $e->getMessage(),
                'code' => $e->getCode()
            ]);
            return redirect()->back()->withErrors(['error' => 'No se pudo guardar el archivo del contrato: ' . $e->getMessage()]);
        }

        $year = null;
        if (isset($values['${Fecha}'])) {
            $date = $values['${Fecha}'];
            try {
                $year = Carbon::parse($date)->year;
            } catch (\Exception $e) {
                Log::warning('Error al parsear fecha', ['date' => $date, 'error' => $e->getMessage()]);
            }
        }
        $coordinacionId = $request->coordinacion_id;
        if (auth()->check() && auth()->user()->role === 'coordinacion') {
            $coordinacionId = auth()->user()->coordinacion_id;
        }
        $contrato->update([
            'nombre' => $request->nombre,
            'data' => json_encode($values),
            'year' => $year,
            'coordinacion_id' => $coordinacionId,
        ]);
        return redirect()->route('contracts.show', $contrato->id)->with('success', 'Contrato actualizado.');
    }

    public function destroy($id)
    {
        $contrato = Contrato::findOrFail($id);
        Storage::delete($contrato->generated_file);
        $contrato->delete();

        return redirect()->route('contracts.index')->with('success', 'Contrato eliminado.');
    }

    public function downloadWord($id)
    {
        $contrato = Contrato::findOrFail($id);
        $filePath = storage_path('app/' . $contrato->generated_file);
        if (!file_exists($filePath)) {
            Log::error('Archivo de contrato no encontrado', ['path' => $filePath]);
            return redirect()->back()->withErrors(['error' => 'El archivo del contrato no existe.']);
        }
        return response()->download($filePath, $contrato->nombre . '.docx');
    }

    public function downloadPdf($id)
    {
        $contrato = Contrato::findOrFail($id);
        $filePath = storage_path('app/' . $contrato->generated_file);
        if (!file_exists($filePath)) {
            Log::error('Archivo de contrato no encontrado', ['path' => $filePath]);
            return redirect()->back()->withErrors(['error' => 'El archivo del contrato no existe.']);
        }

        try {
            $phpWord = IOFactory::load($filePath);
            $pdfPath = $this->generatePdf($phpWord, $contrato->nombre);
            return response()->download($pdfPath, $contrato->nombre . '.pdf')->deleteFileAfterSend(true);
        } catch (\Exception $e) {
            Log::error('Error al generar PDF', [
                'path' => $filePath,
                'error' => $e->getMessage(),
                'code' => $e->getCode()
            ]);
            return redirect()->back()->withErrors(['error' => 'Error al generar PDF: ' . $e->getMessage()]);
        }
    }

    

    private function generatePdf($phpWord, $name, $deleteAfter = true)
    {
        $pdfFileName = uniqid('pdf_') . '_' . $name . '.pdf';
        $pdfPath = storage_path('app/temp/' . $pdfFileName);
        $writer = IOFactory::createWriter($phpWord, 'PDF');
        $writer->save($pdfPath);

        return $pdfPath;
    }

    private function getRelevantInfo($contrato)
    {
        return json_decode($contrato->data, true);
    }

    public function editTemplate($id)
    {
        $template = Template::findOrFail($id);
        return view('contracts.edit_templates', compact('template'));
    }

    public function updateTemplate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $template = Template::findOrFail($id);
        $template->name = $request->name;
        $template->save();

        return redirect()->route('contracts.index')->with('success', 'Nombre de la plantilla actualizado.');
    }

    public function destroyTemplate($id)
    {
        $template = Template::findOrFail($id);
        if (Storage::exists($template->file_path)) {
            Storage::delete($template->file_path);
        }
        $template->delete();

        return redirect()->route('contracts.index')->with('success', 'Plantilla eliminada correctamente.');
    }

    // ----------------------
    // Helpers and utilities
    // ----------------------

    // Extract plain text from DOCX using PhpWord (best-effort)
    private function extractTextFromFile($filePath)
    {
        try {
            $phpWord = IOFactory::load($filePath);
            $text = '';
            foreach ($phpWord->getSections() as $section) {
                $elements = $section->getElements();
                foreach ($elements as $element) {
                    if (method_exists($element, 'getText')) {
                        $text .= $element->getText() . ' ';
                    }
                }
            }
            return $text;
        } catch (\Exception $e) {
            Log::warning('Error al extraer texto con PhpWord: ' . $e->getMessage());
            // fallback: try reading document.xml directly
            $xml = $this->getDocumentXmlFromDocx($filePath);
            if ($xml !== null) {
                // strip tags and return text
                $plain = strip_tags($xml);
                return $plain;
            }
            return '';
        }
    }

    // Extract placeholders ${...} from text and return metadata array
    private function extraerCamposLlave($texto)
    {
        $campos = [];
        preg_match_all('/\$\{([^\}]+)\}/', $texto, $matches);

        if (!empty($matches[1])) {
            foreach ($matches[1] as $index => $rawKey) {
                $fullPlaceholder = $matches[0][$index]; // e.g. ${Nombre_Completo}
                $parsed = $this->parsePlaceholder($rawKey);
                $campos[$fullPlaceholder] = [
                    'name' => $parsed['name'],
                    'valor' => '',
                    'tipo' => $parsed['tipo'] ?? $this->inferirTipo($parsed['name']),
                ];
                Log::debug("Placeholder detectado: $fullPlaceholder, Limpiado: " . $parsed['name'] . ", Tipo: " . $campos[$fullPlaceholder]['tipo']);
            }
        }

        Log::info('Extraídos ' . count($campos) . ' campos por llaves');
        return $campos;
    }

    // Parse token like "Firma:image" or "Nombre|img"
    private function parsePlaceholder($token)
    {
        $result = ['name' => $token];

        if (strpos($token, ':') !== false) {
            [$name, $type] = explode(':', $token, 2);
            $result['name'] = trim($name);
            $result['tipo'] = trim($type);
        } elseif (strpos($token, '|') !== false) {
            [$name, $type] = explode('|', $token, 2);
            $result['name'] = trim($name);
            $result['tipo'] = trim($type);
        }

        if (!empty($result['tipo'])) {
            $t = strtolower($result['tipo']);
            if (in_array($t, ['img', 'image', 'imagen', 'foto', 'firma', 'signature', 'sign'])) {
                $result['tipo'] = 'image';
            } elseif (in_array($t, ['signature', 'sign', 'firma_text', 'signature_text'])) {
                $result['tipo'] = 'signature';
            }
        }

        return $result;
    }

    private function inferirTipo($campo)
    {
        $campo = strtolower($campo);
        if (preg_match('/fecha/', $campo)) return 'fecha';
        if (preg_match('/cedula|cedula_profesional/', $campo)) return 'cedula';
        if (preg_match('/asignatura/', $campo)) return 'asignatura';
        if (preg_match('/monto|precio|pago/', $campo)) return 'monto';
        if (preg_match('/firma|sign|signature/', $campo)) return 'signature';
        if (preg_match('/foto|imagen|img/', $campo)) return 'image';
        if (preg_match('/nombre|nombre_del|nombre_completo|profesionista|profesional/', $campo)) return 'nombre';
        return 'texto';
    }

    // Remove ${ and } and optional suffixes like :image or |img
    private function stripPlaceholder($placeholder)
    {
        $name = $placeholder;
        $name = preg_replace('/^\$\{/', '', $name);
        $name = preg_replace('/\}$/', '', $name);
        if (strpos($name, ':') !== false) {
            [$nameOnly] = explode(':', $name, 2);
            $name = $nameOnly;
        } elseif (strpos($name, '|') !== false) {
            [$nameOnly] = explode('|', $name, 2);
            $name = $nameOnly;
        }
        return $name;
    }

    // Detect placeholders contained inside table rows that have a fixed height (hRule="exact")
    // Returns an array of full placeholders as they appear (e.g. ${Nombre_del_Profesionista})
    private function detectSignaturePlaceholders(string $docxPath): array
    {
        $xml = $this->getDocumentXmlFromDocx($docxPath);
        if ($xml === null) {
            return [];
        }

        $placeholders = [];
        preg_match_all('/\$\{([^\}]+)\}/', $xml, $matches);
        if (empty($matches[0])) {
            return [];
        }

        try {
            $dom = new DOMDocument();
            // suppress warnings
            libxml_use_internal_errors(true);
            $dom->loadXML($xml);
            libxml_clear_errors();
            $xpath = new DOMXPath($dom);
            $xpath->registerNamespace('w', 'http://schemas.openxmlformats.org/wordprocessingml/2006/main');

            foreach ($matches[0] as $fullPlaceholder) {
                // Escape single quotes for XPath; we'll use concat if needed
                // Simpler: use contains() with the plain placeholder
                $expr = "//w:t[contains(., \"" . $this->xpathEscape($fullPlaceholder) . "\")]";
                $nodes = $xpath->query($expr);
                if ($nodes->length === 0) {
                    continue;
                }

                // For each found text node, check ancestor row for trPr/trHeight w:hRule="exact" or presence of trHeight
                $isSignature = false;
                foreach ($nodes as $node) {
                    $trNodes = $xpath->query('ancestor::w:tr[w:trPr/w:trHeight]', $node);
                    if ($trNodes->length > 0) {
                        $isSignature = true;
                        break;
                    }

                    // also check if the containing cell has an explicit vAlign center or tcPr with tcW etc. (best-effort)
                    $tcNodes = $xpath->query('ancestor::w:tc[w:tcPr/w:vAlign]', $node);
                    if ($tcNodes->length > 0) {
                        // treat as signature if cell has vertical alignment (heuristic)
                        $isSignature = true;
                        break;
                    }
                }

                if ($isSignature) {
                    $placeholders[] = $fullPlaceholder;
                }
            }
        } catch (\Exception $e) {
            Log::warning('Error detectSignaturePlaceholders: ' . $e->getMessage());
            return [];
        }

        Log::debug('placeholders detectados como signature: ' . json_encode($placeholders));
        return array_values(array_unique($placeholders));
    }

    // Helper: get document.xml contents from a DOCX package
    private function getDocumentXmlFromDocx(string $docxPath): ?string
    {
        if (!file_exists($docxPath)) {
            return null;
        }

        $zip = new ZipArchive();
        if ($zip->open($docxPath) === true) {
            $index = $zip->locateName('word/document.xml');
            if ($index === false) {
                $zip->close();
                return null;
            }
            $xml = $zip->getFromIndex($index);
            $zip->close();
            return $xml;
        }
        return null;
    }

    // Escape for XPath string literal (handles both quotes)
    private function xpathEscape(string $str): string
    {
        if (strpos($str, '"') === false) {
            return $str;
        }
        // fallback: use concat(...) (simple approach)
        $parts = explode('"', $str);
        $concat = [];
        foreach ($parts as $i => $part) {
            if ($part !== '') {
                $concat[] = "\"$part\"";
            }
            if ($i !== count($parts) - 1) {
                $concat[] = "'\"'"; // a double-quote char
            }
        }
        return 'concat(' . implode(',', $concat) . ')';
    }

    // Check if the template file contains a literal placeholder (exact match) - best-effort by checking document.xml raw
    private function templateContainsPlaceholder(string $docxPath, string $fullPlaceholder): bool
    {
        $xml = $this->getDocumentXmlFromDocx($docxPath);
        if ($xml === null) {
            return false;
        }
        return strpos($xml, $fullPlaceholder) !== false;
    }

    // Split a full name into two balanced lines (returns ['l1'=>'...','l2'=>'...'])
    private function splitNameIntoTwoLines(string $name, int $maxCharsPerLine = 24): array
    {
        $name = trim(preg_replace('/\s+/', ' ', $name));
        if ($name === '') {
            return ['l1' => '', 'l2' => ''];
        }
        if (mb_strlen($name) <= $maxCharsPerLine) {
            return ['l1' => $name, 'l2' => ''];
        }

        $words = explode(' ', $name);
        $line1 = '';
        $line2 = '';

        foreach ($words as $word) {
            if ($line1 === '' || mb_strlen($line1 . ' ' . $word) <= $maxCharsPerLine) {
                $line1 = trim($line1 . ' ' . $word);
            } else {
                $line2 = trim($line2 . ' ' . $word);
            }
        }

        if ($line2 === '') {
            // single very long word or didn't split: fallback split in two halves
            $half = (int) floor(mb_strlen($name) / 2);
            $left = mb_substr($name, 0, $half);
            $right = mb_substr($name, $half);
            return ['l1' => trim($left), 'l2' => trim($right)];
        }

        return ['l1' => $line1, 'l2' => $line2];
    }

    // Simple base64 image detector
    private function isBase64Image($string)
    {
        if (!is_string($string)) return false;
        return preg_match('#^data:image/[^;]+;base64,#', $string) === 1;
    }


    /**
 * Reemplazo simple sobre una copia del .docx.
 * $replacements debe ser array con keys exactas, por ejemplo: '${Nombre_del_Profesionista}' => 'Juan Pérez'
 * Retorna la ruta del archivo temporal (copia) o null si falla.
 */
private function replacePlaceholdersSimpleInDocx(string $originalDocxPath, array $replacements): ?string
{
    if (!file_exists($originalDocxPath)) return null;

    $tmpDir = storage_path('app/temp_templates');
    if (!file_exists($tmpDir)) {
        mkdir($tmpDir, 0755, true);
    }

    $tempPath = $tmpDir . '/' . uniqid('tpl_') . '.docx';
    if (!copy($originalDocxPath, $tempPath)) {
        return null;
    }

    $zip = new \ZipArchive();
    if ($zip->open($tempPath) !== true) {
        return null;
    }

    // Archivos a procesar
    $parts = ['word/document.xml'];
    // agregar headers/footers existentes
    for ($i = 0; $i < $zip->numFiles; $i++) {
        $stat = $zip->statIndex($i);
        $name = $stat['name'];
        if (preg_match('#^word/header[0-9]*\.xml$#', $name) || preg_match('#^word/footer[0-9]*\.xml$#', $name)) {
            $parts[] = $name;
        }
    }

    foreach ($parts as $part) {
        $xml = $zip->getFromName($part);
        if ($xml === false) continue;

        // Reemplazo literal (keys deben ser exactas)
        $newXml = strtr($xml, $replacements);

        if ($newXml !== $xml) {
            $zip->deleteName($part);
            $zip->addFromString($part, $newXml);
        }
    }

    $zip->close();
    return $tempPath;
}

// Reemplaza/usa estas funciones en App\Http/Controllers/ContractController.php
// Asegúrate de tener los `use` necesarios arriba del archivo:
// use PhpOffice\PhpWord\IOFactory;
// use Illuminate\Support\Facades\Log;

public function previewPdf($id)
{
    $contrato = Contrato::with('template')->findOrFail($id);
    $docxPath = storage_path('app/' . ($contrato->generated_file ?? ''));

    if (!file_exists($docxPath)) {
        Log::error('DOCX no encontrado para previewPdf', ['path' => $docxPath, 'contrato_id' => $id]);
        return abort(404, 'Documento no disponible');
    }

    @ini_set('memory_limit', '512M');
    @set_time_limit(120);

    try {
        // IMPORTANTE: Configurar DOMPDF antes de cargar PHPWord
        Settings::setPdfRendererName(Settings::PDF_RENDERER_DOMPDF);
        Settings::setPdfRendererPath(base_path('vendor/dompdf/dompdf'));
        
        // Cargar documento
        $phpWord = IOFactory::load($docxPath);
        
        // Crear PDF directamente en memoria
        $pdfFileName = 'preview_' . $contrato->id . '_' . time() . '.pdf';
        $pdfPath = storage_path('app/temp/' . $pdfFileName);
        
        // Asegurar que el directorio temp existe
        if (!file_exists(storage_path('app/temp'))) {
            mkdir(storage_path('app/temp'), 0755, true);
        }
        
        $writer = IOFactory::createWriter($phpWord, 'PDF');
        $writer->save($pdfPath);

        if (!file_exists($pdfPath)) {
            Log::error('No se generó el PDF temporal en previewPdf', ['expected' => $pdfPath]);
            return redirect()->back()->withErrors(['error' => 'No se pudo generar la vista previa del contrato.']);
        }

        $headers = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . preg_replace('/[^A-Za-z0-9_\-\.]/', '_', $contrato->nombre) . '.pdf"',
            'Cache-Control' => 'private, max-age=0, must-revalidate',
            'Pragma' => 'public',
            'X-Content-Type-Options' => 'nosniff',
            'X-Frame-Options' => 'SAMEORIGIN',
        ];

        $response = response()->file($pdfPath, $headers);

        // Programar borrado del temporal después de enviar
        register_shutdown_function(function() use ($pdfPath) {
            try { 
                if (file_exists($pdfPath)) {
                    unlink($pdfPath); 
                }
            } catch (\Throwable $e) { 
                Log::warning('No se pudo eliminar temporal PDF: '.$e->getMessage()); 
            }
        });

        return $response;
    } catch (\Throwable $e) {
        Log::error('Error al generar PDF para vista previa', [
            'path' => $docxPath,
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);
        
        // Alternativa: Mostrar mensaje amigable
        return response()->view('contracts.pdf_error', [
            'contrato' => $contrato,
            'error' => $e->getMessage()
        ], 500);
    }
}



}