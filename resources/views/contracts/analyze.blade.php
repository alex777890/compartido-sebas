}<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analizar Contratos - Sistema de Gestión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/estilos_contratos/analyze.css') }}">
</head>
<body class="bg-light p-4">
    <div class="container">
        <div class="analyze-card">
            <!-- Encabezado -->
            <div class="analyze-header">
                <h2><i class="fas fa-search me-2"></i>Analizar Contratos</h2>
                <p class="analyze-subtitle">Suba el archivo de contrato para procesar los placeholders y crear una plantilla</p>
            </div>

            <!-- Formulario -->
            <form method="POST" action="{{ route('contracts.analyze.process') }}" enctype="multipart/form-data" class="analyze-form" id="analyzeForm">
                @csrf
                
                <!-- Contrato Vacío -->
                <div class="form-group">
                    <label for="contrato_vacio" class="required">
                        <i class="fas fa-file me-2"></i>Contrato Vacío (Plantilla)
                    </label>
                    <div class="file-input-container">
                        <div class="file-input-wrapper">
                            <input type="file" class="file-input" name="contrato_vacio" id="contrato_vacio" required accept=".pdf,.doc,.docx,.txt">
                            <label for="contrato_vacio" class="file-input-label" id="contrato_vacio_label">
                                <div class="file-input-text">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    <span>Seleccione el contrato vacío</span>
                                </div>
                                <div class="file-input-info">
                                    <small>PDF, DOC, DOCX, TXT</small>
                                </div>
                            </label>
                        </div>
                        <div class="file-name" id="contrato_vacio_name"></div>
                    </div>
                    <div class="form-text">Seleccione la plantilla del contrato con placeholders</div>
                </div>

                <!-- Sección de ayuda -->
                <div class="help-section">
                    <div class="help-title">
                        <i class="fas fa-info-circle"></i>
                        Información importante
                    </div>
                    <ul class="help-list">
                        <li>Asegúrese de que el archivo sea legible y no esté corrupto</li>
                        <li>El sistema detectará los placeholders [[...]] para crear una plantilla</li>
                        <li>Formatos soportados: PDF, Word (.doc, .docx) y texto plano (.txt)</li>
                        <li>El proceso de análisis puede tomar algunos minutos</li>
                    </ul>
                </div>

                <!-- Botones -->
                <div class="button-group">
                    <a href="{{ route('contracts.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>
                        Volver al Inicio
                    </a>
                    <button type="submit" class="btn btn-primary" id="analyzeButton">
                        <i class="fas fa-search me-2"></i>
                        Iniciar Análisis
                    </button>
                </div>

                <!-- Alerta para errores del servidor -->
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
            </form>
        </div>
    </div>

    <!-- Script para mejoras de UI -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
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
                        label.style.borderColor = 'var(--success-color)';
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
                        label.style.borderColor = 'var(--danger-color)';
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

                    // Depuración: Confirmar envío
                    console.log('Enviando archivo:', {
                        contrato_vacio: form.querySelector('#contrato_vacio').files[0]?.name
                    });
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
            
            // Prevenir envío accidental
            let formSubmitted = false;
            form.addEventListener('submit', function() {
                if (!formSubmitted) {
                    formSubmitted = true;
                    setTimeout(() => {
                        formSubmitted = false;
                    }, 3000);
                }
            });
            
            window.addEventListener('beforeunload', function(e) {
                if (analyzeButton.disabled) {
                    e.preventDefault();
                    e.returnValue = 'El análisis está en proceso. ¿Está seguro de que desea salir?';
                }
            });

            // Manejar respuesta del servidor
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('error')) {
                showAlert(urlParams.get('error'), 'danger');
            }
            if (urlParams.has('success')) {
                showAlert(urlParams.get('success'), 'success');
            }
        });
    </script>
</body>
</html>