<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Contratos - Sistema GEPROC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
    :root {
        --primary: #0744b6ff;
        --secondary: #33CAE6;
        --accent: #26E63F;
        --light-bg: #F8F9FA;
        --border-color: #E9ECEF;
        --text-muted: #6C757D;
        --card-shadow: 0 5px 15px rgba(15, 126, 230, 0.08);
        --transition: all 0.3s ease;
        
        /* Tipografía profesional - Tamaños aumentados */
        --font-size-base: 1rem;        /* 16px (antes 14-15px aprox) */
        --font-size-lg: 1.125rem;      /* 18px */
        --font-size-xl: 1.25rem;        /* 20px */
        --font-size-2xl: 1.5rem;        /* 24px */
        --font-size-3xl: 1.875rem;      /* 30px */
    }

    body { 
        background: white; 
        font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
        color: #333; 
        line-height: 1.6;
        padding-top: 0 !important;
        font-size: var(--font-size-base);
    }

    /* ========== ESTILOS DE BARRA Y MENÚ IGUAL AL PRIMER CÓDIGO ========== */

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
        font-size: 1.6rem; /* Aumentado */
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .navbar-brand::before {
        content: "";
        display: block;
        width: 6px;
        height: 32px; /* Aumentado */
        background: var(--primary);
        border-radius: 2px;
    }

    .logo-container {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .logo-img {
        height: 55px; /* Ligeramente aumentado */
        width: auto;
        object-fit: contain;
    }

    /* Segunda barra - Menú */
    .navbar-menu { 
        background: var(--primary); 
        padding: 0.8rem 0; /* Aumentado ligeramente */
        position: sticky;
        top: 73px; /* Ajustado */
        z-index: 999;
    }

    .navbar-menu .navbar-toggler {
        border: 1px solid rgba(255, 255, 255, 0.3);
        padding: 0.35rem 0.6rem; /* Aumentado */
    }

    .navbar-menu .navbar-toggler-icon {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 0.8%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        width: 1.5em; /* Aumentado */
        height: 1.5em; /* Aumentado */
    }

    .navbar-menu .nav-link {
        font-weight: 500;
        color: rgba(255, 255, 255, 0.9) !important;
        padding: 0.7rem 1.6rem !important; /* Aumentado */
        margin: 0 0.1rem;
        border-radius: 4px;
        transition: var(--transition);
        position: relative;
        font-size: 1.05rem; /* Aumentado */
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
        gap: 12px; /* Aumentado */
        color: white;
    }

    .navbar-menu .user-name {
        font-weight: 500;
        color: rgba(255, 255, 255, 0.9);
        font-size: 1.05rem; /* Aumentado */
    }

    .navbar-menu .user-avatar {
        font-size: 1.5rem; /* Aumentado */
        color: rgba(255, 255, 255, 0.9);
    }

    .navbar-menu .logout-form {
        margin: 0;
    }

    .navbar-menu .logout-btn {
        background: transparent;
        border: 1px solid rgba(255, 255, 255, 0.4);
        color: rgba(255, 255, 255, 0.9);
        padding: 0.5rem 1.2rem; /* Aumentado */
        border-radius: 4px;
        font-weight: 500;
        transition: var(--transition);
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 1rem; /* Aumentado */
    }

    .navbar-menu .logout-btn:hover {
        background: rgba(255, 255, 255, 0.1);
        color: white;
        border-color: rgba(255, 255, 255, 0.6);
    }

    .navbar-menu .logout-btn:active {
        background: rgba(255, 255, 255, 0.2);
    }

    /* Contenido principal */
    .main-content { 
        padding: 35px 25px; /* Aumentado */
        min-height: calc(100vh - 155px);
    }
    
    h1, h2, h3, h4, h5, h6 {
        font-weight: 600;
    }
    
    h2 { 
        color: var(--primary);
        margin-bottom: 1.8rem; /* Aumentado */
        padding-bottom: 1rem; /* Aumentado */
        position: relative;
        font-size: var(--font-size-2xl); /* 24px */
    }
    
    h2::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 60px; /* Aumentado */
        height: 3px; /* Aumentado */
        background: var(--primary);
    }
    
    /* Contenedor de contenido */
    .content-container {
        background: white;
        border-radius: 8px; /* Aumentado */
        padding: 2.2rem; /* Aumentado */
        margin-bottom: 2rem;
        border: 1px solid var(--border-color);
        box-shadow: var(--card-shadow);
    }
    
    /* Botón primario */
    .btn-primary-geproc {
        background: var(--primary);
        border: none;
        color: white;
        font-weight: 500;
        padding: 0.7rem 1.8rem; /* Aumentado */
        border-radius: 6px; /* Aumentado */
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        gap: 10px; /* Aumentado */
        font-size: var(--font-size-base); /* 16px */
    }
    
    .btn-primary-geproc:hover {
        background: #063a9b;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(7, 68, 182, 0.2);
    }
    
    /* Panel de filtro - CORREGIDO */
    .filter-panel {
        background: white;
        border-radius: 8px; /* Aumentado */
        padding: 1.8rem; /* Aumentado */
        border: 1px solid var(--border-color);
        margin-bottom: 2rem; /* Aumentado */
    }
    
    .filter-label {
        color: var(--primary);
        font-size: var(--font-size-base); /* 16px */
        margin-bottom: 0.5rem;
    }
    
    .form-select-geproc {
        border: 1px solid var(--border-color);
        border-radius: 6px; /* Aumentado */
        padding: 0.7rem 1.2rem; /* Aumentado */
        font-size: var(--font-size-base); /* 16px */
        transition: var(--transition);
        width: 100%;
    }
    
    .form-select-geproc:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 0.2rem rgba(7, 68, 182, 0.15);
    }
    
    /* Pestañas personalizadas */
    .custom-tabs {
        border-bottom: 1px solid var(--border-color);
        margin-bottom: 2rem; /* Aumentado */
    }
    
    .custom-tabs .nav-link {
        border: none;
        color: var(--text-muted);
        font-weight: 500;
        padding: 0.8rem 1.8rem; /* Aumentado */
        border-radius: 6px 6px 0 0; /* Aumentado */
        margin-right: 0.3rem;
        transition: var(--transition);
        font-size: var(--font-size-base); /* 16px */
    }
    
    .custom-tabs .nav-link:hover {
        color: var(--primary);
        background: rgba(7, 68, 182, 0.05);
    }
    
    .custom-tabs .nav-link.active {
        color: var(--primary);
        background: transparent;
        border-bottom: 2px solid var(--primary);
    }
    
    /* Tarjetas de datos */
    .data-card {
        background: white;
        border-radius: 8px; /* Aumentado */
        border: 1px solid var(--border-color);
        padding: 1.8rem; /* Aumentado */
        margin-bottom: 2rem; /* Aumentado */
        transition: var(--transition);
    }
    
    .data-card:hover {
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
    }
    
    .card-top-info {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.8rem; /* Aumentado */
        padding-bottom: 1.2rem; /* Aumentado */
        border-bottom: 1px solid var(--border-color);
    }
    
    .card-top-info h5 {
        font-size: var(--font-size-lg); /* 18px */
    }
    
    /* Tabla personalizada */
    .table-custom {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }
    
    .table-custom thead th {
        background: rgba(7, 68, 182, 0.05);
        color: var(--primary);
        font-weight: 600;
        padding: 1.2rem 1rem; /* Aumentado padding vertical */
        border-bottom: 2px solid var(--border-color);
        font-size: var(--font-size-base); /* 16px */
    }
    
    .table-custom tbody td {
        padding: 1.2rem 1rem; /* Aumentado padding vertical */
        border-bottom: 1px solid var(--border-color);
        vertical-align: middle;
        font-size: var(--font-size-base); /* 16px */
    }
    
    .table-custom tbody tr:hover {
        background: rgba(7, 68, 182, 0.02);
    }
    
    /* Badges */
    .badge-area {
        background: rgba(7, 68, 182, 0.1);
        color: var(--primary);
        padding: 0.4rem 1rem; /* Aumentado */
        border-radius: 6px; /* Aumentado */
        font-size: 0.9rem; /* Ligeramente aumentado */
        font-weight: 500;
        display: inline-block;
    }
    
    /* Botones de acción */
    .action-flex {
        display: flex;
        gap: 10px; /* Aumentado */
    }
    
    .act-btn {
        width: 40px; /* Aumentado */
        height: 40px; /* Aumentado */
        border-radius: 6px; /* Aumentado */
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        transition: var(--transition);
        border: none;
        font-size: 1.1rem; /* Aumentado */
    }
    
    .act-btn.view {
        background: rgba(25, 135, 84, 0.1);
        color: #198754;
    }
    
    .act-btn.edit {
        background: rgba(13, 110, 253, 0.1);
        color: #0d6efd;
    }
    
    .act-btn.delete {
        background: rgba(220, 53, 69, 0.1);
        color: #dc3545;
    }
    
    .act-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
    }
    
    .act-btn.view:hover {
        background: #198754;
        color: white;
    }
    
    .act-btn.edit:hover {
        background: #0d6efd;
        color: white;
    }
    
    .act-btn.delete:hover {
        background: #dc3545;
        color: white;
    }
    
    /* Tarjetas de plantillas */
    .template-card {
        background: white;
        border: 1px solid var(--border-color);
        border-radius: 8px; /* Aumentado */
        padding: 2.2rem 1.8rem; /* Aumentado */
        transition: var(--transition);
        height: 100%;
    }
    
    .template-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--card-shadow);
    }
    
    .file-icon-large {
        width: 80px; /* Aumentado */
        height: 80px; /* Aumentado */
        background: rgba(7, 68, 182, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.2rem; /* Aumentado */
        color: var(--primary);
    }
    
    .template-name {
        color: var(--primary);
        font-weight: 600;
        margin-bottom: 1rem;
        font-size: var(--font-size-lg); /* 18px */
    }
    
    .btn-use-template {
        background: var(--primary);
        color: white;
        border: none;
        padding: 0.7rem 1.4rem; /* Aumentado */
        border-radius: 6px; /* Aumentado */
        font-weight: 500;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: var(--transition);
        flex: 1;
        font-size: var(--font-size-base); /* 16px */
    }
    
    .btn-use-template:hover {
        background: #063a9b;
        color: white;
        transform: translateY(-2px);
    }
    
    /* Secciones por mes */
    .month-section {
        margin-bottom: 2.5rem; /* Aumentado */
    }
    
    .month-title {
        color: var(--primary);
        font-weight: 600;
        margin-bottom: 1.2rem; /* Aumentado */
        padding-left: 0.8rem; /* Aumentado */
        border-left: 4px solid var(--primary);
        font-size: var(--font-size-xl); /* 20px */
    }
    
    /* Badge general */
    .badge {
        font-weight: 500;
        padding: 0.5rem 1rem; /* Aumentado */
        font-size: 0.85rem; /* Ligeramente aumentado */
    }
    
    .badge-primary { background: var(--primary); }
    .badge-secondary { background: var(--secondary); }
    .badge-success { background: #2E7D32; }
    .badge-warning { background: #F57C00; }
    
    /* Texto de la tabla */
    .contract-name-cell {
        font-weight: 500;
        font-size: var(--font-size-base); /* 16px */
    }
    
    .file-icon-box {
        width: 40px; /* Aumentado */
        height: 40px; /* Aumentado */
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem; /* Aumentado */
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .navbar-brand {
            font-size: 1.4rem;
        }
        
        .navbar-menu .nav-link {
            padding: 0.6rem 1.2rem !important;
            margin: 0.1rem 0;
            font-size: 1rem;
        }
        
        .main-content {
            padding: 25px 15px;
        }
        
        .content-container {
            padding: 1.8rem;
        }
        
        .card-top-info {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }
        
        .navbar-menu {
            top: 67px;
        }
        
        .logo-img {
            height: 48px;
        }
        
        .navbar-menu .user-info-container {
            flex-direction: column;
            gap: 12px;
            align-items: flex-end;
            margin-top: 12px;
            padding-top: 12px;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .navbar-menu .user-name {
            font-size: 1rem;
        }
        
        h2 {
            font-size: 1.4rem;
        }
        
        .table-custom tbody td {
            font-size: 0.95rem;
        }
    }
    
    @media (max-width: 576px) {
        h2 {
            font-size: 1.3rem;
        }
        
        .table-custom thead {
            display: none;
        }
        
        .table-custom tbody tr {
            display: block;
            margin-bottom: 1.2rem;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 1.2rem;
        }
        
        .table-custom tbody td {
            display: block;
            text-align: right;
            border: none;
            padding: 0.7rem 0;
            font-size: 0.95rem;
        }
        
        .table-custom tbody td::before {
            content: attr(data-label);
            float: left;
            font-weight: 600;
            color: var(--primary);
            font-size: 0.95rem;
        }
        
        .action-flex {
            justify-content: center;
        }
        
        .logo-img {
            height: 42px;
        }
        
        .btn-primary-geproc {
            padding: 0.6rem 1.5rem;
            font-size: 0.95rem;
        }
    }
    </style>
</head>
<body>
    <!-- Primera barra - Logo y título (igual al primer código) -->
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
                    <li class="nav-item"><a class="nav-link active {{ request()->routeIs('contratos.*') ? 'active' : '' }}" href="{{ route('contracts.index') }}">Contratos</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}">Accesos</a></li>
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
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 main-content">
                <!-- Encabezado del contenido -->
                <div class="content-container mb-4">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <div>
                            <h2 class="mb-1">Gestión de Contratos</h2>
                            <p class="text-muted mb-0" style="font-size: 1.05rem;">Panel de control administrativo y análisis de documentos</p>
                        </div>
                        <div>
                            <a href="{{ route('contracts.analyze') }}" class="btn-primary-geproc">
                                <i class="fas fa-plus-circle me-2"></i> Nuevo Análisis IA
                            </a>
                        </div>
                    </div>
                </div>

               

                <!-- Panel de filtro - VERSIÓN CORREGIDA -->
                <div class="filter-panel">
                    <span class="filter-label fw-bold mb-2 d-block">
                        <i class="fas fa-filter me-2"></i>Seleccionar Coordinación
                    </span>
                    <form method="GET" action="{{ route('contracts.index') }}" class="row g-3 align-items-center">
                        <div class="col-12 col-md-9">
                            <select name="coordinacion_id" class="form-select-geproc" onchange="this.form.submit()">
                                <option value="">Todas las coordinaciones disponibles</option>
                                @if($coordinaciones->count() > 0)
                                    @foreach($coordinaciones as $coordinacion)
                                        <option value="{{ $coordinacion->id }}" 
                                            {{ request('coordinacion_id') == $coordinacion->id ? 'selected' : '' }}>
                                            {{ $coordinacion->display_name ?: $coordinacion->nombre }}
                                        </option>
                                    @endforeach
                                @else
                                    <option value="" disabled>No hay coordinaciones disponibles</option>
                                @endif
                            </select>
                        </div>
                        @if(request('coordinacion_id'))
                        <div class="col-12 col-md-3">
                            <a href="{{ route('contracts.index') }}" class="btn btn-outline-secondary w-100" style="padding: 0.7rem 1rem; font-size: 1rem;">
                                <i class="fas fa-undo-alt me-2"></i> Limpiar Filtro
                            </a>
                        </div>
                        @endif
                    </form>
                </div>

                <!-- Pestañas -->
                <div class="mb-4">
                    <ul class="nav nav-pills custom-tabs" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <button class="nav-link active" data-bs-toggle="pill" data-bs-target="#tab-recent">Recientes</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="pill" data-bs-target="#tab-templates">Plantillas</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="pill" data-bs-target="#tab-all">Historial Completo</button>
                        </li>
                    </ul>
                </div>

                <!-- Contenido de pestañas -->
                <div class="tab-content" id="pills-tabContent">
                    <!-- Pestaña Recientes -->
                    <div class="tab-pane fade show active" id="tab-recent" role="tabpanel">
                        <div class="data-card">
                            <div class="card-top-info">
                                <h5 class="fw-bold mb-0">
                                    <i class="fas fa-history me-2"></i>Documentos Recientes
                                </h5>
                                <span class="badge bg-light text-muted rounded-pill px-3 py-2" style="font-size: 0.95rem;">
                                    {{ $recentContracts->count() }} resultados encontrados
                                </span>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-custom mb-0">
                                    <thead>
                                        <tr>
                                            <th>Nombre del Documento</th>
                                            <th class="d-none d-lg-table-cell text-center">Coordinación</th>
                                            <th class="text-center">Fecha</th>
                                            <th class="text-center">Operaciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($recentContracts as $contract)
                                        <tr>
                                            <td data-label="Documento">
                                                <div class="d-flex align-items-center">
                                                    <div class="file-icon-box bg-light text-danger rounded-3 me-3">
                                                        <i class="fas fa-file-pdf"></i>
                                                    </div>
                                                    <span class="contract-name-cell">{{ $contract->nombre }}</span>
                                                </div>
                                            </td>
                                            <td class="d-none d-lg-table-cell text-center" data-label="Coordinación">
                                                <span class="badge-area">
                                                    @if($contract->coordinacion)
                                                        {{ $contract->coordinacion->display_name ?: $contract->coordinacion->nombre }}
                                                    @else
                                                        Sin área
                                                    @endif
                                                </span>
                                            </td>
                                            <td class="text-center text-muted fw-medium" data-label="Fecha">{{ $contract->created_at->format('d/m/Y') }}</td>
                                            <td data-label="Operaciones">
                                                <div class="action-flex justify-content-center">
                                                    <a href="{{ route('contracts.show', $contract->id) }}" class="act-btn view" title="Ver Detalle"><i class="fas fa-eye"></i></a>
                                                    <a href="{{ route('contracts.edit', $contract->id) }}" class="act-btn edit" title="Modificar"><i class="fas fa-edit"></i></a>
                                                    <form action="{{ route('contracts.destroy', $contract->id) }}" method="POST" class="d-inline">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" class="act-btn delete" onclick="return confirm('¿Está seguro de eliminar este registro?')">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="4" class="text-center py-5" style="font-size: 1.05rem;">No hay contratos recientes registrados.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Pestaña Plantillas -->
                    <div class="tab-pane fade" id="tab-templates" role="tabpanel">
                        <div class="row g-4">
                            @foreach($templates as $template)
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="template-card text-center">
                                    <div class="file-icon-large mx-auto mb-3">
                                        <i class="fas fa-file-signature"></i>
                                    </div>
                                    <h6 class="template-name">{{ $template->name }}</h6>
                                    <div class="d-flex gap-2 mt-4">
                                        <a href="{{ route('contracts.create', $template->id) }}" class="btn-use-template">
                                            <i class="fas fa-play-circle me-2"></i>Usar Plantilla
                                        </a>
                                        <a href="{{ route('templates.edit', $template->id) }}" class="act-btn edit" title="Editar Nombre">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('templates.destroy', $template->id) }}" method="POST" class="d-inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="act-btn delete" onclick="return confirm('¿Eliminar plantilla?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Pestaña Historial Completo - CORREGIDO -->
                    <div class="tab-pane fade" id="tab-all" role="tabpanel">
                        @foreach($allContracts as $month => $contracts)
                        <div class="month-section">
                            <!-- CORRECCIÓN: Usar $formattedMonths[$month] en lugar de mesEnEspanol() -->
                            <h5 class="month-title">{{ $formattedMonths[$month] ?? $month }}</h5>
                            <div class="data-card">
                                <div class="table-responsive">
                                    <table class="table table-custom mb-0">
                                        <tbody>
                                            @foreach($contracts as $contract)
                                            <tr>
                                                <td class="fw-bold" style="font-size: 1rem;">{{ $contract->nombre }}</td>
                                                <td>
                                                    <div class="action-flex justify-content-end">
                                                        <a href="{{ route('contracts.show', $contract->id) }}" class="act-btn view" title="Ver"><i class="fas fa-eye"></i></a>
                                                        <form action="{{ route('contracts.destroy', $contract->id) }}" method="POST" class="d-inline">
                                                            @csrf @method('DELETE')
                                                            <button type="submit" class="act-btn delete" title="Eliminar"><i class="fas fa-trash"></i></button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        (function(){
            const navbar = document.querySelector('.navbar-top');

            // Efecto de scroll en navbar
            window.addEventListener('scroll', function() {
                if (window.scrollY > 50) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
            });

            // Para diseño responsive de tablas
            document.querySelectorAll('.table-custom tbody td').forEach(cell => {
                const th = cell.closest('tr').querySelector('th');
                if (th) {
                    cell.setAttribute('data-label', th.textContent);
                }
            });

        })();
    </script>
</body>
</html>