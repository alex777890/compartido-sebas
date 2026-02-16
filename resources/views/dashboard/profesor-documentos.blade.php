<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documentos - Sistema GEPROC</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
            --purple-color: #8b5cf6;
            --purple-light: #ede9fe;
            --cyan-color: #06b6d4;
            --cyan-light: #cffafe;
            --border-radius: 12px;
            --sidebar-width: 280px;
            --header-height: 80px;
            --gradient-primary: linear-gradient(135deg, #0744b6ff 0%, #3a6bd3 100%);
            --gradient-success: linear-gradient(135deg, #10b981 0%, #34d399 100%);
            --gradient-warning: linear-gradient(135deg, #f59e0b 0%, #fbbf24 100%);
            --gradient-danger: linear-gradient(135deg, #ef4444 0%, #f87171 100%);
            --gradient-info: linear-gradient(135deg, #3b82f6 0%, #60a5fa 100%);
            --gradient-purple: linear-gradient(135deg, #8b5cf6 0%, #a78bfa 100%);
            --gradient-cyan: linear-gradient(135deg, #06b6d4 0%, #22d3ee 100%);
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

        /* ===== MENÚ DE LA PRIMERA VISTA ===== */
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
            position: relative;
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

        .welcome-message {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 18px;
            background: white;
            border: 1.5px solid var(--success-color);
            border-radius: 40px;
            color: var(--success-color);
            font-weight: 600;
            font-size: 15px;
            box-shadow: 0 3px 10px rgba(16, 185, 129, 0.1);
            transition: var(--transition);
            letter-spacing: 0.3px;
        }

        .welcome-message:hover {
            background: white;
            border-color: var(--success-color);
            color: var(--success-color);
            transform: translateY(-1px);
            box-shadow: 0 5px 12px rgba(16, 185, 129, 0.15);
        }

        .welcome-message i {
            font-size: 18px;
            color: var(--success-color);
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 18px;
            padding: 12px 22px;
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
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 20px;
        }

        .user-info {
            display: flex;
            flex-direction: column;
        }

        .user-info h4 {
            font-size: 18px;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 4px;
            white-space: nowrap;
        }

        .user-info p {
            font-size: 14px;
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

        .content-wrapper {
            padding: 30px 35px;
            max-width: 100%;
        }

        /* ===== ESTILOS DEL DASHBOARD ===== */
        
        /* ALERTAS DEL SISTEMA */
        .system-alert {
            padding: 15px 20px;
            border-radius: 12px;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 15px;
            background-color: #f8f9fa;
            border-left: 6px solid var(--primary);
            animation: slideIn 0.3s ease;
            box-shadow: var(--card-shadow);
        }

        .system-alert i {
            font-size: 22px;
            color: var(--primary);
        }

        .system-alert-content h4 {
            margin: 0 0 4px 0;
            font-size: 16px;
            font-weight: 700;
            color: var(--primary);
        }

        .system-alert-content p {
            margin: 0;
            font-size: 15px;
            color: var(--text-muted);
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* PERIODO ALERT */
        .periodo-alert {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 22px;
            border-radius: 12px;
            margin-bottom: 25px;
            box-shadow: var(--card-shadow);
            background-color: white;
            border: 2px solid var(--border-color);
            transition: var(--transition);
        }

        .periodo-alert:hover {
            transform: translateY(-3px);
            box-shadow: var(--card-shadow-hover);
        }

        .periodo-content {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .periodo-icon {
            font-size: 28px;
            flex-shrink: 0;
        }

        .periodo-content h3 {
            margin: 0 0 5px 0;
            font-size: 18px;
            font-weight: 700;
            color: #1e293b;
        }

        .periodo-content p {
            margin: 0;
            font-size: 15px;
            color: var(--text-muted);
        }

        .periodo-status {
            padding: 8px 16px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 14px;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
            gap: 8px;
            flex-shrink: 0;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .status-active {
            background: var(--gradient-success);
            color: white;
        }

        .status-inactive {
            background: var(--gradient-danger);
            color: white;
        }

        /* CARD GRID */
        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
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
            background: var(--gradient-primary);
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

        .card-icon.req {
            background: var(--gradient-primary);
        }

        .card-icon.sub {
            background: var(--gradient-success);
        }

        .card-icon.fal {
            background: var(--gradient-warning);
        }

        .card-icon.pro {
            background: var(--gradient-info);
        }

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

        /* SECTION STYLES */
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

        /* ===== PANEL DE CONTROL MODIFICADO ===== */
        /* TÍTULO EN CUADRO BLANCO - MÁS PEQUEÑO */
        .control-panel {
            background: white;
            border-radius: 16px;
            padding: 20px 30px;
            margin-bottom: 35px;
            box-shadow: var(--card-shadow);
            border: 2px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 25px;
            transition: var(--transition);
        }

        .control-panel:hover {
            box-shadow: var(--card-shadow-hover);
        }

        .panel-title-section {
            flex: 1;
            min-width: 300px;
        }

        /* TÍTULO MÁS PEQUEÑO (24px) */
        .panel-title-section .subtitle {
            font-size: 24px;
            font-weight: 700;
            color: var(--primary);
            margin: 0;
            line-height: 1.3;
            letter-spacing: -0.3px;
            position: relative;
            display: inline-block;
            text-transform: none;
        }

        .panel-title-section .subtitle::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 60px;
            height: 3px;
            background: var(--gradient-primary);
            border-radius: 2px;
        }

        .action-buttons {
            display: flex;
            gap: 18px;
            align-items: center;
        }

        /* BOTÓN VOLVER */
        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background: white;
            color: var(--primary);
            border: 2px solid var(--primary);
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
        }

        .btn-back:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(7, 68, 182, 0.15);
        }

        /* ALERTAS */
        .alert {
            padding: 18px 24px;
            border-radius: 12px;
            margin-bottom: 30px;
            display: flex;
            align-items: flex-start;
            gap: 18px;
            border-left: 6px solid transparent;
            animation: slideIn 0.3s ease;
            box-shadow: var(--card-shadow);
            font-size: 15px;
        }

        .alert-success {
            background-color: var(--success-light);
            border-color: var(--success-color);
            color: #065f46;
        }

        .alert-warning {
            background-color: var(--warning-light);
            border-color: var(--warning-color);
            color: #92400e;
        }

        .alert-danger {
            background-color: var(--danger-light);
            border-color: var(--danger-color);
            color: #991b1b;
        }

        .alert-info {
            background-color: var(--info-light);
            border-color: var(--info-color);
            color: #1e40af;
        }

        .alert i {
            font-size: 22px;
            margin-top: 2px;
        }

        .alert ul {
            margin-top: 10px;
            margin-left: 18px;
            font-size: 14px;
        }

        .alert ul li {
            margin-bottom: 4px;
        }

        /* PANEL DE PERIODO */
        .periodo-panel {
            background: white;
            border-radius: 16px;
            padding: 25px 30px;
            margin-bottom: 30px;
            box-shadow: var(--card-shadow);
            border: 2px solid var(--border-color);
            position: relative;
            overflow: hidden;
            transition: var(--transition);
        }

        .periodo-panel:hover {
            box-shadow: var(--card-shadow-hover);
        }

        .periodo-panel::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--gradient-primary);
        }

        .periodo-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .periodo-title {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .periodo-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            color: white;
            background: var(--gradient-primary);
            box-shadow: 0 4px 10px rgba(7, 68, 182, 0.2);
        }

        .periodo-text h3 {
            font-size: 18px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 6px;
        }

        .periodo-text p {
            color: var(--text-muted);
            font-size: 14px;
            margin: 0;
        }

        .periodo-badge {
            padding: 8px 18px;
            border-radius: 30px;
            font-weight: 600;
            font-size: 13px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .badge-active {
            background: var(--gradient-success);
            color: white;
        }

        .badge-inactive {
            background: var(--gradient-danger);
            color: white;
        }

        .badge-pendiente {
            background: var(--gradient-warning);
            color: white;
        }

        /* BARRA DE PROGRESO GENERAL */
        .progress-overview {
            background: var(--light-bg);
            border-radius: 10px;
            padding: 20px 25px;
            border: 1px solid var(--border-color);
        }

        .progress-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .progress-title {
            font-size: 16px;
            font-weight: 700;
            color: #1e293b;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .progress-title i {
            color: var(--primary);
            font-size: 16px;
        }

        .progress-percentage {
            font-size: 24px;
            font-weight: 800;
            color: var(--primary);
        }

        .progress-bar-container {
            height: 10px;
            background: #e2e8f0;
            border-radius: 5px;
            overflow: hidden;
            margin-bottom: 10px;
        }

        .progress-bar {
            height: 100%;
            background: var(--gradient-primary);
            border-radius: 5px;
            transition: width 1s ease-in-out;
            position: relative;
            overflow: hidden;
        }

        .progress-bar::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            background-image: linear-gradient(
                45deg,
                rgba(255, 255, 255, 0.15) 25%,
                transparent 25%,
                transparent 50%,
                rgba(255, 255, 255, 0.15) 50%,
                rgba(255, 255, 255, 0.15) 75%,
                transparent 75%,
                transparent
            );
            background-size: 1rem 1rem;
            animation: progress-stripes 1s linear infinite;
        }

        @keyframes progress-stripes {
            from {
                background-position: 1rem 0;
            }
            to {
                background-position: 0 0;
            }
        }

        .progress-stats {
            display: flex;
            justify-content: space-between;
            font-size: 13px;
            color: var(--text-muted);
            font-weight: 500;
        }

        .progress-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 15px;
            margin-top: 20px;
        }

        .detail-item {
            background: white;
            padding: 12px 16px;
            border-radius: 10px;
            border: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            gap: 12px;
            transition: var(--transition);
        }

        .detail-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.06);
        }

        .detail-icon {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            color: white;
            flex-shrink: 0;
        }

        .detail-icon.fecha {
            background: var(--gradient-purple);
        }

        .detail-icon.requeridos {
            background: var(--gradient-info);
        }

        .detail-icon.completados {
            background: var(--gradient-success);
        }

        .detail-icon.progreso {
            background: var(--gradient-primary);
        }

        .detail-content h4 {
            font-size: 12px;
            color: var(--text-muted);
            margin-bottom: 4px;
            font-weight: 500;
        }

        .detail-content p {
            font-size: 15px;
            font-weight: 700;
            color: #1e293b;
            margin: 0;
        }

        /* ===== BOTÓN DE ENVÍO MODIFICADO ===== */
        /* BOTÓN DE ENVÍO A LA DERECHA (NO CENTRADO) */
        .submit-section-wrapper {
            display: flex;
            justify-content: flex-end;
            margin-top: 25px;
            margin-bottom: 15px;
            padding: 0 5px;
        }

        .submit-button {
            padding: 12px 35px;
            background: var(--gradient-primary);
            color: white;
            border: none;
            border-radius: 50px;
            font-weight: 600;
            font-size: 16px;
            cursor: pointer;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 12px;
            box-shadow: 0 8px 20px rgba(7, 68, 182, 0.3);
            letter-spacing: 0.5px;
            border: 1px solid rgba(255,255,255,0.2);
        }

        .submit-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 28px rgba(7, 68, 182, 0.4);
            background: linear-gradient(135deg, #1d4ed8 0%, #0744b6ff 100%);
        }

        .submit-button i {
            font-size: 16px;
        }

        .submit-button:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            transform: none;
        }

        /* TABLA DE DOCUMENTOS */
        .documents-table-container {
            background: white;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: var(--card-shadow);
            border: 2px solid var(--border-color);
            margin-bottom: 10px;
            max-width: 100%;
            overflow-x: auto;
            transition: var(--transition);
        }

        .documents-table-container:hover {
            box-shadow: var(--card-shadow-hover);
        }

        .documents-table-container::-webkit-scrollbar {
            height: 6px;
            width: 6px;
        }

        .documents-table-container::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 3px;
        }

        .documents-table-container::-webkit-scrollbar-thumb {
            background: #d1d5db;
            border-radius: 3px;
        }

        .table-header {
            padding: 22px 30px;
            background: #f8fafc;
            border-bottom: 2px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .table-title {
            font-size: 22px;
            font-weight: 700;
            color: #1e293b;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .table-title i {
            color: var(--primary);
        }

        .table-info {
            font-size: 16px;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: 15px;
        }

        /* TABLA PRINCIPAL */
        .documents-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 15px;
            min-width: 1100px;
        }

        .documents-table thead {
            background: #f8fafc;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .documents-table th {
            padding: 18px 22px;
            text-align: left;
            font-weight: 700;
            color: #475569;
            border-bottom: 2px solid var(--border-color);
            font-size: 15px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            background: #f8fafc;
            white-space: nowrap;
        }

        .documents-table th i {
            margin-right: 10px;
            color: var(--primary);
            font-size: 15px;
        }

        .documents-table tbody tr {
            border-bottom: 1px solid var(--border-color);
            transition: var(--transition);
        }

        .documents-table tbody tr:hover {
            background: #f8fafc;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }

        .documents-table tbody tr.pendiente {
            background: #fefce8;
        }

        .documents-table tbody tr.pendiente:hover {
            background: #fef3c7;
        }

        .documents-table tbody tr.pendiente .document-icon {
            background: var(--gradient-warning);
        }

        .documents-table td {
            padding: 20px 22px;
            vertical-align: middle;
            color: #475569;
            font-size: 15px;
        }

        /* COLUMNAS ESPECÍFICAS */
        .document-name-cell {
            min-width: 280px;
            position: sticky;
            left: 0;
            background: inherit;
            z-index: 5;
            box-shadow: 3px 0 8px rgba(0,0,0,0.05);
        }

        .documents-table tbody tr:hover .document-name-cell {
            background: #f8fafc;
        }

        .documents-table tbody tr.pendiente .document-name-cell {
            background: #fefce8;
        }

        .documents-table tbody tr.pendiente:hover .document-name-cell {
            background: #fef3c7;
        }

        .document-name {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .document-icon {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 17px;
            color: white;
            flex-shrink: 0;
        }

        .icon-aprobado { background: var(--gradient-success); }
        .icon-rechazado { background: var(--gradient-danger); }
        .icon-pendiente { background: var(--gradient-warning); }
        .icon-faltante { background: var(--gradient-primary); }

        .document-name-text {
            flex: 1;
            min-width: 0;
        }

        .document-title {
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 6px;
            font-size: 16px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            line-height: 1.4;
            max-height: 2.8em;
        }

        .document-desc {
            color: var(--text-muted);
            font-size: 13px;
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            line-height: 1.4;
            max-height: 1.4em;
        }

        /* ESTADO DEL DOCUMENTO */
        .status-cell {
            min-width: 140px;
            width: 140px;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 7px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            min-width: 115px;
            justify-content: center;
        }

        .status-aprobado {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        .status-rechazado {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        .status-pendiente {
            background: #fef3c7;
            color: #92400e;
            border: 1px solid #fde68a;
        }

        .status-revision {
            background: #fef3c7;
            color: #92400e;
            border: 1px solid #fde68a;
        }

        .status-faltante {
            background: #e0e7ff;
            color: #3730a3;
            border: 1px solid #c7d2fe;
        }

        .status-indicator {
            width: 8px;
            height: 8px;
            border-radius: 50%;
        }

        .indicator-aprobado { background: #10b981; }
        .indicator-rechazado { background: #ef4444; }
        .indicator-pendiente { background: #f59e0b; }
        .indicator-revision { background: #f59e0b; }
        .indicator-faltante { background: #8b5cf6; }

        /* INFORMACIÓN DEL DOCUMENTO */
        .info-cell {
            min-width: 200px;
            width: 200px;
        }

        .document-info {
            display: flex;
            flex-direction: column;
            gap: 5px;
            max-height: 100px;
            overflow-y: auto;
            padding-right: 5px;
        }

        .document-info::-webkit-scrollbar {
            width: 4px;
        }

        .document-info::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 2px;
        }

        .document-info::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 2px;
        }

        .info-item {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13px;
            min-height: 24px;
        }

        .info-item i {
            color: var(--primary);
            font-size: 12px;
            width: 16px;
            text-align: center;
        }

        .info-label {
            color: var(--text-muted);
            min-width: 70px;
            font-size: 12px;
        }

        .info-value {
            color: #334155;
            font-weight: 500;
            flex: 1;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            font-size: 13px;
        }

        /* ACCIONES - OCULTAR BOTONES SEGÚN ESTADO */
        .actions-cell {
            min-width: 180px;
            width: 180px;
        }

        .document-actions {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .action-btn {
            padding: 7px 12px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 500;
            border: none;
            cursor: pointer;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 5px;
            white-space: nowrap;
            min-width: 80px;
            justify-content: center;
        }

        .btn-view {
            background: #f8fafc;
            color: #475569;
            border: 1px solid var(--border-color);
        }

        .btn-view:hover {
            background: #e2e8f0;
            color: #334155;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .btn-download {
            background: var(--primary);
            color: white;
            border: 1px solid var(--primary);
        }

        .btn-download:hover {
            background: var(--primary-light);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(7, 68, 182, 0.2);
        }

        .btn-update {
            background: #10b981;
            color: white;
            border: 1px solid #10b981;
        }

        .btn-update:hover {
            background: #0da271;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(16, 185, 129, 0.2);
        }

        /* OCULTAR BOTÓN UPLOAD COMPLETAMENTE - SOLO USAREMOS SELECT */
        .btn-upload {
            display: none !important;
        }

        /* CLASES PARA DOCUMENTOS */
        .has-document .btn-upload,
        .no-document .btn-view,
        .no-document .btn-download,
        .no-document .btn-update {
            display: none;
        }

        /* ===== ÁREA DE SUBIDA MODIFICADA ===== */
        /* SOLO UN BOTÓN DE SELECCIONAR POR FILA - SIN BOTÓN SUBIR */
        .upload-cell {
            min-width: 280px;
            width: 280px;
        }

        .upload-container {
            position: relative;
            width: 100%;
        }

        /* CONTENEDOR PRINCIPAL DE SUBIDA - UN SOLO BOTÓN */
        .upload-main-wrapper {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        /* BOTÓN ÚNICO DE SELECCIONAR */
        .file-select-btn {
            padding: 10px 18px;
            background: white;
            color: var(--primary);
            border: 2px solid var(--primary);
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 10px;
            width: fit-content;
            box-shadow: 0 2px 5px rgba(7, 68, 182, 0.1);
        }

        .file-select-btn:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(7, 68, 182, 0.3);
        }

        .file-select-btn i {
            font-size: 14px;
        }

        /* INDICADOR DE ARCHIVO SELECCIONADO */
        .file-selected-indicator {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            padding: 10px 15px;
            background: linear-gradient(135deg, #f0f9ff 0%, #e6f2ff 100%);
            border: 1px solid #b8d6ff;
            border-radius: 8px;
            margin-top: 5px;
            animation: fadeIn 0.3s ease;
            width: 100%;
            box-shadow: 0 2px 8px rgba(7, 68, 182, 0.1);
        }

        .file-info {
            display: flex;
            align-items: center;
            gap: 10px;
            flex: 1;
            min-width: 0;
        }

        .file-info i {
            color: var(--primary);
            font-size: 16px;
        }

        .file-name-display {
            font-size: 13px;
            color: var(--primary);
            font-weight: 600;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            max-width: 160px;
        }

        .file-remove-btn {
            background: rgba(239, 68, 68, 0.1);
            border: none;
            color: var(--danger-color);
            cursor: pointer;
            padding: 5px 8px;
            font-size: 12px;
            transition: var(--transition);
            border-radius: 6px;
            display: flex;
            align-items: center;
            gap: 4px;
            font-weight: 500;
        }

        .file-remove-btn:hover {
            background: var(--danger-color);
            color: white;
            transform: scale(1.05);
        }

        input[type="file"] {
            display: none;
        }

        /* INFORMACIÓN DE ARCHIVO ACTUAL - SIN BOTONES */
        .file-current-info {
            font-size: 13px;
            color: var(--text-muted);
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            max-width: 100%;
            padding: 8px 12px;
            background: #f8fafc;
            border-radius: 8px;
            border: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .file-current-info i {
            color: var(--success-color);
            font-size: 14px;
        }

        .file-current-info span {
            font-weight: 500;
            color: #1e293b;
        }

        /* ESTADO CUANDO YA TIENE DOCUMENTO SUBIDO - SIN BOTONES */
        tr.has-document .upload-main-wrapper .file-select-btn,
        tr.has-document .upload-main-wrapper .file-selected-indicator {
            display: none;
        }

        tr.has-document .upload-main-wrapper .file-current-info {
            background: #f0fdf4;
            border-color: #86efac;
        }

        tr.has-document .upload-main-wrapper .file-current-info i {
            color: #10b981;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-5px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* MODAL PROFESIONAL PARA CONFIRMACIÓN */
        .custom-modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(5px);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10000;
            animation: fadeIn 0.2s ease;
        }

        .custom-modal {
            background: white;
            border-radius: 20px;
            width: 90%;
            max-width: 500px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            overflow: hidden;
            animation: slideUp 0.3s ease;
        }

        .modal-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            color: white;
            padding: 20px 25px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .modal-header i {
            font-size: 28px;
        }

        .modal-header h3 {
            font-size: 20px;
            font-weight: 600;
            margin: 0;
        }

        .modal-body {
            padding: 25px;
            max-height: 400px;
            overflow-y: auto;
        }

        .file-list {
            list-style: none;
            padding: 0;
            margin: 0 0 20px 0;
        }

        .file-list-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 15px;
            background: #f8fafc;
            border-radius: 10px;
            margin-bottom: 8px;
            border-left: 4px solid var(--primary);
        }

        .file-list-item i {
            color: var(--primary);
            font-size: 18px;
        }

        .file-details {
            flex: 1;
        }

        .file-name-modal {
            font-weight: 600;
            color: #1e293b;
            font-size: 14px;
            margin-bottom: 4px;
        }

        .file-size-modal {
            font-size: 12px;
            color: var(--text-muted);
        }

        .modal-footer {
            padding: 20px 25px;
            background: #f8fafc;
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            border-top: 1px solid var(--border-color);
        }

        .modal-btn {
            padding: 10px 25px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: var(--transition);
            border: none;
        }

        .modal-btn-cancel {
            background: white;
            color: #64748b;
            border: 1px solid var(--border-color);
        }

        .modal-btn-cancel:hover {
            background: #f1f5f9;
            transform: translateY(-2px);
        }

        .modal-btn-confirm {
            background: var(--gradient-primary);
            color: white;
            box-shadow: 0 4px 12px rgba(7, 68, 182, 0.2);
        }

        .modal-btn-confirm:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(7, 68, 182, 0.3);
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* OBSERVACIONES */
        .observations {
            background: #fffbeb;
            border: 1px solid #fde68a;
            border-radius: 6px;
            padding: 10px 12px;
            font-size: 13px;
            color: #92400e;
            line-height: 1.4;
            max-height: 80px;
            overflow-y: auto;
            margin-top: 8px;
        }

        .observations-title {
            font-weight: 600;
            margin-bottom: 4px;
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
        }

        /* PANEL SIN PERIODO */
        .no-period-panel {
            background: #fef2f2;
            border-radius: 14px;
            padding: 45px;
            text-align: center;
            margin-bottom: 35px;
            border: 2px solid #fecaca;
        }

        .no-period-icon {
            font-size: 45px;
            color: #ef4444;
            margin-bottom: 25px;
        }

        .no-period-title {
            font-size: 24px;
            color: #dc2626;
            margin-bottom: 18px;
            font-weight: 700;
        }

        .no-period-text {
            color: #9ca3af;
            font-size: 17px;
            max-width: 650px;
            margin: 0 auto 30px;
            line-height: 1.6;
        }

        /* PANEL SIN DOCUMENTOS */
        .no-documents-panel {
            background: #f0f9ff;
            border-radius: 14px;
            padding: 45px;
            text-align: center;
            margin-bottom: 35px;
            border: 2px solid #7dd3fc;
        }

        .no-documents-icon {
            font-size: 45px;
            color: #0ea5e9;
            margin-bottom: 25px;
        }

        .no-documents-title {
            font-size: 24px;
            color: #0ea5e9;
            margin-bottom: 18px;
            font-weight: 700;
        }

        .no-documents-text {
            color: var(--text-muted);
            font-size: 17px;
            max-width: 650px;
            margin: 0 auto 30px;
            line-height: 1.6;
        }

        /* PROGRESS BAR INDIVIDUAL */
        .document-progress {
            margin-top: 10px;
        }

        .progress-indicator {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 5px;
        }

        .progress-text {
            font-size: 12px;
            color: var(--text-muted);
            white-space: nowrap;
        }

        .progress-bar-small {
            flex: 1;
            height: 8px;
            background: #e2e8f0;
            border-radius: 4px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            border-radius: 4px;
            transition: width 0.5s ease;
        }

        .progress-fill.completed {
            background: var(--gradient-success);
        }

        .progress-fill.pending {
            background: var(--gradient-warning);
        }

        .progress-fill.rejected {
            background: var(--gradient-danger);
        }

        .progress-fill.not-started {
            background: var(--gradient-primary);
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
            
            .welcome-message {
                display: none;
            }
            
            .documents-table {
                min-width: 1000px;
            }
        }

        @media (max-width: 992px) {
            .cards-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .panel-title-section .subtitle {
                font-size: 22px;
            }
            
            .control-panel {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
            
            .periodo-alert {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
            
            .periodo-status {
                align-self: stretch;
                justify-content: center;
            }
            
            .periodo-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
            
            .table-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
            
            .document-actions {
                flex-direction: column;
            }
            
            .progress-details {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .cards-grid {
                grid-template-columns: 1fr;
            }
            
            .header-left {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
            
            .user-info h4 {
                font-size: 16px;
            }
            
            .user-info p {
                font-size: 13px;
            }
            
            .section {
                padding: 18px;
            }
            
            .periodo-content {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
            }
            
            .header-right {
                flex-wrap: wrap;
                justify-content: flex-end;
            }
            
            .documents-table-container {
                border-radius: 12px;
                overflow: hidden;
            }
            
            .documents-table {
                display: block;
                min-width: 100%;
            }
            
            .documents-table thead {
                display: none;
            }
            
            .documents-table tbody,
            .documents-table tr,
            .documents-table td {
                display: block;
                width: 100%;
            }
            
            .documents-table tr {
                border-bottom: 2px solid var(--border-color);
                padding: 25px;
                position: relative;
            }
            
            .documents-table td {
                border: none;
                padding: 18px 0;
                position: static;
                box-shadow: none;
                min-width: 100% !important;
                width: 100% !important;
            }
            
            .documents-table td:before {
                content: attr(data-label);
                font-weight: 600;
                color: var(--primary);
                display: block;
                margin-bottom: 12px;
                font-size: 14px;
                background: #f8fafc;
                padding: 8px 14px;
                border-radius: 8px;
                margin-top: 25px;
            }
            
            .documents-table td:first-child:before {
                margin-top: 0;
            }
            
            .document-actions {
                flex-direction: row;
                flex-wrap: wrap;
                justify-content: center;
            }
            
            .action-btn {
                flex: 1;
                min-width: 160px;
                justify-content: center;
                padding: 10px 15px;
                font-size: 14px;
            }
            
            .upload-main-wrapper {
                align-items: flex-start;
            }
            
            .file-select-btn {
                width: 100%;
                justify-content: center;
            }
            
            .periodo-panel {
                padding: 20px;
            }
            
            .logout-button {
                padding: 10px 20px;
                font-size: 14px;
            }
            
            .submit-section-wrapper {
                justify-content: flex-end;
            }
            
            .submit-button {
                width: 100%;
                justify-content: center;
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
            
            .panel-title-section .subtitle {
                font-size: 20px;
            }
            
            .logout-button {
                padding: 10px 20px;
                font-size: 14px;
            }
            
            .documents-table th, 
            .documents-table td {
                padding: 18px 20px;
            }
            
            .document-name {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }
            
            .document-actions {
                flex-direction: row;
                flex-wrap: wrap;
            }
            
            .action-btn {
                padding: 10px 12px;
                font-size: 13px;
                min-width: 140px;
            }
            
            .periodo-panel {
                padding: 20px;
            }
            
            .header-logo {
                gap: 12px;
            }
            
            .logo-img-header {
                height: 50px;
            }
            
            .file-selected-indicator {
                flex-wrap: wrap;
            }
        }

        @media (min-width: 769px) and (max-width: 1200px) {
            .documents-table {
                min-width: 1000px;
            }
            
            .document-name-cell {
                min-width: 250px;
            }
            
            .info-cell {
                min-width: 180px;
            }
            
            .upload-cell {
                min-width: 260px;
            }
        }
    </style>
</head>
<body>
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <!-- HEADER SUPERIOR -->
        <div class="header">
            <div class="header-left">
                <div class="header-logo">
                    <img src="{{ asset('img/logo_iufim.png') }}" alt="Logo IUFIM" class="logo-img-header">
                </div>
                <div class="header-nav">
                    <a href="{{ route('profesor.dashboard') }}" class="nav-link">
                        <i class="fas fa-home"></i> Inicio
                    </a>
                    <a href="{{ route('profesor.documentos') }}" class="nav-link active">
                        <i class="fas fa-folder"></i> Documentos
                    </a>
                    <a href="{{ route('maestros.grados.create') }}" class="nav-link">
                        <i class="fas fa-graduation-cap"></i> Grados
                    </a>
                    <a href="{{ route('editar-mi-perfil') }}" class="nav-link">
                        <i class="fas fa-user"></i> Perfil
                    </a>
                </div>
            </div>
            
            <div class="header-right">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="logout-button">
                        <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                    </button>
                </form>
            </div>
        </div>

        <!-- CONTENT WRAPPER -->
        <div class="content-wrapper">
            <!-- MENSAJES -->
            @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                <div>{{ session('success') }}</div>
            </div>
            @endif

            @if(session('warning'))
            <div class="alert alert-warning">
                <i class="fas fa-exclamation-triangle"></i>
                <div>{{ session('warning') }}</div>
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-triangle"></i>
                <div>{{ session('error') }}</div>
            </div>
            @endif

            @if($errors->any())
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-triangle"></i>
                <div>
                    <strong>Errores encontrados:</strong>
                    <ul style="margin: 10px 0 0 20px; font-size: 14px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif

            @php
                // Variables seguras con datos del controller
                $periodoHabilitado = $periodoHabilitado ?? null;
                $hayPeriodoHabilitado = $hayPeriodoHabilitado ?? false;
                
                if (!$hayPeriodoHabilitado) {
                    $totalRequeridos = 0;
                    $totalSubidos = 0;
                    $aprobados = 0;
                    $rechazados = 0;
                    $pendientes = 0;
                    $porcentaje = 0;
                    $faltantes = 0;
                } else {
                    $totalRequeridos = $estadisticas['total_requeridos'] ?? 0;
                    $totalSubidos = $estadisticas['total_subidos'] ?? 0;
                    $aprobados = $estadisticas['aprobados'] ?? 0;
                    $rechazados = $estadisticas['rechazados'] ?? 0;
                    $pendientes = $estadisticas['pendientes'] ?? 0;
                    $porcentaje = $estadisticas['porcentaje'] ?? 0;
                    $faltantes = $estadisticas['faltantes'] ?? 0;
                }
                
                $maestroData = $maestroData ?? $maestro ?? null;
                $documentosParaVista = $documentosParaVista ?? [];
                $tiposDocumentos = $tiposDocumentos ?? [];
            @endphp

            <!-- PANEL DE CONTROL - TÍTULO MÁS PEQUEÑO -->
            <div class="control-panel">
                <div class="panel-title-section">
                    <p class="subtitle">Carga de documentos</p>
                </div>
                <div class="action-buttons">
                    <a href="{{ route('profesor.dashboard') }}" class="btn-back">
                        <i class="fas fa-arrow-left"></i>
                        Volver
                    </a>
                </div>
            </div>

            <!-- PANEL DE PERÍODO -->
            <div class="periodo-panel">
                <div class="periodo-header">
                    <div class="periodo-title">
                        <div class="periodo-icon">
                            @if($hayPeriodoHabilitado)
                            <i class="fas fa-calendar-check"></i>
                            @else
                            <i class="fas fa-calendar-times"></i>
                            @endif
                        </div>
                        <div class="periodo-text">
                            <h3>
                                @if($hayPeriodoHabilitado)
                                Período Académico: {{ $periodoHabilitado->nombre }}
                                @else
                                Sin período activo
                                @endif
                            </h3>
                            <p>
                                @if($hayPeriodoHabilitado)
                                Sistema de carga de documentos habilitado
                                @else
                                El sistema se activará automáticamente cuando se habilite un nuevo período para que puedas subir tus documentos.
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="periodo-badge {{ $hayPeriodoHabilitado ? 'badge-active' : 'badge-inactive' }}">
                        @if($hayPeriodoHabilitado)
                        <i class="fas fa-check-circle"></i> ACTIVO
                        @else
                        <i class="fas fa-times-circle"></i> INACTIVO
                        @endif
                    </div>
                </div>
                
                <!-- BARRA DE PROGRESO GENERAL -->
                @if($hayPeriodoHabilitado)
                <div class="progress-overview">
                    <div class="progress-header">
                        <div class="progress-title">
                            <i class="fas fa-chart-line"></i>
                            Progreso General
                        </div>
                        <div class="progress-percentage">{{ $porcentaje }}%</div>
                    </div>
                    
                    <div class="progress-bar-container">
                        <div class="progress-bar" style="width: {{ $porcentaje }}%;"></div>
                    </div>
                    
                    <div class="progress-stats">
                        <span>{{ $totalSubidos }} de {{ $totalRequeridos }} docs</span>
                        <span>{{ $faltantes }} pendientes</span>
                    </div>
                    
                    <div class="progress-details">
                        @if($periodoHabilitado->fecha_limite)
                        <div class="detail-item">
                            <div class="detail-icon fecha">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="detail-content">
                                <h4>Fecha Límite</h4>
                                <p>{{ \Carbon\Carbon::parse($periodoHabilitado->fecha_limite)->format('d/m/Y') }}</p>
                            </div>
                        </div>
                        @endif
                        <div class="detail-item">
                            <div class="detail-icon requeridos">
                                <i class="fas fa-file-alt"></i>
                            </div>
                            <div class="detail-content">
                                <h4>Requeridos</h4>
                                <p>{{ $totalRequeridos }}</p>
                            </div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-icon completados">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="detail-content">
                                <h4>Completados</h4>
                                <p>{{ $totalSubidos }}/{{ $totalRequeridos }}</p>
                            </div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-icon progreso">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <div class="detail-content">
                                <h4>Progreso</h4>
                                <p>{{ $porcentaje }}%</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            @if(!$maestroData)
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-triangle"></i>
                <div>
                    <strong>Información de usuario no disponible</strong>
                    <p>Contacta al administrador del sistema para verificar tu perfil.</p>
                </div>
            </div>
            @else
                @if(count($documentosParaVista) > 0)
                <!-- FORMULARIO DE SUBIDA - SOLO BOTÓN SELECCIONAR -->
                <form action="{{ route('profesor.subir-documentos') }}" method="POST" enctype="multipart/form-data" id="uploadForm">
                    @csrf
                    <input type="hidden" name="periodo_id" value="{{ $periodoHabilitado->id ?? '' }}">
                    
                    <!-- TABLA DE DOCUMENTOS -->
                    <div class="documents-table-container">
                        <div class="table-header">
                            <h2 class="table-title">
                                <i class="fas fa-file-alt"></i>
                                Documentos Requeridos
                            </h2>
                            <div class="table-info">
                                <span>{{ count($documentosParaVista) }} documentos listados</span>
                            </div>
                        </div>
                        
                        <table class="documents-table">
                            <thead>
                                <tr>
                                    <th><i class="fas fa-file-signature"></i> Documento</th>
                                    <th><i class="fas fa-clipboard-check"></i> Estado</th>
                                    <th><i class="fas fa-info-circle"></i> Información</th>
                                    <th><i class="fas fa-tools"></i> Acciones</th>
                                    <th><i class="fas fa-upload"></i> Subir Archivo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($documentosParaVista as $documento)
                                @php
                                    $tieneDocumento = $documento['tiene_documento'] ?? false;
                                    $estado = $documento['estado'] ?? 'faltante';
                                    $claseDocumento = $tieneDocumento ? 'has-document' : 'no-document';
                                    $claseFila = $estado == 'pendiente' ? 'pendiente' : '';
                                    $tipoDocumento = $documento['tipo'];
                                @endphp
                                <tr data-documento-id="{{ $documento['documento_id'] ?? '' }}" data-tipo="{{ $tipoDocumento }}" class="{{ $claseDocumento }} {{ $claseFila }}">
                                    <!-- NOMBRE DEL DOCUMENTO -->
                                    <td class="document-name-cell" data-label="Documento">
                                        <div class="document-name">
                                            <div class="document-icon icon-{{ $estado }}">
                                                <i class="fas fa-{{ $documento['icono'] }}"></i>
                                            </div>
                                            <div class="document-name-text">
                                                <div class="document-title">{{ $documento['nombre'] }}</div>
                                                <div class="document-desc">{{ $documento['descripcion'] }}</div>
                                            </div>
                                        </div>
                                        
                                        <!-- BARRA DE PROGRESO INDIVIDUAL -->
                                        <div class="document-progress">
                                            <div class="progress-indicator">
                                                <span class="progress-text">
                                                    @php
                                                        $textoProgreso = '';
                                                        if($estado == 'aprobado') $textoProgreso = 'Aprobado';
                                                        elseif($estado == 'rechazado') $textoProgreso = 'Rechazado';
                                                        elseif($estado == 'pendiente') $textoProgreso = 'En revisión';
                                                        else $textoProgreso = 'Pendiente';
                                                    @endphp
                                                    {{ $textoProgreso }}
                                                </span>
                                                <div class="progress-bar-small">
                                                    @php
                                                        $anchoProgreso = 0;
                                                        $claseProgreso = '';
                                                        if($estado == 'aprobado') {
                                                            $anchoProgreso = 100;
                                                            $claseProgreso = 'completed';
                                                        } elseif($estado == 'rechazado') {
                                                            $anchoProgreso = 100;
                                                            $claseProgreso = 'rejected';
                                                        } elseif($estado == 'pendiente') {
                                                            $anchoProgreso = 50;
                                                            $claseProgreso = 'pending';
                                                        } else {
                                                            $anchoProgreso = 0;
                                                            $claseProgreso = 'not-started';
                                                        }
                                                    @endphp
                                                    <div class="progress-fill {{ $claseProgreso }}" style="width: {{ $anchoProgreso }}%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    
                                    <!-- ESTADO -->
                                    <td class="status-cell" data-label="Estado">
                                        @if($estado == 'aprobado')
                                        <span class="status-badge status-aprobado">
                                            <span class="status-indicator indicator-aprobado"></span>
                                            Aprobado
                                        </span>
                                        @elseif($estado == 'rechazado')
                                        <span class="status-badge status-rechazado">
                                            <span class="status-indicator indicator-rechazado"></span>
                                            Rechazado
                                        </span>
                                        @elseif($estado == 'pendiente')
                                        <span class="status-badge status-revision">
                                            <span class="status-indicator indicator-revision"></span>
                                            En Revisión
                                        </span>
                                        @else
                                        <span class="status-badge status-faltante">
                                            <span class="status-indicator indicator-faltante"></span>
                                            Pendiente
                                        </span>
                                        @endif
                                    </td>
                                    
                                    <!-- INFORMACIÓN -->
                                    <td class="info-cell" data-label="Información">
                                        @if($tieneDocumento)
                                        <div class="document-info">
                                            <div class="info-item">
                                                <i class="fas fa-file"></i>
                                                <span class="info-label">Archivo:</span>
                                                <span class="info-value" title="{{ $documento['archivo'] ?? '' }}">
                                                    @php
                                                        $archivoNombre = $documento['archivo'] ?? 'Documento subido';
                                                        echo strlen($archivoNombre) > 20 ? substr($archivoNombre, 0, 20) . '...' : $archivoNombre;
                                                    @endphp
                                                </span>
                                            </div>
                                            <div class="info-item">
                                                <i class="fas fa-calendar"></i>
                                                <span class="info-label">Subido:</span>
                                                <span class="info-value">{{ $documento['fecha_subida'] ? $documento['fecha_subida']->format('d/m/Y') : 'N/A' }}</span>
                                            </div>
                                            @if($estado == 'aprobado' && isset($documento['aprobado_por']))
                                            <div class="info-item">
                                                <i class="fas fa-user-check"></i>
                                                <span class="info-label">Revisor:</span>
                                                <span class="info-value">{{ $documento['aprobado_por'] }}</span>
                                            </div>
                                            @endif
                                        </div>
                                        @else
                                        <div class="document-info">
                                            <div class="info-item">
                                                <i class="fas fa-exclamation-circle"></i>
                                                <span class="info-label">Estado:</span>
                                                <span class="info-value">No subido</span>
                                            </div>
                                            <div class="info-item">
                                                <i class="fas fa-clock"></i>
                                                <span class="info-label">Fecha:</span>
                                                <span class="info-value">Pendiente</span>
                                            </div>
                                        </div>
                                        @endif
                                        
                                        @if($estado == 'rechazado' && !empty($documento['observaciones']))
                                        <div class="observations" title="{{ $documento['observaciones'] }}">
                                            <div class="observations-title">
                                                <i class="fas fa-comment"></i>
                                                Observaciones
                                            </div>
                                            @php
                                                $obs = $documento['observaciones'];
                                                echo strlen($obs) > 80 ? substr($obs, 0, 80) . '...' : $obs;
                                            @endphp
                                            @if(strlen($documento['observaciones']) > 80)
                                            <span style="color: #8b5cf6; cursor: pointer;" onclick="alertObservacionCompleta('{{ addslashes($documento['observaciones']) }}')">
                                                ...ver más
                                            </span>
                                            @endif
                                        </div>
                                        @endif
                                    </td>
                                    
                                    <!-- ACCIONES -->
                                    <td class="actions-cell" data-label="Acciones">
                                        <div class="document-actions">
                                            @if($tieneDocumento)
                                            <button type="button" class="action-btn btn-view" onclick="verDocumento('{{ $documento['documento_id'] ?? '' }}')">
                                                <i class="fas fa-eye"></i> Ver
                                            </button>
                                            <button type="button" class="action-btn btn-download" onclick="descargarDocumento('{{ $documento['documento_id'] ?? '' }}')">
                                                <i class="fas fa-download"></i> Descargar
                                            </button>
                                            @if($hayPeriodoHabilitado && in_array($estado, ['aprobado', 'rechazado', 'pendiente']))
                                            <button type="button" class="action-btn btn-update" onclick="selectFile('{{ $tipoDocumento }}')">
                                                <i class="fas fa-sync-alt"></i> Actualizar
                                            </button>
                                            @endif
                                            @else
                                            @if($hayPeriodoHabilitado)
                                            <!-- EL BOTÓN UPLOAD ESTÁ OCULTO POR CSS, SOLO USAMOS SELECT -->
                                            <button type="button" class="action-btn btn-upload" style="display: none;">Subir</button>
                                            @endif
                                            @endif
                                        </div>
                                    </td>
                                    
                                    <!-- SUBIR ARCHIVO - SOLO BOTÓN SELECCIONAR -->
                                    <td class="upload-cell" data-label="Subir Archivo">
                                        @if($hayPeriodoHabilitado)
                                        <div class="upload-container">
                                            <!-- INPUT OCULTO -->
                                            <input type="file" 
                                                   id="file-{{ $tipoDocumento }}" 
                                                   name="{{ $tipoDocumento }}"
                                                   accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"
                                                   style="display: none;"
                                                   data-tipo="{{ $tipoDocumento }}"
                                                   onchange="handleFileSelect('{{ $tipoDocumento }}', this)">
                                            
                                            <div class="upload-main-wrapper">
                                                @if(!$tieneDocumento)
                                                <!-- BOTÓN SELECCIONAR - SOLO SI NO TIENE DOCUMENTO -->
                                                <button type="button" class="file-select-btn" onclick="selectFile('{{ $tipoDocumento }}')">
                                                    <i class="fas fa-paperclip"></i> Seleccionar archivo
                                                </button>
                                                
                                                <!-- INDICADOR DE ARCHIVO SELECCIONADO -->
                                                <div id="file-selected-{{ $tipoDocumento }}" class="file-selected-indicator" style="display: none;">
                                                    <div class="file-info">
                                                        <i class="fas fa-file-pdf"></i>
                                                        <span class="file-name-display" id="file-selected-name-{{ $tipoDocumento }}"></span>
                                                    </div>
                                                    <button type="button" class="file-remove-btn" onclick="clearFile('{{ $tipoDocumento }}')">
                                                        <i class="fas fa-times"></i> Quitar
                                                    </button>
                                                </div>
                                                
                                                <!-- PREVIEW INICIAL -->
                                                <div class="file-current-info" id="file-name-preview-{{ $tipoDocumento }}">
                                                    <i class="fas fa-info-circle" style="color: #94a3b8;"></i>
                                                    <span>Ningún archivo seleccionado</span>
                                                </div>
                                                @else
                                                <!-- SI YA TIENE DOCUMENTO, SOLO MOSTRAR NOMBRE DEL ARCHIVO (SIN BOTONES) -->
                                                <div class="file-current-info" id="file-name-preview-{{ $tipoDocumento }}">
                                                    <i class="fas fa-check-circle" style="color: #10b981;"></i>
                                                    <span>Archivo: {{ strlen($documento['archivo'] ?? '') > 30 ? substr($documento['archivo'] ?? '', 0, 30) . '...' : ($documento['archivo'] ?? 'Documento subido') }}</span>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        @else
                                        <div style="color: #94a3af; font-size: 14px; font-style: italic; padding: 12px 0; text-align: center;">
                                            <i class="fas fa-lock"></i> Subida deshabilitada
                                        </div>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- BOTÓN DE ENVÍO A LA DERECHA (DEBAJO DE LA TABLA) -->
                    @if($hayPeriodoHabilitado)
                    <div class="submit-section-wrapper">
                        <button type="button" class="submit-button" id="submitBtn" onclick="showSubmitModal()">
                            <i class="fas fa-paper-plane"></i> Enviar Documentos Seleccionados
                        </button>
                    </div>
                    @endif
                </form>
                @else
                <!-- SIN DOCUMENTOS CONFIGURADOS -->
                <div class="no-documents-panel">
                    <div class="no-documents-icon">
                        <i class="fas fa-folder-open"></i>
                    </div>
                    <h3 class="no-documents-title">Sin Documentos Configurados</h3>
                    <p class="no-documents-text">
                        No se han configurados documentos para tu coordinación académica.
                        Contacta al administrador del sistema para más información.
                    </p>
                </div>
                @endif
            @endif
        </div>
    </div>

    <!-- MODAL PROFESIONAL PARA CONFIRMACIÓN DE ENVÍO -->
    <div id="submitModal" class="custom-modal-overlay" style="display: none;">
        <div class="custom-modal">
            <div class="modal-header">
                <i class="fas fa-paper-plane"></i>
                <h3>Confirmar envío de documentos</h3>
            </div>
            <div class="modal-body">
                <p style="margin-bottom: 15px; color: #475569;">Los siguientes documentos serán enviados para revisión:</p>
                <ul id="modalFileList" class="file-list"></ul>
                <p style="color: #64748b; font-size: 14px; margin-top: 10px;">
                    <i class="fas fa-info-circle" style="color: var(--primary);"></i>
                    Una vez enviados, los documentos quedarán pendientes de revisión por el administrador.
                </p>
            </div>
            <div class="modal-footer">
                <button class="modal-btn modal-btn-cancel" onclick="closeSubmitModal()">Cancelar</button>
                <button class="modal-btn modal-btn-confirm" onclick="submitForm()">Confirmar envío</button>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <script>
        // Variables globales
        let currentSelectedFiles = [];
        
        // Función para mostrar observaciones completas
        function alertObservacionCompleta(observacion) {
            alert("Observaciones completas:\n\n" + observacion);
        }
        
        // Función para manejar selección de archivos
        window.handleFileSelect = function(tipo, input) {
            const fileSelected = document.getElementById('file-selected-' + tipo);
            const fileSelectedName = document.getElementById('file-selected-name-' + tipo);
            const fileNamePreview = document.getElementById('file-name-preview-' + tipo);
            const row = document.querySelector(`tr[data-tipo="${tipo}"]`);
            
            if (input.files.length > 0) {
                const file = input.files[0];
                
                // Actualizar UI
                fileSelectedName.textContent = file.name;
                fileSelected.style.display = 'flex';
                fileNamePreview.innerHTML = `<i class="fas fa-check-circle" style="color: #10b981;"></i> <span>Nuevo archivo: ${file.name.length > 30 ? file.name.substring(0, 30) + '...' : file.name}</span>`;
                
                // Resaltar fila
                if (row) {
                    row.style.backgroundColor = '#eff6ff';
                    row.style.borderLeft = '3px solid #3b82f6';
                    row.classList.remove('no-document');
                    row.classList.add('has-document');
                }
                
                showToast(`Archivo "${file.name}" seleccionado`, 'success');
            }
        };
        
        // Función para limpiar archivo seleccionado
        window.clearFile = function(tipo) {
            const input = document.getElementById('file-' + tipo);
            const fileSelected = document.getElementById('file-selected-' + tipo);
            const fileNamePreview = document.getElementById('file-name-preview-' + tipo);
            const row = document.querySelector(`tr[data-tipo="${tipo}"]`);
            
            if (input) {
                input.value = '';
            }
            
            if (fileSelected) {
                fileSelected.style.display = 'none';
            }
            
            if (fileNamePreview) {
                fileNamePreview.innerHTML = `<i class="fas fa-info-circle" style="color: #94a3b8;"></i> <span>Ningún archivo seleccionado</span>`;
            }
            
            if (row) {
                row.style.backgroundColor = '';
                row.style.borderLeft = '';
                row.classList.remove('has-document');
                row.classList.add('no-document');
            }
            
            showToast('Archivo removido', 'info');
        };
        
        // Abrir selector de archivos
        window.selectFile = function(tipo) {
            const input = document.getElementById('file-' + tipo);
            if (input) {
                input.click();
            }
        };
        
        // Ver documento
        window.verDocumento = function(documentoId) {
            if (documentoId) {
                window.open("{{ url('documentos/ver') }}/" + documentoId, '_blank');
            } else {
                showToast('ID de documento no disponible', 'error');
            }
        };
        
        // Descargar documento
        window.descargarDocumento = function(documentoId) {
            if (documentoId) {
                window.location.href = "{{ url('documentos/descargar') }}/" + documentoId;
            } else {
                showToast('ID de documento no disponible', 'error');
            }
        };
        
        // Mostrar modal de confirmación
        window.showSubmitModal = function() {
            const uploadForm = document.getElementById('uploadForm');
            const fileInputs = uploadForm.querySelectorAll('input[type="file"]');
            let hasFile = false;
            currentSelectedFiles = [];
            
            fileInputs.forEach(input => {
                if (input.files.length > 0) {
                    hasFile = true;
                    currentSelectedFiles.push({
                        tipo: input.name,
                        archivo: input.files[0].name,
                        tamaño: (input.files[0].size / 1024).toFixed(2) + ' KB'
                    });
                }
            });
            
            if (!hasFile) {
                showToast('Selecciona al menos un documento', 'warning');
                return;
            }
            
            const modalList = document.getElementById('modalFileList');
            modalList.innerHTML = '';
            
            currentSelectedFiles.forEach(file => {
                const li = document.createElement('li');
                li.className = 'file-list-item';
                li.innerHTML = `
                    <i class="fas fa-file-pdf"></i>
                    <div class="file-details">
                        <div class="file-name-modal">${file.archivo}</div>
                        <div class="file-size-modal">${file.tamaño}</div>
                    </div>
                `;
                modalList.appendChild(li);
            });
            
            document.getElementById('submitModal').style.display = 'flex';
        };
        
        window.closeSubmitModal = function() {
            document.getElementById('submitModal').style.display = 'none';
        };
        
        window.submitForm = function() {
            const submitBtn = document.getElementById('submitBtn');
            const uploadForm = document.getElementById('uploadForm');
            
            if (submitBtn) {
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Enviando...';
                submitBtn.disabled = true;
            }
            
            closeSubmitModal();
            showToast('Enviando documentos...', 'info');
            uploadForm.submit();
        };
        
        // Mostrar toasts
        function showToast(message, type = 'info') {
            const oldToasts = document.querySelectorAll('.custom-toast');
            oldToasts.forEach(toast => toast.remove());
            
            const toast = document.createElement('div');
            toast.className = 'custom-toast';
            toast.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                padding: 15px 20px;
                background: ${type === 'error' ? '#ef4444' : type === 'success' ? '#10b981' : '#3b82f6'};
                color: white;
                border-radius: 10px;
                box-shadow: 0 5px 15px rgba(0,0,0,0.2);
                z-index: 10001;
                animation: slideInRight 0.3s ease;
                max-width: 350px;
                font-size: 14px;
                display: flex;
                align-items: center;
                gap: 10px;
            `;
            
            const icon = type === 'error' ? 'exclamation-circle' : (type === 'success' ? 'check-circle' : 'info-circle');
            toast.innerHTML = `
                <i class="fas fa-${icon}"></i>
                <span style="flex: 1;">${message}</span>
                <button onclick="this.parentElement.remove()" style="background: none; border: none; color: white; cursor: pointer; padding: 0 5px;">
                    <i class="fas fa-times"></i>
                </button>
            `;
            
            document.body.appendChild(toast);
            
            setTimeout(() => {
                if (toast.parentNode) {
                    toast.style.animation = 'slideOutRight 0.3s ease';
                    setTimeout(() => {
                        if (toast.parentNode) toast.remove();
                    }, 300);
                }
            }, 5000);
        }
        
        // Inicialización
        document.addEventListener('DOMContentLoaded', function() {
            // Validar tamaño de archivo
            const fileInputs = document.querySelectorAll('input[type="file"]');
            fileInputs.forEach(input => {
                input.addEventListener('change', function() {
                    const maxSize = 10 * 1024 * 1024; // 10MB
                    if (this.files[0] && this.files[0].size > maxSize) {
                        showToast('Máximo 10MB', 'error');
                        this.value = '';
                        const tipo = this.dataset.tipo;
                        const fileSelected = document.getElementById('file-selected-' + tipo);
                        const fileNamePreview = document.getElementById('file-name-preview-' + tipo);
                        if (fileSelected) fileSelected.style.display = 'none';
                        if (fileNamePreview) fileNamePreview.innerHTML = `<i class="fas fa-info-circle" style="color: #94a3b8;"></i> <span>Ningún archivo seleccionado</span>`;
                    }
                });
            });
            
            // Cerrar modal al hacer clic fuera
            window.addEventListener('click', function(event) {
                const modal = document.getElementById('submitModal');
                if (event.target === modal) closeSubmitModal();
            });
        });
        
        // Estilos para animaciones
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideInRight {
                from { transform: translateX(100%); opacity: 0; }
                to { transform: translateX(0); opacity: 1; }
            }
            @keyframes slideOutRight {
                from { transform: translateX(0); opacity: 1; }
                to { transform: translateX(100%); opacity: 0; }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>