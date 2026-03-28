<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Administrativo;
use App\Models\DocumentoAdministrativo;
use App\Models\Periodo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class AdministrativosAdminController extends Controller
{
    /**
     * Mostrar lista de todos los administrativos
     */
    public function index(Request $request)
    {
        Log::info('=== ADMIN ADMINISTRATIVOS INDEX ===');
        
        $query = Administrativo::with(['user', 'documentosAdmin']);
        
        // Aplicar filtro por nombre
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('nombres', 'like', "%{$searchTerm}%")
                  ->orWhere('apellido_paterno', 'like', "%{$searchTerm}%")
                  ->orWhere('apellido_materno', 'like', "%{$searchTerm}%");
            });
        }
        
        // Aplicar filtro por puesto
        if ($request->has('puesto') && !empty($request->puesto)) {
            $query->where('puesto', 'like', "%{$request->puesto}%");
        }
        
        // Aplicar filtro por estado de documentos (10 documentos requeridos)
        $totalRequeridos = count(Administrativo::TIPOS_DOCUMENTOS);
        
        if ($request->has('estado') && !empty($request->estado)) {
            if ($request->estado === 'completos') {
                $query->whereHas('documentosAdmin', function($q) {
                    $q->where('estado', 'aprobado');
                }, '=', $totalRequeridos);
            } elseif ($request->estado === 'incompletos') {
                $query->whereHas('documentosAdmin', function($q) {
                    $q->where('estado', 'aprobado');
                }, '<', $totalRequeridos);
            } elseif ($request->estado === 'pendientes') {
                $query->whereHas('documentosAdmin', function($q) {
                    $q->where('estado', 'pendiente');
                });
            } elseif ($request->estado === 'rechazados') {
                $query->whereHas('documentosAdmin', function($q) {
                    $q->where('estado', 'rechazado');
                });
            }
        }
        
        $query->orderBy('apellido_paterno')->orderBy('apellido_materno')->orderBy('nombres');
        
        $administrativos = $query->paginate(15)->withQueryString();
        
        $periodoActivo = Periodo::getPeriodoSubidaHabilitada();
        
        $totalAdministrativos = Administrativo::count();
        $conDocumentosCompletos = Administrativo::whereHas('documentosAdmin', function($q) use ($totalRequeridos) {
            $q->where('estado', 'aprobado');
        }, '=', $totalRequeridos)->count();
        $conDocumentosPendientes = Administrativo::whereHas('documentosAdmin', function($q) {
            $q->where('estado', 'pendiente');
        })->count();
        $conDocumentosRechazados = Administrativo::whereHas('documentosAdmin', function($q) {
            $q->where('estado', 'rechazado');
        })->count();
        
        $puestos = Administrativo::select('puesto')
            ->distinct()
            ->whereNotNull('puesto')
            ->orderBy('puesto')
            ->pluck('puesto');
        
        return view('administrativos-admin.index', compact(
            'administrativos',
            'periodoActivo',
            'totalAdministrativos',
            'conDocumentosCompletos',
            'conDocumentosPendientes',
            'conDocumentosRechazados',
            'puestos'
        ));
    }

    /**
     * Ver detalles de un administrativo específico
     */
    public function show($id)
    {
        Log::info('=== ADMIN ADMINISTRATIVOS SHOW ===', ['id' => $id]);
        
        $administrativo = Administrativo::with([
            'user', 
            'documentosAdmin' => function($query) {
                $query->with('revisadoPor', 'periodo')->orderBy('created_at', 'desc');
            }
        ])->findOrFail($id);
        
        $periodoActivo = Periodo::getPeriodoSubidaHabilitada();
        
        $documentos = $administrativo->documentosAdmin;
        $totalDocumentos = $documentos->count();
        $documentosAprobados = $documentos->where('estado', 'aprobado')->count();
        $documentosPendientes = $documentos->where('estado', 'pendiente')->count();
        $documentosRechazados = $documentos->where('estado', 'rechazado')->count();
        
        $progreso = $administrativo->progreso_documentos;
        
        return view('administrativos-admin.show', compact(
            'administrativo',
            'periodoActivo',
            'documentos',
            'totalDocumentos',
            'documentosAprobados',
            'documentosPendientes',
            'documentosRechazados',
            'progreso'
        ));
    }

    /**
     * Ver todos los documentos de un administrativo
     */
    public function documentos($id)
    {
        Log::info('=== ADMIN ADMINISTRATIVOS DOCUMENTOS ===', ['id' => $id]);
        
        $administrativo = Administrativo::with([
            'user',
            'documentosAdmin' => function($query) {
                $query->with('revisadoPor', 'periodo')->orderBy('created_at', 'desc');
            }
        ])->findOrFail($id);
        
        // Tipos de documentos actualizados
        $tiposDocumentos = Administrativo::TIPOS_DOCUMENTOS;
        
        $documentosPorPeriodo = $administrativo->documentosAdmin->groupBy(function($doc) {
            return $doc->periodo ? $doc->periodo->nombre : 'Sin período';
        });
        
        return view('administrativos-admin.documentos', compact(
            'administrativo',
            'tiposDocumentos',
            'documentosPorPeriodo'
        ));
    }

    /**
     * Aprobar un documento
     */
    public function aprobarDocumento($id)
    {
        try {
            Log::info('=== APROBAR DOCUMENTO ADMINISTRATIVO ===', ['id' => $id]);
            
            $documento = DocumentoAdministrativo::findOrFail($id);
            
            $documento->update([
                'estado' => 'aprobado',
                'revisado_por' => Auth::id(),
                'fecha_revision' => now(),
                'observaciones_admin' => null
            ]);
            
            return redirect()->back()->with('success', 'Documento aprobado correctamente.');
            
        } catch (\Exception $e) {
            Log::error('Error al aprobar documento: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error al aprobar el documento.');
        }
    }

    /**
     * Rechazar un documento con observaciones
     */
    public function rechazarDocumento(Request $request, $id)
    {
        try {
            Log::info('=== RECHAZAR DOCUMENTO ADMINISTRATIVO ===', ['id' => $id]);
            
            $request->validate([
                'observaciones' => 'required|string|max:1000'
            ]);
            
            $documento = DocumentoAdministrativo::findOrFail($id);
            
            $documento->update([
                'estado' => 'rechazado',
                'observaciones_admin' => $request->observaciones,
                'revisado_por' => Auth::id(),
                'fecha_revision' => now()
            ]);
            
            return redirect()->back()->with('warning', 'Documento rechazado con observaciones.');
            
        } catch (\Exception $e) {
            Log::error('Error al rechazar documento: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error al rechazar el documento.');
        }
    }

    /**
     * Ver documento en navegador
     */
    public function verDocumento($id)
    {
        try {
            $documento = DocumentoAdministrativo::findOrFail($id);
            
            if (!Storage::disk('public')->exists($documento->ruta_archivo)) {
                abort(404, 'El archivo no existe');
            }
            
            $rutaCompleta = Storage::disk('public')->path($documento->ruta_archivo);
            
            return response()->file($rutaCompleta, [
                'Content-Type' => $documento->mime_type,
                'Content-Disposition' => 'inline; filename="' . $documento->nombre_archivo . '"'
            ]);
            
        } catch (\Exception $e) {
            Log::error('Error al ver documento: ' . $e->getMessage());
            abort(404, 'Documento no encontrado');
        }
    }

    /**
     * Descargar documento
     */
    public function descargarDocumento($id)
    {
        try {
            $documento = DocumentoAdministrativo::findOrFail($id);
            
            if (!Storage::disk('public')->exists($documento->ruta_archivo)) {
                return redirect()->back()->with('error', 'El archivo no existe en el servidor');
            }
            
            return Storage::disk('public')->download(
                $documento->ruta_archivo, 
                $documento->nombre_archivo
            );
            
        } catch (\Exception $e) {
            Log::error('Error al descargar documento: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error al descargar el documento');
        }
    }

    /**
     * Estadísticas generales de administrativos
     */
    public function estadisticas()
    {
        Log::info('=== ADMIN ADMINISTRATIVOS ESTADISTICAS ===');
        
        $total = Administrativo::count();
        
        $documentosAprobados = DocumentoAdministrativo::where('estado', 'aprobado')->count();
        $documentosPendientes = DocumentoAdministrativo::where('estado', 'pendiente')->count();
        $documentosRechazados = DocumentoAdministrativo::where('estado', 'rechazado')->count();
        
        $totalRequeridos = count(Administrativo::TIPOS_DOCUMENTOS);
        $completos = 0;
        $administrativos = Administrativo::with('documentosAdmin')->get();
        foreach ($administrativos as $admin) {
            $aprobados = $admin->documentosAdmin->where('estado', 'aprobado')->count();
            if ($aprobados >= $totalRequeridos) {
                $completos++;
            }
        }
        
        $documentosPorTipo = [];
        foreach (array_keys(Administrativo::TIPOS_DOCUMENTOS) as $tipo) {
            $documentosPorTipo[$tipo] = DocumentoAdministrativo::where('tipo', $tipo)->count();
        }
        
        return view('administrativos-admin.estadisticas', compact(
            'total',
            'documentosAprobados',
            'documentosPendientes',
            'documentosRechazados',
            'completos',
            'documentosPorTipo'
        ));
    }
}