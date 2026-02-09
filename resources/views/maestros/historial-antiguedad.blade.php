<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Antigüedad</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-info text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">
                                <i class="fas fa-history me-2"></i>
                                Historial de Antigüedad - {{ $maestro->nombres }} {{ $maestro->apellido_paterno }} {{ $maestro->apellido_materno }}
                            </h4>
                            <div>
                                <a href="{{ route('maestros.calcular-antiguedad', $maestro) }}" class="btn btn-light btn-sm me-2">
                                    <i class="fas fa-plus me-1"></i> Nuevo Cálculo
                                </a>
                                <a href="{{ route('maestros.show', $maestro) }}" class="btn btn-light btn-sm">
                                    <i class="fas fa-arrow-left me-1"></i> Volver
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Nota informativa -->
                        <div class="alert alert-info mb-4">
                            <strong>Nota:</strong> Este cálculo considera SOLO los periodos y meses seleccionados en el formulario.
                        </div>

                        <!-- Resumen de Antigüedad -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="card border-success">
                                    <div class="card-header bg-success text-white">
                                        <h5 class="mb-0">
                                            <i class="fas fa-chart-bar me-2"></i>
                                            Resumen General de Antigüedad
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <!-- Año de ingreso -->
                                        <div class="alert alert-primary mb-4">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-calendar-check fa-2x me-3"></i>
                                                <div>
                                                    <h6 class="mb-1">Año de Ingreso: <strong>{{ $antiguedad['anio_ingreso'] }}</strong></h6>
                                                    <p class="mb-0">Cálculo basado en los meses trabajados registrados en el sistema</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row text-center mb-4">
                                            <div class="col-md-3 mb-3">
                                                <div class="border rounded p-3 bg-light h-100">
                                                    <h6 class="text-muted">Total Meses Trabajados</h6>
                                                    <h2 class="text-primary display-6">{{ $antiguedad['total_meses_trabajados'] }}</h2>
                                                    <small class="text-muted">meses acumulados</small>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <div class="border rounded p-3 bg-light h-100">
                                                    <h6 class="text-muted">Años Completos</h6>
                                                    <h2 class="text-success display-6">{{ $antiguedad['anios'] }}</h2>
                                                    <small class="text-muted">años de servicio</small>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <div class="border rounded p-3 bg-light h-100">
                                                    <h6 class="text-muted">Meses Adicionales</h6>
                                                    <h2 class="text-warning display-6">{{ $antiguedad['meses'] }}</h2>
                                                    <small class="text-muted">meses adicionales</small>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <div class="border rounded p-3 bg-primary text-white h-100">
                                                    <h6 class="mb-2">Antigüedad Total</h6>
                                                    <h4 class="mb-0">{{ $antiguedad['anios'] }} años y {{ $antiguedad['meses'] }} meses</h4>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Detalle de Periodos del Historial -->
                                        @if(isset($antiguedad['detalle_periodos']) && count($antiguedad['detalle_periodos']) > 0)
                                        <div class="mt-4">
                                            <h6 class="text-muted mb-3">
                                                <i class="fas fa-list me-2"></i>Detalle de Periodos Registrados ({{ count($antiguedad['detalle_periodos']) }} periodos)
                                            </h6>
                                            <div class="card">
                                                <div class="card-body">
                                                    @foreach($antiguedad['detalle_periodos'] as $detalle)
                                                    <div class="mb-3">
                                                        <strong class="text-primary">Año {{ $detalle['anio'] }}:</strong>
                                                        <span class="badge bg-primary ms-2">{{ $detalle['total_meses'] }} mes(es)</span>
                                                        <div class="mt-1">
                                                            <small class="text-muted">
                                                                @if(isset($detalle['meses_nombres']) && count($detalle['meses_nombres']) > 0)
                                                                    ({{ implode(', ', $detalle['meses_nombres']) }})
                                                                @else
                                                                    (No especificado)
                                                                @endif
                                                            </small>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tabla de Períodos -->
                        @if($periodosTrabajados->count() > 0)
                        <div class="card mt-4">
                            <div class="card-header bg-light">
                                <h5 class="mb-0"><i class="fas fa-table me-2"></i>Detalle de Períodos Registrados</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>Período</th>
                                                <th>Año</th>
                                                <th>Meses Trabajados</th>
                                                <th>Total Meses</th>
                                                <th>Fecha Registro</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $nombresMeses = [
                                                    1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
                                                    5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
                                                    9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
                                                ];
                                            @endphp
                                            @foreach($periodosTrabajados as $periodo)
                                            <tr>
                                                <td>
                                                    <strong>{{ $periodo->nombre }}</strong>
                                                </td>
                                                <td>
                                                    <span class="badge bg-info fs-6">{{ $periodo->pivot->anio_periodo }}</span>
                                                </td>
                                                <td>
                                                    @php
                                                        $meses = json_decode($periodo->pivot->meses_trabajados, true) ?? [];
                                                        $mesesNombres = array_map(function($mes) use ($nombresMeses) {
                                                            return $nombresMeses[$mes] ?? $mes;
                                                        }, $meses);
                                                    @endphp
                                                    <small class="text-muted">
                                                        {{ implode(', ', $mesesNombres) }}
                                                    </small>
                                                </td>
                                                <td>
                                                    <span class="badge bg-primary fs-6">{{ $periodo->pivot->total_meses }} meses</span>
                                                </td>
                                                <td>
                                                    <small>{{ $periodo->pivot->created_at->format('d/m/Y H:i') }}</small>
                                                </td>
                                                <td>
                                                    <form action="{{ route('maestros.eliminar-periodo', $maestro) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="hidden" name="periodo_id" value="{{ $periodo->id }}">
                                                        <input type="hidden" name="anio_periodo" value="{{ $periodo->pivot->anio_periodo }}">
                                                        <button type="submit" class="btn btn-danger btn-sm" 
                                                                onclick="return confirm('¿Está seguro de eliminar este período?')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="text-center py-5">
                            <i class="fas fa-inbox fa-4x text-muted mb-3"></i>
                            <h4 class="text-muted">No hay períodos registrados</h4>
                            <p class="text-muted">Comience agregando el primer período de trabajo.</p>
                            <a href="{{ route('maestros.calcular-antiguedad', $maestro) }}" class="btn btn-primary btn-lg">
                                <i class="fas fa-plus me-2"></i> Agregar Primer Período
                            </a>
                        </div>
                        @endif

                        <!-- Estadísticas y Información Adicional -->
                        @if($periodosTrabajados->count() > 0)
                        <div class="row mt-4">
                            <div class="col-md-4">
                                <div class="card bg-primary text-white">
                                    <div class="card-body text-center">
                                        <i class="fas fa-sign-in-alt fa-2x mb-2"></i>
                                        <h6>Año de Ingreso</h6>
                                        <h3 class="mb-0">{{ $antiguedad['anio_ingreso'] }}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card bg-success text-white">
                                    <div class="card-body text-center">
                                        <i class="fas fa-calendar-day fa-2x mb-2"></i>
                                        <h6>Total Períodos</h6>
                                        <h3 class="mb-0">{{ $periodosTrabajados->count() }}</h3>
                                        <small>registrados</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card bg-info text-white">
                                    <div class="card-body text-center">
                                        <i class="fas fa-history fa-2x mb-2"></i>
                                        <h6>Años Cubiertos</h6>
                                        <h3 class="mb-0">{{ $periodosTrabajados->unique('pivot.anio_periodo')->count() }}</h3>
                                        <small>años diferentes</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Información Adicional -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="alert alert-info">
                                    <div class="d-flex">
                                        <div class="me-3">
                                            <i class="fas fa-info-circle fa-2x"></i>
                                        </div>
                                        <div>
                                            <h6 class="alert-heading">¿Cómo se calcula la antigüedad?</h6>
                                            <p class="mb-2">La antigüedad se calcula sumando <strong>únicamente los meses trabajados</strong> que han sido registrados en los diferentes periodos. Cada periodo registrado contribuye con los meses específicos que fueron seleccionados como trabajados.</p>
                                            <p class="mb-0"><strong>Fórmula:</strong> Total meses trabajados ÷ 12 = Años completos + Meses restantes</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>