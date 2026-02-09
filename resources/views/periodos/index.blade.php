<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Períodos - Sistema GEPROC</title>
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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

        /* ========== ESTILOS DEL CUERPO DE LA VISTA ========== */
        .page-container {
            padding: 1.5rem 0;
            background: linear-gradient(135deg, #f5f7fa 0%, #f8f9fa 100%);
            min-height: calc(100vh - 136px);
        }
        
        .page-header {
            background: white;
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: var(--card-shadow);
        }
        
        .periodo-card {
            background: white;
            border-radius: 10px;
            border-left: 5px solid #dee2e6;
            margin-bottom: 1rem;
            transition: var(--transition);
            box-shadow: var(--card-shadow);
            overflow: hidden;
        }
        
        .periodo-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(15, 126, 230, 0.12);
        }
        
        .periodo-card.habilitado {
            border-left: 5px solid #28a745;
            background: linear-gradient(135deg, #ffffff 0%, #f8fff9 100%);
        }
        
        .periodo-card.finalizado {
            border-left: 5px solid #9d174d;
            background: linear-gradient(135deg, #fdf2f8 0%, #fce7f3 100%);
        }
        
        .periodo-header {
            padding: 1rem 1.25rem;
            border-bottom: 1px solid var(--border-color);
            background: #f8fafc;
        }
        
        .periodo-body {
            padding: 1.25rem;
        }
        
        .periodo-dates {
            background: #f8fafc;
            padding: 0.75rem 1rem;
            border-radius: 8px;
            font-size: 0.9rem;
            border-left: 3px solid var(--primary);
            margin-bottom: 1rem;
        }
        
        .periodo-tipo {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: 600;
            margin-left: 5px;
            text-transform: uppercase;
        }
        
        .periodo-tipo-A {
            background-color: #e3f2fd;
            color: #1976d2;
            border: 1px solid #bbdefb;
        }
        
        .periodo-tipo-B {
            background-color: #f3e5f5;
            color: #7b1fa2;
            border: 1px solid #e1bee7;
        }
        
        .periodo-actions {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
            margin-top: 1rem;
        }
        
        .btn-periodo {
            padding: 0.4rem 0.8rem;
            border-radius: 6px;
            font-size: 0.85rem;
            font-weight: 500;
            border: none;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 5px;
            cursor: pointer;
        }
        
        .btn-periodo:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }
        
        .btn-primary-action {
            background: var(--primary);
            color: white;
        }
        
        .btn-primary-action:hover:not(:disabled) {
            background: #063a9e;
            color: white;
            transform: translateY(-2px);
        }
        
        .btn-success-action {
            background: #28a745;
            color: white;
        }
        
        .btn-success-action:hover:not(:disabled) {
            background: #218838;
            color: white;
            transform: translateY(-2px);
        }
        
        .btn-warning-action {
            background: #ffc107;
            color: #212529;
        }
        
        .btn-warning-action:hover:not(:disabled) {
            background: #e0a800;
            color: #212529;
            transform: translateY(-2px);
        }
        
        .btn-secondary-action {
            background: #6c757d;
            color: white;
        }
        
        .btn-secondary-action:hover:not(:disabled) {
            background: #5a6268;
            color: white;
            transform: translateY(-2px);
        }
        
        .btn-danger-action {
            background: #dc3545;
            color: white;
        }
        
        .btn-danger-action:hover:not(:disabled) {
            background: #c82333;
            color: white;
            transform: translateY(-2px);
        }
        
        .btn-pink-action {
            background: #9d174d;
            color: white;
        }
        
        .btn-pink-action:hover:not(:disabled) {
            background: #831843;
            color: white;
            transform: translateY(-2px);
        }
        
        .section-title {
            color: var(--primary);
            font-weight: 600;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #e9ecef;
            position: relative;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 60px;
            height: 2px;
            background: var(--secondary);
        }
        
        .current-status {
            background: linear-gradient(135deg, #f8fff9 0%, #ffffff 100%);
            border-radius: 10px;
            padding: 1rem;
            margin-bottom: 1.5rem;
            border-left: 4px solid #28a745;
            box-shadow: var(--card-shadow);
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: 1rem;
            margin-bottom: 1.5rem;
        }
        
        .stat-item {
            background: white;
            border-radius: 8px;
            padding: 1rem;
            text-align: center;
            box-shadow: var(--card-shadow);
        }
        
        .stat-number {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
            line-height: 1;
        }
        
        .stat-label {
            color: var(--text-muted);
            font-size: 0.8rem;
            margin-top: 0.25rem;
        }
        
        .btn-generar {
            background: linear-gradient(135deg, var(--primary), #1a3d9e);
            color: white;
            border: none;
            padding: 0.6rem 1.25rem;
            border-radius: 8px;
            font-weight: 500;
            transition: var(--transition);
            cursor: pointer;
        }
        
        .btn-generar:hover {
            background: linear-gradient(135deg, #1a3d9e, var(--primary));
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(7, 68, 182, 0.2);
        }
        
        .instrucciones-box {
            background: white;
            border-radius: 10px;
            padding: 1.5rem;
            margin-top: 2rem;
            box-shadow: var(--card-shadow);
            border-left: 4px solid var(--primary);
        }
        
        .alertas-periodos {
            margin-bottom: 1.5rem;
        }
        
        .badge-periodo {
            font-size: 0.7rem;
            padding: 3px 8px;
            border-radius: 4px;
        }
        
        /* Estilos para la tabla de fechas */
        .fecha-item {
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .fecha-label {
            font-weight: 500;
            color: var(--text-muted);
            min-width: 60px;
        }
        
        .fecha-valor {
            font-weight: 500;
            color: #333;
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

    <!-- Contenido principal -->
    <div class="page-container">
        <div class="container">
            <!-- Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h1 class="h3 mb-1 text-primary">
                            <i class="fas fa-calendar-alt me-2"></i>
                            Gestión de Períodos
                        </h1>
                        <p class="text-muted mb-0 small">
                            Control de períodos para la subida de documentos - Períodos A y B
                        </p>
                    </div>
                    <div class="col-md-4 text-md-end">
                        <button onclick="generarPeriodos()" class="btn-generar">
                            <i class="fas fa-plus-circle me-1"></i> Generar Períodos
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mensajes -->
            <div class="alertas-periodos">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show mb-3">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show mb-3">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <!-- Período con Subida Activa -->
                @if($periodoSubida)
                    <div class="current-status">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <h5 class="mb-1">
                                    <i class="fas fa-toggle-on me-2 text-success"></i>
                                    Subida ACTIVA en:
                                    <strong>{{ $periodoSubida->nombre }}</strong>
                                    @php
                                        // Determinar el tipo correcto del período
                                        if (str_contains($periodoSubida->codigo, '-A')) {
                                            $tipoPeriodo = 'A';
                                        } elseif (str_contains($periodoSubida->codigo, '-B')) {
                                            $tipoPeriodo = 'B';
                                        } else {
                                            $tipoPeriodo = '';
                                        }
                                    @endphp
                                    @if($tipoPeriodo == 'A')
                                        <span class="periodo-tipo periodo-tipo-A">PERÍODO A</span>
                                    @elseif($tipoPeriodo == 'B')
                                        <span class="periodo-tipo periodo-tipo-B">PERÍODO B</span>
                                    @endif
                                </h5>
                                <p class="mb-0 small">
                                    <i class="fas fa-calendar me-1"></i>
                                    {{ $periodoSubida->fecha_inicio->format('d/m/Y') }} - 
                                    {{ $periodoSubida->fecha_fin->format('d/m/Y') }}
                                </p>
                            </div>
                            <div class="col-md-4 text-md-end">
                                <span class="badge bg-success">
                                    <i class="fas fa-upload me-1"></i> SUBIDA ACTIVA
                                </span>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="alert alert-warning mb-3">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-toggle-off me-3"></i>
                            <div>
                                <strong>Subida INACTIVA</strong>
                                <p class="mb-0 small">No hay período habilitado para subida de documentos</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Estadísticas -->
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-number">{{ $periodos->count() }}</div>
                    <div class="stat-label">Total Períodos</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">
                        {{ $periodos->where('subida_habilitada', true)->count() }}
                    </div>
                    <div class="stat-label">Habilitados</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">
                        {{ $periodos->where('estado', 'finalizado')->count() }}
                    </div>
                    <div class="stat-label">Finalizados</div>
                </div>
            </div>

            <!-- Todos los Períodos -->
            <h3 class="section-title">Períodos Académicos</h3>
            <p class="text-muted small mb-3">Ordenados del más antiguo al más reciente</p>
            
            @php
                // Ordenar períodos de menor a mayor (más antiguo a más reciente)
                $periodosOrdenados = $periodos->sortBy('fecha_inicio');
            @endphp
            
            @if($periodosOrdenados->isEmpty())
                <div class="alert alert-info text-center py-4">
                    <i class="fas fa-calendar-times fa-2x mb-3 text-muted"></i>
                    <h5 class="text-muted">No hay períodos generados</h5>
                    <p class="mb-3">Genera períodos automáticamente para comenzar</p>
                    <button onclick="generarPeriodos()" class="btn btn-primary">
                        <i class="fas fa-magic me-2"></i> Generar Períodos
                    </button>
                </div>
            @else
                <!-- Mostrar 6 períodos por página -->
                @php
                    $perPage = 6;
                    $currentPage = request()->get('page', 1);
                    $paginatedPeriodos = $periodosOrdenados->slice(($currentPage - 1) * $perPage, $perPage)->all();
                @endphp
                
                @foreach($paginatedPeriodos as $periodo)
                    @php
                        $cardClass = '';
                        if($periodo->subida_habilitada) {
                            $cardClass = 'habilitado';
                        } elseif($periodo->estado == 'finalizado') {
                            $cardClass = 'finalizado';
                        }
                        
                        // Determinar el tipo correcto del período basado en el código
                        if (str_contains($periodo->codigo, '-A')) {
                                            $tipoPeriodo = 'A';
                                        } elseif (str_contains($periodo->codigo, '-B')) {
                                            $tipoPeriodo = 'B';
                                        } else {
                                            $tipoPeriodo = '';
                                        }
                    @endphp
                    
                    <div class="periodo-card {{ $cardClass }} mb-3">
                        <div class="periodo-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1">
                                        {{ $periodo->nombre }}
                                        @if($tipoPeriodo == 'A')
                                            <span class="periodo-tipo periodo-tipo-A">PERÍODO A</span>
                                        @elseif($tipoPeriodo == 'B')
                                            <span class="periodo-tipo periodo-tipo-B">PERÍODO B</span>
                                        @endif
                                    </h6>
                                    <div>
                                        @if($periodo->subida_habilitada)
                                            <span class="badge bg-success badge-periodo me-1">
                                                <i class="fas fa-toggle-on me-1"></i> ACTIVA
                                            </span>
                                        @endif
                                        
                                        @if($periodo->estado == 'finalizado')
                                            <span class="badge bg-pink badge-periodo me-1" style="background-color: #9d174d; border-color: #831843;">
                                                <i class="fas fa-flag-checkered me-1"></i> FINALIZADO
                                            </span>
                                        @endif
                                        
                                        @if($periodo->documentos_count > 0)
                                            <span class="badge bg-info badge-periodo">
                                                <i class="fas fa-file me-1"></i> {{ $periodo->documentos_count }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div>
                                    <code class="text-muted small">{{ $periodo->codigo }}</code>
                                </div>
                            </div>
                        </div>
                        
                        <div class="periodo-body">
                            <!-- Fechas - MEJOR DISEÑO -->
                            <div class="periodo-dates">
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <div class="fecha-item">
                                            <span class="fecha-label">Inicio:</span>
                                            <span class="fecha-valor">{{ $periodo->fecha_inicio->format('d/m/Y') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <div class="fecha-item">
                                            <span class="fecha-label">Fin:</span>
                                            <span class="fecha-valor">{{ $periodo->fecha_fin->format('d/m/Y') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Acciones FUNCIONALES con formularios reales -->
                            <div class="periodo-actions">
                                @if($periodo->estado == 'finalizado')
                                    <!-- PERÍODO FINALIZADO - Mostrar opción para reabrir -->
                                    <form action="{{ route('periodos.reabrir', $periodo->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn-periodo btn-success-action"
                                                onclick="return confirm('¿Reabrir el período {{ $periodo->nombre }}?\\n\\nPodrás habilitar subida nuevamente.')">
                                            <i class="fas fa-redo me-1"></i> Reabrir
                                        </button>
                                    </form>
                                
                                @elseif($periodo->subida_habilitada)
                                    <!-- PERÍODO HABILITADO - Muestra Deshabilitar y Finalizar -->
                                    <form action="{{ route('periodos.toggle-subida', $periodo->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn-periodo btn-warning-action">
                                            <i class="fas fa-toggle-off me-1"></i> Deshabilitar
                                        </button>
                                    </form>
                                    
                                    <!-- BOTÓN FINALIZAR - CON COLOR ROSA/MAGENTA -->
                                    <form action="{{ route('periodos.finalizar', $periodo->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn-periodo btn-pink-action"
                                                onclick="return confirm('¿Marcar el período {{ $periodo->nombre }} como FINALIZADO?\\n\\n⚠️ Esta acción NO se puede deshacer.\\n\\nSe deshabilitará la subida automáticamente.')">
                                            <i class="fas fa-flag-checkered me-1"></i> Finalizar
                                        </button>
                                    </form>
                                
                                @else
                                    <!-- PERÍODO NO HABILITADO - Solo muestra Habilitar -->
                                    <form action="{{ route('periodos.toggle-subida', $periodo->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn-periodo btn-success-action"
                                                onclick="return confirm('¿Habilitar subida para {{ $periodo->nombre }}?\\n\\nSe deshabilitará cualquier otro período con subida activa.')">
                                            <i class="fas fa-toggle-on me-1"></i> Habilitar
                                        </button>
                                    </form>
                                    
                                    <!-- Botón para finalizar sin habilitar - CON COLOR ROSA/MAGENTA -->
                                    @if($periodo->estado != 'finalizado')
                                        <form action="{{ route('periodos.finalizar', $periodo->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn-periodo btn-pink-action"
                                                    onclick="return confirm('¿Marcar el período {{ $periodo->nombre }} como FINALIZADO sin habilitar subida?\\n\\n⚠️ Esta acción NO se puede deshacer.')">
                                                <i class="fas fa-flag-checkered me-1"></i> Finalizar
                                            </button>
                                        </form>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
                
                <!-- Paginación -->
                @if($periodosOrdenados->count() > $perPage)
                    <nav aria-label="Navegación de períodos" class="mt-4">
                        <ul class="pagination justify-content-center">
                            @if($currentPage > 1)
                                <li class="page-item">
                                    <a class="page-link" href="?page={{ $currentPage - 1 }}" aria-label="Anterior">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                            @endif
                            
                            @php
                                $totalPages = ceil($periodosOrdenados->count() / $perPage);
                                $startPage = max(1, $currentPage - 2);
                                $endPage = min($totalPages, $currentPage + 2);
                            @endphp
                            
                            @for($i = $startPage; $i <= $endPage; $i++)
                                <li class="page-item {{ $i == $currentPage ? 'active' : '' }}">
                                    <a class="page-link" href="?page={{ $i }}">{{ $i }}</a>
                                </li>
                            @endfor
                            
                            @if($currentPage < $totalPages)
                                <li class="page-item">
                                    <a class="page-link" href="?page={{ $currentPage + 1 }}" aria-label="Siguiente">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </nav>
                @endif
            @endif

            <!-- Información -->
            <div class="instrucciones-box mt-4">
                <h6 class="mb-3"><i class="fas fa-info-circle me-2 text-primary"></i> Información del Sistema</h6>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <h6 class="text-primary">Tipos de Períodos</h6>
                            <p class="text-muted small mb-0">
                                • <span class="periodo-tipo periodo-tipo-A">PERÍODO A</span>: Febrero - Julio<br>
                                • <span class="periodo-tipo periodo-tipo-B">PERÍODO B</span>: Agosto - Enero<br>
                                • Solo UN período puede tener subida activa
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <h6 class="text-primary">Acciones Disponibles</h6>
                            <p class="text-muted small mb-0">
                                • <strong>Habilitar</strong>: Activa la subida de documentos<br>
                                • <strong>Deshabilitar</strong>: Desactiva la subida<br>
                                • <strong>Finalizar</strong>: Marca el período como concluido<br>
                                • <strong>Reabrir</strong>: Permite usar un período finalizado nuevamente
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function generarPeriodos() {
            if (confirm('¿Generar períodos automáticamente para los próximos 7 años?\n\nSe crearán períodos Febrero-Julio (A) y Agosto-Enero (B).')) {
                const loadingHTML = `
                    <div id="loading" style="position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.7); z-index:9999; display:flex; align-items:center; justify-content:center;">
                        <div class="text-center text-white">
                            <div class="spinner-border mb-3" style="width:3rem; height:3rem;"></div>
                            <h5 class="mb-2">Generando períodos...</h5>
                        </div>
                    </div>
                `;
                document.body.insertAdjacentHTML('beforeend', loadingHTML);
                
                // Enviar petición POST real
                fetch('{{ route("periodos.generar-manualmente") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => response.json())
                .then(data => {
                    document.getElementById('loading').remove();
                    if (data.success) {
                        alert('Períodos generados exitosamente');
                        location.reload();
                    } else {
                        alert(data.message || 'Error al generar períodos');
                    }
                })
                .catch(error => {
                    document.getElementById('loading').remove();
                    alert('Error de conexión. Por favor, intenta nuevamente.');
                });
            }
        }
        
        // Auto-generar si no hay períodos
        @if($periodos->isEmpty())
            setTimeout(() => {
                if (confirm('No hay períodos generados. ¿Deseas generarlos automáticamente ahora?')) {
                    generarPeriodos();
                }
            }, 1500);
        @endif
    </script>
</body>
</html>