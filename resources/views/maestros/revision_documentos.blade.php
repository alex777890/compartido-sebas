<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Revisión de Documentos - {{ $maestro->nombres }} - {{ $coordinacion->nombre }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

        /* ========== ESTILOS NUEVOS PARA EL CUERPO DE LA VISTA ========== */
        .main-content {
            padding: 25px 20px;
            min-height: calc(100vh - 140px);
            background-color: var(--light-bg);
        }

        /* Encabezado compacto y profesional */
        .main-header {
            background: white;
            border-radius: 8px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border: 1px solid var(--border-color);
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .main-header h3 {
            color: var(--primary);
            font-weight: 600;
            margin: 0;
            font-size: 1.4rem;
        }

        .header-subtitle {
            color: var(--text-muted);
            font-size: 0.9rem;
            margin-top: 0.3rem;
        }

        .btn-volver {
            background: transparent;
            border: 1px solid var(--primary);
            color: var(--primary);
            font-weight: 500;
            transition: var(--transition);
            font-size: 0.85rem;
            padding: 0.4rem 0.8rem;
        }

        .btn-volver:hover {
            background: var(--primary);
            color: white;
            transform: translateX(-3px);
        }

        /* Info card compacta */
        .info-card {
            background: white;
            border-radius: 8px;
            padding: 1.2rem;
            margin-bottom: 1.5rem;
            border: 1px solid var(--border-color);
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .coordinacion-info {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 0;
        }

        .coordinacion-icon {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), #063a9e);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
            flex-shrink: 0;
        }

        .coordinacion-details h5 {
            margin: 0;
            font-weight: 600;
            color: var(--primary);
            font-size: 1.1rem;
        }

        .coordinacion-details p {
            margin: 0;
            color: var(--text-muted);
            font-size: 0.85rem;
        }

        /* Maestro info compacta */
        .maestro-info {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 0;
        }

        .maestro-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            border: 2px solid var(--border-color);
            flex-shrink: 0;
        }

        .maestro-details h5 {
            margin: 0;
            font-weight: 600;
            color: var(--primary);
            font-size: 1.1rem;
        }

        .maestro-details p {
            margin: 0;
            color: var(--text-muted);
            font-size: 0.85rem;
        }

        /* Sección de documentos */
        .documentos-section {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            margin-bottom: 1.5rem;
            border: 1px solid var(--border-color);
            overflow: hidden;
        }

        .section-header {
            background-color: white;
            padding: 1.2rem 1.5rem;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .section-header h4 {
            margin: 0;
            color: var(--primary);
            font-weight: 600;
            font-size: 1.2rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .section-content {
            padding: 1.5rem;
        }

        /* Tabla compacta */
        .table-compact {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            font-size: 0.9rem;
        }

        .table-compact th {
            background-color: var(--light-bg);
            color: var(--primary);
            font-weight: 600;
            padding: 0.8rem 1rem;
            border-bottom: 2px solid var(--border-color);
            text-align: left;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .table-compact td {
            padding: 0.8rem 1rem;
            vertical-align: middle;
            border-bottom: 1px solid var(--border-color);
        }

        .table-compact tbody tr:hover {
            background-color: rgba(7, 68, 182, 0.02);
        }

        /* Badges mejorados */
        .badge-estado {
            padding: 0.25rem 0.6rem;
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .badge-pendiente {
            background-color: rgba(255, 193, 7, 0.15);
            color: #856404;
        }

        .badge-aprobado {
            background-color: rgba(40, 167, 69, 0.15);
            color: #155724;
        }

        .badge-rechazado {
            background-color: rgba(220, 53, 69, 0.15);
            color: #721c24;
        }

        /* Botones pequeños */
        .btn-group-compact .btn {
            padding: 0.2rem 0.4rem;
            font-size: 0.8rem;
        }

        .btn-success-sm {
            background-color: rgba(40, 167, 69, 0.1);
            border-color: rgba(40, 167, 69, 0.2);
            color: #155724;
            font-size: 0.8rem;
            padding: 0.2rem 0.4rem;
        }

        .btn-success-sm:hover {
            background-color: rgba(40, 167, 69, 0.2);
            border-color: #28a745;
        }

        .btn-danger-sm {
            background-color: rgba(220, 53, 69, 0.1);
            border-color: rgba(220, 53, 69, 0.2);
            color: #721c24;
            font-size: 0.8rem;
            padding: 0.2rem 0.4rem;
        }

        .btn-danger-sm:hover {
            background-color: rgba(220, 53, 69, 0.2);
            border-color: #dc3545;
        }

        .btn-info-sm {
            background-color: rgba(23, 162, 184, 0.1);
            border-color: rgba(23, 162, 184, 0.2);
            color: #0c5460;
            font-size: 0.8rem;
            padding: 0.2rem 0.4rem;
        }

        .btn-info-sm:hover {
            background-color: rgba(23, 162, 184, 0.2);
            border-color: #17a2b8;
        }

        /* Observaciones compactas */
        .observaciones-compact textarea {
            font-size: 0.85rem;
            resize: vertical;
            min-height: 60px;
            border: 1px solid var(--border-color);
            border-radius: 4px;
            padding: 0.5rem;
            width: 100%;
        }

        .observaciones-compact textarea:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.2rem rgba(7, 68, 182, 0.15);
            outline: none;
        }

        .observaciones-leidas {
            font-size: 0.85rem;
            color: var(--text-muted);
            background-color: rgba(7, 68, 182, 0.03);
            padding: 0.6rem;
            border-radius: 4px;
            border-left: 3px solid var(--primary);
            max-height: 100px;
            overflow-y: auto;
            cursor: pointer;
            transition: var(--transition);
        }

        .observaciones-leidas:hover {
            background-color: rgba(7, 68, 182, 0.06);
        }

        /* Resumen de estado */
        .estado-resumen {
            background-color: var(--light-bg);
            padding: 1rem 1.5rem;
            border-top: 1px solid var(--border-color);
        }

        .estado-resumen .badge {
            font-size: 0.8rem;
            padding: 0.3rem 0.6rem;
        }

        /* Período selector */
        .periodo-selector {
            background: white;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            padding: 0.8rem 1rem;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 1.5rem;
        }

        .periodo-badge {
            font-size: 0.85rem;
            padding: 0.4rem 0.8rem;
        }

        /* Mensajes de alerta */
        .alert-compact {
            padding: 0.8rem 1rem;
            font-size: 0.9rem;
            margin-bottom: 1rem;
            border-radius: 6px;
        }

        /* Para móviles */
        @media (max-width: 768px) {
            .main-content {
                padding: 15px;
            }
            
            .table-responsive {
                border: 1px solid var(--border-color);
                border-radius: 6px;
                overflow: hidden;
            }
            
            .table-compact th,
            .table-compact td {
                padding: 0.6rem 0.5rem;
                font-size: 0.8rem;
            }
            
            .section-header {
                padding: 1rem;
            }
            
            .section-content {
                padding: 1rem;
            }
            
            .info-card {
                padding: 1rem;
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
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">Inicio</a>
                    </li>
                    <!-- IMPORTANTE: Cambiar a coordinaciones como activo -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('coordinaciones.*') || request()->routeIs('maestros.revision-documentos') ? 'active' : '' }}" href="{{ route('coordinaciones.index') }}">Coordinaciones</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('maestros.*') && !request()->routeIs('maestros.revision-documentos') ? 'active' : '' }}" href="{{ route('maestros.index') }}">Maestros</a>
                    </li>
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
    
    <!-- Contenido principal -->
    <div class="main-content">
        <!-- Encabezado principal -->
        <div class="main-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3>
                        <i class="fas fa-file-alt me-2 text-primary"></i>
                        Revisión de Documentos
                    </h3>
                    <p class="header-subtitle">
                        Gestión de documentación del docente
                    </p>
                </div>
                <a href="{{ route('coordinaciones.show', $coordinacion->id) }}" class="btn btn-volver">
                    <i class="fas fa-arrow-left me-1"></i>Volver a Coordinación
                </a>
            </div>
        </div>

        <!-- Mensajes de sesión -->
        @if(session('success'))
            <div class="alert alert-success alert-compact alert-dismissible fade show">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Información de coordinación y maestro -->
        <div class="row mb-3">
            <div class="col-md-6">
                <div class="info-card">
                    <div class="coordinacion-info">
                        <div class="coordinacion-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="coordinacion-details">
                            <h5>{{ $coordinacion->nombre }}</h5>
                            <p>Coordinación</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="info-card">
                    <div class="maestro-info">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($maestro->nombres . ' ' . $maestro->apellido_paterno) }}&background=0744b6&color=fff&bold=true&size=45" 
                             alt="{{ $maestro->nombres }}" class="maestro-avatar">
                        <div class="maestro-details">
                            <h5>{{ $maestro->nombres }} {{ $maestro->apellido_paterno }}</h5>
                            <p>
                                <i class="fas fa-envelope text-muted me-1"></i>
                                {{ $maestro->email }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Período actual -->
        <div class="periodo-selector">
            <div class="d-flex align-items-center gap-3 w-100">
                <div>
                    @if($periodoSubida)
                        <span class="badge bg-primary periodo-badge">
                            <i class="fas fa-calendar-alt me-1"></i> 
                            Período: {{ $periodoSubida->nombre }}
                        </span>
                    @else
                        <span class="badge bg-warning periodo-badge">
                            <i class="fas fa-calendar-times me-1"></i> 
                            Sin período activo
                        </span>
                    @endif
                </div>
                
                <div class="ms-auto">
                    <a href="{{ route('maestros.historial-documentos', [
                        'coordinacionId' => $coordinacion->id, 
                        'maestroId' => $maestro->id
                    ]) }}" 
                       class="btn btn-outline-info btn-sm">
                        <i class="fas fa-history me-1"></i> Ver Historial
                    </a>
                </div>
            </div>
        </div>

        <!-- Gestión de documentos -->
        <div class="documentos-section">
            <div class="section-header">
                <h4>
                    <i class="fas fa-folder-open"></i>
                    Documentos del Período
                </h4>
            </div>
            
            <div class="section-content">
                @php
                        // ✅ Usar estas variables que vienen del controlador corregido
    $periodoActivo = $periodoSubida ?? $periodoHabilitado ?? null;
    $hayPeriodoActivo = $hayPeriodoHabilitado ?? ($periodoActivo != null);
    
                    $documentosDelMaestro = $maestro->documentos;
                    $tieneDocumentos = $documentosDelMaestro->count() > 0;
                    
                    $totalDocMaestro = $documentosDelMaestro->count();
                    $aprobadosMaestro = $documentosDelMaestro->where('estado', 'aprobado')->count();
                    $pendientesMaestro = $documentosDelMaestro->where('estado', 'pendiente')->count();
                    $rechazadosMaestro = $documentosDelMaestro->where('estado', 'rechazado')->count();
                    
                    $documentosEsperadosMaestro = count($documentosRequeridos);
                    $porcentajeMaestro = $documentosEsperadosMaestro > 0 ? 
                        round(($totalDocMaestro / $documentosEsperadosMaestro) * 100) : 0;
                @endphp
                
                <!-- Sin período habilitado -->
                @if(!$periodoSubida)
                    <div class="text-center py-4">
                        <i class="fas fa-calendar-alt fa-3x text-warning mb-3"></i>
                        <h5 class="text-warning">No hay período activo</h5>
                        <p class="text-muted mb-3">Actualmente no hay un período habilitado para revisión de documentos.</p>
                        <a href="{{ route('maestros.historial-documentos', [
                            'coordinacionId' => $coordinacion->id, 
                            'maestroId' => $maestro->id
                        ]) }}" 
                           class="btn btn-warning btn-sm">
                            <i class="fas fa-history me-2"></i> Ver Historial Completo
                        </a>
                            <a href="{{ route('periodos.index') }}" 
                                                   class="btn btn-outline-primary">
                                                    <i class="fas fa-cog me-2"></i> Gestionar Períodos
                                                </a>
                    </div>
                
                <!-- Sin documentos -->
                @elseif(!$tieneDocumentos)
                    <div class="text-center py-4">
                        <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">No hay documentos subidos</h5>
                        <p class="text-muted mb-2">Este maestro no ha subido documentos para el período actual.</p>
                        <p class="text-muted small mb-3">
                            <strong>Período:</strong> {{ $periodoSubida->nombre }}
                        </p>
                        <a href="{{ route('maestros.historial-documentos', [
                            'coordinacionId' => $coordinacion->id, 
                            'maestroId' => $maestro->id
                        ]) }}" 
                           class="btn btn-outline-info btn-sm">
                            <i class="fas fa-history me-2"></i> Ver documentos anteriores
                        </a>
                    </div>
                
                <!-- Con documentos -->
                @else
                    <div class="table-responsive">
                        <table class="table table-compact">
                            <thead>
                                <tr>
                                    <th>Tipo</th>
                                    <th>Archivo</th>
                                    <th>Estado</th>
                                    <th>Observaciones</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($documentosDelMaestro as $documento)
                                <tr id="documento-{{ $documento->id }}">
                                    <td>
                                        <strong>
                                            @php
                                                $tipoNombre = $tiposBase[$documento->tipo]['nombre'] ?? ucfirst(str_replace('_', ' ', $documento->tipo));
                                            @endphp
                                            {{ $tipoNombre }}
                                        </strong>
                                    </td>
                                    <td>
                                        @if($documento->ruta_archivo)
                                            <div class="btn-group btn-group-compact">
                                                <a href="{{ route('documentos.ver', $documento->id) }}" 
                                                   target="_blank" 
                                                   class="btn btn-outline-primary btn-sm">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('documentos.descargar', $documento->id) }}"
                                                   class="btn btn-outline-secondary btn-sm">
                                                    <i class="fas fa-download"></i>
                                                </a>
                                            </div>
                                            <div class="small text-muted mt-1">
                                                {{ Str::limit($documento->nombre_archivo, 20) }}
                                            </div>
                                        @else
                                            <span class="text-muted small">
                                                <i class="fas fa-exclamation-triangle text-warning me-1"></i>
                                                Sin archivo
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        @switch($documento->estado)
                                            @case('aprobado')
                                                <span class="badge-estado badge-aprobado">
                                                    <i class="fas fa-check-circle"></i> Aprobado
                                                </span>
                                                @break
                                            @case('rechazado')
                                                <span class="badge-estado badge-rechazado">
                                                    <i class="fas fa-times-circle"></i> Rechazado
                                                </span>
                                                @break
                                            @default
                                                <span class="badge-estado badge-pendiente">
                                                    <i class="fas fa-clock"></i> Pendiente
                                                </span>
                                        @endswitch
                                    </td>
                                    <td style="min-width: 200px;">
                                        @if($documento->estado == 'aprobado' || $documento->estado == 'rechazado')
                                            <!-- Documentos aprobados/rechazados - editables -->
                                            <div class="observaciones-leidas" 
                                                 onclick="editarObservaciones({{ $documento->id }})"
                                                 data-documento-id="{{ $documento->id }}">
                                                @if($documento->observaciones_admin)
                                                    {{ $documento->observaciones_admin }}
                                                @else
                                                    <span class="text-muted">Sin observaciones</span>
                                                @endif
                                            </div>
                                        @else
                                            <!-- Documentos pendientes -->
                                            @if($documento->observaciones_admin)
                                                <div class="observaciones-leidas" onclick="mostrarFormularioObservaciones({{ $documento->id }})">
                                                    {{ $documento->observaciones_admin }}
                                                </div>
                                            @else
                                                <form action="{{ route('documentos.update-observaciones', $documento->id) }}" 
                                                      method="POST" 
                                                      class="observaciones-compact save-observaciones-form"
                                                      data-documento-id="{{ $documento->id }}">
                                                    @csrf
                                                    <div class="mb-2">
                                                        <textarea name="observaciones_admin" 
                                                                  class="form-control form-control-sm" 
                                                                  rows="2"
                                                                  placeholder="Escribe observaciones..."
                                                                  data-documento-id="{{ $documento->id }}"></textarea>
                                                    </div>
                                                    <button type="submit" 
                                                            class="btn btn-success-sm">
                                                        <i class="fas fa-save me-1"></i> Guardar
                                                    </button>
                                                </form>
                                            @endif
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-compact">
                                            @if($documento->estado != 'aprobado')
                                                <form action="{{ route('documentos.aprobar', $documento->id) }}" 
                                                      method="POST" 
                                                      class="d-inline">
                                                    @csrf
                                                    <button type="submit" 
                                                            class="btn btn-success-sm"
                                                            title="Aprobar"
                                                            onclick="return confirm('¿Aprobar este documento?')">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                </form>
                                            @endif
                                            
                                            @if($documento->estado != 'rechazado')
                                                <form action="{{ route('documentos.rechazar', $documento->id) }}" 
                                                      method="POST" 
                                                      class="d-inline">
                                                    @csrf
                                                    <button type="submit" 
                                                            class="btn btn-danger-sm"
                                                            title="Rechazar"
                                                            onclick="return confirm('¿Rechazar este documento?')">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </form>
                                            @endif
                                            
                                            @if($documento->estado == 'aprobado' || $documento->estado == 'rechazado')
                                                <button type="button" 
                                                        class="btn btn-info-sm"
                                                        title="Cambiar a pendiente"
                                                        onclick="cambiarAPendiente({{ $documento->id }})">
                                                    <i class="fas fa-undo"></i>
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Resumen de estado -->
                    <div class="estado-resumen">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <small class="text-muted">
                                    Completado: <strong>{{ $porcentajeMaestro }}%</strong>
                                    ({{ $totalDocMaestro }} de {{ $documentosEsperadosMaestro }})
                                </small>
                            </div>
                            <div class="d-flex gap-2">
                                <span class="badge bg-success">
                                    <i class="fas fa-check"></i> {{ $aprobadosMaestro }}
                                </span>
                                <span class="badge bg-warning">
                                    <i class="fas fa-clock"></i> {{ $pendientesMaestro }}
                                </span>
                                <span class="badge bg-danger">
                                    <i class="fas fa-times"></i> {{ $rechazadosMaestro }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
    // Configurar toastr
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "timeOut": "5000"
    };

    // Función para mostrar formulario de observaciones
    function mostrarFormularioObservaciones(documentoId) {
        const cell = document.querySelector(`#documento-${documentoId} td:nth-child(4)`);
        const currentContent = cell.querySelector('.observaciones-leidas')?.textContent || '';
        
        const formHTML = `
            <form action="/documentos/${documentoId}/observaciones" 
                  method="POST" 
                  class="observaciones-compact save-observaciones-form"
                  data-documento-id="${documentoId}">
                <div class="mb-2">
                    <textarea name="observaciones_admin" 
                              class="form-control form-control-sm" 
                              rows="2"
                              placeholder="Escribe observaciones..."
                              data-documento-id="${documentoId}">${currentContent.trim()}</textarea>
                </div>
                <div class="d-flex justify-content-between">
                    <button type="button" 
                            class="btn btn-outline-secondary btn-sm"
                            onclick="cancelarEdicionObservaciones(${documentoId})">
                        <i class="fas fa-times me-1"></i> Cancelar
                    </button>
                    <button type="submit" 
                            class="btn btn-success-sm">
                        <i class="fas fa-save me-1"></i> Actualizar
                    </button>
                </div>
            </form>
        `;
        
        cell.innerHTML = formHTML;
        
        // Agregar event listener al nuevo formulario
        const form = cell.querySelector('.save-observaciones-form');
        if (form) {
            agregarEventoSubmitFormulario(form);
        }
    }

    // Función para editar observaciones
    function editarObservaciones(documentoId) {
        mostrarFormularioObservaciones(documentoId);
    }

    // Cancelar edición de observaciones
    function cancelarEdicionObservaciones(documentoId) {
        location.reload();
    }

    // Agregar evento submit a formularios
    function agregarEventoSubmitFormulario(form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            guardarObservaciones(this);
        });
    }

    // Función para guardar observaciones
    function guardarObservaciones(form) {
        const documentoId = form.getAttribute('data-documento-id');
        const submitBtn = form.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        const formData = new FormData(form);
        const url = form.action;
        
        // Mostrar loading
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
        submitBtn.disabled = true;
        
        // Enviar solicitud
        fetch(url, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                toastr.success(data.message || 'Observaciones guardadas correctamente');
                setTimeout(() => {
                    location.reload();
                }, 1000);
            } else {
                toastr.error(data.message || 'Error al guardar observaciones');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            toastr.error('Error de conexión');
        })
        .finally(() => {
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        });
    }

    // Función para cambiar documento a pendiente
    function cambiarAPendiente(documentoId) {
        if (confirm('¿Cambiar este documento a estado pendiente?')) {
            const formData = new FormData();
            formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
            
            fetch(`/documentos/${documentoId}/pendiente`, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    toastr.success('Documento marcado como pendiente');
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                }
            })
            .catch(error => {
                toastr.error('Error al cambiar estado');
                console.error('Error:', error);
            });
        }
    }

    // Inicializar
    document.addEventListener('DOMContentLoaded', function() {
        // Agregar event listeners a todos los formularios
        document.querySelectorAll('.save-observaciones-form').forEach(form => {
            agregarEventoSubmitFormulario(form);
        });
        
        // Mostrar mensajes de sesión
        @if(session('success'))
            toastr.success(@json(session('success')));
        @endif
        
        @if(session('error'))
            toastr.error(@json(session('error')));
        @endif
    });
    </script>
</body>
</html>