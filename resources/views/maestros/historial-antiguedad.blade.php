<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Antigüedad - {{ $maestro->nombres }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
            background: #f8f9fa; 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            color: #333; 
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }
        
        /* ========== ESTILOS DE BARRA Y MENÚ ========== */

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
        
        /* ========== ESTILOS PARA EL CONTENIDO PRINCIPAL ========== */
        .main-content {
            padding: 30px;
        }
        
        .profile-header {
            background: white;
            border-radius: 12px;
            padding: 20px 25px;
            margin-bottom: 25px;
            box-shadow: var(--card-shadow);
            border-left: 5px solid var(--primary);
        }
        
        .section-card {
            background: white;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            margin-bottom: 25px;
            border: none;
            overflow: hidden;
            border-left: 4px solid var(--primary);
        }
        
        .section-card .card-header {
            background-color: white;
            color: var(--primary);
            padding: 15px 20px;
            border-bottom: 1px solid var(--border-color);
        }
        
        .section-card .card-body {
            padding: 25px;
        }
        
        .badge-coordinacion {
            background-color: var(--primary);
            color: white;
            font-size: 0.9rem;
        }
        
        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
        }
        
        .btn-primary:hover {
            background-color: #063a9e;
            border-color: #063a9e;
        }
        
        .btn-outline-primary {
            color: var(--primary);
            border-color: var(--primary);
        }
        
        .btn-outline-primary:hover {
            background-color: var(--primary);
            border-color: var(--primary);
        }
        
        .text-primary {
            color: var(--primary) !important;
        }
        
        .border-primary {
            border-color: var(--primary) !important;
        }
        
        .bg-primary {
            background-color: var(--primary) !important;
        }
        
        .action-dropdown .dropdown-menu {
            min-width: 200px;
        }
        
        .antiguedad-card {
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            background: white;
        }
        
        .antiguedad-card.primary {
            border-left: 4px solid var(--primary);
        }
        
        .antiguedad-card.success {
            border-left: 4px solid var(--success-color);
        }
        
        .antiguedad-card.warning {
            border-left: 4px solid var(--warning-color);
        }
        
        .summary-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
            border: 1px solid #e9ecef;
            height: 100%;
        }
        
        .summary-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0,0,0,0.15);
        }
        
        .summary-card i {
            font-size: 2rem;
            margin-bottom: 10px;
            color: var(--primary);
        }
        
        .summary-card h5 {
            font-size: 0.9rem;
            color: #6c757d;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .summary-card h2 {
            font-size: 2.2rem;
            font-weight: 700;
            margin: 0;
            color: #343a40;
        }
        
        .summary-card.primary { border-top: 4px solid var(--primary); }
        .summary-card.success { border-top: 4px solid var(--success-color); }
        .summary-card.warning { border-top: 4px solid var(--warning-color); }
        
        .summary-total {
            background: linear-gradient(135deg, var(--primary), #063a9e);
            color: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            height: 100%;
        }
        
        .summary-total h4 {
            font-size: 1.8rem;
            margin-bottom: 0;
        }
        
        .badge {
            padding: 6px 12px;
            font-weight: 500;
            font-size: 0.85rem;
        }
        
        .table-responsive {
            border-radius: 8px;
            border: 1px solid #e9ecef;
            overflow: hidden;
        }
        
        .table th {
            background-color: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
            font-weight: 600;
            color: #495057;
            padding: 12px 15px;
        }
        
        .table td {
            vertical-align: middle;
            padding: 12px 15px;
            border-top: 1px solid #e9ecef;
        }
        
        .table tbody tr:hover {
            background-color: #f8f9fa;
        }
        
        .alert-info {
            background-color: rgba(7, 68, 182, 0.05);
            border-color: var(--primary);
            color: #333;
        }
        
        .alert-info strong {
            color: var(--primary);
        }
        
        @media (max-width: 768px) {
            .main-content { padding: 15px; }
            .summary-card { margin-bottom: 15px; }
            .summary-card h2 { font-size: 1.8rem; }
            .table-responsive { font-size: 0.85rem; }
        }
    </style>
</head>
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
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.administrativos.*') ? 'active' : '' }}"href="{{ route('admin.administrativos.index') }}">Administrativos</a></ul>
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
    
    <div class="container-fluid p-0">
        <!-- Main Content -->
        <div class="main-content">
            <!-- Botones de acción -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <a href="{{ route('maestros.show', $maestro) }}" class="btn btn-outline-primary">
                        <i class="fas fa-arrow-left"></i> Volver al perfil
                    </a>
                </div>
            </div>

            <!-- Título de la sección -->
            <div class="d-flex align-items-center mb-4">
                <i class="fas fa-history fa-2x text-primary me-3"></i>
                <div>
                    <h3 class="mb-0">Historial de Antigüedad Docente</h3>
                    <h3 class="mb-0">{{ $maestro->nombres }} {{ $maestro->apellido_paterno }} {{ $maestro->apellido_materno }}</h3>
                    <p class="text-muted mb-0">Registro de periodos trabajados y cálculo de antigüedad acumulada</p>
                </div>
            </div>

            <!-- Resumen de Antigüedad -->
            @if(isset($antiguedad) && $antiguedad['total_meses_trabajados'] > 0)
            <div class="section-card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-chart-bar me-2"></i>Resumen General de Antigüedad</h5>
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

                    <div class="row mb-4">
                        <div class="col-md-3 mb-3">
                            <div class="summary-card primary">
                                <i class="fas fa-calendar-alt"></i>
                                <h5>Total Meses</h5>
                                <h2>{{ $antiguedad['total_meses_trabajados'] }}</h2>
                                <small class="text-muted">meses acumulados</small>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="summary-card success">
                                <i class="fas fa-calendar-check"></i>
                                <h5>Años Completos</h5>
                                <h2>{{ $antiguedad['anios'] }}</h2>
                                <small class="text-muted">años</small>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="summary-card warning">
                                <i class="fas fa-calendar-plus"></i>
                                <h5>Meses Adicionales</h5>
                                <h2>{{ $antiguedad['meses'] }}</h2>
                                <small class="text-muted">meses</small>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="summary-total">
                                <i class="fas fa-star mb-2"></i>
                                <h5 class="text-white-50">Antigüedad Total</h5>
                                <h4>{{ $antiguedad['anios'] }} años {{ $antiguedad['meses'] }} meses</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Tabla de Períodos -->
            <div class="section-card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><i class="fas fa-table me-2"></i>Períodos Registrados</h5>
                        <a href="{{ route('maestros.calcular-antiguedad', $maestro) }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-plus me-1"></i> Calcular Antiguedad
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if($periodosTrabajados->count() > 0)
                        @php
                            $nombresMeses = [
                                1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
                                5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
                                9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
                            ];
                        @endphp
                        
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
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
                                                {{ implode(', ', array_slice($mesesNombres, 0, 3)) }}
                                                @if(count($mesesNombres) > 3)
                                                    ... ({{ count($mesesNombres) }} meses)
                                                @endif
                                            </small>
                                        </td>
                                        <td>
                                            <span class="badge bg-primary">{{ $periodo->pivot->total_meses }} meses</span>
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
                                                        onclick="return confirm('¿Está seguro de eliminar este período?')"
                                                        title="Eliminar período">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-inbox fa-4x text-muted mb-3"></i>
                            <h4 class="text-muted">No hay períodos registrados</h4>
                            <p class="text-muted mb-4">Comience agregando el primer período de trabajo.</p>
                            <a href="{{ route('maestros.calcular-antiguedad', $maestro) }}" class="btn btn-primary btn-lg">
                                <i class="fas fa-plus me-2"></i> Calcular Antiguedad
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Información sobre el cálculo -->
            <div class="alert alert-info">
                <div class="d-flex">
                    <div class="me-3">
                        <i class="fas fa-info-circle fa-2x"></i>
                    </div>
                    <div>
                        <h6 class="alert-heading">¿Cómo se calcula la antigüedad?</h6>
                        <p class="mb-0">La antigüedad se calcula sumando únicamente los meses trabajados registrados en los diferentes periodos. Cada periodo contribuye con los meses específicos seleccionados. Total meses trabajados ÷ 12 = Años completos + Meses restantes.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Script para el botón de colapsar detalle
        document.addEventListener('DOMContentLoaded', function() {
            const toggleBtn = document.querySelector('[data-bs-target="#detallePeriodos"]');
            if (toggleBtn) {
                toggleBtn.addEventListener('click', function() {
                    const icon = this.querySelector('.fa-chevron-down, .fa-chevron-up');
                    if (icon) {
                        if (icon.classList.contains('fa-chevron-down')) {
                            icon.classList.remove('fa-chevron-down');
                            icon.classList.add('fa-chevron-up');
                        } else {
                            icon.classList.remove('fa-chevron-up');
                            icon.classList.add('fa-chevron-down');
                        }
                    }
                });
            }
        });
    </script>
</body>
</html>