<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Editar Perfil - Administrativo</title>
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

        /* Tarjeta de edición */
        .edit-card {
            background: white;
            border-radius: 6px;
            padding: 2.5rem;
            border: 1px solid var(--border-color);
            box-shadow: var(--card-shadow);
        }

        .section-title {
            font-size: var(--font-size-h4);
            color: var(--primary);
            margin: 2rem 0 1.5rem 0;
            padding-bottom: 0.8rem;
            border-bottom: 1px solid var(--border-color);
        }

        .section-title:first-of-type {
            margin-top: 0;
        }

        .form-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 0.5rem;
            font-size: 1rem;
        }

        .form-label i {
            color: var(--primary);
            margin-right: 0.5rem;
        }

        .form-control, .form-select {
            border: 1px solid var(--border-color);
            border-radius: 6px;
            padding: 0.7rem 1rem;
            font-size: 1rem;
            transition: var(--transition);
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(7, 68, 182, 0.1);
            outline: none;
        }

        .form-control.is-invalid {
            border-color: #dc3545;
        }

        .invalid-feedback {
            color: #dc3545;
            font-size: 0.9rem;
            margin-top: 0.3rem;
        }

        .form-text {
            color: var(--text-muted);
            font-size: 0.9rem;
            margin-top: 0.3rem;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
            border: none;
            padding: 0.8rem 2.5rem;
            border-radius: 6px;
            font-weight: 500;
            font-size: 1.1rem;
            cursor: pointer;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 0.8rem;
            border: 2px solid var(--primary);
        }

        .btn-primary:hover {
            background: #052d7a;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(7, 68, 182, 0.3);
        }

        .btn-secondary {
            background: transparent;
            border: 2px solid var(--border-color);
            color: var(--text-muted);
            padding: 0.8rem 2rem;
            border-radius: 6px;
            font-weight: 500;
            font-size: 1.1rem;
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-secondary:hover {
            background: var(--light-bg);
            color: #333;
            transform: translateY(-2px);
        }

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

        .alert-danger {
            background: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
        }

        .info-note {
            background: #e8f0fe;
            border-left: 4px solid var(--primary);
            padding: 1.2rem;
            border-radius: 6px;
            margin-bottom: 1.5rem;
            font-size: 1rem;
            color: #333;
            display: flex;
            align-items: center;
            gap: 0.8rem;
            border: 1px solid rgba(7, 68, 182, 0.2);
        }

        .info-note i {
            color: var(--primary);
            font-size: 1.2rem;
        }

        .back-btn {
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

        .back-btn:hover {
            background: rgba(7, 68, 182, 0.05);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(7, 68, 182, 0.15);
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

        .row-custom {
            margin-bottom: 1.5rem;
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
            
            .page-header {
                flex-direction: column;
                gap: 1rem;
                align-items: flex-start;
            }
            
            .edit-card {
                padding: 1.5rem;
            }
            
            .btn-primary, .btn-secondary {
                width: 100%;
                justify-content: center;
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
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('coordinaciones.index') }}">Coordinaciones</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('maestros.index') }}">Maestros</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('contracts.index') }}">Contratos</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('users.index') }}">Accesos</a></li>
                    <li class="nav-item"><a class="nav-link active" href="{{ route('admin.administrativos.index') }}">Administrativos</a></li>
                </ul>
                
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
                    <!-- Cabecera con fecha y botón volver -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h2>Editar Perfil</h2>
                            <p style="color: var(--text-muted); font-size: 1rem;">
                                <i class="fas fa-user-edit" style="color: var(--primary);"></i>
                                Actualiza tu información personal y laboral
                            </p>
                        </div>
                        <div class="d-flex gap-3">
                            <div class="date-badge">
                                <i class="fas fa-calendar-alt"></i>
                                {{ now()->format('d F, Y') }}
                            </div>
                            <a href="{{ route('administrativos.dashboard') }}" class="back-btn">
                                <i class="fas fa-arrow-left"></i> Volver
                            </a>
                        </div>
                    </div>

                    <!-- Alertas -->
                    @if(session('success'))
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle"></i>
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ session('error') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-triangle"></i>
                            Por favor corrige los errores en el formulario.
                        </div>
                    @endif

                    <!-- Nota informativa -->
                    <div class="info-note">
                        <i class="fas fa-info-circle"></i>
                        Todos los campos marcados con <span class="text-danger">*</span> son obligatorios. Puedes editar toda tu información.
                    </div>

                    <!-- Formulario de edición -->
                    <div class="edit-card">
                        <form method="POST" action="{{ route('administrativos.actualizar-perfil') }}">
                            @csrf
                            @method('PUT')

                            <!-- Información Personal -->
                            <h3 class="section-title">
                                <i class="fas fa-user"></i>
                                Información Personal
                            </h3>

                            <div class="row row-custom">
                                <div class="col-md-4 mb-3">
                                    <label for="nombres" class="form-label">
                                        <i class="fas fa-user"></i>
                                        Nombres <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" 
                                           class="form-control @error('nombres') is-invalid @enderror" 
                                           id="nombres" 
                                           name="nombres" 
                                           value="{{ old('nombres', $administrativo->nombres) }}" 
                                           required>
                                    @error('nombres')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="apellido_paterno" class="form-label">
                                        <i class="fas fa-user"></i>
                                        Apellido Paterno <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" 
                                           class="form-control @error('apellido_paterno') is-invalid @enderror" 
                                           id="apellido_paterno" 
                                           name="apellido_paterno" 
                                           value="{{ old('apellido_paterno', $administrativo->apellido_paterno) }}" 
                                           required>
                                    @error('apellido_paterno')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="apellido_materno" class="form-label">
                                        <i class="fas fa-user"></i>
                                        Apellido Materno
                                    </label>
                                    <input type="text" 
                                           class="form-control @error('apellido_materno') is-invalid @enderror" 
                                           id="apellido_materno" 
                                           name="apellido_materno" 
                                           value="{{ old('apellido_materno', $administrativo->apellido_materno) }}">
                                    @error('apellido_materno')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row row-custom">
                                <div class="col-md-4 mb-3">
                                    <label for="fecha_nacimiento" class="form-label">
                                        <i class="fas fa-calendar-alt"></i>
                                        Fecha de Nacimiento <span class="text-danger">*</span>
                                    </label>
                                    <input type="date" 
                                           class="form-control @error('fecha_nacimiento') is-invalid @enderror" 
                                           id="fecha_nacimiento" 
                                           name="fecha_nacimiento" 
                                           value="{{ old('fecha_nacimiento', $administrativo->fecha_nacimiento instanceof \Carbon\Carbon ? $administrativo->fecha_nacimiento->format('Y-m-d') : $administrativo->fecha_nacimiento) }}" 
                                           required>
                                    @error('fecha_nacimiento')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="curp" class="form-label">
                                        <i class="fas fa-id-card"></i>
                                        CURP <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" 
                                           class="form-control @error('curp') is-invalid @enderror" 
                                           id="curp" 
                                           name="curp" 
                                           value="{{ old('curp', $administrativo->curp) }}" 
                                           required
                                           maxlength="18"
                                           pattern="[A-Z0-9]{18}"
                                           title="La CURP debe tener 18 caracteres (letras mayúsculas y números)">
                                    @error('curp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">18 caracteres, solo mayúsculas y números</div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="rfc" class="form-label">
                                        <i class="fas fa-id-card"></i>
                                        RFC <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" 
                                           class="form-control @error('rfc') is-invalid @enderror" 
                                           id="rfc" 
                                           name="rfc" 
                                           value="{{ old('rfc', $administrativo->rfc) }}" 
                                           required
                                           maxlength="13"
                                           pattern="[A-Z0-9]{13}"
                                           title="El RFC debe tener 13 caracteres (letras mayúsculas y números)">
                                    @error('rfc')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">13 caracteres, solo mayúsculas y números</div>
                                </div>
                            </div>

                            <div class="row row-custom">
                                <div class="col-md-6 mb-3">
                                    <label for="telefono" class="form-label">
                                        <i class="fas fa-phone"></i>
                                        Teléfono <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" 
                                           class="form-control @error('telefono') is-invalid @enderror" 
                                           id="telefono" 
                                           name="telefono" 
                                           value="{{ old('telefono', $administrativo->telefono) }}" 
                                           required>
                                    @error('telefono')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="email_personal" class="form-label">
                                        <i class="fas fa-envelope"></i>
                                        Email Personal <span class="text-danger">*</span>
                                    </label>
                                    <input type="email" 
                                           class="form-control @error('email_personal') is-invalid @enderror" 
                                           id="email_personal" 
                                           name="email_personal" 
                                           value="{{ old('email_personal', $administrativo->email_personal) }}" 
                                           required>
                                    @error('email_personal')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row row-custom">
                                <div class="col-12 mb-3">
                                    <label for="direccion" class="form-label">
                                        <i class="fas fa-map-marker-alt"></i>
                                        Dirección <span class="text-danger">*</span>
                                    </label>
                                    <textarea class="form-control @error('direccion') is-invalid @enderror" 
                                              id="direccion" 
                                              name="direccion" 
                                              rows="2" 
                                              required>{{ old('direccion', $administrativo->direccion) }}</textarea>
                                    @error('direccion')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Información Laboral -->
                            <h3 class="section-title">
                                <i class="fas fa-briefcase"></i>
                                Información Laboral
                            </h3>

                            <div class="row row-custom">
                                <div class="col-md-4 mb-3">
                                    <label for="puesto" class="form-label">
                                        <i class="fas fa-user-tie"></i>
                                        Puesto <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" 
                                           class="form-control @error('puesto') is-invalid @enderror" 
                                           id="puesto" 
                                           name="puesto" 
                                           value="{{ old('puesto', $administrativo->puesto) }}" 
                                           required>
                                    @error('puesto')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="area_adscripcion" class="form-label">
                                        <i class="fas fa-building"></i>
                                        Área de Adscripción <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" 
                                           class="form-control @error('area_adscripcion') is-invalid @enderror" 
                                           id="area_adscripcion" 
                                           name="area_adscripcion" 
                                           value="{{ old('area_adscripcion', $administrativo->area_adscripcion) }}" 
                                           required>
                                    @error('area_adscripcion')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="fecha_ingreso" class="form-label">
                                        <i class="fas fa-calendar-check"></i>
                                        Fecha de Ingreso <span class="text-danger">*</span>
                                    </label>
                                    <input type="date" 
                                           class="form-control @error('fecha_ingreso') is-invalid @enderror" 
                                           id="fecha_ingreso" 
                                           name="fecha_ingreso" 
                                           value="{{ old('fecha_ingreso', $administrativo->fecha_ingreso instanceof \Carbon\Carbon ? $administrativo->fecha_ingreso->format('Y-m-d') : $administrativo->fecha_ingreso) }}" 
                                           required>
                                    @error('fecha_ingreso')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row row-custom">
                                <div class="col-md-4 mb-3">
                                    <label for="numero_empleado" class="form-label">
                                        <i class="fas fa-hashtag"></i>
                                        Número de Empleado <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" 
                                           class="form-control @error('numero_empleado') is-invalid @enderror" 
                                           id="numero_empleado" 
                                           name="numero_empleado" 
                                           value="{{ old('numero_empleado', $administrativo->numero_empleado) }}" 
                                           required>
                                    @error('numero_empleado')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="maximo_grado_estudios" class="form-label">
                                        <i class="fas fa-graduation-cap"></i>
                                        Máximo Grado de Estudios
                                    </label>
                                    <select class="form-select @error('maximo_grado_estudios') is-invalid @enderror" 
                                            id="maximo_grado_estudios" 
                                            name="maximo_grado_estudios">
                                        <option value="">Seleccione...</option>
                                        <option value="Licenciatura" {{ old('maximo_grado_estudios', $administrativo->maximo_grado_estudios) == 'Licenciatura' ? 'selected' : '' }}>Licenciatura</option>
                                        <option value="Especialidad" {{ old('maximo_grado_estudios', $administrativo->maximo_grado_estudios) == 'Especialidad' ? 'selected' : '' }}>Especialidad</option>
                                        <option value="Maestría" {{ old('maximo_grado_estudios', $administrativo->maximo_grado_estudios) == 'Maestría' ? 'selected' : '' }}>Maestría</option>
                                        <option value="Doctorado" {{ old('maximo_grado_estudios', $administrativo->maximo_grado_estudios) == 'Doctorado' ? 'selected' : '' }}>Doctorado</option>
                                    </select>
                                    @error('maximo_grado_estudios')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="escolaridad" class="form-label">
                                        <i class="fas fa-school"></i>
                                        Escolaridad
                                    </label>
                                    <input type="text" 
                                           class="form-control @error('escolaridad') is-invalid @enderror" 
                                           id="escolaridad" 
                                           name="escolaridad" 
                                           value="{{ old('escolaridad', $administrativo->escolaridad) }}">
                                    @error('escolaridad')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Botones de acción -->
                            <div class="d-flex justify-content-end gap-3 mt-4">
                                <a href="{{ route('administrativos.dashboard') }}" class="btn-secondary">
                                    <i class="fas fa-times"></i>
                                    Cancelar
                                </a>
                                <button type="submit" class="btn-primary">
                                    <i class="fas fa-save"></i>
                                    Guardar Cambios
                                </button>
                            </div>
                        </form>
                    </div>
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