<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover"/>
    <title>Completar Perfil - Administrativo</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f8fafc;
            color: #0f172a;
            line-height: 1.5;
        }

        /* Header */
        .header {
            background: white;
            padding: 0.75rem 2rem;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -1px rgba(0,0,0,0.03);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 100;
            border-bottom: 1px solid #e2e8f0;
        }

        .logo-area {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .logo-img {
            height: 45px;
            width: auto;
        }

        .logo-area h1 {
            font-size: 1.35rem;
            font-weight: 600;
            color: #0f172a;
            letter-spacing: -0.025em;
        }

        .logo-area span {
            color: #10b981;
            font-weight: 700;
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            background: #f8fafc;
            padding: 0.5rem 1rem;
            border-radius: 40px;
            border: 1px solid #e2e8f0;
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 1rem;
            box-shadow: 0 2px 4px rgba(16,185,129,0.3);
        }

        .user-details {
            line-height: 1.4;
        }

        .user-name {
            font-weight: 600;
            font-size: 0.9rem;
            color: #0f172a;
        }

        .user-role {
            font-size: 0.75rem;
            color: #64748b;
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .user-role i {
            font-size: 0.7rem;
            color: #10b981;
        }

        .logout-btn {
            background: none;
            border: 1px solid #e2e8f0;
            color: #64748b;
            padding: 0.5rem 1.25rem;
            border-radius: 40px;
            cursor: pointer;
            font-size: 0.85rem;
            font-weight: 500;
            transition: all 0.2s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .logout-btn:hover {
            background: #fef2f2;
            border-color: #ef4444;
            color: #ef4444;
        }

        /* Contenido principal */
        .main-content {
            margin-top: 80px;
            padding: 2rem 2rem 3rem;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
        }

        /* Cabecera de página */
        .page-header {
            margin-bottom: 2rem;
            text-align: center;
        }

        .page-header h2 {
            font-size: 2rem;
            font-weight: 700;
            color: #0f172a;
            letter-spacing: -0.025em;
            margin-bottom: 0.5rem;
        }

        .page-header p {
            color: #64748b;
            font-size: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .page-header p i {
            color: #10b981;
        }

        /* Progress steps */
        .progress-steps {
            display: flex;
            justify-content: space-between;
            margin-bottom: 2rem;
            position: relative;
        }

        .progress-steps::before {
            content: '';
            position: absolute;
            top: 20px;
            left: 0;
            right: 0;
            height: 2px;
            background: #e2e8f0;
            z-index: 1;
        }

        .step {
            position: relative;
            z-index: 2;
            background: white;
            padding: 0 0.5rem;
            text-align: center;
        }

        .step-number {
            width: 40px;
            height: 40px;
            background: #f1f5f9;
            border: 2px solid #e2e8f0;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: #64748b;
            margin: 0 auto 0.5rem;
        }

        .step.active .step-number {
            background: #10b981;
            border-color: #10b981;
            color: white;
        }

        .step.completed .step-number {
            background: #10b981;
            border-color: #10b981;
            color: white;
        }

        .step-label {
            font-size: 0.8rem;
            color: #64748b;
            font-weight: 500;
        }

        .step.active .step-label {
            color: #10b981;
            font-weight: 600;
        }

        /* Formulario */
        .form-card {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -1px rgba(0,0,0,0.03);
            border: 1px solid #e2e8f0;
        }

        .form-section {
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid #e2e8f0;
        }

        .form-section:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .form-section h3 {
            font-size: 1.1rem;
            font-weight: 600;
            color: #0f172a;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .form-section h3 i {
            color: #10b981;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
            font-weight: 500;
            font-size: 0.85rem;
            color: #64748b;
            margin-bottom: 0.3rem;
        }

        .form-group label i {
            color: #10b981;
            margin-right: 0.3rem;
            font-size: 0.8rem;
        }

        .form-control {
            width: 100%;
            padding: 0.7rem 1rem;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            font-size: 0.9rem;
            transition: all 0.2s;
            background: #f8fafc;
        }

        .form-control:focus {
            outline: none;
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16,185,129,0.1);
            background: white;
        }

        .form-control.is-invalid {
            border-color: #ef4444;
        }

        .invalid-feedback {
            color: #ef4444;
            font-size: 0.75rem;
            margin-top: 0.25rem;
        }

        .required-star {
            color: #ef4444;
        }

        /* Alertas */
        .alert {
            padding: 1rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .alert-danger {
            background: #fee2e2;
            border: 1px solid #fecaca;
            color: #991b1b;
        }

        .alert ul {
            margin-left: 1.5rem;
        }

        /* Info note */
        .info-note {
            background: #ecfdf5;
            border-left: 4px solid #10b981;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
            color: #065f46;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .info-note i {
            font-size: 1.1rem;
        }

        /* Botones */
        .form-actions {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid #e2e8f0;
        }

        .btn-primary {
            background: #10b981;
            color: white;
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 30px;
            font-weight: 500;
            font-size: 0.95rem;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            box-shadow: 0 4px 6px -1px rgba(16,185,129,0.2);
        }

        .btn-primary:hover {
            background: #059669;
            transform: translateY(-1px);
            box-shadow: 0 10px 15px -3px rgba(16,185,129,0.3);
        }

        .btn-secondary {
            background: white;
            color: #64748b;
            border: 1px solid #e2e8f0;
            padding: 0.75rem 2rem;
            border-radius: 30px;
            font-weight: 500;
            font-size: 0.95rem;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
        }

        .btn-secondary:hover {
            background: #f8fafc;
            color: #0f172a;
            border-color: #cbd5e1;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .header {
                padding: 0.75rem 1rem;
                flex-direction: column;
                gap: 0.75rem;
            }

            .user-menu {
                width: 100%;
                justify-content: space-between;
            }

            .main-content {
                padding: 1rem;
                margin-top: 120px;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            .progress-steps {
                flex-direction: column;
                gap: 1rem;
                align-items: flex-start;
            }

            .progress-steps::before {
                display: none;
            }

            .step {
                display: flex;
                align-items: center;
                gap: 1rem;
                width: 100%;
            }

            .step-number {
                margin: 0;
            }

            .form-actions {
                flex-direction: column;
            }

            .btn-primary, .btn-secondary {
                width: 100%;
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            .logo-img {
                height: 35px;
            }
            
            .logo-area h1 {
                font-size: 1rem;
            }
            
            .form-card {
                padding: 1.2rem;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="logo-area">
            <img src="{{ asset('img/logo_iufim.png') }}" alt="Logo IUFIM" class="logo-img">
            <h1>GEPROC <span>| Administrativos</span></h1>
        </div>

        <div class="user-menu">
            <div class="user-info">
                <div class="user-avatar">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div class="user-details">
                    <div class="user-name">{{ Auth::user()->name }}</div>
                    <div class="user-role">
                        <i class="fas fa-circle"></i>
                        Administrativo
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Salir</span>
                </button>
            </form>
        </div>
    </header>

    <!-- Contenido principal -->
    <main class="main-content">
        <div class="container">
            <div class="page-header">
                <h2>Completar Perfil</h2>
                <p>
                    <i class="fas fa-clipboard-list"></i>
                    Por favor completa la siguiente información (todos los campos son obligatorios)
                </p>
            </div>

            <!-- Progress Steps -->
            <div class="progress-steps">
                <div class="step active">
                    <div class="step-number">1</div>
                    <div class="step-label">Información Personal</div>
                </div>
                <div class="step">
                    <div class="step-number">2</div>
                    <div class="step-label">Información Laboral</div>
                </div>
                <div class="step">
                    <div class="step-number">3</div>
                    <div class="step-label">Documentos</div>
                </div>
            </div>

            <div class="info-note">
                <i class="fas fa-info-circle"></i>
                Todos los campos son obligatorios. Los documentos deben ser en formato <strong>PDF</strong> (máximo 4MB).
            </div>

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

            <div class="form-card">
                <form method="POST" action="{{ route('administrativos.guardar-perfil') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- Información Personal -->
                    <div class="form-section">
                        <h3>
                            <i class="fas fa-user"></i>
                            Información Personal
                        </h3>

                        <div class="form-row">
    <div class="form-group">
        <label for="nombres">
            <i class="fas fa-user"></i> Nombres <span class="required-star">*</span>
        </label>
        <input type="text" 
               class="form-control @error('nombres') is-invalid @enderror" 
               id="nombres" 
               name="nombres" 
               value="{{ old('nombres') }}" 
               required 
               placeholder="Ej: Juan Carlos">
        @error('nombres')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="apellido_paterno">
            <i class="fas fa-user"></i> Apellido Paterno <span class="required-star">*</span>
        </label>
        <input type="text" 
               class="form-control @error('apellido_paterno') is-invalid @enderror" 
               id="apellido_paterno" 
               name="apellido_paterno" 
               value="{{ old('apellido_paterno') }}" 
               required 
               placeholder="Ej: Perez">
        @error('apellido_paterno')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="apellido_materno">
            <i class="fas fa-user"></i> Apellido Materno
        </label>
        <input type="text" 
               class="form-control @error('apellido_materno') is-invalid @enderror" 
               id="apellido_materno" 
               name="apellido_materno" 
               value="{{ old('apellido_materno') }}" 
               placeholder="Ej: Gonzalez">
        @error('apellido_materno')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="fecha_nacimiento">
                                    <i class="fas fa-calendar"></i> Fecha de Nacimiento <span class="required-star">*</span>
                                </label>
                                <input type="date" 
                                       class="form-control @error('fecha_nacimiento') is-invalid @enderror" 
                                       id="fecha_nacimiento" 
                                       name="fecha_nacimiento" 
                                       value="{{ old('fecha_nacimiento') }}" 
                                       required>
                                @error('fecha_nacimiento')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="edad">
                                    <i class="fas fa-cake-candles"></i> Edad <span class="required-star">*</span>
                                </label>
                                <input type="number" 
                                       class="form-control @error('edad') is-invalid @enderror" 
                                       id="edad" 
                                       name="edad" 
                                       value="{{ old('edad') }}" 
                                       required 
                                       min="18" 
                                       max="100"
                                       placeholder="Ej: 25">
                                @error('edad')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="genero">
                                    <i class="fas fa-venus-mars"></i> Género <span class="required-star">*</span>
                                </label>
                                <select class="form-control @error('genero') is-invalid @enderror" id="genero" name="genero" required>
                                    <option value="">Seleccione...</option>
                                    <option value="M" {{ old('genero') == 'M' ? 'selected' : '' }}>Masculino</option>
                                    <option value="F" {{ old('genero') == 'F' ? 'selected' : '' }}>Femenino</option>
                                    <option value="OTRO" {{ old('genero') == 'OTRO' ? 'selected' : '' }}>Otro</option>
                                </select>
                                @error('genero')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="nacionalidad">
                                    <i class="fas fa-flag"></i> Nacionalidad <span class="required-star">*</span>
                                </label>
                                <input type="text" 
                                       class="form-control @error('nacionalidad') is-invalid @enderror" 
                                       id="nacionalidad" 
                                       name="nacionalidad" 
                                       value="{{ old('nacionalidad') }}" 
                                       required 
                                       placeholder="Ej: Mexicana">
                                @error('nacionalidad')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="estado_civil">
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
                                @error('estado_civil')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="lugar_nacimiento">
                                    <i class="fas fa-map-marker-alt"></i> Lugar de Nacimiento <span class="required-star">*</span>
                                </label>
                                <input type="text" 
                                       class="form-control @error('lugar_nacimiento') is-invalid @enderror" 
                                       id="lugar_nacimiento" 
                                       name="lugar_nacimiento" 
                                       value="{{ old('lugar_nacimiento') }}" 
                                       required 
                                       placeholder="Ej: Ciudad de Mexico, CDMX">
                                @error('lugar_nacimiento')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="telefono_celular">
                                    <i class="fas fa-phone-alt"></i> Teléfono Celular <span class="required-star">*</span>
                                </label>
                                <input type="tel" 
                                       class="form-control @error('telefono_celular') is-invalid @enderror" 
                                       id="telefono_celular" 
                                       name="telefono_celular" 
                                       value="{{ old('telefono_celular') }}" 
                                       required 
                                       placeholder="Ej: 5512345678">
                                @error('telefono_celular')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="telefono_fijo">
                                    <i class="fas fa-phone"></i> Teléfono Fijo
                                </label>
                                <input type="tel" 
                                       class="form-control @error('telefono_fijo') is-invalid @enderror" 
                                       id="telefono_fijo" 
                                       name="telefono_fijo" 
                                       value="{{ old('telefono_fijo') }}" 
                                       placeholder="Ej: 5555555555">
                                @error('telefono_fijo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email_personal">
                                <i class="fas fa-envelope"></i> Correo Electrónico Personal <span class="required-star">*</span>
                            </label>
                            <input type="email" 
                                   class="form-control @error('email_personal') is-invalid @enderror" 
                                   id="email_personal" 
                                   name="email_personal" 
                                   value="{{ old('email_personal') }}" 
                                   required 
                                   placeholder="ejemplo@correo.com">
                            @error('email_personal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="domicilio">
                                <i class="fas fa-home"></i> Domicilio <span class="required-star">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('domicilio') is-invalid @enderror" 
                                   id="domicilio" 
                                   name="domicilio" 
                                   value="{{ old('domicilio') }}" 
                                   required 
                                   placeholder="Calle y número">
                            @error('domicilio')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="colonia">
                                    <i class="fas fa-location-dot"></i> Colonia <span class="required-star">*</span>
                                </label>
                                <input type="text" 
                                       class="form-control @error('colonia') is-invalid @enderror" 
                                       id="colonia" 
                                       name="colonia" 
                                       value="{{ old('colonia') }}" 
                                       required 
                                       placeholder="Ej: Centro">
                                @error('colonia')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="codigo_postal">
                                    <i class="fas fa-mail-bulk"></i> Código Postal <span class="required-star">*</span>
                                </label>
                                <input type="text" 
                                       class="form-control @error('codigo_postal') is-invalid @enderror" 
                                       id="codigo_postal" 
                                       name="codigo_postal" 
                                       value="{{ old('codigo_postal') }}" 
                                       required 
                                       maxlength="5"
                                       placeholder="Ej: 12345">
                                @error('codigo_postal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="municipio">
                                    <i class="fas fa-city"></i> Municipio <span class="required-star">*</span>
                                </label>
                                <input type="text" 
                                       class="form-control @error('municipio') is-invalid @enderror" 
                                       id="municipio" 
                                       name="municipio" 
                                       value="{{ old('municipio') }}" 
                                       required 
                                       placeholder="Ej: Cuauhtémoc">
                                @error('municipio')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="ciudad_poblacion">
                                    <i class="fas fa-building"></i> Ciudad o Población <span class="required-star">*</span>
                                </label>
                                <input type="text" 
                                       class="form-control @error('ciudad_poblacion') is-invalid @enderror" 
                                       id="ciudad_poblacion" 
                                       name="ciudad_poblacion" 
                                       value="{{ old('ciudad_poblacion') }}" 
                                       required 
                                       placeholder="Ej: Ciudad de México">
                                @error('ciudad_poblacion')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Información Laboral -->
                    <div class="form-section">
                        <h3>
                            <i class="fas fa-briefcase"></i>
                            Información Laboral
                        </h3>

                        <div class="form-group">
                            <label for="puesto">
                                <i class="fas fa-user-tag"></i> Puesto <span class="required-star">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('puesto') is-invalid @enderror" 
                                   id="puesto" 
                                   name="puesto" 
                                   value="{{ old('puesto') }}" 
                                   required 
                                   placeholder="Ej: Auxiliar Administrativo">
                            @error('puesto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Documentos -->
                    <div class="form-section">
                        <h3>
                            <i class="fas fa-file-pdf"></i>
                            Documentos Requeridos (PDF - Máx. 4MB)
                        </h3>

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

                        @foreach($documentosRequeridos as $tipo => $info)
                            <div class="form-group">
                                <label for="{{ $tipo }}">
                                    <i class="fas fa-{{ $info['icono'] }}"></i> {{ $info['nombre'] }}
                                </label>
                                <input type="file" 
                                       class="form-control @error($tipo) is-invalid @enderror" 
                                       id="{{ $tipo }}" 
                                       name="{{ $tipo }}" 
                                       accept=".pdf">
                                <small style="color: #64748b; display: block; margin-top: 0.25rem;">
                                    {{ $info['descripcion'] }} (PDF, máx 4MB)
                                </small>
                                @error($tipo)
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        @endforeach

                        <div class="info-note" style="margin-top: 1rem;">
                            <i class="fas fa-info-circle"></i>
                            Los documentos se pueden subir ahora o más tarde desde tu dashboard. Una vez subidos, serán revisados por el administrador.
                        </div>
                    </div>

                    <!-- Acciones -->
                    <div class="form-actions">
                        <a href="{{ route('administrativos.dashboard') }}" class="btn-secondary">
                            <i class="fas fa-times"></i> Cancelar
                        </a>
                        <button type="submit" class="btn-primary">
                            <i class="fas fa-save"></i> Guardar Perfil
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>