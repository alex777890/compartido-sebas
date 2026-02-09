<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grados Académicos - Sistema GEPROC</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
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
            --header-height: 70px;
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
            font-size: 18px;
            margin-bottom: 2px;
            font-weight: 700;
            color: var(--primary);
        }

        .user-info p {
            font-size: 12px;
            color: var(--text-muted);
        }

        /* Content Area */
        .content-wrapper {
            padding: 20px;
            min-height: calc(100vh - var(--header-height));
        }

        /* Dashboard Cards */
        .dashboard-card {
            background: white;
            border-radius: var(--border-radius);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: var(--card-shadow);
            border: 1px solid var(--border-color);
            transition: var(--transition);
        }

        .dashboard-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--card-shadow-hover);
        }

        .card-title {
            color: var(--primary);
            font-weight: 600;
            font-size: 1.1rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card-title i {
            font-size: 1.2rem;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            border-radius: var(--border-radius);
            padding: 1.25rem;
            box-shadow: var(--card-shadow);
            border-top: 4px solid var(--primary);
            text-align: center;
            transition: var(--transition);
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: var(--card-shadow-hover);
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            font-size: 1.5rem;
            color: white;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary);
            line-height: 1;
            margin-bottom: 5px;
        }

        .stat-label {
            color: var(--text-muted);
            font-size: 0.9rem;
            font-weight: 500;
        }

        /* Grado Card */
        .grado-card {
            background: white;
            border-radius: 10px;
            padding: 1.25rem;
            margin-bottom: 1rem;
            box-shadow: 0 3px 10px rgba(0,0,0,0.05);
            border-left: 4px solid var(--primary);
            transition: var(--transition);
        }

        .grado-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .grado-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 10px;
        }

        .grado-title {
            font-weight: 700;
            color: var(--primary);
            font-size: 1rem;
            margin-bottom: 5px;
        }

        .grado-nivel {
            display: inline-block;
            padding: 3px 10px;
            background-color: rgba(7, 68, 182, 0.1);
            color: var(--primary);
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .grado-info {
            color: var(--text-muted);
            font-size: 0.85rem;
            margin-bottom: 5px;
        }

        .grado-info i {
            width: 16px;
            margin-right: 5px;
            color: var(--primary);
        }

        /* Form Styles */
        .form-card {
            background: white;
            border-radius: var(--border-radius);
            padding: 1.5rem;
            box-shadow: var(--card-shadow);
            border: 1px solid var(--border-color);
            margin-bottom: 2rem;
        }

        .form-header {
            border-bottom: 2px solid var(--light-bg);
            padding-bottom: 1rem;
            margin-bottom: 1.5rem;
        }

        .form-title {
            color: var(--primary);
            font-weight: 600;
            font-size: 1.1rem;
            margin: 0;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.25rem rgba(7, 68, 182, 0.15);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            border: none;
            padding: 0.5rem 1.5rem;
            font-weight: 600;
            transition: var(--transition);
            border-radius: 8px;
            font-size: 0.9rem;
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 5px 15px rgba(7, 68, 182, 0.3);
            background: linear-gradient(135deg, var(--primary-light), var(--primary));
        }

        .btn-sm {
            padding: 0.3rem 0.8rem;
            font-size: 0.8rem;
        }

        .btn-outline {
            background-color: transparent;
            border: 1px solid var(--border-color);
            color: var(--text-muted);
            padding: 0.3rem 0.8rem;
            font-size: 0.8rem;
            border-radius: 6px;
        }

        .btn-outline:hover {
            background-color: var(--light-bg);
            border-color: var(--primary);
            color: var(--primary);
        }

        .btn-danger {
            background-color: var(--danger-color);
            border: none;
            color: white;
            padding: 0.3rem 0.8rem;
            font-size: 0.8rem;
            border-radius: 6px;
        }

        .btn-danger:hover {
            background-color: #c82333;
            transform: translateY(-1px);
        }

        .btn-success {
            background-color: var(--success-color);
            border: none;
            color: white;
            padding: 0.5rem 1.5rem;
            font-size: 0.9rem;
            border-radius: 8px;
        }

        .btn-success:hover {
            background-color: #218838;
            transform: translateY(-1px);
        }

        .form-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }

        .required::after {
            content: " *";
            color: var(--danger-color);
        }

        /* Alert Styles */
        .alert {
            border-radius: 8px;
            border: none;
            box-shadow: 0 3px 10px rgba(0,0,0,0.05);
            margin-bottom: 1.5rem;
        }

        .alert-success {
            background-color: var(--success-light);
            color: #155724;
            border-left: 4px solid var(--success-color);
        }

        .alert-danger {
            background-color: var(--danger-light);
            color: #721c24;
            border-left: 4px solid var(--danger-color);
        }

        .alert-warning {
            background-color: var(--warning-light);
            color: #856404;
            border-left: 4px solid var(--warning-color);
        }

        /* File Preview */
        .file-preview {
            background: linear-gradient(135deg, var(--primary-light), var(--primary));
            color: white;
            border-radius: 6px;
            padding: 8px 12px;
            margin-top: 8px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            animation: fadeIn 0.3s ease;
            font-size: 0.85rem;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-5px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Badge */
        .badge-primary {
            background-color: var(--primary);
            color: white;
            font-size: 0.8rem;
            padding: 0.4rem 0.8rem;
            border-radius: 50px;
            font-weight: 600;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 5px;
            margin-top: 10px;
        }

        /* Toggle Form Button */
        .toggle-form-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            padding: 0.8rem;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            margin-bottom: 1.5rem;
        }

        .toggle-form-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(7, 68, 182, 0.3);
        }

        /* Responsive */
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
            .content-wrapper {
                padding: 15px;
            }
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 576px) {
            .content-wrapper {
                padding: 10px;
            }
            .stats-grid {
                grid-template-columns: 1fr;
            }
            .btn-primary, .btn-success {
                padding: 0.4rem 1rem;
                font-size: 0.85rem;
            }
        }
        
        /* Botón mejorado - Más compacto y atractivo */
        .btn-add-grado {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 0.6rem 1.2rem;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
            font-size: 0.85rem;
        }
        
        .btn-add-grado:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(7, 68, 182, 0.3);
            color: white;
        }
        
        /* Header de la tarjeta principal mejorado */
        .card-header-flex {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }
        
        /* Tarjetas de grados más compactas */
        .grado-card-compact {
            background: white;
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 0.75rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            border-left: 3px solid var(--primary);
            transition: var(--transition);
        }
        
        .grado-card-compact:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }
        
        .grado-header-compact {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 0.5rem;
        }
        
        .grado-title-compact {
            font-weight: 600;
            color: var(--primary);
            font-size: 0.9rem;
            margin-bottom: 0.25rem;
        }
        
        .grado-nivel-compact {
            display: inline-block;
            padding: 2px 8px;
            background-color: rgba(7, 68, 182, 0.1);
            color: var(--primary);
            border-radius: 12px;
            font-size: 0.7rem;
            font-weight: 600;
        }
        
        .grado-info-compact {
            color: var(--text-muted);
            font-size: 0.8rem;
            margin-bottom: 0.25rem;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .grado-info-compact i {
            width: 14px;
            color: var(--primary);
            font-size: 0.75rem;
        }
        
        /* Stats cards más compactas */
        .stats-compact {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 12px;
            margin-bottom: 1.5rem;
        }
        
        .stat-card-compact {
            background: white;
            border-radius: 8px;
            padding: 1rem;
            box-shadow: 0 3px 10px rgba(0,0,0,0.05);
            border-top: 3px solid var(--primary);
            transition: var(--transition);
        }
        
        .stat-icon-compact {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
            font-size: 1.2rem;
            color: white;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
        }
        
        .stat-value-compact {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
            line-height: 1;
            margin-bottom: 3px;
            text-align: center;
        }
        
        .stat-label-compact {
            color: var(--text-muted);
            font-size: 0.8rem;
            font-weight: 500;
            text-align: center;
        }
        
        /* Mejoras responsive adicionales */
        @media (max-width: 768px) {
            .card-header-flex {
                flex-direction: column;
                align-items: stretch;
            }
            
            .btn-add-grado {
                width: 100%;
                justify-content: center;
            }
        }
        
        /* Contenedor de grados con mejor espaciado */
        .grados-container {
            margin-top: 1.5rem;
            padding-top: 1rem;
            border-top: 1px solid var(--border-color);
        }
        
        /* Título de sección mejorado */
        .section-title {
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        /* Estado vacío mejorado */
        .empty-state {
            text-align: center;
            padding: 2rem 1rem;
            background: rgba(248, 249, 250, 0.5);
            border-radius: 8px;
            border: 1px dashed var(--border-color);
        }
        
        .empty-state i {
            font-size: 2rem;
            color: var(--text-muted);
            margin-bottom: 0.75rem;
        }
        
        .empty-state h5 {
            color: var(--text-muted);
            font-size: 0.95rem;
            margin-bottom: 0.5rem;
        }
        
        .empty-state p {
            color: var(--text-muted);
            font-size: 0.85rem;
            margin-bottom: 0;
        }
        
        /* Acciones compactas */
        .action-buttons-compact {
            display: flex;
            gap: 4px;
        }
        
        .btn-action-sm {
            padding: 0.2rem 0.5rem;
            font-size: 0.75rem;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <!-- SIDEBAR BLANCO CON LÍNEA AZUL (sin cambios) -->
    <div class="sidebar">
        <div class="sidebar-header">
            <img src="{{ asset('img/logo_iufim.png') }}" alt="Logo IUFIM" class="logo-img-sidebar">
            <h2><i class="fas fa-chalkboard-teacher"></i> <span>GEPROC</span></h2>
        </div>
        
        <div class="sidebar-menu">
            <a href="{{ route('profesor.dashboard') }}" class="menu-item">
                <i class="fas fa-tachometer-alt"></i>
                <span>Inicio</span>
            </a>
            <a href="" class="menu-item">
                <i class="fas fa-user"></i>
                <span>Mi Perfil</span>
            </a>
            <a href="{{ route('profesor.dashboard') }}" class="menu-item">
                <i class="fas fa-folder"></i>
                <span>Mis Documentos</span>
            </a>
            <a href="" class="menu-item active">
                <i class="fas fa-graduation-cap"></i>
                <span>Grados Académicos</span>
            </a>
            <a href="" class="menu-item">
                <i class="fas fa-cog"></i>
                <span>Configuración</span>
            </a>
        </div>
        
        <div class="sidebar-footer">
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
        <!-- HEADER CON NOMBRE -->
        <div class="header">
            <div class="user-profile">
                <div class="user-avatar">
                    {{ substr(auth()->user()->name, 0, 1) }}{{ substr(auth()->user()->name, strpos(auth()->user()->name, ' ') + 1, 1) ?? '' }}
                </div>
                <div class="user-info">
                    <h4>{{ auth()->user()->name }}</h4>
                    <p>{{ auth()->user()->email }}</p>
                </div>
            </div>
        </div>

        <!-- CONTENT WRAPPER -->
        <div class="content-wrapper">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Dashboard de Grados -->
            <div class="dashboard-card">
                <!-- Header mejorado con botón más atractivo -->
                <div class="card-header-flex">
                    <div class="card-title">
                        <i class="fas fa-graduation-cap"></i> Mis Grados Académicos
                    </div>
                    
                    <button type="button" class="btn-add-grado" id="toggleFormBtn">
                        <i class="fas fa-plus-circle"></i> Agregar Grado
                    </button>
                </div>
                
                <!-- Estadísticas compactas -->
                @php
                    $totalGrados = $gradosAcademicos->count();
                    $doctorados = $gradosAcademicos->where('nivel', 'Doctorado')->count();
                    $maestrias = $gradosAcademicos->where('nivel', 'Maestría')->count();
                    $licenciaturas = $gradosAcademicos->where('nivel', 'Licenciatura')->count();
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
                        <div class="stat-value-compact">{{ $licenciaturas }}</div>
                        <div class="stat-label-compact">Licenciaturas</div>
                    </div>
                </div>

                <!-- Formulario (oculto inicialmente) -->
                <div class="form-card" id="gradoFormContainer" style="display: none;">
                    <div class="form-header">
                        <h5 class="form-title">
                            <i class="fas fa-plus-circle me-2"></i> Agregar Nuevo Grado Académico
                        </h5>
                    </div>
                    
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <h6 class="alert-heading">
                                <i class="fas fa-exclamation-triangle me-2"></i>Error en el formulario
                            </h6>
                            <ul class="mb-0" style="font-size: 0.9rem;">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('maestros.grados.store') }}" method="POST" enctype="multipart/form-data" id="gradoForm">
                        @csrf
                        
                        <input type="hidden" name="maestro_id" value="{{ $maestro->id }}">

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
                                        <button type="button" class="btn btn-sm btn-outline-light" onclick="clearFile()">
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
                            <button type="button" class="btn btn-outline" id="cancelFormBtn">
                                <i class="fas fa-times me-2"></i> Cancelar
                            </button>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save me-2"></i> Guardar Grado
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Lista de Grados Académicos - Versión compacta -->
                <div class="grados-container">
                    <div class="section-title">
                        <i class="fas fa-list"></i> Grados Registrados
                    </div>
                    
                    @if($gradosAcademicos->count() > 0)
                        @foreach($gradosAcademicos as $grado)
                            <div class="grado-card-compact">
                                <div class="grado-header-compact">
                                    <div>
                                        <div class="grado-title-compact">{{ $grado->nombre_titulo }}</div>
                                        <span class="grado-nivel-compact">{{ $grado->nivel }}</span>
                                    </div>
                                    <div class="action-buttons-compact">
                                        <a href="{{ route('maestros.grados.edit', $grado->id) }}" class="btn btn-outline btn-action-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('maestros.grados.destroy', $grado->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-action-sm" onclick="return confirm('¿Está seguro de eliminar este grado académico?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                
                                <div class="grado-info-compact">
                                    <i class="fas fa-university"></i>
                                    <span>{{ $grado->institucion ?? 'Sin institución registrada' }}</span>
                                </div>
                                
                                <div class="grado-info-compact">
                                    <i class="fas fa-calendar"></i>
                                    <span>Año: {{ $grado->ano_obtencion ?? 'No especificado' }}</span>
                                </div>
                                
                                @if($grado->cedula_profesional)
                                    <div class="grado-info-compact">
                                        <i class="fas fa-id-card"></i>
                                        <span>Cédula: {{ $grado->cedula_profesional }}</span>
                                    </div>
                                @endif
                                
                                @if($grado->documento)
                                    <div class="grado-info-compact">
                                        <i class="fas fa-file"></i>
                                        <span>
                                            Documento: 
                                            <a href="{{ Storage::url($grado->documento) }}" target="_blank" class="text-primary">
                                                Ver
                                            </a>
                                        </span>
                                    </div>
                                @endif
                                
                                @if($grado->observaciones)
                                    <div class="grado-info-compact">
                                        <i class="fas fa-comment"></i>
                                        <span>{{ Str::limit($grado->observaciones, 80) }}</span>
                                    </div>
                                @endif
                            </div>
                        @endforeach
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
        function clearFile() {
            document.getElementById('documento').value = '';
            document.getElementById('filePreview').style.display = 'none';
        }

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