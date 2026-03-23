<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
    <title>Dashboard Profesor - Sistema GEPROC</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
            --purple-color: #8b5cf6;
            --purple-light: #ede9fe;
            --cyan-color: #06b6d4;
            --cyan-light: #cffafe;
            --border-radius: 12px;
            --gradient-primary: linear-gradient(135deg, #0744b6ff 0%, #3a6bd3 100%);
            --gradient-success: linear-gradient(135deg, #10b981 0%, #34d399 100%);
            --gradient-warning: linear-gradient(135deg, #f59e0b 0%, #fbbf24 100%);
            --gradient-danger: linear-gradient(135deg, #ef4444 0%, #f87171 100%);
            --gradient-info: linear-gradient(135deg, #3b82f6 0%, #60a5fa 100%);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', 'Segoe UI', system-ui, -apple-system, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #f5f7fb 0%, #f0f4f8 100%);
            color: #2d3748;
            line-height: 1.6;
            min-height: 100vh;
            font-size: 15px;
        }

        /* ===== PRIMERA BARRA (HEADER SUPERIOR) ===== */
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

        .container-custom {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .logo-img {
            height: 55px;
            width: auto;
            max-width: 180px;
            object-fit: contain;
        }

        .navbar-brand { 
            color: var(--primary) !important; 
            font-weight: 600; 
            font-size: 1.4rem;
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        .navbar-brand::before {
            content: "";
            display: block;
            width: 6px;
            height: 28px;
            background: var(--primary);
            border-radius: 2px;
        }

        /* ===== SEGUNDA BARRA (MENÚ DE NAVEGACIÓN) ===== */
        .navbar-menu { 
            background: var(--primary); 
            padding: 8px 0;
            position: sticky;
            top: 73px;
            z-index: 999;
        }

        /* Estilos para escritorio (menú horizontal visible) */
        .navbar-menu .navbar-collapse {
            display: flex !important;
            align-items: center;
            justify-content: space-between;
        }

        .navbar-menu .navbar-nav {
            display: flex;
            align-items: center;
            gap: 5px;
            flex-wrap: wrap;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .navbar-menu .nav-item {
            list-style: none;
        }

        .navbar-menu .nav-link {
            font-weight: 500;
            color: rgba(255, 255, 255, 0.9) !important;
            padding: 1rem 1.8rem !important;
            margin: 0 0.1rem;
            border-radius: 8px;
            transition: var(--transition);
            position: relative;
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .navbar-menu .nav-link:hover, 
        .navbar-menu .nav-link.active {
            color: white !important;
            background-color: rgba(255, 255, 255, 0.12);
        }

        .navbar-menu .nav-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 50%;
            width: 0;
            height: 3px;
            background: white;
            transition: var(--transition);
            transform: translateX(-50%);
            border-radius: 2px;
        }

        .navbar-menu .nav-link:hover::after, 
        .navbar-menu .nav-link.active::after {
            width: 70%;
        }

        /* Información de usuario y cerrar sesión en escritorio */
        .user-info-container {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
            color: white;
            padding: 5px 12px;
            border-radius: 40px;
            background: rgba(255, 255, 255, 0.1);
        }

        .user-name {
            font-weight: 500;
            color: rgba(255, 255, 255, 0.95);
            font-size: 0.95rem;
        }

        .user-avatar {
            font-size: 1.3rem;
            color: rgba(255, 255, 255, 0.9);
        }

        .logout-form {
            margin: 0;
        }

        .logout-btn {
            background: transparent;
            border: 1px solid rgba(255, 255, 255, 0.4);
            color: rgba(255, 255, 255, 0.9);
            padding: 0.5rem 1.2rem;
            border-radius: 40px;
            font-weight: 500;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9rem;
            cursor: pointer;
        }

        .logout-btn:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border-color: rgba(255, 255, 255, 0.6);
            transform: translateY(-2px);
        }

        /* Botón hamburguesa - Oculto en escritorio */
        .navbar-toggler {
            display: none;
            background: transparent;
            border: 1px solid rgba(255, 255, 255, 0.3);
            padding: 0.5rem 0.75rem;
            border-radius: 4px;
            cursor: pointer;
        }

        .navbar-toggler-icon {
            display: inline-block;
            width: 1.5em;
            height: 1.5em;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 0.8%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: center;
            background-size: contain;
        }

        /* MAIN CONTENT */
        .main-content {
            max-width: 1400px;
            margin: 0 auto;
            padding: 30px 20px;
            min-height: calc(100vh - 140px);
        }

        /* ===== ESTILOS DEL DASHBOARD (MANTENIDOS) ===== */
        .system-alert {
            padding: 15px 20px;
            border-radius: 12px;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 15px;
            background-color: #f8f9fa;
            border-left: 6px solid var(--primary);
            animation: slideIn 0.3s ease;
            box-shadow: var(--card-shadow);
        }

        .system-alert i {
            font-size: 22px;
            color: var(--primary);
        }

        .system-alert-content h4 {
            margin: 0 0 4px 0;
            font-size: 16px;
            font-weight: 700;
            color: var(--primary);
        }

        .system-alert-content p {
            margin: 0;
            font-size: 15px;
            color: var(--text-muted);
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .periodo-alert {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 22px;
            border-radius: 12px;
            margin-bottom: 25px;
            box-shadow: var(--card-shadow);
            background-color: white;
            border: 2px solid var(--border-color);
            transition: var(--transition);
            flex-wrap: wrap;
            gap: 15px;
        }

        .periodo-alert:hover {
            transform: translateY(-3px);
            box-shadow: var(--card-shadow-hover);
        }

        .periodo-content {
            display: flex;
            align-items: center;
            gap: 16px;
            flex: 1;
        }

        .periodo-icon {
            font-size: 28px;
            flex-shrink: 0;
        }

        .periodo-content h3 {
            margin: 0 0 5px 0;
            font-size: 18px;
            font-weight: 700;
            color: #1e293b;
        }

        .periodo-content p {
            margin: 0;
            font-size: 15px;
            color: var(--text-muted);
        }

        .periodo-status {
            padding: 8px 16px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 14px;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
            gap: 8px;
            flex-shrink: 0;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .status-active {
            background: var(--gradient-success);
            color: white;
        }

        .status-inactive {
            background: var(--gradient-danger);
            color: white;
        }

        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 25px;
        }

        .card {
            background-color: white;
            border-radius: 14px;
            padding: 20px;
            box-shadow: var(--card-shadow);
            transition: var(--transition);
            border: 2px solid var(--border-color);
            position: relative;
            overflow: hidden;
        }

        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--gradient-primary);
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: var(--card-shadow-hover);
        }

        .card-header {
            display: flex;
            align-items: center;
            margin-bottom: 12px;
        }

        .card-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            font-size: 22px;
            color: white;
            box-shadow: 0 5px 10px rgba(0,0,0,0.1);
        }

        .card-icon.req { background: var(--gradient-primary); }
        .card-icon.sub { background: var(--gradient-success); }
        .card-icon.fal { background: var(--gradient-warning); }
        .card-icon.pro { background: var(--gradient-info); }

        .card-title h3 {
            font-size: 15px;
            color: var(--text-muted);
            margin-bottom: 5px;
            font-weight: 600;
        }

        .card-value {
            font-size: 32px;
            font-weight: 800;
            color: #1e293b;
            line-height: 1;
        }

        .card-footer {
            margin-top: 10px;
            color: var(--text-muted);
            font-size: 13px;
            font-weight: 500;
        }

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
            gap: 10px;
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

        .profile-info {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 18px;
        }

        .info-item {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 16px;
            background-color: var(--light-bg);
            border-radius: 12px;
            border: 1px solid var(--border-color);
            transition: var(--transition);
        }

        .info-item:hover {
            background-color: #eef2f7;
            transform: translateY(-2px);
            box-shadow: 0 5px 12px rgba(0,0,0,0.08);
        }

        .info-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 22px;
            flex-shrink: 0;
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
        }

        .info-icon.id-card { background: linear-gradient(135deg, #4f46e5, #6366f1); }
        .info-icon.envelope { background: linear-gradient(135deg, #dc2626, #ef4444); }
        .info-icon.university { background: linear-gradient(135deg, #7c3aed, #8b5cf6); }
        .info-icon.calendar { background: linear-gradient(135deg, #ea580c, #f97316); }
        .info-icon.user-check { background: linear-gradient(135deg, #16a34a, #22c55e); }
        .info-icon.chart-bar { background: linear-gradient(135deg, #0284c7, #38bdf8); }

        .info-content h4 {
            font-size: 14px;
            color: var(--text-muted);
            margin-bottom: 5px;
            font-weight: 600;
        }

        .info-content p {
            font-size: 17px;
            font-weight: 700;
            color: #1e293b;
            line-height: 1.3;
        }

        .btn-go-documents {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            background: var(--gradient-primary);
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: 700;
            font-size: 15px;
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
            box-shadow: 0 5px 15px rgba(7, 68, 182, 0.25);
        }

        .periodo-actions {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-top: 10px;
            flex-wrap: wrap;
        }

        .btn-subir-documentos {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 18px;
            background: transparent;
            color: var(--primary);
            border: 2px solid var(--primary);
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
        }

        .btn-subir-documentos:hover {
            background-color: var(--primary);
            color: white;
            transform: translateY(-2px);
        }

        .timeline {
            position: relative;
            padding-left: 25px;
        }

        .timeline:before {
            content: '';
            position: absolute;
            left: 8px;
            top: 0;
            bottom: 0;
            width: 2px;
            background: linear-gradient(to bottom, var(--primary-light), var(--secondary));
        }

        .timeline-item {
            position: relative;
            margin-bottom: 18px;
        }

        .timeline-marker {
            position: absolute;
            left: -25px;
            top: 0;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1;
            font-size: 10px;
            border: 2px solid white;
            box-shadow: 0 3px 6px rgba(0,0,0,0.12);
        }

        .timeline-marker.aprobado { background-color: var(--success-color); color: white; }
        .timeline-marker.rechazado { background-color: var(--danger-color); color: white; }
        .timeline-marker.pendiente { background-color: var(--warning-color); color: white; }

        .timeline-content {
            background-color: var(--light-bg);
            border-radius: 10px;
            padding: 14px 18px;
            transition: var(--transition);
            border: 1px solid var(--border-color);
        }

        .timeline-content:hover {
            transform: translateX(4px);
            background-color: white;
        }

        .timeline-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 6px;
            flex-wrap: wrap;
            gap: 8px;
        }

        .timeline-title {
            font-weight: 700;
            font-size: 16px;
            color: var(--primary);
        }

        .timeline-time {
            font-size: 13px;
            color: var(--text-muted);
        }

        .alert {
            padding: 15px 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            display: flex;
            align-items: flex-start;
            gap: 15px;
            border-left: 6px solid transparent;
            animation: slideIn 0.3s ease;
            box-shadow: var(--card-shadow);
        }

        .alert-success { background-color: var(--success-light); border-color: var(--success-color); color: #065f46; }
        .alert-warning { background-color: var(--warning-light); border-color: var(--warning-color); color: #92400e; }
        .alert-danger { background-color: var(--danger-light); border-color: var(--danger-color); color: #991b1b; }

        .welcome-message {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background: white;
            border: 1.5px solid var(--success-color);
            border-radius: 40px;
            color: var(--success-color);
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 20px;
        }

        /* ===== MEDIA QUERIES - SOLO PARA MÓVIL ===== */
        @media (max-width: 991px) {
            .navbar-menu {
                top: 70px;
            }
            
            /* En móvil, ocultamos el menú horizontal y mostramos el botón hamburguesa */
            .navbar-menu .navbar-collapse {
                display: none !important;
                flex-direction: column;
                align-items: stretch;
                width: 100%;
                background: var(--primary);
                padding: 15px 0 20px 0;
                border-radius: 0 0 12px 12px;
                position: absolute;
                top: 100%;
                left: 0;
                z-index: 1000;
            }
            
            .navbar-menu .navbar-collapse.active {
                display: flex !important;
            }
            
            .navbar-toggler {
                display: block;
            }
            
            .navbar-menu .navbar-nav {
                flex-direction: column;
                align-items: stretch;
                width: 100%;
                margin-bottom: 20px;
            }
            
            .navbar-menu .nav-link {
                justify-content: flex-start;
                padding: 12px 20px !important;
                margin: 2px 0;
            }
            
            .navbar-menu .nav-link::after {
                display: none;
            }
            
            .user-info-container {
                flex-direction: column;
                align-items: stretch;
                width: 100%;
                gap: 15px;
                padding-top: 15px;
                border-top: 1px solid rgba(255, 255, 255, 0.2);
            }
            
            .user-info {
                justify-content: center;
                padding: 10px;
            }
            
            .logout-form {
                width: 100%;
            }
            
            .logout-btn {
                width: 100%;
                justify-content: center;
                padding: 10px;
            }
        }

        @media (max-width: 768px) {
            .container-custom {
                padding: 0 15px;
            }
            
            .logo-img {
                height: 45px;
            }
            
            .navbar-brand {
                font-size: 1.2rem;
            }
            
            .main-content {
                padding: 20px 15px;
            }
            
            .cards-grid {
                grid-template-columns: 1fr;
            }
            
            .profile-info {
                grid-template-columns: 1fr;
            }
            
            .periodo-alert {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .periodo-status {
                align-self: stretch;
                justify-content: center;
            }
            
            .periodo-content {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .section {
                padding: 18px;
            }
        }
    </style>
</head>
<body>
    <!-- PRIMERA BARRA - Logo y título -->
    <nav class="navbar-top">
        <div class="container-custom">
            <div class="logo-container">
                <img src="{{ asset('img/logo_iufim.png') }}" alt="Logo IUFIM" class="logo-img">
                <a class="navbar-brand" href="{{ route('profesor.dashboard') }}">
                    Sistema GEPROC
                </a>
            </div>
        </div>
    </nav>

    <!-- SEGUNDA BARRA - Menú con información de usuario -->
    <nav class="navbar-menu">
        <div class="container-custom" style="display: flex; align-items: center; justify-content: space-between;">
            <!-- Botón hamburguesa (solo visible en móvil) -->
            <button class="navbar-toggler" type="button" id="menuToggle">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Espacio vacío para mantener el layout -->
            <div style="flex: 1;"></div>
        </div>
        
        <!-- Menú colapsable (en escritorio siempre visible, en móvil se despliega) -->
        <div class="navbar-collapse" id="mainNavbar">
            <div class="container-custom" style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 20px;">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="{{ route('profesor.dashboard') }}" class="nav-link active">
                            <i class="fas fa-home"></i> Inicio
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('profesor.documentos') }}" class="nav-link">
                            <i class="fas fa-folder"></i> Documentos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('maestros.grados.create') }}" class="nav-link">
                            <i class="fas fa-graduation-cap"></i> Grados
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('editar-mi-perfil') }}" class="nav-link">
                            <i class="fas fa-user"></i> Perfil
                        </a>
                    </li>
                </ul>
                
                <!-- Información de usuario y cerrar sesión -->
                <div class="user-info-container">
                    <div class="user-info">
                        <span class="user-name">{{ $maestroData->nombre ?? 'Profesor' }}</span>
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

    <!-- MAIN CONTENT -->
    <div class="main-content" id="dashboard">
        @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> 
            <div>{{ session('success') }}</div>
        </div>
        @endif

        @if(session('warning'))
        <div class="alert alert-warning">
            <i class="fas fa-exclamation-triangle"></i> 
            <div>{{ session('warning') }}</div>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-triangle"></i> 
            <div>{{ session('error') }}</div>
        </div>
        @endif

        @php
            $periodoHabilitado = $periodoHabilitado ?? null;
            $hayPeriodoHabilitado = $hayPeriodoHabilitado ?? false;
            
            if (!$hayPeriodoHabilitado) {
                $totalRequeridos = 0;
                $totalSubidos = 0;
                $porcentaje = 0;
                $faltantes = 0;
            } else {
                $totalRequeridos = $estadisticas['total_requeridos'] ?? 0;
                $totalSubidos = $estadisticas['total_subidos'] ?? 0;
                $porcentaje = $estadisticas['porcentaje'] ?? 0;
                $faltantes = $estadisticas['faltantes'] ?? 0;
            }
            
            $maestroData = $maestroData ?? $maestro ?? null;
            $actividadesRecientes = $actividadesRecientes ?? [];
        @endphp

        <div class="welcome-message" id="welcomeContainer">
            <i class="fas fa-hand-wave"></i>
            <span id="welcomeText">Cargando saludo...</span>
        </div>

        @if($hayPeriodoHabilitado && $faltantes > 0)
        <div class="system-alert">
            <i class="fas fa-bell"></i>
            <div class="system-alert-content">
                <h4>📌 Recordatorio Importante</h4>
                <p>Tienes <strong>{{ $faltantes }}</strong> documento(s) pendiente(s) de subir.</p>
            </div>
        </div>
        @endif

        <div class="periodo-alert">
            <div class="periodo-content">
                <div class="periodo-icon">
                    @if($hayPeriodoHabilitado)
                    <i class="fas fa-calendar-check" style="color: var(--success-color);"></i>
                    @else
                    <i class="fas fa-calendar-times" style="color: var(--warning-color);"></i>
                    @endif
                </div>
                <div>
                    <h3>
                        @if($hayPeriodoHabilitado)
                        Período Habilitado: {{ $periodoHabilitado->nombre }}
                        @else
                        No hay período habilitado
                        @endif
                    </h3>
                    <p>
                        @if($hayPeriodoHabilitado)
                        <strong>Estado:</strong> Activo, sube tus documentos
                        @else
                        <strong>Espera a que se habilite un período</strong>
                        @endif
                    </p>
                    @if($hayPeriodoHabilitado)
                    <div class="periodo-actions">
                        <a href="{{ route('profesor.documentos') }}" class="btn-subir-documentos">
                            <i class="fas fa-upload"></i> Subir Documentos
                        </a>
                    </div>
                    @endif
                </div>
            </div>
            <div class="periodo-status {{ $hayPeriodoHabilitado ? 'status-active' : 'status-inactive' }}">
                @if($hayPeriodoHabilitado)
                <i class="fas fa-toggle-on"></i> ACTIVO
                @else
                <i class="fas fa-toggle-off"></i> INACTIVO
                @endif
            </div>
        </div>

        @if(!$maestroData)
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-triangle"></i>
            <div>No se encontró información del maestro. Contacta al administrador.</div>
        </div>
        @else

        <div class="cards-grid">
            <div class="card">
                <div class="card-header">
                    <div class="card-icon req"><i class="fas fa-file-alt"></i></div>
                    <div class="card-title"><h3>Documentos Requeridos</h3></div>
                </div>
                <div class="card-value">{{ $totalRequeridos }}</div>
                <div class="card-footer">Total de documentos a subir</div>
            </div>
            
            <div class="card">
                <div class="card-header">
                    <div class="card-icon sub"><i class="fas fa-check-circle"></i></div>
                    <div class="card-title"><h3>Documentos Subidos</h3></div>
                </div>
                <div class="card-value">{{ $totalSubidos }}</div>
                <div class="card-footer">de {{ $totalRequeridos }} requeridos</div>
            </div>
            
            <div class="card">
                <div class="card-header">
                    <div class="card-icon fal"><i class="fas fa-exclamation-triangle"></i></div>
                    <div class="card-title"><h3>Documentos Faltantes</h3></div>
                </div>
                <div class="card-value">{{ $faltantes }}</div>
                <div class="card-footer">Pendientes de subir</div>
            </div>
            
            <div class="card">
                <div class="card-header">
                    <div class="card-icon pro"><i class="fas fa-chart-line"></i></div>
                    <div class="card-title"><h3>Progreso Total</h3></div>
                </div>
                <div class="card-value">{{ $porcentaje }}%</div>
                <div class="card-footer">Completado</div>
            </div>
        </div>

        <div class="section" id="perfil">
            <div class="section-header">
                <div class="section-title">
                    <i class="fas fa-user-circle"></i>
                    <span>Información Personal</span>
                </div>
                <a href="{{ route('editar-mi-perfil') }}" class="btn-go-documents">
                    <i class="fas fa-edit"></i> Editar Perfil
                </a>
            </div>
            
            <div class="profile-info">
                <div class="info-item">
                    <div class="info-icon id-card"><i class="fas fa-id-card"></i></div>
                    <div class="info-content">
                        <h4>Nombre Completo</h4>
                        <p>{{ $maestroData->nombres }} {{ $maestroData->apellido_paterno }} {{ $maestroData->apellido_materno }}</p>
                    </div>
                </div>
                
                <div class="info-item">
                    <div class="info-icon envelope"><i class="fas fa-envelope"></i></div>
                    <div class="info-content">
                        <h4>Correo Electrónico</h4>
                        <p>{{ $maestroData->email }}</p>
                    </div>
                </div>
                
                <div class="info-item">
                    <div class="info-icon university"><i class="fas fa-university"></i></div>
                    <div class="info-content">
                        <h4>Coordinación</h4>
                        <p>{{ $maestroData->coordinacion->nombre ?? 'No asignada' }}</p>
                    </div>
                </div>
                
                <div class="info-item">
                    <div class="info-icon calendar"><i class="fas fa-calendar-plus"></i></div>
                    <div class="info-content">
                        <h4>Fecha de Registro</h4>
                        <p>{{ $maestroData->created_at ? $maestroData->created_at->format('d/m/Y') : 'N/A' }}</p>
                    </div>
                </div>
                
                <div class="info-item">
                    <div class="info-icon user-check"><i class="fas fa-user-check"></i></div>
                    <div class="info-content">
                        <h4>Estado</h4>
                        <p style="color: var(--success-color);">Activo</p>
                    </div>
                </div>
                
                <div class="info-item">
                    <div class="info-icon chart-bar"><i class="fas fa-chart-bar"></i></div>
                    <div class="info-content">
                        <h4>Progreso</h4>
                        <p>{{ $porcentaje }}% Completado</p>
                    </div>
                </div>
            </div>
        </div>

        @if(count($actividadesRecientes) > 0)
        <div class="section">
            <div class="section-header">
                <div class="section-title">
                    <i class="fas fa-history"></i>
                    <span>Actividades Recientes</span>
                </div>
            </div>
            <div class="timeline">
                @foreach($actividadesRecientes as $actividad)
                <div class="timeline-item">
                    <div class="timeline-marker {{ $actividad['tipo'] }}">
                        <i class="fas fa-{{ $actividad['tipo'] == 'aprobado' ? 'check' : ($actividad['tipo'] == 'rechazado' ? 'times' : 'clock') }}"></i>
                    </div>
                    <div class="timeline-content">
                        <div class="timeline-header">
                            <div class="timeline-title">{{ $actividad['titulo'] }}</div>
                            <div class="timeline-time">{{ $actividad['tiempo'] }}</div>
                        </div>
                        <div class="timeline-desc">{{ $actividad['descripcion'] }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
        @endif
    </div>

    <script>
        // Menú hamburguesa para móvil
        const menuToggle = document.getElementById('menuToggle');
        const mainNavbar = document.getElementById('mainNavbar');
        
        if (menuToggle && mainNavbar) {
            menuToggle.addEventListener('click', function(e) {
                e.stopPropagation();
                mainNavbar.classList.toggle('active');
            });
            
            // Cerrar menú al hacer clic fuera
            document.addEventListener('click', function(event) {
                if (window.innerWidth <= 991) {
                    if (!menuToggle.contains(event.target) && !mainNavbar.contains(event.target)) {
                        mainNavbar.classList.remove('active');
                    }
                }
            });
        }

        function scrollToSection(sectionId) {
            const section = document.getElementById(sectionId);
            if (section) {
                section.scrollIntoView({ behavior: 'smooth', block: 'start' });
                // Cerrar menú móvil
                if (window.innerWidth <= 991 && mainNavbar.classList.contains('active')) {
                    mainNavbar.classList.remove('active');
                }
            }
        }

        function actualizarSaludoMexico() {
            const welcomeText = document.getElementById('welcomeText');
            if (!welcomeText) return;
            
            const opciones = { timeZone: 'America/Mexico_City', hour: 'numeric', hour12: false };
            const formatter = new Intl.DateTimeFormat('es-MX', opciones);
            const horaMexico = parseInt(formatter.format(new Date()));
            
            const nombre = "{{ $maestroData->nombres ?? 'Profesor' }}";
            let saludo, emoji;
            
            if (horaMexico >= 0 && horaMexico < 12) {
                emoji = '🌅';
                saludo = 'Buenos días';
            } else if (horaMexico >= 12 && horaMexico < 19) {
                emoji = '☀️';
                saludo = 'Buenas tardes';
            } else {
                emoji = '🌙';
                saludo = 'Buenas noches';
            }
            
            welcomeText.innerHTML = `${emoji} ¡${saludo}, ${nombre}! Bienvenido/a al Sistema GEPROC`;
        }
        
        actualizarSaludoMexico();
        setInterval(actualizarSaludoMexico, 60000);

        // Efecto de scroll en navbar superior
        const navbarTop = document.querySelector('.navbar-top');
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                navbarTop.classList.add('scrolled');
            } else {
                navbarTop.classList.remove('scrolled');
            }
        });
    </script>
</body>
</html>