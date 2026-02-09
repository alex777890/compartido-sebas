<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($contrato) ? 'Editar' : 'Crear' }} Contrato - Sistema de Gestión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/estilos_contratos/form.css') }}">
</head>
<body class="bg-light p-4 {{ isset($contrato) ? 'edit-mode' : 'create-mode' }}">
    <div class="container">
        <div class="questionnaire-card">
            <!-- Header con navegación -->
            <div class="form-header">
                <a href="{{ route('contracts.index') }}" class="back-button">
                    <i class="fas fa-arrow-left"></i>
                    <span>Volver al Listado</span>
                </a>
                <div class="mode-badge {{ isset($contrato) ? 'edit' : 'create' }}">
                    <i class="fas {{ isset($contrato) ? 'fa-edit' : 'fa-plus' }} me-1"></i>
                    {{ isset($contrato) ? 'Modo Edición' : 'Nuevo Contrato' }}
                </div>
            </div>

            <!-- Encabezado -->
            <div class="questionnaire-header">
                <h2>
                    <i class="fas {{ isset($contrato) ? 'fa-edit' : 'fa-file-contract' }} me-2"></i>
                    {{ isset($contrato) ? 'Editar Contrato' : 'Crear Contrato' }}
                </h2>
                
                <!-- Información de la plantilla -->
                <div class="template-info">
                    <div class="template-name">
                        <i class="fas fa-layer-group"></i>
                        Plantilla: {{ $template->name }}
                    </div>
                    <p class="template-description">
                        Complete todos los campos requeridos para {{ isset($contrato) ? 'modificar' : 'generar' }} el contrato.
                    </p>
                </div>
            </div>

            <!-- Indicador de progreso -->
            <div class="progress-section">
                <div class="progress-info">
                    <span class="progress-text">Progreso del formulario</span>
                    <span class="progress-text" id="progressText">0%</span>
                </div>
                <div class="progress-bar">
                    <div class="progress-fill" id="progressFill"></div>
                </div>
            </div>

            <!-- Formulario -->
            <form method="POST" action="{{ isset($contrato) ? route('contracts.update', $contrato->id) : route('contracts.store') }}" 
                  class="questionnaire-form" id="questionnaireForm">
                @csrf
                @if(isset($contrato))
                    @method('PUT')
                @endif
                <input type="hidden" name="template_id" value="{{ $template->id }}">
                
                <!-- Campo Nombre del Contrato -->
                <div class="form-group">
                    <label for="name" class="required">
                        <span class="field-number">1</span>
                        <i class="fas fa-signature me-2"></i>Nombre del Contrato
                    </label>
                    <div class="input-with-icon">
                        <i class="fas fa-heading"></i>
                        <input type="text" class="form-control" name="name" id="name" 
                               value="{{ $contrato->nombre ?? '' }}" 
                               placeholder="Ingrese un nombre descriptivo para el contrato" 
                               required>
                    </div>
                </div>

                <!-- Sección de Campos Dinámicos -->
                <div class="fields-section">
                    <div class="section-header">
                        <h4><i class="fas fa-list-alt me-2"></i>Campos del Cuestionario</h4>
                        <span class="fields-count">{{ count($fields) }} campos</span>
                    </div>
                    
                    @foreach($fields as $index => $field)
                        <div class="form-group">
                            <label for="values_{{ $field }}" class="required">
                                <span class="field-number">{{ $index + 2 }}</span>
                                {{ $field }}
                            </label>
                            <input type="text" class="form-control" name="values[{{ $field }}]" 
                                   id="values_{{ $field }}" 
                                   value="{{ $values[$field] ?? '' }}" 
                                   placeholder="Ingrese {{ strtolower($field) }}" 
                                   required
                                   data-field-index="{{ $index }}">
                        </div>
                    @endforeach
                </div>

                <!-- Botones de acción -->
                <div class="button-group">
                    <a href="{{ route('contracts.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times me-2"></i>
                        Cancelar
                    </a>
                    <button type="submit" class="btn btn-primary" id="submitButton">
                        <i class="fas {{ isset($contrato) ? 'fa-save' : 'fa-file-contract' }} me-2"></i>
                        {{ isset($contrato) ? 'Actualizar' : 'Crear' }} Contrato
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Script para mejoras de UI -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('questionnaireForm');
            const submitButton = document.getElementById('submitButton');
            const progressFill = document.getElementById('progressFill');
            const progressText = document.getElementById('progressText');
            const totalFields = {{ count($fields) + 1 }}; // +1 para el campo nombre
            let completedFields = 0;

            // Calcular progreso inicial
            function calculateProgress() {
                const requiredFields = form.querySelectorAll('[required]');
                completedFields = 0;
                
                requiredFields.forEach(field => {
                    if (field.value.trim() !== '') {
                        completedFields++;
                    }
                });
                
                const progress = Math.round((completedFields / totalFields) * 100);
                progressFill.style.width = progress + '%';
                progressText.textContent = progress + '%';
                
                // Cambiar color según el progreso
                if (progress === 100) {
                    progressFill.style.background = 'var(--success-color)';
                } else if (progress >= 50) {
                    progressFill.style.background = 'var(--warning-color)';
                } else {
                    progressFill.style.background = 'var(--accent-color)';
                }
            }

            // Actualizar progreso en tiempo real
            form.addEventListener('input', function(e) {
                calculateProgress();
            });

            // Calcular progreso inicial
            calculateProgress();

            // Validación del formulario
            form.addEventListener('submit', function(e) {
                const requiredFields = form.querySelectorAll('[required]');
                let isValid = true;
                let emptyFields = [];

                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        field.classList.add('is-invalid');
                        isValid = false;
                        const label = field.closest('.form-group').querySelector('label');
                        emptyFields.push(label.textContent.trim());
                    } else {
                        field.classList.remove('is-invalid');
                    }
                });

                if (!isValid) {
                    e.preventDefault();
                    const fieldList = emptyFields.map(field => field.replace(/^\d+\s*/, '')).join(', ');
                    showAlert(`Por favor, complete los siguientes campos: ${fieldList}`, 'danger');
                    
                    // Scroll al primer campo vacío
                    const firstEmpty = form.querySelector('.is-invalid');
                    if (firstEmpty) {
                        firstEmpty.scrollIntoView({ 
                            behavior: 'smooth', 
                            block: 'center' 
                        });
                        firstEmpty.focus();
                    }
                } else {
                    // Mostrar estado de carga
                    submitButton.classList.add('loading');
                    submitButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Procesando...';
                    submitButton.disabled = true;
                }
            });

            // Navegación por teclado
            form.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' && e.target.type !== 'submit') {
                    e.preventDefault();
                    const fields = Array.from(form.querySelectorAll('input[type="text"]'));
                    const currentIndex = fields.indexOf(e.target);
                    if (currentIndex < fields.length - 1) {
                        fields[currentIndex + 1].focus();
                    }
                }
            });

            // Función para mostrar alertas
            function showAlert(message, type) {
                // Remover alertas existentes
                const existingAlerts = document.querySelectorAll('.alert');
                existingAlerts.forEach(alert => alert.remove());

                const alertDiv = document.createElement('div');
                alertDiv.className = `alert alert-${type} alert-dismissible fade show mt-3`;
                alertDiv.innerHTML = `
                    <i class="fas fa-${getIconName(type)} me-2"></i>
                    ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                `;
                form.prepend(alertDiv);

                // Remover automáticamente después de 5 segundos
                setTimeout(() => {
                    if (alertDiv.parentNode) {
                        alertDiv.remove();
                    }
                }, 5000);
            }

            function getIconName(type) {
                const icons = {
                    'success': 'check-circle',
                    'danger': 'exclamation-triangle',
                    'warning': 'exclamation-triangle',
                    'info': 'info-circle'
                };
                return icons[type] || 'info-circle';
            }

            // Mejorar experiencia en móviles
            if (window.innerWidth <= 768) {
                document.querySelectorAll('.form-control').forEach(input => {
                    input.addEventListener('focus', function() {
                        setTimeout(() => {
                            this.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        }, 300);
                    });
                });
            }

            // Efecto de focus mejorado
            document.querySelectorAll('.form-control').forEach(input => {
                input.addEventListener('focus', function() {
                    this.closest('.form-group').classList.add('focused');
                });
                
                input.addEventListener('blur', function() {
                    this.closest('.form-group').classList.remove('focused');
                });
            });
        });
    </script>
</body>
</html>