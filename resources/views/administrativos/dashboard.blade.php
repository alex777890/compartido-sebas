<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover"/>
    <title>Panel Administrativo - GEPROC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #0744b6ff;
            --primary-light: #3a6bd3;
            --secondary: #33CAE6;
            --accent: #26E63F;
            --light-bg: #F8F9FA;
            --border-color: #E9ECEF;
            --text-muted: #6C757D;
            --card-shadow: 0 5px 15px rgba(15, 126, 230, 0.08);
            --transition: all 0.3s ease;
            --danger-color: #ef4444;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            
            --font-size-base: 1rem;
            --font-size-lg: 1.2rem;
            --font-size-sm: 0.9rem;
            --font-size-h1: 1.8rem;
            --font-size-h2: 1.5rem;
            --font-size-h3: 1.3rem;
            --font-size-h4: 1.1rem;
        }

        body { 
            background: #f8fafc; 
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            color: #333; 
            line-height: 1.6;
            font-size: var(--font-size-base);
        }

        /* ========== BARRA SUPERIOR - LOGO Y TÍTULO ========== */
        .navbar-top { 
            background: white; 
            border-bottom: 1px solid var(--border-color);
            padding: 0.6rem 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            transition: var(--transition);
        }

        .navbar-top.scrolled {
            padding: 0.4rem 0;
            box-shadow: 0 5px 20px rgba(15, 126, 230, 0.15);
        }

        .navbar-brand { 
            color: var(--primary) !important; 
            font-weight: 600; 
            font-size: 1.2rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .navbar-brand::before {
            content: "";
            display: block;
            width: 4px;
            height: 24px;
            background: var(--primary);
            border-radius: 2px;
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo-img {
            height: 45px;
            width: auto;
            object-fit: contain;
        }

        /* ========== BARRA SECUNDARIA - SOLO USUARIO Y CERRAR SESIÓN ========== */
        .navbar-menu { 
            background: var(--primary); 
            padding: 0.6rem 0;
            position: sticky;
            top: 60px;
            z-index: 999;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        /* Contenedor de usuario - alineado a la derecha */
        .user-info-container {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 15px;
            flex-wrap: wrap;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
            color: white;
            background: rgba(255, 255, 255, 0.1);
            padding: 0.4rem 1rem;
            border-radius: 40px;
        }

        .user-name {
            font-weight: 500;
            font-size: 0.9rem;
            color: white;
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            background: rgba(255, 255, 255, 0.25);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            color: white;
            font-weight: 600;
        }

        .logout-btn {
            background: transparent;
            border: 1px solid rgba(255, 255, 255, 0.4);
            color: rgba(255, 255, 255, 0.9);
            padding: 0.4rem 1rem;
            border-radius: 40px;
            font-weight: 500;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9rem;
            text-decoration: none;
        }

        .logout-btn:hover {
            background: rgba(255, 255, 255, 0.15);
            color: white;
            border-color: rgba(255, 255, 255, 0.6);
        }

        /* Contenido principal */
        .main-content { 
            padding: 20px 16px;
            min-height: calc(100vh - 110px);
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
            margin-bottom: 1.2rem; 
            padding-bottom: 0.6rem;
            position: relative;
        }

        h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background: var(--primary);
            border-radius: 2px;
        }

        /* Tarjetas y secciones */
        .welcome-section {
            background: white;
            border-radius: 16px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border: 1px solid var(--border-color);
            box-shadow: var(--card-shadow);
        }

        .welcome-title {
            color: var(--primary);
            font-weight: 700;
            margin-bottom: 0.8rem;
            font-size: var(--font-size-h2);
        }

        .profile-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: #e8f0fe;
            color: var(--primary);
            padding: 0.4rem 1rem;
            border-radius: 40px;
            font-size: 0.85rem;
            font-weight: 500;
            margin-top: 0.8rem;
        }

        /* Grid de estadísticas */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .stats-card {
            background: white;
            border-radius: 16px;
            padding: 1.2rem;
            border: 1px solid var(--border-color);
            box-shadow: var(--card-shadow);
            display: flex;
            align-items: center;
            gap: 1rem;
            transition: var(--transition);
        }

        .stats-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(7, 68, 182, 0.12);
        }

        .stats-icon {
            width: 50px;
            height: 50px;
            background: #e8f0fe;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 1.4rem;
            flex-shrink: 0;
        }

        .stats-content h4 {
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 0.2rem;
        }

        .stats-number {
            font-size: 1.6rem;
            font-weight: 700;
            color: #1e293b;
            line-height: 1.2;
        }

        /* Tarjeta de perfil */
        .profile-card {
            background: white;
            border-radius: 16px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border: 1px solid var(--border-color);
            box-shadow: var(--card-shadow);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 1.2rem;
            padding-bottom: 0.8rem;
            border-bottom: 1px solid var(--border-color);
        }

        .card-header h3 {
            font-size: var(--font-size-h4);
            color: var(--primary);
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin: 0;
        }

        .edit-btn {
            background: transparent;
            border: 2px solid var(--primary);
            color: var(--primary);
            padding: 0.4rem 1rem;
            border-radius: 8px;
            font-weight: 500;
            transition: var(--transition);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.85rem;
        }

        .edit-btn:hover {
            background: rgba(7, 68, 182, 0.05);
            transform: translateY(-2px);
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.2rem;
        }

        .info-item {
            display: flex;
            flex-direction: column;
        }

        .info-label {
            font-size: 0.7rem;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 0.3rem;
        }

        .info-value {
            font-weight: 500;
            color: #1e293b;
            font-size: 0.9rem;
            word-break: break-word;
        }

        /* Sección de documentos */
        .documents-section {
            background: white;
            border-radius: 16px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border: 1px solid var(--border-color);
            box-shadow: var(--card-shadow);
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 1.2rem;
        }

        .section-header h3 {
            font-size: var(--font-size-h4);
            color: var(--primary);
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin: 0;
        }

        .btn-outline {
            background: transparent;
            border: 2px solid var(--primary);
            color: var(--primary);
            padding: 0.4rem 1.2rem;
            border-radius: 8px;
            font-weight: 500;
            transition: var(--transition);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.85rem;
        }

        .btn-outline:hover {
            background: rgba(7, 68, 182, 0.05);
            transform: translateY(-2px);
        }

        /* Tabla responsiva */
        .documents-table-container {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .documents-table {
            width: 100%;
            min-width: 500px;
        }

        .documents-table th {
            text-align: left;
            padding: 0.8rem 0.5rem;
            color: var(--text-muted);
            font-weight: 600;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border-bottom: 1px solid var(--border-color);
        }

        .documents-table td {
            padding: 0.8rem 0.5rem;
            border-bottom: 1px solid var(--border-color);
            vertical-align: middle;
        }

        .document-name {
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }

        .document-name i {
            width: 32px;
            height: 32px;
            background: #e8f0fe;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 0.9rem;
            flex-shrink: 0;
        }

        .badge {
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
        }

        .badge-success {
            background: #d1fae5;
            color: #065f46;
        }

        .badge-warning {
            background: #fef3c7;
            color: #92400e;
        }

        .badge-danger {
            background: #fee2e2;
            color: #991b1b;
        }

        .badge-secondary {
            background: #f1f5f9;
            color: #475569;
        }

        .action-btn {
            background: none;
            border: none;
            color: var(--primary);
            cursor: pointer;
            font-size: 0.9rem;
            padding: 0.3rem 0.5rem;
            transition: var(--transition);
            display: inline-block;
        }

        .action-btn:hover {
            color: var(--primary-light);
            transform: scale(1.1);
        }

        /* Alertas */
        .alert {
            padding: 1rem;
            border-radius: 12px;
            margin-bottom: 1.2rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            border: 1px solid;
            font-size: 0.85rem;
        }

        .alert-success {
            background: #d1fae5;
            border-color: #a7f3d0;
            color: #065f46;
        }

        .alert-info {
            background: #dbeafe;
            border-color: #bfdbfe;
            color: #1e40af;
        }

        .alert-warning {
            background: #fef3c7;
            border-color: #fde68a;
            color: #92400e;
        }

        /* Actividades recientes */
        .activities-section {
            background: white;
            border-radius: 16px;
            padding: 1.5rem;
            border: 1px solid var(--border-color);
            box-shadow: var(--card-shadow);
        }

        .activity-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.8rem 0;
            border-bottom: 1px solid var(--border-color);
            flex-wrap: wrap;
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            flex-shrink: 0;
        }

        .activity-icon.success {
            background: #d1fae5;
            color: #065f46;
        }

        .activity-icon.warning {
            background: #fef3c7;
            color: #92400e;
        }

        .activity-icon.info {
            background: #dbeafe;
            color: #1e40af;
        }

        .activity-content {
            flex: 1;
            min-width: 150px;
        }

        .activity-title {
            font-weight: 600;
            margin-bottom: 0.2rem;
            font-size: 0.9rem;
        }

        .activity-desc {
            font-size: 0.8rem;
            color: var(--text-muted);
        }

        .activity-time {
            font-size: 0.75rem;
            color: #95a5a6;
            white-space: nowrap;
        }

        .date-badge {
            background: white;
            border: 1px solid var(--border-color);
            border-radius: 40px;
            padding: 0.5rem 1rem;
            font-size: 0.85rem;
            color: var(--text-muted);
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        /* ===== MEDIA QUERIES RESPONSIVAS ===== */
        
        /* Tablets */
        @media (max-width: 992px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 1rem;
            }
            
            .info-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 1rem;
            }
            
            .navbar-menu {
                top: 57px;
            }
        }

        /* Móviles */
        @media (max-width: 768px) {
            :root {
                --font-size-base: 0.95rem;
                --font-size-h1: 1.6rem;
                --font-size-h2: 1.4rem;
                --font-size-h3: 1.2rem;
                --font-size-h4: 1rem;
            }
            
            .navbar-top {
                padding: 0.5rem 0;
            }
            
            .logo-img {
                height: 40px;
            }
            
            .navbar-brand {
                font-size: 1rem;
            }
            
            .navbar-menu {
                top: 53px;
            }
            
            .user-info-container {
                justify-content: center;
                width: 100%;
                flex-direction: column;
                align-items: stretch;
            }
            
            .user-info {
                justify-content: center;
                width: 100%;
            }
            
            .logout-btn {
                justify-content: center;
                width: 100%;
            }
            
            .main-content {
                padding: 15px 12px;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
                gap: 0.8rem;
            }
            
            .info-grid {
                grid-template-columns: 1fr;
                gap: 0.8rem;
            }
            
            .stats-card {
                padding: 1rem;
            }
            
            .stats-icon {
                width: 45px;
                height: 45px;
                font-size: 1.2rem;
            }
            
            .stats-number {
                font-size: 1.4rem;
            }
            
            .welcome-section {
                padding: 1.2rem;
                text-align: center;
            }
            
            .welcome-section .row {
                flex-direction: column;
            }
            
            .welcome-section .col-md-8, 
            .welcome-section .col-md-4 {
                text-align: center;
            }
            
            .profile-card, .documents-section, .activities-section {
                padding: 1.2rem;
            }
            
            .card-header {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .section-header {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .activity-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }
            
            .activity-time {
                align-self: flex-start;
            }
            
            .date-badge {
                font-size: 0.75rem;
                padding: 0.4rem 0.8rem;
            }
            
            .d-flex.justify-content-between {
                flex-direction: column;
                gap: 0.8rem;
                align-items: flex-start;
            }
            
            .profile-badge {
                justify-content: center;
            }
        }

        /* Móviles pequeños */
        @media (max-width: 480px) {
            .logo-img {
                height: 35px;
            }
            
            .navbar-brand {
                font-size: 0.9rem;
            }
            
            .stats-icon {
                width: 40px;
                height: 40px;
                font-size: 1rem;
            }
            
            .stats-number {
                font-size: 1.2rem;
            }
            
            .stats-content h4 {
                font-size: 0.65rem;
            }
            
            .badge {
                font-size: 0.7rem;
                padding: 0.25rem 0.6rem;
            }
            
            .edit-btn, .btn-outline {
                padding: 0.3rem 0.8rem;
                font-size: 0.75rem;
            }
            
            .document-name i {
                width: 28px;
                height: 28px;
                font-size: 0.8rem;
            }
            
            .document-name span {
                font-size: 0.85rem;
            }
        }
    </style>
</head>
<body>
    <!-- Primera barra - Solo Logo y título -->
    <nav class="navbar navbar-expand-lg navbar-top">
        <div class="container">
            <div class="logo-container">
                <img src="{{ asset('img/logo_iufim.png') }}" alt="Logo" class="logo-img">
                <a class="navbar-brand" href="{{ route('administrativos.dashboard') }}">
                    GEPROC | Administrativos
                </a>
            </div>
        </div>
    </nav>

    <!-- Segunda barra - Solo Usuario y Cerrar Sesión -->
    <nav class="navbar navbar-menu">
        <div class="container">
            <div class="user-info-container">
                <div class="user-info">
                    <div class="user-avatar">
                        {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                    </div>
                    <span class="user-name">{{ Auth::user()->name ?? 'Administrador' }}</span>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="logout-form">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                    </button>
                </form>
            </div>
        </div>
    </nav>
    
    <!-- Contenido principal -->
    <div class="main-content">
        <div class="container">
            <!-- Cabecera con fecha -->
            <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
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
                        <h1 class="welcome-title">¡Bienvenido, {{ $administrativo->nombres ?? 'Administrador' }}!</h1>
                        <p class="mb-2" style="color: var(--text-muted);">
                            {{ $administrativo->puesto ?? 'Puesto no especificado' }} • {{ $administrativo->area_adscripcion ?? 'Área no especificada' }}
                        </p>
                        <span class="profile-badge">
                            <i class="fas fa-id-card"></i>
                            N° Empleado: {{ $administrativo->numero_empleado ?? 'N/A' }}
                        </span>
                    </div>
                    <div class="col-md-4 text-center mt-3 mt-md-0">
                        <i class="fas fa-user-tie" style="font-size: 4rem; color: var(--primary); opacity: 0.7;"></i>
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
                        <div class="stats-number">{{ $estadisticas['total_requeridos'] ?? 0 }}</div>
                    </div>
                </div>

                <div class="stats-card">
                    <div class="stats-icon">
                        <i class="fas fa-cloud-upload-alt"></i>
                    </div>
                    <div class="stats-content">
                        <h4>Documentos Subidos</h4>
                        <div class="stats-number">{{ $estadisticas['total_subidos'] ?? 0 }}</div>
                    </div>
                </div>

                <div class="stats-card">
                    <div class="stats-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="stats-content">
                        <h4>Aprobados</h4>
                        <div class="stats-number">{{ $estadisticas['aprobados'] ?? 0 }}</div>
                    </div>
                </div>

                <div class="stats-card">
                    <div class="stats-icon">
                        <i class="fas fa-hourglass-half"></i>
                    </div>
                    <div class="stats-content">
                        <h4>Pendientes</h4>
                        <div class="stats-number">{{ $estadisticas['pendientes'] ?? 0 }}</div>
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
                        <span class="info-value">{{ $administrativo->nombre_completo ?? 'No registrado' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">CURP</span>
                        <span class="info-value">{{ $administrativo->curp ?? 'No registrado' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">RFC</span>
                        <span class="info-value">{{ $administrativo->rfc ?? 'No registrado' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Fecha Nacimiento</span>
                        <span class="info-value">{{ isset($administrativo->fecha_nacimiento) ? \Carbon\Carbon::parse($administrativo->fecha_nacimiento)->format('d/m/Y') : 'No registrado' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Teléfono</span>
                        <span class="info-value">{{ $administrativo->telefono ?? 'No registrado' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Email Personal</span>
                        <span class="info-value">{{ $administrativo->email_personal ?? 'No registrado' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Dirección</span>
                        <span class="info-value">{{ $administrativo->direccion ?? 'No registrada' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Fecha Ingreso</span>
                        <span class="info-value">{{ isset($administrativo->fecha_ingreso) ? \Carbon\Carbon::parse($administrativo->fecha_ingreso)->format('d/m/Y') : 'No registrado' }}</span>
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
                        <span style="font-size: 0.8rem; color: var(--text-muted); margin-left: 0.3rem;">
                            ({{ $estadisticas['total_subidos'] ?? 0 }}/{{ $estadisticas['total_requeridos'] ?? 0 }})
                        </span>
                    </h3>
                    <a href="{{ route('administrativos.documentos') }}" class="btn-outline">
                        <i class="fas fa-arrow-right"></i> Ver Todos
                    </a>
                </div>

                <div class="documents-table-container">
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
                            @foreach(array_slice($documentosParaVista ?? [], 0, 3) as $documento)
                               
                                    <td>
                                        <div class="document-name">
                                            <i class="fas fa-{{ $documento['icono'] ?? 'file' }}"></i>
                                            <span>{{ $documento['nombre'] }}</span>
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
                                        @if($documento['tiene_documento'] && isset($documento['fecha_subida']))
                                            {{ \Carbon\Carbon::parse($documento['fecha_subida'])->format('d/m/Y') }}
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
                </div>

                @if(isset($documentosParaVista) && count($documentosParaVista) > 3)
                    <div style="text-align: center; margin-top: 1.2rem;">
                        <a href="{{ route('administrativos.documentos') }}" style="color: var(--primary); text-decoration: none; font-weight: 500; font-size: 0.85rem;">
                            Ver todos los documentos ({{ count($documentosParaVista) - 3 }} más) <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                @endif
            </div>

            <!-- Actividades Recientes -->
            @if(isset($actividadesRecientes) && count($actividadesRecientes) > 0)
                <div class="activities-section">
                    <h3 style="margin-bottom: 1.2rem; color: var(--primary);">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        (function(){
            const navbar = document.querySelector('.navbar-top');
            if (navbar) {
                window.addEventListener('scroll', function() {
                    if (window.scrollY > 50) {
                        navbar.classList.add('scrolled');
                    } else {
                        navbar.classList.remove('scrolled');
                    }
                });
            }
        })();
    </script>
</body>
</html>