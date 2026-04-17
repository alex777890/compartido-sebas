<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documentos del Maestro - GEPROC</title>
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
            --progress-blue: #3a6bd3;
            --progress-light-blue: #60a5fa;
            --progress-gray: #94a3b8;
            --progress-warning: #f97316;
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

        /* BOTÓN VOLVER */
        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 12px 24px;
            background: white;
            color: var(--primary);
            border: 2px solid var(--border-color);
            border-radius: 50px;
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
            transition: var(--transition);
            margin-bottom: 25px;
        }

        .btn-back:hover {
            background-color: var(--primary-soft);
            border-color: var(--primary);
            transform: translateX(-5px);
        }

        /* PERÍODO INFO */
        .periodo-section {
            background-color: white;
            border-radius: var(--border-radius);
            padding: 20px 25px;
            margin-bottom: 25px;
            box-shadow: var(--card-shadow);
            border: 2px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }

        .periodo-title {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 16px;
            font-weight: 600;
            color: var(--primary);
        }

        .periodo-title i {
            font-size: 22px;
        }

        .periodo-fechas {
            font-size: 13px;
            color: var(--text-muted);
            margin-top: 4px;
        }

        .periodo-status {
            padding: 8px 18px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 13px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .status-activo {
            background: var(--success-light);
            color: var(--success-color);
        }

        .status-inactivo {
            background: var(--warning-light);
            color: var(--warning-color);
        }

        .periodo-mensaje {
            background-color: var(--warning-light);
            border-left: 4px solid var(--warning-color);
            padding: 15px 20px;
            border-radius: var(--border-radius);
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 15px;
            color: #92400e;
        }

        .periodo-mensaje i {
            font-size: 22px;
        }

        /* PERFIL DEL MAESTRO */
        .profile-card {
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

        .profile-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
           
        }

        .profile-card:hover {
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
        }

        .profile-name {
            font-size: 24px;
            font-weight: 750;
            color: #1e293b;
            margin-bottom: 8px;
        }

        .profile-contact {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            margin-top: 10px;
        }

        .contact-item {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 14px;
            background-color: var(--light-bg);
            border-radius: 50px;
            font-size: 14px;
            color: var(--text-muted);
        }

        .contact-item i {
            color: var(--primary);
        }

        /* PROGRESO CARD */
        .progress-card {
            background-color: white;
            border-radius: var(--border-radius);
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: var(--card-shadow);
            border: 2px solid var(--border-color);
            transition: var(--transition);
        }

        .progress-card:hover {
            box-shadow: var(--card-shadow-hover);
        }

        .progress-title {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 18px;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 20px;
        }

        .progress-title i {
            font-size: 22px;
        }

        .progress-bar-container {
            height: 40px;
            background-color: var(--light-bg);
            border-radius: 20px;
            overflow: hidden;
            display: flex;
            margin-bottom: 20px;
        }

        .progress-segment {
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 13px;
            transition: width 0.5s ease;
        }

        .progress-segment.approved { background: var(--gradient-success); }
        .progress-segment.pending { background: var(--gradient-warning); }
        .progress-segment.rejected { background: var(--gradient-danger); }
        .progress-segment.missing { background: var(--gradient-info); }

        .stats-badges {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .stat-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 13px;
        }

        .stat-badge.approved {
            background: var(--success-light);
            color: var(--success-color);
        }

        .stat-badge.pending {
            background: var(--warning-light);
            color: var(--warning-color);
        }

        .stat-badge.rejected {
            background: var(--danger-light);
            color: var(--danger-color);
        }

        .stat-badge.missing {
            background: var(--info-light);
            color: var(--info-color);
        }

        /* TABLA DE DOCUMENTOS */
        .documents-card {
            background-color: white;
            border-radius: var(--border-radius);
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: var(--card-shadow);
            border: 2px solid var(--border-color);
            transition: var(--transition);
        }

        .documents-card:hover {
            box-shadow: var(--card-shadow-hover);
        }

        .documents-title {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 18px;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid var(--light-bg);
        }

        .documents-title i {
            font-size: 22px;
        }

        .table-container {
            overflow-x: auto;
        }

        .documents-table {
            width: 100%;
            border-collapse: collapse;
        }

        .documents-table th {
            text-align: left;
            padding: 15px 12px;
            color: var(--text-muted);
            font-weight: 600;
            font-size: 14px;
            border-bottom: 2px solid var(--border-color);
            background-color: var(--light-bg);
        }

        .documents-table td {
            padding: 15px 12px;
            border-bottom: 1px solid var(--border-color);
            vertical-align: middle;
        }

        .documents-table tr:hover td {
            background-color: var(--primary-soft);
        }

        /* BADGES */
        .badge-custom {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 14px;
            border-radius: 50px;
            font-size: 13px;
            font-weight: 600;
        }

        .badge-doc-type {
            background: var(--primary-soft);
            color: var(--primary);
        }

        .badge-approved {
            background: var(--success-light);
            color: var(--success-color);
        }

        .badge-pending {
            background: var(--warning-light);
            color: var(--warning-color);
        }

        .badge-rejected {
            background: var(--danger-light);
            color: var(--danger-color);
        }

        .badge-not-uploaded {
            background: var(--light-bg);
            color: var(--text-muted);
            border: 1px dashed var(--border-color);
        }

        /* OBSERVACIONES */
        .observaciones-text {
            background-color: var(--danger-light);
            color: var(--danger-color);
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 12px;
            max-width: 200px;
            word-break: break-word;
        }

        .sin-observaciones {
            color: var(--text-muted);
            font-size: 12px;
            font-style: italic;
        }

        /* BOTONES DE ACCIÓN */
        .document-actions {
            display: flex;
            gap: 8px;
        }

        .btn-icon {
            width: 34px;
            height: 34px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: white;
            color: var(--primary);
            border: 2px solid var(--border-color);
            text-decoration: none;
            transition: var(--transition);
        }

        .btn-icon:hover {
            background-color: var(--primary);
            color: white;
            border-color: var(--primary);
            transform: translateY(-2px);
        }

        /* MODAL */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            backdrop-filter: blur(4px);
        }

        .modal-container {
            background: white;
            border-radius: 16px;
            width: 90%;
            max-width: 500px;
            box-shadow: var(--card-shadow-hover);
            overflow: hidden;
        }

        .modal-header {
            padding: 20px 24px;
            background: var(--gradient-danger);
            color: white;
        }

        .modal-header h3 {
            font-size: 18px;
            font-weight: 700;
            margin: 0;
        }

        .modal-body {
            padding: 24px;
        }

        .modal-body textarea {
            width: 100%;
            padding: 12px;
            border: 2px solid var(--border-color);
            border-radius: 10px;
            font-size: 14px;
            margin-top: 10px;
        }

        .modal-body textarea:focus {
            outline: none;
            border-color: var(--primary);
        }

        .modal-footer {
            padding: 16px 24px;
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            border-top: 1px solid var(--border-color);
        }

        .modal-btn {
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: var(--transition);
            border: none;
        }

        .modal-btn.cancel {
            background: var(--light-bg);
            color: var(--text-muted);
        }

        .modal-btn.confirm {
            background: var(--gradient-danger);
            color: white;
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
            z-index: 1001;
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
            .profile-card .flex-container {
                flex-direction: column;
                text-align: center;
            }
            
            .profile-contact {
                justify-content: center;
            }
            
            .stats-badges {
                justify-content: center;
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
            
            .profile-name {
                font-size: 20px;
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
            
            .periodo-section {
                flex-direction: column;
                text-align: center;
            }
            
            .progress-bar-container {
                height: auto;
                flex-direction: column;
            }
            
            .progress-segment {
                padding: 8px;
                justify-content: center;
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
    
    $totalDocumentosRequeridos = 6;
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
                <a href="{{ route('coordinaciones.maestros-detalle') }}" class="nav-link">
                    <i class="fas fa-users"></i> Maestros
                </a>
                <a href="{{ route('coordinaciones.maestros') }}" class="nav-link active">
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
        <a href="{{ route('coordinaciones.maestros-detalle') }}" class="mobile-nav-link">
            <i class="fas fa-users"></i> Maestros
        </a>
        <a href="{{ route('coordinaciones.maestros') }}" class="mobile-nav-link active">
            <i class="fas fa-file-alt"></i> Documentos
        </a>
        <a href="{{ route('coordinaciones.estatus') }}" class="mobile-nav-link">
            <i class="fas fa-chart-bar"></i> Estadísticas
        </a>
    </div>

    <!-- CONTENIDO PRINCIPAL -->
    <div class="content-wrapper">
        <!-- BOTÓN VOLVER -->
        <a href="{{ route('coordinaciones.maestros') }}" class="btn-back">
            <i class="fas fa-arrow-left"></i> Volver a la lista de maestros
        </a>

        <!-- PERÍODO HABILITADO -->
        @if(isset($periodoHabilitado) && $periodoHabilitado)
            @if($periodoHabilitado->activo == 1)
                <div class="periodo-section">
                    <div class="periodo-title">
                        <i class="fas fa-calendar-check"></i>
                        <div>
                            <strong>{{ $periodoHabilitado->nombre }}</strong>
                            @if($periodoHabilitado->fecha_inicio && $periodoHabilitado->fecha_fin)
                            <div class="periodo-fechas">
                                <i class="fas fa-calendar-alt"></i>
                                {{ \Carbon\Carbon::parse($periodoHabilitado->fecha_inicio)->format('d/m/Y') }} 
                                al {{ \Carbon\Carbon::parse($periodoHabilitado->fecha_fin)->format('d/m/Y') }}
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="periodo-status status-activo">
                        <i class="fas fa-check-circle"></i> ACTIVO
                    </div>
                </div>
            @else
                <div class="periodo-section">
                    <div class="periodo-title">
                        <i class="fas fa-calendar-check"></i>
                        <div>
                            <strong>{{ $periodoHabilitado->nombre }}</strong>
                            @if($periodoHabilitado->fecha_inicio && $periodoHabilitado->fecha_fin)
                            <div class="periodo-fechas">
                                <i class="fas fa-calendar-alt"></i>
                                {{ \Carbon\Carbon::parse($periodoHabilitado->fecha_inicio)->format('d/m/Y') }} 
                                al {{ \Carbon\Carbon::parse($periodoHabilitado->fecha_fin)->format('d/m/Y') }}
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="periodo-status status-inactivo">
                        <i class="fas fa-times-circle"></i> INACTIVO
                    </div>
                </div>
            @endif
        @else
            <div class="periodo-mensaje">
                <i class="fas fa-info-circle"></i>
                <div>
                    <strong>Sin período activo</strong>
                    <p style="margin: 5px 0 0 0; font-size: 14px;">Mostrando todos los documentos disponibles.</p>
                </div>
            </div>
        @endif

        <!-- PERFIL DEL MAESTRO -->
        <div class="profile-card">
            <div style="display: flex; align-items: center; gap: 25px; flex-wrap: wrap;">
                <div class="profile-avatar">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <div style="flex: 1;">
                    <h1 class="profile-name">{{ $maestro->nombres ?? '' }} {{ $maestro->apellido_paterno ?? '' }} {{ $maestro->apellido_materno ?? '' }}</h1>
                    <div class="profile-contact">
                        <span class="contact-item">
                            <i class="fas fa-envelope"></i> {{ $maestro->email ?? 'No especificado' }}
                        </span>
                        <span class="contact-item">
                            <i class="fas fa-phone"></i> {{ $maestro->telefono ?? 'No especificado' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- PROGRESO DE DOCUMENTOS -->
        <div class="progress-card">
            <div class="progress-title">
                <i class="fas fa-chart-pie"></i> Progreso de Documentos
            </div>
            
            @php
                $aprobados = $estadoMaestro['aprobados'] ?? 0;
                $pendientes = $estadoMaestro['pendientes'] ?? 0;
                $rechazados = $estadoMaestro['rechazados'] ?? 0;
                $total = 6;
                $subidos = $aprobados + $pendientes + $rechazados;
                $faltantes = max(0, $total - $subidos);
            @endphp
            
            <div class="progress-bar-container">
                @if($aprobados > 0)
                <div class="progress-segment approved" style="width: {{ ($aprobados/$total)*100 }}%">
                    {{ $aprobados }}
                </div>
                @endif
                
                @if($pendientes > 0)
                <div class="progress-segment pending" style="width: {{ ($pendientes/$total)*100 }}%">
                    {{ $pendientes }}
                </div>
                @endif
                
                @if($rechazados > 0)
                <div class="progress-segment rejected" style="width: {{ ($rechazados/$total)*100 }}%">
                    {{ $rechazados }}
                </div>
                @endif
                
                @if($faltantes > 0)
                <div class="progress-segment missing" style="width: {{ ($faltantes/$total)*100 }}%">
                    {{ $faltantes }}
                </div>
                @endif
            </div>
            
            <div class="stats-badges">
                <span class="stat-badge approved">
                    <i class="fas fa-check-circle"></i> {{ $aprobados }} Aprobados
                </span>
                <span class="stat-badge pending">
                    <i class="fas fa-clock"></i> {{ $pendientes }} Pendientes
                </span>
                <span class="stat-badge rejected">
                    <i class="fas fa-times-circle"></i> {{ $rechazados }} Rechazados
                </span>
                <span class="stat-badge missing">
                    <i class="fas fa-cloud-upload-alt"></i> {{ $faltantes }} Faltantes
                </span>
            </div>
        </div>

        <!-- TABLA DE DOCUMENTOS -->
        <div class="documents-card">
            <div class="documents-title">
                <i class="fas fa-file-alt"></i> Documentos del Maestro
            </div>
            
            <div class="table-container">
                <table class="documents-table">
                    <thead>
                        <tr>
                            <th>Tipo de Documento</th>
                            <th>Fecha de subida</th>
                            <th>Estado</th>
                            <th>Observaciones</th>
                            <th>Revisado por</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $tiposOrdenados = [
                                'cst' => 'CST',
                                'iufim' => 'IUFIM',
                                'comprobante_domicilio' => 'Comprobante Domicilio',
                                'oficio_ingresos' => 'Oficio Ingresos',
                                'declaracion_anual' => 'Declaración Anual',
                                'comprobante_seguro_social' => 'Seguro Social'
                            ];
                        @endphp
                        
                        @foreach($tiposOrdenados as $tipo => $nombreMostrar)
                            @php
                                $documento = isset($documentosPorTipo[$tipo]) && count($documentosPorTipo[$tipo]) > 0 
                                    ? $documentosPorTipo[$tipo][0] 
                                    : null;
                                $icono = $tiposDocumentos[$tipo]['icono'] ?? 'file';
                            @endphp
                            <tr>
                                <td>
                                    <span class="badge-custom badge-doc-type">
                                        <i class="fas fa-{{ $icono }}"></i>
                                        {{ $nombreMostrar }}
                                    </span>
                                </td>
                                <td>
                                    @if($documento)
                                        <small>{{ \Carbon\Carbon::parse($documento->created_at)->format('d/m/Y H:i') }}</small>
                                    @else
                                        <small class="text-muted">-</small>
                                    @endif
                                </td>
                                <td>
                                    @if($documento)
                                        @if($documento->estado == 'aprobado')
                                            <span class="badge-custom badge-approved">
                                                <i class="fas fa-check-circle"></i> Aprobado
                                            </span>
                                        @elseif($documento->estado == 'rechazado')
                                            <span class="badge-custom badge-rejected">
                                                <i class="fas fa-times-circle"></i> Rechazado
                                            </span>
                                        @else
                                            <span class="badge-custom badge-pending">
                                                <i class="fas fa-clock"></i> Pendiente
                                            </span>
                                        @endif
                                    @else
                                        <span class="badge-custom badge-not-uploaded">
                                            <i class="fas fa-times-circle"></i> No subido
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    @if($documento && $documento->observaciones_admin)
                                        <div class="observaciones-text">
                                            <i class="fas fa-comment"></i> {{ Str::limit($documento->observaciones_admin, 50) }}
                                        </div>
                                    @else
                                        <span class="sin-observaciones">
                                            <i class="fas fa-comment-slash"></i> Sin observaciones
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    @if($documento && $documento->revisadoPor)
                                        <small>{{ $documento->revisadoPor->name }}</small>
                                    @else
                                        <small class="text-muted">-</small>
                                    @endif
                                </td>
                                <td>
                                    @if($documento)
                                        <div class="document-actions">
                                            <a href="{{ route('documentos.view', $documento->id) }}" class="btn-icon" target="_blank" title="Ver documento">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('documentos.download', $documento->id) }}" class="btn-icon" title="Descargar documento">
                                                <i class="fas fa-download"></i>
                                            </a>
                                        </div>
                                    @else
                                        <small class="text-muted">-</small>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- MODAL DE RECHAZO -->
<div id="rejectModal" class="modal-overlay" style="display: none;">
    <div class="modal-container">
        <div class="modal-header">
            <h3><i class="fas fa-exclamation-triangle"></i> Rechazar Documento</h3>
        </div>
        <form id="rejectForm" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-body">
                <p>Por favor, indica el motivo del rechazo:</p>
                <textarea name="observaciones" id="rejectObservaciones" rows="4" placeholder="Escribe aquí las observaciones..." required></textarea>
                <input type="hidden" name="estado" value="rechazado" id="rejectEstado">
            </div>
            <div class="modal-footer">
                <button type="button" class="modal-btn cancel" onclick="closeRejectModal()">Cancelar</button>
                <button type="submit" class="modal-btn confirm">Rechazar Documento</button>
            </div>
        </form>
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
    
    const mobileLinks = document.querySelectorAll('.mobile-nav-link');
    mobileLinks.forEach(link => {
        link.addEventListener('click', closeMenu);
    });
    
    window.addEventListener('resize', () => {
        if (window.innerWidth > 768 && mobileMenu.classList.contains('open')) {
            closeMenu();
        }
    });
    
    // Función de alerta
    function showAlert(message, type = 'success') {
        const alertDiv = document.getElementById('alertMessage');
        alertDiv.textContent = message;
        alertDiv.style.borderLeftColor = type === 'success' ? '#10b981' : (type === 'warning' ? '#f59e0b' : '#ef4444');
        alertDiv.style.display = 'block';
        
        setTimeout(() => {
            alertDiv.style.display = 'none';
        }, 3000);
    }
    
    // Función para cambiar estado del documento
    function cambiarEstadoDocumento(documentoId, estado) {
        if (estado === 'rechazado') {
            const modal = document.getElementById('rejectModal');
            const form = document.getElementById('rejectForm');
            form.action = `/coordinacion/documentos/${documentoId}/estado`;
            modal.style.display = 'flex';
        } else {
            if (confirm('¿Estás seguro de aprobar este documento?')) {
                fetch(`/coordinacion/documentos/${documentoId}/estado`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ estado: 'aprobado' })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showAlert(data.message, 'success');
                        setTimeout(() => location.reload(), 1500);
                    } else {
                        showAlert(data.message, 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showAlert('Error al cambiar el estado', 'error');
                });
            }
        }
    }
    
    function closeRejectModal() {
        document.getElementById('rejectModal').style.display = 'none';
    }
    
    // Manejar envío del formulario de rechazo
    document.getElementById('rejectForm')?.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        const data = Object.fromEntries(formData.entries());
        
        fetch(this.action, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showAlert(data.message, 'success');
                setTimeout(() => location.reload(), 1500);
                closeRejectModal();
            } else {
                showAlert(data.message, 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('Error al rechazar el documento', 'error');
        });
    });
    
    // Cerrar modal al hacer clic fuera
    window.addEventListener('click', function(event) {
        const modal = document.getElementById('rejectModal');
        if (event.target === modal) {
            closeRejectModal();
        }
    });
    
    // Mostrar notificaciones de sesión
    @if(session('success'))
        showAlert('{{ session('success') }}', 'success');
    @endif
    @if(session('error'))
        showAlert('{{ session('error') }}', 'error');
    @endif
    @if(session('warning'))
        showAlert('{{ session('warning') }}', 'warning');
    @endif
    @if(session('info'))
        showAlert('{{ session('info') }}', 'info');
    @endif
</script>
</body>
</html>