<?php

namespace App\Http\Controllers;

use App\Models\Administrativo;
use App\Models\DocumentoAdministrativo;
use App\Models\Periodo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdministrativosController extends Controller
{
    /**
     * Dashboard principal del administrativo
     * Muestra su perfil y estado de documentos
     */
    public function dashboard()
    {
        try {
            Log::info('=== DASHBOARD ADMINISTRATIVO ===');
            
            $user = Auth::user();
            
            // Buscar administrativo asociado al usuario
            $administrativo = Administrativo::where('user_id', $user->id)
                ->with(['documentosAdmin.revisadoPor', 'documentosAdmin.periodo'])
                ->first();

            if (!$administrativo) {
                return redirect()->route('administrativos.completar-perfil')
                    ->with('info', 'Por favor, completa tu perfil primero.');
            }

            // Verificar período activo (opcional para documentos)
            $periodoActivo = Periodo::getPeriodoSubidaHabilitada();
            
            // Tipos de documentos requeridos
            // Tipos de documentos requeridos - 10 documentos
$tiposDocumentos = [
    'solicitud_empleo' => [
        'nombre' => 'Solicitud de Empleo',
        'icono' => 'file-alt',
        'descripcion' => 'Formato de solicitud de empleo'
    ],
    'curriculum_vitae' => [
        'nombre' => 'Curriculum Vitae',
        'icono' => 'file-alt',
        'descripcion' => 'Hoja de vida actualizada'
    ],
    'acta_nacimiento' => [
        'nombre' => 'Acta de Nacimiento',
        'icono' => 'file',
        'descripcion' => 'Acta de nacimiento certificada'
    ],
    'curp_documento' => [
        'nombre' => 'CURP',
        'icono' => 'id-card',
        'descripcion' => 'CURP (Formato página RENAPO)'
    ],
    'constancia_fiscal' => [
        'nombre' => 'Constancia de Situación Fiscal',
        'icono' => 'file-invoice',
        'descripcion' => 'Constancia de situación fiscal (SAT)'
    ],
    'nss' => [
        'nombre' => 'Número de Seguridad Social',
        'icono' => 'heartbeat',
        'descripcion' => 'NSS (Formato página IMSS)'
    ],
    'ine' => [
        'nombre' => 'INE',
        'icono' => 'id-card',
        'descripcion' => 'Identificación oficial vigente'
    ],
    'comprobante_domicilio' => [
        'nombre' => 'Comprobante de Domicilio',
        'icono' => 'home',
        'descripcion' => 'Comprobante de domicilio reciente'
    ],
    'comprobante_estudios' => [
        'nombre' => 'Comprobante de Estudios',
        'icono' => 'graduation-cap',
        'descripcion' => 'Último grado de estudios'
    ],
    'certificado_medico' => [
        'nombre' => 'Certificado Médico',
        'icono' => 'file-medical',
        'descripcion' => 'Certificado médico vigente'
    ]
];

            // Cargar documentos del período activo si existe
            $documentosDelPeriodo = collect();
            if ($periodoActivo) {
                $documentosDelPeriodo = $administrativo->documentosAdmin()
                    ->where('periodo_id', $periodoActivo->id)
                    ->with('revisadoPor')
                    ->get();
            } else {
                // Si no hay período activo, mostrar todos los documentos
                $documentosDelPeriodo = $administrativo->documentosAdmin()
                    ->with('revisadoPor')
                    ->get();
            }

            // Procesar documentos para la vista
            $documentosSubidos = [];
            foreach ($documentosDelPeriodo as $doc) {
                $documentosSubidos[$doc->tipo] = $doc;
            }

            $documentosParaVista = [];
            foreach ($tiposDocumentos as $tipo => $info) {
                $documentoInfo = [
                    'tipo' => $tipo,
                    'nombre' => $info['nombre'],
                    'icono' => $info['icono'],
                    'descripcion' => $info['descripcion'],
                    'estado' => 'faltante',
                    'tiene_documento' => false,
                    'documento_id' => null,
                    'observaciones' => null,
                    'fecha_subida' => null,
                    'archivo' => null,
                    'aprobado_por' => null
                ];

                if (isset($documentosSubidos[$tipo])) {
                    $doc = $documentosSubidos[$tipo];
                    $documentoInfo['estado'] = $doc->estado;
                    $documentoInfo['tiene_documento'] = true;
                    $documentoInfo['documento_id'] = $doc->id;
                    $documentoInfo['observaciones'] = $doc->observaciones_admin;
                    $documentoInfo['fecha_subida'] = $doc->created_at;
                    $documentoInfo['archivo'] = $doc->nombre_archivo;
                    $documentoInfo['aprobado_por'] = $doc->revisadoPor->name ?? null;
                }

                $documentosParaVista[] = $documentoInfo;
            }

            // Calcular estadísticas
            $totalRequeridos = count($tiposDocumentos);
            $totalSubidos = count($documentosSubidos);
            $faltantes = $totalRequeridos - $totalSubidos;
            $porcentaje = $totalRequeridos > 0 ? round(($totalSubidos / $totalRequeridos) * 100) : 0;

            $documentosAprobados = $documentosDelPeriodo->where('estado', 'aprobado')->count();
            $documentosRechazados = $documentosDelPeriodo->where('estado', 'rechazado')->count();
            $documentosPendientes = $documentosDelPeriodo->where('estado', 'pendiente')->count();

            $estadisticas = [
                'total_requeridos' => $totalRequeridos,
                'total_subidos' => $totalSubidos,
                'aprobados' => $documentosAprobados,
                'rechazados' => $documentosRechazados,
                'pendientes' => $documentosPendientes,
                'porcentaje' => $porcentaje,
                'faltantes' => $faltantes,
            ];

            // Actividades recientes
            $actividadesRecientes = $this->obtenerActividadesRecientes($documentosDelPeriodo);

            return view('administrativos.dashboard', compact(
                'administrativo',
                'tiposDocumentos',
                'documentosParaVista',
                'estadisticas',
                'periodoActivo',
                'actividadesRecientes'
            ));

        } catch (\Exception $e) {
            Log::error('ERROR en dashboard administrativo: ' . $e->getMessage());
            return redirect()->route('administrativos.completar-perfil')
                ->with('error', 'Error al cargar el dashboard: ' . $e->getMessage());
        }
    }

    /**
     * Mostrar formulario para completar perfil
     */
    public function mostrarFormularioPerfil()
    {
        try {
            $user = Auth::user();
            
            // Verificar si ya tiene perfil
            $administrativoExistente = Administrativo::where('user_id', $user->id)->first();

            if ($administrativoExistente) {
                return redirect()->route('administrativos.dashboard')
                    ->with('info', 'Ya tienes un perfil completado.');
            }

            return view('administrativos.completar-perfil');
            
        } catch (\Exception $e) {
            Log::error('Error en mostrarFormularioPerfil: ' . $e->getMessage());
            return view('administrativos.completar-perfil')
                ->with('error', 'Error al cargar formulario: ' . $e->getMessage());
        }
    }

    /**
     * Guardar el perfil del administrativo (cuestionario inicial)
     */
    /**
 * Guardar el perfil del administrativo (cuestionario inicial)
 */
/**
 * Guardar el perfil del administrativo
 */
public function guardarPerfil(Request $request)
{
    try {
        Log::info('=== GUARDAR PERFIL ADMINISTRATIVO ===');
        
        $user = Auth::user();

        $perfilExistente = Administrativo::where('user_id', $user->id)->first();

        if ($perfilExistente) {
            return redirect()->route('administrativos.dashboard')
                ->with('info', 'Ya tienes un perfil registrado.');
        }

        $validated = $request->validate([
            'nombres' => 'required|string|max:100',
            'apellido_paterno' => 'required|string|max:50',
            'apellido_materno' => 'nullable|string|max:50',
            'fecha_nacimiento' => 'required|date|before:today',
            'edad' => 'required|integer|min:18|max:100',
            'genero' => 'required|in:M,F,OTRO',
            'nacionalidad' => 'required|string|max:100',
            'estado_civil' => 'required|string|max:50',
            'telefono_celular' => 'required|string|max:20',
            'telefono_fijo' => 'nullable|string|max:20',
            'email_personal' => 'required|email|max:100',
            'domicilio' => 'required|string',
            'colonia' => 'required|string|max:100',
            'codigo_postal' => 'required|string|max:10',
            'municipio' => 'required|string|max:100',
            'ciudad_poblacion' => 'required|string|max:100',
            'lugar_nacimiento' => 'required|string|max:200',
            'puesto' => 'required|string|max:100',
            
            // Documentos
            'solicitud_empleo' => 'nullable|file|mimes:pdf|max:4096',
            'curriculum_vitae' => 'nullable|file|mimes:pdf|max:4096',
            'acta_nacimiento' => 'nullable|file|mimes:pdf|max:4096',
            'curp_documento' => 'nullable|file|mimes:pdf|max:4096',
            'constancia_fiscal' => 'nullable|file|mimes:pdf|max:4096',
            'nss' => 'nullable|file|mimes:pdf|max:4096',
            'ine' => 'nullable|file|mimes:pdf|max:4096',
            'comprobante_domicilio' => 'nullable|file|mimes:pdf|max:4096',
            'comprobante_estudios' => 'nullable|file|mimes:pdf|max:4096',
            'certificado_medico' => 'nullable|file|mimes:pdf|max:4096',
        ], [
            'fecha_nacimiento.before' => 'La fecha de nacimiento no puede ser futura.',
            'edad.min' => 'Debes ser mayor de 18 años.',
            '*.max' => 'El archivo no debe ser mayor a 4MB',
            '*.mimes' => 'El archivo debe ser formato PDF',
        ]);

        $edad = \Carbon\Carbon::parse($validated['fecha_nacimiento'])->age;

        $administrativo = Administrativo::create([
            'user_id' => $user->id,
            'nombres' => $validated['nombres'],
            'apellido_paterno' => $validated['apellido_paterno'],
            'apellido_materno' => $validated['apellido_materno'] ?? null,
            'fecha_nacimiento' => $validated['fecha_nacimiento'],
            'edad' => $edad,
            'genero' => $validated['genero'],
            'nacionalidad' => $validated['nacionalidad'],
            'estado_civil' => $validated['estado_civil'],
            'telefono_celular' => $validated['telefono_celular'],
            'telefono_fijo' => $validated['telefono_fijo'] ?? null,
            'email_personal' => $validated['email_personal'],
            'domicilio' => $validated['domicilio'],
            'colonia' => $validated['colonia'],
            'codigo_postal' => $validated['codigo_postal'],
            'municipio' => $validated['municipio'],
            'ciudad_poblacion' => $validated['ciudad_poblacion'],
            'lugar_nacimiento' => $validated['lugar_nacimiento'],
            'puesto' => $validated['puesto'],
        ]);

        // Procesar documentos (igual que antes)
        $documentosSubidos = 0;
        $tiposDocumentos = [
            'solicitud_empleo', 'curriculum_vitae', 'acta_nacimiento', 
            'curp_documento', 'constancia_fiscal', 'nss', 'ine', 
            'comprobante_domicilio', 'comprobante_estudios', 'certificado_medico'
        ];
        
        foreach ($tiposDocumentos as $tipo) {
            if ($request->hasFile($tipo)) {
                $archivo = $request->file($tipo);
                
                $directorio = "documentos_administrativos/{$administrativo->id}";
                if (!Storage::disk('public')->exists($directorio)) {
                    Storage::disk('public')->makeDirectory($directorio);
                }
                
                $extension = $archivo->getClientOriginalExtension();
                $nombreArchivo = $tipo . '_' . time() . '_' . uniqid() . '.' . $extension;
                $ruta = $archivo->storeAs($directorio, $nombreArchivo, 'public');
                
                DocumentoAdministrativo::create([
                    'administrativo_id' => $administrativo->id,
                    'tipo' => $tipo,
                    'nombre_archivo' => $archivo->getClientOriginalName(),
                    'ruta_archivo' => $ruta,
                    'mime_type' => $archivo->getMimeType(),
                    'tamanio' => $archivo->getSize(),
                    'estado' => 'pendiente',
                ]);
                
                $documentosSubidos++;
            }
        }

        return redirect()->route('administrativos.dashboard')
            ->with('success', 'Perfil completado exitosamente.');

    } catch (\Exception $e) {
        Log::error('ERROR en guardarPerfil: ' . $e->getMessage());
        return back()
            ->withInput()
            ->with('error', 'Error al guardar el perfil: ' . $e->getMessage());
    }
}

    /**
     * Vista de documentos del administrativo
     */
    public function documentos()
    {
        try {
            Log::info('=== VISTA DOCUMENTOS ADMINISTRATIVO ===');
            
            $user = Auth::user();
            
            $administrativo = Administrativo::where('user_id', $user->id)
                ->with(['documentosAdmin.revisadoPor', 'documentosAdmin.periodo'])
                ->first();

            if (!$administrativo) {
                return redirect()->route('administrativos.completar-perfil')
                    ->with('info', 'Por favor, completa tu perfil primero.');
            }

            // Verificar período activo
            $periodoActivo = Periodo::getPeriodoSubidaHabilitada();

            // Tipos de documentos requeridos
            // Tipos de documentos requeridos - 10 documentos
$tiposDocumentos = [
    'solicitud_empleo' => [
        'nombre' => 'Solicitud de Empleo',
        'icono' => 'file-alt',
        'descripcion' => 'Formato de solicitud de empleo'
    ],
    'curriculum_vitae' => [
        'nombre' => 'Curriculum Vitae',
        'icono' => 'file-alt',
        'descripcion' => 'Hoja de vida actualizada'
    ],
    'acta_nacimiento' => [
        'nombre' => 'Acta de Nacimiento',
        'icono' => 'file',
        'descripcion' => 'Acta de nacimiento certificada'
    ],
    'curp_documento' => [
        'nombre' => 'CURP',
        'icono' => 'id-card',
        'descripcion' => 'CURP (Formato página RENAPO)'
    ],
    'constancia_fiscal' => [
        'nombre' => 'Constancia de Situación Fiscal',
        'icono' => 'file-invoice',
        'descripcion' => 'Constancia de situación fiscal (SAT)'
    ],
    'nss' => [
        'nombre' => 'Número de Seguridad Social',
        'icono' => 'heartbeat',
        'descripcion' => 'NSS (Formato página IMSS)'
    ],
    'ine' => [
        'nombre' => 'INE',
        'icono' => 'id-card',
        'descripcion' => 'Identificación oficial vigente'
    ],
    'comprobante_domicilio' => [
        'nombre' => 'Comprobante de Domicilio',
        'icono' => 'home',
        'descripcion' => 'Comprobante de domicilio reciente'
    ],
    'comprobante_estudios' => [
        'nombre' => 'Comprobante de Estudios',
        'icono' => 'graduation-cap',
        'descripcion' => 'Último grado de estudios'
    ],
    'certificado_medico' => [
        'nombre' => 'Certificado Médico',
        'icono' => 'file-medical',
        'descripcion' => 'Certificado médico vigente'
    ]
];
            // Cargar documentos
            $documentos = $periodoActivo 
                ? $administrativo->documentosAdmin()->where('periodo_id', $periodoActivo->id)->with('revisadoPor')->get()
                : $administrativo->documentosAdmin()->with('revisadoPor')->get();

            // Procesar documentos para la vista
            $documentosSubidos = [];
            foreach ($documentos as $doc) {
                $documentosSubidos[$doc->tipo] = $doc;
            }

            $documentosParaVista = [];
            foreach ($tiposDocumentos as $tipo => $info) {
                $documentoInfo = [
                    'tipo' => $tipo,
                    'nombre' => $info['nombre'],
                    'icono' => $info['icono'],
                    'descripcion' => $info['descripcion'],
                    'estado' => 'faltante',
                    'tiene_documento' => false,
                    'documento_id' => null,
                    'observaciones' => null,
                    'fecha_subida' => null,
                    'archivo' => null,
                    'aprobado_por' => null
                ];

                if (isset($documentosSubidos[$tipo])) {
                    $doc = $documentosSubidos[$tipo];
                    $documentoInfo['estado'] = $doc->estado;
                    $documentoInfo['tiene_documento'] = true;
                    $documentoInfo['documento_id'] = $doc->id;
                    $documentoInfo['observaciones'] = $doc->observaciones_admin;
                    $documentoInfo['fecha_subida'] = $doc->created_at;
                    $documentoInfo['archivo'] = $doc->nombre_archivo;
                    $documentoInfo['aprobado_por'] = $doc->revisadoPor->name ?? null;
                }

                $documentosParaVista[] = $documentoInfo;
            }

            // Calcular estadísticas
            $totalRequeridos = count($tiposDocumentos);
            $totalSubidos = count($documentosSubidos);
            $faltantes = $totalRequeridos - $totalSubidos;
            $porcentaje = $totalRequeridos > 0 ? round(($totalSubidos / $totalRequeridos) * 100) : 0;

            $documentosAprobados = $documentos->where('estado', 'aprobado')->count();
            $documentosRechazados = $documentos->where('estado', 'rechazado')->count();
            $documentosPendientes = $documentos->where('estado', 'pendiente')->count();

            $estadisticas = [
                'total_requeridos' => $totalRequeridos,
                'total_subidos' => $totalSubidos,
                'aprobados' => $documentosAprobados,
                'rechazados' => $documentosRechazados,
                'pendientes' => $documentosPendientes,
                'porcentaje' => $porcentaje,
                'faltantes' => $faltantes,
            ];

            return view('administrativos.documentos', compact(
                'administrativo',
                'tiposDocumentos',
                'documentosParaVista',
                'estadisticas',
                'periodoActivo'
            ));

        } catch (\Exception $e) {
            Log::error('ERROR en documentos: ' . $e->getMessage());
            return redirect()->route('administrativos.dashboard')
                ->with('error', 'Error al cargar documentos: ' . $e->getMessage());
        }
    }

    /**
     * Subir documentos
     */
    /**
 * Subir documentos
 */
public function subirDocumentos(Request $request)
{
    try {
        Log::info('=== SUBIR DOCUMENTOS ADMINISTRATIVO ===');
        
        $user = Auth::user();
        
        $administrativo = Administrativo::where('user_id', $user->id)->first();

        if (!$administrativo) {
            return redirect()->route('administrativos.completar-perfil')
                ->with('error', 'No tienes un perfil de administrativo asociado.');
        }

        // Validación con límite de 4MB
        $validator = Validator::make($request->all(), [
            'solicitud_empleo' => 'nullable|file|mimes:pdf|max:4096',
            'curriculum_vitae' => 'nullable|file|mimes:pdf|max:4096',
            'acta_nacimiento' => 'nullable|file|mimes:pdf|max:4096',
            'curp_documento' => 'nullable|file|mimes:pdf|max:4096',
            'constancia_fiscal' => 'nullable|file|mimes:pdf|max:4096',
            'nss' => 'nullable|file|mimes:pdf|max:4096',
            'ine' => 'nullable|file|mimes:pdf|max:4096',
            'comprobante_domicilio' => 'nullable|file|mimes:pdf|max:4096',
            'comprobante_estudios' => 'nullable|file|mimes:pdf|max:4096',
            'certificado_medico' => 'nullable|file|mimes:pdf|max:4096',
        ], [
            '*.max' => 'El archivo no debe ser mayor a 4MB',
            '*.mimes' => 'El archivo debe ser formato PDF',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Error en la validación de archivos');
        }

        // Obtener período activo
        $periodoActivo = Periodo::getPeriodoSubidaHabilitada();

        $documentosSubidos = 0;
        $documentosActualizados = 0;
        $tiposDocumentos = [
            'solicitud_empleo', 'curriculum_vitae', 'acta_nacimiento', 
            'curp_documento', 'constancia_fiscal', 'nss', 'ine', 
            'comprobante_domicilio', 'comprobante_estudios', 'certificado_medico'
        ];

        DB::beginTransaction();

        try {
            foreach ($tiposDocumentos as $tipo) {
                if ($request->hasFile($tipo)) {
                    $archivo = $request->file($tipo);
                    
                    Log::info("Procesando: {$tipo}");
                    
                    // Verificar si ya existe este tipo
                    $query = DocumentoAdministrativo::where('administrativo_id', $administrativo->id)
                        ->where('tipo', $tipo);
                    
                    if ($periodoActivo) {
                        $query->where('periodo_id', $periodoActivo->id);
                    }
                    
                    $documentoExistente = $query->first();

                    // Crear directorio
                    $directorio = "documentos_administrativos/{$administrativo->id}";
                    if (!Storage::disk('public')->exists($directorio)) {
                        Storage::disk('public')->makeDirectory($directorio);
                    }

                    // Generar nombre único
                    $extension = $archivo->getClientOriginalExtension();
                    $nombreArchivo = $tipo . '_' . time() . '_' . uniqid() . '.' . $extension;
                    $ruta = $archivo->storeAs($directorio, $nombreArchivo, 'public');

                    if ($documentoExistente) {
                        // Eliminar archivo anterior
                        if ($documentoExistente->ruta_archivo && Storage::disk('public')->exists($documentoExistente->ruta_archivo)) {
                            Storage::disk('public')->delete($documentoExistente->ruta_archivo);
                        }

                        // Actualizar documento existente
                        $documentoExistente->update([
                            'nombre_archivo' => $archivo->getClientOriginalName(),
                            'ruta_archivo' => $ruta,
                            'mime_type' => $archivo->getMimeType(),
                            'tamanio' => $archivo->getSize(),
                            'estado' => 'pendiente',
                            'observaciones_admin' => null,
                            'revisado_por' => null,
                            'fecha_revision' => null,
                        ]);

                        $documentosActualizados++;
                        Log::info("Documento {$tipo} ACTUALIZADO");
                    } else {
                        // Crear nuevo documento
                        DocumentoAdministrativo::create([
                            'administrativo_id' => $administrativo->id,
                            'periodo_id' => $periodoActivo ? $periodoActivo->id : null,
                            'tipo' => $tipo,
                            'nombre_archivo' => $archivo->getClientOriginalName(),
                            'ruta_archivo' => $ruta,
                            'mime_type' => $archivo->getMimeType(),
                            'tamanio' => $archivo->getSize(),
                            'estado' => 'pendiente',
                        ]);

                        $documentosSubidos++;
                        Log::info("Documento {$tipo} CREADO");
                    }
                }
            }

            DB::commit();

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

            return redirect()->route('administrativos.documentos')
                ->with('success', $mensaje);

        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

    } catch (\Exception $e) {
        Log::error('ERROR en subirDocumentos: ' . $e->getMessage());
        return redirect()->back()
            ->with('error', 'Error al subir documentos: ' . $e->getMessage())
            ->withInput();
    }
}

    /**
     * Editar perfil del administrativo
     */
    public function editarPerfil()
    {
        try {
            $user = Auth::user();
            $administrativo = Administrativo::where('user_id', $user->id)->first();

            if (!$administrativo) {
                return redirect()->route('administrativos.completar-perfil')
                    ->with('error', 'No tienes un perfil registrado.');
            }

            return view('administrativos.editar-perfil', compact('administrativo'));

        } catch (\Exception $e) {
            Log::error('Error en editarPerfil: ' . $e->getMessage());
            return redirect()->route('administrativos.dashboard')
                ->with('error', 'Error al cargar formulario: ' . $e->getMessage());
        }
    }

    /**
     * Actualizar perfil del administrativo
     */
    /**
 * Actualizar perfil del administrativo
 */
/**
 * Actualizar perfil del administrativo
 */
public function actualizarPerfil(Request $request)
{
    try {
        $user = Auth::user();
        $administrativo = Administrativo::where('user_id', $user->id)->first();

        if (!$administrativo) {
            return redirect()->route('administrativos.completar-perfil')
                ->with('error', 'No tienes un perfil registrado.');
        }

        $validated = $request->validate([
            'nombres' => 'required|string|max:100',
            'apellido_paterno' => 'required|string|max:50',
            'apellido_materno' => 'nullable|string|max:50',
            'fecha_nacimiento' => 'required|date|before:today',
            'edad' => 'required|integer|min:18|max:100',
            'genero' => 'required|in:M,F,OTRO',
            'nacionalidad' => 'required|string|max:100',
            'estado_civil' => 'required|string|max:50',
            'telefono_celular' => 'required|string|max:20',
            'telefono_fijo' => 'nullable|string|max:20',
            'email_personal' => 'required|email|max:100',
            'domicilio' => 'required|string',
            'colonia' => 'required|string|max:100',
            'codigo_postal' => 'required|string|max:10',
            'municipio' => 'required|string|max:100',
            'ciudad_poblacion' => 'required|string|max:100',
            'lugar_nacimiento' => 'required|string|max:200',
            'puesto' => 'required|string|max:100',
        ]);

        $administrativo->update([
            'nombres' => $validated['nombres'],
            'apellido_paterno' => $validated['apellido_paterno'],
            'apellido_materno' => $validated['apellido_materno'],
            'fecha_nacimiento' => $validated['fecha_nacimiento'],
            'edad' => $validated['edad'],
            'genero' => $validated['genero'],
            'nacionalidad' => $validated['nacionalidad'],
            'estado_civil' => $validated['estado_civil'],
            'telefono_celular' => $validated['telefono_celular'],
            'telefono_fijo' => $validated['telefono_fijo'],
            'email_personal' => $validated['email_personal'],
            'domicilio' => $validated['domicilio'],
            'colonia' => $validated['colonia'],
            'codigo_postal' => $validated['codigo_postal'],
            'municipio' => $validated['municipio'],
            'ciudad_poblacion' => $validated['ciudad_poblacion'],
            'lugar_nacimiento' => $validated['lugar_nacimiento'],
            'puesto' => $validated['puesto'],
        ]);

        return redirect()->route('administrativos.dashboard')
            ->with('success', 'Perfil actualizado correctamente.');

    } catch (\Exception $e) {
        Log::error('Error en actualizarPerfil: ' . $e->getMessage());
        return back()
            ->withInput()
            ->with('error', 'Error al actualizar el perfil: ' . $e->getMessage());
    }
}
    /**
     * Obtener actividades recientes
     */
    private function obtenerActividadesRecientes($documentos)
    {
        $actividades = [];
        
        if (!$documentos || $documentos->isEmpty()) {
            return [
                [
                    'titulo' => 'Perfil completado',
                    'descripcion' => 'Tu perfil ha sido registrado exitosamente',
                    'tipo' => 'success',
                    'tiempo' => 'Recién'
                ],
                [
                    'titulo' => 'Documentos pendientes',
                    'descripcion' => 'Sube tus documentos para completar tu expediente',
                    'tipo' => 'info',
                    'tiempo' => 'Recién'
                ]
            ];
        }
        
        $documentosOrdenados = $documentos->sortByDesc('updated_at')->take(5);
        
        foreach ($documentosOrdenados as $documento) {
            $actividad = [
                'titulo' => $this->obtenerNombreDocumento($documento->tipo),
                'descripcion' => $this->obtenerDescripcionActividad($documento),
                'tipo' => $documento->estado,
                'tiempo' => $this->calcularTiempo($documento->updated_at)
            ];
            
            $actividades[] = $actividad;
        }
        
        return $actividades;
    }

    private function obtenerNombreDocumento($tipo)
{
    $nombres = [
        'solicitud_empleo' => 'Solicitud de Empleo',
        'curriculum_vitae' => 'Curriculum Vitae',
        'acta_nacimiento' => 'Acta de Nacimiento',
        'curp_documento' => 'CURP',
        'constancia_fiscal' => 'Constancia de Situación Fiscal',
        'nss' => 'Número de Seguridad Social',
        'ine' => 'INE',
        'comprobante_domicilio' => 'Comprobante de Domicilio',
        'comprobante_estudios' => 'Comprobante de Estudios',
        'certificado_medico' => 'Certificado Médico'
    ];
    
    return $nombres[$tipo] ?? 'Documento';
}

    private function obtenerDescripcionActividad($documento)
    {
        switch ($documento->estado) {
            case 'aprobado':
                return "Documento aprobado por administrador";
            case 'rechazado':
                return $documento->observaciones_admin ?: "Documento requiere correcciones";
            case 'pendiente':
                return "Documento subido - En revisión";
            default:
                return "Documento actualizado";
        }
    }

    private function calcularTiempo($fecha)
    {
        if (!$fecha) {
            return "Recién";
        }
        
        $diferencia = now()->diffInMinutes($fecha);
        
        if ($diferencia < 1) {
            return "Recién";
        } elseif ($diferencia < 60) {
            return "Hace {$diferencia} min";
        } elseif ($diferencia < 1440) {
            $horas = floor($diferencia / 60);
            return "Hace {$horas} " . ($horas == 1 ? 'hora' : 'horas');
        } else {
            $dias = floor($diferencia / 1440);
            return "Hace {$dias} " . ($dias == 1 ? 'día' : 'días');
        }
    }


    /**
 * Ver documento en el navegador
 */
public function verDocumento($id)
{
    try {
        Log::info('=== VER DOCUMENTO ADMINISTRATIVO ===', ['id' => $id]);
        
        $user = Auth::user();
        $administrativo = Administrativo::where('user_id', $user->id)->first();
        
        if (!$administrativo) {
            return redirect()->route('administrativos.dashboard')
                ->with('error', 'No tienes un perfil de administrativo asociado.');
        }
        
        // Buscar el documento asegurando que pertenezca al administrativo
        $documento = DocumentoAdministrativo::where('id', $id)
            ->where('administrativo_id', $administrativo->id)
            ->first();
        
        if (!$documento) {
            Log::error('Documento no encontrado o no pertenece al usuario');
            return redirect()->route('administrativos.documentos')
                ->with('error', 'Documento no encontrado');
        }
        
        // Verificar que el archivo existe
        if (!Storage::disk('public')->exists($documento->ruta_archivo)) {
            Log::error('Archivo no encontrado: ' . $documento->ruta_archivo);
            return redirect()->route('administrativos.documentos')
                ->with('error', 'El archivo no existe en el servidor');
        }
        
        $rutaCompleta = Storage::disk('public')->path($documento->ruta_archivo);
        
        return response()->file($rutaCompleta, [
            'Content-Type' => $documento->mime_type,
            'Content-Disposition' => 'inline; filename="' . $documento->nombre_archivo . '"'
        ]);
        
    } catch (\Exception $e) {
        Log::error('Error al ver documento: ' . $e->getMessage());
        return redirect()->route('administrativos.documentos')
            ->with('error', 'Error al ver el documento');
    }
}

/**
 * Descargar documento
 */
public function descargarDocumento($id)
{
    try {
        Log::info('=== DESCARGAR DOCUMENTO ADMINISTRATIVO ===', ['id' => $id]);
        
        $user = Auth::user();
        $administrativo = Administrativo::where('user_id', $user->id)->first();
        
        if (!$administrativo) {
            return redirect()->route('administrativos.dashboard')
                ->with('error', 'No tienes un perfil de administrativo asociado.');
        }
        
        // Buscar el documento asegurando que pertenezca al administrativo
        $documento = DocumentoAdministrativo::where('id', $id)
            ->where('administrativo_id', $administrativo->id)
            ->first();
        
        if (!$documento) {
            Log::error('Documento no encontrado o no pertenece al usuario');
            return redirect()->route('administrativos.documentos')
                ->with('error', 'Documento no encontrado');
        }
        
        // Verificar que el archivo existe
        if (!Storage::disk('public')->exists($documento->ruta_archivo)) {
            Log::error('Archivo no encontrado: ' . $documento->ruta_archivo);
            return redirect()->route('administrativos.documentos')
                ->with('error', 'El archivo no existe en el servidor');
        }
        
        // Generar nombre para descarga (más amigable)
        $nombreDescarga = $administrativo->nombre_completo . ' - ' . 
                         $this->obtenerNombreDocumento($documento->tipo) . '.pdf';
        $nombreDescarga = preg_replace('/[^a-zA-Z0-9\-_\.]/', '_', $nombreDescarga);
        
        return Storage::disk('public')->download(
            $documento->ruta_archivo, 
            $nombreDescarga
        );
        
    } catch (\Exception $e) {
        Log::error('Error al descargar documento: ' . $e->getMessage());
        return redirect()->route('administrativos.documentos')
            ->with('error', 'Error al descargar el documento');
    }
}
}