<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingresar Horario - {{ $maestro->nombre_completo }}</title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    /* (Mantén todos los estilos CSS que ya tienes) */
    :root {
        --primary: #0744b6ff;
        --secondary: #33CAE6;
        --accent: #0744b6ff;
        --light-bg: #F8F9FA;
        --border-color: #E9ECEF;
        --text-muted: #6C757D;
        --card-shadow: 0 2px 8px rgba(7, 68, 182, 0.08);
        --transition: all 0.3s ease;
        --success-color: #28a745;
        --info-color: #17a2b8;
    }
    
    body { 
        background: white; 
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
        color: #333; 
        line-height: 1.6;
        font-size: 0.9rem;
    }            
    
    /* ========== ESTILOS DE BARRA Y MENÚ ========== */
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
    
    /* ========== ESTILOS COMPACTOS PARA EL CUERPO ========== */
    .container-fluid {
        padding: 1rem 0.5rem;
    }
    
    .card {
        border: none;
        box-shadow: var(--card-shadow);
        margin-bottom: 1rem;
        border-radius: 8px;
    }
    
    .card-header {
        padding: 0.75rem 1rem;
        background: linear-gradient(135deg, var(--primary) 0%, #0639a0 100%);
        color: white;
        border-bottom: none;
        border-radius: 8px 8px 0 0 !important;
    }
    
    .card-title {
        font-size: 1.1rem;
        margin-bottom: 0.25rem;
        font-weight: 600;
    }
    
    .card-subtitle {
        font-size: 0.8rem;
        opacity: 0.9;
    }
    
    .card-body {
        padding: 1rem;
    }
    
    .form-label {
        font-weight: 600;
        font-size: 0.85rem;
        margin-bottom: 0.4rem;
        color: #495057;
    }
    
    .form-control, .form-select {
        font-size: 0.85rem;
        padding: 0.5rem 0.75rem;
        border: 1px solid #ced4da;
        border-radius: 5px;
        transition: var(--transition);
    }
    
    .form-control:focus, .form-select:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 0.2rem rgba(7, 68, 182, 0.15);
    }
    
    .btn {
        font-size: 0.85rem;
        padding: 0.5rem 0.75rem;
        border-radius: 5px;
        font-weight: 500;
        transition: var(--transition);
    }
    
    .btn-agregar-materia {
        background-color: var(--primary);
        color: white;
        border: none;
    }
    
    .btn-agregar-materia:hover {
        background-color: #0639a0;
        transform: translateY(-1px);
        box-shadow: 0 3px 8px rgba(7, 68, 182, 0.2);
    }
    
    /* ========== ESTILOS MEJORADOS DE TABLA ========== */
    .table-horarios {
        font-size: 0.8rem;
        margin-bottom: 0;
        border-collapse: separate;
        border-spacing: 0;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }
    
    .table-horarios th {
        background: linear-gradient(135deg, var(--primary) 0%, #0639a0 100%);
        color: white;
        font-weight: 600;
        padding: 0.6rem 0.5rem;
        text-align: center;
        border: none;
        position: relative;
    }
    
    .table-horarios th:not(:last-child)::after {
        content: '';
        position: absolute;
        right: 0;
        top: 20%;
        height: 60%;
        width: 1px;
        background: rgba(255, 255, 255, 0.2);
    }
    
    .table-horarios td {
        padding: 0.5rem;
        vertical-align: middle;
        cursor: pointer;
        transition: var(--transition);
        border: 1px solid #e9ecef;
        text-align: center;
    }
    
    .hora-cell {
        min-height: 50px;
        background-color: #f8f9fa;
        transition: all 0.2s ease;
        position: relative;
    }
    
    .hora-cell:hover {
        background-color: rgba(7, 68, 182, 0.08);
        transform: scale(1.02);
        z-index: 1;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .hora-cell.vacia:hover::before {
        content: '➕';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 1.2rem;
        opacity: 0.3;
    }
    
    .hora-cell.ocupada {
        background-color: rgba(7, 68, 182, 0.05);
        border: 2px solid rgba(7, 68, 182, 0.2);
    }
    
    .materia-badge {
        display: inline-block;
        padding: 0.25rem 0.5rem;
        border-radius: 4px;
        font-size: 0.75rem;
        font-weight: 600;
        color: white;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        max-width: 100%;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    
    .color-1 { background-color: #0744b6; }
    .color-2 { background-color: #0d6efd; }
    .color-3 { background-color: #198754; }
    .color-4 { background-color: #0dcaf0; }
    .color-5 { background-color: #6f42c1; }
    .color-6 { background-color: #fd7e14; }
    .color-7 { background-color: #20c997; }
    .color-8 { background-color: #e83e8c; }
    
    .materia-item {
        border-left: 4px solid;
        margin-bottom: 0.5rem;
        cursor: pointer;
        transition: var(--transition);
        border-radius: 5px;
        background: white;
    }
    
    .materia-item:hover {
        transform: translateX(3px);
        box-shadow: 0 3px 6px rgba(0,0,0,0.08);
    }
    
    .materia-seleccionada {
        background-color: rgba(7, 68, 182, 0.05);
        border: 2px solid var(--primary);
        border-left: 4px solid var(--primary);
    }
    
    .lista-materias-container {
        max-height: 150px;
        overflow-y: auto;
        padding-right: 5px;
    }
    
    /* Estilos para la sección de evidencia digital */
    .evidencia-horario-section {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-radius: 8px;
        padding: 1rem;
        border: 2px dashed #dee2e6;
        margin-top: 1rem;
    }
    
    .file-upload-area {
        border: 2px dashed #ced4da;
        border-radius: 8px;
        padding: 1.5rem;
        text-align: center;
        cursor: pointer;
        transition: var(--transition);
        background: white;
    }
    
    .file-upload-area:hover {
        border-color: var(--primary);
        background-color: rgba(7, 68, 182, 0.02);
    }
    
    .file-upload-area.dragover {
        border-color: var(--primary);
        background-color: rgba(7, 68, 182, 0.05);
    }
    
    .upload-icon {
        font-size: 2.5rem;
        color: var(--primary);
        margin-bottom: 0.5rem;
    }
    
    .file-preview {
        max-width: 200px;
        max-height: 150px;
        border-radius: 5px;
        border: 1px solid #dee2e6;
        margin-top: 10px;
    }
    
    .resumen-horas .horas-totales {
        font-size: 1.4rem;
        font-weight: 700;
        color: var(--primary);
    }
    
    .alert {
        font-size: 0.85rem;
        padding: 0.75rem;
        border-radius: 5px;
        border: none;
    }
    
    .alert-temporal {
        position: fixed;
        top: 120px;
        right: 20px;
        z-index: 1050;
        min-width: 300px;
        box-shadow: 0 3px 15px rgba(0,0,0,0.1);
        border-left: 4px solid;
    }
    
    .configuracion-aula-grupo {
        background-color: rgba(7, 68, 182, 0.03);
        padding: 1rem;
        border-radius: 8px;
        border: 1px solid rgba(7, 68, 182, 0.1);
    }
    
    .sin-periodo, .con-periodo {
        transition: var(--transition);
    }
    
    .badge-horario-lleno {
        background-color: var(--success-color);
    }
    
    .periodo-con-horario {
        font-weight: 600;
        color: var(--success-color);
    }
    
    .contador-horas {
        font-size: 0.75rem;
        color: var(--text-muted);
    }
    
    .horas-dia-container {
        background: white;
        padding: 0.5rem;
        border-radius: 5px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .table-responsive {
            font-size: 0.75rem;
        }
        
        .table-horarios th, 
        .table-horarios td {
            padding: 0.4rem;
        }
        
        .hora-cell {
            min-height: 45px;
        }
        
        .materia-badge {
            font-size: 0.7rem;
            padding: 0.15rem 0.3rem;
        }
    }
    </style>
</head>
<body>
    <!-- Primera barra - Logo y título -->
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
    
    <!-- Segunda barra - Menú con información de usuario y cerrar sesión -->
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

    <!-- CUERPO COMPACTO DEL FORMULARIO -->
    <div class="container-fluid py-3">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title mb-1">📅 Ingresar Horario del Maestro</h5>
                                <p class="card-subtitle mb-0">{{ $maestro->nombres }} {{ $maestro->apellido_paterno }} {{ $maestro->apellido_materno }}</p>
                            </div>
                            <div class="badge bg-light text-dark">
                                ID: {{ $maestro->id }}
                            </div>
                        </div>
                    </div>
                    
                    <form action="{{ route('horarios.guardar') }}" method="POST" id="formHorario" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <input type="hidden" name="maestro_id" value="{{ $maestro->id }}">
                            
                            <!-- Mostrar mensajes de éxito/error -->
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show">
                                    <i class="fas fa-check-circle me-2"></i>
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            @if(session('error'))
                                <div class="alert alert-danger alert-dismissible fade show">
                                    <i class="fas fa-exclamation-circle me-2"></i>
                                    {{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            <!-- Selección de Periodo -->
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label for="periodo_id" class="form-label">
                                        <i class="fas fa-calendar-alt me-1"></i> Período Académico *
                                    </label>
                                    <select name="periodo_id" id="periodo_id" class="form-select" required>
                                        <option value="">Seleccionar Período</option>
                                        @foreach($periodos as $periodo)
                                            <option value="{{ $periodo->id }}" 
                                                {{ ($periodoId ?? '') == $periodo->id ? 'selected' : '' }}
                                                class="{{ isset($periodosConHorario) && in_array($periodo->id, $periodosConHorario) ? 'periodo-con-horario' : '' }}">
                                                {{ $periodo->nombre }} ({{ $periodo->codigo }})
                                                @if(isset($periodosConHorario) && in_array($periodo->id, $periodosConHorario))
                                                    <span class="float-end">✅ Horario registrado</span>
                                                @endif
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="form-text mt-2">
                                        <span class="badge bg-success me-1">✅</span> Periodos con horario ya registrado
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">
                                        <i class="fas fa-book me-1"></i> Agregar Materias
                                    </label>
                                    <div class="input-group">
                                        <input type="text" id="input-nueva-materia" class="form-control" placeholder="Escribir nombre de la materia...">
                                        <button type="button" class="btn btn-agregar-materia" id="btn-agregar-materia">
                                            <i class="fas fa-plus me-1"></i> Agregar
                                        </button>
                                    </div>
                                    <div class="form-text">Escribe materias y luego selecciona en las celdas del horario</div>
                                </div>
                            </div>

                            <!-- Mensaje cuando NO hay periodo seleccionado -->
                            <div id="sin-periodo" class="sin-periodo text-center py-4 bg-light rounded">
                                <div class="mb-3">
                                    <i class="fas fa-calendar-plus fa-3x text-muted"></i>
                                </div>
                                <h5 class="mb-2">📋 Primero selecciona un periodo académico</h5>
                                <p class="mb-0 text-muted">Selecciona un período de la lista para comenzar a ingresar el horario.</p>
                            </div>

                            <!-- Contenido cuando SÍ hay periodo seleccionado -->
                            <div id="con-periodo" class="con-periodo">
                                <!-- Configuración de Aula y Grupo -->
                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <div class="configuracion-aula-grupo">
                                            <h6 class="mb-3">
                                                <i class="fas fa-school me-2"></i> Configuración de Aula y Grupo
                                            </h6>
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <label for="aula-global" class="form-label">Aula (para todas las materias)</label>
                                                    @php
                                                        $aulaValue = '';
                                                        if (isset($horariosExistentes[0])) {
                                                            if (is_array($horariosExistentes[0])) {
                                                                $aulaValue = $horariosExistentes[0]['aula'] ?? '';
                                                            } else {
                                                                $aulaValue = $horariosExistentes[0]->aula ?? '';
                                                            }
                                                        }
                                                    @endphp
                                                    <input type="text" class="form-control" id="aula-global" 
                                                           value="{{ $aulaValue }}" 
                                                           placeholder="Ej: AULA 101, LAB-201, VIRTUAL">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="grupo-global" class="form-label">Grupo (para todas las materias)</label>
                                                    @php
                                                        $grupoValue = '';
                                                        if (isset($horariosExistentes[0])) {
                                                            if (is_array($horariosExistentes[0])) {
                                                                $grupoValue = $horariosExistentes[0]['grupo'] ?? '';
                                                            } else {
                                                                $grupoValue = $horariosExistentes[0]->grupo ?? '';
                                                            }
                                                        }
                                                    @endphp
                                                    <input type="text" class="form-control" id="grupo-global" 
                                                           value="{{ $grupoValue }}" 
                                                           placeholder="Ej: GRUPO A, 5TO SEMESTRE, TURNO MATUTINO">
                                                </div>
                                            </div>
                                            <div class="form-text mt-2">
                                                <i class="fas fa-info-circle me-1"></i> Esta configuración se aplicará a todas las materias del horario
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- 🔥 NUEVA SECCIÓN: Evidencia Digital del Horario -->
                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <div class="evidencia-horario-section">
                                            <h6 class="mb-3">
                                                <i class="fas fa-camera me-2"></i> Evidencia Digital del Horario (Opcional)
                                            </h6>
                                            <p class="text-muted mb-3">
                                                Sube una foto o imagen del horario impreso como respaldo. Formatos aceptados: JPG, PNG, PDF. Máx: 5MB.
                                            </p>
                                            
                                            <div id="file-upload-container">
                                                <input type="file" name="horario_foto" id="horario_foto" class="d-none" accept="image/*,.pdf">
                                                
                                                <div id="file-upload-area" class="file-upload-area">
                                                    <div class="upload-icon">
                                                        <i class="fas fa-cloud-upload-alt"></i>
                                                    </div>
                                                    <h6 class="mb-2">Arrastra y suelta tu archivo aquí</h6>
                                                    <p class="text-muted mb-3">o haz clic para seleccionar</p>
                                                    <button type="button" id="btn-seleccionar-archivo" class="btn btn-outline-primary btn-sm">
                                                        <i class="fas fa-folder-open me-1"></i> Seleccionar Archivo
                                                    </button>
                                                </div>
                                                
                                                <div id="file-preview" class="mt-3 d-none">
                                                    <div class="d-flex align-items-center justify-content-between bg-light p-3 rounded">
                                                        <div class="d-flex align-items-center">
                                                            <i class="fas fa-file-image fa-2x text-primary me-3"></i>
                                                            <div>
                                                                <h6 class="mb-0" id="file-name"></h6>
                                                                <small class="text-muted" id="file-size"></small>
                                                            </div>
                                                        </div>
                                                        <button type="button" id="btn-eliminar-archivo" class="btn btn-sm btn-outline-danger">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </div>
                                                    
                                                    <!-- Vista previa para imágenes -->
                                                    <div id="image-preview" class="mt-2 text-center d-none">
                                                        <img id="preview-image" class="file-preview" src="" alt="Vista previa">
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            @if(isset($horariosExistentes[0]) && $horariosExistentes[0]->horario_foto)
                                                <div class="mt-3">
                                                    <div class="alert alert-info">
                                                        <i class="fas fa-info-circle me-2"></i>
                                                        Ya existe un horario digital cargado. Subir uno nuevo lo reemplazará.
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Lista de Materias Seleccionadas -->
                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <div class="card border-0 shadow-sm">
                                            <div class="card-header bg-primary text-white py-2">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <h6 class="mb-0">
                                                        <i class="fas fa-list-check me-2"></i> Materias Agregadas
                                                    </h6>
                                                    <span class="badge bg-warning" id="contador-materias">0</span>
                                                </div>
                                            </div>
                                            <div class="card-body p-2">
                                                <div id="lista-materias" class="lista-materias-container">
                                                    <p class="text-muted mb-0 text-center py-3" id="sin-materias">
                                                        <i class="fas fa-book-open me-1"></i> No hay materias agregadas. Escribe materias para comenzar.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Tabla de Horarios - CORREGIDA -->
                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <div class="card border-0 shadow-sm">
                                            <div class="card-header bg-primary text-white py-2">
                                                <h6 class="mb-0">
                                                    <i class="fas fa-table me-2"></i> Distribución Horaria Semanal
                                                </h6>
                                            </div>
                                            <div class="card-body p-0">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-hover table-horarios m-0">
                                                        <thead>
                                                            <tr>
                                                                <th style="width: 15%" class="text-center">
                                                                    <i class="fas fa-clock me-1"></i> Horario
                                                                </th>
                                                                <th style="width: 17%" class="text-center">
                                                                    <i class="fas fa-calendar-day me-1"></i> Lunes
                                                                </th>
                                                                <th style="width: 17%" class="text-center">
                                                                    <i class="fas fa-calendar-day me-1"></i> Martes
                                                                </th>
                                                                <th style="width: 17%" class="text-center">
                                                                    <i class="fas fa-calendar-day me-1"></i> Miércoles
                                                                </th>
                                                                <th style="width: 17%" class="text-center">
                                                                    <i class="fas fa-calendar-day me-1"></i> Jueves
                                                                </th>
                                                                <th style="width: 17%" class="text-center">
                                                                    <i class="fas fa-calendar-day me-1"></i> Viernes
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="tabla-horarios-body">
                                                            @php
                                                                $horasDisponibles = ['7-8', '8-9', '9-10', '10-11', '11-12', '12-13', '13-14', '14-15', '15-16', '16-17', '17-18'];
                                                                $diasSemana = ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes'];
                                                            @endphp

                                                            @foreach($horasDisponibles as $hora)
                                                                <tr>
                                                                    <td class="fw-bold text-center bg-light align-middle">
                                                                        <span class="badge bg-dark">{{ $hora }}</span>
                                                                    </td>
                                                                    @foreach($diasSemana as $dia)
                                                                        @php
                                                                            // 🔥 CORRECCIÓN: Manejar correctamente el tipo de dato
                                                                            $claseEnEstaHora = null;
                                                                            $materiaNombre = '';
                                                                            $colorMateria = 1;
                                                                            
                                                                            if (isset($horarioCompleto[$dia]) && is_array($horarioCompleto[$dia])) {
                                                                                // Buscar la clase en esta hora
                                                                                $claseEnEstaHora = collect($horarioCompleto[$dia])
                                                                                    ->firstWhere('horario', $hora);
                                                                                
                                                                                // Verificar si es array u objeto
                                                                                if ($claseEnEstaHora) {
                                                                                    // 🔥 CORRECCIÓN: Acceder correctamente según el tipo
                                                                                    if (is_array($claseEnEstaHora)) {
                                                                                        $materiaNombre = $claseEnEstaHora['materia_nombre'] ?? '';
                                                                                    } else {
                                                                                        $materiaNombre = $claseEnEstaHora->materia_nombre ?? '';
                                                                                    }
                                                                                    
                                                                                    // Obtener color de materia
                                                                                    if (!empty($materiaNombre)) {
                                                                                        $colorMateria = $materiasColores[$materiaNombre] ?? 1;
                                                                                    }
                                                                                }
                                                                            }
                                                                            
                                                                            $tieneClase = !empty($claseEnEstaHora) && !empty($materiaNombre);
                                                                        @endphp
                                                                        <td class="hora-cell {{ $tieneClase ? 'ocupada celda-con-materia' : 'vacia' }}" 
                                                                            data-hora="{{ $hora }}" 
                                                                            data-dia="{{ $dia }}"
                                                                            onclick="asignarMateriaACelda(this)">
                                                                            @if($tieneClase)
                                                                                <span class="materia-badge color-{{ $colorMateria }}">
                                                                                    {{ substr($materiaNombre, 0, 15) }}
                                                                                </span>
                                                                            @else
                                                                                <div class="text-muted">
                                                                                    <small><i class="fas fa-plus-circle me-1"></i> Disponible</small>
                                                                                </div>
                                                                            @endif
                                                                        </td>
                                                                    @endforeach
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="card-footer bg-light py-2 text-center">
                                                    <small class="text-muted">
                                                        <i class="fas fa-mouse-pointer me-1"></i> Haz clic en las celdas para asignar materias
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Resumen de Horas - CORREGIDO -->
                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <div class="card resumen-horas border-0 shadow-sm">
                                            <div class="card-header bg-primary text-white py-2">
                                                <h6 class="mb-0">
                                                    <i class="fas fa-chart-bar me-2"></i> Resumen de Horas por Día
                                                </h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="row text-center">
                                                    @php
                                                        $horasPorDia = [
                                                            'Lunes' => 0,
                                                            'Martes' => 0,
                                                            'Miercoles' => 0,
                                                            'Jueves' => 0,
                                                            'Viernes' => 0
                                                        ];
                                                        
                                                        // 🔥 CORRECCIÓN: Manejar arrays u objetos
                                                        foreach($horariosExistentes as $horario) {
                                                            // Determinar si es array u objeto
                                                            $diaHorario = '';
                                                            if (is_array($horario)) {
                                                                $diaHorario = $horario['dia'] ?? '';
                                                            } else {
                                                                $diaHorario = $horario->dia ?? '';
                                                            }
                                                            
                                                            if(isset($horasPorDia[$diaHorario])) {
                                                                $horasPorDia[$diaHorario]++;
                                                            }
                                                        }
                                                        
                                                        $totalSemanal = array_sum($horasPorDia);
                                                    @endphp
                                                    <div class="col">
                                                        <div class="horas-dia-container">
                                                            <small class="d-block text-muted">Lunes</small>
                                                            <div id="horas-lunes" class="horas-totales">{{ $horasPorDia['Lunes'] }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="horas-dia-container">
                                                            <small class="d-block text-muted">Martes</small>
                                                            <div id="horas-martes" class="horas-totales">{{ $horasPorDia['Martes'] }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="horas-dia-container">
                                                            <small class="d-block text-muted">Miércoles</small>
                                                            <div id="horas-miercoles" class="horas-totales">{{ $horasPorDia['Miercoles'] }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="horas-dia-container">
                                                            <small class="d-block text-muted">Jueves</small>
                                                            <div id="horas-jueves" class="horas-totales">{{ $horasPorDia['Jueves'] }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="horas-dia-container">
                                                            <small class="d-block text-muted">Viernes</small>
                                                            <div id="horas-viernes" class="horas-totales">{{ $horasPorDia['Viernes'] }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 mt-3">
                                                        <div class="p-3 bg-light rounded">
                                                            <small class="d-block text-muted">Total Semanal de Horas Clase</small>
                                                            <div id="total-semanal" class="horas-totales {{ $totalSemanal > 0 ? 'text-success' : 'text-danger' }}">
                                                                {{ $totalSemanal }} <small>horas</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Campos ocultos para enviar datos - CORREGIDO -->
                                <div id="hidden-fields-container">
                                    @if(isset($horariosExistentes) && count($horariosExistentes) > 0)
                                        @foreach($horariosExistentes as $index => $horario)
                                            @php
                                                // 🔥 CORRECCIÓN: Manejar tanto arrays como objetos
                                                $materiaNombre = is_array($horario) ? ($horario['materia_nombre'] ?? '') : ($horario->materia_nombre ?? '');
                                                $dia = is_array($horario) ? ($horario['dia'] ?? '') : ($horario->dia ?? '');
                                                $horarioHora = is_array($horario) ? ($horario['horario'] ?? '') : ($horario->horario ?? '');
                                                $aula = is_array($horario) ? ($horario['aula'] ?? '') : ($horario->aula ?? '');
                                                $grupo = is_array($horario) ? ($horario['grupo'] ?? '') : ($horario->grupo ?? '');
                                            @endphp
                                            <input type="hidden" name="clases[{{ $index }}][materia_nombre]" value="{{ $materiaNombre }}">
                                            <input type="hidden" name="clases[{{ $index }}][dia]" value="{{ $dia }}">
                                            <input type="hidden" name="clases[{{ $index }}][horario]" value="{{ $horarioHora }}">
                                            <input type="hidden" name="clases[{{ $index }}][aula]" value="{{ $aula }}">
                                            <input type="hidden" name="clases[{{ $index }}][grupo]" value="{{ $grupo }}">
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="card-footer bg-light py-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('horarios.index') }}" class="btn btn-secondary btn-sm">
                                    <i class="fas fa-arrow-left me-1"></i> Volver
                                </a>
                                <div>
                                    <button type="button" id="btn-limpiar-todo" class="btn btn-outline-secondary btn-sm me-2">
                                        <i class="fas fa-trash-alt me-1"></i> Limpiar Todo
                                    </button>
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        <i class="fas fa-save me-1"></i> Guardar Horario
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    // Variables globales - CORREGIDO para manejar arrays y objetos
    let materiasSeleccionadas = [];
    let horariosSeleccionados = [];
    let siguienteColor = {{ $siguienteColor ?? 1 }};
    let siguienteId = {{ $siguienteId ?? 1 }};
    let materiaActiva = null;
    const horasDisponibles = ['7-8', '8-9', '9-10', '10-11', '11-12', '12-13', '13-14', '14-15', '15-16', '16-17', '17-18'];
    const diasSemana = ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes'];
    
    const maestroId = @json($maestro->id);
    const STORAGE_KEY = `horario_maestro_${maestroId}`;
    
    // Inicializar datos desde Laravel - CORREGIDO
    document.addEventListener('DOMContentLoaded', function() {
        // Inicializar materias seleccionadas
        @if(isset($materiasExistentes) && count($materiasExistentes) > 0)
            @foreach($materiasExistentes as $materia)
                @php
                    // Manejar tanto objetos como arrays
                    $idMateria = is_object($materia) ? ($materia->id ?? $loop->iteration) : ($materia['id'] ?? $loop->iteration);
                    $nombreMateria = is_object($materia) ? $materia->nombre : $materia['nombre'];
                    $colorMateria = is_object($materia) ? $materia->color : $materia['color'];
                @endphp
                materiasSeleccionadas.push({
                    id: {{ $idMateria }},
                    nombre: '{{ $nombreMateria }}',
                    color: {{ $colorMateria }}
                });
            @endforeach
        @endif
    
        // Inicializar horarios seleccionados
        @if(isset($horariosExistentes) && count($horariosExistentes) > 0)
            @foreach($horariosExistentes as $horario)
                @php
                    // Manejar tanto objetos como arrays
                    $materiaNombre = '';
                    $dia = '';
                    $horarioHora = '';
                    $aula = '';
                    $grupo = '';
                    
                    if (is_array($horario)) {
                        $materiaNombre = $horario['materia_nombre'] ?? '';
                        $dia = $horario['dia'] ?? '';
                        $horarioHora = $horario['horario'] ?? '';
                        $aula = $horario['aula'] ?? '';
                        $grupo = $horario['grupo'] ?? '';
                    } else {
                        $materiaNombre = $horario->materia_nombre ?? '';
                        $dia = $horario->dia ?? '';
                        $horarioHora = $horario->horario ?? '';
                        $aula = $horario->aula ?? '';
                        $grupo = $horario->grupo ?? '';
                    }
                    
                    // Buscar la materia correspondiente
                    $materiaId = 0;
                    $colorMateria = 1;
                    foreach($materiasExistentes as $m) {
                        $nombreM = is_object($m) ? $m->nombre : $m['nombre'];
                        if ($nombreM == $materiaNombre) {
                            $materiaId = is_object($m) ? $m->id : $m['id'];
                            $colorMateria = is_object($m) ? $m->color : $m['color'];
                            break;
                        }
                    }
                @endphp
                horariosSeleccionados.push({
                    clave: '{{ $materiaId }}_{{ $dia }}_{{ $horarioHora }}',
                    materia_id: {{ $materiaId }},
                    materia_nombre: '{{ $materiaNombre }}',
                    materia_color: {{ $colorMateria }},
                    dia: '{{ $dia }}',
                    horario: '{{ $horarioHora }}',
                    aula: '{{ $aula }}',
                    grupo: '{{ $grupo }}'
                });
            @endforeach
        @endif
    
        toggleContenidoPeriodo();
        actualizarListaMaterias();
        inicializarUploadArchivo();
        inicializarEventosCeldas();
        actualizarTablaHorarios();
        actualizarResumenHoras();
        
        // Cargar de localStorage si existe
        cargarDeLocalStorage();
    });
    
    // Funciones para manejar la subida de archivos
    function inicializarUploadArchivo() {
        const fileInput = document.getElementById('horario_foto');
        const uploadArea = document.getElementById('file-upload-area');
        const btnSeleccionar = document.getElementById('btn-seleccionar-archivo');
        const btnEliminar = document.getElementById('btn-eliminar-archivo');
        const filePreview = document.getElementById('file-preview');
        const fileName = document.getElementById('file-name');
        const fileSize = document.getElementById('file-size');
        const previewImage = document.getElementById('preview-image');
        const imagePreview = document.getElementById('image-preview');
    
        uploadArea.addEventListener('click', () => fileInput.click());
        btnSeleccionar.addEventListener('click', () => fileInput.click());
    
        uploadArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            uploadArea.classList.add('dragover');
        });
    
        uploadArea.addEventListener('dragleave', () => {
            uploadArea.classList.remove('dragover');
        });
    
        uploadArea.addEventListener('drop', (e) => {
            e.preventDefault();
            uploadArea.classList.remove('dragover');
            if (e.dataTransfer.files.length) {
                fileInput.files = e.dataTransfer.files;
                handleFileSelect(fileInput.files[0]);
            }
        });
    
        fileInput.addEventListener('change', (e) => {
            if (e.target.files.length) {
                handleFileSelect(e.target.files[0]);
            }
        });
    
        btnEliminar.addEventListener('click', () => {
            fileInput.value = '';
            filePreview.classList.add('d-none');
            imagePreview.classList.add('d-none');
            uploadArea.classList.remove('d-none');
        });
    
        function handleFileSelect(file) {
            const maxSize = 5 * 1024 * 1024;
            if (file.size > maxSize) {
                mostrarAlerta('⚠️ El archivo es demasiado grande. Máximo 5MB.', 'warning');
                return;
            }
    
            const validTypes = ['image/jpeg', 'image/png', 'image/gif', 'application/pdf'];
            if (!validTypes.includes(file.type)) {
                mostrarAlerta('⚠️ Formato no válido. Use JPG, PNG, GIF o PDF.', 'warning');
                return;
            }
    
            fileName.textContent = file.name;
            fileSize.textContent = formatBytes(file.size);
            filePreview.classList.remove('d-none');
    
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    previewImage.src = e.target.result;
                    imagePreview.classList.remove('d-none');
                };
                reader.readAsDataURL(file);
            } else {
                imagePreview.classList.add('d-none');
            }
    
            mostrarAlerta(`✅ Archivo "${file.name}" seleccionado`, 'success');
        }
    
        function formatBytes(bytes, decimals = 2) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const dm = decimals < 0 ? 0 : decimals;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
        }
    }
    
    // Inicializar eventos de celdas
    function inicializarEventosCeldas() {
        document.querySelectorAll('.hora-cell').forEach(celda => {
            celda.addEventListener('click', function() {
                asignarMateriaACelda(this);
            });
        });
    }
    
    // Agregar nueva materia
    document.getElementById('btn-agregar-materia').addEventListener('click', function() {
        const input = document.getElementById('input-nueva-materia');
        const nombreMateria = input.value.trim();
    
        if (!nombreMateria) {
            mostrarAlerta('⚠️ Escribe un nombre de materia antes de agregar.', 'warning');
            return;
        }
    
        const existe = materiasSeleccionadas.some(m => m.nombre.toLowerCase() === nombreMateria.toLowerCase());
        if (existe) {
            mostrarAlerta('❌ Esta materia ya está agregada.', 'danger');
            input.value = '';
            return;
        }
    
        const colorAsignado = siguienteColor;
        siguienteColor = (siguienteColor % 8) + 1;
    
        const nuevaMateria = {
            id: siguienteId++,
            nombre: nombreMateria,
            color: colorAsignado
        };
    
        materiasSeleccionadas.push(nuevaMateria);
        materiaActiva = nuevaMateria;
    
        input.value = '';
        actualizarListaMaterias();
        guardarEnLocalStorage();
        mostrarAlerta(`✅ Materia "<strong>${nombreMateria}</strong>" agregada correctamente.`, 'success');
    });
    
    // Mostrar/ocultar contenido según periodo
    function toggleContenidoPeriodo() {
        const periodoSelect = document.getElementById('periodo_id');
        const sinPeriodo = document.getElementById('sin-periodo');
        const conPeriodo = document.getElementById('con-periodo');
        
        if (periodoSelect.value) {
            sinPeriodo.style.display = 'none';
            conPeriodo.style.display = 'block';
        } else {
            sinPeriodo.style.display = 'block';
            conPeriodo.style.display = 'none';
        }
    }
    
    // Asignar materia a celda
    function asignarMateriaACelda(celda) {
        if (!materiaActiva) {
            mostrarAlerta('⚠️ Primero selecciona o agrega una materia.', 'warning');
            return;
        }
    
        const dia = celda.dataset.dia;
        const horario = celda.dataset.hora;
        
        const tieneMateria = celda.classList.contains('ocupada');
        
        if (tieneMateria) {
            if (!confirm(`¿Reemplazar la materia en ${dia} ${horario}?`)) {
                return;
            }
            horariosSeleccionados = horariosSeleccionados.filter(h => 
                !(h.dia === dia && h.horario === horario)
            );
        }
        
        actualizarCeldaConMateria(celda, materiaActiva);
        
        const aula = document.getElementById('aula-global').value || '';
        const grupo = document.getElementById('grupo-global').value || '';
        
        horariosSeleccionados.push({
            clave: `${materiaActiva.id}_${dia}_${horario}`,
            materia_id: materiaActiva.id,
            materia_nombre: materiaActiva.nombre,
            materia_color: materiaActiva.color,
            dia: dia,
            horario: horario,
            aula: aula,
            grupo: grupo
        });
        
        actualizarResumenHoras();
        actualizarCamposOcultos();
        guardarEnLocalStorage();
        
        mostrarAlerta(`✅ Materia "<strong>${materiaActiva.nombre}</strong>" asignada a ${dia} ${horario}`, 'success');
    }
    
    // Actualizar celda con materia
    function actualizarCeldaConMateria(celda, materia) {
        celda.innerHTML = `<span class="materia-badge color-${materia.color}">${materia.nombre.substring(0,15)}</span>`;
        celda.classList.remove('vacia');
        celda.classList.add('ocupada', 'celda-con-materia');
        celda.title = `${materia.nombre} - ${celda.dataset.dia} ${celda.dataset.hora}`;
    }
    
    // Actualizar tabla completa de horarios
    function actualizarTablaHorarios() {
        document.querySelectorAll('.hora-cell').forEach(celda => {
            const dia = celda.dataset.dia;
            const horario = celda.dataset.hora;
            
            const horarioExistente = horariosSeleccionados.find(h => h.dia === dia && h.horario === horario);
            
            if (horarioExistente) {
                const materia = materiasSeleccionadas.find(m => m.id === horarioExistente.materia_id);
                if (materia) {
                    actualizarCeldaConMateria(celda, materia);
                }
            } else {
                celda.innerHTML = '<div class="text-muted"><small><i class="fas fa-plus-circle me-1"></i> Disponible</small></div>';
                celda.classList.remove('ocupada', 'celda-con-materia');
                celda.classList.add('vacia');
                celda.title = `Haz clic para asignar materia (${dia} ${horario})`;
            }
        });
    }
    
    // Actualizar lista de materias
    function actualizarListaMaterias() {
        const listaContainer = document.getElementById('lista-materias');
        const contador = document.getElementById('contador-materias');
        const sinMaterias = document.getElementById('sin-materias');
    
        contador.textContent = materiasSeleccionadas.length;
    
        if (materiasSeleccionadas.length === 0) {
            if (sinMaterias) sinMaterias.style.display = 'block';
            listaContainer.innerHTML = `<p class="text-muted mb-0 text-center py-3" id="sin-materias"><i class="fas fa-book-open me-1"></i> No hay materias agregadas. Escribe materias para comenzar.</p>`;
            materiaActiva = null;
            return;
        }
    
        if (sinMaterias) sinMaterias.style.display = 'none';
        listaContainer.innerHTML = '';
    
        materiasSeleccionadas.sort((a, b) => a.id - b.id).forEach((materia) => {
            const esActiva = materiaActiva && materiaActiva.id === materia.id;
            const horariosMateria = horariosSeleccionados.filter(h => h.materia_id === materia.id).length;
    
            const div = document.createElement('div');
            div.className = `card materia-item ${esActiva ? 'materia-seleccionada' : ''}`;
            div.style.borderLeftColor = `#${getColorHex(materia.color)}`;
            div.style.marginBottom = '8px';
            div.onclick = () => seleccionarMateria(materia.id);
    
            div.innerHTML = `
                <div class="card-body py-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="flex-grow-1">
                            <span class="badge materia-badge color-${materia.color} me-2">${materia.nombre.substring(0,3).toUpperCase()}</span>
                            <small class="fw-bold">${materia.nombre}</small><br>
                            <small class="contador-horas">${horariosMateria} hora(s) asignada(s)</small>
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-danger" title="Eliminar materia">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            `;
    
            div.querySelector('button').addEventListener('click', (e) => {
                e.stopPropagation();
                eliminarMateria(materia.id);
            });
    
            listaContainer.appendChild(div);
        });
    }
    
    function getColorHex(colorIndex) {
        const colores = ['0744b6', '0d6efd', '198754', '0dcaf0', '6f42c1', 'fd7e14', '20c997', 'e83e8c'];
        return colores[colorIndex - 1] || '0744b6';
    }
    
    function seleccionarMateria(materiaId) {
        materiaActiva = materiasSeleccionadas.find(m => m.id === materiaId);
        if (!materiaActiva) {
            mostrarAlerta('❌ Error: Materia no encontrada', 'danger');
            return;
        }
        actualizarListaMaterias();
        mostrarAlerta(`🔵 Materia "<strong>${materiaActiva.nombre}</strong>" seleccionada. Haz clic en las celdas de la tabla para asignarla.`, 'info');
    }
    
    // Eliminar materia
    function eliminarMateria(materiaId) {
        const materia = materiasSeleccionadas.find(m => m.id === materiaId);
        const horariosMateria = horariosSeleccionados.filter(h => h.materia_id === materiaId).length;
        
        if (!confirm(`¿Eliminar la materia "${materia.nombre}"? Se eliminarán ${horariosMateria} horario(s) asignado(s).`)) return;
    
        materiasSeleccionadas = materiasSeleccionadas.filter(m => m.id !== materiaId);
        if (materiaActiva && materiaActiva.id === materiaId) materiaActiva = null;
        
        horariosSeleccionados = horariosSeleccionados.filter(h => h.materia_id !== materiaId);
        
        actualizarTablaHorarios();
        actualizarListaMaterias();
        actualizarResumenHoras();
        actualizarCamposOcultos();
        guardarEnLocalStorage();
        mostrarAlerta(`🗑️ Materia "${materia.nombre}" eliminada correctamente`, 'success');
    }
    
    // Actualizar resumen de horas
    function actualizarResumenHoras() {
        const horasPorDia = { 
            'Lunes':0, 'Martes':0, 'Miercoles':0, 
            'Jueves':0, 'Viernes':0 
        };
        
        horariosSeleccionados.forEach(h => { 
            if(horasPorDia[h.dia] !== undefined) horasPorDia[h.dia]++; 
        });
    
        diasSemana.forEach(dia => {
            const el = document.getElementById(`horas-${dia.toLowerCase()}`);
            if(el) el.textContent = horasPorDia[dia];
        });
    
        const totalHoras = Object.values(horasPorDia).reduce((a,b)=>a+b,0);
        const totalEl = document.getElementById('total-semanal');
        if(totalEl) {
            totalEl.textContent = `${totalHoras} horas`;
            totalEl.className = `horas-totales ${totalHoras>0?'text-success':'text-danger'}`;
        }
    }
    
    // Actualizar campos ocultos para envío
    function actualizarCamposOcultos() {
        const container = document.getElementById('hidden-fields-container');
        container.innerHTML = '';
        
        horariosSeleccionados.forEach((h,i) => {
            container.innerHTML += `
                <input type="hidden" name="clases[${i}][materia_nombre]" value="${h.materia_nombre}">
                <input type="hidden" name="clases[${i}][dia]" value="${h.dia}">
                <input type="hidden" name="clases[${i}][horario]" value="${h.horario}">
                <input type="hidden" name="clases[${i}][aula]" value="${h.aula}">
                <input type="hidden" name="clases[${i}][grupo]" value="${h.grupo}">
            `;
        });
    }
    
    // Guardar en localStorage
    function guardarEnLocalStorage() {
        const datos = {
            materiasSeleccionadas,
            horariosSeleccionados,
            siguienteColor,
            siguienteId,
            aulaGlobal: document.getElementById('aula-global').value || '',
            grupoGlobal: document.getElementById('grupo-global').value || '',
            periodoId: document.getElementById('periodo_id').value || ''
        };
        localStorage.setItem(STORAGE_KEY, JSON.stringify(datos));
    }
    
    // Cargar de localStorage
    function cargarDeLocalStorage() {
        const datosGuardados = JSON.parse(localStorage.getItem(STORAGE_KEY) || 'null');
        
        if (datosGuardados) {
            const periodoActual = document.getElementById('periodo_id').value;
            if (!periodoActual || datosGuardados.periodoId === periodoActual) {
                materiasSeleccionadas = datosGuardados.materiasSeleccionadas || materiasSeleccionadas;
                horariosSeleccionados = datosGuardados.horariosSeleccionados || horariosSeleccionados;
                siguienteColor = datosGuardados.siguienteColor || siguienteColor;
                siguienteId = datosGuardados.siguienteId || siguienteId;
                
                if (datosGuardados.aulaGlobal) {
                    document.getElementById('aula-global').value = datosGuardados.aulaGlobal;
                }
                if (datosGuardados.grupoGlobal) {
                    document.getElementById('grupo-global').value = datosGuardados.grupoGlobal;
                }
                
                actualizarTablaHorarios();
                actualizarListaMaterias(); 
                actualizarResumenHoras(); 
                actualizarCamposOcultos();
            }
        }
    }
    
    function mostrarAlerta(mensaje, tipo='info') {
        document.querySelectorAll('.alert-temporal').forEach(a => a.remove());
        
        const alerta = document.createElement('div');
        alerta.className = `alert alert-${tipo} alert-dismissible fade show alert-temporal`;
        
        let icono = 'info-circle';
        if (tipo === 'success') icono = 'check-circle';
        if (tipo === 'warning') icono = 'exclamation-triangle';
        if (tipo === 'danger') icono = 'exclamation-circle';
        
        alerta.innerHTML = `
            <i class="fas fa-${icono} me-2"></i>
            ${mensaje}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        
        const cardBody = document.querySelector('.card-body');
        if (cardBody) {
            cardBody.insertBefore(alerta, cardBody.firstChild);
            
            setTimeout(() => {
                if (alerta.parentNode) alerta.remove();
            }, 5000);
        }
    }
    
    // Event Listeners
    document.getElementById('input-nueva-materia').addEventListener('keypress', function(e) {
        if(e.key === 'Enter'){
            e.preventDefault(); 
            document.getElementById('btn-agregar-materia').click(); 
        }
    });
    
    // Limpiar todo
    document.getElementById('btn-limpiar-todo').addEventListener('click', function() {
        if(!confirm('¿Limpiar todas las materias y horarios? Esta acción no se puede deshacer.')) return;
        
        materiasSeleccionadas = []; 
        horariosSeleccionados = []; 
        siguienteColor = 1; 
        siguienteId = 1; 
        materiaActiva = null;
        
        document.getElementById('aula-global').value = '';
        document.getElementById('grupo-global').value = '';
        
        actualizarTablaHorarios();
        actualizarListaMaterias(); 
        actualizarResumenHoras(); 
        actualizarCamposOcultos(); 
        guardarEnLocalStorage();
        
        mostrarAlerta('🧹 Todos los datos han sido limpiados correctamente','success');
    });
    
    // Cambio de periodo
    document.getElementById('periodo_id').addEventListener('change', function() {
        toggleContenidoPeriodo(); 
        guardarEnLocalStorage();
        
        if(this.value){ 
            const url = new URL(window.location.href); 
            url.searchParams.set('periodo_id', this.value); 
            window.location.href = url.toString(); 
        }
    });
    
    // Cambios en aula y grupo
    document.getElementById('aula-global').addEventListener('change', function() {
        horariosSeleccionados.forEach(h => {
            h.aula = this.value;
        });
        guardarEnLocalStorage();
    });
    
    document.getElementById('grupo-global').addEventListener('change', function() {
        horariosSeleccionados.forEach(h => {
            h.grupo = this.value;
        });
        guardarEnLocalStorage();
    });
    
    // Validación al enviar formulario
    document.getElementById('formHorario').addEventListener('submit', function(e){
        const periodoId = document.getElementById('periodo_id').value;
        
        if(!periodoId){ 
            e.preventDefault(); 
            mostrarAlerta('⚠️ Debes seleccionar un periodo académico','danger'); 
            return false; 
        }
        
        if(materiasSeleccionadas.length === 0){ 
            e.preventDefault(); 
            mostrarAlerta('⚠️ Debes agregar al menos una materia','danger'); 
            return false; 
        }
        
        if(horariosSeleccionados.length === 0){ 
            e.preventDefault(); 
            mostrarAlerta('⚠️ Debes asignar al menos un horario','danger'); 
            return false; 
        }
    
        if(!confirm(`¿Guardar el horario con ${materiasSeleccionadas.length} materias y ${horariosSeleccionados.length} horario(s)?`)) { 
            e.preventDefault(); 
            return false; 
        }
        
        limpiarLocalStorage();
        return true;
    });
    
    function limpiarLocalStorage() {
        localStorage.removeItem(STORAGE_KEY);
        localStorage.removeItem('ultimo_periodo');
    }
    </script>
</body>
</html>