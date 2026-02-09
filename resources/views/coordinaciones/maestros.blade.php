<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estado de Documentos | GEPROC GP</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
    
        :root {
            --primary: #0744b6ff;
            --secondary: #33CAE6;
            --accent: #26E63F;
            --dark-primary: #052e7a;
            --light-primary: rgba(7, 68, 182, 0.08);
            --light-bg: #ffffff;
            --card-bg: #ffffff;
            --sidebar-bg: #ffffff;
            --border-color: #e1e5eb;
            --text-muted: #64748b;
            --text-dark: #1e293b;
            --shadow-sm: 0 2px 8px rgba(7, 68, 182, 0.05);
            --shadow-md: 0 4px 12px rgba(7, 68, 182, 0.08);
            --shadow-lg: 0 8px 24px rgba(7, 68, 182, 0.12);
            --gradient-primary: linear-gradient(135deg, var(--primary) 0%, #0a5bda 100%);
            --gradient-dark: linear-gradient(135deg, var(--dark-primary) 0%, #0744b6 100%);
            --gradient-card: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', 'Segoe UI', system-ui, -apple-system, sans-serif;
        }

        body {
            background-color: #f8fafc;
            color: var(--text-dark);
            line-height: 1.5;
            min-height: 100vh;
        }

        /* ========== SIDEBAR (MANTENIDO IGUAL) ========== */
        .dashboard-container {
            display: flex;
            min-height: 100vh;
            background: #f8fafc;
        }

        .sidebar {
            width: 280px;
            background: var(--sidebar-bg);
            box-shadow: var(--shadow-md);
            border-right: 1px solid var(--border-color);
            position: fixed;
            height: 100vh;
            z-index: 1000;
            display: flex;
            flex-direction: column;
        }

        .logo-section {
            padding: 28px 24px;
            background: var(--gradient-dark);
            display: flex;
            align-items: center;
            gap: 16px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .logo-circle {
            width: 60px;
            height: 60px;
            background: white;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .logo-circle img {
            width: 42px;
            height: 42px;
            object-fit: contain;
        }

        .logo-text {
            flex: 1;
        }

        .logo-text h1 {
            color: white;
            font-size: 1.4rem;
            font-weight: 700;
            letter-spacing: -0.5px;
            margin-bottom: 4px;
        }

        .logo-text span {
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.8rem;
            font-weight: 400;
        }

        .nav-menu {
            flex: 1;
            padding: 24px 0;
            overflow-y: auto;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 14px 24px;
            color: var(--text-muted);
            text-decoration: none;
            transition: var(--transition);
            margin: 4px 12px;
            border-radius: 10px;
            font-weight: 500;
        }

        .nav-item:hover {
            background: var(--light-primary);
            color: var(--primary);
            transform: translateX(4px);
        }

        .nav-item.active {
            background: var(--light-primary);
            color: var(--primary);
            box-shadow: var(--shadow-sm);
            border-left: 3px solid var(--primary);
        }

        .nav-item i {
            width: 20px;
            text-align: center;
            font-size: 1.1rem;
        }

        .nav-divider {
            height: 1px;
            background: var(--border-color);
            margin: 20px 24px;
        }

        .user-section {
            padding: 24px;
            border-top: 1px solid var(--border-color);
            background: var(--light-bg);
        }

        .logout-btn {
            width: 100%;
            padding: 12px;
            background: white;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            color: var(--primary);
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .logout-btn:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-2px);
        }

        /* ========== CONTENIDO PRINCIPAL (MÁS COMPACTO) ========== */
        .main-content {
            flex: 1;
            margin-left: 280px;
            padding: 20px;
            background: #f8fafc;
        }

        /* Header más compacto */
        .main-header {
            background: var(--card-bg);
            border-radius: 12px;
            padding: 18px 24px;
            margin-bottom: 20px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-left h2 {
            font-size: 1.4rem;
            color: var(--text-dark);
            font-weight: 700;
            margin-bottom: 4px;
        }

        .header-left p {
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        .date-display {
            background: var(--light-primary);
            color: var(--primary);
            padding: 8px 16px;
            border-radius: 8px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.85rem;
        }

        /* Información de período compacta */
        .periodo-info {
            background: var(--light-primary);
            border-radius: 8px;
            padding: 12px 16px;
            margin-bottom: 20px;
            border: 1px solid rgba(7, 68, 182, 0.1);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .periodo-title {
            font-weight: 600;
            color: var(--primary);
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.95rem;
        }

        .periodo-status {
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 15px;
            font-size: 0.75rem;
        }

        .status-activo {
            background: rgba(38, 230, 63, 0.15);
            color: #1a9c2a;
        }

        .status-inactivo {
            background: rgba(108, 117, 125, 0.15);
            color: var(--text-muted);
        }

        /* Sección de maestros compacta */
        .maestros-section {
            background: var(--card-bg);
            border-radius: 12px;
            padding: 20px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid var(--border-color);
        }

        .section-header h2 {
            font-size: 1.3rem;
            color: var(--primary);
            font-weight: 700;
        }

        .maestros-count {
            background: var(--gradient-primary);
            color: white;
            padding: 8px 16px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* Buscador compacto */
        .search-filter {
            display: flex;
            gap: 12px;
            margin-bottom: 20px;
            padding: 16px;
            background: var(--gradient-card);
            border-radius: 10px;
            border: 1px solid var(--border-color);
        }

        .search-box {
            flex-grow: 1;
            position: relative;
            max-width: 350px;
        }

        .search-box input {
            width: 100%;
            padding: 10px 16px 10px 40px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-size: 0.9rem;
            background: white;
        }

        .search-box i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        .filter-btn {
            background: white;
            border: 1px solid var(--border-color);
            padding: 10px 16px;
            border-radius: 8px;
            color: var(--text-muted);
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 600;
            text-decoration: none;
            font-size: 0.85rem;
        }

        .primary-btn {
            background: var(--gradient-primary);
            color: white !important;
            border: none !important;
        }

        /* Tabla compacta */
        .maestros-table-container {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
        }

        .table-header {
            padding: 16px 20px;
            background: var(--gradient-card);
            border-bottom: 1px solid var(--border-color);
        }

        .table-header h3 {
            color: var(--text-dark);
            font-weight: 700;
            font-size: 1.1rem;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .maestros-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 1000px;
            font-size: 0.9rem;
        }

        .maestros-table th {
            padding: 14px 12px;
            text-align: left;
            font-weight: 700;
            color: var(--primary);
            border-bottom: 1px solid var(--border-color);
            text-transform: uppercase;
            font-size: 0.8rem;
            background: var(--light-primary);
        }

        .maestros-table td {
            padding: 14px 12px;
            border-bottom: 1px solid var(--border-color);
            vertical-align: middle;
        }

        .maestro-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .maestro-avatar {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            background: var(--gradient-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 1rem;
            flex-shrink: 0;
        }

        .maestro-name h4 {
            font-weight: 700;
            color: #333;
            margin-bottom: 2px;
            font-size: 0.95rem;
        }

        .maestro-name p {
            font-size: 0.8rem;
            color: var(--text-muted);
        }

        /* Documentación compacta - SIN PORCENTAJE */
        .document-progress {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .progress-stats {
            display: flex;
            justify-content: space-between;
            font-size: 0.8rem;
            color: var(--text-dark);
            font-weight: 600;
        }

        .doc-count {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .doc-count span {
            background: var(--light-primary);
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .entregados { color: #1a9c2a; }
        .faltantes { color: #f44336; }

        /* Badge de estado compacto */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 10px;
            border-radius: 15px;
            font-size: 0.75rem;
            font-weight: 700;
        }

        .status-active {
            background: rgba(38, 230, 63, 0.15);
            color: #1a9c2a;
            border: 1px solid rgba(38, 230, 63, 0.3);
        }

        .status-inactive {
            background: rgba(108, 117, 125, 0.15);
            color: var(--text-muted);
            border: 1px solid rgba(108, 117, 125, 0.3);
        }

        /* Acciones compactas */
        .action-icons {
            display: flex;
            gap: 4px;
        }

        .icon-btn {
            width: 32px;
            height: 32px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--light-bg);
            color: var(--text-muted);
            cursor: pointer;
            border: 1px solid transparent;
            text-decoration: none;
            font-size: 0.8rem;
        }

        .icon-btn:hover {
            background: var(--primary);
            color: white;
        }

        /* Paginación compacta */
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 4px;
            margin-top: 20px;
            padding-top: 15px;
            border-top: 1px solid var(--border-color);
        }

        .page-btn {
            width: 36px;
            height: 36px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
            color: var(--text-muted);
            border: 1px solid var(--border-color);
            cursor: pointer;
            font-weight: 600;
            text-decoration: none;
            font-size: 0.85rem;
        }

        .page-btn.active {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        /* Footer compacto */
        .footer-info {
            margin-top: 30px;
            padding: 15px;
            background: var(--card-bg);
            border-radius: 10px;
            color: var(--text-muted);
            font-size: 0.8rem;
            text-align: center;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
        }

        /* FAB compacto */
        .fab {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 50px;
            height: 50px;
            border-radius: 12px;
            background: var(--gradient-primary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            cursor: pointer;
            box-shadow: var(--shadow-md);
            text-decoration: none;
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .sidebar { width: 80px; }
            .main-content { margin-left: 80px; }
            .logo-text, .nav-item span { display: none; }
            .nav-item { justify-content: center; padding: 16px; }
            .logo-circle { margin: 0 auto; }
        }

        @media (max-width: 768px) {
            .main-content { padding: 15px; }
            .maestros-table th, .maestros-table td { padding: 10px 8px; }
            .search-filter { flex-direction: column; }
            .filter-btn { width: 100%; justify-content: center; }
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div class="dashboard-container">
        <!-- SIDEBAR (IGUAL) -->
        <aside class="sidebar">
            <div class="logo-section">
                <div class="logo-circle">
                    <img src="{{ asset('img/logo_iufim.png') }}" alt="Logo" class="logo-img">
                </div>
                <div class="logo-text">
                    <h1>GEPROC GP</h1>
                </div>
            </div>
            
            <nav class="nav-menu">
                <a href="{{ route('coordinacion.dashboard') }}" class="nav-item">
                    <i class="fas fa-home"></i>
                    <span>Inicio</span>
                </a>
                <a href="{{ route('coordinaciones.maestros-detalle') }}" class="nav-item">
                    <i class="fas fa-users"></i>
                    <span>Maestros</span>
                </a>
                <a href="{{ route('coordinaciones.maestros') }}" class="nav-item active">
                    <i class="fas fa-file-alt"></i>
                    <span>Documentos</span>
                </a>
                <a href="#" class="nav-item">
                    <i class="fas fa-chart-bar"></i>
                    <span>Estadísticas</span>
                </a>
                <a href="#" class="nav-item">
                    <i class="fas fa-building"></i>
                    <span>Mi Coordinación</span>
                </a>
            </nav>
            
            <div class="user-section">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Cerrar Sesión</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- CONTENIDO PRINCIPAL (COMPACTO) -->
        <main class="main-content">
            <div class="main-header">
                <div class="header-left">
                    <h2>Estado de Documentos</h2>
                    <p>Gestión y revisión de documentación</p>
                </div>
                <div class="header-right">
                    <div class="date-display">
                        <i class="fas fa-calendar-alt"></i>
                        {{ now()->format('d/m/Y') }}
                    </div>
                </div>
            </div>

            @if($coordinacion)
                <!-- ✅ INFORMACIÓN DEL PERÍODO - CON VALIDACIÓN -->
                @if(isset($periodoHabilitado) && $periodoHabilitado)
                <div class="periodo-info">
                    <div class="periodo-title">
                        <i class="fas fa-calendar-check"></i>
                        Período: <strong>{{ $periodoHabilitado->nombre }}</strong>
                        @if($periodoHabilitado->fecha_inicio && $periodoHabilitado->fecha_fin)
                        <span style="font-size: 0.85rem; color: var(--text-muted); margin-left: 10px;">
                            ({{ \Carbon\Carbon::parse($periodoHabilitado->fecha_inicio)->format('d/m/Y') }} 
                            al {{ \Carbon\Carbon::parse($periodoHabilitado->fecha_fin)->format('d/m/Y') }})
                        </span>
                        @endif
                    </div>
                    <div class="periodo-status {{ $periodoHabilitado->activo ? 'status-activo' : 'status-inactivo' }}">
                        <i class="fas fa-{{ $periodoHabilitado->activo ? 'check-circle' : 'times-circle' }}"></i>
                        {{ $periodoHabilitado->activo ? 'ACTIVO' : 'INACTIVO' }}
                    </div>
                </div>
                @else
                <div class="periodo-mensaje">
                    <i class="fas fa-info-circle"></i>
                    <div>
                        <strong>Sin período activo</strong>
                        <p style="margin: 5px 0 0 0; font-size: 0.9rem;">
                            No hay un período habilitado actualmente. Los documentos mostrados son de todos los períodos.
                        </p>
                    </div>
                </div>
                @endif

                <div class="maestros-section">
                    <div class="section-header">
                        <h2>Documentación por Maestro</h2>
                        <div class="maestros-count">
                            <i class="fas fa-users"></i> 
                            {{ $totalMaestros ?? 0 }} Maestros
                        </div>
                    </div>

                    <div class="search-filter">
                        <form method="GET" action="{{ route('coordinaciones.maestros') }}" class="search-box">
                            <i class="fas fa-search"></i>
                            <input type="hidden" name="coordinaciones_id" value="{{ $coordinacion->id }}">
                            <input type="text" name="search" placeholder="Buscar maestro..." value="{{ request('search') }}">
                        </form>
                        <a href="{{ route('maestros.create') }}?coordinaciones_id={{ $coordinacion->id }}" class="filter-btn primary-btn">
                            <i class="fas fa-plus"></i> Nuevo
                        </a>
                    </div>

                    <div class="maestros-table-container">
                        <div class="table-responsive">
                            <table class="maestros-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Maestro</th>
                                        <th>Especialidad</th>
                                        <th>Estado de Documentos</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($maestros as $index => $maestro)
                                    @php
                                        // ✅ USAR VARIABLES CON VALIDACIÓN
                                        $estado = $maestro->estadoDocumentos ?? null;
                                        $progreso = $maestro->progresoDocumentos ?? ['subidos' => 0, 'total' => 0];
                                        $documentosFaltantes = max(0, ($progreso['total'] ?? 0) - ($progreso['subidos'] ?? 0));
                                    @endphp
                                    <tr>
                                        <td>{{ $maestros->firstItem() + $index }}</td>
                                        <td>
                                            <div class="maestro-info">
                                                <div class="maestro-avatar">
                                                    {{ strtoupper(substr($maestro->nombres ?? '', 0, 1) . substr($maestro->apellido_paterno ?? '', 0, 1)) }}
                                                </div>
                                                <div class="maestro-name">
                                                    <h4>{{ $maestro->nombres ?? '' }} {{ $maestro->apellido_paterno ?? '' }}</h4>
                                                    <p>{{ $maestro->email ?? '' }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <strong>{{ $maestro->maximo_grado_academico ?? 'N/A' }}</strong>
                                            <br>
                                            <small>{{ $maestro->especialidad ?? '' }}</small>
                                        </td>
                                        <td>
                                            <div class="document-progress">
                                                <div class="progress-stats">
                                                    <div class="doc-count">
                                                        <i class="fas fa-check entregados"></i>
                                                        <span class="entregados">{{ $progreso['subidos'] ?? 0 }}</span>
                                                        <span style="margin: 0 4px; color: var(--text-muted);">/</span>
                                                        <i class="fas fa-times faltantes"></i>
                                                        <span class="faltantes">{{ $documentosFaltantes }}</span>
                                                    </div>
                                                </div>
                                                @if($estado)
                                                <div style="font-size: 0.75rem; color: var(--text-muted);">
                                                    {{ $estado['aprobados'] ?? 0 }} aprobados • 
                                                    {{ $estado['rechazados'] ?? 0 }} rechazados • 
                                                    {{ $estado['pendientes'] ?? 0 }} pendientes
                                                </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <div class="action-icons">
                                                <a href="" class="icon-btn" title="Ver documentos">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('maestros.edit', $maestro->id) }}" class="icon-btn" title="Editar">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" style="text-align: center; padding: 30px;">
                                            <i class="fas fa-users-slash" style="font-size: 2rem; margin-bottom: 10px; opacity: 0.5; color: var(--text-muted);"></i>
                                            <p>No hay maestros registrados</p>
                                            <a href="{{ route('maestros.create') }}?coordinaciones_id={{ $coordinacion->id }}" 
                                               class="filter-btn primary-btn" style="display: inline-flex; margin-top: 10px;">
                                                <i class="fas fa-plus"></i> Agregar primer maestro
                                            </a>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    @if($maestros->hasPages())
                    <div class="pagination">
                        @if(!$maestros->onFirstPage())
                            <a href="{{ $maestros->previousPageUrl() }}" class="page-btn"><i class="fas fa-chevron-left"></i></a>
                        @endif
                        
                        @foreach(range(1, $maestros->lastPage()) as $page)
                            @if($page == $maestros->currentPage())
                                <span class="page-btn active">{{ $page }}</span>
                            @else
                                <a href="{{ $maestros->url($page) }}" class="page-btn">{{ $page }}</a>
                            @endif
                        @endforeach
                        
                        @if($maestros->hasMorePages())
                            <a href="{{ $maestros->nextPageUrl() }}" class="page-btn"><i class="fas fa-chevron-right"></i></a>
                        @endif
                    </div>
                    @endif
                </div>
            @endif

            <div class="footer-info">
                <p>GEPROC GP | {{ now()->format('d/m/Y H:i') }}</p>
                @if($coordinacion && $maestros->total() > 0)
                <p>Mostrando {{ $maestros->firstItem() }}-{{ $maestros->lastItem() }} de {{ $maestros->total() }} maestros</p>
                @endif
                @if(isset($periodoHabilitado) && $periodoHabilitado)
                <p>Período: {{ $periodoHabilitado->nombre }}</p>
                @endif
            </div>
        </main>
    </div>

    <a href="{{ route('maestros.create') }}?coordinaciones_id={{ $coordinacion->id ?? '' }}" class="fab">
        <i class="fas fa-plus"></i>
    </a>

    <script>
        function showAlert(message, type = 'success') {
            alert(message);
        }
    </script>
</body>
</html>