<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analizar Contratos - Sistema GEPROC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
        --success-color: #28a745;
        --danger-color: #dc3545;
        --warning-color: #ffc107;
    }

    body { 
        background: white; 
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
        color: #333; 
        line-height: 1.6;
        padding: 0;
        margin: 0;
    }

    /* ========== BARRA DE NAVEGACIÓN - IGUAL AL PRIMER CÓDIGO ========== */

    /* Primera barra - Logo y título */
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

    /* Segunda barra - Menú */
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

    /* Estilo para el botón de Cerrar Sesión en el menú */
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
    
    h1, h2, h3, h4, h5, h6 {
        font-weight: 600;
    }
    
    h2 { 
        color: var(--primary);
        margin-bottom: 1rem; 
        font-size: 1.5rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    /* Contenedor de contenido */
    .content-container {
        background: white;
        border-radius: 6px;
        padding: 2rem;
        margin-bottom: 2rem;
        border: 1px solid var(--border-color);
        box-shadow: var(--card-shadow);
        max-width: 800px;
        margin: 2rem auto;
    }
    
    /* Botones */
    .btn-primary-geproc {
        background: var(--primary);
        border: none;
        color: white;
        font-weight: 500;
        padding: 0.6rem 1.5rem;
        border-radius: 5px;
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    
    .btn-primary-geproc:hover {
        background: #063a9b;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(7, 68, 182, 0.2);
    }

    .btn-secondary-geproc {
        background: #6c757d;
        border: none;
        color: white;
        font-weight: 500;
        padding: 0.6rem 1.5rem;
        border-radius: 5px;
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    
    .btn-secondary-geproc:hover {
        background: #5a6268;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(108, 117, 125, 0.2);
    }
    
    /* ========== ESTILOS ESPECÍFICOS PARA ANÁLISIS ========== */

    /* Encabezado */
    .analyze-header {
        margin-bottom: 2rem;
    }

    .analyze-subtitle {
        color: var(--text-muted);
        font-size: 1rem;
        margin-top: 0.5rem;
    }

    /* Formulario */
    .analyze-form {
        margin-top: 1.5rem;
    }

    .form-group {
        margin-bottom: 2rem;
    }

    .form-group label {
        font-weight: 600;
        color: var(--primary);
        margin-bottom: 0.8rem;
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 1rem;
    }

    .form-group label.required::after {
        content: "*";
        color: var(--danger-color);
        margin-left: 4px;
    }

    /* File Input */
    .file-input-container {
        width: 100%;
    }

    .file-input-wrapper {
        position: relative;
        width: 100%;
    }

    .file-input {
        position: absolute;
        width: 0.1px;
        height: 0.1px;
        opacity: 0;
        overflow: hidden;
        z-index: -1;
    }

    .file-input-label {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        width: 100%;
        min-height: 180px;
        background: var(--light-bg);
        border: 2px dashed var(--border-color);
        border-radius: 6px;
        cursor: pointer;
        transition: var(--transition);
        padding: 2rem;
    }

    .file-input-label:hover {
        border-color: var(--primary);
        background: rgba(7, 68, 182, 0.02);
    }

    .file-input-label.dragover {
        border-color: var(--primary);
        background: rgba(7, 68, 182, 0.05);
        transform: scale(1.02);
    }

    .file-input-text {
        text-align: center;
        margin-bottom: 0.5rem;
    }

    .file-input-text i {
        font-size: 3rem;
        color: var(--primary);
        display: block;
        margin-bottom: 1rem;
    }

    .file-input-text span {
        font-size: 1rem;
        color: var(--primary);
        font-weight: 500;
    }

    .file-input-info {
        text-align: center;
    }

    .file-input-info small {
        color: var(--text-muted);
        font-size: 0.85rem;
    }

    .file-name {
        margin-top: 0.5rem;
        padding: 0.5rem;
        background: var(--light-bg);
        border-radius: 4px;
        font-size: 0.9rem;
        color: var(--success-color);
        display: none;
    }

    .file-name.show {
        display: block;
    }

    /* Form text */
    .form-text {
        color: var(--text-muted);
        font-size: 0.85rem;
        margin-top: 0.5rem;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    /* Sección de ayuda */
    .help-section {
        background: rgba(7, 68, 182, 0.02);
        border: 1px solid var(--border-color);
        border-radius: 6px;
        padding: 1.5rem;
        margin-bottom: 2rem;
    }

    .help-title {
        color: var(--primary);
        font-weight: 600;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .help-list {
        margin-bottom: 0;
        padding-left: 1.5rem;
    }

    .help-list li {
        margin-bottom: 0.5rem;
        color: var(--text-muted);
    }

    .help-list li:last-child {
        margin-bottom: 0;
    }

    /* Botones */
    .button-group {
        display: flex;
        gap: 1rem;
        margin-top: 2rem;
        padding-top: 1.5rem;
        border-top: 1px solid var(--border-color);
    }

    .button-group .btn {
        flex: 1;
        padding: 0.75rem;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .btn-primary {
        background: var(--primary);
        border: none;
        transition: var(--transition);
    }

    .btn-primary:hover {
        background: #063a9b;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(7, 68, 182, 0.2);
    }

    .btn-secondary {
        background: #6c757d;
        border: none;
        transition: var(--transition);
    }

    .btn-secondary:hover {
        background: #5a6268;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(108, 117, 125, 0.2);
    }

    /* Alertas */
    .alert {
        border-radius: 6px;
        padding: 1rem;
        margin-top: 1rem;
        display: flex;
        align-items: center;
    }

    .alert-success {
        background-color: rgba(40, 167, 69, 0.1);
        border: 1px solid rgba(40, 167, 69, 0.2);
        color: #28a745;
    }

    .alert-danger {
        background-color: rgba(220, 53, 69, 0.1);
        border: 1px solid rgba(220, 53, 69, 0.2);
        color: #dc3545;
    }

    /* Estado de carga */
    .btn-primary.loading {
        opacity: 0.8;
        cursor: not-allowed;
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
            margin: 1rem;
        }
        
        .button-group {
            flex-direction: column;
        }
        
        .button-group .btn {
            width: 100%;
        }
        
        .file-input-label {
            min-height: 150px;
            padding: 1.5rem;
        }
        
        .file-input-text i {
            font-size: 2.5rem;
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
        
        .file-input-text span {
            font-size: 0.9rem;
        }
        
        .file-input-info small {
            font-size: 0.8rem;
        }
        
        .help-section {
            padding: 1.2rem;
        }
    }
    </style>
</head>
<body>
    <!-- Primera barra - Logo y título (igual al primer código) -->
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

    <!-- Segunda barra - Menú con información de usuario y cerrar sesión -->
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
            <!-- Encabezado compacto en una sola línea -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="d-flex align-items-center gap-2">
                    <h2 class="mb-0"><i class="fas fa-search me-2"></i>Analizar Contratos</h2>
                    <span class="badge bg-light text-primary px-3 py-2">Nuevo Análisis</span>
                </div>
                <a href="{{ route('contracts.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Volver
                </a>
            </div>

            <!-- Formulario en grid de 2 columnas -->
            <div class="row g-4">
                <!-- Columna izquierda - Carga de archivo (más ancha) -->
                <div class="col-md-8">
                    <div class="content-container p-4">
                        <form method="POST" action="{{ route('contracts.analyze.process') }}" enctype="multipart/form-data" id="analyzeForm">
                            @csrf
                            
                            <!-- Contrato Vacío -->
                            <div class="form-group mb-0">
                                <label for="contrato_vacio" class="required fw-bold mb-3 d-flex align-items-center">
                                    <i class="fas fa-file me-2"></i>Contrato Vacío (Plantilla)
                                </label>
                                <div class="file-input-container">
                                    <div class="file-input-wrapper">
                                        <input type="file" class="file-input" name="contrato_vacio" id="contrato_vacio" required accept=".pdf,.doc,.docx,.txt">
                                        <label for="contrato_vacio" class="file-input-label" id="contrato_vacio_label">
                                            <div class="file-input-text">
                                                <i class="fas fa-cloud-upload-alt"></i>
                                                <span>Seleccione o arrastre el archivo</span>
                                            </div>
                                            <div class="file-input-info">
                                                <small>PDF, DOC, DOCX, TXT (Máx. 10MB)</small>
                                            </div>
                                        </label>
                                    </div>
                                    <div class="file-name" id="contrato_vacio_name"></div>
                                </div>
                                <div class="form-text mt-2">
                                    <i class="fas fa-info-circle"></i>
                                    El archivo debe contener placeholders con formato [[...]]
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Columna derecha - Panel de información (más angosta) -->
                <div class="col-md-4">
                    <!-- Sección de ayuda -->
                    <div class="help-section mb-4">
                        <div class="help-title">
                            <i class="fas fa-info-circle"></i>
                            Formatos soportados
                        </div>
                        <div class="d-flex flex-wrap gap-2 mb-3">
                            <span class="badge bg-light text-dark p-2"><i class="far fa-file-pdf text-danger me-1"></i> PDF</span>
                            <span class="badge bg-light text-dark p-2"><i class="far fa-file-word text-primary me-1"></i> DOC</span>
                            <span class="badge bg-light text-dark p-2"><i class="far fa-file-word text-primary me-1"></i> DOCX</span>
                            <span class="badge bg-light text-dark p-2"><i class="far fa-file-alt text-secondary me-1"></i> TXT</span>
                        </div>
                        
                        <div class="help-title mt-4">
                            <i class="fas fa-check-circle text-success"></i>
                            Requisitos
                        </div>
                        <ul class="help-list">
                            <li>Archivo legible y sin corrupción</li>
                            <li>Placeholders con formato [[campo]]</li>
                            <li>Tamaño máximo 10MB</li>
                        </ul>
                    </div>

                    <!-- Botón de acción y alertas -->
                    <div class="content-container p-4">
                        <button type="submit" class="btn btn-primary w-100 py-3 mb-3" form="analyzeForm" id="analyzeButton">
                            <i class="fas fa-search me-2"></i>
                            Iniciar Análisis
                        </button>

                        @if ($errors->any())
                            <div class="alert alert-danger mt-3">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                {{ $errors->first() }}
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success mt-3">
                                <i class="fas fa-check-circle me-2"></i>
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>
                </div>
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

            // Manejo de file inputs
            const fileInputs = document.querySelectorAll('.file-input');
            
            fileInputs.forEach(input => {
                const label = document.getElementById(input.id + '_label');
                const fileName = document.getElementById(input.id + '_name');
                
                input.addEventListener('change', function(e) {
                    if (this.files && this.files[0]) {
                        const file = this.files[0];
                        fileName.textContent = `✓ ${file.name} (${formatFileSize(file.size)})`;
                        fileName.classList.add('show');
                        
                        // Actualizar label
                        label.style.borderColor = '#28a745';
                        label.style.background = '#f0fff4';
                    }
                });
                
                // Efectos de drag and drop
                label.addEventListener('dragover', function(e) {
                    e.preventDefault();
                    this.classList.add('dragover');
                });
                
                label.addEventListener('dragleave', function(e) {
                    e.preventDefault();
                    this.classList.remove('dragover');
                });
                
                label.addEventListener('drop', function(e) {
                    e.preventDefault();
                    this.classList.remove('dragover');
                    input.files = e.dataTransfer.files;
                    input.dispatchEvent(new Event('change'));
                });
            });
            
            // Formatear tamaño de archivo
            function formatFileSize(bytes) {
                if (bytes === 0) return '0 Bytes';
                const k = 1024;
                const sizes = ['Bytes', 'KB', 'MB', 'GB'];
                const i = Math.floor(Math.log(bytes) / Math.log(k));
                return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
            }
            
            // Validación del formulario
            const form = document.getElementById('analyzeForm');
            const analyzeButton = document.getElementById('analyzeButton');
            
            form.addEventListener('submit', function(e) {
                const requiredFiles = form.querySelectorAll('input[type="file"][required]');
                let isValid = true;
                
                requiredFiles.forEach(input => {
                    if (!input.files || !input.files[0]) {
                        isValid = false;
                        const label = document.getElementById(input.id + '_label');
                        label.style.borderColor = '#dc3545';
                        label.style.background = '#fff5f5';
                    }
                });
                
                if (!isValid) {
                    e.preventDefault();
                    showAlert('Por favor, seleccione el archivo antes de continuar.', 'danger');
                } else {
                    // Mostrar estado de carga
                    analyzeButton.classList.add('loading');
                    analyzeButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Analizando...';
                    analyzeButton.disabled = true;
                }
            });
            
            // Función para mostrar alertas
            function showAlert(message, type) {
                const alertDiv = document.createElement('div');
                alertDiv.className = `alert alert-${type} alert-dismissible fade show mt-3`;
                alertDiv.innerHTML = `
                    <i class="fas fa-${type === 'danger' ? 'exclamation-triangle' : 'info-circle'} me-2"></i>
                    ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                `;
                form.prepend(alertDiv);
                
                setTimeout(() => {
                    if (alertDiv.parentNode) {
                        alertDiv.remove();
                    }
                }, 5000);
            }

        })();
    </script>
</body>
</html>