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
            $tiposDocumentos = [
                'identificacion_oficial' => [
                    'nombre' => 'Identificación Oficial',
                    'icono' => 'id-card',
                    'descripcion' => 'INE, Pasaporte o Cédula Profesional vigente'
                ],
                'comprobante_domicilio' => [
                    'nombre' => 'Comprobante de Domicilio',
                    'icono' => 'home',
                    'descripcion' => 'Recibo de luz, agua, teléfono o predial (últimos 3 meses)'
                ],
                'curriculum' => [
                    'nombre' => 'Currículum Vitae',
                    'icono' => 'file-alt',
                    'descripcion' => 'Hoja de vida actualizada con fotografía'
                ],
                'acta_nacimiento' => [
                    'nombre' => 'Acta de Nacimiento',
                    'icono' => 'file',
                    'descripcion' => 'Acta de nacimiento certificada'
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
    public function guardarPerfil(Request $request)
    {
        try {
            Log::info('=== GUARDAR PERFIL ADMINISTRATIVO ===');
            
            $user = Auth::user();

            // Verificar si ya existe perfil
            $perfilExistente = Administrativo::where('user_id', $user->id)->first();

            if ($perfilExistente) {
                return redirect()->route('administrativos.dashboard')
                    ->with('info', 'Ya tienes un perfil registrado.');
            }

            // Validación
            $validated = $request->validate([
                // Información Personal
                'nombres' => 'required|string|max:100',
                'apellido_paterno' => 'required|string|max:50',
                'apellido_materno' => 'nullable|string|max:50',
                'fecha_nacimiento' => 'required|date|before:today',
                'curp' => 'required|string|size:18|unique:administrativos,curp|regex:/^[A-Z0-9]{18}$/',
                'rfc' => 'required|string|size:13|unique:administrativos,rfc|regex:/^[A-Z0-9]{13}$/',
                'telefono' => 'required|string|max:20',
                'email_personal' => 'required|email|max:100',
                'direccion' => 'required|string',
                
                // Información Laboral
                'puesto' => 'required|string|max:100',
                'fecha_ingreso' => 'required|date',
                'numero_empleado' => 'required|string|max:50|unique:administrativos,numero_empleado',
                'area_adscripcion' => 'required|string|max:100',
                'maximo_grado_estudios' => 'nullable|string|max:100',
                'escolaridad' => 'nullable|string|max:100',
                
                // Documentos (subida opcional en este paso)
                'identificacion_oficial' => 'nullable|file|mimes:pdf|max:5120',
                'comprobante_domicilio' => 'nullable|file|mimes:pdf|max:5120',
                'curriculum' => 'nullable|file|mimes:pdf|max:5120',
                'acta_nacimiento' => 'nullable|file|mimes:pdf|max:5120',
            ], [
                'curp.size' => 'La CURP debe tener exactamente 18 caracteres.',
                'curp.regex' => 'La CURP solo puede contener letras mayúsculas y números.',
                'rfc.size' => 'El RFC debe tener exactamente 13 caracteres.',
                'rfc.regex' => 'El RFC solo puede contener letras mayúsculas y números.',
                'fecha_nacimiento.before' => 'La fecha de nacimiento no puede ser futura.',
                'identificacion_oficial.max' => 'El archivo no debe ser mayor a 5MB',
                'comprobante_domicilio.max' => 'El archivo no debe ser mayor a 5MB',
                'curriculum.max' => 'El archivo no debe ser mayor a 5MB',
                'acta_nacimiento.max' => 'El archivo no debe ser mayor a 5MB',
            ]);

            Log::info('Validación pasada correctamente');

            // Crear el registro del administrativo
            $administrativo = Administrativo::create([
                'user_id' => $user->id,
                'nombres' => $validated['nombres'],
                'apellido_paterno' => $validated['apellido_paterno'],
                'apellido_materno' => $validated['apellido_materno'] ?? null,
                'fecha_nacimiento' => $validated['fecha_nacimiento'],
                'curp' => $validated['curp'],
                'rfc' => $validated['rfc'],
                'telefono' => $validated['telefono'],
                'email_personal' => $validated['email_personal'],
                'direccion' => $validated['direccion'],
                'puesto' => $validated['puesto'],
                'fecha_ingreso' => $validated['fecha_ingreso'],
                'numero_empleado' => $validated['numero_empleado'],
                'area_adscripcion' => $validated['area_adscripcion'],
                'maximo_grado_estudios' => $validated['maximo_grado_estudios'] ?? null,
                'escolaridad' => $validated['escolaridad'] ?? null,
            ]);

            Log::info('Perfil administrativo creado. ID: ' . $administrativo->id);

            // Procesar documentos si se subieron
            $documentosSubidos = [];
            $tiposDocumentos = ['identificacion_oficial', 'comprobante_domicilio', 'curriculum', 'acta_nacimiento'];
            
            foreach ($tiposDocumentos as $tipo) {
                if ($request->hasFile($tipo)) {
                    $archivo = $request->file($tipo);
                    
                    // Crear directorio si no existe
                    $directorio = "documentos_administrativos/{$administrativo->id}";
                    if (!Storage::disk('public')->exists($directorio)) {
                        Storage::disk('public')->makeDirectory($directorio);
                    }
                    
                    // Generar nombre único
                    $extension = $archivo->getClientOriginalExtension();
                    $nombreArchivo = $tipo . '_' . time() . '_' . uniqid() . '.' . $extension;
                    $ruta = $archivo->storeAs($directorio, $nombreArchivo, 'public');
                    
                    // Guardar en la tabla documentos_administrativos
                    DocumentoAdministrativo::create([
                        'administrativo_id' => $administrativo->id,
                        'tipo' => $tipo,
                        'nombre_archivo' => $archivo->getClientOriginalName(),
                        'ruta_archivo' => $ruta,
                        'mime_type' => $archivo->getMimeType(),
                        'tamanio' => $archivo->getSize(),
                        'estado' => 'pendiente',
                    ]);
                    
                    $documentosSubidos[] = $tipo;
                    Log::info("Documento {$tipo} subido correctamente");
                }
            }

            $mensaje = 'Perfil completado exitosamente.';
            if (count($documentosSubidos) > 0) {
                $mensaje .= ' Se subieron ' . count($documentosSubidos) . ' documento(s).';
            }

            return redirect()->route('administrativos.dashboard')
                ->with('success', $mensaje);

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Error de validación: ' . json_encode($e->errors()));
            return back()
                ->withErrors($e->errors())
                ->withInput()
                ->with('error', 'Por favor corrige los errores en el formulario.');
                
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
            $tiposDocumentos = [
                'identificacion_oficial' => [
                    'nombre' => 'Identificación Oficial',
                    'icono' => 'id-card',
                    'descripcion' => 'INE, Pasaporte o Cédula Profesional vigente'
                ],
                'comprobante_domicilio' => [
                    'nombre' => 'Comprobante de Domicilio',
                    'icono' => 'home',
                    'descripcion' => 'Recibo de luz, agua, teléfono o predial (últimos 3 meses)'
                ],
                'curriculum' => [
                    'nombre' => 'Currículum Vitae',
                    'icono' => 'file-alt',
                    'descripcion' => 'Hoja de vida actualizada con fotografía'
                ],
                'acta_nacimiento' => [
                    'nombre' => 'Acta de Nacimiento',
                    'icono' => 'file',
                    'descripcion' => 'Acta de nacimiento certificada'
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

            // Validación
            $validator = Validator::make($request->all(), [
                'identificacion_oficial' => 'nullable|file|mimes:pdf|max:5120',
                'comprobante_domicilio' => 'nullable|file|mimes:pdf|max:5120',
                'curriculum' => 'nullable|file|mimes:pdf|max:5120',
                'acta_nacimiento' => 'nullable|file|mimes:pdf|max:5120',
            ], [
                '*.max' => 'El archivo no debe ser mayor a 5MB',
                '*.mimes' => 'El archivo debe ser formato PDF',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput()
                    ->with('error', 'Error en la validación de archivos');
            }

            // Obtener período activo (opcional)
            $periodoActivo = Periodo::getPeriodoSubidaHabilitada();

            $documentosSubidos = 0;
            $documentosActualizados = 0;
            $tiposDocumentos = ['identificacion_oficial', 'comprobante_domicilio', 'curriculum', 'acta_nacimiento'];

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
                'telefono' => 'required|string|max:20',
                'email_personal' => 'required|email|max:100',
                'direccion' => 'required|string',
                'puesto' => 'required|string|max:100',
                'area_adscripcion' => 'required|string|max:100',
                'maximo_grado_estudios' => 'nullable|string|max:100',
                'escolaridad' => 'nullable|string|max:100',
            ]);

            $administrativo->update($validated);

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
            'identificacion_oficial' => 'Identificación Oficial',
            'comprobante_domicilio' => 'Comprobante de Domicilio',
            'curriculum' => 'Currículum Vitae',
            'acta_nacimiento' => 'Acta de Nacimiento'
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