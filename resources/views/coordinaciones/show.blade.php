<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maestros de Coordinación</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <style>
        :root {
            --primary: #0744b6ff;
            --secondary: #33CAE6;
            --accent: #26E63F;
            --light-bg: #F8F9FA;
            --border-color: #E9ECEF;
            --text-muted: #6C757D;
            --card-shadow: 0 3px 10px rgba(15, 126, 230, 0.05);
            --transition: all 0.3s ease;
        }

        body { 
            background: white; 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            color: #333; 
            line-height: 1.5;
        }

        /* ========== ESTILOS DE BARRA Y MENÚ (NO MODIFICAR) ========== */
        .navbar-top { 
            background: white; 
            border-bottom: 1px solid var(--border-color);
            padding: 0.8rem 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
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

        /* ========== ESTILOS DE LA VISTA MEJORADOS ========== */
        .container-fluid {
            padding: 20px;
            max-width: 1400px;
            margin: 0 auto;
        }

        /* Encabezado simplificado - estilo segunda vista */
        .page-header {
            background: white;
            border-bottom: 2px solid var(--primary);
            padding: 30px 0;
            margin-bottom: 20px;
        }

        .page-header h1 {
            color: var(--primary);
            font-weight: 600;
            font-size: 1.5rem;
            margin-bottom: 5px;
            display: flex;
            align-items: center;
            gap: 10px;
            
        }

        .page-header .subtitle {
            color: var(--text-muted);
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* Botón Volver mejorado */
        .btn-volver {
            background: var(--primary);
            border: none;
            color: white;
            padding: 8px 16px;
            font-size: 0.85rem;
            border-radius: 6px;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            font-weight: 500;
            box-shadow: 0 2px 4px rgba(7, 68, 182, 0.15);
        }

        .btn-volver:hover {
            background: #063a9c;
            transform: translateY(-2px);
            color: white;
            text-decoration: none;
            box-shadow: 0 4px 8px rgba(7, 68, 182, 0.2);
        }

        .btn-volver:active {
            transform: translateY(0);
            box-shadow: 0 1px 2px rgba(7, 68, 182, 0.15);
        }

        /* Filtro compacto - estilo segunda vista */
        .filtro-compacto {
            background: #f8fafc;
            border-radius: 8px;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid var(--border-color);
        }

        .filtro-compacto .form-select {
            font-size: 0.9rem;
            padding: 8px 12px;
        }

        .filtro-compacto .btn-outline-secondary {
            font-size: 0.85rem;
            padding: 7px 12px;
        }

        /* Tarjeta principal - estilo segunda vista */
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: var(--card-shadow);
            margin-bottom: 20px;
            overflow: hidden;
        }

        .card-header {
            background: white;
            border-bottom: 1px solid var(--border-color);
            padding: 15px 20px;
        }

        .card-header h6 {
            font-weight: 600;
            color: var(--primary);
            font-size: 1.1rem;
            margin: 0;
        }

        .card-body {
            padding: 20px;
        }

        /* Tabla - estilo segunda vista */
        .table {
            margin-bottom: 0;
        }

        .table thead th {
            border-top: none;
            font-weight: 600;
            color: var(--primary);
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 12px 15px;
            background-color: #f8fafc;
            white-space: nowrap;
        }

        .table tbody td {
            padding: 12px 15px;
            vertical-align: middle;
            border-color: #f1f3f5;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(7, 68, 182, 0.03);
        }

        /* ========== PAGINACIÓN DATATABLES PEQUEÑA (DE VISTA 2) ========== */
        .dataTables_wrapper .dataTables_paginate {
            padding-top: 10px !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 4px 10px !important;
            margin: 0 2px !important;
            font-size: 0.8rem !important;
            min-width: 32px !important;
            height: 32px !important;
            line-height: 20px !important;
            border-radius: 4px !important;
            border: 1px solid #dee2e6 !important;
            color: var(--primary) !important;
            background: white !important;
            transition: var(--transition) !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current,
        .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            background: var(--primary) !important;
            color: white !important;
            border-color: var(--primary) !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: rgba(7, 68, 182, 0.1) !important;
            color: var(--primary) !important;
            border-color: var(--primary) !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled,
        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover {
            color: #6c757d !important;
            background: #f8f9fa !important;
            border-color: #dee2e6 !important;
            cursor: not-allowed !important;
        }

        /* Botones de paginación con iconos más pequeños */
        .dataTables_wrapper .dataTables_paginate .paginate_button.previous,
        .dataTables_wrapper .dataTables_paginate .paginate_button.next {
            min-width: 32px !important;
            padding: 4px 8px !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.first,
        .dataTables_wrapper .dataTables_paginate .paginate_button.last {
            min-width: 32px !important;
            padding: 4px 8px !important;
        }

        /* Paginación estilo Bootstrap */
        .dataTables_wrapper .dataTables_paginate .pagination {
            margin-bottom: 0 !important;
            font-size: 0.8rem !important;
        }

        .dataTables_wrapper .dataTables_paginate .pagination .page-item.active .page-link {
            background-color: var(--primary) !important;
            border-color: var(--primary) !important;
            color: white !important;
        }

        .dataTables_wrapper .dataTables_paginate .pagination .page-link {
            color: var(--primary) !important;
            font-size: 0.8rem !important;
            padding: 4px 10px !important;
            border-radius: 4px !important;
            border: 1px solid #dee2e6 !important;
            margin: 0 2px !important;
            min-width: 32px !important;
            height: 32px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            transition: var(--transition) !important;
        }

        .dataTables_wrapper .dataTables_paginate .pagination .page-link:hover {
            background-color: rgba(7, 68, 182, 0.1) !important;
            border-color: var(--primary) !important;
            color: var(--primary) !important;
        }

        .dataTables_wrapper .dataTables_paginate .pagination .page-item.disabled .page-link {
            color: #6c757d !important;
            background: #f8f9fa !important;
            border-color: #dee2e6 !important;
        }

        /* Remove DataTable info */
        .dataTables_info {
            display: none !important;
        }

        /* Badges mejorados */
        .badge-gender-male {
            background: rgba(33, 150, 243, 0.1);
            color: #2196F3;
            font-weight: 500;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.8rem;
        }

        .badge-gender-female {
            background: rgba(233, 30, 99, 0.1);
            color: #E91E63;
            font-weight: 500;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.8rem;
        }

        .badge-gender-other {
            background: rgba(158, 158, 158, 0.1);
            color: #9E9E9E;
            font-weight: 500;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.8rem;
        }

        /* Botones de estado mejorados */
        .status-btn {
            border: none;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 0.8rem;
            font-weight: 500;
            transition: var(--transition);
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 85px;
        }

        .status-active {
            background: rgba(46, 125, 50, 0.1);
            color: #2E7D32;
            border: 1px solid rgba(46, 125, 50, 0.2);
        }

        .status-inactive {
            background: rgba(244, 67, 54, 0.1);
            color: #F44336;
            border: 1px solid rgba(244, 67, 54, 0.2);
        }

        .status-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        /* Botones de acción */
        .btn-actions {
            background: transparent;
            border: 1px solid var(--border-color);
            color: var(--text-muted);
            width: 34px;
            height: 34px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 5px;
            padding: 0;
            font-size: 0.9rem;
            transition: var(--transition);
        }

        .btn-actions:hover {
            background: var(--light-bg);
            border-color: var(--primary);
            color: var(--primary);
        }

        /* Dropdown mejorado */
        .dropdown-menu {
            border: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border-radius: 6px;
            padding: 0;
            overflow: hidden;
            min-width: 200px;
            font-size: 0.9rem;
        }

        .dropdown-header {
            background: #f8fafc;
            color: var(--primary);
            font-weight: 600;
            padding: 10px 15px;
            font-size: 0.85rem;
        }

        .dropdown-item {
            padding: 8px 15px;
            font-size: 0.9rem;
            transition: var(--transition);
        }

        .dropdown-item:hover {
            background: rgba(7, 68, 182, 0.05);
        }

        /* Alertas y mensajes */
        .resumen-alert {
            background: #f8f9fa;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            margin-bottom: 20px;
            padding: 12px 15px;
        }

        .resumen-alert .badge {
            font-size: 0.85rem;
            padding: 0.3rem 0.7rem;
        }

        /* Sin datos */
        .no-data {
            padding: 40px 20px;
            text-align: center;
            color: var(--text-muted);
        }

        .no-data i {
            font-size: 2.5rem;
            margin-bottom: 15px;
            opacity: 0.5;
        }

        /* Header-badge para nombre de coordinación */
        .header-badge {
            background: rgba(7, 68, 182, 0.1);
            color: var(--primary);
            padding: 4px 10px;
            border-radius: 4px;
            font-weight: 500;
            font-size: 0.9rem;
            margin-left: 5px;
        }

        /* Botones de acción en header */
        .header-actions {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
            justify-content: flex-end;
        }

        .btn-action {
            border: 1px solid var(--border-color);
            background: white;
            color: var(--text-muted);
            border-radius: 6px;
            padding: 0.45rem 0.85rem;
            font-size: 0.8rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            transition: all 0.2s ease;
            text-decoration: none;
            cursor: pointer;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
        }

        .btn-documentos {
            background: #f8f9fa;
            border-color: #ced4da;
            color: #495057;
        }

        .btn-documentos:hover {
            background: #e9ecef;
            border-color: #adb5bd;
            color: #212529;
            transform: translateY(-1px);
        }

        .btn-estadisticas {
            background: #e3f2fd;
            border-color: #90caf9;
            color: #1565c0;
        }

        .btn-estadisticas:hover {
            background: #bbdefb;
            border-color: #64b5f6;
            color: #0d47a1;
            transform: translateY(-1px);
        }

        /* Estado oculto para filtros */
        .teacher-hidden {
            display: none !important;
        }

        /* Diálogo de confirmación */
        .confirmation-dialog {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 9999;
            align-items: center;
            justify-content: center;
        }

        .confirmation-content {
            background: white;
            border-radius: 8px;
            padding: 1.5rem;
            max-width: 400px;
            width: 90%;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }

        /* Mensaje sin resultados */
        #noResultsMessage {
            border-radius: 8px;
            margin: 1rem 0;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .container-fluid {
                padding: 15px;
            }
            
            .table-responsive {
                font-size: 0.9rem;
            }
            
            .btn-group {
                flex-wrap: wrap;
                gap: 5px;
            }
            
            .header-actions {
                flex-direction: column;
                gap: 0.5rem;
                margin-top: 1rem;
            }
            
            .btn-action {
                width: 100%;
                justify-content: center;
            }
            
            /* Paginación responsive */
            .dataTables_wrapper .dataTables_paginate .paginate_button,
            .dataTables_wrapper .dataTables_paginate .pagination .page-link {
                padding: 3px 6px !important;
                min-width: 28px !important;
                height: 28px !important;
                font-size: 0.75rem !important;
                margin: 0 1px !important;
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

    <div class="container-fluid">
        <!-- Encabezado compacto y profesional - estilo segunda vista -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-lg-8 col-md-7 mb-3 mb-md-0">
                    <h1>
                        <i class="fas fa-users"></i> Maestros de la Coordinación: <span>{{ $coordinacion->nombre }}</span>
                    </h1>
                
                </div>
                <div class="col-lg-4 col-md-5 text-md-end">
                    <div class="header-actions">
                        <!-- Botón Estado de Documentos -->
                        <a href="{{ route('coordinaciones.estado-documentos', $coordinacion->id) }}" 
                           class="btn-action btn-documentos"
                           title="Ver estado de documentos de todos los maestros">
                            <i class="fas fa-clipboard-check"></i>
                            <span class="d-none d-md-inline">Estado de Documentos</span>
                        </a>
                        
                        <!-- Botón Estadísticas -->
                        <a href="{{ route('coordinaciones.estadisticas', $coordinacion->id) }}" 
                           class="btn-action btn-estadisticas"
                           title="Ver estadísticas de la coordinación">
                            <i class="fas fa-chart-pie"></i>
                            <span class="d-none d-md-inline">Estadísticas</span>
                        </a>
                        
                        <!-- Botón Volver -->
                        <a href="{{ route('coordinaciones.index') }}" 
                           class="btn-volver btn-sm">
                            <i class="fas fa-arrow-left"></i> Volver
                        </a>
                    </div>
                </div>
            </div>
        </div>

        @if($maestros->count() > 0)
        
            <!-- Resumen estadístico - estilo compacto -->
            <div class="resumen-alert">
                <div class="row text-center">
                    <div class="col-md-4 border-end">
                        <small class="text-muted d-block">Total</small>
                        <strong id="totalCount" class="badge bg-primary">{{ $maestros->count() }}</strong>
                    </div> 
                    <div class="col-md-4 border-end">
                        <small class="text-muted d-block">Activos</small>
                        <strong id="activeCount" class="badge bg-success">{{ $maestros->where('activo', true)->count() }}</strong>
                    </div>
                    <div class="col-md-4">
                        <small class="text-muted d-block">Inactivos</small>
                        <strong id="inactiveCount" class="badge bg-danger">{{ $maestros->where('activo', false)->count() }}</strong>
                    </div>
                </div>
            </div>
            
            <!-- NOTA SOBRE CAMBIO DE ESTADO -->
            <div class="alert alert-light border mb-3">
                <div class="d-flex align-items-center">
                    <i class="fas fa-info-circle text-primary me-2"></i>
                    <div>
                        <small class="text-muted">
                            <strong>Nota:</strong> Puede cambiar el estado de cualquier docente haciendo clic en el botón 
                            <span class="badge bg-success">Activo</span> o <span class="badge bg-danger">Inactivo</span>. 
                            El cambio se reflejará inmediatamente en el sistema.
                        </small>
                    </div>
                </div>
            </div>
            <!-- Mensaje cuando no hay resultados -->
            <div id="noResultsMessage" class="alert alert-warning d-none">
                <i class="fas fa-search me-2"></i>No se encontraron maestros con los criterios de búsqueda.
            </div>

            <!-- Tabla de Maestros - CON DATATABLES DE VISTA 2 -->
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="m-0">
                            <i class="fas fa-users me-2"></i>Listado de Maestros
                        </h6>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="dataTable">
                            <thead>
                                <tr>
                                    <th width="4%">#</th>
                                    <th width="15%">Nombre Completo</th>
                                    <th width="8%">Género</th>
                                    <th width="12%">Grado Académico</th>
                                    <th width="10%">Teléfono</th>
                                    <th width="10%">Estado</th>
                                    <th width="8%" class="text-end">Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="teachersTableBody">
                                @foreach($maestros as $index => $maestro)
                                <tr class="teacher-row" 
                                    data-maestro-id="{{ $maestro->id }}" 
                                    data-nombre-completo="{{ $maestro->nombres }} {{ $maestro->apellido_paterno }} {{ $maestro->apellido_materno }}"
                                    data-email="{{ $maestro->email }}"
                                    data-telefono="{{ $maestro->telefono }}"
                                    data-grado="{{ $maestro->maximo_grado_academico }}"
                                    data-genero="{{ $maestro->sexo }}"
                                    data-activo="{{ $maestro->activo }}">
                                    <td class="row-index">{{ $index + 1 }}</td>
                                    <td>
                                        <div class="maestro-info">
                                            <div class="maestro-nombre">{{ $maestro->nombres }} {{ $maestro->apellido_paterno }} {{ $maestro->apellido_materno }}</div>
                                        </div>
                                    </td>
                                    <td>
                                        @if($maestro->sexo == 'Masculino')
                                            <span class="badge-gender-male">
                                                <i class="fas fa-male me-1"></i>M
                                            </span>
                                        @elseif($maestro->sexo == 'Femenino')
                                            <span class="badge-gender-female">
                                                <i class="fas fa-female me-1"></i>F
                                            </span>
                                        @else
                                            <span class="badge-gender-other">
                                                <i class="fas fa-user me-1"></i>{{ $maestro->sexo ? substr($maestro->sexo, 0, 1) : 'N/A' }}
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary">
                                            {{ Str::limit($maestro->maximo_grado_academico, 20) }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($maestro->telefono)
                                            <i class="fas fa-phone text-muted me-1"></i>
                                            {{ $maestro->telefono }}
                                        @else
                                            <span class="text-muted">N/A</span>
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                            $estaActivo = $maestro->activo ?? true;
                                        @endphp
                                        <button class="status-btn {{ $estaActivo ? 'status-active' : 'status-inactive' }}" 
                                                data-maestro-id="{{ $maestro->id }}"
                                                data-actual-status="{{ $estaActivo ? 'active' : 'inactive' }}"
                                                data-maestro-nombre="{{ $maestro->nombres }} {{ $maestro->apellido_paterno }} {{ $maestro->apellido_materno }}">
                                            <i class="fas {{ $estaActivo ? 'fa-check-circle' : 'fa-times-circle' }} me-1"></i>
                                            {{ $estaActivo ? 'Activo' : 'Inactivo' }}
                                        </button>
                                    </td>
                                    
                                    <td class="text-end">
                                        <!-- Botón de acciones con dropdown -->
                                        <div class="dropdown">
                                            <button class="btn btn-actions dropdown-toggle" type="button" 
                                                    data-bs-toggle="dropdown" 
                                                    aria-expanded="false" title="Acciones">
                                                <i class="fas fa-cog"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('maestros.show', $maestro->id) }}">
                                                        <i class="fas fa-eye text-primary me-2"></i> 
                                                        <div>
                                                            <div>Ver expediente</div>
                                                        </div>
                                                    </a>
                                                </li>
                                                
                                                <li><hr class="dropdown-divider"></li>
                                                <li>
                                                    <a class="dropdown-item text-danger" href="#">
                                                        <i class="fas fa-trash-alt me-2"></i>
                                                        <div>
                                                            <div>Eliminar docente</div>
                                                        </div>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- LA PAGINACIÓN AHORA SE MANEJA CON DATATABLES - NO SE NECESITA EL CONTENEDOR SEPARADO -->

        @else
            <!-- Mensaje cuando no hay maestros -->
            <div class="no-data">
                <i class="fas fa-users-slash"></i>
                <h5 class="mt-3 mb-2">No hay maestros asignados</h5>
                <p class="mb-0">Esta coordinación no tiene maestros registrados.</p>
                <div class="mt-3">
                    <a href="{{ route('maestros.create') }}" class="btn btn-primary me-2">
                        <i class="fas fa-plus me-1"></i>Agregar Maestro
                    </a>
                    <a href="{{ route('coordinaciones.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i>Volver a Coordinaciones
                    </a>
                </div>
            </div>
        @endif
    </div>

    <!-- Diálogo de confirmación para cambio de estado -->
    <div class="confirmation-dialog" id="confirmationDialog">
        <div class="confirmation-content">
            <h5 class="mb-3" id="dialogTitle">Confirmar cambio de estado</h5>
            <p id="dialogMessage">¿Está seguro que desea cambiar el estado de este maestro?</p>
            <div class="d-flex justify-content-end gap-2 mt-4">
                <button type="button" class="btn btn-secondary" id="btnCancel">Cancelar</button>
                <button type="button" class="btn btn-primary" id="btnConfirm">Confirmar</button>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Variables globales
        let table;
        
        // Inicializar DataTable si la tabla existe
        if ($('#dataTable').length) {
            table = $('#dataTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json",
                    "paginate": {
                        "first": "«",
                        "last": "»",
                        "next": "›",
                        "previous": "‹"
                    },
                    "lengthMenu": "Mostrar _MENU_ registros por página",
                    "search": "Buscar:",
                    "zeroRecords": "No se encontraron registros coincidentes",
                    "emptyTable": "No hay datos disponibles en la tabla"
                },
                "order": [[0, "asc"]],
                "pageLength": 10,
                "responsive": true,
                "dom": '<"row"<"col-sm-12 col-md-6"f><"col-sm-12 col-md-6"l>>rt<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
                "initComplete": function() {
                    $('.dataTables_filter input').addClass('form-control form-control-sm').attr('placeholder', 'Buscar maestro...');
                    $('.dataTables_length select').addClass('form-select form-select-sm');
                },
                // Ocultar la información de registros
                "info": false,
                // Estilo para la paginación
                "drawCallback": function() {
                    $('.dataTables_paginate .pagination').addClass('pagination-sm');
                }
            });
        }
        
        // Evento para botones de estado
        document.querySelectorAll('.status-btn').forEach(button => {
            button.addEventListener('click', function() {
                const maestroId = this.getAttribute('data-maestro-id');
                const currentStatus = this.getAttribute('data-actual-status');
                const maestroNombre = this.getAttribute('data-maestro-nombre');
                const newStatus = currentStatus === 'active' ? 'inactive' : 'active';
                
                // Mostrar diálogo de confirmación
                showConfirmationDialog(maestroId, newStatus, this, maestroNombre);
            });
        });
        
        // Eventos para el diálogo de confirmación
        document.getElementById('btnCancel').addEventListener('click', function() {
            hideConfirmationDialog();
        });
        
        document.getElementById('btnConfirm').addEventListener('click', function() {
            const dialog = document.getElementById('confirmationDialog');
            const maestroId = dialog.getAttribute('data-maestro-id');
            const newStatus = dialog.getAttribute('data-new-status');
            const buttonElement = document.querySelector(`.status-btn[data-maestro-id="${maestroId}"]`);
            
            if (buttonElement) {
                updateTeacherStatus(maestroId, newStatus, buttonElement);
            }
            hideConfirmationDialog();
        });
        
        // Evento para búsqueda personalizada (opcional, ya que DataTables tiene su propio buscador)
        document.getElementById('btnSearch')?.addEventListener('click', function() {
            const searchValue = document.getElementById('searchNombreCompleto').value;
            if (table) {
                table.search(searchValue).draw();
                updateCounters();
            }
        });
        
        // Evento para Enter en el campo de búsqueda
        document.getElementById('searchNombreCompleto')?.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                document.getElementById('btnSearch').click();
            }
        });
        
        // Evento para limpiar filtros
        document.getElementById('btnReset')?.addEventListener('click', function() {
            document.getElementById('searchNombreCompleto').value = '';
            if (table) {
                table.search('').draw();
                updateCounters();
            }
        });
        
        // Función para mostrar diálogo de confirmación
        function showConfirmationDialog(maestroId, newStatus, buttonElement, maestroNombre) {
            const isActivating = newStatus === 'active';
            const dialog = document.getElementById('confirmationDialog');
            const title = document.getElementById('dialogTitle');
            const message = document.getElementById('dialogMessage');
            
            title.textContent = isActivating ? 'Activar Maestro' : 'Desactivar Maestro';
            message.textContent = `¿Está seguro que desea ${isActivating ? 'activar' : 'desactivar'} al maestro "${maestroNombre}"?`;
            
            // Guardar datos en el diálogo
            dialog.setAttribute('data-maestro-id', maestroId);
            dialog.setAttribute('data-new-status', newStatus);
            
            dialog.style.display = 'flex';
        }
        
        // Función para ocultar diálogo de confirmación
        function hideConfirmationDialog() {
            const dialog = document.getElementById('confirmationDialog');
            dialog.style.display = 'none';
            dialog.removeAttribute('data-maestro-id');
            dialog.removeAttribute('data-new-status');
        }
        
        // Función para actualizar contadores
        function updateCounters() {
            if (!table) return;
            
            // Contar maestros activos e inactivos
            let activeCount = 0;
            let inactiveCount = 0;
            
            // Iterar sobre las filas visibles de DataTables
            table.rows({ search: 'applied' }).every(function() {
                const row = this.node();
                const statusBtn = row.querySelector('.status-btn');
                if (statusBtn) {
                    const status = statusBtn.getAttribute('data-actual-status');
                    if (status === 'active') {
                        activeCount++;
                    } else {
                        inactiveCount++;
                    }
                }
            });
            
            const totalCount = table.rows({ search: 'applied' }).count();
            
            // Actualizar contadores en la alerta de resumen
            document.getElementById('totalCount').textContent = totalCount;
            document.getElementById('activeCount').textContent = activeCount;
            document.getElementById('inactiveCount').textContent = inactiveCount;
        }
        
        // Llamar a updateCounters cuando DataTables se redibuja
        if (table) {
            table.on('draw', function() {
                updateCounters();
            });
            
            // Inicializar contadores
            updateCounters();
        }
        
        // Función para actualizar el estado del maestro
        function updateTeacherStatus(maestroId, newStatus, buttonElement) {
            const isActive = newStatus === 'active';
            
            // Deshabilitar temporalmente el botón durante la actualización
            buttonElement.disabled = true;
            
            // Guardar el estado original para poder revertir si falla
            const originalStatus = buttonElement.getAttribute('data-actual-status');
            
            // Llamada AJAX al servidor
            fetch(`/coordinaciones/{{ $coordinacion->id }}/maestros/${maestroId}/status`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    activo: isActive
                })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error en la respuesta del servidor: ' + response.status);
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    // Actualizar la vista si el servidor responde con éxito
                    if (isActive) {
                        buttonElement.classList.remove('status-inactive');
                        buttonElement.classList.add('status-active');
                        buttonElement.innerHTML = '<i class="fas fa-check-circle me-1"></i>Activo';
                        buttonElement.setAttribute('data-actual-status', 'active');
                    } else {
                        buttonElement.classList.remove('status-active');
                        buttonElement.classList.add('status-inactive');
                        buttonElement.innerHTML = '<i class="fas fa-times-circle me-1"></i>Inactivo';
                        buttonElement.setAttribute('data-actual-status', 'inactive');
                    }
                    
                    // Actualizar el atributo data-activo en la fila
                    const teacherRow = buttonElement.closest('.teacher-row');
                    teacherRow.setAttribute('data-activo', isActive);
                    
                    // Actualizar contadores
                    updateCounters();
                    
                } else {
                    throw new Error(data.message || 'Error desconocido del servidor');
                }
            })
            .catch(error => {
                console.error('Error en la petición:', error);
                alert('Error al actualizar el estado: ' + error.message);
                
                // Revertir cambios visuales
                revertStatusChange(buttonElement, originalStatus === 'active');
            })
            .finally(() => {
                // Rehabilitar el botón siempre
                buttonElement.disabled = false;
            });
        }
        
        // Función para revertir cambios en caso de error
        function revertStatusChange(buttonElement, originalIsActive) {
            if (originalIsActive) {
                buttonElement.classList.remove('status-inactive');
                buttonElement.classList.add('status-active');
                buttonElement.innerHTML = '<i class="fas fa-check-circle me-1"></i>Activo';
                buttonElement.setAttribute('data-actual-status', 'active');
            } else {
                buttonElement.classList.remove('status-active');
                buttonElement.classList.add('status-inactive');
                buttonElement.innerHTML = '<i class="fas fa-times-circle me-1"></i>Inactivo';
                buttonElement.setAttribute('data-actual-status', 'inactive');
            }
            
            // Actualizar contadores
            updateCounters();
        }
    });
    </script>
</body>
</html>