<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Horarios - Sistema de Nómina</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title mb-0">📅 Gestión de Horarios</h3>
                    </div>
                    <div class="card-body">
                        <!-- Lista de Maestros -->
                        <div class="row">
                            @foreach($maestros as $maestro)
                                <div class="col-md-6 col-lg-4 mb-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $maestro->nombre_completo }}</h5>
                                            <p class="card-text">
                                                <small class="text-muted">
                                                    {{ $maestro->titulo }}<br>
                                                    {{ $maestro->email }}
                                                </small>
                                            </p>
                                            <div class="d-grid gap-2">
                                                <a href="{{ route('horarios.formulario', $maestro->id) }}" 
                                                   class="btn btn-primary btn-sm">
                                                    ✏️ Ingresar Horario
                                                </a>
                                                <a href="{{ route('horarios.ver', $maestro->id) }}" 
                                                   class="btn btn-outline-secondary btn-sm">
                                                    👁️ Ver Horario
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        @if($maestros->isEmpty())
                            <div class="alert alert-info text-center">
                                <h5>📋 No hay maestros activos</h5>
                                <p class="mb-0">No se encontraron maestros activos en el sistema.</p>
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