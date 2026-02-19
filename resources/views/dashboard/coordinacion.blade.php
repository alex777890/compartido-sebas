<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Coordinación | GEPROC GP</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #1a4cba;
            --primary-dark: #0a3a9e;
            --primary-light: #2a5cd4;
            --secondary: #33CAE6;
            --accent: #26E63F;
            --dark-primary: #052e7a;
            --light-primary: rgba(26, 76, 186, 0.08);
            --light-bg: #f8fafc;
            --card-bg: #ffffff;
            --border-color: #e1e5eb;
            --text-muted: #64748b;
            --text-dark: #1e293b;
            --shadow-sm: 0 2px 8px rgba(26, 76, 186, 0.05);
            --shadow-md: 0 4px 12px rgba(26, 76, 186, 0.08);
            --shadow-lg: 0 8px 24px rgba(26, 76, 186, 0.12);
            --gradient-primary: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', 'Segoe UI', system-ui, sans-serif;
        }

        body {
            background: #f5f7fb;
            color: var(--text-dark);
            min-height: 100vh;
        }

        /* Top Bar Superior - MODIFICADA */
        .top-bar {
            background: white;
            height: 70px; /* Aumentada de 40px a 70px */
            border-bottom: 2px solid #e0e7ef;
            display: flex;
            align-items: center;
            padding: 0 40px;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1001;
            box-shadow: 0 2px 10px rgba(0,0,0,0.03);
        }

        .top-bar-content {
            max-width: 1400px;
            margin: 0 auto;
            width: 100%;
            display: flex;
            justify-content: space-between; /* Cambiado a space-between */
            align-items: center;
        }

        /* Header Logo - MODIFICADO (quitado el fondo/círculo) */
.header-logo {
    display: flex;
    align-items: center;
    padding: 0; /* Eliminado el padding */
    background: transparent; /* Eliminado el fondo gradiente */
    border-radius: 0; /* Eliminado el border-radius */
    box-shadow: none; /* Eliminada la sombra */
    border: none; /* Eliminado el borde */
}

.logo-img-header {
    width: 45px;
    height: 45px;
    object-fit: contain;
    margin-right: 12px;
}

.header-logo span {
    color: var(--primary);
    font-weight: 700;
    font-size: 1.3rem;
    letter-spacing: 0.5px;
}

        /* Elementos de la derecha en top bar */
        .top-bar-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .top-bar-item {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--text-muted);
            font-size: 0.9rem;
            padding: 5px 10px;
            border-radius: 30px;
            transition: all 0.2s ease;
        }

        .top-bar-item:hover {
            background: #f0f4fa;
        }

        .top-bar-item i {
            color: var(--primary);
            font-size: 1rem;
        }

        .top-bar-divider {
            width: 1px;
            height: 30px;
            background: #e0e7ef;
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            background: var(--light-primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-weight: 600;
            font-size: 1rem;
            border: 2px solid white;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        /* Main Navigation - Ahora con top padding ajustado */
        .top-nav {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            position: fixed;
            top: 70px; /* Ajustado a 70px (nueva altura de top bar) */
            left: 0;
            right: 0;
            z-index: 1000;
            box-shadow: 0 4px 20px rgba(26, 76, 186, 0.25);
        }

        .nav-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 40px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 70px;
        }

        /* Logo y menú a la izquierda */
        .nav-left {
            display: flex;
            align-items: center;
            gap: 30px;
        }

        /* Línea blanca entre espacio y menú */
        .divider-white {
            width: 2px;
            height: 40px;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 2px;
        }

        /* Menú */
        .nav-menu {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 24px;
            color: rgba(255, 255, 255, 0.85);
            text-decoration: none;
            border-radius: 10px;
            transition: all 0.2s ease;
            font-weight: 500;
            font-size: 1rem;
            position: relative;
        }

        .nav-item i {
            font-size: 1.1rem;
        }

        .nav-item:hover {
            background: rgba(255, 255, 255, 0.15);
            color: white;
            transform: translateY(-2px);
        }

        .nav-item.active {
            color: white;
            background: rgba(255, 255, 255, 0.12);
            font-weight: 600;
        }

        .nav-item.active::after {
            content: '';
            position: absolute;
            bottom: -18px;
            left: 0;
            width: 100%;
            height: 3px;
            background: white;
            border-radius: 3px 3px 0 0;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        /* Sección derecha */
        .nav-right {
            display: flex;
            align-items: center;
        }

        .logout-btn {
            background: rgba(255, 255, 255, 0.15);
            border: none;
            padding: 10px 20px;
            border-radius: 30px;
            color: white;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.95rem;
            font-weight: 500;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .logout-btn i {
            font-size: 1rem;
        }

        .logout-btn:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: translateY(-2px);
            border-color: rgba(255, 255, 255, 0.3);
        }

        /* Main Content - Ajustado por las dos barras */
        .main-content {
            margin-top: 140px; /* 70px (top bar) + 70px (nav) */
            padding: 30px 40px;
            min-height: calc(100vh - 140px);
        }

        .content-container {
            max-width: 1400px;
            margin: 0 auto;
        }

        /* Welcome Card */
        .welcome-card {
            background: white;
            border-radius: 20px;
            padding: 30px 35px;
            margin-bottom: 25px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.02);
            border: 1px solid #edf2f7;
        }

        .welcome-grid {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .welcome-content h1 {
            font-size: 1.8rem;
            color: var(--text-dark);
            font-weight: 600;
            margin-bottom: 8px;
        }

        .welcome-content h1 span {
            color: var(--primary);
        }

        .welcome-content p {
            color: var(--text-muted);
            font-size: 1rem;
        }

        .coordinacion-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--light-primary);
            padding: 6px 15px;
            border-radius: 25px;
            color: var(--primary);
            font-size: 0.9rem;
            margin-top: 12px;
        }

        .stats-mini-grid {
            display: flex;
            gap: 15px;
        }

        .stat-mini-card {
            background: #f8fafd;
            padding: 15px 25px;
            border-radius: 12px;
            text-align: center;
            min-width: 120px;
        }

        .stat-mini-card i {
            font-size: 1.5rem;
            color: var(--primary);
            margin-bottom: 8px;
        }

        .stat-mini-card h3 {
            font-size: 0.8rem;
            color: var(--text-muted);
            font-weight: 500;
            margin-bottom: 5px;
        }

        .stat-mini-card .number {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-dark);
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 25px;
        }

        .stat-card {
            background: white;
            border-radius: 16px;
            padding: 22px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.02);
            border: 1px solid #edf2f7;
            transition: all 0.2s ease;
        }

        .stat-card:hover {
            border-color: var(--primary);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(26, 76, 186, 0.06);
        }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: var(--light-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 1.3rem;
        }

        .stat-trend {
            background: rgba(38, 230, 63, 0.1);
            color: #1a9c2a;
            padding: 4px 10px;
            border-radius: 25px;
            font-size: 0.75rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .stat-content h3 {
            font-size: 0.85rem;
            color: var(--text-muted);
            margin-bottom: 8px;
            font-weight: 500;
        }

        .stat-number {
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--text-dark);
            line-height: 1;
            margin-bottom: 5px;
        }

        .stat-label {
            color: var(--text-muted);
            font-size: 0.85rem;
        }

        /* Quick Actions */
        .quick-actions {
            background: white;
            border-radius: 16px;
            padding: 25px;
            border: 1px solid #edf2f7;
        }

        .section-header {
            margin-bottom: 20px;
        }

        .section-header h2 {
            font-size: 1.3rem;
            color: var(--text-dark);
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-header h2 i {
            color: var(--primary);
            font-size: 1.4rem;
        }

        .actions-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
        }

        .action-card {
            background: #f8fafd;
            border-radius: 12px;
            padding: 18px;
            text-align: center;
            text-decoration: none;
            border: 1px solid #edf2f7;
            transition: all 0.2s ease;
        }

        .action-card:hover {
            border-color: var(--primary);
            transform: translateY(-2px);
            background: white;
            box-shadow: 0 8px 20px rgba(26, 76, 186, 0.06);
        }

        .action-icon {
            width: 52px;
            height: 52px;
            background: white;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 12px;
            color: var(--primary);
            font-size: 1.5rem;
            border: 1px solid #edf2f7;
        }

        .action-card h3 {
            font-size: 1rem;
            color: var(--text-dark);
            margin-bottom: 5px;
            font-weight: 600;
        }

        .action-card p {
            font-size: 0.8rem;
            color: var(--text-muted);
        }

        /* Footer */
        .footer {
            margin-top: 30px;
            padding: 20px;
            background: white;
            border-radius: 12px;
            text-align: center;
            color: var(--text-muted);
            font-size: 0.85rem;
            border: 1px solid #edf2f7;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .actions-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .welcome-grid {
                flex-direction: column;
                gap: 20px;
                align-items: flex-start;
            }
            
            .top-bar-right .top-bar-item span {
                display: none;
            }
        }

        @media (max-width: 768px) {
            .nav-menu {
                display: none;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .stats-mini-grid {
                flex-wrap: wrap;
            }
            
            .main-content {
                padding: 20px;
            }
            
            .top-bar {
                padding: 0 20px;
            }
            
            .top-bar-right {
                gap: 10px;
            }
        }

        /* Floating Action Button */
        .fab {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 54px;
            height: 54px;
            border-radius: 12px;
            background: var(--primary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            cursor: pointer;
            box-shadow: 0 6px 15px rgba(26, 76, 186, 0.3);
            transition: all 0.2s ease;
            z-index: 1000;
            border: none;
            text-decoration: none;
        }

        .fab:hover {
            background: var(--primary-dark);
            transform: scale(1.05);
        }

        /* Alert */
        #alertMessage {
            position: fixed;
            top: 150px;
            right: 20px;
            padding: 12px 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 6px 16px rgba(0,0,0,0.1);
            border-left: 4px solid var(--accent);
            z-index: 10000;
            display: none;
            font-size: 0.95rem;
            font-weight: 500;
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
        
        // Iniciales del usuario para el avatar
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

    <!-- Top Bar Superior - MODIFICADA con logo a la izquierda -->
    <div class="top-bar">
        <div class="top-bar-content">
            <!-- Logo en barra blanca - AHORA A LA IZQUIERDA -->
            <div class="header-logo">
                <img src="{{ asset('img/logo_iufim.png') }}" alt="Logo IUFIM" class="logo-img-header">
                <span>SISTEMA GEPROC</span>
            </div>
            
            <!-- Elementos de la derecha -->
            <div class="top-bar-right">
                <div class="top-bar-divider"></div>
                <div class="top-bar-item">
                    <div class="user-avatar">
                        {{ $userInitials ?: 'U' }}
                    </div>
                    <span>{{ $user->name ?? 'Usuario' }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Top Navigation - Menú principal -->
    <nav class="top-nav">
        <div class="nav-container">
            <div class="nav-left">
                <!-- Línea blanca separadora -->
                <div class="divider-white"></div>
                
                <!-- Menú de navegación -->
                <div class="nav-menu">
                    <a href="{{ route('coordinacion.dashboard') }}" class="nav-item active">
                        <i class="fas fa-home"></i>
                        <span>Inicio</span>
                    </a>
                    <a href="{{ route('coordinaciones.maestros-detalle') }}" class="nav-item">
                        <i class="fas fa-users"></i>
                        <span>Maestros</span>
                    </a>
                    <a href="{{ route('coordinaciones.maestros') }}" class="nav-item">
                        <i class="fas fa-file-alt"></i>
                        <span>Documentos</span>
                    </a>
                    <a href="{{ route('coordinaciones.estadisticas', $coordinacion->id ?? '#') }}" class="nav-item">
                        <i class="fas fa-chart-bar"></i>
                        <span>Estadísticas</span>
                    </a>
                    <a href="{{ route('coordinaciones.show', $coordinacion->id ?? '#') }}" class="nav-item">
                        <i class="fas fa-building"></i>
                        <span>Mi Coordinación</span>
                    </a>
                </div>
            </div>
            
            <div class="nav-right">                
                <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Cerrar sesión</span>
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        <div class="content-container">
            
            @if($coordinacion)
            <!-- Welcome Card -->
            <div class="welcome-card">
                <div class="welcome-grid">
                    <div class="welcome-content">
                        <h1>
                            Hola, <span>{{ $user->name }}</span>
                        </h1>
                        <p>Tu Coordinacion {{ $coordinacion->nombre }}</p>
                    </div>
                
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon">
                            <i class="fas fa-user-check"></i>
                        </div>
                        <span class="stat-trend">
                            <i class="fas fa-arrow-up"></i> 5%
                        </span>
                    </div>
                    <div class="stat-content">
                        <h3>Maestros Activos</h3>
                        <div class="stat-number">{{ $maestrosActivos ?? 0 }}</div>
                        <span class="stat-label">de {{ $totalMaestros ?? 0 }} totales</span>
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                    <div class="stat-content">
                        <h3>Total de Maestros</h3>
                        <div class="stat-number">{{ $totalMaestros ?? 0 }}</div>
                        <span class="stat-label">registrados</span>
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon">
                            <i class="fas fa-file-contract"></i>
                        </div>
                    </div>
                    <div class="stat-content">
                        <h3>Documentación</h3>
                        <div class="stat-number">{{ $documentosCompletos ?? 0 }}</div>
                        <span class="stat-label">completa</span>
                    </div>
                </div>
            </div>



            @endif

        
        </div>
    </main>

    <!-- Alert Container -->
    <div id="alertMessage"></div>

    <script>
        function showAlert(message, type = 'success') {
            const alertDiv = document.getElementById('alertMessage');
            alertDiv.textContent = message;
            alertDiv.style.borderLeftColor = type === 'success' ? '#26E63F' : '#ff6b6b';
            alertDiv.style.display = 'block';
            
            setTimeout(() => {
                alertDiv.style.display = 'none';
            }, 3000);
        }
    </script>
</body>
</html>