<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Completar Perfil | GEPROC GP</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #0744b6ff;
            --secondary: #33CAE6;
            --accent: #26E63F;
            --dark-primary: #052e7a;
            --light-primary: rgba(7, 68, 182, 0.08);
            --light-bg: #f8fafc;
            --card-bg: #ffffff;
            --border-color: #e1e5eb;
            --text-muted: #64748b;
            --text-dark: #1e293b;
            --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.07);
            --shadow-lg: 0 10px 25px rgba(0, 0, 0, 0.1);
            --gradient-primary: linear-gradient(135deg, var(--primary) 0%, #0a5bda 100%);
            --gradient-accent: linear-gradient(135deg, var(--accent) 0%, #1dc535 100%);
            --transition: all 0.2s ease;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', -apple-system, BlinkMacSystemFont, sans-serif;
        }
        
        body {
            background: var(--light-bg);
            color: var(--text-dark);
            line-height: 1.5;
            min-height: 100vh;
        }
        
        .main-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        /* Header Styles */
        .header {
            background: white;
            border-radius: 10px;
            padding: 20px 30px;
            margin-bottom: 25px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo-container {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        
        .logo-circle {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: white;
            border: 2px solid var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        
        .logo-img {
            width: 85%;
            height: 85%;
            object-fit: contain;
        }
        
        .logo-section h1 {
            color: var(--dark-primary);
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 4px;
        }
        
        .logo-section p {
            color: var(--text-muted);
            font-size: 0.9rem;
            font-weight: 500;
        }
        
        .logout-btn {
            background: var(--gradient-primary);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9rem;
        }
        
        .logout-btn:hover {
            opacity: 0.9;
            transform: translateY(-1px);
        }
        
        /* Welcome Section */
        .welcome-section {
            background: white;
            border-radius: 10px;
            padding: 25px 30px;
            margin-bottom: 25px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
        }
        
        .welcome-section h1 {
            font-size: 1.5rem;
            color: var(--dark-primary);
            margin-bottom: 10px;
            font-weight: 600;
        }
        
        .welcome-section p {
            color: var(--text-muted);
            margin-bottom: 5px;
            font-size: 0.95rem;
        }
        
        .welcome-section strong {
            color: var(--primary);
            font-weight: 600;
        }
        
        /* Main Form Container */
        .form-main-container {
            display: flex;
            gap: 25px;
        }
        
        /* Progress Sidebar */
        .progress-sidebar {
            flex: 0 0 280px;
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
            height: fit-content;
        }
        
        .progress-title {
            font-size: 1.1rem;
            color: var(--dark-primary);
            margin-bottom: 20px;
            font-weight: 600;
            padding-bottom: 15px;
            border-bottom: 1px solid var(--border-color);
        }
        
        .progress-steps {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        
        .progress-step {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 12px 15px;
            border-radius: 8px;
            transition: var(--transition);
            cursor: pointer;
        }
        
        .progress-step:hover {
            background: var(--light-primary);
        }
        
        .progress-step.active {
            background: var(--light-primary);
            border-left: 3px solid var(--primary);
        }
        
        .step-circle {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #f1f5f9;
            border: 2px solid #cbd5e1;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.95rem;
            color: var(--text-muted);
            transition: var(--transition);
        }
        
        .progress-step.active .step-circle {
            background: var(--gradient-primary);
            border-color: var(--primary);
            color: white;
        }
        
        .progress-step.completed .step-circle {
            background: var(--gradient-accent);
            border-color: var(--accent);
            color: white;
        }
        
        .step-info {
            flex: 1;
        }
        
        .step-label {
            font-weight: 600;
            font-size: 0.95rem;
            color: var(--text-dark);
            margin-bottom: 3px;
        }
        
        .step-desc {
            font-size: 0.85rem;
            color: var(--text-muted);
        }
        
        /* Form Content */
        .form-content {
            flex: 1;
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
        }
        
        .step-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 1px solid var(--border-color);
        }
        
        .step-icon {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: var(--light-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 1.1rem;
        }
        
        .step-title-large {
            font-size: 1.3rem;
            color: var(--dark-primary);
            font-weight: 600;
        }
        
        .form-step {
            display: none;
        }
        
        .form-step.active {
            display: block;
            animation: fadeIn 0.3s ease;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        /* Form Fields */
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--dark-primary);
            font-size: 0.95rem;
        }
        
        .required-field::after {
            content: '*';
            color: #ef4444;
            margin-left: 4px;
        }
        
        .form-control, .form-select {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            font-size: 0.95rem;
            transition: var(--transition);
            background: white;
            color: var(--text-dark);
        }
        
        .form-control:focus, .form-select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(7, 68, 182, 0.1);
        }
        
        .form-control:hover, .form-select:hover {
            border-color: #94a3b8;
        }
        
        .form-select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%230744b6' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 15px center;
            background-size: 12px;
            padding-right: 40px;
            cursor: pointer;
        }
        
        .row {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -10px;
        }
        
        .col-md-4, .col-md-6, .col-md-3 {
            padding: 0 10px;
            flex: 0 0 auto;
        }
        
        .col-md-4 {
            width: 33.333333%;
        }
        
        .col-md-6 {
            width: 50%;
        }
        
        .col-md-3 {
            width: 25%;
        }
        
        .mb-3 {
            margin-bottom: 1rem;
        }
        
        .mb-4 {
            margin-bottom: 1.5rem;
        }
        
        .form-text {
            font-size: 0.8rem;
            color: var(--text-muted);
            margin-top: 6px;
            padding-left: 2px;
        }
        
        textarea.form-control {
            min-height: 100px;
            resize: vertical;
            line-height: 1.5;
        }
        
        /* Form Actions */
        .form-actions {
            display: flex;
            justify-content: space-between;
            margin-top: 40px;
            padding-top: 25px;
            border-top: 1px solid var(--border-color);
        }
        
        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 6px;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .btn-primary {
            background: var(--gradient-primary);
            color: white;
        }
        
        .btn-primary:hover {
            opacity: 0.9;
            transform: translateY(-1px);
        }
        
        .btn-secondary {
            background: #f1f5f9;
            color: var(--dark-primary);
            border: 1px solid var(--border-color);
        }
        
        .btn-secondary:hover {
            background: #e2e8f0;
        }
        
        .btn-success {
            background: var(--gradient-accent);
            color: white;
        }
        
        .btn-success:hover {
            opacity: 0.9;
            transform: translateY(-1px);
        }
        
        /* Validation */
        .invalid-feedback {
            display: block;
            width: 100%;
            margin-top: 6px;
            font-size: 0.8rem;
            color: #ef4444;
            font-weight: 500;
        }
        
        .is-invalid {
            border-color: #ef4444 !important;
        }
        
        .is-invalid:focus {
            border-color: #ef4444 !important;
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1) !important;
        }
        
        /* Responsive */
        @media (max-width: 992px) {
            .form-main-container {
                flex-direction: column;
            }
            
            .progress-sidebar {
                flex: none;
                width: 100%;
            }
            
            .col-md-4, .col-md-6, .col-md-3 {
                width: 100%;
                margin-bottom: 15px;
            }
            
            .row > [class*="col-"]:last-child {
                margin-bottom: 0;
            }
        }
        
        @media (max-width: 768px) {
            .main-container {
                padding: 15px;
            }
            
            .header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
                padding: 20px;
            }
            
            .logo-container {
                width: 100%;
                justify-content: center;
                margin-bottom: 10px;
            }
            
            .logout-btn {
                width: 100%;
                justify-content: center;
            }
            
            .form-content {
                padding: 20px;
            }
            
            .form-actions {
                flex-direction: column;
                gap: 12px;
            }
            
            .btn {
                width: 100%;
                justify-content: center;
            }
        }
        
        /* Additional Utilities */
        input[type="date"] {
            min-height: 44px;
        }
        
        ::placeholder {
            color: #94a3b8;
            opacity: 0.8;
        }
        
        /* Status Indicator */
        .status-complete {
            color: var(--accent);
            font-size: 0.85rem;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <div class="main-container">
        <!-- Header -->
        <header class="header">
            <div class="logo-container">
                <div class="logo-circle">
                    <img src="{{ asset('img/logo_iufim.png') }}" alt="Logo" class="logo-img">
                </div>
                <div class="logo-section">
                    <h1>GEPROC GP</h1>
                    <p>Sistema de Gestión de Profesores</p>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                </button>
            </form>
        </header>

        <!-- Welcome Section -->
        <section class="welcome-section">
            <h1>Completar Perfil del Profesor</h1>
            <p>Bienvenido/a, <strong id="user-name">{{ auth()->user()->name ?? 'Profesor' }}</strong></p>
            <p>Por favor, completa tu información para acceder al sistema</p>
        </section>

        <!-- Main Form Area -->
        <div class="form-main-container">
            <!-- Progress Sidebar -->
            <aside class="progress-sidebar">
                <h3 class="progress-title">Progreso del Registro</h3>
                <div class="progress-steps">
                    <div class="progress-step active" data-step="1">
                        <div class="step-circle">1</div>
                        <div class="step-info">
                            <div class="step-label">Información Personal</div>
                            <div class="step-desc">Datos básicos y académicos</div>
                        </div>
                    </div>
                    <div class="progress-step" data-step="2">
                        <div class="step-circle">2</div>
                        <div class="step-info">
                            <div class="step-label">Información de Contacto</div>
                            <div class="step-desc">Teléfono, email y dirección</div>
                        </div>
                    </div>
                    <div class="progress-step" data-step="3">
                        <div class="step-circle">3</div>
                        <div class="step-info">
                            <div class="step-label">Documentos Oficiales</div>
                            <div class="step-desc">RFC y CURP</div>
                        </div>
                    </div>
                </div>
            </aside>

            <!-- Form Content -->
            <main class="form-content">
                <form action="{{ route('profesor.guardar-perfil') }}" method="POST" id="teacher-form">
                    @csrf
                    
                    <!-- Paso 1: Información Personal -->
                    <div class="form-step active" id="form-step-1">
                        <div class="step-header">
                            <div class="step-icon">
                                <i class="fas fa-user"></i>
                            </div>
                            <h2 class="step-title-large">Información Personal</h2>
                        </div>
                        
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nombres" class="form-label required-field">Nombres</label>
                                    <input type="text" class="form-control @error('nombres') is-invalid @enderror" 
                                           id="nombres" name="nombres" value="{{ old('nombres') }}" required
                                           placeholder="Ingrese sus nombres">
                                    @error('nombres')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="apellido_paterno" class="form-label required-field">Apellido Paterno</label>
                                    <input type="text" class="form-control @error('apellido_paterno') is-invalid @enderror" 
                                           id="apellido_paterno" name="apellido_paterno" value="{{ old('apellido_paterno') }}" required
                                           placeholder="Ingrese su apellido paterno">
                                    @error('apellido_paterno')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="apellido_materno" class="form-label">Apellido Materno</label>
                                    <input type="text" class="form-control @error('apellido_materno') is-invalid @enderror" 
                                           id="apellido_materno" name="apellido_materno" value="{{ old('apellido_materno') }}"
                                           placeholder="Ingrese su apellido materno">
                                    @error('apellido_materno')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="fecha_nacimiento" class="form-label required-field">Fecha de Nacimiento</label>
                                    <input type="date" class="form-control @error('fecha_nacimiento') is-invalid @enderror" 
                                           id="fecha_nacimiento" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" required>
                                    @error('fecha_nacimiento')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="edad" class="form-label required-field">Edad</label>
                                    <input type="number" class="form-control @error('edad') is-invalid @enderror" 
                                           id="edad" name="edad" value="{{ old('edad') }}" min="18" max="100" required
                                           placeholder="Edad">
                                    @error('edad')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="sexo" class="form-label">Sexo</label>
                                    <select class="form-select @error('sexo') is-invalid @enderror" id="sexo" name="sexo">
                                        <option value="">Seleccionar sexo</option>
                                        <option value="Masculino" {{ old('sexo') == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                                        <option value="Femenino" {{ old('sexo') == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                                    </select>
                                    @error('sexo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="estado_civil" class="form-label">Estado Civil</label>
                                    <select class="form-select @error('estado_civil') is-invalid @enderror" id="estado_civil" name="estado_civil">
                                        <option value="">Seleccionar estado civil</option>
                                        <option value="Soltero" {{ old('estado_civil') == 'Soltero' ? 'selected' : '' }}>Soltero</option>
                                        <option value="Casado" {{ old('estado_civil') == 'Casado' ? 'selected' : '' }}>Casado</option>
                                        <option value="Divorciado" {{ old('estado_civil') == 'Divorciado' ? 'selected' : '' }}>Divorciado</option>
                                        <option value="Viudo" {{ old('estado_civil') == 'Viudo' ? 'selected' : '' }}>Viudo</option>
                                    </select>
                                    @error('estado_civil')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="coordinaciones_id" class="form-label required-field">Coordinación</label>
                                    <select class="form-select @error('coordinaciones_id') is-invalid @enderror" 
                                            id="coordinaciones_id" name="coordinaciones_id" required>
                                        <option value="">Seleccionar coordinación</option>
                                        @foreach($coordinaciones as $coordinacion)
                                            <option value="{{ $coordinacion->id }}" 
                                                {{ old('coordinaciones_id') == $coordinacion->id ? 'selected' : '' }}>
                                                {{ $coordinacion->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('coordinaciones_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="maximo_grado_academico" class="form-label required-field">Máximo Grado Académico</label>
                                    <select class="form-select @error('maximo_grado_academico') is-invalid @enderror" 
                                            id="maximo_grado_academico" name="maximo_grado_academico" required>
                                        <option value="">Seleccionar grado académico</option>
                                        <option value="Licenciatura" {{ old('maximo_grado_academico') == 'Licenciatura' ? 'selected' : '' }}>Licenciatura</option>
                                        <option value="Especialidad" {{ old('maximo_grado_academico') == 'Especialidad' ? 'selected' : '' }}>Especialidad</option>
                                        <option value="Maestría" {{ old('maximo_grado_academico') == 'Maestría' ? 'selected' : '' }}>Maestría</option>
                                        <option value="Doctorado" {{ old('maximo_grado_academico') == 'Doctorado' ? 'selected' : '' }}>Doctorado</option>
                                    </select>
                                    @error('maximo_grado_academico')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-actions">
                            <div></div>
                            <button type="button" class="btn btn-primary" id="next-step-1">
                                Siguiente <i class="fas fa-arrow-right"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Paso 2: Información de Contacto -->
                    <div class="form-step" id="form-step-2">
                        <div class="step-header">
                            <div class="step-icon">
                                <i class="fas fa-address-book"></i>
                            </div>
                            <h2 class="step-title-large">Información de Contacto</h2>
                        </div>
                        
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="telefono" class="form-label">Teléfono</label>
                                    <input type="tel" class="form-control @error('telefono') is-invalid @enderror" 
                                           id="telefono" name="telefono" value="{{ old('telefono') }}" 
                                           placeholder="Ej. 555-123-4567">
                                    @error('telefono')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label required-field">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                           id="email" name="email" value="{{ old('email', auth()->user()->email) }}" 
                                           required placeholder="ejemplo@correo.com">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label for="direccion" class="form-label">Dirección</label>
                            <textarea class="form-control @error('direccion') is-invalid @enderror" 
                                      id="direccion" name="direccion" rows="3" 
                                      placeholder="Ingrese su dirección completa">{{ old('direccion') }}</textarea>
                            @error('direccion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-actions">
                            <button type="button" class="btn btn-secondary" id="prev-step-2">
                                <i class="fas fa-arrow-left"></i> Anterior
                            </button>
                            <button type="button" class="btn btn-primary" id="next-step-2">
                                Siguiente <i class="fas fa-arrow-right"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Paso 3: Documentos Oficiales -->
                    <div class="form-step" id="form-step-3">
                        <div class="step-header">
                            <div class="step-icon">
                                <i class="fas fa-id-card"></i>
                            </div>
                            <h2 class="step-title-large">Documentos Oficiales</h2>
                        </div>
                        
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="rfc" class="form-label required-field">RFC</label>
                                    <input type="text" class="form-control @error('rfc') is-invalid @enderror" 
                                           id="rfc" name="rfc" value="{{ old('rfc') }}" required 
                                           placeholder="Ej. ABC123456XYZ" maxlength="13" style="text-transform: uppercase;">
                                    <small class="form-text">13 caracteres (letras y números)</small>
                                    @error('rfc')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="curp" class="form-label required-field">CURP</label>
                                    <input type="text" class="form-control @error('curp') is-invalid @enderror" 
                                           id="curp" name="curp" value="{{ old('curp') }}" required 
                                           placeholder="Ej. ABC123456DEF78901" maxlength="18" style="text-transform: uppercase;">
                                    <small class="form-text">18 caracteres</small>
                                    @error('curp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-actions">
                            <button type="button" class="btn btn-secondary" id="prev-step-3">
                                <i class="fas fa-arrow-left"></i> Anterior
                            </button>
                            <button type="submit" class="btn btn-success" id="submit-form">
                                <i class="fas fa-check"></i> Finalizar Registro
                            </button>
                        </div>
                    </div>
                </form>
            </main>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const progressSteps = document.querySelectorAll('.progress-step');
            const formSteps = document.querySelectorAll('.form-step');
            const teacherForm = document.getElementById('teacher-form');
            
            const nextStep1Btn = document.getElementById('next-step-1');
            const prevStep2Btn = document.getElementById('prev-step-2');
            const nextStep2Btn = document.getElementById('next-step-2');
            const prevStep3Btn = document.getElementById('prev-step-3');
            const submitBtn = document.getElementById('submit-form');
            
            let currentStep = 1;
            const totalSteps = 3;
            
            function setupEventListeners() {
                nextStep1Btn.addEventListener('click', () => goToStep(2));
                prevStep2Btn.addEventListener('click', () => goToStep(1));
                nextStep2Btn.addEventListener('click', () => goToStep(3));
                prevStep3Btn.addEventListener('click', () => goToStep(2));
                
                // Click en steps del sidebar
                document.querySelectorAll('.progress-step').forEach(step => {
                    step.addEventListener('click', function() {
                        const stepNumber = parseInt(this.getAttribute('data-step'));
                        if (stepNumber < currentStep) {
                            goToStep(stepNumber);
                        }
                    });
                });
                
                document.getElementById('fecha_nacimiento').addEventListener('change', calculateAge);
                
                document.getElementById('rfc').addEventListener('input', function() {
                    this.value = this.value.toUpperCase();
                });
                
                document.getElementById('curp').addEventListener('input', function() {
                    this.value = this.value.toUpperCase();
                });
            }
            
            function goToStep(step) {
                if (step > currentStep && !validateStep(currentStep)) {
                    return;
                }
                
                currentStep = step;
                updateProgressBar();
                updateFormSteps();
            }
            
            function updateProgressBar() {
                progressSteps.forEach((step, index) => {
                    const stepNumber = index + 1;
                    if (stepNumber < currentStep) {
                        step.classList.add('completed');
                        step.classList.remove('active');
                    } else if (stepNumber === currentStep) {
                        step.classList.add('active');
                        step.classList.remove('completed');
                    } else {
                        step.classList.remove('active', 'completed');
                    }
                });
            }
            
            function updateFormSteps() {
                formSteps.forEach((step, index) => {
                    if (index + 1 === currentStep) {
                        step.classList.add('active');
                    } else {
                        step.classList.remove('active');
                    }
                });
            }
            
            function validateStep(step) {
                let isValid = true;
                
                if (step === 1) {
                    const requiredFields = [
                        'nombres', 'apellido_paterno', 'fecha_nacimiento', 
                        'edad', 'coordinaciones_id', 'maximo_grado_academico'
                    ];
                    
                    requiredFields.forEach(fieldName => {
                        const field = document.getElementById(fieldName);
                        if (!field.value || field.value.trim() === '') {
                            markInvalid(field, 'Este campo es obligatorio');
                            isValid = false;
                        } else {
                            markValid(field);
                        }
                    });
                    
                    const edad = document.getElementById('edad');
                    if (edad.value && (edad.value < 18 || edad.value > 100)) {
                        markInvalid(edad, 'La edad debe estar entre 18 y 100 años');
                        isValid = false;
                    }
                    
                }
                
                if (step === 2) {
                    const email = document.getElementById('email');
                    
                    if (!email.value.trim()) {
                        markInvalid(email, 'Este campo es obligatorio');
                        isValid = false;
                    } else if (!isValidEmail(email.value)) {
                        markInvalid(email, 'Ingrese un email válido');
                        isValid = false;
                    } else {
                        markValid(email);
                    }
                }
                
                if (step === 3) {
                    const rfc = document.getElementById('rfc');
                    const curp = document.getElementById('curp');
                    
                    if (!rfc.value.trim()) {
                        markInvalid(rfc, 'Este campo es obligatorio');
                        isValid = false;
                    } else if (rfc.value.length !== 13) {
                        markInvalid(rfc, 'El RFC debe tener exactamente 13 caracteres');
                        isValid = false;
                    } else {
                        markValid(rfc);
                    }
                    
                    if (!curp.value.trim()) {
                        markInvalid(curp, 'Este campo es obligatorio');
                        isValid = false;
                    } else if (curp.value.length !== 18) {
                        markInvalid(curp, 'La CURP debe tener exactamente 18 caracteres');
                        isValid = false;
                    } else {
                        markValid(curp);
                    }
                }
                
                return isValid;
            }
            
            function markInvalid(field, message) {
                field.classList.add('is-invalid');
                
                let feedback = field.nextElementSibling;
                if (!feedback || !feedback.classList.contains('invalid-feedback')) {
                    feedback = document.createElement('div');
                    feedback.className = 'invalid-feedback';
                    field.parentNode.appendChild(feedback);
                }
                feedback.textContent = message;
            }
            
            function markValid(field) {
                field.classList.remove('is-invalid');
                
                const feedback = field.nextElementSibling;
                if (feedback && feedback.classList.contains('invalid-feedback')) {
                    feedback.remove();
                }
            }
            
            function isValidEmail(email) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return emailRegex.test(email);
            }
            
            function calculateAge() {
                const fechaNacimiento = document.getElementById('fecha_nacimiento');
                const edadField = document.getElementById('edad');
                
                if (fechaNacimiento.value) {
                    const birthDate = new Date(fechaNacimiento.value);
                    const today = new Date();
                    let age = today.getFullYear() - birthDate.getFullYear();
                    const monthDiff = today.getMonth() - birthDate.getMonth();
                    
                    if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                        age--;
                    }
                    
                    edadField.value = age;
                }
            }
            
            teacherForm.addEventListener('submit', function(e) {
                if (!validateStep(1) || !validateStep(2) || !validateStep(3)) {
                    e.preventDefault();
                    alert('Por favor, corrige los errores en el formulario antes de enviar.');
                    return;
                }
                
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Guardando...';
                submitBtn.disabled = true;
            });
            
            setupEventListeners();
        });
    </script>
</body>
</html>