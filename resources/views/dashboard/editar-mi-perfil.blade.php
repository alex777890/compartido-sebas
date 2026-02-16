<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil - Sistema GEPROC</title>
    <!-- Font Awesome -->
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
            --card-shadow: 0 5px 20px rgba(7, 68, 182, 0.08);
            --card-shadow-hover: 0 10px 30px rgba(7, 68, 182, 0.12);
            --transition: all 0.3s ease;

            /* Colores de acento */
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
            --header-height: 90px;
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

        /* ===== MENÚ DE LA VISTA 02 - EXACTAMENTE IGUAL ===== */
        .header {
            height: var(--header-height);
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

        /* ===== ESTILOS DEL CUERPO MEJORADOS - SOBRIOS Y PROFESIONALES ===== */
        .control-panel {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            flex-wrap: wrap;
            gap: 20px;
        }

        .panel-title-section {
            flex: 1;
            min-width: 300px;
        }

        .main-title {
            font-size: 28px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 5px;
        }

        .subtitle {
            color: var(--text-muted);
            font-size: 15px;
            line-height: 1.5;
        }

        /* Botón Volver Elegante */
        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 12px 24px;
            background: white;
            color: var(--primary);
            border: 2px solid var(--primary);
            border-radius: 10px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
        }

        .btn-back:hover {
            background: var(--gradient-primary);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(7, 68, 182, 0.2);
            border-color: transparent;
        }

        /* Tarjeta de Perfil Principal */
        .profile-card {
            background: white;
            border-radius: 20px;
            box-shadow: var(--card-shadow);
            border: 2px solid var(--border-color);
            overflow: hidden;
            margin-bottom: 25px;
            transition: var(--transition);
        }

        .profile-card:hover {
            box-shadow: var(--card-shadow-hover);
        }

        .profile-header {
            background: var(--gradient-primary);
            color: white;
            padding: 30px 35px;
            position: relative;
            overflow: hidden;
        }

        .profile-header::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 250px;
            height: 250px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            transform: translate(30%, -30%);
        }

        .profile-header h1 {
            font-size: 30px;
            font-weight: 700;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 15px;
            position: relative;
            z-index: 2;
        }

        .profile-header p {
            font-size: 16px;
            opacity: 0.9;
            margin: 0;
            position: relative;
            z-index: 2;
            max-width: 600px;
        }

        .profile-content {
            padding: 35px;
        }

        /* Secciones del Formulario */
        .form-section {
            margin-bottom: 40px;
        }

        .section-title {
            font-size: 20px;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 25px;
            padding-bottom: 12px;
            border-bottom: 2px solid #e9ecef;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .section-title i {
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-size: 24px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 25px;
        }

        .form-group {
            margin-bottom: 0;
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
            font-size: 15px;
        }

        .required::after {
            content: ' *';
            color: var(--orange-dark);
            font-weight: 700;
        }

        .form-control, .form-select {
            border: 2px solid var(--border-color);
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 14px;
            transition: var(--transition);
            background: white;
            width: 100%;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(7, 68, 182, 0.08);
            outline: none;
        }

        .form-control.is-invalid {
            border-color: var(--orange-color);
        }

        .invalid-feedback {
            color: var(--orange-dark);
            font-size: 13px;
            margin-top: 5px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .input-group {
            position: relative;
        }

        .input-group-text {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            font-size: 13px;
            background: none;
            border: none;
            pointer-events: none;
            font-weight: 500;
        }

        /* Información de Solo Lectura */
        .readonly-info {
            background: var(--light-bg);
            border: 2px solid var(--border-color);
            border-radius: 16px;
            padding: 25px;
            margin-top: 30px;
        }

        .readonly-info h5 {
            color: var(--primary);
            margin-bottom: 20px;
            font-size: 18px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 700;
        }

        .readonly-info h5 i {
            color: var(--primary);
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
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
            font-weight: 600;
        }

        .info-value {
            font-weight: 600;
            color: #1e293b;
            font-size: 15px;
            background: white;
            padding: 8px 12px;
            border-radius: 8px;
            border: 1px solid var(--border-color);
        }

        /* Acciones del Formulario */
        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 20px;
            margin-top: 40px;
            padding-top: 25px;
            border-top: 2px solid var(--border-color);
        }

        .btn {
            padding: 14px 32px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 15px;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: var(--transition);
            border: none;
            cursor: pointer;
            text-decoration: none;
        }

        .btn-primary {
            background: var(--gradient-primary);
            color: white;
            box-shadow: 0 5px 15px rgba(7, 68, 182, 0.25);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(7, 68, 182, 0.35);
            color: white;
        }

        .btn-outline-secondary {
            background: white;
            color: var(--text-muted);
            border: 2px solid var(--border-color);
            font-weight: 600;
        }

        .btn-outline-secondary:hover {
            background: var(--light-bg);
            border-color: var(--primary);
            color: var(--primary);
            transform: translateY(-2px);
        }

        /* Alertas */
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

        /* Responsive */
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
            .control-panel {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .profile-content {
                padding: 25px;
            }

            .profile-header {
                padding: 25px;
            }

            .profile-header h1 {
                font-size: 26px;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .content-wrapper {
                padding: 15px;
            }

            .form-actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }

            .header-left {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .header-right {
                flex-wrap: wrap;
                justify-content: flex-end;
            }

            .logout-button {
                padding: 10px 20px;
                font-size: 14px;
            }
        }

        @media (max-width: 480px) {
            .content-wrapper {
                padding: 12px;
            }

            .profile-content {
                padding: 18px;
            }

            .profile-header h1 {
                font-size: 22px;
            }

            .section-title {
                font-size: 18px;
            }

            .btn-back {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <!-- HEADER SUPERIOR - COPIADO DE LA VISTA 02 -->
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
                    <a href="{{ route('maestros.grados.create') }}" class="nav-link">
                        <i class="fas fa-graduation-cap"></i> Grados
                    </a>
                    <a href="{{ route('editar-mi-perfil') }}" class="nav-link active">
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
                    <form action="{{ route('profesor.actualizar-perfil') }}" method="POST" id="profileForm">
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

                    // Revertir si hay error (timeout por si acaso)
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
            if (profileForm) {
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
            }

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