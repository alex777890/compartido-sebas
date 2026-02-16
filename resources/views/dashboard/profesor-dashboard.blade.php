<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Profesor - Sistema GEPROC</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
            --sidebar-width: 280px;
            --header-height: 80px;
            --gradient-primary: linear-gradient(135deg, #0744b6ff 0%, #3a6bd3 100%);
            --gradient-success: linear-gradient(135deg, #10b981 0%, #34d399 100%);
            --gradient-warning: linear-gradient(135deg, #f59e0b 0%, #fbbf24 100%);
            --gradient-danger: linear-gradient(135deg, #ef4444 0%, #f87171 100%);
            --gradient-info: linear-gradient(135deg, #3b82f6 0%, #60a5fa 100%);
            --gradient-purple: linear-gradient(135deg, #8b5cf6 0%, #a78bfa 100%);
            --gradient-cyan: linear-gradient(135deg, #06b6d4 0%, #22d3ee 100%);
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
            display: flex;
            min-height: 100vh;
            font-size: 15px;
        }

        /* ===== MENÚ DE LA PRIMERA VISTA ===== */
        /* HEADER SUPERIOR MEJORADO Y MÁS GRANDE */
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

        /* HOVER CON AZUL MUY CLARO */
        .nav-link:hover {
            background-color: #e8f0fe;
            color: var(--primary);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(7, 68, 182, 0.12);
        }

        /* ESTILO PARA EL ENLACE ACTIVO - SIN LÍNEA AZUL INFERIOR */
        .nav-link.active {
            background-color: #e8f0fe;
            color: var(--primary);
            box-shadow: 0 8px 16px rgba(7, 68, 182, 0.15);
            border-radius: 10px;
            position: relative;
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

        /* LETRERO DE BIENVENIDA - COMPACTO Y ELEGANTE */
        .welcome-message {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 18px;
            background: white;
            border: 1.5px solid var(--success-color);
            border-radius: 40px;
            color: var(--success-color);
            font-weight: 600;
            font-size: 15px;
            box-shadow: 0 3px 10px rgba(16, 185, 129, 0.1);
            transition: var(--transition);
            letter-spacing: 0.3px;
        }

        .welcome-message:hover {
            background: white;
            border-color: var(--success-color);
            color: var(--success-color);
            transform: translateY(-1px);
            box-shadow: 0 5px 12px rgba(16, 185, 129, 0.15);
        }

        .welcome-message i {
            font-size: 18px;
            color: var(--success-color);
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 18px;
            padding: 12px 22px;
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
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 20px;
        }

        .user-info {
            display: flex;
            flex-direction: column;
        }

        .user-info h4 {
            font-size: 18px;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 4px;
            white-space: nowrap;
        }

        .user-info p {
            font-size: 14px;
            color: var(--text-muted);
            white-space: nowrap;
        }

        /* BOTÓN DE CERRAR SESIÓN - SIN CONTORNO AZUL, TOTALMENTE BLANCO */
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

        /* MAIN CONTENT */
        .main-content {
            flex: 1;
            transition: var(--transition);
        }

        /* CONTENT WRAPPER */
        .content-wrapper {
            padding: 30px 35px;
            max-width: 100%;
        }

        /* ===== ESTILOS DEL DASHBOARD - CUADROS MÁS COMPACTOS, LETRAS GRANDES ===== */
        
        /* ALERTAS DEL SISTEMA */
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

        /* PERIODO ALERT - MÁS COMPACTO */
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
        }

        .periodo-alert:hover {
            transform: translateY(-3px);
            box-shadow: var(--card-shadow-hover);
        }

        .periodo-content {
            display: flex;
            align-items: center;
            gap: 16px;
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

        /* CARD GRID - MÁS COMPACTO */
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

        .card-icon.req {
            background: var(--gradient-primary);
        }

        .card-icon.sub {
            background: var(--gradient-success);
        }

        .card-icon.fal {
            background: var(--gradient-warning);
        }

        .card-icon.pro {
            background: var(--gradient-info);
        }

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

        /* SECTION STYLES - MÁS COMPACTO */
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

        /* PROFILE SECTION - ICONOS CON COLORES ESPECÍFICOS */
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

        /* COLORES ESPECÍFICOS PARA CADA ICONO */
        .info-icon.id-card {
            background: linear-gradient(135deg, #4f46e5, #6366f1);
        }
        .info-icon.envelope {
            background: linear-gradient(135deg, #dc2626, #ef4444);
        }
        .info-icon.university {
            background: linear-gradient(135deg, #7c3aed, #8b5cf6);
        }
        .info-icon.calendar {
            background: linear-gradient(135deg, #ea580c, #f97316);
        }
        .info-icon.user-check {
            background: linear-gradient(135deg, #16a34a, #22c55e);
        }
        .info-icon.chart-bar {
            background: linear-gradient(135deg, #0284c7, #38bdf8);
        }

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

        /* BOTÓN PARA IR A DOCUMENTOS */
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

        .btn-go-documents:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(7, 68, 182, 0.35);
        }

        .btn-go-documents i {
            font-size: 16px;
        }

        .periodo-actions {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-top: 10px;
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
            box-shadow: 0 5px 12px rgba(7, 68, 182, 0.2);
        }

        /* ACTIVIDADES RECIENTES - MÁS COMPACTAS */
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
            border-radius: 2px;
        }

        .timeline-item {
            position: relative;
            margin-bottom: 18px;
        }

        .timeline-item:last-child {
            margin-bottom: 0;
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

        .timeline-marker.aprobado {
            background-color: var(--success-color);
            color: white;
        }

        .timeline-marker.rechazado {
            background-color: var(--danger-color);
            color: white;
        }

        .timeline-marker.pendiente {
            background-color: var(--warning-color);
            color: white;
        }

        .timeline-content {
            background-color: var(--light-bg);
            border-radius: 10px;
            padding: 14px 18px;
            transition: var(--transition);
            border: 1px solid var(--border-color);
        }

        .timeline-content:hover {
            transform: translateX(4px);
            box-shadow: 0 5px 12px rgba(0,0,0,0.08);
            background-color: white;
        }

        .timeline-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 6px;
        }

        .timeline-title {
            font-weight: 700;
            font-size: 16px;
            color: var(--primary);
        }

        .timeline-time {
            font-size: 13px;
            color: var(--text-muted);
            font-weight: 500;
        }

        .timeline-desc {
            color: #4a5568;
            font-size: 14px;
            line-height: 1.5;
        }

        /* ALERTAS ESTILIZADAS */
        .alert {
            padding: 15px 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            display: flex;
            align-items: flex-start;
            gap: 15px;
            border-left: 6px solid transparent;
            animation: slideIn 0.3s ease;
            font-size: 15px;
            box-shadow: var(--card-shadow);
        }

        .alert-success {
            background-color: var(--success-light);
            border-color: var(--success-color);
            color: #065f46;
        }

        .alert-warning {
            background-color: var(--warning-light);
            border-color: var(--warning-color);
            color: #92400e;
        }

        .alert-danger {
            background-color: var(--danger-light);
            border-color: var(--danger-color);
            color: #991b1b;
        }

        .alert-info {
            background-color: var(--info-light);
            border-color: var(--info-color);
            color: #1e40af;
        }

        .alert i {
            font-size: 22px;
            margin-top: 2px;
        }

        .alert ul {
            margin-top: 10px;
            margin-left: 18px;
            font-size: 14px;
        }

        .alert ul li {
            margin-bottom: 4px;
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
            
            .welcome-message {
                display: none;
            }
        }

        @media (max-width: 992px) {
            .cards-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .profile-info {
                grid-template-columns: 1fr;
            }
            
            .periodo-alert {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
            
            .periodo-status {
                align-self: stretch;
                justify-content: center;
            }
        }

        @media (max-width: 768px) {
            .cards-grid {
                grid-template-columns: 1fr;
            }
            
            .header-left {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
            
            .user-info h4 {
                font-size: 16px;
            }
            
            .user-info p {
                font-size: 13px;
            }
            
            .section {
                padding: 18px;
            }
            
            .periodo-content {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
            }
            
            .header-right {
                flex-wrap: wrap;
                justify-content: flex-end;
            }
        }

        @media (max-width: 480px) {
            .content-wrapper {
                padding: 15px;
            }
            
            .card-value {
                font-size: 26px;
            }
            
            .section-title {
                font-size: 18px;
            }
            
            .info-content p {
                font-size: 15px;
            }
            
            .btn-go-documents {
                width: 100%;
                justify-content: center;
                padding: 10px 20px;
            }
            
            .logout-button {
                padding: 10px 20px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <!-- HEADER SUPERIOR DE LA PRIMERA VISTA - MENÚ COMPLETO -->
    <div class="main-content">
        <!-- HEADER SUPERIOR MÁS GRANDE Y ATTRACTIVO -->
        <div class="header">
            <div class="header-left">
                <div class="header-logo">
                    <img src="{{ asset('img/logo_iufim.png') }}" alt="Logo IUFIM" class="logo-img-header">
                </div>
                <div class="header-nav">
                    <a href="{{ route('profesor.dashboard') }}" class="nav-link active">
                        <i class="fas fa-home"></i> Inicio
                    </a>
                    <a href="{{ route('profesor.documentos') }}" class="nav-link">
                        <i class="fas fa-folder"></i> Documentos
                    </a>
                    <a href="{{ route('maestros.grados.create') }}" class="nav-link">
                        <i class="fas fa-graduation-cap"></i> Grados
                    </a>
                    <a href="#perfil" class="nav-link" onclick="scrollToSection('perfil')">
                        <i class="fas fa-user"></i> Perfil
                    </a>
                </div>
            </div>
            
            <div class="header-right">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="logout-button">
                        <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                    </button>
                </form>
            </div>
        </div>

        <!-- CONTENT WRAPPER -->
        <div class="content-wrapper" id="dashboard">
            <!-- MENSAJES DEL SISTEMA -->
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

            @if($errors->any())
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-triangle"></i>
                <div>
                    <strong>Errores encontrados:</strong>
                    <ul style="margin: 10px 0 0 20px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif

            @php
                // Variables seguras con datos del controller
                $periodoHabilitado = $periodoHabilitado ?? null;
                $hayPeriodoHabilitado = $hayPeriodoHabilitado ?? false;
                
                if (!$hayPeriodoHabilitado) {
                    $totalRequeridos = 0;
                    $totalSubidos = 0;
                    $aprobados = 0;
                    $rechazados = 0;
                    $pendientes = 0;
                    $porcentaje = 0;
                    $faltantes = 0;
                } else {
                    $totalRequeridos = $estadisticas['total_requeridos'] ?? 0;
                    $totalSubidos = $estadisticas['total_subidos'] ?? 0;
                    $aprobados = $estadisticas['aprobados'] ?? 0;
                    $rechazados = $estadisticas['rechazados'] ?? 0;
                    $pendientes = $estadisticas['pendientes'] ?? 0;
                    $porcentaje = $estadisticas['porcentaje'] ?? 0;
                    $faltantes = $estadisticas['faltantes'] ?? 0;
                }
                
                $maestroData = $maestroData ?? $maestro ?? null;
                $actividadesRecientes = $actividadesRecientes ?? [];
            @endphp

            <!-- LETRERO DE BIENVENIDA - COMPACTO Y ELEGANTE -->
            <div class="welcome-message">
                <i class="fas fa-hand-wave"></i>
                <span>¡Bienvenido/a, {{ $maestroData->nombres ?? 'Profesor' }}!</span>
            </div>

            <!-- ALERTA DEL SISTEMA -->
            @if($hayPeriodoHabilitado && $faltantes > 0)
            <div class="system-alert">
                <i class="fas fa-bell"></i>
                <div class="system-alert-content">
                    <h4>📌 Recordatorio Importante</h4>
                    <p>Tienes <strong style="color: var(--primary);">{{ $faltantes }}</strong> documento(s) pendiente(s) de subir para el período actual.</p>
                </div>
            </div>
            @endif

            <!-- PERIODO HABILITADO CON BOTÓN DE SUBIR DOCUMENTOS -->
            <div class="periodo-alert">
                <div class="periodo-content">
                    <div class="periodo-icon">
                        @if($hayPeriodoHabilitado)
                        <i class="fas fa-calendar-check" style="color: var(--success-color);"></i>
                        @else
                        <i class="fas fa-calendar-times" style="color: var(--warning-color);"></i>
                        @endif
                    </div>
                    <div style="flex: 1;">
                        <h3>
                            @if($hayPeriodoHabilitado)
                            Período Habilitado: {{ $periodoHabilitado->nombre }}
                            @else
                            No hay período habilitado
                            @endif
                        </h3>
                        <p>
                            @if($hayPeriodoHabilitado)
                            <strong>Estado:</strong> Activo, sube tus documentos para este periodo
                            @if($periodoHabilitado->fecha_limite)
                            • <strong>Fecha límite:</strong> {{ \Carbon\Carbon::parse($periodoHabilitado->fecha_limite)->format('d/m/Y') }}
                            @endif
                            @else
                            <strong>Espera a que se habilite un período para subir documentos</strong>
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
                <div>
                    <strong>No se encontró información del maestro.</strong>
                    <p style="margin-top: 8px; font-size: 15px;">Contacta al administrador del sistema.</p>
                </div>
            </div>
            @else

            <!-- INFORMACIÓN DEL PERFIL - ICONOS CON COLORES ESPECÍFICOS -->
            <div class="section" id="perfil">
                <div class="section-header">
                    <div class="section-title">
                        <i class="fas fa-user-circle"></i>
                        <span>Información Personal</span>
                    </div>
                </div>
                
                <div class="profile-info">
                    <div class="info-item">
                        <div class="info-icon id-card">
                            <i class="fas fa-id-card"></i>
                        </div>
                        <div class="info-content">
                            <h4>Nombre Completo</h4>
                            <p>{{ $maestroData->nombres }} {{ $maestroData->apellido_paterno }} {{ $maestroData->apellido_materno }}</p>
                        </div>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-icon envelope">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="info-content">
                            <h4>Correo Electrónico</h4>
                            <p>{{ $maestroData->email }}</p>
                        </div>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-icon university">
                            <i class="fas fa-university"></i>
                        </div>
                        <div class="info-content">
                            <h4>Coordinación</h4>
                            <p>{{ $maestroData->coordinacion->nombre ?? 'No asignada' }}</p>
                        </div>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-icon calendar">
                            <i class="fas fa-calendar-plus"></i>
                        </div>
                        <div class="info-content">
                            <h4>Fecha de Registro</h4>
                            <p>{{ $maestroData->created_at ? $maestroData->created_at->format('d/m/Y') : 'N/A' }}</p>
                        </div>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-icon user-check">
                            <i class="fas fa-user-check"></i>
                        </div>
                        <div class="info-content">
                            <h4>Estado</h4>
                            <p style="color: var(--success-color); font-weight: 700;">Activo</p>
                        </div>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-icon chart-bar">
                            <i class="fas fa-chart-bar"></i>
                        </div>
                        <div class="info-content">
                            <h4>Progreso de Documentos</h4>
                            <p style="color: var(--primary); font-weight: 700;">{{ $porcentaje }}% Completado</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ACTIVIDADES RECIENTES - MÁS COMPACTAS -->
            @if(count($actividadesRecientes) > 0)
            <div class="section">
                <div class="section-header">
                    <div class="section-title">
                        <i class="fas fa-history"></i>
                        <span>Estado de Actividades</span>
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
    </div>

    <script>
        function scrollToSection(sectionId) {
            const section = document.getElementById(sectionId);
            if (section) {
                section.scrollIntoView({ behavior: 'smooth', block: 'start' });
                
                // Actualizar clase activa en el menú
                document.querySelectorAll('.nav-link').forEach(link => {
                    link.classList.remove('active');
                });
                
                // Buscar el enlace que corresponde a esta sección
                document.querySelectorAll('.nav-link').forEach(link => {
                    if (link.getAttribute('href') === '#' + sectionId) {
                        link.classList.add('active');
                    }
                });
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Marcar enlace activo según la URL
            const currentPath = window.location.pathname;
            document.querySelectorAll('.nav-link').forEach(link => {
                const href = link.getAttribute('href');
                if (href && !href.startsWith('#') && currentPath.includes(href)) {
                    link.classList.add('active');
                }
            });

            // Manejar clics en enlaces de anclaje
            document.querySelectorAll('.nav-link[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href').substring(1);
                    scrollToSection(targetId);
                });
            });
        });
    </script>
</body>
</html>