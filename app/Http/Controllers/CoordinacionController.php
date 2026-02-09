<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Coordinacion;
use App\Models\Maestro;
use App\Models\Periodo; // ✅ AGREGAR ESTE
use App\Models\DocumentoMaestro; // ✅ AGREGAR ESTE
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // ✅ AGREGAR ESTO
use Illuminate\Support\Facades\Auth; // ✅ AGREGAR ESTO
use Illuminate\Support\Facades\Schema; // ✅ AGREGAR ESTO




class CoordinacionController extends Controller{

    public function index()
    {
        // SOLUCIÓN ALTERNATIVA: Usar carga manual del count
        $coordinaciones = Coordinacion::all();
        
        // Cargar el conteo manualmente para evitar el error SQL
        foreach ($coordinaciones as $coordinacion) {
            $coordinacion->maestros_count = Maestro::where('coordinaciones_id', $coordinacion->id)->count();
        }
        
        return view('coordinaciones.index', compact('coordinaciones'));
    }
    
    public function create()
    {
        return view('coordinaciones.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100|unique:coordinaciones,nombre',
        ]);
        
        Coordinacion::create($request->all());
        
        return redirect()->route('coordinaciones.index')
                         ->with('success', 'Coordinación creada exitosamente.');
    }
    
    public function show($id)
    {
        try {
            $coordinacion = Coordinacion::findOrFail($id);
            
            // Obtener maestros con sus documentos - usar coordinaciones_id
            $maestros = $coordinacion->maestros()
                ->with(['documentos' => function($query) {
                    $query->select('id', 'maestro_id', 'tipo', 'created_at');
                }])
                ->orderBy('apellido_paterno', 'asc')
                ->orderBy('apellido_materno', 'asc') 
                ->orderBy('nombres', 'asc')
                ->get();
            
            // Calcular progreso de documentos para cada maestro
            $maestros->each(function($maestro) {
                $maestro->progresoDocumentos = $this->calcularProgresoDocumentos($maestro);
            });
            
            // ✅ AGREGAR ESTA LÍNEA CRÍTICA
            $coordinacion_id = $coordinacion->id;
            
            return view('coordinaciones.show', compact('coordinacion', 'maestros', 'coordinacion_id')); // ✅ AGREGAR coordinacion_id
            
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('coordinaciones.index')
                             ->with('error', 'Coordinación no encontrada.');
        }
    }
    
    // FUNCIÓN DE ESTADÍSTICAS COMPLETA Y CORREGIDA
    public function estadisticas($id)
    {
        try {
            $coordinacion = Coordinacion::findOrFail($id);
            
            // ✅ AGREGAR ESTA LÍNEA
            $coordinacion_id = $coordinacion->id;
            
            // Obtener todos los maestros de esta coordinación con sus documentos
            $maestros = $coordinacion->maestros()->with('documentos')->get();
            
            // Calcular estadísticas básicas
            $totalMaestros = $maestros->count();
            $hombres = $maestros->where('sexo', 'Masculino')->count();
            $mujeres = $maestros->where('sexo', 'Femenino')->count();
            $otros = $maestros->where('sexo', 'Otro')->count();
            $sinSexo = $maestros->whereNull('sexo')->count();
            
            // Calcular distribución de edades
            $edades18_30 = $maestros->where('edad', '>=', 18)->where('edad', '<=', 30)->count();
            $edades31_40 = $maestros->where('edad', '>=', 31)->where('edad', '<=', 40)->count();
            $edades41_50 = $maestros->where('edad', '>=', 41)->where('edad', '<=', 50)->count();
            $edades51_60 = $maestros->where('edad', '>=', 51)->where('edad', '<=', 60)->count();
            $edades61_plus = $maestros->where('edad', '>=', 61)->count();

            // CORRECCIÓN: Usar maximo_grado_academico en lugar de nivel_academico
            $licenciatura = $maestros->where('maximo_grado_academico', 'Licenciatura')->count();
            $maestria = $maestros->where('maximo_grado_academico', 'Maestría')->count();
            $doctorado = $maestros->where('maximo_grado_academico', 'Doctorado')->count();
            
            // También contar especialidad si existe
            $especialidad = $maestros->where('maximo_grado_academico', 'Especialidad')->count();
            
            // Calcular estadísticas de estado de actividad
            $maestrosActivos = $maestros->where('estado', 'Activo')->count();
            $maestrosInactivos = $maestros->where('estado', 'Inactivo')->count();
            
            // Si no existe el campo 'estado', calcular basado en otra lógica
            if ($maestrosActivos === 0 && $maestrosInactivos === 0) {
                // Verificar si existe el campo 'activo'
                if ($maestros->first() && isset($maestros->first()->activo)) {
                    $maestrosActivos = $maestros->where('activo', 1)->count();
                    $maestrosInactivos = $maestros->where('activo', 0)->count();
                } else {
                    // Asumir que todos los maestros están activos si no hay campo estado
                    $maestrosActivos = $totalMaestros;
                    $maestrosInactivos = 0;
                }
            }
            
            // Calcular estadísticas de documentos
            $documentosCompletos = 0;
            $documentosPendientes = 0;
            $documentosFaltantes = 0;
            
            // Tipos de documentos requeridos
            $tiposDocumentos = [
                'cst' => 'CST',
                'iufim' => 'IUFIM', 
                'comprobante_domicilio' => 'Comprobante Domicilio',
                'oficio_ingresos' => 'Oficio Ingresos',
                'declaracion_anual' => 'Declaración Anual',
                'comprobante_seguro_social' => 'Seguro Social'
            ];
            
            // Inicializar array para documentos por tipo
            $documentosPorTipo = [];
            foreach ($tiposDocumentos as $tipo => $nombre) {
                $documentosPorTipo[$tipo] = [
                    'nombre' => $nombre,
                    'completados' => 0,
                    'porcentaje' => 0
                ];
            }
            
            // Contar documentos por maestro
            foreach ($maestros as $maestro) {
                $documentosSubidos = $maestro->documentos->count();
                $totalDocumentosRequeridos = count($tiposDocumentos);
                
                // Contar documentos por tipo
                foreach ($tiposDocumentos as $tipo => $nombre) {
                    $tieneDocumento = $maestro->documentos->where('tipo', $tipo)->count() > 0;
                    if ($tieneDocumento) {
                        $documentosPorTipo[$tipo]['completados']++;
                    }
                }
                
                // Clasificar estado de documentos del maestro
                if ($documentosSubidos == 0) {
                    $documentosFaltantes++;
                } elseif ($documentosSubidos == $totalDocumentosRequeridos) {
                    $documentosCompletos++;
                } else {
                    $documentosPendientes++;
                }
            }
            
            // Calcular porcentajes para cada tipo de documento
            foreach ($documentosPorTipo as $tipo => $datos) {
                if ($totalMaestros > 0) {
                    $documentosPorTipo[$tipo]['porcentaje'] = ($datos['completados'] / $totalMaestros) * 100;
                }
            }
            
            // Determinar si la coordinación está activa
            $estaActiva = $totalMaestros > 0;
            
            return view('coordinaciones.estadisticas', compact(
                'coordinacion', 
                'coordinacion_id', // ✅ AGREGAR ESTA VARIABLE
                'totalMaestros',
                'hombres',
                'mujeres', 
                'otros',
                'sinSexo',
                'estaActiva',
                'licenciatura',
                'maestria',
                'doctorado',
                'especialidad',
                'maestrosActivos',
                'maestrosInactivos',
                'documentosCompletos',
                'documentosPendientes',
                'documentosFaltantes',
                'documentosPorTipo',
                'edades18_30',
                'edades31_40', 
                'edades41_50',
                'edades51_60',
                'edades61_plus'
            ));
            
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('coordinaciones.index')
                            ->with('error', 'Coordinación no encontrada.');
        }
    }

    public function edit($id)
    {
        try {
            $coordinacion = Coordinacion::findOrFail($id);
            return view('coordinaciones.edit', compact('coordinacion'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('coordinaciones.index')
                            ->with('error', 'Coordinación no encontrada.');
        }
    }
    
    public function update(Request $request, $id)
    {
        try {
            $coordinacion = Coordinacion::findOrFail($id);
            
            $request->validate([
                'nombre' => 'required|string|max:100|unique:coordinaciones,nombre,' . $coordinacion->id,
            ]);
            
            $coordinacion->update($request->all());
            
            return redirect()->route('coordinaciones.index')
                            ->with('success', 'Coordinación actualizada exitosamente.');
            
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('coordinaciones.index')
                            ->with('error', 'Coordinación no encontrada.');
        }
    }
    
    public function destroy($id)
    {
        try {
            $coordinacion = Coordinacion::findOrFail($id);
            
            // Verificar si hay maestros asociados antes de eliminar
            if ($coordinacion->maestros()->count() > 0) {
                return redirect()->route('coordinaciones.index')
                                ->with('error', 'No se puede eliminar la coordinación porque tiene maestros asociados.');
            }
            
            $coordinacion->delete();
            
            return redirect()->route('coordinaciones.index')
                            ->with('success', 'Coordinación eliminada exitosamente.');
            
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('coordinaciones.index')
                            ->with('error', 'Coordinación no encontrada.');
        }
    }

    public function updateMaestroStatus(Request $request, $coordinacionId, $maestroId)
    {
        try {
            // Verificar que la coordinación existe
            $coordinacion = Coordinacion::findOrFail($coordinacionId);
            
            // Verificar que el maestro existe y pertenece a la coordinación
            // CORRECCIÓN: Usar coordinaciones_id en lugar de coordinacion_id
            $maestro = Maestro::where('id', $maestroId)
                            ->where('coordinaciones_id', $coordinacionId) // <- CAMBIO AQUÍ
                            ->firstOrFail();
            
            $request->validate([
                'activo' => 'required|boolean'
            ]);
            
            $maestro->update([
                'activo' => $request->activo
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Estado del maestro actualizado correctamente',
                'maestro' => [
                    'id' => $maestro->id,
                    'activo' => $maestro->activo,
                    'nombre_completo' => $maestro->nombres . ' ' . $maestro->apellido_paterno
                ]
            ]);
            
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Maestro no encontrado en esta coordinación'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el estado: ' . $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Calcular progreso de documentos para un maestro
     */
    private function calcularProgresoDocumentos($maestro)
    {
        $tiposDocumentos = [
            'cst', 'iufim', 'comprobante_domicilio', 
            'oficio_ingresos', 'declaracion_anual', 'comprobante_seguro_social'
        ];
        
        $totalDocumentos = count($tiposDocumentos);
        $documentosSubidos = 0;
        
        foreach ($tiposDocumentos as $tipo) {
            if ($maestro->documentos->where('tipo', $tipo)->count() > 0) {
                $documentosSubidos++;
            }
        }
        
        $porcentaje = $totalDocumentos > 0 ? ($documentosSubidos / $totalDocumentos) * 100 : 0;
        $faltantes = $totalDocumentos - $documentosSubidos;
        
        return [
            'total' => $totalDocumentos,
            'subidos' => $documentosSubidos,
            'faltantes' => $faltantes,
            'porcentaje' => round($porcentaje, 2)
        ];
    }
    // ... (todos tus métodos anteriores) ...



    //////////////FUCTION ROL DE COORDINACION 
    public function dashboard(Request $request)
    {
        try {
            \Log::info('=== DASHBOARD DE COORDINACIÓN CON DOCUMENTOS - INICIO ===');
            
            // ✅ 1. OBTENER USUARIO AUTENTICADO
            $user = Auth::user();
            
            if (!$user) {
                \Log::error('❌ No hay usuario autenticado');
                return redirect()->route('login')->with('error', 'Debes iniciar sesión');
            }
            
            \Log::info("Usuario: {$user->name} (ID: {$user->id})");
            \Log::info("coordinaciones_id del usuario: " . ($user->coordinaciones_id ?? 'NULL'));
            
            $coordinacion = null;
            
            // ========== OBTENER COORDINACIÓN ==========
            if (!empty($user->coordinaciones_id)) {
                $coordinacion = Coordinacion::find($user->coordinaciones_id);
            }
            
            if (!$coordinacion) {
                $coordinacion = Coordinacion::where(function($query) use ($user) {
                    if (Schema::hasColumn('coordinaciones', 'responsable_id')) {
                        $query->orWhere('responsable_id', $user->id);
                    }
                    if (Schema::hasColumn('coordinaciones', 'responsable_email')) {
                        $query->orWhere('responsable_email', $user->email);
                    }
                    if (Schema::hasColumn('coordinaciones', 'responsable')) {
                        $query->orWhere('responsable', $user->name)
                              ->orWhere('responsable', 'LIKE', '%' . $user->name . '%');
                    }
                })->first();
            }
            
            if (!$coordinacion) {
                $coordinacion = Coordinacion::first();
            }
            
            if (!$coordinacion) {
                \Log::error("❌ NO HAY COORDINACIONES EN EL SISTEMA");
                return view('coordinacion.dashboard', [
                    'error' => 'No hay coordinaciones en el sistema.',
                    'coordinacion' => null,
                    'maestros' => collect(),
                    'totalMaestros' => 0,
                    'maestrosActivos' => 0,
                    'documentosCompletos' => 0,
                    'periodoHabilitado' => null,
                    'estadisticasDocumentos' => [],
                    'estadoDocumentos' => []
                ]);
            }
            
            \Log::info("🎯 Coordinación final: {$coordinacion->nombre} (ID: {$coordinacion->id})");
            
            // ✅ 2. OBTENER PERÍODO HABILITADO (IMPORTANTE)
             // ✅ 2. OBTENER PERÍODO HABILITADO (IMPORTANTE)
        $periodoHabilitado = $this->obtenerPeriodoHabilitado();
        
        // ✅ AGREGAR: Manejar alertas específicas
        $alertaPeriodo = null;
        $tipoAlerta = 'info';
        
        if (!$periodoHabilitado) {
            $alertaPeriodo = 'No hay períodos configurados en el sistema.';
            $tipoAlerta = 'warning';
            \Log::warning($alertaPeriodo);
        } elseif ($periodoHabilitado->activo == 0) {
            if (isset($periodoHabilitado->es_futuro) && $periodoHabilitado->es_futuro) {
                $alertaPeriodo = "Próximo período: {$periodoHabilitado->nombre} (Inicia: {$periodoHabilitado->fecha_inicio})";
                $tipoAlerta = 'info';
            } else {
                $alertaPeriodo = "Período: {$periodoHabilitado->nombre} - La subida de documentos no está habilitada.";
                $tipoAlerta = 'warning';
            }
            \Log::info($alertaPeriodo);
        } else {
            $alertaPeriodo = "Período activo: {$periodoHabilitado->nombre}";
            $tipoAlerta = 'success';
            \Log::info($alertaPeriodo);
        }
            
            // ✅ 3. OBTENER MAESTROS CON SUS DOCUMENTOS DEL PERÍODO
            $maestrosQuery = Maestro::where('coordinaciones_id', $coordinacion->id);
            
            // ✅ 4. CARGAR DOCUMENTOS DEL PERÍODO PARA CADA MAESTRO
            if ($periodoHabilitado && $periodoHabilitado->id) {
                $maestrosQuery->with(['documentos' => function($query) use ($periodoHabilitado) {
                    $query->where('periodo_id', $periodoHabilitado->id)
                          ->orderBy('tipo', 'asc');
                }]);
            } else {
                // Si no hay período, cargar todos los documentos
                $maestrosQuery->with(['documentos' => function($query) {
                    $query->orderBy('tipo', 'asc');
                }]);
            }
            
            // ✅ 5. ESTADÍSTICAS BÁSICAS
            $totalMaestros = $maestrosQuery->count();
            $maestrosActivos = Maestro::where('coordinaciones_id', $coordinacion->id)
                ->where('activo', 1)
                ->count();
            
            // ✅ 6. BÚSQUEDA
            if ($request->has('search') && !empty($request->search)) {
                $search = $request->search;
                $maestrosQuery->where(function($q) use ($search) {
                    $q->where('nombres', 'LIKE', "%{$search}%")
                      ->orWhere('apellido_paterno', 'LIKE', "%{$search}%")
                      ->orWhere('apellido_materno', 'LIKE', "%{$search}%")
                      ->orWhere('email', 'LIKE', "%{$search}%");
                });
            }
            
            // ✅ 7. PAGINAR Y OBTENER MAESTROS
            $maestros = $maestrosQuery->orderBy('apellido_paterno', 'asc')
                ->orderBy('apellido_materno', 'asc')
                ->orderBy('nombres', 'asc')
                ->paginate(15)
                ->appends(['search' => $request->search]);
            
            \Log::info("📋 Maestros encontrados: " . $maestros->count());
            
            // ✅ 8. CALCULAR ESTADO DE DOCUMENTOS PARA CADA MAESTRO
            $estadoDocumentos = [];
            $documentosCompletos = 0;
            $estadisticasDocumentos = [
                'total_subidos' => 0,
                'total_aprobados' => 0,
                'total_pendientes' => 0,
                'total_rechazados' => 0,
                'total_faltantes' => 0
            ];
            
            foreach ($maestros as $maestro) {
                $estado = $this->calcularEstadoDocumentos($maestro, $periodoHabilitado, $coordinacion->id);
                $estadoDocumentos[$maestro->id] = $estado;
                
                // Sumar a estadísticas generales
                $estadisticasDocumentos['total_subidos'] += $estado['total_subidos'];
                $estadisticasDocumentos['total_aprobados'] += $estado['aprobados'];
                $estadisticasDocumentos['total_pendientes'] += $estado['pendientes'];
                $estadisticasDocumentos['total_rechazados'] += $estado['rechazados'];
                $estadisticasDocumentos['total_faltantes'] += $estado['faltantes'];
                
                if ($estado['completado']) {
                    $documentosCompletos++;
                }
                
                // ✅ IMPORTANTE: AGREGAR DATOS AL MAESTRO PARA LA VISTA
                $maestro->estadoDocumentos = $estado;
                $maestro->progresoDocumentos = [
                    'porcentaje' => $estado['porcentaje'],
                    'subidos' => $estado['total_subidos'],
                    'total' => $estado['total_requeridos']
                ];
            }
            
            \Log::info("📊 Estadísticas documentos: " . json_encode($estadisticasDocumentos));
            
            // ✅ 9. RETORNAR VISTA CON TODAS LAS VARIABLES
            return view('dashboard.coordinacion', compact(
                'coordinacion',
                'maestros',
                'totalMaestros',
                'maestrosActivos',
                'documentosCompletos',
                'periodoHabilitado',
                'estadoDocumentos',
                'estadisticasDocumentos',
                'alertaPeriodo', // ✅ AGREGAR
            'tipoAlerta'     // ✅ AGREGAR
            ));
            
        } catch (\Exception $e) {
            \Log::error('💥 ERROR en dashboard: ' . $e->getMessage());
            \Log::error('Archivo: ' . $e->getFile());
            \Log::error('Línea: ' . $e->getLine());
            
            return view('dashboard.coordinacion', [
                'coordinacion' => null,
                'maestros' => collect(),
                'totalMaestros' => 0,
                'maestrosActivos' => 0,
                'documentosCompletos' => 0,
                'periodoHabilitado' => null,
                'estadoDocumentos' => [],
                'estadisticasDocumentos' => [],
                'error' => 'Error al cargar el dashboard: ' . $e->getMessage()
            ]);
        }
    }
    
    /**
 * ✅ MÉTODO PARA OBTENER PERÍODO HABILITADO - CORREGIDO
 */
private function obtenerPeriodoHabilitado()
{
    try {
        \Log::info('=== BUSCANDO PERÍODO HABILITADO PARA COORDINACIÓN ===');
        
        // Método 1: Usar el método específico del modelo Periodo si existe
        // Primero verifica si el método es estático
        if (method_exists(Periodo::class, 'getPeriodoSubidaHabilitada')) {
            $periodo = Periodo::getPeriodoSubidaHabilitada();
            if ($periodo) {
                \Log::info("✅ Período habilitado encontrado vía método: {$periodo->nombre} (ID: {$periodo->id})");
                $periodo->activo = 1;
                return $periodo;
            }
        }
        
        // Método 2: Buscar período con subida habilitada en fechas actuales
        $hoy = Carbon::now();
        $periodo = Periodo::where('subida_habilitada', true)
            ->whereDate('fecha_inicio', '<=', $hoy)
            ->whereDate('fecha_fin', '>=', $hoy)
            ->orderBy('fecha_inicio', 'desc')
            ->first();
        
        if ($periodo) {
            \Log::info("✅ Período habilitado encontrado por fechas: {$periodo->nombre} (ID: {$periodo->id})");
            $periodo->activo = 1;
            return $periodo;
        }
        
        // Método 3: Buscar cualquier período en fechas actuales
        $periodo = Periodo::whereDate('fecha_inicio', '<=', $hoy)
            ->whereDate('fecha_fin', '>=', $hoy)
            ->orderBy('fecha_inicio', 'desc')
            ->first();
        
        if ($periodo) {
            \Log::info("⚠️ Período actual encontrado (subida NO habilitada): {$periodo->nombre}");
            $periodo->activo = 0; // No tiene subida habilitada
            return $periodo;
        }
        
        // Método 4: Verificar si hay períodos recientes (últimos 30 días)
        $ultimoMes = Carbon::now()->subDays(30);
        $periodo = Periodo::where('fecha_fin', '>=', $ultimoMes)
            ->orderBy('fecha_fin', 'desc')
            ->first();
        
        if ($periodo) {
            \Log::info("⚠️ Usando período reciente: {$periodo->nombre} (Finalizó: {$periodo->fecha_fin})");
            $periodo->activo = 0;
            return $periodo;
        }
        
        // Método 5: Último período creado (SOLO si no hay otros)
        $periodo = Periodo::latest()->first();
        
        if ($periodo) {
            \Log::info("⚠️ Usando último período disponible: {$periodo->nombre}");
            $periodo->activo = 0;
            
            // Verificar si este período está en el futuro
            if ($periodo->fecha_inicio > Carbon::now()) {
                \Log::warning("📅 PERÍODO FUTURO: {$periodo->nombre} inicia el {$periodo->fecha_inicio}");
                $periodo->activo = 0;
                $periodo->es_futuro = true;
            }
            
            return $periodo;
        }
        
        \Log::warning("❌ No se encontró ningún período en el sistema");
        return null;
        
    } catch (\Exception $e) {
        \Log::error("Error al obtener período: " . $e->getMessage());
        \Log::error("Trace: " . $e->getTraceAsString());
        return null;
    }
}
    
    /**
     * ✅ CALCULAR ESTADO DE DOCUMENTOS POR MAESTRO - CORREGIDO
     */
    private function calcularEstadoDocumentos($maestro, $periodo, $coordinacionId)
    {
        try {
            // Documentos requeridos por coordinación
            $documentosRequeridos = $this->obtenerDocumentosRequeridos($coordinacionId);
            
            // ✅ CORREGIDO: Manejar correctamente la colección de documentos
            $documentos = collect();
            
            if ($periodo && $periodo->id) {
                // Filtrar documentos del período específico
                if ($maestro->documentos && $maestro->documentos->count() > 0) {
                    $documentos = $maestro->documentos->where('periodo_id', $periodo->id);
                }
            } else {
                // Si no hay período, usar todos los documentos
                $documentos = $maestro->documentos ?? collect();
            }
            
            $totalRequeridos = count($documentosRequeridos);
            $totalSubidos = $documentos->count();
            
            // Contar por estado
            $aprobados = $documentos->where('estado', 'aprobado')->count();
            $pendientes = $documentos->where('estado', 'pendiente')->count();
            $rechazados = $documentos->where('estado', 'rechazado')->count();
            $faltantes = max(0, $totalRequeridos - $totalSubidos);
            
            // Calcular porcentaje
            $porcentaje = $totalRequeridos > 0 ? round(($totalSubidos / $totalRequeridos) * 100) : 0;
            
            // Determinar estado general
            $estadoGeneral = 'faltante';
            $color = 'danger';
            $completado = false;
            
            if ($totalSubidos >= $totalRequeridos) {
                if ($rechazados > 0) {
                    $estadoGeneral = 'con_rechazos';
                    $color = 'warning';
                } elseif ($aprobados == $totalRequeridos) {
                    $estadoGeneral = 'completo_aprobado';
                    $color = 'success';
                    $completado = true;
                } else {
                    $estadoGeneral = 'en_revision';
                    $color = 'info';
                }
            } elseif ($totalSubidos > 0) {
                $estadoGeneral = 'parcial';
                $color = 'warning';
            }
            
            return [
                'total_subidos' => $totalSubidos,
                'total_requeridos' => $totalRequeridos,
                'aprobados' => $aprobados,
                'pendientes' => $pendientes,
                'rechazados' => $rechazados,
                'faltantes' => $faltantes,
                'porcentaje' => $porcentaje,
                'estado_general' => $estadoGeneral,
                'color' => $color,
                'completado' => $completado,
                'documentos' => $documentos
            ];
            
        } catch (\Exception $e) {
            \Log::error("Error en calcularEstadoDocumentos: " . $e->getMessage());
            return [
                'total_subidos' => 0,
                'total_requeridos' => 0,
                'aprobados' => 0,
                'pendientes' => 0,
                'rechazados' => 0,
                'faltantes' => 0,
                'porcentaje' => 0,
                'estado_general' => 'error',
                'color' => 'danger',
                'completado' => false,
                'documentos' => collect()
            ];
        }
    }
    
    /**
     * ✅ OBTENER DOCUMENTOS REQUERIDOS POR COORDINACIÓN
     */
    private function obtenerDocumentosRequeridos($coordinacionId)
    {
        $documentosPorCoordinacion = [
            1 => ['cst', 'iufim', 'comprobante_domicilio'],
            2 => ['cst', 'iufim', 'oficio_ingresos', 'declaracion_anual'],
            3 => ['cst', 'iufim', 'comprobante_seguro_social', 'comprobante_domicilio'],
            7 => ['cst', 'iufim', 'comprobante_domicilio', 'curriculum', 'cedula_profesional', 'titulo'],
        ];
        
        return $documentosPorCoordinacion[$coordinacionId] ?? ['cst', 'iufim', 'comprobante_domicilio'];
    }
    
    /**
     * ✅ MÉTODO PARA VER DOCUMENTOS DE UN MAESTRO ESPECÍFICO - CORREGIDO
     */
    public function verDocumentosMaestro($maestroId)
    {
        try {
            $user = Auth::user();
            $coordinacion = $user->coordinaciones_id ? Coordinacion::find($user->coordinaciones_id) : null;
            
            if (!$coordinacion) {
                return redirect()->route('coordinacion.dashboard')
                    ->with('error', 'No tienes una coordinación asignada.');
            }
            
            // Verificar que el maestro pertenece a esta coordinación
            $maestro = Maestro::where('id', $maestroId)
                ->where('coordinaciones_id', $coordinacion->id)
                ->firstOrFail();
            
            // Obtener período habilitado
            $periodoHabilitado = $this->obtenerPeriodoHabilitado();
            
            // Cargar documentos del período
            if ($periodoHabilitado && $periodoHabilitado->id) {
                $maestro->load(['documentos' => function($query) use ($periodoHabilitado) {
                    $query->where('periodo_id', $periodoHabilitado->id)
                          ->with('revisadoPor')
                          ->orderBy('tipo', 'asc');
                }]);
            } else {
                $maestro->load(['documentos' => function($query) {
                    $query->with('revisadoPor')->orderBy('tipo', 'asc');
                }]);
            }
            
            // Tipos de documentos base
            $tiposBase = [
                'cst' => ['nombre' => 'CST', 'icono' => 'file-contract', 'color' => 'primary'],
                'iufim' => ['nombre' => 'IUFIM', 'icono' => 'file-invoice', 'color' => 'info'],
                'comprobante_domicilio' => ['nombre' => 'Comprobante Domicilio', 'icono' => 'home', 'color' => 'success'],
                'oficio_ingresos' => ['nombre' => 'Oficio Ingresos', 'icono' => 'money-bill-wave', 'color' => 'warning'],
                'declaracion_anual' => ['nombre' => 'Declaración Anual', 'icono' => 'file-alt', 'color' => 'secondary'],
                'comprobante_seguro_social' => ['nombre' => 'Seguro Social', 'icono' => 'shield-alt', 'color' => 'danger'],
                'curriculum' => ['nombre' => 'Curriculum', 'icono' => 'file-alt', 'color' => 'info'],
                'cedula_profesional' => ['nombre' => 'Cédula', 'icono' => 'id-card', 'color' => 'success'],
                'titulo' => ['nombre' => 'Título', 'icono' => 'graduation-cap', 'color' => 'primary']
            ];
            
            $documentosRequeridos = $this->obtenerDocumentosRequeridos($coordinacion->id);
            
            // ✅ AGREGAR: Calcular estado actual del maestro para esta vista
            $estadoMaestro = $this->calcularEstadoDocumentos($maestro, $periodoHabilitado, $coordinacion->id);
            
            return view('coordinacion.documentos_maestro', compact(
                'coordinacion',
                'maestro',
                'periodoHabilitado',
                'tiposBase',
                'documentosRequeridos',
                'estadoMaestro' // ✅ AGREGAR ESTA VARIABLE
            ));
            
        } catch (\Exception $e) {
            \Log::error('Error en verDocumentosMaestro: ' . $e->getMessage());
            \Log::error('Trace: ' . $e->getTraceAsString());
            return redirect()->route('coordinacion.dashboard')
                ->with('error', 'Error al cargar documentos del maestro: ' . $e->getMessage());
        }
    }
    
    /**
     * ✅ MÉTODO PARA CAMBIAR ESTADO DE DOCUMENTO (APROBAR/RECHAZAR)
     */
    public function cambiarEstadoDocumento(Request $request, $documentoId)
    {
        try {
            $user = Auth::user();
            
            // Verificar que el documento existe
            $documento = DocumentoMaestro::findOrFail($documentoId);
            
            // Verificar que el maestro pertenece a la coordinación del usuario
            $maestro = $documento->maestro;
            if ($maestro->coordinaciones_id != $user->coordinaciones_id) {
                abort(403, 'No tienes permisos para modificar este documento');
            }
            
            $request->validate([
                'estado' => 'required|in:aprobado,rechazado,pendiente',
                'observaciones' => 'nullable|string|max:1000'
            ]);
            
            // Actualizar documento
            $documento->estado = $request->estado;
            $documento->revisado_por = $user->id;
            $documento->fecha_revision = now();
            
            if ($request->has('observaciones')) {
                $documento->observaciones_admin = $request->observaciones;
            }
            
            $documento->save();
            
            \Log::info("Documento {$documentoId} cambiado a {$request->estado} por coordinador {$user->id}");
            
            return response()->json([
                'success' => true,
                'message' => 'Estado actualizado correctamente',
                'estado' => $request->estado
            ]);
            
        } catch (\Exception $e) {
            \Log::error('Error en cambiarEstadoDocumento: ' . $e->getMessage());
            \Log::error('Trace: ' . $e->getTraceAsString());
            return response()->json([
                'success' => false,
                'message' => 'Error al cambiar estado: ' . $e->getMessage()
            ], 500);
        }
    }
    
    /**
 * ✅ VISTA DE MAESTROS - ACTUALIZADA PARA MOSTRAR ESTADO DE DOCUMENTOS
 */
public function maestros(Request $request)
{
    try {
        $user = Auth::user();
        $coordinacion = $user->coordinaciones_id ? Coordinacion::find($user->coordinaciones_id) : null;
        
        if (!$coordinacion) {
            return redirect()->route('coordinacion.dashboard')
                ->with('error', 'No tienes una coordinación asignada.');
        }
        
        // Obtener período habilitado para mostrar en la vista
        $periodoHabilitado = $this->obtenerPeriodoHabilitado();
        
        // Búsqueda si viene por GET
        $query = Maestro::where('coordinaciones_id', $coordinacion->id);
        
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nombres', 'like', "%{$search}%")
                  ->orWhere('apellido_paterno', 'like', "%{$search}%")
                  ->orWhere('apellido_materno', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('especialidad', 'like', "%{$search}%");
            });
        }
        
        // Filtrar por estado si se solicita
        if ($request->has('estado') && $request->estado !== '') {
            $query->where('activo', $request->estado);
        }
        
        // ✅ IMPORTANTE: CARGAR DOCUMENTOS DEL PERÍODO
        if ($periodoHabilitado && $periodoHabilitado->id) {
            $query->with(['documentos' => function($q) use ($periodoHabilitado) {
                $q->where('periodo_id', $periodoHabilitado->id);
            }]);
        } else {
            $query->with('documentos');
        }
        
        $maestros = $query->orderBy('apellido_paterno', 'asc')
            ->orderBy('apellido_materno', 'asc')
            ->orderBy('nombres', 'asc')
            ->paginate(15)
            ->withQueryString();
        
        $totalMaestros = Maestro::where('coordinaciones_id', $coordinacion->id)->count();
        $maestrosActivos = Maestro::where('coordinaciones_id', $coordinacion->id)
            ->where('activo', 1)
            ->count();
        
        // ✅ CALCULAR ESTADO DE DOCUMENTOS PARA CADA MAESTRO
        $estadosMaestros = [];
        $documentosRequeridos = $this->obtenerDocumentosRequeridos($coordinacion->id);
        
        foreach ($maestros as $maestro) {
            $estado = $this->calcularEstadoDocumentos($maestro, $periodoHabilitado, $coordinacion->id);
            $estadosMaestros[$maestro->id] = $estado;
            
            // ✅ AGREGAR DATOS AL MAESTRO PARA LA VISTA
            $maestro->estadoDocumentos = $estado;
            $maestro->progresoDocumentos = [
                'porcentaje' => $estado['porcentaje'],
                'subidos' => $estado['total_subidos'],
                'total' => $estado['total_requeridos']
            ];
        }
        
        return view('coordinaciones.maestros', [
            'coordinacion' => $coordinacion,
            'maestros' => $maestros,
            'totalMaestros' => $totalMaestros,
            'maestrosActivos' => $maestrosActivos,
            'periodoHabilitado' => $periodoHabilitado, // ✅ ESTA VARIABLE YA EXISTE
            'estadosMaestros' => $estadosMaestros,
            'documentosRequeridos' => $documentosRequeridos,
            'search' => $request->search ?? '',
            'estado' => $request->estado ?? ''
        ]);
        
    } catch (\Exception $e) {
        \Log::error('Error en maestros: ' . $e->getMessage());
        \Log::error('Trace: ' . $e->getTraceAsString());
        return redirect()->route('coordinacion.dashboard')
            ->with('error', 'Error al cargar la lista de maestros: ' . $e->getMessage());
    }
}

    
/**
 * ✅ VISTA DETALLADA DE MAESTROS (VERSIÓN 2)
 */
/**
 * ✅ VISTA DETALLADA DE MAESTROS (VERSIÓN 2) - CORREGIDO
 */
public function maestrosDetalle(Request $request)
{
    try {
        $user = Auth::user();
        $coordinacion = $user->coordinaciones_id ? Coordinacion::find($user->coordinaciones_id) : null;
        
        if (!$coordinacion) {
            return redirect()->route('coordinacion.dashboard')
                ->with('error', 'No tienes una coordinación asignada.');
        }
        
        // ✅ AGREGADO: Obtener período habilitado
        $periodoHabilitado = $this->obtenerPeriodoHabilitado();
        
        // Consulta de maestros con todos los campos
        $query = Maestro::where('coordinaciones_id', $coordinacion->id);
        
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nombres', 'like', "%{$search}%")
                  ->orWhere('apellido_paterno', 'like', "%{$search}%")
                  ->orWhere('apellido_materno', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('telefono', 'like', "%{$search}%")
                  ->orWhere('especialidad', 'like', "%{$search}%")
                  ->orWhere('maximo_grado_academico', 'like', "%{$search}%");
            });
        }
        
        // Cargar documentos para calcular progreso
        $query->with('documentos');
        
        $maestros = $query->orderBy('apellido_paterno', 'asc')
            ->orderBy('apellido_materno', 'asc')
            ->orderBy('nombres', 'asc')
            ->paginate(15)
            ->withQueryString();
        
        $totalMaestros = Maestro::where('coordinaciones_id', $coordinacion->id)->count();
        
        // Calcular progreso de documentos
        $documentosRequeridos = $this->obtenerDocumentosRequeridos($coordinacion->id);
        
        foreach ($maestros as $maestro) {
            $documentosSubidos = $maestro->documentos->count();
            $totalRequeridos = count($documentosRequeridos);
            
            $maestro->progresoDocumentos = [
                'subidos' => $documentosSubidos,
                'total' => $totalRequeridos
            ];
        }
        
        // ✅ CORREGIDO: Agregar $periodoHabilitado al compact
        return view('coordinaciones.maestros-detalle', compact(
            'coordinacion',
            'maestros',
            'totalMaestros',
            'periodoHabilitado' // ✅ AGREGADO
        ));
        
    } catch (\Exception $e) {
        \Log::error('Error en maestrosDetalle: ' . $e->getMessage());
        return redirect()->route('coordinacion.dashboard')
            ->with('error', 'Error al cargar la lista de maestros: ' . $e->getMessage());
    }
}

}