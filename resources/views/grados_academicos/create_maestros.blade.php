<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grados Académicos - Sistema GEPROC</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
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
            --card-shadow: 0 5px 20px rgba(7, 68, 182, 0.08);
            --card-shadow-hover: 0 10px 30px rgba(7, 68, 182, 0.12);
            --transition: all 0.3s ease;
            
            /* Nuevos colores para tarjetas - Solo 3 colores principales */
            --green-color: #10b981;
            --green-light: #d1fae5;
            --green-dark: #059669;
            
            --blue-color: #3b82f6;
            --blue-light: #dbeafe;
            --blue-dark: #2563eb;
            
            --orange-color: #f97316;
            --orange-light: #ffedd5;
            --orange-dark: #ea580c;
            
            --border-radius: 12px;
            --sidebar-width: 280px;
            --header-height: 80px;
            --gradient-primary: linear-gradient(135deg, #0744b6ff 0%, #3a6bd3 100%);
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

        /* ===== MENÚ DE LA PRIMERA VISTA - EXACTAMENTE IGUAL ===== */
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
            color: var(--orange-dark);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(239, 68, 68, 0.15);
        }

        .logout-button i {
            font-size: 16px;
        }

        /* ===== MAIN CONTENT ===== */
        .main-content {
            flex: 1;
            transition: var(--transition);
        }

        .content-wrapper {
            padding: 30px 35px;
            max-width: 100%;
        }

        /* ===== ESTILOS DEL CUERPO MEJORADOS - MÁS SOBRIOS ===== */
        .dashboard-card {
            background: white;
            border-radius: 16px;
            padding: 30px;
            margin-bottom: 25px;
            box-shadow: var(--card-shadow);
            border: 2px solid var(--border-color);
            transition: var(--transition);
        }

        .dashboard-card:hover {
            box-shadow: var(--card-shadow-hover);
        }

        .card-header-flex {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 25px;
            padding-bottom: 20px;
            border-bottom: 2px solid var(--light-bg);
        }

        .card-title {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 24px;
            color: var(--primary);
            font-weight: 700;
            margin: 0;
        }

        .card-title i {
            font-size: 28px;
            color: var(--primary);
        }

        /* ===== BOTÓN AGREGAR - ESTILO MÁS SOBRIO ===== */
        .btn-add-grado {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 14px 28px;
            background: var(--gradient-primary);
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: 700;
            font-size: 15px;
            cursor: pointer;
            transition: var(--transition);
            box-shadow: 0 5px 15px rgba(7, 68, 182, 0.25);
            text-decoration: none;
            letter-spacing: 0.3px;
        }

        .btn-add-grado:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(7, 68, 182, 0.35);
            color: white;
        }

        .btn-add-grado i {
            font-size: 16px;
        }

        /* ===== ESTADÍSTICAS - COLORES SUAVES ===== */
        .stats-compact {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card-compact {
            background: white;
            border-radius: 14px;
            padding: 20px;
            box-shadow: var(--card-shadow);
            border: 2px solid var(--border-color);
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }

        .stat-card-compact::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
        }

        /* Colores diferentes para cada estadística */
        .stat-card-compact:nth-child(1)::before {
            background: var(--gradient-primary);
        }
        .stat-card-compact:nth-child(2)::before {
            background: var(--orange-color);
        }
        .stat-card-compact:nth-child(3)::before {
            background: var(--blue-color);
        }
        .stat-card-compact:nth-child(4)::before {
            background: var(--green-color);
        }

        .stat-card-compact:hover {
            transform: translateY(-4px);
            box-shadow: var(--card-shadow-hover);
        }

        .stat-icon-compact {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
            font-size: 22px;
            color: white;
        }

        .stat-card-compact:nth-child(1) .stat-icon-compact {
            background: var(--gradient-primary);
        }
        .stat-card-compact:nth-child(2) .stat-icon-compact {
            background: var(--orange-color);
        }
        .stat-card-compact:nth-child(3) .stat-icon-compact {
            background: var(--blue-color);
        }
        .stat-card-compact:nth-child(4) .stat-icon-compact {
            background: var(--green-color);
        }

        .stat-value-compact {
            font-size: 32px;
            font-weight: 800;
            color: #1e293b;
            line-height: 1;
            margin-bottom: 5px;
        }

        .stat-label-compact {
            color: var(--text-muted);
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* ===== FORM CARD - ESTILO MÁS LIMPIO ===== */
        .form-card {
            background: white;
            border-radius: 16px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: var(--card-shadow);
            border: 2px solid var(--border-color);
            transition: var(--transition);
        }

        .form-card:hover {
            box-shadow: var(--card-shadow-hover);
        }

        .form-header {
            border-bottom: 2px solid var(--light-bg);
            padding-bottom: 18px;
            margin-bottom: 25px;
        }

        .form-title {
            color: var(--primary);
            font-weight: 700;
            font-size: 20px;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .form-title i {
            font-size: 22px;
            color: var(--primary);
        }

        .form-label {
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .required::after {
            content: " *";
            color: var(--orange-dark);
            font-weight: 700;
        }

        .form-control, .form-select {
            border: 2px solid var(--border-color);
            border-radius: 10px;
            padding: 12px 16px;
            font-size: 14px;
            transition: var(--transition);
            background: white;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(7, 68, 182, 0.08);
            outline: none;
        }

        .btn-success {
            background: linear-gradient(135deg, var(--green-color) 0%, var(--green-dark) 100%);
            border: none;
            padding: 12px 28px;
            font-weight: 600;
            font-size: 15px;
            border-radius: 10px;
            color: white;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 5px 15px rgba(16, 185, 129, 0.2);
        }

        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
            color: white;
        }

        .btn-outline {
            background: white;
            border: 2px solid var(--border-color);
            color: var(--text-muted);
            padding: 12px 28px;
            font-weight: 600;
            font-size: 15px;
            border-radius: 10px;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .btn-outline:hover {
            background: var(--light-bg);
            border-color: var(--primary);
            color: var(--primary);
            transform: translateY(-2px);
        }

        /* ===== FILE PREVIEW ===== */
        .file-preview {
            background: var(--green-light);
            border: 2px solid var(--green-color);
            border-radius: 10px;
            padding: 12px 16px;
            margin-top: 12px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            animation: slideIn 0.3s ease;
            color: var(--green-dark);
            font-weight: 600;
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

        .btn-outline-light {
            background: white;
            border: 1.5px solid var(--green-light);
            color: var(--green-dark);
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 13px;
            transition: var(--transition);
            font-weight: 600;
        }

        .btn-outline-light:hover {
            background: var(--green-color);
            color: white;
            border-color: var(--green-color);
        }

        /* ===== SECCIÓN DE GRADOS ===== */
        .grados-container {
            margin-top: 30px;
            padding-top: 25px;
            border-top: 2px solid var(--light-bg);
        }

        .section-title {
            font-size: 20px;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .section-title i {
            font-size: 22px;
            color: var(--primary);
        }

        /* ===== GRADO CARD - MÁS PEQUEÑAS Y SOLO COLOR VERDE PARA INFORMACIÓN ===== */
        .grados-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 20px;
        }

        .grado-card-compact {
            background: white;
            border-radius: 12px;
            padding: 18px;
            box-shadow: var(--card-shadow);
            border: 2px solid var(--border-color);
            border-left: 5px solid;
            transition: var(--transition);
            position: relative;
            height: fit-content;
        }

        .grado-card-compact:hover {
            transform: translateY(-3px);
            box-shadow: var(--card-shadow-hover);
        }

        /* Solo 3 colores para los bordes izquierdos */
        .grado-card-compact[data-nivel="Doctorado"] {
            border-left-color: var(--orange-color);
        }
        
        .grado-card-compact[data-nivel="Maestría"] {
            border-left-color: var(--blue-color);
        }
        
        .grado-card-compact[data-nivel="Especialidad"],
        .grado-card-compact[data-nivel="Licenciatura"] {
            border-left-color: var(--green-color);
        }

        .grado-header-compact {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 12px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .grado-title-compact {
            font-weight: 700;
            color: #1e293b;
            font-size: 16px;
            margin-bottom: 5px;
            line-height: 1.3;
        }

        .grado-nivel-compact {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 50px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        /* Colores para los badges de nivel (usando los 3 colores) */
        .grado-card-compact[data-nivel="Doctorado"] .grado-nivel-compact {
            background: var(--orange-light);
            color: var(--orange-dark);
        }
        
        .grado-card-compact[data-nivel="Maestría"] .grado-nivel-compact {
            background: var(--blue-light);
            color: var(--blue-dark);
        }
        
        .grado-card-compact[data-nivel="Especialidad"] .grado-nivel-compact,
        .grado-card-compact[data-nivel="Licenciatura"] .grado-nivel-compact {
            background: var(--green-light);
            color: var(--green-dark);
        }

        .action-buttons-compact {
            display: flex;
            gap: 8px;
        }

        .btn-action-sm {
            padding: 6px 12px;
            font-size: 12px;
            border-radius: 6px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: var(--transition);
            font-weight: 600;
            border: none;
            cursor: pointer;
        }

        .btn-action-sm.btn-outline {
            border: 1.5px solid var(--border-color);
            background: white;
            color: var(--text-muted);
            text-decoration: none;
        }

        .btn-action-sm.btn-outline:hover {
            background: var(--blue-light);
            border-color: var(--blue-color);
            color: var(--blue-dark);
        }

        .btn-action-sm.btn-danger {
            background: linear-gradient(135deg, #f97316 0%, #ea580c 100%);
            color: white;
            box-shadow: 0 4px 10px rgba(249, 115, 22, 0.2);
        }

        .btn-action-sm.btn-danger:hover {
            background: linear-gradient(135deg, #ea580c 0%, #c2410c 100%);
            box-shadow: 0 6px 14px rgba(249, 115, 22, 0.3);
            transform: translateY(-2px);
        }

        /* INFORMACIÓN DEL GRADO - TODO EN VERDE */
        .grado-info-compact {
            color: #2d3748;
            font-size: 13px;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 3px 0;
        }

        .grado-info-compact i {
            width: 16px;
            text-align: center;
            color: var(--green-color);
            font-size: 13px;
        }

        .grado-info-compact span {
            color: #4a5568;
            line-height: 1.4;
        }

        .text-primary {
            color: var(--green-dark) !important;
            font-weight: 600;
            text-decoration: none;
        }

        .text-primary:hover {
            color: var(--green-color) !important;
            text-decoration: underline;
        }

        /* Línea divisoria sutil */
        .grado-divider {
            height: 1px;
            background: linear-gradient(to right, transparent, var(--green-light), transparent);
            margin: 12px 0 10px 0;
        }

        /* ===== EMPTY STATE ===== */
        .empty-state {
            text-align: center;
            padding: 60px 30px;
            background: var(--light-bg);
            border-radius: 16px;
            border: 2px dashed var(--border-color);
        }

        .empty-state i {
            font-size: 60px;
            color: var(--primary);
            margin-bottom: 20px;
        }

        .empty-state h5 {
            color: #1e293b;
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 12px;
        }

        .empty-state p {
            color: var(--text-muted);
            font-size: 15px;
            margin-bottom: 0;
        }

        /* ===== ALERTAS ===== */
        .alert {
            padding: 16px 22px;
            border-radius: 12px;
            margin-bottom: 25px;
            display: flex;
            align-items: flex-start;
            gap: 16px;
            animation: slideIn 0.3s ease;
            border: none;
            border-left: 6px solid;
            font-size: 15px;
            box-shadow: var(--card-shadow);
        }

        .alert-success {
            background: var(--green-light);
            border-color: var(--green-color);
            color: var(--green-dark);
        }

        .alert-danger {
            background: var(--orange-light);
            border-color: var(--orange-color);
            color: var(--orange-dark);
        }

        .alert i {
            font-size: 20px;
        }

        .btn-close {
            background: transparent;
            border: none;
            font-size: 16px;
            cursor: pointer;
            opacity: 0.6;
            transition: var(--transition);
            color: inherit;
            padding: 4px;
        }

        .btn-close:hover {
            opacity: 1;
            transform: scale(1.1);
        }

        /* ===== RESPONSIVE ===== */
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
        }

        @media (max-width: 992px) {
            .stats-compact {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .card-header-flex {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .btn-add-grado {
                width: 100%;
                justify-content: center;
            }
            
            .grados-grid {
                grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            }
        }

        @media (max-width: 768px) {
            .header-left {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
            
            .content-wrapper {
                padding: 15px;
            }
            
            .dashboard-card {
                padding: 20px;
            }
            
            .stats-compact {
                grid-template-columns: 1fr;
                gap: 15px;
            }
            
            .stat-value-compact {
                font-size: 28px;
            }
            
            .grado-header-compact {
                flex-direction: column;
                gap: 10px;
            }
            
            .action-buttons-compact {
                width: 100%;
                justify-content: flex-start;
            }
            
            .header-right {
                flex-wrap: wrap;
                justify-content: flex-end;
            }
            
            .logout-button {
                padding: 10px 20px;
                font-size: 14px;
            }
            
            .grados-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 480px) {
            .content-wrapper {
                padding: 12px;
            }
            
            .dashboard-card {
                padding: 18px;
            }
            
            .card-title {
                font-size: 20px;
            }
            
            .btn-add-grado {
                padding: 12px 20px;
                font-size: 14px;
            }
            
            .form-card {
                padding: 18px;
            }
            
            .form-title {
                font-size: 18px;
            }
            
            .btn-success, .btn-outline {
                width: 100%;
                justify-content: center;
            }
            
            .d-flex {
                flex-direction: column;
                gap: 10px;
            }
            
            .header-logo {
                gap: 12px;
            }
            
            .logo-img-header {
                height: 50px;
            }
        }
    </style>
</head>
<body>
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <!-- HEADER SUPERIOR - EXACTAMENTE IGUAL A LA PRIMERA VISTA -->
        <div class="header">
            <div class="header-left">
                <div class="header-logo">
                    <img src="{{ asset('img/logo_iufim.png') }}" alt="Logo IUFIM" class="logo-img-header">
                </div>
                <div class="header-nav">
                    <a href="{{ route('profesor.dashboard') }}" class="nav-link">
                        <i class="fas fa-home"></i> Inicio
                    </a>
                    <a href="{{ route('profesor.documentos') }}" class="nav-link">
                        <i class="fas fa-folder"></i> Documentos
                    </a>
                    <a href="{{ route('maestros.grados.create') }}" class="nav-link active">
                        <i class="fas fa-graduation-cap"></i> Grados
                    </a>
                    <a href="{{ route('profesor.dashboard') }}#perfil" class="nav-link">
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
        <div class="content-wrapper">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle"></i>
                    <div style="flex: 1;">{{ session('success') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle"></i>
                    <div style="flex: 1;">{{ session('error') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif

            <!-- Dashboard de Grados -->
            <div class="dashboard-card">
                <div class="card-header-flex">
                    <div class="card-title">
                        <i class="fas fa-graduation-cap"></i> Mis Grados Académicos
                    </div>
                    
                    <button type="button" class="btn-add-grado" id="toggleFormBtn">
                        <i class="fas fa-plus-circle"></i> Agregar Grado
                    </button>
                </div>
                
                @php
                    $totalGrados = $gradosAcademicos->count();
                    $doctorados = $gradosAcademicos->where('nivel', 'Doctorado')->count();
                    $maestrias = $gradosAcademicos->where('nivel', 'Maestría')->count();
                    $licenciaturas = $gradosAcademicos->where('nivel', 'Licenciatura')->count();
                    $especialidades = $gradosAcademicos->where('nivel', 'Especialidad')->count();
                @endphp
                
                <div class="stats-compact">
                    <div class="stat-card-compact">
                        <div class="stat-icon-compact">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <div class="stat-value-compact">{{ $totalGrados }}</div>
                        <div class="stat-label-compact">Total de Grados</div>
                    </div>
                    
                    <div class="stat-card-compact">
                        <div class="stat-icon-compact">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <div class="stat-value-compact">{{ $doctorados }}</div>
                        <div class="stat-label-compact">Doctorados</div>
                    </div>
                    
                    <div class="stat-card-compact">
                        <div class="stat-icon-compact">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <div class="stat-value-compact">{{ $maestrias }}</div>
                        <div class="stat-label-compact">Maestrías</div>
                    </div>
                    
                    <div class="stat-card-compact">
                        <div class="stat-icon-compact">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <div class="stat-value-compact">{{ $licenciaturas + $especialidades }}</div>
                        <div class="stat-label-compact">Lic/Esp</div>
                    </div>
                </div>

                <!-- Formulario (oculto inicialmente) -->
                <div class="form-card" id="gradoFormContainer" style="display: none;">
                    <div class="form-header">
                        <h5 class="form-title">
                            <i class="fas fa-plus-circle"></i> Agregar Nuevo Grado Académico
                        </h5>
                    </div>
                    
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-triangle"></i>
                            <div style="flex: 1;">
                                <strong>Error en el formulario</strong>
                                <ul class="mb-0 mt-2" style="font-size: 14px;">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    @endif

                    <form action="{{ route('maestros.grados.store') }}" method="POST" enctype="multipart/form-data" id="gradoForm">
                        @csrf
                        
                        <input type="hidden" name="maestro_id" value="{{ $maestro->id ?? '' }}">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nivel" class="form-label required">Nivel Académico</label>
                                    <select name="nivel" id="nivel" class="form-select @error('nivel') is-invalid @enderror" required>
                                        <option value="">Seleccione un nivel</option>
                                        <option value="Licenciatura" {{ old('nivel') == 'Licenciatura' ? 'selected' : '' }}>Licenciatura</option>
                                        <option value="Especialidad" {{ old('nivel') == 'Especialidad' ? 'selected' : '' }}>Especialidad</option>
                                        <option value="Maestría" {{ old('nivel') == 'Maestría' ? 'selected' : '' }}>Maestría</option>
                                        <option value="Doctorado" {{ old('nivel') == 'Doctorado' ? 'selected' : '' }}>Doctorado</option>
                                    </select>
                                    @error('nivel')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="nombre_titulo" class="form-label required">Nombre del Título</label>
                                    <input type="text" name="nombre_titulo" id="nombre_titulo" 
                                           class="form-control @error('nombre_titulo') is-invalid @enderror" 
                                           value="{{ old('nombre_titulo') }}" 
                                           placeholder="Ej: Licenciado en Sistemas Computacionales" required>
                                    @error('nombre_titulo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="institucion" class="form-label">Institución Educativa</label>
                                    <input type="text" name="institucion" id="institucion" 
                                           class="form-control @error('institucion') is-invalid @enderror" 
                                           value="{{ old('institucion') }}"
                                           placeholder="Ej: Universidad Nacional Autónoma de México">
                                    @error('institucion')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="ano_obtencion" class="form-label">Año de Obtención</label>
                                    <input type="number" name="ano_obtencion" id="ano_obtencion" 
                                           class="form-control @error('ano_obtencion') is-invalid @enderror" 
                                           value="{{ old('ano_obtencion') }}" 
                                           min="1900" max="{{ date('Y') }}"
                                           placeholder="Ej: 2015">
                                    @error('ano_obtencion')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="cedula_profesional" class="form-label">Cédula Profesional</label>
                                    <input type="text" name="cedula_profesional" id="cedula_profesional" 
                                           class="form-control @error('cedula_profesional') is-invalid @enderror" 
                                           value="{{ old('cedula_profesional') }}"
                                           placeholder="Ej: 12345678">
                                    @error('cedula_profesional')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="fecha_expedicion_cedula" class="form-label">Fecha de Expedición</label>
                                    <input type="date" name="fecha_expedicion_cedula" id="fecha_expedicion_cedula" 
                                           class="form-control @error('fecha_expedicion_cedula') is-invalid @enderror" 
                                           value="{{ old('fecha_expedicion_cedula') }}" 
                                           max="{{ date('Y-m-d') }}">
                                    @error('fecha_expedicion_cedula')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="documento" class="form-label">Documento Comprobatorio</label>
                                    <input type="file" name="documento" id="documento" 
                                           class="form-control @error('documento') is-invalid @enderror" 
                                           accept=".pdf,.jpg,.jpeg,.png">
                                    @error('documento')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Formatos: PDF, JPG, PNG. Máx: 2MB</small>
                                    <div id="filePreview" class="file-preview" style="display: none;">
                                        <span><i class="fas fa-file me-2"></i><span id="fileName"></span></span>
                                        <button type="button" class="btn-outline-light" onclick="clearFile()">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="observaciones" class="form-label">Observaciones</label>
                                    <textarea name="observaciones" id="observaciones" 
                                              class="form-control @error('observaciones') is-invalid @enderror" 
                                              rows="2"
                                              placeholder="Observaciones adicionales">{{ old('observaciones') }}</textarea>
                                    @error('observaciones')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-3">
                            <button type="button" class="btn-outline" id="cancelFormBtn">
                                <i class="fas fa-times"></i> Cancelar
                            </button>
                            <button type="submit" class="btn-success">
                                <i class="fas fa-save"></i> Guardar Grado
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Lista de Grados Académicos - Ahora en grid con tarjetas más pequeñas -->
                <div class="grados-container">
                    <div class="section-title">
                        <i class="fas fa-list"></i> Grados Registrados
                    </div>
                    
                    @if($gradosAcademicos->count() > 0)
                        <div class="grados-grid">
                            @foreach($gradosAcademicos as $grado)
                                <div class="grado-card-compact" data-nivel="{{ $grado->nivel }}">
                                    <div class="grado-header-compact">
                                        <div>
                                            <div class="grado-title-compact">{{ Str::limit($grado->nombre_titulo, 40) }}</div>
                                            <span class="grado-nivel-compact">{{ $grado->nivel }}</span>
                                        </div>
                                        <div class="action-buttons-compact">
                                            <a href="{{ route('maestros.grados.edit', $grado->id) }}" class="btn-action-sm btn-outline">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('maestros.grados.destroy', $grado->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-action-sm btn-danger" onclick="return confirm('¿Está seguro de eliminar este grado académico?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    
                                    <div class="grado-divider"></div>
                                    
                                    <div class="grado-info-compact">
                                        <i class="fas fa-university"></i>
                                        <span>{{ $grado->institucion ?? 'Sin institución' }}</span>
                                    </div>
                                    
                                    <div class="grado-info-compact">
                                        <i class="fas fa-calendar"></i>
                                        <span>Año: {{ $grado->ano_obtencion ?? 'N/E' }}</span>
                                    </div>
                                    
                                    @if($grado->cedula_profesional)
                                        <div class="grado-info-compact">
                                            <i class="fas fa-id-card"></i>
                                            <span>Cédula: {{ Str::limit($grado->cedula_profesional, 12) }}</span>
                                        </div>
                                    @endif
                                    
                                    @if($grado->documento)
                                        <div class="grado-info-compact">
                                            <i class="fas fa-file"></i>
                                            <span>
                                                <a href="{{ Storage::url($grado->documento) }}" target="_blank" class="text-primary">
                                                    Ver archivo <i class="fas fa-external-link-alt ms-1" style="font-size: 10px;"></i>
                                                </a>
                                            </span>
                                        </div>
                                    @endif
                                    
                                    @if($grado->observaciones)
                                        <div class="grado-info-compact">
                                            <i class="fas fa-comment"></i>
                                            <span>{{ Str::limit($grado->observaciones, 35) }}</span>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-state">
                            <i class="fas fa-graduation-cap"></i>
                            <h5>No tienes grados académicos registrados</h5>
                            <p>Comienza agregando tu primer grado académico usando el botón superior</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Mostrar/ocultar formulario
        const toggleFormBtn = document.getElementById('toggleFormBtn');
        const gradoFormContainer = document.getElementById('gradoFormContainer');
        const cancelFormBtn = document.getElementById('cancelFormBtn');
        
        toggleFormBtn.addEventListener('click', function() {
            gradoFormContainer.style.display = gradoFormContainer.style.display === 'none' ? 'block' : 'none';
        });
        
        cancelFormBtn.addEventListener('click', function() {
            gradoFormContainer.style.display = 'none';
        });

        // Mostrar nombre del archivo seleccionado
        document.getElementById('documento').addEventListener('change', function(e) {
            const fileInput = e.target;
            const fileName = fileInput.files[0] ? fileInput.files[0].name : '';
            const filePreview = document.getElementById('filePreview');
            const fileNameSpan = document.getElementById('fileName');
            
            if (fileName) {
                fileNameSpan.textContent = fileName;
                filePreview.style.display = 'flex';
            } else {
                filePreview.style.display = 'none';
            }
        });

        // Limpiar selección de archivo
        window.clearFile = function() {
            document.getElementById('documento').value = '';
            document.getElementById('filePreview').style.display = 'none';
        };

        // Validación de año actual
        document.getElementById('ano_obtencion').addEventListener('input', function(e) {
            const currentYear = new Date().getFullYear();
            const inputYear = parseInt(e.target.value);
            
            if (inputYear > currentYear) {
                e.target.setCustomValidity(`El año no puede ser mayor a ${currentYear}`);
            } else {
                e.target.setCustomValidity('');
            }
        });

        // Validación de fecha futura
        document.getElementById('fecha_expedicion_cedula').addEventListener('input', function(e) {
            const selectedDate = new Date(e.target.value);
            const today = new Date();
            
            if (selectedDate > today) {
                e.target.setCustomValidity('La fecha no puede ser futura');
            } else {
                e.target.setCustomValidity('');
            }
        });

        // Validar formulario antes de enviar
        document.getElementById('gradoForm').addEventListener('submit', function(e) {
            const nivel = document.getElementById('nivel').value;
            const titulo = document.getElementById('nombre_titulo').value;
            
            if (!nivel || !titulo) {
                e.preventDefault();
                alert('Por favor complete todos los campos obligatorios marcados con *');
                return false;
            }
            
            return true;
        });

        // Mostrar formulario si hay errores
        document.addEventListener('DOMContentLoaded', function() {
            const hasErrors = {{ $errors->any() ? 'true' : 'false' }};
            if (hasErrors) {
                gradoFormContainer.style.display = 'block';
            }
        });
    </script>
</body>
</html>

