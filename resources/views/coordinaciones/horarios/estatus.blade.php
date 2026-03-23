<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes, viewport-fit=cover">
    <title>Estadísticas de Horarios - Coordinación | GEPROC GP</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- jsPDF -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <!-- SheetJS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <!-- jQuery para DataTables (opcional) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        :root {
            --primary: #0744b6ff;
            --primary-dark: #0a3a9e;
            --primary-light: #2a5cd4;
            --secondary: #33CAE6;
            --accent: #28a745;
            --dark-primary: #052e7a;
            --light-primary: rgba(7, 68, 182, 0.08);
            --light-bg: #F8F9FA;
            --border-color: #E9ECEF;
            --text-muted: #6C757D;
            --card-shadow: 0 5px 15px rgba(7, 68, 182, 0.08);
            --shadow-sm: 0 2px 8px rgba(26, 76, 186, 0.05);
            --shadow-md: 0 4px 12px rgba(26, 76, 186, 0.08);
            --shadow-lg: 0 8px 24px rgba(26, 76, 186, 0.12);
            --gradient-primary: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            --transition: all 0.3s ease;
            --success-color: #28a745;
            --warning-color: #FFC107;
            --danger-color: #dc3545;
            --info-color: #17a2b8;
            --purple-color: #6f42c1;
            --orange-color: #fd7e14;
            --pink-color: #e83e8c;
        }
        
        body { 
            background: #f5f7fa;
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            color: #333; 
            line-height: 1.6;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            overflow-x: hidden;
        }
        
        /* Top Bar Superior */
        .top-bar {
            background: white;
            height: 70px;
            border-bottom: 2px solid #e0e7ef;
            display: flex;
            align-items: center;
            padding: 0 40px;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1001;
            box-shadow: 0 2px 10px rgba(0,0,0,0.03);
        }

        .top-bar-content {
            max-width: 1400px;
            margin: 0 auto;
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-logo {
            display: flex;
            align-items: center;
            padding: 0;
            background: transparent;
            border-radius: 0;
            box-shadow: none;
            border: none;
        }

        .logo-img-header {
            width: 80px;
            height: 80px;
            object-fit: contain;
            margin-right: 12px;
        }

        .header-logo span {
            color: var(--primary);
            font-weight: 700;
            font-size: 1.3rem;
            letter-spacing: 0.5px;
        }

        .top-bar-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .top-bar-divider {
            width: 1px;
            height: 30px;
            background: #e0e7ef;
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            background: var(--light-primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-weight: 600;
            font-size: 1rem;
            border: 2px solid white;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .top-bar-item {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--text-muted);
            font-size: 0.9rem;
            padding: 5px 10px;
            border-radius: 30px;
            transition: all 0.2s ease;
        }

        /* Top Navigation - Versión Hamburguesa */
        .top-nav {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            position: fixed;
            top: 70px;
            left: 0;
            right: 0;
            z-index: 1000;
            box-shadow: 0 4px 20px rgba(26, 76, 186, 0.25);
        }

        .nav-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 40px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 70px;
        }

        .nav-left {
            display: flex;
            align-items: center;
            gap: 30px;
        }

        /* Botón Hamburguesa */
        .hamburger-btn {
            background: rgba(255, 255, 255, 0.15);
            border: none;
            width: 45px;
            height: 45px;
            border-radius: 10px;
            color: white;
            font-size: 1.3rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: none;
            align-items: center;
            justify-content: center;
        }

        .hamburger-btn:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: scale(1.05);
        }

        .divider-white {
            width: 2px;
            height: 40px;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 2px;
        }

        /* Menú Desktop */
        .nav-menu {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 24px;
            color: rgba(255, 255, 255, 0.85);
            text-decoration: none;
            border-radius: 10px;
            transition: all 0.2s ease;
            font-weight: 500;
            font-size: 1rem;
            position: relative;
        }

        .nav-item i {
            font-size: 1.1rem;
        }

        .nav-item:hover {
            background: rgba(255, 255, 255, 0.15);
            color: white;
            transform: translateY(-2px);
        }

        .nav-item.active {
            color: white;
            background: rgba(255, 255, 255, 0.12);
            font-weight: 600;
        }

        .nav-item.active::after {
            content: '';
            position: absolute;
            bottom: -18px;
            left: 0;
            width: 100%;
            height: 3px;
            background: white;
            border-radius: 3px 3px 0 0;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        /* Menú Móvil Desplegable */
        .mobile-nav-menu {
            position: fixed;
            top: 140px;
            left: 0;
            right: 0;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            z-index: 999;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.4s ease-out;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        .mobile-nav-menu.open {
            max-height: 400px;
            overflow-y: auto;
        }

        .mobile-nav-items {
            padding: 15px 20px;
        }

        .mobile-nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 20px;
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            border-radius: 12px;
            transition: all 0.2s ease;
            font-weight: 500;
            font-size: 1rem;
            margin-bottom: 8px;
        }

        .mobile-nav-item i {
            font-size: 1.2rem;
            width: 24px;
        }

        .mobile-nav-item:hover {
            background: rgba(255, 255, 255, 0.15);
            color: white;
            transform: translateX(5px);
        }

        .mobile-nav-item.active {
            color: white;
            background: rgba(255, 255, 255, 0.2);
            font-weight: 600;
        }

        /* Overlay para cerrar menú */
        .menu-overlay {
            position: fixed;
            top: 140px;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 998;
            display: none;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .menu-overlay.active {
            display: block;
            opacity: 1;
        }

        .nav-right {
            display: flex;
            align-items: center;
        }

        .logout-btn {
            background: rgba(255, 255, 255, 0.15);
            border: none;
            padding: 10px 20px;
            border-radius: 30px;
            color: white;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.95rem;
            font-weight: 500;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .logout-btn i {
            font-size: 1rem;
        }

        .logout-btn:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: translateY(-2px);
            border-color: rgba(255, 255, 255, 0.3);
        }

        /* Main Content */
        .main-content {
            margin-top: 140px;
            padding: 30px 40px;
            min-height: calc(100vh - 140px);
        }

        .content-container {
            max-width: 1400px;
            margin: 0 auto;
        }

        /* Header mejorado */
        .main-header {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            border-radius: 16px;
            padding: 24px 30px;
            margin-bottom: 25px;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .main-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 6px;
            height: 100%;
            background: var(--gradient-primary);
            border-radius: 6px 0 0 6px;
        }

        .header-left h2 {
            font-size: 1.8rem;
            color: var(--text-dark);
            font-weight: 700;
            margin-bottom: 8px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .header-left p {
            color: var(--text-muted);
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .header-left p i {
            color: var(--primary);
            font-size: 1.1rem;
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
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 15px;
        }
        
        .stats-grid-3 {
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
        .stat-card.purple { border-top-color: var(--purple-color); }
        .stat-card.orange { border-top-color: var(--orange-color); }
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
            grid-template-columns: repeat(auto-fit, minmax(450px, 1fr));
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
            height: 280px;
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
            flex-wrap: wrap;
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
        
        /* Tabla de materias */
        .materias-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .materias-table th {
            background: rgba(7, 68, 182, 0.05);
            padding: 10px;
            font-weight: 600;
            color: var(--primary);
            border-bottom: 2px solid var(--border-color);
        }
        
        .materias-table td {
            padding: 8px 10px;
            border-bottom: 1px solid var(--border-color);
        }
        
        .materias-table tr:last-child td {
            border-bottom: none;
        }
        
        .materias-table tr:hover {
            background: rgba(0,0,0,0.02);
        }
        
        .badge-materia {
            background: var(--primary);
            color: white;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
        }
        
        .badge-materia i {
            margin-right: 5px;
        }
        
        /* Selector de período */
        .periodo-selector {
            background: white;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid var(--border-color);
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }
        
        .periodo-activo {
            background: rgba(40, 167, 69, 0.1);
            border-left: 3px solid var(--success-color);
            padding: 10px 15px;
            border-radius: 8px;
            margin-top: 10px;
        }
        
        /* Info note */
        .info-note {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            border-left: 4px solid var(--primary);
            border-radius: 8px;
            padding: 16px 20px;
            margin-bottom: 20px;
            display: flex;
            align-items: flex-start;
            gap: 12px;
            border: 1px solid var(--border-color);
            box-shadow: var(--shadow-sm);
        }

        .info-note i {
            font-size: 1.4rem;
            color: var(--primary);
            margin-top: 2px;
        }

        .info-note-content {
            flex: 1;
        }

        .info-note-title {
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 4px;
            font-size: 0.95rem;
        }

        .info-note-text {
            color: var(--text-muted);
            font-size: 0.9rem;
            line-height: 1.5;
        }

        .info-note-text strong {
            color: var(--primary);
            font-weight: 600;
        }
        
        /* Responsive */
        @media (max-width: 1200px) {
            .charts-container {
                grid-template-columns: 1fr;
            }
        }
        
        @media (max-width: 992px) {
            .stats-grid, .stats-grid-3 {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .main-content {
                padding: 20px 15px;
            }
        }
        
        @media (max-width: 768px) {
            /* Ocultar menú desktop y mostrar hamburguesa */
            .nav-menu {
                display: none;
            }
            
            .hamburger-btn {
                display: flex;
            }
            
            .divider-white {
                display: none;
            }
            
            .stats-grid, .stats-grid-3 {
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
            
            .top-bar {
                padding: 0 20px;
                height: 60px;
            }
            
            .top-nav {
                top: 60px;
            }
            
            .nav-container {
                height: 60px;
                padding: 0 20px;
            }
            
            .main-content {
                margin-top: 130px;
                padding: 20px;
            }
            
            .mobile-nav-menu {
                top: 130px;
            }
            
            .menu-overlay {
                top: 130px;
            }
            
            .top-bar-right {
                gap: 10px;
            }
            
            .logo-img-header {
                width: 60px;
                height: 60px;
            }
            
            .header-logo span {
                font-size: 1rem;
            }
            
            .main-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
            
            .periodo-selector .row {
                flex-direction: column;
                gap: 15px;
            }
        }
        
        @media (max-width: 576px) {
            .age-grid {
                grid-template-columns: 1fr;
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
            .top-bar, 
            .top-nav, 
            .mobile-nav-menu,
            .menu-overlay,
            .hamburger-btn,
            .export-buttons,
            .logout-btn,
            .info-note {
                display: none !important;
            }
            
            .main-content {
                padding: 0;
                margin: 0;
                margin-top: 20px;
                min-height: auto;
            }
            
            .main-header {
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
    @php
        use Illuminate\Support\Facades\Auth;
        use App\Models\Coordinacion;
        use Carbon\Carbon;
        
        $user = Auth::user();
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
    @endphp

    <!-- Top Bar Superior -->
    <div class="top-bar">
        <div class="top-bar-content">
            <div class="header-logo">
                <img src="{{ asset('img/logo_iufim.png') }}" alt="Logo IUFIM" class="logo-img-header">
                <span></span>
            </div>
            
            <div class="top-bar-right">
                <div class="top-bar-divider"></div>
                <div class="user-avatar">
                    {{ $userInitials }}
                </div>
            </div>
        </div>
    </div>

    <!-- Top Navigation con menú hamburguesa -->
    <nav class="top-nav">
        <div class="nav-container">
            <div class="nav-left">
                <!-- Botón Hamburguesa -->
                <button class="hamburger-btn" id="hamburgerBtn">
                    <i class="fas fa-bars"></i>
                </button>
                
                <!-- Menú Desktop (visible en escritorio) -->
                <div class="nav-menu">
                    <a href="{{ route('coordinacion.dashboard') }}" class="nav-item">
                        <i class="fas fa-home"></i>
                        <span>Inicio</span>
                    </a>
                    <a href="{{ route('coordinaciones.maestros-detalle') }}" class="nav-item">
                        <i class="fas fa-users"></i>
                        <span>Maestros</span>
                    </a>
                    <a href="{{ route('coordinaciones.maestros') }}" class="nav-item">
                        <i class="fas fa-file-alt"></i>
                        <span>Documentos</span>
                    </a>
                    <a href="{{ route('coordinaciones.estatus') }}" class="nav-item active">
                        <i class="fas fa-chart-bar"></i>
                        <span>Estadísticas</span>
                    </a>
                    @if(isset($coordinacionId) && $coordinacionId)
                    <a href="{{ route('coordinaciones.show', $coordinacionId) }}" class="nav-item">
                        <i class="fas fa-building"></i>
                        <span>Mi Coordinación</span>
                    </a>
                    @endif
                </div>
            </div>
            
            <div class="nav-right">                
                <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Cerrar sesión</span>
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Menú Móvil Desplegable -->
    <div class="mobile-nav-menu" id="mobileMenu">
        <div class="mobile-nav-items">
            <a href="{{ route('coordinacion.dashboard') }}" class="mobile-nav-item">
                <i class="fas fa-home"></i>
                <span>Inicio</span>
            </a>
            <a href="{{ route('coordinaciones.maestros-detalle') }}" class="mobile-nav-item">
                <i class="fas fa-users"></i>
                <span>Maestros</span>
            </a>
            <a href="{{ route('coordinaciones.maestros') }}" class="mobile-nav-item">
                <i class="fas fa-file-alt"></i>
                <span>Documentos</span>
            </a>
            <a href="{{ route('coordinaciones.estatus') }}" class="mobile-nav-item active">
                <i class="fas fa-chart-bar"></i>
                <span>Estadísticas</span>
            </a>
            @if(isset($coordinacionId) && $coordinacionId)
            <a href="{{ route('coordinaciones.show', $coordinacionId) }}" class="mobile-nav-item">
                <i class="fas fa-building"></i>
                <span>Mi Coordinación</span>
            </a>
            @endif
        </div>
    </div>

    <!-- Overlay para cerrar menú -->
    <div class="menu-overlay" id="menuOverlay"></div>

    <!-- Overlay de carga para exportación -->
    <div class="export-loading" id="exportLoading">
        <div class="spinner-border text-light" role="status">
            <span class="visually-hidden">Generando PDF...</span>
        </div>
        <p class="loading-text" id="loadingText">Generando reporte, por favor espere...</p>
    </div>

    <!-- Main Content -->
    <main class="main-content">
        <div class="content-container">
            <!-- HEADER -->
            <div class="main-header">
                <div class="header-left">
                    <h2>Estadísticas de Horarios</h2>
                    <p><i class="fas fa-chart-pie"></i> {{ $coordinacionNombre }}</p>
                </div>
                <div class="header-right">
                    @if(isset($periodoSeleccionado) && $periodoSeleccionado)
                        <span class="badge bg-{{ ($periodoSeleccionado->activo ?? false) ? 'success' : (($periodoSeleccionado->subida_habilitada ?? false) ? 'info' : 'secondary') }} fs-6 p-2 px-3">
                            <i class="fas fa-calendar-alt me-1"></i>
                            {{ $periodoSeleccionado->nombre ?? 'Período' }}
                            @if($periodoSeleccionado->activo ?? false)
                                (Activo)
                            @elseif($periodoSeleccionado->subida_habilitada ?? false)
                                (Subida Habilitada)
                            @endif
                        </span>
                    @endif
                </div>
            </div>

            <!-- Selector de período (informativo) -->
            @if(isset($periodoSeleccionado) && $periodoSeleccionado)
            <div class="periodo-selector">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h5><i class="fas fa-calendar-check text-primary me-2"></i> Período analizado:</h5>
                        <strong>{{ $periodoSeleccionado->nombre }}</strong>
                        <div class="text-muted small">
                            {{ \Carbon\Carbon::parse($periodoSeleccionado->fecha_inicio)->format('d/m/Y') }} - 
                            {{ \Carbon\Carbon::parse($periodoSeleccionado->fecha_fin)->format('d/m/Y') }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="periodo-activo">
                            <i class="fas fa-info-circle me-2 text-info"></i>
                            @if($periodoSeleccionado->activo ?? false)
                                <span class="text-success fw-bold">Período activo actualmente</span>
                            @elseif($periodoSeleccionado->subida_habilitada ?? false)
                                <span class="text-info fw-bold">Período con subida de documentos habilitada</span>
                            @else
                                <span class="text-secondary fw-bold">Período inactivo (solo consulta)</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- NOTA INFORMATIVA SOBRE LAS ESTADÍSTICAS -->
            <div class="info-note">
                <i class="fas fa-chart-line"></i>
                <div class="info-note-content">
                    <div class="info-note-title">Acerca de las estadísticas</div>
                    <div class="info-note-text">
                        Los datos mostrados corresponden al período <strong>{{ $periodoSeleccionado->nombre ?? 'seleccionado' }}</strong>. 
                        Se incluye información de <strong>{{ $totalMaestros }} maestros</strong> de tu coordinación.
                    </div>
                </div>
            </div>

            <!-- Sección 1: Resumen General de Maestros -->
            <div class="stats-section">
                <h3 class="section-title">
                    <i class="fas fa-chart-bar"></i> Resumen General de Maestros
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
                    
                    <!-- NUEVO: Otros géneros -->
                    @if(isset($otros) && $otros > 0)
                    <div class="stat-card purple">
                        <div class="stat-number text-purple">{{ $otros }}</div>
                        <div class="stat-label">Otro</div>
                        @if($totalMaestros > 0)
                            <div class="stat-percentage">{{ number_format(($otros / $totalMaestros) * 100, 1) }}%</div>
                        @endif
                    </div>
                    @endif
                    
                    <!-- NUEVO: Sin género -->
                    @if(isset($sinSexo) && $sinSexo > 0)
                    <div class="stat-card warning">
                        <div class="stat-number text-warning">{{ $sinSexo }}</div>
                        <div class="stat-label">Sin especificar</div>
                        @if($totalMaestros > 0)
                            <div class="stat-percentage">{{ number_format(($sinSexo / $totalMaestros) * 100, 1) }}%</div>
                        @endif
                    </div>
                    @endif
                    
                    <div class="stat-card info">
                        <div class="stat-number text-info">{{ $maestrosActivos }}</div>
                        <div class="stat-label">Maestros Activos</div>
                        @if($totalMaestros > 0)
                            <div class="stat-percentage">{{ number_format(($maestrosActivos / $totalMaestros) * 100, 1) }}%</div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Sección 2: Estado de Horarios -->
            <div class="stats-section">
                <h3 class="section-title">
                    <i class="fas fa-clock"></i> Estado de Horarios
                </h3>
                <div class="stats-grid-3">
                    <div class="stat-card success">
                        <div class="stat-number text-success">{{ $conHorario }}</div>
                        <div class="stat-label">Con Horario Asignado</div>
                        @if($totalMaestros > 0)
                            <div class="stat-percentage">{{ number_format(($conHorario / $totalMaestros) * 100, 1) }}%</div>
                        @endif
                    </div>
                    
                    <div class="stat-card warning">
                        <div class="stat-number text-warning">{{ $sinHorario }}</div>
                        <div class="stat-label">Sin Horario</div>
                        @if($totalMaestros > 0)
                            <div class="stat-percentage">{{ number_format(($sinHorario / $totalMaestros) * 100, 1) }}%</div>
                        @endif
                    </div>
                    
                    <div class="stat-card info">
                        <div class="stat-number text-info">{{ $conFoto }}</div>
                        <div class="stat-label">Con Foto de Horario</div>
                        @if($totalMaestros > 0)
                            <div class="stat-percentage">{{ number_format(($conFoto / $totalMaestros) * 100, 1) }}%</div>
                        @endif
                    </div>
                </div>
                
                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="alert alert-success d-flex align-items-center">
                            <i class="fas fa-check-circle me-3 fs-3"></i>
                            <div>
                                <strong>{{ $conHorarioYFoto }} maestros</strong> tienen horario completo con foto<br>
                                <small class="text-muted">Horario asignado y foto subida</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="alert alert-warning d-flex align-items-center">
                            <i class="fas fa-exclamation-triangle me-3 fs-3"></i>
                            <div>
                                <strong>{{ $conHorarioSinFoto }} maestros</strong> tienen horario sin foto<br>
                                <small class="text-muted">Horario asignado pero falta foto</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sección 3: Gráficas Principales -->
            <div class="stats-section">
                <h3 class="section-title">
                    <i class="fas fa-chart-pie"></i> Distribuciones
                </h3>
                <div class="charts-container">
                    <!-- Gráfica de Estado de Horarios -->
                    <div class="chart-wrapper">
                        <h4 class="chart-title">Estado de Horarios</h4>
                        <div class="chart-container">
                            <canvas id="horariosChart"></canvas>
                        </div>
                    </div>
                    
                    <!-- Gráfica de Horas por Maestro -->
                    <div class="chart-wrapper">
                        <h4 class="chart-title">Distribución de Horas Clase</h4>
                        <div class="chart-container">
                            <canvas id="horasChart"></canvas>
                        </div>
                    </div>
                    
                    <!-- Gráfica de Género -->
                    <div class="chart-wrapper">
                        <h4 class="chart-title">Distribución por Género</h4>
                        <div class="chart-container">
                            <canvas id="genderChart"></canvas>
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

            <!-- Sección 4: Distribución por Edad -->
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

            <!-- Sección 5: Estadísticas de Horas -->
            <div class="stats-section">
                <h3 class="section-title">
                    <i class="fas fa-hourglass-half"></i> Estadísticas de Horas Clase
                </h3>
                <div class="row">
                    <div class="col-md-4">
                        <div class="stat-card info">
                            <div class="stat-number text-info">{{ $totalHorasAsignadas }}</div>
                            <div class="stat-label">Total Horas Asignadas</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card success">
                            <div class="stat-number text-success">{{ $conHorario > 0 ? round($totalHorasAsignadas / $conHorario, 1) : 0 }}</div>
                            <div class="stat-label">Promedio Horas/Maestro</div>
                            <div class="small text-muted">(solo maestros con horario)</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card warning">
                            <div class="stat-number text-warning">{{ $promedioHoras }}</div>
                            <div class="stat-label">Promedio General</div>
                            <div class="small text-muted">(todos los maestros)</div>
                        </div>
                    </div>
                </div>
                
                <h5 class="mt-4 mb-3">Distribución de Horas por Maestro</h5>
                <div class="row">
                    @foreach($distribucionHoras as $rango => $cantidad)
                    <div class="col-md-4 col-lg-2 mb-3">
                        <div class="card text-center h-100">
                            <div class="card-body p-2">
                                <h3 class="text-primary mb-0">{{ $cantidad }}</h3>
                                <small class="text-muted">{{ $rango }} horas</small>
                                @if($totalMaestros > 0)
                                    <div class="progress mt-2" style="height: 5px;">
                                        <div class="progress-bar bg-primary" style="width: {{ ($cantidad / $totalMaestros) * 100 }}%"></div>
                                    </div>
                                    <small>{{ number_format(($cantidad / $totalMaestros) * 100, 1) }}%</small>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Sección 6: Top Materias -->
            @if(isset($topMaterias) && count($topMaterias) > 0)
            <div class="stats-section">
                <h3 class="section-title">
                    <i class="fas fa-book"></i> Top 5 Materias Más Impartidas
                </h3>
                <div class="row">
                    <div class="col-md-8 mx-auto">
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
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif

            <!-- Sección 7: Nivel Académico -->
            <div class="stats-section">
                <h3 class="section-title">
                    <i class="fas fa-graduation-cap"></i> Nivel Académico
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

            <!-- Sección 8: Actividad -->
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

            <!-- Botones de exportación -->
            <div class="export-buttons">
                <a href="{{ route('coordinacion.dashboard') }}" class="btn btn-warning">
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
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Control del menú hamburguesa
        const hamburgerBtn = document.getElementById('hamburgerBtn');
        const mobileMenu = document.getElementById('mobileMenu');
        const menuOverlay = document.getElementById('menuOverlay');
        
        function toggleMenu() {
            mobileMenu.classList.toggle('open');
            menuOverlay.classList.toggle('active');
            
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
            menuOverlay.classList.remove('active');
            const icon = hamburgerBtn.querySelector('i');
            icon.classList.remove('fa-times');
            icon.classList.add('fa-bars');
        }
        
        if (hamburgerBtn) {
            hamburgerBtn.addEventListener('click', toggleMenu);
        }
        
        if (menuOverlay) {
            menuOverlay.addEventListener('click', closeMenu);
        }
        
        // Cerrar menú al hacer click en un enlace
        const mobileLinks = document.querySelectorAll('.mobile-nav-item');
        mobileLinks.forEach(link => {
            link.addEventListener('click', closeMenu);
        });
        
        // Cerrar menú al redimensionar a escritorio
        window.addEventListener('resize', () => {
            if (window.innerWidth > 768 && mobileMenu.classList.contains('open')) {
                closeMenu();
            }
        });
        
        // Fecha actual
        function updateDate() {
            const dateElement = document.getElementById('currentDate');
            if (dateElement) {
                const today = new Date();
                const options = { day: 'numeric', month: 'short', year: 'numeric' };
                dateElement.textContent = today.toLocaleDateString('es-ES', options);
            }
        }
        
        document.addEventListener('DOMContentLoaded', function() {
            updateDate();
            console.log('Cargando gráficas de horarios...');
            
            // Datos desde PHP
            const totalMaestros = {{ $totalMaestros }};
            
            // Datos de horarios
            const horariosData = {
                conHorario: {{ $conHorario }},
                sinHorario: {{ $sinHorario }},
                conFoto: {{ $conFoto }},
                sinFoto: {{ $sinFoto }}
            };

            // Datos de distribución de horas
            const distribucionHorasData = {
                rango1: {{ $distribucionHoras['0-5'] ?? 0 }},
                rango2: {{ $distribucionHoras['6-10'] ?? 0 }},
                rango3: {{ $distribucionHoras['11-15'] ?? 0 }},
                rango4: {{ $distribucionHoras['16-20'] ?? 0 }},
                rango5: {{ $distribucionHoras['21-25'] ?? 0 }},
                rango6: {{ $distribucionHoras['26+'] ?? 0 }}
            };

            // Datos de género
            const genderData = {
                hombres: {{ $hombres }},
                mujeres: {{ $mujeres }},
                otros: {{ $otros ?? 0 }},
                sinSexo: {{ $sinSexo ?? 0 }}
            };

            // Datos de actividad
            const activityData = {
                activos: {{ $maestrosActivos }},
                inactivos: {{ $maestrosInactivos }}
            };

            // Gráfica 1: Estado de Horarios
            const horariosCtx = document.getElementById('horariosChart').getContext('2d');
            new Chart(horariosCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Con Horario', 'Sin Horario'],
                    datasets: [{
                        data: [horariosData.conHorario, horariosData.sinHorario],
                        backgroundColor: ['#28a745', '#dc3545'],
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
                        backgroundColor: [
                            '#17a2b8',
                            '#28a745',
                            '#ffc107',
                            '#fd7e14',
                            '#dc3545',
                            '#6f42c1'
                        ],
                        borderWidth: 1,
                        borderRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: { stepSize: 1 }
                        }
                    },
                    plugins: {
                        legend: { display: false }
                    }
                }
            });

            // Gráfica 3: Género
            const genderCtx = document.getElementById('genderChart').getContext('2d');
            
            let genderLabels = ['Hombres', 'Mujeres'];
            let genderDataset = [genderData.hombres, genderData.mujeres];
            let genderColors = ['#007bff', '#e83e8c'];
            
            if (genderData.otros > 0) {
                genderLabels.push('Otro');
                genderDataset.push(genderData.otros);
                genderColors.push('#6f42c1');
            }
            
            if (genderData.sinSexo > 0) {
                genderLabels.push('Sin especificar');
                genderDataset.push(genderData.sinSexo);
                genderColors.push('#ffc107');
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
                        backgroundColor: ['#28a745', '#dc3545'],
                        borderWidth: 1,
                        borderRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: { stepSize: 1 }
                        }
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

            // Función para exportar a PDF
            document.getElementById('exportPdf').addEventListener('click', function(e) {
                e.preventDefault();
                const loadingDiv = document.getElementById('exportLoading');
                loadingDiv.classList.add('show');
                
                setTimeout(() => {
                    alert('Función de exportación a PDF - En desarrollo');
                    loadingDiv.classList.remove('show');
                }, 1500);
            });

            // Función para exportar a Excel
            document.getElementById('exportExcel').addEventListener('click', function(e) {
                e.preventDefault();
                const loadingDiv = document.getElementById('exportLoading');
                loadingDiv.classList.add('show');
                
                setTimeout(() => {
                    alert('Función de exportación a Excel - En desarrollo');
                    loadingDiv.classList.remove('show');
                }, 1500);
            });

            console.log('Todas las gráficas cargadas correctamente');
        });
    </script>
</body>
</html>