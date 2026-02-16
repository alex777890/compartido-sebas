<?php

namespace App\Http\Controllers;

use App\Models\Maestro;
use App\Models\Periodo;
use App\Models\Coordinacion;
use App\Models\DocumentoMaestro; // ✅ AGREGAR ESTE
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator; // ✅ AGREGAR ESTE
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB; // ✅ AGREGAR ESTE

class MaestroController extends Controller
{
    public function index(Request $request)
{
    \Log::info('=== MAESTROS INDEX ===');
    \Log::info('Request params:', $request->all());
    
    // ✅ USAR coordinaciones_id (CON 's')
    $coordinacionId = $request->input('coordinaciones_id', 'all');
    
    \Log::info('Coordinacion ID from request: ' . $coordinacionId);
    
    $query = Maestro::with(['coordinacion', 'gradosAcademicos']);
    
    \Log::info('Before filter - Query count: ' . $query->count());
    
    if ($coordinacionId !== 'all') {
        \Log::info('Applying filter for coordinacion_id: ' . $coordinacionId);
        $query->where('coordinaciones_id', $coordinacionId);
        \Log::info('After filter - Query count: ' . $query->count());
    }
    
    if ($request->has('search') && !empty($request->search)) {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('nombres', 'LIKE', "%{$search}%")
              ->orWhere('apellido_paterno', 'LIKE', "%{$search}%")
              ->orWhere('apellido_materno', 'LIKE', "%{$search}%")
              ->orWhere('email', 'LIKE', "%{$search}%");
        });
    }
    
    $maestros = $query->paginate(12)->appends([
        'coordinaciones_id' => $coordinacionId,
        'search' => $request->search
    ]);
    
    $coordinaciones = Coordinacion::all();
    
    \Log::info('Coordinaciones count: ' . $coordinaciones->count());
    \Log::info('Maestros count after query: ' . $maestros->count());
    
    // ✅ VERIFICAR SI HAY MAESTROS EN ESA COORDINACIÓN
    if ($coordinacionId !== 'all') {
        $maestrosEnCoordinacion = Maestro::where('coordinaciones_id', $coordinacionId)->count();
        \Log::info('Maestros en coordinacion ' . $coordinacionId . ': ' . $maestrosEnCoordinacion);
    }
    
    return view('maestros.index', compact('maestros', 'coordinaciones', 'coordinacionId'));
}
    
    public function create()
    {
        $coordinaciones = Coordinacion::all();
        return view('maestros.create', compact('coordinaciones'));
    }

    public function store(Request $request)
    {
        // ✅ CORREGIDO: Cambiar validación de 'coordinacion_id' a 'coordinaciones_id'
        $validated = $request->validate([
            'coordinaciones_id' => 'required|exists:coordinaciones,id', // ← CAMBIADO
            'nombres' => 'required|string|max:100',
            'apellido_paterno' => 'required|string|max:50',
            'apellido_materno' => 'nullable|string|max:50',
            'maximo_grado_academico' => 'required|in:Licenciatura,Especialidad,Maestría,Doctorado',
            'fecha_nacimiento' => 'required|date|before:today',
            'edad' => 'required|integer|min:18|max:100',
            'sexo' => 'nullable|in:Masculino,Femenino,Otro',
            'estado_civil' => 'nullable|in:Soltero,Casado,Divorciado,Viudo,Unión Libre',
            'telefono' => 'nullable|string|max:15',
            'email' => 'required|email|unique:maestros,email',
            'direccion' => 'nullable|string|max:255',
            'rfc' => 'required|string|size:13|unique:maestros,rfc|regex:/^[A-Z0-9]{13}$/',
            'curp' => 'required|string|size:18|unique:maestros,curp|regex:/^[A-Z0-9]{18}$/',
        ], [
            'coordinaciones_id.required' => 'La coordinación es obligatoria.', // ← CAMBIADO
            'coordinaciones_id.exists' => 'La coordinación seleccionada no existe.', // ← CAMBIADO
            'fecha_nacimiento.before' => 'La fecha de nacimiento no puede ser futura.',
            'edad.min' => 'La edad mínima debe ser 18 años.',
            'edad.max' => 'La edad máxima no puede exceder 100 años.',
            'rfc.size' => 'El RFC debe tener exactamente 13 caracteres.',
            'rfc.regex' => 'El RFC solo puede contener letras mayúsculas y números.',
            'curp.size' => 'La CURP debe tener exactamente 18 caracteres.',
            'curp.regex' => 'La CURP solo puede contener letras mayúsculas y números.',
        ]);

        $maestro = Maestro::create($validated);

        return redirect()->route('maestros.show', $maestro->id)
                         ->with('success', 'Maestro creado exitosamente. Ahora puedes agregar sus grados académicos.');
    }
    
    public function show($id, Request $request)
    {
        try {
            $maestro = Maestro::with([
                'coordinacion',
                'gradosAcademicos',
                'periodos'
            ])->findOrFail($id);
            
            $periodos = Periodo::all();
            $periodoSeleccionado = $request->input('periodo_id');

            // Calcular antigüedad TOTAL siempre
            $antiguedadTotal = $this->calcularAntiguedadTotal($maestro);

            return view('maestros.show', compact(
                'maestro', 
                'antiguedadTotal',
                'periodos',
                'periodoSeleccionado'
            ));
            
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('maestros.index')
                             ->with('error', 'Maestro no encontrado.');
        } catch (\Exception $e) {
            return redirect()->route('maestros.index')
                             ->with('error', 'Error al cargar el maestro: ' . $e->getMessage());
        }
    }
    
    public function edit(Maestro $maestro)
    {
        $coordinaciones = Coordinacion::all();
        return view('maestros.edit', compact('maestro', 'coordinaciones'));
    }
    
    public function update(Request $request, Maestro $maestro)
    {
        // ✅ CORREGIDO: Cambiar validación de 'coordinacion_id' a 'coordinaciones_id'
        $request->validate([
            'coordinaciones_id' => 'required|exists:coordinaciones,id', // ← CAMBIADO
            'nombres' => 'required|string|max:100',
            'apellido_paterno' => 'required|string|max:50',
            'apellido_materno' => 'nullable|string|max:50',
            'maximo_grado_academico' => 'required|in:Licenciatura,Especialidad,Maestría,Doctorado',
            'anio_ingreso' => 'nullable|integer|max:' . (date('Y') + 1),
            'fecha_nacimiento' => 'required|date',
            'edad' => 'required|integer|min:18|max:100',
            'sexo' => 'nullable|in:Masculino,Femenino,Otro',
            'estado_civil' => 'nullable|in:Soltero,Casado,Divorciado,Viudo,Unión Libre',
            'telefono' => 'nullable|string|max:15',
            'email' => 'required|email|unique:maestros,email,' . $maestro->id,
            'direccion' => 'nullable|string',
            'rfc' => 'required|string|max:13|unique:maestros,rfc,' . $maestro->id,
            'curp' => 'required|string|max:18|unique:maestros,curp,' . $maestro->id,
        ]);
        
        $maestro->update($request->all());
        
        return redirect()->route('maestros.show', $maestro->id)
                        ->with('success', 'Maestro actualizado exitosamente.');
    }
    
    public function destroy(Maestro $maestro)
    {
        $maestro->delete();
        
        return redirect()->route('maestros.index')
                        ->with('success', 'Maestro eliminado exitosamente.');
    }

    // =============================================
    // FUNCIONES CORREGIDAS PARA CÁLCULO DE ANTIGÜEDAD
    // =============================================

    public function mostrarCalculoAntiguedad(Maestro $maestro)
    {
        $periodos = Periodo::all();

        return view('maestros.calculo-antiguedad', compact(
            'maestro', 
            'periodos'
        ));
    }

    public function calcularYGuardarAntiguedad(Request $request, Maestro $maestro)
    {
        // Verificar si el maestro tiene año de ingreso
        if (!$maestro->anio_ingreso) {
            return redirect()->back()
                           ->with('error', 'El maestro no tiene año de ingreso definido. Por favor, regístrelo primero.')
                           ->withInput();
        }

        $request->validate([
            'periodo_actual' => 'required|exists:periodos,id',
            'periodos_meses' => 'required|string'
        ]);

        $periodosMeses = json_decode($request->periodos_meses, true);
        
        if (!$periodosMeses) {
            return redirect()->back()
                           ->with('error', 'No se han seleccionado periodos válidos.')
                           ->withInput();
        }

        $periodo = Periodo::find($request->periodo_actual);
        $anioPeriodo = $this->extraerAnioDePeriodo($periodo->nombre);

        // ELIMINAR registros anteriores del MISMO periodo actual para evitar duplicados
        $maestro->periodos()
                ->wherePivot('periodo_id', $request->periodo_actual)
                ->detach();

        // Procesar cada año y sus meses (SOLO los seleccionados en el formulario)
        $totalMesesSeleccionados = 0;
        foreach ($periodosMeses as $anio => $meses) {
            if (count($meses) > 0) {
                // Guardar en la relación maestro_periodo
                $maestro->periodos()->attach($request->periodo_actual, [
                    'meses_trabajados' => json_encode($meses),
                    'total_meses' => count($meses),
                    'anio_periodo' => $anio
                ]);
                
                $totalMesesSeleccionados += count($meses);
            }
        }

        // Calcular antigüedad SOLO de los periodos seleccionados
        $antiguedad = $this->calcularAntiguedadSeleccionada($periodosMeses);

        // Obtener los meses trabajados del último año procesado
        $ultimoAnio = max(array_keys($periodosMeses));
        $mesesTrabajados = $periodosMeses[$ultimoAnio] ?? [];

        // Redirigir a la vista de resultado
        return view('maestros.resultado-antiguedad', compact(
            'maestro', 
            'antiguedad',
            'anioPeriodo',
            'mesesTrabajados',
            'periodo',
            'totalMesesSeleccionados'
        ));
    }

    /**
     * MÉTODO NUEVO: Extrae el año del nombre del periodo
     */
    private function extraerAnioDePeriodo($nombrePeriodo)
    {
        preg_match('/(\d{4})/', $nombrePeriodo, $matches);
        return isset($matches[1]) ? (int)$matches[1] : date('Y');
    }

    /**
     * NUEVO MÉTODO: Calcula antigüedad SOLO de los periodos seleccionados
     */
    private function calcularAntiguedadSeleccionada($periodosMeses)
    {
        $totalMesesTrabajados = 0;
        $detallePeriodos = [];

        foreach ($periodosMeses as $anio => $meses) {
            $mesesCount = count($meses);
            
            if ($mesesCount > 0) {
                $totalMesesTrabajados += $mesesCount;
                
                $detallePeriodos[] = [
                    'anio' => $anio,
                    'meses' => $meses,
                    'total_meses' => $mesesCount,
                    'meses_nombres' => $this->convertirMesesANombres($meses)
                ];
            }
        }

        // Calcular años y meses basado SOLO en meses seleccionados
        $aniosTotales = floor($totalMesesTrabajados / 12);
        $mesesRestantes = $totalMesesTrabajados % 12;

        return [
            'total_meses_trabajados' => $totalMesesTrabajados,
            'anios' => $aniosTotales,
            'meses' => $mesesRestantes,
            'total_meses' => $totalMesesTrabajados,
            'detalle_periodos' => $detallePeriodos
        ];
    }

    /**
     * MÉTODO EXISTENTE: Calcular antigüedad total (para mostrar en otras vistas)
     */
    private function calcularAntiguedadTotal($maestro)
    {
        $anioIngreso = $maestro->anio_ingreso;

        if (!$anioIngreso) {
            return [
                'error' => 'No se ha definido el año de ingreso',
                'anios' => 0,
                'meses' => 0,
                'total_meses' => 0
            ];
        }

        // Sumar SOLO los meses trabajados registrados en periodos
        $totalMesesTrabajados = 0;
        $detallePeriodos = [];

        foreach ($maestro->periodos as $periodo) {
            $mesesPeriodo = json_decode($periodo->pivot->meses_trabajados, true) ?? [];
            $mesesCount = count($mesesPeriodo);
            
            $totalMesesTrabajados += $mesesCount;
            
            $detallePeriodos[] = [
                'periodo' => $periodo->nombre,
                'anio' => $periodo->pivot->anio_periodo,
                'meses' => $mesesPeriodo,
                'total_meses' => $mesesCount,
                'meses_nombres' => $this->convertirMesesANombres($mesesPeriodo)
            ];
        }

        // Calcular años y meses basado SOLO en meses trabajados
        $aniosTotales = floor($totalMesesTrabajados / 12);
        $mesesRestantes = $totalMesesTrabajados % 12;

        return [
            'anio_ingreso' => $anioIngreso,
            'anio_actual' => date('Y'),
            'total_meses_trabajados' => $totalMesesTrabajados,
            'anios' => $aniosTotales,
            'meses' => $mesesRestantes,
            'total_meses' => $totalMesesTrabajados,
            'detalle_periodos' => $detallePeriodos
        ];
    }

    /**
     * MÉTODO EXISTENTE: Convertir números de meses a nombres
     */
    private function convertirMesesANombres($mesesNumeros)
    {
        $meses = [
            1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
            5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
            9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
        ];

        $nombres = [];
        foreach ($mesesNumeros as $mes) {
            if (isset($meses[$mes])) {
                $nombres[] = $meses[$mes];
            }
        }

        return $nombres;
    }

    public function mostrarHistorialAntiguedad(Maestro $maestro)
    {
        $antiguedad = $this->calcularAntiguedadTotal($maestro);
        $periodosTrabajados = $maestro->periodos()
            ->orderBy('pivot_anio_periodo', 'desc')
            ->orderBy('periodos.id', 'desc')
            ->get();

        return view('maestros.historial-antiguedad', compact(
            'maestro',
            'antiguedad',
            'periodosTrabajados'
        ));
    }

    public function eliminarPeriodoMaestro(Request $request, Maestro $maestro)
    {
        $request->validate([
            'periodo_id' => 'required|exists:periodos,id',
            'anio_periodo' => 'required|integer'
        ]);

        $maestro->periodos()
                ->wherePivot('periodo_id', $request->periodo_id)
                ->wherePivot('anio_periodo', $request->anio_periodo)
                ->detach();

        return redirect()->route('maestros.historial-antiguedad', $maestro->id)
                         ->with('success', 'Periodo eliminado correctamente.');
    }

    public function actualizarAnioIngreso(Request $request, Maestro $maestro)
    {
        $request->validate([
            'anio_ingreso' => 'required|integer|min:1950|max:' . date('Y')
        ]);

        try {
            $maestro->update([
                'anio_ingreso' => $request->anio_ingreso
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Año de ingreso actualizado correctamente'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el año de ingreso'
            ], 500);
        }
    }

    // =============================================
    // FUNCIONES NUEVAS PARA EL DASHBOARD DEL PROFESOR
    // =============================================
    public function mostrarFormularioPerfil()
    {
        try {
            \Log::info('=== MOSTRAR FORMULARIO PERFIL ===');
            \Log::info('User ID: ' . auth()->id());
            \Log::info('User Email: ' . auth()->user()->email);

            // Verificar si ya tiene perfil
            $maestroExistente = Maestro::where('user_id', auth()->id())
                ->orWhere('email', auth()->user()->email)
                ->first();

            if ($maestroExistente) {
                \Log::info('Perfil ya existe. Redirigiendo a dashboard');
                return redirect()->route('profesor.dashboard')
                    ->with('info', 'Ya tienes un perfil completado.');
            }

            $coordinaciones = Coordinacion::all();
            
            return view('dashboard.profesor', compact('coordinaciones'));
            
        } catch (\Exception $e) {
            \Log::error('Error en mostrarFormularioPerfil: ' . $e->getMessage());
            $coordinaciones = Coordinacion::all();
            return view('dashboard.profesor', compact('coordinaciones'))
                ->with('error', 'Error al cargar formulario: ' . $e->getMessage());
        }
    }

    /**
     * Guardar perfil del profesor - VERSIÓN COMPLETAMENTE CORREGIDA
     */
    public function guardarPerfilProfesor(Request $request)
    {
        try {
            \Log::info('=== INICIO GUARDAR PERFIL PROFESOR ===');
            \Log::info('Datos recibidos:', $request->all());
            \Log::info('User ID: ' . auth()->id());
            \Log::info('User Email: ' . auth()->user()->email);

            // Verificar si ya existe perfil
            $perfilExistente = Maestro::where('user_id', auth()->id())
                ->orWhere('email', auth()->user()->email)
                ->first();

            if ($perfilExistente) {
                \Log::warning('Usuario ya tiene perfil. ID: ' . $perfilExistente->id);
                return redirect()->route('profesor.dashboard')
                    ->with('info', 'Ya tienes un perfil registrado.');
            }

            // ✅ CORREGIDO: Cambiar validación de 'coordinacion_id' a 'coordinaciones_id'
            $validated = $request->validate([
                'coordinaciones_id' => 'required|exists:coordinaciones,id', // ← CAMBIADO
                'nombres' => 'required|string|max:100',
                'apellido_paterno' => 'required|string|max:50',
                'apellido_materno' => 'nullable|string|max:50',
                'maximo_grado_academico' => 'required|in:Licenciatura,Especialidad,Maestría,Doctorado',
                'fecha_nacimiento' => 'required|date|before:today',
                'edad' => 'required|integer|min:18|max:100',
                'sexo' => 'nullable|in:Masculino,Femenino',
                'estado_civil' => 'nullable|in:Soltero,Casado,Divorciado,Viudo',
                'telefono' => 'nullable|string|max:15',
                'email' => 'required|email|unique:maestros,email',
                'direccion' => 'nullable|string|max:255',
                'rfc' => 'required|string|size:13|unique:maestros,rfc|regex:/^[A-Z0-9]{13}$/',
                'curp' => 'required|string|size:18|unique:maestros,curp|regex:/^[A-Z0-9]{18}$/',
            ], [
                'coordinaciones_id.required' => 'La coordinación es obligatoria.', // ← CAMBIADO
                'coordinaciones_id.exists' => 'La coordinación seleccionada no existe.', // ← CAMBIADO
                'email.unique' => 'Este correo ya está registrado en el sistema.',
                'rfc.unique' => 'Este RFC ya está registrado.',
                'curp.unique' => 'Esta CURP ya está registrada.',
            ]);

            \Log::info('Validación pasada correctamente');

            // Ya no necesitas mapear porque usamos el mismo nombre
            $maestroData = [
                'coordinaciones_id' => $validated['coordinaciones_id'],
                'nombres' => $validated['nombres'],
                'apellido_paterno' => $validated['apellido_paterno'],
                'apellido_materno' => $validated['apellido_materno'] ?? null,
                'maximo_grado_academico' => $validated['maximo_grado_academico'],
                'anio_ingreso' => $validated['anio_ingreso'] ?? null,
                'fecha_nacimiento' => $validated['fecha_nacimiento'],
                'edad' => $validated['edad'],
                'sexo' => $validated['sexo'] ?? null,
                'estado_civil' => $validated['estado_civil'] ?? null,
                'telefono' => $validated['telefono'] ?? null,
                'email' => $validated['email'],
                'direccion' => $validated['direccion'] ?? null,
                'rfc' => $validated['rfc'],
                'curp' => $validated['curp'],
                'user_id' => auth()->id(),
            ];
            
            \Log::info('Datos preparados para BD:', $maestroData);
            
            $maestro = Maestro::create($maestroData);

            \Log::info('Perfil creado exitosamente. ID: ' . $maestro->id);
            \Log::info('Redirigiendo a dashboard del profesor...');
            
            return redirect()->route('profesor.dashboard')
                ->with('success', '¡Perfil completado exitosamente! Bienvenido al sistema.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Error de validación: ' . json_encode($e->errors()));
            return back()
                ->withErrors($e->errors())
                ->withInput()
                ->with('error', 'Por favor corrige los errores en el formulario.');
                
        } catch (\Exception $e) {
            \Log::error('ERROR en guardarPerfilProfesor: ' . $e->getMessage());
            \Log::error('Trace: ' . $e->getTraceAsString());
            return back()
                ->withInput()
                ->with('error', 'Error al guardar el perfil: ' . $e->getMessage());
        }
    }

    /**
 * ✅ NUEVO MÉTODO: Mostrar formulario para actualizar datos personales del maestro
 */
public function editarMiPerfil()
{
    try {
        \Log::info('=== EDITAR MI PERFIL - MAESTRO ===');
        
        // Buscar maestro
        $maestro = Maestro::where('user_id', auth()->id())
            ->orWhere('email', auth()->user()->email)
            ->first();

        if (!$maestro) {
            return redirect()->route('profesor.completar-perfil')
                ->with('error', 'No tienes un perfil registrado.');
        }

        $coordinaciones = Coordinacion::all();
        
        return view('dashboard.editar-mi-perfil', compact('maestro', 'coordinaciones'));
        
    } catch (\Exception $e) {
        \Log::error('Error en editarMiPerfil: ' . $e->getMessage());
        return redirect()->route('profesor.mi-perfil')
            ->with('error', 'Error al cargar formulario: ' . $e->getMessage());
    }
}

/**
 * ✅ NUEVO MÉTODO: Actualizar datos personales del maestro
 */
public function actualizarMiPerfil(Request $request)
{
    try {
        \Log::info('=== ACTUALIZAR MI PERFIL - MAESTRO ===');
        \Log::info('Datos recibidos:', $request->all());
        
        // Buscar maestro
        $maestro = Maestro::where('user_id', auth()->id())
            ->orWhere('email', auth()->user()->email)
            ->first();

        if (!$maestro) {
            return redirect()->route('profesor.completar-perfil')
                ->with('error', 'No tienes un perfil registrado.');
        }

        // ✅ Validación de datos
        $validated = $request->validate([
            'nombres' => 'required|string|max:100',
            'apellido_paterno' => 'required|string|max:50',
            'apellido_materno' => 'nullable|string|max:50',
            'fecha_nacimiento' => 'required|date|before:today',
            'edad' => 'required|integer|min:18|max:100',
            'sexo' => 'nullable|in:Masculino,Femenino,Otro',
            'estado_civil' => 'nullable|in:Soltero,Casado,Divorciado,Viudo,Unión Libre',
            'telefono' => 'nullable|string|max:15',
            'direccion' => 'nullable|string|max:255',
            // Los siguientes campos no se pueden cambiar desde el panel del maestro
            // 'email' => 'required|email|unique:maestros,email,' . $maestro->id,
            // 'rfc' => 'required|string|size:13|unique:maestros,rfc,' . $maestro->id,
            // 'curp' => 'required|string|size:18|unique:maestros,curp,' . $maestro->id,
            // 'maximo_grado_academico' => 'required|in:Licenciatura,Especialidad,Maestría,Doctorado',
            // 'coordinaciones_id' => 'required|exists:coordinaciones,id',
        ], [
            'fecha_nacimiento.before' => 'La fecha de nacimiento no puede ser futura.',
            'edad.min' => 'La edad mínima debe ser 18 años.',
            'edad.max' => 'La edad máxima no puede exceder 100 años.',
        ]);

        \Log::info('Validación pasada correctamente');

        // ✅ Actualizar solo los campos permitidos
        $maestro->update([
            'nombres' => $validated['nombres'],
            'apellido_paterno' => $validated['apellido_paterno'],
            'apellido_materno' => $validated['apellido_materno'] ?? null,
            'fecha_nacimiento' => $validated['fecha_nacimiento'],
            'edad' => $validated['edad'],
            'sexo' => $validated['sexo'] ?? null,
            'estado_civil' => $validated['estado_civil'] ?? null,
            'telefono' => $validated['telefono'] ?? null,
            'direccion' => $validated['direccion'] ?? null,
        ]);

        \Log::info('Perfil actualizado exitosamente. ID: ' . $maestro->id);
        
        return redirect()->route('dashboard.editar-mi-perfil')
            ->with('success', '¡Tus datos personales han sido actualizados exitosamente!');

    } catch (\Illuminate\Validation\ValidationException $e) {
        \Log::error('Error de validación: ' . json_encode($e->errors()));
        return back()
            ->withErrors($e->errors())
            ->withInput()
            ->with('error', 'Por favor corrige los errores en el formulario.');
            
    } catch (\Exception $e) {
        \Log::error('ERROR en actualizarMiPerfil: ' . $e->getMessage());
        \Log::error('Trace: ' . $e->getTraceAsString());
        return back()
            ->withInput()
            ->with('error', 'Error al actualizar el perfil: ' . $e->getMessage());
    }
}



    //////////////////
public function dashboard()
{
    try {
        \Log::info('=== DASHBOARD PROFESOR - VERSIÓN COMPLETA ===');
        \Log::info('Usuario autenticado: ' . auth()->user()->email);

        // Buscar maestro
        $maestro = Maestro::where('user_id', auth()->id())
            ->orWhere('email', auth()->user()->email)
            ->with(['documentos.revisadoPor', 'coordinacion', 'periodos'])
            ->first();

        if (!$maestro) {
            return redirect()->route('profesor.completar-perfil')
                ->with('info', 'Por favor, completa tu perfil primero.');
        }

        // **✅ CORRECCIÓN: USAR EL MÉTODO getPeriodoSubidaHabilitada()**
        $periodoSubida = Periodo::getPeriodoSubidaHabilitada();
        $hayPeriodoHabilitado = false;
        $nombrePeriodo = 'No hay período habilitado';
        
        if ($periodoSubida) {
            $hayPeriodoHabilitado = true;
            $nombrePeriodo = $periodoSubida->nombre;
            $periodoHabilitado = $periodoSubida;
            \Log::info("✅ PERÍODO HABILITADO: {$periodoSubida->nombre} (ID: {$periodoSubida->id})");
        } else {
            // Crear un objeto dummy para el período
            $periodoHabilitado = (object) [
                'id' => null,
                'nombre' => 'No hay período activo',
                'activo' => 0,
                'estado' => 'inactivo'
            ];
            \Log::warning("⚠️ NO SE ENCONTRÓ PERÍODO ACTIVO");
        }

        // **✅ SI NO HAY PERÍODO: MOSTRAR SOLO PERFIL**
        if (!$hayPeriodoHabilitado) {
            \Log::info("🔴 NO HAY PERÍODO - Mostrando solo perfil");
            
            $maestroData = $maestro;
            $estadisticas = [
                'total_requeridos' => 0,
                'total_subidos' => 0,
                'aprobados' => 0,
                'rechazados' => 0,
                'pendientes' => 0,
                'porcentaje' => 0,
                'faltantes' => 0,
                'completo' => false
            ];
            $faltantes = 0;
            
            return view('dashboard.profesor-dashboard', [
                'maestro' => $maestro,
                'maestroData' => $maestroData,
                'tiposDocumentos' => [],
                'estadisticas' => $estadisticas,
                'documentosParaVista' => [],
                'documentosRechazados' => collect([]),
                'documentosAprobados' => collect([]),
                'documentosPendientes' => collect([]),
                'periodoHabilitado' => $periodoHabilitado,
                'actividadesRecientes' => [],
                'hayPeriodoHabilitado' => $hayPeriodoHabilitado,
                'nombrePeriodo' => $nombrePeriodo,
                'faltantes' => $faltantes
            ]);
        }

        // **✅ SI HAY PERÍODO: CARGAR DOCUMENTOS SOLO DE ESE PERÍODO**
        $coordinacionId = $maestro->coordinaciones_id ?? 1;
        
        // Tipos de documentos por coordinación
        $tiposBase = [
            'cst' => ['nombre' => 'Constancia de Situación Fiscal (CST)', 'icono' => 'file-contract'],
            'iufim' => ['nombre' => 'Documento IUFIM', 'icono' => 'file-invoice'],
            'comprobante_domicilio' => ['nombre' => 'Comprobante de Domicilio', 'icono' => 'home'],
            'oficio_ingresos' => ['nombre' => 'Oficio de Ingresos', 'icono' => 'money-bill-wave'],
            'declaracion_anual' => ['nombre' => 'Declaración Anual', 'icono' => 'file-alt'],
            'comprobante_seguro_social' => ['nombre' => 'Comprobante de Seguro Social', 'icono' => 'shield-alt'],
            'curriculum' => ['nombre' => 'Curriculum Vitae', 'icono' => 'file-alt'],
            'cedula_profesional' => ['nombre' => 'Cédula Profesional', 'icono' => 'id-card'],
            'titulo' => ['nombre' => 'Título Profesional', 'icono' => 'graduation-cap'],
        ];
        
        $documentosPorCoordinacion = [
            1 => ['cst', 'iufim', 'comprobante_domicilio', 'curriculum', 'cedula_profesional', 'titulo'],
            2 => ['cst', 'iufim', 'oficio_ingresos', 'declaracion_anual', 'curriculum', 'cedula_profesional'],
            3 => ['cst', 'iufim', 'comprobante_seguro_social', 'comprobante_domicilio', 'curriculum', 'titulo'],
            4 => ['cst', 'iufim', 'comprobante_domicilio', 'curriculum', 'cedula_profesional'],
            5 => ['cst', 'iufim', 'oficio_ingresos', 'curriculum', 'titulo'],
            6 => ['cst', 'iufim', 'comprobante_seguro_social', 'curriculum', 'cedula_profesional'],
            7 => ['cst', 'iufim', 'comprobante_domicilio', 'curriculum', 'cedula_profesional', 'titulo'],
        ];
        
        $tiposPermitidos = $documentosPorCoordinacion[$coordinacionId] ?? [
            'cst', 'iufim', 'comprobante_domicilio', 
            'curriculum', 'cedula_profesional', 'titulo'
        ];
        
        $tiposDocumentos = [];
        foreach ($tiposPermitidos as $tipo) {
            if (isset($tiposBase[$tipo])) {
                $tiposDocumentos[$tipo] = $tiposBase[$tipo];
            }
        }
        
        // **✅ CARGAR DOCUMENTOS SOLO DEL PERÍODO ACTUAL**
        $documentosDelPeriodo = $maestro->documentos()
            ->where('periodo_id', $periodoHabilitado->id)
            ->orderBy('tipo', 'asc')
            ->with('revisadoPor')
            ->get();
        
        \Log::info("📊 Documentos del período {$periodoHabilitado->nombre}: " . $documentosDelPeriodo->count());
        
        // Procesar documentos del período
        $documentosRechazados = $documentosDelPeriodo->where('estado', 'rechazado');
        $documentosAprobados = $documentosDelPeriodo->where('estado', 'aprobado');
        $documentosPendientes = $documentosDelPeriodo->where('estado', 'pendiente');
        
        $documentosSubidos = [];
        foreach ($documentosDelPeriodo as $documento) {
            $documentosSubidos[$documento->tipo] = $documento;
        }
        
        // Crear lista de documentos para vista
        $documentosParaVista = [];
        foreach ($tiposDocumentos as $tipo => $info) {
            $documentoInfo = [
                'tipo' => $tipo,
                'nombre' => $info['nombre'],
                'icono' => $info['icono'],
                'descripcion' => $info['descripcion'] ?? '',
                'estado' => 'faltante',
                'tiene_documento' => false,
                'documento_id' => null,
                'observaciones' => null,
                'fecha_subida' => null,
            ];
            
            if (isset($documentosSubidos[$tipo])) {
                $doc = $documentosSubidos[$tipo];
                $documentoInfo['estado'] = $doc->estado;
                $documentoInfo['tiene_documento'] = true;
                $documentoInfo['documento_id'] = $doc->id;
                $documentoInfo['observaciones'] = $doc->observaciones_admin;
                $documentoInfo['fecha_subida'] = $doc->created_at;
                $documentoInfo['archivo'] = $doc->nombre_archivo;
            }
            
            $documentosParaVista[] = $documentoInfo;
        }
        
        // **✅ CALCULAR ESTADÍSTICAS SOLO DEL PERÍODO**
        $totalRequeridos = count($tiposDocumentos);
        $totalSubidos = count($documentosSubidos);
        $faltantes = $totalRequeridos - $totalSubidos;
        $porcentaje = $totalRequeridos > 0 ? 
            round(($totalSubidos / $totalRequeridos) * 100) : 0;
        
        $estadisticas = [
            'total_requeridos' => $totalRequeridos,
            'total_subidos' => $totalSubidos,
            'aprobados' => $documentosAprobados->count(),
            'rechazados' => $documentosRechazados->count(),
            'pendientes' => $documentosPendientes->count(),
            'porcentaje' => $porcentaje,
            'faltantes' => $faltantes,
            'completo' => ($totalSubidos >= $totalRequeridos) && 
                         ($documentosRechazados->count() == 0)
        ];
        
        \Log::info("📈 Estadísticas del período: " . json_encode($estadisticas));
        
        // Actividades recientes
        $actividadesRecientes = $this->obtenerActividadesRecientes($documentosDelPeriodo);
        
        // Preparar datos
        $maestroData = $maestro;
        
        return view('dashboard.profesor-dashboard', compact(
            'maestro', 
            'maestroData',
            'tiposDocumentos',
            'estadisticas',
            'documentosParaVista',
            'documentosRechazados',
            'documentosAprobados',
            'documentosPendientes',
            'periodoHabilitado',
            'actividadesRecientes',
            'hayPeriodoHabilitado',
            'nombrePeriodo',
            'faltantes'
        ));
        
    } catch (\Exception $e) {
        \Log::error('ERROR en dashboard: ' . $e->getMessage());
        \Log::error('Trace: ' . $e->getTraceAsString());
        return redirect()->route('profesor.completar-perfil')
            ->with('error', 'Error al cargar el dashboard: ' . $e->getMessage());
    }
}
/**
 * ✅ VISTA DOCUMENTOS PROFESOR - CORREGIDA PARA 6 DOCUMENTOS FIJOS
 */
public function documentos()
{
    try {
        \Log::info('=== VISTA DOCUMENTOS PROFESOR ===');
        
        // Buscar maestro
        $maestro = Maestro::where('user_id', auth()->id())
            ->orWhere('email', auth()->user()->email)
            ->with(['documentos.revisadoPor', 'coordinacion'])
            ->first();

        if (!$maestro) {
            return redirect()->route('profesor.completar-perfil')
                ->with('info', 'Por favor, completa tu perfil primero.');
        }

        // Verificar período
        $periodoSubida = Periodo::getPeriodoSubidaHabilitada();
        $hayPeriodoHabilitado = false;
        
        if ($periodoSubida) {
            $hayPeriodoHabilitado = true;
            $periodoHabilitado = $periodoSubida;
        } else {
            $periodoHabilitado = (object) [
                'id' => null,
                'nombre' => 'No hay período activo',
                'activo' => 0,
                'estado' => 'inactivo',
                'fecha_limite' => null
            ];
        }

        // ✅ CONFIGURAR DOCUMENTOS - SOLO LOS 6 ESPECÍFICOS (SIN FILTRO POR COORDINACIÓN)
        $tiposDocumentos = [
            'cst' => [
                'nombre' => 'Constancia de Situación Fiscal (CST)', 
                'icono' => 'file-contract',
                'descripcion' => 'Documento emitido por el SAT que acredita la situación fiscal'
            ],
            'iufim' => [
                'nombre' => 'Documento IUFIM', 
                'icono' => 'file-invoice',
                'descripcion' => 'Documento oficial de la institución'
            ],
            'comprobante_domicilio' => [
                'nombre' => 'Comprobante de Domicilio', 
                'icono' => 'home',
                'descripcion' => 'Recibo de luz, agua, teléfono o predial vigente'
            ],
            'oficio_ingresos' => [
                'nombre' => 'Oficio de Ingresos', 
                'icono' => 'money-bill-wave',
                'descripcion' => 'Documento que comprueba ingresos mensuales'
            ],
            'declaracion_anual' => [
                'nombre' => 'Declaración Anual', 
                'icono' => 'file-alt',
                'descripcion' => 'Declaración fiscal anual del ejercicio anterior'
            ],
            'comprobante_seguro_social' => [
                'nombre' => 'Comprobante de Seguro Social', 
                'icono' => 'shield-alt',
                'descripcion' => 'Credencial o comprobante de afiliación al IMSS/ISSSTE'
            ]
        ];
        
        // Cargar documentos del período actual si existe
        $documentosDelPeriodo = collect([]);
        if ($hayPeriodoHabilitado) {
            $documentosDelPeriodo = $maestro->documentos()
                ->where('periodo_id', $periodoHabilitado->id)
                ->orderBy('tipo', 'asc')
                ->with('revisadoPor')
                ->get();
        }
        
        // Procesar documentos para vista
        $documentosSubidos = [];
        foreach ($documentosDelPeriodo as $documento) {
            $documentosSubidos[$documento->tipo] = $documento;
        }
        
        $documentosParaVista = [];
        foreach ($tiposDocumentos as $tipo => $info) {
            $documentoInfo = [
                'tipo' => $tipo,
                'nombre' => $info['nombre'],
                'icono' => $info['icono'],
                'descripcion' => $info['descripcion'] ?? '',
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
        
        $documentosAprobados = $documentosDelPeriodo->where('estado', 'aprobado');
        $documentosRechazados = $documentosDelPeriodo->where('estado', 'rechazado');
        $documentosPendientes = $documentosDelPeriodo->where('estado', 'pendiente');
        
        $estadisticas = [
            'total_requeridos' => $totalRequeridos,
            'total_subidos' => $totalSubidos,
            'aprobados' => $documentosAprobados->count(),
            'rechazados' => $documentosRechazados->count(),
            'pendientes' => $documentosPendientes->count(),
            'porcentaje' => $porcentaje,
            'faltantes' => $faltantes,
        ];
        
        \Log::info("✅ Documentos cargados: " . count($documentosParaVista) . " documentos");
        \Log::info("📊 Estadísticas: " . json_encode($estadisticas));
        
        return view('dashboard.profesor-documentos', compact(
            'maestro',
            'periodoHabilitado',
            'hayPeriodoHabilitado',
            'documentosParaVista',
            'estadisticas',
            'faltantes',
            'tiposDocumentos'
        ));
        
    } catch (\Exception $e) {
        \Log::error('❌ ERROR en documentos view: ' . $e->getMessage());
        \Log::error('Trace: ' . $e->getTraceAsString());
        return redirect()->route('profesor.dashboard')
            ->with('error', 'Error al cargar documentos: ' . $e->getMessage());
    }
}

/**
 * ✅ SUBIR DOCUMENTOS - CORREGIDO PARA PROCESAR LOS 6 DOCUMENTOS FIJOS
 */
public function subirDocumentos(Request $request)
{
    try {
        \Log::info('=== SUBIDA DE DOCUMENTOS ===');
        \Log::info('Usuario autenticado: ' . auth()->user()->email);
        \Log::info('Request data:', $request->all());
        \Log::info('Files:', $_FILES);

        // Buscar maestro
        $maestro = Maestro::where('user_id', auth()->id())
            ->orWhere('email', auth()->user()->email)
            ->first();

        if (!$maestro) {
            \Log::error('❌ Maestro no encontrado');
            return redirect()->route('profesor.completar-perfil')
                ->with('error', 'No tienes un perfil de maestro asociado.')
                ->withInput();
        }

        \Log::info("✅ Maestro encontrado: {$maestro->nombres}, ID: {$maestro->id}");

        // ✅ OBTENER PERÍODO HABILITADO
        $periodoSubida = Periodo::getPeriodoSubidaHabilitada();
        
        if (!$periodoSubida) {
            \Log::warning('⚠️ No hay período habilitado, buscando último período...');
            $periodoSubida = Periodo::latest()->first();
        }
        
        if (!$periodoSubida) {
            \Log::error('❌ No se encontró ningún período');
            return redirect()->back()
                ->with('error', 'No hay ningún período habilitado para subir documentos.')
                ->withInput();
        }

        \Log::info("📅 Período: {$periodoSubida->nombre} (ID: {$periodoSubida->id})");

        // ✅ TIPOS DE DOCUMENTOS FIJOS - LOS MISMOS 6 DE LA VISTA
        $tiposPermitidos = [
            'cst',
            'iufim',
            'comprobante_domicilio',
            'oficio_ingresos',
            'declaracion_anual',
            'comprobante_seguro_social'
        ];

        \Log::info("📋 Tipos de documentos permitidos: " . implode(', ', $tiposPermitidos));

        // ✅ VALIDACIÓN DE ARCHIVOS
        $reglas = [];
        foreach ($tiposPermitidos as $tipo) {
            $reglas[$tipo] = 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240';
        }
        
        $validator = Validator::make($request->all(), $reglas);

        if ($validator->fails()) {
            \Log::error('❌ Validación fallida:', $validator->errors()->toArray());
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Error en la validación de archivos');
        }

        // ✅ CONTADORES
        $documentosSubidos = 0;
        $documentosActualizados = 0;
        $documentosProcesados = [];
        $errores = [];

        DB::beginTransaction();

        try {
            foreach ($tiposPermitidos as $tipo) {
                if ($request->hasFile($tipo) && $request->file($tipo)->isValid()) {
                    $archivo = $request->file($tipo);
                    
                    \Log::info("📁 Procesando: {$tipo}");
                    \Log::info("   - Nombre original: {$archivo->getClientOriginalName()}");
                    \Log::info("   - Tamaño: " . round($archivo->getSize() / 1024, 2) . " KB");
                    \Log::info("   - MIME: {$archivo->getMimeType()}");

                    // ✅ VERIFICAR SI YA EXISTE EN ESTE PERÍODO
                    $documentoExistente = DocumentoMaestro::where('maestro_id', $maestro->id)
                        ->where('tipo', $tipo)
                        ->where('periodo_id', $periodoSubida->id)
                        ->first();

                    // ✅ CREAR DIRECTORIO SI NO EXISTE
                    $directorio = "documentos_maestros/{$maestro->id}";
                    if (!Storage::disk('public')->exists($directorio)) {
                        Storage::disk('public')->makeDirectory($directorio);
                        \Log::info("   📂 Directorio creado: {$directorio}");
                    }

                    // ✅ GENERAR NOMBRE ÚNICO
                    $extension = $archivo->getClientOriginalExtension();
                    $timestamp = time();
                    $uniqueId = uniqid();
                    $nombreArchivo = "{$tipo}_{$timestamp}_{$uniqueId}.{$extension}";
                    
                    // ✅ GUARDAR ARCHIVO
                    $path = $archivo->storeAs($directorio, $nombreArchivo, 'public');
                    
                    if (!$path) {
                        throw new \Exception("No se pudo guardar el archivo {$tipo}");
                    }

                    \Log::info("   💾 Guardado en: {$path}");

                    if ($documentoExistente) {
                        // ✅ ELIMINAR ARCHIVO ANTERIOR
                        if ($documentoExistente->ruta_archivo) {
                            $rutaAnterior = str_replace('storage/', '', $documentoExistente->ruta_archivo);
                            if (Storage::disk('public')->exists($rutaAnterior)) {
                                Storage::disk('public')->delete($rutaAnterior);
                                \Log::info("   🗑️ Archivo anterior eliminado: {$rutaAnterior}");
                            }
                        }

                        // ✅ ACTUALIZAR DOCUMENTO EXISTENTE
                        $documentoExistente->update([
                            'nombre_archivo' => $archivo->getClientOriginalName(),
                            'ruta_archivo' => $path,
                            'mime_type' => $archivo->getMimeType(),
                            'tamanio' => $archivo->getSize(),
                            'estado' => 'pendiente',
                            'fecha_revision' => null,
                            'revisado_por' => null,
                            'observaciones_admin' => null,
                            'updated_at' => now(),
                        ]);

                        $documentosActualizados++;
                        $documentosProcesados[] = "{$tipo}: Actualizado";
                        \Log::info("   ✅ {$tipo} ACTUALIZADO");
                        
                    } else {
                        // ✅ CREAR NUEVO DOCUMENTO
                        DocumentoMaestro::create([
                            'maestro_id' => $maestro->id,
                            'periodo_id' => $periodoSubida->id,
                            'tipo' => $tipo,
                            'nombre_archivo' => $archivo->getClientOriginalName(),
                            'ruta_archivo' => $path,
                            'mime_type' => $archivo->getMimeType(),
                            'tamanio' => $archivo->getSize(),
                            'estado' => 'pendiente',
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);

                        $documentosSubidos++;
                        $documentosProcesados[] = "{$tipo}: Nuevo";
                        \Log::info("   ✅ {$tipo} CREADO");
                    }
                }
            }

            DB::commit();

            // ✅ CONSTRUIR MENSAJE DE ÉXITO
            $mensaje = '';
            if ($documentosSubidos > 0 && $documentosActualizados > 0) {
                $mensaje = "✅ Se subieron {$documentosSubidos} documento(s) nuevo(s) y se actualizaron {$documentosActualizados} documento(s).";
            } elseif ($documentosSubidos > 0) {
                $mensaje = "✅ Se subieron {$documentosSubidos} documento(s) correctamente.";
            } elseif ($documentosActualizados > 0) {
                $mensaje = "✅ Se actualizaron {$documentosActualizados} documento(s) correctamente.";
            } else {
                $mensaje = "⚠️ No se seleccionaron documentos para subir.";
            }

            \Log::info("🎉 Subida completada: {$mensaje}");
            \Log::info("📋 Documentos procesados:", $documentosProcesados);

            // ✅ REDIRECCIONAR A LA VISTA DE DOCUMENTOS (NO AL DASHBOARD)
            return redirect()->route('profesor.documentos')
                ->with('success', $mensaje);

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('❌ Error en transacción: ' . $e->getMessage());
            \Log::error('Trace: ' . $e->getTraceAsString());
            
            return redirect()->back()
                ->with('error', 'Error al subir documentos: ' . $e->getMessage())
                ->withInput();
        }

    } catch (\Exception $e) {
        \Log::error('❌ ERROR CRÍTICO: ' . $e->getMessage());
        \Log::error('Trace: ' . $e->getTraceAsString());
        
        return redirect()->back()
            ->with('error', 'Error crítico al procesar la solicitud: ' . $e->getMessage())
            ->withInput();
    }
}
/**
 * ✅ **AGREGAR ESTE MÉTODO (copiado de dashboardMaestro)**
 */
private function verificarYConfigurarPeriodo()
{
    try {
        \Log::info('=== BUSCANDO PERÍODO PARA MAESTRO ===');
        
        // USAR EL NUEVO MÉTODO ESPECÍFICO
        $periodo = Periodo::getPeriodoParaMaestros();
        
        if ($periodo) {
            \Log::info("✅ MAESTRO VERÁ EL PERÍODO: {$periodo->nombre}");
            \Log::info("   Estado: {$periodo->estado}");
            \Log::info("   Subida habilitada: " . ($periodo->subida_habilitada ? 'SI' : 'NO'));
            
            // Agregar propiedad para la vista
            $periodo->activo = 1;
            return $periodo;
        }
        
        \Log::warning("⚠️ MAESTRO NO VERÁ NINGÚN PERÍODO");
        
        // Debug adicional
        $todosPeriodos = Periodo::all();
        \Log::info("Períodos en BD: " . $todosPeriodos->count());
        foreach ($todosPeriodos as $p) {
            \Log::info("   - {$p->id}: {$p->nombre} | Estado: {$p->estado} | Subida: " . ($p->subida_habilitada ? 'SI' : 'NO'));
        }
        
        return null;
        
    } catch (\Exception $e) {
        \Log::error("Error: " . $e->getMessage());
        return null;
    }
}


    private function obtenerActividadesRecientes($documentos)
    {
        $actividades = [];
        
        if (!$documentos || $documentos->isEmpty()) {
            // Si no hay documentos, mostrar actividades por defecto
            return [
                [
                    'titulo' => 'Completar perfil',
                    'descripcion' => 'Tu perfil ha sido registrado exitosamente',
                    'tipo' => 'success',
                    'tiempo' => 'Recién'
                ],
                [
                    'titulo' => 'Documentos pendientes',
                    'descripcion' => 'Sube tus documentos para completar tu registro',
                    'tipo' => 'info',
                    'tiempo' => 'Recién'
                ]
            ];
        }
        
        // Ordenar documentos por fecha de actualización
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

    /**
     * Obtener nombre amigable del documento
     */
    private function obtenerNombreDocumento($tipo)
    {
        $nombres = [
            'cst' => 'Constancia de Situación Fiscal',
            'iufim' => 'Documento IUFIM',
            'comprobante_domicilio' => 'Comprobante de Domicilio',
            'oficio_ingresos' => 'Oficio de Ingresos',
            'declaracion_anual' => 'Declaración Anual',
            'comprobante_seguro_social' => 'Seguro Social',
            'curriculum' => 'Curriculum Vitae',
            'cedula_profesional' => 'Cédula Profesional',
            'titulo' => 'Título Profesional'
        ];
        
        return $nombres[$tipo] ?? 'Documento';
    }

    /**
     * Obtener descripción según estado
     */
    private function obtenerDescripcionActividad($documento)
    {
        switch ($documento->estado) {
            case 'aprobado':
                return "Documento aprobado por administrador";
            case 'rechazado':
                return $documento->observaciones ?: "Documento requiere correcciones";
            case 'pendiente':
                return "Documento subido - En revisión";
            default:
                return "Documento actualizado";
        }
    }

    /**
     * Calcular tiempo relativo
     */
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
     * Perfil del profesor (vista personalizada para el profesor)
     */
    public function miPerfil()
    {
        try {
            \Log::info('=== MI PERFIL PROFESOR ===');
            
            $maestro = null;
            
            // Verificar si la columna user_id existe
            if (\Schema::hasColumn('maestros', 'user_id')) {
                $maestro = Maestro::where('user_id', auth()->id())->first();
            } else {
                // Método alternativo: buscar por email
                $maestro = Maestro::where('email', auth()->user()->email)->first();
            }
            
            if (!$maestro) {
                \Log::warning('No se encontró perfil para miPerfil');
                return redirect()->route('profesor.completar-perfil');
            }

            // Calcular antigüedad para el perfil del profesor
            $antiguedad = $this->calcularAntiguedadTotal($maestro);

            \Log::info('Mostrando mi perfil para: ' . $maestro->nombres);
            
            return view('dashboard.mi-perfil', compact('maestro', 'antiguedad'));
            
        } catch (\Exception $e) {
            \Log::error('Error en miPerfil: ' . $e->getMessage());
            return redirect()->route('dashboard.profesor-dashboard')
                ->with('error', 'Error al cargar el perfil: ' . $e->getMessage());
        }
    }

    /**
     * Historial de antigüedad del profesor (vista personalizada)
     */
    public function miAntiguedad()
    {
        try {
            $maestro = null;
            
            // Verificar si la columna user_id existe
            if (\Schema::hasColumn('maestros', 'user_id')) {
                $maestro = Maestro::where('user_id', auth()->id())->first();
            } else {
                // Método alternativo: buscar por email
                $maestro = Maestro::where('email', auth()->user()->email)->first();
            }
            
            if (!$maestro) {
                return redirect()->route('profesor.completar-perfil');
            }

            $antiguedad = $this->calcularAntiguedadTotal($maestro);
            $periodosTrabajados = $maestro->periodos()
                ->orderBy('pivot_anio_periodo', 'desc')
                ->orderBy('periodos.id', 'desc')
                ->get();

            return view('dashboard.mi-antiguedad', compact('maestro', 'antiguedad', 'periodosTrabajados'));
            
        } catch (\Exception $e) {
            return redirect()->route('profesor.dashboard')
                             ->with('error', 'Error al cargar el historial: ' . $e->getMessage());
        }
    }
}