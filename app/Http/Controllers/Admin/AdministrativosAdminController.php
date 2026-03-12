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
        
        // Iniciar query con relaciones
        $query = Administrativo::with(['user', 'documentosAdmin']);
        
        // Aplicar filtro por nombre
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('nombres', 'like', "%{$searchTerm}%")
                  ->orWhere('apellido_paterno', 'like', "%{$searchTerm}%")
                  ->orWhere('apellido_materno', 'like', "%{$searchTerm}%")
                  ->orWhere('numero_empleado', 'like', "%{$searchTerm}%");
            });
        }
        
        // Aplicar filtro por área
        if ($request->has('area') && !empty($request->area)) {
            $query->where('area_adscripcion', 'like', "%{$request->area}%");
        }
        
        // Aplicar filtro por estado de documentos
        if ($request->has('estado') && !empty($request->estado)) {
            if ($request->estado === 'completos') {
                $query->whereHas('documentosAdmin', function($q) {
                    $q->where('estado', 'aprobado');
                }, '=', 4); // 4 documentos requeridos
            } elseif ($request->estado === 'incompletos') {
                $query->whereHas('documentosAdmin', function($q) {
                    $q->where('estado', 'aprobado');
                }, '<', 4);
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
        
        // Ordenar
        $query->orderBy('apellido_paterno')->orderBy('apellido_materno')->orderBy('nombres');
        
        // Paginar resultados
        $administrativos = $query->paginate(15)->withQueryString();
        
        // Obtener período activo para contexto
        $periodoActivo = Periodo::getPeriodoSubidaHabilitada();
        
        // Estadísticas generales
        $totalAdministrativos = Administrativo::count();
        $conDocumentosCompletos = Administrativo::whereHas('documentosAdmin', function($q) {
            $q->where('estado', 'aprobado');
        }, '=', 4)->count();
        $conDocumentosPendientes = Administrativo::whereHas('documentosAdmin', function($q) {
            $q->where('estado', 'pendiente');
        })->count();
        $conDocumentosRechazados = Administrativo::whereHas('documentosAdmin', function($q) {
            $q->where('estado', 'rechazado');
        })->count();
        
        // Áreas para filtro
        $areas = Administrativo::select('area_adscripcion')
            ->distinct()
            ->whereNotNull('area_adscripcion')
            ->orderBy('area_adscripcion')
            ->pluck('area_adscripcion');
        
        return view('administrativos-admin.index', compact(
            'administrativos',
            'periodoActivo',
            'totalAdministrativos',
            'conDocumentosCompletos',
            'conDocumentosPendientes',
            'conDocumentosRechazados',
            'areas'
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
        
        // Obtener período activo
        $periodoActivo = Periodo::getPeriodoSubidaHabilitada();
        
        // Estadísticas de documentos
        $documentos = $administrativo->documentosAdmin;
        $totalDocumentos = $documentos->count();
        $documentosAprobados = $documentos->where('estado', 'aprobado')->count();
        $documentosPendientes = $documentos->where('estado', 'pendiente')->count();
        $documentosRechazados = $documentos->where('estado', 'rechazado')->count();
        
        // Progreso
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
        
        // Tipos de documentos para referencia
        $tiposDocumentos = [
            'identificacion_oficial' => 'Identificación Oficial',
            'comprobante_domicilio' => 'Comprobante de Domicilio',
            'curriculum' => 'Currículum Vitae',
            'acta_nacimiento' => 'Acta de Nacimiento'
        ];
        
        // Agrupar documentos por período
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
                'observaciones_admin' => null // Limpiar observaciones si las había
            ]);
            
            Log::info('Documento aprobado exitosamente');
            
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
            
            Log::info('Documento rechazado con observaciones');
            
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
        
        // Total de administrativos
        $total = Administrativo::count();
        
        // Documentos por estado
        $documentosAprobados = DocumentoAdministrativo::where('estado', 'aprobado')->count();
        $documentosPendientes = DocumentoAdministrativo::where('estado', 'pendiente')->count();
        $documentosRechazados = DocumentoAdministrativo::where('estado', 'rechazado')->count();
        
        // Administrativos con documentos completos
        $completos = 0;
        $administrativos = Administrativo::with('documentosAdmin')->get();
        foreach ($administrativos as $admin) {
            $aprobados = $admin->documentosAdmin->where('estado', 'aprobado')->count();
            if ($aprobados >= 4) {
                $completos++;
            }
        }
        
        // Documentos por tipo
        $documentosPorTipo = [
            'identificacion_oficial' => DocumentoAdministrativo::where('tipo', 'identificacion_oficial')->count(),
            'comprobante_domicilio' => DocumentoAdministrativo::where('tipo', 'comprobante_domicilio')->count(),
            'curriculum' => DocumentoAdministrativo::where('tipo', 'curriculum')->count(),
            'acta_nacimiento' => DocumentoAdministrativo::where('tipo', 'acta_nacimiento')->count(),
        ];
        
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