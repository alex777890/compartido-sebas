<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estado de Documentos - {{ $coordinacion->nombre ?? 'Coordinación' }}</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    
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

        /* ========== ESTILOS DE LA VISTA ========== */
        .container-fluid {
            padding: 20px;
            max-width: 1400px;
            margin: 0 auto;
        }

        /* Encabezado simplificado - estilo segunda vista */
        .page-header {
            background: white;
            border-bottom: 2px solid var(--primary);
            padding: 10px 0;
            margin-bottom: 5px;
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

        /* BOTÓN VOLVER MEJORADO */
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

        /* Filtro compacto */
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

        /* Estadísticas compactas */
        .stats-container {
            background: white;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
            box-shadow: var(--card-shadow);
        }

        .stat-item {
            text-align: center;
            padding: 10px 5px;
        }

        .stat-value {
            font-weight: 700;
            font-size: 1.4rem;
            margin-bottom: 5px;
        }

        .stat-label {
            font-size: 0.8rem;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .stat-total { color: var(--primary); }
        .stat-success { color: var(--accent); }
        .stat-warning { color: #f0ad4e; }
        .stat-danger { color: #d9534f; }

        /* Tarjeta principal */
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

        /* Tabla - Manteniendo el estilo original pero más profesional */
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

        /* Badges mejorados */
        .badge-status {
            padding: 6px 12px;
            font-weight: 500;
            font-size: 0.8rem;
            border-radius: 6px;
            min-width: 100px;
            display: inline-block;
        }

        .badge-documentos {
            padding: 6px 12px;
            font-weight: 600;
            font-size: 0.9rem;
            border-radius: 6px;
            display: inline-block;
        }

        .badge-danger {
            background: linear-gradient(135deg, #ff6b6b 0%, #ee5a52 100%);
            border: none;
        }

        .badge-success {
            background: linear-gradient(135deg, #26E63F 0%, #1ec535 100%);
            border: none;
        }

        .badge-warning {
            background: linear-gradient(135deg, #ffd166 0%, #f9c74f 100%);
            color: #333;
            border: none;
        }

        .badge-info {
            background: linear-gradient(135deg, #33CAE6 0%, #2aaec5 100%);
            border: none;
        }

        .badge-secondary {
            background: linear-gradient(135deg, #6c757d 0%, #5a6268 100%);
            border: none;
        }

        /* Botones compactos pero profesionales */
        .btn-group .btn {
            padding: 6px 12px;
            font-size: 0.85rem;
            border-radius: 5px;
        }

        .btn-primary {
            background: var(--primary);
            border: none;
            font-size: 0.85rem;
            padding: 6px 12px;
        }

        .btn-primary:hover {
            background: #063a9c;
        }

        .btn-info {
            background: var(--secondary);
            border: none;
            font-size: 0.85rem;
            padding: 6px 12px;
        }

        .btn-info:hover {
            background: #2aaec5;
        }

        .btn-outline-info {
            border-color: var(--secondary);
            color: var(--secondary);
            font-size: 0.85rem;
            padding: 6px 12px;
        }

        .btn-outline-info:hover {
            background: var(--secondary);
            border-color: var(--secondary);
            color: white;
        }

        .btn-success {
            background: var(--accent);
            border: none;
            font-size: 0.85rem;
            padding: 6px 12px;
        }

        .btn-success:hover {
            background: #1ec535;
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

        /* Progress bar */
        .progress {
            height: 8px;
            border-radius: 4px;
            background-color: #e9ecef;
            overflow: hidden;
            margin: 5px 0;
        }

        .progress-bar {
            border-radius: 4px;
        }

        /* ========== PAGINACIÓN DATATABLES PEQUEÑA ========== */
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

        /* Información de maestro */
        .maestro-info {
            display: flex;
            flex-direction: column;
        }

        .maestro-nombre {
            font-weight: 600;
            font-size: 0.95rem;
            color: #333;
        }

        .maestro-coordinacion {
            font-size: 0.8rem;
            color: var(--text-muted);
        }

        /* Contador de documentos */
        .document-counter {
            display: flex;
            gap: 10px;
            justify-content: center;
            font-size: 0.8rem;
            margin-top: 5px;
        }

        .counter-success { color: var(--accent); }
        .counter-danger { color: #d9534f; }
        .counter-warning { color: #f0ad4e; }

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

        /* Leyenda de estado */
        .legend-estado {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            margin-top: 10px;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 0.8rem;
            color: var(--text-muted);
        }

        .legend-color {
            width: 12px;
            height: 12px;
            border-radius: 2px;
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
        <!-- Encabezado compacto y profesional -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-lg-8 col-md-7 mb-3 mb-md-0">
                    <h1>
                        <i class="fas fa-clipboard-check"></i>Estado de Documentos: {{ $coordinacion->nombre ?? 'Coordinación no especificada' }}
                    </h1>
                </div>
                <div class="col-lg-4 col-md-5 text-md-end">
                    @if(isset($periodoActual) && $periodoActual)
                    <span class="periodo-info mb-2 d-inline-block">
                        <i class="fas fa-calendar-alt"></i>
                        {{ $periodoActual->nombre }}
                    </span>
                    @else
                    <span class="periodo-info inactive mb-2 d-inline-block">
                        <i class="fas fa-calendar-times"></i>
                        Sin período seleccionado
                    </span>
                    @endif
                    <div class="mt-2">
                        <a href="{{ route('coordinaciones.show', $coordinacion->id ?? '') }}" 
                           class="btn btn-volver btn-sm">
                            <i class="fas fa-arrow-left"></i> Volver
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filtro por período -->
        @if(isset($periodosDisponibles) && $periodosDisponibles->count() > 0)
        <div class="filtro-compacto">
            <form method="GET" action="" class="row g-2 align-items-center">
                <div class="col-md-5">
                    <label for="periodo_id" class="form-label mb-1">
                        <i class="fas fa-filter me-2"></i>Filtrar por período:
                    </label>
                    <select name="periodo_id" id="periodo_id" class="form-select" onchange="this.form.submit()">
                        <option value="">-- Seleccionar período --</option>
                        @foreach($periodosDisponibles as $periodo)
                        <option value="{{ $periodo->id }}" 
                            {{ isset($periodoActual) && $periodoActual->id == $periodo->id ? 'selected' : '' }}>
                            {{ $periodo->nombre }} 
                            ({{ \Carbon\Carbon::parse($periodo->fecha_inicio)->format('d/m/Y') }} - 
                             {{ \Carbon\Carbon::parse($periodo->fecha_fin)->format('d/m/Y') }})
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    @if(request()->has('periodo_id'))
                    <a href="{{ route('coordinaciones.estado-documentos', $coordinacion->id) }}" 
                       class="btn btn-outline-secondary btn-sm w-100 mt-4">
                        <i class="fas fa-times me-1"></i> Limpiar
                    </a>
                    @endif
                </div>
                <div class="col-md-4 text-md-end">
                    <small class="text-muted">
                        <i class="fas fa-info-circle me-1"></i>
                        Selecciona un período para ver documentos específicos
                    </small>
                </div>
            </form>
        </div>
        @endif

        <!-- Estadísticas (solo si hay período) -->
        @if(isset($estadisticasGenerales['hay_periodo']) && $estadisticasGenerales['hay_periodo'])
        <div class="stats-container">
            <div class="row g-2">
                <div class="col-xl-3 col-md-6">
                    <div class="stat-item">
                        <div class="stat-value stat-total">{{ $estadisticasGenerales['total_maestros'] ?? 0 }}</div>
                        <div class="stat-label">Total Maestros</div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="stat-item">
                        <div class="stat-value stat-success">{{ $estadisticasGenerales['completados'] ?? 0 }}</div>
                        <div class="stat-label">Completados</div>
                        <div class="text-success small">{{ $estadisticasGenerales['porcentaje_completado'] ?? 0 }}%</div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="stat-item">
                        <div class="stat-value stat-warning">{{ $estadisticasGenerales['en_proceso'] ?? 0 }}</div>
                        <div class="stat-label">En Proceso</div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="stat-item">
                        <div class="stat-value stat-danger">{{ $estadisticasGenerales['sin_subir'] ?? 0 }}</div>
                        <div class="stat-label">Sin Subir</div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Tabla de Maestros (Manteniendo estructura original pero con mejor diseño) -->
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="m-0">
                        <i class="fas fa-users me-2"></i>Listado de Maestros
                        @if(isset($periodoActual) && $periodoActual)
                        <small class="text-muted ms-2">(Período: {{ $periodoActual->nombre }})</small>
                        @endif
                    </h6>
                    
                </div>
            </div>
            <div class="card-body">
                @if(isset($maestrosConEstadisticas) && $maestrosConEstadisticas->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover" id="dataTable">
                        <thead>
                            <tr>
                                <th width="60">#</th>
                                <th>Maestro</th>
                                <th width="140">Estado</th>
                                <th width="140">Documentos</th>
                                <th width="160" class="text-end">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($maestrosConEstadisticas as $maestro)
                            <tr>
                                <td class="text-center fw-bold text-primary">{{ $maestro['numero'] }}</td>
                                <td>
                                    <div class="maestro-info">
                                        <div class="maestro-nombre">{{ $maestro['nombres'] }}</div>
                                        @if(isset($maestro['coordinacion']))
                                        <div class="maestro-coordinacion">{{ $maestro['coordinacion'] }}</div>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    @if($maestro['hay_periodo'] === false)
                                    <span class="badge-status badge-secondary">
                                        <i class="fas fa-calendar-times me-1"></i> SIN PERÍODO
                                    </span>
                                    @elseif($maestro['total_subidos'] == 0)
                                    <span class="badge-status badge-danger">
                                        <i class="fas fa-times me-1"></i> {{ $maestro['texto_estado'] }}
                                    </span>
                                    @elseif($maestro['color_estado'] == 'success')
                                    <span class="badge-status badge-success">
                                        <i class="fas fa-check me-1"></i> {{ $maestro['texto_estado'] }}
                                    </span>
                                    @else
                                    <span class="badge-status badge-warning">
                                        <i class="fas fa-exclamation-triangle me-1"></i> {{ $maestro['texto_estado'] }}
                                    </span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($maestro['hay_periodo'] === false)
                                    <span class="text-muted fst-italic">-</span>
                                    @elseif($maestro['total_subidos'] > 0)
                                    <div class="badge-documentos badge-warning">
                                        {{ $maestro['total_subidos'] }}/{{ $maestro['total_requeridos'] }}
                                    </div>
                                    <div class="document-counter">
                                        @if($maestro['aprobados'] > 0)
                                        <span class="counter-success">
                                            <i class="fas fa-check"></i> {{ $maestro['aprobados'] }}
                                        </span>
                                        @endif
                                        @if($maestro['rechazados'] > 0)
                                        <span class="counter-danger">
                                            <i class="fas fa-times"></i> {{ $maestro['rechazados'] }}
                                        </span>
                                        @endif
                                        @if($maestro['pendientes'] > 0)
                                        <span class="counter-warning">
                                            <i class="fas fa-clock"></i> {{ $maestro['pendientes'] }}
                                        </span>
                                        @endif
                                    </div>
                                    @else
                                    <span class="text-muted">Sin documentos</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <div class="btn-group btn-group-sm" role="group">
                                        @if($maestro['hay_periodo'] === true)
                                        <a href="{{ route('maestros.revision-documentos', ['coordinacionId' => $coordinacion->id, 'maestroId' => $maestro['id']]) }}" 
                                           class="btn btn-primary" title="Revisar Documentos">
                                            <i class="fas fa-file-alt"></i>
                                        </a>
                                        <button type="button" class="btn btn-info dropdown-toggle" 
                                                data-bs-toggle="dropdown" aria-expanded="false" title="Más opciones">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        @else
                                        <a href="{{ route('maestros.historial-documentos', [
                                            'coordinacionId' => $coordinacion->id, 
                                            'maestroId' => $maestro['id']
                                        ]) }}" 
                                           class="btn btn-outline-info" title="Ver Historial">
                                            <i class="fas fa-history"></i>
                                        </a>
                                        @endif
                                        
                                        @if($maestro['hay_periodo'] === true)
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <h6 class="dropdown-header">Detalles de Documentos</h6>
                                            <div class="px-3 py-2 small">
                                                <div class="d-flex justify-content-between mb-2">
                                                    <span class="fw-medium">Progreso:</span>
                                                    <span class="fw-semibold">{{ $maestro['porcentaje'] }}%</span>
                                                </div>
                                                <div class="progress mb-3">
                                                    <div class="progress-bar bg-{{ $maestro['color_estado'] }}" 
                                                         style="width: {{ $maestro['porcentaje'] }}%">
                                                    </div>
                                                </div>
                                                
                                                <div class="row mb-2">
                                                    <div class="col-6">
                                                        <div class="fw-medium text-muted">Requeridos</div>
                                                        <div class="fw-semibold">{{ $maestro['total_requeridos'] }}</div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="fw-medium text-muted">Subidos</div>
                                                        <div class="fw-semibold">{{ $maestro['total_subidos'] }}</div>
                                                    </div>
                                                </div>
                                                
                                                <div class="row">
                                                    <div class="col-4 text-center">
                                                        <div class="text-success">
                                                            <i class="fas fa-check fa-lg mb-1"></i>
                                                            <div class="small">{{ $maestro['aprobados'] }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-4 text-center">
                                                        <div class="text-danger">
                                                            <i class="fas fa-times fa-lg mb-1"></i>
                                                            <div class="small">{{ $maestro['rechazados'] }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-4 text-center">
                                                        <div class="text-warning">
                                                            <i class="fas fa-clock fa-lg mb-1"></i>
                                                            <div class="small">{{ $maestro['pendientes'] }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="no-data">
                    <i class="fas fa-users-slash"></i>
                    <h5 class="mt-3 mb-2">No hay maestros en esta coordinación</h5>
                    <p class="mb-0">No se encontraron maestros registrados en esta coordinación.</p>
                </div>
                @endif
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
        $(document).ready(function() {
            // Inicializar DataTable si la tabla existe
            if ($('#dataTable').length) {
                $('#dataTable').DataTable({
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json",
                        "paginate": {
                            "first": "«",
                            "last": "»",
                            "next": "›",
                            "previous": "‹"
                        },
                        "lengthMenu": "Mostrar _MENU_ registros por página"
                    },
                    "order": [[0, "asc"]],
                    "pageLength": 25,
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
            
            // Inicializar tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
            
            // Auto-submit del filtro de período cuando cambia
            $('#periodo_id').on('change', function() {
                if (this.value) {
                    this.form.submit();
                }
            });
        });
    </script>
</body>
</html>