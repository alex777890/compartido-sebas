<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Completar Perfil - Administrativo | GEPROC</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
            --border-radius: 12px;
            --gradient-primary: linear-gradient(135deg, #0744b6ff 0%, #3a6bd3 100%);
            --gradient-success: linear-gradient(135deg, #10b981 0%, #34d399 100%);
            --gradient-warning: linear-gradient(135deg, #f59e0b 0%, #fbbf24 100%);
            --gradient-danger: linear-gradient(135deg, #ef4444 0%, #f87171 100%);
            --gradient-info: linear-gradient(135deg, #3b82f6 0%, #60a5fa 100%);
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

        /* ===== HEADER SUPERIOR ===== */
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

        .header-right {
            display: flex;
            align-items: center;
            gap: 30px;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 8px 16px;
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

        .user-info {
            display: flex;
            flex-direction: column;
        }

        .user-info h4 {
            font-size: 15px;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 2px;
            white-space: nowrap;
        }

        .user-info p {
            font-size: 12px;
            color: var(--text-muted);
            white-space: nowrap;
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
        }

        .content-wrapper {
            padding: 30px 35px;
            max-width: 100%;
        }

        /* HEADER DEL CONTENIDO */
        .content-header {
            background-color: white;
            border-radius: var(--border-radius);
            padding: 25px 30px;
            margin-bottom: 25px;
            box-shadow: var(--card-shadow);
            border: 2px solid var(--border-color);
            transition: var(--transition);
            position: relative;
            overflow: hidden;
            text-align: center;
        }

        .content-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--gradient-primary);
        }

        .content-header:hover {
            transform: translateY(-3px);
            box-shadow: var(--card-shadow-hover);
        }

        .content-header h1 {
            font-size: 28px;
            font-weight: 800;
            color: #1e293b;
            margin: 0 0 8px 0;
        }

        .content-header p {
            color: var(--text-muted);
            font-size: 15px;
            margin: 0;
        }

        /* PROGRESS STEPS */
        .progress-steps {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
            position: relative;
            background: white;
            padding: 20px 30px;
            border-radius: var(--border-radius);
            border: 2px solid var(--border-color);
            box-shadow: var(--card-shadow);
        }

        .progress-steps::before {
            content: '';
            position: absolute;
            top: 40px;
            left: 80px;
            right: 80px;
            height: 2px;
            background: var(--border-color);
            z-index: 1;
        }

        .step {
            position: relative;
            z-index: 2;
            background: white;
            text-align: center;
            flex: 1;
        }

        .step-number {
            width: 45px;
            height: 45px;
            background: var(--light-bg);
            border: 2px solid var(--border-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 18px;
            color: var(--text-muted);
            margin: 0 auto 10px;
            transition: var(--transition);
        }

        .step.active .step-number {
            background: var(--gradient-primary);
            border-color: var(--primary);
            color: white;
            box-shadow: 0 0 0 4px rgba(7, 68, 182, 0.2);
        }

        .step.completed .step-number {
            background: var(--gradient-success);
            border-color: var(--success-color);
            color: white;
        }

        .step-label {
            font-size: 14px;
            font-weight: 600;
            color: var(--text-muted);
        }

        .step.active .step-label {
            color: var(--primary);
        }

        .step.completed .step-label {
            color: var(--success-color);
        }

        /* SECCIÓN PRINCIPAL */
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

        .section-title {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 18px;
            color: var(--primary);
            font-weight: 700;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid var(--light-bg);
        }

        .section-title i {
            font-size: 20px;
        }

        /* FORMULARIO */
        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group.full-width {
            grid-column: 1 / -1;
        }

        .form-label {
            font-size: 14px;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-label i {
            color: var(--primary);
            font-size: 14px;
        }

        .required-star {
            color: var(--danger-color);
            font-size: 14px;
        }

        .form-control, .form-select {
            padding: 12px 16px;
            border: 2px solid var(--border-color);
            border-radius: 10px;
            font-size: 15px;
            transition: var(--transition);
            background-color: white;
            width: 100%;
        }

        .form-control:focus, .form-select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(7, 68, 182, 0.1);
        }

        .form-control.is-invalid, .form-select.is-invalid {
            border-color: var(--danger-color);
        }

        .invalid-feedback {
            color: var(--danger-color);
            font-size: 13px;
            margin-top: 5px;
        }

        small.text-muted {
            display: block;
            margin-top: 5px;
            font-size: 12px;
            color: var(--text-muted);
        }

        /* ALERTAS */
        .alert {
            padding: 15px 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 15px;
            border-left: 6px solid transparent;
            animation: slideIn 0.3s ease;
            font-size: 15px;
            box-shadow: var(--card-shadow);
        }

        .alert-danger {
            background-color: var(--danger-light);
            border-color: var(--danger-color);
            color: #991b1b;
        }

        .alert ul {
            margin-left: 20px;
            margin-top: 8px;
        }

        .alert i {
            font-size: 22px;
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

        /* INFO NOTE */
        .info-note {
            background-color: var(--primary-soft);
            border-left: 4px solid var(--primary);
            padding: 15px 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 15px;
            font-size: 14px;
            color: #2d3748;
        }

        .info-note i {
            color: var(--primary);
            font-size: 20px;
        }

        /* BOTONES DE NAVEGACIÓN */
        .form-actions {
            display: flex;
            justify-content: space-between;
            gap: 15px;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 2px solid var(--border-color);
            flex-wrap: wrap;
        }

        .btn-prev {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            background: transparent;
            color: var(--primary);
            border: 2px solid var(--primary);
            border-radius: 10px;
            font-weight: 600;
            font-size: 15px;
            cursor: pointer;
            transition: var(--transition);
        }

        .btn-prev:hover {
            background-color: var(--primary);
            color: white;
            transform: translateY(-2px);
        }

        .btn-next {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 28px;
            background: var(--gradient-primary);
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: 700;
            font-size: 15px;
            cursor: pointer;
            transition: var(--transition);
            box-shadow: 0 5px 15px rgba(7, 68, 182, 0.25);
        }

        .btn-next:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(7, 68, 182, 0.35);
        }

        .btn-submit {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 32px;
            background: var(--gradient-success);
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: 700;
            font-size: 15px;
            cursor: pointer;
            transition: var(--transition);
            box-shadow: 0 5px 15px rgba(16, 185, 129, 0.25);
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(16, 185, 129, 0.35);
        }

        .btn-cancel {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            background: transparent;
            color: #4a5568;
            border: 2px solid var(--border-color);
            border-radius: 10px;
            font-weight: 600;
            font-size: 15px;
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
        }

        .btn-cancel:hover {
            background-color: var(--danger-light);
            border-color: var(--danger-color);
            color: var(--danger-color);
            transform: translateY(-2px);
        }

        /* PESTAÑAS */
        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
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
            
            .content-wrapper {
                padding: 20px 25px;
            }
        }

        @media (max-width: 992px) {
            .form-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .user-info h4 {
                font-size: 14px;
            }
            
            .user-info p {
                font-size: 11px;
            }
            
            .section {
                padding: 18px;
            }
            
            .header-right {
                flex-wrap: wrap;
                justify-content: flex-end;
            }
            
            .content-header h1 {
                font-size: 24px;
            }
            
            .logout-button {
                padding: 8px 16px;
                font-size: 13px;
            }
            
            .user-profile {
                padding: 6px 12px;
            }
            
            .user-avatar {
                width: 35px;
                height: 35px;
                font-size: 14px;
            }
            
            .progress-steps {
                flex-direction: column;
                gap: 15px;
            }
            
            .progress-steps::before {
                display: none;
            }
            
            .step {
                display: flex;
                align-items: center;
                gap: 15px;
            }
            
            .step-number {
                margin: 0;
            }
            
            .form-actions {
                flex-direction: column;
            }
            
            .btn-prev, .btn-next, .btn-submit, .btn-cancel {
                width: 100%;
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            .content-wrapper {
                padding: 15px;
            }
            
            .section-title {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>

@php
    use Illuminate\Support\Facades\Auth;
    
    $user = Auth::user();
    $userInitials = '';
    if ($user && $user->name) {
        $names = explode(' ', $user->name);
        foreach ($names as $name) {
            if (!empty($name)) {
                $userInitials .= strtoupper(substr($name, 0, 1));
            }
        }
        $userInitials = substr($userInitials, 0, 2);
    }
@endphp

<div class="main-content">
    <!-- HEADER SUPERIOR -->
    <div class="header">
        <div class="header-left">
            <div class="header-logo">
                <img src="{{ asset('img/logo_iufim.png') }}" alt="Logo IUFIM" class="logo-img-header">
            </div>
        </div>
        
        <div class="header-right">
            
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-button">
                    <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                </button>
            </form>
        </div>
    </div>

    <!-- CONTENIDO PRINCIPAL -->
    <div class="content-wrapper">
        <!-- HEADER -->
        <div class="content-header">
            <h1>Completar Perfil</h1>
            <p><i class="fas fa-clipboard-list" style="color: var(--primary); margin-right: 8px;"></i>Por favor completa la siguiente información (todos los campos son obligatorios)</p>
        </div>

        <!-- PROGRESS STEPS -->
        <div class="progress-steps">
            <div class="step active" data-step="1">
                <div class="step-number">1</div>
                <div class="step-label">Información Personal</div>
            </div>
            <div class="step" data-step="2">
                <div class="step-number">2</div>
                <div class="step-label">Información Laboral</div>
            </div>
            <div class="step" data-step="3">
                <div class="step-number">3</div>
                <div class="step-label">Documentos</div>
            </div>
        </div>

        <!-- INFO NOTE -->
        <div class="info-note">
            <i class="fas fa-info-circle"></i>
            <span>Los campos marcados con <strong style="color: var(--danger-color);">*</strong> son obligatorios. Los documentos deben ser en formato <strong>PDF</strong> (máximo 4MB).</span>
        </div>

        <!-- ERRORES -->
        @if($errors->any())
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-triangle"></i>
                <div>
                    <strong>Por favor corrige los siguientes errores:</strong>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <!-- FORMULARIO -->
        <div class="section">
            <form method="POST" action="{{ route('administrativos.guardar-perfil') }}" enctype="multipart/form-data" id="profileForm">
                @csrf

                <!-- TAB 1: INFORMACIÓN PERSONAL -->
                <div id="tab1" class="tab-content active">
                    <div class="section-title">
                        <i class="fas fa-user"></i>
                        <span>Información Personal</span>
                    </div>

                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-user"></i> Nombres <span class="required-star">*</span>
                            </label>
                            <input type="text" class="form-control @error('nombres') is-invalid @enderror" id="nombres" name="nombres" value="{{ old('nombres') }}" required placeholder="Ej: Juan Carlos">
                            @error('nombres')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-user"></i> Apellido Paterno <span class="required-star">*</span>
                            </label>
                            <input type="text" class="form-control @error('apellido_paterno') is-invalid @enderror" id="apellido_paterno" name="apellido_paterno" value="{{ old('apellido_paterno') }}" required placeholder="Ej: Perez">
                            @error('apellido_paterno')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-user"></i> Apellido Materno
                            </label>
                            <input type="text" class="form-control @error('apellido_materno') is-invalid @enderror" id="apellido_materno" name="apellido_materno" value="{{ old('apellido_materno') }}" placeholder="Ej: Gonzalez">
                            @error('apellido_materno')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-calendar"></i> Fecha de Nacimiento <span class="required-star">*</span>
                            </label>
                            <input type="date" class="form-control @error('fecha_nacimiento') is-invalid @enderror" id="fecha_nacimiento" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" required>
                            @error('fecha_nacimiento')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-cake-candles"></i> Edad <span class="required-star">*</span>
                            </label>
                            <input type="number" class="form-control @error('edad') is-invalid @enderror" id="edad" name="edad" value="{{ old('edad') }}" required min="18" max="100" placeholder="Ej: 25">
                            @error('edad')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-venus-mars"></i> Género <span class="required-star">*</span>
                            </label>
                            <select class="form-control @error('genero') is-invalid @enderror" id="genero" name="genero" required>
                                <option value="">Seleccione...</option>
                                <option value="M" {{ old('genero') == 'M' ? 'selected' : '' }}>Masculino</option>
                                <option value="F" {{ old('genero') == 'F' ? 'selected' : '' }}>Femenino</option>
                                <option value="OTRO" {{ old('genero') == 'OTRO' ? 'selected' : '' }}>Otro</option>
                            </select>
                            @error('genero')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-flag"></i> Nacionalidad <span class="required-star">*</span>
                            </label>
                            <input type="text" class="form-control @error('nacionalidad') is-invalid @enderror" id="nacionalidad" name="nacionalidad" value="{{ old('nacionalidad') }}" required placeholder="Ej: Mexicana">
                            @error('nacionalidad')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-heart"></i> Estado Civil <span class="required-star">*</span>
                            </label>
                            <select class="form-control @error('estado_civil') is-invalid @enderror" id="estado_civil" name="estado_civil" required>
                                <option value="">Seleccione...</option>
                                <option value="SOLTERO(A)" {{ old('estado_civil') == 'SOLTERO(A)' ? 'selected' : '' }}>Soltero(a)</option>
                                <option value="CASADO(A)" {{ old('estado_civil') == 'CASADO(A)' ? 'selected' : '' }}>Casado(a)</option>
                                <option value="DIVORCIADO(A)" {{ old('estado_civil') == 'DIVORCIADO(A)' ? 'selected' : '' }}>Divorciado(a)</option>
                                <option value="VIUDO(A)" {{ old('estado_civil') == 'VIUDO(A)' ? 'selected' : '' }}>Viudo(a)</option>
                                <option value="UNION LIBRE" {{ old('estado_civil') == 'UNION LIBRE' ? 'selected' : '' }}>Unión Libre</option>
                            </select>
                            @error('estado_civil')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-map-marker-alt"></i> Lugar de Nacimiento <span class="required-star">*</span>
                            </label>
                            <input type="text" class="form-control @error('lugar_nacimiento') is-invalid @enderror" id="lugar_nacimiento" name="lugar_nacimiento" value="{{ old('lugar_nacimiento') }}" required placeholder="Ej: Ciudad de Mexico, CDMX">
                            @error('lugar_nacimiento')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-phone-alt"></i> Teléfono Celular <span class="required-star">*</span>
                            </label>
                            <input type="tel" class="form-control @error('telefono_celular') is-invalid @enderror" id="telefono_celular" name="telefono_celular" value="{{ old('telefono_celular') }}" required placeholder="Ej: 5512345678">
                            @error('telefono_celular')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-phone"></i> Teléfono Fijo
                            </label>
                            <input type="tel" class="form-control @error('telefono_fijo') is-invalid @enderror" id="telefono_fijo" name="telefono_fijo" value="{{ old('telefono_fijo') }}" placeholder="Ej: 5555555555">
                            @error('telefono_fijo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group full-width">
                            <label class="form-label">
                                <i class="fas fa-envelope"></i> Correo Electrónico Personal <span class="required-star">*</span>
                            </label>
                            <input type="email" class="form-control @error('email_personal') is-invalid @enderror" id="email_personal" name="email_personal" value="{{ old('email_personal') }}" required placeholder="ejemplo@correo.com">
                            @error('email_personal')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group full-width">
                            <label class="form-label">
                                <i class="fas fa-home"></i> Domicilio <span class="required-star">*</span>
                            </label>
                            <input type="text" class="form-control @error('domicilio') is-invalid @enderror" id="domicilio" name="domicilio" value="{{ old('domicilio') }}" required placeholder="Calle y número">
                            @error('domicilio')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-location-dot"></i> Colonia <span class="required-star">*</span>
                            </label>
                            <input type="text" class="form-control @error('colonia') is-invalid @enderror" id="colonia" name="colonia" value="{{ old('colonia') }}" required placeholder="Ej: Centro">
                            @error('colonia')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-mail-bulk"></i> Código Postal <span class="required-star">*</span>
                            </label>
                            <input type="text" class="form-control @error('codigo_postal') is-invalid @enderror" id="codigo_postal" name="codigo_postal" value="{{ old('codigo_postal') }}" required maxlength="5" placeholder="Ej: 12345">
                            @error('codigo_postal')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-city"></i> Municipio <span class="required-star">*</span>
                            </label>
                            <input type="text" class="form-control @error('municipio') is-invalid @enderror" id="municipio" name="municipio" value="{{ old('municipio') }}" required placeholder="Ej: Cuauhtémoc">
                            @error('municipio')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-building"></i> Ciudad o Población <span class="required-star">*</span>
                            </label>
                            <input type="text" class="form-control @error('ciudad_poblacion') is-invalid @enderror" id="ciudad_poblacion" name="ciudad_poblacion" value="{{ old('ciudad_poblacion') }}" required placeholder="Ej: Ciudad de México">
                            @error('ciudad_poblacion')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                <!-- TAB 2: INFORMACIÓN LABORAL -->
                <div id="tab2" class="tab-content">
                    <div class="section-title">
                        <i class="fas fa-briefcase"></i>
                        <span>Información Laboral</span>
                    </div>

                    <div class="form-grid">
                        <div class="form-group full-width">
                            <label class="form-label">
                                <i class="fas fa-user-tag"></i> Puesto <span class="required-star">*</span>
                            </label>
                            <input type="text" class="form-control @error('puesto') is-invalid @enderror" id="puesto" name="puesto" value="{{ old('puesto') }}" required placeholder="Ej: Auxiliar Administrativo">
                            @error('puesto')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                <!-- TAB 3: DOCUMENTOS -->
                <div id="tab3" class="tab-content">
                    <div class="section-title">
                        <i class="fas fa-file-pdf"></i>
                        <span>Documentos Requeridos (PDF - Máx. 4MB)</span>
                    </div>

                    @php
                        $documentosRequeridos = [
                            'solicitud_empleo' => ['nombre' => 'Solicitud de Empleo', 'icono' => 'file-alt', 'descripcion' => 'Formato de solicitud de empleo'],
                            'curriculum_vitae' => ['nombre' => 'Curriculum Vitae', 'icono' => 'file-alt', 'descripcion' => 'Hoja de vida actualizada'],
                            'acta_nacimiento' => ['nombre' => 'Acta de Nacimiento', 'icono' => 'file', 'descripcion' => 'Acta de nacimiento certificada'],
                            'curp_documento' => ['nombre' => 'CURP', 'icono' => 'id-card', 'descripcion' => 'CURP (Formato página RENAPO)'],
                            'constancia_fiscal' => ['nombre' => 'Constancia de Situación Fiscal', 'icono' => 'file-invoice', 'descripcion' => 'Constancia de situación fiscal (SAT)'],
                            'nss' => ['nombre' => 'Número de Seguridad Social', 'icono' => 'heartbeat', 'descripcion' => 'NSS (Formato página IMSS)'],
                            'ine' => ['nombre' => 'INE', 'icono' => 'id-card', 'descripcion' => 'Identificación oficial vigente'],
                            'comprobante_domicilio' => ['nombre' => 'Comprobante de Domicilio', 'icono' => 'home', 'descripcion' => 'Comprobante de domicilio reciente'],
                            'comprobante_estudios' => ['nombre' => 'Comprobante de Estudios', 'icono' => 'graduation-cap', 'descripcion' => 'Último grado de estudios'],
                            'certificado_medico' => ['nombre' => 'Certificado Médico', 'icono' => 'file-medical', 'descripcion' => 'Certificado médico vigente']
                        ];
                    @endphp

                    <div class="form-grid">
                        @foreach($documentosRequeridos as $tipo => $info)
                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fas fa-{{ $info['icono'] }}"></i> {{ $info['nombre'] }}
                                </label>
                                <input type="file" class="form-control @error($tipo) is-invalid @enderror" id="{{ $tipo }}" name="{{ $tipo }}" accept=".pdf">
                                <small class="text-muted">{{ $info['descripcion'] }} (PDF, máx 4MB)</small>
                                @error($tipo)<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        @endforeach
                    </div>

                    <div class="info-note" style="margin-top: 20px;">
                        <i class="fas fa-info-circle"></i>
                        <span>Los documentos se pueden subir ahora o más tarde desde tu dashboard. Una vez subidos, serán revisados por el administrador.</span>
                    </div>
                </div>

                <!-- BOTONES DE NAVEGACIÓN -->
                <div class="form-actions">
                    <div>
                        <button type="button" id="prevBtn" class="btn-prev" style="display: none;">
                            <i class="fas fa-arrow-left"></i> Anterior
                        </button>
                    </div>
                    <div style="display: flex; gap: 15px;">
                        <a href="{{ route('administrativos.dashboard') }}" class="btn-cancel">
                            <i class="fas fa-times"></i> Cancelar
                        </a>
                        <button type="button" id="nextBtn" class="btn-next">
                            Siguiente <i class="fas fa-arrow-right"></i>
                        </button>
                        <button type="submit" id="submitBtn" class="btn-submit" style="display: none;">
                            <i class="fas fa-save"></i> Guardar Perfil
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Variables para el control de pestañas
    let currentStep = 1;
    const totalSteps = 3;

    const tabs = document.querySelectorAll('.tab-content');
    const steps = document.querySelectorAll('.step');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const submitBtn = document.getElementById('submitBtn');

    function updateTabs() {
        // Mostrar/ocultar tabs
        tabs.forEach((tab, index) => {
            if (index + 1 === currentStep) {
                tab.classList.add('active');
            } else {
                tab.classList.remove('active');
            }
        });

        // Actualizar pasos
        steps.forEach((step, index) => {
            const stepNum = index + 1;
            step.classList.remove('active', 'completed');
            
            if (stepNum === currentStep) {
                step.classList.add('active');
            } else if (stepNum < currentStep) {
                step.classList.add('completed');
            }
        });

        // Mostrar/ocultar botones
        if (currentStep === 1) {
            prevBtn.style.display = 'none';
        } else {
            prevBtn.style.display = 'inline-flex';
        }

        if (currentStep === totalSteps) {
            nextBtn.style.display = 'none';
            submitBtn.style.display = 'inline-flex';
        } else {
            nextBtn.style.display = 'inline-flex';
            submitBtn.style.display = 'none';
        }
    }

    // Validar campos visibles actualmente
    function validateCurrentStep() {
        const currentTab = document.querySelector(`.tab-content.active`);
        const requiredInputs = currentTab.querySelectorAll('[required]');
        let isValid = true;

        requiredInputs.forEach(input => {
            if (!input.value.trim()) {
                isValid = false;
                input.classList.add('is-invalid');
                
                // Crear mensaje de error si no existe
                let feedback = input.parentElement.querySelector('.invalid-feedback');
                if (!feedback) {
                    feedback = document.createElement('div');
                    feedback.className = 'invalid-feedback';
                    feedback.textContent = 'Este campo es obligatorio';
                    input.parentElement.appendChild(feedback);
                }
            } else {
                input.classList.remove('is-invalid');
                const feedback = input.parentElement.querySelector('.invalid-feedback');
                if (feedback && feedback.textContent === 'Este campo es obligatorio') {
                    feedback.remove();
                }
            }
        });

        return isValid;
    }

    // Siguiente paso
    function nextStep() {
        if (validateCurrentStep()) {
            if (currentStep < totalSteps) {
                currentStep++;
                updateTabs();
            }
        } else {
            // Mostrar alerta
            const alertDiv = document.createElement('div');
            alertDiv.className = 'alert alert-danger';
            alertDiv.innerHTML = '<i class="fas fa-exclamation-triangle"></i><div>Por favor completa todos los campos obligatorios antes de continuar.</div>';
            alertDiv.style.position = 'fixed';
            alertDiv.style.top = '100px';
            alertDiv.style.right = '20px';
            alertDiv.style.zIndex = '2000';
            alertDiv.style.animation = 'slideIn 0.3s ease';
            document.body.appendChild(alertDiv);
            
            setTimeout(() => {
                alertDiv.remove();
            }, 3000);
        }
    }

    // Paso anterior
    function prevStep() {
        if (currentStep > 1) {
            currentStep--;
            updateTabs();
        }
    }

    // Eventos
    prevBtn.addEventListener('click', prevStep);
    nextBtn.addEventListener('click', nextStep);

    // Inicializar
    updateTabs();

    // Remover clases is-invalid al escribir
    document.querySelectorAll('[required]').forEach(input => {
        input.addEventListener('input', function() {
            if (this.value.trim()) {
                this.classList.remove('is-invalid');
                const feedback = this.parentElement.querySelector('.invalid-feedback');
                if (feedback && feedback.textContent === 'Este campo es obligatorio') {
                    feedback.remove();
                }
            }
        });
    });
</script>
</body>
</html>