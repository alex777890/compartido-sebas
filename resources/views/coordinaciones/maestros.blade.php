<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estado de Documentos | GEPROC GP</title>
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
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 1rem;
            box-shadow: 0 2px 10px rgba(102, 126, 234, 0.3);
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

        /* Top Navigation */
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

        .date-display {
            background: white;
            color: var(--primary);
            padding: 12px 20px;
            border-radius: 12px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.95rem;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
        }

        .date-display i {
            color: var(--primary);
            font-size: 1.1rem;
        }

        /* Información de período mejorada */
        .periodo-info {
            background: linear-gradient(135deg, #ffffff 0%, #f0f4ff 100%);
            border-radius: 16px;
            padding: 18px 22px;
            margin-bottom: 25px;
            border: 1px solid rgba(26, 76, 186, 0.2);
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: var(--shadow-sm);
        }

        .periodo-title {
            font-weight: 600;
            color: var(--primary);
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 1rem;
        }

        .periodo-title i {
            font-size: 1.3rem;
            color: var(--primary);
        }

        .periodo-status {
            font-weight: 600;
            padding: 6px 14px;
            border-radius: 30px;
            font-size: 0.8rem;
            letter-spacing: 0.5px;
        }

        .status-activo {
            background: rgba(38, 230, 63, 0.15);
            color: #1a9c2a;
            border: 1px solid rgba(38, 230, 63, 0.3);
        }

        .status-inactivo {
            background: rgba(108, 117, 125, 0.15);
            color: var(--text-muted);
            border: 1px solid rgba(108, 117, 125, 0.3);
        }

        .periodo-mensaje {
            background: linear-gradient(135deg, #fff3cd 0%, #fff9e6 100%);
            border: 1px solid #ffeeba;
            border-radius: 12px;
            padding: 15px 20px;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 15px;
            color: #856404;
            box-shadow: var(--shadow-sm);
        }

        .periodo-mensaje i {
            font-size: 1.5rem;
            color: #856404;
        }

        /* Sección de maestros mejorada */
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

        /* Info Tooltip - MEJORADO: se despliega a la izquierda */
        .info-tooltip-container {
            position: relative;
            display: inline-flex;
            align-items: center;
            cursor: pointer;
        }

        .info-icon {
            width: 36px;
            height: 36px;
            background: var(--primary);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
        }

        .info-icon:hover {
            transform: scale(1.1);
            background: var(--primary-dark);
        }

        .info-tooltip {
            position: absolute;
            top: 45px;
            right: 0;
            background: white;
            border-radius: 16px;
            box-shadow: var(--shadow-lg);
            padding: 20px;
            width: 400px;
            z-index: 10000;
            border: 1px solid var(--border-color);
            display: none;
        }

        .info-tooltip::before {
            content: '';
            position: absolute;
            top: -8px;
            right: 15px;
            width: 16px;
            height: 16px;
            background: white;
            transform: rotate(45deg);
            border-left: 1px solid var(--border-color);
            border-top: 1px solid var(--border-color);
        }

        .info-tooltip.show {
            display: block;
        }

        .tooltip-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--border-color);
        }

        .tooltip-title {
            font-weight: 700;
            color: var(--primary);
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .close-tooltip {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: #f0f0f0;
            border: none;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: var(--transition);
            font-size: 1rem;
        }

        .close-tooltip:hover {
            background: #f44336;
            color: white;
            transform: scale(1.1);
        }

        .tooltip-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 12px 0;
            border-bottom: 1px solid var(--border-color);
        }

        .tooltip-item:last-child {
            border-bottom: none;
        }

        .tooltip-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }

        .tooltip-icon.aprobado {
            background: rgba(26, 156, 42, 0.15);
            color: #1a9c2a;
        }

        .tooltip-icon.rechazado {
            background: rgba(244, 67, 54, 0.15);
            color: #f44336;
        }

        .tooltip-icon.pendiente {
            background: rgba(255, 152, 0, 0.15);
            color: #ff9800;
        }

        .tooltip-icon.nosubido {
            background: rgba(108, 117, 125, 0.15);
            color: #6c757d;
        }

        .tooltip-text {
            flex: 1;
            font-size: 0.95rem;
            color: var(--text-dark);
        }

        .tooltip-text strong {
            color: var(--primary);
            display: block;
            margin-bottom: 4px;
            font-size: 1rem;
        }

        .tooltip-text strong span.aprobado { color: #1a9c2a; }
        .tooltip-text strong span.rechazado { color: #f44336; }

        .tooltip-text p {
            color: var(--text-muted);
            font-size: 0.85rem;
            margin: 0;
            line-height: 1.4;
        }

        .tooltip-footer {
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px dashed var(--border-color);
            font-size: 0.9rem;
            color: var(--text-muted);
            text-align: center;
            background: #f8f9fa;
            border-radius: 10px;
            padding: 12px;
        }

        /* Buscador mejorado - AHORA ARRIBA Y MÁS GRANDE */
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

        /* Info note con el tooltip al lado */
        .info-note-wrapper {
            display: flex;
            align-items: center;
            gap: 15px;
            background: #e8f0fe;
            border-radius: 12px;
            padding: 12px 20px;
            margin-bottom: 20px;
            border: 1px solid rgba(26, 76, 186, 0.2);
        }

        .info-note {
            display: flex;
            align-items: center;
            gap: 12px;
            color: var(--primary);
            font-size: 0.95rem;
            flex: 1;
        }

        .info-note i {
            font-size: 1.3rem;
            color: var(--primary);
        }

        .info-note strong {
            font-weight: 700;
        }

        /* Tabla mejorada */
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

        /* Documentación mejorada con 4 estados */
        .document-progress {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .progress-stats {
            display: flex;
            justify-content: space-between;
            font-size: 0.9rem;
            color: var(--text-dark);
            font-weight: 600;
        }

        .doc-count {
            display: flex;
            align-items: center;
            gap: 8px;
            background: #f8f9fa;
            padding: 6px 12px;
            border-radius: 30px;
            border: 1px solid var(--border-color);
        }

        .doc-count span {
            background: white;
            padding: 2px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 700;
        }

        .entregados { 
            color: #1a9c2a;
            background: rgba(26, 156, 42, 0.1) !important;
        }
        
        .faltantes { 
            color: #f44336;
            background: rgba(244, 67, 54, 0.1) !important;
        }

        /* Nuevos indicadores visuales para documentos con 4 estados */
        .doc-status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 30px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .badge-aprobado {
            background: rgba(38, 230, 63, 0.15);
            color: #1a9c2a;
            border: 1px solid rgba(38, 230, 63, 0.3);
        }

        .badge-rechazado {
            background: rgba(244, 67, 54, 0.15);
            color: #f44336;
            border: 1px solid rgba(244, 67, 54, 0.3);
        }

        .badge-pendiente {
            background: rgba(255, 193, 7, 0.15);
            color: #ff9800;
            border: 1px solid rgba(255, 193, 7, 0.3);
        }

        .badge-nosubido {
            background: rgba(108, 117, 125, 0.15);
            color: #6c757d;
            border: 1px solid rgba(108, 117, 125, 0.3);
        }

        /* Acciones mejoradas */
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

        /* Paginación de DataTables */
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

        /* Ocultar info de DataTables */
        .dataTables_info {
            display: none !important;
        }

        /* Estilo para el buscador de DataTables */
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

        /* Badge para búsqueda activa */
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

        /* Limpiar búsqueda */
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

        /* Responsive */
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
            .nav-menu {
                display: none;
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
            
            .info-note-wrapper {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .info-tooltip {
                width: 300px;
                right: -50px;
            }
            
            .info-tooltip::before {
                right: 65px;
            }
            
            .maestros-table th,
            .maestros-table td {
                padding: 12px 10px;
            }
            
            .table-responsive {
                max-width: 100vw;
            }
            
            .main-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
            
            .header-right {
                width: 100%;
            }
            
            .date-display {
                width: 100%;
                justify-content: center;
            }
        }

        /* Alert mejorado */
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
        
        // Obtener el término de búsqueda actual
        $searchTerm = request('search', '');
    @endphp

    <!-- Top Bar Superior -->
    <div class="top-bar">
        <div class="top-bar-content">
            <div class="header-logo">
                <img src="{{ asset('img/logo_iufim.png') }}" alt="Logo IUFIM" class="logo-img-header">
                <span></span>
            </div>
        </div>
    </div>

    <!-- Top Navigation - Menú principal -->
    <nav class="top-nav">
        <div class="nav-container">
            <div class="nav-left">
                <div class="divider-white"></div>
                
                <div class="nav-menu">
                    <a href="{{ route('coordinacion.dashboard') }}" class="nav-item">
                        <i class="fas fa-home"></i>
                        <span>Inicio</span>
                    </a>
                    <a href="{{ route('coordinaciones.maestros-detalle') }}" class="nav-item">
                        <i class="fas fa-users"></i>
                        <span>Maestros</span>
                    </a>
                    <a href="{{ route('coordinaciones.maestros') }}" class="nav-item active">
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

    <!-- Main Content -->
    <main class="main-content">
        <div class="content-container">
            
            
            <div class="main-header">
                <div class="header-left">
                    <h2>Estado de Documentos</h2>
                    <p><i class="fas fa-clipboard-check"></i> Gestión y revisión de documentación académica</p>
                </div>
                <div class="header-right">
                </div>
            </div>

            @if($coordinacion)
                <!-- ✅ INFORMACIÓN DEL PERÍODO - CON VALIDACIÓN -->
                @if(isset($periodoHabilitado) && $periodoHabilitado)
                <div class="periodo-info">
                    <div class="periodo-title">
                        <i class="fas fa-calendar-check"></i>
                        <div>
                            <strong>{{ $periodoHabilitado->nombre }}</strong>
                            @if($periodoHabilitado->fecha_inicio && $periodoHabilitado->fecha_fin)
                            <div style="font-size: 0.85rem; color: var(--text-muted); margin-top: 3px;">
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
                        <p style="margin: 5px 0 0 0; font-size: 0.9rem;">
                            No hay un período habilitado actualmente. Los documentos mostrados son de todos los períodos.
                        </p>
                    </div>
                </div>
                @endif

                <div class="maestros-section">
                    <div class="section-header">
                        <div class="maestros-count">
                            <i class="fas fa-users"></i> 
                            <span id="totalMaestros">{{ $totalMaestros ?? 0 }}</span> Maestros
                        </div>
                    </div>

                    <!-- FILTRO DE BÚSQUEDA GRANDE ARRIBA DEL TEXTO -->
                    <div class="search-filter-top">
                        <div class="search-box-large">
                            <i class="fas fa-search"></i>
                            <input type="text" id="searchInput" placeholder="Buscar maestro por nombre o email..." value="{{ $searchTerm }}" autocomplete="off">
                        </div>
                        <button type="button" class="search-btn-large" id="searchButton">
                            <i class="fas fa-search"></i> Buscar
                        </button>
                        @if($searchTerm)
                        <a href="{{ route('coordinaciones.maestros', ['coordinaciones_id' => $coordinacion->id]) }}" class="clear-search">
                            <i class="fas fa-times-circle"></i> Limpiar
                        </a>
                        @endif
                    </div>

                    <!-- Nota explicativa con tooltip al lado -->
                    <div class="info-note-wrapper">
                        <div class="info-note">
                            <i class="fas fa-lightbulb"></i>
                            <div>
                                <strong>¿Cómo funciona el estado de documentos?</strong> 
                                Los documentos se muestran con 4 estados: 
                                <span style="color: #1a9c2a;">✓ Aprobados</span>, 
                                <span style="color: #f44336;">✗ Rechazados</span>, 
                                <span style="color: #ff9800;">⏱ Pendientes</span> y 
                                <span style="color: #6c757d;">⬆ No subidos</span>.
                            </div>
                        </div>
                        
                        <!-- Ícono de información con tooltip -->
                        <div class="info-tooltip-container" id="infoIcon">
                            <div class="info-icon">
                                <i class="fas fa-info"></i>
                            </div>
                            <div class="info-tooltip" id="infoTooltip">
                                <div class="tooltip-header">
                                    <div class="tooltip-title">
                                        <i class="fas fa-file-alt"></i> Estado de Documentos
                                    </div>
                                    <button class="close-tooltip" id="closeTooltip">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                                <div class="tooltip-item">
                                    <div class="tooltip-icon aprobado">
                                        <i class="fas fa-check-circle"></i>
                                    </div>
                                    <div class="tooltip-text">
                                        <strong>Aprobados <span class="aprobado">✓</span></strong>
                                        <p>Los documentos han sido aprobados por RH</p>
                                    </div>
                                </div>
                                <div class="tooltip-item">
                                    <div class="tooltip-icon rechazado">
                                        <i class="fas fa-times-circle"></i>
                                    </div>
                                    <div class="tooltip-text">
                                        <strong>Rechazados <span class="rechazado">✗</span></strong>
                                        <p>Los documentos no cumplen con lo especificado y se tienen que volver a subir</p>
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

                    <div class="maestros-table-container">
                        <div class="table-header">
                            <h3><i class="fas fa-list"></i> Lista de Maestros y su Documentación</h3>
                            @if($searchTerm)
                            <div class="search-active-badge">
                                <i class="fas fa-filter"></i> Filtrado por: "{{ $searchTerm }}"
                                <a href="{{ route('coordinaciones.maestros', ['coordinaciones_id' => $coordinacion->id]) }}">
                                    <i class="fas fa-times"></i>
                                </a>
                            </div>
                            @endif
                        </div>
                        <div class="table-responsive">
                            <table class="maestros-table" id="documentosTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Maestro</th>
                                        <th>Grado Academico</th>
                                        <th>Estado de Documentos</th>
                                        <th>Ver Documentos</th>
                                    </tr>
                                </thead>
                                <tbody id="maestrosTableBody">
                                    @forelse($maestros as $index => $maestro)
                                    @php
                                        // ✅ USAR VARIABLES CON VALIDACIÓN
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
                                            <br>
                                            <small style="color: var(--text-muted);">{{ $maestro->especialidad ?? '' }}</small>
                                        </td>
                                        <td>
                                            <div class="document-progress">
                                                @if($estado)
                                                <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                                                    <span class="doc-status-badge badge-aprobado">
                                                        <i class="fas fa-check-circle"></i> {{ $estado['aprobados'] ?? 0 }} aprob.
                                                    </span>
                                                    <span class="doc-status-badge badge-rechazado">
                                                        <i class="fas fa-times-circle"></i> {{ $estado['rechazados'] ?? 0 }} rechaz.
                                                    </span>
                                                    <span class="doc-status-badge badge-pendiente">
                                                        <i class="fas fa-clock"></i> {{ $estado['pendientes'] ?? 0 }} pend.
                                                    </span>
                                                    <span class="doc-status-badge badge-nosubido">
                                                        <i class="fas fa-cloud-upload-alt"></i> {{ $documentosNoSubidos }} no sub.
                                                    </span>
                                                </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                                <div class="action-icons">
        <a href="{{ route('coordinacion.maestros.documentos', $maestro->id) }}" class="icon-btn" title="Ver documentos" style="width: auto; padding: 0 15px;">
            <i class="fas fa-eye" style="margin-right: 5px;"></i> Ver documentos
        </a>
    </div>

                                        </td>
                                        
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" style="text-align: center; padding: 40px;">
                                            <i class="fas fa-users-slash" style="font-size: 3rem; margin-bottom: 15px; opacity: 0.3; color: var(--text-muted);"></i>
                                            <p style="font-size: 1.1rem; color: var(--text-muted); margin-bottom: 15px;">
                                                @if($searchTerm)
                                                    No se encontraron maestros que coincidan con "{{ $searchTerm }}"
                                                @else
                                                    No hay maestros registrados en esta coordinación
                                                @endif
                                            </p>
                                            @if($searchTerm)
                                            <a href="{{ route('coordinaciones.maestros', ['coordinaciones_id' => $coordinacion->id]) }}" 
                                               class="filter-btn primary-btn" style="display: inline-flex; margin-top: 10px;">
                                                <i class="fas fa-times"></i> Limpiar búsqueda
                                            </a>
                                            @else
                                            <a href="{{ route('maestros.create') }}?coordinaciones_id={{ $coordinacion->id }}" 
                                               class="filter-btn primary-btn" style="display: inline-flex; margin-top: 10px;">
                                                <i class="fas fa-plus"></i> Agregar primer maestro
                                            </a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </main>

    <!-- Alert Container -->
    <div id="alertMessage"></div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
<script>
    // Función para mostrar alertas
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

    // Script principal
    document.addEventListener('DOMContentLoaded', function() {
        // Verificar si existe el tooltip (para la vista de documentos)
        const infoIcon = document.getElementById('infoIcon');
        const infoTooltip = document.getElementById('infoTooltip');
        const closeTooltip = document.getElementById('closeTooltip');
        
        // TOOLTIP: se abre al hacer clic y se cierra con la X
        if (infoIcon && infoTooltip) {
            infoIcon.addEventListener('click', function(e) {
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
                if (!infoIcon.contains(e.target) && !infoTooltip.contains(e.target)) {
                    infoTooltip.classList.remove('show');
                }
            });
            
            infoTooltip.addEventListener('click', function(e) {
                e.stopPropagation();
            });
        }

// Inicializar DataTable para la tabla de documentos - SIN ORDENAMIENTO
if ($('#documentosTable').length) {
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
        // ✅ DESACTIVAR TODO ORDENAMIENTO COMPLETAMENTE
        "ordering": false,
        "order": [],
        "orderFixed": [],
        "orderCellsTop": false,
        "orderClasses": false,
        "orderMulti": false,
        
        "pageLength": 10,
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
        "responsive": true,
        "dom": '<"row"<"col-sm-12"l>>rt<"row"<"col-sm-12"p>>',
        "columnDefs": [
            { 
                "targets": "_all",
                "orderable": false,
                "searchable": true // Mantener búsqueda
            }
        ],
        "drawCallback": function() {
            var info = table.page.info();
            $('#totalMaestros').text(info.recordsDisplay);
            
            // ✅ Actualizar números consecutivos
            updateConsecutiveNumbers();
        }
    });

    // Función para actualizar números consecutivos
    function updateConsecutiveNumbers() {
        var rows = $('#documentosTable tbody tr');
        rows.each(function(index) {
            $(this).find('td:first').html('<strong>' + (index + 1) + '</strong>');
        });
    }

    // Configurar búsqueda personalizada
    $('#searchButton').on('click', function() {
        table.search($('#searchInput').val()).draw();
    });

    $('#searchInput').on('keypress', function(e) {
        if (e.key === 'Enter') {
            table.search($(this).val()).draw();
        }
    });

    // Si hay término de búsqueda inicial, aplicarlo
    @if($searchTerm)
        table.search('{{ $searchTerm }}').draw();
    @endif

    // Ajustar estilos del select
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