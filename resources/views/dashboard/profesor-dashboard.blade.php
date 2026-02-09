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
            --success-color: #28a745;
            --success-light: #d4edda;
            --warning-color: #FFC107;
            --warning-light: #fff3cd;
            --danger-color: #dc3545;
            --danger-light: #f8d7da;
            --info-color: #17a2b8;
            --info-light: #d1ecf1;
            --border-radius: 12px;
            --sidebar-width: 280px;
            --header-height: 80px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        }

        

        body {
            background-color: #f5f7fb;
            color: #2d3748;
            line-height: 1.6;
            display: flex;
            min-height: 100vh;
            font-size: 14px;
        }
                /* Añade estos estilos para el botón de subir documentos */
        .periodo-actions {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-top: 10px;
        }

        .btn-subir-documentos {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            background: transparent;
            color: var(--primary);
            border: 2px solid var(--primary);
            border-radius: 8px;
            font-weight: 600;
            font-size: 13px;
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
        }

        .btn-subir-documentos:hover {
            background-color: var(--primary);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(7, 68, 182, 0.2);
        }

        /* Estilo para alertas del sistema */
        .system-alert {
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 15px;
            background-color: #f8f9fa;
            border-left: 4px solid var(--primary);
            animation: slideIn 0.3s ease;
        }

        .system-alert i {
            font-size: 20px;
            color: var(--primary);
        }

        .system-alert-content h4 {
            margin: 0 0 5px 0;
            font-size: 14px;
            color: var(--primary);
        }

        .system-alert-content p {
            margin: 0;
            font-size: 13px;
            color: var(--text-muted);
        }

        /* SIDEBAR - BLANCO CON LÍNEA AZUL */
        .sidebar {
            width: var(--sidebar-width);
            background: var(--sidebar-bg);
            color: #2d3748;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            box-shadow: 5px 0 15px rgba(0, 0, 0, 0.05);
            z-index: 100;
            transition: var(--transition);
            border-right: 3px solid var(--primary);
        }

        .sidebar-header {
            padding: 20px 15px;
            text-align: center;
            border-bottom: 1px solid var(--border-color);
        }

        .logo-img-sidebar {
            width: 120px;
            height: auto;
            margin-bottom: 15px;
        }

        .sidebar-header h2 {
            font-size: 20px;
            margin-bottom: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            font-weight: 600;
            color: var(--primary);
        }

        .sidebar-header p {
            font-size: 12px;
            color: var(--text-muted);
        }

        .sidebar-menu {
            padding: 15px 0;
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: #4a5568;
            text-decoration: none;
            transition: var(--transition);
            border-left: 4px solid transparent;
            font-size: 13.5px;
        }

        .menu-item:hover, .menu-item.active {
            background-color: rgba(7, 68, 182, 0.08);
            color: var(--primary);
            border-left-color: var(--primary);
        }

        .menu-item i {
            width: 20px;
            font-size: 16px;
            margin-right: 12px;
            color: var(--primary);
        }

        .menu-item span {
            font-weight: 500;
        }

        .menu-item .badge {
            margin-left: auto;
            background-color: var(--secondary);
            color: white;
            border-radius: 50px;
            padding: 2px 8px;
            font-size: 11px;
            font-weight: bold;
            min-width: 20px;
            text-align: center;
        }

        .sidebar-footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            padding: 15px;
            text-align: center;
            border-top: 1px solid var(--border-color);
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
            box-shadow: 0 5px 10px rgba(7, 68, 182, 0.15);
        }

        /* MAIN CONTENT */
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            padding: 0;
            transition: var(--transition);
        }

        /* HEADER - CON NOMBRE MÁS GRANDE */
        .header {
            height: 70px;
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 25px;
            position: sticky;
            top: 0;
            z-index: 99;
        }

        .logo-container {
            display: flex;
            align-items: center;
        }

        .logo-img {
            height: 45px;
            width: auto;
            max-width: 180px;
            object-fit: contain;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 6px 12px;
            background-color: var(--light-bg);
            border-radius: 50px;
            cursor: pointer;
            transition: var(--transition);
        }

        .user-profile:hover {
            background-color: #e9ecef;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 16px;
        }

        .user-info h4 {
            font-size: 18px;
            margin-bottom: 2px;
            font-weight: 700;
            color: var(--primary);
        }

        .user-info p {
            font-size: 12px;
            color: var(--text-muted);
        }

        .content-wrapper {
            padding: 20px;
        }

        /* PERIODO ALERT - COMPACTO */
        .periodo-alert {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 25px;
            box-shadow: var(--card-shadow);
            background-color: white;
            border: 1px solid var(--border-color);
        }

        .periodo-content {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .periodo-icon {
            font-size: 28px;
            flex-shrink: 0;
        }

        .periodo-status {
            padding: 6px 15px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 12px;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
            gap: 6px;
            flex-shrink: 0;
        }

        .status-active {
            background-color: var(--success-color);
            color: white;
        }

        .status-inactive {
            background-color: var(--text-muted);
            color: white;
        }

        /* CARD GRID - COMPACTO */
        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-bottom: 25px;
        }

        .card {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: var(--card-shadow);
            transition: var(--transition);
            border-top: 4px solid var(--primary);
            border: 1px solid var(--border-color);
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: var(--card-shadow-hover);
        }

        .card-header {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .card-icon {
            width: 45px;
            height: 45px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            font-size: 20px;
            color: white;
        }

        .card-icon.req {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
        }

        .card-icon.sub {
            background: linear-gradient(135deg, var(--success-color), #35c04a);
        }

        .card-icon.fal {
            background: linear-gradient(135deg, var(--warning-color), #ffd54f);
        }

        .card-icon.pro {
            background: linear-gradient(135deg, var(--secondary), #5dd5f3);
        }

        .card-title h3 {
            font-size: 14px;
            color: var(--text-muted);
            margin-bottom: 5px;
            font-weight: 600;
        }

        .card-value {
            font-size: 28px;
            font-weight: 700;
            color: #2d3748;
            line-height: 1;
        }

        .card-footer {
            margin-top: 8px;
            color: var(--text-muted);
            font-size: 12px;
        }

        /* SECTION STYLES - COMPACTO */
        .section {
            background-color: white;
            border-radius: 10px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: var(--card-shadow);
            border: 1px solid var(--border-color);
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
            font-size: 18px;
            color: var(--primary);
            font-weight: 700;
        }

        .section-title i {
            font-size: 20px;
        }

        /* PROFILE SECTION - COMPACTO */
        .profile-info {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 15px;
        }

        .info-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px;
            background-color: var(--light-bg);
            border-radius: 8px;
            border: 1px solid var(--border-color);
            transition: var(--transition);
        }

        .info-item:hover {
            background-color: #eef2f7;
        }

        .info-icon {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 18px;
            flex-shrink: 0;
        }

        .info-content h4 {
            font-size: 13px;
            color: var(--text-muted);
            margin-bottom: 4px;
            font-weight: 600;
        }

        .info-content p {
            font-size: 15px;
            font-weight: 600;
            color: #2d3748;
            line-height: 1.3;
        }

        /* ACTIVIDADES RECIENTES - COLORIDO */
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
            margin-bottom: 20px;
        }

        .timeline-item:last-child {
            margin-bottom: 0;
        }

        .timeline-marker {
            position: absolute;
            left: -25px;
            top: 0;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1;
            font-size: 10px;
            border: 2px solid white;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
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
            color: #333;
        }

        .timeline-content {
            background-color: var(--light-bg);
            border-radius: 8px;
            padding: 15px;
            transition: var(--transition);
        }

        .timeline-content:hover {
            transform: translateX(3px);
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }

        .timeline-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px;
        }

        .timeline-title {
            font-weight: 700;
            font-size: 14px;
            color: var(--primary);
        }

        .timeline-time {
            font-size: 12px;
            color: var(--text-muted);
            font-weight: 500;
        }

        .timeline-desc {
            color: #555;
            font-size: 13px;
            line-height: 1.4;
        }

        /* ALERTAS ESTILIZADAS */
        .alert {
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            display: flex;
            align-items: flex-start;
            gap: 15px;
            border-left: 4px solid transparent;
            animation: slideIn 0.3s ease;
        }

        .alert-success {
            background-color: var(--success-light);
            border-color: var(--success-color);
            color: #155724;
        }

        .alert-warning {
            background-color: var(--warning-light);
            border-color: var(--warning-color);
            color: #856404;
        }

        .alert-danger {
            background-color: var(--danger-light);
            border-color: var(--danger-color);
            color: #721c24;
        }

        .alert-info {
            background-color: var(--info-light);
            border-color: var(--info-color);
            color: #0c5460;
        }

        .alert i {
            font-size: 20px;
            margin-top: 2px;
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

        /* BOTÓN PARA IR A DOCUMENTOS */
        .btn-go-documents {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
            box-shadow: 0 4px 15px rgba(7, 68, 182, 0.2);
        }

        .btn-go-documents:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(7, 68, 182, 0.3);
            background: linear-gradient(135deg, var(--primary-light), var(--primary));
        }

        .btn-go-documents:active {
            transform: translateY(0);
        }

        .quick-actions {
            display: flex;
            gap: 15px;
            margin-top: 20px;
            flex-wrap: wrap;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .sidebar {
                width: 70px;
            }
            
            .sidebar-header h2 span,
            .sidebar-header p,
            .menu-item span,
            .sidebar-footer p {
                display: none;
            }
            
            .logo-img-sidebar {
                width: 45px;
            }
            
            .sidebar-header h2 {
                justify-content: center;
            }
            
            .main-content {
                margin-left: 70px;
            }
            
            .menu-item {
                justify-content: center;
                padding: 15px;
            }
            
            .menu-item i {
                margin-right: 0;
                font-size: 18px;
            }
            
            .user-info h4 {
                font-size: 16px;
            }
            
            .cards-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .profile-info {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 480px) {
            .cards-grid {
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
            
            .header {
                padding: 0 15px;
            }
        }
    </style>
</head>
  <!-- SIDEBAR BLANCO CON LÍNEA AZUL -->
    <div class="sidebar">
        <div class="sidebar-header">
            <img src="{{ asset('img/logo_iufim.png') }}" alt="Logo IUFIM" class="logo-img-sidebar">
            <h2><i class="fas fa-chalkboard-teacher"></i> <span>GEPROC</span></h2>
        </div>
        
        <div class="sidebar-menu">
            <a href="{{ route('profesor.dashboard') }}" class="menu-item active">
                <i class="fas fa-tachometer-alt"></i>
                <span>Inicio</span>
            </a>
            <a href=""  class="menu-item">
                <i class="fas fa-user"></i>
                <span>Mi Perfil</span>
            </a>
            <a href="{{ route('profesor.documentos') }}" class="menu-item">
                <i class="fas fa-folder"></i>
                <span>Mis Documentos</span>
                @if(($faltantes ?? 0) > 0)
                <span class="badge">{{ $faltantes }}</span>
                @endif
            </a>
            <a href="{{ route('maestros.grados.create') }}" class="menu-item">
                <i class="fas fa-graduation-cap"></i>
                <span>Grados Académicos</span>
            </a>
            <a href="#configuracion" class="menu-item">
                <i class="fas fa-cog"></i>
                <span>Configuración</span>
            </a>
        </div>
        
        <div class="sidebar-footer">
            <p style="font-size: 12px; opacity: 0.7; margin-bottom: 15px; color: var(--text-muted);"></p>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Cerrar Sesión</span>
                </button>
            </form>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <div class="main-content">
        <!-- HEADER CON NOMBRE MÁS GRANDE -->
        <div class="header">
            <div class="user-profile">
                <div class="user-avatar">
                    {{ substr($maestroData->nombres ?? 'P', 0, 1) }}{{ substr($maestroData->apellido_paterno ?? 'F', 0, 1) }}
                </div>
                <div class="user-info">
                    <h4>{{ $maestroData->nombres ?? 'Profesor' }} {{ $maestroData->apellido_paterno ?? '' }}</h4>
                    <p>{{ $maestroData->coordinacion->nombre ?? 'Coordinación' }}</p>
                </div>
            </div>
        </div>

        <!-- CONTENT WRAPPER -->
        <div class="content-wrapper" id="dashboard">
            <!-- MENSAJES DEL SISTEMA (NO DE DOCUMENTOS) -->
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
                    <ul style="margin: 10px 0 0 20px; font-size: 13px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif

            <!-- ALERTA DEL SISTEMA (EJEMPLO) -->
            @if($hayPeriodoHabilitado && $faltantes > 0)
            <div class="system-alert">
                <i class="fas fa-bell"></i>
                <div class="system-alert-content">
                    <h4>Recordatorio Importante</h4>
                    <p>Tienes {{ $faltantes }} documento(s) pendiente(s) de subir para el período actual.</p>
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

            <!-- PERIODO HABILITADO CON BOTÓN DE SUBIR DOCUMENTOS -->
            <div class="periodo-alert {{ $hayPeriodoHabilitado ? 'success' : 'warning' }}">
                <div class="periodo-content">
                    <div class="periodo-icon">
                        @if($hayPeriodoHabilitado)
                        <i class="fas fa-calendar-check" style="color: var(--success-color);"></i>
                        @else
                        <i class="fas fa-calendar-times" style="color: var(--warning-color);"></i>
                        @endif
                    </div>
                    <div style="flex: 1;">
                        <h3 style="margin: 0 0 5px 0; font-size: 16px;">
                            @if($hayPeriodoHabilitado)
                            Período Habilitado: {{ $periodoHabilitado->nombre }}
                            @else
                            No hay período habilitado
                            @endif
                        </h3>
                        <p style="margin: 0; font-size: 13px; color: var(--text-muted);">
                            @if($hayPeriodoHabilitado)
                            <strong>Estado:</strong> Activo, sube tus documentos para este periodo
                            @if($periodoHabilitado->fecha_limite)
                            • Fecha límite: {{ \Carbon\Carbon::parse($periodoHabilitado->fecha_limite)->format('d/m/Y') }}
                            @endif
                            @else
                            <strong>Espera a que se habilite un período para subir documentos</strong>
                            @endif
                        </p>
                    
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
                    <p style="margin-top: 5px; font-size: 13px;">Contacta al administrador del sistema.</p>
                </div>
            </div>
            @else

            <!-- INFORMACIÓN DEL PERFIL -->
            <div class="section" id="perfil">
                <div class="section-header">
                    <div class="section-title">
                        <i class="fas fa-user-circle"></i>
                        <span>Información Personal</span>
                    </div>
                </div>
                
                <div class="profile-info">
                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fas fa-id-card"></i>
                        </div>
                        <div class="info-content">
                            <h4>Nombre Completo</h4>
                            <p>{{ $maestroData->nombres }} {{ $maestroData->apellido_paterno }} {{ $maestroData->apellido_materno }}</p>
                        </div>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="info-content">
                            <h4>Correo Electrónico</h4>
                            <p>{{ $maestroData->email }}</p>
                        </div>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fas fa-university"></i>
                        </div>
                        <div class="info-content">
                            <h4>Coordinación</h4>
                            <p>{{ $maestroData->coordinacion->nombre ?? 'No asignada' }}</p>
                        </div>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fas fa-calendar-plus"></i>
                        </div>
                        <div class="info-content">
                            <h4>Fecha de Registro</h4>
                            <p>{{ $maestroData->created_at->format('d/m/Y') }}</p>
                        </div>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fas fa-user-check"></i>
                        </div>
                        <div class="info-content">
                            <h4>Estado</h4>
                            <p style="color: var(--success-color); font-weight: 700;">Activo</p>
                        </div>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fas fa-chart-bar"></i>
                        </div>
                        <div class="info-content">
                            <h4>Progreso de Documentos</h4>
                            <p style="color: var(--primary); font-weight: 700;">{{ $porcentaje }}% Completado</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ACTIVIDADES RECIENTES -->
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
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Navegación del sidebar
            document.querySelectorAll('.menu-item').forEach(item => {
                item.addEventListener('click', function(e) {
                    if (this.getAttribute('href') && this.getAttribute('href').startsWith('#')) {
                        e.preventDefault();
                        const targetId = this.getAttribute('href').substring(1);
                        const targetSection = document.getElementById(targetId);
                        
                        if (targetSection) {
                            document.querySelectorAll('.menu-item').forEach(i => {
                                i.classList.remove('active');
                            });
                            this.classList.add('active');
                            targetSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
                        }
                    }
                });
            });
        });
        
        function scrollToSection(sectionId) {
            const section = document.getElementById(sectionId);
            if (section) {
                section.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        }
    </script>
</body>
</html>