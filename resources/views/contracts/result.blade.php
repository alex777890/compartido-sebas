<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado del Análisis - Sistema de Gestión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/estilos_contratos/result.css') }}">
</head>
<body class="bg-light p-4">
    <div class="container">
        <div class="results-card">
            <!-- Encabezado -->
            <div class="results-header">
                <h2><i class="fas fa-chart-bar me-2"></i>Resultado del Análisis</h2>
                <p class="results-subtitle">Campos detectados en los documentos comparados</p>
            </div>

            <!-- Estadísticas del análisis -->
            @if(!isset($error) && !empty($campos))
            <div class="analysis-stats">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-tags"></i>
                    </div>
                    <div class="stat-value">{{ count($campos) }}</div>
                    <div class="stat-label">Campos Detectados</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="stat-value">{{ count(array_filter($campos)) }}</div>
                    <div class="stat-label">Campos con Valores</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-percentage"></i>
                    </div>
                    <div class="stat-value">
                        {{ count($campos) > 0 ? round((count(array_filter($campos)) / count($campos)) * 100) : 0 }}%
                    </div>
                    <div class="stat-label">Tasa de Detección</div>
                </div>
            </div>
            @endif

            <!-- Alertas de estado -->
            @if(isset($error))
                <div class="alert alert-danger">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Error en el Análisis</strong>
                    </div>
                    <p class="mb-0 mt-2">{{ $error }}</p>
                    @if(isset($camposRaw))
                        <details class="mt-3">
                            <summary class="fw-bold">Detalles técnicos:</summary>
                            <pre class="mt-2">{{ $camposRaw }}</pre>
                        </details>
                    @endif
                </div>
            @elseif(empty($campos))
                <div class="alert alert-warning">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        <strong>No se detectaron campos variables</strong>
                    </div>
                    <p class="mb-0 mt-2">
                        Por favor, revise los archivos subidos o intente de nuevo. 
                        Asegúrese de que los documentos contengan campos variables entre llaves {}.
                    </p>
                </div>
            @else
                <!-- Tabla de campos detectados -->
                <div class="campos-table-container">
                    <div class="d-flex justify-content-between align-items-center p-3 border-bottom">
                        <h4 class="mb-0">
                            <i class="fas fa-list-ul me-2"></i>Campos Detectados
                            <span class="fields-count">{{ count($campos) }}</span>
                        </h4>
                        <div class="text-muted small">
                            <i class="fas fa-info-circle me-1"></i>
                            {{ count($campos) }} campos encontrados
                        </div>
                    </div>
                    <table class="table table-hover campos-table">
                        <thead>
                            <tr>
                                <th width="40%">
                                    <i class="fas fa-tag me-2"></i>Placeholder
                                </th>
                                <th width="60%">
                                    <i class="fas fa-font me-2"></i>Valor Detectado
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($campos as $placeholder => $valor)
                                <tr>
                                    <td>
                                        <span class="placeholder-cell">
                                            {{ $placeholder }}
                                        </span>
                                    </td>
                                    <td class="value-cell">
                                        @if(!empty($valor))
                                            <i class="fas fa-check text-success me-2"></i>
                                            {{ $valor }}
                                        @else
                                            <span class="text-muted">
                                                <i class="fas fa-times text-warning me-2"></i>
                                                Vacío
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Formulario para guardar plantilla -->
                <div class="template-form-section">
                    <div class="form-header">
                        <h4><i class="fas fa-save me-2"></i>Guardar como Plantilla</h4>
                        <p class="text-muted mb-0">Guarde los campos detectados como una plantilla reutilizable</p>
                    </div>

                    <form method="POST" action="{{ route('templates.store') }}" id="templateForm">
                        @csrf
                        <input type="hidden" name="vacio_temp_path" value="{{ $vacio_temp_path }}">
                        @foreach($campos as $placeholder => $valor)
                            <input type="hidden" name="fields[]" value="{{ $placeholder }}">
                        @endforeach
                        
                        <div class="form-group">
                            <label for="templateName">
                                <i class="fas fa-heading me-2"></i>Nombre de la Plantilla
                            </label>
                            <input type="text" name="name" id="templateName" class="form-control" 
                                   placeholder="Ingrese un nombre descriptivo para la plantilla" 
                                   required
                                   maxlength="100">
                            <div class="form-text">
                                Use un nombre que describa el tipo de contrato (ej: "Contrato de Arrendamiento", "Acuerdo de Confidencialidad")
                            </div>
                        </div>

                        <div class="button-group">
                            <button type="submit" class="btn btn-success" id="saveTemplateBtn">
                                <i class="fas fa-save me-2"></i>
                                Guardar Plantilla y Crear Contrato
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Estado de éxito (oculto inicialmente) -->
                <div class="success-animation" id="successAnimation" style="display: none;">
                    <div class="success-icon">
                        <i class="fas fa-check"></i>
                    </div>
                    <h4 class="text-success">¡Plantilla Guardada Exitosamente!</h4>
                    <p class="text-muted">Redirigiendo a la creación del contrato...</p>
                </div>
            @endif

            <!-- Botones de acción -->
            <div class="button-group">
                <a href="{{ route('contracts.analyze.form') }}" class="btn btn-secondary">
                    <i class="fas fa-redo me-2"></i>
                    Analizar Otro Contrato
                </a>
                @if(!isset($error) && !empty($campos))
                <a href="{{ route('contracts.index') }}" class="btn btn-primary">
                    <i class="fas fa-home me-2"></i>
                    Volver al Inicio
                </a>
                @endif
            </div>
        </div>
    </div>

    <!-- Script para mejoras de UI -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const templateForm = document.getElementById('templateForm');
            const saveTemplateBtn = document.getElementById('saveTemplateBtn');
            const successAnimation = document.getElementById('successAnimation');
            const templateName = document.getElementById('templateName');

            // Auto-focus en el campo de nombre
            if (templateName) {
                templateName.focus();
            }

            // Validación del formulario
            if (templateForm) {
                templateForm.addEventListener('submit', function(e) {
                    const nameValue = templateName.value.trim();
                    
                    if (!nameValue) {
                        e.preventDefault();
                        showAlert('Por favor, ingrese un nombre para la plantilla.', 'warning');
                        templateName.focus();
                        return;
                    }

                    if (nameValue.length > 100) {
                        e.preventDefault();
                        showAlert('El nombre de la plantilla no puede exceder los 100 caracteres.', 'warning');
                        templateName.focus();
                        return;
                    }

                    // Mostrar estado de carga
                    saveTemplateBtn.classList.add('loading');
                    saveTemplateBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Guardando...';
                    saveTemplateBtn.disabled = true;

                    // Simular éxito (en un caso real esto lo haría el servidor)
                    setTimeout(() => {
                        successAnimation.style.display = 'block';
                        templateForm.style.display = 'none';
                    }, 1500);
                });
            }

            // Contador de caracteres para el nombre
            if (templateName) {
                const charCounter = document.createElement('div');
                charCounter.className = 'char-counter mt-1 text-end text-muted small';
                charCounter.innerHTML = '<span id="charCount">0</span>/100 caracteres';
                templateName.parentNode.appendChild(charCounter);

                templateName.addEventListener('input', function() {
                    const length = this.value.length;
                    document.getElementById('charCount').textContent = length;
                    
                    if (length > 80) {
                        charCounter.classList.add('warning');
                    } else {
                        charCounter.classList.remove('warning');
                    }
                });

                // Inicializar contador
                templateName.dispatchEvent(new Event('input'));
            }

            // Función para mostrar alertas
            function showAlert(message, type) {
                // Remover alertas existentes
                const existingAlerts = document.querySelectorAll('.alert:not(.alert-danger):not(.alert-warning)');
                existingAlerts.forEach(alert => alert.remove());

                const alertDiv = document.createElement('div');
                alertDiv.className = `alert alert-${type} alert-dismissible fade show mt-3`;
                alertDiv.innerHTML = `
                    <div class="d-flex align-items-center">
                        <i class="fas fa-${type === 'warning' ? 'exclamation-triangle' : 'info-circle'} me-2"></i>
                        <strong>${message}</strong>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                `;
                
                templateForm.parentNode.insertBefore(alertDiv, templateForm);

                // Remover automáticamente después de 5 segundos
                setTimeout(() => {
                    if (alertDiv.parentNode) {
                        alertDiv.remove();
                    }
                }, 5000);
            }

            // Efectos de hover en la tabla
            document.querySelectorAll('.campos-table tbody tr').forEach(row => {
                row.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateX(5px)';
                });
                
                row.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateX(0)';
                });
            });

            // Auto-hide alerts después de 8 segundos
            setTimeout(() => {
                document.querySelectorAll('.alert').forEach(alert => {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                });
            }, 8000);
        });
    </script>
</body>
</html>