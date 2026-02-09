<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Horario - {{ $maestro->nombre_completo }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .table-horarios {
            font-size: 0.9rem;
        }
        .table-horarios th {
            background-color: #343a40;
            color: white;
            text-align: center;
        }
        .materia-badge {
            font-size: 0.75rem;
            padding: 3px 6px;
            border-radius: 4px;
            color: white;
            font-weight: bold;
        }
        .resumen-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        .hora-cell {
            text-align: center;
            padding: 8px 4px;
        }
        .celda-ocupada {
            background-color: #e8f5e8;
            border: 1px solid #28a745;
        }
    </style>
</head>
<body>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h3 class="card-title mb-1">📊 Horario - {{ $maestro->nombre_completo }}</h3>
                                <p class="card-subtitle mb-0">
                                    <small>{{ $maestro->titulo }} | {{ $maestro->email }}</small>
                                </p>
                            </div>
                            <a href="{{ route('horarios.index') }}" class="btn btn-light btn-sm">
                                ← Volver
                            </a>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <!-- Selector de Periodo -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="periodo_select" class="form-label">Seleccionar Periodo</label>
                                <select id="periodo_select" class="form-select" onchange="cambiarPeriodo(this.value)">
                                    @foreach($periodos as $periodo)
                                        <option value="{{ $periodo->id }}" {{ $periodoId == $periodo->id ? 'selected' : '' }}>
                                            {{ $periodo->nombre }} ({{ $periodo->codigo }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 d-flex align-items-end">
                                <a href="{{ route('horarios.formulario', $maestro->id) }}" class="btn btn-success">
                                    ✏️ Editar Horario
                                </a>
                            </div>
                        </div>

                        @if($periodoId)
                            <!-- Resumen de Horas -->
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <div class="card resumen-card">
                                        <div class="card-body">
                                            <div class="row text-center">
                                                <div class="col">
                                                    <small>Total Horas Semana</small>
                                                    <div class="h4 fw-bold">{{ $resumenHoras['total_horas_semanales'] ?? 0 }}</div>
                                                </div>
                                                <div class="col">
                                                    <small>Lunes</small>
                                                    <div class="h5 fw-bold">{{ $resumenHoras['Lunes']['horas'] ?? 0 }}</div>
                                                </div>
                                                <div class="col">
                                                    <small>Martes</small>
                                                    <div class="h5 fw-bold">{{ $resumenHoras['Martes']['horas'] ?? 0 }}</div>
                                                </div>
                                                <div class="col">
                                                    <small>Miércoles</small>
                                                    <div class="h5 fw-bold">{{ $resumenHoras['Miercoles']['horas'] ?? 0 }}</div>
                                                </div>
                                                <div class="col">
                                                    <small>Jueves</small>
                                                    <div class="h5 fw-bold">{{ $resumenHoras['Jueves']['horas'] ?? 0 }}</div>
                                                </div>
                                                <div class="col">
                                                    <small>Viernes</small>
                                                    <div class="h5 fw-bold">{{ $resumenHoras['Viernes']['horas'] ?? 0 }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Tabla de Horarios -->
                            <div class="table-responsive">
                                <table class="table table-bordered table-horarios">
                                    <thead>
                                        <tr>
                                            <th style="width: 15%">Horario</th>
                                            <th style="width: 17%">Lunes</th>
                                            <th style="width: 17%">Martes</th>
                                            <th style="width: 17%">Miércoles</th>
                                            <th style="width: 17%">Jueves</th>
                                            <th style="width: 17%">Viernes</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $horasDisponibles = ['7-8', '8-9', '9-10', '10-11', '11-12', '12-13', '13-14', '14-15', '15-16', '16-17', '17-18'];
                                            $diasSemana = ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes'];
                                        @endphp

                                        @foreach($horasDisponibles as $hora)
                                            <tr>
                                                <td class="fw-bold text-center bg-light">{{ $hora }}</td>
                                                @foreach($diasSemana as $dia)
                                                    @php
                                                        $claseEnEstaHora = collect($horarioCompleto[$dia] ?? [])
                                                            ->firstWhere('horario', $hora);
                                                    @endphp
                                                    <td class="hora-cell {{ $claseEnEstaHora ? 'celda-ocupada' : '' }}">
                                                        @if($claseEnEstaHora)
                                                            <div class="materia-badge" style="background-color: #28a745;">
                                                                {{ substr($claseEnEstaHora->materia_nombre, 0, 3) }}
                                                            </div>
                                                            <small class="d-block mt-1">
                                                                <strong>{{ $claseEnEstaHora->materia_nombre }}</strong>
                                                            </small>
                                                            <small class="d-block text-muted">
                                                                Aula: {{ $claseEnEstaHora->aula }}
                                                            </small>
                                                            <small class="d-block text-muted">
                                                                Grupo: {{ $claseEnEstaHora->grupo }}
                                                            </small>
                                                        @else
                                                            <span class="text-muted">-</span>
                                                        @endif
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Detalles por Día -->
                            <div class="row mt-4">
                                @foreach($diasSemana as $dia)
                                    @if(isset($resumenHoras[$dia]['clases']) && count($resumenHoras[$dia]['clases']) > 0)
                                        <div class="col-md-12 mb-3">
                                            <div class="card">
                                                <div class="card-header bg-info text-white">
                                                    <h6 class="mb-0">📅 {{ $dia }} - {{ $resumenHoras[$dia]['horas'] }} horas</h6>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        @foreach($resumenHoras[$dia]['clases'] as $clase)
                                                            <div class="col-md-6 col-lg-4 mb-2">
                                                                <div class="card">
                                                                    <div class="card-body py-2">
                                                                        <h6 class="card-title mb-1">{{ $clase['materia'] }}</h6>
                                                                        <p class="card-text mb-1">
                                                                            <small class="text-muted">
                                                                                Horario: {{ $clase['horario'] }} | 
                                                                                Aula: {{ $clase['aula'] }} | 
                                                                                Grupo: {{ $clase['grupo'] }}
                                                                            </small>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>

                        @else
                            <!-- Mensaje cuando no hay periodo seleccionado -->
                            <div class="alert alert-warning text-center">
                                <h5>⚠️ No hay periodos activos</h5>
                                <p class="mb-0">No se encontraron periodos académicos activos para mostrar el horario.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        function cambiarPeriodo(periodoId) {
            const url = new URL(window.location.href);
            url.searchParams.set('periodo', periodoId);
            window.location.href = url.toString();
        }

        // También puedes agregar esta función para manejar cambios automáticos
        document.getElementById('periodo_select').addEventListener('change', function() {
            cambiarPeriodo(this.value);
        });
    </script>
</body>
</html>