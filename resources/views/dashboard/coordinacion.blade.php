<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Coordinación - Sistema GEPROC</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
            --card-shadow: 0 5px 20px rgba(7, 68, 182, 0.12);
            --card-shadow-hover: 0 10px 30px rgba(7, 68, 182, 0.2);
            --transition: all 0.3s ease;
            --success-color: #10b981;
            --success-light: #d1fae5;
            --warning-color: #f59e0b;
            --warning-light: #fef3c7;
            --danger-color: #ef4444;
            --danger-light: #fee2e2;
            --info-color: #3b82f6;
            --info-light: #dbeafe;
            --border-radius: 12px;
            --gradient-primary: linear-gradient(135deg, #0744b6ff 0%, #3a6bd3 100%);
            --gradient-success: linear-gradient(135deg, #10b981 0%, #34d399 100%);
            --gradient-warning: linear-gradient(135deg, #f59e0b 0%, #fbbf24 100%);
            --gradient-danger: linear-gradient(135deg, #ef4444 0%, #f87171 100%);
            --gradient-info: linear-gradient(135deg, #3b82f6 0%, #60a5fa 100%);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #f5f7fb 0%, #f0f4f8 100%);
            color: #2d3748;
            line-height: 1.6;
            min-height: 100vh;
            font-size: 15px;
        }

        /* ===== HEADER SUPERIOR ===== */
        .header {
            height: 90px;
            background-color: white;
            box-shadow: 0 3px 20px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 40px;
            position: sticky;
            top: 0;
            z-index: 100;
            border-bottom: 4px solid var(--primary);
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 40px;
        }

        .header-logo {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .logo-img-header {
            height: 65px;
            width: auto;
            max-width: 180px;
            object-fit: contain;
        }

        .header-nav {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .nav-link {
            padding: 15px 22px;
            color: #4a5568;
            text-decoration: none;
            font-weight: 600;
            font-size: 16px;
            border-radius: 10px;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 12px;
            white-space: nowrap;
        }

        .nav-link:hover {
            background-color: #e8f0fe;
            color: var(--primary);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(7, 68, 182, 0.12);
        }

        .nav-link.active {
            background-color: #e8f0fe;
            color: var(--primary);
            box-shadow: 0 8px 16px rgba(7, 68, 182, 0.15);
            border-radius: 10px;
            font-weight: 700;
        }

        .nav-link i {
            font-size: 16px;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 30px;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 8px 16px;
            background-color: var(--light-bg);
            border-radius: 50px;
            cursor: pointer;
            transition: var(--transition);
            border: 2px solid var(--border-color);
        }

        .user-profile:hover {
            background-color: #e9ecef;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--gradient-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 16px;
        }

        .user-info {
            display: flex;
            flex-direction: column;
        }

        .user-info h4 {
            font-size: 15px;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 2px;
            white-space: nowrap;
        }

        .user-info p {
            font-size: 12px;
            color: var(--text-muted);
            white-space: nowrap;
        }

        .logout-button {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 28px;
            background-color: white;
            color: #4a5568;
            border: none;
            border-radius: 50px;
            font-weight: 600;
            font-size: 15px;
            cursor: pointer;
            transition: var(--transition);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .logout-button:hover {
            background-color: #fee2e2;
            color: var(--danger-color);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(239, 68, 68, 0.15);
        }

        .logout-button i {
            font-size: 16px;
        }

        /* Botón hamburguesa para móvil */
        .hamburger-btn {
            display: none;
            background: transparent;
            border: none;
            font-size: 24px;
            color: var(--primary);
            cursor: pointer;
            padding: 10px;
        }

        /* Menú móvil */
        .mobile-menu {
            display: none;
            position: fixed;
            top: 90px;
            left: 0;
            right: 0;
            background: white;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            z-index: 99;
            padding: 20px;
            border-bottom: 2px solid var(--border-color);
            transform: translateY(-100%);
            transition: transform 0.3s ease;
        }

        .mobile-menu.open {
            transform: translateY(0);
        }

        .mobile-nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 15px;
            color: #4a5568;
            text-decoration: none;
            font-weight: 600;
            border-radius: 10px;
            transition: var(--transition);
        }

        .mobile-nav-link:hover {
            background-color: var(--primary-soft);
            color: var(--primary);
        }

        .mobile-nav-link.active {
            background-color: var(--primary-soft);
            color: var(--primary);
        }

        /* MAIN CONTENT */
        .main-content {
            flex: 1;
        }

        .content-wrapper {
            padding: 30px 35px;
            max-width: 100%;
        }

        /* SECCIÓN DE BIENVENIDA */
        .welcome-section {
            background-color: white;
            border-radius: var(--border-radius);
            padding: 25px 30px;
            margin-bottom: 25px;
            box-shadow: var(--card-shadow);
            border: 2px solid var(--border-color);
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }

        .welcome-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            
        }

        .welcome-section:hover {
            transform: translateY(-3px);
            box-shadow: var(--card-shadow-hover);
        }

        .welcome-title {
            font-size: 28px;
            font-weight: 750;
            color: var(--primary);
            margin-bottom: 12px;
        }

        .welcome-title span {
            color: var(--primary);
        }

        .welcome-subtitle {
            font-size: 16px;
            color: var(--text-muted);
            margin-bottom: 0;
        }

        .coordinacion-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--primary-soft);
            padding: 8px 16px;
            border-radius: 50px;
            color: var(--primary);
            font-size: 14px;
            font-weight: 600;
            margin-top: 12px;
        }

        /* CARDS GRID - ESTADÍSTICAS */
        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            margin-bottom: 25px;
        }

        .card {
            background-color: white;
            border-radius: 14px;
            padding: 20px;
            box-shadow: var(--card-shadow);
            transition: var(--transition);
            border: 2px solid var(--border-color);
            position: relative;
            overflow: hidden;
        }

        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: var(--card-shadow-hover);
        }

        .card-header {
            display: flex;
            align-items: center;
            margin-bottom: 12px;
        }

        .card-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            font-size: 22px;
            color: white;
            box-shadow: 0 5px 10px rgba(0,0,0,0.1);
        }

        .card-icon.activos { background: var(--gradient-success); }
        .card-icon.total { background: var(--gradient-primary); }
        .card-icon.documentos { background: var(--gradient-info); }

        .card-title h3 {
            font-size: 15px;
            color: var(--text-muted);
            margin-bottom: 5px;
            font-weight: 600;
        }

        .card-value {
            font-size: 32px;
            font-weight: 800;
            color: #1e293b;
            line-height: 1;
        }

        .card-footer {
            margin-top: 10px;
            color: var(--text-muted);
            font-size: 13px;
            font-weight: 500;
        }

        /* ACCIONES RÁPIDAS */
        .section {
            background-color: white;
            border-radius: 16px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: var(--card-shadow);
            border: 2px solid var(--border-color);
            transition: var(--transition);
        }

        .section:hover {
            box-shadow: var(--card-shadow-hover);
        }

        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid var(--light-bg);
            flex-wrap: wrap;
            gap: 15px;
        }

        .section-title {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 20px;
            color: var(--primary);
            font-weight: 700;
        }

        .section-title i {
            font-size: 22px;
        }

        /* GRID DE ACCIONES */
        .actions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        .action-card {
            background-color: var(--light-bg);
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            text-decoration: none;
            border: 2px solid var(--border-color);
            transition: var(--transition);
            display: block;
        }

        .action-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--card-shadow-hover);
            border-color: var(--primary);
            background-color: white;
        }

        .action-icon {
            width: 60px;
            height: 60px;
            background: white;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            color: var(--primary);
            font-size: 24px;
            border: 2px solid var(--border-color);
            transition: var(--transition);
        }

        .action-card:hover .action-icon {
            border-color: var(--primary);
            background: var(--primary-soft);
        }

        .action-card h3 {
            font-size: 16px;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 5px;
        }

        .action-card p {
            font-size: 13px;
            color: var(--text-muted);
        }

        /* FOOTER */
        .footer {
            background-color: white;
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            color: var(--text-muted);
            font-size: 13px;
            border: 2px solid var(--border-color);
        }

        /* ALERTA FLOTANTE */
        .alert-floating {
            position: fixed;
            top: 100px;
            right: 20px;
            padding: 15px 20px;
            background-color: white;
            border-left: 4px solid var(--success-color);
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            z-index: 1000;
            display: none;
            font-size: 14px;
            font-weight: 500;
            color: #2d3748;
        }

        /* RESPONSIVE */
        @media (max-width: 1200px) {
            .header {
                padding: 0 25px;
                height: auto;
                flex-direction: column;
                gap: 15px;
                padding: 15px;
            }
            
            .header-left, .header-right {
                width: 100%;
                justify-content: space-between;
            }
            
            .header-nav {
                overflow-x: auto;
                padding-bottom: 10px;
                width: 100%;
            }
            
            .nav-link {
                padding: 12px 16px;
                font-size: 15px;
            }
            
            .content-wrapper {
                padding: 20px 25px;
            }
        }

        @media (max-width: 992px) {
            .cards-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .actions-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .header-nav {
                display: none;
            }
            
            .hamburger-btn {
                display: block;
            }
            
            .mobile-menu {
                display: block;
            }
            
            .cards-grid {
                grid-template-columns: 1fr;
            }
            
            .actions-grid {
                grid-template-columns: 1fr;
            }
            
            .header-left {
                flex-direction: row;
                justify-content: space-between;
                width: 100%;
            }
            
            .user-info h4 {
                font-size: 14px;
            }
            
            .user-info p {
                font-size: 11px;
            }
            
            .section {
                padding: 18px;
            }
            
            .header-right {
                flex-wrap: wrap;
                justify-content: flex-end;
            }
            
            .welcome-title {
                font-size: 24px;
            }
            
            .logout-button {
                padding: 8px 16px;
                font-size: 13px;
            }
            
            .user-profile {
                padding: 6px 12px;
            }
            
            .user-avatar {
                width: 35px;
                height: 35px;
                font-size: 14px;
            }
        }

        @media (max-width: 480px) {
            .content-wrapper {
                padding: 15px;
            }
            
            .card-value {
                font-size: 26px;
            }
            
            .section-title {
                font-size: 18px;
            }
            
            .welcome-section {
                padding: 18px;
            }
            
            .coordinacion-badge {
                font-size: 12px;
                padding: 6px 12px;
            }
        }
    </style>
</head>
<body>

@php
    use Illuminate\Support\Facades\Auth;
    use App\Models\Coordinacion;
    use App\Models\Maestro;
    
    $user = Auth::user();
    $coordinacion = $user->coordinaciones_id ? Coordinacion::find($user->coordinaciones_id) : null;
    
    if (isset($coordinacionControlador) && $coordinacionControlador) {
        $coordinacion = $coordinacionControlador;
    }
    
    if ($coordinacion) {
        if (!isset($totalMaestros)) {
            $totalMaestros = Maestro::where('coordinaciones_id', $coordinacion->id)->count();
        }
        if (!isset($maestrosActivos)) {
            $maestrosActivos = Maestro::where('coordinaciones_id', $coordinacion->id)
                ->where('activo', 1)
                ->count();
        }
        if (!isset($documentosCompletos)) {
            $documentosCompletos = 0;
        }
    }
    
    $userInitials = '';
    if ($user && $user->name) {
        $names = explode(' ', $user->name);
        foreach ($names as $name) {
            if (!empty($name)) {
                $userInitials .= strtoupper(substr($name, 0, 1));
            }
        }
        $userInitials = substr($userInitials, 0, 2);
    }
@endphp

<div class="main-content">
    <!-- HEADER SUPERIOR -->
    <div class="header">
        <div class="header-left">
            <div class="header-logo">
                <img src="{{ asset('img/logo_iufim.png') }}" alt="Logo IUFIM" class="logo-img-header">
            </div>
            <button class="hamburger-btn" id="hamburgerBtn">
                <i class="fas fa-bars"></i>
            </button>
            <div class="header-nav">
                <a href="{{ route('coordinacion.dashboard') }}" class="nav-link active">
                    <i class="fas fa-home"></i> Inicio
                </a>
                <a href="{{ route('coordinaciones.maestros-detalle') }}" class="nav-link">
                    <i class="fas fa-users"></i> Maestros
                </a>
                <a href="{{ route('coordinaciones.maestros') }}" class="nav-link">
                    <i class="fas fa-file-alt"></i> Documentos
                </a>
                <a href="{{ route('coordinaciones.estatus') }}" class="nav-link">
                    <i class="fas fa-chart-bar"></i> Estadísticas
                </a>
            </div>
        </div>
        
        <div class="header-right">
            
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-button">
                    <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                </button>
            </form>
        </div>
    </div>

    <!-- MENÚ MÓVIL -->
    <div class="mobile-menu" id="mobileMenu">
        <a href="{{ route('coordinacion.dashboard') }}" class="mobile-nav-link active">
            <i class="fas fa-home"></i> Inicio
        </a>
        <a href="{{ route('coordinaciones.maestros-detalle') }}" class="mobile-nav-link">
            <i class="fas fa-users"></i> Maestros
        </a>
        <a href="{{ route('coordinaciones.maestros') }}" class="mobile-nav-link">
            <i class="fas fa-file-alt"></i> Documentos
        </a>
        <a href="{{ route('coordinaciones.estatus') }}" class="mobile-nav-link">
            <i class="fas fa-chart-bar"></i> Estadísticas
        </a>
    </div>

    <!-- CONTENIDO PRINCIPAL -->
    <div class="content-wrapper">
        @if($coordinacion)
        <!-- TARJETA DE BIENVENIDA -->
        <div class="welcome-section">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 20px;">
                <div>
                    <h1 class="welcome-title">
                        Hola, <span>{{ $user->name ?? 'Coordinador' }}</span>
                    </h1>
                    <div class="coordinacion-badge">
                        <i class="fas fa-building"></i>
                        Coordinación: {{ $coordinacion->nombre }}
                    </div>
                </div>
                <div>
                    <i class="fas fa-chalkboard-user" style="font-size: 70px; color: var(--primary); opacity: 0.5;"></i>
                </div>
            </div>
        </div>

        <!-- ESTADÍSTICAS -->
        <div class="cards-grid">
            <div class="card">
                <div class="card-header">
                    <div class="card-icon activos">
                        <i class="fas fa-user-check"></i>
                    </div>
                    <div class="card-title">
                        <h3>Maestros Activos</h3>
                    </div>
                </div>
                <div class="card-value">{{ $maestrosActivos ?? 0 }}</div>
                <div class="card-footer">de {{ $totalMaestros ?? 0 }} totales</div>
            </div>

            <div class="card">
                <div class="card-header">
                    <div class="card-icon total">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="card-title">
                        <h3>Total de Maestros</h3>
                    </div>
                </div>
                <div class="card-value">{{ $totalMaestros ?? 0 }}</div>
                <div class="card-footer">registrados en el sistema</div>
            </div>

            <div class="card">
                <div class="card-header">
                    <div class="card-icon documentos">
                        <i class="fas fa-file-contract"></i>
                    </div>
                    <div class="card-title">
                        <h3>Documentación Completa</h3>
                    </div>
                </div>
                <div class="card-value">{{ $documentosCompletos ?? 0 }}</div>
                <div class="card-footer">maestros con documentos completos</div>
            </div>
        </div>

        <!-- ACCIONES RÁPIDAS -->
        <div class="section">
            <div class="section-header">
                <div class="section-title">
                    <i class="fas fa-bolt"></i>
                    <span>Acciones Rápidas</span>
                </div>
            </div>

            <div class="actions-grid">
                <a href="{{ route('coordinaciones.maestros-detalle') }}" class="action-card">
                    <div class="action-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3>Gestionar Maestros</h3>
                    <p>Ver y administrar maestros</p>
                </a>

                <a href="{{ route('coordinaciones.maestros') }}" class="action-card">
                    <div class="action-icon">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <h3>Revisar Documentos</h3>
                    <p>Validar documentación de maestros</p>
                </a>

                <a href="{{ route('coordinaciones.estatus') }}" class="action-card">
                    <div class="action-icon">
                        <i class="fas fa-chart-bar"></i>
                    </div>
                    <h3>Ver Estadísticas</h3>
                    <p>Reportes y métricas detalladas</p>
                </a>
            </div>
        </div>
        @endif

        <!-- FOOTER -->
        <div class="footer">
            <p>Sistema GEPROC - Gestión de Procesos y Documentación</p>
        </div>
    </div>
</div>

<!-- ALERTA FLOTANTE -->
<div id="alertMessage" class="alert-floating"></div>

<script>
    // Control del menú hamburguesa
    const hamburgerBtn = document.getElementById('hamburgerBtn');
    const mobileMenu = document.getElementById('mobileMenu');
    
    function toggleMenu() {
        mobileMenu.classList.toggle('open');
        const icon = hamburgerBtn.querySelector('i');
        if (mobileMenu.classList.contains('open')) {
            icon.classList.remove('fa-bars');
            icon.classList.add('fa-times');
        } else {
            icon.classList.remove('fa-times');
            icon.classList.add('fa-bars');
        }
    }
    
    function closeMenu() {
        mobileMenu.classList.remove('open');
        const icon = hamburgerBtn.querySelector('i');
        icon.classList.remove('fa-times');
        icon.classList.add('fa-bars');
    }
    
    if (hamburgerBtn) {
        hamburgerBtn.addEventListener('click', toggleMenu);
    }
    
    // Cerrar menú al hacer click en un enlace
    const mobileLinks = document.querySelectorAll('.mobile-nav-link');
    mobileLinks.forEach(link => {
        link.addEventListener('click', closeMenu);
    });
    
    // Cerrar menú al redimensionar a escritorio
    window.addEventListener('resize', () => {
        if (window.innerWidth > 768 && mobileMenu.classList.contains('open')) {
            closeMenu();
        }
    });
    
    // Función de alerta
    function showAlert(message, type = 'success') {
        const alertDiv = document.getElementById('alertMessage');
        alertDiv.textContent = message;
        alertDiv.style.borderLeftColor = type === 'success' ? '#10b981' : '#ef4444';
        alertDiv.style.display = 'block';
        
        setTimeout(() => {
            alertDiv.style.display = 'none';
        }, 3000);
    }
    
    // Resaltar el enlace activo basado en la URL actual
    const currentPath = window.location.pathname;
    const desktopItems = document.querySelectorAll('.nav-link');
    const mobileItems = document.querySelectorAll('.mobile-nav-link');
    
    function setActiveLink(items) {
        items.forEach(item => {
            const href = item.getAttribute('href');
            if (href && currentPath.includes(href) && href !== '#') {
                items.forEach(i => i.classList.remove('active'));
                item.classList.add('active');
            }
        });
    }
    
    setActiveLink(desktopItems);
    setActiveLink(mobileItems);
</script>
</body>
</html>