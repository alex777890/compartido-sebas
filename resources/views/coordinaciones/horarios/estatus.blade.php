<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estadísticas de Horarios - Sistema GEPROC</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- jsPDF -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <!-- SheetJS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        :root {
            --primary: #0744b6ff;
            --primary-light: #3a6bd3;
            --primary-soft: #e8f0fe;
            --secondary: #33CAE6;
            --accent: #28a745;
            --light-bg: #F8F9FA;
            --dark-bg: #1a1a2e;
            --sidebar-bg: #ffffff;
            --border-color: #E9ECEF;
            --text-muted: #6C757D;
            --card-shadow: 0 5px 20px rgba(7, 68, 182, 0.12);
            --card-shadow-hover: 0 10px 30px rgba(7, 68, 182, 0.2);
            --transition: all 0.3s ease;
            --success-color: #10b981;
            --success-light: #d1fae5;
            --warning-color: #f59e0b;
            --warning-light: #fef3c7;
            --danger-color: #ef4444;
            --danger-light: #fee2e2;
            --info-color: #3b82f6;
            --info-light: #dbeafe;
            --border-radius: 12px;
            --gradient-primary: linear-gradient(135deg, #0744b6ff 0%, #3a6bd3 100%);
            --gradient-success: linear-gradient(135deg, #10b981 0%, #34d399 100%);
            --gradient-warning: linear-gradient(135deg, #f59e0b 0%, #fbbf24 100%);
            --gradient-danger: linear-gradient(135deg, #ef4444 0%, #f87171 100%);
            --gradient-info: linear-gradient(135deg, #3b82f6 0%, #60a5fa 100%);
            --gradient-purple: linear-gradient(135deg, #8b5cf6 0%, #a78bfa 100%);
            --gradient-orange: linear-gradient(135deg, #f97316 0%, #fb923c 100%);
            --gradient-pink: linear-gradient(135deg, #ec4899 0%, #f472b6 100%);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #f5f7fb 0%, #f0f4f8 100%);
            color: #2d3748;
            line-height: 1.6;
            min-height: 100vh;
            font-size: 15px;
        }

        /* ===== HEADER SUPERIOR ===== */
        .header {
            height: 90px;
            background-color: white;
            box-shadow: 0 3px 20px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 40px;
            position: sticky;
            top: 0;
            z-index: 100;
            border-bottom: 4px solid var(--primary);
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 40px;
        }

        .header-logo {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .logo-img-header {
            height: 65px;
            width: auto;
            max-width: 180px;
            object-fit: contain;
        }

        .header-nav {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .nav-link {
            padding: 15px 22px;
            color: #4a5568;
            text-decoration: none;
            font-weight: 600;
            font-size: 16px;
            border-radius: 10px;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 12px;
            white-space: nowrap;
        }

        .nav-link:hover {
            background-color: #e8f0fe;
            color: var(--primary);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(7, 68, 182, 0.12);
        }

        .nav-link.active {
            background-color: #e8f0fe;
            color: var(--primary);
            box-shadow: 0 8px 16px rgba(7, 68, 182, 0.15);
            border-radius: 10px;
            font-weight: 700;
        }

        .nav-link i {
            font-size: 16px;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 30px;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 8px 16px;
            background-color: var(--light-bg);
            border-radius: 50px;
            cursor: pointer;
            transition: var(--transition);
            border: 2px solid var(--border-color);
        }

        .user-profile:hover {
            background-color: #e9ecef;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--gradient-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 16px;
        }

        .user-info {
            display: flex;
            flex-direction: column;
        }

        .user-info h4 {
            font-size: 15px;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 2px;
            white-space: nowrap;
        }

        .user-info p {
            font-size: 12px;
            color: var(--text-muted);
            white-space: nowrap;
        }

        .logout-button {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 28px;
            background-color: white;
            color: #4a5568;
            border: none;
            border-radius: 50px;
            font-weight: 600;
            font-size: 15px;
            cursor: pointer;
            transition: var(--transition);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .logout-button:hover {
            background-color: #fee2e2;
            color: var(--danger-color);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(239, 68, 68, 0.15);
        }

        .logout-button i {
            font-size: 16px;
        }

        /* Botón hamburguesa para móvil */
        .hamburger-btn {
            display: none;
            background: transparent;
            border: none;
            font-size: 24px;
            color: var(--primary);
            cursor: pointer;
            padding: 10px;
        }

        /* Menú móvil */
        .mobile-menu {
            display: none;
            position: fixed;
            top: 90px;
            left: 0;
            right: 0;
            background: white;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            z-index: 99;
            padding: 20px;
            border-bottom: 2px solid var(--border-color);
            transform: translateY(-100%);
            transition: transform 0.3s ease;
        }

        .mobile-menu.open {
            transform: translateY(0);
        }

        .mobile-nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 15px;
            color: #4a5568;
            text-decoration: none;
            font-weight: 600;
            border-radius: 10px;
            transition: var(--transition);
        }

        .mobile-nav-link:hover {
            background-color: var(--primary-soft);
            color: var(--primary);
        }

        .mobile-nav-link.active {
            background-color: var(--primary-soft);
            color: var(--primary);
        }

        /* MAIN CONTENT */
        .main-content {
            flex: 1;
        }

        .content-wrapper {
            padding: 30px 35px;
            max-width: 100%;
        }

        /* HEADER DEL CONTENIDO */
        .content-header {
            background-color: white;
            border-radius: var(--border-radius);
            padding: 25px 30px;
            margin-bottom: 25px;
            box-shadow: var(--card-shadow);
            border: 2px solid var(--border-color);
            transition: var(--transition);
            position: relative;
            overflow: hidden;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .content-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            
        }

        .content-header:hover {
            transform: translateY(-3px);
            box-shadow: var(--card-shadow-hover);
        }

        .content-header h1 {
            font-size: 28px;
            font-weight: 750;
            color: #1e293b;
            margin: 0 0 8px 0;
        }

        .content-header p {
            color: var(--text-muted);
            font-size: 15px;
            margin: 0;
        }

        .periodo-badge {
            background: var(--gradient-primary);
            color: white;
            padding: 12px 24px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        /* PERÍODO SELECTOR */
        .periodo-section {
            background-color: white;
            border-radius: var(--border-radius);
            padding: 20px 25px;
            margin-bottom: 25px;
            box-shadow: var(--card-shadow);
            border: 2px solid var(--border-color);
        }

        .periodo-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }

        .periodo-nombre {
            font-size: 18px;
            font-weight: 700;
            color: var(--primary);
        }

        .periodo-fechas {
            font-size: 14px;
            color: var(--text-muted);
            margin-top: 4px;
        }

        .periodo-estado {
            padding: 8px 18px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 13px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .estado-activo {
            background: var(--success-light);
            color: var(--success-color);
        }

        .estado-subida {
            background: var(--info-light);
            color: var(--info-color);
        }

        .estado-inactivo {
            background: var(--warning-light);
            color: var(--warning-color);
        }

        /* NOTA INFORMATIVA */
        .info-note {
            background-color: var(--primary-soft);
            border-left: 4px solid var(--primary);
            padding: 15px 20px;
            border-radius: 12px;
            margin-bottom: 25px;
            display: flex;
            align-items: flex-start;
            gap: 15px;
            font-size: 14px;
            color: #2d3748;
        }

        .info-note i {
            color: var(--primary);
            font-size: 20px;
            margin-top: 2px;
        }

        .info-note-content strong {
            color: var(--primary);
        }

        /* SECCIONES DE ESTADÍSTICAS */
        .section {
            background-color: white;
            border-radius: 16px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: var(--card-shadow);
            border: 2px solid var(--border-color);
            transition: var(--transition);
        }

        .section:hover {
            box-shadow: var(--card-shadow-hover);
        }

        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid var(--light-bg);
            flex-wrap: wrap;
            gap: 15px;
        }

        .section-title {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 20px;
            color: var(--primary);
            font-weight: 700;
        }

        .section-title i {
            font-size: 22px;
        }

        /* CARDS GRID */
        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }

        .cards-grid-3 {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }

        .stat-card {
            background-color: white;
            border-radius: 14px;
            padding: 20px;
            box-shadow: var(--card-shadow);
            transition: var(--transition);
            border: 2px solid var(--border-color);
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
        }

        .stat-card.primary::before { background: var(--gradient-primary); }
        .stat-card.success::before { background: var(--gradient-success); }
        .stat-card.warning::before { background: var(--gradient-warning); }
        .stat-card.danger::before { background: var(--gradient-danger); }
        .stat-card.info::before { background: var(--gradient-info); }
        .stat-card.purple::before { background: var(--gradient-purple); }
        .stat-card.orange::before { background: var(--gradient-orange); }
        .stat-card.pink::before { background: var(--gradient-pink); }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--card-shadow-hover);
        }

        .stat-number {
            font-size: 32px;
            font-weight: 800;
            color: #1e293b;
            line-height: 1;
            margin-bottom: 8px;
        }

        .stat-label {
            font-size: 14px;
            color: var(--text-muted);
            font-weight: 600;
            margin-bottom: 8px;
        }

        .stat-percentage {
            font-size: 13px;
            font-weight: 600;
            padding: 4px 12px;
            background-color: var(--primary-soft);
            border-radius: 50px;
            display: inline-block;
            color: var(--primary);
        }

        /* GRÁFICAS */
        .charts-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 20px;
        }

        .chart-wrapper {
            background-color: white;
            border-radius: 14px;
            padding: 20px;
            box-shadow: var(--card-shadow);
            border: 2px solid var(--border-color);
            transition: var(--transition);
        }

        .chart-wrapper:hover {
            box-shadow: var(--card-shadow-hover);
        }

        .chart-title {
            font-size: 16px;
            font-weight: 700;
            color: var(--primary);
            text-align: center;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--light-bg);
        }

        .chart-container {
            height: 280px;
            position: relative;
        }

        /* GRID DE EDADES */
        .age-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
        }

        .age-item {
            background-color: var(--light-bg);
            border-radius: 12px;
            padding: 18px;
            text-align: center;
            border: 1px solid var(--border-color);
            transition: var(--transition);
        }

        .age-item:hover {
            transform: translateY(-3px);
            box-shadow: var(--card-shadow);
            border-color: var(--primary-light);
        }

        .age-value {
            font-size: 28px;
            font-weight: 800;
            color: var(--primary);
            margin-bottom: 5px;
        }

        .age-label {
            font-size: 13px;
            color: var(--text-muted);
            margin-bottom: 8px;
        }

        .age-percentage {
            font-size: 12px;
            font-weight: 600;
            background-color: var(--primary-soft);
            padding: 4px 10px;
            border-radius: 50px;
            display: inline-block;
            color: var(--primary);
        }

        /* TABLA DE MATERIAS */
        .materias-table {
            width: 100%;
            border-collapse: collapse;
        }

        .materias-table th {
            text-align: left;
            padding: 12px;
            color: var(--text-muted);
            font-weight: 600;
            font-size: 13px;
            border-bottom: 2px solid var(--border-color);
        }

        .materias-table td {
            padding: 12px;
            border-bottom: 1px solid var(--border-color);
        }

        .materias-table tr:hover td {
            background-color: var(--primary-soft);
        }

        .badge-materia {
            background: var(--gradient-primary);
            color: white;
            padding: 6px 14px;
            border-radius: 50px;
            font-size: 13px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        /* ALERTAS INTERNAS */
        .alert-custom {
            padding: 15px 20px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .alert-custom.success {
            background-color: var(--success-light);
            color: #065f46;
        }

        .alert-custom.warning {
            background-color: var(--warning-light);
            color: #92400e;
        }

        .alert-custom i {
            font-size: 24px;
        }

        /* BOTONES DE EXPORTACIÓN */
        .export-buttons {
            display: flex;
            gap: 15px;
            justify-content: flex-end;
            margin-top: 10px;
            flex-wrap: wrap;
        }

        .btn-export {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
            border: none;
        }

        .btn-export.pdf {
            background: transparent;
            color: var(--danger-color);
            border: 2px solid var(--danger-color);
        }

        .btn-export.pdf:hover {
            background-color: var(--danger-color);
            color: white;
            transform: translateY(-2px);
        }

        .btn-export.excel {
            background: transparent;
            color: var(--success-color);
            border: 2px solid var(--success-color);
        }

        .btn-export.excel:hover {
            background-color: var(--success-color);
            color: white;
            transform: translateY(-2px);
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 24px;
            background: transparent;
            color: var(--warning-color);
            border: 2px solid var(--warning-color);
            border-radius: 10px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
        }

        .btn-back:hover {
            background-color: var(--warning-color);
            color: white;
            transform: translateY(-2px);
        }

        /* OVERLAY DE CARGA */
        .export-loading {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.8);
            display: none;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            z-index: 2000;
        }

        .export-loading.show {
            display: flex;
        }

        .spinner {
            width: 50px;
            height: 50px;
            border: 4px solid rgba(255,255,255,0.3);
            border-top-color: white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .loading-text {
            color: white;
            margin-top: 15px;
            font-size: 16px;
        }

        /* PROGRESS BAR */
        .progress {
            height: 6px;
            background-color: var(--light-bg);
            border-radius: 3px;
            overflow: hidden;
            margin-top: 8px;
        }

        .progress-bar {
            height: 100%;
            background: var(--gradient-primary);
            border-radius: 3px;
        }

        /* RESPONSIVE */
        @media (max-width: 1200px) {
            .header {
                padding: 0 25px;
                height: auto;
                flex-direction: column;
                gap: 15px;
                padding: 15px;
            }
            
            .header-left, .header-right {
                width: 100%;
                justify-content: space-between;
            }
            
            .header-nav {
                overflow-x: auto;
                padding-bottom: 10px;
                width: 100%;
            }
            
            .nav-link {
                padding: 12px 16px;
                font-size: 15px;
            }
            
            .content-wrapper {
                padding: 20px 25px;
            }
            
            .charts-container {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 992px) {
            .cards-grid, .cards-grid-3 {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .header-nav {
                display: none;
            }
            
            .hamburger-btn {
                display: block;
            }
            
            .mobile-menu {
                display: block;
            }
            
            .header-left {
                flex-direction: row;
                justify-content: space-between;
                width: 100%;
            }
            
            .user-info h4 {
                font-size: 14px;
            }
            
            .user-info p {
                font-size: 11px;
            }
            
            .section {
                padding: 18px;
            }
            
            .header-right {
                flex-wrap: wrap;
                justify-content: flex-end;
            }
            
            .content-header h1 {
                font-size: 24px;
            }
            
            .logout-button {
                padding: 8px 16px;
                font-size: 13px;
            }
            
            .user-profile {
                padding: 6px 12px;
            }
            
            .user-avatar {
                width: 35px;
                height: 35px;
                font-size: 14px;
            }
            
            .cards-grid, .cards-grid-3 {
                grid-template-columns: 1fr;
            }
            
            .age-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .periodo-info {
                flex-direction: column;
                text-align: center;
            }
            
            .export-buttons {
                justify-content: center;
            }
            
            .btn-export, .btn-back {
                flex: 1;
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            .content-wrapper {
                padding: 15px;
            }
            
            .section-title {
                font-size: 18px;
            }
            
            .age-grid {
                grid-template-columns: 1fr;
            }
            
            .chart-container {
                height: 220px;
            }
        }

        /* ESTILOS PARA IMPRESIÓN */
        @media print {
            .header, .mobile-menu, .hamburger-btn, .export-buttons, .logout-button, .info-note {
                display: none !important;
            }
            
            .main-content {
                margin-top: 0;
                padding: 0;
            }
            
            .section, .content-header, .periodo-section {
                box-shadow: none;
                border: 1px solid #ddd;
                page-break-inside: avoid;
            }
            
            .stat-card {
                box-shadow: none;
                border: 1px solid #ddd;
            }
        }
    </style>
</head>
<body>

@php
    use Illuminate\Support\Facades\Auth;
    use App\Models\Coordinacion;
    use Carbon\Carbon;
    
    $user = Auth::user();
    $coordinacion = $user->coordinaciones_id ? Coordinacion::find($user->coordinaciones_id) : null;
    
    $userInitials = '';
    if ($user && $user->name) {
        $names = explode(' ', $user->name);
        foreach ($names as $name) {
            if (!empty($name)) {
                $userInitials .= strtoupper(substr($name, 0, 1));
            }
        }
        $userInitials = substr($userInitials, 0, 2);
    }
    
    $coordinacionNombre = $coordinacion->nombre ?? 'Coordinación';
    $coordinacionId = $coordinacion->id ?? null;
@endphp

<div class="main-content">
    <!-- HEADER SUPERIOR -->
    <div class="header">
        <div class="header-left">
            <div class="header-logo">
                <img src="{{ asset('img/logo_iufim.png') }}" alt="Logo IUFIM" class="logo-img-header">
            </div>
            <button class="hamburger-btn" id="hamburgerBtn">
                <i class="fas fa-bars"></i>
            </button>
            <div class="header-nav">
                <a href="{{ route('coordinacion.dashboard') }}" class="nav-link">
                    <i class="fas fa-home"></i> Inicio
                </a>
                <a href="{{ route('coordinaciones.maestros-detalle') }}" class="nav-link">
                    <i class="fas fa-users"></i> Maestros
                </a>
                <a href="{{ route('coordinaciones.maestros') }}" class="nav-link">
                    <i class="fas fa-file-alt"></i> Documentos
                </a>
                <a href="{{ route('coordinaciones.estatus') }}" class="nav-link active">
                    <i class="fas fa-chart-bar"></i> Estadísticas
                </a>
            </div>
        </div>
        
        <div class="header-right">
            
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-button">
                    <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                </button>
            </form>
        </div>
    </div>

    <!-- MENÚ MÓVIL -->
    <div class="mobile-menu" id="mobileMenu">
        <a href="{{ route('coordinacion.dashboard') }}" class="mobile-nav-link">
            <i class="fas fa-home"></i> Inicio
        </a>
        <a href="{{ route('coordinaciones.maestros-detalle') }}" class="mobile-nav-link">
            <i class="fas fa-users"></i> Maestros
        </a>
        <a href="{{ route('coordinaciones.maestros') }}" class="mobile-nav-link">
            <i class="fas fa-file-alt"></i> Documentos
        </a>
        <a href="{{ route('coordinaciones.estatus') }}" class="mobile-nav-link active">
            <i class="fas fa-chart-bar"></i> Estadísticas
        </a>
    </div>

    <!-- CONTENIDO PRINCIPAL -->
    <div class="content-wrapper">
        <!-- HEADER -->
        <div class="content-header">
            <div>
                <h1>Estadísticas de Horarios</h1>
                <p><i class="fas fa-chart-pie" style="color: var(--primary); margin-right: 8px;"></i>{{ $coordinacionNombre }}</p>
            </div>
            @if(isset($periodoSeleccionado) && $periodoSeleccionado)
            <div class="periodo-badge">
                <i class="fas fa-calendar-alt"></i>
                {{ $periodoSeleccionado->nombre ?? 'Período' }}
                @if($periodoSeleccionado->activo ?? false)
                    (Activo)
                @elseif($periodoSeleccionado->subida_habilitada ?? false)
                    (Subida Habilitada)
                @endif
            </div>
            @endif
        </div>

        <!-- PERÍODO SELECCIONADO -->
        @if(isset($periodoSeleccionado) && $periodoSeleccionado)
        <div class="periodo-section">
            <div class="periodo-info">
                <div>
                    <div class="periodo-nombre">
                        <i class="fas fa-calendar-check" style="color: var(--primary); margin-right: 8px;"></i>
                        {{ $periodoSeleccionado->nombre }}
                    </div>
                    <div class="periodo-fechas">
                        <i class="fas fa-calendar-alt"></i>
                        {{ \Carbon\Carbon::parse($periodoSeleccionado->fecha_inicio)->format('d/m/Y') }} - 
                        {{ \Carbon\Carbon::parse($periodoSeleccionado->fecha_fin)->format('d/m/Y') }}
                    </div>
                </div>
                <div>
                    @if($periodoSeleccionado->activo ?? false)
                        <span class="periodo-estado estado-activo">
                            <i class="fas fa-check-circle"></i> Período activo actualmente
                        </span>
                    @elseif($periodoSeleccionado->subida_habilitada ?? false)
                        <span class="periodo-estado estado-subida">
                            <i class="fas fa-upload"></i> Período con subida de documentos habilitada
                        </span>
                    @else
                        <span class="periodo-estado estado-inactivo">
                            <i class="fas fa-info-circle"></i> Período inactivo (solo consulta)
                        </span>
                    @endif
                </div>
            </div>
        </div>
        @endif

        <!-- NOTA INFORMATIVA -->
        <div class="info-note">
            <i class="fas fa-chart-line"></i>
            <div class="info-note-content">
                <strong>Acerca de las estadísticas</strong><br>
                Los datos mostrados corresponden al período <strong>{{ $periodoSeleccionado->nombre ?? 'seleccionado' }}</strong>. 
                Se incluye información de <strong>{{ $totalMaestros ?? 0 }} maestros</strong> de tu coordinación.
            </div>
        </div>

        <!-- SECCIÓN 1: RESUMEN GENERAL -->
        <div class="section">
            <div class="section-header">
                <div class="section-title">
                    <i class="fas fa-chart-bar"></i>
                    <span>Resumen General de Maestros</span>
                </div>
            </div>
            <div class="cards-grid">
                <div class="stat-card success">
                    <div class="stat-number text-success">{{ $totalMaestros ?? 0 }}</div>
                    <div class="stat-label">Total de Maestros</div>
                    <div class="stat-percentage">100%</div>
                </div>
                
                <div class="stat-card primary">
                    <div class="stat-number text-primary">{{ $hombres ?? 0 }}</div>
                    <div class="stat-label">Hombres</div>
                    @if(($totalMaestros ?? 0) > 0)
                        <div class="stat-percentage">{{ number_format((($hombres ?? 0) / ($totalMaestros ?? 1)) * 100, 1) }}%</div>
                    @endif
                </div>
                
                <div class="stat-card pink">
                    <div class="stat-number text-pink">{{ $mujeres ?? 0 }}</div>
                    <div class="stat-label">Mujeres</div>
                    @if(($totalMaestros ?? 0) > 0)
                        <div class="stat-percentage">{{ number_format((($mujeres ?? 0) / ($totalMaestros ?? 1)) * 100, 1) }}%</div>
                    @endif
                </div>
                
                @if(isset($otros) && $otros > 0)
                <div class="stat-card purple">
                    <div class="stat-number text-purple">{{ $otros }}</div>
                    <div class="stat-label">Otro</div>
                    <div class="stat-percentage">{{ number_format(($otros / ($totalMaestros ?? 1)) * 100, 1) }}%</div>
                </div>
                @endif
                
                @if(isset($sinSexo) && $sinSexo > 0)
                <div class="stat-card warning">
                    <div class="stat-number text-warning">{{ $sinSexo }}</div>
                    <div class="stat-label">Sin especificar</div>
                    <div class="stat-percentage">{{ number_format(($sinSexo / ($totalMaestros ?? 1)) * 100, 1) }}%</div>
                </div>
                @endif
                
                <div class="stat-card info">
                    <div class="stat-number text-info">{{ $maestrosActivos ?? 0 }}</div>
                    <div class="stat-label">Maestros Activos</div>
                    @if(($totalMaestros ?? 0) > 0)
                        <div class="stat-percentage">{{ number_format((($maestrosActivos ?? 0) / ($totalMaestros ?? 1)) * 100, 1) }}%</div>
                    @endif
                </div>
            </div>
        </div>

        <!-- SECCIÓN 2: ESTADO DE HORARIOS -->
        <div class="section">
            <div class="section-header">
                <div class="section-title">
                    <i class="fas fa-clock"></i>
                    <span>Estado de Horarios</span>
                </div>
            </div>
            <div class="cards-grid-3">
                <div class="stat-card success">
                    <div class="stat-number text-success">{{ $conHorario ?? 0 }}</div>
                    <div class="stat-label">Con Horario Asignado</div>
                    @if(($totalMaestros ?? 0) > 0)
                        <div class="stat-percentage">{{ number_format((($conHorario ?? 0) / ($totalMaestros ?? 1)) * 100, 1) }}%</div>
                    @endif
                </div>
                
                <div class="stat-card warning">
                    <div class="stat-number text-warning">{{ $sinHorario ?? 0 }}</div>
                    <div class="stat-label">Sin Horario</div>
                    @if(($totalMaestros ?? 0) > 0)
                        <div class="stat-percentage">{{ number_format((($sinHorario ?? 0) / ($totalMaestros ?? 1)) * 100, 1) }}%</div>
                    @endif
                </div>
                
                <div class="stat-card info">
                    <div class="stat-number text-info">{{ $conFoto ?? 0 }}</div>
                    <div class="stat-label">Con Foto de Horario</div>
                    @if(($totalMaestros ?? 0) > 0)
                        <div class="stat-percentage">{{ number_format((($conFoto ?? 0) / ($totalMaestros ?? 1)) * 100, 1) }}%</div>
                    @endif
                </div>
            </div>
            
            <div class="row mt-3" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 15px;">
                <div class="alert-custom success">
                    <i class="fas fa-check-circle"></i>
                    <div>
                        <strong>{{ $conHorarioYFoto ?? 0 }} maestros</strong> tienen horario completo con foto<br>
                        <small>Horario asignado y foto subida</small>
                    </div>
                </div>
                <div class="alert-custom warning">
                    <i class="fas fa-exclamation-triangle"></i>
                    <div>
                        <strong>{{ $conHorarioSinFoto ?? 0 }} maestros</strong> tienen horario sin foto<br>
                        <small>Horario asignado pero falta foto</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- SECCIÓN 3: GRÁFICAS -->
        <div class="section">
            <div class="section-header">
                <div class="section-title">
                    <i class="fas fa-chart-pie"></i>
                    <span>Distribuciones</span>
                </div>
            </div>
            <div class="charts-container">
                <div class="chart-wrapper">
                    <div class="chart-title">Estado de Horarios</div>
                    <div class="chart-container">
                        <canvas id="horariosChart"></canvas>
                    </div>
                </div>
                
                <div class="chart-wrapper">
                    <div class="chart-title">Distribución de Horas Clase</div>
                    <div class="chart-container">
                        <canvas id="horasChart"></canvas>
                    </div>
                </div>
                
                <div class="chart-wrapper">
                    <div class="chart-title">Distribución por Género</div>
                    <div class="chart-container">
                        <canvas id="genderChart"></canvas>
                    </div>
                </div>
                
                <div class="chart-wrapper">
                    <div class="chart-title">Estado de los Maestros</div>
                    <div class="chart-container">
                        <canvas id="activityChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- SECCIÓN 4: DISTRIBUCIÓN POR EDAD -->
        <div class="section">
            <div class="section-header">
                <div class="section-title">
                    <i class="fas fa-user-clock"></i>
                    <span>Distribución por Edad</span>
                </div>
            </div>
            <div class="age-grid">
                <div class="age-item">
                    <div class="age-value">{{ $edades18_30 ?? 0 }}</div>
                    <div class="age-label">18-30 años</div>
                    @if(($totalMaestros ?? 0) > 0)
                        <div class="age-percentage">{{ number_format((($edades18_30 ?? 0) / ($totalMaestros ?? 1)) * 100, 1) }}%</div>
                    @endif
                </div>
                <div class="age-item">
                    <div class="age-value">{{ $edades31_40 ?? 0 }}</div>
                    <div class="age-label">31-40 años</div>
                    @if(($totalMaestros ?? 0) > 0)
                        <div class="age-percentage">{{ number_format((($edades31_40 ?? 0) / ($totalMaestros ?? 1)) * 100, 1) }}%</div>
                    @endif
                </div>
                <div class="age-item">
                    <div class="age-value">{{ $edades41_50 ?? 0 }}</div>
                    <div class="age-label">41-50 años</div>
                    @if(($totalMaestros ?? 0) > 0)
                        <div class="age-percentage">{{ number_format((($edades41_50 ?? 0) / ($totalMaestros ?? 1)) * 100, 1) }}%</div>
                    @endif
                </div>
                <div class="age-item">
                    <div class="age-value">{{ $edades51_60 ?? 0 }}</div>
                    <div class="age-label">51-60 años</div>
                    @if(($totalMaestros ?? 0) > 0)
                        <div class="age-percentage">{{ number_format((($edades51_60 ?? 0) / ($totalMaestros ?? 1)) * 100, 1) }}%</div>
                    @endif
                </div>
                <div class="age-item">
                    <div class="age-value">{{ $edades61_plus ?? 0 }}</div>
                    <div class="age-label">61+ años</div>
                    @if(($totalMaestros ?? 0) > 0)
                        <div class="age-percentage">{{ number_format((($edades61_plus ?? 0) / ($totalMaestros ?? 1)) * 100, 1) }}%</div>
                    @endif
                </div>
                <div class="age-item">
                    <div class="age-value">
                        @php
                            $sumaEdades = 0;
                            $contadorEdades = 0;
                            if (isset($maestros)) {
                                foreach ($maestros as $maestro) {
                                    if (isset($maestro->edad) && $maestro->edad) {
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

        <!-- SECCIÓN 5: ESTADÍSTICAS DE HORAS -->
        <div class="section">
            <div class="section-header">
                <div class="section-title">
                    <i class="fas fa-hourglass-half"></i>
                    <span>Estadísticas de Horas Clase</span>
                </div>
            </div>
            <div class="cards-grid-3">
                <div class="stat-card info">
                    <div class="stat-number text-info">{{ $totalHorasAsignadas ?? 0 }}</div>
                    <div class="stat-label">Total Horas Asignadas</div>
                </div>
                <div class="stat-card success">
                    <div class="stat-number text-success">{{ ($conHorario ?? 0) > 0 ? round(($totalHorasAsignadas ?? 0) / ($conHorario ?? 1), 1) : 0 }}</div>
                    <div class="stat-label">Promedio Horas/Maestro</div>
                    <div class="small text-muted">(solo maestros con horario)</div>
                </div>
                <div class="stat-card warning">
                    <div class="stat-number text-warning">{{ $promedioHoras ?? 0 }}</div>
                    <div class="stat-label">Promedio General</div>
                    <div class="small text-muted">(todos los maestros)</div>
                </div>
            </div>
            
            <div class="section-header" style="margin-top: 20px;">
                <div class="section-title">
                    <i class="fas fa-chart-line"></i>
                    <span>Distribución de Horas por Maestro</span>
                </div>
            </div>
            <div class="cards-grid">
                @foreach($distribucionHoras ?? [] as $rango => $cantidad)
                <div class="stat-card">
                    <div class="stat-number">{{ $cantidad }}</div>
                    <div class="stat-label">{{ $rango }} horas</div>
                    @if(($totalMaestros ?? 0) > 0)
                        <div class="stat-percentage">{{ number_format(($cantidad / ($totalMaestros ?? 1)) * 100, 1) }}%</div>
                        <div class="progress">
                            <div class="progress-bar" style="width: {{ ($cantidad / ($totalMaestros ?? 1)) * 100 }}%"></div>
                        </div>
                    @endif
                </div>
                @endforeach
            </div>
        </div>

        <!-- SECCIÓN 6: TOP MATERIAS -->
        @if(isset($topMaterias) && count($topMaterias) > 0)
        <div class="section">
            <div class="section-header">
                <div class="section-title">
                    <i class="fas fa-book"></i>
                    <span>Top 5 Materias Más Impartidas</span>
                </div>
            </div>
            <div style="overflow-x: auto;">
                <table class="materias-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Materia</th>
                            <th class="text-center">Total Clases</th>
                            <th class="text-center">Porcentaje</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($topMaterias as $index => $materia)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <span class="badge-materia">
                                    <i class="fas fa-book-open"></i> {{ $materia->materia_nombre ?? $materia['materia_nombre'] }}
                                </span>
                            </td>
                            <td class="text-center fw-bold">{{ $materia->total_clases ?? $materia['total_clases'] }}</td>
                            <td class="text-center">
                                @php
                                    $totalClases = collect($topMaterias)->sum('total_clases');
                                    $porcentaje = $totalClases > 0 ? (($materia->total_clases ?? $materia['total_clases']) / $totalClases) * 100 : 0;
                                @endphp
                                {{ number_format($porcentaje, 1) }}%
                                <div class="progress" style="margin-top: 5px;">
                                    <div class="progress-bar" style="width: {{ $porcentaje }}%"></div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif

        <!-- SECCIÓN 7: NIVEL ACADÉMICO -->
        <div class="section">
            <div class="section-header">
                <div class="section-title">
                    <i class="fas fa-graduation-cap"></i>
                    <span>Nivel Académico</span>
                </div>
            </div>
            <div class="cards-grid">
                <div class="stat-card success">
                    <div class="stat-number text-success">{{ $licenciatura ?? 0 }}</div>
                    <div class="stat-label">Licenciatura</div>
                    @if(($totalMaestros ?? 0) > 0)
                        <div class="stat-percentage">{{ number_format((($licenciatura ?? 0) / ($totalMaestros ?? 1)) * 100, 1) }}%</div>
                    @endif
                </div>
                
                <div class="stat-card warning">
                    <div class="stat-number text-warning">{{ $maestria ?? 0 }}</div>
                    <div class="stat-label">Maestría</div>
                    @if(($totalMaestros ?? 0) > 0)
                        <div class="stat-percentage">{{ number_format((($maestria ?? 0) / ($totalMaestros ?? 1)) * 100, 1) }}%</div>
                    @endif
                </div>
                
                <div class="stat-card danger">
                    <div class="stat-number text-danger">{{ $doctorado ?? 0 }}</div>
                    <div class="stat-label">Doctorado</div>
                    @if(($totalMaestros ?? 0) > 0)
                        <div class="stat-percentage">{{ number_format((($doctorado ?? 0) / ($totalMaestros ?? 1)) * 100, 1) }}%</div>
                    @endif
                </div>
                
                @if(isset($especialidad) && $especialidad > 0)
                <div class="stat-card info">
                    <div class="stat-number text-info">{{ $especialidad }}</div>
                    <div class="stat-label">Especialidad</div>
                    <div class="stat-percentage">{{ number_format(($especialidad / ($totalMaestros ?? 1)) * 100, 1) }}%</div>
                </div>
                @endif
            </div>
        </div>

        <!-- SECCIÓN 8: ESTADO DE ACTIVIDAD -->
        <div class="section">
            <div class="section-header">
                <div class="section-title">
                    <i class="fas fa-user-check"></i>
                    <span>Estado de Actividad</span>
                </div>
            </div>
            <div class="cards-grid">
                <div class="stat-card success">
                    <div class="stat-number text-success">{{ $maestrosActivos ?? 0 }}</div>
                    <div class="stat-label">Activos</div>
                    @if(($totalMaestros ?? 0) > 0)
                        <div class="stat-percentage">{{ number_format((($maestrosActivos ?? 0) / ($totalMaestros ?? 1)) * 100, 1) }}%</div>
                    @endif
                </div>
                <div class="stat-card danger">
                    <div class="stat-number text-danger">{{ $maestrosInactivos ?? 0 }}</div>
                    <div class="stat-label">Inactivos</div>
                    @if(($totalMaestros ?? 0) > 0)
                        <div class="stat-percentage">{{ number_format((($maestrosInactivos ?? 0) / ($totalMaestros ?? 1)) * 100, 1) }}%</div>
                    @endif
                </div>
            </div>
        </div>

        <!-- BOTONES DE EXPORTACIÓN -->
        <div class="export-buttons">
            <a href="{{ route('coordinacion.dashboard') }}" class="btn-back">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
            <button class="btn-export pdf" id="exportPdf">
                <i class="fas fa-file-pdf"></i> Exportar PDF
            </button>
            <button class="btn-export excel" id="exportExcel">
                <i class="fas fa-file-excel"></i> Exportar Excel
            </button>
        </div>
    </div>
</div>

<!-- OVERLAY DE CARGA -->
<div class="export-loading" id="exportLoading">
    <div class="spinner"></div>
    <p class="loading-text" id="loadingText">Generando reporte, por favor espere...</p>
</div>

<script>
    // Control del menú hamburguesa
    const hamburgerBtn = document.getElementById('hamburgerBtn');
    const mobileMenu = document.getElementById('mobileMenu');
    
    function toggleMenu() {
        mobileMenu.classList.toggle('open');
        const icon = hamburgerBtn.querySelector('i');
        if (mobileMenu.classList.contains('open')) {
            icon.classList.remove('fa-bars');
            icon.classList.add('fa-times');
        } else {
            icon.classList.remove('fa-times');
            icon.classList.add('fa-bars');
        }
    }
    
    function closeMenu() {
        mobileMenu.classList.remove('open');
        const icon = hamburgerBtn.querySelector('i');
        icon.classList.remove('fa-times');
        icon.classList.add('fa-bars');
    }
    
    if (hamburgerBtn) {
        hamburgerBtn.addEventListener('click', toggleMenu);
    }
    
    const mobileLinks = document.querySelectorAll('.mobile-nav-link');
    mobileLinks.forEach(link => {
        link.addEventListener('click', closeMenu);
    });
    
    window.addEventListener('resize', () => {
        if (window.innerWidth > 768 && mobileMenu.classList.contains('open')) {
            closeMenu();
        }
    });
    
    document.addEventListener('DOMContentLoaded', function() {
        // Datos desde PHP
        const totalMaestros = {{ $totalMaestros ?? 0 }};
        
        const horariosData = {
            conHorario: {{ $conHorario ?? 0 }},
            sinHorario: {{ $sinHorario ?? 0 }}
        };
        
        const distribucionHorasData = {
            rango1: {{ $distribucionHoras['0-5'] ?? 0 }},
            rango2: {{ $distribucionHoras['6-10'] ?? 0 }},
            rango3: {{ $distribucionHoras['11-15'] ?? 0 }},
            rango4: {{ $distribucionHoras['16-20'] ?? 0 }},
            rango5: {{ $distribucionHoras['21-25'] ?? 0 }},
            rango6: {{ $distribucionHoras['26+'] ?? 0 }}
        };
        
        const genderData = {
            hombres: {{ $hombres ?? 0 }},
            mujeres: {{ $mujeres ?? 0 }},
            otros: {{ $otros ?? 0 }},
            sinSexo: {{ $sinSexo ?? 0 }}
        };
        
        const activityData = {
            activos: {{ $maestrosActivos ?? 0 }},
            inactivos: {{ $maestrosInactivos ?? 0 }}
        };
        
        // Gráfica 1: Estado de Horarios
        const horariosCtx = document.getElementById('horariosChart').getContext('2d');
        new Chart(horariosCtx, {
            type: 'doughnut',
            data: {
                labels: ['Con Horario', 'Sin Horario'],
                datasets: [{
                    data: [horariosData.conHorario, horariosData.sinHorario],
                    backgroundColor: ['#10b981', '#ef4444'],
                    borderWidth: 2,
                    borderColor: '#fff',
                    hoverOffset: 15
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'bottom' },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const total = horariosData.conHorario + horariosData.sinHorario;
                                const percentage = total > 0 ? ((context.parsed / total) * 100).toFixed(1) : 0;
                                return `${context.label}: ${context.parsed} (${percentage}%)`;
                            }
                        }
                    }
                }
            }
        });
        
        // Gráfica 2: Distribución de Horas
        const horasCtx = document.getElementById('horasChart').getContext('2d');
        new Chart(horasCtx, {
            type: 'bar',
            data: {
                labels: ['0-5 h', '6-10 h', '11-15 h', '16-20 h', '21-25 h', '26+ h'],
                datasets: [{
                    label: 'Cantidad de Maestros',
                    data: [
                        distribucionHorasData.rango1,
                        distribucionHorasData.rango2,
                        distribucionHorasData.rango3,
                        distribucionHorasData.rango4,
                        distribucionHorasData.rango5,
                        distribucionHorasData.rango6
                    ],
                    backgroundColor: ['#3b82f6', '#10b981', '#f59e0b', '#f97316', '#ef4444', '#8b5cf6'],
                    borderWidth: 1,
                    borderRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: { beginAtZero: true, ticks: { stepSize: 1 } }
                },
                plugins: { legend: { display: false } }
            }
        });
        
        // Gráfica 3: Género
        const genderCtx = document.getElementById('genderChart').getContext('2d');
        let genderLabels = ['Hombres', 'Mujeres'];
        let genderDataset = [genderData.hombres, genderData.mujeres];
        let genderColors = ['#3b82f6', '#ec4899'];
        
        if (genderData.otros > 0) {
            genderLabels.push('Otro');
            genderDataset.push(genderData.otros);
            genderColors.push('#8b5cf6');
        }
        
        if (genderData.sinSexo > 0) {
            genderLabels.push('Sin especificar');
            genderDataset.push(genderData.sinSexo);
            genderColors.push('#f59e0b');
        }
        
        new Chart(genderCtx, {
            type: 'pie',
            data: {
                labels: genderLabels,
                datasets: [{
                    data: genderDataset,
                    backgroundColor: genderColors,
                    borderWidth: 2,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'bottom' },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const total = genderDataset.reduce((a, b) => a + b, 0);
                                const percentage = total > 0 ? ((context.parsed / total) * 100).toFixed(1) : 0;
                                return `${context.label}: ${context.parsed} (${percentage}%)`;
                            }
                        }
                    }
                }
            }
        });
        
        // Gráfica 4: Actividad
        const activityCtx = document.getElementById('activityChart').getContext('2d');
        new Chart(activityCtx, {
            type: 'bar',
            data: {
                labels: ['Activos', 'Inactivos'],
                datasets: [{
                    data: [activityData.activos, activityData.inactivos],
                    backgroundColor: ['#10b981', '#ef4444'],
                    borderWidth: 1,
                    borderRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: { beginAtZero: true, ticks: { stepSize: 1 } }
                },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const total = activityData.activos + activityData.inactivos;
                                const percentage = total > 0 ? ((context.parsed / total) * 100).toFixed(1) : 0;
                                return `${context.label}: ${context.parsed} (${percentage}%)`;
                            }
                        }
                    }
                }
            }
        });
        
        // Exportar PDF
        document.getElementById('exportPdf').addEventListener('click', function() {
            const loadingDiv = document.getElementById('exportLoading');
            loadingDiv.classList.add('show');
            
            setTimeout(() => {
                alert('Función de exportación a PDF - En desarrollo');
                loadingDiv.classList.remove('show');
            }, 1500);
        });
        
        // Exportar Excel
        document.getElementById('exportExcel').addEventListener('click', function() {
            const loadingDiv = document.getElementById('exportLoading');
            loadingDiv.classList.add('show');
            
            setTimeout(() => {
                alert('Función de exportación a Excel - En desarrollo');
                loadingDiv.classList.remove('show');
            }, 1500);
        });
    });
</script>
</body>
</html>