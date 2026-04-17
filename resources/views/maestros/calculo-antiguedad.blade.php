<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cálculo de Antigüedad</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<style>
    :root {
        --primary: #0744b6ff;
        --primary-light: #eef3ff;
        --primary-dark: #053594;
        --secondary: #33CAE6;
        --accent: #28a745;
        --light-bg: #F8F9FA;
        --border-color: #E9ECEF;
        --text-muted: #6C757D;
        --text-dark: #2c3e50;
        --card-shadow: 0 15px 35px rgba(7, 68, 182, 0.08);
        --card-shadow-hover: 0 20px 40px rgba(7, 68, 182, 0.12);
        --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        --success-color: #28a745;
        --warning-color: #FFC107;
        --danger-color: #dc3545;
        --gradient-primary: linear-gradient(135deg, #0744b6 0%, #0f5ad6 100%);
        --gradient-success: linear-gradient(135deg, #28a745 0%, #34ce57 100%);
        --gradient-warning: linear-gradient(135deg, #ffc107 0%, #ffd54b 100%);
        --info-color: #17a2b8;
        --amber-color: #f39c12;
        --amber-light: #fef5e7;
    }
    
    body { 
        background: linear-gradient(135deg, #f8faff 0%, #f0f3f8 100%);
        font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
        color: var(--text-dark); 
        line-height: 1.6;
        margin: 0;
        padding: 0;
        min-height: 100vh;
    }
    
    /* ========== ESTILOS DE BARRA Y MENÚ (EXACTAMENTE IGUALES) ========== */

    /* Primera barra - Logo y título */
    .navbar-top { 
        background: white; 
        border-bottom: 1px solid var(--border-color);
        padding: 0.8rem 0;
        position: sticky;
        top: 0;
        z-index: 1000;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }

    .navbar-top.scrolled {
        padding: 0.6rem 0;
        box-shadow: 0 5px 20px rgba(15, 126, 230, 0.15);
    }

    .navbar-brand { 
        color: var(--primary) !important; 
        font-weight: 600; 
        font-size: 1.4rem;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .navbar-brand::before {
        content: "";
        display: block;
        width: 6px;
        height: 28px;
        background: var(--primary);
        border-radius: 2px;
    }

    .logo-container {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .logo-img {
        height: 50px;
        width: auto;
        object-fit: contain;
    }

    /* Segunda barra - Menú */
    .navbar-menu { 
        background: var(--primary); 
        padding: 0.7rem 0;
        position: sticky;
        top: 68px;
        z-index: 999;
    }

    .navbar-menu .navbar-toggler {
        border: 1px solid rgba(255, 255, 255, 0.3);
        padding: 0.25rem 0.5rem;
    }

    .navbar-menu .navbar-toggler-icon {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 0.8%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
    }

    .navbar-menu .nav-link {
        font-weight: 500;
        color: rgba(255, 255, 255, 0.9) !important;
        padding: 0.6rem 1.5rem !important;
        margin: 0 0.1rem;
        border-radius: 4px;
        transition: var(--transition);
        position: relative;
        font-size: 0.95rem;
    }

    .navbar-menu .nav-link:hover, 
    .navbar-menu .nav-link.active {
        color: white !important;
        background-color: rgba(255, 255, 255, 0.12);
    }

    .navbar-menu .nav-link::after {
        content: '';
        position: absolute;
        bottom: -7px;
        left: 50%;
        width: 0;
        height: 2px;
        background: white;
        transition: var(--transition);
        transform: translateX(-50%);
    }

    .navbar-menu .nav-link:hover::after, 
    .navbar-menu .nav-link.active::after {
        width: 60%;
    }

    /* Estilo para el botón de Cerrar Sesión en el menú */
    .navbar-menu .user-info-container {
        display: flex;
        align-items: center;
        margin-left: auto;
        gap: 15px;
    }

    .navbar-menu .user-info {
        display: flex;
        align-items: center;
        gap: 10px;
        color: white;
    }

    .navbar-menu .user-name {
        font-weight: 500;
        color: rgba(255, 255, 255, 0.9);
    }

    .navbar-menu .user-avatar {
        font-size: 1.3rem;
        color: rgba(255, 255, 255, 0.9);
    }

    .navbar-menu .logout-form {
        margin: 0;
    }

    .navbar-menu .logout-btn {
        background: transparent;
        border: 1px solid rgba(255, 255, 255, 0.4);
        color: rgba(255, 255, 255, 0.9);
        padding: 0.4rem 1rem;
        border-radius: 4px;
        font-weight: 500;
        transition: var(--transition);
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.9rem;
    }

    .navbar-menu .logout-btn:hover {
        background: rgba(255, 255, 255, 0.1);
        color: white;
        border-color: rgba(255, 255, 255, 0.6);
    }

    .navbar-menu .logout-btn:active {
        background: rgba(255, 255, 255, 0.2);
    }
    
    /* ========== ESTILOS REDISEÑADOS PARA EL CONTENIDO ========== */
    .container-fluid.py-4 {
        max-width: 1400px;
        margin: 0 auto;
        padding: 1.5rem 2rem !important;
    }

    /* Tarjetas principales */
    .card-modern {
        border: none;
        border-radius: 24px;
        box-shadow: var(--card-shadow);
        overflow: hidden;
        transition: var(--transition);
        background: white;
    }

    .card-modern:hover {
        box-shadow: var(--card-shadow-hover);
    }

    /* Header de tarjeta con diseño mejorado */
    .card-header-modern {
        background: white;
        padding: 1.5rem 2rem;
        border-bottom: 1px solid var(--border-color);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .card-header-modern h4 {
        color: var(--text-dark);
        font-weight: 600;
        font-size: 1.4rem;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .card-header-modern h4 i {
        color: var(--primary);
        font-size: 1.6rem;
    }

    /* Badges de estado - AHORA SIN AZUL */
    .badge-status {
        padding: 0.4rem 1.2rem;
        border-radius: 30px;
        font-weight: 500;
        font-size: 0.9rem;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
    }

    .badge-editing {
        background: var(--amber-light);
        color: #b94e0b;
        border-left: 4px solid var(--amber-color);
    }

    .badge-new {
        background: #e3fcef;
        color: #0b5e2e;
        border-left: 4px solid var(--success-color);
    }

    /* Tarjetas de información */
    .info-card {
        background: white;
        border: 1px solid var(--border-color);
        border-radius: 20px;
        padding: 1.5rem;
        height: 100%;
        transition: var(--transition);
    }

    .info-card:hover {
        border-color: var(--primary);
        box-shadow: 0 10px 25px rgba(7, 68, 182, 0.05);
    }

    .info-card-title {
        color: var(--primary);
        font-weight: 600;
        font-size: 1.1rem;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .info-card-title i {
        font-size: 1.2rem;
    }

    /* Badges de información */
    .badge-info-light {
        background: var(--primary-light);
        color: var(--primary);
        padding: 0.5rem 1rem;
        border-radius: 30px;
        font-weight: 500;
        font-size: 1rem;
    }

    .badge-warning-light {
        background: #fef5e7;
        color: #b94e0b;
        padding: 0.5rem 1rem;
        border-radius: 30px;
        font-weight: 500;
        font-size: 1rem;
    }

    /* Alertas */
    .alert-modern {
        border: none;
        border-radius: 16px;
        padding: 1rem 1.5rem;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .alert-info-modern {
        background: var(--primary-light);
        color: var(--primary-dark);
    }

    .alert-info-modern i {
        color: var(--primary);
        font-size: 1.5rem;
    }

    .alert-warning-modern {
        background: #fef5e7;
        color: #b94e0b;
        border-left: 4px solid var(--amber-color);
    }

    .alert-warning-modern i {
        color: var(--amber-color);
    }

    /* Formularios */
    .form-group-modern {
        margin-bottom: 1.2rem;
    }

    .form-label-modern {
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 0.5rem;
        display: block;
        font-size: 0.95rem;
    }

    .form-control-modern, .form-select-modern {
        border: 2px solid var(--border-color);
        border-radius: 14px;
        padding: 0.7rem 1.2rem;
        font-size: 0.95rem;
        transition: var(--transition);
        background: white;
        width: 100%;
    }

    .form-control-modern:focus, .form-select-modern:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 4px rgba(7, 68, 182, 0.1);
        outline: none;
    }

    .form-text-modern {
        color: var(--text-muted);
        font-size: 0.85rem;
        margin-top: 0.25rem;
    }

    /* Botones */
    .btn-modern {
        padding: 0.7rem 1.8rem;
        font-weight: 500;
        border-radius: 14px;
        transition: var(--transition);
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        font-size: 0.95rem;
    }

    .btn-primary-modern {
        background: var(--gradient-primary);
        color: white;
        box-shadow: 0 8px 16px rgba(7, 68, 182, 0.15);
    }

    .btn-primary-modern:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 24px rgba(7, 68, 182, 0.25);
    }

    .btn-secondary-modern {
        background: white;
        color: var(--text-muted);
        border: 2px solid var(--border-color);
    }

    .btn-secondary-modern:hover {
        background: var(--light-bg);
        color: var(--text-dark);
        border-color: var(--text-muted);
    }

    .btn-success-modern {
        background: linear-gradient(135deg, #28a745 0%, #34ce57 100%);
        color: white;
    }

    .btn-success-modern:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 16px rgba(40, 167, 69, 0.25);
    }

    /* CALENDARIO */
    #calendario-periodos {
        max-height: 500px;
        overflow-y: auto;
        padding-right: 10px;
    }

    #calendario-periodos::-webkit-scrollbar {
        width: 6px;
    }

    #calendario-periodos::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }

    #calendario-periodos::-webkit-scrollbar-thumb {
        background: var(--primary);
        border-radius: 10px;
    }

    .periodo-card {
        background: white;
        border: 1px solid var(--border-color) !important;
        border-radius: 20px !important;
        transition: var(--transition);
        margin-bottom: 1rem;
    }

    .periodo-card:hover {
        border-color: var(--primary) !important;
        box-shadow: 0 8px 20px rgba(7, 68, 182, 0.08);
    }

    .periodo-card h6 {
        color: var(--primary);
        font-weight: 600;
        font-size: 1.1rem;
    }

    /* Meses */
    .mes-calendario {
        font-size: 0.75rem;
        padding: 0.3rem 0 !important;
        text-align: center;
        border-radius: 10px !important;
        transition: var(--transition);
        font-weight: 500;
        background: white;
        border: 1px solid var(--border-color);
    }

    .mes-calendario[data-disponible="true"] {
        cursor: pointer;
    }

    .mes-calendario[data-disponible="true"]:hover:not([style*="background-color"]) {
        background: rgba(7, 68, 182, 0.05) !important;
        border-color: var(--primary);
        transform: translateY(-2px);
    }

    .mes-calendario[data-disponible="false"] {
        background: #f8f9fa;
        color: #adb5bd;
        border-color: #dee2e6;
        cursor: not-allowed;
        opacity: 0.7;
    }

    .mes-calendario.seleccionado {
        background-color: var(--primary) !important;
        color: white !important;
        border-color: var(--primary) !important;
        box-shadow: 0 4px 8px rgba(7, 68, 182, 0.2);
    }

    /* Checkbox personalizado */
    .form-check-input-modern {
        width: 1.2rem;
        height: 1.2rem;
        border: 2px solid var(--border-color);
        border-radius: 6px;
        cursor: pointer;
    }

    .form-check-input-modern:checked {
        background-color: var(--primary);
        border-color: var(--primary);
    }

    .form-check-label-modern {
        color: var(--text-muted);
        font-size: 0.85rem;
        cursor: pointer;
    }

    /* Resumen de selección */
    .resumen-card {
        background: var(--light-bg);
        border-radius: 16px;
        padding: 1.2rem;
    }

    .resumen-title {
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .resumen-content {
        font-size: 0.95rem;
    }

    .badge-resumen {
        background: var(--primary);
        color: white;
        padding: 0.3rem 0.8rem;
        border-radius: 20px;
        font-size: 0.8rem;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .container-fluid.py-4 {
            padding: 1rem !important;
        }
        
        .card-header-modern {
            padding: 1.2rem;
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }
        
        .mes-calendario {
            font-size: 0.65rem;
        }
        
        .col-1 {
            width: 20%;
            flex: 0 0 auto;
        }
    }
</style>
<body>
    <!-- Primera barra - Logo y título (EXACTAMENTE IGUAL) -->
    <nav class="navbar navbar-expand-lg navbar-top">
        <div class="container">
            <div class="logo-container">
                <img src="{{ asset('img/logo_iufim.png') }}" alt="Logo" class="logo-img">
                <a class="navbar-brand" href="{{ route('dashboard') }}">
                    Sistema GEPROC
                </a>
            </div>
        </div>
    </nav>
    
    <!-- Segunda barra - Menú con información de usuario y cerrar sesión (EXACTAMENTE IGUAL) -->
    <nav class="navbar navbar-expand-lg navbar-menu">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('coordinaciones.*') ? 'active' : '' }}" href="{{ route('coordinaciones.index') }}">Coordinaciones</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('maestros.*') ? 'active' : '' }}" href="{{ route('maestros.index') }}">Maestros</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('contratos.*') ? 'active' : '' }}" href="{{ route('contracts.index') }}">Contratos</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('contratos.*') ? 'active' : '' }}" href="{{ route('users.index') }}">Accesos</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.administrativos.*') ? 'active' : '' }}"href="{{ route('admin.administrativos.index') }}">Administrativos</a></ul>
                </ul>
                
                <!-- Información de usuario y cerrar sesión -->
                <div class="user-info-container">
                    <div class="user-info">
                        <span class="user-name">{{ Auth::user()->name }}</span>
                        <div class="user-avatar">
                            <i class="fas fa-user-circle"></i>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" class="logout-form">
                        @csrf
                        <button type="submit" class="logout-btn">
                            <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>
    
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <!-- Tarjeta principal con diseño mejorado -->
                <div class="card-modern">
                    <!-- Header con badge de estado NO AZUL -->
                    <div class="card-header-modern">
                        <h4>
                            <i class="fas fa-calendar-alt"></i>
                            Cálculo de Antigüedad - {{ $maestro->nombres }} {{ $maestro->apellido_paterno }} {{ $maestro->apellido_materno }}
                        </h4>
                        
                        @if(isset($periodoEditar) && $periodoEditar)
                            <span class="badge-status badge-editing">
                                <i class="fas fa-edit"></i> Editando: {{ $periodoEditar->nombre }}
                            </span>
                        @else
                            <span class="badge-status badge-new">
                                <i class="fas fa-plus-circle"></i> Nuevo Registro
                            </span>
                        @endif
                    </div>
                    
                    <div class="card-body p-4">
                        <!-- Información del Maestro - CON AÑO DE INGRESO EDITABLE -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="info-card">
                                    <h6 class="info-card-title">
                                        <i class="fas fa-chalkboard-teacher"></i>
                                        Información del Maestro
                                    </h6>
                                    
                                    <!-- AÑO DE INGRESO - AHORA EDITABLE DIRECTAMENTE -->
                                    <div class="mb-3">
                                        <label class="form-label-modern">Año de Ingreso</label>
                                        <div class="d-flex align-items-center gap-2">
                                            @if($maestro->anio_ingreso)
                                                <span class="badge-info-light">
                                                    <i class="fas fa-calendar-check me-1"></i>
                                                    {{ $maestro->anio_ingreso }}
                                                </span>
                                                <button type="button" class="btn btn-sm btn-outline-primary" onclick="habilitarEdicionAnio()">
                                                    <i class="fas fa-pen"></i>
                                                </button>
                                            @else
                                                <span class="badge-warning-light">
                                                    <i class="fas fa-exclamation-triangle me-1"></i>
                                                    No registrado
                                                </span>
                                                <button type="button" class="btn btn-sm btn-primary" onclick="habilitarEdicionAnio()">
                                                    <i class="fas fa-plus"></i> Registrar
                                                </button>
                                            @endif
                                        </div>
                                        
                                        <!-- Formulario oculto para editar año de ingreso -->
                                        <div id="form-editar-anio" style="display: none;" class="mt-2">
                                            <div class="input-group">
                                                <input type="number" 
                                                       id="anio_ingreso_input" 
                                                       class="form-control-modern" 
                                                       value="{{ $maestro->anio_ingreso ?? '' }}"
                                                       min="1950" 
                                                       max="{{ date('Y') }}"
                                                       placeholder="Ingrese año">
                                                <button class="btn btn-success-modern" type="button" onclick="guardarAnioIngreso()">
                                                    <i class="fas fa-save"></i>
                                                </button>
                                                <button class="btn btn-secondary-modern" type="button" onclick="cancelarEdicionAnio()">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                            <small class="form-text-modern">Año en que el docente comenzó a laborar</small>
                                        </div>
                                    </div>
                                    
                                    <p class="mb-0"><strong>Coordinación:</strong> {{ $maestro->coordinacion->nombre ?? 'No asignada' }}</p>
                                </div>
                            </div>
                            
                            @if(isset($periodoEditar) && $periodoEditar)
                            <div class="col-md-6">
                                <div class="alert-modern alert-info-modern h-100">
                                    <i class="fas fa-info-circle"></i>
                                    <div>
                                        <strong>Modo edición activado</strong>
                                        <p class="mb-0 mt-1">Estás editando el período <strong>{{ $periodoEditar->nombre }}</strong>. Los cambios que realices actualizarán este período específico.</p>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>

                        <!-- Formulario para registrar año de ingreso si no existe (VERSIÓN ORIGINAL MANTENIDA) -->
                        @if(!$maestro->anio_ingreso)
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="alert-modern alert-warning-modern">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    <div>
                                        <strong>Registrar Año de Ingreso</strong>
                                        <p class="mb-0 mt-1">El maestro no tiene registrado un año de ingreso. Por favor, ingréselo para continuar con el cálculo de antigüedad.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Formulario principal (solo visible si tiene año de ingreso) -->
                        @if($maestro->anio_ingreso)
                        <form action="{{ route('maestros.calcular-antiguedad.guardar', $maestro) }}" method="POST" id="form-antiguedad">
                            @csrf
                            
                            <!-- Selección de Periodo Actual -->
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="form-group-modern">
                                        <label for="periodo_actual" class="form-label-modern">
                                            <i class="fas fa-clock text-primary me-1"></i>
                                            Periodo a calcular:
                                        </label>
                                        <select name="periodo_actual" id="periodo_actual" class="form-select-modern" required>
                                            <option value="">Seleccione el periodo</option>
                                            @foreach($periodos as $periodo)
                                                <option value="{{ $periodo->id }}" 
                                                        data-nombre="{{ $periodo->nombre }}"
                                                        {{ isset($periodoEditar) && $periodoEditar->id == $periodo->id ? 'selected' : '' }}>
                                                    {{ $periodo->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <small class="form-text-modern" id="periodo-info">
                                            @if(isset($periodoEditar) && $periodoEditar)
                                                <i class="fas fa-edit me-1"></i> Editando período: {{ $periodoEditar->nombre }}
                                            @else
                                                <i class="fas fa-info-circle me-1"></i> Seleccione un período para comenzar
                                            @endif
                                        </small>
                                    </div>
                                </div>
                            </div>

                            <!-- Calendario de Periodos (se muestra dinámicamente) -->
                            <div class="row mb-4" id="calendario-container" style="{{ isset($periodoEditar) && $periodoEditar ? 'display: block;' : 'display: none;' }}">
                                <div class="col-12">
                                    <div class="card-modern">
                                        <div class="card-header-modern" style="background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);">
                                            <h5 class="mb-0 text-white">
                                                <i class="fas fa-calendar-check me-2"></i>
                                                Selección de Meses Trabajados
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            <h6 class="fw-bold mb-3" id="titulo-calendario">
                                                @if(isset($periodoEditar) && $periodoEditar)
                                                    <i class="fas fa-edit text-warning me-2"></i>
                                                    Editando meses para el período {{ $periodoEditar->nombre }}
                                                @else
                                                    <i class="fas fa-hand-pointer text-primary me-2"></i>
                                                    Seleccione los meses trabajados
                                                @endif
                                            </h6>
                                            
                                            <div id="calendario-periodos">
                                                <!-- Aquí se cargarán los años dinámicamente -->
                                            </div>

                                            <!-- Resumen de selección -->
                                            <div class="mt-4 resumen-card">
                                                <h6 class="resumen-title">
                                                    <i class="fas fa-chart-pie text-primary"></i>
                                                    Resumen de Selección:
                                                </h6>
                                                <div id="resumen-seleccion" class="resumen-content">
                                                    <p class="text-muted mb-0">No hay meses seleccionados</p>
                                                </div>
                                                <input type="hidden" name="periodos_meses" id="periodos_meses" 
                                                       value='{{ isset($datosPrecargados) && !empty($datosPrecargados) ? json_encode($datosPrecargados) : "{}" }}'>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('maestros.historial-antiguedad', $maestro) }}" class="btn btn-secondary-modern btn-modern">
                                    <i class="fas fa-times"></i>
                                    Cancelar
                                </a>
                                <button type="submit" class="btn btn-primary-modern btn-modern">
                                    <i class="fas fa-save"></i>
                                    {{ isset($periodoEditar) && $periodoEditar ? 'Actualizar Antigüedad' : 'Guardar Antigüedad' }}
                                </button>
                            </div>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Funciones para editar año de ingreso
        function habilitarEdicionAnio() {
            document.getElementById('form-editar-anio').style.display = 'block';
        }

        function cancelarEdicionAnio() {
            document.getElementById('form-editar-anio').style.display = 'none';
        }

        function guardarAnioIngreso() {
            const anioIngreso = document.getElementById('anio_ingreso_input').value;
            
            if (!anioIngreso) {
                alert('Por favor ingrese el año de ingreso');
                return;
            }

            const formData = new FormData();
            formData.append('anio_ingreso', anioIngreso);
            formData.append('_token', '{{ csrf_token() }}');

            fetch('{{ route("maestros.actualizar-anio-ingreso", $maestro->id) }}', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert('Error al guardar el año de ingreso');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al guardar el año de ingreso');
            });
        }

        // Script original del calendario (sin modificar)
        document.addEventListener('DOMContentLoaded', function() {
            let seleccionMeses = {};
            const anioIngreso = {{ $maestro->anio_ingreso ?? 0 }};
            
            @if(isset($datosPrecargados) && !empty($datosPrecargados))
                seleccionMeses = @json($datosPrecargados);
                console.log('📂 Datos precargados para edición:', seleccionMeses);
            @endif
            
            const periodoActualSelect = document.getElementById('periodo_actual');
            const periodoInfo = document.getElementById('periodo-info');
            const calendarioContainer = document.getElementById('calendario-container');
            const calendarioPeriodos = document.getElementById('calendario-periodos');
            const tituloCalendario = document.getElementById('titulo-calendario');
            const periodosMesesInput = document.getElementById('periodos_meses');

            const periodosConfig = {
                @foreach($periodos as $periodo)
                '{{ $periodo->id }}': {
                    nombre: '{{ $periodo->nombre }}',
                    anio: extraerAnioDePeriodo('{{ $periodo->nombre }}'),
                    mesesDisponibles: obtenerMesesDisponibles('{{ $periodo->nombre }}')
                },
                @endforeach
            };

            function extraerAnioDePeriodo(nombrePeriodo) {
                const match = nombrePeriodo.match(/(\d{4})/);
                return match ? parseInt(match[1]) : new Date().getFullYear();
            }

            function obtenerMesesDisponibles(nombrePeriodo) {
                const nombre = nombrePeriodo.toLowerCase();
                
                if (nombre.includes('enero') || nombre.includes('primer') || nombre.includes('1') || nombre.includes('ene') || nombre.includes('jun')) {
                    return [1, 2, 3, 4, 5, 6];
                } else if (nombre.includes('agosto') || nombre.includes('segundo') || nombre.includes('2') || nombre.includes('jul') || nombre.includes('dic')) {
                    return [7, 8, 9, 10, 11, 12];
                } else if (nombre.includes('anual') || nombre.includes('completo')) {
                    return [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
                } else {
                    return [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
                }
            }

            periodoActualSelect.addEventListener('change', function() {
                const periodoId = this.value;
                
                if (periodoId && anioIngreso) {
                    const config = periodosConfig[periodoId];
                    if (config) {
                        periodoInfo.innerHTML = `<i class="fas fa-check-circle text-success me-1"></i> Periodo seleccionado: ${config.nombre}`;
                        tituloCalendario.innerHTML = `<i class="fas fa-hand-pointer text-primary me-2"></i> Seleccione los meses trabajados para el período ${config.nombre}`;
                        
                        generarCalendario(anioIngreso, config.anio, config.mesesDisponibles);
                        calendarioContainer.style.display = 'block';
                    }
                } else {
                    calendarioContainer.style.display = 'none';
                    periodoInfo.innerHTML = `<i class="fas fa-info-circle me-1"></i> Seleccione un período para comenzar`;
                }
            });

            function generarCalendario(anioInicio, anioFin, mesesDisponiblesUltimoAnio) {
                calendarioPeriodos.innerHTML = '';
                
                @if(!isset($periodoEditar))
                    seleccionMeses = {};
                @endif
                
                const aniosDesdeIngreso = [];
                for (let year = anioInicio; year <= anioFin; year++) {
                    aniosDesdeIngreso.push(year);
                    if (!seleccionMeses[year]) {
                        seleccionMeses[year] = [];
                    }
                }

                aniosDesdeIngreso.forEach(anio => {
                    const esUltimoAnio = anio === anioFin;
                    const mesesParaEsteAnio = esUltimoAnio ? mesesDisponiblesUltimoAnio : [1,2,3,4,5,6,7,8,9,10,11,12];
                    
                    const periodoCard = document.createElement('div');
                    periodoCard.className = 'periodo-card p-3 border mb-3';
                    
                    periodoCard.innerHTML = `
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h6 class="mb-0">${anio}</h6>
                            <div class="form-check">
                                <input class="form-check-input-modern selector-anio" 
                                       type="checkbox" 
                                       id="anio_${anio}"
                                       data-anio="${anio}">
                                <label class="form-check-label-modern" for="anio_${anio}">
                                    Seleccionar todos los meses ${esUltimoAnio ? 'disponibles' : ''}
                                </label>
                            </div>
                        </div>
                        <div class="row g-1">
                            ${generarMeses(anio, mesesParaEsteAnio, esUltimoAnio)}
                        </div>
                    `;
                    
                    calendarioPeriodos.appendChild(periodoCard);
                });

                asignarEventosMeses();
                
                @if(isset($datosPrecargados) && !empty($datosPrecargados))
                    marcarMesesPrecargados();
                @endif
                
                actualizarResumen();
                actualizarInputHidden();
            }

            function marcarMesesPrecargados() {
                Object.keys(seleccionMeses).forEach(anio => {
                    const meses = seleccionMeses[anio];
                    meses.forEach(mesNum => {
                        const mesElement = document.querySelector(`.mes-calendario[data-anio="${anio}"][data-mes="${mesNum}"]`);
                        if (mesElement && mesElement.dataset.disponible === 'true') {
                            mesElement.style.backgroundColor = '#0744b6';
                            mesElement.style.color = 'white';
                            mesElement.classList.add('seleccionado');
                        }
                    });
                });
            }

            function generarMeses(anio, mesesDisponibles, esUltimoAnio) {
                const meses = [
                    [1, 'Ene'], [2, 'Feb'], [3, 'Mar'], [4, 'Abr'],
                    [5, 'May'], [6, 'Jun'], [7, 'Jul'], [8, 'Ago'],
                    [9, 'Sep'], [10, 'Oct'], [11, 'Nov'], [12, 'Dic']
                ];

                return meses.map(([numero, nombre]) => {
                    const estaDisponible = mesesDisponibles.includes(numero);
                    const estaSeleccionado = seleccionMeses[anio] && seleccionMeses[anio].includes(numero);
                    
                    const estilo = !estaDisponible && esUltimoAnio ? 
                        'background-color: #f8f9fa; color: #6c757d; cursor: not-allowed;' : 
                        (estaSeleccionado ? 'background-color: #0744b6; color: white;' : 'cursor: pointer;');
                    
                    return `
                        <div class="col-1 px-1">
                            <div class="mes-calendario border rounded p-2 text-center ${estaSeleccionado ? 'seleccionado' : ''}" 
                                 data-anio="${anio}"
                                 data-mes="${numero}"
                                 data-disponible="${estaDisponible}"
                                 style="${estilo}">
                                ${nombre}
                            </div>
                        </div>
                    `;
                }).join('');
            }

            function asignarEventosMeses() {
                document.querySelectorAll('.mes-calendario').forEach(mes => {
                    mes.addEventListener('click', function() {
                        const disponible = this.dataset.disponible === 'true';
                        const anio = this.dataset.anio;
                        const mesNum = parseInt(this.dataset.mes);
                        
                        if (!disponible) return;
                        
                        const index = seleccionMeses[anio].indexOf(mesNum);
                        
                        if (index === -1) {
                            seleccionMeses[anio].push(mesNum);
                            this.style.backgroundColor = '#0744b6';
                            this.style.color = 'white';
                            this.classList.add('seleccionado');
                        } else {
                            seleccionMeses[anio].splice(index, 1);
                            this.style.backgroundColor = '';
                            this.style.color = '';
                            this.classList.remove('seleccionado');
                        }
                        
                        actualizarResumen();
                        actualizarInputHidden();
                    });
                });

                document.querySelectorAll('.selector-anio').forEach(selector => {
                    const anio = selector.dataset.anio;
                    const mesesAnio = document.querySelectorAll(`.mes-calendario[data-anio="${anio}"][data-disponible="true"]`);
                    const mesesSeleccionados = seleccionMeses[anio] ? seleccionMeses[anio].length : 0;
                    const totalMesesDisponibles = Array.from(mesesAnio).length;
                    
                    if (mesesSeleccionados === totalMesesDisponibles && totalMesesDisponibles > 0) {
                        selector.checked = true;
                    }

                    selector.addEventListener('change', function() {
                        const anio = this.dataset.anio;
                        const meses = document.querySelectorAll(`.mes-calendario[data-anio="${anio}"]`);
                        
                        if (this.checked) {
                            const mesesDisponibles = Array.from(meses)
                                .filter(mes => mes.dataset.disponible === 'true')
                                .map(mes => parseInt(mes.dataset.mes));
                            
                            seleccionMeses[anio] = [...mesesDisponibles];
                            meses.forEach(mes => {
                                if (mes.dataset.disponible === 'true') {
                                    mes.style.backgroundColor = '#0744b6';
                                    mes.style.color = 'white';
                                    mes.classList.add('seleccionado');
                                }
                            });
                        } else {
                            seleccionMeses[anio] = [];
                            meses.forEach(mes => {
                                mes.style.backgroundColor = '';
                                mes.style.color = '';
                                mes.classList.remove('seleccionado');
                            });
                        }
                        
                        actualizarResumen();
                        actualizarInputHidden();
                    });
                });
            }

            function actualizarResumen() {
                const resumen = document.getElementById('resumen-seleccion');
                let html = '';
                let totalMeses = 0;
                
                Object.keys(seleccionMeses).forEach(anio => {
                    if (seleccionMeses[anio].length > 0) {
                        totalMeses += seleccionMeses[anio].length;
                        html += `<div class="mb-2 p-2 bg-white rounded">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <strong class="text-primary">${anio}:</strong>
                                        <span class="badge-resumen">${seleccionMeses[anio].length} meses</span>
                                    </div>
                                    <small class="text-muted d-block mt-1">${seleccionMeses[anio].sort((a,b) => a-b).join(' · ')}</small>
                                </div>`;
                    }
                });
                
                if (totalMeses === 0) {
                    html = '<p class="text-muted mb-0 text-center py-3"><i class="fas fa-inbox fa-2x mb-2 d-block"></i>No hay meses seleccionados</p>';
                } else {
                    html = `<div class="mb-3 p-2 bg-white rounded border-start border-4 border-success">
                                <div class="d-flex justify-content-between align-items-center">
                                    <strong>Total:</strong>
                                    <span class="badge bg-success">${totalMeses} meses</span>
                                </div>
                            </div>` + html;
                }
                
                resumen.innerHTML = html;
            }

            function actualizarInputHidden() {
                document.getElementById('periodos_meses').value = JSON.stringify(seleccionMeses);
            }

            @if(isset($periodoEditar) && $periodoEditar)
                setTimeout(function() {
                    const event = new Event('change');
                    periodoActualSelect.dispatchEvent(event);
                }, 100);
            @endif

            const formAntiguedad = document.getElementById('form-antiguedad');
            if (formAntiguedad) {
                formAntiguedad.addEventListener('submit', function(e) {
                    const periodoActual = document.getElementById('periodo_actual').value;
                    const totalMeses = Object.values(seleccionMeses).flat().length;
                    
                    if (!periodoActual) {
                        e.preventDefault();
                        alert('Por favor seleccione el periodo');
                        return;
                    }
                    
                    if (totalMeses === 0) {
                        e.preventDefault();
                        alert('Por favor seleccione al menos un mes trabajado');
                        return;
                    }
                });
            }
        });
    </script>
</body>
</html>