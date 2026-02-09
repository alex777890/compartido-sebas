<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estadísticas de Coordinación</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- jsPDF para exportación a PDF -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <!-- SheetJS para exportación a Excel -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <style>
        :root {
            --primary: #0744b6ff;
            --secondary: #33CAE6;
            --accent: #28a745;
            --light-bg: #F8F9FA;
            --border-color: #E9ECEF;
            --text-muted: #6C757D;
            --card-shadow: 0 5px 15px rgba(7, 68, 182, 0.08);
            --transition: all 0.3s ease;
            --success-color: #28a745;
            --warning-color: #FFC107;
            --danger-color: #dc3545;
            --info-color: #17a2b8;
            --pink-color: #e83e8c;
        }
        
        body { 
            background: #f5f7fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            color: #333; 
            line-height: 1.6;
            margin: 0;
            padding: 0;
            min-height: 100vh;
        }
        
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
            font-size: 0.95rem;
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

        /* Contenido principal */
        .main-content {
            padding: 25px 20px;
            max-width: 1400px;
            margin: 0 auto;
            min-height: calc(100vh - 136px);
        }
        
        /* IMPORTANTE: OCULTAR EL ENCABEZADO EN LA VISTA WEB */
        .report-header-container {
            display: none !important; /* NO se ve en la web */
        }
        
        /* Cabecera de la página */
        .page-header {
            background: white;
            border-radius: 12px;
            padding: 20px 25px;
            margin-bottom: 25px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            border-left: 5px solid var(--primary);
        }
        
        .page-title {
            color: var(--primary);
            font-weight: 700;
            margin-bottom: 5px;
            font-size: 1.7rem;
        }
        
        .page-subtitle {
            color: var(--text-muted);
            font-size: 1rem;
            margin-bottom: 5px;
        }
        
        /* Secciones de estadísticas */
        .stats-section {
            background: white;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 25px;
            box-shadow: var(--card-shadow);
            border: 1px solid var(--border-color);
        }
        
        .section-title {
            color: var(--primary);
            font-weight: 600;
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 2px solid #f0f2f5;
            font-size: 1.3rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .section-title i {
            color: var(--secondary);
            background: rgba(51, 202, 230, 0.1);
            width: 36px;
            height: 36px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        /* Grid de estadísticas */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 15px;
            margin-bottom: 15px;
        }
        
        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 20px 15px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
            border-top: 4px solid var(--primary);
            transition: var(--transition);
            text-align: center;
            border: 1px solid var(--border-color);
        }
        
        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(7, 68, 182, 0.15);
        }
        
        .stat-card.primary { border-top-color: var(--primary); }
        .stat-card.success { border-top-color: var(--success-color); }
        .stat-card.warning { border-top-color: var(--warning-color); }
        .stat-card.danger { border-top-color: var(--danger-color); }
        .stat-card.info { border-top-color: var(--info-color); }
        .stat-card.pink { border-top-color: var(--pink-color); }
        
        .stat-number {
            font-size: 2.4rem;
            font-weight: 800;
            margin-bottom: 5px;
            line-height: 1;
        }
        
        .stat-label {
            color: var(--text-muted);
            font-size: 0.95rem;
            font-weight: 500;
            margin-bottom: 8px;
        }
        
        .stat-percentage {
            font-size: 1rem;
            font-weight: 600;
            padding: 6px 12px;
            background: rgba(7, 68, 182, 0.08);
            border-radius: 20px;
            display: inline-block;
        }
        
        /* Gráficas */
        .charts-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(480px, 1fr));
            gap: 20px;
            margin-bottom: 15px;
        }
        
        .chart-wrapper {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border-color);
        }
        
        .chart-title {
            color: var(--primary);
            font-weight: 600;
            margin-bottom: 15px;
            font-size: 1.15rem;
            text-align: center;
            padding-bottom: 12px;
            border-bottom: 1px solid #f0f2f5;
        }
        
        .chart-container {
            height: 300px;
            position: relative;
        }
        
        /* Grid de edades */
        .age-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
            margin-top: 15px;
        }
        
        .age-item {
            background: white;
            border-radius: 10px;
            padding: 20px 12px;
            text-align: center;
            border-left: 4px solid var(--secondary);
            transition: var(--transition);
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border-color);
        }
        
        .age-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .age-value {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 5px;
        }
        
        .age-label {
            font-size: 0.9rem;
            color: var(--text-muted);
            margin-bottom: 6px;
            font-weight: 500;
        }
        
        .age-percentage {
            font-size: 0.85rem;
            color: var(--success-color);
            font-weight: 600;
            background: rgba(40, 167, 69, 0.1);
            padding: 4px 8px;
            border-radius: 12px;
            display: inline-block;
        }
        
        /* Botones de exportación */
        .export-buttons {
            display: flex;
            gap: 8px;
            justify-content: flex-end;
            margin-top: 15px;
        }
        
        .export-buttons .btn {
            padding: 6px 12px;
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        /* Estilos para la exportación */
        .export-loading {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.9);
            z-index: 9999;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            color: white;
        }

        .export-loading.show {
            display: flex;
        }

        .spinner-border {
            width: 3rem;
            height: 3rem;
            border-width: 0.25em;
        }
        
        .loading-text {
            margin-top: 15px;
            font-size: 1.1rem;
            font-weight: 500;
        }
        
        /* Responsive */
        @media (max-width: 1200px) {
            .charts-container {
                grid-template-columns: 1fr;
            }
        }
        
        @media (max-width: 992px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .main-content {
                padding: 20px 15px;
            }
            
            .page-header {
                padding: 18px 20px;
            }
            
            .charts-container {
                grid-template-columns: 1fr;
            }
        }
        
        @media (max-width: 768px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .age-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .chart-wrapper {
                padding: 18px;
            }
            
            .chart-container {
                height: 260px;
            }
            
            .export-buttons {
                flex-wrap: wrap;
                justify-content: center;
            }
            
            .export-buttons .btn {
                flex: 1;
                min-width: 130px;
                font-size: 0.85rem;
                padding: 5px 10px;
            }
        }
        
        @media (max-width: 576px) {
            .age-grid {
                grid-template-columns: 1fr;
            }
            
            .page-header {
                padding: 15px;
            }
            
            .stats-section {
                padding: 18px 15px;
            }
            
            .section-title {
                font-size: 1.15rem;
            }
            
            .stat-number {
                font-size: 2rem;
            }
            
            .chart-container {
                height: 220px;
            }
            
            .export-buttons .btn {
                min-width: 120px;
                font-size: 0.8rem;
            }
        }
        
        /* Estilos para impresión */
        @media print {
            .navbar-top, 
            .navbar-menu, 
            .export-buttons,
            .logout-btn {
                display: none !important;
            }
            
            .main-content {
                padding: 0;
                margin: 0;
                min-height: auto;
            }
            
            .page-header {
                box-shadow: none;
                border: 1px solid #ddd;
                margin-bottom: 15px;
                padding: 15px;
            }
            
            .stats-section {
                box-shadow: none;
                border: 1px solid #ddd;
                page-break-inside: avoid;
                margin-bottom: 15px;
                padding: 15px;
            }
            
            .chart-wrapper {
                box-shadow: none;
                border: 1px solid #ddd;
                page-break-inside: avoid;
                padding: 15px;
            }
            
            body {
                background: white;
                font-size: 11pt;
                font-family: 'Times New Roman', Times, serif;
            }
            
            .stat-number {
                font-size: 1.8rem;
            }
            
            .chart-container {
                height: 250px;
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
                    <li class="nav-item"><a class="nav-link" href="">Accesos</a></li>
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

    <!-- Overlay de carga para exportación -->
    <div class="export-loading" id="exportLoading">
        <div class="spinner-border text-light" role="status">
            <span class="visually-hidden">Generando PDF...</span>
        </div>
        <p class="loading-text" id="loadingText">Generando reporte, por favor espere...</p>
    </div>

    <div class="main-content" id="reportContent">
        <!-- NOTA: El encabezado "DEPARTAMENTO DE NOMINA" NO aparece aquí -->
        <!-- Solo aparecerá en el PDF generado -->

        <!-- Cabecera de la página (título y botones) -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="page-title">
                        <i class="fas fa-chart-line me-2"></i>
                        Estadísticas de Coordinación
                    </h1>
                    <h2 class="page-subtitle">{{ $coordinacion->nombre }}</h2>
                    <p class="text-muted mb-0">Resumen completo de la distribución de maestros</p>
                </div>
                <div class="col-md-4 text-end">
                    <div class="d-flex flex-column align-items-end gap-2">
                        <span class="badge bg-{{ $estaActiva ? 'success' : 'secondary' }} fs-6 p-2 px-3">
                            <i class="fas {{ $estaActiva ? 'fa-check' : 'fa-times' }} me-1"></i>
                            {{ $estaActiva ? 'Coordinación Activa' : 'Coordinación Inactiva' }}
                        </span>
                        <div class="export-buttons">
                            <a href="{{ route('coordinaciones.show', $coordinacion->id) }}" class="btn btn-warning">
                                <i class="fas fa-arrow-left me-1"></i> Volver
                            </a>
            
                            <button class="btn btn-outline-success" id="exportPdf">
                                <i class="fas fa-file-pdf me-1"></i> PDF
                            </button>
                            <button class="btn btn-outline-info" id="exportExcel">
                                <i class="fas fa-file-excel me-1"></i> Excel
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sección 1: Resumen General -->
        <div class="stats-section">
            <h3 class="section-title">
                <i class="fas fa-chart-bar"></i> Resumen General
            </h3>
            <div class="stats-grid">
                <div class="stat-card success">
                    <div class="stat-number text-success">{{ $totalMaestros }}</div>
                    <div class="stat-label">Total de Maestros</div>
                    <div class="stat-percentage">100%</div>
                </div>
                
                <div class="stat-card primary">
                    <div class="stat-number text-primary">{{ $hombres }}</div>
                    <div class="stat-label">Hombres</div>
                    @if($totalMaestros > 0)
                        <div class="stat-percentage">{{ number_format(($hombres / $totalMaestros) * 100, 1) }}%</div>
                    @endif
                </div>
                
                <div class="stat-card pink">
                    <div class="stat-number text-pink">{{ $mujeres }}</div>
                    <div class="stat-label">Mujeres</div>
                    @if($totalMaestros > 0)
                        <div class="stat-percentage">{{ number_format(($mujeres / $totalMaestros) * 100, 1) }}%</div>
                    @endif
                </div>
                
                <div class="stat-card info">
                    <div class="stat-number text-info">{{ $maestrosActivos }}</div>
                    <div class="stat-label">Maestros Activos</div>
                    @if($totalMaestros > 0)
                        <div class="stat-percentage">{{ number_format(($maestrosActivos / $totalMaestros) * 100, 1) }}%</div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sección 2: Gráficas -->
        <div class="stats-section">
            <h3 class="section-title">
                <i class="fas fa-chart-pie"></i> Distribuciones
            </h3>
            <div class="charts-container">
                <!-- Gráfica de Género -->
                <div class="chart-wrapper">
                    <h4 class="chart-title">Distribución por Género</h4>
                    <div class="chart-container">
                        <canvas id="genderChart"></canvas>
                    </div>
                </div>
                
                <!-- Gráfica de Nivel Académico -->
                <div class="chart-wrapper">
                    <h4 class="chart-title">Nivel Académico</h4>
                    <div class="chart-container">
                        <canvas id="academicChart"></canvas>
                    </div>
                </div>
                
                <!-- Gráfica de Edades -->
                <div class="chart-wrapper">
                    <h4 class="chart-title">Distribución por Rango de Edad</h4>
                    <div class="chart-container">
                        <canvas id="ageChart"></canvas>
                    </div>
                </div>
                
                <!-- Gráfica de Actividad -->
                <div class="chart-wrapper">
                    <h4 class="chart-title">Estado de los Maestros</h4>
                    <div class="chart-container">
                        <canvas id="activityChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sección 3: Estadísticas Académicas -->
        <div class="stats-section">
            <h3 class="section-title">
                <i class="fas fa-graduation-cap"></i> Estadísticas de Nivel Académico
            </h3>
            <div class="stats-grid">
                <div class="stat-card success">
                    <div class="stat-number text-success">{{ $licenciatura }}</div>
                    <div class="stat-label">Licenciatura</div>
                    @if($totalMaestros > 0)
                        <div class="stat-percentage">{{ number_format(($licenciatura / $totalMaestros) * 100, 1) }}%</div>
                    @endif
                </div>
                
                <div class="stat-card warning">
                    <div class="stat-number text-warning">{{ $maestria }}</div>
                    <div class="stat-label">Maestría</div>
                    @if($totalMaestros > 0)
                        <div class="stat-percentage">{{ number_format(($maestria / $totalMaestros) * 100, 1) }}%</div>
                    @endif
                </div>
                
                <div class="stat-card danger">
                    <div class="stat-number text-danger">{{ $doctorado }}</div>
                    <div class="stat-label">Doctorado</div>
                    @if($totalMaestros > 0)
                        <div class="stat-percentage">{{ number_format(($doctorado / $totalMaestros) * 100, 1) }}%</div>
                    @endif
                </div>
                
                @if(isset($especialidad) && $especialidad > 0)
                <div class="stat-card info">
                    <div class="stat-number text-info">{{ $especialidad }}</div>
                    <div class="stat-label">Especialidad</div>
                    @if($totalMaestros > 0)
                        <div class="stat-percentage">{{ number_format(($especialidad / $totalMaestros) * 100, 1) }}%</div>
                    @endif
                </div>
                @endif
            </div>
        </div>

        <!-- Sección 4: Edades -->
        <div class="stats-section">
            <h3 class="section-title">
                <i class="fas fa-user-clock"></i> Distribución por Edad
            </h3>
            <div class="age-grid">
                <div class="age-item">
                    <div class="age-value">{{ $edades18_30 ?? 0 }}</div>
                    <div class="age-label">18-30 años</div>
                    @if($totalMaestros > 0)
                        <div class="age-percentage">{{ number_format((($edades18_30 ?? 0) / $totalMaestros) * 100, 1) }}%</div>
                    @endif
                </div>
                <div class="age-item">
                    <div class="age-value">{{ $edades31_40 ?? 0 }}</div>
                    <div class="age-label">31-40 años</div>
                    @if($totalMaestros > 0)
                        <div class="age-percentage">{{ number_format((($edades31_40 ?? 0) / $totalMaestros) * 100, 1) }}%</div>
                    @endif
                </div>
                <div class="age-item">
                    <div class="age-value">{{ $edades41_50 ?? 0 }}</div>
                    <div class="age-label">41-50 años</div>
                    @if($totalMaestros > 0)
                        <div class="age-percentage">{{ number_format((($edades41_50 ?? 0) / $totalMaestros) * 100, 1) }}%</div>
                    @endif
                </div>
                <div class="age-item">
                    <div class="age-value">{{ $edades51_60 ?? 0 }}</div>
                    <div class="age-label">51-60 años</div>
                    @if($totalMaestros > 0)
                        <div class="age-percentage">{{ number_format((($edades51_60 ?? 0) / $totalMaestros) * 100, 1) }}%</div>
                    @endif
                </div>
                <div class="age-item">
                    <div class="age-value">{{ $edades61_plus ?? 0 }}</div>
                    <div class="age-label">61+ años</div>
                    @if($totalMaestros > 0)
                        <div class="age-percentage">{{ number_format((($edades61_plus ?? 0) / $totalMaestros) * 100, 1) }}%</div>
                    @endif
                </div>
                <div class="age-item">
                    <div class="age-value">
                        @php
                            $sumaEdades = 0;
                            $contadorEdades = 0;
                            if (isset($maestros)) {
                                foreach ($maestros as $maestro) {
                                    if ($maestro->edad) {
                                        $sumaEdades += $maestro->edad;
                                        $contadorEdades++;
                                    }
                                }
                            }
                            $promedioEdad = $contadorEdades > 0 ? round($sumaEdades / $contadorEdades, 1) : 0;
                        @endphp
                        {{ $promedioEdad }}
                    </div>
                    <div class="age-label">Promedio</div>
                    <div class="age-percentage">años</div>
                </div>
            </div>
        </div>

        <!-- Sección 5: Actividad -->
        <div class="stats-section">
            <h3 class="section-title">
                <i class="fas fa-user-check"></i> Estado de Actividad
            </h3>
            <div class="stats-grid">
                <div class="stat-card success">
                    <div class="stat-number text-success">{{ $maestrosActivos }}</div>
                    <div class="stat-label">Activos</div>
                    @if($totalMaestros > 0)
                        <div class="stat-percentage">{{ number_format(($maestrosActivos / $totalMaestros) * 100, 1) }}%</div>
                    @endif
                </div>
                <div class="stat-card danger">
                    <div class="stat-number text-danger">{{ $maestrosInactivos }}</div>
                    <div class="stat-label">Inactivos</div>
                    @if($totalMaestros > 0)
                        <div class="stat-percentage">{{ number_format(($maestrosInactivos / $totalMaestros) * 100, 1) }}%</div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('Cargando gráficas...');
    
    const genderData = {
        hombres: {{ $hombres }},
        mujeres: {{ $mujeres }}
    };

    const academicData = {
        licenciatura: Number({{ $licenciatura }}) || 0,
        maestria: Number({{ $maestria }}) || 0,
        doctorado: Number({{ $doctorado }}) || 0,
        especialidad: Number({{ $especialidad ?? 0 }}) || 0
    };

    const activityData = {
        activos: {{ $maestrosActivos }},
        inactivos: {{ $maestrosInactivos }}
    };

    const ageData = {
        edades18_30: {{ $edades18_30 ?? 0 }},
        edades31_40: {{ $edades31_40 ?? 0 }},
        edades41_50: {{ $edades41_50 ?? 0 }},
        edades51_60: {{ $edades51_60 ?? 0 }},
        edades61_plus: {{ $edades61_plus ?? 0 }}
    };

    const totalMaestros = {{ $totalMaestros }};

    // Gráfica de género
    const genderCtx = document.getElementById('genderChart').getContext('2d');
    const genderChart = new Chart(genderCtx, {
        type: 'doughnut',
        data: {
            labels: ['Hombres', 'Mujeres'],
            datasets: [{
                data: [genderData.hombres, genderData.mujeres],
                backgroundColor: ['#007bff', '#e83e8c'],
                borderWidth: 2,
                borderColor: '#fff',
                hoverOffset: 15
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 15,
                        font: {
                            size: 11,
                            weight: '500'
                        },
                        color: '#333'
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    titleFont: { size: 12 },
                    bodyFont: { size: 12 },
                    callbacks: {
                        label: function(context) {
                            const total = genderData.hombres + genderData.mujeres;
                            const percentage = total > 0 ? ((context.parsed / total) * 100).toFixed(1) : 0;
                            return `${context.label}: ${context.parsed} (${percentage}%)`;
                        }
                    }
                }
            }
        }
    });

    // Gráfica de nivel académico
    const academicCtx = document.getElementById('academicChart').getContext('2d');
    
    const academicLabels = [];
    const academicValues = [];
    const academicColors = ['#28a745', '#ffc107', '#dc3545', '#17a2b8'];
    
    if (academicData.licenciatura > 0) {
        academicLabels.push('Licenciatura');
        academicValues.push(academicData.licenciatura);
    }
    if (academicData.maestria > 0) {
        academicLabels.push('Maestría');
        academicValues.push(academicData.maestria);
    }
    if (academicData.doctorado > 0) {
        academicLabels.push('Doctorado');
        academicValues.push(academicData.doctorado);
    }
    if (academicData.especialidad > 0) {
        academicLabels.push('Especialidad');
        academicValues.push(academicData.especialidad);
    }
    
    const academicChart = new Chart(academicCtx, {
        type: 'pie',
        data: {
            labels: academicLabels,
            datasets: [{
                data: academicValues,
                backgroundColor: academicColors.slice(0, academicLabels.length),
                borderWidth: 2,
                borderColor: '#fff',
                hoverOffset: 15
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 15,
                        font: {
                            size: 11,
                            weight: '500'
                        },
                        color: '#333'
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    titleFont: { size: 12 },
                    bodyFont: { size: 12 },
                    callbacks: {
                        label: function(context) {
                            const total = totalMaestros;
                            const percentage = total > 0 ? ((context.parsed / total) * 100).toFixed(1) : 0;
                            return `${context.label}: ${context.parsed} (${percentage}%)`;
                        }
                    }
                }
            }
        }
    });

    // Gráfica de estado de actividad
    const activityCtx = document.getElementById('activityChart').getContext('2d');
    const activityChart = new Chart(activityCtx, {
        type: 'bar',
        data: {
            labels: ['Activos', 'Inactivos'],
            datasets: [{
                label: 'Cantidad de Maestros',
                data: [activityData.activos, activityData.inactivos],
                backgroundColor: ['#28a745', '#dc3545'],
                borderWidth: 1,
                borderRadius: 6,
                borderSkipped: false
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1,
                        font: {
                            size: 11
                        }
                    },
                    grid: {
                        drawBorder: false
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        font: {
                            size: 12,
                            weight: '500'
                        }
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    callbacks: {
                        label: function(context) {
                            const total = totalMaestros;
                            const percentage = total > 0 ? ((context.parsed / total) * 100).toFixed(1) : 0;
                            return `${context.label}: ${context.parsed} (${percentage}%)`;
                        }
                    }
                }
            }
        }
    });

    // Gráfica de edades
    const ageCtx = document.getElementById('ageChart').getContext('2d');
    const ageChart = new Chart(ageCtx, {
        type: 'bar',
        data: {
            labels: ['18-30 años', '31-40 años', '41-50 años', '51-60 años', '61+ años'],
            datasets: [{
                label: 'Cantidad de Maestros',
                data: [
                    ageData.edades18_30,
                    ageData.edades31_40,
                    ageData.edades41_50,
                    ageData.edades51_60,
                    ageData.edades61_plus
                ],
                backgroundColor: [
                    'rgba(54, 162, 235, 0.8)',
                    'rgba(75, 192, 192, 0.8)',
                    'rgba(255, 206, 86, 0.8)',
                    'rgba(153, 102, 255, 0.8)',
                    'rgba(255, 99, 132, 0.8)'
                ],
                borderColor: [
                    'rgb(54, 162, 235)',
                    'rgb(75, 192, 192)',
                    'rgb(255, 206, 86)',
                    'rgb(153, 102, 255)',
                    'rgb(255, 99, 132)'
                ],
                borderWidth: 1,
                borderRadius: 6,
                borderSkipped: false
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1,
                        font: {
                            size: 11
                        }
                    },
                    grid: {
                        drawBorder: false
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        font: {
                            size: 11,
                            weight: '500'
                        }
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    callbacks: {
                        label: function(context) {
                            const total = totalMaestros;
                            const percentage = total > 0 ? ((context.parsed / total) * 100).toFixed(1) : 0;
                            return `${context.label}: ${context.parsed} maestros (${percentage}%)`;
                        }
                    }
                }
            }
        }
    });

    // Event listeners para los botones de exportación
    document.getElementById('exportPdf').addEventListener('click', function(e) {
        e.preventDefault();
        exportToPDF();
    });

    document.getElementById('exportExcel').addEventListener('click', function(e) {
        e.preventDefault();
        exportToExcel();
    });

    // FUNCIÓN CORREGIDA PARA EXPORTAR A PDF
    async function exportToPDF() {
        const loadingElement = document.getElementById('exportLoading');
        const loadingText = document.getElementById('loadingText');
        loadingText.textContent = 'Preparando reporte PDF...';
        loadingElement.classList.add('show');
        
        try {
            // 1. Primero capturar todas las gráficas como imágenes
            loadingText.textContent = 'Capturando gráficas...';
            
            async function captureChart(canvasId) {
                const canvas = document.getElementById(canvasId);
                if (!canvas) return null;
                
                return new Promise((resolve) => {
                    setTimeout(() => {
                        html2canvas(canvas, {
                            scale: 2,
                            useCORS: true,
                            backgroundColor: '#ffffff',
                            logging: false
                        }).then(chartCanvas => {
                            resolve(chartCanvas.toDataURL('image/png'));
                        }).catch(() => resolve(null));
                    }, 500);
                });
            }
            
            const chartImages = {
                genderChart: await captureChart('genderChart'),
                academicChart: await captureChart('academicChart'),
                ageChart: await captureChart('ageChart'),
                activityChart: await captureChart('activityChart')
            };
            
            // 2. Crear una COPIA del contenido que ya está en pantalla
            loadingText.textContent = 'Generando documento...';
            
            // 3. Crear el HTML para PDF usando el contenido de la vista
            const pdfHTML = `
                <!DOCTYPE html>
                <html>
                <head>
                    <meta charset="UTF-8">
                    <title>Reporte Estadístico - {{ $coordinacion->nombre }}</title>
                    <style>
                        @page { margin: 20mm; }
                        body { 
                            font-family: 'Times New Roman', Times, serif; 
                            margin: 0; 
                            padding: 0; 
                            color: #000;
                            line-height: 1.4;
                            background: white;
                            font-size: 11pt;
                        }
                        
                        /* ENCABEZADO EXACTO COMO LA IMAGEN - SOLO PARA PDF */
                        .pdf-header {
                            border: 2px solid #000 !important;
                            border-radius: 0 !important;
                            padding: 25px !important;
                            margin-bottom: 25px !important;
                            text-align: center;
                            font-family: 'Times New Roman', Times, serif;
                            page-break-after: avoid;
                            position: relative;
                            background: white;
                        }
                        
                        .pdf-header-logo {
                            width: 100px !important;
                            height: auto;
                            position: absolute;
                            left: 30px;
                            top: 50%;
                            transform: translateY(-50%);
                        }
                        
                        .pdf-departamento {
                            font-size: 24pt !important;
                            font-weight: bold !important;
                            color: #000 !important;
                            margin: 0 !important;
                            text-transform: uppercase !important;
                            line-height: 1.2;
                            letter-spacing: 1px;
                        }
                        
                        .pdf-informe {
                            font-size: 18pt !important;
                            color: #000 !important;
                            margin: 10px 0 15px 0 !important;
                            font-weight: 500 !important;
                            line-height: 1.3;
                        }
                        
                        .pdf-financio {
                            font-size: 28pt !important;
                            font-weight: bold !important;
                            color: #000 !important;
                            margin-top: 25px !important;
                            text-transform: uppercase !important;
                            letter-spacing: 2px;
                        }
                        
                        /* Línea divisoria */
                        .pdf-divider {
                            border: none;
                            border-top: 1px solid #000;
                            width: 80%;
                            margin: 15px auto;
                        }
                        
                        /* Estilos para las secciones en PDF */
                        .page-header {
                            border: 1px solid #ddd !important;
                            border-radius: 5px !important;
                            padding: 15px !important;
                            margin-bottom: 15px !important;
                            border-left: 5px solid #0744b6 !important;
                        }
                        
                        .page-title {
                            color: #0744b6 !important;
                            font-size: 16pt !important;
                            margin-bottom: 5px !important;
                        }
                        
                        .stats-section {
                            border: 1px solid #ddd !important;
                            border-radius: 5px !important;
                            padding: 15px !important;
                            margin-bottom: 15px !important;
                            page-break-inside: avoid;
                        }
                        
                        .section-title {
                            color: #0744b6 !important;
                            font-size: 14pt !important;
                            border-bottom: 2px solid #f0f2f5;
                            padding-bottom: 8px;
                            margin-bottom: 15px;
                        }
                        
                        .stat-card {
                            border: 1px solid #ddd !important;
                            border-radius: 5px !important;
                            padding: 15px !important;
                            margin-bottom: 10px !important;
                        }
                        
                        .stat-number {
                            font-size: 1.8rem !important;
                        }
                        
                        .chart-wrapper {
                            border: 1px solid #ddd !important;
                            border-radius: 5px !important;
                            padding: 15px !important;
                            margin-bottom: 15px !important;
                            page-break-inside: avoid;
                        }
                        
                        .chart-container {
                            height: 250px !important;
                        }
                        
                        /* Ocultar elementos que no deben ir en PDF */
                        .export-buttons,
                        .btn,
                        .badge,
                        .navbar-top,
                        .navbar-menu,
                        .logout-btn {
                            display: none !important;
                        }
                        
                        /* Asegurar que las imágenes de gráficas se vean bien */
                        .chart-image {
                            width: 100%;
                            height: auto;
                            max-height: 200px;
                            object-fit: contain;
                            display: block;
                            margin: 0 auto;
                        }
                        
                        /* Grid de estadísticas para PDF */
                        .stats-grid {
                            display: grid;
                            grid-template-columns: repeat(4, 1fr);
                            gap: 10px;
                            margin-bottom: 15px;
                        }
                        
                        .age-grid {
                            display: grid;
                            grid-template-columns: repeat(3, 1fr);
                            gap: 10px;
                            margin-top: 15px;
                        }
                        
                        /* Pie de página */
                        .footer {
                            text-align: center;
                            margin-top: 40px;
                            font-size: 10px;
                            color: #666;
                            border-top: 1px solid #ddd;
                            padding-top: 10px;
                        }
                    </style>
                </head>
                <body>
                    <!-- ENCABEZADO EXACTO COMO LA IMAGEN - SOLO EN PDF -->
                    <div class="pdf-header">
                        <img src="{{ asset('img/logo_iufim.png') }}" alt="Logo" class="pdf-header-logo">
                        
                        <div style="display: inline-block; text-align: center;">
                            <div class="pdf-departamento">
                                DEPARTAMENTO DE NOMINA
                            </div>
                            
                            <div class="pdf-informe">
                                Informe de Estadísticas Generales de la Coordinación
                            </div>
                            
                            <div class="pdf-financio">
                                FINANCIO INGLÉS
                            </div>
                        </div>
                    </div>
                    
                    <!-- CABECERA DE LA PÁGINA -->
                    <div class="page-header">
                        <h1 class="page-title">
                            Estadísticas de Coordinación
                        </h1>
                        <h2 class="page-subtitle">{{ $coordinacion->nombre }}</h2>
                        <p class="text-muted mb-0">Resumen completo de la distribución de maestros</p>
                        <div style="margin-top: 10px;">
                            <span class="badge bg-{{ $estaActiva ? 'success' : 'secondary' }}">
                                {{ $estaActiva ? 'Coordinación Activa' : 'Coordinación Inactiva' }}
                            </span>
                        </div>
                    </div>
                    
                    <!-- SECCIÓN 1: RESUMEN GENERAL -->
                    <div class="stats-section">
                        <h3 class="section-title">Resumen General</h3>
                        <div class="stats-grid">
                            <div class="stat-card">
                                <div class="stat-number" style="color: #28a745;">{{ $totalMaestros }}</div>
                                <div class="stat-label">Total de Maestros</div>
                                <div class="stat-percentage">100%</div>
                            </div>
                            
                            <div class="stat-card">
                                <div class="stat-number" style="color: #007bff;">{{ $hombres }}</div>
                                <div class="stat-label">Hombres</div>
                                ${totalMaestros > 0 ? `<div class="stat-percentage">${(({{ $hombres }} / totalMaestros) * 100).toFixed(1)}%</div>` : ''}
                            </div>
                            
                            <div class="stat-card">
                                <div class="stat-number" style="color: #e83e8c;">{{ $mujeres }}</div>
                                <div class="stat-label">Mujeres</div>
                                ${totalMaestros > 0 ? `<div class="stat-percentage">${(({{ $mujeres }} / totalMaestros) * 100).toFixed(1)}%</div>` : ''}
                            </div>
                            
                            <div class="stat-card">
                                <div class="stat-number" style="color: #17a2b8;">{{ $maestrosActivos }}</div>
                                <div class="stat-label">Maestros Activos</div>
                                ${totalMaestros > 0 ? `<div class="stat-percentage">${(({{ $maestrosActivos }} / totalMaestros) * 100).toFixed(1)}%</div>` : ''}
                            </div>
                        </div>
                    </div>
                    
                    <!-- SECCIÓN 2: GRÁFICAS -->
                    <div class="stats-section">
                        <h3 class="section-title">Distribuciones</h3>
                        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 15px;">
                            <!-- Gráfica de Género -->
                            <div class="chart-wrapper">
                                <h4 class="chart-title">Distribución por Género</h4>
                                <div class="chart-container">
                                    ${chartImages.genderChart ? `<img src="${chartImages.genderChart}" class="chart-image">` : '<p>Gráfica no disponible</p>'}
                                </div>
                            </div>
                            
                            <!-- Gráfica de Nivel Académico -->
                            <div class="chart-wrapper">
                                <h4 class="chart-title">Nivel Académico</h4>
                                <div class="chart-container">
                                    ${chartImages.academicChart ? `<img src="${chartImages.academicChart}" class="chart-image">` : '<p>Gráfica no disponible</p>'}
                                </div>
                            </div>
                            
                            <!-- Gráfica de Edades -->
                            <div class="chart-wrapper">
                                <h4 class="chart-title">Distribución por Rango de Edad</h4>
                                <div class="chart-container">
                                    ${chartImages.ageChart ? `<img src="${chartImages.ageChart}" class="chart-image">` : '<p>Gráfica no disponible</p>'}
                                </div>
                            </div>
                            
                            <!-- Gráfica de Actividad -->
                            <div class="chart-wrapper">
                                <h4 class="chart-title">Estado de los Maestros</h4>
                                <div class="chart-container">
                                    ${chartImages.activityChart ? `<img src="${chartImages.activityChart}" class="chart-image">` : '<p>Gráfica no disponible</p>'}
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- SECCIÓN 3: ESTADÍSTICAS ACADÉMICAS -->
                    <div class="stats-section">
                        <h3 class="section-title">Estadísticas de Nivel Académico</h3>
                        <div class="stats-grid">
                            <div class="stat-card">
                                <div class="stat-number" style="color: #28a745;">{{ $licenciatura }}</div>
                                <div class="stat-label">Licenciatura</div>
                                ${totalMaestros > 0 ? `<div class="stat-percentage">${(({{ $licenciatura }} / totalMaestros) * 100).toFixed(1)}%</div>` : ''}
                            </div>
                            
                            <div class="stat-card">
                                <div class="stat-number" style="color: #ffc107;">{{ $maestria }}</div>
                                <div class="stat-label">Maestría</div>
                                ${totalMaestros > 0 ? `<div class="stat-percentage">${(({{ $maestria }} / totalMaestros) * 100).toFixed(1)}%</div>` : ''}
                            </div>
                            
                            <div class="stat-card">
                                <div class="stat-number" style="color: #dc3545;">{{ $doctorado }}</div>
                                <div class="stat-label">Doctorado</div>
                                ${totalMaestros > 0 ? `<div class="stat-percentage">${(({{ $doctorado }} / totalMaestros) * 100).toFixed(1)}%</div>` : ''}
                            </div>
                            
                            ${ {{ $especialidad ?? 0 }} > 0 ? `
                            <div class="stat-card">
                                <div class="stat-number" style="color: #17a2b8;">{{ $especialidad }}</div>
                                <div class="stat-label">Especialidad</div>
                                ${totalMaestros > 0 ? `<div class="stat-percentage">${(({{ $especialidad }} / totalMaestros) * 100).toFixed(1)}%</div>` : ''}
                            </div>
                            ` : ''}
                        </div>
                    </div>
                    
                    <!-- SECCIÓN 4: EDADES -->
                    <div class="stats-section">
                        <h3 class="section-title">Distribución por Edad</h3>
                        <div class="age-grid">
                            <div class="age-item">
                                <div class="age-value">{{ $edades18_30 ?? 0 }}</div>
                                <div class="age-label">18-30 años</div>
                                ${totalMaestros > 0 ? `<div class="age-percentage">${(({{ $edades18_30 ?? 0 }} / totalMaestros) * 100).toFixed(1)}%</div>` : ''}
                            </div>
                            <div class="age-item">
                                <div class="age-value">{{ $edades31_40 ?? 0 }}</div>
                                <div class="age-label">31-40 años</div>
                                ${totalMaestros > 0 ? `<div class="age-percentage">${(({{ $edades31_40 ?? 0 }} / totalMaestros) * 100).toFixed(1)}%</div>` : ''}
                            </div>
                            <div class="age-item">
                                <div class="age-value">{{ $edades41_50 ?? 0 }}</div>
                                <div class="age-label">41-50 años</div>
                                ${totalMaestros > 0 ? `<div class="age-percentage">${(({{ $edades41_50 ?? 0 }} / totalMaestros) * 100).toFixed(1)}%</div>` : ''}
                            </div>
                            <div class="age-item">
                                <div class="age-value">{{ $edades51_60 ?? 0 }}</div>
                                <div class="age-label">51-60 años</div>
                                ${totalMaestros > 0 ? `<div class="age-percentage">${(({{ $edades51_60 ?? 0 }} / totalMaestros) * 100).toFixed(1)}%</div>` : ''}
                            </div>
                            <div class="age-item">
                                <div class="age-value">{{ $edades61_plus ?? 0 }}</div>
                                <div class="age-label">61+ años</div>
                                ${totalMaestros > 0 ? `<div class="age-percentage">${(({{ $edades61_plus ?? 0 }} / totalMaestros) * 100).toFixed(1)}%</div>` : ''}
                            </div>
                            <div class="age-item">
                                <div class="age-value">
                                    ${ {{ $promedioEdad ?? 0 }} }
                                </div>
                                <div class="age-label">Promedio</div>
                                <div class="age-percentage">años</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- SECCIÓN 5: ACTIVIDAD -->
                    <div class="stats-section">
                        <h3 class="section-title">Estado de Actividad</h3>
                        <div class="stats-grid">
                            <div class="stat-card">
                                <div class="stat-number" style="color: #28a745;">{{ $maestrosActivos }}</div>
                                <div class="stat-label">Activos</div>
                                ${totalMaestros > 0 ? `<div class="stat-percentage">${(({{ $maestrosActivos }} / totalMaestros) * 100).toFixed(1)}%</div>` : ''}
                            </div>
                            <div class="stat-card">
                                <div class="stat-number" style="color: #dc3545;">{{ $maestrosInactivos }}</div>
                                <div class="stat-label">Inactivos</div>
                                ${totalMaestros > 0 ? `<div class="stat-percentage">${(({{ $maestrosInactivos }} / totalMaestros) * 100).toFixed(1)}%</div>` : ''}
                            </div>
                        </div>
                    </div>
                    
                    <!-- PIE DE PÁGINA -->
                    <div class="footer">
                        Sistema GEPROC | Reporte Estadístico<br>
                        Generado el ${new Date().toLocaleDateString()} a las ${new Date().toLocaleTimeString()}<br>
                        Coordinación: {{ $coordinacion->nombre }}
                    </div>
                </body>
                </html>
            `;
            
            // 4. Crear un div temporal para la exportación
            const tempDiv = document.createElement('div');
            tempDiv.style.position = 'absolute';
            tempDiv.style.left = '-9999px';
            tempDiv.style.top = '0';
            tempDiv.style.width = '800px';
            tempDiv.style.background = 'white';
            tempDiv.style.padding = '0';
            tempDiv.style.fontFamily = 'Times New Roman, Times, serif';
            
            // 5. Insertar el HTML en el div temporal
            tempDiv.innerHTML = pdfHTML;
            document.body.appendChild(tempDiv);
            
            // 6. Esperar a que las imágenes se carguen
            await new Promise(resolve => setTimeout(resolve, 2000));
            
            // 7. Convertir a imagen con html2canvas
            loadingText.textContent = 'Generando PDF...';
            const canvas = await html2canvas(tempDiv, {
                scale: 2,
                useCORS: true,
                logging: false,
                backgroundColor: '#ffffff',
                allowTaint: true,
                width: tempDiv.offsetWidth,
                height: tempDiv.scrollHeight,
                windowWidth: tempDiv.scrollWidth,
                windowHeight: tempDiv.scrollHeight
            });
            
            // 8. Limpiar el div temporal
            document.body.removeChild(tempDiv);
            
            // 9. Crear PDF
            const { jsPDF } = window.jspdf;
            const pdf = new jsPDF('p', 'mm', 'a4');
            
            const imgWidth = 210; // Ancho A4 en mm
            const imgHeight = (canvas.height * imgWidth) / canvas.width;
            
            // 10. Agregar imagen al PDF
            pdf.addImage(canvas.toDataURL('image/png', 1.0), 'PNG', 0, 0, imgWidth, imgHeight);
            
            // 11. Guardar el PDF
            const fileName = `Reporte_Estadisticas_{{ preg_replace('/[^a-zA-Z0-9]/', '_', $coordinacion->nombre) }}.pdf`;
            pdf.save(fileName);
            
            // 12. Ocultar loading
            loadingElement.classList.remove('show');
            
        } catch (error) {
            console.error('Error al generar PDF:', error);
            alert('Error al generar el PDF: ' + error.message);
            loadingElement.classList.remove('show');
        }
    }

    // FUNCIÓN PARA EXPORTAR A EXCEL (se mantiene igual)
    function exportToExcel() {
        const loadingElement = document.getElementById('exportLoading');
        const loadingText = document.getElementById('loadingText');
        loadingText.textContent = 'Generando Excel, por favor espere...';
        loadingElement.classList.add('show');
        
        try {
            // Verificar que la librería está cargada
            if (typeof XLSX === 'undefined') {
                throw new Error('La librería XLSX no está cargada. Recarga la página.');
            }
            
            // Preparar datos para Excel
            const data = [
                ['REPORTE DE ESTADÍSTICAS - COORDINACIÓN'],
                ['DEPARTAMENTO DE NOMINA'],
                ['Informe de Estadísticas Generales de la Coordinación'],
                [''],
                ['INFORMACIÓN DE LA COORDINACIÓN'],
                ['Coordinación: {{ $coordinacion->nombre }}'],
                ['Fecha de generación: ' + new Date().toLocaleDateString()],
                ['Estado: {{ $estaActiva ? "Activa" : "Inactiva" }}'],
                [''],
                ['RESUMEN GENERAL'],
                ['', 'Cantidad', 'Porcentaje'],
                ['Total de maestros', {{ $totalMaestros }}, '100%'],
                ['Hombres', {{ $hombres }}, totalMaestros > 0 ? (({{ $hombres }} / totalMaestros) * 100).toFixed(2) + '%' : '0%'],
                ['Mujeres', {{ $mujeres }}, totalMaestros > 0 ? (({{ $mujeres }} / totalMaestros) * 100).toFixed(2) + '%' : '0%'],
                ['Maestros Activos', {{ $maestrosActivos }}, totalMaestros > 0 ? (({{ $maestrosActivos }} / totalMaestros) * 100).toFixed(2) + '%' : '0%'],
                ['Maestros Inactivos', {{ $maestrosInactivos }}, totalMaestros > 0 ? (({{ $maestrosInactivos }} / totalMaestros) * 100).toFixed(2) + '%' : '0%'],
                [''],
                ['NIVEL ACADÉMICO'],
                ['', 'Cantidad', 'Porcentaje'],
                ['Licenciatura', {{ $licenciatura }}, totalMaestros > 0 ? (({{ $licenciatura }} / totalMaestros) * 100).toFixed(2) + '%' : '0%'],
                ['Maestría', {{ $maestria }}, totalMaestros > 0 ? (({{ $maestria }} / totalMaestros) * 100).toFixed(2) + '%' : '0%'],
                ['Doctorado', {{ $doctorado }}, totalMaestros > 0 ? (({{ $doctorado }} / totalMaestros) * 100).toFixed(2) + '%' : '0%'],
                @if(isset($especialidad) && $especialidad > 0)
                ['Especialidad', {{ $especialidad }}, totalMaestros > 0 ? (({{ $especialidad }} / totalMaestros) * 100).toFixed(2) + '%' : '0%'],
                @endif
                [''],
                ['DISTRIBUCIÓN POR EDAD'],
                ['Rango de Edad', 'Cantidad', 'Porcentaje'],
                ['18-30 años', {{ $edades18_30 ?? 0 }}, totalMaestros > 0 ? (({{ $edades18_30 ?? 0 }} / totalMaestros) * 100).toFixed(2) + '%' : '0%'],
                ['31-40 años', {{ $edades31_40 ?? 0 }}, totalMaestros > 0 ? (({{ $edades31_40 ?? 0 }} / totalMaestros) * 100).toFixed(2) + '%' : '0%'],
                ['41-50 años', {{ $edades41_50 ?? 0 }}, totalMaestros > 0 ? (({{ $edades41_50 ?? 0 }} / totalMaestros) * 100).toFixed(2) + '%' : '0%'],
                ['51-60 años', {{ $edades51_60 ?? 0 }}, totalMaestros > 0 ? (({{ $edades51_60 ?? 0 }} / totalMaestros) * 100).toFixed(2) + '%' : '0%'],
                ['61+ años', {{ $edades61_plus ?? 0 }}, totalMaestros > 0 ? (({{ $edades61_plus ?? 0 }} / totalMaestros) * 100).toFixed(2) + '%' : '0%'],
                ['Promedio de Edad', '{{ $promedioEdad }} años', ''],
                [''],
                ['INFORMACIÓN ADICIONAL'],
                ['Fecha y hora de exportación:', new Date().toLocaleString()]
            ];
            
            // Crear hoja de trabajo
            const ws = XLSX.utils.aoa_to_sheet(data);
            
            // Ajustar anchos de columnas
            const wscols = [
                { wch: 25 },
                { wch: 12 },
                { wch: 12 }
            ];
            ws['!cols'] = wscols;
            
            // Crear libro de trabajo
            const wb = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(wb, ws, 'Estadísticas');
            
            // Generar archivo
            const fileName = 'estadisticas-coordinacion-{{ preg_replace('/[^a-zA-Z0-9]/', '_', $coordinacion->nombre) }}.xlsx';
            XLSX.writeFile(wb, fileName);
            
            // Ocultar loading
            setTimeout(() => {
                loadingElement.classList.remove('show');
            }, 500);
            
        } catch (error) {
            console.error('ERROR en exportToExcel:', error);
            alert('Error al generar el Excel: ' + error.message);
            loadingElement.classList.remove('show');
        }
    }

    console.log('Todas las gráficas cargadas correctamente');
});
</script>
</body>
</html>