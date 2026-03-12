<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estadísticas de Administrativos - Sistema GEPROC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
    :root {
        --primary: #0744b6ff;
        --secondary: #33CAE6;
        --accent: #26E63F;
        --light-bg: #F8F9FA;
        --border-color: #E9ECEF;
        --text-muted: #6C757D;
        --card-shadow: 0 5px 15px rgba(15, 126, 230, 0.08);
        --transition: all 0.3s ease;
    }

    body { 
        background: white; 
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
        color: #333; 
        line-height: 1.6;
        padding: 0;
        margin: 0;
    }

    .navbar-top { 
        background: white; 
        border-bottom: 1px solid var(--border-color);
        padding: 0.8rem 0;
        position: sticky;
        top: 0;
        z-index: 1000;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }

    .navbar-brand { 
        color: var(--primary) !important; 
        font-weight: 600; 
        font-size: 1.4rem;
        display: flex;
        align-items: center;
        gap: 12px;
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

    .navbar-menu { 
        background: var(--primary); 
        padding: 0.7rem 0;
        position: sticky;
        top: 68px;
        z-index: 999;
    }

    .navbar-menu .nav-link {
        font-weight: 500;
        color: rgba(255, 255, 255, 0.9) !important;
        padding: 0.6rem 1.5rem !important;
        border-radius: 4px;
        transition: var(--transition);
    }

    .navbar-menu .nav-link:hover, 
    .navbar-menu .nav-link.active {
        color: white !important;
        background-color: rgba(255, 255, 255, 0.12);
    }

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

    .navbar-menu .logout-btn {
        background: transparent;
        border: 1px solid rgba(255, 255, 255, 0.4);
        color: rgba(255, 255, 255, 0.9);
        padding: 0.4rem 1rem;
        border-radius: 4px;
        transition: var(--transition);
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.9rem;
    }

    .navbar-menu .logout-btn:hover {
        background: rgba(255, 255, 255, 0.1);
        color: white;
    }

    .main-content { 
        padding: 30px 20px;
        min-height: calc(100vh - 140px);
    }

    .content-container {
        background: white;
        border-radius: 6px;
        padding: 2rem;
        margin-bottom: 2rem;
        border: 1px solid var(--border-color);
        box-shadow: var(--card-shadow);
        max-width: 1200px;
        margin: 0 auto;
    }

    h2 { 
        color: var(--primary);
        margin-bottom: 1rem; 
        padding-bottom: 0.8rem;
        position: relative;
        font-size: 1.5rem;
    }
    
    h2::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 50px;
        height: 2px;
        background: var(--primary);
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .back-btn {
        background: white;
        border: 1px solid var(--border-color);
        color: var(--text-muted);
        padding: 0.5rem 1.2rem;
        border-radius: 4px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: var(--transition);
    }

    .back-btn:hover {
        background: var(--light-bg);
        color: var(--primary);
        border-color: var(--primary);
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: white;
        padding: 1.5rem;
        border-radius: 8px;
        text-align: center;
        border: 1px solid var(--border-color);
        box-shadow: var(--card-shadow);
    }

    .stat-icon {
        font-size: 2.5rem;
        margin-bottom: 1rem;
    }

    .stat-value {
        font-size: 2rem;
        font-weight: 700;
        color: var(--primary);
        line-height: 1.2;
    }

    .stat-label {
        color: var(--text-muted);
        font-size: 0.9rem;
    }

    .charts-container {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 2rem;
        margin: 2rem 0;
    }

    .chart-card {
        background: white;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        padding: 1.5rem;
    }

    .chart-title {
        font-weight: 600;
        color: var(--primary);
        margin-bottom: 1rem;
        text-align: center;
    }

    .chart-wrapper {
        height: 300px;
        position: relative;
    }

    .summary-section {
        background: var(--light-bg);
        border: 1px solid var(--border-color);
        border-radius: 8px;
        padding: 1.5rem;
        margin-top: 2rem;
    }

    .summary-title {
        font-weight: 600;
        color: var(--primary);
        margin-bottom: 1rem;
    }

    .summary-list {
        list-style: none;
        padding: 0;
    }

    .summary-item {
        padding: 0.75rem 0;
        border-bottom: 1px solid var(--border-color);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .summary-item:last-child {
        border-bottom: none;
    }

    .summary-label {
        font-weight: 500;
    }

    .summary-value {
        font-weight: 600;
        color: var(--primary);
    }

    .badge {
        padding: 0.25rem 0.5rem;
        border-radius: 4px;
        font-size: 0.75rem;
    }

    .badge-success {
        background: #d1fae5;
        color: #065f46;
    }

    .badge-warning {
        background: #fed7aa;
        color: #9a3412;
    }

    .badge-danger {
        background: #fee2e2;
        color: #991b1b;
    }

    .badge-info {
        background: #dbeafe;
        color: #1e40af;
    }

    @media (max-width: 768px) {
        .charts-container {
            grid-template-columns: 1fr;
        }
        
        .stats-grid {
            grid-template-columns: 1fr;
        }
    }
    </style>
</head>
<body>
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

    <nav class="navbar navbar-expand-lg navbar-menu">
        <div class="container">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('coordinaciones.index') }}">Coordinaciones</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('maestros.index') }}">Maestros</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('contracts.index') }}">Contratos</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('users.index') }}">Accesos</a></li>
                    <li class="nav-item"><a class="nav-link active" href="{{ route('admin.administrativos.index') }}">Administrativos</a></li>
                </ul>
                
                <div class="user-info-container">
                    <div class="user-info">
                        <span class="user-name">{{ Auth::user()->name }}</span>
                        <div class="user-avatar">
                            <i class="fas fa-user-circle"></i>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="logout-btn">
                            <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12 main-content">
                <div class="content-container">
                    <div class="page-header">
                        <h2>
                            <i class="fas fa-chart-bar me-2"></i>
                            Estadísticas de Administrativos
                        </h2>
                        <a href="{{ route('admin.administrativos.index') }}" class="back-btn">
                            <i class="fas fa-arrow-left"></i> Volver al listado
                        </a>
                    </div>

                    <div class="stats-grid">
                        <div class="stat-card">
                            <div class="stat-icon text-primary">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="stat-value">{{ $total }}</div>
                            <div class="stat-label">Total Administrativos</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon text-success">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="stat-value">{{ $documentosAprobados }}</div>
                            <div class="stat-label">Documentos Aprobados</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon text-warning">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="stat-value">{{ $documentosPendientes }}</div>
                            <div class="stat-label">Documentos Pendientes</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon text-danger">
                                <i class="fas fa-times-circle"></i>
                            </div>
                            <div class="stat-value">{{ $documentosRechazados }}</div>
                            <div class="stat-label">Documentos Rechazados</div>
                        </div>
                    </div>

                    <div class="charts-container">
                        <!-- Gráfico de Estado de Documentos -->
                        <div class="chart-card">
                            <h4 class="chart-title">Estado de Documentos</h4>
                            <div class="chart-wrapper">
                                <canvas id="documentosChart"></canvas>
                            </div>
                        </div>

                        <!-- Gráfico de Documentos por Tipo -->
                        <div class="chart-card">
                            <h4 class="chart-title">Documentos por Tipo</h4>
                            <div class="chart-wrapper">
                                <canvas id="tiposChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="summary-section">
                        <h4 class="summary-title">Resumen General</h4>
                        <ul class="summary-list">
                            <li class="summary-item">
                                <span class="summary-label">Administrativos con documentos completos:</span>
                                <span class="summary-value">
                                    {{ $completos }}
                                    <span class="badge badge-success">
                                        {{ $total > 0 ? round(($completos / $total) * 100) : 0 }}%
                                    </span>
                                </span>
                            </li>
                            <li class="summary-item">
                                <span class="summary-label">Promedio de documentos por administrativo:</span>
                                <span class="summary-value">
                                    {{ $total > 0 ? round(($documentosAprobados + $documentosPendientes + $documentosRechazados) / $total, 1) : 0 }}
                                </span>
                            </li>
                            <li class="summary-item">
                                <span class="summary-label">Documentos por tipo:</span>
                                <span class="summary-value">
                                    <div class="mt-2">
                                        @foreach($documentosPorTipo as $tipo => $cantidad)
                                            <div class="d-flex justify-content-between mb-1">
                                                <span>
                                                    @if($tipo == 'identificacion_oficial')
                                                        <i class="fas fa-id-card"></i> Identificación:
                                                    @elseif($tipo == 'comprobante_domicilio')
                                                        <i class="fas fa-home"></i> Comprobante:
                                                    @elseif($tipo == 'curriculum')
                                                        <i class="fas fa-file-alt"></i> Currículum:
                                                    @elseif($tipo == 'acta_nacimiento')
                                                        <i class="fas fa-file"></i> Acta:
                                                    @endif
                                                </span>
                                                <span class="fw-bold">{{ $cantidad }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Gráfico de Estado de Documentos
        const documentosCtx = document.getElementById('documentosChart').getContext('2d');
        new Chart(documentosCtx, {
            type: 'doughnut',
            data: {
                labels: ['Aprobados', 'Pendientes', 'Rechazados'],
                datasets: [{
                    data: [
                        {{ $documentosAprobados }},
                        {{ $documentosPendientes }},
                        {{ $documentosRechazados }}
                    ],
                    backgroundColor: [
                        '#28a745',
                        '#ffc107',
                        '#dc3545'
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        // Gráfico de Documentos por Tipo
        const tiposCtx = document.getElementById('tiposChart').getContext('2d');
        new Chart(tiposCtx, {
            type: 'bar',
            data: {
                labels: [
                    'Identificación',
                    'Comprobante',
                    'Currículum',
                    'Acta'
                ],
                datasets: [{
                    data: [
                        {{ $documentosPorTipo['identificacion_oficial'] ?? 0 }},
                        {{ $documentosPorTipo['comprobante_domicilio'] ?? 0 }},
                        {{ $documentosPorTipo['curriculum'] ?? 0 }},
                        {{ $documentosPorTipo['acta_nacimiento'] ?? 0 }}
                    ],
                    backgroundColor: '#0744b6',
                    borderRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>