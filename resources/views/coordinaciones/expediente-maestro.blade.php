<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expediente de {{ $maestro->nombres }} {{ $maestro->apellido_paterno }} | GEPROC</title>
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

        /* Botón hamburguesa */
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

        /* BREADCRUMB */
        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 25px;
            flex-wrap: wrap;
            background-color: white;
            padding: 12px 20px;
            border-radius: var(--border-radius);
            border: 2px solid var(--border-color);
        }

        .breadcrumb a {
            color: var(--text-muted);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: var(--transition);
            font-size: 14px;
        }

        .breadcrumb a:hover {
            color: var(--primary);
        }

        .breadcrumb i {
            font-size: 12px;
        }

        .breadcrumb span {
            color: var(--primary);
            font-weight: 600;
        }

        /* BOTONES DE ACCIÓN */
        .action-buttons {
            display: flex;
            gap: 15px;
            margin-bottom: 25px;
            flex-wrap: wrap;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            background: transparent;
            color: var(--primary);
            border: 2px solid var(--primary);
            border-radius: 10px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
        }

        .btn-back:hover {
            background-color: var(--primary);
            color: white;
            transform: translateY(-2px);
        }

        /* HEADER DE PERFIL */
        .profile-header {
            background-color: white;
            border-radius: var(--border-radius);
            padding: 25px 30px;
            margin-bottom: 25px;
            box-shadow: var(--card-shadow);
            border: 2px solid var(--border-color);
            transition: var(--transition);
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            gap: 25px;
            flex-wrap: wrap;
        }

        .profile-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            
        }

        .profile-header:hover {
            transform: translateY(-3px);
            box-shadow: var(--card-shadow-hover);
        }

        .profile-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: var(--gradient-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 32px;
            box-shadow: 0 5px 15px rgba(7, 68, 182, 0.25);
        }

        .profile-info {
            flex: 1;
        }

        .profile-info h1 {
            font-size: 28px;
            font-weight: 750;
            color: #1e293b;
            margin-bottom: 8px;
        }

        .profile-info h1 span {
            color: var(--primary);
        }

        .profile-status {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 20px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 14px;
        }

        .status-active {
            background: var(--success-light);
            color: var(--success-color);
        }

        .status-inactive {
            background: var(--danger-light);
            color: var(--danger-color);
        }

        /* SECCIONES */
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
            gap: 12px;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid var(--light-bg);
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

        /* GRID DE INFORMACIÓN */
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 18px;
        }

        .info-item {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .info-item.full-width {
            grid-column: 1 / -1;
        }

        .info-label {
            font-size: 12px;
            font-weight: 600;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .info-value {
            font-size: 15px;
            font-weight: 600;
            color: #1e293b;
            padding: 10px 14px;
            background-color: var(--light-bg);
            border-radius: 10px;
            border: 1px solid var(--border-color);
        }

        /* GRID DE GRADOS ACADÉMICOS */
        .grados-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 18px;
        }

        .grado-card {
            background-color: var(--light-bg);
            border-radius: 12px;
            padding: 18px;
            border: 1px solid var(--border-color);
            transition: var(--transition);
        }

        .grado-card:hover {
            transform: translateY(-3px);
            box-shadow: var(--card-shadow);
            border-color: var(--primary-light);
        }

        .grado-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }

        .grado-nivel {
            font-size: 13px;
            font-weight: 700;
            padding: 4px 12px;
            background: var(--gradient-primary);
            color: white;
            border-radius: 20px;
        }

        .grado-btn {
            width: 34px;
            height: 34px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
            color: var(--primary);
            border: 2px solid var(--border-color);
            text-decoration: none;
            transition: var(--transition);
        }

        .grado-btn:hover {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
            transform: scale(1.05);
        }

        .grado-titulo {
            font-size: 16px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 12px;
        }

        .grado-detalle {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            font-size: 13px;
            color: var(--text-muted);
        }

        .grado-detalle span {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .grado-detalle i {
            color: var(--primary);
            width: 14px;
        }

        /* EMPTY STATE */
        .empty-state {
            text-align: center;
            padding: 50px 20px;
            background-color: var(--light-bg);
            border-radius: 12px;
            color: var(--text-muted);
        }

        .empty-state i {
            font-size: 48px;
            opacity: 0.5;
            margin-bottom: 15px;
        }

        .empty-state p {
            font-size: 15px;
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
            .info-grid {
                grid-template-columns: 1fr;
            }
            
            .grados-grid {
                grid-template-columns: 1fr;
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
            
            .profile-header {
                flex-direction: column;
                text-align: center;
                padding: 20px;
            }
            
            .profile-info h1 {
                font-size: 22px;
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
            
            .action-buttons {
                flex-direction: column;
            }
            
            .btn-back {
                width: 100%;
                justify-content: center;
            }
            
            .info-item.full-width {
                grid-column: span 1;
            }
        }

        @media (max-width: 480px) {
            .content-wrapper {
                padding: 15px;
            }
            
            .section-title {
                font-size: 18px;
            }
            
            .profile-avatar {
                width: 60px;
                height: 60px;
                font-size: 24px;
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
                <a href="{{ route('coordinacion.dashboard') }}" class="nav-link">
                    <i class="fas fa-home"></i> Inicio
                </a>
                <a href="{{ route('coordinaciones.maestros-detalle') }}" class="nav-link active">
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
        <a href="{{ route('coordinacion.dashboard') }}" class="mobile-nav-link">
            <i class="fas fa-home"></i> Inicio
        </a>
        <a href="{{ route('coordinaciones.maestros-detalle') }}" class="mobile-nav-link active">
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
        <!-- BREADCRUMB -->
        <div class="breadcrumb">
            <a href="{{ route('coordinaciones.maestros-detalle') }}">
                <i class="fas fa-users"></i> Maestros
            </a>
            <i class="fas fa-chevron-right"></i>
            <span>Expediente</span>
        </div>

        <!-- BOTONES DE ACCIÓN -->
        <div class="action-buttons">
            <a href="{{ route('coordinaciones.maestros-detalle') }}" class="btn-back">
                <i class="fas fa-arrow-left"></i> Volver a la lista
            </a>
        </div>

        <!-- HEADER DE PERFIL -->
        <div class="profile-header">
            <div class="profile-avatar">
                <i class="fas fa-user-graduate"></i>
            </div>
            
            <div class="profile-info">
                <h1>{{ $maestro->nombres }} {{ $maestro->apellido_paterno }} {{ $maestro->apellido_materno ?? '' }}</h1>
            </div>
            
            <div>
                @if($maestro->activo)
                    <span class="profile-status status-active">
                        <i class="fas fa-check-circle"></i> Activo
                    </span>
                @else
                    <span class="profile-status status-inactive">
                        <i class="fas fa-times-circle"></i> Inactivo
                    </span>
                @endif
            </div>
        </div>

        <!-- INFORMACIÓN PERSONAL -->
        <div class="section">
            <div class="section-header">
                <div class="section-title">
                    <i class="fas fa-user-circle"></i>
                    <span>Información Personal</span>
                </div>
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
                    <span class="info-label">Género</span>
                    <span class="info-value">
                        @if($maestro->sexo == 'M') Masculino
                        @elseif($maestro->sexo == 'F') Femenino
                        @else {{ $maestro->sexo ?? 'No especificado' }}
                        @endif
                    </span>
                </div>

                <div class="info-item">
                    <span class="info-label">Estado civil</span>
                    <span class="info-value">{{ $maestro->estado_civil ?? 'No especificado' }}</span>
                </div>

                <div class="info-item">
                    <span class="info-label">Edad</span>
                    <span class="info-value">{{ $maestro->edad ?? '--' }} años</span>
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

        <!-- INFORMACIÓN INSTITUCIONAL -->
        <div class="section">
            <div class="section-header">
                <div class="section-title">
                    <i class="fas fa-building"></i>
                    <span>Información Institucional</span>
                </div>
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

        <!-- GRADOS ACADÉMICOS -->
        <div class="section">
            <div class="section-header">
                <div class="section-title">
                    <i class="fas fa-graduation-cap"></i>
                    <span>Grados Académicos</span>
                </div>
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
                            <span><i class="fas fa-calendar-alt"></i> {{ $grado->anio_obtencion ?? 'Año no especificado' }}</span>
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

        <!-- FOOTER -->
        <div class="footer">
            <p>GEPROC - Sistema de Gestión de Procesos y Documentación | Expediente de maestro</p>
        </div>
    </div>
</div>

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
    
    const mobileLinks = document.querySelectorAll('.mobile-nav-link');
    mobileLinks.forEach(link => {
        link.addEventListener('click', closeMenu);
    });
    
    window.addEventListener('resize', () => {
        if (window.innerWidth > 768 && mobileMenu.classList.contains('open')) {
            closeMenu();
        }
    });
</script>
</body>
</html>