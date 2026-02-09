<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MaestroController;
use App\Http\Controllers\CoordinacionController;
use App\Http\Controllers\GradoAcademicoController;
use App\Http\Controllers\DocumentoMaestroController;
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\PeriodoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContratoIAController;
use App\Http\Controllers\ContractController;



// ==================== RUTAS PÚBLICAS ====================

// Inicio
Route::get('/', function () {
    return view('inicio');
})->name('inicio');

// Ruta de diagnóstico rápido
Route::get('/diagnostico-coordinacion', function() {
    return view('dashboard.diagnostico-rapido');
})->name('diagnostico.coordinacion');


// Rutas para el ROL de coordinación
Route::get('/coordinacion/dashboard', [CoordinacionController::class, 'dashboard'])
    ->name('coordinacion.dashboard')
    ->middleware('auth');

Route::get('/coordinacion/maestros', [CoordinacionController::class, 'maestros'])
    ->name('coordinaciones.maestros')
    ->middleware('auth');
Route::get('/coordinacion/maestros-detalle', [CoordinacionController::class, 'maestrosDetalle'])
     ->name('coordinaciones.maestros-detalle');
    
// Autenticación
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Recuperación de contraseña
Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

// Documentos públicos (ver y descargar)
Route::get('/documentos/{id}/ver', [DocumentoMaestroController::class, 'verDocumento'])
    ->name('documentos.ver');
Route::get('/documentos/{id}/descargar', [DocumentoMaestroController::class, 'descargar'])
    ->name('documentos.descargar');

// Redirección maestros.index
Route::get('/maestros.index', function () {
    return redirect()->route('maestros.index');
});

// ==================== RUTAS PARA TODOS LOS AUTENTICADOS ====================
Route::middleware(['auth'])->group(function () {
    
    // ===== DASHBOARD Y REDIRECCIONES =====
    Route::get('/dashboard', function () {
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('login');
        }
        
        switch($user->role) {
            case 'admin':
                return redirect()->route('dashboard.admin');
            case 'profesor':
            case 'maestro':
                return redirect()->route('maestro.dashboard');
            case 'coordinacion':
                return redirect()->route('dashboard.coordinacion');
            default:
                abort(403, 'Rol no autorizado');
        }
    })->name('dashboard');
    
    Route::get('/dashboard/admin', function () {
        return view('dashboard.admin');
    })->name('dashboard.admin')->middleware('admin');
    
    Route::get('/dashboard/profesor', function () {
        return view('dashboard.profesor');
    })->name('dashboard.profesor');
    
    Route::get('/dashboard/coordinacion', function () {
        $user = Auth::user();
        $coordinacion = $user->coordinacion;
        
        return view('dashboard.coordinacion', compact('coordinacion'));
    })->name('dashboard.coordinacion');
    
    // ===== RUTAS PARA AUTHCONTROLLER =====
    // (Ya definidas en públicas)
    
    // ===== RUTAS PARA COORDINACIONCONTROLLER =====
    Route::get('/coordinaciones/{id}', [CoordinacionController::class, 'show'])
        ->name('coordinaciones.show')
        ->middleware('admin');

    Route::get('/coordinaciones/{coordinacion}/estadisticas', [CoordinacionController::class, 'estadisticas'])
        ->name('coordinaciones.estadisticas')
        ->middleware('admin');
    
    Route::put('/coordinaciones/{coordinacion}/maestros/{maestro}/status', 
        [CoordinacionController::class, 'updateMaestroStatus'])
        ->name('coordinaciones.maestros.status')
        ->middleware('admin');
    
    Route::resource('coordinaciones', CoordinacionController::class)->middleware('admin');


        ///////////////////// DASHBOARD DE ROL PROFESOR
Route::get('/profesor/dashboard', [MaestroController::class, 'dashboard'])
    ->name('profesor.dashboard');
    // Vista separada de documentos
    Route::get('/documentos', [MaestroController::class, 'documentos'])->name('profesor.documentos');
        
        // ✅ NUEVAS RUTAS PARA ACTUALIZAR PERFIL
    Route::get('/mi-perfil/editar', [MaestroController::class, 'editarMiPerfil'])
        ->name('editar-mi-perfil');
    Route::post('/mi-perfil/actualizar', [MaestroController::class, 'actualizarMiPerfil'])
        ->name('actualizar-mi-perfil');


        // ===== RUTAS PARA MAESTROCONTROLLER =====
    Route::prefix('profesor')->group(function () {
        Route::get('/completar-perfil', [MaestroController::class, 'mostrarFormularioPerfil'])
             ->name('profesor.completar-perfil');
        
        Route::post('/guardar-perfil', [MaestroController::class, 'guardarPerfilProfesor'])
             ->name('profesor.guardar-perfil');
        
        Route::get('/dashboard', [MaestroController::class, 'dashboard'])
             ->name('profesor.dashboard');
        
        Route::get('/mi-perfil', [MaestroController::class, 'miPerfil'])
             ->name('profesor.mi-perfil');
        
        Route::get('/mi-antiguedad', [MaestroController::class, 'miAntiguedad'])
             ->name('profesor.mi-antiguedad');
    });
    
    Route::get('/profesor/mi-perfil', function () {
        return view('profesor.perfil');
    })->name('profesor.mi-perfil');

// SUBIR DOCUMENTOS (desde el dashboard del profesor)
Route::post('/profesor/subir-documentos', [MaestroController::class, 'subirDocumentos'])
    ->name('profesor.subir-documentos');
    
    // ===== RUTAS PARA DOCUMENTOMAESTROCONTROLLER =====
    Route::get('/mis-documentos', [DocumentoMaestroController::class, 'mostrarDocumentos'])
        ->name('maestro.mis-documentos');
    
   
    Route::get('/maestro/dashboard', [DocumentoMaestroController::class, 'dashboardMaestro'])
        ->name('maestro.dashboard');
    
    Route::get('/coordinaciones/{coordinacionId}/revision-documentos/{maestroId}', 
        [DocumentoMaestroController::class, 'revisionDocumentos'])
        ->name('maestros.revision-documentos');
    
    Route::get('/coordinaciones/{id}/estado-documentos', [DocumentoMaestroController::class, 'estadoDocumentosPorCoordinacion'])
        ->name('coordinaciones.estado-documentos');
    
    Route::get('/coordinaciones/{coordinacionId}/historial-documentos/{maestroId}', 
        [DocumentoMaestroController::class, 'historialDocumentos'])
        ->name('maestros.historial-documentos')
        ->middleware('admin');

    // Ruta 2: Desde maestro individual (NUEVA)
Route::get('maestros/{maestroId}/historial-documentos', 
    [DocumentoMaestroController::class, 'historialDocumentosDesdeMaestro'])
    ->name('maestros.historial-documentos-desde-maestro');
    
    Route::post('/documentos/{id}/observaciones', [DocumentoMaestroController::class, 'updateObservaciones'])
        ->name('documentos.update-observaciones');
    
    Route::post('/documentos/{id}/aprobar', [DocumentoMaestroController::class, 'aprobar'])
        ->name('documentos.aprobar');
    
    Route::post('/documentos/{id}/rechazar', [DocumentoMaestroController::class, 'rechazar'])
        ->name('documentos.rechazar');
    
    Route::post('/documentos/{id}/pendiente', [DocumentoMaestroController::class, 'pendiente'])
        ->name('documentos.pendiente');
    
    Route::post('/documentos/{id}/resubir', [DocumentoMaestroController::class, 'resubirDocumento'])
        ->name('documentos.resubir');
    
    Route::delete('/documentos/{documentoId}', [DocumentoMaestroController::class, 'eliminarDocumento'])
        ->name('documentos.eliminar')
        ->middleware('admin');
    
    Route::get('/documentos/{documento}/ver', [DocumentoMaestroController::class, 'verDocumento'])
        ->name('documentos.ver');
    
    Route::get('/documentos/{documento}/descargar', [DocumentoMaestroController::class, 'descargarDocumento'])
        ->name('documentos.descargar');

        //////////////////////////////////////////////===== =====


    // ===== RUTAS PARA GRADOACADEMICOCONTROLLER =====
    Route::get('/grados-academicos/create/{maestro_id}', [GradoAcademicoController::class, 'create'])
        ->name('grados-academicos.create');
    
    Route::post('/grados-academicos/store', [GradoAcademicoController::class, 'store'])
        ->name('grados-academicos.store');
    
    Route::get('/grados-academicos/edit/{id}', [GradoAcademicoController::class, 'edit'])
        ->name('grados-academicos.edit');
    
    Route::delete('/grados-academicos/destroy/{id}', [GradoAcademicoController::class, 'destroy'])
        ->name('grados-academicos.destroy');
    
    Route::get('/grados-academicos/{id}/documento', [GradoAcademicoController::class, 'showDocument'])
        ->name('grados-academicos.show-document');
    // ===== RUTAS PARA GRADOACADEMICOCONTROLLER MAESTROS =====
         // Rutas para maestros - grados académicos
Route::middleware(['auth'])->group(function () {
    Route::prefix('maestro')->name('maestros.')->group(function () {
        // Grados académicos
        Route::get('/grados', [GradoAcademicoController::class, 'indexMaestro'])->name('grados.index');
        Route::get('/grados/create', [GradoAcademicoController::class, 'createMaestro'])->name('grados.create');
        Route::post('/grados', [GradoAcademicoController::class, 'store'])->name('grados.store');
        Route::get('/grados/{id}/edit', [GradoAcademicoController::class, 'editMaestro'])->name('grados.edit');
        Route::put('/grados/{id}', [GradoAcademicoController::class, 'update'])->name('grados.update');
        Route::delete('/grados/{id}', [GradoAcademicoController::class, 'destroyMaestro'])->name('grados.destroy');
        Route::get('/grados/{id}/download', [GradoAcademicoController::class, 'download'])->name('grados.download');
        Route::get('/grados/{id}/show', [GradoAcademicoController::class, 'showDocument'])->name('grados.show');
    });
    // RUTAS PARA GRADOS ACADÉMICOS
Route::resource('grados-academicos', GradoAcademicoController::class)->except(['index', 'show']);
Route::get('grados-academicos/{id}/download', [GradoAcademicoController::class, 'download'])->name('grados-academicos.download');
Route::get('grados-academicos/{id}/show-document', [GradoAcademicoController::class, 'showDocument'])->name('grados-academicos.show-document');
});

    // ===== =====================================================

    // ===== RUTAS PARA HORARIO CONTROLLER =====
    Route::get('/horarios', [HorarioController::class, 'index'])->name('horarios.index');
    
    Route::get('/horarios/maestro/{maestroId}/formulario', [HorarioController::class, 'mostrarFormulario'])
        ->name('horarios.formulario');
    
    Route::post('/horarios/guardar', [HorarioController::class, 'guardarHorario'])
        ->name('horarios.guardar');
    
    Route::get('/horarios/maestro/{maestroId}/{periodoId?}', [HorarioController::class, 'verHorario'])
        ->name('horarios.ver');
    
    Route::get('/horarios/verificar/{maestroId}/{periodoId}', [HorarioController::class, 'verificarHorarios'])
        ->name('horarios.verificar');
    
    Route::post('/horarios/calcular-horas', [HorarioController::class, 'calcularHorasMaestro'])
        ->name('horarios.calcular-horas');
    
            // ===== =====================================================

    // ===== RUTAS PARA CALCULAR ANTIGUEDAD =====
    Route::get('/maestros/{maestro}/calcular-antiguedad', [MaestroController::class, 'mostrarCalculoAntiguedad'])
        ->name('maestros.calcular-antiguedad');
    
    Route::post('/maestros/{maestro}/calcular-antiguedad', [MaestroController::class, 'calcularYGuardarAntiguedad'])
        ->name('maestros.calcular-antiguedad.guardar');
    
    Route::get('/maestros/{maestro}/historial-antiguedad', [MaestroController::class, 'mostrarHistorialAntiguedad'])
        ->name('maestros.historial-antiguedad');
    
    Route::delete('/maestros/{maestro}/eliminar-periodo', [MaestroController::class, 'eliminarPeriodoMaestro'])
        ->name('maestros.eliminar-periodo');
    
    Route::post('/maestros/{maestro}/actualizar-anio-ingreso', [MaestroController::class, 'actualizarAnioIngreso'])
        ->name('maestros.actualizar-anio-ingreso');
    
    Route::post('/maestros/{maestro}/subir-documentos', [DocumentoMaestroController::class, 'subirDocumentos'])
        ->name('maestros.subir-documentos');
    
    Route::resource('maestros', MaestroController::class)->middleware('admin');


    
    // ===== RUTAS PARA PERIODOCONTROLLER =====
    Route::prefix('periodos')->group(function () {
        Route::get('/', [PeriodoController::class, 'index'])->name('periodos.index');
        
        Route::post('/{periodo}/toggle-subida', [PeriodoController::class, 'toggleSubida'])
             ->name('periodos.toggle-subida');
        
        Route::post('/generar-manualmente', [PeriodoController::class, 'generarPeriodosManualmente'])
             ->name('periodos.generar-manualmente');
        
        Route::get('/{periodo}/documentos', [PeriodoController::class, 'documentos'])
             ->name('periodos.documentos');
        
        Route::post('/{periodo}/finalizar', [PeriodoController::class, 'finalizar'])
             ->name('periodos.finalizar');
        
        Route::post('/{periodo}/reabrir', [PeriodoController::class, 'reabrir'])
             ->name('periodos.reabrir');
        
        Route::get('/{id}/documentos', [PeriodoController::class, 'documentos'])
             ->name('periodos.documentos');
    });
    


    // ===== RUTAS PARA USERCONTROLLER =====
    Route::prefix('users')->middleware(['admin'])->name('users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/', [UserController::class, 'store'])->name('store');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
        Route::put('/{user}', [UserController::class, 'update'])->name('update');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
    });

    // Rutas para Contratos - Análisis (ContratoIAController)
    Route::get('/contracts/analyze', [ContratoIAController::class, 'analyze'])->name('contracts.analyze'); // Corrección aquí
    Route::post('/contracts/analyze/process', [ContratoIAController::class, 'process'])->name('contracts.analyze.process');
    Route::post('/templates', [ContratoIAController::class, 'storeTemplate'])->name('templates.store');

    // Rutas para Contratos - CRUD (ContractController)
    Route::get('/contracts', [ContractController::class, 'index'])->name('contracts.index');
    Route::get('/contracts/create/{templateId?}', [ContractController::class, 'create'])->name('contracts.create');
    Route::post('/contracts', [ContractController::class, 'store'])->name('contracts.store');
    Route::get('/contracts/{id}', [ContractController::class, 'show'])->name('contracts.show');
    Route::get('/contracts/{id}/edit', [ContractController::class, 'edit'])->name('contracts.edit');
    Route::put('/contracts/{id}', [ContractController::class, 'update'])->name('contracts.update');
    Route::delete('/contracts/{id}', [ContractController::class, 'destroy'])->name('contracts.destroy');
    Route::get('/contracts/{id}/download/word', [ContractController::class, 'downloadWord'])->name('contracts.download.word');
    Route::get('/contracts/{id}/download/pdf', [ContractController::class, 'downloadPdf'])->name('contracts.download.pdf');
    Route::get('/contracts/{id}/preview/pdf', [ContractController::class, 'previewPdf'])->name('contracts.preview.pdf');
    
    // Editar nombre de plantilla
    Route::get('/templates/{id}/edit', [ContractController::class, 'editTemplate'])->name('templates.edit');
    Route::put('/templates/{id}', [ContractController::class, 'updateTemplate'])->name('templates.update');
    Route::delete('/templates/{template}', [ContractController::class, 'destroyTemplate'])->name('templates.destroy');

    // preview PDF para la vista/iframe (genera PDF desde DOCX si hace falta)
    Route::get('/contracts/{id}/preview/pdf', [App\Http\Controllers\ContractController::class, 'previewPdf'])
    ->name('contracts.preview.pdf');

    // preview DOCX para que Mammoth lo descargue desde el navegador (same-origin)
    Route::get('/contracts/{id}/preview/docx', [App\Http\Controllers\ContractController::class, 'previewDocx'])
    ->name('contracts.preview.docx');




});

// ==================== RUTAS CON PARÁMETROS (fuera del grupo auth) ====================
Route::prefix('maestros')->group(function () {
    Route::get('/{maestro}/documentos', [DocumentoMaestroController::class, 'mostrarDocumentos'])
        ->name('maestros.documentos');
    
    Route::get('/{maestroId}/documentos/json', [DocumentoMaestroController::class, 'mostrarDocumentosJson'])
        ->name('maestros.documentos.json');

});