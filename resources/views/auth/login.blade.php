<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión | New Developer</title>
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
        /* Efecto de ondas en la parte inferior - MÁS VISIBLE */
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

        /* ========== ESTILOS DEL MENÚ CENTRADO DEL PRIMER CÓDIGO ========== */
        /* HEADER FIXED */
        .header {
            width: 100%;
            padding: 16px 40px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: fixed;
            background: #fff;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 15px rgba(0,0,0,.05);
        }

        /* LOGO PEGADO A LA IZQUIERDA */
        .logo-container { 
            display: flex; 
            align-items: center; 
            gap: 12px; 
            height: 40px; /* ALTURA FIJA PARA EL CONTENEDOR */
        }
        .logo-img { 
            width: 60px; /* MÁS GRANDE */
            height: 60px; /* MÁS GRANDE */
            border-radius: 8px; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            color: white;
            object-fit: contain; /* PARA MANTENER PROPORCIONES */
        }

        /* NAV - MÁS GRANDE Y CENTRADO */
        nav {
            display: flex;
            justify-content: center;
            align-items: center;
            flex: 1;
        }

        nav a {
            margin: 0 18px;
            text-decoration: none;
            color: var(--text-dark);
            font-weight: 500;
            font-size: 1rem;
            position: relative;
            padding-bottom: 5px;
        }
        
        nav a:hover,
        nav a.active { 
            color: var(--primary); 
        }
        
        nav a.active::after,
        nav a:hover::after {
            content:"";
            position: absolute;
            bottom: 0; 
            left: 0;
            height: 3px; 
            width: 100%;
            background: var(--primary);
        }

        /* LOGIN BUTTON */
        .login-btn {
            padding: 10px 24px;
            background: white; /* FONDO BLANCO */
            color: var(--primary); /* TEXTO AZUL */
            border-radius: 8px;
            font-weight: 600;
            font-size: 1rem;
            text-decoration: none;
            transition: all 0.3s ease;
            border: 2px solid var(--primary); /* BORDE AZUL */
            box-shadow: 0 2px 8px rgba(7, 68, 182, 0.2);
        }
        
        .login-btn:hover {
            background: var(--primary); /* FONDO AZUL AL PASAR MOUSE */
            color: white; /* TEXTO BLANCO AL PASAR MOUSE */
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(7, 68, 182, 0.3);
        }

        /* ========== FIN ESTILOS DEL MENÚ CENTRADO ========== */

        /* CONTENEDOR PRINCIPAL */
        .main-content {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
            margin-top: 80px; /* Espacio para el header fijo */
        }

        /* LOGIN CONTAINER */
        .login-container {
            width: 100%;
            max-width: 380px;
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            position: relative;
            z-index: 1;
            border: 1px solid rgba(7, 68, 182, 0.1);
        }

        .login-header {
            padding: 2rem 2rem 1.2rem;
            text-align: center;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            color: white;
            position: relative;
        }

        .login-header::after {
            content: '';
            position: absolute;
            bottom: -18px;
            left: 0;
            width: 100%;
            height: 36px;
            background: white;
            border-radius: 50% 50% 0 0;
        }

        .login-logo {
            width: 70px;
            height: 70px;
            margin: 0 auto 0.8rem;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .login-logo img {
            width: 45px;
            height: auto;
        }

        .login-header h1 {
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 0.4rem;
        }

        .login-header p {
            font-size: 0.85rem;
            opacity: 0.9;
        }

        .login-form {
            padding: 1.8rem 1.8rem 1.2rem;
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

        .input-with-icon input {
            width: 100%;
            padding: 10px 12px 10px 40px;
            border: 2px solid var(--gray-border);
            border-radius: 8px;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            background-color: white;
            position: relative;
        }

        .input-with-icon input:focus {
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

        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.2rem;
        }

        .remember-me {
            display: flex;
            align-items: center;
        }

        .remember-me input {
            margin-right: 6px;
            accent-color: var(--primary);
        }

        .remember-me label {
            margin: 0;
            font-size: 0.8rem;
            color: var(--text-light);
        }

        .forgot-password {
            color: var(--primary);
            text-decoration: none;
            font-size: 0.8rem;
            transition: color 0.2s ease;
            font-weight: 600;
        }

        .forgot-password:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }

        .login-button {
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
            margin-bottom: 1.2rem;
        }

        .login-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(7, 68, 182, 0.4);
        }

        .login-button:active {
            transform: translateY(0);
        }

        .register-link {
            text-align: center;
            font-size: 0.85rem;
            color: var(--text-light);
        }

        .register-link a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s ease;
        }

        .register-link a:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }

        /* Alertas personalizadas */
        .alert {
            margin-bottom: 1rem;
            border-radius: 8px;
            font-size: 0.8rem;
            padding: 0.6rem 0.8rem;
            border: none;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .alert-info {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            color: white;
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

        /* Efectos decorativos más sutiles */
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

        /* Responsive */
        @media (max-width: 768px) {
            .header {
                padding: 14px 20px;
                flex-wrap: wrap;
            }
            
            nav {
                order: 2;
                width: 100%;
                margin-top: 10px;
            }
            
            .logo-container, .header-actions {
                flex: none;
            }
        }

        @media (max-width: 576px) {
            .login-container {
                max-width: 100%;
            }
            
            .login-header {
                padding: 1.5rem 1.5rem 1rem;
            }
            
            .login-form {
                padding: 1.5rem 1.5rem 1rem;
            }
            
            .form-options {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.6rem;
            }
            
            nav a {
                margin: 0 10px;
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <!-- Fondo decorativo con ondas - MÁS VISIBLE -->
    <div class="wave-decoration"></div>

    <!-- ✅ NAVBAR CON MENÚ CENTRADO -->
    <header class="header">
        <div class="logo-container">
            <img src="{{ asset('img/logo_iufim.png') }}" alt="Logo" class="logo-img">
        </div>

        <nav>
            <a href="{{ route('inicio') }}" class="active">Inicio</a>
        </nav>

    </header>

    <!-- CONTENEDOR PRINCIPAL -->
    <div class="main-content">
        <!-- Contenedor de login -->
        <div class="login-container">
            <!-- Efectos decorativos -->
            <div class="decoration-circle circle-1"></div>
            <div class="decoration-circle circle-2"></div>
            
            <!-- Encabezado -->
            <div class="login-header">
                <div class="login-logo">
                    <img src="{{ asset('img/logo_iufim.png') }}" alt="Logo">
                </div>
                <h1>Iniciar Sesión</h1>
                <p>Accede a tu cuenta para continuar</p>
            </div>
            
            <!-- Formulario -->
            <div class="login-form">
                <!-- Alertas -->
                @if(session('role_changed'))
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i>
                        {{ session('role_changed') }}
                    </div>
                @endif

                @if(session('success'))
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i>
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group">
                        <label for="email">Correo electrónico</label>
                        <div class="input-with-icon">
                            <i class="fas fa-envelope"></i>
                            <input id="email" type="email" class="@error('email') is-invalid @enderror" 
                                   name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                   placeholder="tucorreo@ejemplo.com">
                        </div>
                        @error('email')
                            <div class="alert alert-danger mt-2">
                                <i class="fas fa-exclamation-circle"></i>
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <div class="input-with-icon">
                            <i class="fas fa-lock"></i>
                            <input id="password" type="password" class="@error('password') is-invalid @enderror" 
                                   name="password" required autocomplete="current-password"
                                   placeholder="Ingresa tu contraseña">
                            <button type="button" class="password-toggle" id="togglePassword">
                                <i class="far fa-eye"></i>
                            </button>
                        </div>
                        @error('password')
                            <div class="alert alert-danger mt-2">
                                <i class="fas fa-exclamation-circle"></i>
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>

                    <div class="form-options">
                        <div class="remember-me">
                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label for="remember">Recordarme</label>
                        </div>
                        <a href="{{ route('password.request') }}" class="forgot-password">¿Olvidaste tu contraseña?</a>
                    </div>

                    <button type="submit" class="login-button">
                        <i class="fas fa-sign-in-alt"></i> Iniciar Sesión
                    </button>

                    <div class="register-link">
                        ¿No tienes cuenta? <a href="{{ route('register') }}">Regístrate aquí</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (para las alertas) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Script para mostrar/ocultar contraseña -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');
            
            togglePassword.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                
                // Cambiar icono
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