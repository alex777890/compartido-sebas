<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Antigüedad - {{ $maestro->nombres }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #0744b6ff;
            --primary-light: #eef3ff;
            --primary-dark: #053594;
            --secondary: #33CAE6;
            --accent: #28a745;
            --light-bg: #F8F9FA;
            --border-color: #E9ECEF;
            --text-muted: #6C757D;
            --text-dark: #2c3e50;
            --card-shadow: 0 15px 35px rgba(7, 68, 182, 0.08);
            --card-shadow-hover: 0 20px 40px rgba(7, 68, 182, 0.12);
            --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            --success-color: #28a745;
            --warning-color: #FFC107;
            --danger-color: #dc3545;
            --gradient-primary: linear-gradient(135deg, #0744b6 0%, #0f5ad6 100%);
            --gradient-success: linear-gradient(135deg, #28a745 0%, #34ce57 100%);
            --gradient-warning: linear-gradient(135deg, #ffc107 0%, #ffd54b 100%);
            --info-color: #17a2b8;
        }
        
        body { 
            background: linear-gradient(135deg, #f8faff 0%, #f0f3f8 100%);
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            color: var(--text-dark); 
            line-height: 1.6;
            margin: 0;
            padding: 0;
            min-height: 100vh;
        }
        
        /* ========== ESTILOS DE BARRA Y MENÚ (SIN CAMBIOS) ========== */

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
        
        /* ========== ESTILOS REDISEÑADOS PARA EL CONTENIDO PRINCIPAL ========== */
        .main-content {
            padding: 2.5rem;
            max-width: 1500px;
            margin: 0 auto;
        }
        
        /* Header con diseño mejorado - NOMBRE MÁS PEQUEÑO */
        .page-header {
            background: white;
            border-radius: 24px;
            padding: 1.8rem 2.5rem;
            margin-bottom: 2rem;
            box-shadow: var(--card-shadow);
            border: 1px solid rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(10px);
        }
        
        .header-icon {
            width: 54px;
            height: 54px;
            background: var(--gradient-primary);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.6rem;
            box-shadow: 0 8px 16px rgba(7, 68, 182, 0.15);
        }
        
        .teacher-name {
            font-size: 1.7rem;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 0.2rem;
            line-height: 1.2;
        }
        
        .teacher-subtitle {
            color: var(--text-muted);
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .teacher-subtitle i {
            color: var(--primary);
            font-size: 0.8rem;
        }
        
        /* Botones con diseño moderno */
        .btn-modern {
            padding: 0.7rem 1.4rem;
            border-radius: 12px;
            font-weight: 500;
            transition: var(--transition);
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.95rem;
        }
        
        .btn-outline-modern {
            background: transparent;
            border: 1.5px solid var(--primary);
            color: var(--primary);
        }
        
        .btn-outline-modern:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(7, 68, 182, 0.15);
        }
        
        .btn-primary-modern {
            background: var(--gradient-primary);
            color: white;
        }
        
        .btn-primary-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(7, 68, 182, 0.2);
        }
        
        /* Tarjetas de sección */
        .section-card-modern {
            background: white;
            border-radius: 24px;
            box-shadow: var(--card-shadow);
            margin-bottom: 2rem;
            border: none;
            overflow: hidden;
            transition: var(--transition);
        }
        
        .card-header-modern {
            background: white;
            padding: 1.4rem 2rem;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .card-header-modern h5 {
            color: var(--primary);
            font-weight: 600;
            font-size: 1.2rem;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .card-header-modern h5 i {
            font-size: 1.3rem;
        }
        
        .card-body-modern {
            padding: 2rem;
        }
        
        /* Año de ingreso - MINIMAL */
        .ingreso-card-mini {
            background: white;
            border: 1px solid var(--border-color);
            border-radius: 14px;
            padding: 1rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 15px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.02);
        }
        
        .ingreso-icon-mini {
            width: 42px;
            height: 42px;
            background: var(--light-bg);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-muted);
            font-size: 1.1rem;
        }
        
        .ingreso-text-mini h6 {
            color: var(--text-muted);
            font-size: 0.8rem;
            margin-bottom: 0.1rem;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }
        
        .ingreso-text-mini h4 {
            color: var(--text-dark);
            font-size: 1.4rem;
            font-weight: 600;
            margin-bottom: 0;
            line-height: 1.2;
        }
        
        .badge-mini-warning {
            background: #fff3cd;
            color: #856404;
            padding: 0.25rem 0.8rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 500;
            margin-left: 1rem;
        }
        
        /* Tarjetas de resumen - MEJORADAS */
        .summary-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.2rem;
        }
        
        .summary-card-modern {
            background: white;
            border-radius: 18px;
            padding: 1.5rem 1.2rem;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.02);
            border: 1px solid var(--border-color);
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }
        
        .summary-card-modern::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: var(--gradient-primary);
        }
        
        .summary-card-modern:hover {
            transform: translateY(-3px);
            box-shadow: var(--card-shadow);
        }
        
        .summary-icon {
            width: 48px;
            height: 48px;
            background: var(--primary-light);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 0.8rem;
            color: var(--primary);
            font-size: 1.4rem;
        }
        
        .summary-card-modern h5 {
            color: var(--text-muted);
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.3rem;
        }
        
        .summary-card-modern h2 {
            font-size: 2rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 0.1rem;
            line-height: 1.2;
        }
        
        .summary-card-modern small {
            color: var(--text-muted);
            font-size: 0.8rem;
        }
        
        .summary-total-modern {
            background: var(--gradient-primary);
            border-radius: 18px;
            padding: 1.5rem 1.2rem;
            text-align: center;
            color: white;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            box-shadow: 0 10px 20px rgba(7, 68, 182, 0.25);
            transform: scale(1.02);
            border: 2px solid rgba(255, 255, 255, 0.2);
        }
        
        .summary-total-modern h5 {
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.3rem;
        }
        
        .summary-total-modern h4 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0;
            line-height: 1.2;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }
        
        /* Tabla MEJORADA */
        .table-responsive-modern {
            overflow-x: auto;
            border-radius: 14px;
        }
        
        .table-modern {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 10px;
        }
        
        .table-modern thead th {
            background: transparent;
            color: var(--text-muted);
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 1rem 1.2rem;
            border: none;
        }
        
        .table-modern tbody tr {
            background: white;
            border-radius: 14px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.02);
            transition: var(--transition);
        }
        
        .table-modern tbody tr:hover {
            box-shadow: 0 8px 20px rgba(7, 68, 182, 0.1);
        }
        
        .table-modern td {
            padding: 1.2rem 1.2rem;
            border: none;
            vertical-align: middle;
            font-size: 1rem;
        }
        
        .table-modern td:first-child {
            border-radius: 14px 0 0 14px;
        }
        
        .table-modern td:last-child {
            border-radius: 0 14px 14px 0;
        }
        
        .periodo-badge {
            background: var(--primary-light);
            color: var(--primary);
            padding: 0.3rem 1rem;
            border-radius: 30px;
            font-size: 0.85rem;
            font-weight: 500;
            display: inline-block;
        }
        
        .anio-badge-modern {
            background: var(--light-bg);
            color: var(--text-dark);
            padding: 0.3rem 0.8rem;
            border-radius: 30px;
            font-size: 0.85rem;
            font-weight: 500;
            margin: 0.1rem;
            display: inline-block;
            transition: var(--transition);
            border: 1px solid var(--border-color);
        }
        
        .anio-badge-modern:hover {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }
        
        .total-meses-badge {
            background: var(--gradient-primary);
            color: white;
            padding: 0.4rem 1rem;
            border-radius: 30px;
            font-size: 0.95rem;
            font-weight: 600;
            display: inline-block;
            box-shadow: 0 4px 8px rgba(7, 68, 182, 0.2);
        }
        
        .fecha-small {
            color: var(--text-muted);
            font-size: 0.75rem;
            display: block;
            margin-top: 0.25rem;
        }
        
        .btn-group-modern {
            display: flex;
            gap: 6px;
        }
        
        .btn-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
            border: none;
            background: transparent;
            color: var(--text-muted);
            font-size: 1rem;
        }
        
        .btn-icon:hover {
            background: var(--light-bg);
            color: var(--primary);
        }
        
        .btn-icon-warning:hover {
            background: #fff3cd;
            color: #ffc107;
        }
        
        .btn-icon-danger:hover {
            background: #f8d7da;
            color: #dc3545;
        }
        
        /* Empty state */
        .empty-state {
            text-align: center;
            padding: 3.5rem 2rem;
        }
        
        .empty-state-icon {
            width: 80px;
            height: 80px;
            background: var(--primary-light);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.2rem;
            color: var(--primary);
            font-size: 2.2rem;
        }
        
        .empty-state h4 {
            color: var(--text-dark);
            font-weight: 600;
            font-size: 1.3rem;
            margin-bottom: 0.3rem;
        }
        
        .empty-state p {
            color: var(--text-muted);
            font-size: 0.95rem;
            margin-bottom: 1.8rem;
        }
        
        /* Alert info */
        .alert-modern {
            background: var(--primary-light);
            border: none;
            border-radius: 14px;
            padding: 1.2rem 1.5rem;
            color: var(--primary-dark);
            font-size: 0.95rem;
        }
        
        .alert-modern i {
            color: var(--primary);
        }
        
        @media (max-width: 992px) {
            .summary-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        @media (max-width: 768px) {
            .main-content {
                padding: 1.2rem;
            }
            
            .summary-grid {
                grid-template-columns: 1fr;
            }
            
            .teacher-name {
                font-size: 1.5rem;
            }
            
            .page-header {
                padding: 1.2rem;
            }
            
            .table-modern td {
                padding: 1rem;
                font-size: 0.9rem;
            }
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
    
    <!-- Segunda barra - Menú -->
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
        <!-- Main Content - REDISEÑADO -->
        <div class="main-content">
            <!-- Header con nombre MÁS PEQUEÑO -->
            <div class="page-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center gap-3">
                        <div class="header-icon">
                            <i class="fas fa-history"></i>
                        </div>
                        <div>
                            <h1 class="teacher-name">{{ $maestro->nombres }} {{ $maestro->apellido_paterno }} {{ $maestro->apellido_materno }}</h1>
                            <div class="teacher-subtitle">
                                <i class="fas fa-id-card"></i>
                                <span>Historial de Antigüedad</span>
                                <i class="fas fa-circle" style="font-size: 3px;"></i>
                                <span>{{ $maestro->coordinacion->nombre ?? 'Sin coordinación' }}</span>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('maestros.show', $maestro) }}" class="btn btn-outline-modern btn-modern">
                        <i class="fas fa-arrow-left"></i>
                        Volver
                    </a>
                </div>
            </div>

            <!-- AÑO DE INGRESO - Versión mini -->
            <div class="section-card-modern">
                <div class="card-body-modern">
                    <div class="ingreso-card-mini">
                        <div class="ingreso-icon-mini">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <div class="ingreso-text-mini">
                            <h6>Año de Ingreso del Docente</h6>
                            <div class="d-flex align-items-center">
                                <h4>{{ $maestro->anio_ingreso ?? 'No registrado' }}</h4>
                                @if(!$maestro->anio_ingreso)
                                    <span class="badge-mini-warning">
                                        <i class="fas fa-exclamation-triangle me-1"></i>
                                        Pendiente
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Resumen de Antigüedad - CON MEJOR DISEÑO -->
            @if(isset($antiguedad) && isset($antiguedad['total_meses']) && $antiguedad['total_meses'] > 0)
            <div class="section-card-modern">
                <div class="card-header-modern">
                    <h5>
                        <i class="fas fa-chart-bar"></i>
                        Resumen de Antigüedad
                    </h5>
                </div>
                <div class="card-body-modern">
                    <div class="summary-grid">
                        <div class="summary-card-modern">
                            <div class="summary-icon">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                            <h5>Total Meses</h5>
                            <h2>{{ $antiguedad['total_meses'] }}</h2>
                            <small>meses acumulados</small>
                        </div>
                        
                        <div class="summary-card-modern">
                            <div class="summary-icon" style="background: rgba(40, 167, 69, 0.1); color: var(--success-color);">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                            <h5>Años Completos</h5>
                            <h2>{{ $antiguedad['anios'] }}</h2>
                            <small>años</small>
                        </div>
                        
                        <div class="summary-card-modern">
                            <div class="summary-icon" style="background: rgba(255, 193, 7, 0.1); color: var(--warning-color);">
                                <i class="fas fa-calendar-plus"></i>
                            </div>
                            <h5>Meses Adicionales</h5>
                            <h2>{{ $antiguedad['meses'] }}</h2>
                            <small>meses</small>
                        </div>
                        
                        <div class="summary-total-modern">
                            <h5>Antigüedad Total</h5>
                            <h4>{{ $antiguedad['anios'] }} años {{ $antiguedad['meses'] }} meses</h4>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Tabla de Períodos - CON AÑO DE INGRESO AGREGADO -->
            <div class="section-card-modern">
                <div class="card-header-modern">
                    <h5>
                        <i class="fas fa-table"></i>
                        Períodos Registrados
                    </h5>
                    <a href="{{ route('maestros.calcular-antiguedad', $maestro) }}" class="btn btn-primary-modern btn-modern">
                        <i class="fas fa-plus"></i>
                        Calcular Antiguedad
                    </a>
                </div>
                <div class="card-body-modern">
                    @if($periodosTrabajados->count() > 0)
                        @php
                            // Agrupar períodos por ID
                            $periodosAgrupados = [];
                            foreach($periodosTrabajados as $periodo) {
                                $periodoId = $periodo->id;
                                if(!isset($periodosAgrupados[$periodoId])) {
                                    $periodosAgrupados[$periodoId] = [
                                        'nombre' => $periodo->nombre,
                                        'fecha' => $periodo->pivot->created_at,
                                        'años' => [],
                                        'total_meses' => 0
                                    ];
                                }
                                
                                $anio = $periodo->pivot->anio_periodo;
                                $meses = json_decode($periodo->pivot->meses_trabajados, true) ?? [];
                                $totalMeses = count($meses);
                                
                                $periodosAgrupados[$periodoId]['años'][] = $anio;
                                $periodosAgrupados[$periodoId]['total_meses'] += $totalMeses;
                            }
                        @endphp
                        
                        <div class="table-responsive-modern">
                            <table class="table-modern">
                                <thead>
                                    <tr>
                                        <th>Período</th>
                                        <th>Año Ingreso</th>
                                        <th>Años Trabajados</th>
                                        <th>Total Meses</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($periodosAgrupados as $periodoId => $datos)
                                    <tr>
                                        <td>
                                            <span class="periodo-badge">
                                                <i class="fas fa-calendar me-1"></i>
                                                {{ $datos['nombre'] }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="anio-badge-modern" style="background: var(--primary-light); color: var(--primary); font-weight: 600;">
                                                <i class="fas fa-calendar-check me-1"></i>
                                                {{ $maestro->anio_ingreso ?? '—' }}
                                            </span>
                                        </td>
                                        <td>
                                            @foreach($datos['años'] as $anio)
                                                <span class="anio-badge-modern">
                                                    {{ $anio }}
                                                </span>
                                            @endforeach
                                        </td>
                                        <td>
                                            <span class="total-meses-badge">
                                                {{ $datos['total_meses'] }} meses
                                            </span>
                                        </td>
                                        <td>
                                            <div class="btn-group-modern">
                                                <a href="{{ route('maestros.calcular-antiguedad', ['maestro' => $maestro, 'periodo_id' => $periodoId]) }}" 
                                                   class="btn-icon btn-icon-warning"
                                                   title="Editar período">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                
                                                <form action="{{ route('maestros.eliminar-periodo', $maestro) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="periodo_id" value="{{ $periodoId }}">
                                                    <input type="hidden" name="anio_periodo" value="{{ $datos['años'][0] ?? '' }}">
                                                    <button type="submit" class="btn-icon btn-icon-danger" 
                                                            onclick="return confirm('¿Está seguro de eliminar este período?')"
                                                            title="Eliminar período">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="empty-state">
                            <div class="empty-state-icon">
                                <i class="fas fa-inbox"></i>
                            </div>
                            <h4>No hay períodos registrados</h4>
                            <p>Comience agregando el primer período de trabajo</p>
                            <a href="{{ route('maestros.calcular-antiguedad', $maestro) }}" class="btn btn-primary-modern btn-modern">
                                <i class="fas fa-plus me-2"></i>
                                Calcular Antigüedad
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Información sobre el cálculo -->
            <div class="alert-modern d-flex align-items-start gap-2">
                <i class="fas fa-info-circle fa-lg mt-1"></i>
                <div>
                    <p class="mb-0"><strong>Calculo de Atiguedad:</strong> Cuando se realiza un calculo de atiguedad se agrega al historial pero se va haciedo la suma de todos los calculos, si solo quieres un caculo de antiguedad edita la atiguedad que seleccione</p>
                    <p class="mb-0"><strong>¿Cómo se calcula?</strong> Suma de meses trabajados ÷ 12 = Años completos + Meses restantes.</p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>