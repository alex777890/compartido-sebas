<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario | New Developer</title>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Bootstrap CSS (solo para las alertas) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #0744b6ff;
            --primary-light: #2c6ae5;
            --primary-dark: #053494;
            --text-dark: #1a202c;
            --text-light: #596170;
            --bg-light: #f7f9fc;
            --gray-border: #dce3ee;
            --success: #10b981;
            --error: #ef4444;
            --warning: #f59e0b;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Open Sans', sans-serif;
            min-height: 100vh;
            background: white;
            display: flex;
            flex-direction: column;
            color: var(--text-dark);
            position: relative;
            overflow-x: hidden;
        }

        /* Efecto de ondas en la parte inferior */
        .wave-decoration {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 120px;
            background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1200 120' preserveAspectRatio='none'%3E%3Cpath d='M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z' fill='%230744b6' fill-opacity='0.06'%3E%3C/path%3E%3C/svg%3E");
            background-size: cover;
            z-index: -1;
        }

        /* CONTENEDOR PRINCIPAL */
        .main-content {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
            min-height: 100vh;
        }

        /* CONTENEDOR QUE DIVIDE EN DOS MITADES */
        .split-container {
            display: flex;
            width: 100%;
            max-width: 1400px;
            background: transparent;
            gap: 2rem;
            align-items: center;
        }

        /* MITAD IZQUIERDA - IMAGEN MÁS GRANDE */
        .image-half {
            flex: 1.2; /* Le doy más espacio a la imagen */
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        .image-half img {
            width: 100%;
            max-width: 700px; /* Aumentado de 500px a 700px */
            height: auto;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            object-fit: cover;
        }

        /* MITAD DERECHA - FORMULARIO */
        .form-half {
            flex: 0.9; /* Reduzco un poco el espacio del formulario */
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        /* REGISTER CONTAINER - EXACTAMENTE IGUAL */
        .register-container {
            width: 100%;
            max-width: 420px;
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            position: relative;
            z-index: 1;
            border: 1px solid rgba(7, 68, 182, 0.1);
        }

        .register-header {
            padding: 2rem 2rem 1.2rem;
            text-align: center;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            color: white;
            position: relative;
        }

        .register-header::after {
            content: '';
            position: absolute;
            bottom: -18px;
            left: 0;
            width: 100%;
            height: 36px;
            background: white;
            border-radius: 50% 50% 0 0;
        }

        .register-header h1 {
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 0.4rem;
        }

        .register-header p {
            font-size: 0.85rem;
            opacity: 0.9;
        }

        .register-form {
            padding: 2rem 2rem 1.5rem;
        }

        .form-group {
            margin-bottom: 1.2rem;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.4rem;
            font-weight: 600;
            color: var(--text-dark);
            font-size: 0.85rem;
        }

        .input-with-icon {
            position: relative;
        }

        .input-with-icon i {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary);
            font-size: 0.9rem;
            z-index: 1;
        }

        .input-with-icon input,
        .input-with-icon select {
            width: 100%;
            padding: 10px 12px 10px 40px;
            border: 2px solid var(--gray-border);
            border-radius: 8px;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            background-color: white;
            position: relative;
        }

        .input-with-icon select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%230744b6' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
            background-size: 12px;
            cursor: pointer;
        }

        .input-with-icon input:focus,
        .input-with-icon select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(7, 68, 182, 0.1);
            outline: none;
        }

        .password-toggle {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--text-light);
            cursor: pointer;
            font-size: 0.85rem;
            z-index: 1;
        }

        .register-button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            box-shadow: 0 4px 12px rgba(7, 68, 182, 0.3);
            margin: 1.5rem 0 1rem;
        }

        .register-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(7, 68, 182, 0.4);
        }

        .login-link {
            text-align: center;
            font-size: 0.85rem;
            color: var(--text-light);
        }

        .login-link a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s ease;
        }

        .login-link a:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }

        /* Alertas */
        .alert {
            margin-bottom: 1rem;
            border-radius: 8px;
            font-size: 0.8rem;
            padding: 0.6rem 0.8rem;
            border: none;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .alert-success {
            background: linear-gradient(135deg, var(--success) 0%, #34d399 100%);
            color: white;
        }

        .alert-danger {
            background: linear-gradient(135deg, var(--error) 0%, #f87171 100%);
            color: white;
        }

        .alert i {
            margin-right: 6px;
        }

        .alert ul {
            margin-top: 5px;
            padding-left: 20px;
        }

        .error-message {
            display: block;
            color: var(--error);
            font-size: 0.7rem;
            margin-top: 0.2rem;
            font-weight: 500;
        }

        .decoration-circle {
            position: absolute;
            border-radius: 50%;
            z-index: 0;
        }

        .circle-1 {
            width: 150px;
            height: 150px;
            top: -60px;
            right: -60px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            opacity: 0.08;
        }

        .circle-2 {
            width: 120px;
            height: 120px;
            bottom: -45px;
            left: -45px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            opacity: 0.08;
        }

        #coordinacionField {
            transition: all 0.3s ease;
        }

        .form-group[style*="display: none"] {
            margin: 0;
            padding: 0;
            height: 0;
            overflow: hidden;
        }

        /* Línea divisoria (opcional, la puedes quitar si no la quieres) */
        .divider-vertical {
            width: 3px;
            height: 500px;
            background: linear-gradient(180deg, transparent 0%, var(--primary) 20%, var(--primary-light) 50%, var(--primary) 80%, transparent 100%);
            border-radius: 3px;
            box-shadow: 0 0 15px rgba(7, 68, 182, 0.3);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .split-container {
                flex-direction: column;
                gap: 1rem;
            }
            
            .image-half, .form-half {
                width: 100%;
                flex: 1;
            }
            
            .image-half img {
                max-width: 500px;
            }
            
            .divider-vertical {
                display: none;
            }
        }
    </style>
</head>
<body>
    <!-- Fondo decorativo con ondas -->
    <div class="wave-decoration"></div>

    <!-- CONTENEDOR PRINCIPAL -->
    <div class="main-content">
        <!-- Contenedor dividido en dos mitades -->
        <div class="split-container">
            <!-- MITAD IZQUIERDA - IMAGEN MÁS GRANDE -->
            <div class="image-half">
                <img src="{{ asset('img/register.jpeg') }}" alt="Registro">
            </div>
            
            <!-- Línea divisoria (opcional - la puedes eliminar si no la quieres) -->
            <div class="divider-vertical"></div>
            
            <!-- MITAD DERECHA - FORMULARIO (EXACTAMENTE IGUAL) -->
            <div class="form-half">
                <div class="register-container">
                    <!-- Efectos decorativos -->
                    <div class="decoration-circle circle-1"></div>
                    <div class="decoration-circle circle-2"></div>
                    
                    <!-- Encabezado -->
                    <div class="register-header">
                        <h1>Crear una nueva cuenta</h1>
                        <p>Únete a nuestra comunidad y accede a todos los recursos</p>
                    </div>
                    
                    <!-- Formulario -->
                    <div class="register-form">
                        <!-- Alertas -->
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <i class="fas fa-exclamation-circle"></i>
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if(session('success'))
                            <div class="alert alert-success">
                                <i class="fas fa-check-circle"></i>
                                {{ session('success') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('register') }}" id="registerForm">
                            @csrf

                            <div class="form-group">
                                <label for="name">Nombre completo</label>
                                <div class="input-with-icon">
                                    <i class="fas fa-user"></i>
                                    <input type="text" id="name" name="name" 
                                           value="{{ old('name') }}" required autofocus
                                           placeholder="Ingresa tu nombre completo">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email">Correo electrónico</label>
                                <div class="input-with-icon">
                                    <i class="fas fa-envelope"></i>
                                    <input type="email" id="email" name="email" 
                                           value="{{ old('email') }}" required
                                           placeholder="tucorreo@ejemplo.com">
                                </div>
                            </div>

                            <!-- Campo de Selección de Coordinación -->
                            <div class="form-group" id="coordinacionField" style="display: none;">
                                <label for="coordinaciones_id">Coordinación</label>
                                <div class="input-with-icon">
                                    <i class="fas fa-building"></i>
                                    <select id="coordinaciones_id" name="coordinaciones_id" class="form-select">
                                        <option value="">Selecciona tu coordinación</option>
                                        @foreach($coordinaciones as $coordinacion)
                                            <option value="{{ $coordinacion->id }}" {{ old('coordinaciones_id') == $coordinacion->id ? 'selected' : '' }}>
                                                {{ $coordinacion->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('coordinaciones_id')
                                    <span class="error-message">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password">Contraseña</label>
                                <div class="input-with-icon">
                                    <i class="fas fa-lock"></i>
                                    <input type="password" id="password" 
                                           name="password" required
                                           placeholder="Mínimo 8 caracteres">
                                    <button type="button" class="password-toggle" id="togglePassword">
                                        <i class="far fa-eye"></i>
                                    </button>
                                </div>
                                @error('password')
                                    <span class="error-message">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation">Confirmar contraseña</label>
                                <div class="input-with-icon">
                                    <i class="fas fa-lock"></i>
                                    <input type="password" id="password_confirmation" 
                                           name="password_confirmation" required
                                           placeholder="Repite tu contraseña">
                                    <button type="button" class="password-toggle" id="togglePasswordConfirm">
                                        <i class="far fa-eye"></i>
                                    </button>
                                </div>
                            </div>

                            <button type="submit" class="register-button">
                                <i class="fas fa-user-plus"></i> Registrar
                            </button>

                            <div class="login-link">
                                ¿Ya tienes cuenta? <a href="{{ route('inicio') }}">Inicia sesión</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- JavaScript -->
    <script>
        function toggleCoordinacionField() {
            const roleSelect = document.getElementById('role');
            const coordinacionField = document.getElementById('coordinacionField');
            const coordinacionSelect = document.getElementById('coordinaciones_id');
            
            if (roleSelect.value === 'coordinacion') {
                coordinacionField.style.display = 'block';
                coordinacionSelect.required = true;
            } else {
                coordinacionField.style.display = 'none';
                coordinacionSelect.required = false;
                coordinacionSelect.value = '';
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            toggleCoordinacionField();
            
            const roleValue = "{{ old('role') }}";
            if (roleValue === 'coordinacion') {
                document.getElementById('coordinacionField').style.display = 'block';
            }

            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');
            
            togglePassword.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                
                const icon = this.querySelector('i');
                if (type === 'password') {
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                } else {
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                }
            });

            const togglePasswordConfirm = document.getElementById('togglePasswordConfirm');
            const passwordConfirmInput = document.getElementById('password_confirmation');
            
            togglePasswordConfirm.addEventListener('click', function() {
                const type = passwordConfirmInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordConfirmInput.setAttribute('type', type);
                
                const icon = this.querySelector('i');
                if (type === 'password') {
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                } else {
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                }
            });
        });
    </script>
</body>
</html>