<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Maestros | GEPROC GP</title>
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

        /* ========== SIDEBAR ========== */
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

        /* ========== CONTENIDO PRINCIPAL ========== */
        .main-content {
            flex: 1;
            margin-left: 280px;
            padding: 20px;
            background: #f8fafc;
            min-height: 100vh;
        }

        .main-header {
            background: var(--card-bg);
            border-radius: 12px;
            padding: 20px 24px;
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

        /* ========== TABLA AJUSTADA AL MENU ========== */
        .maestros-section {
            background: var(--card-bg);
            border-radius: 12px;
            padding: 24px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
            margin-top: 0;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 16px;
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

        /* Buscador */
        .search-filter {
            display: flex;
            gap: 12px;
            margin-bottom: 24px;
            padding: 16px;
            background: var(--gradient-card);
            border-radius: 10px;
            border: 1px solid var(--border-color);
        }

        .search-box {
            flex-grow: 1;
            position: relative;
        }

        .search-box input {
            width: 100%;
            padding: 12px 16px 12px 44px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-size: 0.9rem;
            background: white;
        }

        .search-box i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        .filter-btn {
            background: white;
            border: 1px solid var(--border-color);
            padding: 12px 16px;
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

        /* ========== TABLA OPTIMIZADA PARA 8 COLUMNAS ========== */
        .maestros-table-container {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
            width: 100%;
        }

        .table-responsive {
            overflow-x: auto;
            width: 100%;
            max-width: calc(100vw - 320px); /* Resta el ancho del menú + padding */
        }

        .maestros-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 1150px; /* Optimizado para 8 columnas */
            table-layout: fixed; /* Distribuye el ancho equitativamente */
        }

        /* Distribución de columnas optimizada */
        .maestros-table th:nth-child(1), /* # */
        .maestros-table td:nth-child(1) {
            width: 50px;
            min-width: 50px;
            max-width: 50px;
        }

        .maestros-table th:nth-child(2), /* Maestro */
        .maestros-table td:nth-child(2) {
            width: 180px;
            min-width: 180px;
            max-width: 180px;
        }

        .maestros-table th:nth-child(3), /* Email */
        .maestros-table td:nth-child(3) {
            width: 200px;
            min-width: 200px;
            max-width: 200px;
        }

        .maestros-table th:nth-child(4), /* Teléfono */
        .maestros-table td:nth-child(4) {
            width: 120px;
            min-width: 120px;
            max-width: 120px;
        }

        .maestros-table th:nth-child(5), /* Grado Académico */
        .maestros-table td:nth-child(5) {
            width: 150px;
            min-width: 150px;
            max-width: 150px;
        }

        .maestros-table th:nth-child(6), /* Estado */
        .maestros-table td:nth-child(6) {
            width: 100px;
            min-width: 100px;
            max-width: 100px;
        }

        .maestros-table th:nth-child(7), /* Horario clase */
        .maestros-table td:nth-child(7) {
            width: 100px;
            min-width: 100px;
            max-width: 100px;
        }

        .maestros-table th:nth-child(8), /* Expediente */
        .maestros-table td:nth-child(8) {
            width: 100px;
            min-width: 100px;
            max-width: 100px;
        }

        .maestros-table th {
            padding: 14px 10px;
            text-align: left;
            font-weight: 700;
            color: var(--primary);
            border-bottom: 2px solid var(--border-color);
            text-transform: uppercase;
            font-size: 0.75rem;
            background: var(--light-primary);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .maestros-table td {
            padding: 14px 10px;
            border-bottom: 1px solid var(--border-color);
            vertical-align: middle;
            font-size: 0.85rem;
            height: 56px;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Información del maestro */
        .maestro-info {
            display: flex;
            align-items: center;
            gap: 12px;
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
            font-size: 0.9rem;
            flex-shrink: 0;
        }

        .maestro-name h4 {
            font-weight: 700;
            color: #333;
            margin-bottom: 4px;
            font-size: 0.9rem;
            line-height: 1.2;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .maestro-name p {
            font-size: 0.75rem;
            color: var(--text-muted);
            line-height: 1.2;
        }

        /* Información adicional */
        .maestro-detalle {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .detalle-item {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.8rem;
            line-height: 1.2;
        }

        .detalle-item i {
            width: 14px;
            color: var(--text-muted);
            font-size: 0.75rem;
            flex-shrink: 0;
        }

        .detalle-item span {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Badge de estado */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 0.75rem;
            font-weight: 700;
            white-space: nowrap;
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

        /* Acciones */
        .action-icons {
            display: flex;
            gap: 6px;
            justify-content: center;
        }

        .icon-btn {
            width: 34px;
            height: 34px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--light-bg);
            color: var(--text-muted);
            cursor: pointer;
            border: 1px solid var(--border-color);
            text-decoration: none;
            font-size: 0.8rem;
            transition: var(--transition);
        }

        .icon-btn:hover {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        /* Paginación */
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 5px;
            margin-top: 24px;
            padding-top: 16px;
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
            transition: var(--transition);
        }

        .page-btn:hover,
        .page-btn.active {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        /* Footer */
        .footer-info {
            margin-top: 30px;
            padding: 16px;
            background: var(--card-bg);
            border-radius: 10px;
            color: var(--text-muted);
            font-size: 0.8rem;
            text-align: center;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
        }

        /* FAB */
        .fab {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 56px;
            height: 56px;
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
            transition: var(--transition);
            z-index: 999;
        }

        .fab:hover {
            transform: scale(1.05);
            box-shadow: var(--shadow-lg);
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .sidebar { 
                width: 80px; 
            }
            .main-content { 
                margin-left: 80px; 
                padding: 16px;
            }
            .logo-text, .nav-item span { 
                display: none; 
            }
            .nav-item { 
                justify-content: center; 
                padding: 16px; 
            }
            .table-responsive {
                max-width: calc(100vw - 112px); /* Ajuste para menú colapsado */
            }
        }

        @media (max-width: 768px) {
            .main-content { 
                padding: 12px;
                margin-left: 0;
            }
            .sidebar {
                transform: translateX(-100%);
            }
            .maestros-section {
                padding: 16px;
            }
            .search-filter { 
                flex-direction: column; 
            }
            .filter-btn { 
                width: 100%; 
                justify-content: center; 
            }
            .table-responsive {
                max-width: 100vw;
            }
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div class="dashboard-container">
        <!-- SIDEBAR -->
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
                <a href="{{ route('coordinaciones.maestros-detalle') }}" class="nav-item active">
                    <i class="fas fa-users"></i>
                    <span>Maestros</span>
                </a>
                <a href="{{ route('coordinaciones.maestros') }}" class="nav-item">
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

        <!-- CONTENIDO PRINCIPAL -->
        <main class="main-content">
            <div class="main-header">
                <div class="header-left">
                    <h2>Lista Completa de Maestros</h2>
                    <p>Información detallada del personal académico</p>
                </div>
                <div class="header-right">
                    <div class="date-display">
                        <i class="fas fa-calendar-alt"></i>
                        {{ now()->format('d/m/Y') }}
                    </div>
                </div>
            </div>

            @if($coordinacion)
                <div class="maestros-section">
                    <div class="section-header">
                        <h2>Registro de Maestros</h2>
                        <div class="maestros-count">
                            <i class="fas fa-users"></i> 
                            {{ $totalMaestros ?? 0 }} Registrados
                        </div>
                    </div>

                    <div class="search-filter">
                        <form method="GET" action="{{ route('coordinaciones.maestros-detalle') }}" class="search-box">
                            <i class="fas fa-search"></i>
                            <input type="hidden" name="coordinaciones_id" value="{{ $coordinacion->id }}">
                            <input type="text" name="search" placeholder="Buscar por nombre, email, especialidad..." 
                                   value="{{ request('search') }}">
                        </form>
                        <button class="filter-btn" onclick="toggleFilters()">
                            <i class="fas fa-filter"></i> Filtros
                        </button>
                        <a href="{{ route('maestros.create') }}?coordinaciones_id={{ $coordinacion->id }}" 
                           class="filter-btn primary-btn">
                            <i class="fas fa-plus"></i> Nuevo Maestro
                        </a>
                    </div>

                    <div class="maestros-table-container">
                        <div class="table-responsive">
                            <table class="maestros-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Maestro</th>
                                        <th>Email</th>
                                        <th>Teléfono</th>
                                        <th>Grado Académico</th>
                                        <th>Estado</th>
                                        <th>Horario clase</th>
                                        <th>Expediente</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($maestros as $index => $maestro)
                                    <tr>
                                        <td>{{ $maestros->firstItem() + $index }}</td>
                                        <td>
                                            <div class="maestro-info">
                                                <div class="maestro-name">
                                                    <h4>{{ $maestro->nombres ?? '' }} {{ $maestro->apellido_paterno ?? '' }}</h4>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="maestro-detalle">
                                                <div class="detalle-item">
                                                    <i class="fas fa-envelope"></i>
                                                    <span>{{ $maestro->email ?? 'No especificado' }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="maestro-detalle">
                                                <div class="detalle-item">
                                                    <i class="fas fa-phone"></i>
                                                    <span>{{ $maestro->telefono ?? 'No especificado' }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <strong style="font-size: 0.9rem;">{{ $maestro->maximo_grado_academico ?? 'N/A' }}</strong>
                                            @if($maestro->titulo_obtenido)
                                            <div class="detalle-item" style="margin-top: 4px;">
                                                <i class="fas fa-graduation-cap"></i>
                                                <span style="font-size: 0.75rem;">{{ $maestro->titulo_obtenido }}</span>
                                            </div>
                                            @endif
                                        </td>
                                        <td>
                                            @if($maestro->activo ?? false)
                                                <span class="status-badge status-active">
                                                    <i class="fas fa-check-circle"></i> Activo
                                                </span>
                                            @else
                                                <span class="status-badge status-inactive">
                                                    <i class="fas fa-times-circle"></i> Inactivo
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="action-icons">
                                                <a href="#" class="icon-btn" title="Asignar Horario">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="action-icons">
                                                <a href="{{ route('maestros.show', $maestro->id) }}" class="icon-btn" title="Ver Expediente">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="8" style="text-align: center; padding: 40px;">
                                            <i class="fas fa-users-slash" style="font-size: 2rem; margin-bottom: 10px; opacity: 0.5; color: var(--text-muted);"></i>
                                            <p style="font-size: 0.9rem; color: var(--text-muted);">No hay maestros registrados</p>
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
                <p>GEPROC - Sistema de Gestión de Procesos</p>
                @if($coordinacion && $maestros->total() > 0)
                <p>Mostrando {{ $maestros->firstItem() }}-{{ $maestros->lastItem() }} de {{ $maestros->total() }} maestros</p>
                @endif
            </div>
        </main>
    </div>

    <a href="{{ route('maestros.create') }}?coordinaciones_id={{ $coordinacion->id ?? '' }}" class="fab">
        <i class="fas fa-plus"></i>
    </a>

    <script>
        function toggleFilters() {
            alert('Funcionalidad de filtros avanzados');
        }
    </script>
</body>
</html>