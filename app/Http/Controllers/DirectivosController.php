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
        // Iniciar consulta con relaciones necesarias
        $query = Maestro::with(['user', 'coordinacion', 'gradosAcademicos']);
        
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
        $query = Maestro::with(['user', 'coordinacion', 'gradosAcademicos']);
        
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
        $maestro = Maestro::with(['user', 'coordinacion', 'gradosAcademicos', 'documentos'])
            ->findOrFail($id);
        
        // Si es petición AJAX, devolver solo el contenido
        if (request()->ajax()) {
            return view('directivos.partials.maestro-detalle', compact('maestro'));
        }
        
        return view('directivos.ver-maestro', compact('maestro'));
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
}