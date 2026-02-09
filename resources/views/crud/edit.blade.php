<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario - Sistema GEPROC</title>
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
        background: white; 
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
        color: #333; 
        line-height: 1.6;
        padding: 0;
        margin: 0;
    }

    /* Barra superior */
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

    /* Barra de menú */
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

    .navbar-menu .logout-btn:active {
        background: rgba(255, 255, 255, 0.2);
    }

    /* Contenido principal */
    .main-content { 
        padding: 30px 20px;
        min-height: calc(100vh - 140px);
    }

    .content-container {
        background: white;
        border-radius: 6px;
        padding: 2rem;
        margin-bottom: 2rem;
        border: 1px solid var(--border-color);
        box-shadow: var(--card-shadow);
        max-width: 700px;
        margin: 2rem auto;
    }

    h1, h2, h3, h4, h5, h6 {
        font-weight: 600;
    }
    
    h2 { 
        color: var(--primary);
        margin-bottom: 1rem; 
        padding-bottom: 0.8rem;
        position: relative;
        font-size: 1.5rem;
    }
    
    h2::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 50px;
        height: 2px;
        background: var(--primary);
    }

    /* Header mejorado */
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        flex-wrap: wrap;
        gap: 1.5rem;
    }

    .page-title-section {
        flex: 1;
    }

    .page-subtitle {
        color: var(--text-muted);
        font-size: 0.95rem;
        margin-bottom: 0;
    }

    .page-actions {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }

    /* Formulario */
    .form-container {
        margin-top: 1.5rem;
    }

    .form-label {
        font-weight: 500;
        color: var(--primary);
        margin-bottom: 0.5rem;
        font-size: 0.95rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .form-control, .form-select {
        border: 1px solid var(--border-color);
        border-radius: 4px;
        padding: 0.75rem;
        font-size: 1rem;
        transition: var(--transition);
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 0.25rem rgba(7, 68, 182, 0.15);
    }

    .form-control.is-invalid, .form-select.is-invalid {
        border-color: #dc3545;
    }

    .form-control.is-invalid:focus {
        box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25);
    }

    .invalid-feedback {
        font-size: 0.85rem;
        margin-top: 0.25rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .form-text {
        color: var(--text-muted);
        font-size: 0.85rem;
        margin-top: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    /* Información del usuario actual */
    .user-current-info {
        background: rgba(7, 68, 182, 0.03);
        border: 1px solid var(--border-color);
        border-radius: 6px;
        padding: 1.5rem;
        margin-bottom: 2rem;
    }

    .user-info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        margin-top: 1rem;
    }

    .info-item {
        display: flex;
        flex-direction: column;
    }

    .info-label {
        font-size: 0.85rem;
        color: var(--text-muted);
        margin-bottom: 0.25rem;
    }

    .info-value {
        font-weight: 500;
        color: var(--primary);
    }

    /* Botones */
    .btn-primary-custom {
        background: var(--primary);
        border: none;
        color: white;
        font-weight: 500;
        padding: 0.75rem 1.5rem;
        border-radius: 5px;
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 1rem;
    }

    .btn-primary-custom:hover {
        background: #063a9b;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(7, 68, 182, 0.2);
    }

    .btn-secondary-custom {
        background: #6c757d;
        border: none;
        color: white;
        font-weight: 500;
        padding: 0.75rem 1.5rem;
        border-radius: 5px;
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 1rem;
    }

    .btn-secondary-custom:hover {
        background: #5a6268;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(108, 117, 125, 0.2);
    }

    .btn-outline-custom {
        background: white;
        border: 1px solid var(--border-color);
        color: var(--primary);
        font-weight: 500;
        padding: 0.75rem 1.5rem;
        border-radius: 5px;
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 1rem;
    }

    .btn-outline-custom:hover {
        background: rgba(7, 68, 182, 0.05);
        border-color: var(--primary);
        transform: translateY(-2px);
    }

    .btn-group-custom {
        display: flex;
        gap: 1rem;
        margin-top: 2rem;
        padding-top: 1.5rem;
        border-top: 1px solid var(--border-color);
        justify-content: flex-end;
    }

    /* Alertas */
    .alert {
        border-radius: 6px;
        border: 1px solid transparent;
        padding: 1rem;
        margin-bottom: 1.5rem;
    }

    .alert-danger {
        background-color: rgba(220, 53, 69, 0.1);
        border-color: rgba(220, 53, 69, 0.2);
        color: #dc3545;
    }

    .alert-danger ul {
        margin: 0.5rem 0 0 1rem;
        padding-left: 1rem;
    }

    .alert-danger li {
        margin-bottom: 0.25rem;
    }

    .alert-danger .btn-close {
        filter: invert(1) brightness(0.5) sepia(1) hue-rotate(-70deg) saturate(5);
    }

    /* Campos dinámicos */
    .field-container {
        margin-bottom: 1.5rem;
        transition: var(--transition);
        opacity: 1;
        height: auto;
        overflow: hidden;
    }

    .field-container.hidden {
        opacity: 0;
        height: 0;
        margin: 0;
        padding: 0;
        visibility: hidden;
    }

    .field-container.visible {
        opacity: 1;
        height: auto;
        margin-bottom: 1.5rem;
        visibility: visible;
    }

    /* Grupo de formulario */
    .form-group {
        background: rgba(7, 68, 182, 0.02);
        border: 1px solid var(--border-color);
        border-radius: 6px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .form-group-title {
        color: var(--primary);
        font-weight: 600;
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 1px solid var(--border-color);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    /* Coordinación especial */
    .coordinacion-required {
        border-left: 4px solid var(--primary);
        padding-left: 1rem;
        background: rgba(7, 68, 182, 0.03);
    }

    /* Contraseña opcional */
    .password-optional {
        background: rgba(40, 167, 69, 0.03);
        border-left: 4px solid #28a745;
        padding-left: 1rem;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .navbar-brand {
            font-size: 1.2rem;
        }
        
        .navbar-menu .nav-link {
            padding: 0.5rem 1rem !important;
            margin: 0.1rem 0;
        }
        
        .main-content {
            padding: 20px 15px;
        }
        
        .content-container {
            padding: 1.5rem;
            margin: 1rem auto;
        }
        
        .navbar-menu {
            top: 60px;
        }
        
        .logo-img {
            height: 45px;
        }
        
        .navbar-menu .user-info-container {
            flex-direction: column;
            gap: 10px;
            align-items: flex-end;
            margin-top: 10px;
            padding-top: 10px;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .page-header {
            flex-direction: column;
            align-items: stretch;
            gap: 1rem;
        }
        
        .page-actions {
            width: 100%;
            justify-content: stretch;
        }
        
        .page-actions .btn {
            flex: 1;
            justify-content: center;
        }
        
        .btn-group-custom {
            flex-direction: column;
        }
        
        .btn-group-custom .btn {
            width: 100%;
            justify-content: center;
        }
        
        .form-group {
            padding: 1rem;
        }
        
        .user-info-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 576px) {
        h2 {
            font-size: 1.3rem;
        }
        
        .logo-img {
            height: 40px;
        }
        
        .content-container {
            padding: 1.2rem;
            border-radius: 4px;
        }
        
        .btn-primary-custom, 
        .btn-secondary-custom, 
        .btn-outline-custom {
            padding: 0.6rem 1rem;
            font-size: 0.9rem;
        }
        
        .user-current-info {
            padding: 1rem;
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
                    <li class="nav-item"><a class="nav-link active {{ request()->routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}">Accesos</a></li>
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
                    <!-- Header mejorado del contenido -->
                    <div class="page-header">
                        <div class="page-title-section">
                            <h2><i class="fas fa-user-edit me-2"></i>Editar Usuario</h2>
                            <p class="page-subtitle">Modifique la información del usuario {{ $user->name }}</p>
                        </div>
                        <div class="page-actions">
                            <a href="{{ route('users.index') }}" class="btn-outline-custom">
                                <i class="fas fa-users me-2"></i>Ver Usuarios
                            </a>
                            <a href="{{ route('dashboard') }}" class="btn-secondary-custom">
                                <i class="fas fa-home me-2"></i>Inicio
                            </a>
                        </div>
                    </div>

                    <!-- Información actual del usuario -->
                    <div class="user-current-info">
                        <h5 class="mb-3"><i class="fas fa-info-circle me-2 text-primary"></i>Información Actual</h5>
                        <div class="user-info-grid">
                            <div class="info-item">
                                <span class="info-label">ID del Usuario</span>
                                <span class="info-value">#{{ $user->id }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Correo Actual</span>
                                <span class="info-value">{{ $user->email }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Rol Actual</span>
                                <span class="info-value">
                                    @if($user->role === 'admin')
                                        <span class="badge role-badge-admin"><i class="fas fa-crown me-1"></i>Administrador</span>
                                    @elseif($user->role === 'profesor')
                                        <span class="badge role-badge-profesor"><i class="fas fa-chalkboard-teacher me-1"></i>Profesor</span>
                                    @elseif($user->role === 'coordinacion')
                                        <span class="badge role-badge-coordinacion"><i class="fas fa-building me-1"></i>Coordinación</span>
                                    @endif
                                </span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Coordinación Asignada</span>
                                <span class="info-value">
                                    @if($user->coordinacion)
                                        <span class="badge bg-secondary">
                                            <i class="fas fa-university me-1"></i>
                                            {{ $user->coordinacion->nombre }}
                                        </span>
                                    @else
                                        <span class="badge bg-light text-dark border">No asignada</span>
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Alertas de errores -->
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                <div class="flex-grow-1">
                                    <strong class="me-2">Por favor corrige los siguientes errores:</strong>
                                    <ul class="mb-0 mt-2">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                        </div>
                    @endif

                    <!-- Formulario de edición -->
                    <form method="POST" action="{{ route('users.update', $user) }}" class="form-container" id="userForm">
                        @csrf
                        @method('PUT')

                        <!-- Grupo 1: Información básica -->
                        <div class="form-group">
                            <h4 class="form-group-title">
                                <i class="fas fa-id-card"></i> Información Personal
                            </h4>
                            
                            <!-- Nombre completo -->
                            <div class="field-container">
                                <label for="name" class="form-label">
                                    <i class="fas fa-user"></i>Nombre Completo
                                </label>
                                <input type="text" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       id="name" 
                                       name="name" 
                                       value="{{ old('name', $user->name) }}" 
                                       placeholder="Ej: Juan Pérez González"
                                       required>
                                @error('name')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Correo electrónico -->
                            <div class="field-container">
                                <label for="email" class="form-label">
                                    <i class="fas fa-envelope"></i>Correo Electrónico
                                </label>
                                <input type="email" 
                                       class="form-control @error('email') is-invalid @enderror" 
                                       id="email" 
                                       name="email" 
                                       value="{{ old('email', $user->email) }}" 
                                       placeholder="ejemplo@iufim.edu.mx"
                                       required>
                                @error('email')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle"></i>{{ $message }}
                                    </div>
                                @enderror
                                <div class="form-text">
                                    <i class="fas fa-info-circle"></i>
                                    Este será el usuario para acceder al sistema
                                </div>
                            </div>
                        </div>

                        <!-- Grupo 2: Rol y permisos -->
                        <div class="form-group">
                            <h4 class="form-group-title">
                                <i class="fas fa-user-tag"></i> Permisos y Acceso
                            </h4>
                            
                            <!-- Rol -->
                            <div class="field-container">
                                <label for="role" class="form-label">
                                    <i class="fas fa-user-shield"></i>Tipo de Usuario
                                </label>
                                <select class="form-select @error('role') is-invalid @enderror" 
                                        id="role" 
                                        name="role" 
                                        required>
                                    <option value="">Seleccione un tipo de usuario</option>
                                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Administrador</option>
                                    <option value="profesor" {{ old('role', $user->role) == 'profesor' ? 'selected' : '' }}>Profesor</option>
                                    <option value="coordinacion" {{ old('role', $user->role) == 'coordinacion' ? 'selected' : '' }}>Coordinación</option>
                                </select>
                                @error('role')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle"></i>{{ $message }}
                                    </div>
                                @enderror
                                <div class="form-text">
                                    <i class="fas fa-info-circle"></i>
                                    El tipo determina los permisos y funcionalidades disponibles
                                </div>
                            </div>

                            <!-- Coordinación (condicional) - CORREGIDO el nombre del campo -->
                            <div class="field-container coordinacion-required {{ (old('role', $user->role) == 'coordinacion' || old('coordinaciones_id', $user->coordinaciones_id)) ? 'visible' : 'hidden' }}" id="coordinacionField">
                                <label for="coordinaciones_id" class="form-label">
                                    <i class="fas fa-university"></i>Asignar a Coordinación
                                    <span class="text-danger">*</span>
                                </label>
                                <select class="form-select @error('coordinaciones_id') is-invalid @enderror" 
                                        id="coordinaciones_id" 
                                        name="coordinaciones_id">
                                    <option value="">Seleccione una coordinación</option>
                                    @foreach($coordinaciones as $coordinacion)
                                        <option value="{{ $coordinacion->id }}" {{ old('coordinaciones_id', $user->coordinaciones_id) == $coordinacion->id ? 'selected' : '' }}>
                                            {{ $coordinacion->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('coordinaciones_id')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle"></i>{{ $message }}
                                    </div>
                                @enderror
                                <div class="form-text">
                                    <i class="fas fa-info-circle"></i>
                                    Solo usuarios del tipo "Coordinación" requieren estar asignados
                                </div>
                            </div>
                        </div>

                        <!-- Grupo 3: Seguridad (opcional) -->
                        <div class="form-group password-optional">
                            <h4 class="form-group-title">
                                <i class="fas fa-lock"></i> Cambio de Contraseña (Opcional)
                            </h4>
                            
                            <!-- Contraseña -->
                            <div class="field-container">
                                <label for="password" class="form-label">
                                    <i class="fas fa-key"></i>Nueva Contraseña
                                </label>
                                <input type="password" 
                                       class="form-control @error('password') is-invalid @enderror" 
                                       id="password" 
                                       name="password" 
                                       placeholder="Dejar en blanco para no cambiar">
                                @error('password')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle"></i>{{ $message }}
                                    </div>
                                @enderror
                                <div class="form-text">
                                    <i class="fas fa-info-circle"></i>
                                    La contraseña debe tener al menos 8 caracteres (opcional)
                                </div>
                            </div>

                            <!-- Confirmar contraseña -->
                            <div class="field-container">
                                <label for="password_confirmation" class="form-label">
                                    <i class="fas fa-key"></i>Confirmar Nueva Contraseña
                                </label>
                                <input type="password" 
                                       class="form-control @error('password_confirmation') is-invalid @enderror" 
                                       id="password_confirmation" 
                                       name="password_confirmation" 
                                       placeholder="Repita la nueva contraseña">
                                @error('password_confirmation')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <!-- Botones de acción -->
                        <div class="btn-group-custom">
                            <a href="{{ route('users.index') }}" class="btn-secondary-custom">
                                <i class="fas fa-times me-2"></i>Cancelar
                            </a>
                            <button type="submit" class="btn-primary-custom" id="submitBtn">
                                <i class="fas fa-save me-2"></i>Actualizar Usuario
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

            // Efecto de scroll en navbar
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
                    // Mostrar campo de coordinación con animación
                    coordinacionField.classList.remove('hidden');
                    setTimeout(() => {
                        coordinacionField.classList.add('visible');
                    }, 10);
                    coordinacionSelect.required = true;
                    
                    // Agregar indicador visual
                    coordinacionField.classList.add('coordinacion-required');
                } else {
                    // Ocultar campo de coordinación con animación
                    coordinacionField.classList.remove('visible');
                    coordinacionField.classList.remove('coordinacion-required');
                    setTimeout(() => {
                        coordinacionField.classList.add('hidden');
                    }, 300);
                    coordinacionSelect.required = false;
                    // No limpiar el valor para mantener la selección si se cambia el rol y se vuelve
                }
            }

            // Validación del formulario antes de enviar
            function validateForm() {
                const roleSelect = document.getElementById('role');
                const coordinacionSelect = document.getElementById('coordinaciones_id');
                const coordinacionField = document.getElementById('coordinacionField');
                
                // Si es coordinación, verificar que se haya seleccionado una coordinación
                if (roleSelect.value === 'coordinacion') {
                    if (!coordinacionSelect.value) {
                        // Mostrar error
                        coordinacionSelect.classList.add('is-invalid');
                        
                        // Crear mensaje de error si no existe
                        let errorDiv = coordinacionSelect.nextElementSibling;
                        if (!errorDiv || !errorDiv.classList.contains('invalid-feedback')) {
                            errorDiv = document.createElement('div');
                            errorDiv.className = 'invalid-feedback d-flex align-items-center';
                            errorDiv.innerHTML = '<i class="fas fa-exclamation-circle me-1"></i>Debe seleccionar una coordinación para este rol.';
                            coordinacionSelect.parentNode.insertBefore(errorDiv, coordinacionSelect.nextSibling);
                        }
                        
                        // Enfocar el campo y mostrar alerta
                        coordinacionSelect.focus();
                        
                        // Mostrar alerta flotante
                        showAlert('Debe seleccionar una coordinación para el rol de Coordinación.', 'danger');
                        return false;
                    } else {
                        // Remover error si existe
                        coordinacionSelect.classList.remove('is-invalid');
                        const errorDiv = coordinacionSelect.nextElementSibling;
                        if (errorDiv && errorDiv.classList.contains('invalid-feedback')) {
                            errorDiv.remove();
                        }
                    }
                }
                
                return true;
            }

            // Mostrar alerta temporal
            function showAlert(message, type = 'info') {
                // Remover alertas anteriores
                const existingAlert = document.querySelector('.floating-alert');
                if (existingAlert) {
                    existingAlert.remove();
                }
                
                const alertDiv = document.createElement('div');
                alertDiv.className = `alert alert-${type} floating-alert alert-dismissible fade show`;
                alertDiv.style.cssText = `
                    position: fixed;
                    top: 120px;
                    right: 20px;
                    z-index: 9999;
                    min-width: 300px;
                    max-width: 400px;
                    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
                `;
                
                alertDiv.innerHTML = `
                    <div class="d-flex align-items-center">
                        <i class="fas fa-${type === 'danger' ? 'exclamation-triangle' : 'info-circle'} me-2"></i>
                        <div class="flex-grow-1">${message}</div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                `;
                
                document.body.appendChild(alertDiv);
                
                // Auto cerrar después de 5 segundos
                setTimeout(() => {
                    if (alertDiv.parentNode) {
                        const bsAlert = new bootstrap.Alert(alertDiv);
                        bsAlert.close();
                    }
                }, 5000);
            }

            // Ejecutar al cargar la página
            document.addEventListener('DOMContentLoaded', function() {
                // Verificar el rol actual para mostrar/ocultar coordinación
                const roleSelect = document.getElementById('role');
                const userRole = roleSelect.value;
                
                if (userRole === 'coordinacion') {
                    toggleCoordinacionField();
                }
                
                // Agregar evento al cambio de rol
                roleSelect.addEventListener('change', toggleCoordinacionField);
                
                // Cerrar alertas automáticamente después de 5 segundos
                setTimeout(() => {
                    document.querySelectorAll('.alert').forEach(alert => {
                        const bsAlert = new bootstrap.Alert(alert);
                        bsAlert.close();
                    });
                }, 5000);

                // Enfocar el primer campo del formulario
                const firstField = document.querySelector('input[required]');
                if (firstField) {
                    setTimeout(() => {
                        firstField.focus();
                    }, 100);
                }
                
                // Validar formulario antes de enviar
                const form = document.getElementById('userForm');
                form.addEventListener('submit', function(e) {
                    if (!validateForm()) {
                        e.preventDefault();
                        e.stopPropagation();
                    }
                });
            });

            // Validación en tiempo real para campos requeridos
            document.querySelectorAll('input[required], select[required]').forEach(field => {
                field.addEventListener('blur', function() {
                    if (!this.value.trim()) {
                        this.classList.add('is-invalid');
                    } else {
                        this.classList.remove('is-invalid');
                    }
                });
            });

            // Validación de coincidencia de contraseñas (solo si se ingresan)
            const passwordField = document.getElementById('password');
            const confirmPasswordField = document.getElementById('password_confirmation');
            
            function validatePasswordMatch() {
                if (passwordField.value || confirmPasswordField.value) {
                    if (passwordField.value !== confirmPasswordField.value) {
                        confirmPasswordField.classList.add('is-invalid');
                        confirmPasswordField.setCustomValidity('Las contraseñas no coinciden');
                        
                        // Mostrar mensaje de error personalizado
                        let errorDiv = confirmPasswordField.nextElementSibling;
                        if (!errorDiv || !errorDiv.classList.contains('invalid-feedback')) {
                            errorDiv = document.createElement('div');
                            errorDiv.className = 'invalid-feedback d-flex align-items-center';
                            errorDiv.innerHTML = '<i class="fas fa-exclamation-circle me-1"></i>Las contraseñas no coinciden';
                            confirmPasswordField.parentNode.insertBefore(errorDiv, confirmPasswordField.nextSibling);
                        }
                    } else {
                        confirmPasswordField.classList.remove('is-invalid');
                        confirmPasswordField.setCustomValidity('');
                        
                        // Remover mensaje de error si existe
                        const errorDiv = confirmPasswordField.nextElementSibling;
                        if (errorDiv && errorDiv.classList.contains('invalid-feedback')) {
                            errorDiv.remove();
                        }
                    }
                }
            }
            
            if (passwordField && confirmPasswordField) {
                passwordField.addEventListener('input', validatePasswordMatch);
                confirmPasswordField.addEventListener('input', validatePasswordMatch);
            }

        })();
    </script>
</body>
</html>