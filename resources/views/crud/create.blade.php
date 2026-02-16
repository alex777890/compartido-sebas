<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Usuario - Sistema GEPROC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
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
    }

    body { 
        background: #f5f7fa; 
        font-family: 'Inter', 'Segoe UI', sans-serif; 
        color: #333; 
        line-height: 1.5;
        padding: 0;
        margin: 0;
    }

    /* Barra superior - TAMAÑO ORIGINAL */
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

/* Barra de menú - TAMAÑO ORIGINAL */
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
    font-size: 0.95rem;
}

.navbar-menu .user-avatar {
    font-size: 1.3rem;
    color: rgba(255, 255, 255, 0.9);
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

    /* Contenido principal - AHORA MÁS COMPACTO */
    .main-content { 
        padding: 20px;
        min-height: calc(100vh - 110px);
    }

    .content-container {
        background: white;
        border-radius: 8px;
        padding: 1.5rem;
        margin-bottom: 1rem;
        border: 1px solid var(--border-color);
        box-shadow: var(--card-shadow);
        max-width: 1200px;
        margin: 0 auto;
    }

    h2 { 
        color: var(--primary);
        margin-bottom: 0.5rem; 
        font-size: 1.3rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    h2 i {
        font-size: 1.2rem;
    }

    /* Header compacto */
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.2rem;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .page-title-section {
        flex: 1;
    }

    .page-subtitle {
        color: var(--text-muted);
        font-size: 0.85rem;
        margin-bottom: 0;
    }

    .page-actions {
        display: flex;
        gap: 0.8rem;
        flex-wrap: wrap;
    }

    /* FORMULARIO EN GRID - 2 COLUMNAS */
    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
    }

    .form-group {
        background: rgba(7, 68, 182, 0.02);
        border: 1px solid var(--border-color);
        border-radius: 6px;
        padding: 1rem;
        margin-bottom: 1rem;
    }

    .form-group.full-width {
        grid-column: span 2;
    }

    .form-group-title {
        color: var(--primary);
        font-weight: 600;
        margin-bottom: 0.8rem;
        padding-bottom: 0.4rem;
        border-bottom: 1px solid var(--border-color);
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.95rem;
    }

    .form-group-title i {
        font-size: 0.9rem;
    }

    /* Campos en grid dentro de cada grupo */
    .fields-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
    }

    .field-container {
        margin-bottom: 0.5rem;
    }

    .field-container.full-width {
        grid-column: span 2;
    }

    .form-label {
        font-weight: 500;
        color: var(--primary);
        margin-bottom: 0.3rem;
        font-size: 0.85rem;
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }

    .form-label i {
        font-size: 0.8rem;
        color: var(--text-muted);
    }

    .form-control, .form-select {
        border: 1px solid var(--border-color);
        border-radius: 4px;
        padding: 0.5rem 0.75rem;
        font-size: 0.9rem;
        transition: var(--transition);
        height: 38px;
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 0.2rem rgba(7, 68, 182, 0.1);
    }

    .form-text {
        color: var(--text-muted);
        font-size: 0.75rem;
        margin-top: 0.2rem;
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }

    /* Coordinación especial */
    .coordinacion-required {
        border-left: 3px solid var(--primary);
        padding-left: 0.8rem;
        background: rgba(7, 68, 182, 0.03);
        border-radius: 0 4px 4px 0;
    }

    /* Botones más compactos */
    .btn-primary-custom {
        background: var(--primary);
        border: none;
        color: white;
        font-weight: 500;
        padding: 0.5rem 1.2rem;
        border-radius: 4px;
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 0.9rem;
        height: 38px;
    }

    .btn-primary-custom:hover {
        background: #063a9b;
        transform: translateY(-1px);
        box-shadow: 0 3px 8px rgba(7, 68, 182, 0.2);
    }

    .btn-secondary-custom {
        background: #6c757d;
        border: none;
        color: white;
        font-weight: 500;
        padding: 0.5rem 1.2rem;
        border-radius: 4px;
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 0.9rem;
        height: 38px;
    }

    .btn-secondary-custom:hover {
        background: #5a6268;
        transform: translateY(-1px);
    }

    .btn-outline-custom {
        background: white;
        border: 1px solid var(--border-color);
        color: var(--primary);
        font-weight: 500;
        padding: 0.5rem 1.2rem;
        border-radius: 4px;
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 0.9rem;
        height: 38px;
    }

    .btn-outline-custom:hover {
        background: rgba(7, 68, 182, 0.05);
        border-color: var(--primary);
    }

    .btn-group-custom {
        display: flex;
        gap: 0.8rem;
        margin-top: 1rem;
        padding-top: 1rem;
        border-top: 1px solid var(--border-color);
        justify-content: flex-end;
    }

    /* Alertas compactas */
    .alert {
        border-radius: 4px;
        padding: 0.8rem;
        margin-bottom: 1rem;
        font-size: 0.9rem;
    }

    .alert ul {
        margin: 0.3rem 0 0 1.2rem;
        padding-left: 0.5rem;
    }

    .alert-danger {
        background-color: rgba(220, 53, 69, 0.05);
        border-color: rgba(220, 53, 69, 0.2);
        color: #dc3545;
    }

    /* Campos dinámicos */
    .field-container.hidden {
        display: none;
    }

    .field-container.visible {
        display: block;
    }

    /* Responsive */
    @media (max-width: 992px) {
        .form-grid {
            grid-template-columns: 1fr;
        }
        
        .form-group.full-width {
            grid-column: span 1;
        }
        
        .fields-grid {
            grid-template-columns: 1fr;
        }
        
        .field-container.full-width {
            grid-column: span 1;
        }
    }

    @media (max-width: 768px) {
        .navbar-top {
            padding: 0.4rem 0;
        }
        
        .logo-img {
            height: 40px;
        }
        
        .navbar-brand {
            font-size: 1.1rem;
        }
        
        .navbar-menu {
            top: 58px;
        }
        
        .main-content {
            padding: 15px;
        }
        
        .content-container {
            padding: 1rem;
        }
        
        .page-header {
            flex-direction: column;
            align-items: stretch;
        }
        
        .page-actions {
            width: 100%;
        }
        
        .btn-group-custom {
            flex-direction: column;
        }
        
        .btn-group-custom .btn {
            width: 100%;
            justify-content: center;
        }
        
        .user-info-container {
            flex-direction: column;
            gap: 8px;
            align-items: flex-start;
            margin-top: 8px;
            padding-top: 8px;
            border-top: 1px solid rgba(255,255,255,0.2);
        }
    }

    @media (max-width: 576px) {
        h2 {
            font-size: 1.2rem;
        }
        
        .content-container {
            padding: 0.8rem;
        }
        
        .form-group {
            padding: 0.8rem;
        }
    }
    </style>
</head>
<body>
    <!-- Primera barra - Logo y título (más compacta) -->
    <nav class="navbar navbar-expand-lg navbar-top">
        <div class="container">
            <div class="logo-container">
                <img src="{{ asset('img/logo_iufim.png') }}" alt="Logo" class="logo-img">
                <a class="navbar-brand" href="{{ route('dashboard') }}">
                    Sistema GEPROC
                </a>
            </div>
        </div>
    </nav>

   <!-- Segunda barra - Menú -->
    <nav class="navbar navbar-expand-lg navbar-menu">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('coordinaciones.*') ? 'active' : '' }}" href="{{ route('coordinaciones.index') }}">Coordinaciones</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('maestros.*') ? 'active' : '' }}" href="{{ route('maestros.index') }}">Maestros</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('contratos.*') ? 'active' : '' }}" href="{{ route('contracts.index') }}">Contratos</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}">Accesos</a></li>
                </ul>
                
                <!-- Información de usuario y cerrar sesión -->
                <div class="user-info-container">
                    <div class="user-info">
                        <span class="user-name">{{ Auth::user()->name }}</span>
                        <div class="user-avatar">
                            <i class="fas fa-user-circle"></i>
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


    <div class="container-fluid">
        <div class="row">
            <div class="col-12 main-content">
                <div class="content-container">
                    <!-- Header compacto -->
                    <div class="page-header">
                        <div class="page-title-section">
                            <h2>
                                <i class="fas fa-user-plus"></i>
                                Crear Nuevo Usuario
                            </h2>
                            <p class="page-subtitle">Complete los campos para registrar un usuario</p>
                        </div>
                        <div class="page-actions">
                            <a href="{{ route('users.index') }}" class="btn-outline-custom">
                                <i class="fas fa-users"></i>Ver Usuarios
                            </a>
                        </div>
                    </div>

                    <!-- Alertas de errores (más compactas) -->
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show">
                            <div class="d-flex">
                                <i class="fas fa-exclamation-triangle me-2 mt-1"></i>
                                <div>
                                    <strong>Errores encontrados:</strong>
                                    <ul class="mb-0">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
                            </div>
                        </div>
                    @endif

                    <!-- Formulario en GRID de 2 columnas -->
                    <form method="POST" action="{{ route('users.store') }}" id="userForm">
                        @csrf

                        <div class="form-grid">
                            <!-- Grupo 1: Información personal -->
                            <div class="form-group">
                                <h4 class="form-group-title">
                                    <i class="fas fa-id-card"></i> Información Personal
                                </h4>
                                <div class="fields-grid">
                                    <!-- Nombre completo -->
                                    <div class="field-container full-width">
                                        <label for="name" class="form-label">
                                            <i class="fas fa-user"></i>Nombre Completo
                                        </label>
                                        <input type="text" 
                                               class="form-control @error('name') is-invalid @enderror" 
                                               id="name" name="name" 
                                               value="{{ old('name') }}" 
                                               placeholder="Juan Pérez González" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Correo electrónico -->
                                    <div class="field-container full-width">
                                        <label for="email" class="form-label">
                                            <i class="fas fa-envelope"></i>Correo Electrónico
                                        </label>
                                        <input type="email" 
                                               class="form-control @error('email') is-invalid @enderror" 
                                               id="email" name="email" 
                                               value="{{ old('email') }}" 
                                               placeholder="ejemplo@iufim.edu.mx" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">
                                            <i class="fas fa-info-circle"></i>
                                            Será el usuario de acceso
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Grupo 2: Rol y permisos -->
                            <div class="form-group">
                                <h4 class="form-group-title">
                                    <i class="fas fa-user-tag"></i> Permisos y Acceso
                                </h4>
                                <div class="fields-grid">
                                    <!-- Rol -->
                                    <div class="field-container full-width">
                                        <label for="role" class="form-label">
                                            <i class="fas fa-user-shield"></i>Tipo de Usuario
                                        </label>
                                        <select class="form-select @error('role') is-invalid @enderror" 
                                                id="role" name="role" required>
                                            <option value="">Seleccione tipo</option>
                                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrador</option>
                                            <option value="profesor" {{ old('role') == 'profesor' ? 'selected' : '' }}>Profesor</option>
                                            <option value="coordinacion" {{ old('role') == 'coordinacion' ? 'selected' : '' }}>Coordinación</option>
                                        </select>
                                        @error('role')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Coordinación (condicional) -->
                                    <div class="field-container full-width coordinacion-required {{ old('role') == 'coordinacion' ? 'visible' : 'hidden' }}" id="coordinacionField">
                                        <label for="coordinaciones_id" class="form-label">
                                            <i class="fas fa-university"></i>Asignar a Coordinación
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select class="form-select @error('coordinaciones_id') is-invalid @enderror" 
                                                id="coordinaciones_id" name="coordinaciones_id">
                                            <option value="">Seleccione una coordinación</option>
                                            @foreach($coordinaciones as $coordinacion)
                                                <option value="{{ $coordinacion->id }}" {{ old('coordinaciones_id') == $coordinacion->id ? 'selected' : '' }}>
                                                    {{ $coordinacion->display_name ?? $coordinacion->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('coordinaciones_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Grupo 3: Seguridad (ocupa las 2 columnas) -->
                            <div class="form-group full-width">
                                <h4 class="form-group-title">
                                    <i class="fas fa-lock"></i> Seguridad y Acceso
                                </h4>
                                <div class="fields-grid">
                                    <!-- Contraseña -->
                                    <div class="field-container">
                                        <label for="password" class="form-label">
                                            <i class="fas fa-key"></i>Contraseña
                                        </label>
                                        <input type="password" 
                                               class="form-control @error('password') is-invalid @enderror" 
                                               id="password" name="password" 
                                               placeholder="Mínimo 8 caracteres" required>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Mínimo 8 caracteres</div>
                                    </div>

                                    <!-- Confirmar contraseña -->
                                    <div class="field-container">
                                        <label for="password_confirmation" class="form-label">
                                            <i class="fas fa-key"></i>Confirmar Contraseña
                                        </label>
                                        <input type="password" 
                                               class="form-control" 
                                               id="password_confirmation" 
                                               name="password_confirmation" 
                                               placeholder="Repita la contraseña" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Botones de acción -->
                        <div class="btn-group-custom">
                            <a href="{{ route('users.index') }}" class="btn-secondary-custom">
                                <i class="fas fa-times"></i>Cancelar
                            </a>
                            <button type="submit" class="btn-primary-custom">
                                <i class="fas fa-save"></i>Crear Usuario
                            </button>
                        </div>
                    </form>
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

            // Función para mostrar/ocultar campo de coordinación
            function toggleCoordinacionField() {
                const roleSelect = document.getElementById('role');
                const coordinacionField = document.getElementById('coordinacionField');
                const coordinacionSelect = document.getElementById('coordinaciones_id');
                
                if (roleSelect.value === 'coordinacion') {
                    coordinacionField.classList.remove('hidden');
                    coordinacionField.classList.add('visible');
                    coordinacionSelect.required = true;
                } else {
                    coordinacionField.classList.remove('visible');
                    coordinacionField.classList.add('hidden');
                    coordinacionSelect.required = false;
                    coordinacionSelect.value = '';
                }
            }

            // Validación de coincidencia de contraseñas
            function validatePasswordMatch() {
                const password = document.getElementById('password');
                const confirm = document.getElementById('password_confirmation');
                
                if (password.value && confirm.value) {
                    if (password.value !== confirm.value) {
                        confirm.classList.add('is-invalid');
                        confirm.setCustomValidity('Las contraseñas no coinciden');
                        
                        // Mostrar mensaje de error
                        let errorDiv = confirm.nextElementSibling;
                        if (!errorDiv || !errorDiv.classList.contains('invalid-feedback')) {
                            errorDiv = document.createElement('div');
                            errorDiv.className = 'invalid-feedback';
                            errorDiv.textContent = 'Las contraseñas no coinciden';
                            confirm.parentNode.appendChild(errorDiv);
                        }
                    } else {
                        confirm.classList.remove('is-invalid');
                        confirm.setCustomValidity('');
                        
                        // Remover mensaje de error
                        const errorDiv = confirm.nextElementSibling;
                        if (errorDiv && errorDiv.classList.contains('invalid-feedback')) {
                            errorDiv.remove();
                        }
                    }
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                const roleSelect = document.getElementById('role');
                if (roleSelect.value === 'coordinacion') {
                    toggleCoordinacionField();
                }
                
                roleSelect.addEventListener('change', toggleCoordinacionField);
                
                // Auto-cerrar alertas
                setTimeout(() => {
                    document.querySelectorAll('.alert').forEach(alert => {
                        const bsAlert = new bootstrap.Alert(alert);
                        bsAlert.close();
                    });
                }, 5000);

                // Validación de contraseñas
                const password = document.getElementById('password');
                const confirm = document.getElementById('password_confirmation');
                
                if (password && confirm) {
                    password.addEventListener('input', validatePasswordMatch);
                    confirm.addEventListener('input', validatePasswordMatch);
                }
            });

        })();
    </script>
</body>
</html>