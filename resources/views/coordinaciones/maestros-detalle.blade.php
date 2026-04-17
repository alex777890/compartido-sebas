<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Maestros - Sistema GEPROC</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- jQuery para DataTables -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables CSS y JS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
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
            --status-active-bg: #d1fae5;
            --status-active-text: #065f46;
            --status-inactive-bg: #fee2e2;
            --status-inactive-text: #991b1b;
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

        /* HEADER DEL CONTENIDO */
        .content-header {
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

        .content-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            
        }

        .content-header:hover {
            transform: translateY(-3px);
            box-shadow: var(--card-shadow-hover);
        }

        .content-header h1 {
            font-size: 28px;
            font-weight: 750;
            color: #1e293b;
            margin: 0 0 8px 0;
        }

        .content-header p {
            color: var(--text-muted);
            font-size: 15px;
            margin: 0;
        }

        /* SECCIÓN PRINCIPAL */
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

        .maestros-count {
            background: var(--gradient-primary);
            color: white;
            padding: 8px 18px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* BUSCADOR */
        .search-container {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .search-box {
            flex: 1;
            position: relative;
            max-width: 500px;
        }

        .search-box input {
            width: 100%;
            padding: 14px 20px 14px 48px;
            border: 2px solid var(--border-color);
            border-radius: 12px;
            font-size: 15px;
            transition: var(--transition);
        }

        .search-box input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(7, 68, 182, 0.1);
        }

        .search-box i {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            font-size: 18px;
        }

        .btn-search {
            background: var(--gradient-primary);
            color: white;
            border: none;
            padding: 14px 32px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 15px;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn-search:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(7, 68, 182, 0.25);
        }

        .clear-search {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            padding: 8px 16px;
            border-radius: 10px;
            transition: var(--transition);
        }

        .clear-search:hover {
            background-color: var(--primary-soft);
        }

        /* NOTA INFORMATIVA */
        .info-note {
            background-color: var(--primary-soft);
            border-left: 4px solid var(--primary);
            padding: 15px 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            display: flex;
            align-items: flex-start;
            gap: 15px;
            font-size: 14px;
            color: #2d3748;
        }

        .info-note i {
            color: var(--primary);
            font-size: 20px;
            margin-top: 2px;
        }

        .info-note-content strong {
            color: var(--primary);
        }

        /* TABLA */
        .table-container {
            overflow-x: auto;
        }

        .maestros-table {
            width: 100%;
            border-collapse: collapse;
        }

        .maestros-table th {
            text-align: left;
            padding: 15px 12px;
            color: var(--text-muted);
            font-weight: 600;
            font-size: 14px;
            border-bottom: 2px solid var(--border-color);
            background-color: var(--light-bg);
        }

        .maestros-table td {
            padding: 15px 12px;
            border-bottom: 1px solid var(--border-color);
            vertical-align: middle;
        }

        .maestros-table tr:hover td {
            background-color: var(--primary-soft);
        }

        .maestro-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .maestro-avatar {
            width: 45px;
            height: 45px;
            border-radius: 12px;
            background: var(--gradient-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 18px;
        }

        .maestro-name h4 {
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 4px;
            font-size: 15px;
        }

        .maestro-name p {
            font-size: 13px;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .maestro-name p i {
            color: var(--primary);
            font-size: 12px;
        }

        .detalle-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
        }

        .detalle-item i {
            color: var(--text-muted);
            width: 16px;
        }

        /* BADGES DE ESTADO */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            border-radius: 50px;
            font-size: 13px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: var(--transition);
        }

        .status-badge.status-active {
            background: var(--status-active-bg);
            color: var(--status-active-text);
        }

        .status-badge.status-inactive {
            background: var(--status-inactive-bg);
            color: var(--status-inactive-text);
        }

        .status-badge:hover {
            transform: translateY(-2px);
            filter: brightness(0.95);
        }

        /* BOTONES DE ACCIÓN */
        .action-icons {
            display: flex;
            gap: 8px;
        }

        .icon-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            background: transparent;
            color: var(--primary);
            border: 2px solid var(--primary);
            border-radius: 10px;
            font-weight: 600;
            font-size: 13px;
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
        }

        .icon-btn:hover {
            background-color: var(--primary);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 12px rgba(7, 68, 182, 0.2);
        }

        /* DATATABLES PERSONALIZACIÓN */
        .dataTables_wrapper .dataTables_paginate {
            padding-top: 20px !important;
            display: flex !important;
            justify-content: center !important;
        }

        .dataTables_wrapper .dataTables_paginate .pagination {
            display: flex !important;
    flex-direction: row !important;  /* ← Esto fuerza la dirección horizontal */
    flex-wrap: wrap !important;
    justify-content: center !important;
    align-items: center !important;
    gap: 5px !important;
    margin-bottom: 0 !important;
    list-style: none !important;
        }

        .dataTables_wrapper .dataTables_paginate .pagination .page-item {
    display: inline-block !important;  /* ← Esto hace que cada item sea inline */
    margin: 0 !important;
}

        .dataTables_wrapper .dataTables_paginate .pagination .page-item .page-link {
             color: var(--primary) !important;
    padding: 8px 14px !important;
    border-radius: 8px !important;
    border: 1px solid var(--border-color) !important;
    transition: var(--transition) !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
        }

        .dataTables_wrapper .dataTables_paginate .pagination .page-item.active .page-link {
            background-color: var(--primary) !important;
            border-color: var(--primary) !important;
            color: white !important;
        }

        .dataTables_wrapper .dataTables_paginate .pagination .page-link:hover {
            background-color: var(--primary-soft) !important;
            border-color: var(--primary) !important;
        }

        .dataTables_length {
            margin-bottom: 15px;
        }

        .dataTables_length select {
            padding: 6px 12px;
            border: 2px solid var(--border-color);
            border-radius: 8px;
            margin: 0 5px;
        }

        .search-active-badge {
            background-color: var(--primary-soft);
            color: var(--primary);
            padding: 6px 15px;
            border-radius: 50px;
            font-size: 13px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
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
            max-width: 400px;
            box-shadow: var(--card-shadow-hover);
            overflow: hidden;
        }

        .modal-header {
            padding: 24px 24px 0;
        }

        .modal-header h3 {
            font-size: 20px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 8px;
        }

        .modal-header p {
            color: var(--text-muted);
            font-size: 14px;
        }

        .modal-divider {
            height: 1px;
            background: var(--border-color);
            margin: 20px 24px;
        }

        .modal-actions {
            padding: 0 24px 24px;
            display: flex;
            gap: 12px;
            justify-content: flex-end;
        }

        .modal-btn {
            padding: 10px 20px;
            border-radius: 10px;
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

        .modal-btn.cancel:hover {
            background: var(--border-color);
        }

        .modal-btn.confirm {
            background: var(--gradient-primary);
            color: white;
        }

        .modal-btn.confirm:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 12px rgba(7, 68, 182, 0.2);
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
            .search-container {
                flex-direction: column;
            }
            
            .search-box {
                max-width: 100%;
            }
            
            .btn-search {
                width: 100%;
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
            
            .content-header h1 {
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
            
            .section-header {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .action-icons {
                flex-direction: column;
            }
            
            .icon-btn {
                width: 100%;
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            .content-wrapper {
                padding: 15px;
            }
            
            .section-title {
                font-size: 18px;
            }
            
            .maestro-info {
                flex-direction: column;
                align-items: flex-start;
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
        @if($coordinacion)
        <!-- HEADER -->
        <div class="content-header">
            <h1>Registro de Maestros</h1>
            <p><i class="fas fa-users" style="color: var(--primary); margin-right: 8px;"></i>Gestión de maestros de la coordinación</p>
        </div>

        <!-- SECCIÓN PRINCIPAL -->
        <div class="section">
            <div class="section-header">
                <div class="section-title">
                    <i class="fas fa-chalkboard-teacher"></i>
                    <span>Lista de Maestros</span>
                </div>
                <div class="maestros-count">
                    <i class="fas fa-users"></i>
                    <span id="totalMaestros">{{ $totalMaestros ?? 0 }}</span> Maestros
                </div>
            </div>

            <!-- BUSCADOR -->
            <div class="search-container">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" id="searchInput" placeholder="Buscar maestro por nombre, email o teléfono...">
                </div>
                <button type="button" class="btn-search" id="searchButton">
                    <i class="fas fa-search"></i> Buscar
                </button>
                <a href="{{ route('coordinaciones.maestros-detalle', ['coordinaciones_id' => $coordinacion->id]) }}" class="clear-search" id="clearSearch" style="display: none;">
                    <i class="fas fa-times-circle"></i> Limpiar búsqueda
                </a>
            </div>

            <!-- NOTA INFORMATIVA -->
            <div class="info-note">
                <i class="fas fa-info-circle"></i>
                <div class="info-note-content">
                    <strong>Sobre el estado del maestro:</strong> "Inactivo" significa que el maestro se encuentra con una baja temporal en el instituto. Puede reactivarse en cualquier momento.
                </div>
            </div>

            <!-- TABLA -->
            <div class="table-container">
                <table class="maestros-table" id="maestrosTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Maestro</th>
                            <th>Teléfono</th>
                            <th>Grado Académico</th>
                            <th>Estado</th>
                            <th>Horario</th>
                            <th>Expediente</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($maestros as $index => $maestro)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <div class="maestro-info">
                                    <div class="maestro-avatar">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div class="maestro-name">
                                        <h4>{{ $maestro->nombres ?? '' }} {{ $maestro->apellido_paterno ?? '' }}</h4>
                                        <p><i class="fas fa-envelope"></i> {{ $maestro->email ?? '' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="detalle-item">
                                    <i class="fas fa-phone"></i>
                                    <span>{{ $maestro->telefono ?? 'No especificado' }}</span>
                                </div>
                            </td>
                            <td>
                                <strong>{{ $maestro->maximo_grado_academico ?? 'N/A' }}</strong>
                                @if($maestro->titulo_obtenido)
                                <div class="detalle-item" style="margin-top: 4px;">
                                    <i class="fas fa-graduation-cap"></i>
                                    <span>{{ $maestro->titulo_obtenido }}</span>
                                </div>
                                @endif
                            </td>
                            <td>
                                @if($maestro->activo ?? false)
                                    <button type="button" 
                                            class="status-badge status-active toggle-estado-btn"
                                            data-maestro-id="{{ $maestro->id }}"
                                            data-maestro-nombre="{{ $maestro->nombres ?? '' }} {{ $maestro->apellido_paterno ?? '' }}"
                                            data-estado-actual="1">
                                        <i class="fas fa-check-circle"></i> Activo
                                    </button>
                                @else
                                    <button type="button" 
                                            class="status-badge status-inactive toggle-estado-btn"
                                            data-maestro-id="{{ $maestro->id }}"
                                            data-maestro-nombre="{{ $maestro->nombres ?? '' }} {{ $maestro->apellido_paterno ?? '' }}"
                                            data-estado-actual="0">
                                        <i class="fas fa-times-circle"></i> Inactivo
                                    </button>
                                @endif
                            </td>
                            <td>
                                <div class="action-icons">
                                    <a href="{{ route('horarios.coordinacion.asignacion', $maestro->id) }}" class="icon-btn">
                                        <i class="fas fa-clock"></i> Asignar
                                    </a>
                                </div>
                            </td>
                            <td>
                                <div class="action-icons">
                                    <a href="{{ route('coordinaciones.maestros.expediente', $maestro->id) }}" class="icon-btn">
                                        <i class="fas fa-eye"></i> Ver Exp
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" style="text-align: center; padding: 40px;">
                                <i class="fas fa-users-slash" style="font-size: 48px; margin-bottom: 15px; opacity: 0.3;"></i>
                                <p style="font-size: 16px; color: var(--text-muted);">No hay maestros registrados en esta coordinación</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @endif
    </div>
</div>

<!-- MODAL DE CONFIRMACIÓN -->
<div id="confirmModal" class="modal-overlay" style="display: none;">
    <div class="modal-container">
        <div class="modal-header">
            <h3 id="modalTitle">Cambiar estado</h3>
            <p id="modalMessage">¿Está seguro que desea cambiar el estado del maestro?</p>
        </div>
        <div class="modal-divider"></div>
        <div class="modal-actions">
            <button class="modal-btn cancel" onclick="hideModal()">Cancelar</button>
            <button class="modal-btn confirm" id="confirmBtn">Confirmar</button>
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
        alertDiv.style.borderLeftColor = type === 'success' ? '#10b981' : '#ef4444';
        alertDiv.style.display = 'block';
        
        setTimeout(() => {
            alertDiv.style.display = 'none';
        }, 3000);
    }
    
    // Funciones del modal
    function showModal(title, message, onConfirm) {
        document.getElementById('modalTitle').textContent = title;
        document.getElementById('modalMessage').textContent = message;
        document.getElementById('confirmModal').style.display = 'flex';
        
        document.getElementById('confirmBtn').onclick = function() {
            hideModal();
            if (onConfirm) onConfirm();
        };
    }
    
    function hideModal() {
        document.getElementById('confirmModal').style.display = 'none';
    }
    
    document.addEventListener('DOMContentLoaded', function() {
        // Inicializar DataTable
        if ($('#maestrosTable').length) {
            var table = $('#maestrosTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json",
                    "paginate": {
                        "first": "«",
                        "last": "»",
                        "next": "›",
                        "previous": "‹"
                    },
                    "lengthMenu": "Mostrar _MENU_ registros por página",
                    "zeroRecords": "No se encontraron maestros"
                },
                "order": [[0, "asc"]],
                "pageLength": 10,
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
                "dom": '<"row"<"col-sm-12"l>>rt<"row"<"col-sm-12"p>>',
                "drawCallback": function() {
                    var info = table.page.info();
                    $('#totalMaestros').text(info.recordsDisplay);
                    
                    var searchTerm = table.search();
                    if (searchTerm) {
                        $('#searchBadge').show();
                        $('#searchTermDisplay').text('"' + searchTerm + '"');
                        $('#clearSearch').show();
                    } else {
                        $('#searchBadge').hide();
                        $('#clearSearch').hide();
                    }
                }
            });
            
            // Búsqueda
            $('#searchButton').on('click', function() {
                table.search($('#searchInput').val()).draw();
            });
            
            $('#searchInput').on('keypress', function(e) {
                if (e.key === 'Enter') {
                    table.search($(this).val()).draw();
                }
            });
            
            $('#clearSearch').on('click', function(e) {
                e.preventDefault();
                $('#searchInput').val('');
                table.search('').draw();
            });
        }
        
        // Cambio de estado con modal
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        
        function construirUrl(maestroId) {
            return `/maestros/${maestroId}/cambiar-estado`;
        }
        
        const botonesEstado = document.querySelectorAll('.toggle-estado-btn');
        
        botonesEstado.forEach((boton) => {
            boton.addEventListener('click', function(e) {
                e.preventDefault();
                
                const maestroId = this.dataset.maestroId;
                const maestroNombre = this.dataset.maestroNombre || 'este maestro';
                const estadoActual = parseInt(this.dataset.estadoActual);
                const nuevoEstado = estadoActual === 1 ? 0 : 1;
                const accion = nuevoEstado === 1 ? 'activar' : 'desactivar';
                const accionTexto = nuevoEstado === 1 ? 'ACTIVAR' : 'DESACTIVAR';
                
                const botonOriginal = this;
                const textoOriginal = this.innerHTML;
                
                showModal(
                    `${accionTexto} MAESTRO`,
                    `¿Está seguro que desea ${accion} al maestro "${maestroNombre}"?`,
                    function() {
                        botonOriginal.disabled = true;
                        botonOriginal.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Procesando...';
                        
                        const url = construirUrl(maestroId);
                        
                        fetch(url, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest'
                            },
                            body: JSON.stringify({ activo: nuevoEstado })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                botonOriginal.className = `status-badge ${data.data.badge_class} toggle-estado-btn`;
                                botonOriginal.innerHTML = `<i class="fas ${data.data.icono}"></i> ${data.data.estado_texto}`;
                                botonOriginal.dataset.estadoActual = data.data.activo;
                                botonOriginal.disabled = false;
                                showAlert(data.message, 'success');
                            } else {
                                throw new Error(data.message || 'Error al cambiar estado');
                            }
                        })
                        .catch(error => {
                            botonOriginal.disabled = false;
                            botonOriginal.innerHTML = textoOriginal;
                            showAlert(error.message || 'Error al cambiar el estado del maestro', 'error');
                        });
                    }
                );
            });
        });
        
        // Cerrar modal al hacer clic fuera
        window.addEventListener('click', function(event) {
            const modal = document.getElementById('confirmModal');
            if (event.target === modal) {
                hideModal();
            }
        });
    });
</script>
</body>
</html>