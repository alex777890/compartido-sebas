<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover"/>
    <title>Editar Perfil - Administrativo</title>
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
            
            --font-size-base: 1rem;
            --font-size-lg: 1.1rem;
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
            margin-bottom: 0.8rem;
        }

        /* Tarjeta de edición */
        .edit-card {
            background: white;
            border-radius: 16px;
            padding: 1.8rem;
            border: 1px solid var(--border-color);
            box-shadow: var(--card-shadow);
        }

        .section-title {
            font-size: var(--font-size-h4);
            color: var(--primary);
            margin: 1.5rem 0 1.2rem 0;
            padding-bottom: 0.6rem;
            border-bottom: 2px solid var(--border-color);
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }

        .section-title:first-of-type {
            margin-top: 0;
        }

        .form-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }

        .form-label i {
            color: var(--primary);
            margin-right: 0.5rem;
        }

        .form-control, .form-select {
            border: 1px solid var(--border-color);
            border-radius: 10px;
            padding: 0.6rem 1rem;
            font-size: 0.9rem;
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
            font-size: 0.8rem;
            margin-top: 0.3rem;
        }

        .form-text {
            color: var(--text-muted);
            font-size: 0.75rem;
            margin-top: 0.3rem;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
            border: none;
            padding: 0.7rem 2rem;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
        }

        .btn-primary:hover {
            background: var(--primary-light);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(7, 68, 182, 0.3);
        }

        .btn-secondary {
            background: transparent;
            border: 2px solid var(--border-color);
            color: var(--text-muted);
            padding: 0.7rem 1.5rem;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.9rem;
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
            padding: 0.8rem 1rem;
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

        .alert-danger {
            background: #fee2e2;
            border-color: #fecaca;
            color: #991b1b;
        }

        .info-note {
            background: #e8f0fe;
            border-left: 4px solid var(--primary);
            padding: 1rem;
            border-radius: 12px;
            margin-bottom: 1.2rem;
            font-size: 0.85rem;
            color: #333;
            display: flex;
            align-items: center;
            gap: 0.8rem;
            border: 1px solid rgba(7, 68, 182, 0.2);
        }

        .info-note i {
            color: var(--primary);
            font-size: 1rem;
        }

        .back-btn {
            background: transparent;
            border: 2px solid var(--primary);
            color: var(--primary);
            padding: 0.5rem 1.2rem;
            border-radius: 10px;
            font-weight: 500;
            transition: var(--transition);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.85rem;
        }

        .back-btn:hover {
            background: rgba(7, 68, 182, 0.05);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(7, 68, 182, 0.15);
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

        .page-header {
            margin-bottom: 1.5rem;
        }

        .required-star {
            color: #ef4444;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .navbar-menu {
                top: 57px;
            }
        }

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
            
            .page-header {
                flex-direction: column;
                gap: 1rem;
                align-items: flex-start;
            }
            
            .edit-card {
                padding: 1.2rem;
            }
            
            .section-title {
                margin: 1rem 0 0.8rem 0;
            }
            
            .btn-primary, .btn-secondary {
                width: 100%;
                justify-content: center;
            }
            
            .d-flex.justify-content-between {
                flex-direction: column;
                gap: 0.8rem;
                align-items: flex-start;
            }
            
            .d-flex.gap-3 {
                flex-direction: column;
                width: 100%;
            }
            
            .date-badge, .back-btn {
                justify-content: center;
                width: 100%;
            }
            
            .d-flex.justify-content-end {
                flex-direction: column;
                gap: 0.8rem;
            }
        }

        @media (max-width: 480px) {
            .logo-img {
                height: 35px;
            }
            
            .navbar-brand {
                font-size: 0.9rem;
            }
            
            .edit-card {
                padding: 1rem;
            }
            
            .form-control, .form-select {
                padding: 0.5rem 0.8rem;
                font-size: 0.85rem;
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
                <a class="navbar-brand" href="{{ route('administrativos.dashboard') }}">
                    GEPROC | Administrativos
                </a>
            </div>
        </div>
    </nav>

    <!-- Segunda barra - Usuario y Cerrar Sesión -->
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
            <!-- Cabecera con fecha y botón volver -->
            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3 page-header">
                <div>
                    <h2>Editar Perfil</h2>
                    <p style="color: var(--text-muted); font-size: 0.9rem; margin: 0;">
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
                Todos los campos marcados con <span class="required-star">*</span> son obligatorios. Puedes editar toda tu información.
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

                    <div class="row">
    <div class="col-md-4 mb-3">
        <label for="nombres" class="form-label">
            <i class="fas fa-user"></i>
            Nombres <span class="required-star">*</span>
        </label>
        <input type="text" 
               class="form-control @error('nombres') is-invalid @enderror" 
               id="nombres" 
               name="nombres" 
               value="{{ old('nombres', $administrativo->nombres) }}" 
               required>
    </div>

    <div class="col-md-4 mb-3">
        <label for="apellido_paterno" class="form-label">
            <i class="fas fa-user"></i>
            Apellido Paterno <span class="required-star">*</span>
        </label>
        <input type="text" 
               class="form-control @error('apellido_paterno') is-invalid @enderror" 
               id="apellido_paterno" 
               name="apellido_paterno" 
               value="{{ old('apellido_paterno', $administrativo->apellido_paterno) }}" 
               required>
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
    </div>
</div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="fecha_nacimiento" class="form-label">
                                <i class="fas fa-calendar-alt"></i>
                                Fecha de Nacimiento <span class="required-star">*</span>
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
                            <label for="edad" class="form-label">
                                <i class="fas fa-cake-candles"></i>
                                Edad <span class="required-star">*</span>
                            </label>
                            <input type="number" 
                                   class="form-control @error('edad') is-invalid @enderror" 
                                   id="edad" 
                                   name="edad" 
                                   value="{{ old('edad', $administrativo->edad) }}" 
                                   required 
                                   min="18" 
                                   max="100">
                            @error('edad')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="genero" class="form-label">
                                <i class="fas fa-venus-mars"></i>
                                Género <span class="required-star">*</span>
                            </label>
                            <select class="form-select @error('genero') is-invalid @enderror" id="genero" name="genero" required>
                                <option value="">Seleccione...</option>
                                <option value="M" {{ old('genero', $administrativo->genero) == 'M' ? 'selected' : '' }}>Masculino</option>
                                <option value="F" {{ old('genero', $administrativo->genero) == 'F' ? 'selected' : '' }}>Femenino</option>
                                <option value="OTRO" {{ old('genero', $administrativo->genero) == 'OTRO' ? 'selected' : '' }}>Otro</option>
                            </select>
                            @error('genero')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nacionalidad" class="form-label">
                                <i class="fas fa-flag"></i>
                                Nacionalidad <span class="required-star">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('nacionalidad') is-invalid @enderror" 
                                   id="nacionalidad" 
                                   name="nacionalidad" 
                                   value="{{ old('nacionalidad', $administrativo->nacionalidad) }}" 
                                   required>
                            @error('nacionalidad')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="estado_civil" class="form-label">
                                <i class="fas fa-heart"></i>
                                Estado Civil <span class="required-star">*</span>
                            </label>
                            <select class="form-select @error('estado_civil') is-invalid @enderror" id="estado_civil" name="estado_civil" required>
                                <option value="">Seleccione...</option>
                                <option value="SOLTERO(A)" {{ old('estado_civil', $administrativo->estado_civil) == 'SOLTERO(A)' ? 'selected' : '' }}>Soltero(a)</option>
                                <option value="CASADO(A)" {{ old('estado_civil', $administrativo->estado_civil) == 'CASADO(A)' ? 'selected' : '' }}>Casado(a)</option>
                                <option value="DIVORCIADO(A)" {{ old('estado_civil', $administrativo->estado_civil) == 'DIVORCIADO(A)' ? 'selected' : '' }}>Divorciado(a)</option>
                                <option value="VIUDO(A)" {{ old('estado_civil', $administrativo->estado_civil) == 'VIUDO(A)' ? 'selected' : '' }}>Viudo(a)</option>
                                <option value="UNION LIBRE" {{ old('estado_civil', $administrativo->estado_civil) == 'UNION LIBRE' ? 'selected' : '' }}>Unión Libre</option>
                            </select>
                            @error('estado_civil')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="lugar_nacimiento" class="form-label">
                                <i class="fas fa-map-marker-alt"></i>
                                Lugar de Nacimiento <span class="required-star">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('lugar_nacimiento') is-invalid @enderror" 
                                   id="lugar_nacimiento" 
                                   name="lugar_nacimiento" 
                                   value="{{ old('lugar_nacimiento', $administrativo->lugar_nacimiento) }}" 
                                   required>
                            @error('lugar_nacimiento')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="telefono_celular" class="form-label">
                                <i class="fas fa-phone-alt"></i>
                                Teléfono Celular <span class="required-star">*</span>
                            </label>
                            <input type="tel" 
                                   class="form-control @error('telefono_celular') is-invalid @enderror" 
                                   id="telefono_celular" 
                                   name="telefono_celular" 
                                   value="{{ old('telefono_celular', $administrativo->telefono_celular) }}" 
                                   required>
                            @error('telefono_celular')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="telefono_fijo" class="form-label">
                                <i class="fas fa-phone"></i>
                                Teléfono Fijo
                            </label>
                            <input type="tel" 
                                   class="form-control @error('telefono_fijo') is-invalid @enderror" 
                                   id="telefono_fijo" 
                                   name="telefono_fijo" 
                                   value="{{ old('telefono_fijo', $administrativo->telefono_fijo) }}">
                            @error('telefono_fijo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="email_personal" class="form-label">
                                <i class="fas fa-envelope"></i>
                                Email Personal <span class="required-star">*</span>
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

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="domicilio" class="form-label">
                                <i class="fas fa-home"></i>
                                Domicilio <span class="required-star">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('domicilio') is-invalid @enderror" 
                                   id="domicilio" 
                                   name="domicilio" 
                                   value="{{ old('domicilio', $administrativo->domicilio) }}" 
                                   required>
                            @error('domicilio')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="colonia" class="form-label">
                                <i class="fas fa-location-dot"></i>
                                Colonia <span class="required-star">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('colonia') is-invalid @enderror" 
                                   id="colonia" 
                                   name="colonia" 
                                   value="{{ old('colonia', $administrativo->colonia) }}" 
                                   required>
                            @error('colonia')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="codigo_postal" class="form-label">
                                <i class="fas fa-mail-bulk"></i>
                                Código Postal <span class="required-star">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('codigo_postal') is-invalid @enderror" 
                                   id="codigo_postal" 
                                   name="codigo_postal" 
                                   value="{{ old('codigo_postal', $administrativo->codigo_postal) }}" 
                                   required
                                   maxlength="5">
                            @error('codigo_postal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="municipio" class="form-label">
                                <i class="fas fa-city"></i>
                                Municipio <span class="required-star">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('municipio') is-invalid @enderror" 
                                   id="municipio" 
                                   name="municipio" 
                                   value="{{ old('municipio', $administrativo->municipio) }}" 
                                   required>
                            @error('municipio')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="ciudad_poblacion" class="form-label">
                                <i class="fas fa-building"></i>
                                Ciudad o Población <span class="required-star">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('ciudad_poblacion') is-invalid @enderror" 
                                   id="ciudad_poblacion" 
                                   name="ciudad_poblacion" 
                                   value="{{ old('ciudad_poblacion', $administrativo->ciudad_poblacion) }}" 
                                   required>
                            @error('ciudad_poblacion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Información Laboral -->
                    <h3 class="section-title">
                        <i class="fas fa-briefcase"></i>
                        Información Laboral
                    </h3>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="puesto" class="form-label">
                                <i class="fas fa-user-tie"></i>
                                Puesto <span class="required-star">*</span>
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