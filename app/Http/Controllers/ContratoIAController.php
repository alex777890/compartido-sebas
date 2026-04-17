<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\IOFactory;
use App\Models\Template;
use Illuminate\Support\Facades\Log;

class ContratoIAController extends Controller
{
    public function index()
    {
        return view('contracts.index');
    }

    public function form()
    {
        return $this->index();
    }

    public function analyze()
    {
        try {
            Log::info('Accediendo a contracts.analyze');
            return view('contracts.analyze');
        } catch (\Exception $e) {
            Log::error('Error en ContratoIAController@analyze: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->withErrors(['error' => 'Ocurrió un error al cargar la página de análisis.']);
        }
    }

    public function process(Request $request)
    {
        Log::info('🔄 Iniciando procesamiento de contratos');

        $request->validate([
            'contrato_vacio' => 'required|file|mimes:doc,docx,pdf|max:5120',
        ]);

        $vacioTempPath = $request->file('contrato_vacio')->store('temp_templates');
        $permanentPath = str_replace('temp_templates/', 'templates/', $vacioTempPath);
        Storage::move($vacioTempPath, $permanentPath);

        $vacioText = $this->extractTextFromFile(storage_path('app/' . $permanentPath));
        $normalizedText = $this->normalizarTexto($vacioText);

        Log::debug('Buscando placeholders ${...} en el contrato vacío. Texto: ' . substr($normalizedText, 0, 200));

        $campos = $this->extraerCamposLlave($normalizedText); // CAMBIO AL MÉTODO de ${...}

        if (empty($campos)) {
            Log::warning('No se encontraron campos válidos para guardar la plantilla.');
            return back()->withErrors([
                'error' => 'No se encontraron placeholders ${...} válidos en el documento.'
            ]);
        }

        // Guardamos los placeholders tal cual (incluyendo el identificador de tipo en la estructura)
        $placeholders = array_keys($campos);

        $template = Template::create([
            'name' => 'Plantilla_' . uniqid(),
            'file_path' => $permanentPath,
            'fields' => json_encode($campos), // ahora guardamos estructura con tipos
        ]);

        Log::info("Plantilla creada con ID: {$template->id}, Campos: " . json_encode($campos));
        $message = "✅ " . count($campos) . " campos detectados. Procede a crear el contrato.";

        return redirect()->route('contracts.create', ['templateId' => $template->id])
            ->with('success', $message);
    }

    private function extractTextFromFile($filePath)
    {
        $extension = pathinfo($filePath, PATHINFO_EXTENSION);
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

        Log::debug('Texto extraído de DOCX/DOC: ' . substr($text, 0, 200));
        return $text;
    }

    private function normalizarTexto($texto)
    {
        return preg_replace('/[^\w\sáéíóúÁÉÍÓÚñÑ.,$:{}()\-\/\[\]\|]/u', ' ', $texto);
    }

    // EXTRAE LLAVES tipo ${Campo} y detecta sufijos :image o |img
    private function extraerCamposLlave($texto)
    {
        $campos = [];
        preg_match_all('/\$\{([^\}]+)\}/', $texto, $matches);

        if (!empty($matches[1])) {
            foreach ($matches[1] as $index => $rawKey) {
                $fullPlaceholder = $matches[0][$index]; // Ejemplo: ${Nombre_Completo} o ${Firma:image}
                $parsed = $this->parsePlaceholder($rawKey); // devuelve ['name'=>'Firma','tipo'=>'image']
                $campos[$fullPlaceholder] = [
                    'name' => $parsed['name'],
                    'valor' => '',
                    'tipo' => $parsed['tipo'] ?? $this->inferirTipo($parsed['name']),
                ];
                Log::debug("Placeholder detectado: $fullPlaceholder, Parsed: " . json_encode($campos[$fullPlaceholder]));
            }
        }

        Log::info('📝 Extraídos ' . count($campos) . ' campos por ${...}');
        return $campos;
    }

    /**
     * parsePlaceholder: interpreta si el token tiene sufijo de tipo
     * Ejemplos:
     * - "Firma:image"  => ['name'=>'Firma','tipo'=>'image']
     * - "Firma|img"    => ['name'=>'Firma','tipo'=>'image']
     * - "Nombre"       => ['name'=>'Nombre']
     */
    private function parsePlaceholder($token)
    {
        $result = ['name' => $token];

        // acepta sintaxis "campo:imagen" o "campo|img"
        if (strpos($token, ':') !== false) {
            [$name, $type] = explode(':', $token, 2);
            $result['name'] = trim($name);
            $result['tipo'] = trim($type);
        } elseif (strpos($token, '|') !== false) {
            [$name, $type] = explode('|', $token, 2);
            $result['name'] = trim($name);
            $result['tipo'] = trim($type);
        }

        // normalizar algunos alias
        if (!empty($result['tipo'])) {
            $t = strtolower($result['tipo']);
            if (in_array($t, ['img', 'image', 'imagen', 'foto', 'firma'])) {
                $result['tipo'] = 'image';
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
        if (preg_match('/nombre/', $campo)) return 'nombre';
        if (preg_match('/firma|sign|signature/', $campo)) return 'image';
        return 'texto';
    }
}