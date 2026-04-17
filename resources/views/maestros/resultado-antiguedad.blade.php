<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado de Antigüedad</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">
                            Resultado de Cálculo - {{ $maestro->nombres }} {{ $maestro->apellido_paterno }} {{ $maestro->apellido_materno }}
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info">
                            <strong>Periodo:</strong> {{ $periodo->nombre }} | 
                            <strong>Año del periodo:</strong> {{ $anioPeriodo }}
                        </div>
                        
                        <div class="card">
                            <div class="card-header bg-success text-white">
                                <h5 class="mb-0">Resultado del Cálculo</h5>
                            </div>
                            <div class="card-body">
                                <div class="alert alert-warning">
                                    <strong>Nota:</strong> Este cálculo considera SOLO los periodos y meses seleccionados en el formulario.
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card bg-light">
                                            <div class="card-body text-center">
                                                <h4 class="text-primary">{{ $antiguedad['anios'] }} Años</h4>
                                                <h4 class="text-secondary">{{ $antiguedad['meses'] }} Meses</h4>
                                                <p class="mb-0 text-muted">Total meses trabajados: {{ $antiguedad['total_meses'] }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h6>Detalle de Periodos Seleccionados:</h6>
                                        @foreach($antiguedad['detalle_periodos'] as $detalle)
                                        <div class="border-bottom pb-2 mb-2">
                                            <strong>Año {{ $detalle['anio'] }}:</strong> 
                                            <span class="badge bg-primary">{{ $detalle['total_meses'] }} meses</span>
                                            <br>
                                            <small class="text-muted">({{ implode(', ', $detalle['meses_nombres']) }})</small>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <a href="{{ route('maestros.calcular-antiguedad', $maestro) }}" class="btn btn-primary">
                                Calcular Nuevamente
                            </a>
                            <a href="{{ route('maestros.historial-antiguedad', $maestro) }}" class="btn btn-info">
                                Ver Historial Completo
                            </a>
                            <a href="{{ route('maestros.show', $maestro) }}" class="btn btn-secondary">
                                Volver al Maestro
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>