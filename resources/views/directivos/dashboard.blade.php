<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Directivo - GEPROC</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* (Mantén todos los estilos anteriores que ya tienes) */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f8fafc;
            color: #0f172a;
            line-height: 1.5;
        }

        /* Header mejorado */
        .header {
            background: white;
            padding: 0.75rem 2rem;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -1px rgba(0,0,0,0.03);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 100;
            border-bottom: 1px solid #e2e8f0;
        }

        .logo-area {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .logo-img {
            height: 45px;
            width: auto;
        }

        .logo-area h1 {
            font-size: 1.35rem;
            font-weight: 600;
            color: #0f172a;
            letter-spacing: -0.025em;
        }

        .logo-area span {
            color: #3b82f6;
            font-weight: 700;
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            background: #f8fafc;
            padding: 0.5rem 1rem;
            border-radius: 40px;
            border: 1px solid #e2e8f0;
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 1rem;
            box-shadow: 0 2px 4px rgba(59,130,246,0.3);
        }

        .user-details {
            line-height: 1.4;
        }

        .user-name {
            font-weight: 600;
            font-size: 0.9rem;
            color: #0f172a;
        }

        .user-role {
            font-size: 0.75rem;
            color: #64748b;
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .user-role i {
            font-size: 0.7rem;
            color: #3b82f6;
        }

        .logout-btn {
            background: none;
            border: 1px solid #e2e8f0;
            color: #64748b;
            padding: 0.5rem 1.25rem;
            border-radius: 40px;
            cursor: pointer;
            font-size: 0.85rem;
            font-weight: 500;
            transition: all 0.2s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .logout-btn:hover {
            background: #fef2f2;
            border-color: #ef4444;
            color: #ef4444;
        }

        /* Contenido principal */
        .main-content {
            margin-top: 80px;
            padding: 2rem 2rem 3rem;
        }

        .container {
            max-width: 1280px;
            margin: 0 auto;
        }

        /* Cabecera de página */
        .page-header {
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .page-header h2 {
            font-size: 1.8rem;
            font-weight: 700;
            color: #0f172a;
            letter-spacing: -0.025em;
            margin-bottom: 0.25rem;
        }

        .page-header p {
            color: #64748b;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .page-header p i {
            color: #3b82f6;
            font-size: 0.9rem;
        }

        .date-badge {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 40px;
            padding: 0.5rem 1.25rem;
            font-size: 0.85rem;
            color: #64748b;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .date-badge i {
            color: #3b82f6;
        }

        /* Tarjetas de estadísticas */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            border-radius: 20px;
            padding: 1.75rem;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -1px rgba(0,0,0,0.03);
            display: flex;
            align-items: center;
            gap: 1.25rem;
            transition: all 0.2s;
            border: 1px solid #e2e8f0;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 25px -5px rgba(0,0,0,0.05), 0 10px 10px -5px rgba(0,0,0,0.02);
            border-color: #cbd5e1;
        }

        .stat-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2rem;
            box-shadow: 0 10px 15px -3px rgba(59,130,246,0.2);
        }

        .stat-icon.coordinaciones {
            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
            box-shadow: 0 10px 15px -3px rgba(139,92,246,0.2);
        }

        .stat-content h3 {
            font-size: 0.85rem;
            font-weight: 600;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 0.25rem;
        }

        .stat-content .number {
            font-size: 2.5rem;
            font-weight: 700;
            color: #0f172a;
            line-height: 1.2;
        }

        .stat-content .subtitle {
            font-size: 0.8rem;
            color: #94a3b8;
            margin-top: 0.25rem;
        }

        /* Sección de coordinaciones mejorada */
        .coordinaciones-section {
            background: white;
            border-radius: 20px;
            padding: 1.75rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -1px rgba(0,0,0,0.03);
            border: 1px solid #e2e8f0;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .section-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: #0f172a;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .section-title i {
            color: #3b82f6;
            font-size: 1.1rem;
        }

        .info-note {
            background: #eff6ff;
            border-radius: 40px;
            padding: 0.5rem 1.25rem;
            font-size: 0.85rem;
            color: #1e40af;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            border: 1px solid #bfdbfe;
        }

        .info-note i {
            font-size: 0.9rem;
        }

        .coordinaciones-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1rem;
        }

        .coordinacion-item {
            background: #f8fafc;
            border-radius: 16px;
            padding: 1.25rem;
            border: 1px solid #e2e8f0;
            transition: all 0.2s;
            position: relative;
            overflow: hidden;
        }

        .coordinacion-item:hover {
            background: white;
            border-color: #cbd5e1;
            box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05);
        }

        .coordinacion-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            border-radius: 4px 0 0 4px;
        }

        .coordinacion-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .coordinacion-nombre {
            font-weight: 600;
            color: #0f172a;
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .coordinacion-nombre i {
            color: #3b82f6;
            font-size: 0.9rem;
        }

        .coordinacion-stats {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 0.75rem;
        }

        .stat-badge {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background: white;
            padding: 0.4rem 0.75rem;
            border-radius: 40px;
            font-size: 0.85rem;
            border: 1px solid #e2e8f0;
        }

        .stat-badge i {
            color: #3b82f6;
            font-size: 0.8rem;
        }

        .percentage-bar {
            height: 6px;
            background: #e2e8f0;
            border-radius: 3px;
            margin-top: 0.75rem;
            overflow: hidden;
        }

        .percentage-fill {
            height: 100%;
            background: linear-gradient(90deg, #3b82f6 0%, #2563eb 100%);
            border-radius: 3px;
            transition: width 0.3s;
        }

        /* Filtros mejorados */
        .filters-section {
            background: white;
            border-radius: 20px;
            padding: 1.75rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -1px rgba(0,0,0,0.03);
            border: 1px solid #e2e8f0;
        }

        .filters-grid {
            display: grid;
            grid-template-columns: 1fr 1fr auto;
            gap: 1rem;
            align-items: flex-end;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .filter-group label {
            font-weight: 500;
            font-size: 0.85rem;
            color: #64748b;
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }

        .filter-group label i {
            color: #3b82f6;
            font-size: 0.8rem;
        }

        .filter-group input,
        .filter-group select {
            padding: 0.7rem 1rem;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            font-size: 0.9rem;
            transition: all 0.2s;
            background: #f8fafc;
        }

        .filter-group input:focus,
        .filter-group select:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 4px rgba(59,130,246,0.1);
            background: white;
        }

        .filter-actions {
            display: flex;
            gap: 0.5rem;
            align-items: flex-end;
        }

        .btn-filter {
            padding: 0.7rem 1.75rem;
            background: #3b82f6;
            color: white;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            font-weight: 500;
            font-size: 0.9rem;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            white-space: nowrap;
            box-shadow: 0 4px 6px -1px rgba(59,130,246,0.2);
        }

        .btn-filter:hover {
            background: #2563eb;
            transform: translateY(-1px);
            box-shadow: 0 10px 15px -3px rgba(59,130,246,0.3);
        }

        .btn-clear {
            padding: 0.7rem 1.5rem;
            background: #f8fafc;
            color: #64748b;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            cursor: pointer;
            font-weight: 500;
            font-size: 0.9rem;
            transition: all 0.2s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            white-space: nowrap;
        }

        .btn-clear:hover {
            background: #f1f5f9;
            color: #0f172a;
            border-color: #cbd5e1;
        }

        /* Loader para filtros AJAX */
        .filter-loader {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255,255,255,0.7);
            z-index: 9999;
            justify-content: center;
            align-items: center;
            backdrop-filter: blur(2px);
        }

        .filter-loader.active {
            display: flex;
        }

        .spinner {
            width: 50px;
            height: 50px;
            border: 4px solid #e2e8f0;
            border-top-color: #3b82f6;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Tabla simplificada */
        .table-section {
            background: white;
            border-radius: 20px;
            padding: 1.75rem;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -1px rgba(0,0,0,0.03);
            border: 1px solid #e2e8f0;
        }

        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .results-info {
            color: #64748b;
            font-size: 0.9rem;
            background: #f8fafc;
            padding: 0.5rem 1rem;
            border-radius: 40px;
            border: 1px solid #e2e8f0;
        }

        .results-info strong {
            color: #0f172a;
            font-weight: 600;
        }

        .table-responsive {
            overflow-x: auto;
            border-radius: 16px;
            border: 1px solid #e2e8f0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 600px;
        }

        th {
            text-align: left;
            padding: 1rem 1.25rem;
            background: #f8fafc;
            color: #64748b;
            font-weight: 600;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border-bottom: 1px solid #e2e8f0;
        }

        td {
            padding: 1.25rem;
            border-bottom: 1px solid #e2e8f0;
            color: #0f172a;
            font-size: 0.95rem;
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover td {
            background: #f8fafc;
        }

        .nombre-maestro {
            font-weight: 600;
            color: #0f172a;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .nombre-maestro i {
            color: #94a3b8;
            font-size: 1rem;
        }

        .badge-coordinacion {
            background: #eff6ff;
            color: #1e40af;
            padding: 0.4rem 1rem;
            border-radius: 40px;
            font-size: 0.8rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            border: 1px solid #bfdbfe;
        }

        .badge-coordinacion i {
            font-size: 0.7rem;
        }

        .badge-sin-asignar {
            background: #f1f5f9;
            color: #64748b;
            padding: 0.4rem 1rem;
            border-radius: 40px;
            font-size: 0.8rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            border: 1px solid #e2e8f0;
        }

        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: #94a3b8;
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: #cbd5e1;
        }

        .empty-state h3 {
            color: #64748b;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        /* Paginación */
        .pagination {
            margin-top: 2rem;
            display: flex;
            justify-content: flex-end;
        }

        .pagination nav {
            display: inline-block;
        }

        .pagination .pagination {
            display: flex;
            gap: 0.25rem;
        }

        .pagination .page-link {
            padding: 0.5rem 0.9rem;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            color: #64748b;
            text-decoration: none;
            transition: all 0.2s;
            font-size: 0.9rem;
            background: white;
            cursor: pointer;
        }

        .pagination .page-link:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
            color: #0f172a;
        }

        .pagination .page-link.active {
            background: #3b82f6;
            color: white;
            border-color: #3b82f6;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .filters-grid {
                grid-template-columns: 1fr 1fr;
            }
            
            .filter-actions {
                grid-column: span 2;
                justify-content: flex-end;
            }
        }

        @media (max-width: 768px) {
            .header {
                padding: 0.75rem 1rem;
                flex-direction: column;
                gap: 0.75rem;
            }

            .user-menu {
                width: 100%;
                justify-content: space-between;
            }

            .main-content {
                padding: 1rem;
                margin-top: 120px;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .filters-grid {
                grid-template-columns: 1fr;
            }

            .filter-actions {
                grid-column: span 1;
                flex-direction: column;
            }

            .btn-filter,
            .btn-clear {
                width: 100%;
                justify-content: center;
            }

            .coordinaciones-grid {
                grid-template-columns: 1fr;
            }

            .section-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .info-note {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <!-- Loader para filtros AJAX -->
    <div class="filter-loader" id="filterLoader">
        <div class="spinner"></div>
    </div>

    <!-- Header mejorado -->
    <header class="header">
        <div class="logo-area">
            <img src="{{ asset('img/logo_iufim.png') }}" alt="Logo IUFIM" class="logo-img">
            <h1>GEPROC <span>| Directivos</span></h1>
        </div>

        <div class="user-menu">
            <div class="user-info">
                <div class="user-avatar">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div class="user-details">
                    <div class="user-name">{{ Auth::user()->name }}</div>
                    <div class="user-role">
                        <i class="fas fa-circle"></i>
                        Directivo
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Salir</span>
                </button>
            </form>
        </div>
    </header>

    <!-- Contenido principal -->
    <main class="main-content">
        <div class="container">
            <!-- Alerta informativa -->
            @if(session('info'))
                <div class="alert alert-info" style="background: #eff6ff; border: 1px solid #bfdbfe; color: #1e40af; border-radius: 12px; padding: 1rem; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.75rem;">
                    <i class="fas fa-info-circle" style="color: #3b82f6;"></i>
                    {{ session('info') }}
                </div>
            @endif

            <!-- Cabecera con fecha -->
            <div class="page-header">
                <div>
                    <h2>Panel General De Maestros</h2>
                   
                </div>
                
            </div>

            <!-- Tarjetas de estadísticas (solo 2) -->
            <div class="stats-grid" id="statsContainer">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <div class="stat-content">
                        <h3>Total Maestros</h3>
                        <div class="number" id="totalMaestros">{{ $totalMaestros }}</div>
                        <div class="subtitle">Registrados en el sistema</div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon coordinaciones">
                        <i class="fas fa-layer-group"></i>
                    </div>
                    <div class="stat-content">
                        <h3>Coordinaciones</h3>
                        <div class="number" id="totalCoordinaciones">{{ $maestrosPorCoordinacion->count() }}</div>
                        <div class="subtitle">Activas en el sistema</div>
                    </div>
                </div>
            </div>

            <!-- Resumen por Coordinaciones con nota informativa -->
            <div class="coordinaciones-section" id="coordinacionesContainer">
                <div class="section-header">
                    <h3 class="section-title">
                        <i class="fas fa-chart-pie"></i>
                        Distribución de Maestros por Coordinación
                    </h3>
                    <div class="info-note">
                        <i class="fas fa-lightbulb"></i>
                        Vista informativa - Porcentaje del total de maestros
                    </div>
                </div>

                <div class="coordinaciones-grid" id="coordinacionesGrid">
                    @forelse($maestrosPorCoordinacion as $coordinacion)
                        <div class="coordinacion-item" data-coordinacion-id="{{ $coordinacion->id }}">
                            <div class="coordinacion-header">
                                <span class="coordinacion-nombre">
                                    <i class="fas fa-university"></i>
                                    {{ $coordinacion->nombre }}
                                </span>
                                <span class="stat-badge">
                                    <i class="fas fa-user"></i>
                                    <span class="maestros-count">{{ $coordinacion->maestros_count }}</span> maestros
                                </span>
                            </div>
                            <div class="coordinacion-stats">
                                <span style="color: #64748b; font-size: 0.85rem;">
                                    <span class="porcentaje">{{ $totalMaestros > 0 ? round(($coordinacion->maestros_count / $totalMaestros) * 100) : 0 }}</span>% del total
                                </span>
                            </div>
                            <div class="percentage-bar">
                                <div class="percentage-fill" style="width: {{ $totalMaestros > 0 ? ($coordinacion->maestros_count / $totalMaestros) * 100 : 0 }}%"></div>
                            </div>
                        </div>
                    @empty
                        <p style="color: #94a3b8; text-align: center; padding: 2rem;">No hay coordinaciones registradas</p>
                    @endforelse
                </div>
            </div>

            <!-- Filtros de búsqueda mejorados - CON AJAX -->
            <div class="filters-section">
                <h3 class="section-title" style="margin-bottom: 1.5rem;">
                    <i class="fas fa-filter"></i>
                    Filtros de Búsqueda
                </h3>
                
                <div class="filters-grid">
                    <div class="filter-group">
                        <label for="coordinacion">
                            <i class="fas fa-building"></i> Coordinación
                        </label>
                        <select name="coordinacion" id="coordinacion">
                            <option value="">Todas las coordinaciones</option>
                            @foreach($maestrosPorCoordinacion as $coordinacion)
                                <option value="{{ $coordinacion->id }}" 
                                    {{ request('coordinacion') == $coordinacion->id ? 'selected' : '' }}>
                                    {{ $coordinacion->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="filter-group">
                        <label for="nombre">
                            <i class="fas fa-user"></i> Nombre del Maestro
                        </label>
                        <input type="text" 
                               name="nombre" 
                               id="nombre" 
                               value="{{ request('nombre') }}"
                               placeholder="Buscar por nombre o apellidos...">
                    </div>

                    <div class="filter-actions">
                        <button type="button" class="btn-filter" id="btnFilter">
                            <i class="fas fa-search"></i> Filtrar
                        </button>
                        
                        <button type="button" class="btn-clear" id="btnClear">
                            <i class="fas fa-times"></i> Limpiar
                        </button>
                    </div>
                </div>
            </div>

            <!-- Tabla simplificada - Solo Nombre y Coordinación -->
            <div class="table-section" id="tablaContainer">
                <div class="table-header">
                    <div class="results-info" id="resultsInfo">
                        <i class="fas fa-list-ul" style="margin-right: 0.5rem; color: #3b82f6;"></i>
                        Mostrando <strong id="fromItem">{{ $maestros->firstItem() ?? 0 }}</strong> - 
                        <strong id="toItem">{{ $maestros->lastItem() ?? 0 }}</strong> de 
                        <strong id="totalItems">{{ $maestros->total() }}</strong> maestros
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="maestrosTable">
                        <thead>
                            <tr>
                                <th>Nombre Completo</th>
                                <th>Coordinación</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            @forelse($maestros as $maestro)
                                <tr>
                                    <td>
                                        <div class="nombre-maestro">
                                            <i class="fas fa-user-circle"></i>
                                            <strong>{{ $maestro->nombres }} {{ $maestro->apellido_paterno }} {{ $maestro->apellido_materno }}</strong>
                                        </div>
                                    </td>
                                    <td>
                                        @if($maestro->coordinacion)
                                            <span class="badge-coordinacion">
                                                <i class="fas fa-university"></i>
                                                {{ $maestro->coordinacion->nombre }}
                                            </span>
                                        @else
                                            <span class="badge-sin-asignar">
                                                <i class="fas fa-times-circle"></i>
                                                Sin asignar
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2">
                                        <div class="empty-state">
                                            <i class="fas fa-search"></i>
                                            <h3>No se encontraron maestros</h3>
                                            <p>Intenta con otros filtros de búsqueda</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Paginación -->
                @if($maestros->hasPages())
                    <div class="pagination" id="paginationContainer">
                        {{ $maestros->appends(request()->query())->links('pagination::bootstrap-5') }}
                    </div>
                @endif
            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const filterLoader = document.getElementById('filterLoader');
            const btnFilter = document.getElementById('btnFilter');
            const btnClear = document.getElementById('btnClear');
            const coordinacionSelect = document.getElementById('coordinacion');
            const nombreInput = document.getElementById('nombre');

            // Función para cargar datos con AJAX
            async function cargarDatosFiltrados() {
                // Mostrar loader
                filterLoader.classList.add('active');

                // Obtener valores de los filtros
                const coordinacion = coordinacionSelect.value;
                const nombre = nombreInput.value.trim();

                // Construir URL con parámetros
                let url = new URL(window.location.href);
                url.searchParams.delete('coordinacion');
                url.searchParams.delete('nombre');
                url.searchParams.delete('page');
                
                if (coordinacion) {
                    url.searchParams.set('coordinacion', coordinacion);
                }
                if (nombre) {
                    url.searchParams.set('nombre', nombre);
                }

                try {
                    // Hacer petición AJAX
                    const response = await fetch(url.toString(), {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });
                    
                    const html = await response.text();
                    
                    // Crear un elemento temporal para parsear el HTML
                    const temp = document.createElement('div');
                    temp.innerHTML = html;

                    // Actualizar solo las partes necesarias
                    
                    // 1. Actualizar estadísticas (si cambian)
                    const newTotalMaestros = temp.querySelector('#totalMaestros');
                    const newTotalCoordinaciones = temp.querySelector('#totalCoordinaciones');
                    if (newTotalMaestros) {
                        document.getElementById('totalMaestros').textContent = newTotalMaestros.textContent;
                    }
                    if (newTotalCoordinaciones) {
                        document.getElementById('totalCoordinaciones').textContent = newTotalCoordinaciones.textContent;
                    }

                    // 2. Actualizar grid de coordinaciones
                    const newCoordinacionesGrid = temp.querySelector('#coordinacionesGrid');
                    if (newCoordinacionesGrid) {
                        document.getElementById('coordinacionesGrid').innerHTML = newCoordinacionesGrid.innerHTML;
                    }

                    // 3. Actualizar tabla de maestros
                    const newTableBody = temp.querySelector('#tableBody');
                    if (newTableBody) {
                        document.getElementById('tableBody').innerHTML = newTableBody.innerHTML;
                    }

                    // 4. Actualizar información de resultados
                    const newResultsInfo = temp.querySelector('#resultsInfo');
                    if (newResultsInfo) {
                        document.getElementById('resultsInfo').innerHTML = newResultsInfo.innerHTML;
                    }

                    // 5. Actualizar paginación
                    const newPagination = temp.querySelector('#paginationContainer');
                    const oldPagination = document.getElementById('paginationContainer');
                    if (newPagination && oldPagination) {
                        oldPagination.innerHTML = newPagination.innerHTML;
                    } else if (newPagination && !oldPagination) {
                        // Si no había paginación y ahora sí, crearla
                        const tablaContainer = document.getElementById('tablaContainer');
                        const newPaginationClone = newPagination.cloneNode(true);
                        tablaContainer.appendChild(newPaginationClone);
                    } else if (!newPagination && oldPagination) {
                        // Si había paginación y ahora no, eliminarla
                        oldPagination.remove();
                    }

                    // Actualizar URL sin recargar la página
                    window.history.pushState({}, '', url.toString());

                } catch (error) {
                    console.error('Error al filtrar:', error);
                    // Mostrar mensaje de error
                    alert('Error al aplicar filtros. Por favor intenta de nuevo.');
                } finally {
                    // Ocultar loader
                    filterLoader.classList.remove('active');
                }
            }

            // Evento para el botón de filtrar
            btnFilter.addEventListener('click', function(e) {
                e.preventDefault();
                cargarDatosFiltrados();
            });

            // Evento para el botón de limpiar
            btnClear.addEventListener('click', function(e) {
                e.preventDefault();
                // Limpiar campos
                coordinacionSelect.value = '';
                nombreInput.value = '';
                
                // Cargar datos sin filtros
                let url = new URL(window.location.href);
                url.search = ''; // Eliminar todos los parámetros
                
                // Actualizar URL
                window.history.pushState({}, '', url.toString());
                
                // Recargar datos
                cargarDatosFiltrados();
            });

            // Permitir filtrar con Enter en el campo de nombre
            nombreInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    cargarDatosFiltrados();
                }
            });

            // Cambio en select también puede filtrar automáticamente (opcional)
            // Descomenta la siguiente línea si quieres que filtre al cambiar el select
            // coordinacionSelect.addEventListener('change', cargarDatosFiltrados);
        });
    </script>
</body>
</html>