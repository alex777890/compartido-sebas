<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Panel Administrativo - GEPROC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #0744b6ff;
            --secondary: #33CAE6;
            --accent: #26E63F;
            --light-bg: #F8F9FA;
            --border-color: #E9ECEF;
            --text-muted: #6C757D;
            --card-shadow: 0 5px 15px rgba(15, 126, 230, 0.08);
            --transition: all 0.3s ease;
            
            --font-size-base: 1.1rem;
            --font-size-lg: 1.3rem;
            --font-size-sm: 1rem;
            --font-size-h1: 2.2rem;
            --font-size-h2: 1.9rem;
            --font-size-h3: 1.6rem;
            --font-size-h4: 1.4rem;
        }

        body { 
            background: white; 
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            color: #333; 
            line-height: 1.6;
            font-size: var(--font-size-base);
        }

        /* ========== BARRA DE NAVEGACIÓN ========== */
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
        }

        .navbar-menu .user-avatar {
            width: 36px;
            height: 36px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.3);
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
            padding: 30px 20px;
            min-height: calc(100vh - 140px);
            background: #f8fafc;
        }

        h1, h2, h3, h4, h5, h6 {
            font-weight: 600;
            line-height: 1.3;
        }

        h1 { font-size: var(--font-size-h1); }
        h2 { font-size: var(--font-size-h2); }
        h3 { font-size: var(--font-size-h3); }
        h4 { font-size: var(--font-size-h4); }

        h2 { 
            color: var(--primary);
            margin-bottom: 1.5rem; 
            padding-bottom: 0.8rem;
            position: relative;
        }

        h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 3px;
            background: var(--primary);
        }

        /* Tarjetas y secciones */
        .welcome-section {
            background: white;
            border-radius: 6px;
            padding: 2.5rem;
            margin-bottom: 2rem;
            border: 1px solid var(--border-color);
            box-shadow: var(--card-shadow);
        }

        .welcome-title {
            color: var(--primary);
            font-weight: 600;
            margin-bottom: 1.2rem;
            font-size: var(--font-size-h2);
        }

        .profile-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: #e8f0fe;
            color: var(--primary);
            padding: 0.5rem 1.2rem;
            border-radius: 40px;
            font-size: 0.95rem;
            font-weight: 500;
            border: 1px solid rgba(7, 68, 182, 0.2);
            margin-top: 1rem;
        }

        /* Grid de estadísticas */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stats-card {
            background: white;
            border-radius: 6px;
            padding: 1.8rem 1.5rem;
            border: 1px solid var(--border-color);
            box-shadow: var(--card-shadow);
            display: flex;
            align-items: center;
            gap: 1.2rem;
            transition: var(--transition);
        }

        .stats-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(7, 68, 182, 0.12);
        }

        .stats-icon {
            width: 60px;
            height: 60px;
            background: #e8f0fe;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 1.8rem;
        }

        .stats-content h4 {
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 0.3rem;
        }

        .stats-number {
            font-size: 2rem;
            font-weight: 700;
            color: #333;
        }

        /* Tarjeta de perfil */
        .profile-card {
            background: white;
            border-radius: 6px;
            padding: 2rem;
            margin-bottom: 2rem;
            border: 1px solid var(--border-color);
            box-shadow: var(--card-shadow);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--border-color);
        }

        .card-header h3 {
            font-size: var(--font-size-h4);
            color: var(--primary);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .edit-btn {
            background: transparent;
            border: 2px solid var(--primary);
            color: var(--primary);
            padding: 0.5rem 1.2rem;
            border-radius: 6px;
            font-weight: 500;
            transition: var(--transition);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.95rem;
        }

        .edit-btn:hover {
            background: rgba(7, 68, 182, 0.05);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(7, 68, 182, 0.15);
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.8rem;
        }

        .info-item {
            display: flex;
            flex-direction: column;
        }

        .info-label {
            font-size: 0.8rem;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 0.4rem;
        }

        .info-value {
            font-weight: 500;
            color: #333;
            font-size: 1rem;
        }

        /* Sección de documentos */
        .documents-section {
            background: white;
            border-radius: 6px;
            padding: 2rem;
            margin-bottom: 2rem;
            border: 1px solid var(--border-color);
            box-shadow: var(--card-shadow);
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .btn-outline {
            background: transparent;
            border: 2px solid var(--primary);
            color: var(--primary);
            padding: 0.6rem 1.5rem;
            border-radius: 6px;
            font-weight: 500;
            transition: var(--transition);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-outline:hover {
            background: rgba(7, 68, 182, 0.05);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(7, 68, 182, 0.15);
        }

        .documents-table {
            width: 100%;
        }

        .documents-table th {
            text-align: left;
            padding: 1rem 0.5rem;
            color: var(--text-muted);
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border-bottom: 1px solid var(--border-color);
        }

        .documents-table td {
            padding: 1rem 0.5rem;
            border-bottom: 1px solid var(--border-color);
        }

        .document-name {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .document-name i {
            width: 35px;
            height: 35px;
            background: #e8f0fe;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
        }

        .badge {
            padding: 0.4rem 1rem;
            border-radius: 4px;
            font-size: 0.85rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
        }

        .badge-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .badge-warning {
            background: #fff3cd;
            color: #856404;
            border: 1px solid #ffeeba;
        }

        .badge-danger {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .badge-secondary {
            background: #e2e3e5;
            color: #383d41;
            border: 1px solid #d6d8db;
        }

        .action-btn {
            background: none;
            border: none;
            color: var(--primary);
            cursor: pointer;
            font-size: 1rem;
            padding: 0.3rem 0.5rem;
            transition: var(--transition);
        }

        .action-btn:hover {
            color: #052d7a;
            transform: scale(1.1);
        }

        /* Alertas */
        .alert {
            padding: 1.2rem;
            border-radius: 6px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            border: 1px solid;
        }

        .alert-success {
            background: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
        }

        .alert-info {
            background: #d1ecf1;
            border-color: #bee5eb;
            color: #0c5460;
        }

        .alert-warning {
            background: #fff3cd;
            border-color: #ffeeba;
            color: #856404;
        }

        /* Actividades recientes */
        .activities-section {
            background: white;
            border-radius: 6px;
            padding: 2rem;
            border: 1px solid var(--border-color);
            box-shadow: var(--card-shadow);
        }

        .activity-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem 0;
            border-bottom: 1px solid var(--border-color);
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-icon {
            width: 45px;
            height: 45px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }

        .activity-icon.success {
            background: #d4edda;
            color: #155724;
        }

        .activity-icon.warning {
            background: #fff3cd;
            color: #856404;
        }

        .activity-icon.info {
            background: #d1ecf1;
            color: #0c5460;
        }

        .activity-content {
            flex: 1;
        }

        .activity-title {
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .activity-desc {
            font-size: 0.9rem;
            color: var(--text-muted);
        }

        .activity-time {
            font-size: 0.85rem;
            color: #95a5a6;
        }

        .date-badge {
            background: white;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            padding: 0.7rem 1.5rem;
            font-size: 0.95rem;
            color: var(--text-muted);
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .info-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            :root {
                --font-size-base: 1rem;
                --font-size-h1: 1.9rem;
                --font-size-h2: 1.6rem;
                --font-size-h3: 1.4rem;
                --font-size-h4: 1.2rem;
            }
            
            .navbar-menu {
                top: 60px;
            }
            
            .navbar-menu .nav-link {
                padding: 0.6rem 1.2rem !important;
            }
            
            .navbar-menu .user-info-container {
                flex-direction: column;
                gap: 10px;
                align-items: flex-start;
                margin-top: 10px;
                padding-top: 10px;
                border-top: 1px solid rgba(255, 255, 255, 0.2);
            }
            
            .main-content {
                padding: 20px 15px;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .info-grid {
                grid-template-columns: 1fr;
            }
            
            .section-header {
                flex-direction: column;
                gap: 1rem;
                align-items: flex-start;
            }
            
            .logo-img {
                height: 45px;
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
                    GEPROC | Administrativos
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
            
                
                <!-- Información de usuario y cerrar sesión -->
                <div class="user-info-container">
                    <div class="user-info">
                        <span class="user-name">{{ Auth::user()->name }}</span>
                        <div class="user-avatar">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
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
    
    <!-- Contenido principal -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 main-content">
                <div class="container">
                    <!-- Cabecera con fecha -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2>Panel Administrativo</h2>
                        <div class="date-badge">
                            <i class="fas fa-calendar-alt"></i>
                            {{ now()->format('d F, Y') }}
                        </div>
                    </div>

                    <!-- Alertas -->
                    @if(session('success'))
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle"></i>
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('info'))
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i>
                            {{ session('info') }}
                        </div>
                    @endif

                    @if(session('warning'))
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle"></i>
                            {{ session('warning') }}
                        </div>
                    @endif

                    <!-- Tarjeta de bienvenida -->
                    <div class="welcome-section">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <h1 class="welcome-title">¡Bienvenido, {{ $administrativo->nombres }}!</h1>
                                <p class="mb-2" style="font-size: var(--font-size-lg); color: var(--text-muted);">
                                    {{ $administrativo->puesto }} • {{ $administrativo->area_adscripcion }}
                                </p>
                                <span class="profile-badge">
                                    <i class="fas fa-id-card"></i>
                                    N° Empleado: {{ $administrativo->numero_empleado }}
                                </span>
                            </div>
                            <div class="col-md-4 text-center">
                                <i class="fas fa-user-tie" style="font-size: 5rem; color: var(--primary); opacity: 0.7;"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Estadísticas de documentos -->
                    <div class="stats-grid">
                        <div class="stats-card">
                            <div class="stats-icon">
                                <i class="fas fa-file-pdf"></i>
                            </div>
                            <div class="stats-content">
                                <h4>Documentos Requeridos</h4>
                                <div class="stats-number">{{ $estadisticas['total_requeridos'] }}</div>
                            </div>
                        </div>

                        <div class="stats-card">
                            <div class="stats-icon">
                                <i class="fas fa-cloud-upload-alt"></i>
                            </div>
                            <div class="stats-content">
                                <h4>Documentos Subidos</h4>
                                <div class="stats-number">{{ $estadisticas['total_subidos'] }}</div>
                            </div>
                        </div>

                        <div class="stats-card">
                            <div class="stats-icon">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="stats-content">
                                <h4>Aprobados</h4>
                                <div class="stats-number">{{ $estadisticas['aprobados'] }}</div>
                            </div>
                        </div>

                        <div class="stats-card">
                            <div class="stats-icon">
                                <i class="fas fa-hourglass-half"></i>
                            </div>
                            <div class="stats-content">
                                <h4>Pendientes</h4>
                                <div class="stats-number">{{ $estadisticas['pendientes'] }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Información del Perfil -->
                    <div class="profile-card">
                        <div class="card-header">
                            <h3>
                                <i class="fas fa-id-card"></i>
                                Información Personal
                            </h3>
                            <a href="{{ route('administrativos.editar-perfil') }}" class="edit-btn">
                                <i class="fas fa-edit"></i> Editar Perfil
                            </a>
                        </div>

                        <div class="info-grid">
                            <div class="info-item">
                                <span class="info-label">Nombre Completo</span>
                                <span class="info-value">{{ $administrativo->nombre_completo }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">CURP</span>
                                <span class="info-value">{{ $administrativo->curp }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">RFC</span>
                                <span class="info-value">{{ $administrativo->rfc }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Fecha Nacimiento</span>
                                <span class="info-value">{{ $administrativo->fecha_nacimiento->format('d/m/Y') }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Teléfono</span>
                                <span class="info-value">{{ $administrativo->telefono }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Email Personal</span>
                                <span class="info-value">{{ $administrativo->email_personal }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Dirección</span>
                                <span class="info-value">{{ $administrativo->direccion }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Fecha Ingreso</span>
                                <span class="info-value">{{ $administrativo->fecha_ingreso->format('d/m/Y') }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Grado Máximo</span>
                                <span class="info-value">{{ $administrativo->maximo_grado_estudios ?? 'No especificado' }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Documentos -->
                    <div class="documents-section">
                        <div class="section-header">
                            <h3>
                                <i class="fas fa-file-pdf"></i>
                                Documentos Requeridos
                                <span style="font-size: 0.9rem; color: var(--text-muted); margin-left: 0.5rem;">
                                    ({{ $estadisticas['total_subidos'] }}/{{ $estadisticas['total_requeridos'] }})
                                </span>
                            </h3>
                            <a href="{{ route('administrativos.documentos') }}" class="btn-outline">
                                <i class="fas fa-arrow-right"></i> Ver Todos
                            </a>
                        </div>

                        <table class="documents-table">
                            <thead>
                                <tr>
                                    <th>Documento</th>
                                    <th>Estado</th>
                                    <th>Fecha Subida</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(array_slice($documentosParaVista, 0, 3) as $documento)
                                    <tr>
                                        <td>
                                            <div class="document-name">
                                                <i class="fas fa-{{ $documento['icono'] }}"></i>
                                                {{ $documento['nombre'] }}
                                            </div>
                                        </td>
                                        <td>
                                            @if($documento['estado'] == 'aprobado')
                                                <span class="badge badge-success">
                                                    <i class="fas fa-check-circle"></i> Aprobado
                                                </span>
                                            @elseif($documento['estado'] == 'rechazado')
                                                <span class="badge badge-danger">
                                                    <i class="fas fa-times-circle"></i> Rechazado
                                                </span>
                                            @elseif($documento['estado'] == 'pendiente')
                                                <span class="badge badge-warning">
                                                    <i class="fas fa-clock"></i> Pendiente
                                                </span>
                                            @else
                                                <span class="badge badge-secondary">
                                                    <i class="fas fa-hourglass"></i> Faltante
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($documento['tiene_documento'])
                                                {{ $documento['fecha_subida']->format('d/m/Y') }}
                                            @else
                                                <span style="color: #95a5a6;">No subido</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($documento['tiene_documento'])
                                                <a href="{{ route('administrativos.documentos.ver', $documento['documento_id']) }}" target="_blank" class="action-btn" title="Ver documento">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('administrativos.documentos.descargar', $documento['documento_id']) }}" class="action-btn" title="Descargar">
                                                    <i class="fas fa-download"></i>
                                                </a>
                                            @else
                                                <span style="color: #95a5a6;">-</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        @if(count($documentosParaVista) > 3)
                            <div style="text-align: center; margin-top: 1.5rem;">
                                <a href="{{ route('administrativos.documentos') }}" style="color: var(--primary); text-decoration: none; font-weight: 500;">
                                    Ver todos los documentos ({{ count($documentosParaVista) - 3 }} más)
                                </a>
                            </div>
                        @endif
                    </div>

                    <!-- Actividades Recientes -->
                    @if(isset($actividadesRecientes) && count($actividadesRecientes) > 0)
                        <div class="activities-section">
                            <h3 style="margin-bottom: 1.5rem; font-size: var(--font-size-h4); color: var(--primary);">
                                <i class="fas fa-history" style="margin-right: 0.5rem;"></i>
                                Actividades Recientes
                            </h3>

                            @foreach($actividadesRecientes as $actividad)
                                <div class="activity-item">
                                    <div class="activity-icon {{ $actividad['tipo'] }}">
                                        @if($actividad['tipo'] == 'aprobado')
                                            <i class="fas fa-check-circle"></i>
                                        @elseif($actividad['tipo'] == 'rechazado')
                                            <i class="fas fa-times-circle"></i>
                                        @else
                                            <i class="fas fa-clock"></i>
                                        @endif
                                    </div>
                                    <div class="activity-content">
                                        <div class="activity-title">{{ $actividad['titulo'] }}</div>
                                        <div class="activity-desc">{{ $actividad['descripcion'] }}</div>
                                    </div>
                                    <div class="activity-time">{{ $actividad['tiempo'] }}</div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        (function(){
            const navbar = document.querySelector('.navbar-top');

            window.addEventListener('scroll', function() {
                if (window.scrollY > 50) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
            });
        })();
    </script>
</body>
</html>