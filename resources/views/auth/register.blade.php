<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario | GEPROC GP</title>
    <link href="{{ asset('css/register.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Bootstrap CSS (solo para los formularios) -->
    <link rel="stylesheet" href="css/register.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Contenido principal -->
    <main class="register-main">
        <div class="register-container">
            <div class="register-header">
                <h2>Crear una nueva cuenta</h2>
                <p>Únete a nuestra comunidad y accede a todos los recursos</p>
            </div>
            
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="register-form" id="registerForm">
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

                <!-- NUEVO CAMPO: Selección de Rol -->
                <div class="form-group">
                    <label for="role">Tipo de Usuario</label>
                    <div class="input-with-icon">
                        <i class="fas fa-user-tag"></i>
                        <select id="role" name="role" class="form-select" required onchange="toggleCoordinacionField()">
                            <option value="">Selecciona tu rol</option>
                            <option value="profesor" {{ old('role') == 'profesor' ? 'selected' : '' }}>Profesor</option>
                            <option value="coordinacion" {{ old('role') == 'coordinacion' ? 'selected' : '' }}>Coordinación</option>
                        </select>
                    </div>
                    @error('role')
                        <span class="error-message">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- NUEVO CAMPO: Selección de Coordinación (se muestra solo para rol coordinación) -->
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
                    </div>
                </div>

                <button type="submit" class="register-button">
                    <i class="fas fa-user-plus"></i> Registrar
                </button>

                <div class="register-button1">
                    <a href="{{ route('login') }}">¿Ya tienes cuenta? Inicia sesión</a>
                </div>

            </form>
        </div>
    </main>

    <!-- JavaScript para mostrar/ocultar campo de coordinación -->
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

        // Ejecutar al cargar la página para mantener el estado si hay errores
        document.addEventListener('DOMContentLoaded', function() {
            toggleCoordinacionField();
            
            // Si hay errores de validación, asegurarse de que los campos mantengan su estado
            const roleValue = "{{ old('role') }}";
            if (roleValue === 'coordinacion') {
                document.getElementById('coordinacionField').style.display = 'block';
            }
        });
    </script>

</body>
</html>