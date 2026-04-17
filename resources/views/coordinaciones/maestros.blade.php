<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estado de Documentos - Sistema GEPROC</title>
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
            --badge-aprobado-bg: #d1fae5;
            --badge-aprobado-text: #065f46;
            --badge-rechazado-bg: #fee2e2;
            --badge-rechazado-text: #991b1b;
            --badge-pendiente-bg: #fef3c7;
            --badge-pendiente-text: #92400e;
            --badge-nosubido-bg: #f1f5f9;
            --badge-nosubido-text: #475569;
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

        /* INFO NOTE CON TOOLTIP */
        .info-wrapper {
            display: flex;
            align-items: center;
            gap: 15px;
            background-color: var(--primary-soft);
            border-radius: 12px;
            padding: 12px 20px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .info-note {
            display: flex;
            align-items: center;
            gap: 12px;
            flex: 1;
            font-size: 14px;
            color: #2d3748;
        }

        .info-note i {
            color: var(--primary);
            font-size: 20px;
        }

        .info-note strong {
            color: var(--primary);
        }

        /* TOOLTIP */
        .tooltip-container {
            position: relative;
            display: inline-flex;
            align-items: center;
        }

        .info-icon-btn {
            width: 38px;
            height: 38px;
            background: var(--gradient-primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            cursor: pointer;
            transition: var(--transition);
            border: none;
        }

        .info-icon-btn:hover {
            transform: scale(1.05);
            box-shadow: var(--card-shadow);
        }

        .info-tooltip {
            position: absolute;
            top: 45px;
            right: 0;
            background: white;
            border-radius: 16px;
            box-shadow: var(--card-shadow-hover);
            width: 320px;
            z-index: 100;
            display: none;
            border: 2px solid var(--border-color);
        }

        .info-tooltip.show {
            display: block;
        }

        .tooltip-header {
            padding: 15px 20px;
            border-bottom: 2px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .tooltip-header h4 {
            font-size: 16px;
            font-weight: 700;
            color: var(--primary);
            margin: 0;
        }

        .close-tooltip {
            background: none;
            border: none;
            font-size: 18px;
            cursor: pointer;
            color: var(--text-muted);
        }

        .tooltip-item {
            padding: 12px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 1px solid var(--border-color);
        }

        .tooltip-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .tooltip-icon.aprobado { background: var(--success-light); color: var(--success-color); }
        .tooltip-icon.rechazado { background: var(--danger-light); color: var(--danger-color); }
        .tooltip-icon.pendiente { background: var(--warning-light); color: var(--warning-color); }
        .tooltip-icon.nosubido { background: var(--light-bg); color: var(--text-muted); }

        .tooltip-text strong {
            display: block;
            font-size: 14px;
            margin-bottom: 2px;
        }

        .tooltip-text p {
            font-size: 12px;
            color: var(--text-muted);
            margin: 0;
        }

        .tooltip-footer {
            padding: 12px 20px;
            background: var(--light-bg);
            font-size: 12px;
            text-align: center;
            color: var(--text-muted);
        }

        /* TABLA */
        .table-container {
            overflow-x: auto;
        }

        .documentos-table {
            width: 100%;
            border-collapse: collapse;
        }

        .documentos-table th {
            text-align: left;
            padding: 15px 12px;
            color: var(--text-muted);
            font-weight: 600;
            font-size: 14px;
            border-bottom: 2px solid var(--border-color);
            background-color: var(--light-bg);
        }

        .documentos-table td {
            padding: 15px 12px;
            border-bottom: 1px solid var(--border-color);
            vertical-align: middle;
        }

        .documentos-table tr:hover td {
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
        }

        /* BADGES DE DOCUMENTOS */
        .doc-badges {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .doc-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 600;
        }

        .doc-badge.aprobado {
            background: var(--badge-aprobado-bg);
            color: var(--badge-aprobado-text);
        }

        .doc-badge.rechazado {
            background: var(--badge-rechazado-bg);
            color: var(--badge-rechazado-text);
        }

        .doc-badge.pendiente {
            background: var(--badge-pendiente-bg);
            color: var(--badge-pendiente-text);
        }

        .doc-badge.nosubido {
            background: var(--badge-nosubido-bg);
            color: var(--badge-nosubido-text);
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
            padding: 10px 20px;
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

        /* DATATABLES */
        .dataTables_wrapper .dataTables_paginate {
            padding-top: 20px !important;
            display: flex !important;
            justify-content: center !important;
        }

        .dataTables_wrapper .dataTables_paginate .pagination {
            display: flex !important;
            flex-direction: row !important;
            flex-wrap: wrap !important;
            justify-content: center !important;
            gap: 5px !important;
            margin-bottom: 0 !important;
        }

        .dataTables_wrapper .dataTables_paginate .pagination .page-item {
            display: inline-block !important;
        }

        .dataTables_wrapper .dataTables_paginate .pagination .page-item .page-link {
            color: var(--primary) !important;
            padding: 8px 14px !important;
            border-radius: 8px !important;
            border: 1px solid var(--border-color) !important;
            transition: var(--transition) !important;
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
            
            .periodo-section {
                flex-direction: column;
                text-align: center;
            }
            
            .info-wrapper {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .info-tooltip {
                right: -80px;
                width: 280px;
            }
            
            .doc-badges {
                flex-direction: column;
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
            
            .info-tooltip {
                right: -100px;
                width: 260px;
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
    
    $searchTerm = request('search', '');
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
        @if($coordinacion)
        <!-- HEADER -->
        <div class="content-header">
            <h1>Estado de Documentos</h1>
            <p><i class="fas fa-clipboard-check" style="color: var(--primary); margin-right: 8px;"></i>Gestión y revisión de documentación académica</p>
        </div>

        <!-- PERÍODO HABILITADO -->
        @if(isset($periodoHabilitado) && $periodoHabilitado)
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
            <div class="periodo-status {{ $periodoHabilitado->activo ? 'status-activo' : 'status-inactivo' }}">
                <i class="fas fa-{{ $periodoHabilitado->activo ? 'check-circle' : 'times-circle' }}"></i>
                {{ $periodoHabilitado->activo ? 'ACTIVO' : 'INACTIVO' }}
            </div>
        </div>
        @else
        <div class="periodo-mensaje">
            <i class="fas fa-info-circle"></i>
            <div>
                <strong>Sin período activo</strong>
                <p style="margin: 5px 0 0 0; font-size: 14px;">No hay un período habilitado actualmente. Los documentos mostrados son de todos los períodos.</p>
            </div>
        </div>
        @endif

        <!-- SECCIÓN PRINCIPAL -->
        <div class="section">
            <div class="section-header">
                <div class="maestros-count">
                    <i class="fas fa-users"></i>
                    <span id="totalMaestros">{{ $totalMaestros ?? 0 }}</span> Maestros
                </div>
            </div>

            <!-- BUSCADOR -->
            <div class="search-container">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" id="searchInput" placeholder="Buscar maestro por nombre o email..." value="{{ $searchTerm }}">
                </div>
                <button type="button" class="btn-search" id="searchButton">
                    <i class="fas fa-search"></i> Buscar
                </button>
                @if($searchTerm)
                <a href="{{ route('coordinaciones.maestros', ['coordinaciones_id' => $coordinacion->id]) }}" class="clear-search">
                    <i class="fas fa-times-circle"></i> Limpiar búsqueda
                </a>
                @endif
            </div>

            <!-- INFO NOTE CON TOOLTIP -->
            <div class="info-wrapper">
                <div class="info-note">
                    <i class="fas fa-lightbulb"></i>
                    <div>
                        <strong>¿Cómo funciona el estado de documentos?</strong> 
                        Los documentos se muestran con 4 estados: 
                        <span style="color: #065f46;">✓ Aprobados</span>, 
                        <span style="color: #991b1b;">✗ Rechazados</span>, 
                        <span style="color: #92400e;">⏱ Pendientes</span> y 
                        <span style="color: #475569;">⬆ No subidos</span>.
                    </div>
                </div>
                
                <div class="tooltip-container" id="infoIcon">
                    <button class="info-icon-btn" id="infoButton">
                        <i class="fas fa-info"></i>
                    </button>
                    <div class="info-tooltip" id="infoTooltip">
                        <div class="tooltip-header">
                            <h4><i class="fas fa-file-alt"></i> Estado de Documentos</h4>
                            <button class="close-tooltip" id="closeTooltip">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="tooltip-item">
                            <div class="tooltip-icon aprobado">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="tooltip-text">
                                <strong>Aprobados</strong>
                                <p>Los documentos han sido aprobados por RH</p>
                            </div>
                        </div>
                        <div class="tooltip-item">
                            <div class="tooltip-icon rechazado">
                                <i class="fas fa-times-circle"></i>
                            </div>
                            <div class="tooltip-text">
                                <strong>Rechazados</strong>
                                <p>Los documentos no cumplen y se tienen que volver a subir</p>
                            </div>
                        </div>
                        <div class="tooltip-item">
                            <div class="tooltip-icon pendiente">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="tooltip-text">
                                <strong>Pendientes</strong>
                                <p>Los documentos están siendo revisados por RH</p>
                            </div>
                        </div>
                        <div class="tooltip-item">
                            <div class="tooltip-icon nosubido">
                                <i class="fas fa-cloud-upload-alt"></i>
                            </div>
                            <div class="tooltip-text">
                                <strong>No subidos</strong>
                                <p>Documentos que aún no han sido cargados por el maestro</p>
                            </div>
                        </div>
                        <div class="tooltip-footer">
                            <i class="fas fa-file-pdf"></i> Total: 6 documentos requeridos por maestro
                        </div>
                    </div>
                </div>
            </div>

            <!-- TABLA -->
            <div class="table-container">
                <table class="documentos-table" id="documentosTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Maestro</th>
                            <th>Grado Académico</th>
                            <th>Estado de Documentos</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($maestros as $index => $maestro)
                        @php
                            $estado = $maestro->estadoDocumentos ?? null;
                            $progreso = $maestro->progresoDocumentos ?? ['subidos' => 0, 'total' => 6];
                            $documentosFaltantes = max(0, ($progreso['total'] ?? 6) - ($progreso['subidos'] ?? 0));
                            $documentosNoSubidos = $documentosFaltantes - (($estado['pendientes'] ?? 0) + ($estado['rechazados'] ?? 0) + ($estado['aprobados'] ?? 0));
                            if ($documentosNoSubidos < 0) $documentosNoSubidos = 0;
                        @endphp
                        <tr>
                            <td><strong>{{ $index + 1 }}</strong></td>
                            <td>
                                <div class="maestro-info">
                                    <div class="maestro-avatar">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div class="maestro-name">
                                        <h4>{{ $maestro->nombres ?? '' }} {{ $maestro->apellido_paterno ?? '' }} {{ $maestro->apellido_materno ?? '' }}</h4>
                                        <p><i class="fas fa-envelope"></i> {{ $maestro->email ?? '' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <strong>{{ $maestro->maximo_grado_academico ?? 'N/A' }}</strong>
                                @if($maestro->especialidad)
                                <br><small style="color: var(--text-muted);">{{ $maestro->especialidad }}</small>
                                @endif
                            </td>
                            <td>
                                <div class="doc-badges">
                                    @if($estado)
                                    <span class="doc-badge aprobado">
                                        <i class="fas fa-check-circle"></i> {{ $estado['aprobados'] ?? 0 }} aprob.
                                    </span>
                                    <span class="doc-badge rechazado">
                                        <i class="fas fa-times-circle"></i> {{ $estado['rechazados'] ?? 0 }} rechaz.
                                    </span>
                                    <span class="doc-badge pendiente">
                                        <i class="fas fa-clock"></i> {{ $estado['pendientes'] ?? 0 }} pend.
                                    </span>
                                    <span class="doc-badge nosubido">
                                        <i class="fas fa-cloud-upload-alt"></i> {{ $documentosNoSubidos }} no sub.
                                    </span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="action-icons">
                                    <a href="{{ route('coordinacion.maestros.documentos', $maestro->id) }}" class="icon-btn">
                                        <i class="fas fa-eye"></i> Ver documentos
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 40px;">
                                <i class="fas fa-users-slash" style="font-size: 48px; margin-bottom: 15px; opacity: 0.3;"></i>
                                <p style="font-size: 16px; color: var(--text-muted);">
                                    @if($searchTerm)
                                        No se encontraron maestros que coincidan con "{{ $searchTerm }}"
                                    @else
                                        No hay maestros registrados en esta coordinación
                                    @endif
                                </p>
                                @if($searchTerm)
                                <a href="{{ route('coordinaciones.maestros', ['coordinaciones_id' => $coordinacion->id]) }}" class="icon-btn" style="margin-top: 15px;">
                                    <i class="fas fa-times"></i> Limpiar búsqueda
                                </a>
                                @endif
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
    
    document.addEventListener('DOMContentLoaded', function() {
        // Tooltip
        const infoButton = document.getElementById('infoButton');
        const infoTooltip = document.getElementById('infoTooltip');
        const closeTooltip = document.getElementById('closeTooltip');
        
        if (infoButton && infoTooltip) {
            infoButton.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                infoTooltip.classList.toggle('show');
            });
            
            if (closeTooltip) {
                closeTooltip.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    infoTooltip.classList.remove('show');
                });
            }
            
            document.addEventListener('click', function(e) {
                if (!infoButton.contains(e.target) && !infoTooltip.contains(e.target)) {
                    infoTooltip.classList.remove('show');
                }
            });
        }
        
        // Inicializar DataTable
        if ($('#documentosTable').length && $('#documentosTable tbody tr').length > 0) {
            var table = $('#documentosTable').DataTable({
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
                "ordering": false,
                "pageLength": 10,
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
                "dom": '<"row"<"col-sm-12"l>>rt<"row"<"col-sm-12"p>>',
                "drawCallback": function() {
                    var info = table.page.info();
                    $('#totalMaestros').text(info.recordsDisplay);
                    
                    // Actualizar números consecutivos
                    var rows = $('#documentosTable tbody tr');
                    rows.each(function(index) {
                        $(this).find('td:first').html('<strong>' + (index + 1) + '</strong>');
                    });
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
            
            @if($searchTerm)
                table.search('{{ $searchTerm }}').draw();
            @endif
            
            $('.dataTables_length select').addClass('form-select form-select-sm');
        }
    });
</script>
</body>
</html>