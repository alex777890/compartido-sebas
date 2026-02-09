<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Documentos - {{ $maestro->nombres }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
            background: #f8fafc; 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            color: #333; 
            line-height: 1.5;
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
        
        /* ========== NUEVOS ESTILOS ========== */
        
        /* Tarjeta del encabezado - ARREGLADA */
        .header-container {
            background: white;
            border-radius: 10px;
            padding: 1.5rem 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            border: 1px solid #e9ecef;
            position: relative;
        }
        
        .header-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 5px;
            height: 100%;
            background: var(--primary);
        }
        
        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }
        
        .header-title {
            font-weight: 600;
            color: var(--primary);
            font-size: 1.4rem;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .teacher-name {
            font-size: 1.2rem;
            font-weight: 500;
            color: #2c3e50;
            margin: 0;
        }
        
        .btn-volver {
            border: 2px solid var(--primary);
            color: var(--primary);
            font-weight: 500;
            padding: 0.5rem 1.2rem;
            border-radius: 6px;
            transition: var(--transition);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
        }
        
        .btn-volver:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(7, 68, 182, 0.2);
        }
        
        /* Tarjetas de estadísticas con colores profesionales */
        .stats-card {
            border: none;
            border-radius: 10px;
            margin-bottom: 1rem;
            transition: var(--transition);
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
            position: relative;
            overflow: hidden;
        }
        
        .stats-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
        }
        
        .stats-card.total::before {
            background: var(--primary);
        }
        
        .stats-card.aprobados::before {
            background: #28a745;
        }
        
        .stats-card.rechazados::before {
            background: #dc3545;
        }
        
        .stats-card.pendientes::before {
            background: #ffc107;
        }
        
        .stats-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.12);
        }
        
        .stats-card .card-body {
            padding: 1.5rem;
            text-align: center;
        }
        
        .stats-card .card-body h3 {
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        
        .stats-card.total .card-body h3 {
            color: var(--primary);
        }
        
        .stats-card.aprobados .card-body h3 {
            color: #28a745;
        }
        
        .stats-card.rechazados .card-body h3 {
            color: #dc3545;
        }
        
        .stats-card.pendientes .card-body h3 {
            color: #ffc107;
        }
        
        .stats-card .card-body p {
            color: var(--text-muted);
            margin-bottom: 0;
            font-size: 0.95rem;
        }
        
        /* Períodos y documentos */
        .main-content {
            padding: 1.5rem;
        }
        
        .card {
            border: 1px solid #e9ecef;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
            transition: var(--transition);
            background: white;
        }
        
        .card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }
        
        .card-header.bg-light {
            background: #f8f9fa !important;
            border-bottom: 1px solid #e9ecef;
            font-weight: 600;
            padding: 1rem 1.25rem;
        }
        
        .periodo-card {
            border: 1px solid #e9ecef;
            border-radius: 8px;
            margin-bottom: 15px;
            transition: all 0.3s ease;
            cursor: pointer;
            background: white;
            padding: 1rem;
        }
        
        .periodo-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-color: var(--primary);
        }
        
        .periodo-card.actual {
            border-left: 4px solid var(--primary);
            background-color: #f8faff;
        }
        
        .periodo-card.seleccionado {
            border: 2px solid var(--primary);
            background-color: #f0f5ff;
        }
        
        .documento-historial {
            border-bottom: 1px solid #eee;
            padding: 12px 0;
            transition: var(--transition);
        }
        
        .documento-historial:hover {
            background: #f8f9fa;
            border-radius: 6px;
            padding: 12px 10px;
        }
        
        .badge-periodo {
            font-size: 0.75rem;
            padding: 4px 10px;
            border-radius: 20px;
            background: var(--primary);
            color: white;
        }
        
        .badge.bg-success {
            background: #28a745 !important;
        }
        
        .badge.bg-danger {
            background: #dc3545 !important;
        }
        
        .badge.bg-warning {
            background: #ffc107 !important;
            color: #212529;
        }
        
        .btn-sm.btn-outline-primary {
            border: 1px solid var(--primary);
            color: var(--primary);
            transition: var(--transition);
        }
        
        .btn-sm.btn-outline-primary:hover {
            background: var(--primary);
            color: white;
        }
        
        @media (max-width: 768px) {
            .main-content {
                padding: 1rem;
            }
            
            .header-container {
                padding: 1.2rem 1.5rem;
            }
            
            .header-title {
                font-size: 1.2rem;
            }
            
            .teacher-name {
                font-size: 1.1rem;
            }
            
            .header-content {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .btn-volver {
                margin-top: 0.5rem;
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
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('contratos.*') ? 'active' : '' }}" href="{{ route('users.index') }}">Accesos</a></li>
                </ul>
                
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

    <div class="container-fluid p-0">
        <div class="main-content p-4">
            <!-- Encabezado CORREGIDO -->
            <div class="header-container">
                <div class="header-content">
                    <div>
                        <h1 class="header-title">
                            <i class="fas fa-history"></i>
                            Historial de Documentos
                        </h1>
                        <h2 class="teacher-name">{{ $maestro->nombres }}</h2>
                    </div>
                    <div>
                        @if(isset($coordinacion) && $coordinacion && is_object($coordinacion) && isset($coordinacion->id) && $coordinacion->id)
                            <a href="{{ route('coordinaciones.show', $coordinacion->id) }}" class="btn-volver">
                                <i class="fas fa-arrow-left me-2"></i> Volver a Coordinación
                            </a>
                        @elseif(isset($coordinacionId) && $coordinacionId)
                            <a href="{{ route('coordinaciones.show', $coordinacionId) }}" class="btn-volver">
                                <i class="fas fa-arrow-left me-2"></i> Volver a Coordinación
                            </a>
                        @else
                            <a href="{{ route('maestros.show', $maestro->id) }}" class="btn-volver">
                                <i class="fas fa-arrow-left me-2"></i> Volver a Maestro
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            
            <!-- Estadísticas DINÁMICAS según período seleccionado -->
            <div class="row mb-4">
                <div class="col-md-3 mb-3">
                    <div class="stats-card total">
                        <div class="card-body">
                            @if($periodoSeleccionado)
                                <h3>{{ $documentosDelPeriodoSeleccionado->count() }}</h3>
                            @else
                                <h3>{{ $totalDocumentos }}</h3>
                            @endif
                            <p class="mb-0">Documentos Totales</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="stats-card aprobados">
                        <div class="card-body">
                            @if($periodoSeleccionado)
                                <h3>{{ $documentosDelPeriodoSeleccionado->where('estado', 'aprobado')->count() }}</h3>
                            @else
                                <h3>{{ $totalAprobados }}</h3>
                            @endif
                            <p class="mb-0">Aprobados</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="stats-card rechazados">
                        <div class="card-body">
                            @if($periodoSeleccionado)
                                <h3>{{ $documentosDelPeriodoSeleccionado->where('estado', 'rechazado')->count() }}</h3>
                            @else
                                <h3>{{ $totalRechazados }}</h3>
                            @endif
                            <p class="mb-0">Rechazados</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="stats-card pendientes">
                        <div class="card-body">
                            @if($periodoSeleccionado)
                                <h3>{{ $documentosDelPeriodoSeleccionado->where('estado', 'pendiente')->count() }}</h3>
                            @else
                                <h3>{{ $totalPendientes }}</h3>
                            @endif
                            <p class="mb-0">Pendientes</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <!-- Columna izquierda: Lista de períodos ORDEN INVERTIDO -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header bg-light">
                            <h6 class="mb-0">
                                <i class="fas fa-calendar-alt me-2"></i>
                                Períodos
                            </h6>
                        </div>
                        <div class="card-body p-3">
                            @php
                                // Ordenar los períodos: más reciente primero (fecha_inicio descendente)
                                $periodosOrdenados = $periodosConDocumentos->sortByDesc('fecha_inicio');
                            @endphp
                            
                            @forelse($periodosOrdenados as $periodo)
                                <div class="periodo-card p-3 
                                    {{ $periodoActual && $periodo->id == $periodoActual->id ? 'actual' : '' }}
                                    {{ $periodoSeleccionado && $periodo->id == $periodoSeleccionado->id ? 'seleccionado' : '' }}"
                                    onclick="seleccionarPeriodo({{ $periodo->id }})">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="mb-1">{{ $periodo->nombre }}</h6>
                                            <div class="estadisticas-periodo text-muted">
                                                <small>
                                                    {{ $periodo->fecha_inicio->format('M/Y') }} - 
                                                    {{ $periodo->fecha_fin->format('M/Y') }}
                                                </small>
                                            </div>
                                        </div>
                                        <div class="text-end">
                                            <span class="badge-periodo">
                                                {{ $periodo->documentos_count }} docs
                                            </span>
                                            @if($periodoActual && $periodo->id == $periodoActual->id)
                                                <span class="badge bg-success badge-periodo mt-1">
                                                    Actual
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- Mini estadísticas del período -->
                                    <div class="mt-2">
                                        @php
                                            $docsPeriodo = $periodo->documentos ?? collect();
                                            $aprobados = $docsPeriodo->where('estado', 'aprobado')->count();
                                            $rechazados = $docsPeriodo->where('estado', 'rechazado')->count();
                                            $pendientes = $docsPeriodo->where('estado', 'pendiente')->count();
                                        @endphp
                                        <div class="d-flex gap-2">
                                            <small class="text-success">
                                                <i class="fas fa-check"></i> {{ $aprobados }}
                                            </small>
                                            <small class="text-danger">
                                                <i class="fas fa-times"></i> {{ $rechazados }}
                                            </small>
                                            <small class="text-warning">
                                                <i class="fas fa-clock"></i> {{ $pendientes }}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-4">
                                    <i class="fas fa-folder-open fa-2x text-muted mb-3"></i>
                                    <p class="text-muted">No hay períodos con documentos</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
                
                <!-- Columna derecha: Documentos del período seleccionado -->
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header bg-light">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="mb-0">
                                    @if($periodoSeleccionado)
                                        <i class="fas fa-file-alt me-2"></i>
                                        Documentos - {{ $periodoSeleccionado->nombre }}
                                        <span class="text-muted ms-2" style="font-size: 0.85rem;">
                                            {{ $periodoSeleccionado->fecha_inicio->format('d/m/Y') }} - {{ $periodoSeleccionado->fecha_fin->format('d/m/Y') }}
                                        </span>
                                    @else
                                        <i class="fas fa-info-circle me-2"></i>
                                        Selecciona un período para ver documentos
                                    @endif
                                </h6>
                            </div>
                        </div>
                        <div class="card-body">
                            @if($periodoSeleccionado)
                                @if($documentosDelPeriodoSeleccionado->count() > 0)
                                    @foreach($documentosDelPeriodoSeleccionado as $documento)
                                        <div class="documento-historial">
                                            <div class="row align-items-center">
                                                <div class="col-md-4">
                                                    <strong>
                                                        {{ $tiposBase[$documento->tipo]['nombre'] ?? ucfirst($documento->tipo) }}
                                                    </strong>
                                                </div>
                                                <div class="col-md-3">
                                                    @switch($documento->estado)
                                                        @case('aprobado')
                                                            <span class="badge bg-success">Aprobado</span>
                                                            @break
                                                        @case('rechazado')
                                                            <span class="badge bg-danger">Rechazado</span>
                                                            @break
                                                        @default
                                                            <span class="badge bg-warning">Pendiente</span>
                                                    @endswitch
                                                </div>
                                                <div class="col-md-3">
                                                    <small class="text-muted">
                                                        {{ $documento->fecha_revision ? $documento->fecha_revision->format('d/m/Y') : 'No revisado' }}
                                                    </small>
                                                </div>
                                                <div class="col-md-2">
                                                    @if($documento->ruta_archivo)
                                                        <a href="{{ route('documentos.ver', $documento->id) }}" 
                                                           target="_blank" 
                                                           class="btn btn-sm btn-outline-primary">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                            @if($documento->observaciones_admin)
                                                <div class="mt-2 small text-muted">
                                                    <em> Observaciones: "{{ Str::limit($documento->observaciones_admin, 100) }}"</em>
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                @else
                                    <div class="text-center py-5">
                                        <i class="fas fa-folder-open fa-2x text-muted mb-3"></i>
                                        <p class="text-muted">No hay documentos en este período</p>
                                    </div>
                                @endif
                            @else
                                <div class="text-center py-5">
                                    <i class="fas fa-mouse-pointer fa-2x text-muted mb-3"></i>
                                    <p class="text-muted">Selecciona un período de la lista para ver los documentos</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function seleccionarPeriodo(periodoId) {
            const url = new URL(window.location.href);
            url.searchParams.set('periodo_id', periodoId);
            window.location.href = url.toString();
        }
        
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            if (!urlParams.has('periodo_id') && {{ $periodosConDocumentos->count() > 0 ? 'true' : 'false' }}) {
                const primerPeriodo = {{ $periodosOrdenados->first()->id ?? 'null' }};
                if (primerPeriodo) {
                    setTimeout(() => {
                        seleccionarPeriodo(primerPeriodo);
                    }, 100);
                }
            }
        });
    </script>
</body>
</html>