<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Mi Perfil - Sistema GEPROC</title>
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
            --success-color: #10b981;
            --danger-color: #ef4444;

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

        /* ===== HEADER COMPACTO IGUAL A LOS OTROS CÓDIGOS (SIN SALUDO) ===== */
        .header {
            background-color: white;
            box-shadow: 0 3px 20px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 100;
            border-bottom: 4px solid var(--primary);
        }

        .header-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 12px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            flex-wrap: wrap;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 30px;
            flex-wrap: wrap;
        }

        .logo-img-header {
            height: 55px;
            width: auto;
            max-width: 150px;
            object-fit: contain;
        }

        .header-nav {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .nav-link {
            padding: 10px 18px;
            color: #4a5568;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            border-radius: 10px;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 10px;
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
            font-weight: 700;
        }

        .nav-link i {
            font-size: 14px;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .logout-button {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 20px;
            background-color: white;
            color: #4a5568;
            border: none;
            border-radius: 50px;
            font-weight: 600;
            font-size: 13px;
            cursor: pointer;
            transition: var(--transition);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .logout-button:hover {
            background-color: #fee2e2;
            color: var(--danger-color);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(239, 68, 68, 0.15);
        }

        .main-content {
            width: 100%;
            max-width: 1400px;
            margin: 0 auto;
        }

        .content-wrapper {
            padding: 25px 20px;
        }

        /* ===== MEDIA QUERIES COMPACTAS ===== */
        @media (max-width: 1200px) {
            .header-container {
                padding: 12px 20px;
            }
            
            .header-left {
                gap: 20px;
            }
            
            .nav-link {
                padding: 8px 14px;
                font-size: 13px;
            }
            
            .content-wrapper {
                padding: 20px;
            }
        }

        @media (max-width: 768px) {
            .header-container {
                flex-direction: column;
                align-items: stretch;
                padding: 12px 15px;
            }
            
            .header-left {
                flex-direction: column;
                align-items: stretch;
                gap: 12px;
            }
            
            .header-nav {
               justify-content: center;
                overflow-x: auto;
                padding-bottom: 8px;
                -webkit-overflow-scrolling: touch;
            }
            
            .nav-link {
                padding: 8px 12px;
                font-size: 12px;
            }
            
            .nav-link i {
                font-size: 12px;
            }
            
            .header-right {
                justify-content: center;
            }
            
            .content-wrapper {
                padding: 15px;
            }
            
            .logo-img-header {
                height: 45px;
            }
            
            .logout-button {
                padding: 6px 16px;
                font-size: 12px;
            }
        }

        @media (max-width: 480px) {
            .nav-link span {
                display: none;
            }
            
            .nav-link i {
                margin: 0;
                font-size: 16px;
            }
            
            .nav-link {
                padding: 8px 12px;
            }
            
            .logout-button span {
                display: inline;
            }
        }

        /* ===== ESTILOS DEL CUERPO ===== */
        .control-panel {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .panel-title-section {
            flex: 1;
            min-width: 250px;
        }

        .main-title {
            font-size: 24px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 5px;
        }

        .subtitle {
            color: var(--text-muted);
            font-size: 14px;
            line-height: 1.5;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background: white;
            color: var(--primary);
            border: 2px solid var(--primary);
            border-radius: 10px;
            font-weight: 600;
            font-size: 13px;
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
        }

        .btn-back:hover {
            background: var(--gradient-primary);
            color: white;
            transform: translateY(-2px);
            border-color: transparent;
        }

        .btn-edit {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 24px;
            background: var(--gradient-primary);
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
            box-shadow: 0 4px 12px rgba(7, 68, 182, 0.2);
        }

        .btn-edit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(7, 68, 182, 0.3);
        }

        .btn-edit i {
            font-size: 14px;
        }

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
            font-size: 26px;
            font-weight: 700;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 12px;
            position: relative;
            z-index: 2;
        }

        .profile-header p {
            font-size: 14px;
            opacity: 0.9;
            margin: 0;
            position: relative;
            z-index: 2;
            max-width: 600px;
        }

        .profile-content {
            padding: 25px;
        }

        .info-section {
            margin-bottom: 25px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 20px;
        }

        .info-card {
            background: var(--light-bg);
            border: 2px solid var(--border-color);
            border-radius: 14px;
            padding: 20px;
            transition: var(--transition);
        }

        .info-card:hover {
            border-color: var(--primary-light);
            box-shadow: var(--card-shadow);
        }

        .info-card-title {
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--primary);
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 16px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--border-color);
        }

        .info-card-title i {
            font-size: 18px;
        }

        .info-item {
            display: flex;
            margin-bottom: 12px;
            padding: 6px 0;
            border-bottom: 1px dashed rgba(0,0,0,0.05);
        }

        .info-item:last-child {
            border-bottom: none;
        }

        .info-label {
            width: 120px;
            color: var(--text-muted);
            font-weight: 500;
            font-size: 13px;
        }

        .info-value {
            flex: 1;
            color: #1e293b;
            font-weight: 600;
            font-size: 14px;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 12px;
            border-radius: 30px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-success {
            background: var(--green-light);
            color: var(--green-dark);
        }

        .badge-info {
            background: var(--blue-light);
            color: var(--blue-dark);
        }

        /* Formulario de Edición */
        .edit-form-container {
            display: none;
            animation: slideDown 0.4s ease;
        }

        .edit-form-container.show {
            display: block;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-15px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-section {
            margin-bottom: 30px;
        }

        .section-title {
            font-size: 18px;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #e9ecef;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-title i {
            font-size: 20px;
            color: var(--primary);
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }

        .form-group {
            margin-bottom: 0;
        }

        .form-label {
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 6px;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
        }

        .form-label i {
            color: var(--primary);
            width: 16px;
            text-align: center;
            font-size: 13px;
        }

        .required::after {
            content: ' *';
            color: var(--orange-dark);
            font-weight: 700;
        }

        .form-control, .form-select {
            border: 2px solid var(--border-color);
            border-radius: 10px;
            padding: 10px 14px;
            font-size: 13px;
            transition: var(--transition);
            background: white;
            width: 100%;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(7, 68, 182, 0.08);
            outline: none;
        }

        .input-group {
            position: relative;
        }

        .input-group-text {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            font-size: 12px;
            background: none;
            border: none;
            pointer-events: none;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px solid var(--border-color);
        }

        .btn {
            padding: 10px 24px;
            border-radius: 10px;
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
            box-shadow: 0 4px 12px rgba(7, 68, 182, 0.2);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(7, 68, 182, 0.3);
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
            padding: 12px 18px;
            border-radius: 12px;
            margin-bottom: 20px;
            display: flex;
            align-items: flex-start;
            gap: 12px;
            border-left: 4px solid;
            font-size: 13px;
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
            font-size: 16px;
        }

        /* Responsive adicionales */
        @media (max-width: 992px) {
            .control-panel {
                flex-direction: column;
                align-items: flex-start;
            }

            .info-grid {
                grid-template-columns: 1fr;
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
        }

        @media (max-width: 768px) {
            .form-actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }

            .info-label {
                width: 100px;
            }
        }

        @media (max-width: 480px) {
            .profile-content {
                padding: 15px;
            }

            .profile-header h1 {
                font-size: 18px;
            }

            .section-title {
                font-size: 16px;
            }

            .btn-back, .btn-edit {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <div class="main-content">
        <!-- HEADER COMPACTO SIN SALUDO -->
        <div class="header">
            <div class="header-container">
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
                        <a href="{{ route('maestros.grados.index') }}" class="nav-link">
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
                            <i class="fas fa-sign-out-alt"></i> <span>Cerrar Sesión</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>

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
                    <ul style="margin: 8px 0 0 20px; font-size: 12px;">
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
                    <h1 class="main-title">Mi Perfil</h1>
                    <p class="subtitle">Revisa la información de tu perfil guardada y si es necesario edita tu perfil</p>
                </div>
                <div class="action-buttons">
                    <button id="toggleEditBtn" class="btn-edit">
                        <i class="fas fa-edit"></i>
                        <span id="btnText">Editar Perfil</span>
                    </button>
                </div>
            </div>

            <!-- TARJETA DE PERFIL -->
            <div class="profile-card">
                <div class="profile-header">
                    <h1><i class="fas fa-user-circle"></i> {{ $maestro->nombres }} {{ $maestro->apellido_paterno }} {{ $maestro->apellido_materno }}</h1>
                    <p>{{ $maestro->email }} · {{ $maestro->coordinacion->nombre ?? 'Coordinación no asignada' }}</p>
                </div>

                <div class="profile-content">
                    <!-- SECCIÓN DE INFORMACIÓN DEL MAESTRO (SIEMPRE VISIBLE) -->
                    <div id="infoSection" class="info-section">
                        <div class="info-grid">
                            <!-- Información Personal -->
                            <div class="info-card">
                                <div class="info-card-title">
                                    <i class="fas fa-user"></i>
                                    <span>Información Personal</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Nombres:</span>
                                    <span class="info-value">{{ $maestro->nombres }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Apellidos:</span>
                                    <span class="info-value">{{ $maestro->apellido_paterno }} {{ $maestro->apellido_materno }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Fecha Nacimiento:</span>
                                    <span class="info-value">{{ \Carbon\Carbon::parse($maestro->fecha_nacimiento)->format('d/m/Y') }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Edad:</span>
                                    <span class="info-value">{{ $maestro->edad }} años</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Género:</span>
                                    <span class="info-value">{{ $maestro->sexo ?? 'No especificado' }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Estado Civil:</span>
                                    <span class="info-value">{{ $maestro->estado_civil ?? 'No especificado' }}</span>
                                </div>
                            </div>

                            <!-- Información de Contacto -->
                            <div class="info-card">
                                <div class="info-card-title">
                                    <i class="fas fa-address-card"></i>
                                    <span>Contacto</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Teléfono:</span>
                                    <span class="info-value">{{ $maestro->telefono ?? 'No registrado' }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Email:</span>
                                    <span class="info-value">{{ $maestro->email }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Dirección:</span>
                                    <span class="info-value">{{ $maestro->direccion ?? 'No registrada' }}</span>
                                </div>
                            </div>

                            <!-- Información Institucional -->
                            <div class="info-card">
                                <div class="info-card-title">
                                    <i class="fas fa-building"></i>
                                    <span>Información Institucional</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">RFC:</span>
                                    <span class="info-value">{{ $maestro->rfc }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">CURP:</span>
                                    <span class="info-value">{{ $maestro->curp }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Grado Académico:</span>
                                    <span class="info-value">{{ $maestro->maximo_grado_academico ?? 'No especificado' }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Coordinación:</span>
                                    <span class="info-value">
                                        <span class="badge badge-info">
                                            <i class="fas fa-check-circle"></i>
                                            {{ $maestro->coordinacion->nombre ?? 'No asignada' }}
                                        </span>
                                    </span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Estado:</span>
                                    <span class="info-value">
                                        @if($maestro->activo)
                                            <span class="badge badge-success">
                                                <i class="fas fa-check-circle"></i> Activo
                                            </span>
                                        @else
                                            <span class="badge badge-danger">
                                                <i class="fas fa-times-circle"></i> Inactivo
                                            </span>
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- FORMULARIO DE EDICIÓN (OCULTO INICIALMENTE) -->
                    <div id="editFormContainer" class="edit-form-container">
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
                                            <div class="invalid-feedback">{{ $message }}</div>
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
                                            <div class="invalid-feedback">{{ $message }}</div>
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
                                            <div class="invalid-feedback">{{ $message }}</div>
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
                                               value="{{ old('fecha_nacimiento', $maestro->fecha_nacimiento ? \Carbon\Carbon::parse($maestro->fecha_nacimiento)->format('Y-m-d') : '') }}"
                                               required>
                                        @error('fecha_nacimiento')
                                            <div class="invalid-feedback">{{ $message }}</div>
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
                                            <div class="invalid-feedback">{{ $message }}</div>
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
                                            <div class="invalid-feedback">{{ $message }}</div>
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
                                            <div class="invalid-feedback">{{ $message }}</div>
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
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group" style="grid-column: span 2;">
                                        <label for="direccion" class="form-label">
                                            <i class="fas fa-home"></i> Dirección
                                        </label>
                                        <textarea class="form-control @error('direccion') is-invalid @enderror"
                                                  id="direccion"
                                                  name="direccion"
                                                  rows="2"
                                                  placeholder="Calle, número, colonia, ciudad...">{{ old('direccion', $maestro->direccion) }}</textarea>
                                        @error('direccion')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Información Institucional -->
                            <div class="form-section">
                                <h3 class="section-title"><i class="fas fa-building"></i> Información Importante</h3>
                                <div class="form-grid">
                                    <div class="form-group">
                                        <label for="email" class="form-label required">
                                            <i class="fas fa-envelope"></i> Email Institucional
                                        </label>
                                        <input type="email"
                                               class="form-control @error('email') is-invalid @enderror"
                                               id="email"
                                               name="email"
                                               value="{{ old('email', $maestro->email) }}"
                                               required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="rfc" class="form-label required">
                                            <i class="fas fa-id-card"></i> RFC
                                        </label>
                                        <input type="text"
                                               class="form-control @error('rfc') is-invalid @enderror"
                                               id="rfc"
                                               name="rfc"
                                               value="{{ old('rfc', $maestro->rfc) }}"
                                               maxlength="13"
                                               required>
                                        @error('rfc')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="curp" class="form-label required">
                                            <i class="fas fa-id-card"></i> CURP
                                        </label>
                                        <input type="text"
                                               class="form-control @error('curp') is-invalid @enderror"
                                               id="curp"
                                               name="curp"
                                               value="{{ old('curp', $maestro->curp) }}"
                                               maxlength="18"
                                               required>
                                        @error('curp')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="maximo_grado_academico" class="form-label required">
                                            <i class="fas fa-graduation-cap"></i> Máximo Grado Académico
                                        </label>
                                        <select class="form-select @error('maximo_grado_academico') is-invalid @enderror"
                                                id="maximo_grado_academico"
                                                name="maximo_grado_academico"
                                                required>
                                            <option value="">Seleccionar...</option>
                                            <option value="Licenciatura" {{ old('maximo_grado_academico', $maestro->maximo_grado_academico) == 'Licenciatura' ? 'selected' : '' }}>Licenciatura</option>
                                            <option value="Especialidad" {{ old('maximo_grado_academico', $maestro->maximo_grado_academico) == 'Especialidad' ? 'selected' : '' }}>Especialidad</option>
                                            <option value="Maestría" {{ old('maximo_grado_academico', $maestro->maximo_grado_academico) == 'Maestría' ? 'selected' : '' }}>Maestría</option>
                                            <option value="Doctorado" {{ old('maximo_grado_academico', $maestro->maximo_grado_academico) == 'Doctorado' ? 'selected' : '' }}>Doctorado</option>
                                        </select>
                                        @error('maximo_grado_academico')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="coordinaciones_id" class="form-label required">
                                            <i class="fas fa-building"></i> Coordinación
                                        </label>
                                        <select class="form-select @error('coordinaciones_id') is-invalid @enderror"
                                                id="coordinaciones_id"
                                                name="coordinaciones_id"
                                                required>
                                            <option value="">Seleccionar...</option>
                                            @foreach($coordinaciones ?? [] as $coordinacion)
                                                <option value="{{ $coordinacion->id }}" {{ old('coordinaciones_id', $maestro->coordinaciones_id) == $coordinacion->id ? 'selected' : '' }}>
                                                    {{ $coordinacion->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('coordinaciones_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Acciones del Formulario -->
                            <div class="form-actions">
                                <button type="button" id="cancelEditBtn" class="btn btn-outline-secondary">
                                    <i class="fas fa-times"></i> Cancelar
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Guardar Cambios
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleBtn = document.getElementById('toggleEditBtn');
            const cancelBtn = document.getElementById('cancelEditBtn');
            const infoSection = document.getElementById('infoSection');
            const editFormContainer = document.getElementById('editFormContainer');
            const btnText = document.getElementById('btnText');
            
            let isEditMode = false;

            function toggleEditMode() {
                isEditMode = !isEditMode;
                
                if (isEditMode) {
                    infoSection.style.display = 'none';
                    editFormContainer.classList.add('show');
                    btnText.textContent = 'Ver Perfil';
                } else {
                    infoSection.style.display = 'block';
                    editFormContainer.classList.remove('show');
                    btnText.textContent = 'Editar Perfil';
                }
            }

            if (toggleBtn) {
                toggleBtn.addEventListener('click', toggleEditMode);
            }

            if (cancelBtn) {
                cancelBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    if (isEditMode) {
                        toggleEditMode();
                    }
                });
            }

            // Si hay errores, mostrar formulario
            @if($errors->any())
                infoSection.style.display = 'none';
                editFormContainer.classList.add('show');
                btnText.textContent = 'Ver Perfil';
                isEditMode = true;
            @endif

            // Calcular edad automáticamente
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

            // Validar edad
            if (edadInput) {
                edadInput.addEventListener('change', function() {
                    const edad = parseInt(this.value);
                    if (edad < 18 || edad > 100) {
                        alert('La edad debe estar entre 18 y 100 años');
                        this.value = '';
                    }
                });

                edadInput.addEventListener('input', function() {
                    if (this.value < 18) this.value = 18;
                    if (this.value > 100) this.value = 100;
                });
            }
        });
    </script>
</body>
</html>