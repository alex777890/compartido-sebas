<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer Contraseña | New Developer</title>
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<main class="login-main">
    <div class="login-container">
        <div class="login-header">
            <h2>Restablecer Contraseña</h2>
            <p>Ingresa tu nueva contraseña</p>
        </div>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.update') }}" class="login-form">
            @csrf

            <!-- Token oculto -->
            <input type="hidden" name="token" value="{{ $token }}">
            
            <!-- Email oculto (viene por query string) -->
            <input type="hidden" name="email" value="{{ request()->email }}">

            <div class="form-group">
                <label for="password">Nueva Contraseña</label>
                <div class="input-with-icon">
                    <i class="fas fa-lock"></i>
                    <input id="password" type="password" 
                           class="@error('password') is-invalid @enderror" 
                           name="password" required autocomplete="new-password"
                           placeholder="Ingresa nueva contraseña">
                </div>
                @error('password')
                    <span class="error-message">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password-confirm">Confirmar Contraseña</label>
                <div class="input-with-icon">
                    <i class="fas fa-lock"></i>
                    <input id="password-confirm" type="password" 
                           name="password_confirmation" required autocomplete="new-password"
                           placeholder="Confirma tu contraseña">
                </div>
            </div>

            <button type="submit" class="login-button">
                <i class="fas fa-sync-alt"></i> Restablecer Contraseña
            </button>
        </form>
    </div>

    <!-- Área gráfica -->
    <div class="login-graphics">
        <div class="graphic-circle circle-1"></div>
        <div class="graphic-circle circle-2"></div>
        <div class="login-logo">GP</div>
        <h1>Restablecer</h1>
        <p>Introduce tu nueva contraseña para recuperar el acceso a tu cuenta.</p>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>