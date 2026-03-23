<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes, viewport-fit=cover">
    <title>Lista de Maestros | GEPROC GP</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Agregar Bootstrap para el paginado simple -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery para DataTables -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables CSS y JS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
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
            --status-inactive-bg: #fee2e2;
            --status-inactive-text: #991b1b;
            --status-inactive-border: #fecaca;
            --status-active-bg: #dcfce7;
            --status-active-text: #166534;
            --status-active-border: #bbf7d0;
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
            overflow-x: hidden;
        }

        /* Top Bar Superior */
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

        /* Top Navigation - Versión Hamburguesa */
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

        /* Botón Hamburguesa */
        .hamburger-btn {
            background: rgba(255, 255, 255, 0.15);
            border: none;
            width: 45px;
            height: 45px;
            border-radius: 10px;
            color: white;
            font-size: 1.3rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: none;
            align-items: center;
            justify-content: center;
        }

        .hamburger-btn:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: scale(1.05);
        }

        .divider-white {
            width: 2px;
            height: 40px;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 2px;
        }

        /* Menú Desktop */
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

        /* Menú Móvil Desplegable */
        .mobile-nav-menu {
            position: fixed;
            top: 140px;
            left: 0;
            right: 0;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            z-index: 999;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.4s ease-out;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        .mobile-nav-menu.open {
            max-height: 400px;
            overflow-y: auto;
        }

        .mobile-nav-items {
            padding: 15px 20px;
        }

        .mobile-nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 20px;
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            border-radius: 12px;
            transition: all 0.2s ease;
            font-weight: 500;
            font-size: 1rem;
            margin-bottom: 8px;
        }

        .mobile-nav-item i {
            font-size: 1.2rem;
            width: 24px;
        }

        .mobile-nav-item:hover {
            background: rgba(255, 255, 255, 0.15);
            color: white;
            transform: translateX(5px);
        }

        .mobile-nav-item.active {
            color: white;
            background: rgba(255, 255, 255, 0.2);
            font-weight: 600;
        }

        /* Overlay para cerrar menú */
        .menu-overlay {
            position: fixed;
            top: 140px;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 998;
            display: none;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .menu-overlay.active {
            display: block;
            opacity: 1;
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

        /* Main Content */
        .main-content {
            margin-top: 140px;
            padding: 30px 40px;
            min-height: calc(100vh - 140px);
        }

        .content-container {
            max-width: 1400px;
            margin: 0 auto;
        }

        /* Header mejorado */
        .main-header {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            border-radius: 16px;
            padding: 24px 30px;
            margin-bottom: 25px;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .main-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 6px;
            height: 100%;
            background: var(--gradient-primary);
            border-radius: 6px 0 0 6px;
        }

        .header-left h2 {
            font-size: 1.8rem;
            color: var(--text-dark);
            font-weight: 700;
            margin-bottom: 8px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .header-left p {
            color: var(--text-muted);
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .header-left p i {
            color: var(--primary);
            font-size: 1.1rem;
        }

        /* Sección de maestros */
        .maestros-section {
            background: var(--card-bg);
            border-radius: 20px;
            padding: 25px;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid var(--border-color);
        }

        .section-header h2 {
            font-size: 1.5rem;
            color: var(--primary);
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-header h2 i {
            background: var(--light-primary);
            padding: 8px;
            border-radius: 10px;
            color: var(--primary);
        }

        .maestros-count {
            background: var(--gradient-primary);
            color: white;
            padding: 10px 20px;
            border-radius: 30px;
            font-weight: 600;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: var(--shadow-sm);
        }

        /* BUSCADOR */
        .search-filter-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            gap: 20px;
        }

        .search-box-large {
            flex: 1;
            position: relative;
            max-width: 500px;
        }

        .search-box-large input {
            width: 100%;
            padding: 15px 20px 15px 50px;
            border: 2px solid var(--border-color);
            border-radius: 12px;
            font-size: 1rem;
            background: white;
            transition: var(--transition);
        }

        .search-box-large input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(26, 76, 186, 0.1);
        }

        .search-box-large i {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            font-size: 1.2rem;
        }

        .search-btn-large {
            background: var(--primary);
            color: white;
            border: none;
            padding: 15px 35px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            transition: var(--transition);
            min-width: 140px;
            justify-content: center;
        }

        .search-btn-large:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .search-btn-large i {
            font-size: 1.2rem;
        }

        .clear-search {
            color: var(--primary);
            text-decoration: none;
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 5px 10px;
            border-radius: 20px;
            transition: var(--transition);
        }

        .clear-search:hover {
            background: rgba(26, 76, 186, 0.1);
        }

        /* Nota informativa */
        .info-note {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            border-left: 4px solid var(--primary);
            border-radius: 8px;
            padding: 16px 20px;
            margin-bottom: 20px;
            display: flex;
            align-items: flex-start;
            gap: 12px;
            border: 1px solid var(--border-color);
            box-shadow: var(--shadow-sm);
        }

        .info-note i {
            font-size: 1.4rem;
            color: var(--primary);
            margin-top: 2px;
        }

        .info-note-content {
            flex: 1;
        }

        .info-note-title {
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 4px;
            font-size: 0.95rem;
        }

        .info-note-text {
            color: var(--text-muted);
            font-size: 0.9rem;
            line-height: 1.5;
        }

        .info-note-text strong {
            color: var(--primary);
            font-weight: 600;
        }

        /* Tabla */
        .maestros-table-container {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
            margin-bottom: 20px;
        }

        .table-header {
            padding: 18px 22px;
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            border-bottom: 2px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .table-header h3 {
            color: var(--text-dark);
            font-weight: 700;
            font-size: 1.2rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .table-header h3 i {
            color: var(--primary);
        }

        .search-active-badge {
            background: var(--primary);
            color: white;
            padding: 5px 15px;
            border-radius: 30px;
            font-size: 0.85rem;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .search-active-badge a {
            color: white;
            text-decoration: none;
            margin-left: 5px;
            opacity: 0.8;
        }

        .search-active-badge a:hover {
            opacity: 1;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .maestros-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 1100px;
            font-size: 0.95rem;
        }

        .maestros-table th {
            padding: 16px 14px;
            text-align: left;
            font-weight: 700;
            color: var(--primary);
            border-bottom: 2px solid var(--border-color);
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.5px;
            background: linear-gradient(135deg, #f8fafc 0%, #ffffff 100%);
        }

        .maestros-table td {
            padding: 16px 14px;
            border-bottom: 1px solid var(--border-color);
            vertical-align: middle;
        }

        .maestros-table tbody tr:hover {
            background: var(--light-primary);
            transition: var(--transition);
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
            white-space: normal;
            overflow: visible;
            text-overflow: clip;
        }

        .maestro-name p {
            font-size: 0.85rem;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: 5px;
            white-space: normal;
            overflow: visible;
            text-overflow: clip;
        }

        .maestro-name p i {
            font-size: 0.8rem;
            color: var(--primary);
        }

        .maestro-detalle {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .detalle-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9rem;
            line-height: 1.3;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .detalle-item i {
            width: 16px;
            color: var(--text-muted);
            font-size: 0.85rem;
            flex-shrink: 0;
        }

        .detalle-item span {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Badge de estado */
        .status-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            white-space: nowrap;
            border: 1px solid transparent;
            min-width: 85px;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }

        .status-badge i {
            font-size: 0.8rem;
        }

        .status-badge.status-active {
            background: var(--status-active-bg);
            color: var(--status-active-text);
            border-color: var(--status-active-border);
        }

        .status-badge.status-active:hover {
            background: #bbf7d0;
            border-color: #86efac;
            transform: translateY(-1px);
            box-shadow: 0 2px 5px rgba(22, 101, 52, 0.2);
        }

        .status-badge.status-inactive {
            background: var(--status-inactive-bg);
            color: var(--status-inactive-text);
            border-color: var(--status-inactive-border);
        }

        .status-badge.status-inactive:hover {
            background: #fecaca;
            border-color: #fca5a5;
            transform: translateY(-1px);
            box-shadow: 0 2px 5px rgba(153, 27, 27, 0.2);
        }

        .status-badge:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none !important;
            box-shadow: none !important;
        }

        /* Acciones */
        .action-icons {
            display: flex;
            gap: 6px;
        }

        .icon-btn {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
            color: var(--text-muted);
            cursor: pointer;
            border: 2px solid var(--border-color);
            text-decoration: none;
            font-size: 0.9rem;
            transition: var(--transition);
        }

        .icon-btn:hover {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
            transform: translateY(-2px);
            box-shadow: var(--shadow-sm);
        }

        .icon-btn[style*="width: auto"] {
            width: auto !important;
            padding: 0 15px !important;
            gap: 5px;
        }

        /* PAGINACIÓN DE DATATABLES */
        .dataTables_wrapper .dataTables_paginate {
            padding-top: 20px !important;
            display: flex !important;
            justify-content: center !important;
        }

        .dataTables_wrapper .dataTables_paginate .pagination {
            margin-bottom: 0 !important;
            font-size: 0.8rem !important;
            gap: 3px;
        }

        .dataTables_wrapper .dataTables_paginate .pagination .page-item .page-link {
            color: var(--primary) !important;
            font-size: 0.8rem !important;
            padding: 6px 12px !important;
            border-radius: 6px !important;
            border: 1px solid var(--border-color) !important;
            margin: 0 2px !important;
            min-width: 36px !important;
            height: 36px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            transition: var(--transition) !important;
            background: white !important;
        }

        .dataTables_wrapper .dataTables_paginate .pagination .page-item.active .page-link {
            background-color: var(--primary) !important;
            border-color: var(--primary) !important;
            color: white !important;
        }

        .dataTables_wrapper .dataTables_paginate .pagination .page-link:hover {
            background-color: rgba(26, 76, 186, 0.1) !important;
            border-color: var(--primary) !important;
            color: var(--primary) !important;
            transform: translateY(-2px);
        }

        .dataTables_wrapper .dataTables_paginate .pagination .page-item.disabled .page-link {
            color: #6c757d !important;
            background: #f8f9fa !important;
            border-color: var(--border-color) !important;
            opacity: 0.6;
        }

        .dataTables_info {
            display: none !important;
        }

        .dataTables_filter {
            display: none !important;
        }

        .dataTables_length {
            margin-bottom: 15px;
        }

        .dataTables_length select {
            padding: 6px 10px;
            border: 2px solid var(--border-color);
            border-radius: 8px;
            font-size: 0.9rem;
            margin: 0 5px;
        }

        /* Modal de confirmación */
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
            z-index: 11000;
            backdrop-filter: blur(4px);
            animation: fadeIn 0.2s ease;
        }

        .modal-container {
            background: white;
            border-radius: 16px;
            width: 90%;
            max-width: 400px;
            box-shadow: var(--shadow-lg);
            animation: slideUp 0.3s ease;
            overflow: hidden;
        }

        .modal-header {
            padding: 20px 24px 0;
        }

        .modal-header h3 {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 8px;
        }

        .modal-header p {
            color: var(--text-muted);
            font-size: 0.95rem;
            line-height: 1.5;
        }

        .modal-header p strong {
            color: var(--primary);
            font-weight: 600;
        }

        .modal-divider {
            height: 1px;
            background: var(--border-color);
            margin: 16px 24px;
        }

        .modal-actions {
            padding: 0 24px 24px;
            display: flex;
            gap: 12px;
            justify-content: flex-end;
        }

        .modal-btn {
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer;
            transition: var(--transition);
            border: none;
        }

        .modal-btn.cancel {
            background: #f1f5f9;
            color: var(--text-muted);
        }

        .modal-btn.cancel:hover {
            background: #e2e8f0;
        }

        .modal-btn.confirm {
            background: var(--gradient-primary);
            color: white;
        }

        .modal-btn.confirm:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideUp {
            from {
                transform: translateY(20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        /* Alert Container */
        #alertMessage {
            position: fixed;
            top: 160px;
            right: 25px;
            padding: 15px 25px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
            border-left: 5px solid var(--accent);
            z-index: 10000;
            display: none;
            font-size: 1rem;
            font-weight: 500;
            animation: slideIn 0.3s ease;
        }

        .toggle-estado-btn {
            cursor: pointer !important;
            transition: all 0.3s ease !important;
            border: none !important;
            width: 100% !important;
            text-align: center !important;
            background: transparent !important;
            font-family: inherit;
        }
        
        .toggle-estado-btn:hover {
            transform: scale(1.02);
            filter: brightness(0.95);
        }
        
        .toggle-estado-btn:disabled {
            opacity: 0.7;
            cursor: not-allowed !important;
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .table-responsive {
                max-width: calc(100vw - 80px);
            }
        }

        @media (max-width: 1024px) {
            .top-bar-right .top-bar-item span:not(.user-avatar) {
                display: none;
            }
        }

        @media (max-width: 768px) {
            /* Ocultar menú desktop y mostrar hamburguesa */
            .nav-menu {
                display: none;
            }
            
            .hamburger-btn {
                display: flex;
            }
            
            .divider-white {
                display: none;
            }
            
            .main-content {
                padding: 20px;
                margin-top: 130px;
            }
            
            .top-bar {
                padding: 0 20px;
                height: 60px;
            }
            
            .top-nav {
                top: 60px;
            }
            
            .nav-container {
                height: 60px;
                padding: 0 20px;
            }
            
            .mobile-nav-menu {
                top: 130px;
            }
            
            .menu-overlay {
                top: 130px;
            }
            
            .top-bar-right {
                gap: 10px;
            }
            
            .search-filter-top {
                flex-direction: column;
                align-items: stretch;
            }
            
            .search-box-large {
                max-width: 100%;
            }
            
            .search-btn-large {
                width: 100%;
            }
            
            .table-responsive {
                max-width: 100vw;
            }
            
            .info-note {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .modal-actions {
                flex-direction: column;
            }
            
            .modal-btn {
                width: 100%;
            }
            
            .logo-img-header {
                width: 60px;
                height: 60px;
            }
            
            .header-logo span {
                font-size: 1rem;
            }
        }

        @media (max-width: 480px) {
            .section-header {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
            }
            
            .main-header {
                padding: 20px;
            }
            
            .header-left h2 {
                font-size: 1.3rem;
            }
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

    <!-- Top Bar Superior -->
    <div class="top-bar">
        <div class="top-bar-content">
            <div class="header-logo">
                <img src="{{ asset('img/logo_iufim.png') }}" alt="Logo IUFIM" class="logo-img-header">
                <span></span>
            </div>
            
            <div class="top-bar-right">
                <div class="top-bar-divider"></div>
                <div class="user-avatar">
                    {{ $userInitials }}
                </div>
            </div>
        </div>
    </div>

    <!-- Top Navigation con menú hamburguesa -->
    <nav class="top-nav">
        <div class="nav-container">
            <div class="nav-left">
                <!-- Botón Hamburguesa -->
                <button class="hamburger-btn" id="hamburgerBtn">
                    <i class="fas fa-bars"></i>
                </button>
                
                <!-- Menú Desktop (visible en escritorio) -->
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
                    <a href="{{ route('coordinaciones.estatus') }}" class="nav-item">
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

    <!-- Menú Móvil Desplegable -->
    <div class="mobile-nav-menu" id="mobileMenu">
        <div class="mobile-nav-items">
            <a href="{{ route('coordinacion.dashboard') }}" class="mobile-nav-item">
                <i class="fas fa-home"></i>
                <span>Inicio</span>
            </a>
            <a href="{{ route('coordinaciones.maestros-detalle') }}" class="mobile-nav-item active">
                <i class="fas fa-users"></i>
                <span>Maestros</span>
            </a>
            <a href="{{ route('coordinaciones.maestros') }}" class="mobile-nav-item">
                <i class="fas fa-file-alt"></i>
                <span>Documentos</span>
            </a>
            <a href="{{ route('coordinaciones.estatus') }}" class="mobile-nav-item">
                <i class="fas fa-chart-bar"></i>
                <span>Estadísticas</span>
            </a>
            <a href="{{ route('coordinaciones.show', $coordinacion->id ?? '#') }}" class="mobile-nav-item">
                <i class="fas fa-building"></i>
                <span>Mi Coordinación</span>
            </a>
        </div>
    </div>

    <!-- Overlay para cerrar menú -->
    <div class="menu-overlay" id="menuOverlay"></div>

    <!-- Main Content (CONTENIDO ORIGINAL SIN MODIFICAR) -->
    <main class="main-content">
        <div class="content-container">
            
            <!-- HEADER -->
            <div class="main-header">
                <div class="header-left">
                    <h2>Registro de Maestros</h2>
                    <p><i class="fas fa-users"></i> Gestión de maestros de la coordinación</p>
                </div>
                <div class="header-right">
                </div>
            </div>

            @if($coordinacion)
                <div class="maestros-section">
                    <div class="section-header">
                        <h2><i class="fas fa-chalkboard-teacher"></i> Lista de Maestros</h2>
                        <div class="maestros-count">
                            <i class="fas fa-users"></i> 
                            <span id="totalMaestros">{{ $totalMaestros ?? 0 }}</span> Maestros
                        </div>
                    </div>

                    <!-- FILTRO DE BÚSQUEDA -->
                    <div class="search-filter-top">
                        <div class="search-box-large">
                            <i class="fas fa-search"></i>
                            <input type="text" id="searchInput" placeholder="Buscar maestro por nombre, email o teléfono..." value="" autocomplete="off">
                        </div>
                        <button type="button" class="search-btn-large" id="searchButton">
                            <i class="fas fa-search"></i> Buscar
                        </button>
                        <a href="{{ route('coordinaciones.maestros-detalle', ['coordinaciones_id' => $coordinacion->id]) }}" class="clear-search" id="clearSearch" style="display: none;">
                            <i class="fas fa-times-circle"></i> Limpiar
                        </a>
                    </div>

                    <!-- NOTA INFORMATIVA SOBRE EL ESTADO -->
                    <div class="info-note">
                        <i class="fas fa-info-circle"></i>
                        <div class="info-note-content">
                            <div class="info-note-title">Sobre el estado del maestro</div>
                            <div class="info-note-text">
                                <strong>Inactivo:</strong> El maestro se encuentra con una <strong>baja temporal en el instituto</strong>. 
                                Puede reactivarse en cualquier momento cuando se reincorpore a sus actividades académicas.
                            </div>
                        </div>
                    </div>

                    <div class="maestros-table-container">
                        <div class="table-header">
                            <h3><i class="fas fa-list"></i> Maestros registrados</h3>
                            <div class="search-active-badge" id="searchBadge" style="display: none;">
                                <i class="fas fa-filter"></i> Filtrado: <span id="searchTermDisplay"></span>
                                <a href="#" id="removeSearch"><i class="fas fa-times"></i></a>
                            </div>
                        </div>
                        <div class="table-responsive">
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
                                            <div class="maestro-detalle">
                                                <div class="detalle-item">
                                                    <i class="fas fa-phone"></i>
                                                    <span>{{ $maestro->telefono ?? 'No especificado' }}</span>
                                                </div>
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
                                                        data-estado-actual="1"
                                                        title="Haz clic para cambiar estado">
                                                    <i class="fas fa-check-circle"></i> Activo
                                                </button>
                                            @else
                                                <button type="button" 
                                                        class="status-badge status-inactive toggle-estado-btn"
                                                        data-maestro-id="{{ $maestro->id }}"
                                                        data-maestro-nombre="{{ $maestro->nombres ?? '' }} {{ $maestro->apellido_paterno ?? '' }}"
                                                        data-estado-actual="0"
                                                        title="Haz clic para cambiar estado">
                                                    <i class="fas fa-times-circle"></i> Inactivo
                                                </button>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="action-icons">
                                                <a href="{{ route('horarios.coordinacion.asignacion', $maestro->id) }}" class="icon-btn" title="Asignar horario" style="width: auto; padding: 0 15px;">
                                                    <i class="fas fa-clock"></i> Asignar
                                                </a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="action-icons">
                                                <a href="{{ route('coordinaciones.maestros.expediente', $maestro->id) }}" class="icon-btn" title="Ver documentos" style="width: auto; padding: 0 15px;">
                                                    <i class="fas fa-eye"></i> Ver Exp
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" style="text-align: center; padding: 40px;">
                                            <i class="fas fa-users-slash" style="font-size: 3rem; margin-bottom: 15px; opacity: 0.3; color: var(--text-muted);"></i>
                                            <p style="font-size: 1.1rem; color: var(--text-muted);">No hay maestros registrados en esta coordinación</p>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="dataTables_info" style="display: none;"></div>
                </div>
            @endif
        </div>
    </main>

    <!-- Modal de confirmación personalizado -->
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

    <!-- Alert Container -->
    <div id="alertMessage"></div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Control del menú hamburguesa
        const hamburgerBtn = document.getElementById('hamburgerBtn');
        const mobileMenu = document.getElementById('mobileMenu');
        const menuOverlay = document.getElementById('menuOverlay');
        
        function toggleMenu() {
            mobileMenu.classList.toggle('open');
            menuOverlay.classList.toggle('active');
            
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
            menuOverlay.classList.remove('active');
            const icon = hamburgerBtn.querySelector('i');
            icon.classList.remove('fa-times');
            icon.classList.add('fa-bars');
        }
        
        if (hamburgerBtn) {
            hamburgerBtn.addEventListener('click', toggleMenu);
        }
        
        if (menuOverlay) {
            menuOverlay.addEventListener('click', closeMenu);
        }
        
        // Cerrar menú al hacer click en un enlace
        const mobileLinks = document.querySelectorAll('.mobile-nav-item');
        mobileLinks.forEach(link => {
            link.addEventListener('click', closeMenu);
        });
        
        // Cerrar menú al redimensionar a escritorio
        window.addEventListener('resize', () => {
            if (window.innerWidth > 768 && mobileMenu.classList.contains('open')) {
                closeMenu();
            }
        });
        
        // Fecha actual
        function updateDate() {
            const dateElement = document.getElementById('currentDate');
            if (dateElement) {
                const today = new Date();
                const options = { day: 'numeric', month: 'short', year: 'numeric' };
                dateElement.textContent = today.toLocaleDateString('es-ES', options);
            }
        }
        
        function showAlert(message, type = 'success') {
            const alertDiv = document.getElementById('alertMessage');
            alertDiv.textContent = message;
            alertDiv.style.borderLeftColor = type === 'success' ? '#26E63F' : '#ff6b6b';
            alertDiv.style.display = 'block';
            
            setTimeout(() => {
                alertDiv.style.display = 'none';
            }, 3000);
        }

        // Funciones para el modal personalizado
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
            updateDate();
            
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
                    "responsive": true,
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

                // Búsqueda con el botón
                $('#searchButton').on('click', function() {
                    var searchTerm = $('#searchInput').val();
                    table.search(searchTerm).draw();
                });

                // Búsqueda con Enter
                $('#searchInput').on('keypress', function(e) {
                    if (e.key === 'Enter') {
                        table.search($(this).val()).draw();
                    }
                });

                // Limpiar búsqueda
                $('#clearSearch, #removeSearch').on('click', function(e) {
                    e.preventDefault();
                    $('#searchInput').val('');
                    table.search('').draw();
                });

                $('.dataTables_length select').addClass('form-select form-select-sm');
            }

            // Script para cambio de estado con modal personalizado
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            
            function construirUrl(maestroId) {
                return `/maestros/${maestroId}/cambiar-estado`;
            }

            const botonesEstado = document.querySelectorAll('.toggle-estado-btn');
            
            botonesEstado.forEach((boton) => {
                boton.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    
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
                                body: JSON.stringify({
                                    activo: nuevoEstado
                                })
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
                                console.error('Error:', error);
                                botonOriginal.disabled = false;
                                botonOriginal.innerHTML = textoOriginal;
                                showAlert(error.message || 'Error al cambiar el estado del maestro', 'error');
                            });
                        }
                    );
                });
            });

            // Cerrar modal si se hace clic fuera de él
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