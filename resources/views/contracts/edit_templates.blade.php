<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Plantilla - Sistema de Gestión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/estilos_contratos/edit_templates.css') }}">
</head>
<body class="bg-light p-4">
    <div class="container">
        <div class="template-card">
            <!-- Encabezado -->
            <div class="template-header">
                <h2><i class="fas fa-edit me-2"></i>Editar Plantilla</h2>
                <p class="template-subtitle">Modifique el nombre de la plantilla según sus necesidades</p>
            </div>

            <!-- Información de la plantilla -->
            <div class="template-info">
                <div class="template-current">
                    <i class="fas fa-info-circle text-primary"></i>
                    Editando: {{ $template->name }}
                </div>
                <p class="template-meta">
                    Creada el {{ $template->created_at->format('d/m/Y') }} • 
                    Actualizada el {{ $template->updated_at->format('d/m/Y') }}
                </p>
            </div>

            <!-- Alertas de errores -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Por favor, corrija los siguientes errores:</strong>
                    </div>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Formulario -->
            <form action="{{ route('templates.update', $template->id) }}" method="POST" class="template-form" id="editTemplateForm">
                @csrf
                @method('PUT')

                <!-- Campo Nombre -->
                <div class="form-group">
                    <label for="name" class="form-label">
                        <i class="fas fa-heading me-2"></i>Nombre de la Plantilla
                    </label>
                    <div class="input-with-icon">
                        <i class="fas fa-layer-group"></i>
                        <input type="text" name="name" id="name" class="form-control" 
                               value="{{ old('name', $template->name) }}" 
                               placeholder="Ingrese el nuevo nombre de la plantilla" 
                               required
                               maxlength="100"
                               autofocus>
                    </div>
                    <div class="char-counter" id="charCounter">
                        <span id="charCount">0</span>/100 caracteres
                    </div>
                    
                    <!-- Preview del nombre -->
                    <div class="name-preview" id="namePreview">
                        <div class="preview-label">Vista previa:</div>
                        <div class="preview-value" id="previewValue"></div>
                    </div>
                </div>

                <!-- Botones -->
                <div class="button-group">
                    <a href="{{ route('contracts.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times me-2"></i>
                        Cancelar
                    </a>
                    <button type="submit" class="btn btn-success" id="saveButton">
                        <i class="fas fa-save me-2"></i>
                        Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Script para mejoras de UI -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('editTemplateForm');
            const nameInput = document.getElementById('name');
            const charCounter = document.getElementById('charCounter');
            const charCount = document.getElementById('charCount');
            const namePreview = document.getElementById('namePreview');
            const previewValue = document.getElementById('previewValue');
            const saveButton = document.getElementById('saveButton');
            const originalName = "{{ $template->name }}";

            // Actualizar contador de caracteres
            function updateCharCounter() {
                const length = nameInput.value.length;
                charCount.textContent = length;
                
                if (length === 0) {
                    charCounter.className = 'char-counter';
                } else if (length > 80) {
                    charCounter.className = 'char-counter warning';
                } else if (length >= 95) {
                    charCounter.className = 'char-counter danger';
                } else {
                    charCounter.className = 'char-counter';
                }
            }

            // Actualizar vista previa
            function updatePreview() {
                const value = nameInput.value.trim();
                if (value && value !== originalName) {
                    previewValue.textContent = value;
                    namePreview.classList.add('show');
                } else {
                    namePreview.classList.remove('show');
                }
            }

            // Event listeners
            nameInput.addEventListener('input', function() {
                updateCharCounter();
                updatePreview();
            });

            // Validación del formulario
            form.addEventListener('submit', function(e) {
                const nameValue = nameInput.value.trim();
                
                if (!nameValue) {
                    e.preventDefault();
                    showAlert('Por favor, ingrese un nombre para la plantilla.', 'danger');
                    nameInput.classList.add('is-invalid');
                    nameInput.focus();
                    return;
                }

                if (nameValue === originalName) {
                    e.preventDefault();
                    showAlert('No ha realizado ningún cambio en el nombre de la plantilla.', 'warning');
                    return;
                }

                if (nameValue.length > 100) {
                    e.preventDefault();
                    showAlert('El nombre no puede exceder los 100 caracteres.', 'danger');
                    nameInput.classList.add('is-invalid');
                    return;
                }

                // Mostrar estado de carga
                saveButton.classList.add('loading');
                saveButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Guardando...';
                saveButton.disabled = true;
            });

            // Función para mostrar alertas
            function showAlert(message, type) {
                // Remover alertas existentes
                const existingAlerts = document.querySelectorAll('.alert:not(.alert-danger)');
                existingAlerts.forEach(alert => alert.remove());

                const alertDiv = document.createElement('div');
                alertDiv.className = `alert alert-${type === 'danger' ? 'danger' : 'warning'} alert-dismissible fade show`;
                alertDiv.innerHTML = `
                    <div class="d-flex align-items-center">
                        <i class="fas fa-${type === 'danger' ? 'exclamation-triangle' : 'exclamation-circle'} me-2"></i>
                        <strong>${message}</strong>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                `;
                
                form.insertBefore(alertDiv, form.firstChild);

                // Remover automáticamente después de 5 segundos
                setTimeout(() => {
                    if (alertDiv.parentNode) {
                        alertDiv.remove();
                    }
                }, 5000);

                // Efecto de shake en el campo
                if (type === 'danger') {
                    nameInput.classList.add('shake');
                    setTimeout(() => {
                        nameInput.classList.remove('shake');
                    }, 500);
                }
            }

            // Inicializar
            updateCharCounter();
            updatePreview();

            // Prevenir navegación accidental si hay cambios
            let hasChanges = false;
            nameInput.addEventListener('input', function() {
                hasChanges = this.value !== originalName;
            });

            window.addEventListener('beforeunload', function(e) {
                if (hasChanges && !saveButton.disabled) {
                    e.preventDefault();
                    e.returnValue = 'Tiene cambios sin guardar en el nombre de la plantilla. ¿Está seguro de que desea salir?';
                }
            });

            // Auto-focus y selección del texto
            nameInput.focus();
            nameInput.select();
        });
    </script>
</body>
</html>