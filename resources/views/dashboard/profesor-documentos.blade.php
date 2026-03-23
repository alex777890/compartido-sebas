<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
    <title>Documentos - Sistema GEPROC</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
            font-family: 'Inter', 'Segoe UI', system-ui, -apple-system, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #f5f7fb 0%, #f0f4f8 100%);
            color: #2d3748;
            line-height: 1.6;
            min-height: 100vh;
            font-size: 15px;
        }

        /* ===== PRIMERA BARRA (HEADER SUPERIOR) ===== */
        .navbar-top { 
            background: white; 
            border-bottom: 1px solid var(--border-color);
            padding: 0.8rem 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .navbar-top.scrolled {
            padding: 0.6rem 0;
            box-shadow: 0 5px 20px rgba(15, 126, 230, 0.15);
        }

        .container-custom {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .logo-img {
            height: 55px;
            width: auto;
            max-width: 180px;
            object-fit: contain;
        }

        .navbar-brand { 
            color: var(--primary) !important; 
            font-weight: 600; 
            font-size: 1.4rem;
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        .navbar-brand::before {
            content: "";
            display: block;
            width: 6px;
            height: 28px;
            background: var(--primary);
            border-radius: 2px;
        }

        /* ===== SEGUNDA BARRA (MENÚ DE NAVEGACIÓN) ===== */
        .navbar-menu { 
            background: var(--primary); 
            padding: 8px 0;
            position: sticky;
            top: 73px;
            z-index: 999;
        }

        /* Estilos para escritorio (menú horizontal visible) */
        .navbar-menu .navbar-collapse {
            display: flex !important;
            align-items: center;
            justify-content: space-between;
        }

        .navbar-menu .navbar-nav {
            display: flex;
            align-items: center;
            gap: 5px;
            flex-wrap: wrap;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .navbar-menu .nav-item {
            list-style: none;
        }

        .navbar-menu .nav-link {
            font-weight: 500;
            color: rgba(255, 255, 255, 0.9) !important;
            padding: 1rem 1.8rem !important;
            margin: 0 0.1rem;
            border-radius: 8px;
            transition: var(--transition);
            position: relative;
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .navbar-menu .nav-link:hover, 
        .navbar-menu .nav-link.active {
            color: white !important;
            background-color: rgba(255, 255, 255, 0.12);
        }

        .navbar-menu .nav-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 50%;
            width: 0;
            height: 3px;
            background: white;
            transition: var(--transition);
            transform: translateX(-50%);
            border-radius: 2px;
        }

        .navbar-menu .nav-link:hover::after, 
        .navbar-menu .nav-link.active::after {
            width: 70%;
        }

        /* Información de usuario y cerrar sesión en escritorio */
        .user-info-container {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
            color: white;
            padding: 5px 12px;
            border-radius: 40px;
            background: rgba(255, 255, 255, 0.1);
        }

        .user-name {
            font-weight: 500;
            color: rgba(255, 255, 255, 0.95);
            font-size: 0.95rem;
        }

        .user-avatar {
            font-size: 1.3rem;
            color: rgba(255, 255, 255, 0.9);
        }

        .logout-form {
            margin: 0;
        }

        .logout-btn {
            background: transparent;
            border: 1px solid rgba(255, 255, 255, 0.4);
            color: rgba(255, 255, 255, 0.9);
            padding: 0.5rem 1.2rem;
            border-radius: 40px;
            font-weight: 500;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9rem;
            cursor: pointer;
        }

        .logout-btn:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border-color: rgba(255, 255, 255, 0.6);
            transform: translateY(-2px);
        }

        /* Botón hamburguesa - Oculto en escritorio */
        .navbar-toggler {
            display: none;
            background: transparent;
            border: 1px solid rgba(255, 255, 255, 0.3);
            padding: 0.5rem 0.75rem;
            border-radius: 4px;
            cursor: pointer;
        }

        .navbar-toggler-icon {
            display: inline-block;
            width: 1.5em;
            height: 1.5em;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 0.8%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: center;
            background-size: contain;
        }

        /* MAIN CONTENT */
        .main-content {
            max-width: 1400px;
            margin: 0 auto;
            padding: 30px 20px;
            min-height: calc(100vh - 140px);
        }

        /* ===== ESTILOS DEL DOCUMENTOS ===== */
        .control-panel {
            background: white;
            border-radius: 16px;
            padding: 20px 25px;
            margin-bottom: 25px;
            box-shadow: var(--card-shadow);
            border: 2px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .panel-title-section .subtitle {
            font-size: 24px;
            font-weight: 700;
            color: var(--primary);
            margin: 0;
            line-height: 1.3;
            position: relative;
            display: inline-block;
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

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 18px;
            background: white;
            color: var(--primary);
            border: 2px solid var(--primary);
            border-radius: 8px;
            font-weight: 600;
            font-size: 13px;
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
        }

        .btn-back:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-2px);
        }

        .periodo-panel {
            background: white;
            border-radius: 16px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: var(--card-shadow);
            border: 2px solid var(--border-color);
            position: relative;
            overflow: hidden;
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
            flex-wrap: wrap;
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
            flex-shrink: 0;
        }

        .periodo-text h3 {
            font-size: 22px;
            font-weight: 700;
            color: #0b2b5c;
            margin-bottom: 6px;
        }

        .periodo-text p {
            color: var(--text-muted);
            font-size: 13px;
            margin: 0;
        }

        .periodo-badge {
            padding: 6px 14px;
            border-radius: 30px;
            font-weight: 600;
            font-size: 12px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .badge-active {
            background: var(--gradient-success);
            color: white;
        }

        .badge-inactive {
            background: var(--gradient-danger);
            color: white;
        }

        .progress-overview {
            background: var(--light-bg);
            border-radius: 12px;
            padding: 18px 20px;
        }

        .progress-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .progress-title {
            font-size: 14px;
            font-weight: 700;
            color: #1e293b;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .progress-percentage {
            font-size: 22px;
            font-weight: 800;
            color: var(--primary);
        }

        .progress-bar-container {
            height: 8px;
            background: #e2e8f0;
            border-radius: 4px;
            overflow: hidden;
            margin-bottom: 8px;
        }

        .progress-bar {
            height: 100%;
            background: var(--gradient-primary);
            border-radius: 4px;
            transition: width 1s ease;
        }

        .progress-stats {
            display: flex;
            justify-content: space-between;
            font-size: 12px;
            color: var(--text-muted);
            font-weight: 500;
            flex-wrap: wrap;
            gap: 10px;
        }

        .progress-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 12px;
            margin-top: 15px;
        }

        .detail-item {
            background: white;
            padding: 10px 12px;
            border-radius: 10px;
            border: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .detail-icon {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            color: white;
            flex-shrink: 0;
        }

        .detail-icon.requeridos { background: linear-gradient(135deg, #2563eb, #38bdf8); }
        .detail-icon.completados { background: var(--gradient-success); }
        .detail-icon.progreso { background: var(--gradient-purple); }

        .detail-content h4 {
            font-size: 11px;
            color: var(--text-muted);
            margin-bottom: 2px;
        }

        .detail-content p {
            font-size: 14px;
            font-weight: 700;
            color: #1e293b;
            margin: 0;
        }

        .documents-table-container {
            background: white;
            border-radius: 14px;
            overflow-x: auto;
            overflow-y: visible;
            box-shadow: var(--card-shadow);
            border: 2px solid var(--border-color);
            -webkit-overflow-scrolling: touch;
        }

        .table-header {
            padding: 18px 20px;
            background: #f8fafc;
            border-bottom: 2px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
        }

        .table-title {
            font-size: 18px;
            font-weight: 700;
            color: #1e293b;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .documents-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
            min-width: 900px;
        }

        .documents-table thead {
            background: #f8fafc;
        }

        .documents-table th {
            padding: 14px 16px;
            text-align: left;
            font-weight: 700;
            color: #475569;
            border-bottom: 2px solid var(--border-color);
            font-size: 13px;
            white-space: nowrap;
        }

        .documents-table th i {
            margin-right: 8px;
            color: var(--primary);
        }

        .documents-table tbody tr {
            border-bottom: 1px solid var(--border-color);
            transition: var(--transition);
        }

        .documents-table tbody tr:hover {
            background: #f8fafc;
        }

        .documents-table td {
            padding: 16px;
            vertical-align: middle;
            color: #475569;
        }

        .document-name {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .document-icon {
            width: 38px;
            height: 38px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            color: white;
            flex-shrink: 0;
        }

        .icon-aprobado { background: var(--gradient-success); }
        .icon-rechazado { background: var(--gradient-danger); }
        .icon-pendiente { background: var(--gradient-warning); }
        .icon-faltante { background: var(--gradient-purple); }

        .document-title {
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 4px;
            font-size: 14px;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            white-space: nowrap;
        }

        .status-aprobado { background: #d1fae5; color: #065f46; }
        .status-rechazado { background: #fee2e2; color: #991b1b; }
        .status-revision { background: #fef3c7; color: #92400e; }
        .status-faltante { background: #e0e7ff; color: #3730a3; }

        .upload-container {
            position: relative;
        }

        .file-select-btn {
            padding: 8px 14px;
            background: white;
            color: var(--primary);
            border: 2px solid var(--primary);
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .file-select-btn:hover {
            background: var(--primary);
            color: white;
        }

        .file-selected-indicator {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
            padding: 8px 12px;
            background: #f0f9ff;
            border: 1px solid #b8d6ff;
            border-radius: 8px;
            margin-top: 8px;
        }

        .file-info {
            display: flex;
            align-items: center;
            gap: 8px;
            flex: 1;
            min-width: 0;
        }

        .file-name-display {
            font-size: 12px;
            color: var(--primary);
            font-weight: 600;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .file-remove-btn {
            background: rgba(239, 68, 68, 0.1);
            border: none;
            color: var(--danger-color);
            cursor: pointer;
            padding: 4px 8px;
            font-size: 11px;
            border-radius: 6px;
        }

        .file-current-info {
            font-size: 12px;
            color: var(--text-muted);
            padding: 6px 10px;
            background: #f8fafc;
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 8px;
        }

        input[type="file"] {
            display: none;
        }

        .submit-section-wrapper {
            display: flex;
            justify-content: flex-end;
            margin-top: 20px;
        }

        .submit-button {
            padding: 10px 28px;
            background: var(--gradient-primary);
            color: white;
            border: none;
            border-radius: 50px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .submit-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(7, 68, 182, 0.3);
        }

        .alert {
            padding: 12px 16px;
            border-radius: 12px;
            margin-bottom: 20px;
            display: flex;
            align-items: flex-start;
            gap: 12px;
            border-left: 6px solid transparent;
            font-size: 13px;
        }

        .alert-success { background-color: var(--success-light); border-color: var(--success-color); }
        .alert-warning { background-color: var(--warning-light); border-color: var(--warning-color); }
        .alert-danger { background-color: var(--danger-light); border-color: var(--danger-color); }

        .no-documents-panel {
            background: #f0f9ff;
            border-radius: 14px;
            padding: 35px 25px;
            text-align: center;
            border: 2px solid #7dd3fc;
        }

        /* ===== ESTILOS DEL MODAL REDISEÑADO ===== */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .modal-container {
            background: white;
            border-radius: 24px;
            width: 90%;
            max-width: 500px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            transform: scale(0.95);
            transition: transform 0.3s ease;
            animation: modalSlideIn 0.3s ease forwards;
        }

        @keyframes modalSlideIn {
            from {
                transform: scale(0.95);
                opacity: 0;
            }
            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        .modal-header-custom {
            padding: 24px 24px 16px 24px;
            border-bottom: 2px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .modal-icon {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: var(--gradient-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
        }

        .modal-icon i {
            font-size: 24px;
            color: white;
        }

        .modal-title-custom {
            font-size: 20px;
            font-weight: 700;
            color: #1e293b;
            margin: 0;
        }

        .modal-close {
            background: transparent;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: var(--text-muted);
            transition: var(--transition);
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        }

        .modal-close:hover {
            background: var(--light-bg);
            color: var(--danger-color);
        }

        .modal-body-custom {
            padding: 24px;
        }

        .modal-message {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            background: var(--primary-soft);
            padding: 16px;
            border-radius: 16px;
            margin-bottom: 20px;
        }

        .modal-message i {
            font-size: 20px;
            color: var(--primary);
        }

        .modal-message p {
            margin: 0;
            color: #2d3748;
            font-weight: 500;
            line-height: 1.5;
        }

        .files-section {
            margin-top: 20px;
        }

        .files-title {
            font-size: 14px;
            font-weight: 600;
            color: var(--text-muted);
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .files-list {
            max-height: 300px;
            overflow-y: auto;
            padding-right: 8px;
        }

        .file-item {
            background: #f8fafc;
            border-radius: 12px;
            padding: 12px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: var(--transition);
            border: 1px solid var(--border-color);
        }

        .file-item:hover {
            background: white;
            border-color: var(--primary-light);
            transform: translateX(4px);
        }

        .file-icon {
            width: 40px;
            height: 40px;
            background: var(--gradient-primary);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .file-icon i {
            font-size: 18px;
            color: white;
        }

        .file-details {
            flex: 1;
            min-width: 0;
        }

        .file-name {
            font-weight: 600;
            color: #1e293b;
            font-size: 13px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .file-size {
            font-size: 11px;
            color: var(--text-muted);
            margin-top: 4px;
            display: block;
        }

        .file-badge {
            background: var(--success-light);
            color: var(--success-color);
            padding: 4px 8px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 600;
            flex-shrink: 0;
        }

        .modal-footer-custom {
            padding: 16px 24px 24px 24px;
            border-top: 2px solid var(--border-color);
            display: flex;
            gap: 12px;
            justify-content: flex-end;
        }

        .btn-cancel {
            padding: 10px 20px;
            background: white;
            border: 2px solid var(--border-color);
            border-radius: 12px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: var(--transition);
            color: var(--text-muted);
        }

        .btn-cancel:hover {
            background: var(--light-bg);
            border-color: var(--danger-color);
            color: var(--danger-color);
        }

        .btn-confirm {
            padding: 10px 24px;
            background: var(--gradient-primary);
            border: none;
            border-radius: 12px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: var(--transition);
            color: white;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-confirm:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(7, 68, 182, 0.3);
        }

        /* Scroll personalizado para la lista de archivos */
        .files-list::-webkit-scrollbar {
            width: 6px;
        }

        .files-list::-webkit-scrollbar-track {
            background: var(--light-bg);
            border-radius: 10px;
        }

        .files-list::-webkit-scrollbar-thumb {
            background: var(--primary-light);
            border-radius: 10px;
        }

        /* ===== MEDIA QUERIES - SOLO PARA MÓVIL ===== */
        @media (max-width: 991px) {
            .navbar-menu {
                top: 70px;
            }
            
            .navbar-menu .navbar-collapse {
                display: none !important;
                flex-direction: column;
                align-items: stretch;
                width: 100%;
                background: var(--primary);
                padding: 15px 0 20px 0;
                border-radius: 0 0 12px 12px;
                position: absolute;
                top: 100%;
                left: 0;
                z-index: 1000;
            }
            
            .navbar-menu .navbar-collapse.active {
                display: flex !important;
            }
            
            .navbar-toggler {
                display: block;
            }
            
            .navbar-menu .navbar-nav {
                flex-direction: column;
                align-items: stretch;
                width: 100%;
                margin-bottom: 20px;
            }
            
            .navbar-menu .nav-link {
                justify-content: flex-start;
                padding: 12px 20px !important;
                margin: 2px 0;
            }
            
            .navbar-menu .nav-link::after {
                display: none;
            }
            
            .user-info-container {
                flex-direction: column;
                align-items: stretch;
                width: 100%;
                gap: 15px;
                padding-top: 15px;
                border-top: 1px solid rgba(255, 255, 255, 0.2);
            }
            
            .user-info {
                justify-content: center;
                padding: 10px;
            }
            
            .logout-form {
                width: 100%;
            }
            
            .logout-btn {
                width: 100%;
                justify-content: center;
                padding: 10px;
            }
            
            .control-panel {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .progress-details {
                grid-template-columns: repeat(3, 1fr);
            }
            
            .periodo-header {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .table-header {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .modal-container {
                width: 95%;
                margin: 20px;
            }
        }

        @media (max-width: 768px) {
            .container-custom {
                padding: 0 15px;
            }
            
            .logo-img {
                height: 45px;
            }
            
            .navbar-brand {
                font-size: 1.2rem;
            }
            
            .main-content {
                padding: 20px 15px;
            }
            
            .progress-details {
                grid-template-columns: 1fr;
            }
            
            .periodo-text h3 {
                font-size: 18px;
            }
            
            .periodo-panel {
                padding: 18px;
            }
            
            .documents-table-container {
                border-radius: 12px;
            }
            
            .documents-table thead {
                display: none;
            }
            
            .documents-table tbody tr {
                display: block;
                margin-bottom: 15px;
                border: 1px solid var(--border-color);
                border-radius: 12px;
                padding: 15px;
            }
            
            .documents-table td {
                display: flex;
                align-items: flex-start;
                gap: 12px;
                padding: 10px 0;
                border: none;
            }
            
            .documents-table td:before {
                content: attr(data-label);
                font-weight: 600;
                color: var(--primary);
                min-width: 100px;
                font-size: 12px;
            }
            
            .document-name {
                flex: 1;
            }
            
            .submit-section-wrapper {
                justify-content: stretch;
            }
            
            .submit-button {
                width: 100%;
                justify-content: center;
            }
            
            .btn-back {
                width: 100%;
                justify-content: center;
            }
            
            .panel-title-section .subtitle {
                font-size: 20px;
            }
            
            .modal-footer-custom {
                flex-direction: column-reverse;
            }
            
            .btn-cancel, .btn-confirm {
                width: 100%;
                justify-content: center;
            }
        }

        @media (max-width: 576px) {
            .panel-title-section .subtitle {
                font-size: 18px;
            }
            
            .periodo-text h3 {
                font-size: 16px;
            }
            
            .documents-table td:before {
                min-width: 85px;
                font-size: 11px;
            }
            
            .file-select-btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <!-- PRIMERA BARRA - Logo y título -->
    <nav class="navbar-top">
        <div class="container-custom">
            <div class="logo-container">
                <img src="{{ asset('img/logo_iufim.png') }}" alt="Logo IUFIM" class="logo-img">
                <a class="navbar-brand" href="{{ route('profesor.dashboard') }}">
                    Sistema GEPROC
                </a>
            </div>
        </div>
    </nav>

    <!-- SEGUNDA BARRA - Menú con información de usuario -->
    <nav class="navbar-menu">
        <div class="container-custom" style="display: flex; align-items: center; justify-content: space-between;">
            <button class="navbar-toggler" type="button" id="menuToggle">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div style="flex: 1;"></div>
        </div>
        
        <div class="navbar-collapse" id="mainNavbar">
            <div class="container-custom" style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 20px;">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="{{ route('profesor.dashboard') }}" class="nav-link">
                            <i class="fas fa-home"></i> Inicio
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('profesor.documentos') }}" class="nav-link active">
                            <i class="fas fa-folder"></i> Documentos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('maestros.grados.create') }}" class="nav-link">
                            <i class="fas fa-graduation-cap"></i> Grados
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('editar-mi-perfil') }}" class="nav-link">
                            <i class="fas fa-user"></i> Perfil
                        </a>
                    </li>
                </ul>
                
                <div class="user-info-container">
                    <div class="user-info">
                        <span class="user-name">{{ $maestroData->nombre ?? 'Profesor' }}</span>
                        <div class="user-avatar">
                            <i class="fas fa-user-circle"></i>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" class="logout-form">
                        @csrf
                        <button type="submit" class="logout-btn">
                            <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- MAIN CONTENT -->
    <div class="main-content">
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
                <ul style="margin: 8px 0 0 20px; font-size: 13px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif

        @php
            $procesoActivo = $procesoActivo ?? false;
            $documentosParaVista = $documentosParaVista ?? [];
            $estadisticas = $estadisticas ?? [];
            
            $totalRequeridos = $estadisticas['total_requeridos'] ?? ($procesoActivo ? 13 : 6);
            $totalSubidos = $estadisticas['total_subidos'] ?? 0;
            $porcentaje = $estadisticas['porcentaje'] ?? ($totalRequeridos > 0 ? round(($totalSubidos / $totalRequeridos) * 100) : 0);
            $faltantes = $estadisticas['faltantes'] ?? ($totalRequeridos - $totalSubidos);
        @endphp

        <div class="control-panel">
            <div class="panel-title-section">
                <p class="subtitle">
                    @if($procesoActivo)
                        Documentos de Nuevo Ingreso 
                    @else
                        Documentos Período
                    @endif
                </p>
            </div>
            <div class="action-buttons">
                <a href="{{ route('profesor.dashboard') }}" class="btn-back">
                    <i class="fas fa-arrow-left"></i>
                    Volver
                </a>
            </div>
        </div>

        <div class="periodo-panel">
            <div class="periodo-header">
                <div class="periodo-title">
                    <div class="periodo-icon">
                        <i class="fas fa-folder-open"></i>
                    </div>
                    <div class="periodo-text">
                        <h3>
                            @if($procesoActivo)
                                Expediente de Nuevo Ingreso
                            @else
                                {{ $periodoHabilitado->nombre ?? 'Período Actual' }}
                            @endif
                        </h3>
                        <p>
                            @if($procesoActivo)
                                Sube los 13 documentos requeridos para completar tu ingreso.
                            @else
                                Mantén actualizado tu expediente con los documentos del período.
                            @endif
                        </p>
                    </div>
                </div>
                <div class="periodo-badge {{ $procesoActivo ? 'badge-active' : 'badge-inactive' }}">
                    @if($procesoActivo)
                    <i class="fas fa-check-circle"></i> NUEVO INGRESO
                    @else
                    <i class="fas fa-clock"></i> PERÍODO
                    @endif
                </div>
            </div>
            
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
                    <span>{{ $totalSubidos }} de {{ $totalRequeridos }} documentos</span>
                    <span>{{ $faltantes }} pendientes</span>
                </div>
                
                <div class="progress-details">
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
        </div>

        @if(count($documentosParaVista) > 0)
        <form action="{{ route($rutaSubida ?? 'profesor.subir-documentos') }}" method="POST" enctype="multipart/form-data" id="uploadForm">
            @csrf
            
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
                            <th><i class="fas fa-upload"></i> Subir Archivo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($documentosParaVista as $documento)
                            @php
                                $tieneDocumento = $documento['tiene_documento'] ?? false;
                                $estado = $documento['estado'] ?? 'faltante';
                                $iconClass = 'icon-'.$estado;
                            @endphp
                            <tr>
                                <td data-label="Documento">
                                    <div class="document-name">
                                        <div class="document-icon {{ $iconClass }}">
                                            <i class="fas fa-{{ $documento['icono'] ?? 'file' }}"></i>
                                        </div>
                                        <div>
                                            <div class="document-title">{{ $documento['nombre'] }}</div>
                                            @if($documento['observaciones'] ?? false)
                                                <small class="text-danger">
                                                    <i class="fas fa-comment"></i> {{ $documento['observaciones'] }}
                                                </small>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                
                                <td data-label="Estado">
                                    @if($estado == 'aprobado')
                                    <span class="status-badge status-aprobado">
                                        <i class="fas fa-check-circle"></i> Aprobado
                                    </span>
                                    @elseif($estado == 'rechazado')
                                    <span class="status-badge status-rechazado">
                                        <i class="fas fa-times-circle"></i> Rechazado
                                    </span>
                                    @elseif($estado == 'pendiente')
                                    <span class="status-badge status-revision">
                                        <i class="fas fa-clock"></i> En Revisión
                                    </span>
                                    @else
                                    <span class="status-badge status-faltante">
                                        <i class="fas fa-hourglass-half"></i> Pendiente
                                    </span>
                                    @endif
                                </td>
                                
                                <td data-label="Información">
                                    @if($tieneDocumento)
                                    <div>
                                        <div><i class="fas fa-file"></i> {{ $documento['archivo_original'] ?? $documento['archivo'] ?? 'Documento' }}</div>
                                        @if(isset($documento['fecha_subida']))
                                        <div><i class="fas fa-calendar"></i> {{ \Carbon\Carbon::parse($documento['fecha_subida'])->format('d/m/Y') }}</div>
                                        @endif
                                    </div>
                                    @else
                                    <div><i class="fas fa-exclamation-circle"></i> No subido</div>
                                    @endif
                                </td>
                                
                                <td data-label="Subir Archivo">
                                    <div class="upload-container">
                                        <div class="upload-main-wrapper">
                                            <input type="file" 
                                                   name="{{ $documento['tipo'] ?? 'documentos[' . $documento['id'] . ']' }}" 
                                                   id="file-{{ $documento['id'] }}" 
                                                   class="file-input" 
                                                   data-doc-id="{{ $documento['id'] }}"
                                                   data-doc-name="{{ $documento['nombre'] }}"
                                                   accept=".pdf,.jpg,.jpeg,.png">
                                            
                                            <label for="file-{{ $documento['id'] }}" class="file-select-btn">
                                                <i class="fas fa-cloud-upload-alt"></i> Seleccionar
                                            </label>
                                            
                                            <div id="file-info-{{ $documento['id'] }}" class="file-selected-indicator" style="display: none;">
                                                <div class="file-info">
                                                    <i class="fas fa-check-circle text-success"></i>
                                                    <span class="file-name-display"></span>
                                                </div>
                                                <button type="button" class="file-remove-btn" onclick="resetFileInput({{ $documento['id'] }})">
                                                    <i class="fas fa-times"></i> Quitar
                                                </button>
                                            </div>
                                            
                                            @if($tieneDocumento && isset($documento['documento_id']))
                                                <div class="file-current-info">
                                                    <i class="fas fa-file-pdf"></i>
                                                    <span>Documento subido</span>
                                                </div>
                                                <div class="d-flex gap-2 mt-2">
                                                    <a href="{{ route('documentos.ver', $documento['documento_id']) }}" 
                                                       class="btn-outline-primary btn-sm" 
                                                       target="_blank">
                                                        <i class="fas fa-eye"></i> Ver
                                                    </a>
                                                    <a href="{{ route('documentos.descargar', $documento['documento_id']) }}" 
                                                       class="btn-outline-success btn-sm">
                                                        <i class="fas fa-download"></i> Descargar
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="submit-section-wrapper">
                <button type="button" class="submit-button" id="submitBtn" onclick="mostrarModalConfirmacion()">
                    <i class="fas fa-paper-plane"></i> Enviar Documentos
                </button>
            </div>
        </form>
        @else
        <div class="no-documents-panel">
            <div class="no-documents-icon">
                <i class="fas fa-folder-open"></i>
            </div>
            <h3 class="no-documents-title">Sin Documentos Configurados</h3>
            <p class="no-documents-text">
                No se han configurado documentos. Contacta al administrador del sistema.
            </p>
        </div>
        @endif
    </div>

    <!-- MODAL REDISEÑADO -->
    <div id="confirmacionModal" class="modal-overlay">
        <div class="modal-container">
            <div class="modal-header-custom">
                <div>
                    <div class="modal-icon">
                        <i class="fas fa-paper-plane"></i>
                    </div>
                    <h3 class="modal-title-custom">Confirmar envío de documentos</h3>
                </div>
                <button class="modal-close" onclick="cerrarModal()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <div class="modal-body-custom">
                <div class="modal-message">
                    <i class="fas fa-info-circle"></i>
                    <p>¿Estás seguro de enviar los siguientes documentos para revisión?</p>
                </div>
                
                <div class="files-section">
                    <div class="files-title">
                        <i class="fas fa-file-alt"></i>
                        Documentos seleccionados
                        <span id="archivosCount" class="file-badge" style="background: var(--primary-soft); color: var(--primary);">0</span>
                    </div>
                    <div id="archivosSeleccionadosList" class="files-list">
                        <!-- Los archivos se insertarán dinámicamente aquí -->
                    </div>
                </div>
            </div>
            
            <div class="modal-footer-custom">
                <button type="button" class="btn-cancel" onclick="cerrarModal()">
                    <i class="fas fa-times"></i> Cancelar
                </button>
                <button type="button" class="btn-confirm" onclick="enviarFormulario()">
                    <i class="fas fa-check-circle"></i> Confirmar envío
                </button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Menú hamburguesa para móvil
        const menuToggle = document.getElementById('menuToggle');
        const mainNavbar = document.getElementById('mainNavbar');
        
        if (menuToggle && mainNavbar) {
            menuToggle.addEventListener('click', function(e) {
                e.stopPropagation();
                mainNavbar.classList.toggle('active');
            });
            
            document.addEventListener('click', function(event) {
                if (window.innerWidth <= 991) {
                    if (!menuToggle.contains(event.target) && !mainNavbar.contains(event.target)) {
                        mainNavbar.classList.remove('active');
                    }
                }
            });
        }

        // Variables para el modal
        let archivosSeleccionados = [];
        const modal = document.getElementById('confirmacionModal');

        // Función para obtener el icono según el tipo de archivo
        function getFileIcon(fileName) {
            const extension = fileName.split('.').pop().toLowerCase();
            if (extension === 'pdf') return 'fa-file-pdf';
            if (['jpg', 'jpeg', 'png', 'gif'].includes(extension)) return 'fa-file-image';
            return 'fa-file-alt';
        }

        // Función para formatear el tamaño del archivo
        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.file-input').forEach(input => {
                input.addEventListener('change', function(e) {
                    const docId = this.dataset.docId;
                    const docName = this.dataset.docName;
                    const fileInfo = document.getElementById('file-info-' + docId);
                    const fileNameDisplay = fileInfo.querySelector('.file-name-display');
                    
                    if (this.files.length > 0) {
                        const file = this.files[0];
                        const fileSize = file.size;
                        const fileSizeKB = (fileSize / 1024).toFixed(2);
                        
                        if (fileSize > 5 * 1024 * 1024) {
                            alert('El archivo no puede ser mayor a 5MB');
                            this.value = '';
                            fileInfo.style.display = 'none';
                            return;
                        }
                        
                        const validTypes = ['application/pdf', 'image/jpeg', 'image/jpg', 'image/png'];
                        if (!validTypes.includes(file.type)) {
                            alert('Solo se permiten archivos PDF, JPG, JPEG o PNG');
                            this.value = '';
                            fileInfo.style.display = 'none';
                            return;
                        }
                        
                        fileNameDisplay.textContent = file.name + ' (' + fileSizeKB + ' KB)';
                        fileInfo.style.display = 'flex';
                        
                        // Guardar archivo en la lista global
                        const existingIndex = archivosSeleccionados.findIndex(a => a.docId === docId);
                        if (existingIndex !== -1) {
                            archivosSeleccionados[existingIndex] = { docId, docName, file, fileName: file.name, fileSize };
                        } else {
                            archivosSeleccionados.push({ docId, docName, file, fileName: file.name, fileSize });
                        }
                    } else {
                        fileInfo.style.display = 'none';
                        // Remover archivo de la lista
                        archivosSeleccionados = archivosSeleccionados.filter(a => a.docId !== docId);
                    }
                });
            });
        });

        function resetFileInput(docId) {
            const input = document.getElementById('file-' + docId);
            const fileInfo = document.getElementById('file-info-' + docId);
            input.value = '';
            fileInfo.style.display = 'none';
            archivosSeleccionados = archivosSeleccionados.filter(a => a.docId !== docId);
        }

        function mostrarModalConfirmacion() {
            archivosSeleccionados = [];
            
            // Recolectar archivos seleccionados
            document.querySelectorAll('.file-input').forEach(input => {
                if (input.files.length > 0) {
                    const docId = input.dataset.docId;
                    const docName = input.dataset.docName;
                    const file = input.files[0];
                    archivosSeleccionados.push({
                        docId,
                        docName,
                        file,
                        fileName: file.name,
                        fileSize: file.size
                    });
                }
            });
            
            if (archivosSeleccionados.length === 0) {
                alert('Selecciona al menos un documento para subir');
                return;
            }
            
            // Generar HTML para los archivos seleccionados
            const archivosList = document.getElementById('archivosSeleccionadosList');
            const archivosCount = document.getElementById('archivosCount');
            
            archivosList.innerHTML = archivosSeleccionados.map(archivo => `
                <div class="file-item">
                    <div class="file-icon">
                        <i class="fas ${getFileIcon(archivo.fileName)}"></i>
                    </div>
                    <div class="file-details">
                        <div class="file-name">${escapeHtml(archivo.docName)}</div>
                        <div class="file-name" style="font-size: 11px; color: #6b7280; margin-top: 2px;">${escapeHtml(archivo.fileName)}</div>
                        <span class="file-size">${formatFileSize(archivo.fileSize)}</span>
                    </div>
                    <div class="file-badge">
                        <i class="fas fa-check"></i> Listo
                    </div>
                </div>
            `).join('');
            
            archivosCount.textContent = archivosSeleccionados.length;
            
            // Mostrar modal con animación
            modal.classList.add('active');
        }
        
        function cerrarModal() {
            modal.classList.remove('active');
        }
        
        function enviarFormulario() {
            cerrarModal();
            document.getElementById('uploadForm').submit();
        }
        
        // Función para escapar HTML
        function escapeHtml(text) {
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }
        
        // Cerrar modal al hacer clic en el overlay
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                cerrarModal();
            }
        });
        
        // Efecto de scroll en navbar superior
        const navbarTop = document.querySelector('.navbar-top');
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                navbarTop.classList.add('scrolled');
            } else {
                navbarTop.classList.remove('scrolled');
            }
        });
        
        // Prevenir cierre con tecla ESC
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && modal.classList.contains('active')) {
                cerrarModal();
            }
        });
    </script>
</body>
</html>