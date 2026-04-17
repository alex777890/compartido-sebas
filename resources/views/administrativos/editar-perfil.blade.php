<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover"/>
    <title>Editar Perfil - Administrativo | GEPROC</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
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

        /* FECHA BADGE */
        .date-badge {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 10px 20px;
            background-color: white;
            border: 2px solid var(--border-color);
            border-radius: 50px;
            font-size: 14px;
            font-weight: 600;
            color: var(--text-muted);
            transition: var(--transition);
        }

        .date-badge:hover {
            transform: translateY(-2px);
            box-shadow: var(--card-shadow);
            border-color: var(--primary-light);
        }

        .date-badge i {
            color: var(--primary);
            font-size: 16px;
        }

        /* BOTÓN VOLVER */
        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background: transparent;
            color: var(--primary);
            border: 2px solid var(--primary);
            border-radius: 10px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
        }

        .back-btn:hover {
            background-color: var(--primary);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 12px rgba(7, 68, 182, 0.2);
        }

        /* HEADER DEL CONTENIDO */
        .content-header {
            margin-bottom: 10px;
        }

        .content-header h1 {
            font-size: 28px;
            font-weight: 750;
            color: #1e293b;
            margin: 0 0 8px 0;
            position: relative;
            padding-bottom: 8px;
        }

        .content-header h1::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 3px;
            
            border-radius: 2px;
        }

        .content-header p {
            color: var(--text-muted);
            font-size: 15px;
            margin: 0;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
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

        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid var(--light-bg);
            flex-wrap: wrap;
            gap: 15px;
        }

        .section-title {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 20px;
            color: var(--primary);
            font-weight: 700;
        }

        .section-title i {
            font-size: 22px;
        }

        /* NOTA INFORMATIVA */
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

        .alert-success {
            background-color: var(--success-light);
            border-color: var(--success-color);
            color: #065f46;
        }

        .alert-danger {
            background-color: var(--danger-light);
            border-color: var(--danger-color);
            color: #991b1b;
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

        /* BOTONES DE ACCIÓN */
        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 2px solid var(--border-color);
            flex-wrap: wrap;
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
            background-color: var(--light-bg);
            transform: translateY(-2px);
            border-color: var(--danger-color);
            color: var(--danger-color);
        }

        .btn-save {
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

        .btn-save:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(7, 68, 182, 0.35);
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
            .form-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .header-left {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
            
            .user-info h4 {
                font-size: 16px;
            }
            
            .user-info p {
                font-size: 13px;
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
            
            .header-actions {
                margin-top: 10px;
                width: 100%;
            }
            
            .back-btn, .date-badge {
                width: 100%;
                justify-content: center;
            }
            
            .form-actions {
                flex-direction: column;
            }
            
            .btn-cancel, .btn-save {
                width: 100%;
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            .content-wrapper {
                padding: 15px;
            }
            
            .section-title {
                font-size: 18px;
            }
            
            .logout-button {
                padding: 10px 20px;
                font-size: 14px;
            }
            
            .form-control, .form-select {
                padding: 10px 14px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="main-content">
        <!-- HEADER SUPERIOR -->
        <div class="header">
            <div class="header-left">
                <div class="header-logo">
                    <img src="{{ asset('img/logo_iufim.png') }}" alt="Logo IUFIM" class="logo-img-header">
                </div>
            </div>
            
            <div class="header-right">
               
                <form method="POST" action="{{ route('logout') }}" class="logout-form">
                    @csrf
                    <button type="submit" class="logout-button">
                        <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                    </button>
                </form>
            </div>
        </div>

        <!-- CONTENIDO PRINCIPAL -->
        <div class="content-wrapper">
            <!-- CABECERA -->
            <div style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 20px; margin-bottom: 25px;">
                <div class="content-header">
                    <h1>Editar Perfil</h1>
                    <p>
                        <i class="fas fa-user-edit" style="color: var(--primary); margin-right: 8px;"></i>
                        Actualiza tu información personal y laboral
                    </p>
                </div>
                <div class="header-actions">
                    
                    <a href="{{ route('administrativos.dashboard') }}" class="back-btn">
                        <i class="fas fa-arrow-left"></i> Volver al Panel
                    </a>
                </div>
            </div>

            <!-- ALERTAS -->
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
                    <div>
                        <strong>Por favor corrige los siguientes errores:</strong>
                        <ul style="margin: 10px 0 0 20px;">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <!-- NOTA INFORMATIVA -->
            <div class="info-note">
                <i class="fas fa-info-circle"></i>
                <span>Los campos marcados con <strong style="color: var(--danger-color);">*</strong> son obligatorios. Puedes editar toda tu información personal y laboral.</span>
            </div>

            <!-- FORMULARIO DE EDICIÓN -->
            <div class="section">
                <form method="POST" action="{{ route('administrativos.actualizar-perfil') }}">
                    @csrf
                    @method('PUT')

                    <!-- INFORMACIÓN PERSONAL -->
                    <div class="section-header">
                        <div class="section-title">
                            <i class="fas fa-user"></i>
                            <span>Información Personal</span>
                        </div>
                    </div>

                    <div class="form-grid">
                        <div class="form-group">
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
                            @error('nombres')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
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
                            @error('apellido_paterno')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
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

                        <div class="form-group">
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

                        <div class="form-group">
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

                        <div class="form-group">
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

                        <div class="form-group">
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

                        <div class="form-group">
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

                        <div class="form-group">
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

                        <div class="form-group">
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

                        <div class="form-group">
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

                        <div class="form-group">
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

                        <div class="form-group full-width">
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

                        <div class="form-group">
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

                        <div class="form-group">
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

                        <div class="form-group">
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

                        <div class="form-group">
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

                    <!-- INFORMACIÓN LABORAL -->
                    <div class="section-header" style="margin-top: 30px;">
                        <div class="section-title">
                            <i class="fas fa-briefcase"></i>
                            <span>Información Laboral</span>
                        </div>
                    </div>

                    <div class="form-grid">
                        <div class="form-group full-width">
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

                    <!-- BOTONES DE ACCIÓN -->
                    <div class="form-actions">
                        <a href="{{ route('administrativos.dashboard') }}" class="btn-cancel">
                            <i class="fas fa-times"></i>
                            Cancelar
                        </a>
                        <button type="submit" class="btn-save">
                            <i class="fas fa-save"></i>
                            Guardar Cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        (function(){
            const header = document.querySelector('.header');
            if (header) {
                window.addEventListener('scroll', function() {
                    if (window.scrollY > 50) {
                        header.classList.add('scrolled');
                    } else {
                        header.classList.remove('scrolled');
                    }
                });
            }
        })();
    </script>
</body>
</html>