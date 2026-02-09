<?php

namespace App\Http\Controllers;

use Carbon\Carbon; // ← ESTA ES LA QUE FALTA
use App\Models\Periodo; // ✅ AGREGAR ESTA LÍNEA
use App\Models\Maestro;
use App\Models\Coordinacion;
use App\Models\DocumentoMaestro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class DocumentoMaestroController extends Controller
{
  
     public function dashboardMaestro()
    {   
        Log::info('=== DASHBOARD MAESTRO EJECUTADO ===');

        try {
            // Obtener el maestro autenticado
            $user = Auth::user();
            
            if (!$user) {
                return redirect()->route('login')->with('error', 'Debes iniciar sesión');
            }
            
            Log::info("Usuario autenticado: {$user->id}, Email: {$user->email}");
            
            // Obtener maestro con sus documentos y coordinación
            $maestro = null;
            
            if (isset($user->maestro_id)) {
                $maestro = Maestro::with(['coordinacion', 'documentos.periodo', 'documentos.revisadoPor'])->find($user->maestro_id);
            }
            
            if (!$maestro) {
                $maestro = Maestro::with(['coordinacion', 'documentos.periodo', 'documentos.revisadoPor'])->where('email', $user->email)->first();
            }
            
            if (!$maestro) {
                $maestro = Maestro::with(['coordinacion', 'documentos.periodo', 'documentos.revisadoPor'])->where('user_id', $user->id)->first();
            }
            
            if (!$maestro) {
                Log::error('No se encontró maestro para el usuario: ' . $user->id);
                return redirect()->route('login')->with('error', 'No tienes un perfil de maestro asociado');
            }
            
            Log::info("Maestro encontrado: {$maestro->nombres}, ID: {$maestro->id}, Coordinación ID: {$maestro->coordinacion_id}");
            
               // ✅ **CORRECCIÓN: USAR EL NUEVO MÉTODO**
        $periodoHabilitado = $this->verificarYConfigurarPeriodo();
            if (!$periodoHabilitado) {
                Log::warning("⚠️ NO SE ENCONTRÓ PERÍODO ACTIVO");
                // Si no hay período, crear uno temporal para el view
                $periodoHabilitado = (object) [
                    'id' => null,
                    'nombre' => 'No hay período activo',
                    'activo' => 0,
                    'fecha_inicio' => null,
                    'fecha_fin' => null,
                    'estado' => 'inactivo'
                ];
            } else {
                // ✅ IMPORTANTE: Agregar propiedad 'activo' para la vista
                $periodoHabilitado->activo = 1;
                Log::info("✅ PERÍODO ENCONTRADO: {$periodoHabilitado->nombre} (ID: {$periodoHabilitado->id})");
            }
            
            // ✅ CORRECCIÓN CRÍTICA: COORDINACIÓN ID 7
            $coordinacionId = $maestro->coordinacion_id ?? 1;
            Log::info("Coordinación ID del maestro: {$coordinacionId}");
            
            // Tipos de documentos base
            $tiposBase = [
                'cst' => ['nombre' => 'Constancia de Situación Fiscal (CST)', 'icono' => 'file-contract', 'descripcion' => 'Documento oficial de situación fiscal actual'],
                'iufim' => ['nombre' => 'Documento IUFIM', 'icono' => 'file-invoice', 'descripcion' => 'Declaración de ingresos y gastos'],
                'comprobante_domicilio' => ['nombre' => 'Comprobante de Domicilio', 'icono' => 'home', 'descripcion' => 'Recibo que acredita domicilio actual'],
                'oficio_ingresos' => ['nombre' => 'Oficio de Ingresos', 'icono' => 'money-bill-wave', 'descripcion' => 'Documento oficial que certifica ingresos'],
                'declaracion_anual' => ['nombre' => 'Declaración Anual', 'icono' => 'file-alt', 'descripcion' => 'Declaración fiscal anual'],
                'comprobante_seguro_social' => ['nombre' => 'Comprobante de Seguro Social', 'icono' => 'shield-alt', 'descripcion' => 'Afiliación al seguro social vigente'],
                'curriculum' => ['nombre' => 'Curriculum Vitae', 'icono' => 'file-alt', 'descripcion' => 'Hoja de vida actualizada'],
                'cedula_profesional' => ['nombre' => 'Cédula Profesional', 'icono' => 'id-card', 'descripcion' => 'Cédula profesional vigente'],
                'titulo' => ['nombre' => 'Título Profesional', 'icono' => 'graduation-cap', 'descripcion' => 'Título profesional registrado']
            ];
            
            // ✅ CORRECCIÓN: AGREGAR COORDINACIÓN 7 AL ARRAY
            $documentosPorCoordinacion = [
                1 => ['cst', 'iufim', 'comprobante_domicilio'],
                2 => ['cst', 'iufim', 'oficio_ingresos', 'declaracion_anual'],
                3 => ['cst', 'iufim', 'comprobante_seguro_social', 'comprobante_domicilio'],
                7 => ['cst', 'iufim', 'comprobante_domicilio', 'curriculum', 'cedula_profesional', 'titulo'],
            ];
            
            // Tipos permitidos para esta coordinación
            $tiposPermitidos = $documentosPorCoordinacion[$coordinacionId] ?? [
                'cst', 'iufim', 'comprobante_domicilio', 
                'oficio_ingresos', 'declaracion_anual', 'comprobante_seguro_social',
                'curriculum', 'cedula_profesional', 'titulo'
            ];
            
            Log::info("Tipos permitidos para coordinación {$coordinacionId}: " . implode(', ', $tiposPermitidos));
            
            // Filtrar solo los tipos permitidos para mostrar
            $tiposDocumentos = [];
            foreach ($tiposPermitidos as $tipo) {
                if (isset($tiposBase[$tipo])) {
                    $tiposDocumentos[$tipo] = $tiposBase[$tipo];
                }
            }
            
            Log::info("Tipos de documentos para mostrar: " . count($tiposDocumentos));
            
            // ✅ FILTRAR DOCUMENTOS POR PERIODO (SI EXISTE PERIODO)
            if ($periodoHabilitado && $periodoHabilitado->id) {
                $maestro->load(['documentos' => function($query) use ($periodoHabilitado) {
                    $query->where('periodo_id', $periodoHabilitado->id)
                          ->orderBy('tipo', 'asc')
                          ->with('revisadoPor', 'periodo');
                }]);
                
                Log::info("Documentos del maestro en período {$periodoHabilitado->nombre}: " . $maestro->documentos->count());
            } else {
                // Mostrar todos los documentos si no hay período
                $maestro->load(['documentos' => function($query) {
                    $query->orderBy('tipo', 'asc')
                          ->with('revisadoPor', 'periodo');
                }]);
            }
            
            // ✅ CREAR DOCUMENTOS PARA VISTA
            $documentosParaVista = [];
            $documentosRechazados = [];
            $documentosAprobados = [];
            $documentosPendientes = [];
            
            foreach ($tiposDocumentos as $tipo => $info) {
                $documentoExistente = $maestro->documentos->where('tipo', $tipo)->first();
                
                if ($documentoExistente) {
                    $documentosParaVista[] = [
                        'tipo' => $tipo,
                        'nombre' => $info['nombre'],
                        'icono' => $info['icono'],
                        'descripcion' => $info['descripcion'],
                        'tiene_documento' => true,
                        'estado' => $documentoExistente->estado,
                        'documento_id' => $documentoExistente->id,
                        'archivo' => $documentoExistente->nombre_archivo,
                        'fecha_subida' => $documentoExistente->created_at,
                        'observaciones' => $documentoExistente->observaciones_admin,
                        'revisado_por' => $documentoExistente->revisadoPor->name ?? null
                    ];
                    
                    // Clasificar
                    if ($documentoExistente->estado == 'rechazado') {
                        $documentosRechazados[] = $documentoExistente;
                    } elseif ($documentoExistente->estado == 'aprobado') {
                        $documentosAprobados[] = $documentoExistente;
                    } elseif ($documentoExistente->estado == 'pendiente') {
                        $documentosPendientes[] = $documentoExistente;
                    }
                } else {
                    $documentosParaVista[] = [
                        'tipo' => $tipo,
                        'nombre' => $info['nombre'],
                        'icono' => $info['icono'],
                        'descripcion' => $info['descripcion'],
                        'tiene_documento' => false,
                        'estado' => 'faltante'
                    ];
                }
            }
            
            // ✅ CALCULAR ESTADÍSTICAS
            $totalRequeridos = count($tiposDocumentos);
            $totalSubidos = $maestro->documentos->count();
            $aprobados = count($documentosAprobados);
            $rechazados = count($documentosRechazados);
            $pendientes = count($documentosPendientes);
            $faltantes = $totalRequeridos - $totalSubidos;
            $porcentaje = $totalRequeridos > 0 ? round(($totalSubidos / $totalRequeridos) * 100) : 0;
            
            $estadisticas = [
                'total' => $totalSubidos,
                'aprobados' => $aprobados,
                'rechazados' => $rechazados,
                'pendientes' => $pendientes,
                'porcentaje' => $porcentaje,
                'requeridos' => $totalRequeridos,
                'total_subidos' => $totalSubidos,
                'total_requeridos' => $totalRequeridos,
                'faltantes' => $faltantes
            ];
            
            Log::info("Estadísticas: " . json_encode($estadisticas));
            
           // ✅ AGREGAR ESTAS LÍNEAS ANTES DEL RETURN
$hayPeriodoHabilitado = false;
$nombrePeriodo = 'No hay período habilitado';

if ($periodoHabilitado && isset($periodoHabilitado->id)) {
    $hayPeriodoHabilitado = true;
    $nombrePeriodo = $periodoHabilitado->nombre;
    
    // También asegurarnos de que el período tenga las propiedades necesarias
    if (!isset($periodoHabilitado->activo)) {
        $periodoHabilitado->activo = 1;
    }
    
    // Si no tiene estado, agregarlo
    if (!isset($periodoHabilitado->estado)) {
        $periodoHabilitado->estado = 'activo';
    }
    
    // Si no tiene fechas, agregar fechas por defecto
    if (!isset($periodoHabilitado->fecha_inicio)) {
        $periodoHabilitado->fecha_inicio = now()->format('Y-m-d');
    }
    
    if (!isset($periodoHabilitado->fecha_fin)) {
        $periodoHabilitado->fecha_fin = now()->addMonths(3)->format('Y-m-d');
    }
} else {
    // Crear un objeto dummy para el período
    $periodoHabilitado = (object) [
        'id' => null,
        'nombre' => 'No hay período activo',
        'activo' => 0,
        'fecha_inicio' => null,
        'fecha_fin' => null,
        'estado' => 'inactivo'
    ];
}

// ✅ RETORNAR VISTA CON TODOS LOS DATOS
return view('maestros.dashboard', compact(
    'maestro', 
    'tiposDocumentos',
    'estadisticas',
    'documentosRechazados',
    'documentosAprobados',
    'documentosPendientes',
    'periodoHabilitado',
    'documentosParaVista',
    'hayPeriodoHabilitado',  // ✅ AGREGAR ESTA
    'nombrePeriodo'          // ✅ AGREGAR ESTA
));
            
            
        } catch (\Exception $e) {
            Log::error('Error en dashboardMaestro: ' . $e->getMessage());
            Log::error('Trace: ' . $e->getTraceAsString());
            return back()->with('error', 'Error al cargar el dashboard: ' . $e->getMessage());
        }
    }
    // Agrega este método AL PRINCIPIO de tu dashboardMaestro

    private function verificarYConfigurarPeriodo()
{
    try {
        Log::info('=== BUSCANDO PERÍODO PARA MAESTRO ===');
        
        // ✅ USAR EL NUEVO MÉTODO ESPECÍFICO
        $periodo = Periodo::getPeriodoParaMaestros();
        
        if ($periodo) {
            Log::info("✅ MAESTRO VERÁ EL PERÍODO: {$periodo->nombre}");
            Log::info("   Estado: {$periodo->estado}");
            Log::info("   Subida habilitada: " . ($periodo->subida_habilitada ? 'SI' : 'NO'));
            
            // Agregar propiedad para la vista
            $periodo->activo = 1;
            return $periodo;
        }
        
        Log::warning("⚠️ MAESTRO NO VERÁ NINGÚN PERÍODO");
        
        // Debug adicional
        $todosPeriodos = Periodo::all();
        Log::info("Períodos en BD: " . $todosPeriodos->count());
        foreach ($todosPeriodos as $p) {
            Log::info("   - {$p->id}: {$p->nombre} | Estado: {$p->estado} | Subida: " . ($p->subida_habilitada ? 'SI' : 'NO'));
        }
        
        return null;
        
    } catch (\Exception $e) {
        Log::error("Error: " . $e->getMessage());
        return null;
    }
}




    // ✅ MÉTODO CORREGIDO Y SIMPLIFICADO PARA OBTENER PERÍODO
    private function obtenerPeriodoActivo()
    {
        $hoy = Carbon::now();
        
        // 1. Primero buscar cualquier período que esté en rango de fechas
        $periodo = Periodo::whereDate('fecha_inicio', '<=', $hoy)
            ->whereDate('fecha_fin', '>=', $hoy)
            ->orderBy('fecha_inicio', 'desc')
            ->first();
        
        if ($periodo) {
            Log::info("✅ Período encontrado (en rango): {$periodo->nombre}");
            return $periodo;
        }
        
        // 2. Si no hay en rango, buscar el último período creado
        $periodo = Periodo::orderBy('fecha_inicio', 'desc')->first();
        
        if ($periodo) {
            Log::info("⚠️ Usando último período disponible: {$periodo->nombre}");
            return $periodo;
        }
        
        Log::info("❌ No hay períodos en la base de datos");
        return null;
    }

    // ✅ MÉTODO ADICIONAL SIMPLE PARA VER SI HAY PERÍODOS (solo para debug rápido)
    public function verificarPeriodos()
    {
        $periodos = Periodo::all();
        
        if ($periodos->isEmpty()) {
            return "❌ NO HAY PERÍODOS EN LA BASE DE DATOS";
        }
        
        $html = "<h3>Períodos en BD ({$periodos->count()}):</h3>";
        foreach ($periodos as $p) {
            $html .= "<p><strong>{$p->nombre}</strong> ({$p->estado})<br>";
            $html .= "{$p->fecha_inicio} al {$p->fecha_fin}</p>";
        }
        
        return $html;
    }

    
public function revisionDocumentos($coordinacionId, $maestroId)
{
    Log::info('=== MÉTODO revisionDocumentos INDIVIDUAL EJECUTADO ===');
    Log::info('Coordinación ID recibido: ' . $coordinacionId);
    Log::info('Maestro ID recibido: ' . $maestroId);
    
    try {
        // Buscar la coordinación
        $coordinacion = Coordinacion::findOrFail($coordinacionId);
        
        // ✅ **CORRECCIÓN: USAR EL MISMO MÉTODO QUE EN DASHBOARD**
        $periodoSubida = Periodo::getPeriodoSubidaHabilitada();
        
        if (!$periodoSubida) {
            Log::info('No se encontró período habilitado. Buscando último período...');
            $periodoSubida = Periodo::latest()->first();
        }
        
        if (!$periodoSubida) {
            Log::warning("❌ NO SE ENCONTRÓ NINGÚN PERÍODO");
            $periodoSubida = null;
        } else {
            Log::info("✅ PERÍODO ENCONTRADO: {$periodoSubida->nombre} (ID: {$periodoSubida->id})");
        }

        // Buscar el maestro específico
        $maestro = Maestro::where('id', $maestroId)
            ->where('coordinaciones_id', $coordinacionId)
            ->firstOrFail();
        
        Log::info("=== MAESTRO INDIVIDUAL ID {$maestro->id} ===");
        Log::info("Nombre: {$maestro->nombres}");
        
        // ✅ **CARGAR DOCUMENTOS SOLO DEL PERÍODO ACTUAL (si hay período)**
        if ($periodoSubida) {
            // Cargar documentos específicos del período actual
            $maestro->load(['documentos' => function($query) use ($periodoSubida) {
                $query->where('periodo_id', $periodoSubida->id)
                      ->with('revisadoPor')
                      ->orderBy('tipo', 'asc');
            }]);
            
            Log::info("Documentos del maestro en período {$periodoSubida->nombre}: " . $maestro->documentos->count());
        } else {
            // Si no hay período habilitado, mostrar todos los documentos
            $maestro->load(['documentos' => function($query) {
                $query->with('revisadoPor')->orderBy('tipo', 'asc');
            }]);
            
            Log::info("No hay período habilitado, mostrando todos los documentos: " . $maestro->documentos->count());
        }
        
        // Tipos de documentos base
        $tiposBase = [
            'cst' => ['nombre' => 'Constancia de Situación Fiscal (CST)', 'icono' => 'file-contract', 'color' => 'primary'],
            'iufim' => ['nombre' => 'Documento IUFIM', 'icono' => 'file-invoice', 'color' => 'info'],
            'comprobante_domicilio' => ['nombre' => 'Comprobante de Domicilio', 'icono' => 'home', 'color' => 'success'],
            'oficio_ingresos' => ['nombre' => 'Oficio de Ingresos', 'icono' => 'money-bill-wave', 'color' => 'warning'],
            'declaracion_anual' => ['nombre' => 'Declaración Anual', 'icono' => 'file-alt', 'color' => 'secondary'],
            'comprobante_seguro_social' => ['nombre' => 'Comprobante de Seguro Social', 'icono' => 'shield-alt', 'color' => 'danger'],
            'curriculum' => ['nombre' => 'Curriculum Vitae', 'icono' => 'file-alt', 'color' => 'info'],
            'cedula_profesional' => ['nombre' => 'Cédula Profesional', 'icono' => 'id-card', 'color' => 'success'],
            'titulo' => ['nombre' => 'Título Profesional', 'icono' => 'graduation-cap', 'color' => 'primary']
        ];
        
        // Documentos requeridos por coordinación
        $documentosPorCoordinacion = [
            1 => ['cst', 'iufim', 'comprobante_domicilio'],
            2 => ['cst', 'iufim', 'oficio_ingresos', 'declaracion_anual'],
            3 => ['cst', 'iufim', 'comprobante_seguro_social', 'comprobante_domicilio'],
        ];
        
        $documentosRequeridos = $documentosPorCoordinacion[$coordinacionId] ?? [
            'cst', 'iufim', 'comprobante_domicilio', 'oficio_ingresos', 
            'declaracion_anual', 'comprobante_seguro_social'
        ];
        
        // ✅ **CALCULAR ESTADÍSTICAS PARA ESTE MAESTRO INDIVIDUAL**
        $documentosDelMaestro = $maestro->documentos;
        $totalDocumentosSubidos = $documentosDelMaestro->count();
        $totalDocumentosAprobados = $documentosDelMaestro->where('estado', 'aprobado')->count();
        $totalDocumentosPendientes = $documentosDelMaestro->where('estado', 'pendiente')->count();
        $totalDocumentosRechazados = $documentosDelMaestro->where('estado', 'rechazado')->count();
        
        // Calcular porcentaje de completado
        $documentosEsperadosMaestro = count($documentosRequeridos);
        $porcentajeMaestro = $documentosEsperadosMaestro > 0 ? 
            round(($totalDocumentosSubidos / $documentosEsperadosMaestro) * 100) : 0;
        
        // ✅ **AGREGAR: Información del período para la vista**
        $periodoHabilitado = $periodoSubida;
        $hayPeriodoHabilitado = $periodoSubida != null;
        $nombrePeriodo = $periodoSubida ? $periodoSubida->nombre : 'No hay período habilitado';
        
        // Pasar datos a la vista
        return view('maestros.revision_documentos', compact(
            'maestro', 
            'coordinacion',
            'tiposBase',
            'documentosRequeridos',
            'totalDocumentosSubidos',
            'totalDocumentosAprobados',
            'totalDocumentosPendientes',
            'totalDocumentosRechazados',
            'porcentajeMaestro',
            'periodoSubida', 
            'periodoHabilitado',     // ✅ AGREGAR
            'hayPeriodoHabilitado',  // ✅ AGREGAR
            'nombrePeriodo'          // ✅ AGREGAR
        ));
        
    } catch (\Exception $e) {
        Log::error('ERROR en revisionDocumentos individual: ' . $e->getMessage());
        Log::error('Trace: ' . $e->getTraceAsString());
        
        return redirect()->route('coordinaciones.index')
            ->with('error', 'Error al cargar los documentos del maestro: ' . $e->getMessage());
    }
}

    
    public function updateObservaciones(Request $request, $id)
{
    \Log::info('=== UPDATE OBSERVACIONES SIMPLIFICADO ===');
    
    try {
        $documento = DocumentoMaestro::findOrFail($id);
        
        // Validar
        $request->validate([
            'observaciones_admin' => 'nullable|string|max:1000'
        ]);
        
        // Texto simple - sin limpieza compleja
        $observaciones = $request->observaciones_admin ? trim($request->observaciones_admin) : null;
        
        // Actualizar
        $documento->observaciones_admin = $observaciones;
        $documento->revisado_por = Auth::id();
        $documento->fecha_revision = now();
        $documento->save();
        
        \Log::info('Observaciones guardadas para documento: ' . $id);
        
        // Respuesta JSON SEGURA Y SIMPLE
        $response = [
            'success' => true,
            'message' => 'Observaciones guardadas',
            'data' => [
                'observaciones' => $observaciones,
                'fecha' => $documento->fecha_revision->format('d/m/Y H:i'),
                'revisado_por' => Auth::user()->name
            ]
        ];
        
        // FORZAR encoding UTF-8
        return response()
            ->json($response, 200, [
                'Content-Type' => 'application/json; charset=utf-8'
            ], JSON_UNESCAPED_UNICODE);
            
    } catch (\Exception $e) {
        \Log::error('Error: ' . $e->getMessage());
        
        return response()->json([
            'success' => false,
            'message' => 'Error interno'
        ], 500, [], JSON_UNESCAPED_UNICODE);
    }
} 

/**
 * ✅ NUEVO MÉTODO: Mostrar documentos específicos del período actual
 */
public function documentosPorPeriodo(Maestro $maestro)
{
    Log::info('=== MOSTRANDO DOCUMENTOS POR PERÍODO ===');
    Log::info('Maestro ID: ' . $maestro->id);
    
    try {
        // ✅ 1. OBTENER PERÍODO CON SUBIDA HABILITADA
        $periodoSubida = Periodo::getPeriodoSubidaHabilitada();
        
        if (!$periodoSubida) {
            Log::warning('No hay período habilitado para mostrar documentos');
            return view('maestros.dashboard', [
                'maestro' => $maestro,
                'periodoSubida' => null,
                'documentosPeriodoActual' => collect([]),
                'estadisticas' => [
                    'total' => 0,
                    'aprobados' => 0,
                    'rechazados' => 0,
                    'pendientes' => 0,
                    'porcentaje' => 0
                ],
                'documentosRechazados' => collect([]),
                'documentosAprobados' => collect([]),
                'tiposDocumentos' => [],
                'error' => 'No hay período habilitado para subir documentos.'
            ]);
        }
        
        Log::info("Período habilitado: {$periodoSubida->nombre} (ID: {$periodoSubida->id})");
        
        // ✅ 2. CARGAR DOCUMENTOS SOLO DEL PERÍODO ACTUAL
        $maestro->load(['documentos' => function($query) use ($periodoSubida) {
            $query->where('periodo_id', $periodoSubida->id)
                  ->orderBy('tipo', 'asc')
                  ->with('revisadoPor');
        }]);
        
        Log::info("Documentos del maestro en período {$periodoSubida->nombre}: " . $maestro->documentos->count());
        
        // ✅ 3. CREAR COLECCIONES ESPECÍFICAS DEL PERÍODO
        $documentosPeriodoActual = $maestro->documentos;
        $documentosRechazados = $documentosPeriodoActual->where('estado', 'rechazado');
        $documentosAprobados = $documentosPeriodoActual->where('estado', 'aprobado');
        $documentosPendientes = $documentosPeriodoActual->where('estado', 'pendiente');
        
        // ✅ 4. DEFINIR TIPOS DE DOCUMENTOS POR COORDINACIÓN
        $coordinacionId = $maestro->coordinacion_id ?? 1;
        
        $tiposBase = [
            'cst' => ['nombre' => 'Constancia de Situación Fiscal (CST)', 'icono' => 'file-contract'],
            'iufim' => ['nombre' => 'Documento IUFIM', 'icono' => 'file-invoice'],
            'comprobante_domicilio' => ['nombre' => 'Comprobante de Domicilio', 'icono' => 'home'],
            'oficio_ingresos' => ['nombre' => 'Oficio de Ingresos', 'icono' => 'money-bill-wave'],
            'declaracion_anual' => ['nombre' => 'Declaración Anual', 'icono' => 'file-alt'],
            'comprobante_seguro_social' => ['nombre' => 'Comprobante de Seguro Social', 'icono' => 'shield-alt'],
        ];
        
        $documentosPorCoordinacion = [
            1 => ['cst', 'iufim', 'comprobante_domicilio'],
            2 => ['cst', 'iufim', 'oficio_ingresos', 'declaracion_anual'],
            3 => ['cst', 'iufim', 'comprobante_seguro_social', 'comprobante_domicilio'],
        ];
        
        $tiposPermitidos = $documentosPorCoordinacion[$coordinacionId] ?? [
            'cst', 'iufim', 'comprobante_domicilio', 
            'oficio_ingresos', 'declaracion_anual', 'comprobante_seguro_social'
        ];
        
        $tiposDocumentos = [];
        foreach ($tiposPermitidos as $tipo) {
            if (isset($tiposBase[$tipo])) {
                $tiposDocumentos[$tipo] = $tiposBase[$tipo];
            }
        }
        
        // ✅ 5. CALCULAR ESTADÍSTICAS SOLO DEL PERÍODO ACTUAL
        $totalRequeridos = count($tiposDocumentos);
        $totalSubidos = $documentosPeriodoActual->count();
        $aprobados = $documentosAprobados->count();
        $rechazados = $documentosRechazados->count();
        $pendientes = $documentosPendientes->count();
        $porcentaje = $totalRequeridos > 0 ? round(($totalSubidos / $totalRequeridos) * 100) : 0;
        
        $estadisticas = [
            'total' => $totalSubidos,
            'aprobados' => $aprobados,
            'rechazados' => $rechazados,
            'pendientes' => $pendientes,
            'porcentaje' => $porcentaje,
            'requeridos' => $totalRequeridos
        ];
        
        Log::info("Estadísticas del período: " . json_encode($estadisticas));
        
        // ✅ 6. OBTENER HISTORIAL DE PERÍODOS ANTERIORES (opcional)
        $historialPeriodos = Periodo::where('id', '!=', $periodoSubida->id)
            ->whereHas('documentos', function($query) use ($maestro) {
                $query->where('maestro_id', $maestro->id);
            })
            ->withCount(['documentos' => function($query) use ($maestro) {
                $query->where('maestro_id', $maestro->id);
            }])
            ->orderBy('fecha_inicio', 'desc')
            ->get();
        
        // ✅ 7. RETORNAR VISTA CON DATOS DEL PERÍODO ACTUAL
        return view('maestros.dashboard', compact(
            'maestro',
            'periodoSubida',
            'documentosPeriodoActual',
            'documentosRechazados',
            'documentosAprobados',
            'tiposDocumentos',
            'estadisticas',
            'historialPeriodos'
        ));
        
    } catch (\Exception $e) {
        Log::error('Error en documentosPorPeriodo: ' . $e->getMessage());
        Log::error('Trace: ' . $e->getTraceAsString());
        return back()->with('error', 'Error al cargar documentos del período: ' . $e->getMessage());
    }
}


/**
 * ✅ HISTORIAL COMPLETO DE TODOS LOS PERÍODOS
 */
public function historialDocumentos($coordinacionId, $maestroId)
{
    Log::info('=== HISTORIAL DOCUMENTOS - TODOS LOS PERÍODOS ===');
    
    try {
        $coordinacion = Coordinacion::findOrFail($coordinacionId);
        $maestro = Maestro::where('id', $maestroId)
            ->where('coordinaciones_id', $coordinacionId)
            ->firstOrFail();
        
        // ✅ 1. OBTENER TODOS LOS PERÍODOS CON DOCUMENTOS DE ESTE MAESTRO
        $periodosConDocumentos = Periodo::whereHas('documentos', function($query) use ($maestroId) {
                $query->where('maestro_id', $maestroId);
            })
            ->with(['documentos' => function($query) use ($maestroId) {
                $query->where('maestro_id', $maestroId)
                      ->with('revisadoPor');
            }])
            ->withCount(['documentos' => function($query) use ($maestroId) {
                $query->where('maestro_id', $maestroId);
            }])
            ->orderBy('fecha_inicio', 'desc')
            ->get();
        
        // ✅ 2. PERÍODO ACTUAL (para marcar cuál es el actual)
        $periodoActual = Periodo::getPeriodoSubidaHabilitada();
        
        // ✅ 3. PERÍODO SELECCIONADO (si viene por GET)
        $periodoSeleccionadoId = request()->get('periodo_id');
        $periodoSeleccionado = null;
        $documentosDelPeriodoSeleccionado = collect();
        
        if ($periodoSeleccionadoId) {
            $periodoSeleccionado = Periodo::find($periodoSeleccionadoId);
            if ($periodoSeleccionado) {
                $documentosDelPeriodoSeleccionado = $periodoSeleccionado->documentos()
                    ->where('maestro_id', $maestroId)
                    ->with('revisadoPor')
                    ->get();
            }
        }
        
        // ✅ 4. ESTADÍSTICAS GENERALES
        $maestro->load(['documentos' => function($query) {
            $query->with('periodo');
        }]);
        
        $totalDocumentos = $maestro->documentos->count();
        $totalAprobados = $maestro->documentos->where('estado', 'aprobado')->count();
        $totalRechazados = $maestro->documentos->where('estado', 'rechazado')->count();
        $totalPendientes = $maestro->documentos->where('estado', 'pendiente')->count();
        
        // Tipos de documentos para referencia
        $tiposBase = [
            'cst' => ['nombre' => 'CST', 'icono' => 'file-contract', 'color' => 'primary'],
            'iufim' => ['nombre' => 'IUFIM', 'icono' => 'file-invoice', 'color' => 'info'],
            'comprobante_domicilio' => ['nombre' => 'Comprobante Domicilio', 'icono' => 'home', 'color' => 'success'],
            'oficio_ingresos' => ['nombre' => 'Oficio Ingresos', 'icono' => 'money-bill-wave', 'color' => 'warning'],
            'declaracion_anual' => ['nombre' => 'Declaración Anual', 'icono' => 'file-alt', 'color' => 'secondary'],
            'comprobante_seguro_social' => ['nombre' => 'Seguro Social', 'icono' => 'shield-alt', 'color' => 'danger'],
        ];
        
        return view('maestros.historial_documentos', compact(
            'maestro',
            'coordinacion',
            'coordinacionId', // ¡FALTA ESTA LÍNEA EN TU CÓDIGO ACTUAL!
            'periodosConDocumentos',
            'periodoActual',
            'periodoSeleccionado',
            'documentosDelPeriodoSeleccionado',
            'totalDocumentos',
            'totalAprobados',
            'totalRechazados',
            'totalPendientes',
            'tiposBase'
        ));
        
    } catch (\Exception $e) {
        Log::error('Error en historialDocumentos: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Error al cargar historial');
    }
}

/**
 * ✅ HISTORIAL COMPLETO DESDE VISTA DE MAESTRO (sin coordinacionId específico)
 */
public function historialDocumentosDesdeMaestro($maestroId)
{
    Log::info('=== HISTORIAL DOCUMENTOS DESDE MAESTRO - TODOS LOS PERÍODOS ===');
    
    try {
        $maestro = Maestro::with('coordinacion')->where('id', $maestroId)->firstOrFail();
        
        // Si el maestro tiene coordinación, obtenemos el objeto completo
        $coordinacion = $maestro->coordinacion;
        $coordinacionId = $coordinacion ? $coordinacion->id : null;
        
        // ✅ 1. OBTENER TODOS LOS PERÍODOS CON DOCUMENTOS DE ESTE MAESTRO
        $periodosConDocumentos = Periodo::whereHas('documentos', function($query) use ($maestroId) {
                $query->where('maestro_id', $maestroId);
            })
            ->with(['documentos' => function($query) use ($maestroId) {
                $query->where('maestro_id', $maestroId)
                      ->with('revisadoPor');
            }])
            ->withCount(['documentos' => function($query) use ($maestroId) {
                $query->where('maestro_id', $maestroId);
            }])
            ->orderBy('fecha_inicio', 'desc')
            ->get();
        
        // ✅ 2. PERÍODO ACTUAL (para marcar cuál es el actual)
        $periodoActual = Periodo::getPeriodoSubidaHabilitada();
        
        // ✅ 3. PERÍODO SELECCIONADO (si viene por GET)
        $periodoSeleccionadoId = request()->get('periodo_id');
        $periodoSeleccionado = null;
        $documentosDelPeriodoSeleccionado = collect();
        
        if ($periodoSeleccionadoId) {
            $periodoSeleccionado = Periodo::find($periodoSeleccionadoId);
            if ($periodoSeleccionado) {
                $documentosDelPeriodoSeleccionado = $periodoSeleccionado->documentos()
                    ->where('maestro_id', $maestroId)
                    ->with('revisadoPor')
                    ->get();
            }
        }
        
        // ✅ 4. ESTADÍSTICAS GENERALES
        $maestro->load(['documentos' => function($query) {
            $query->with('periodo');
        }]);
        
        $totalDocumentos = $maestro->documentos->count();
        $totalAprobados = $maestro->documentos->where('estado', 'aprobado')->count();
        $totalRechazados = $maestro->documentos->where('estado', 'rechazado')->count();
        $totalPendientes = $maestro->documentos->where('estado', 'pendiente')->count();
        
        // Tipos de documentos para referencia
        $tiposBase = [
            'cst' => ['nombre' => 'CST', 'icono' => 'file-contract', 'color' => 'primary'],
            'iufim' => ['nombre' => 'IUFIM', 'icono' => 'file-invoice', 'color' => 'info'],
            'comprobante_domicilio' => ['nombre' => 'Comprobante Domicilio', 'icono' => 'home', 'color' => 'success'],
            'oficio_ingresos' => ['nombre' => 'Oficio Ingresos', 'icono' => 'money-bill-wave', 'color' => 'warning'],
            'declaracion_anual' => ['nombre' => 'Declaración Anual', 'icono' => 'file-alt', 'color' => 'secondary'],
            'comprobante_seguro_social' => ['nombre' => 'Seguro Social', 'icono' => 'shield-alt', 'color' => 'danger'],
        ];
        
        return view('maestros.historial_documentos', compact(
            'maestro',
            'coordinacion',
            'coordinacionId',
            'periodosConDocumentos',
            'periodoActual',
            'periodoSeleccionado',
            'documentosDelPeriodoSeleccionado',
            'totalDocumentos',
            'totalAprobados',
            'totalRechazados',
            'totalPendientes',
            'tiposBase'
        ));
        
    } catch (\Exception $e) {
        Log::error('Error en historialDocumentosDesdeMaestro: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Error al cargar historial');
    }
}

    // Método para aprobar documento
    public function aprobar($id)
    {
        try {
            Log::info('Aprobando documento ID: ' . $id);
            
            $documento = DocumentoMaestro::findOrFail($id);
            
            $documento->update([
                'estado' => 'aprobado',
                'revisado_por' => Auth::id(),
                'fecha_revision' => now()
            ]);
            
            Log::info('Documento ID ' . $id . ' aprobado por usuario ' . Auth::id());
            
            return back()->with('success', 'Documento aprobado correctamente');
            
        } catch (\Exception $e) {
            Log::error('Error al aprobar documento: ' . $e->getMessage());
            return back()->with('error', 'Error al aprobar documento');
        }
    }
    
    // Método para rechazar documento
    public function rechazar($id)
    {
        try {
            Log::info('Rechazando documento ID: ' . $id);
            
            $documento = DocumentoMaestro::findOrFail($id);
            
            $documento->update([
                'estado' => 'rechazado',
                'revisado_por' => Auth::id(),
                'fecha_revision' => now()
            ]);
            
            Log::info('Documento ID ' . $id . ' rechazado por usuario ' . Auth::id());
            
            return back()->with('warning', 'Documento rechazado');
            
        } catch (\Exception $e) {
            Log::error('Error al rechazar documento: ' . $e->getMessage());
            return back()->with('error', 'Error al rechazar documento');
        }
    }
    
    // Método para cambiar a pendiente
    public function pendiente($id)
    {
        try {
            Log::info('Cambiando a pendiente documento ID: ' . $id);
            
            $documento = DocumentoMaestro::findOrFail($id);
            
            $documento->update([
                'estado' => 'pendiente',
                'revisado_por' => Auth::id(),
                'fecha_revision' => now()
            ]);
            
            Log::info('Documento ID ' . $id . ' cambiado a pendiente');
            
            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Documento marcado como pendiente'
                ]);
            }
            
            return back()->with('info', 'Documento marcado como pendiente');
            
        } catch (\Exception $e) {
            Log::error('Error al cambiar a pendiente: ' . $e->getMessage());
            
            if (request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error al cambiar estado'
                ], 500);
            }
            
            return back()->with('error', 'Error al cambiar estado');
        }
    }
    
    // Método para descargar documento (MANTENIDO)
    public function descargar($id)
    {
        try {
            Log::info('Descargando documento ID: ' . $id);
            
            $documento = DocumentoMaestro::findOrFail($id);
            
            if (!Storage::disk('public')->exists($documento->ruta_archivo)) {
                Log::error('Archivo no encontrado: ' . $documento->ruta_archivo);
                return back()->with('error', 'El archivo no existe en el servidor');
            }
            
            $nombreArchivo = $documento->nombre_archivo ?? 'documento_' . $documento->id . '.pdf';
            
            Log::info('Descargando: ' . $nombreArchivo);
            
            return Storage::disk('public')->download(
                $documento->ruta_archivo, 
                $nombreArchivo
            );
            
        } catch (\Exception $e) {
            Log::error('Error al descargar documento: ' . $e->getMessage());
            return back()->with('error', 'Error al descargar el documento');
        }
    }
    
    // MÉTODO NUEVO - Para compatibilidad con rutas que usan 'descargarDocumento'
    public function descargarDocumento($id)
    {
        try {
            Log::info('Descargando documento (descargarDocumento) ID: ' . $id);
            
            $documento = DocumentoMaestro::findOrFail($id);
            
            if (!Storage::disk('public')->exists($documento->ruta_archivo)) {
                Log::error('Archivo no encontrado: ' . $documento->ruta_archivo);
                return back()->with('error', 'El archivo no existe en el servidor');
            }
            
            $nombreArchivo = $documento->nombre_archivo ?? 'documento_' . $documento->id . '.pdf';
            
            Log::info('Descargando: ' . $nombreArchivo);
            
            return Storage::disk('public')->download(
                $documento->ruta_archivo, 
                $nombreArchivo
            );
            
        } catch (\Exception $e) {
            Log::error('Error al descargar documento: ' . $e->getMessage());
            return back()->with('error', 'Error al descargar el documento');
        }
    }
    
    // Método para ver documento
    public function verDocumento($id)
    {
        try {
            $documento = DocumentoMaestro::findOrFail($id);
            
            if (!Storage::disk('public')->exists($documento->ruta_archivo)) {
                abort(404, 'El archivo no existe en el almacenamiento.');
            }

            $rutaCompleta = Storage::disk('public')->path($documento->ruta_archivo);
            $tipoMime = Storage::disk('public')->mimeType($documento->ruta_archivo);

            return response()->file($rutaCompleta, [
                'Content-Type' => $tipoMime,
                'Content-Disposition' => 'inline; filename="' . $documento->nombre_archivo . '"'
            ]);
            
        } catch (\Exception $e) {
            Log::error('Error al ver documento: ' . $e->getMessage());
            abort(404, 'Documento no encontrado');
        }
    }
    
    public function mostrarDocumentos(Maestro $maestro)
    {
        Log::info('Mostrando documentos para maestro ID: ' . $maestro->id);
        
        try {
            // Cargar documentos del maestro
            $maestro->load(['documentos' => function($query) {
                $query->orderBy('tipo', 'asc');
            }]);
            
            Log::info("Maestro: {$maestro->nombres}, Documentos: " . $maestro->documentos->count());
            
            // Tipos de documentos base
            $tiposBase = [
                'cst' => ['nombre' => 'Constancia de Situación Fiscal (CST)', 'icono' => 'file-contract'],
                'iufim' => ['nombre' => 'Documento IUFIM', 'icono' => 'file-invoice'],
                'comprobante_domicilio' => ['nombre' => 'Comprobante de Domicilio', 'icono' => 'home'],
                'oficio_ingresos' => ['nombre' => 'Oficio de Ingresos', 'icono' => 'money-bill-wave'],
                'declaracion_anual' => ['nombre' => 'Declaración Anual', 'icono' => 'file-alt'],
                'comprobante_seguro_social' => ['nombre' => 'Comprobante de Seguro Social', 'icono' => 'shield-alt'],
                'curriculum' => ['nombre' => 'Curriculum Vitae', 'icono' => 'file-alt'],
                'cedula_profesional' => ['nombre' => 'Cédula Profesional', 'icono' => 'id-card'],
                'titulo' => ['nombre' => 'Título Profesional', 'icono' => 'graduation-cap']
            ];
            
            $coordinacionId = $maestro->coordinacion_id ?? 1;
            
            // Documentos requeridos por coordinación
            $documentosPorCoordinacion = [
                1 => ['cst', 'iufim', 'comprobante_domicilio'],
                2 => ['cst', 'iufim', 'oficio_ingresos', 'declaracion_anual'],
                3 => ['cst', 'iufim', 'comprobante_seguro_social', 'comprobante_domicilio'],
            ];
            
            // Tipos permitidos para esta coordinación
            $tiposPermitidos = $documentosPorCoordinacion[$coordinacionId] ?? [
                'cst', 'iufim', 'comprobante_domicilio', 
                'oficio_ingresos', 'declaracion_anual', 'comprobante_seguro_social'
            ];
            
            // Filtrar solo los tipos permitidos para mostrar
            $tiposDocumentos = [];
            foreach ($tiposPermitidos as $tipo) {
                if (isset($tiposBase[$tipo])) {
                    $tiposDocumentos[$tipo] = $tiposBase[$tipo];
                }
            }
            
            Log::info("Tipos de documentos para mostrar: " . implode(', ', array_keys($tiposDocumentos)));
            
            // Estadísticas
            $documentosAprobados = $maestro->documentos->where('estado', 'aprobado')->count();
            $documentosRechazados = $maestro->documentos->where('estado', 'rechazado')->count();
            $documentosPendientes = $maestro->documentos->where('estado', 'pendiente')->count();
            $documentosObservados = $maestro->documentos->whereNotNull('observaciones_admin')->count();
            $documentosTotales = $maestro->documentos->count();
            
            return view('maestros.documentos', compact(
                'maestro', 
                'tiposDocumentos',
                'documentosAprobados',
                'documentosRechazados',
                'documentosPendientes',
                'documentosObservados',
                'documentosTotales',
                'coordinacionId'
            ));
            
        } catch (\Exception $e) {
            Log::error('Error en mostrarDocumentos: ' . $e->getMessage());
            Log::error('Trace: ' . $e->getTraceAsString());
            return back()->with('error', 'Error al cargar los documentos del maestro');
        }
    }
    public function subirDocumentos(Request $request)
{
    Log::info('=== INICIANDO SUBIDA DE DOCUMENTOS DESDE DASHBOARD ===');
    Log::info('Usuario ID: ' . auth()->id());
    
    try {
        // ✅ 1. OBTENER MAESTRO DEL USUARIO AUTENTICADO
        $user = Auth::user();
        $maestro = Maestro::where('user_id', $user->id)->first();
        
        if (!$maestro) {
            // Intentar por email si no encuentra por user_id
            $maestro = Maestro::where('email', $user->email)->first();
        }
        
        if (!$maestro) {
            Log::error('No se encontró maestro para el usuario: ' . $user->id);
            return redirect()
                ->back()
                ->with('error', 'No tienes un perfil de maestro asociado.')
                ->withInput();
        }
        
        $maestroId = $maestro->id;
        Log::info('Maestro ID encontrado: ' . $maestroId);
        Log::info('Archivos recibidos: ', array_keys($request->allFiles()));
        
        // ✅ 2. VERIFICAR PERÍODO DE FORMA MÁS FLEXIBLE
        $hoy = Carbon::now();
        Log::info("Fecha actual: " . $hoy->format('Y-m-d H:i:s'));
        
        // Buscar período activo
        $periodoSubida = Periodo::where('estado', 'activo')
            ->whereDate('fecha_inicio', '<=', $hoy)
            ->whereDate('fecha_fin', '>=', $hoy)
            ->first();
        
        // Si no encuentra, buscar cualquier período que incluya hoy
        if (!$periodoSubida) {
            Log::info('No se encontró período activo tradicional, buscando alternativo...');
            $periodoSubida = Periodo::whereDate('fecha_inicio', '<=', $hoy)
                ->whereDate('fecha_fin', '>=', $hoy)
                ->first();
        }
        
        // Si aún no encuentra, buscar el último período
        if (!$periodoSubida) {
            Log::info('Buscando el último período creado...');
            $periodoSubida = Periodo::latest()->first();
        }
        
        if (!$periodoSubida) {
            Log::error('❌ NO SE ENCONTRÓ NINGÚN PERÍODO VÁLIDO');
            return redirect()
                ->back()
                ->with('error', '❌ No hay ningún período habilitado para subir documentos.')
                ->withInput();
        }
        
        Log::info("✅ Período encontrado: {$periodoSubida->nombre} (ID: {$periodoSubida->id})");
        Log::info("   Fecha inicio: {$periodoSubida->fecha_inicio}");
        Log::info("   Fecha fin: {$periodoSubida->fecha_fin}");
        
        // ✅ 3. VERIFICAR QUE EL PERÍODO NO ESTÉ FINALIZADO
        $fechaFin = Carbon::parse($periodoSubida->fecha_fin);
        if ($hoy->gt($fechaFin)) {
            Log::error('El período ya finalizó: ' . $periodoSubida->nombre);
            return redirect()
                ->back()
                ->with('error', '❌ El período ' . $periodoSubida->nombre . 
                       ' ya finalizó el ' . $fechaFin->format('d/m/Y') . 
                       '. No se pueden subir documentos.')
                ->withInput();
        }
        
        // ✅ 4. CONFIGURAR TIPOS DE DOCUMENTOS
        $coordinacionId = $maestro->coordinacion_id ?? 1;
        
        $documentosPorCoordinacion = [
            1 => ['cst', 'iufim', 'comprobante_domicilio'],
            2 => ['cst', 'iufim', 'oficio_ingresos', 'declaracion_anual'],
            3 => ['cst', 'iufim', 'comprobante_seguro_social', 'comprobante_domicilio'],
        ];
        
        $tiposPermitidos = $documentosPorCoordinacion[$coordinacionId] ?? [
            'cst', 'iufim', 'comprobante_domicilio', 
            'oficio_ingresos', 'declaracion_anual', 'comprobante_seguro_social'
        ];
        
        Log::info("Tipos permitidos para subir: " . implode(', ', $tiposPermitidos));
        
        // ✅ 5. VALIDACIÓN
        $reglas = [];
        $mensajes = [];
        
        foreach ($tiposPermitidos as $tipo) {
            $reglas[$tipo] = 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240'; // 10MB máximo
            $mensajes[$tipo . '.max'] = 'El archivo :attribute no debe ser mayor a 10MB';
            $mensajes[$tipo . '.mimes'] = 'El archivo :attribute debe ser PDF, Word o imagen';
        }
        
        $validator = Validator::make($request->all(), $reglas, $mensajes);

        if ($validator->fails()) {
            Log::error('Validación fallida: ', $validator->errors()->toArray());
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Error en la validación de archivos');
        }

        $documentosSubidos = 0;
        $documentosActualizados = 0;
        $errores = [];

        // ✅ 6. INICIAR TRANSACCIÓN PARA GARANTIZAR INTEGRIDAD
        DB::beginTransaction();

        try {
            foreach ($tiposPermitidos as $tipo) {
                if ($request->hasFile($tipo)) {
                    $archivo = $request->file($tipo);
                    
                    Log::info("Procesando archivo tipo: {$tipo}");
                    Log::info("Nombre original: {$archivo->getClientOriginalName()}");
                    Log::info("Tamaño: {$archivo->getSize()} bytes");
                    
                    try {
                        // ✅ 7. VERIFICAR SI YA EXISTE ESTE TIPO EN ESTE PERÍODO
                        $documentoExistente = DocumentoMaestro::where('maestro_id', $maestroId)
                            ->where('tipo', $tipo)
                            ->where('periodo_id', $periodoSubida->id)
                            ->first();
                        
                        // Verificar si el directorio existe, si no crearlo
                        $directorio = "documentos_maestros/{$maestroId}";
                        if (!Storage::disk('public')->exists($directorio)) {
                            Storage::disk('public')->makeDirectory($directorio);
                            Log::info("Directorio creado: {$directorio}");
                        }
                        
                        // Generar nombre único
                        $extension = $archivo->getClientOriginalExtension();
                        $nombreArchivo = $tipo . '_' . time() . '_' . uniqid() . '.' . $extension;
                        $ruta = "{$directorio}/{$nombreArchivo}";
                        
                        Log::info("Guardando en: {$ruta}");
                        
                        // Subir archivo
                        $path = $archivo->storeAs("public/{$directorio}", $nombreArchivo);
                        $rutaArchivo = str_replace('public/', '', $path);
                        
                        Log::info("Archivo almacenado en: {$path}");
                        
                        if ($documentoExistente) {
                            Log::info("✅ Documento existente encontrado, ID: {$documentoExistente->id}");
                            
                            // Eliminar archivo físico anterior si existe
                            if ($documentoExistente->ruta_archivo && Storage::disk('public')->exists($documentoExistente->ruta_archivo)) {
                                Storage::disk('public')->delete($documentoExistente->ruta_archivo);
                                Log::info("Archivo físico anterior eliminado: {$documentoExistente->ruta_archivo}");
                            }
                            
                            // Actualizar documento existente
                            $documentoExistente->update([
                                'nombre_archivo' => $archivo->getClientOriginalName(),
                                'ruta_archivo' => $rutaArchivo,
                                'mime_type' => $archivo->getMimeType(),
                                'tamanio' => $archivo->getSize(),
                                'estado' => 'pendiente', // Resetear estado a pendiente
                                'fecha_revision' => null,
                                'revisado_por' => null,
                                'observaciones_admin' => null, // Limpiar observaciones anteriores
                                'updated_at' => now(),
                            ]);
                            
                            $documentosActualizados++;
                            Log::info("✅ Documento tipo {$tipo} ACTUALIZADO exitosamente");
                            
                        } else {
                            Log::info("✅ Creando NUEVO documento para tipo: {$tipo}");
                            
                            // Crear nuevo documento
                            DocumentoMaestro::create([
                                'maestro_id' => $maestroId,
                                'periodo_id' => $periodoSubida->id,
                                'tipo' => $tipo,
                                'nombre_archivo' => $archivo->getClientOriginalName(),
                                'ruta_archivo' => $rutaArchivo,
                                'mime_type' => $archivo->getMimeType(),
                                'tamanio' => $archivo->getSize(),
                                'estado' => 'pendiente',
                                'fecha_revision' => null,
                                'revisado_por' => null,
                                'observaciones_admin' => null,
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);

                            $documentosSubidos++;
                            Log::info("✅ Documento tipo {$tipo} CREADO exitosamente");
                        }
                        
                    } catch (\Exception $e) {
                        // Rollback de la transacción en caso de error
                        DB::rollBack();
                        Log::error("❌ Error al procesar archivo tipo {$tipo}: " . $e->getMessage());
                        Log::error('Trace: ' . $e->getTraceAsString());
                        $errores[] = "Error al subir {$tipo}: " . $e->getMessage();
                        throw $e;
                    }
                }
            }

            // ✅ 8. CONFIRMAR TRANSACCIÓN
            DB::commit();
            Log::info('✅ Transacción confirmada exitosamente');
            
        } catch (\Exception $e) {
            // Rollback en caso de error
            DB::rollBack();
            Log::error('❌ Error en transacción: ' . $e->getMessage());
            if (empty($errores)) {
                $errores[] = $e->getMessage();
            }
        }

        if (count($errores) > 0) {
            Log::error('❌ Errores durante la subida: ', $errores);
            return redirect()
                ->back()
                ->with('error', 'Hubo errores al subir algunos archivos: ' . implode(', ', $errores));
        }

        // ✅ 9. MENSAJE PERSONALIZADO
        $mensaje = '';
        if ($documentosSubidos > 0 && $documentosActualizados > 0) {
            $mensaje = "✅ Se subieron {$documentosSubidos} documento(s) nuevo(s) y se actualizaron {$documentosActualizados} documento(s).";
        } elseif ($documentosSubidos > 0) {
            $mensaje = "✅ Se subieron {$documentosSubidos} documento(s) correctamente.";
        } elseif ($documentosActualizados > 0) {
            $mensaje = "✅ Se actualizaron {$documentosActualizados} documento(s) correctamente.";
        } else {
            $mensaje = "ℹ️ No se seleccionaron documentos para subir.";
        }
        
        Log::info($mensaje);

        // ✅ 10. REDIRIGIR A LA MISMA PÁGINA (back)
        return redirect()
            ->back()
            ->with('success', $mensaje);
            
    } catch (\Exception $e) {
        Log::error('❌ ERROR CRÍTICO en subirDocumentos: ' . $e->getMessage());
        Log::error('❌ Trace: ' . $e->getTraceAsString());
        return redirect()
            ->back()
            ->with('error', 'Error crítico al subir documentos: ' . $e->getMessage());
    }
}
    // Método para eliminar documento
    public function eliminarDocumento($documentoId)
    {
        try {
            Log::info('Eliminando documento ID: ' . $documentoId);
            
            $documento = DocumentoMaestro::findOrFail($documentoId);
            $maestroId = $documento->maestro_id;
            
            Log::info("Eliminando documento tipo: {$documento->tipo} del maestro ID: {$maestroId}");
            
            if (Storage::disk('public')->exists($documento->ruta_archivo)) {
                Storage::disk('public')->delete($documento->ruta_archivo);
                Log::info("Archivo físico eliminado: {$documento->ruta_archivo}");
            }
            
            $documento->delete();
            
            Log::info("Documento eliminado de la base de datos");

            return redirect()
                ->route('maestros.documentos', $maestroId)
                ->with('success', 'Documento eliminado correctamente.');
                
        } catch (\Exception $e) {
            Log::error('Error en eliminarDocumento: ' . $e->getMessage());
            return back()->with('error', 'Error al eliminar el documento');
        }
    }
    
    public function resubirDocumento(Request $request, $id)
    {
        try {
            $documento = DocumentoMaestro::findOrFail($id);
            
            $request->validate([
                'archivo' => 'required|file|mimes:pdf|max:5120'
            ]);
            
            // Eliminar archivo anterior si existe
            if ($documento->ruta_archivo && Storage::exists($documento->ruta_archivo)) {
                Storage::delete($documento->ruta_archivo);
            }
            
            // Guardar nuevo archivo
            $archivo = $request->file('archivo');
            $nombreArchivo = $documento->tipo . '_' . time() . '.' . $archivo->getClientOriginalExtension();
            $rutaArchivo = $archivo->storeAs('documentos', $nombreArchivo);
            
            // Actualizar documento
            $documento->nombre_archivo = $nombreArchivo;
            $documento->ruta_archivo = $rutaArchivo;
            $documento->tamanio = $archivo->getSize();
            $documento->estado = 'pendiente'; // Cambiar a pendiente para nueva revisión
            $documento->observaciones_admin = null; // Limpiar observaciones anteriores
            $documento->revisado_por = null;
            $documento->fecha_revision = null;
            $documento->save();
            
            return redirect()->back()->with('success', 'Documento re-subido exitosamente. Espera la nueva revisión del administrador.');
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al re-subir el documento: ' . $e->getMessage());
        }
    }
   /**
 * ✅ NUEVO MÉTODO: Vista para mostrar maestros con su estado de documentos POR COORDINACIÓN
 * MUESTRA MAESTROS AUN CUANDO NO HAY PERÍODO ACTIVO
 */
/**
 * ✅ MÉTODO MODIFICADO: Vista para mostrar maestros con su estado de documentos POR COORDINACIÓN
 * Con lógica condicional para cuando hay o no período
 */
public function estadoDocumentosPorCoordinacion($id)
{
    Log::info('=== VISTA ESTADO DOCUMENTOS MAESTROS POR COORDINACIÓN ===');
    
    // ✅ DEBUG EXTENDIDO
    Log::info('Coordinación ID recibido: ' . $id);
    Log::info('Tipo de ID: ' . gettype($id));
    Log::info('URL completa: ' . request()->fullUrl());
    Log::info('Segmentos URL: ' . json_encode(request()->segments()));
    
    try {
        // ✅ VERIFICACIÓN ROBUSTA DEL ID
        if (empty($id) || $id == 'undefined' || $id == 'null') {
            Log::error('ID inválido o vacío recibido');
            
            // Intentar obtener de la URL
            $segmentos = request()->segments();
            foreach ($segmentos as $index => $segmento) {
                if (is_numeric($segmento)) {
                    $id = $segmento;
                    Log::info('ID encontrado en segmento ' . $index . ': ' . $id);
                    break;
                }
            }
        }
        
        // Convertir a entero si es numérico
        if (is_numeric($id)) {
            $id = (int) $id;
            Log::info('ID convertido a entero: ' . $id);
        }
        
        if (!$id || !is_numeric($id)) {
            Log::error('ID final inválido: ' . $id);
            return redirect()->route('coordinaciones.index')
                ->with('error', 'ID de coordinación inválido: ' . $id);
        }
        
        // ✅ 1. OBTENER LA COORDINACIÓN CON MÚLTIPLES INTENTOS
        Log::info('Buscando coordinación con ID: ' . $id);
        $coordinacion = Coordinacion::find($id);
        
        if (!$coordinacion) {
            Log::info('No encontrada por find(), buscando por coordinaciones_id...');
            $coordinacion = Coordinacion::where('coordinaciones_id', $id)->first();
        }
        
        if (!$coordinacion) {
            Log::error('❌ NO SE ENCONTRÓ COORDINACIÓN CON ID: ' . $id);
            
            // Listar todas las coordinaciones para debug
            $todasCoordinaciones = Coordinacion::all();
            Log::info('Coordinaciones disponibles: ' . $todasCoordinaciones->pluck('id', 'nombre'));
            
            return redirect()->route('coordinaciones.index')
                ->with('error', 'No se encontró la coordinación con ID: ' . $id . 
                       '. Coordinaciones disponibles: ' . $todasCoordinaciones->count());
        }
        
        Log::info("✅ Coordinación encontrada: {$coordinacion->nombre} (ID: {$coordinacion->id})");
        
        // ✅ 2. OBTENER PERÍODO CON SUBIDA HABILITADA (si existe)
        $periodoSubida = Periodo::getPeriodoSubidaHabilitada();
        
        // ✅ 3. OBTENER TODOS LOS PERÍODOS DISPONIBLES PARA EL FILTRO
        $periodosDisponibles = Periodo::orderBy('fecha_inicio', 'desc')->get();
        
        // ✅ 4. PERÍODO SELECCIONADO (por GET, si no hay período activo)
        $periodoSeleccionadoId = request()->get('periodo_id');
        $periodoSeleccionado = null;
        
        if ($periodoSeleccionadoId) {
            $periodoSeleccionado = Periodo::find($periodoSeleccionadoId);
        }
        
        // ✅ 5. DETERMINAR QUÉ PERÍODO USAR (activo > seleccionado > ninguno)
        $periodoActual = $periodoSubida ?: $periodoSeleccionado;
        $hayPeriodoActivo = $periodoActual != null;
        
        Log::info("Período activo: " . ($periodoActual ? $periodoActual->nombre : 'Ninguno') . " para coordinación: {$coordinacion->nombre}");
        
        // ✅ 6. OBTENER MAESTROS DE ESTA COORDINACIÓN

             // CORREGIDO: Usar solo coordinaciones_id
    $maestros = Maestro::where('coordinaciones_id', $coordinacion->id)
        ->with(['documentos' => function($query) use ($periodoActual) {
            if ($periodoActual) {
                $query->where('periodo_id', $periodoActual->id);
            }
            $query->orderBy('tipo', 'asc');
        }])
        ->orderBy('nombres', 'asc')
        ->get();
        
        Log::info("Total de maestros encontrados para coordinación {$coordinacion->nombre}: " . $maestros->count());
        
        // ✅ 7. DEFINIR TIPOS DE DOCUMENTOS POR COORDINACIÓN
        $tiposBase = [
            'cst' => ['nombre' => 'CST'],
            'iufim' => ['nombre' => 'IUFIM'],
            'comprobante_domicilio' => ['nombre' => 'Comprobante Domicilio'],
            'oficio_ingresos' => ['nombre' => 'Oficio Ingresos'],
            'declaracion_anual' => ['nombre' => 'Declaración Anual'],
            'comprobante_seguro_social' => ['nombre' => 'Seguro Social'],
        ];
        
        $documentosPorCoordinacion = [
            1 => ['cst', 'iufim', 'comprobante_domicilio'],
            2 => ['cst', 'iufim', 'oficio_ingresos', 'declaracion_anual'],
            3 => ['cst', 'iufim', 'comprobante_seguro_social', 'comprobante_domicilio'],
        ];
        
        // ✅ 8. CALCULAR ESTADÍSTICAS PARA CADA MAESTRO
        $maestrosConEstadisticas = $maestros->map(function($maestro, $index) use ($coordinacion, $documentosPorCoordinacion, $tiposBase, $periodoActual, $hayPeriodoActivo) {
            // Calcular documentos requeridos según su coordinación
            $coordinacionId = $coordinacion->id;
            $tiposRequeridos = $documentosPorCoordinacion[$coordinacionId] ?? [
                'cst', 'iufim', 'comprobante_domicilio', 
                'oficio_ingresos', 'declaracion_anual', 'comprobante_seguro_social'
            ];
            
            // Obtener documentos del maestro (del período actual si existe, o todos si no)
            $documentosMaestro = $periodoActual 
                ? $maestro->documentos->where('periodo_id', $periodoActual->id)
                : $maestro->documentos;
            
            // Si NO hay período activo, siempre mostrar como "Sin documentos del período"
            if (!$hayPeriodoActivo) {
                return [
                    'numero' => $index + 1,
                    'id' => $maestro->id,
                    'nombres' => $maestro->nombres . ' ' . $maestro->apellidos,
                    'coordinacion' => $maestro->coordinacion ? $maestro->coordinacion->nombre : 'Sin coordinación',
                    'coordinacion_id' => $coordinacionId,
                    'total_subidos' => 0,
                    'total_requeridos' => count($tiposRequeridos),
                    'aprobados' => 0,
                    'pendientes' => 0,
                    'rechazados' => 0,
                    'porcentaje' => 0,
                    'color_estado' => 'secondary',
                    'texto_estado' => 'SIN PERÍODO',
                    'texto_badge' => '0/' . count($tiposRequeridos),
                    'documentos' => collect(),
                    'tipos_requeridos' => $tiposRequeridos,
                    'tiene_documentos' => false,
                    'hay_periodo' => false
                ];
            }
            
            // Si HAY período activo, calcular estadísticas normales
            $totalRequeridos = count($tiposRequeridos);
            $totalSubidos = $documentosMaestro->count();
            $aprobados = $documentosMaestro->where('estado', 'aprobado')->count();
            $pendientes = $documentosMaestro->where('estado', 'pendiente')->count();
            $rechazados = $documentosMaestro->where('estado', 'rechazado')->count();
            
            // Calcular porcentaje de completado
            $porcentaje = $totalRequeridos > 0 ? round(($totalSubidos / $totalRequeridos) * 100) : 0;
            
            // Determinar color del estado general
            $colorEstado = 'danger'; // ROJO por defecto (no ha subido)
            $textoEstado = 'NO HA SUBIDO';
            
            if ($totalSubidos > 0) {
                if ($totalSubidos >= $totalRequeridos && $rechazados == 0) {
                    $colorEstado = 'success'; // VERDE (completado y sin rechazos)
                    $textoEstado = 'COMPLETADO';
                } elseif ($totalSubidos >= $totalRequeridos && $rechazados > 0) {
                    $colorEstado = 'warning'; // AMARILLO (completado pero con rechazos)
                    $textoEstado = 'CON RECHAZOS';
                } else {
                    $colorEstado = 'warning'; // AMARILLO (subió algunos)
                    $textoEstado = 'EN PROCESO';
                }
            }
            
            // Texto para el badge amarillo (2/6)
            $textoBadge = "{$totalSubidos}/{$totalRequeridos}";
            
            return [
                'numero' => $index + 1,
                'id' => $maestro->id,
                'nombres' => $maestro->nombres . ' ' . $maestro->apellidos,
                'coordinacion' => $maestro->coordinacion ? $maestro->coordinacion->nombre : 'Sin coordinación',
                'coordinacion_id' => $coordinacionId,
                'total_subidos' => $totalSubidos,
                'total_requeridos' => $totalRequeridos,
                'aprobados' => $aprobados,
                'pendientes' => $pendientes,
                'rechazados' => $rechazados,
                'porcentaje' => $porcentaje,
                'color_estado' => $colorEstado,
                'texto_estado' => $textoEstado,
                'texto_badge' => $textoBadge,
                'documentos' => $documentosMaestro,
                'tipos_requeridos' => $tiposRequeridos,
                'tiene_documentos' => $totalSubidos > 0,
                'hay_periodo' => true
            ];
        });
        
        // ✅ 9. ESTADÍSTICAS GENERALES
        $totalMaestros = $maestrosConEstadisticas->count();
        
        if ($hayPeriodoActivo) {
            $maestrosCompletados = $maestrosConEstadisticas->where('total_subidos', '>=', function($maestro) {
                return $maestro['total_requeridos'];
            })->where('rechazados', 0)->count();
            
            $maestrosSinSubir = $maestrosConEstadisticas->where('total_subidos', 0)->count();
            $maestrosEnProceso = $totalMaestros - $maestrosCompletados - $maestrosSinSubir;
        } else {
            $maestrosCompletados = 0;
            $maestrosSinSubir = $totalMaestros;
            $maestrosEnProceso = 0;
        }
        
        $estadisticasGenerales = [
            'total_maestros' => $totalMaestros,
            'completados' => $maestrosCompletados,
            'en_proceso' => $maestrosEnProceso,
            'sin_subir' => $maestrosSinSubir,
            'porcentaje_completado' => $totalMaestros > 0 ? round(($maestrosCompletados / $totalMaestros) * 100) : 0,
            'hay_periodo' => $hayPeriodoActivo
        ];
        
        Log::info("Estadísticas generales para coordinación {$coordinacion->nombre}: " . json_encode($estadisticasGenerales));
        
        return view('maestros.estado_documentos', compact(
            'coordinacion',
            'maestrosConEstadisticas',
            'periodoActual',
            'periodosDisponibles',
            'estadisticasGenerales'
        ));
        
    } catch (\Exception $e) {
        Log::error('❌ ERROR en estadoDocumentosPorCoordinacion: ' . $e->getMessage());
        Log::error('❌ Trace: ' . $e->getTraceAsString());
        
        // ✅ CORREGIDO: Redirigir al index, no a show
        return redirect()->route('coordinaciones.index')
            ->with('error', 'Error al cargar el estado de documentos: ' . $e->getMessage());
    }
}
}
