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
            font-size: 18px; /* Aumentado de 14px a 18px */
            margin-bottom: 2px;
            font-weight: 700; /* Más negrita */
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

        /* NUEVO DISEÑO COMPACTO PARA DOCUMENTOS */
        .documentos-unificados {
            display: grid;
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .documento-unificado-card {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border-color);
            transition: var(--transition);
        }

        .documento-unificado-card:hover {
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        /* HEADER COMPACTO DEL DOCUMENTO */
        .doc-header-unificado {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .doc-title-container {
            display: flex;
            align-items: center;
            gap: 12px;
            flex: 1;
        }

        .doc-icon-container {
            width: 45px;
            height: 45px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            color: white;
            flex-shrink: 0;
        }

        .icon-aprobado {
            background: linear-gradient(135deg, var(--success-color), #35c04a);
        }

        .icon-rechazado {
            background: linear-gradient(135deg, var(--danger-color), #e25c6c);
        }

        .icon-pendiente {
            background: linear-gradient(135deg, var(--warning-color), #ffd54f);
        }

        .icon-faltante {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
        }

        .doc-info-unificado {
            flex: 1;
        }

        .doc-name-unificado {
            font-size: 16px;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 4px;
            line-height: 1.2;
        }

        .doc-description-unificado {
            color: var(--text-muted);
            font-size: 13px;
            line-height: 1.4;
        }

        .doc-status-badge {
            padding: 6px 12px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            margin-left: 10px;
            flex-shrink: 0;
        }

        .status-aprobado {
            background-color: rgba(40, 167, 69, 0.12);
            color: var(--success-color);
            border: 1px solid rgba(40, 167, 69, 0.2);
        }

        .status-rechazado {
            background-color: rgba(220, 53, 69, 0.12);
            color: var(--danger-color);
            border: 1px solid rgba(220, 53, 69, 0.2);
        }

        .status-pendiente {
            background-color: rgba(255, 193, 7, 0.12);
            color: var(--warning-color);
            border: 1px solid rgba(255, 193, 7, 0.2);
        }

        /* CONTENIDO COMPACTO DEL DOCUMENTO */
        .doc-content-unificado {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 15px;
        }

        @media (max-width: 992px) {
            .doc-content-unificado {
                grid-template-columns: 1fr;
                gap: 15px;
            }
        }

        /* ESTADO ACTUAL - COMPACTO CON BOTONES */
        .doc-estado-actual {
            background-color: var(--light-bg);
            border-radius: 8px;
            padding: 15px;
        }

        .doc-estado-actual h5 {
            font-size: 14px;
            margin-bottom: 10px;
            color: var(--primary);
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .estado-info {
            background: white;
            border-radius: 6px;
            padding: 12px;
            margin-bottom: 10px;
            border: 1px solid var(--border-color);
        }

        .info-row {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 8px;
            font-size: 13px;
        }

        .info-row:last-child {
            margin-bottom: 0;
        }

        .info-row i {
            color: var(--primary);
            width: 16px;
            text-align: center;
            font-size: 13px;
        }

        /* BOTONES DE ACCIÓN PARA DOCUMENTOS */
        .doc-action-buttons {
            display: flex;
            gap: 8px;
            margin-top: 12px;
            flex-wrap: wrap;
        }

        /* SUBIDA COMPACTA - BOTÓN PEQUEÑO */
        .doc-subida-archivo {
            background-color: var(--light-bg);
            border-radius: 8px;
            padding: 15px;
        }

        .doc-subida-archivo h5 {
            font-size: 14px;
            margin-bottom: 10px;
            color: var(--primary);
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .upload-area-mini {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
        }

        .upload-info {
            flex: 1;
        }

        .upload-info p {
            color: var(--text-muted);
            font-size: 12px;
            margin-bottom: 4px;
            line-height: 1.3;
        }

        .upload-info span {
            font-size: 11px;
            color: var(--text-muted);
            display: block;
        }

        .upload-btn-container {
            flex-shrink: 0;
        }

        /* BOTONES COMPACTOS */
        .btn {
            padding: 8px 16px;
            border-radius: 6px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            font-size: 13px;
            white-space: nowrap;
        }

        .btn-primary {
            background-color: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--primary-light);
            transform: translateY(-1px);
            box-shadow: 0 3px 8px rgba(7, 68, 182, 0.2);
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 12px;
        }

        .btn-outline {
            background-color: transparent;
            border: 1px solid var(--border-color);
            color: var(--text-muted);
        }

        .btn-outline:hover {
            background-color: var(--light-bg);
            border-color: var(--primary);
            color: var(--primary);
        }

        .btn-success {
            background-color: var(--success-color);
            color: white;
        }

        .btn-success:hover {
            background-color: #218838;
            transform: translateY(-1px);
            box-shadow: 0 3px 8px rgba(40, 167, 69, 0.2);
        }

        .btn-warning {
            background-color: var(--warning-color);
            color: #333;
        }

        .btn-warning:hover {
            background-color: #e0a800;
            transform: translateY(-1px);
            box-shadow: 0 3px 8px rgba(255, 193, 7, 0.2);
        }

        .selected-file-info {
            margin-top: 10px;
            padding: 8px 10px;
            background: linear-gradient(135deg, var(--primary-light), var(--primary));
            color: white;
            border-radius: 6px;
            font-size: 12px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            animation: fadeIn 0.3s ease;
        }

        .selected-file-info button {
            background: none;
            border: none;
            color: white;
            cursor: pointer;
            padding: 0 4px;
            font-size: 11px;
        }

        /* BOTÓN DE SUBIR DOCUMENTOS - PEQUEÑO Y A LA DERECHA */
        .submit-documents-container {
            display: flex;
            justify-content: flex-end;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid var(--light-bg);
        }

        .submit-documents-btn {
            padding: 10px 24px;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 700;
            font-size: 14px;
            cursor: pointer;
            transition: var(--transition);
            box-shadow: 0 3px 10px rgba(7, 68, 182, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .submit-documents-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(7, 68, 182, 0.4);
        }

        /* OBSERVACIONES */
        .observaciones-box {
            background-color: #fff3cd;
            border-left: 3px solid var(--warning-color);
            padding: 10px;
            border-radius: 6px;
            margin-top: 10px;
            font-size: 12px;
        }

        .observaciones-box strong {
            display: flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 5px;
            color: #856404;
            font-size: 12px;
        }

        /* RESPONSIVE */
        @media (max-width: 1200px) {
            .sidebar {
                width: 250px;
            }
            .main-content {
                margin-left: 250px;
            }
        }

        @media (max-width: 992px) {
            .sidebar {
                width: 70px;
            }
            .sidebar-header h2 span, 
            .menu-item span, 
            .menu-item .badge,
            .sidebar-footer p {
                display: none;
            }
            .sidebar-header {
                padding: 15px 10px;
            }
            .logo-img-sidebar {
                width: 50px;
                margin-bottom: 10px;
            }
            .menu-item {
                justify-content: center;
                padding: 12px;
            }
            .menu-item i {
                margin-right: 0;
                font-size: 18px;
            }
            .main-content {
                margin-left: 70px;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                display: none;
            }
            .main-content {
                margin-left: 0;
            }
            .header {
                height: auto;
                padding: 15px;
                flex-direction: column;
                gap: 15px;
            }
            .logo-img {
                height: 35px;
            }
            .cards-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            .section {
                padding: 20px;
            }
            .doc-header-unificado {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
            .doc-status-badge {
                margin-left: 0;
                align-self: flex-start;
            }
            .user-info h4 {
                font-size: 16px; /* Un poco más pequeño en móviles */
            }
        }

        @media (max-width: 576px) {
            .cards-grid {
                grid-template-columns: 1fr;
            }
            .content-wrapper {
                padding: 15px;
            }
            .section {
                padding: 15px;
            }
            .profile-info {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- SIDEBAR BLANCO CON LÍNEA AZUL -->
    <div class="sidebar">
        <div class="sidebar-header">
            <img src="{{ asset('img/logo_iufim.png') }}" alt="Logo IUFIM" class="logo-img-sidebar">
            <h2><i class="fas fa-chalkboard-teacher"></i> <span>GEPROC</span></h2>
        </div>
        
        <div class="sidebar-menu">
            <a href="#dashboard" class="menu-item active">
                <i class="fas fa-tachometer-alt"></i>
                <span>Inicio</span>
            </a>
            <a href="#perfil" class="menu-item">
                <i class="fas fa-user"></i>
                <span>Mi Perfil</span>
            </a>
            <a href="#documentos" class="menu-item">
                <i class="fas fa-folder"></i>
                <span>Mis Documentos</span>
            </a>
            <a href="{{ route('maestros.grados.create') }}" class="menu-item">
                <i class="fas fa-chart-bar"></i>
                
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
            <!-- MENSAJES -->
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
                $documentosParaVista = $documentosParaVista ?? [];
                $tiposDocumentos = $tiposDocumentos ?? [];
                $actividadesRecientes = $actividadesRecientes ?? [];
            @endphp

            <!-- PERIODO HABILITADO -->
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
                            <strong>Estado:</strong> Activo para subir documentos
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
            <!-- ESTADÍSTICAS -->
            <div class="cards-grid">
                <div class="card">
                    <div class="card-header">
                        <div class="card-icon req">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <div class="card-title">
                            <h3>Documentos Requeridos</h3>
                            <div class="card-value">{{ $totalRequeridos }}</div>
                        </div>
                    </div>
                    <div class="card-footer">Total requerido</div>
                </div>
                
                <div class="card">
                    <div class="card-header">
                        <div class="card-icon sub">
                            <i class="fas fa-upload"></i>
                        </div>
                        <div class="card-title">
                            <h3>Documentos Subidos</h3>
                            <div class="card-value">{{ $totalSubidos }}</div>
                        </div>
                    </div>
                    <div class="card-footer">En período actual</div>
                </div>
                
                <div class="card">
                    <div class="card-header">
                        <div class="card-icon fal">
                            <i class="fas fa-exclamation-circle"></i>
                        </div>
                        <div class="card-title">
                            <h3>Documentos Faltantes</h3>
                            <div class="card-value">{{ $faltantes }}</div>
                        </div>
                    </div>
                    <div class="card-footer">Por subir</div>
                </div>
                
                <div class="card">
                    <div class="card-header">
                        <div class="card-icon pro">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="card-title">
                            <h3>Progreso General</h3>
                            <div class="card-value">{{ $porcentaje }}%</div>
                        </div>
                    </div>
                    <div class="card-footer">Completado</div>
                </div>
            </div>

            <!-- INFORMACIÓN DEL PERFIL -->
            <div class="section" id="perfil">
                <div class="section-header">
                    <div class="section-title">
                        <i class="fas fa-user-circle"></i>
                        <span>Información del Profesor</span>
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
                </div>
            </div>

            <!-- ACTIVIDADES RECIENTES -->
            @if(count($actividadesRecientes) > 0)
            <div class="section">
                <div class="section-header">
                    <div class="section-title">
                        <i class="fas fa-file-alt me-2"></i>
                        <span>Estado de documentos</span>
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

            <!-- SECCIÓN UNIFICADA: DOCUMENTOS REQUERIDOS Y SUBIDA -->
            <div class="section" id="documentos">
                <div class="section-header">
                    <div class="section-title">
                        <i class="fas fa-file-alt"></i>
                        <span>Gestión de Documentos</span>
                    </div>
                    <div style="font-size: 13px; color: var(--text-muted);">
                        {{ count($documentosParaVista) }} documentos
                    </div>
                </div>
                
                @if(!$hayPeriodoHabilitado)
                <div style="text-align: center; padding: 30px 20px; background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); border-radius: 10px; border: 2px dashed var(--border-color); margin-bottom: 20px;">
                    <i class="fas fa-lock" style="font-size: 40px; color: var(--danger-color); margin-bottom: 15px;"></i>
                    <h3 style="color: var(--danger-color); margin-bottom: 10px; font-size: 18px;">Subida Bloqueada</h3>
                    <p style="color: var(--text-muted); font-size: 14px; max-width: 500px; margin: 0 auto;">
                        No hay ningún período académico habilitado para subir documentos.
                    </p>
                </div>
                @endif
                
                @if(count($documentosParaVista) > 0)
                <form action="{{ route('profesor.subir-documentos') }}" method="POST" enctype="multipart/form-data" id="uploadForm">
                    @csrf
                    <input type="hidden" name="periodo_id" value="{{ $periodoHabilitado->id ?? '' }}">
                    
                    <div class="documentos-unificados">
                        @foreach($documentosParaVista as $documento)
                        <div class="documento-unificado-card" id="documento-{{ $documento['tipo'] }}">
                            <div class="doc-header-unificado">
                                <div class="doc-title-container">
                                    <div class="doc-icon-container 
                                        @if($documento['estado'] == 'aprobado') icon-aprobado
                                        @elseif($documento['estado'] == 'rechazado') icon-rechazado
                                        @elseif($documento['estado'] == 'pendiente') icon-pendiente
                                        @else icon-faltante
                                        @endif">
                                        <i class="fas fa-{{ $documento['icono'] }}"></i>
                                    </div>
                                    <div class="doc-info-unificado">
                                        <div class="doc-name-unificado">{{ $documento['nombre'] }}</div>
                                        <div class="doc-description-unificado">{{ $documento['descripcion'] }}</div>
                                    </div>
                                </div>
                                <div class="doc-status-badge status-{{ $documento['estado'] }}">
                                    @if($documento['estado'] == 'aprobado')
                                    <i class="fas fa-check-circle"></i>
                                    @elseif($documento['estado'] == 'rechazado')
                                    <i class="fas fa-times-circle"></i>
                                    @elseif($documento['estado'] == 'pendiente')
                                    <i class="fas fa-clock"></i>
                                    @else
                                    <i class="fas fa-exclamation-circle"></i>
                                    @endif
                                    <span>{{ ucfirst($documento['estado']) }}</span>
                                </div>
                            </div>
                            
                            <div class="doc-content-unificado">
                                <!-- ESTADO ACTUAL CON BOTONES -->
                                <div class="doc-estado-actual">
                                    <h5><i class="fas fa-info-circle"></i> Estado Actual</h5>
                                    
                                    @if($documento['tiene_documento'])
                                    <div class="estado-info">
                                        <div class="info-row">
                                            <i class="fas fa-file"></i>
                                            <span><strong>Archivo:</strong> {{ $documento['archivo'] ?? 'Sin nombre' }}</span>
                                        </div>
                                        <div class="info-row">
                                            <i class="fas fa-calendar"></i>
                                            <span><strong>Subido:</strong> {{ $documento['fecha_subida'] ? $documento['fecha_subida']->format('d/m/Y H:i') : 'No disponible' }}</span>
                                        </div>
                                        @if($documento['estado'] == 'aprobado' && isset($documento['aprobado_por']))
                                        <div class="info-row">
                                            <i class="fas fa-user-check"></i>
                                            <span><strong>Aprobado por:</strong> {{ $documento['aprobado_por'] }}</span>
                                        </div>
                                        @endif
                                    </div>
                                    
                                    @if($documento['estado'] == 'rechazado' && $documento['observaciones'])
                                    <div class="observaciones-box">
                                        <strong><i class="fas fa-comment-dots"></i> Observaciones:</strong>
                                        <p style="margin: 0;">{{ $documento['observaciones'] }}</p>
                                    </div>
                                    @endif
                                    
                                    <!-- BOTONES DE ACCIÓN PARA DOCUMENTOS EXISTENTES -->
                                    <div class="doc-action-buttons">
                                        @if($documento['tiene_documento'])
                                            <button type="button" class="btn btn-outline btn-sm" onclick="verDocumento('{{ $documento['documento_id'] ?? '' }}')">
                                                <i class="fas fa-eye"></i> Ver
                                            </button>
                                            <button type="button" class="btn btn-primary btn-sm" onclick="descargarDocumento('{{ $documento['documento_id'] ?? '' }}')">
                                                <i class="fas fa-download"></i> Descargar
                                            </button>
                                            
                                            <!-- Mostrar botón Resubir solo para documentos aprobados o rechazados -->
                                            @if(($documento['estado'] == 'aprobado' || $documento['estado'] == 'rechazado') && $hayPeriodoHabilitado)
                                            <button type="button" class="btn btn-warning btn-sm" onclick="selectFile('{{ $documento['tipo'] }}')">
                                                <i class="fas fa-upload"></i> Resubir
                                            </button>
                                            @endif
                                        @else
                                        <div style="text-align: center; padding: 15px; background: white; border-radius: 6px; border: 2px dashed var(--danger-light);">
                                            <i class="fas fa-file-exclamation" style="font-size: 28px; color: var(--danger-color); margin-bottom: 10px;"></i>
                                            <p style="color: var(--danger-color); font-weight: 600; margin: 0 0 8px 0; font-size: 13px;">
                                                Documento no subido
                                            </p>
                                            <p style="color: var(--text-muted); font-size: 12px; margin: 0;">
                                                Este documento es requerido.
                                            </p>
                                        </div>
                                        @endif
                                    </div>
                                    @else
                                    <div style="text-align: center; padding: 15px; background: white; border-radius: 6px; border: 2px dashed var(--danger-light);">
                                        <i class="fas fa-file-exclamation" style="font-size: 28px; color: var(--danger-color); margin-bottom: 10px;"></i>
                                        <p style="color: var(--danger-color); font-weight: 600; margin: 0 0 8px 0; font-size: 13px;">
                                            Documento no subido
                                        </p>
                                        <p style="color: var(--text-muted); font-size: 12px; margin: 0;">
                                            Este documento es requerido.
                                        </p>
                                    </div>
                                    @endif
                                </div>
                                
                                <!-- SUBIDA DE ARCHIVO COMPACTA -->
                                @if($hayPeriodoHabilitado)
                                <div class="doc-subida-archivo">
                                    <h5><i class="fas fa-cloud-upload-alt"></i> Subir Documento</h5>
                                    <div class="upload-area-mini">
                                        <div class="upload-info">
                                            <p>Selecciona un archivo para {{ $documento['tiene_documento'] ? 'actualizar' : 'subir' }} este documento.</p>
                                            <span>PDF, Word, JPG o PNG (máx. 10MB)</span>
                                        </div>
                                        <div class="upload-btn-container">
                                            <button type="button" class="btn btn-primary btn-sm" onclick="selectFile('{{ $documento['tipo'] }}')">
                                                <i class="fas fa-upload"></i> Seleccionar
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <input type="file" 
                                           id="{{ $documento['tipo'] }}" 
                                           name="{{ $documento['tipo'] }}"
                                           accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"
                                           style="display: none;"
                                           onchange="updateFileName('{{ $documento['tipo'] }}', this)">
                                    
                                    <div id="file-name-{{ $documento['tipo'] }}" class="selected-file-info" style="display: none;">
                                        <span><i class="fas fa-file"></i> <strong id="file-name-text-{{ $documento['tipo'] }}"></strong></span>
                                        <button type="button" onclick="clearFile('{{ $documento['tipo'] }}')">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                    @if($hayPeriodoHabilitado && count($documentosParaVista) > 0)
                    <div class="submit-documents-container">
                        <button type="submit" class="submit-documents-btn" id="submitBtn">
                            <i class="fas fa-upload"></i> Subir Documentos Seleccionados
                        </button>
                    </div>
                    @endif
                </form>
                @else
                <div style="text-align: center; padding: 30px 20px; background: var(--light-bg); border-radius: 10px;">
                    <i class="fas fa-folder-open" style="font-size: 40px; color: var(--text-muted); margin-bottom: 15px;"></i>
                    <h4 style="color: var(--text-muted); margin-bottom: 10px; font-size: 16px;">No hay documentos configurados</h4>
                    <p style="color: var(--text-muted); max-width: 400px; margin: 0 auto; font-size: 13px;">
                        No se han configurado documentos para tu coordinación.
                    </p>
                </div>
                @endif
            </div>
            @endif
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Manejar la selección de archivos
            window.updateFileName = function(tipo, input) {
                const fileNameDisplay = document.getElementById('file-name-' + tipo);
                const fileNameText = document.getElementById('file-name-text-' + tipo);
                
                if (input.files.length > 0) {
                    fileNameText.textContent = input.files[0].name;
                    fileNameDisplay.style.display = 'flex';
                    
                    // Resaltar el card
                    const card = document.getElementById('documento-' + tipo);
                    if (card) {
                        card.style.boxShadow = '0 0 0 2px rgba(7, 68, 182, 0.3), 0 5px 15px rgba(7, 68, 182, 0.15)';
                        card.style.borderColor = 'var(--primary)';
                        
                        setTimeout(() => {
                            card.style.boxShadow = '0 3px 10px rgba(0, 0, 0, 0.05)';
                            card.style.borderColor = 'var(--border-color)';
                        }, 2000);
                    }
                }
            };
            
            window.clearFile = function(tipo) {
                const input = document.getElementById(tipo);
                const fileNameDisplay = document.getElementById('file-name-' + tipo);
                
                input.value = '';
                fileNameDisplay.style.display = 'none';
            };
            
            window.selectFile = function(tipo) {
                const input = document.getElementById(tipo);
                if (input) {
                    input.click();
                }
            };
            
            // Validar formulario de subida
            const uploadForm = document.getElementById('uploadForm');
            if (uploadForm) {
                uploadForm.addEventListener('submit', function(e) {
                    const submitBtn = document.getElementById('submitBtn');
                    const fileInputs = this.querySelectorAll('input[type="file"]');
                    let hasFile = false;
                    
                    fileInputs.forEach(input => {
                        if (input.files.length > 0) {
                            hasFile = true;
                        }
                    });
                    
                    if (!hasFile) {
                        e.preventDefault();
                        alert('Por favor, selecciona al menos un documento para subir.');
                        return false;
                    }
                    
                    if (submitBtn) {
                        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Subiendo...';
                        submitBtn.disabled = true;
                    }
                });
            }
            
            // Funciones para ver y descargar documentos
            window.verDocumento = function(documentoId) {
                if (documentoId) {
                    window.open("{{ url('documentos/ver') }}/" + documentoId, '_blank');
                } else {
                    alert('No se puede ver el documento. ID no disponible.');
                }
            };
            
            window.descargarDocumento = function(documentoId) {
                if (documentoId) {
                    window.location.href = "{{ url('documentos/descargar') }}/" + documentoId;
                } else {
                    alert('No se puede descargar el documento. ID no disponible.');
                }
            };
            
            // Navegación del sidebar
            document.querySelectorAll('.menu-item').forEach(item => {
                item.addEventListener('click', function(e) {
                    if (this.getAttribute('href').startsWith('#')) {
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
    </script>
</body>
</html>