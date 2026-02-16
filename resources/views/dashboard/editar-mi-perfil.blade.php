<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil - Sistema GEPROC</title>
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
            --border-radius: 8px;
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
            background: var(--gradient-primary);
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

        /* PANEL DE CONTROL SUPERIOR - DISEÑO PROFESIONAL */
        .control-panel {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            flex-wrap: wrap;
            gap: 20px;
        }

        .panel-title-section {
            flex: 1;
            min-width: 300px;
        }

        .main-title {
            font-size: 26px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 5px;
        }

        .subtitle {
            color: var(--text-muted);
            font-size: 14px;
            line-height: 1.5;
        }

        .action-buttons {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        /* BOTÓN VOLVER - DISEÑO ELEGANTE */
        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 10px 20px;
            background: white;
            color: var(--primary);
            border: 1px solid var(--primary);
            border-radius: 6px;
            font-weight: 600;
            font-size: 13px;
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
        }

        .btn-back:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(7, 68, 182, 0.15);
        }

        /* ALERTAS MEJORADAS */
        .alert {
            padding: 14px 18px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            align-items: flex-start;
            gap: 12px;
            border-left: 4px solid transparent;
            animation: slideIn 0.3s ease;
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
            font-size: 18px;
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

        /* TARJETA DE PERFIL */
        .profile-card {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            border: 1px solid var(--border-color);
            overflow: hidden;
            margin-bottom: 25px;
        }

        .profile-header {
            background: var(--gradient-primary);
            color: white;
            padding: 25px 30px;
            position: relative;
            overflow: hidden;
        }

        .profile-header::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            transform: translate(30%, -30%);
        }

        .profile-header h1 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 15px;
            position: relative;
            z-index: 2;
        }

        .profile-header p {
            font-size: 15px;
            opacity: 0.9;
            margin: 0;
            position: relative;
            z-index: 2;
            max-width: 600px;
        }

        .profile-content {
            padding: 30px;
        }

        .form-section {
            margin-bottom: 40px;
        }

        .section-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #e9ecef;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-title i {
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-size: 20px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
        }

        .form-label i {
            color: var(--primary);
            width: 20px;
            text-align: center;
        }

        .required::after {
            content: '*';
            color: var(--danger-color);
            margin-left: 4px;
        }

        .form-control {
            border: 1px solid var(--border-color);
            border-radius: 6px;
            padding: 12px 15px;
            font-size: 14px;
            transition: var(--transition);
            background: white;
            width: 100%;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(7, 68, 182, 0.1);
            outline: none;
        }

        .form-control.is-invalid {
            border-color: var(--danger-color);
        }

        .invalid-feedback {
            color: var(--danger-color);
            font-size: 13px;
            margin-top: 5px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .readonly-info {
            background: #f8f9fa;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            padding: 20px;
            margin-top: 30px;
        }

        .readonly-info h5 {
            color: var(--primary);
            margin-bottom: 15px;
            font-size: 16px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }

        .info-item {
            display: flex;
            flex-direction: column;
        }

        .info-label {
            font-size: 12px;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
        }

        .info-value {
            font-weight: 600;
            color: #2d3748;
            font-size: 14px;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid var(--border-color);
        }

        .btn {
            padding: 12px 28px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: var(--transition);
            border: none;
            cursor: pointer;
            text-decoration: none;
        }

        .btn-primary {
            background: var(--gradient-primary);
            color: white;
            border: none;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(7, 68, 182, 0.2);
        }

        .btn-secondary {
            background: white;
            color: var(--primary);
            border: 1px solid var(--primary);
        }

        .btn-secondary:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-2px);
        }

        .btn-outline-secondary {
            background: transparent;
            color: var(--text-muted);
            border: 1px solid var(--border-color);
        }

        .btn-outline-secondary:hover {
            background: #f8f9fa;
            color: var(--text-muted);
            border-color: var(--border-color);
        }

        .input-group {
            position: relative;
        }

        .input-group-text {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            font-size: 12px;
            background: none;
            border: none;
            pointer-events: none;
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
            
            .control-panel {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
            
            .form-grid {
                grid-template-columns: 1fr;
            }
            
            .profile-content {
                padding: 20px;
            }
            
            .profile-header {
                padding: 20px;
            }
            
            .profile-header h1 {
                font-size: 22px;
            }
            
            .form-actions {
                flex-direction: column;
            }
            
            .btn {
                width: 100%;
                justify-content: center;
            }
            
            .info-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Estilos específicos para selects */
        .form-select {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e");
            background-position: right 0.75rem center;
            background-size: 16px 12px;
            width: 100%;
            padding: 12px 15px;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            font-size: 14px;
            transition: var(--transition);
            background-color: white;
        }

        .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(7, 68, 182, 0.1);
            outline: none;
        }

        /* Estilos para textarea */
        textarea.form-control {
            min-height: 100px;
            resize: vertical;
        }

        /* Loading state */
        .btn.loading {
            position: relative;
            color: transparent;
        }

        .btn.loading::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-top-color: white;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
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
            <a href="{{ route('profesor.dashboard') }}" class="menu-item">
                <i class="fas fa-tachometer-alt"></i>
                <span>Inicio</span>
            </a>
            <a href="{{ route('profesor.documentos') }}" class="menu-item">
                <i class="fas fa-folder"></i>
                <span>Mis Documentos</span>
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
                    {{ substr($maestro->nombres ?? 'P', 0, 1) }}{{ substr($maestro->apellido_paterno ?? 'F', 0, 1) }}
                </div>
                <div class="user-info">
                    <h4>{{ $maestro->nombres ?? 'Profesor' }} {{ $maestro->apellido_paterno ?? '' }}</h4>
                    <p>{{ $maestro->coordinacion->nombre ?? 'Coordinación' }}</p>
                </div>
            </div>
        </div>

        <!-- CONTENT WRAPPER -->
        <div class="content-wrapper">
            <!-- MENSAJES -->
            @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                <div>{{ session('success') }}</div>
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

            <!-- PANEL DE CONTROL -->
            <div class="control-panel">
                <div class="panel-title-section">
                    <h1 class="main-title">Editar Perfil Personal</h1>
                    <p class="subtitle">Actualiza tu información personal y de contacto</p>
                </div>
                <div class="action-buttons">
                    <a href="{{ route('profesor.mi-perfil') }}" class="btn-back">
                        <i class="fas fa-arrow-left"></i>
                        Volver al Perfil
                    </a>
                </div>
            </div>

            <!-- TARJETA DE PERFIL -->
            <div class="profile-card">
                <div class="profile-header">
                    <h1><i class="fas fa-user-edit"></i> Editar Información Personal</h1>
                    <p>Actualiza tu información personal. Los campos marcados con * son obligatorios.</p>
                </div>

                <div class="profile-content">
                    <form action="{{ route('dashboard.editar-mi-perfil') }}" method="POST" id="profileForm">
                        @csrf
                        
                        <!-- Información Personal -->
                        <div class="form-section">
                            <h3 class="section-title"><i class="fas fa-user-circle"></i> Información Personal</h3>
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="nombres" class="form-label required">
                                        <i class="fas fa-user"></i> Nombres
                                    </label>
                                    <input type="text" 
                                           class="form-control @error('nombres') is-invalid @enderror" 
                                           id="nombres" 
                                           name="nombres" 
                                           value="{{ old('nombres', $maestro->nombres) }}" 
                                           required>
                                    @error('nombres')
                                        <div class="invalid-feedback">
                                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="apellido_paterno" class="form-label required">
                                        <i class="fas fa-user"></i> Apellido Paterno
                                    </label>
                                    <input type="text" 
                                           class="form-control @error('apellido_paterno') is-invalid @enderror" 
                                           id="apellido_paterno" 
                                           name="apellido_paterno" 
                                           value="{{ old('apellido_paterno', $maestro->apellido_paterno) }}" 
                                           required>
                                    @error('apellido_paterno')
                                        <div class="invalid-feedback">
                                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="apellido_materno" class="form-label">
                                        <i class="fas fa-user"></i> Apellido Materno
                                    </label>
                                    <input type="text" 
                                           class="form-control @error('apellido_materno') is-invalid @enderror" 
                                           id="apellido_materno" 
                                           name="apellido_materno" 
                                           value="{{ old('apellido_materno', $maestro->apellido_materno) }}">
                                    @error('apellido_materno')
                                        <div class="invalid-feedback">
                                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Datos Demográficos -->
                        <div class="form-section">
                            <h3 class="section-title"><i class="fas fa-user-friends"></i> Datos Demográficos</h3>
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="fecha_nacimiento" class="form-label required">
                                        <i class="fas fa-birthday-cake"></i> Fecha de Nacimiento
                                    </label>
                                    <input type="date" 
                                           class="form-control @error('fecha_nacimiento') is-invalid @enderror" 
                                           id="fecha_nacimiento" 
                                           name="fecha_nacimiento" 
                                           value="{{ old('fecha_nacimiento', $maestro->fecha_nacimiento) }}" 
                                           required>
                                    @error('fecha_nacimiento')
                                        <div class="invalid-feedback">
                                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="edad" class="form-label required">
                                        <i class="fas fa-calendar-alt"></i> Edad
                                    </label>
                                    <div class="input-group">
                                        <input type="number" 
                                               class="form-control @error('edad') is-invalid @enderror" 
                                               id="edad" 
                                               name="edad" 
                                               min="18" 
                                               max="100"
                                               value="{{ old('edad', $maestro->edad) }}" 
                                               required>
                                        <span class="input-group-text">años</span>
                                    </div>
                                    @error('edad')
                                        <div class="invalid-feedback">
                                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="sexo" class="form-label">
                                        <i class="fas fa-venus-mars"></i> Sexo
                                    </label>
                                    <select class="form-select @error('sexo') is-invalid @enderror" 
                                            id="sexo" 
                                            name="sexo">
                                        <option value="">Seleccionar...</option>
                                        <option value="Masculino" {{ old('sexo', $maestro->sexo) == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                                        <option value="Femenino" {{ old('sexo', $maestro->sexo) == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                                        <option value="Otro" {{ old('sexo', $maestro->sexo) == 'Otro' ? 'selected' : '' }}>Otro</option>
                                    </select>
                                    @error('sexo')
                                        <div class="invalid-feedback">
                                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="estado_civil" class="form-label">
                                        <i class="fas fa-heart"></i> Estado Civil
                                    </label>
                                    <select class="form-select @error('estado_civil') is-invalid @enderror" 
                                            id="estado_civil" 
                                            name="estado_civil">
                                        <option value="">Seleccionar...</option>
                                        <option value="Soltero" {{ old('estado_civil', $maestro->estado_civil) == 'Soltero' ? 'selected' : '' }}>Soltero</option>
                                        <option value="Casado" {{ old('estado_civil', $maestro->estado_civil) == 'Casado' ? 'selected' : '' }}>Casado</option>
                                        <option value="Divorciado" {{ old('estado_civil', $maestro->estado_civil) == 'Divorciado' ? 'selected' : '' }}>Divorciado</option>
                                        <option value="Viudo" {{ old('estado_civil', $maestro->estado_civil) == 'Viudo' ? 'selected' : '' }}>Viudo</option>
                                        <option value="Unión Libre" {{ old('estado_civil', $maestro->estado_civil) == 'Unión Libre' ? 'selected' : '' }}>Unión Libre</option>
                                    </select>
                                    @error('estado_civil')
                                        <div class="invalid-feedback">
                                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Información de Contacto -->
                        <div class="form-section">
                            <h3 class="section-title"><i class="fas fa-address-card"></i> Información de Contacto</h3>
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="telefono" class="form-label">
                                        <i class="fas fa-phone"></i> Teléfono
                                    </label>
                                    <input type="text" 
                                           class="form-control @error('telefono') is-invalid @enderror" 
                                           id="telefono" 
                                           name="telefono" 
                                           value="{{ old('telefono', $maestro->telefono) }}"
                                           placeholder="Ej. 555-123-4567">
                                    @error('telefono')
                                        <div class="invalid-feedback">
                                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group" style="grid-column: span 2;">
                                    <label for="direccion" class="form-label">
                                        <i class="fas fa-home"></i> Dirección
                                    </label>
                                    <textarea class="form-control @error('direccion') is-invalid @enderror" 
                                              id="direccion" 
                                              name="direccion" 
                                              rows="3" 
                                              placeholder="Calle, número, colonia, ciudad...">{{ old('direccion', $maestro->direccion) }}</textarea>
                                    @error('direccion')
                                        <div class="invalid-feedback">
                                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Información Institucional (Solo lectura) -->
                        <div class="readonly-info">
                            <h5><i class="fas fa-info-circle"></i> Información Institucional (No editable)</h5>
                            <div class="info-grid">
                                <div class="info-item">
                                    <span class="info-label">Email Institucional</span>
                                    <span class="info-value">{{ $maestro->email }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">RFC</span>
                                    <span class="info-value">{{ $maestro->rfc }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">CURP</span>
                                    <span class="info-value">{{ $maestro->curp }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Coordinación</span>
                                    <span class="info-value">{{ $maestro->coordinacion->nombre ?? 'No asignada' }}</span>
                                </div>
                            </div>
                            <p style="margin-top: 15px; font-size: 13px; color: var(--text-muted);">
                                <i class="fas fa-exclamation-triangle"></i>
                                Para cambiar estos datos, contacta al administrador del sistema.
                            </p>
                        </div>

                        <!-- Acciones del Formulario -->
                        <div class="form-actions">
                            <a href="{{ route('profesor.mi-perfil') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times"></i> Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary" id="submitBtn">
                                <i class="fas fa-save"></i> Guardar Cambios
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Calcular edad automáticamente cuando cambia la fecha de nacimiento
            const fechaNacimientoInput = document.getElementById('fecha_nacimiento');
            const edadInput = document.getElementById('edad');
            
            if (fechaNacimientoInput && edadInput) {
                fechaNacimientoInput.addEventListener('change', function() {
                    const fechaNacimiento = new Date(this.value);
                    const hoy = new Date();
                    
                    if (!isNaN(fechaNacimiento.getTime())) {
                        let edad = hoy.getFullYear() - fechaNacimiento.getFullYear();
                        const mes = hoy.getMonth() - fechaNacimiento.getMonth();
                        
                        if (mes < 0 || (mes === 0 && hoy.getDate() < fechaNacimiento.getDate())) {
                            edad--;
                        }
                        
                        if (edad >= 18 && edad <= 100) {
                            edadInput.value = edad;
                        }
                    }
                });
            }
            
            // Validar edad cuando se cambia manualmente
            if (edadInput) {
                edadInput.addEventListener('change', function() {
                    const edad = parseInt(this.value);
                    if (edad < 18 || edad > 100) {
                        showToast('La edad debe estar entre 18 y 100 años', 'warning');
                        this.value = '';
                        this.focus();
                    }
                });
                
                edadInput.addEventListener('input', function() {
                    if (this.value < 18) this.value = 18;
                    if (this.value > 100) this.value = 100;
                });
            }
            
            // Manejar envío del formulario
            const profileForm = document.getElementById('profileForm');
            const submitBtn = document.getElementById('submitBtn');
            
            if (profileForm && submitBtn) {
                profileForm.addEventListener('submit', function(e) {
                    // Validación adicional de edad
                    const edad = parseInt(edadInput.value);
                    if (edad < 18 || edad > 100) {
                        e.preventDefault();
                        showToast('Por favor, ingresa una edad válida entre 18 y 100 años', 'error');
                        edadInput.focus();
                        return false;
                    }
                    
                    // Cambiar estado del botón
                    const originalText = submitBtn.innerHTML;
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Guardando...';
                    submitBtn.classList.add('loading');
                    submitBtn.disabled = true;
                    
                    // Mostrar mensaje de progreso
                    showToast('Guardando cambios...', 'info');
                    
                    // Revertir si hay error
                    setTimeout(() => {
                        submitBtn.innerHTML = originalText;
                        submitBtn.classList.remove('loading');
                        submitBtn.disabled = false;
                    }, 5000);
                    
                    return true;
                });
            }
            
            // Función para mostrar toasts
            function showToast(message, type = 'info') {
                const toast = document.createElement('div');
                toast.style.cssText = `
                    position: fixed;
                    top: 20px;
                    right: 20px;
                    padding: 15px 20px;
                    background: ${type === 'error' ? '#ef4444' : type === 'warning' ? '#f59e0b' : '#3b82f6'};
                    color: white;
                    border-radius: 10px;
                    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
                    z-index: 1000;
                    animation: slideInRight 0.3s ease;
                    max-width: 350px;
                    font-size: 14px;
                    display: flex;
                    align-items: center;
                    gap: 10px;
                `;
                
                const icon = type === 'error' ? 'exclamation-circle' : 
                            type === 'warning' ? 'exclamation-triangle' : 
                            'info-circle';
                
                toast.innerHTML = `
                    <i class="fas fa-${icon}"></i>
                    <span>${message}</span>
                `;
                
                document.body.appendChild(toast);
                
                setTimeout(() => {
                    toast.style.animation = 'slideOutRight 0.3s ease';
                    setTimeout(() => {
                        document.body.removeChild(toast);
                    }, 300);
                }, 4000);
            }
            
            // Añadir estilos para animaciones de toast
            const style = document.createElement('style');
            style.textContent = `
                @keyframes slideInRight {
                    from {
                        transform: translateX(100%);
                        opacity: 0;
                    }
                    to {
                        transform: translateX(0);
                        opacity: 1;
                    }
                }
                @keyframes slideOutRight {
                    from {
                        transform: translateX(0);
                        opacity: 1;
                    }
                    to {
                        transform: translateX(100%);
                        opacity: 0;
                    }
                }
            `;
            document.head.appendChild(style);
            
            // Validación en tiempo real
            const inputs = profileForm.querySelectorAll('input, select, textarea');
            inputs.forEach(input => {
                input.addEventListener('blur', function() {
                    validateField(this);
                });
                
                input.addEventListener('input', function() {
                    if (this.classList.contains('is-invalid')) {
                        this.classList.remove('is-invalid');
                        const feedback = this.nextElementSibling;
                        if (feedback && feedback.classList.contains('invalid-feedback')) {
                            feedback.style.display = 'none';
                        }
                    }
                });
            });
            
            function validateField(field) {
                // Validaciones específicas por tipo de campo
                if (field.hasAttribute('required') && !field.value.trim()) {
                    showFieldError(field, 'Este campo es requerido');
                    return false;
                }
                
                if (field.type === 'email' && field.value) {
                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!emailRegex.test(field.value)) {
                        showFieldError(field, 'Por favor ingresa un email válido');
                        return false;
                    }
                }
                
                if (field.id === 'telefono' && field.value) {
                    const phoneRegex = /^[\d\s\-\(\)]+$/;
                    if (!phoneRegex.test(field.value)) {
                        showFieldError(field, 'Por favor ingresa un número de teléfono válido');
                        return false;
                    }
                }
                
                return true;
            }
            
            function showFieldError(field, message) {
                field.classList.add('is-invalid');
                
                let feedback = field.nextElementSibling;
                if (!feedback || !feedback.classList.contains('invalid-feedback')) {
                    feedback = document.createElement('div');
                    feedback.className = 'invalid-feedback';
                    field.parentNode.insertBefore(feedback, field.nextSibling);
                }
                
                feedback.innerHTML = `<i class="fas fa-exclamation-circle"></i> ${message}`;
                feedback.style.display = 'flex';
            }
        });
    </script>
</body>
</html>