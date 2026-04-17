<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Maestro;
use App\Models\Periodo;
use App\Models\Horario;
use Illuminate\Http\Request;
use App\Services\CalculadorHorasService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB; // ✅ AGREGAR PARA CONSULTAS

class HorarioCoordinacionController extends Controller
{
    protected $calculadorHoras;

    public function __construct(CalculadorHorasService $calculadorHoras)
    {
        $this->calculadorHoras = $calculadorHoras;
    }

    /**
     * Mostrar lista de maestros para coordinación
     */
    public function index()
    {
        $maestros = Maestro::select('id', 'nombres', 'apellido_paterno', 'apellido_materno', 'maximo_grado_academico', 'email', 'coordinacion_id')
            ->with('coordinacion')
            ->orderBy('nombres', 'asc')
            ->get();

        foreach ($maestros as $maestro) {
            $maestro->nombre_completo = trim("{$maestro->nombres} {$maestro->apellido_paterno} {$maestro->apellido_materno}");
        }

        $periodoActivo = Periodo::where('activo', true)->first();

        return view('horarios.index', compact('maestros', 'periodoActivo'));
    }

    /**
     * Mostrar formulario para asignar horario (coordinación)
     */
    public function mostrarFormulario($maestroId)
    {
        $maestro = Maestro::findOrFail($maestroId);
        
        $periodos = Periodo::orderBy('fecha_inicio', 'desc')->get();
        
        $periodoId = request('periodo_id', Periodo::where('subida_habilitada', true)->value('id'));
        
        $periodosConHorario = Horario::where('maestro_id', $maestroId)
            ->pluck('periodo_id')
            ->unique()
            ->toArray();
        
        $horariosAgrupados = [];
        $materias = [];
        $colores = [1, 2, 3, 4, 5, 6, 7, 8];
        $materiasVistas = [];
        
        if ($periodoId) {
            $horarios = Horario::where('maestro_id', $maestroId)
                ->where('periodo_id', $periodoId)
                ->get();
            
            foreach ($horarios as $horario) {
                $materiaNombre = $horario->materia_nombre;
                
                if (!in_array($materiaNombre, $materiasVistas)) {
                    $materias[] = [
                        'id' => count($materias) + 1,
                        'nombre' => $materiaNombre,
                        'color' => $colores[count($materias) % count($colores)]
                    ];
                    $materiasVistas[] = $materiaNombre;
                }
            }
            
            foreach ($horarios as $horario) {
                $materiaNombre = $horario->materia_nombre;
                
                $colorMateria = 1;
                foreach ($materias as $m) {
                    if ($m['nombre'] === $materiaNombre) {
                        $colorMateria = $m['color'];
                        break;
                    }
                }
                
                $dias = is_array($horario->dias) ? $horario->dias : json_decode($horario->dias, true) ?? [];
                
                foreach ($dias as $dia) {
                    $horaInicio = date('G', strtotime($horario->horario_inicio));
                    $horaFin = date('G', strtotime($horario->horario_fin));
                    $rangoHorario = $horaInicio . '-' . $horaFin;
                    
                    $horariosAgrupados[] = [
                        'id' => $horario->id,
                        'dia' => $dia,
                        'horario' => $rangoHorario,
                        'materia_nombre' => $materiaNombre,
                        'color' => $colorMateria,
                        'aula' => $horario->aula,
                        'grupo' => $horario->grupo
                    ];
                }
            }
        }
        
        return view('coordinaciones.horarios.asignacion', compact(
            'maestro',
            'periodos',
            'periodoId',
            'horariosAgrupados',
            'materias',
            'periodosConHorario'
        ));
    }

    /**
     * Guardar horario (mejorado para manejar fotos)
     */
    public function guardarHorario(Request $request)
    {
        try {
            // Validar datos básicos
            $request->validate([
                'maestro_id' => 'required|exists:maestros,id',
                'periodo_id' => 'required|exists:periodos,id',
            ]);

            // VERIFICAR ACCIONES ESPECIALES
            // 1. Eliminar foto
            if ($request->has('eliminar_foto')) {
                return $this->eliminarFotoHorario($request->maestro_id, $request->periodo_id);
            }
            
            // 2. Subir solo foto (sin guardar horario)
            if ($request->has('subir_foto')) {
                return $this->subirFotoHorario($request);
            }

            // 3. Guardar horario completo (con o sin foto)
            return $this->guardarHorarioCompleto($request);

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al procesar la solicitud: ' . $e->getMessage())
                ->withInput();
        }
    }

/**
 * Subir solo la foto del horario - CORREGIDO (AHORA ACEPTA EXCEL Y WORD)
 */
private function subirFotoHorario(Request $request)
{
    $request->validate([
        'maestro_id' => 'required|exists:maestros,id',
        'periodo_id' => 'required|exists:periodos,id',
        'horario_foto' => 'required|file|mimes:jpeg,png,jpg,gif,pdf,xlsx,xls,csv,doc,docx|max:5120', // ✅ AÑADIDO doc,docx
    ]);

    try {
        // Buscar si existe algún horario para este maestro y período
        $horariosExistentes = Horario::where('maestro_id', $request->maestro_id)
            ->where('periodo_id', $request->periodo_id)
            ->get();
        
        // Subir nueva foto
        $file = $request->file('horario_foto');
        $extension = $file->getClientOriginalExtension();
        $fileName = 'horario_' . $request->maestro_id . '_' . $request->periodo_id . '_' . time() . '.' . $extension;
        $path = $file->storeAs('horarios/fotos', $fileName, 'public');

        if ($horariosExistentes->isNotEmpty()) {
            // Si ya hay horarios, actualizar TODOS con la nueva foto
            foreach ($horariosExistentes as $horario) {
                // Eliminar foto anterior si existe
                if ($horario->horario_foto && Storage::disk('public')->exists($horario->horario_foto)) {
                    Storage::disk('public')->delete($horario->horario_foto);
                }
                
                $horario->horario_foto = $path;
                $horario->save();
            }
        } else {
            // No hay horarios, crear un registro SOLO para la foto
            Horario::create([
                'maestro_id' => $request->maestro_id,
                'periodo_id' => $request->periodo_id,
                'materia_nombre' => 'SIN MATERIAS',
                'dias' => [],
                'horario_inicio' => '00:00',
                'horario_fin' => '00:00',
                'aula' => '',
                'grupo' => '',
                'horario_foto' => $path,
                'duracion_horas' => 0,
                'usuario_registro' => Auth::id(),
                'rol_registro' => 'coordinacion'
            ]);
        }

        $maestro = Maestro::find($request->maestro_id);
        $periodo = Periodo::find($request->periodo_id);

        return redirect()->route('horarios.coordinacion.asignacion', [
            'maestroId' => $request->maestro_id,
            'periodo_id' => $request->periodo_id
        ])->with('success', "✅ Archivo del horario subido exitosamente para {$maestro->nombre_completo} en el periodo {$periodo->nombre}.");

    } catch (\Exception $e) {
        return redirect()->back()
            ->with('error', 'Error al subir el archivo: ' . $e->getMessage())
            ->withInput();
    }
}

    /**
     * Eliminar foto del horario
     */
    private function eliminarFotoHorario($maestroId, $periodoId)
    {
        try {
            $horarios = Horario::where('maestro_id', $maestroId)
                ->where('periodo_id', $periodoId)
                ->get();

            $fotoEliminada = false;

            foreach ($horarios as $horario) {
                if ($horario->horario_foto) {
                    // Eliminar archivo físico
                    if (Storage::disk('public')->exists($horario->horario_foto)) {
                        Storage::disk('public')->delete($horario->horario_foto);
                    }
                    
                    $horario->horario_foto = null;
                    $horario->save();
                    $fotoEliminada = true;
                }
            }

            if (!$fotoEliminada) {
                return redirect()->back()->with('info', 'No había foto para eliminar.');
            }

            $maestro = Maestro::find($maestroId);
            $periodo = Periodo::find($periodoId);

            return redirect()->route('horarios.coordinacion.asignacion', [
                'maestroId' => $maestroId,
                'periodo_id' => $periodoId
            ])->with('success', "🗑️ Foto del horario eliminada para {$maestro->nombre_completo}.");

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al eliminar la foto: ' . $e->getMessage());
        }
    }

    /**
 * Ver o descargar foto del horario (CORREGIDO - AHORA INTENTA VER DOCUMENTOS)
 */
public function verFotoHorario($maestroId, $periodoId)
{
    try {
        $horario = Horario::where('maestro_id', $maestroId)
            ->where('periodo_id', $periodoId)
            ->whereNotNull('horario_foto')
            ->first();
        
        if (!$horario || !$horario->horario_foto) {
            abort(404, 'Archivo no encontrado');
        }
        
        $path = $horario->horario_foto;
        
        // Si la ruta ya incluye 'storage/', la limpiamos
        if (strpos($path, 'storage/') === 0) {
            $path = substr($path, 8);
        }
        
        // Verificar si el archivo existe
        if (!Storage::disk('public')->exists($path)) {
            abort(404, 'Archivo no encontrado en el servidor');
        }
        
        // Obtener el archivo
        $file = Storage::disk('public')->get($path);
        $mimeType = Storage::disk('public')->mimeType($path);
        $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));
        
        $filename = 'horario_' . $maestroId . '_' . $periodoId . '.' . $extension;
        
        // Determinar si es descarga o visualización
        if (request()->has('download')) {
            // Si tiene parámetro download, FORZAR descarga
            $disposition = 'attachment';
        } else {
            // Si NO tiene parámetro download, INTENTAR ver en el navegador
            // Esto aplica para TODOS los formatos, incluyendo Word y Excel
            $disposition = 'inline';
        }
        
        // Configurar cabeceras según el tipo de archivo
        $headers = [
            'Content-Type' => $mimeType,
            'Content-Disposition' => $disposition . '; filename="' . $filename . '"',
            'Cache-Control' => 'public, max-age=0',
            'Pragma' => 'public'
        ];
        
        // Establecer los tipos MIME correctos para cada formato
        switch ($extension) {
            case 'pdf':
                $headers['Content-Type'] = 'application/pdf';
                break;
            case 'doc':
                $headers['Content-Type'] = 'application/msword';
                break;
            case 'docx':
                $headers['Content-Type'] = 'application/vnd.openxmlformats-officedocument.wordprocessingml.document';
                break;
            case 'xls':
                $headers['Content-Type'] = 'application/vnd.ms-excel';
                break;
            case 'xlsx':
                $headers['Content-Type'] = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
                break;
            case 'csv':
                $headers['Content-Type'] = 'text/csv';
                break;
            case 'jpg':
            case 'jpeg':
                $headers['Content-Type'] = 'image/jpeg';
                break;
            case 'png':
                $headers['Content-Type'] = 'image/png';
                break;
            case 'gif':
                $headers['Content-Type'] = 'image/gif';
                break;
        }
        
        // Devolver el archivo
        return response($file, 200)
            ->withHeaders($headers);
            
    } catch (\Exception $e) {
        abort(500, 'Error al cargar el archivo: ' . $e->getMessage());
    }
}

    /**
     * Guardar horario completo con clases
     */
    private function guardarHorarioCompleto(Request $request)
    {
        $request->validate([
            'clases' => 'required|array',
            'clases.*.materia_nombre' => 'required|string|max:255',
            'clases.*.dia' => 'required|in:Lunes,Martes,Miércoles,Jueves,Viernes',
            'clases.*.horario' => 'required|string|max:10',
            'clases.*.aula' => 'nullable|string|max:100',
            'clases.*.grupo' => 'nullable|string|max:100',
            'horario_foto' => 'nullable|file|mimes:jpeg,png,jpg,gif,pdf,xlsx,xls,csv,doc,docx|max:5120', 
        ]);

        try {
            // Obtener foto existente si la hay
            $horarioExistente = Horario::where('maestro_id', $request->maestro_id)
                ->where('periodo_id', $request->periodo_id)
                ->whereNotNull('horario_foto')
                ->first();
            
            $horarioFotoPath = $horarioExistente ? $horarioExistente->horario_foto : null;

            // Si se subió una nueva foto, reemplazar
            if ($request->hasFile('horario_foto')) {
                // Eliminar foto anterior si existe
                if ($horarioExistente && $horarioExistente->horario_foto) {
                    if (Storage::disk('public')->exists($horarioExistente->horario_foto)) {
                        Storage::disk('public')->delete($horarioExistente->horario_foto);
                    }
                }
                
                $file = $request->file('horario_foto');
                $fileName = 'horario_' . $request->maestro_id . '_' . $request->periodo_id . '_' . time() . '.' . $file->getClientOriginalExtension();
                $horarioFotoPath = $file->storeAs('horarios/fotos', $fileName, 'public');
            }

            // Eliminar horarios existentes (pero mantener la foto si ya estaba)
            Horario::where('maestro_id', $request->maestro_id)
                   ->where('periodo_id', $request->periodo_id)
                   ->delete();

            // Agrupar por materia, horario, aula y grupo
            $clasesAgrupadas = [];
            
            foreach ($request->clases as $clase) {
                $key = $clase['materia_nombre'] . '|' . $clase['horario'] . '|' . ($clase['aula'] ?? '') . '|' . ($clase['grupo'] ?? '');
                
                if (!isset($clasesAgrupadas[$key])) {
                    $clasesAgrupadas[$key] = [
                        'materia_nombre' => $clase['materia_nombre'],
                        'horario' => $clase['horario'],
                        'aula' => $clase['aula'] ?? '',
                        'grupo' => $clase['grupo'] ?? '',
                        'dias' => []
                    ];
                }
                
                if (!in_array($clase['dia'], $clasesAgrupadas[$key]['dias'])) {
                    $clasesAgrupadas[$key]['dias'][] = $clase['dia'];
                }
            }

            // Guardar clases agrupadas
            foreach ($clasesAgrupadas as $clase) {
                list($horaInicio, $horaFin) = explode('-', $clase['horario']);
                
                Horario::create([
                    'maestro_id' => $request->maestro_id,
                    'periodo_id' => $request->periodo_id,
                    'materia_nombre' => $clase['materia_nombre'],
                    'dias' => $clase['dias'],
                    'horario_inicio' => $horaInicio . ':00',
                    'horario_fin' => $horaFin . ':00',
                    'aula' => $clase['aula'],
                    'grupo' => $clase['grupo'],
                    'horario_foto' => $horarioFotoPath,
                    'duracion_horas' => 1,
                    'usuario_registro' => Auth::id(),
                    'rol_registro' => 'coordinacion'
                ]);
            }

            // Calcular horas totales
            $totalHoras = Horario::calcularHorasTotalesMaestro($request->maestro_id, $request->periodo_id);

            $maestro = Maestro::find($request->maestro_id);
            $periodo = Periodo::find($request->periodo_id);

            return redirect()->route('horarios.coordinacion.asignacion', [
                'maestroId' => $request->maestro_id,
                'periodo_id' => $request->periodo_id
            ])->with('success', "✅ Horario guardado exitosamente. {$maestro->nombre_completo} tiene {$totalHoras} horas clase en el periodo {$periodo->nombre}.");

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al guardar el horario: ' . $e->getMessage());
        }
    }

    /**
     * Ver horario de un maestro
     */
    public function verHorario($maestroId, $periodoId = null)
    {
        $maestro = Maestro::findOrFail($maestroId);
        $periodos = Periodo::orderBy('fecha_inicio', 'desc')->get();
        
        if (!$periodoId) {
            $periodoActivo = Periodo::where('activo', true)->first();
            $periodoId = $periodoActivo ? $periodoActivo->id : null;
        }

        $horarioCompleto = [];
        $resumenHoras = [];
        
        if ($periodoId) {
            $horarios = Horario::where('maestro_id', $maestroId)
                ->where('periodo_id', $periodoId)
                ->get();
            
            foreach ($horarios as $horario) {
                $dias = is_array($horario->dias) ? $horario->dias : json_decode($horario->dias, true) ?? [];
                
                foreach ($dias as $dia) {
                    $horaInicio = date('G', strtotime($horario->horario_inicio));
                    $horaFin = date('G', strtotime($horario->horario_fin));
                    $rangoHorario = $horaInicio . '-' . $horaFin;
                    
                    if (!isset($horarioCompleto[$dia])) {
                        $horarioCompleto[$dia] = [];
                    }
                    
                    $horarioCompleto[$dia][] = [
                        'horario' => $rangoHorario,
                        'materia_nombre' => $horario->materia_nombre,
                        'aula' => $horario->aula,
                        'grupo' => $horario->grupo
                    ];
                }
            }
            
            $resumenHoras = $this->calculadorHoras->calcularHorasMaestro($maestroId, $periodoId);
        }

        return view('coordinaciones.horarios.ver', compact(
            'maestro', 
            'periodos', 
            'periodoId', 
            'horarioCompleto', 
            'resumenHoras'
        ));
    }

    /**
     * API para obtener horarios por período
     */
    public function getHorariosPorPeriodo(Request $request)
    {
        $request->validate([
            'maestro_id' => 'required|exists:maestros,id',
            'periodo_id' => 'required|exists:periodos,id'
        ]);

        $horarios = Horario::where('maestro_id', $request->maestro_id)
            ->where('periodo_id', $request->periodo_id)
            ->get();

        return response()->json([
            'success' => true,
            'horarios' => $horarios
        ]);
    }
}