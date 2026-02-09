<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Contrato - Sistema GEPROC</title>
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
    }

    h1, h2, h3, h4, h5, h6 {
        font-weight: 600;
    }
    
    h2 { 
        color: var(--primary);
        margin-bottom: 1.5rem; 
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

    /* Estilos del formulario */
    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        font-weight: 600;
        color: var(--primary);
        margin-bottom: 0.5rem;
        display: block;
    }

    .form-label.required::after {
        content: " *";
        color: #dc3545;
    }

    .form-control, .form-select {
        border: 1px solid var(--border-color);
        border-radius: 5px;
        padding: 0.75rem 1rem;
        font-size: 0.95rem;
        transition: var(--transition);
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 0.2rem rgba(7, 68, 182, 0.15);
        outline: none;
    }

    .input-with-icon {
        position: relative;
    }

    .input-with-icon i {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-muted);
        z-index: 2;
    }

    .input-with-icon .form-control,
    .input-with-icon .form-select {
        padding-left: 2.5rem;
    }

    .error-message {
        color: #dc3545;
        font-size: 0.875rem;
        margin-top: 0.25rem;
        display: flex;
        align-items: center;
        gap: 5px;
    }

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
        width: 100%;
        justify-content: center;
    }

    .btn-primary-custom:hover {
        background: #063a9b;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(7, 68, 182, 0.2);
    }

    .back-button {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--primary);
        text-decoration: none;
        font-weight: 500;
        margin-bottom: 1.5rem;
        transition: var(--transition);
    }

    .back-button:hover {
        color: #063a9b;
        gap: 10px;
    }

    .fields-section {
        background: white;
        border: 1px solid var(--border-color);
        border-radius: 6px;
        padding: 1.5rem;
        margin: 2rem 0;
    }

    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid var(--border-color);
    }

    .field-info {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 0.5rem;
        font-size: 0.85rem;
    }

    .field-counter {
        color: var(--text-muted);
        font-weight: 500;
    }

    .field-placeholder {
        color: var(--text-muted);
        font-family: 'Courier New', monospace;
        background: rgba(7, 68, 182, 0.05);
        padding: 0.2rem 0.5rem;
        border-radius: 3px;
        font-size: 0.8rem;
    }

    .page-header {
        margin-bottom: 2rem;
    }

    .page-subtitle {
        color: var(--text-muted);
        font-size: 0.95rem;
        margin-bottom: 0;
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
    }

    @media (max-width: 576px) {
        h2 {
            font-size: 1.3rem;
        }
        
        .logo-img {
            height: 40px;
        }
        
        .section-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }
        
        .field-info {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.5rem;
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
                    <li class="nav-item"><a class="nav-link active {{ request()->routeIs('contratos.*') ? 'active' : '' }}" href="{{ route('contracts.index') }}">Contratos</a></li>
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
                    <!-- Botón de volver -->
                    <a href="{{ route('contracts.index') }}" class="back-button">
                        <i class="fas fa-arrow-left"></i>
                        Volver a la lista de contratos
                    </a>

                    <!-- Encabezado -->
                    <div class="page-header">
                        <h2><i class="fas fa-file-contract me-2"></i>Crear Contrato</h2>
                        <p class="page-subtitle">Complete los siguientes campos para generar un nuevo contrato</p>
                    </div>

                    <!-- Formulario -->
                    <form method="POST" action="{{ route('contracts.store') }}" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Selector de plantilla -->
                        <div class="form-group">
                            <label for="template_id" class="form-label required">Plantilla</label>
                            <div class="input-with-icon">
                                <i class="fas fa-layer-group"></i>
                                <select name="template_id" id="template_id" class="form-select" required>
                                    <option value="">Seleccione una plantilla...</option>
                                    @foreach($templates as $template)
                                        <option value="{{ $template->id }}" {{ $selectedTemplate && $selectedTemplate->id == $template->id ? 'selected' : '' }}>
                                            {{ $template->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('template_id')
                                <div class="error-message">
                                    <i class="fas fa-exclamation-circle"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Selector de Coordinación - CORREGIDO -->
                        <div class="form-group">
                            <label for="coordinacion_id" class="form-label required">Coordinación</label>
                            <div class="input-with-icon">
                                <i class="fas fa-building"></i>
                                <select name="coordinacion_id" id="coordinacion_id" class="form-select" required>
                                    <option value="">Seleccione una coordinación...</option>
                                    @if(isset($coordinaciones) && $coordinaciones->count() > 0)
                                        @foreach($coordinaciones as $coordinacion)
                                            <option value="{{ $coordinacion->id }}" {{ old('coordinacion_id') == $coordinacion->id ? 'selected' : '' }}>
                                                {{ $coordinacion->display_name ?: $coordinacion->nombre }}
                                            </option>
                                        @endforeach
                                    @else
                                        <option value="" disabled>No hay coordinaciones disponibles</option>
                                    @endif
                                </select>
                            </div>
                            @error('coordinacion_id')
                                <div class="error-message">
                                    <i class="fas fa-exclamation-circle"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Nombre del contrato -->
                        <div class="form-group">
                            <label for="nombre" class="form-label required">Nombre del Contrato</label>
                            <div class="input-with-icon">
                                <i class="fas fa-signature"></i>
                                <input type="text" name="nombre" id="nombre" class="form-control" 
                                       placeholder="Ingrese el nombre del contrato" required value="{{ old('nombre') }}">
                            </div>
                            @error('nombre')
                                <div class="error-message">
                                    <i class="fas fa-exclamation-circle"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Sección de campos dinámicos -->
                        <div class="fields-section">
                            <div class="section-header">
                                <h4 class="mb-0"><i class="fas fa-list-alt me-2"></i>Campos del Contrato</h4>
                                <span class="badge bg-primary">{{ is_array($fields) ? count($fields) : 0 }} campos</span>
                            </div>

                            @php
                                $oldValues = old('values', []);
                            @endphp

                            @if(is_array($fields) && count($fields) > 0)
                                @foreach($fields as $key => $field)
                                    @php
                                        // Determinar fullPlaceholder y meta
                                        if (is_array($field)) {
                                            if (is_string($key) && preg_match('/^\$\{.*\}$/', $key)) {
                                                $fullPlaceholder = $key;
                                            } elseif (isset($field['name']) && is_string($field['name'])) {
                                                $fullPlaceholder = '${' . $field['name'] . '}';
                                            } else {
                                                $fullPlaceholder = is_string($key) ? $key : ('${campo_' . $loop->index . '}');
                                            }
                                            $meta = $field;
                                        } else {
                                            $fullPlaceholder = $field;
                                            $meta = [];
                                        }

                                        // Limpiar para label
                                        $clean = preg_replace('/^\$\{|\}$/', '', $fullPlaceholder);
                                        $label = ucwords(str_replace(['_', '-'], ' ', $clean));
                                        
                                        // Obtener valor viejo
                                        $fieldValue = '';
                                        if (is_array($oldValues) && array_key_exists($fullPlaceholder, $oldValues)) {
                                            $fieldValue = $oldValues[$fullPlaceholder];
                                        }
                                        
                                        // Determinar tipo
                                        $tipo = $meta['tipo'] ?? 'texto';
                                    @endphp

                                    <div class="form-group">
                                        <label for="field_{{ $loop->index }}" class="form-label required">{{ $label }}</label>
                                        <div class="input-with-icon">
                                            <i class="fas fa-pen"></i>
                                            
                                            @if(in_array($tipo, ['image', 'signature']))
                                                <!-- Para imágenes/firmas -->
                                                <input type="file"
                                                       name="files[{{ preg_replace('/^\$\{|\}$/','',$fullPlaceholder) }}]"
                                                       id="field_{{ $loop->index }}"
                                                       class="form-control"
                                                       accept="image/*">
                                                <!-- Campo de texto adicional para el nombre -->
                                                <input type="text"
                                                       name="values[{{ $fullPlaceholder }}]"
                                                       class="form-control mt-2"
                                                       placeholder="Ingrese {{ strtolower($label) }}"
                                                       value="{{ $fieldValue }}">
                                            @else
                                                <!-- Para campos de texto normales -->
                                                <input type="text"
                                                       name="values[{{ $fullPlaceholder }}]"
                                                       id="field_{{ $loop->index }}"
                                                       class="form-control"
                                                       placeholder="Ingrese {{ strtolower($label) }}"
                                                       value="{{ $fieldValue }}"
                                                       required>
                                            @endif
                                        </div>
                                        <div class="field-info">
                                            <span class="field-counter">{{ $loop->index + 1 }}/{{ count($fields) }}</span>
                                            <span class="field-placeholder" title="Placeholder original">
                                                <i class="fas fa-code me-1"></i>{{ $fullPlaceholder }}
                                            </span>
                                        </div>
                                        @error("values.$fullPlaceholder")
                                            <div class="error-message">
                                                <i class="fas fa-exclamation-circle"></i>{{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                @endforeach
                            @else
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle me-2"></i>
                                    No se encontraron campos para esta plantilla. Por favor, seleccione otra plantilla.
                                </div>
                            @endif
                        </div>

                        <!-- Botón de envío -->
                        <button type="submit" class="btn-primary-custom">
                            <i class="fas fa-plus-circle me-2"></i>
                            Crear Contrato
                        </button>
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

            // Validación del formulario
            const form = document.querySelector('form');
            if (form) {
                form.addEventListener('submit', function(e) {
                    const requiredFields = form.querySelectorAll('[required]');
                    let isValid = true;
                    
                    requiredFields.forEach(field => {
                        if (!field.value.trim()) {
                            field.classList.add('is-invalid');
                            isValid = false;
                        } else {
                            field.classList.remove('is-invalid');
                        }
                    });
                    
                    if (!isValid) {
                        e.preventDefault();
                        const errorAlert = document.createElement('div');
                        errorAlert.className = 'alert alert-danger mt-3';
                        errorAlert.innerHTML = '<i class="fas fa-exclamation-triangle me-2"></i>Por favor, complete todos los campos requeridos.';
                        form.prepend(errorAlert);
                        
                        setTimeout(() => {
                            errorAlert.remove();
                        }, 5000);
                    }
                });
            }

            // Asignar automáticamente la coordinación si el usuario es coordinación
            @if(auth()->check() && auth()->user()->role === 'coordinacion')
                const coordinacionSelect = document.getElementById('coordinacion_id');
                if (coordinacionSelect) {
                    const userCoordinacionId = {{ auth()->user()->coordinacion_id ?? 'null' }};
                    if (userCoordinacionId) {
                        coordinacionSelect.value = userCoordinacionId;
                        coordinacionSelect.disabled = true;
                        
                        // Agregar información
                        const infoDiv = document.createElement('div');
                        infoDiv.className = 'alert alert-info mt-2';
                        infoDiv.innerHTML = '<i class="fas fa-info-circle me-2"></i>Su coordinación ha sido asignada automáticamente según su perfil.';
                        coordinacionSelect.parentNode.appendChild(infoDiv);
                    }
                }
            @endif

            // Cambio de plantilla - podría recargar campos
            const templateSelect = document.getElementById('template_id');
            if (templateSelect) {
                templateSelect.addEventListener('change', function() {
                    if (this.value) {
                        // Redirigir a la misma página con el template seleccionado
                        window.location.href = '{{ route("contracts.create") }}?template=' + this.value;
                    }
                });
            }

        })();
    </script>
</body>
</html>