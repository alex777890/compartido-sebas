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
            --primary-dark: #053a8a;
            --primary-light: #3a6bd3;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --info: #3b82f6;
            --light-bg: #F8F9FC;
            --border-color: #E9ECEF;
            --text-muted: #6C757D;
            --card-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.02);
            --transition: all 0.3s ease;
        }

        body { 
            background: #F5F7FB; 
            font-family: 'Inter', 'Segoe UI', sans-serif; 
            color: #1E293B; 
            line-height: 1.5;
        }

        /* Navbar Superior */
        .navbar-top { 
            background: white; 
            border-bottom: 1px solid var(--border-color);
            padding: 0.8rem 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            backdrop-filter: blur(10px);
        }

        .navbar-brand { 
            color: var(--primary) !important; 
            font-weight: 700; 
            font-size: 1.3rem;
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
            height: 45px;
            width: auto;
        }

        /* Navbar Menu */
        .navbar-menu { 
            background: var(--primary); 
            padding: 0.5rem 0;
            position: sticky;
            top: 65px;
            z-index: 999;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .navbar-menu .nav-link {
            font-weight: 500;
            color: rgba(255, 255, 255, 0.85) !important;
            padding: 0.5rem 1.2rem !important;
            border-radius: 8px;
            transition: var(--transition);
            font-size: 0.9rem;
        }

        .navbar-menu .nav-link:hover, 
        .navbar-menu .nav-link.active {
            color: white !important;
            background-color: rgba(255, 255, 255, 0.15);
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

        .navbar-menu .user-name {
            font-weight: 500;
            font-size: 0.9rem;
        }

        .navbar-menu .logout-btn {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
            padding: 0.4rem 1rem;
            border-radius: 8px;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.85rem;
        }

        .navbar-menu .logout-btn:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        /* Main Content */
        .main-content { 
            padding: 30px 20px;
            min-height: calc(100vh - 115px);
        }

        .content-container {
            max-width: 1400px;
            margin: 0 auto;
        }

        /* Header */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .page-header h2 {
            font-size: 1.8rem;
            font-weight: 700;
            color: #0F172A;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .page-header h2 i {
            color: var(--primary);
            font-size: 1.8rem;
        }

        .back-btn {
            background: white;
            border: 1px solid var(--border-color);
            color: var(--text-muted);
            padding: 0.6rem 1.2rem;
            border-radius: 10px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-weight: 500;
            transition: var(--transition);
        }

        .back-btn:hover {
            background: var(--light-bg);
            color: var(--primary);
            border-color: var(--primary);
            transform: translateY(-2px);
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            padding: 1.5rem;
            border-radius: 20px;
            border: 1px solid var(--border-color);
            box-shadow: var(--card-shadow);
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: var(--primary);
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 30px -12px rgba(0, 0, 0, 0.1);
        }

        .stat-icon {
            font-size: 2.2rem;
            margin-bottom: 1rem;
        }

        .stat-value {
            font-size: 2.2rem;
            font-weight: 700;
            color: #0F172A;
            line-height: 1.2;
        }

        .stat-label {
            color: var(--text-muted);
            font-size: 0.85rem;
            font-weight: 500;
            margin-top: 0.3rem;
        }

        /* Charts Container */
        .charts-container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.8rem;
            margin-bottom: 2rem;
        }

        .chart-card {
            background: white;
            border-radius: 20px;
            padding: 1.5rem;
            border: 1px solid var(--border-color);
            box-shadow: var(--card-shadow);
            transition: var(--transition);
        }

        .chart-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 30px -12px rgba(0, 0, 0, 0.08);
        }

        .chart-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 1.5rem;
            padding-bottom: 0.8rem;
            border-bottom: 2px solid var(--border-color);
        }

        .chart-header i {
            font-size: 1.4rem;
            color: var(--primary);
        }

        .chart-title {
            font-weight: 600;
            color: #1E293B;
            margin: 0;
            font-size: 1.1rem;
        }

        .chart-subtitle {
            color: var(--text-muted);
            font-size: 0.75rem;
            margin-left: auto;
        }

        .chart-wrapper {
            height: 320px;
            position: relative;
        }

        /* Summary Section */
        .summary-section {
            background: white;
            border-radius: 20px;
            padding: 1.8rem;
            border: 1px solid var(--border-color);
            box-shadow: var(--card-shadow);
        }

        .summary-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 1.5rem;
            padding-bottom: 0.8rem;
            border-bottom: 2px solid var(--border-color);
        }

        .summary-header i {
            font-size: 1.4rem;
            color: var(--primary);
        }

        .summary-title {
            font-weight: 700;
            color: #1E293B;
            margin: 0;
            font-size: 1.2rem;
        }

        .summary-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
        }

        .summary-card {
            background: var(--light-bg);
            border-radius: 16px;
            padding: 1.2rem;
        }

        .summary-card-label {
            font-size: 0.8rem;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 0.5rem;
        }

        .summary-card-value {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
        }

        .summary-card-detail {
            font-size: 0.8rem;
            color: var(--text-muted);
            margin-top: 0.3rem;
        }

        .progress {
            height: 8px;
            border-radius: 10px;
            background: #E2E8F0;
            margin: 0.8rem 0;
        }

        .progress-bar {
            border-radius: 10px;
            background: var(--primary);
        }

        .documentos-tipo-list {
            max-height: 280px;
            overflow-y: auto;
        }

        .documento-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.7rem 0;
            border-bottom: 1px solid var(--border-color);
        }

        .documento-item:last-child {
            border-bottom: none;
        }

        .documento-nombre {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.85rem;
        }

        .documento-nombre i {
            width: 24px;
            color: var(--primary);
        }

        .documento-cantidad {
            font-weight: 600;
            color: var(--primary);
            background: rgba(7, 68, 182, 0.1);
            padding: 0.2rem 0.6rem;
            border-radius: 20px;
            font-size: 0.8rem;
        }

        .badge {
            padding: 0.25rem 0.6rem;
            border-radius: 20px;
            font-size: 0.7rem;
            font-weight: 500;
        }

        .badge-success { background: #d1fae5; color: #065f46; }
        .badge-warning { background: #fed7aa; color: #9a3412; }
        .badge-danger { background: #fee2e2; color: #991b1b; }
        .badge-info { background: #dbeafe; color: #1e40af; }

        @media (max-width: 1024px) {
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
            .charts-container { grid-template-columns: 1fr; }
            .summary-grid { grid-template-columns: 1fr; gap: 1rem; }
        }

        @media (max-width: 768px) {
            .stats-grid { grid-template-columns: 1fr; }
            .page-header { flex-direction: column; align-items: flex-start; }
        }
    </style>
</head>
<body>
    <!-- Navbar Superior -->
    <nav class="navbar navbar-expand-lg navbar-top">
        <div class="container">
            <div class="logo-container">
                <img src="{{ asset('img/logo_iufim.png') }}" alt="Logo" class="logo-img">
                <a class="navbar-brand" href="{{ route('dashboard') }}">
                    GEPROC
                </a>
            </div>
        </div>
    </nav>

    <!-- Navbar Menu -->
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
                        <i class="fas fa-user-circle fa-lg"></i>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="logout-btn">
                            <i class="fas fa-sign-out-alt"></i> Salir
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <div class="content-container">
            <!-- Header -->
            <div class="page-header">
                <h2>
                    <i class="fas fa-chart-line"></i>
                    Estadísticas de Administrativos
                </h2>
                <a href="{{ route('admin.administrativos.index') }}" class="back-btn">
                    <i class="fas fa-arrow-left"></i> Volver al listado
                </a>
            </div>

            <!-- Stats Grid -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon text-primary"><i class="fas fa-users"></i></div>
                    <div class="stat-value">{{ number_format($total) }}</div>
                    <div class="stat-label">Total de Administrativos</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon text-success"><i class="fas fa-check-circle"></i></div>
                    <div class="stat-value">{{ number_format($documentosAprobados) }}</div>
                    <div class="stat-label">Documentos Aprobados</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon text-warning"><i class="fas fa-clock"></i></div>
                    <div class="stat-value">{{ number_format($documentosPendientes) }}</div>
                    <div class="stat-label">Documentos Pendientes</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon text-danger"><i class="fas fa-times-circle"></i></div>
                    <div class="stat-value">{{ number_format($documentosRechazados) }}</div>
                    <div class="stat-label">Documentos Rechazados</div>
                </div>
            </div>

            <!-- Charts -->
            <div class="charts-container">
                <!-- Gráfico de Estado de Documentos -->
                <div class="chart-card">
                    <div class="chart-header">
                        <i class="fas fa-chart-pie"></i>
                        <h4 class="chart-title">Estado de Documentos</h4>
                        <span class="chart-subtitle">Distribución por estado</span>
                    </div>
                    <div class="chart-wrapper">
                        <canvas id="estadoChart"></canvas>
                    </div>
                </div>

                <!-- Gráfico de Documentos por Tipo -->
                <div class="chart-card">
                    <div class="chart-header">
                        <i class="fas fa-chart-bar"></i>
                        <h4 class="chart-title">Documentos por Tipo</h4>
                        <span class="chart-subtitle">Cantidad subida por tipo</span>
                    </div>
                    <div class="chart-wrapper">
                        <canvas id="tiposChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Summary Section -->
            <div class="summary-section">
                <div class="summary-header">
                    <i class="fas fa-clipboard-list"></i>
                    <h4 class="summary-title">Resumen General</h4>
                </div>
                
                <div class="summary-grid">
                    <div class="summary-card">
                        <div class="summary-card-label">Documentos Completos</div>
                        <div class="summary-card-value">{{ $completos }} / {{ $total }}</div>
                        <div class="progress">
                            <div class="progress-bar" style="width: {{ $total > 0 ? round(($completos / $total) * 100) : 0 }}%"></div>
                        </div>
                        <div class="summary-card-detail">
                            <i class="fas fa-percent"></i> {{ $total > 0 ? round(($completos / $total) * 100) : 0 }}% del total
                        </div>
                    </div>
                    
                    <div class="summary-card">
                        <div class="summary-card-label">Promedio por Administrativo</div>
                        <div class="summary-card-value">
                            {{ $total > 0 ? round(($documentosAprobados + $documentosPendientes + $documentosRechazados) / $total, 1) : 0 }}
                        </div>
                        <div class="summary-card-detail">
                            <i class="fas fa-file-pdf"></i> documentos en promedio
                        </div>
                    </div>
                    
                    <div class="summary-card">
                        <div class="summary-card-label">Tasa de Aprobación</div>
                        <div class="summary-card-value">
                            @php
                                $totalDocumentos = $documentosAprobados + $documentosPendientes + $documentosRechazados;
                                $tasaAprobacion = $totalDocumentos > 0 ? round(($documentosAprobados / $totalDocumentos) * 100) : 0;
                            @endphp
                            {{ $tasaAprobacion }}%
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-success" style="width: {{ $tasaAprobacion }}%"></div>
                        </div>
                        <div class="summary-card-detail">
                            <i class="fas fa-check-circle text-success"></i> documentos aprobados
                        </div>
                    </div>
                </div>

                <!-- Documentos por tipo detallado -->
                <div style="margin-top: 1.5rem;">
                    <div class="summary-card-label mb-3">Distribución por Tipo de Documento</div>
                    <div class="documentos-tipo-list">
                        @foreach($documentosPorTipo as $tipo => $cantidad)
                            @php
                                $tiposDoc = \App\Models\Administrativo::TIPOS_DOCUMENTOS;
                                $nombre = $tiposDoc[$tipo]['nombre'] ?? ucfirst(str_replace('_', ' ', $tipo));
                                $icono = $tiposDoc[$tipo]['icono'] ?? 'file';
                            @endphp
                            <div class="documento-item">
                                <div class="documento-nombre">
                                    <i class="fas fa-{{ $icono }}"></i>
                                    <span>{{ $nombre }}</span>
                                </div>
                                <div class="documento-cantidad">{{ number_format($cantidad) }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Gráfico de Estado de Documentos (Doughnut)
        const estadoCtx = document.getElementById('estadoChart').getContext('2d');
        new Chart(estadoCtx, {
            type: 'doughnut',
            data: {
                labels: ['Aprobados', 'Pendientes', 'Rechazados'],
                datasets: [{
                    data: [
                        {{ $documentosAprobados }},
                        {{ $documentosPendientes }},
                        {{ $documentosRechazados }}
                    ],
                    backgroundColor: ['#10b981', '#f59e0b', '#ef4444'],
                    borderWidth: 0,
                    hoverOffset: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            font: { size: 11, family: 'Inter' },
                            usePointStyle: true,
                            padding: 15
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.raw || 0;
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = total > 0 ? ((value / total) * 100).toFixed(1) : 0;
                                return `${label}: ${value} (${percentage}%)`;
                            }
                        }
                    }
                },
                cutout: '65%'
            }
        });

        // Gráfico de Documentos por Tipo (Barra Horizontal)
        const tiposCtx = document.getElementById('tiposChart').getContext('2d');
        const tiposLabels = [];
        const tiposData = [];
        
        @foreach($documentosPorTipo as $tipo => $cantidad)
            @php
                $tiposDoc = \App\Models\Administrativo::TIPOS_DOCUMENTOS;
                $nombre = $tiposDoc[$tipo]['nombre'] ?? ucfirst(str_replace('_', ' ', $tipo));
            @endphp
            tiposLabels.push('{{ $nombre }}');
            tiposData.push({{ $cantidad }});
        @endforeach
        
        new Chart(tiposCtx, {
            type: 'bar',
            data: {
                labels: tiposLabels,
                datasets: [{
                    data: tiposData,
                    backgroundColor: '#0744b6',
                    borderRadius: 8,
                    barPercentage: 0.65,
                    categoryPercentage: 0.8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `Total: ${context.raw} documentos`;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { stepSize: 1, font: { size: 11 } },
                        grid: { color: '#E2E8F0', drawBorder: false }
                    },
                    x: {
                        ticks: { font: { size: 10 }, maxRotation: 45, minRotation: 45 },
                        grid: { display: false }
                    }
                },
                layout: {
                    padding: { left: 5, right: 5, top: 10, bottom: 10 }
                }
            }
        });
    </script>
</body>
</html>