<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cálculo de Antigüedad</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>
<style>
    :root {
            --primary: #0744b6ff;
            --secondary: #33CAE6;
            --accent: #28a745;
            --light-bg: #F8F9FA;
            --border-color: #E9ECEF;
            --text-muted: #6C757D;
            --card-shadow: 0 5px 15px rgba(7, 68, 182, 0.08);
            --transition: all 0.3s ease;
            --success-color: #28a745;
            --warning-color: #FFC107;
            --danger-color: #dc3545;
        }
        
        body { 
            background: white; 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            color: #333; 
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }
        
/* ========== ESTILOS DE BARRA Y MENÚ DEL PRIMER CSS CON COLORES DEL SEGUNDO ========== */

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
</style>
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
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('contratos.*') ? 'active' : '' }}" href="{{ route('contracts.index') }}">Contratos</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('contratos.*') ? 'active' : '' }}" href="{{ route('users.index') }}">Accesos</a></li>
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
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">
                            Cálculo de Antigüedad - {{ $maestro->nombres }} {{ $maestro->apellido_paterno }} {{ $maestro->apellido_materno }}
                        </h4>
                    </div>
                    <div class="card-body">
                        <!-- Información del Maestro -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <h6 class="card-title">Información del Maestro</h6>
                                        <p class="mb-1"><strong>Nombre completo:</strong> {{ $maestro->nombres }} {{ $maestro->apellido_paterno }} {{ $maestro->apellido_materno }}</p>
                                        @if($maestro->anio_ingreso)
                                            <p class="mb-1"><strong>Año de ingreso:</strong> <span class="badge bg-info">{{ $maestro->anio_ingreso }}</span></p>
                                        @else
                                            <p class="mb-1"><strong>Año de ingreso:</strong> <span class="badge bg-warning">No registrado</span></p>
                                        @endif
                                        <p class="mb-0"><strong>Coordinación:</strong> {{ $maestro->coordinacion->nombre ?? 'No asignada' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Formulario para registrar año de ingreso si no existe -->
                        @if(!$maestro->anio_ingreso)
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="card border-warning">
                                    <div class="card-header bg-warning text-dark">
                                        <h5 class="mb-0">Registrar Año de Ingreso</h5>
                                    </div>
                                    <div class="card-body">
                                        <p class="text-muted">El maestro no tiene registrado un año de ingreso. Por favor, ingréselo para continuar con el cálculo de antigüedad.</p>
                                        <form action="{{ route('maestros.update', $maestro->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="anio_ingreso" class="form-label fw-bold">Año de Ingreso:</label>
                                                        <input type="number" 
                                                               name="anio_ingreso" 
                                                               id="anio_ingreso" 
                                                               class="form-control" 
                                                               min="1950" 
                                                               max="{{ date('Y') }}"
                                                               value="{{ old('anio_ingreso') }}"
                                                               required>
                                                        <small class="form-text text-muted">Año en que el maestro comenzó a trabajar</small>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 d-flex align-items-end">
                                            
                                                <div class="col-md-8 d-flex align-items-end">
                                                    <button type="button" id="btn-guardar-anio" class="btn btn-success">
                                                            Guardar Año de Ingreso
                                                    </button>
                                                </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Formulario principal (solo visible si tiene año de ingreso) -->
                        @if($maestro->anio_ingreso)
                        <form action="{{ route('maestros.calcular-antiguedad.guardar', $maestro) }}" method="POST" id="form-antiguedad">
                            @csrf
                            
                            <!-- Selección de Periodo Actual -->
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="periodo_actual" class="form-label fw-bold">Periodo Actual:</label>
                                        <select name="periodo_actual" id="periodo_actual" class="form-select" required>
                                            <option value="">Seleccione el periodo actual</option>
                                            @foreach($periodos as $periodo)
                                                <option value="{{ $periodo->id }}" data-nombre="{{ $periodo->nombre }}">
                                                    {{ $periodo->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <small class="form-text text-muted" id="periodo-info"></small>
                                    </div>
                                </div>
                            </div>

                            <!-- Calendario de Periodos (se muestra dinámicamente) -->
                            <div class="row mb-4" id="calendario-container" style="display: none;">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header bg-info text-white">
                                            <h5 class="mb-0">Selección de Periodos Trabajados</h5>
                                        </div>
                                        <div class="card-body">
                                            <h6 class="fw-bold mb-3" id="titulo-calendario">Seleccione los periodos y meses trabajados:</h6>
                                            
                                            <div id="calendario-periodos">
                                                <!-- Aquí se cargarán los años dinámicamente -->
                                            </div>

                                            <!-- Resumen de selección -->
                                            <div class="mt-3 p-3 bg-light rounded">
                                                <h6 class="fw-bold">Resumen de Selección:</h6>
                                                <div id="resumen-seleccion">
                                                    <p class="text-muted mb-0">No hay meses seleccionados</p>
                                                </div>
                                                <input type="hidden" name="periodos_meses" id="periodos_meses">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    Calcular y Guardar Antigüedad
                                </button>
                                
                                <a href="{{ route('maestros.historial-antiguedad', $maestro) }}" class="btn btn-info btn-lg">
                                    Ver Historial
                                </a>
                                <a href="{{ route('maestros.show', $maestro) }}" class="btn btn-secondary btn-lg">Cancelar</a>
                            </div>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let seleccionMeses = {};
            const anioIngreso = {{ $maestro->anio_ingreso ?? 0 }};
            
            // Elementos del DOM
            const periodoActualSelect = document.getElementById('periodo_actual');
            const periodoInfo = document.getElementById('periodo-info');
            const calendarioContainer = document.getElementById('calendario-container');
            const calendarioPeriodos = document.getElementById('calendario-periodos');
            const tituloCalendario = document.getElementById('titulo-calendario');

            // Mapeo de periodos a años y meses
            const periodosConfig = {
                @foreach($periodos as $periodo)
                '{{ $periodo->id }}': {
                    nombre: '{{ $periodo->nombre }}',
                    anio: extraerAnioDePeriodo('{{ $periodo->nombre }}'),
                    mesesDisponibles: obtenerMesesDisponibles('{{ $periodo->nombre }}')
                },
                @endforeach
            };

            // Función para extraer el año del nombre del periodo
            function extraerAnioDePeriodo(nombrePeriodo) {
                const match = nombrePeriodo.match(/(\d{4})/);
                return match ? parseInt(match[1]) : new Date().getFullYear();
            }

            // Función para obtener meses disponibles según el periodo
            function obtenerMesesDisponibles(nombrePeriodo) {
                const nombre = nombrePeriodo.toLowerCase();
                
                if (nombre.includes('enero') || nombre.includes('primer') || nombre.includes('1') || nombre.includes('ene') || nombre.includes('jun')) {
                    return [1, 2, 3, 4, 5, 6]; // Enero a Junio
                } else if (nombre.includes('agosto') || nombre.includes('segundo') || nombre.includes('2') || nombre.includes('jul') || nombre.includes('dic')) {
                    return [7, 8, 9, 10, 11, 12]; // Julio a Diciembre
                } else if (nombre.includes('anual') || nombre.includes('completo')) {
                    return [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]; // Todo el año
                } else {
                    return [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]; // Por defecto todos los meses
                }
            }

            // Cuando cambia el periodo actual
            periodoActualSelect.addEventListener('change', function() {
                const periodoId = this.value;
                
                if (periodoId && anioIngreso) {
                    const config = periodosConfig[periodoId];
                    if (config) {
                        // Actualizar información del periodo
                        periodoInfo.textContent = `Periodo seleccionado: ${config.nombre}`;
                        tituloCalendario.textContent = `Seleccione los meses trabajados hasta el periodo ${config.nombre}`;
                        
                        // Generar calendario hasta el año del periodo
                        generarCalendario(anioIngreso, config.anio, config.mesesDisponibles);
                        calendarioContainer.style.display = 'block';
                    }
                } else {
                    calendarioContainer.style.display = 'none';
                    periodoInfo.textContent = '';
                }
            });

            // Generar calendario dinámicamente
            function generarCalendario(anioInicio, anioFin, mesesDisponiblesUltimoAnio) {
                seleccionMeses = {}; // Reiniciar selección
                calendarioPeriodos.innerHTML = '';
                
                // Generar array de años desde ingreso hasta año del periodo
                const aniosDesdeIngreso = [];
                for (let year = anioInicio; year <= anioFin; year++) {
                    aniosDesdeIngreso.push(year);
                    seleccionMeses[year] = []; // Inicializar array para cada año
                }

                // Generar HTML para cada año
                aniosDesdeIngreso.forEach(anio => {
                    const esUltimoAnio = anio === anioFin;
                    // En años anteriores, todos los meses están disponibles
                    const mesesParaEsteAnio = esUltimoAnio ? mesesDisponiblesUltimoAnio : [1,2,3,4,5,6,7,8,9,10,11,12];
                    
                    const periodoCard = document.createElement('div');
                    periodoCard.className = 'periodo-card p-3 border mb-3';
                    
                    periodoCard.innerHTML = `
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h6 class="mb-0 text-primary">${anio}</h6>
                            <div class="form-check">
                                <input class="form-check-input selector-anio" 
                                       type="checkbox" 
                                       id="anio_${anio}"
                                       data-anio="${anio}">
                                <label class="form-check-label small" for="anio_${anio}">
                                    Seleccionar todos los meses ${esUltimoAnio ? 'disponibles' : ''}
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            ${generarMeses(anio, mesesParaEsteAnio, esUltimoAnio)}
                        </div>
                    `;
                    
                    calendarioPeriodos.appendChild(periodoCard);
                });

                // Re-asignar eventos después de generar el HTML
                asignarEventosMeses();
                actualizarResumen();
                actualizarInputHidden();
            }

            // Generar HTML para los meses de un año
            function generarMeses(anio, mesesDisponibles, esUltimoAnio) {
                const meses = [
                    [1, 'Ene'], [2, 'Feb'], [3, 'Mar'], [4, 'Abr'],
                    [5, 'May'], [6, 'Jun'], [7, 'Jul'], [8, 'Ago'],
                    [9, 'Sep'], [10, 'Oct'], [11, 'Nov'], [12, 'Dic']
                ];

                return meses.map(([numero, nombre]) => {
                    const estaDisponible = mesesDisponibles.includes(numero);
                    const estilo = !estaDisponible && esUltimoAnio ? 
                        'background-color: #f8f9fa; color: #6c757d; cursor: not-allowed;' : 
                        'cursor: pointer;';
                    
                    return `
                        <div class="col-1 text-center p-1">
                            <div class="mes-calendario border rounded p-2" 
                                 data-anio="${anio}"
                                 data-mes="${numero}"
                                 data-disponible="${estaDisponible}"
                                 style="${estilo}">
                                ${nombre}
                            </div>
                        </div>
                    `;
                }).join('');
            }

            // Asignar eventos a los meses
            function asignarEventosMeses() {
                document.querySelectorAll('.mes-calendario').forEach(mes => {
                    mes.addEventListener('click', function() {
                        const disponible = this.dataset.disponible === 'true';
                        const anio = this.dataset.anio;
                        const mesNum = parseInt(this.dataset.mes);
                        
                        if (!disponible) return;
                        
                        const index = seleccionMeses[anio].indexOf(mesNum);
                        
                        if (index === -1) {
                            // Agregar mes
                            seleccionMeses[anio].push(mesNum);
                            this.style.backgroundColor = '#007bff';
                            this.style.color = 'white';
                        } else {
                            // Quitar mes
                            seleccionMeses[anio].splice(index, 1);
                            this.style.backgroundColor = '';
                            this.style.color = '';
                        }
                        
                        actualizarResumen();
                        actualizarInputHidden();
                    });
                });

                // Selectores de año completo
                document.querySelectorAll('.selector-anio').forEach(selector => {
                    selector.addEventListener('change', function() {
                        const anio = this.dataset.anio;
                        const meses = document.querySelectorAll(`.mes-calendario[data-anio="${anio}"]`);
                        
                        if (this.checked) {
                            // Seleccionar solo meses disponibles del año
                            const mesesDisponibles = Array.from(meses)
                                .filter(mes => mes.dataset.disponible === 'true')
                                .map(mes => parseInt(mes.dataset.mes));
                            
                            seleccionMeses[anio] = [...mesesDisponibles];
                            meses.forEach(mes => {
                                if (mes.dataset.disponible === 'true') {
                                    mes.style.backgroundColor = '#007bff';
                                    mes.style.color = 'white';
                                }
                            });
                        } else {
                            // Deseleccionar todos los meses del año
                            seleccionMeses[anio] = [];
                            meses.forEach(mes => {
                                mes.style.backgroundColor = '';
                                mes.style.color = '';
                            });
                        }
                        
                        actualizarResumen();
                        actualizarInputHidden();
                    });
                });
            }

            function actualizarResumen() {
                const resumen = document.getElementById('resumen-seleccion');
                let html = '';
                let totalMeses = 0;
                
                Object.keys(seleccionMeses).forEach(anio => {
                    if (seleccionMeses[anio].length > 0) {
                        totalMeses += seleccionMeses[anio].length;
                        html += `<div class="mb-1">
                                    <strong>${anio}:</strong> 
                                    <span class="badge bg-primary">${seleccionMeses[anio].length} meses</span>
                                    <small class="text-muted">(${seleccionMeses[anio].sort((a,b) => a-b).join(', ')})</small>
                                </div>`;
                    }
                });
                
                if (totalMeses === 0) {
                    html = '<p class="text-muted mb-0">No hay meses seleccionados</p>';
                } else {
                    html = `<div class="mb-2">
                                <strong>Total meses seleccionados: <span class="badge bg-success">${totalMeses}</span></strong>
                            </div>` + html;
                }
                
                resumen.innerHTML = html;
            }

            function actualizarInputHidden() {
                document.getElementById('periodos_meses').value = JSON.stringify(seleccionMeses);
            }

            // Validación del formulario
            const formAntiguedad = document.getElementById('form-antiguedad');
            if (formAntiguedad) {
                formAntiguedad.addEventListener('submit', function(e) {
                    const periodoActual = document.getElementById('periodo_actual').value;
                    const totalMeses = Object.values(seleccionMeses).flat().length;
                    
                    if (!periodoActual) {
                        e.preventDefault();
                        alert('Por favor seleccione el periodo actual');
                        return;
                    }
                    
                    if (totalMeses === 0) {
                        e.preventDefault();
                        alert('Por favor seleccione al menos un mes trabajado');
                        return;
                    }
                });
            }
        });
document.addEventListener('DOMContentLoaded', function() {
    // Guardar año de ingreso si no existe (usando AJAX)
    const btnGuardarAnio = document.getElementById('btn-guardar-anio');
    if (btnGuardarAnio) {
        btnGuardarAnio.addEventListener('click', function() {
            const anioIngreso = document.getElementById('anio_ingreso').value;
            
            if (!anioIngreso) {
                alert('Por favor ingrese el año de ingreso');
                return;
            }

            // Enviar formulario para guardar el año de ingreso
            const formData = new FormData();
            formData.append('anio_ingreso', anioIngreso);
            formData.append('_token', '{{ csrf_token() }}');

            fetch('{{ route("maestros.actualizar-anio-ingreso", $maestro->id) }}', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert('Error al guardar el año de ingreso');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al guardar el año de ingreso');
            });
        });
    }

    // ... el resto de tu código JavaScript existente
});

    </script>
</body>
</html>