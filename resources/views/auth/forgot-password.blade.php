<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña | New Developer</title>
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<main class="login-main">
    <div class="login-container">
        <div class="login-header">
            <h2>Recuperar Contraseña</h2>
            <p>Introduce tu correo y te enviaremos un enlace para restablecer tu contraseña.</p>
        </div>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="login-form">
            @csrf

            <div class="form-group">
                <label for="email">Correo electrónico</label>
                <div class="input-with-icon">
                    <i class="fas fa-envelope"></i>
                    <input id="email" type="email" class="@error('email') is-invalid @enderror"
                           name="email" value="{{ old('email') }}" required autofocus
                           placeholder="tucorreo@ejemplo.com">
                </div>
                @error('email')
                    <span class="error-message"><strong>{{ $message }}</strong></span>
                @enderror
            </div>

            <button type="submit" class="login-button">
                <i class="fas fa-paper-plane"></i> Enviar enlace de recuperación
            </button>
        </form>

        <div class="text-center mt-3">
            <a href="{{ route('inicio') }}">Volver</a>
        </div>
    </div>

    <div class="login-graphics">
        <div class="graphic-circle circle-1"></div>
        <div class="graphic-circle circle-2"></div>
        
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>