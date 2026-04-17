<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Nuevo Maestro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .sidebar {
            background-color: #343a40;
            color: white;
            height: 100vh;
            position: fixed;
            padding-top: 20px;
        }
        .main-content {
            margin-left: 250px;
            padding: 20px;
        }
        .required-field::after {
            content: " *";
            color: red;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 sidebar">
                <div class="text-center mb-4">
                    <h4><i class="fas fa-graduation-cap"></i> Sistema Maestros</h4>
                </div>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('maestros.index') }}">
                            <i class="fas fa-home"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('maestros.index') }}">
                            <i class="fas fa-chalkboard-teacher"></i> Maestros
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('coordinaciones.index') }}">
                            <i class="fas fa-layer-group"></i> Coordinaciones
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 main-content">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2><i class="fas fa-user-plus"></i> Registrar Nuevo Maestro</h2>
                    <a href="{{ route('maestros.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Volver a la lista
                    </a>
                </div>

                <!-- Mostrar mensajes de error -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Por favor corrige los siguientes errores:</strong>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Formulario -->
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fas fa-info-circle"></i> Información del Maestro</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('maestros.store') }}" method="POST">
                            @csrf
                            
                            <!-- Sección: Coordinación y Grado Académico -->
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="coordinacion_id" class="form-label required-field">Coordinación</label>
                                        <select class="form-select @error('coordinacion_id') is-invalid @enderror" 
                                                id="coordinacion_id" name="coordinacion_id" required>
                                            <option value="">Seleccionar coordinación</option>
                                            @foreach($coordinaciones as $coordinacion)
                                                <option value="{{ $coordinacion->id }}" 
                                                    {{ old('coordinacion_id') == $coordinacion->id ? 'selected' : '' }}>
                                                    {{ $coordinacion->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('coordinacion_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="maximo_grado_academico" class="form-label required-field">Máximo Grado Académico</label>
                                        <select class="form-select @error('maximo_grado_academico') is-invalid @enderror" 
                                                id="maximo_grado_academico" name="maximo_grado_academico" required>
                                            <option value="">Seleccionar grado académico</option>
                                            <option value="Licenciatura" {{ old('maximo_grado_academico') == 'Licenciatura' ? 'selected' : '' }}>Licenciatura</option>
                                            <option value="Especialidad" {{ old('maximo_grado_academico') == 'Especialidad' ? 'selected' : '' }}>Especialidad</option>
                                            <option value="Maestría" {{ old('maximo_grado_academico') == 'Maestría' ? 'selected' : '' }}>Maestría</option>
                                            <option value="Doctorado" {{ old('maximo_grado_academico') == 'Doctorado' ? 'selected' : '' }}>Doctorado</option>
                                        </select>
                                        @error('maximo_grado_academico')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="anio_ingreso">Año de Ingreso</label>
                                            <input type="number" class="form-control" id="anio_ingreso" name="anio_ingreso" 
                                            value="{{ old('anio_ingreso', isset($maestro) ? $maestro->anio_ingreso : '') }}"max="{{ date('Y') + 1 }}">
                                </div>
                            </div>

                            <!-- Sección: Información Personal -->
                            <h5 class="mb-3"><i class="fas fa-user"></i> Información Personal</h5>
                            <div class="row mb-4">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="nombres" class="form-label required-field">Nombres</label>
                                        <input type="text" class="form-control @error('nombres') is-invalid @enderror" 
                                               id="nombres" name="nombres" value="{{ old('nombres') }}" required>
                                        @error('nombres')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="apellido_paterno" class="form-label required-field">Apellido Paterno</label>
                                        <input type="text" class="form-control @error('apellido_paterno') is-invalid @enderror" 
                                               id="apellido_paterno" name="apellido_paterno" value="{{ old('apellido_paterno') }}" required>
                                        @error('apellido_paterno')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="apellido_materno" class="form-label">Apellido Materno</label>
                                        <input type="text" class="form-control @error('apellido_materno') is-invalid @enderror" 
                                               id="apellido_materno" name="apellido_materno" value="{{ old('apellido_materno') }}">
                                        @error('apellido_materno')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Sección: Datos Personales -->
                            <div class="row mb-4">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="fecha_nacimiento" class="form-label required-field">Fecha de Nacimiento</label>
                                        <input type="date" class="form-control @error('fecha_nacimiento') is-invalid @enderror" 
                                               id="fecha_nacimiento" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" required>
                                        @error('fecha_nacimiento')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                 <div class="col-md-3">
        <div class="mb-3">
            <label for="edad" class="form-label required-field">Edad</label>
            <input type="number" class="form-control @error('edad') is-invalid @enderror" 
                   id="edad" name="edad" value="{{ old('edad') }}" required 
                   min="18" max="100" placeholder="Edad">
            @error('edad')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="sexo" class="form-label">Sexo</label>
                                        <select class="form-select @error('sexo') is-invalid @enderror" id="sexo" name="sexo">
                                            <option value="">Seleccionar sexo</option>
                                            <option value="Masculino" {{ old('sexo') == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                                            <option value="Femenino" {{ old('sexo') == 'Femenino' ? 'selected' : '' }}>Femenino</option>
    
                                        </select>
                                        @error('sexo')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="estado_civil" class="form-label">Estado Civil</label>
                                        <select class="form-select @error('estado_civil') is-invalid @enderror" id="estado_civil" name="estado_civil">
                                            <option value="">Seleccionar estado civil</option>
                                            <option value="Soltero" {{ old('estado_civil') == 'Soltero' ? 'selected' : '' }}>Soltero</option>
                                            <option value="Casado" {{ old('estado_civil') == 'Casado' ? 'selected' : '' }}>Casado</option>
                                        </select>
                                        @error('estado_civil')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Sección: Contacto -->
                            <h5 class="mb-3"><i class="fas fa-address-book"></i> Información de Contacto</h5>
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="telefono" class="form-label">Teléfono</label>
                                        <input type="tel" class="form-control @error('telefono') is-invalid @enderror" 
                                               id="telefono" name="telefono" value="{{ old('telefono') }}" placeholder="Ej. 555-123-4567">
                                        @error('telefono')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label required-field">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                               id="email" name="email" value="{{ old('email') }}" required placeholder="ejemplo@correo.com">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="direccion" class="form-label">Dirección</label>
                                <textarea class="form-control @error('direccion') is-invalid @enderror" 
                                          id="direccion" name="direccion" rows="3" placeholder="Dirección completa">{{ old('direccion') }}</textarea>
                                @error('direccion')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Sección: Documentos Oficiales -->
                            <h5 class="mb-3"><i class="fas fa-id-card"></i> Documentos Oficiales</h5>
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="rfc" class="form-label required-field">RFC</label>
                                        <input type="text" class="form-control @error('rfc') is-invalid @enderror" 
                                               id="rfc" name="rfc" value="{{ old('rfc') }}" required 
                                               placeholder="Ej. ABC123456XYZ" maxlength="13" style="text-transform: uppercase;">
                                        <small class="form-text text-muted">13 caracteres (letras y números)</small>
                                        @error('rfc')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="curp" class="form-label required-field">CURP</label>
                                        <input type="text" class="form-control @error('curp') is-invalid @enderror" 
                                               id="curp" name="curp" value="{{ old('curp') }}" required 
                                               placeholder="Ej. ABC123456DEF78901" maxlength="18" style="text-transform: uppercase;">
                                        <small class="form-text text-muted">18 caracteres</small>
                                        @error('curp')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Botones -->
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('maestros.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-times"></i> Cancelar
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Guardar Maestro
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Convertir a mayúsculas automáticamente
        document.getElementById('rfc').addEventListener('input', function() {
            this.value = this.value.toUpperCase();
        });

        document.getElementById('curp').addEventListener('input', function() {
            this.value = this.value.toUpperCase();
        });

        // Validación de fecha (no puede ser futura)
        document.getElementById('fecha_nacimiento').addEventListener('change', function() {
            const fechaNacimiento = new Date(this.value);
            const hoy = new Date();
            
            if (fechaNacimiento > hoy) {
                alert('La fecha de nacimiento no puede ser futura');
                this.value = '';
            }
        });

        // Mostrar campos requeridos
        document.addEventListener('DOMContentLoaded', function() {
            const requiredFields = document.querySelectorAll('.required-field');
            requiredFields.forEach(field => {
                field.style.fontWeight = 'bold';
            });
        });

          // Convertir a mayúsculas automáticamente
    document.getElementById('rfc').addEventListener('input', function() {
        this.value = this.value.toUpperCase();
    });

    document.getElementById('curp').addEventListener('input', function() {
        this.value = this.value.toUpperCase();
    });

    // Calcular edad automáticamente desde fecha de nacimiento
    document.getElementById('fecha_nacimiento').addEventListener('change', function() {
        const fechaNacimiento = new Date(this.value);
        const hoy = new Date();
        
        if (fechaNacimiento > hoy) {
            alert('La fecha de nacimiento no puede ser futura');
            this.value = '';
            document.getElementById('edad').value = '';
            return;
        }
        
        // Calcular edad
        let edad = hoy.getFullYear() - fechaNacimiento.getFullYear();
        const mes = hoy.getMonth() - fechaNacimiento.getMonth();
        
        if (mes < 0 || (mes === 0 && hoy.getDate() < fechaNacimiento.getDate())) {
            edad--;
        }
        
        document.getElementById('edad').value = edad;
    });

    // Validar que la edad esté entre 18 y 100 años
    document.getElementById('edad').addEventListener('change', function() {
        const edad = parseInt(this.value);
        if (edad < 18 || edad > 100) {
            alert('La edad debe estar entre 18 y 100 años');
            this.value = '';
        }
    });

    // Mostrar campos requeridos
    document.addEventListener('DOMContentLoaded', function() {
        const requiredFields = document.querySelectorAll('.required-field');
        requiredFields.forEach(field => {
            field.style.fontWeight = 'bold';
        });
    });
    </script>
</body>
</html>
