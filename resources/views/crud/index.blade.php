<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios - Sistema GEPROC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
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
    }

    body { 
        background: white; 
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
        color: #333; 
        line-height: 1.6;
        padding: 0;
        margin: 0;
    }

    /* Barra superior */
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

    /* Barra de menú */
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

    /* Contenido principal */
    .main-content { 
        padding: 30px 20px;
        min-height: calc(100vh - 140px);
    }

    .content-container {
        background: white;
        border-radius: 6px;
        padding: 2rem;
        margin-bottom: 2rem;
        border: 1px solid var(--border-color);
        box-shadow: var(--card-shadow);
    }

    h1, h2, h3, h4, h5, h6 {
        font-weight: 600;
    }
    
    h2 { 
        color: var(--primary);
        margin-bottom: 1rem; 
        padding-bottom: 0.8rem;
        position: relative;
        font-size: 1.5rem;
    }
    
    h2::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 50px;
        height: 2px;
        background: var(--primary);
    }

    /* Estadísticas */
    .stats-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 1.5rem;
        margin: 2rem 0;
    }

    .stat-card {
        background: white;
        padding: 1.5rem;
        border-radius: 8px;
        text-align: center;
        border: 1px solid var(--border-color);
        transition: var(--transition);
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--card-shadow);
    }

    .stat-icon {
        font-size: 2.5rem;
        margin-bottom: 1rem;
    }

    .stat-value {
        font-size: 2.2rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        color: var(--primary);
    }

    .stat-label {
        color: var(--text-muted);
        font-size: 0.9rem;
        font-weight: 500;
    }

    .users-icon { color: var(--primary); }
    .admins-icon { color: #dc3545; }
    .profesores-icon { color: #ffc107; }
    .coordinacion-icon { color: #6f42c1; }

    /* Filtros */
    .filter-card {
        background: white;
        border-radius: 8px;
        border: 1px solid var(--border-color);
        box-shadow: var(--card-shadow);
        margin-bottom: 1.5rem;
    }

    .form-label-filter {
        font-weight: 500;
        color: var(--primary);
        font-size: 0.9rem;
        margin-bottom: 0.3rem;
    }

    .input-group .btn-filter {
        padding: 0.5rem 1rem;
        border-color: var(--border-color);
    }

    .input-group .btn-filter:hover {
        background-color: rgba(7, 68, 182, 0.05);
        border-color: var(--primary);
    }

    /* Información de resultados */
    .results-info {
        background: rgba(13, 110, 253, 0.05);
        border-left: 4px solid var(--primary);
        border-radius: 4px;
        padding: 0.75rem 1rem;
        margin-bottom: 1.5rem;
    }

    /* Paginación */
    .pagination-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 1rem 0;
        padding: 1rem 0;
        border-top: 1px solid var(--border-color);
    }

    .pagination-info {
        color: var(--text-muted);
        font-size: 0.9rem;
    }

    .pagination-custom .page-link {
        color: var(--primary);
        border: 1px solid var(--border-color);
        margin: 0 2px;
        border-radius: 4px !important;
        font-weight: 500;
        transition: var(--transition);
        padding: 0.5rem 0.9rem;
    }

    .pagination-custom .page-link:hover {
        background-color: rgba(7, 68, 182, 0.05);
        color: var(--primary);
        border-color: var(--primary);
    }

    .pagination-custom .page-item.active .page-link {
        background-color: var(--primary);
        border-color: var(--primary);
        color: white;
    }

    .pagination-custom .page-item.disabled .page-link {
        color: var(--text-muted);
        background-color: var(--light-bg);
    }

    /* Tabla */
    .table-responsive {
        border-radius: 6px;
        overflow: hidden;
        border: 1px solid var(--border-color);
    }

    .table {
        margin-bottom: 0;
    }

    .table thead th {
        background: rgba(7, 68, 182, 0.05);
        color: var(--primary);
        font-weight: 600;
        padding: 1rem;
        border-bottom: 2px solid var(--border-color);
    }

    .table tbody td {
        padding: 1rem;
        vertical-align: middle;
        border-bottom: 1px solid var(--border-color);
    }

    .table tbody tr:hover {
        background: rgba(7, 68, 182, 0.02);
    }

    /* Badges */
    .badge {
        font-weight: 500;
        padding: 0.4rem 0.8rem;
        font-size: 0.8rem;
    }

    .role-badge-admin {
        background: linear-gradient(135deg, #dc3545, #c82333);
        color: white;
    }

    .role-badge-profesor {
        background: linear-gradient(135deg, #28a745, #20c997);
        color: white;
    }

    .role-badge-coordinacion {
        background: linear-gradient(135deg, var(--primary), #0056b3);
        color: white;
    }

    /* Botones de acción */
    .action-btn {
        padding: 0.4rem 0.8rem;
        border: none;
        border-radius: 4px;
        font-size: 0.85rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        transition: var(--transition);
        font-weight: 500;
    }

    .edit-btn {
        background: rgba(255, 193, 7, 0.1);
        color: #ffc107;
        border: 1px solid rgba(255, 193, 7, 0.3);
    }

    .edit-btn:hover {
        background: #ffc107;
        color: #212529;
        transform: translateY(-2px);
        box-shadow: 0 3px 8px rgba(255, 193, 7, 0.2);
    }

    .delete-btn {
        background: rgba(220, 53, 69, 0.1);
        color: #dc3545;
        border: 1px solid rgba(220, 53, 69, 0.3);
    }

    .delete-btn:hover {
        background: #dc3545;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 3px 8px rgba(220, 53, 69, 0.2);
    }

    .btn-primary-custom {
        background: var(--primary);
        border: none;
        color: white;
        font-weight: 500;
        padding: 0.75rem 1.5rem;
        border-radius: 5px;
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 1rem;
    }

    .btn-primary-custom:hover {
        background: #063a9b;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(7, 68, 182, 0.2);
    }

    /* Header del contenido */
    .content-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .page-subtitle {
        color: var(--text-muted);
        font-size: 0.95rem;
        margin-bottom: 0;
    }

    /* Estado vacío */
    .empty-state {
        text-align: center;
        padding: 4rem 1rem;
        color: var(--text-muted);
    }

    .empty-state i {
        font-size: 3.5rem;
        margin-bottom: 1.5rem;
        opacity: 0.5;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .navbar-brand {
            font-size: 1.2rem;
        }
        
        .navbar-menu .nav-link {
            padding: 0.5rem 1rem !important;
            margin: 0.1rem 0;
        }
        
        .main-content {
            padding: 20px 15px;
        }
        
        .content-container {
            padding: 1.5rem;
        }
        
        .navbar-menu {
            top: 60px;
        }
        
        .logo-img {
            height: 45px;
        }
        
        .navbar-menu .user-info-container {
            flex-direction: column;
            gap: 10px;
            align-items: flex-end;
            margin-top: 10px;
            padding-top: 10px;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .content-header {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .stats-container {
            grid-template-columns: 1fr;
        }
        
        .table-responsive {
            font-size: 0.9rem;
        }
        
        .action-btn {
            padding: 0.3rem 0.6rem;
            font-size: 0.8rem;
        }
        
        .pagination-container {
            flex-direction: column;
            gap: 1rem;
            text-align: center;
        }
    }

    @media (max-width: 576px) {
        h2 {
            font-size: 1.3rem;
        }
        
        .logo-img {
            height: 40px;
        }
        
        .stat-card {
            padding: 1.2rem;
        }
        
        .stat-value {
            font-size: 1.8rem;
        }
        
        .stat-icon {
            font-size: 2rem;
        }
        
        .table thead {
            display: none;
        }
        
        .table tbody tr {
            display: block;
            margin-bottom: 1rem;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            padding: 1rem;
        }
        
        .table tbody td {
            display: block;
            text-align: right;
            border: none;
            padding: 0.5rem 0;
            position: relative;
        }
        
        .table tbody td::before {
            content: attr(data-label);
            position: absolute;
            left: 0;
            width: 50%;
            padding-right: 10px;
            font-weight: 600;
            color: var(--primary);
            text-align: left;
        }
        
        .table tbody td .d-flex {
            justify-content: flex-end;
        }
        
        .pagination-custom .page-link {
            padding: 0.4rem 0.7rem;
            font-size: 0.85rem;
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

    <!-- Segunda barra - Menú -->
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
                    <li class="nav-item"><a class="nav-link active {{ request()->routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}">Accesos</a></li>
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
                <div class="content-container">
                    <!-- Header del contenido -->
                    <div class="content-header">
                        <div>
                            <h2><i class="fas fa-users me-2"></i>Gestión de Usuarios</h2>
                            <p class="page-subtitle">Administra los usuarios y permisos del sistema</p>
                        </div>
                        <a href="{{ route('users.create') }}" class="btn-primary-custom">
                            <i class="fas fa-plus-circle me-2"></i>Nuevo Usuario
                        </a>
                    </div>

                    <!-- Alertas -->
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <!-- Estadísticas -->
                    <div class="stats-container">
                        <div class="stat-card">
                            <div class="stat-icon users-icon"><i class="fas fa-users"></i></div>
                            <div class="stat-value">{{ $totalUsers }}</div>
                            <div class="stat-label">Usuarios Totales</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon admins-icon"><i class="fas fa-user-shield"></i></div>
                            <div class="stat-value">{{ $adminUsers }}</div>
                            <div class="stat-label">Administradores</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon profesores-icon"><i class="fas fa-chalkboard-teacher"></i></div>
                            <div class="stat-value">{{ $profesorUsers }}</div>
                            <div class="stat-label">Profesores</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon coordinacion-icon"><i class="fas fa-building"></i></div>
                            <div class="stat-value">{{ $coordinacionUsers }}</div>
                            <div class="stat-label">Coordinaciones</div>
                        </div>
                    </div>

                    <!-- Filtros de búsqueda -->
                    <div class="filter-card">
                        <div class="card-body">
                            <form method="GET" action="{{ route('users.index') }}" class="row g-3">
                                <div class="col-md-5">
                                    <label for="search" class="form-label-filter">
                                        <i class="fas fa-search me-1"></i>Buscar por nombre o email
                                    </label>
                                    <div class="input-group">
                                        <input type="text" 
                                               class="form-control" 
                                               id="search" 
                                               name="search" 
                                               placeholder="Nombre, apellido o email..." 
                                               value="{{ request('search') }}"
                                               aria-label="Buscar usuarios">
                                        <button class="btn btn-outline-primary btn-filter" type="submit">
                                            <i class="fas fa-search"></i> Buscar
                                        </button>
                                        @if(request('search'))
                                        <a href="{{ route('users.index', array_merge(request()->except('search'))) }}" 
                                           class="btn btn-outline-secondary btn-filter" 
                                           type="button"
                                           title="Limpiar búsqueda">
                                            <i class="fas fa-times"></i>
                                        </a>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="col-md-3">
                                    <label for="role" class="form-label-filter">
                                        <i class="fas fa-user-tag me-1"></i>Filtrar por rol
                                    </label>
                                    <select class="form-select" id="role" name="role" onchange="this.form.submit()">
                                        <option value="">Todos los roles</option>
                                        <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Administrador</option>
                                        <option value="profesor" {{ request('role') == 'profesor' ? 'selected' : '' }}>Profesor</option>
                                        <option value="coordinacion" {{ request('role') == 'coordinacion' ? 'selected' : '' }}>Coordinación</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-3">
                                    <label for="coordinacion" class="form-label-filter">
                                        <i class="fas fa-building me-1"></i>Filtrar por coordinación
                                    </label>
                                    <select class="form-select" id="coordinacion" name="coordinacion" onchange="this.form.submit()">
                                        <option value="">Todas las coordinaciones</option>
                                        @foreach($coordinaciones as $coord)
                                            <option value="{{ $coord->id }}" {{ request('coordinacion') == $coord->id ? 'selected' : '' }}>
                                                {{ $coord->display_name ?? $coord->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="col-md-1 d-flex align-items-end">
                                    @if(request()->anyFilled(['search', 'role', 'coordinacion']))
                                    <a href="{{ route('users.index') }}" 
                                       class="btn btn-outline-danger w-100" 
                                       title="Limpiar todos los filtros">
                                        <i class="fas fa-filter-circle-xmark"></i>
                                    </a>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Resultados de búsqueda -->
                    @if(request()->anyFilled(['search', 'role', 'coordinacion']))
                    <div class="results-info">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-filter me-2 text-primary"></i>
                            <div>
                                <strong>Filtros aplicados:</strong>
                                @if(request('search'))
                                    <span class="badge bg-primary ms-2">
                                        <i class="fas fa-search me-1"></i> "{{ request('search') }}"
                                    </span>
                                @endif
                                @if(request('role'))
                                    <span class="badge bg-info ms-2">
                                        <i class="fas fa-user-tag me-1"></i> {{ ucfirst(request('role')) }}
                                    </span>
                                @endif
                                @if(request('coordinacion'))
                                    <span class="badge bg-warning text-dark ms-2">
                                        <i class="fas fa-building me-1"></i> 
                                        @php
                                            $coordSelected = $coordinaciones->firstWhere('id', request('coordinacion'));
                                        @endphp
                                        {{ $coordSelected->display_name ?? $coordSelected->nombre ?? 'N/A' }}
                                    </span>
                                @endif
                                <a href="{{ route('users.index') }}" class="btn btn-sm btn-link ms-2">
                                    <i class="fas fa-times"></i> Limpiar filtros
                                </a>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Información de paginación -->
                    @if($users->total() > 0)
                    <div class="pagination-container">
                        <div class="pagination-info">
                            Mostrando {{ $users->firstItem() ?? 0 }} - {{ $users->lastItem() ?? 0 }} de {{ $users->total() }} usuarios
                            @if(request()->anyFilled(['search', 'role', 'coordinacion']))
                                <span class="text-primary">(Filtrados)</span>
                            @endif
                        </div>
                        <div>
                            <nav aria-label="Paginación de usuarios">
                                <ul class="pagination pagination-custom mb-0">
                                    {{ $users->withQueryString()->links('pagination::bootstrap-5') }}
                                </ul>
                            </nav>
                        </div>
                    </div>
                    @endif

                    <!-- Tabla de usuarios -->
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Correo Electrónico</th>
                                    <th>Rol</th>
                                    <th>Coordinación</th>
                                    <th>Fecha Registro</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($users->count() > 0)
                                    @foreach($users as $user)
                                    <tr>
                                        <td data-label="ID"><strong>#{{ $user->id }}</strong></td>
                                        <td data-label="Nombre">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-user-circle me-2 text-primary"></i>
                                                {{ $user->name }}
                                                @if($user->id === auth()->id())
                                                    <span class="badge bg-info ms-2">Tú</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td data-label="Correo">{{ $user->email }}</td>
                                        <td data-label="Rol">
                                            @if($user->role === 'admin')
                                                <span class="badge role-badge-admin"><i class="fas fa-crown me-1"></i>Administrador</span>
                                            @elseif($user->role === 'profesor')
                                                <span class="badge role-badge-profesor"><i class="fas fa-chalkboard-teacher me-1"></i>Profesor</span>
                                            @elseif($user->role === 'coordinacion')
                                                <span class="badge role-badge-coordinacion"><i class="fas fa-building me-1"></i>Coordinación</span>
                                            @else
                                                <span class="badge bg-secondary">{{ $user->role }}</span>
                                            @endif
                                        </td>
                                        <td data-label="Coordinación">
                                            @if($user->coordinacion)
                                                <span class="badge bg-secondary">
                                                    <i class="fas fa-university me-1"></i>
                                                    {{ $user->coordinacion->display_name ?? $user->coordinacion->nombre }}
                                                </span>
                                            @else
                                                <span class="badge bg-light text-dark border">No asignada</span>
                                            @endif
                                        </td>
                                        <td data-label="Fecha Registro"><small class="text-muted">{{ $user->created_at->format('d/m/Y') }}</small></td>
                                        <td data-label="Acciones">
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('users.edit', $user) }}" class="action-btn edit-btn">
                                                    <i class="fas fa-edit"></i> Editar
                                                </a>
                                                <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="action-btn delete-btn"
                                                        onclick="return confirm('¿Está seguro de eliminar al usuario {{ $user->name }}? Esta acción no se puede deshacer.')"
                                                        {{ $user->id === auth()->id() ? 'disabled' : '' }}>
                                                        <i class="fas fa-trash"></i> Eliminar
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="7" class="text-center py-4">
                                            <div class="empty-state">
                                                @if(request()->anyFilled(['search', 'role', 'coordinacion']))
                                                    <i class="fas fa-search fa-3x mb-3"></i>
                                                    <h4 class="mb-2">No se encontraron usuarios</h4>
                                                    <p class="text-muted mb-4">No hay resultados que coincidan con tus filtros de búsqueda.</p>
                                                    <a href="{{ route('users.index') }}" class="btn-primary-custom">
                                                        <i class="fas fa-times me-2"></i>Limpiar filtros
                                                    </a>
                                                @else
                                                    <i class="fas fa-users fa-3x mb-3"></i>
                                                    <h4 class="mb-2">No hay usuarios registrados</h4>
                                                    <p class="text-muted mb-4">Comience creando el primer usuario del sistema.</p>
                                                    <a href="{{ route('users.create') }}" class="btn-primary-custom">
                                                        <i class="fas fa-plus-circle me-2"></i>Crear Primer Usuario
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                    <!-- Paginación inferior -->
                    @if($users->total() > 0)
                    <div class="pagination-container">
                        <div class="pagination-info">
                            Página {{ $users->currentPage() }} de {{ $users->lastPage() }}
                        </div>
                        <div>
                            <nav aria-label="Paginación inferior de usuarios">
                                <ul class="pagination pagination-custom mb-0">
                                    {{ $users->withQueryString()->links('pagination::bootstrap-5') }}
                                </ul>
                            </nav>
                        </div>
                    </div>
                    @endif
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

            // Cerrar alertas automáticamente después de 5 segundos
            setTimeout(() => {
                document.querySelectorAll('.alert').forEach(alert => {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                });
            }, 5000);

            // Confirmación para eliminar usuarios
            document.querySelectorAll('.delete-btn:not([disabled])').forEach(button => {
                button.addEventListener('click', function(e) {
                    if (!confirm('¿Está seguro de eliminar este usuario? Esta acción no se puede deshacer.')) {
                        e.preventDefault();
                    }
                });
            });

            // Para diseño responsive de tablas
            document.querySelectorAll('.table tbody td').forEach(cell => {
                const th = cell.closest('tr').querySelector('th');
                if (th) {
                    cell.setAttribute('data-label', th.textContent);
                }
            });

            // Auto-enfoque en campo de búsqueda cuando se presiona Ctrl+F
            document.addEventListener('keydown', function(e) {
                if ((e.ctrlKey || e.metaKey) && e.key === 'f') {
                    e.preventDefault();
                    const searchInput = document.getElementById('search');
                    if (searchInput) {
                        searchInput.focus();
                        searchInput.select();
                    }
                }
            });

            // Limpiar filtros individuales
            document.querySelectorAll('.btn-filter-clear').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const param = this.getAttribute('data-param');
                    const url = new URL(window.location.href);
                    url.searchParams.delete(param);
                    window.location.href = url.toString();
                });
            });

        })();
    </script>
</body>
</html>