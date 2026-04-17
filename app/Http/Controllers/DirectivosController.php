<?php

namespace App\Http\Controllers;

use App\Models\Maestro;
use App\Models\Coordinacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DirectivosController extends Controller
{
    /**
     * Dashboard principal para directivos con filtros
     */
    public function dashboard(Request $request)
    {
        // Iniciar consulta con relaciones necesarias (AGREGAMOS 'periodos')
        $query = Maestro::with(['user', 'coordinacion', 'gradosAcademicos', 'periodos']);
        
        // Aplicar filtro por coordinación
        if ($request->filled('coordinacion')) {
            $query->where('coordinaciones_id', $request->coordinacion);
        }
        
        // Aplicar filtro por nombre del maestro (búsqueda en nombres y apellidos)
        if ($request->filled('nombre')) {
            $searchTerm = $request->nombre;
            $query->where(function($q) use ($searchTerm) {
                $q->where('nombres', 'like', "%{$searchTerm}%")
                  ->orWhere('apellido_paterno', 'like', "%{$searchTerm}%")
                  ->orWhere('apellido_materno', 'like', "%{$searchTerm}%");
            });
        }
        
        // Ordenar por coordinación y luego por apellidos
        $query->orderBy('coordinaciones_id')
              ->orderBy('apellido_paterno')
              ->orderBy('apellido_materno')
              ->orderBy('nombres');
        
        // Paginar resultados (20 por página)
        $maestros = $query->paginate(20)->withQueryString();
        
        // Estadísticas generales (sin filtros)
        $totalMaestros = Maestro::count();
        
        // Maestros por coordinación (sin filtros para mantener estadísticas generales)
        $maestrosPorCoordinacion = Coordinacion::withCount('maestros')
            ->where('activo', true)
            ->get();
        
        return view('directivos.dashboard', compact(
            'maestros', 
            'totalMaestros', 
            'maestrosPorCoordinacion'
        ));
    }

    /**
     * Vista detallada de maestros con filtros (alternativa)
     */
    public function maestros(Request $request)
    {
        $query = Maestro::with(['user', 'coordinacion', 'gradosAcademicos', 'periodos']);
        
        // Aplicar filtros
        if ($request->filled('coordinacion')) {
            $query->where('coordinaciones_id', $request->coordinacion);
        }
        
        if ($request->filled('nombre')) {
            $searchTerm = $request->nombre;
            $query->where(function($q) use ($searchTerm) {
                $q->where('nombres', 'like', "%{$searchTerm}%")
                  ->orWhere('apellido_paterno', 'like', "%{$searchTerm}%")
                  ->orWhere('apellido_materno', 'like', "%{$searchTerm}%");
            });
        }
        
        // Filtro por grado académico (opcional)
        if ($request->filled('grado')) {
            $query->whereHas('gradosAcademicos', function($q) use ($request) {
                $q->where('tipo_grado', $request->grado);
            });
        }
        
        $maestros = $query->orderBy('apellido_paterno')
                         ->orderBy('apellido_materno')
                         ->paginate(20)
                         ->withQueryString();
        
        $coordinaciones = Coordinacion::where('activo', true)->get();
        
        return view('directivos.maestros', compact('maestros', 'coordinaciones'));
    }

    /**
     * Ver detalles de un maestro específico
     */
    public function verMaestro($id)
    {
        $maestro = Maestro::with(['user', 'coordinacion', 'gradosAcademicos', 'documentos', 'periodos'])
            ->findOrFail($id);
        
        // Calcular antigüedad
        $antiguedad = $this->calcularAntiguedadTotal($maestro);
        
        // Si es petición AJAX, devolver solo el contenido
        if (request()->ajax()) {
            return view('directivos.partials.maestro-detalle', compact('maestro', 'antiguedad'));
        }
        
        return view('directivos.ver-maestro', compact('maestro', 'antiguedad'));
    }

    /**
     * Vista para antigüedad (pendiente)
     */
    public function antiguedad(Request $request)
    {
        // Por ahora solo redirige al dashboard con mensaje
        return redirect()->route('directivos.dashboard')
            ->with('info', 'Módulo de antigüedad en desarrollo. Próximamente disponible.');
    }

    // =============================================
    // FUNCIONES DE CÁLCULO DE ANTIGÜEDAD (AGREGADAS)
    // =============================================

    /**
     * Calcular antigüedad total de un maestro
     */
    private function calcularAntiguedadTotal($maestro)
    {
        $anioIngreso = $maestro->anio_ingreso;

        if (!$anioIngreso) {
            return [
                'anios' => 0,
                'meses' => 0,
                'total_meses' => 0
            ];
        }

        // Sumar SOLO los meses trabajados registrados en periodos
        $totalMesesTrabajados = 0;

        foreach ($maestro->periodos as $periodo) {
            $mesesPeriodo = json_decode($periodo->pivot->meses_trabajados, true) ?? [];
            $totalMesesTrabajados += count($mesesPeriodo);
        }

        // Calcular años y meses basado SOLO en meses trabajados
        $aniosTotales = floor($totalMesesTrabajados / 12);
        $mesesRestantes = $totalMesesTrabajados % 12;

        return [
            'anio_ingreso' => $anioIngreso,
            'total_meses' => $totalMesesTrabajados,
            'anios' => $aniosTotales,
            'meses' => $mesesRestantes
        ];
    }

    /**
     * Obtener el último período calculado de un maestro
     */
    private function obtenerUltimoPeriodo($maestro)
    {
        return $maestro->periodos()
            ->orderBy('pivot_created_at', 'desc')
            ->first();
    }
}