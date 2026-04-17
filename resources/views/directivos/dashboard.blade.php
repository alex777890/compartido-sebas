<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Directivo - GEPROC</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #0744b6ff;
            --primary-light: #3a6bd3;
            --primary-soft: #e8f0fe;
            --secondary: #33CAE6;
            --accent: #28a745;
            --light-bg: #F8F9FA;
            --dark-bg: #1a1a2e;
            --sidebar-bg: #ffffff;
            --border-color: #E9ECEF;
            --text-muted: #6C757D;
            --text-dark: #000000;
            --card-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            --card-shadow-hover: 0 10px 30px rgba(0, 0, 0, 0.12);
            --transition: all 0.3s ease;
            --success-color: #10b981;
            --success-light: #d1fae5;
            --warning-color: #f59e0b;
            --warning-light: #fef3c7;
            --danger-color: #ef4444;
            --danger-light: #fee2e2;
            --info-color: #3b82f6;
            --info-light: #dbeafe;
            --purple-color: #8b5cf6;
            --purple-light: #ede9fe;
            --cyan-color: #06b6d4;
            --cyan-light: #cffafe;
            --border-radius: 12px;
            --gradient-primary: linear-gradient(135deg, #0744b6ff 0%, #3a6bd3 100%);
            
            /* Colores para coordinaciones - Paleta fija */
            --coor-1: #3b82f6;
            --coor-1-light: #dbeafe;
            --coor-2: #8b5cf6;
            --coor-2-light: #ede9fe;
            --coor-3: #10b981;
            --coor-3-light: #d1fae5;
            --coor-4: #f59e0b;
            --coor-4-light: #fef3c7;
            --coor-5: #ef4444;
            --coor-5-light: #fee2e2;
            --coor-6: #06b6d4;
            --coor-6-light: #cffafe;
            --coor-7: #ec489a;
            --coor-7-light: #fce7f3;
            --coor-8: #84cc16;
            --coor-8-light: #ecfccb;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #f5f7fb 0%, #f0f4f8 100%);
            color: #2d3748;
            line-height: 1.6;
            min-height: 100vh;
            font-size: 15px;
        }

        /* ===== HEADER ===== */
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
            border-bottom: 4px solid var(--primary);
        }

        .logo-area {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .logo-img {
            height: 55px;
            width: auto;
            max-width: 180px;
            object-fit: contain;
        }

        .logo-area h1 {
            font-size: 1.4rem;
            font-weight: 600;
            color: var(--primary);
            letter-spacing: -0.025em;
        }

        .logo-area span {
            color: var(--primary-light);
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
            background: var(--light-bg);
            padding: 0.5rem 1rem;
            border-radius: 40px;
            border: 1px solid var(--border-color);
            transition: var(--transition);
        }

        .user-info:hover {
            transform: translateY(-2px);
            box-shadow: var(--card-shadow);
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            background: var(--gradient-primary);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 1rem;
            box-shadow: 0 2px 4px rgba(7,68,182,0.3);
        }

        .user-details {
            line-height: 1.4;
        }

        .user-name {
            font-weight: 600;
            font-size: 0.9rem;
            color: #000000;
        }

        .user-role {
            font-size: 0.75rem;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .user-role i {
            font-size: 0.7rem;
            color: var(--primary);
        }

        .logout-btn {
            background: none;
            border: 1px solid var(--border-color);
            color: var(--text-muted);
            padding: 0.5rem 1.25rem;
            border-radius: 40px;
            cursor: pointer;
            font-size: 0.85rem;
            font-weight: 500;
            transition: var(--transition);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .logout-btn:hover {
            background: var(--danger-light);
            border-color: var(--danger-color);
            color: var(--danger-color);
            transform: translateY(-2px);
        }

        /* Contenido principal */
        .main-content {
            margin-top: 85px;
            padding: 2rem 2rem 3rem;
        }

        .container {
            max-width: 1400px;
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
            font-size: 28px;
            font-weight: 700;
            color: #000000;
            letter-spacing: -0.025em;
            position: relative;
            display: inline-block;
        }

        .page-header h2::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 60px;
            height: 3px;
            border-radius: 2px;
        }

        .date-badge {
            background: white;
            border: 1px solid var(--border-color);
            border-radius: 40px;
            padding: 0.5rem 1.25rem;
            font-size: 0.85rem;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: 0.5rem;
            box-shadow: var(--card-shadow);
        }

        .date-badge i {
            color: var(--primary);
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
            box-shadow: var(--card-shadow);
            display: flex;
            align-items: center;
            gap: 1.25rem;
            transition: var(--transition);
            border: 2px solid var(--border-color);
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--card-shadow-hover);
        }

        .stat-icon {
            width: 70px;
            height: 70px;
            background: var(--gradient-primary);
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2rem;
            box-shadow: 0 10px 15px -3px rgba(7,68,182,0.2);
        }

        .stat-icon.coordinaciones {
            background: linear-gradient(135deg, #6c5ce7 0%, #8b5cf6 100%);
            box-shadow: 0 10px 15px -3px rgba(107,70,193,0.2);
        }

        .stat-content h3 {
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 0.25rem;
        }

        .stat-content .number {
            font-size: 2.5rem;
            font-weight: 800;
            color: #000000;
            line-height: 1.2;
        }

        .stat-content .subtitle {
            font-size: 0.8rem;
            color: #94a3b8;
            margin-top: 0.25rem;
        }

        /* Sección de coordinaciones */
        .coordinaciones-section {
            background: white;
            border-radius: 20px;
            padding: 1.75rem;
            margin-bottom: 2rem;
            box-shadow: var(--card-shadow);
            border: 2px solid var(--border-color);
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }

        .coordinaciones-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            
        }

        .coordinaciones-section:hover {
            box-shadow: var(--card-shadow-hover);
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
            font-weight: 700;
            color: #000000;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .section-title i {
            color: var(--primary);
            font-size: 1.1rem;
        }

        .info-note {
            background: var(--info-light);
            border-radius: 40px;
            padding: 0.5rem 1.25rem;
            font-size: 0.85rem;
            color: var(--info-color);
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

        /* Estilos para coordinaciones */
        .coordinacion-item {
            background: var(--light-bg);
            border-radius: 16px;
            padding: 1.25rem;
            border: 1px solid var(--border-color);
            transition: var(--transition);
            position: relative;
            overflow: hidden;
            border-left: 4px solid;
        }

        .coordinacion-item:hover {
            background: white;
            transform: translateY(-3px);
            box-shadow: var(--card-shadow);
        }

        .coordinacion-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .coordinacion-nombre {
            font-weight: 700;
            color: #000000;
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .coordinacion-nombre i {
            font-size: 0.9rem;
        }

        .stat-badge {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background: white;
            padding: 0.4rem 0.75rem;
            border-radius: 40px;
            font-size: 0.85rem;
            border: 1px solid var(--border-color);
            font-weight: 600;
            color: #000000;
        }

        .stat-badge i {
            font-size: 0.8rem;
        }

        .coordinacion-stats {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 0.75rem;
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
            border-radius: 3px;
            transition: width 0.3s;
        }

        /* Filtros */
        .filters-section {
            background: white;
            border-radius: 20px;
            padding: 1.75rem;
            margin-bottom: 2rem;
            box-shadow: var(--card-shadow);
            border: 2px solid var(--border-color);
            transition: var(--transition);
        }

        .filters-section:hover {
            box-shadow: var(--card-shadow-hover);
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
            font-weight: 600;
            font-size: 0.85rem;
            color: #000000;
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }

        .filter-group label i {
            color: var(--primary);
            font-size: 0.8rem;
        }

        .filter-group input,
        .filter-group select {
            padding: 0.75rem 1rem;
            border: 2px solid var(--border-color);
            border-radius: 12px;
            font-size: 0.9rem;
            transition: var(--transition);
            background: white;
        }

        .filter-group input:focus,
        .filter-group select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(7,68,182,0.08);
        }

        .filter-actions {
            display: flex;
            gap: 0.5rem;
            align-items: flex-end;
        }

        .btn-filter {
            padding: 0.75rem 1.75rem;
            background: var(--gradient-primary);
            color: white;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            font-weight: 600;
            font-size: 0.9rem;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            white-space: nowrap;
            box-shadow: 0 4px 12px rgba(7,68,182,0.2);
        }

        .btn-filter:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(7,68,182,0.3);
        }

        .btn-clear {
            padding: 0.75rem 1.5rem;
            background: white;
            color: var(--text-muted);
            border: 2px solid var(--border-color);
            border-radius: 12px;
            cursor: pointer;
            font-weight: 600;
            font-size: 0.9rem;
            transition: var(--transition);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            white-space: nowrap;
        }

        .btn-clear:hover {
            background: var(--light-bg);
            color: var(--primary);
            border-color: var(--primary);
            transform: translateY(-2px);
        }

        /* Loader */
        .filter-loader {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255,255,255,0.8);
            z-index: 9999;
            justify-content: center;
            align-items: center;
            backdrop-filter: blur(3px);
        }

        .filter-loader.active {
            display: flex;
        }

        .spinner {
            width: 50px;
            height: 50px;
            border: 4px solid var(--border-color);
            border-top-color: var(--primary);
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Tabla */
        .table-section {
            background: white;
            border-radius: 20px;
            padding: 1.75rem;
            box-shadow: var(--card-shadow);
            border: 2px solid var(--border-color);
            transition: var(--transition);
        }

        .table-section:hover {
            box-shadow: var(--card-shadow-hover);
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
            color: var(--text-muted);
            font-size: 0.9rem;
            background: var(--light-bg);
            padding: 0.5rem 1rem;
            border-radius: 40px;
            border: 1px solid var(--border-color);
        }

        .results-info strong {
            color: #000000;
            font-weight: 700;
        }

        .table-responsive {
            overflow-x: auto;
            border-radius: 16px;
            border: 1px solid var(--border-color);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 900px;
        }

        th {
            text-align: left;
            padding: 1rem 1.25rem;
            background: var(--light-bg);
            color: #000000;
            font-weight: 700;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border-bottom: 2px solid var(--border-color);
        }

        th i {
            margin-right: 6px;
            color: var(--primary);
        }

        td {
            padding: 1.25rem;
            border-bottom: 1px solid var(--border-color);
            color: #2d3748;
            font-size: 0.95rem;
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover td {
            background: var(--light-bg);
        }

        .nombre-maestro {
            font-weight: 600;
            color: #000000;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .nombre-maestro i {
            color: var(--primary);
            font-size: 1rem;
        }

        /* Badges de coordinación */
        .badge-coordinacion {
            padding: 0.4rem 1rem;
            border-radius: 40px;
            font-size: 0.8rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            border: 1px solid;
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

        .badge-anio {
            background: #f1f5f9;
            color: #334155;
            padding: 0.4rem 0.8rem;
            border-radius: 30px;
            font-size: 0.85rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            border: 1px solid #e2e8f0;
        }

        .badge-anio i {
            color: var(--primary);
            font-size: 0.7rem;
        }

        .badge-antiguedad {
            background: var(--success-light);
            color: #0e5814;
            padding: 0.4rem 0.8rem;
            border-radius: 30px;
            font-size: 0.85rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            border: 1px solid #b7e0b7;
        }

        .badge-antiguedad i {
            color: var(--success-color);
            font-size: 0.7rem;
        }

        .badge-sin-calculo {
            background: #f1f5f9;
            color: #64748b;
            padding: 0.4rem 0.8rem;
            border-radius: 30px;
            font-size: 0.8rem;
            font-weight: 400;
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            border: 1px solid #e2e8f0;
        }

        .periodo-actual {
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--primary);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .periodo-actual i {
            font-size: 0.8rem;
        }

        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: var(--text-muted);
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: var(--primary);
            opacity: 0.5;
        }

        .empty-state h3 {
            color: #000000;
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
            border: 1px solid var(--border-color);
            border-radius: 10px;
            color: var(--text-muted);
            text-decoration: none;
            transition: var(--transition);
            font-size: 0.9rem;
            background: white;
            cursor: pointer;
        }

        .pagination .page-link:hover {
            background: var(--light-bg);
            border-color: var(--primary);
            color: var(--primary);
        }

        .pagination .page-link.active {
            background: var(--gradient-primary);
            color: white;
            border-color: var(--primary);
        }

        /* Alertas */
        .alert {
            padding: 1rem 1.25rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
            border-left: 6px solid transparent;
            font-size: 0.9rem;
        }

        .alert-info {
            background: var(--info-light);
            border-color: var(--info-color);
            color: #1e40af;
        }

        .alert-info i {
            color: var(--info-color);
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
                margin-top: 130px;
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

        @media (max-width: 480px) {
            .stat-card {
                flex-direction: column;
                text-align: center;
            }
            
            .stat-icon {
                margin: 0 auto;
            }
            
            .stat-content h3 {
                text-align: center;
            }
            
            .stat-content .number {
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <!-- Loader para filtros AJAX -->
    <div class="filter-loader" id="filterLoader">
        <div class="spinner"></div>
    </div>

    <!-- Header -->
    <header class="header">
        <div class="logo-area">
            <img src="{{ asset('img/logo_iufim.png') }}" alt="Logo IUFIM" class="logo-img">
            <h1>GEPROC <span>| Directivos</span></h1>
        </div>

        <div class="user-menu">
            

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
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i>
                    {{ session('info') }}
                </div>
            @endif

            <!-- Cabecera con fecha -->
            <div class="page-header">
                <div>
                    <h2>Panel General De Maestros</h2>
                </div>
                <div class="date-badge">
                    <i class="fas fa-calendar-alt"></i>
                    {{ now()->format('d/m/Y') }}
                </div>
            </div>

            <!-- Tarjetas de estadísticas -->
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

            <!-- Resumen por Coordinaciones - EN ORDEN ALFABÉTICO -->
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
                    @php
                        // Definir colores fijos para coordinaciones (por nombre, no por ID)
                        $paletaColores = [
                            '#3b82f6', // Azul
                            '#8b5cf6', // Morado
                            '#10b981', // Verde
                            '#f59e0b', // Naranja
                            '#ef4444', // Rojo
                            '#06b6d4', // Cyan
                            '#ec489a', // Rosa
                            '#84cc16', // Verde lima
                        ];
                        
                        $fondosColores = [
                            '#dbeafe', '#ede9fe', '#d1fae5', '#fef3c7',
                            '#fee2e2', '#cffafe', '#fce7f3', '#ecfccb'
                        ];
                        
                        // Ordenar coordinaciones alfabéticamente por nombre
                        $coordinacionesOrdenadas = $maestrosPorCoordinacion->sortBy('nombre');
                        $colorIndex = 0;
                    @endphp
                    
                    @forelse($coordinacionesOrdenadas as $coordinacion)
                        @php
                            $colorActual = $paletaColores[$colorIndex % count($paletaColores)];
                            $fondoActual = $fondosColores[$colorIndex % count($fondosColores)];
                            $colorIndex++;
                        @endphp
                        <div class="coordinacion-item" style="border-left-color: {{ $colorActual }};" data-coordinacion-id="{{ $coordinacion->id }}" data-coordinacion-nombre="{{ $coordinacion->nombre }}" data-color="{{ $colorActual }}" data-fondo="{{ $fondoActual }}">
                            <div class="coordinacion-header">
                                <span class="coordinacion-nombre">
                                    <i class="fas fa-university" style="color: {{ $colorActual }};"></i>
                                    {{ $coordinacion->nombre }}
                                </span>
                                <span class="stat-badge">
                                    <i class="fas fa-user" style="color: {{ $colorActual }};"></i>
                                    <span class="maestros-count">{{ $coordinacion->maestros_count }}</span> maestros
                                </span>
                            </div>
                            <div class="coordinacion-stats">
                                <span style="color: var(--text-muted); font-size: 0.85rem;">
                                    <span class="porcentaje">{{ $totalMaestros > 0 ? round(($coordinacion->maestros_count / $totalMaestros) * 100) : 0 }}</span>% del total
                                </span>
                            </div>
                            <div class="percentage-bar">
                                <div class="percentage-fill" style="width: {{ $totalMaestros > 0 ? ($coordinacion->maestros_count / $totalMaestros) * 100 : 0 }}%; background: {{ $colorActual }};"></div>
                            </div>
                        </div>
                    @empty
                        <p style="color: var(--text-muted); text-align: center; padding: 2rem;">No hay coordinaciones registradas</p>
                    @endforelse
                </div>
            </div>

            <!-- Filtros de búsqueda -->
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
                            @foreach($maestrosPorCoordinacion->sortBy('nombre') as $coordinacion)
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
                            <i class="fas fa-search"></i> Buscar
                        </button>
                        
                        <button type="button" class="btn-clear" id="btnClear">
                            <i class="fas fa-times"></i> Limpiar
                        </button>
                    </div>
                </div>
            </div>

            <!-- Tabla de maestros -->
            <div class="table-section" id="tablaContainer">
                <div class="table-header">
                    <div class="results-info" id="resultsInfo">
                        <i class="fas fa-list-ul" style="margin-right: 0.5rem;"></i>
                        Mostrando <strong id="fromItem">{{ $maestros->firstItem() ?? 0 }}</strong> - 
                        <strong id="toItem">{{ $maestros->lastItem() ?? 0 }}</strong> de 
                        <strong id="totalItems">{{ $maestros->total() }}</strong> maestros
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="maestrosTable">
                        <thead>
                            <tr>
                                <th><i class="fas fa-user-circle"></i> Nombre Completo</th>
                                <th><i class="fas fa-building"></i> Coordinación</th>
                                <th><i class="fas fa-calendar-alt"></i> Año de Ingreso</th>
                                <th><i class="fas fa-clock"></i> Periodo Actual</th>
                                <th><i class="fas fa-chart-line"></i> Antigüedad</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            @php
                                // Crear un mapa de colores por nombre de coordinación para la tabla
                                $mapaColores = [];
                                $coordinacionesOrdenadasMap = $maestrosPorCoordinacion->sortBy('nombre');
                                $colorIdx = 0;
                                foreach($coordinacionesOrdenadasMap as $coord) {
                                    $mapaColores[$coord->nombre] = [
                                        'color' => $paletaColores[$colorIdx % count($paletaColores)],
                                        'fondo' => $fondosColores[$colorIdx % count($fondosColores)]
                                    ];
                                    $colorIdx++;
                                }
                            @endphp
                            
                            @forelse($maestros as $maestro)
                                @php
                                    // Calcular antigüedad
                                    $anioIngreso = $maestro->anio_ingreso;
                                    $totalMeses = 0;
                                    $anios = 0;
                                    $meses = 0;
                                    $ultimoPeriodo = null;
                                    
                                    if ($maestro->periodos && $maestro->periodos->count() > 0) {
                                        foreach ($maestro->periodos as $periodo) {
                                            $mesesPeriodo = json_decode($periodo->pivot->meses_trabajados, true) ?? [];
                                            $totalMeses += count($mesesPeriodo);
                                        }
                                        $anios = floor($totalMeses / 12);
                                        $meses = $totalMeses % 12;
                                        
                                        $ultimoPeriodo = $maestro->periodos->sortByDesc(function($p) {
                                            return $p->pivot->created_at;
                                        })->first();
                                    }
                                    
                                    // Obtener colores para la coordinación del maestro
                                    $nombreCoordinacion = $maestro->coordinacion ? $maestro->coordinacion->nombre : null;
                                    $colorCoor = $mapaColores[$nombreCoordinacion] ?? ['color' => '#64748b', 'fondo' => '#f1f5f9'];
                                @endphp
                                
                                    <td>
                                        <div class="nombre-maestro">
                                            <i class="fas fa-user-circle"></i>
                                            <strong>{{ $maestro->nombres }} {{ $maestro->apellido_paterno }} {{ $maestro->apellido_materno }}</strong>
                                        </div>
                                    </td>
                                    <td>
                                        @if($maestro->coordinacion)
                                            <span class="badge-coordinacion" style="background: {{ $colorCoor['fondo'] }}; color: {{ $colorCoor['color'] }}; border-color: {{ $colorCoor['color'] }};">
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
                                    <td>
                                        @if($anioIngreso)
                                            <span class="badge-anio">
                                                <i class="fas fa-calendar-alt"></i>
                                                {{ $anioIngreso }}
                                            </span>
                                        @else
                                            <span class="badge-sin-calculo">
                                                <i class="fas fa-calendar-times"></i>
                                                —
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($ultimoPeriodo)
                                            <span class="periodo-actual">
                                                <i class="fas fa-clock"></i>
                                                {{ $ultimoPeriodo->nombre }}
                                            </span>
                                        @else
                                            <span class="badge-sin-calculo">
                                                <i class="fas fa-hourglass"></i>
                                                Sin cálculos
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($totalMeses > 0)
                                            <span class="badge-antiguedad">
                                                <i class="fas fa-star"></i>
                                                {{ $anios }} años, {{ $meses }} meses
                                            </span>
                                        @else
                                            <span class="badge-sin-calculo">
                                                <i class="fas fa-hourglass"></i>
                                                —
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">
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

            // Guardar los colores de las coordinaciones para mantener consistencia después del filtro AJAX
            const coloresCoordinaciones = {};
            document.querySelectorAll('.coordinacion-item').forEach(item => {
                const nombre = item.dataset.coordinacionNombre;
                const color = item.dataset.color;
                const fondo = item.dataset.fondo;
                if (nombre && color && fondo) {
                    coloresCoordinaciones[nombre] = { color, fondo };
                }
            });

            // Función para aplicar colores consistentes a los badges de la tabla
            function aplicarColoresTabla() {
                document.querySelectorAll('#tableBody tr').forEach(row => {
                    const celdaCoordinacion = row.querySelector('td:nth-child(2) .badge-coordinacion');
                    if (celdaCoordinacion) {
                        const nombreCoordinacion = celdaCoordinacion.textContent.trim();
                        if (coloresCoordinaciones[nombreCoordinacion]) {
                            const { color, fondo } = coloresCoordinaciones[nombreCoordinacion];
                            celdaCoordinacion.style.background = fondo;
                            celdaCoordinacion.style.color = color;
                            celdaCoordinacion.style.borderColor = color;
                        }
                    }
                });
            }

            // Función para cargar datos con AJAX
            async function cargarDatosFiltrados() {
                filterLoader.classList.add('active');

                const coordinacion = coordinacionSelect.value;
                const nombre = nombreInput.value.trim();

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
                    const response = await fetch(url.toString(), {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });
                    
                    const html = await response.text();
                    const temp = document.createElement('div');
                    temp.innerHTML = html;

                    // Actualizar estadísticas
                    const newTotalMaestros = temp.querySelector('#totalMaestros');
                    const newTotalCoordinaciones = temp.querySelector('#totalCoordinaciones');
                    if (newTotalMaestros) {
                        document.getElementById('totalMaestros').textContent = newTotalMaestros.textContent;
                    }
                    if (newTotalCoordinaciones) {
                        document.getElementById('totalCoordinaciones').textContent = newTotalCoordinaciones.textContent;
                    }

                    // Actualizar grid de coordinaciones
                    const newCoordinacionesGrid = temp.querySelector('#coordinacionesGrid');
                    if (newCoordinacionesGrid) {
                        document.getElementById('coordinacionesGrid').innerHTML = newCoordinacionesGrid.innerHTML;
                        // Recolectar colores nuevamente
                        document.querySelectorAll('.coordinacion-item').forEach(item => {
                            const nombre = item.querySelector('.coordinacion-nombre')?.textContent.trim();
                            const color = item.style.borderLeftColor;
                            const fondo = item.querySelector('.badge-coordinacion')?.style.background;
                            if (nombre && color) {
                                coloresCoordinaciones[nombre] = { color, fondo: fondo || '#f0f0f0' };
                            }
                        });
                    }

                    // Actualizar tabla de maestros
                    const newTableBody = temp.querySelector('#tableBody');
                    if (newTableBody) {
                        document.getElementById('tableBody').innerHTML = newTableBody.innerHTML;
                        aplicarColoresTabla();
                    }

                    // Actualizar información de resultados
                    const newResultsInfo = temp.querySelector('#resultsInfo');
                    if (newResultsInfo) {
                        document.getElementById('resultsInfo').innerHTML = newResultsInfo.innerHTML;
                    }

                    // Actualizar paginación
                    const newPagination = temp.querySelector('#paginationContainer');
                    const oldPagination = document.getElementById('paginationContainer');
                    if (newPagination && oldPagination) {
                        oldPagination.innerHTML = newPagination.innerHTML;
                    } else if (newPagination && !oldPagination) {
                        const tablaContainer = document.getElementById('tablaContainer');
                        const newPaginationClone = newPagination.cloneNode(true);
                        tablaContainer.appendChild(newPaginationClone);
                    } else if (!newPagination && oldPagination) {
                        oldPagination.remove();
                    }

                    window.history.pushState({}, '', url.toString());

                } catch (error) {
                    console.error('Error al filtrar:', error);
                    alert('Error al aplicar filtros. Por favor intenta de nuevo.');
                } finally {
                    filterLoader.classList.remove('active');
                }
            }

            btnFilter.addEventListener('click', function(e) {
                e.preventDefault();
                cargarDatosFiltrados();
            });

            btnClear.addEventListener('click', function(e) {
                e.preventDefault();
                coordinacionSelect.value = '';
                nombreInput.value = '';
                
                let url = new URL(window.location.href);
                url.search = '';
                window.history.pushState({}, '', url.toString());
                cargarDatosFiltrados();
            });

            nombreInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    cargarDatosFiltrados();
                }
            });

            // Aplicar colores iniciales
            aplicarColoresTabla();
        });
    </script>
</body>
</html>