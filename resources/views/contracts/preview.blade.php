<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vista Previa - Sistema de Gestión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/estilos_contratos/preview.css') }}">
</head>
<body class="bg-light p-4">
    <div class="container">
        <div class="preview-card">
            <!-- Encabezado -->
            <div class="preview-header">
                <h2><i class="fas fa-eye me-2"></i>Vista Previa del Contrato</h2>
                <p class="preview-subtitle">Revise el contenido generado antes de proceder</p>
            </div>

            <!-- Contenedor del documento -->
            <div class="document-container">
                <!-- Cabecera del documento -->
                <div class="document-header">
                    <div class="document-title">
                        <i class="fas fa-file-contract"></i>
                        Documento Generado - Vista Previa
                    </div>
                    <div class="document-actions">
                        <button class="action-btn" onclick="printDocument()" title="Imprimir">
                            <i class="fas fa-print"></i>
                            <span class="d-none d-sm-inline">Imprimir</span>
                        </button>
                        <button class="action-btn" onclick="copyToClipboard()" title="Copiar texto">
                            <i class="fas fa-copy"></i>
                            <span class="d-none d-sm-inline">Copiar</span>
                        </button>
                        <button class="action-btn" onclick="downloadText()" title="Descargar como texto">
                            <i class="fas fa-download"></i>
                            <span class="d-none d-sm-inline">Descargar</span>
                        </button>
                    </div>
                </div>

                <!-- Barra de herramientas -->
                <div class="toolbar">
                    <div class="toolbar-group">
                        <span class="toolbar-label">Zoom:</span>
                        <div class="zoom-controls">
                            <button class="zoom-btn" onclick="zoomOut()" title="Zoom Out">
                                <i class="fas fa-search-minus"></i>
                            </button>
                            <span class="zoom-level" id="zoomLevel">100%</span>
                            <button class="zoom-btn" onclick="zoomIn()" title="Zoom In">
                                <i class="fas fa-search-plus"></i>
                            </button>
                            <button class="zoom-btn" onclick="resetZoom()" title="Reset Zoom">
                                <i class="fas fa-sync-alt"></i>
                            </button>
                        </div>
                    </div>
                    
                    <div class="toolbar-group">
                        <span class="toolbar-label">Vista:</span>
                        <div class="view-mode">
                            <button class="mode-btn active" onclick="setViewMode('comfortable')" data-mode="comfortable">
                                Cómoda
                            </button>
                            <button class="mode-btn" onclick="setViewMode('compact')" data-mode="compact">
                                Compacta
                            </button>
                        </div>
                    </div>
                    
                    <div class="toolbar-group">
                        <span class="toolbar-label">Buscar:</span>
                        <div class="search-box">
                            <input type="text" id="searchInput" placeholder="Buscar en el texto..." 
                                   class="form-control form-control-sm" style="width: 200px;">
                        </div>
                    </div>
                </div>

                <!-- Contenido del documento -->
                <div class="document-content">
                    <pre class="preview-text contract-text" id="previewText">{{ $text }}</pre>
                </div>

                <!-- Estadísticas del documento -->
                <div class="document-stats">
                    <div class="stat-item">
                        <div class="stat-value" id="charCount">0</div>
                        <div class="stat-label">Caracteres</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value" id="wordCount">0</div>
                        <div class="stat-label">Palabras</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value" id="lineCount">0</div>
                        <div class="stat-label">Líneas</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value" id="placeholderCount">0</div>
                        <div class="stat-label">Placeholders</div>
                    </div>
                </div>
            </div>

            <!-- Botones de acción -->
            <div class="button-group text-center">
                <a href="{{ route('contracts.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>
                    Volver al Listado
                </a>
            </div>
        </div>
    </div>

    <!-- Script para mejoras de UI -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const previewText = document.getElementById('previewText');
            const zoomLevel = document.getElementById('zoomLevel');
            let currentZoom = 1;
            let currentViewMode = 'comfortable';

            // Calcular estadísticas iniciales
            calculateStats();

            // Funciones de zoom
            function zoomIn() {
                if (currentZoom < 2) {
                    currentZoom += 0.1;
                    updateZoom();
                }
            }

            function zoomOut() {
                if (currentZoom > 0.5) {
                    currentZoom -= 0.1;
                    updateZoom();
                }
            }

            function resetZoom() {
                currentZoom = 1;
                updateZoom();
            }

            function updateZoom() {
                previewText.style.fontSize = `${currentZoom * 100}%`;
                zoomLevel.textContent = `${Math.round(currentZoom * 100)}%`;
            }

            // Funciones de modo de vista
            function setViewMode(mode) {
                currentViewMode = mode;
                
                // Actualizar botones activos
                document.querySelectorAll('.mode-btn').forEach(btn => {
                    btn.classList.remove('active');
                });
                document.querySelector(`[data-mode="${mode}"]`).classList.add('active');
                
                // Aplicar estilos
                if (mode === 'compact') {
                    previewText.style.lineHeight = '1.4';
                    previewText.style.fontSize = '0.9em';
                } else {
                    previewText.style.lineHeight = '1.8';
                    previewText.style.fontSize = `${currentZoom * 100}%`;
                }
            }

            // Calcular estadísticas del documento
            function calculateStats() {
                const text = previewText.textContent;
                
                // Caracteres
                const charCount = text.length;
                document.getElementById('charCount').textContent = charCount.toLocaleString();
                
                // Palabras
                const wordCount = text.trim() ? text.trim().split(/\s+/).length : 0;
                document.getElementById('wordCount').textContent = wordCount.toLocaleString();
                
                // Líneas
                const lineCount = text.split('\n').length;
                document.getElementById('lineCount').textContent = lineCount.toLocaleString();
                
                // Placeholders (buscar texto entre llaves)
                const placeholderMatches = text.match(/\{[^}]+\}/g) || [];
                document.getElementById('placeholderCount').textContent = placeholderMatches.length;
                
                // Resaltar placeholders
                highlightPlaceholders();
            }

            // Resaltar placeholders en el texto
            function highlightPlaceholders() {
                let html = previewText.textContent;
                
                // Encontrar y envolver placeholders
                html = html.replace(/\{([^}]+)\}/g, '<span class="placeholder" title="Placeholder: $1">{$1}</span>');
                
                // Aplicar el HTML con placeholders resaltados
                previewText.innerHTML = html;
            }

            // Función de búsqueda
            document.getElementById('searchInput').addEventListener('input', function(e) {
                const searchTerm = e.target.value.toLowerCase();
                const text = previewText.textContent;
                
                if (searchTerm) {
                    const regex = new RegExp(`(${searchTerm.replace(/[.*+?^${}()|[\]\\]/g, '\\$&')})`, 'gi');
                    const highlighted = text.replace(regex, '<mark class="highlight">$1</mark>');
                    previewText.innerHTML = highlighted;
                } else {
                    highlightPlaceholders();
                }
            });

            // Imprimir documento
            function printDocument() {
                window.print();
            }

            // Copiar al portapapeles
            function copyToClipboard() {
                const text = previewText.textContent;
                navigator.clipboard.writeText(text).then(() => {
                    showNotification('Texto copiado al portapapeles', 'success');
                }).catch(() => {
                    showNotification('Error al copiar el texto', 'error');
                });
            }

            // Descargar como archivo de texto
            function downloadText() {
                const text = previewText.textContent;
                const blob = new Blob([text], { type: 'text/plain' });
                const url = URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = `contrato-${new Date().toISOString().split('T')[0]}.txt`;
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
                URL.revokeObjectURL(url);
                
                showNotification('Documento descargado exitosamente', 'success');
            }

            // Mostrar notificaciones
            function showNotification(message, type) {
                const notification = document.createElement('div');
                notification.className = `alert alert-${type === 'success' ? 'success' : 'danger'} alert-dismissible fade show position-fixed`;
                notification.style.cssText = 'top: 20px; right: 20px; z-index: 1050; min-width: 300px;';
                notification.innerHTML = `
                    <div class="d-flex align-items-center">
                        <i class="fas fa-${type === 'success' ? 'check' : 'exclamation-triangle'} me-2"></i>
                        ${message}
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                `;
                
                document.body.appendChild(notification);
                
                setTimeout(() => {
                    if (notification.parentNode) {
                        notification.remove();
                    }
                }, 3000);
            }

            // Inicializar
            updateZoom();
            highlightPlaceholders();

            // Hacer funciones globales para los botones
            window.zoomIn = zoomIn;
            window.zoomOut = zoomOut;
            window.resetZoom = resetZoom;
            window.setViewMode = setViewMode;
            window.printDocument = printDocument;
            window.copyToClipboard = copyToClipboard;
            window.downloadText = downloadText;
        });
    </script>
</body>
</html>