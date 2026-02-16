<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Coordinación | GEPROC GP</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #0744b6ff;
            --secondary: #33CAE6;
            --accent: #26E63F;
            --dark-primary: #052e7a;
            --light-primary: rgba(7, 68, 182, 0.08);
            --light-bg: #ffffff;
            --card-bg: #ffffff;
            --sidebar-bg: #ffffff;
            --border-color: #e1e5eb;
            --text-muted: #64748b;
            --text-dark: #1e293b;
            --shadow-sm: 0 2px 8px rgba(7, 68, 182, 0.05);
            --shadow-md: 0 4px 12px rgba(7, 68, 182, 0.08);
            --shadow-lg: 0 8px 24px rgba(7, 68, 182, 0.12);
            --gradient-primary: linear-gradient(135deg, var(--primary) 0%, #0a5bda 100%);
            --gradient-dark: linear-gradient(135deg, var(--dark-primary) 0%, #0744b6 100%);
            --gradient-accent: linear-gradient(135deg, var(--accent) 0%, #1dc535 100%);
            --gradient-card: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', 'Segoe UI', system-ui, -apple-system, sans-serif;
        }

        body {
            background-color: #f8fafc;
            color: var(--text-dark);
            line-height: 1.6;
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* Layout Principal */
        .dashboard-container {
            display: flex;
            min-height: 100vh;
            background: #f8fafc;
        }

        /* Sidebar Mejorado */
        .sidebar {
            width: 280px;
            background: var(--sidebar-bg);
            box-shadow: var(--shadow-md);
            border-right: 1px solid var(--border-color);
            position: fixed;
            height: 100vh;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            transition: var(--transition);
        }

        .logo-section {
            padding: 28px 24px;
            background: var(--gradient-dark);
            display: flex;
            align-items: center;
            gap: 16px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .logo-circle {
            width: 60px; /* Aumentado para que se vea mejor */
            height: 60px; /* Aumentado para que se vea mejor */
            background: white;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .logo-circle img {
            width: 42px; /* Aumentado para que se vea mejor */
            height: 42px; /* Aumentado para que se vea mejor */
            object-fit: contain;
        }

        .logo-text {
            flex: 1;
        }

        .logo-text h1 {
            color: white;
            font-size: 1.4rem;
            font-weight: 700;
            letter-spacing: -0.5px;
            margin-bottom: 4px;
        }

        .logo-text span {
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.8rem;
            font-weight: 400;
        }

        .nav-menu {
            flex: 1;
            padding: 24px 0;
            overflow-y: auto;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 14px 24px;
            color: var(--text-muted);
            text-decoration: none;
            transition: var(--transition);
            margin: 4px 12px;
            border-radius: 10px;
            font-weight: 500;
        }

        .nav-item:hover {
            background: var(--light-primary);
            color: var(--primary);
            transform: translateX(4px);
        }

        .nav-item.active {
            background: var(--light-primary); /* Cambiado de azul a fondo claro */
            color: var(--primary); /* Mantiene el color primario */
            box-shadow: var(--shadow-sm);
            border-left: 3px solid var(--primary); /* Añadido borde izquierdo para indicar activo */
        }

        .nav-item.active i {
            color: var(--primary); /* Mantiene el color primario */
        }

        .nav-item i {
            width: 20px;
            text-align: center;
            font-size: 1.1rem;
            transition: var(--transition);
        }

        .nav-item span {
            font-size: 0.95rem;
        }

        .nav-divider {
            height: 1px;
            background: var(--border-color);
            margin: 20px 24px;
        }

        .user-section {
            padding: 24px;
            border-top: 1px solid var(--border-color);
            background: var(--light-bg);
        }

        .logout-btn {
            width: 100%;
            padding: 12px;
            background: white;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            color: var(--primary);
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .logout-btn:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 10px rgba(7, 68, 182, 0.15);
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 280px;
            padding: 24px;
            background: #f8fafc;
        }

        /* Header Principal */
        .main-header {
            background: var(--card-bg);
            border-radius: 16px;
            padding: 24px 28px; /* Reducido un poco */
            margin-bottom: 24px; /* Reducido un poco */
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
            animation: slideDown 0.4s ease-out;
        }

        .header-left h2 {
            font-size: 1.6rem; /* Reducido un poco */
            color: var(--text-dark);
            font-weight: 700;
            margin-bottom: 6px; /* Reducido un poco */
            letter-spacing: -0.5px;
        }

        .header-left p {
            color: var(--text-muted);
            font-size: 0.95rem;
            font-weight: 400;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .date-display {
            background: var(--light-primary);
            color: var(--primary);
            padding: 10px 18px; /* Reducido un poco */
            border-radius: 10px; /* Reducido un poco */
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9rem;
            border: 1px solid rgba(7, 68, 182, 0.1);
        }

        /* Sección de Bienvenida - Reducida y mejorada */
        .welcome-section {
            background: white; /* Cambiado a blanco */
            color: var(--text-dark);
            border-radius: 16px;
            padding: 28px 32px; /* Reducido significativamente */
            margin-bottom: 24px; /* Reducido */
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
            position: relative;
            overflow: hidden;
            animation: fadeIn 0.6s ease-out;
        }

        .welcome-section::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--gradient-primary);
        }

        .welcome-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 20px;
        }

        .welcome-header h1 {
            font-size: 1.8rem; /* Reducido significativamente */
            color: var(--text-dark);
            font-weight: 700;
            margin-bottom: 8px;
            line-height: 1.3;
        }

        .welcome-header h2 {
            font-size: 1.3rem; /* Reducido */
            color: var(--primary);
            font-weight: 600;
            margin-bottom: 16px;
        }

        .welcome-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
            margin-top: 20px;
        }

        .detail-item {
            background: var(--gradient-card);
            padding: 16px;
            border-radius: 10px;
            border: 1px solid var(--border-color);
        }

        .detail-item h3 {
            color: var(--text-muted);
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 6px;
        }

        .detail-item p {
            color: var(--text-dark);
            font-size: 1rem;
            font-weight: 600;
        }

        .coordinacion-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--light-primary);
            padding: 8px 16px;
            border-radius: 20px;
            color: var(--primary);
            font-weight: 600;
            font-size: 0.9rem;
            border: 1px solid rgba(7, 68, 182, 0.1);
        }

        /* Stats Grid Mejorado - Manteniendo colores originales */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); /* Reducido un poco */
            gap: 20px; /* Reducido */
            margin-bottom: 32px; /* Reducido */
            animation: fadeInUp 0.6s ease 0.2s both;
        }

        .stat-card {
            background: white;
            border-radius: 16px; /* Reducido */
            padding: 24px; /* Reducido */
            box-shadow: var(--shadow-md);
            transition: var(--transition);
            border: 1px solid var(--border-color);
            position: relative;
            overflow: hidden;
            cursor: pointer;
        }

        .stat-card:hover {
            transform: translateY(-5px); /* Reducido */
            box-shadow: var(--shadow-lg);
            border-color: var(--primary);
        }

        .stat-card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px; /* Reducido */
            background: var(--gradient-primary);
        }

        .stat-card:nth-child(2)::before {
            background: var(--gradient-secondary);
        }

        .stat-card:nth-child(3)::before {
            background: var(--gradient-accent);
        }

        .stat-icon {
            width: 54px; /* Reducido */
            height: 54px; /* Reducido */
            border-radius: 12px; /* Reducido */
            background: var(--light-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px; /* Reducido */
            color: var(--primary);
            font-size: 1.3rem; /* Reducido */
        }

        .stat-card:nth-child(2) .stat-icon {
            background: rgba(51, 202, 230, 0.1);
            color: var(--secondary);
        }

        .stat-card:nth-child(3) .stat-icon {
            background: rgba(38, 230, 63, 0.1);
            color: var(--accent);
        }

        .stat-content h3 {
            font-size: 0.95rem; /* Reducido */
            color: var(--text-muted);
            margin-bottom: 10px; /* Reducido */
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .stat-number {
            font-size: 2.5rem; /* Reducido */
            font-weight: 800;
            color: var(--primary);
            line-height: 1;
            margin-bottom: 6px; /* Reducido */
            letter-spacing: -1px;
        }

        .stat-card:nth-child(2) .stat-number {
            color: var(--secondary);
        }

        .stat-card:nth-child(3) .stat-number {
            color: var(--accent);
        }

        .stat-label {
            font-size: 0.9rem; /* Reducido */
            color: var(--text-muted);
            display: block;
            font-weight: 400;
        }

        .stat-trend {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 0.85rem; /* Reducido */
            margin-top: 10px; /* Reducido */
            padding: 5px 10px; /* Reducido */
            border-radius: 20px;
            background: rgba(38, 230, 63, 0.1);
            color: #1a9c2a;
            font-weight: 500;
        }

        /* Quick Actions Mejorado */
        .quick-actions {
            margin-bottom: 32px; /* Reducido */
            animation: fadeInUp 0.6s ease 0.3s both;
        }

        .section-title {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px; /* Reducido */
        }

        .section-title h2 {
            font-size: 1.6rem; /* Reducido */
            color: var(--primary);
            font-weight: 700;
            position: relative;
            padding-bottom: 10px; /* Reducido */
        }

        .section-title h2::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px; /* Reducido */
            height: 3px;
            background: var(--gradient-primary);
            border-radius: 2px;
        }

        .actions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(210px, 1fr)); /* Reducido */
            gap: 20px; /* Reducido */
        }

        .action-btn {
            background: var(--card-bg);
            border-radius: 16px; /* Reducido */
            padding: 24px 20px; /* Reducido significativamente */
            text-align: center;
            text-decoration: none;
            color: var(--primary);
            box-shadow: var(--shadow-md);
            transition: var(--transition);
            border: 1px solid var(--border-color);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .action-btn:hover {
            transform: translateY(-5px); /* Reducido */
            box-shadow: var(--shadow-lg);
            color: var(--dark-primary);
            border-color: var(--primary);
        }

        .action-btn::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px; /* Reducido */
            background: var(--gradient-primary);
        }

        .action-btn i {
            font-size: 2.2rem; /* Reducido significativamente */
            margin-bottom: 16px; /* Reducido */
            color: var(--primary);
            transition: var(--transition);
        }

        .action-btn:hover i {
            transform: scale(1.05); /* Reducido */
        }

        .action-btn span {
            font-weight: 700;
            font-size: 1rem; /* Reducido */
            margin-bottom: 6px; /* Reducido */
        }

        .action-desc {
            font-size: 0.85rem; /* Reducido */
            color: var(--text-muted);
            line-height: 1.4;
        }

        /* Maestros Section Mejorado */
        .maestros-section {
            background: var(--card-bg);
            border-radius: 16px; /* Reducido */
            padding: 28px; /* Reducido */
            margin-top: 32px; /* Reducido */
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px; /* Reducido */
            padding-bottom: 16px; /* Reducido */
            border-bottom: 2px solid var(--border-color);
        }

        .section-header h2 {
            font-size: 1.6rem; /* Reducido */
            color: var(--primary);
            font-weight: 700;
        }

        .maestros-count {
            background: var(--gradient-primary);
            color: white;
            padding: 10px 20px; /* Reducido */
            border-radius: 10px; /* Reducido */
            font-weight: 700;
            font-size: 0.95rem; /* Reducido */
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* Buscador Mejorado */
        .search-filter {
            display: flex;
            gap: 16px;
            margin-bottom: 24px; /* Reducido */
            padding: 20px; /* Reducido */
            background: var(--gradient-card);
            border-radius: 14px; /* Reducido */
            border: 1px solid var(--border-color);
        }

        .search-box {
            flex-grow: 1;
            position: relative;
            max-width: 400px;
        }

        .search-box input {
            width: 100%;
            padding: 14px 20px 14px 50px; /* Reducido */
            border: 2px solid var(--border-color);
            border-radius: 10px; /* Reducido */
            font-size: 0.95rem; /* Reducido */
            transition: var(--transition);
            background: white;
            color: var(--text-dark);
        }

        .search-box input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(7, 68, 182, 0.1);
        }

        .search-box i {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            font-size: 1rem; /* Reducido */
        }

        .filter-btn {
            background: white;
            border: 2px solid var(--border-color);
            padding: 14px 24px; /* Reducido */
            border-radius: 10px; /* Reducido */
            color: var(--text-muted);
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 600;
            text-decoration: none;
            font-size: 0.9rem; /* Reducido */
        }

        .filter-btn:hover {
            border-color: var(--primary);
            color: var(--primary);
            transform: translateY(-2px);
        }

        .primary-btn {
            background: var(--gradient-primary);
            color: white !important;
            border: none !important;
            box-shadow: var(--shadow-md) !important;
        }

        .primary-btn:hover {
            transform: translateY(-2px) !important;
            box-shadow: var(--shadow-lg) !important;
        }

        /* Tabla Mejorada */
        .maestros-table-container {
            background: white;
            border-radius: 16px; /* Reducido */
            overflow: hidden;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
        }

        .table-header {
            padding: 24px 28px; /* Reducido */
            background: var(--gradient-card);
            border-bottom: 2px solid var(--border-color);
        }

        .table-header h3 {
            color: var(--text-dark);
            font-weight: 700;
            font-size: 1.2rem; /* Reducido */
        }

        .table-responsive {
            overflow-x: auto;
        }

        .maestros-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            min-width: 1000px;
        }

        .maestros-table thead {
            background: linear-gradient(135deg, var(--light-primary) 0%, rgba(7, 68, 182, 0.05) 100%);
        }

        .maestros-table th {
            padding: 18px 16px; /* Reducido */
            text-align: left;
            font-weight: 700;
            font-size: 0.9rem; /* Reducido */
            color: var(--primary);
            border-bottom: 2px solid var(--border-color);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .maestros-table tbody tr {
            border-bottom: 1px solid var(--border-color);
            transition: var(--transition);
        }

        .maestros-table tbody tr:hover {
            background-color: rgba(7, 68, 182, 0.03);
        }

        .maestros-table td {
            padding: 18px 16px; /* Reducido */
            border-bottom: 1px solid var(--border-color);
            color: var(--text-dark);
        }

        .maestro-info {
            display: flex;
            align-items: center;
            gap: 12px; /* Reducido */
        }

        .maestro-avatar {
            width: 46px; /* Reducido */
            height: 46px; /* Reducido */
            border-radius: 10px; /* Reducido */
            background: var(--gradient-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 1.1rem; /* Reducido */
            flex-shrink: 0;
        }

        .maestro-name h4 {
            font-weight: 700;
            color: #333;
            margin-bottom: 4px;
            font-size: 1rem; /* Reducido */
        }

        .maestro-name p {
            font-size: 0.85rem; /* Reducido */
            color: var(--text-muted);
        }

        .document-progress {
            display: flex;
            align-items: center;
            gap: 12px; /* Reducido */
        }

        .progress-bar {
            width: 100px; /* Reducido */
            height: 8px; /* Reducido */
            background: #e9ecef;
            border-radius: 4px; /* Reducido */
            overflow: hidden;
            box-shadow: inset 0 1px 2px rgba(0,0,0,0.1); /* Reducido */
            flex-shrink: 0;
        }

        .progress-fill {
            height: 100%;
            background: var(--gradient-accent);
            border-radius: 4px; /* Reducido */
            position: relative;
            overflow: hidden;
        }

        .progress-fill::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(90deg, 
                transparent 0%, 
                rgba(255,255,255,0.3) 50%, 
                transparent 100%);
            animation: shimmer 2s infinite;
        }

        .progress-text {
            font-size: 0.85rem; /* Reducido */
            font-weight: 700;
            color: #333;
            min-width: 40px; /* Reducido */
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 6px 12px; /* Reducido */
            border-radius: 20px;
            font-size: 0.8rem; /* Reducido */
            font-weight: 700;
            letter-spacing: 0.3px;
            text-transform: uppercase;
        }

        .status-active {
            background: rgba(38, 230, 63, 0.15);
            color: #1a9c2a;
            border: 1px solid rgba(38, 230, 63, 0.3); /* Reducido */
        }

        .status-inactive {
            background: rgba(108, 117, 125, 0.15);
            color: var(--text-muted);
            border: 1px solid rgba(108, 117, 125, 0.3); /* Reducido */
        }

        .action-icons {
            display: flex;
            gap: 6px; /* Reducido */
        }

        .icon-btn {
            width: 36px; /* Reducido */
            height: 36px; /* Reducido */
            border-radius: 8px; /* Reducido */
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--light-bg);
            color: var(--text-muted);
            transition: var(--transition);
            cursor: pointer;
            border: 1px solid transparent; /* Reducido */
            text-decoration: none;
        }

        .icon-btn:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-2px); /* Reducido */
            box-shadow: 0 4px 8px rgba(7, 68, 182, 0.15); /* Reducido */
            border-color: var(--primary);
        }

        /* Paginación Mejorada */
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 6px; /* Reducido */
            margin-top: 32px; /* Reducido */
            padding-top: 24px; /* Reducido */
            border-top: 2px solid var(--border-color);
        }

        .page-btn {
            width: 40px; /* Reducido */
            height: 40px; /* Reducido */
            border-radius: 8px; /* Reducido */
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
            color: var(--text-muted);
            border: 1px solid var(--border-color); /* Reducido */
            cursor: pointer;
            transition: var(--transition);
            font-weight: 700;
            text-decoration: none;
        }

        .page-btn:hover, .page-btn.active {
            background: var(--gradient-primary);
            color: white;
            border-color: var(--primary);
            transform: translateY(-2px);
            box-shadow: var(--shadow-sm);
        }

        /* Footer Mejorado */
        .footer-info {
            margin-top: 48px; /* Reducido */
            padding: 24px; /* Reducido */
            background: var(--card-bg);
            border-radius: 14px; /* Reducido */
            color: var(--text-muted);
            font-size: 0.85rem; /* Reducido */
            text-align: center;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-color);
        }

        /* Animaciones */
        @keyframes fadeIn {
            from { 
                opacity: 0; 
                transform: translateY(15px); /* Reducido */
            }
            to { 
                opacity: 1; 
                transform: translateY(0); 
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(15px); /* Reducido */
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-15px); /* Reducido */
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes shimmer {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .sidebar {
                width: 80px;
            }
            
            .main-content {
                margin-left: 80px;
            }
            
            .logo-text,
            .nav-item span {
                display: none;
            }
            
            .nav-item {
                justify-content: center;
                padding: 16px;
            }
            
            .logo-circle {
                margin: 0 auto;
            }
        }

        @media (max-width: 768px) {
            .main-content {
                padding: 16px;
            }
            
            .welcome-section {
                padding: 24px;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .actions-grid {
                grid-template-columns: 1fr;
            }
            
            .search-filter {
                flex-direction: column;
            }
            
            .filter-btn {
                width: 100%;
                justify-content: center;
            }
            
            .maestros-table th, 
            .maestros-table td {
                padding: 14px 10px;
            }
        }

        /* Floating Action Button */
        .fab {
            position: fixed;
            bottom: 24px; /* Reducido */
            right: 24px; /* Reducido */
            width: 56px; /* Reducido */
            height: 56px; /* Reducido */
            border-radius: 14px; /* Reducido */
            background: var(--gradient-primary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem; /* Reducido */
            cursor: pointer;
            box-shadow: var(--shadow-lg);
            transition: var(--transition);
            z-index: 1000;
            text-decoration: none;
        }

        .fab:hover {
            transform: scale(1.08) rotate(90deg); /* Reducido */
            box-shadow: var(--shadow-lg);
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

    @php
        // OBTENER DATOS DIRECTAMENTE (IGUAL QUE EN EL DIAGNÓSTICO)
        use Illuminate\Support\Facades\Auth;
        use App\Models\Coordinacion;
        use App\Models\Maestro;
        
        $user = Auth::user();
        
        // 1. Obtener la coordinación del usuario
        $coordinacion = $user->coordinaciones_id ? Coordinacion::find($user->coordinaciones_id) : null;
        
        // 2. Si no hay coordinación del controlador, usar esta
        if (isset($coordinacionControlador) && $coordinacionControlador) {
            $coordinacion = $coordinacionControlador;
        }
        
        // 3. Verificar si hay maestros (si $maestros no viene del controlador)
        $hayMaestros = false;
        $totalMaestrosControlador = 0;
        
        if (isset($maestros) && $maestros->count() > 0) {
            $hayMaestros = true;
            $totalMaestrosControlador = $maestros->total();
        } else if ($coordinacion) {
            // Si no hay maestros del controlador, buscarlos directamente
            $maestrosDirectos = Maestro::where('coordinaciones_id', $coordinacion->id)
                ->orderBy('apellido_paterno', 'asc')
                ->orderBy('apellido_materno', 'asc')
                ->orderBy('nombres', 'asc')
                ->paginate(15);
                
            if ($maestrosDirectos->count() > 0) {
                $hayMaestros = true;
                $maestros = $maestrosDirectos;
                $totalMaestrosControlador = $maestros->total();
            }
        }
        
        // 4. Calcular estadísticas si no vienen del controlador
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
                $documentosCompletos = 0; // Aquí tu lógica real
            }
        }
        
        // 5. Debug: Mostrar información
        $debugInfo = [
            'usuario_id' => $user->id,
            'usuario_coordinaciones_id' => $user->coordinaciones_id,
            'coordinacion_encontrada' => $coordinacion ? "Sí ({$coordinacion->id}: {$coordinacion->nombre})" : "No",
            'maestros_del_controlador' => isset($maestros) ? $maestros->count() : 'No definido',
            'total_maestros' => $totalMaestros ?? 0
        ];
    @endphp

    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="logo-section">
                <div class="logo-circle">
                    <img src="{{ asset('img/logo_iufim.png') }}" alt="Logo" class="logo-img">
                </div>
                <div class="logo-text">
                    <h1>GEPROC GP</h1>
                </div>
            </div>
            
            <nav class="nav-menu">
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
            </nav>
            
            <div class="user-section">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Cerrar Sesión</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Header -->
            <div class="main-header">
                <div class="header-left">
                    <h2>Panel de Coordinación</h2>
                    <p>Gestión integral de recursos académicos</p>
                </div>
                <div class="header-right">
                    <div class="date-display">
                        <i class="fas fa-calendar-alt"></i>
                        {{ now()->format('d/m/Y') }}
                    </div>
                </div>
            </div>

            @if($coordinacion)
            <!-- Sección de Bienvenida - Reducida y mejorada -->
            <div class="welcome-section">
                <div class="welcome-header">
                    <div>
                        <h1>Bienvenido, {{ $user->name }}</h1>
                        <p>Estás gestionando la coordinación: <strong>{{ $coordinacion->nombre }}</strong></p>
                        <div class="coordinacion-badge">
                            <i class="fas fa-map-marker-alt"></i> ID: {{ $coordinacion->id }}
                        </div>
                    </div>
                </div>
                
                <div class="welcome-details">
                    <div class="detail-item">
                        <h3><i class="fas fa-users"></i> Maestros Totales</h3>
                        <p>{{ $totalMaestros ?? 0 }}</p>
                    </div>
                    <div class="detail-item">
                        <h3><i class="fas fa-user-check"></i> Maestros Activos</h3>
                        <p>{{ $maestrosActivos ?? 0 }}</p>
                    </div>
                    <div class="detail-item">
                        <h3><i class="fas fa-calendar-alt"></i> Fecha Actual</h3>
                        <p>{{ now()->format('d/m/Y') }}</p>
                    </div>
                </div>
            </div>

            <!-- Estadísticas específicas de la coordinación -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-user-check"></i>
                    </div>
                    <div class="stat-content">
                        <h3>Maestros Activos</h3>
                        <p class="stat-number">{{ $maestrosActivos ?? 0 }}</p>
                        <span class="stat-label">En tu coordinación</span>
                        <div class="stat-trend">
                            <i class="fas fa-arrow-up"></i>
                            <span>+5% este mes</span>
                        </div>
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-content">
                        <h3>Total de Maestros</h3>
                        <p class="stat-number">{{ $totalMaestros ?? 0 }}</p>
                        <span class="stat-label">Registrados</span>
                        <div class="stat-trend">
                            <i class="fas fa-chart-line"></i>
                            <span>Total registros</span>
                        </div>
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-file-contract"></i>
                    </div>
                    <div class="stat-content">
                        <h3>Documentación</h3>
                        <p class="stat-number">{{ $documentosCompletos ?? 0 }}</p>
                        <span class="stat-label">Completa</span>
                        <div class="stat-trend">
                            <i class="fas fa-arrow-up"></i>
                            <span>+12% este mes</span>
                        </div>
                    </div>
                </div>
            </div>
        @endif 
            
            

            <!-- Footer -->
            <div class="footer-info">
                <p style="margin-bottom: 10px; font-weight: 600; color: var(--text-dark);">
                    <i class="fas fa-shield-alt" style="color: var(--primary); margin-right: 8px;"></i>
                    Sistema GEPROC  | Panel de Coordinación 
                </p>
            </div>
        </main>
    </div>

    <!-- Alert Message Container -->
    <div id="alertMessage" class="alert-message" style="position: fixed; top: 20px; right: 20px; padding: 16px 20px; background: white; border-radius: 10px; box-shadow: 0 8px 24px rgba(0,0,0,0.1); border-left: 4px solid var(--accent); z-index: 10000; animation: slideInRight 0.3s ease; display: none;"></div>

    <script>
        // Función para alternar el estado de un maestro
        function toggleMaestroStatus(maestroId, currentStatus) {
            if (!confirm(`¿Estás seguro de cambiar el estado del maestro a ${currentStatus === 'Activo' ? 'Inactivo' : 'Activo'}?`)) {
                return;
            }

            const coordinacionId = {{ $coordinacion->id ?? 0 }};
            const newStatus = currentStatus === 'Activo' ? 0 : 1;
            
            fetch(`/coordinaciones/${coordinacionId}/maestros/${maestroId}/status`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    activo: newStatus
                })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error en la respuesta del servidor');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    showAlert('Estado del maestro actualizado correctamente', 'success');
                    setTimeout(() => location.reload(), 1500);
                } else {
                    showAlert('Error al actualizar el estado: ' + (data.message || 'Error desconocido'), 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert('Error de conexión. Por favor, intenta nuevamente.', 'error');
            });
        }

        // Función para mostrar alertas
        function showAlert(message, type = 'success') {
            const alertDiv = document.getElementById('alertMessage');
            alertDiv.textContent = message;
            alertDiv.style.borderLeftColor = type === 'success' ? '#26E63F' : '#ff6b6b';
            alertDiv.style.display = 'block';
            
            setTimeout(() => {
                alertDiv.style.display = 'none';
            }, 5000);
        }

        // Inicialización
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-submit del formulario de búsqueda al presionar Enter
            const searchInput = document.querySelector('.search-box input');
            if (searchInput) {
                searchInput.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        this.closest('form').submit();
                    }
                });
            }

            // Efecto de carga
            const statCards = document.querySelectorAll('.stat-card');
            statCards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.1}s`;
            });

            // Scroll suave
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
        });

        // Filtro de búsqueda en tiempo real
        function filterTable() {
            const input = document.querySelector('.search-box input');
            const filter = input.value.toUpperCase();
            const table = document.querySelector('.maestros-table');
            const tr = table.getElementsByTagName('tr');

            for (let i = 1; i < tr.length; i++) {
                let td = tr[i].getElementsByTagName('td')[0];
                if (td) {
                    let txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = '';
                    } else {
                        tr[i].style.display = 'none';
                    }
                }
            }
        }

        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
    </script>
</body>
</html>