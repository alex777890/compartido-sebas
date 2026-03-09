<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expediente de {{ $maestro->nombres }} {{ $maestro->apellido_paterno }} | GEPROC GP</title>
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
        .maestro-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        /* Avatar modificado: borde azul y fondo blanco */
        .maestro-avatar {
            width: 45px;
            height: 45px;
            border-radius: 12px;
            background: white;
            border: 2px solid var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-weight: 700;
            font-size: 1.1rem;
            flex-shrink: 0;
            box-shadow: 0 2px 8px rgba(26, 76, 186, 0.1);
        }

        .maestro-name h4 {
            font-weight: 700;
            color: #333;
            margin-bottom: 4px;
            font-size: 1rem;
        }

        .maestro-name p {
            font-size: 0.85rem;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .maestro-name p i {
            font-size: 0.8rem;
            color: var(--primary);
        }


        /* Top Bar Superior - Estilo Vista 01 */
        .top-bar {
            background: white;
            height: 70px;
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
            justify-content: space-between;
            align-items: center;
        }

        .header-logo {
            display: flex;
            align-items: center;
            padding: 0;
            background: transparent;
            border-radius: 0;
            box-shadow: none;
            border: none;
        }

        .logo-img-header {
            width: 80px;
            height: 80px;
            object-fit: contain;
            margin-right: 12px;
        }

        .header-logo span {
            color: var(--primary);
            font-weight: 700;
            font-size: 1.3rem;
            letter-spacing: 0.5px;
        }

        .top-bar-right {
            display: flex;
            align-items: center;
            gap: 20px;
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

        /* Top Navigation - Estilo Vista 01 */
        .top-nav {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            position: fixed;
            top: 70px;
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

        .nav-left {
            display: flex;
            align-items: center;
            gap: 30px;
        }

        .divider-white {
            width: 2px;
            height: 40px;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 2px;
        }

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
            padding: 20px 40px;
            min-height: calc(100vh - 140px);
        }

        .content-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Breadcrumb */
        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
            font-size: 0.9rem;
            background: white;
            padding: 12px 20px;
            border-radius: 10px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
        }

        .breadcrumb a {
            color: var(--text-muted);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: var(--transition);
        }

        .breadcrumb a:hover {
            color: var(--primary);
        }

        .breadcrumb i {
            font-size: 0.75rem;
            color: var(--text-muted);
        }

        .breadcrumb span {
            color: var(--text-dark);
            font-weight: 500;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.9rem;
            text-decoration: none;
            transition: var(--transition);
            border: none;
            cursor: pointer;
        }

        .btn-primary {
            background: var(--gradient-primary);
            color: white;
            box-shadow: 0 4px 12px rgba(26, 76, 186, 0.2);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(26, 76, 186, 0.3);
        }

        .btn-secondary {
            background: white;
            color: var(--text-dark);
            border: 1px solid var(--border-color);
        }

        .btn-secondary:hover {
            background: var(--light-primary);
            border-color: var(--primary);
            color: var(--primary);
        }

        /* Profile Header - Mejorado */
        .profile-header {
            background: white;
            border-radius: 16px;
            padding: 25px 30px;
            margin-bottom: 20px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            gap: 25px;
        }

        .profile-avatar {
            width: 90px;
            height: 90px;
            border-radius: 12px;
            background: var(--gradient-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2.2rem;
            box-shadow: 0 8px 16px rgba(26, 76, 186, 0.2);
        }

        .profile-info {
            flex: 1;
        }

        .profile-info h1 {
            font-size: 1.8rem;
            color: var(--text-dark);
            font-weight: 700;
            margin-bottom: 8px;
        }

        .profile-info h1 span {
            color: var(--primary);
        }

        .profile-badges {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 8px;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            background: var(--light-primary);
            color: var(--primary);
            border: 1px solid rgba(26, 76, 186, 0.1);
        }

        .badge i {
            font-size: 0.8rem;
        }

        .badge-success {
            background: rgba(38, 230, 63, 0.1);
            color: #16a34a;
            border-color: rgba(38, 230, 63, 0.2);
        }

        .badge-warning {
            background: rgba(245, 158, 11, 0.1);
            color: #b45309;
            border-color: rgba(245, 158, 11, 0.2);
        }

        .profile-status {
            text-align: right;
        }

        .status-indicator {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            border-radius: 30px;
            font-weight: 600;
            font-size: 0.85rem;
        }

        .status-active {
            background: rgba(38, 230, 63, 0.1);
            color: #16a34a;
            border: 1px solid rgba(38, 230, 63, 0.2);
        }

        .status-inactive {
            background: rgba(239, 68, 68, 0.1);
            color: #dc2626;
            border: 1px solid rgba(239, 68, 68, 0.2);
        }

        /* Stats Grid - Compacto */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-bottom: 20px;
        }

        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 16px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            gap: 12px;
            transition: var(--transition);
        }

        .stat-card:hover {
            border-color: var(--primary);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .stat-icon {
            width: 45px;
            height: 45px;
            border-radius: 10px;
            background: var(--light-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 1.2rem;
        }

        .stat-content h3 {
            font-size: 0.8rem;
            color: var(--text-muted);
            font-weight: 500;
            margin-bottom: 4px;
        }

        .stat-value {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--text-dark);
            line-height: 1.2;
        }

        .stat-label {
            font-size: 0.7rem;
            color: var(--text-muted);
        }

        /* Info Cards - Compactos */
        .info-section {
            background: white;
            border-radius: 12px;
            padding: 20px 25px;
            margin-bottom: 20px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
        }

        .section-title {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 1px solid var(--border-color);
        }

        .section-title i {
            width: 35px;
            height: 35px;
            border-radius: 8px;
            background: var(--light-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 1rem;
        }

        .section-title h2 {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--text-dark);
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }

        .info-item {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .info-item.full-width {
            grid-column: span 2;
        }

        .info-label {
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .info-value {
            font-size: 0.95rem;
            font-weight: 500;
            color: var(--text-dark);
            padding: 8px 12px;
            background: var(--light-bg);
            border-radius: 8px;
            border: 1px solid var(--border-color);
            line-height: 1.4;
        }

        /* Grados Académicos - Compactos */
        .grados-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 15px;
        }

        .grado-card {
            background: var(--light-bg);
            border-radius: 12px;
            padding: 16px;
            border: 1px solid var(--border-color);
            transition: var(--transition);
        }

        .grado-card:hover {
            border-color: var(--primary);
            box-shadow: var(--shadow-sm);
        }

        .grado-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }

        .grado-nivel {
            font-weight: 700;
            color: var(--primary);
            font-size: 0.85rem;
            padding: 4px 10px;
            background: white;
            border-radius: 20px;
            border: 1px solid var(--border-color);
        }

        .grado-btn {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
            color: var(--text-muted);
            border: 1px solid var(--border-color);
            text-decoration: none;
            transition: var(--transition);
        }

        .grado-btn:hover {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        .grado-titulo {
            font-weight: 600;
            font-size: 0.95rem;
            color: var(--text-dark);
            margin-bottom: 10px;
        }

        .grado-detalle {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            font-size: 0.85rem;
            color: var(--text-muted);
        }

        .grado-detalle span {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .grado-detalle i {
            width: 14px;
            color: var(--primary);
        }

        .empty-state {
            grid-column: 1/-1;
            text-align: center;
            padding: 40px;
            background: var(--light-bg);
            border-radius: 12px;
            color: var(--text-muted);
        }

        .empty-state i {
            font-size: 2.5rem;
            margin-bottom: 10px;
            opacity: 0.5;
        }

        /* Footer */
        .footer-info {
            margin-top: 20px;
            padding: 15px;
            background: white;
            border-radius: 8px;
            color: var(--text-muted);
            font-size: 0.8rem;
            text-align: center;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .nav-menu {
                display: none;
            }
            
            .main-content {
                padding: 15px 20px;
            }
            
            .profile-header {
                flex-direction: column;
                text-align: center;
                padding: 20px;
            }
            
            .profile-status {
                text-align: center;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .info-grid {
                grid-template-columns: 1fr;
            }
            
            .info-item.full-width {
                grid-column: span 1;
            }
            
            .grados-grid {
                grid-template-columns: 1fr;
            }
            
            .action-buttons {
                flex-direction: column;
            }
            
            .top-bar-right .top-bar-item span:not(.user-avatar) {
                display: none;
            }
        }

        @media (max-width: 1024px) {
            .top-bar-right .top-bar-item span:not(.user-avatar) {
                display: none;
            }
        }
    </style>
</head>
<body>

    @php
        use Illuminate\Support\Facades\Auth;
        use App\Models\Coordinacion;
        
        $user = Auth::user();
        $coordinacion = $user->coordinaciones_id ? Coordinacion::find($user->coordinaciones_id) : null;
        
        if (isset($coordinacionControlador) && $coordinacionControlador) {
            $coordinacion = $coordinacionControlador;
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

    <!-- Top Bar Superior - Estilo Vista 01 -->
    <div class="top-bar">
        <div class="top-bar-content">
            <div class="header-logo">
                <img src="{{ asset('img/logo_iufim.png') }}" alt="Logo IUFIM" class="logo-img-header">
                <span></span>
            </div>
        </div>
    </div>

    <!-- Top Navigation - Estilo Vista 01 -->
    <nav class="top-nav">
        <div class="nav-container">
            <div class="nav-left">
                <div class="divider-white"></div>
                
                <div class="nav-menu">
                    <a href="{{ route('coordinacion.dashboard') }}" class="nav-item">
                        <i class="fas fa-home"></i>
                        <span>Inicio</span>
                    </a>
                    <a href="{{ route('coordinaciones.maestros-detalle') }}" class="nav-item active">
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
            <!-- Action Buttons -->
            <div class="action-buttons">
                <a href="{{ route('coordinaciones.maestros-detalle') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Volver a la lista
                </a>
            </div>

            <!-- Profile Header - Mejorado con icono de persona -->
            <div class="profile-header">
                <div class="maestro-avatar">
                    <i class="fas fa-user"></i>
                </div>
                
                <div class="profile-info">
                    <h1>{{ $maestro->nombres }} {{ $maestro->apellido_paterno }} {{ $maestro->apellido_materno ?? '' }}</h1>
                </div>
                
                <div class="profile-status">
                    @if($maestro->activo)
                        <span class="status-indicator status-active">
                            <i class="fas fa-check-circle"></i> Activo
                        </span>
                    @else
                        <span class="status-indicator status-inactive">
                            <i class="fas fa-times-circle"></i> Inactivo
                        </span>
                    @endif
                </div>
            </div>


            <!-- Información Personal -->
            <div class="info-section">
                <div class="section-title">
                    <i class="fas fa-user-circle"></i>
                    <h2>Información Personal</h2>
                </div>

                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label">Nombre completo</span>
                        <span class="info-value">{{ $maestro->nombres }} {{ $maestro->apellido_paterno }} {{ $maestro->apellido_materno ?? '' }}</span>
                    </div>

                    <div class="info-item">
                        <span class="info-label">Fecha de nacimiento</span>
                        <span class="info-value">{{ $maestro->fecha_nacimiento ? \Carbon\Carbon::parse($maestro->fecha_nacimiento)->format('d/m/Y') : 'No registrado' }}</span>
                    </div>

                    <div class="info-item">
                        <span class="info-label">Teléfono</span>
                        <span class="info-value">{{ $maestro->telefono ?? 'No registrado' }}</span>
                    </div>

                    <div class="info-item">
                        <span class="info-label">Genero</span>
                        <span class="info-value">{{ $maestro->sexo ?? 'No especificado' }} </span>
                    </div>

                    <div class="info-item">
                        <span class="info-label">Estado civil</span>
                        <span class="info-value">{{ $maestro->estado_civil ?? 'No especificado' }}</span>
                    </div>
            

                    <div class="info-item">
                        <span class="info-label">Edad</span>
                        <span class="info-value">{{ $maestro->edad ?? '--' }} </span>
                    </div>

                    <div class="info-item full-width">
                        <span class="info-label">Email</span>
                        <span class="info-value">{{ $maestro->email ?? 'No registrado' }}</span>
                    </div>

                    <div class="info-item full-width">
                        <span class="info-label">Dirección</span>
                        <span class="info-value">{{ $maestro->direccion ?? 'No registrada' }}</span>
                    </div>
                </div>
            </div>

            <!-- Información Institucional -->
            <div class="info-section">
                <div class="section-title">
                    <i class="fas fa-building"></i>
                    <h2>Información Institucional</h2>
                </div>

                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label">Coordinación</span>
                        <span class="info-value">{{ $coordinacion->nombre ?? 'No asignada' }}</span>
                    </div>

                    <div class="info-item">
                        <span class="info-label">Grado de Estudios</span>
                        <span class="info-value">{{ $maestro->maximo_grado_academico ?? 'No registrado' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">RFC</span>
                        <span class="info-value">{{ $maestro->rfc ?? 'No registrado' }}</span>
                    </div>

                    <div class="info-item">
                        <span class="info-label">CURP</span>
                        <span class="info-value">{{ $maestro->curp ?? 'No registrado' }}</span>
                    </div>

                </div>
            </div>

            <!-- Grados Académicos -->
            <div class="info-section">
                <div class="section-title">
                    <i class="fas fa-graduation-cap"></i>
                    <h2>Grados Académicos</h2>
                </div>

                <div class="grados-grid">
                    @forelse($maestro->gradosAcademicos as $grado)
                        <div class="grado-card">
                            <div class="grado-header">
                                <span class="grado-nivel">{{ $grado->nivel ?? 'N/A' }}</span>
                                @if($grado->documento_path)
                                    <a href="{{ route('grados-academicos.show-document', $grado->id) }}" target="_blank" class="grado-btn" title="Ver documento">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                @endif
                            </div>
                            <div class="grado-titulo">{{ $grado->titulo ?? 'Sin título' }}</div>
                            <div class="grado-detalle">
                                <span><i class="fas fa-university"></i> {{ $grado->institucion ?? 'Institución no especificada' }}</span>
                                <span><i class="fas fa-calendar"></i> {{ $grado->anio_obtencion ?? 'Año no especificado' }}</span>
                            </div>
                        </div>
                    @empty
                        <div class="empty-state">
                            <i class="fas fa-graduation-cap"></i>
                            <p>No hay grados académicos registrados</p>
                        </div>
                    @endforelse
                </div>
            </div>
            
            <!-- Footer -->
            <div class="footer-info">
                <p>GEPROC - Sistema de Gestión de Procesos | Expediente de maestro</p>
            </div>
        </div>
    </main>
</body>
</html>