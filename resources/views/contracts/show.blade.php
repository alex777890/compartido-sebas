<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Contrato - Sistema GEPROC</title>
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

    /* Estilos específicos para la vista de contrato */
    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1rem;
        margin: 1.5rem 0;
    }

    .info-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem;
        background: white;
        border: 1px solid var(--border-color);
        border-radius: 6px;
        transition: var(--transition);
    }

    .info-item:hover {
        box-shadow: var(--card-shadow);
    }

    .info-item i {
        font-size: 1.5rem;
        color: var(--primary);
        width: 40px;
        height: 40px;
        background: rgba(7, 68, 182, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .info-label {
        font-size: 0.85rem;
        color: var(--text-muted);
        font-weight: 500;
        margin-bottom: 0.25rem;
    }

    .info-value {
        font-weight: 600;
        color: var(--primary);
    }

    .badge {
        font-weight: 500;
        padding: 0.4rem 0.8rem;
        font-size: 0.8rem;
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
        text-decoration: none;
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
        text-decoration: none;
    }

    .btn-secondary-custom:hover {
        background: #5a6268;
        color: white;
        transform: translateY(-2px);
    }

    .download-section {
        background: white;
        border: 1px solid var(--border-color);
        border-radius: 6px;
        padding: 1.5rem;
        margin: 2rem 0;
    }

    .download-header {
        font-weight: 600;
        color: var(--primary);
        margin-bottom: 1rem;
        padding-bottom: 0.75rem;
        border-bottom: 2px solid rgba(7, 68, 182, 0.1);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .button-group {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        margin: 1.5rem 0;
    }

    .preview-section {
        background: white;
        border: 1px solid var(--border-color);
        border-radius: 6px;
        padding: 1.5rem;
        margin: 2rem 0;
    }

    .preview-header {
        font-weight: 600;
        color: var(--primary);
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid rgba(7, 68, 182, 0.1);
    }

    .preview-container {
        min-height: 600px;
        position: relative;
        border: 1px solid var(--border-color);
        border-radius: 4px;
        overflow: hidden;
    }

    .loading-state {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        z-index: 10;
        background: white;
        padding: 2rem;
        border-radius: 8px;
        box-shadow: var(--card-shadow);
    }

    .loading-spinner {
        width: 48px;
        height: 48px;
        border: 6px solid #eee;
        border-top-color: var(--primary);
        border-radius: 50%;
        margin: 0 auto 1rem;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    #previewFrame {
        width: 100%;
        height: 600px;
        border: none;
        display: block;
    }

    .coordinacion-info {
        background: rgba(7, 68, 182, 0.05);
        border-left: 4px solid var(--primary);
        padding: 1rem;
        border-radius: 4px;
        margin-top: 1.5rem;
    }

    .floating-actions {
        position: fixed;
        right: 20px;
        bottom: 20px;
        display: flex;
        flex-direction: column;
        gap: 10px;
        z-index: 1000;
    }

    .floating-btn {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--primary);
        color: white;
        border: none;
        box-shadow: 0 4px 12px rgba(7, 68, 182, 0.3);
        transition: var(--transition);
        text-decoration: none;
        font-size: 1.2rem;
    }

    .floating-btn:hover {
        background: #063a9b;
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 6px 16px rgba(7, 68, 182, 0.4);
    }

    .floating-btn.secondary {
        background: #6c757d;
    }

    .floating-btn.secondary:hover {
        background: #5a6268;
    }

    .floating-btn.warning {
        background: #ffc107;
        color: #212529;
    }

    .floating-btn.warning:hover {
        background: #e0a800;
        color: #212529;
    }

    .pdf-error {
        text-align: center;
        padding: 3rem 1rem;
        color: var(--text-muted);
    }

    .pdf-error i {
        font-size: 3rem;
        margin-bottom: 1rem;
        color: #dc3545;
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
        
        .info-grid {
            grid-template-columns: 1fr;
        }
        
        .button-group {
            flex-direction: column;
        }
        
        .button-group .btn {
            width: 100%;
        }
        
        .floating-actions {
            right: 15px;
            bottom: 15px;
        }
        
        .floating-btn {
            width: 50px;
            height: 50px;
            font-size: 1.1rem;
        }
        
        #previewFrame {
            height: 500px;
        }
        
        .preview-container {
            min-height: 500px;
        }
    }

    @media (max-width: 576px) {
        h2 {
            font-size: 1.3rem;
        }
        
        .logo-img {
            height: 40px;
        }
        
        #previewFrame {
            height: 400px;
        }
        
        .preview-container {
            min-height: 400px;
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
                    <!-- Encabezado -->
                    <div class="page-header">
                        <h2><i class="fas fa-file-contract me-2"></i>Vista del Contrato</h2>
                        <p class="page-subtitle">Revise y descargue el documento generado</p>
                    </div>

                    <!-- Alertas -->
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                <strong>Se encontraron los siguientes errores:</strong>
                            </div>
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <!-- Información del contrato -->
                    <div class="info-grid">
                        <div class="info-item">
                            <i class="fas fa-signature"></i>
                            <div>
                                <div class="info-label">Nombre del Contrato</div>
                                <div class="info-value">{{ $contrato->nombre }}</div>
                            </div>
                        </div>

                        <div class="info-item">
                            <i class="fas fa-building"></i>
                            <div>
                                <div class="info-label">Coordinación</div>
                                <div class="info-value">
                                    @if($contrato->coordinacion)
                                        <span class="badge bg-success">{{ $contrato->coordinacion->display_name ?: $contrato->coordinacion->nombre }}</span>
                                    @else
                                        <span class="badge bg-secondary">Sin coordinación asignada</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="info-item">
                            <i class="fas fa-calendar-plus"></i>
                            <div>
                                <div class="info-label">Fecha de Creación</div>
                                <div class="info-value">{{ $contrato->created_at->format('d/m/Y H:i') }}</div>
                            </div>
                        </div>

                        <div class="info-item">
                            <i class="fas fa-sync-alt"></i>
                            <div>
                                <div class="info-label">Última Actualización</div>
                                <div class="info-value">{{ $contrato->updated_at->format('d/m/Y H:i') }}</div>
                            </div>
                        </div>

                        <div class="info-item">
                            <i class="fas fa-id-badge"></i>
                            <div>
                                <div class="info-label">ID del Contrato</div>
                                <div class="info-value">#{{ str_pad($contrato->id, 6, '0', STR_PAD_LEFT) }}</div>
                            </div>
                        </div>

                        <div class="info-item">
                            <i class="fas fa-layer-group"></i>
                            <div>
                                <div class="info-label">Plantilla</div>
                                <div class="info-value">
                                    @if($contrato->template)
                                        <span class="badge bg-info">{{ $contrato->template->name }}</span>
                                    @else
                                        <span class="badge bg-secondary">Plantilla no disponible</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sección de descargas -->
                    <div class="download-section">
                        <div class="download-header">
                            <i class="fas fa-download"></i> Descargar Documento
                        </div>
                        
                        <div class="button-group">
                            <a href="{{ route('contracts.download.word', $contrato->id) }}" class="btn-primary-custom" id="downloadWord">
                                <i class="fas fa-file-word me-2"></i> Descargar Word (.docx)
                            </a>
                        </div>

                        @if($contrato->coordinacion)
                            <div class="coordinacion-info">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-info-circle text-primary me-2"></i>
                                    <div>
                                        <strong>Información de Coordinación:</strong>
                                        <span class="ms-2">{{ $contrato->coordinacion->display_name ?: $contrato->coordinacion->nombre }}</span>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Vista previa del PDF -->
                    <div class="preview-section">
                        <div class="preview-header">
                            <h3 class="mb-0">Vista Previa del Contrato</h3>
                        </div>

                        <div class="preview-container">
                            <div id="loadingState" class="loading-state">
                                <div class="loading-spinner"></div>
                                <p>Cargando vista previa del contrato...</p>
                            </div>

                            <!-- IFRAME para mostrar el PDF - SOLUCIÓN SIMPLE -->
                            <iframe 
                                src="{{ route('contracts.preview.pdf', $contrato->id) }}?t={{ time() }}" 
                                id="previewFrame" 
                                onload="hideLoading()"
                                style="display: none; width: 100%; height: 600px; border: none;">
                            </iframe>

                            <!-- Mensaje alternativo si falla el PDF -->
                            <div id="pdfError" class="pdf-error" style="display: none;">
                                <i class="fas fa-exclamation-triangle"></i>
                                <h4>No se pudo cargar la vista previa</h4>
                                <p>El PDF no pudo ser generado o cargado.</p>
                                <div class="mt-3">
                                    <a href="{{ route('contracts.download.word', $contrato->id) }}" class="btn-primary-custom">
                                        <i class="fas fa-file-word me-2"></i> Descargar Word
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Botón de volver -->
                    <div class="text-center mt-4">
                        <a href="{{ route('contracts.index') }}" class="btn-secondary-custom">
                            <i class="fas fa-arrow-left me-2"></i> Volver al Listado
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Botones flotantes -->
    <div class="floating-actions">
        <a href="{{ route('contracts.edit', $contrato->id) }}" class="floating-btn warning" title="Editar Contrato">
            <i class="fas fa-edit"></i>
        </a>
        <a href="{{ route('contracts.download.word', $contrato->id) }}" class="floating-btn" title="Descargar Word">
            <i class="fas fa-download"></i>
        </a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Ocultar loading y mostrar PDF cuando cargue
            window.hideLoading = function() {
                const loadingState = document.getElementById('loadingState');
                const previewFrame = document.getElementById('previewFrame');
                const pdfError = document.getElementById('pdfError');
                
                if (loadingState) {
                    loadingState.style.display = 'none';
                }
                
                // Verificar si el iframe cargó correctamente
                try {
                    // Intentar acceder al contenido del iframe
                    if (previewFrame && previewFrame.contentDocument && previewFrame.contentDocument.body) {
                        // Si tiene contenido, mostrarlo
                        previewFrame.style.display = 'block';
                        pdfError.style.display = 'none';
                    } else {
                        // Si no tiene contenido, mostrar error
                        previewFrame.style.display = 'none';
                        pdfError.style.display = 'block';
                    }
                } catch (e) {
                    // Error de cross-origin, mostrar el iframe de todos modos
                    if (previewFrame) {
                        previewFrame.style.display = 'block';
                        pdfError.style.display = 'none';
                    }
                }
            };

            // Manejo de errores del iframe
            const previewFrame = document.getElementById('previewFrame');
            if (previewFrame) {
                previewFrame.addEventListener('error', function() {
                    hideLoading();
                    document.getElementById('pdfError').style.display = 'block';
                });
            }

            // Feedback visual para botón de descarga
            const downloadWord = document.getElementById('downloadWord');
            if (downloadWord) {
                downloadWord.addEventListener('click', function(e) {
                    const originalHTML = this.innerHTML;
                    this.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Preparando descarga...';
                    this.classList.add('disabled');
                    
                    // Permitir que la descarga comience
                    setTimeout(() => {
                        this.innerHTML = originalHTML;
                        this.classList.remove('disabled');
                    }, 2000);
                });
            }

            // Cerrar alertas automáticamente
            setTimeout(() => {
                const alerts = document.querySelectorAll('.alert');
                alerts.forEach(alert => {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                });
            }, 5000);

            // Forzar recarga del iframe si no carga en 10 segundos
            setTimeout(() => {
                const loadingState = document.getElementById('loadingState');
                if (loadingState && loadingState.style.display !== 'none') {
                    // Recargar el iframe con un timestamp diferente
                    if (previewFrame) {
                        previewFrame.src = previewFrame.src.split('?')[0] + '?t=' + new Date().getTime();
                    }
                }
            }, 10000);
        });
    </script>
</body>
</html>