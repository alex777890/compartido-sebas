<?php

namespace App\Http\Controllers;

use App\Models\Maestro;
use App\Models\Periodo;
use App\Models\Horario;
use Illuminate\Http\Request;
use App\Services\CalculadorHorasService;
use Illuminate\Support\Facades\Storage;

class HorarioController extends Controller
{
    protected $calculadorHoras;

    public function __construct(CalculadorHorasService $calculadorHoras)
    {
        $this->calculadorHoras = $calculadorHoras;
    }

    public function index()
    {
        // 🔹 Obtiene TODOS los maestros sin límites
        $maestros = Maestro::select('id', 'nombres', 'apellido_paterno', 'apellido_materno', 'maximo_grado_academico', 'email')
            ->orderBy('nombres', 'asc')
            ->get();

        // 🔹 Crea un atributo nombre_completo si no existe en el modelo
        foreach ($maestros as $maestro) {
            $maestro->nombre_completo = trim("{$maestro->nombres} {$maestro->apellido_paterno} {$maestro->apellido_materno}");
        }

        // 🔹 Retorna la vista index
        return view('horarios.index', compact('maestros'));
    }

    public function mostrarFormulario($maestroId)
    {
        $maestro = Maestro::findOrFail($maestroId);
        $periodos = Periodo::all();
        
        // Obtener el periodo seleccionado (si existe)
        $periodoId = request('periodo_id');
        
        // Obtener periodos que ya tienen horario para mostrar etiqueta
        $periodosConHorario = Horario::where('maestro_id', $maestroId)
            ->pluck('periodo_id')
            ->unique()
            ->toArray();
            
        
        // Inicializar todas las variables con valores por defecto
        $horariosExistentes = [];
        $horarioCompleto = [];
        $materiasExistentes = [];
        $materiasColores = [];
        $siguienteColor = 1;
        $siguienteId = 1;
        $horariosExistentesFormatted = [];
        
        if ($periodoId) {
            $horariosExistentes = Horario::where('maestro_id', $maestroId)
                ->where('periodo_id', $periodoId)
                ->get();
                
            $horarioCompleto = $this->calculadorHoras->obtenerHorarioCompleto($maestroId, $periodoId);
            
            // Preparar materias existentes para JavaScript
            $materiasUnicas = $horariosExistentes->pluck('materia_nombre')->unique();
            
            foreach ($materiasUnicas as $index => $materiaNombre) {
                $materiasExistentes[] = [
                    'id' => $siguienteId++,
                    'nombre' => $materiaNombre,
                    'color' => $siguienteColor
                ];
                $materiasColores[$materiaNombre] = $siguienteColor;
                $siguienteColor = ($siguienteColor % 8) + 1;
            }
            
            // Preparar horarios existentes para JavaScript
            $horariosExistentesFormatted = [];
            foreach ($horariosExistentes as $horario) {
                // Encontrar el ID de la materia
                $materiaId = null;
                foreach ($materiasExistentes as $materia) {
                    if ($materia['nombre'] === $horario->materia_nombre) {
                        $materiaId = $materia['id'];
                        break;
                    }
                }
                
                if ($materiaId) {
                    $horariosExistentesFormatted[] = [
                        'clave' => $materiaId . '_' . $horario->dia . '_' . $horario->horario,
                        'materia_id' => $materiaId,
                        'materia_nombre' => $horario->materia_nombre,
                        'materia_color' => $materiasColores[$horario->materia_nombre],
                        'dia' => $horario->dia,
                        'horario' => $horario->horario,
                        'aula' => $horario->aula,
                        'grupo' => $horario->grupo
                    ];
                }
            }
        }
        
        return view('maestros.formulario_horas', compact(
            'maestro', 
            'periodos', 
            'periodoId', 
            'horariosExistentes',
            'horarioCompleto',
            'materiasExistentes',
            'materiasColores',
            'siguienteColor',
            'siguienteId',
            'horariosExistentesFormatted',
            'periodosConHorario'
        ));
    }

    public function guardarHorario(Request $request)
{
    $request->validate([
        'maestro_id' => 'required|exists:maestros,id',
        'periodo_id' => 'required|exists:periodos,id',
        'clases' => 'required|array',
        // Formato antiguo para compatibilidad
        'clases.*.materia_nombre' => 'required|string|max:255',
        'clases.*.dia' => 'required|in:Lunes,Martes,Miercoles,Jueves,Viernes',
        'clases.*.horario' => 'required|string|max:10',
        'clases.*.aula' => 'nullable|string|max:100',
        'clases.*.grupo' => 'nullable|string|max:100',
        'horario_foto' => 'nullable|file|mimes:jpeg,png,jpg,gif,pdf|max:5120',
    ]);

    try {
        // Eliminar horarios existentes
        Horario::where('maestro_id', $request->maestro_id)
               ->where('periodo_id', $request->periodo_id)
               ->delete();

        // Procesar la foto
        $horarioFotoPath = null;
        if ($request->hasFile('horario_foto')) {
            $file = $request->file('horario_foto');
            $fileName = 'horario_' . $request->maestro_id . '_' . $request->periodo_id . '_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('horarios/fotos', $fileName, 'public');
            $horarioFotoPath = $path;
        }

        // 🔥 CONVERTIR formato antiguo a nuevo
        foreach ($request->clases as $clase) {
            // Convertir horario antiguo (ej: "7-8") a nuevo formato
            list($horaInicio, $horaFin) = explode('-', $clase['horario']);
            
            Horario::create([
                'maestro_id' => $request->maestro_id,
                'periodo_id' => $request->periodo_id,
                'materia_nombre' => $clase['materia_nombre'],
                'dias' => [$clase['dia']], // Convertir string a array
                'horario_inicio' => $horaInicio . ':00',
                'horario_fin' => $horaFin . ':00',
                'aula' => $clase['aula'] ?? '',
                'grupo' => $clase['grupo'] ?? '',
                'horario_foto' => $horarioFotoPath,
                'duracion_horas' => 1, // Cada hora individual es 1 hora
            ]);
        }

        // Calcular horas totales
        $totalHoras = Horario::calcularHorasTotalesMaestro($request->maestro_id, $request->periodo_id);

        $maestro = Maestro::find($request->maestro_id);
        $periodo = Periodo::find($request->periodo_id);

        return redirect()->route('horarios.formulario', [
            'maestroId' => $request->maestro_id
        ])->with([
            'success' => "Horario guardado exitosamente. {$maestro->nombre_completo} tiene {$totalHoras} horas clase en el periodo {$periodo->nombre}.",
            'periodo_id' => $request->periodo_id
        ]);

    } catch (\Exception $e) {
        return redirect()->back()->with('error', 
            'Error al guardar el horario: ' . $e->getMessage()
        );
    }
}

    public function verHorario($maestroId, $periodoId = null)
    {
        $maestro = Maestro::findOrFail($maestroId);
        $periodos = Periodo::where('activo', true)->get();
        
        if (!$periodoId) {
            $periodoActivo = Periodo::where('activo', true)->first();
            $periodoId = $periodoActivo ? $periodoActivo->id : null;
        }

        $horarioCompleto = $periodoId ? 
            $this->calculadorHoras->obtenerHorarioCompleto($maestroId, $periodoId) : [];
        $resumenHoras = $periodoId ? 
            $this->calculadorHoras->calcularHorasMaestro($maestroId, $periodoId) : [];

        return view('horarios.ver', compact(
            'maestro', 
            'periodos', 
            'periodoId', 
            'horarioCompleto', 
            'resumenHoras'
        ));
    }

    public function calcularHorasMaestro(Request $request)
    {
        $request->validate([
            'maestro_id' => 'required|exists:maestros,id',
            'periodo_id' => 'required|exists:periodos,id'
        ]);

        $maestroId = $request->maestro_id;
        $periodoId = $request->periodo_id;

        // Usar el servicio para calcular horas
        $resultado = $this->calculadorHoras->calcularHorasMaestro($maestroId, $periodoId);
        $horarioCompleto = $this->calculadorHoras->obtenerHorarioCompleto($maestroId, $periodoId);

        $maestro = Maestro::find($maestroId);
        $periodo = Periodo::find($periodoId);

        return view('maestros.resultado_horas', compact(
            'resultado', 
            'horarioCompleto', 
            'maestro', 
            'periodo'
        ));
    }

    public function verificarHorarios($maestroId, $periodoId)
    {
        $horarios = Horario::with(['periodo'])
            ->where('maestro_id', $maestroId)
            ->where('periodo_id', $periodoId)
            ->get();

        $maestro = Maestro::find($maestroId);
        $periodo = Periodo::find($periodoId);

        return view('horarios.verificar', compact('horarios', 'maestro', 'periodo'));
    }
}