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
            --border-radius: 8px;
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

        /* HEADER SUPERIOR MEJORADO Y MÁS GRANDE */
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

        .nav-link:hover, .nav-link.active {
            background-color: rgba(7, 68, 182, 0.12);
            color: var(--primary);
            transform: translateY(-2px);
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
            font-size: 16px;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 4px;
            white-space: nowrap;
        }

        .user-info p {
            font-size: 13px;
            color: var(--text-muted);
            white-space: nowrap;
        }

        /* BOTÓN DE CERRAR SESIÓN BLANCO */
        .logout-button {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 24px;
            background-color: white; /* CAMBIADO A BLANCO */
            color: var(--primary);
            border: 2px solid var(--primary);
            border-radius: 10px;
            font-weight: 600;
            font-size: 15px;
            cursor: pointer;
            transition: var(--transition);
        }

        .logout-button:hover {
            background-color: var(--primary); /* CAMBIA A AZUL AL HOVER */
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(7, 68, 182, 0.2);
        }

        .content-wrapper {
            padding: 35px 40px;
            max-width: 100%;
        }

        /* PANEL DE CONTROL SUPERIOR */
        .control-panel {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 35px;
            flex-wrap: wrap;
            gap: 25px;
        }

        .panel-title-section {
            flex: 1;
            min-width: 300px;
        }

        .main-title {
            font-size: 34px;
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 10px;
        }

        .subtitle {
            color: var(--text-muted);
            font-size: 17px;
            line-height: 1.6;
        }

        .action-buttons {
            display: flex;
            gap: 18px;
            align-items: center;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            padding: 14px 28px;
            background: white;
            color: var(--primary);
            border: 2px solid var(--primary);
            border-radius: 10px;
            font-weight: 600;
            font-size: 16px;
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

        /* PANEL DE PERIODO */
        .periodo-panel {
            background: white;
            border-radius: 18px;
            padding: 35px;
            margin-bottom: 35px;
            box-shadow: 0 6px 20px rgba(7, 68, 182, 0.12);
            border: 2px solid #e2e8f0;
            position: relative;
            overflow: hidden;
        }

        .periodo-panel::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: var(--gradient-primary);
        }

        .periodo-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 30px;
            flex-wrap: wrap;
            gap: 25px;
        }

        .periodo-title {
            display: flex;
            align-items: center;
            gap: 25px;
        }

        .periodo-icon {
            width: 60px;
            height: 60px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
            color: white;
            background: var(--gradient-primary);
            box-shadow: 0 6px 15px rgba(7, 68, 182, 0.25);
        }

        .periodo-text h3 {
            font-size: 22px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 10px;
        }

        .periodo-text p {
            color: #64748b;
            font-size: 16px;
            margin: 0;
        }

        .periodo-badge {
            padding: 12px 26px;
            border-radius: 30px;
            font-weight: 700;
            font-size: 15px;
            display: inline-flex;
            align-items: center;
            gap: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
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
            background: #f8fafc;
            border-radius: 12px;
            padding: 30px;
            margin-bottom: 30px;
            border: 2px solid #e2e8f0;
        }

        .progress-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .progress-title {
            font-size: 20px;
            font-weight: 700;
            color: #1e293b;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .progress-title i {
            color: var(--primary);
        }

        .progress-percentage {
            font-size: 32px;
            font-weight: 800;
            color: var(--primary);
        }

        .progress-bar-container {
            height: 16px;
            background: #e2e8f0;
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 15px;
        }

        .progress-bar {
            height: 100%;
            background: var(--gradient-primary);
            border-radius: 8px;
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
            font-size: 15px;
            color: #64748b;
            font-weight: 500;
        }

        .progress-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 25px;
            margin-top: 25px;
        }

        .detail-item {
            background: white;
            padding: 18px 24px;
            border-radius: 12px;
            border: 2px solid #e2e8f0;
            display: flex;
            align-items: center;
            gap: 18px;
            transition: var(--transition);
        }

        .detail-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.08);
        }

        .detail-icon {
            width: 45px;
            height: 45px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
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
            font-size: 14px;
            color: #64748b;
            margin-bottom: 6px;
            font-weight: 500;
        }

        .detail-content p {
            font-size: 18px;
            font-weight: 700;
            color: #1e293b;
            margin: 0;
        }

        /* TABLA DE DOCUMENTOS - MÁS COMPACTA PERO ATRACTIVA */
        .documents-table-container {
            background: white;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border: 2px solid #e2e8f0;
            margin-bottom: 35px;
            max-width: 100%;
            overflow-x: auto;
        }

        /* QUITAR BARRAS DE DESPLAZAMIENTO VISIBLES */
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
            border-bottom: 2px solid #e2e8f0;
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
            color: #64748b;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        /* TABLA PRINCIPAL - MÁS COMPACTA Y ATRACTIVA */
        .documents-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 15px;
            min-width: 1100px; /* REDUCIDO PARA MENOS SCROLL */
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
            border-bottom: 2px solid #e2e8f0;
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
            border-bottom: 1px solid #f1f5f9;
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

        /* COLUMNAS ESPECÍFICAS - MÁS COMPACTAS */
        .document-name-cell {
            min-width: 280px; /* REDUCIDO */
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
            color: #64748b;
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
            min-width: 140px; /* REDUCIDO */
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
            background: #dbeafe;
            color: #1e40af;
            border: 1px solid #bfdbfe;
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
        .indicator-revision { background: #3b82f6; }
        .indicator-faltante { background: #8b5cf6; }

        /* INFORMACIÓN DEL DOCUMENTO */
        .info-cell {
            min-width: 200px; /* REDUCIDO */
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
            color: #64748b;
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

        /* ACCIONES */
        .actions-cell {
            min-width: 180px; /* REDUCIDO */
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
            border: 1px solid #e2e8f0;
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

        .btn-upload {
            background: #3b82f6;
            color: white;
            border: 1px solid #3b82f6;
        }

        .btn-upload:hover {
            background: #2563eb;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(59, 130, 246, 0.2);
        }

        /* ÁREA DE SUBIDA */
        .upload-cell {
            min-width: 220px; /* REDUCIDO */
            width: 220px;
        }

        .upload-container {
            position: relative;
        }

        .file-input-wrapper {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .file-input-btn {
            padding: 7px 12px;
            background: #f8fafc;
            color: #475569;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            font-size: 13px;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 5px;
            white-space: nowrap;
        }

        .file-input-btn:hover {
            background: #e2e8f0;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        input[type="file"] {
            display: none;
        }

        .file-name {
            flex: 1;
            font-size: 13px;
            color: #64748b;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 160px;
        }

        .file-selected {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 8px 12px;
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            border-radius: 6px;
            margin-top: 8px;
            animation: fadeIn 0.3s ease;
        }

        .file-selected-info {
            display: flex;
            align-items: center;
            gap: 8px;
            flex: 1;
            min-width: 0;
        }

        .file-selected-icon {
            color: #3b82f6;
            font-size: 13px;
            flex-shrink: 0;
        }

        .file-selected-name {
            font-size: 13px;
            color: #1e40af;
            font-weight: 500;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            max-width: 140px;
        }

        .file-remove {
            background: none;
            border: none;
            color: #ef4444;
            cursor: pointer;
            padding: 4px;
            font-size: 12px;
            flex-shrink: 0;
            transition: var(--transition);
        }

        .file-remove:hover {
            color: #dc2626;
            transform: scale(1.1);
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
            color: #64748b;
            font-size: 17px;
            max-width: 650px;
            margin: 0 auto 30px;
            line-height: 1.6;
        }

        /* BOTÓN DE ENVÍO */
        .submit-section {
            margin-top: 45px;
            padding-top: 30px;
            border-top: 2px solid #e2e8f0;
            text-align: center;
        }

        .submit-button {
            padding: 16px 45px;
            background: var(--gradient-primary);
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: 700;
            font-size: 17px;
            cursor: pointer;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 14px;
        }

        .submit-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(7, 68, 182, 0.25);
            background: linear-gradient(135deg, #1d4ed8 0%, #0744b6ff 100%);
        }

        /* REMOVER SCROLL INDICATOR */
        .scroll-indicator {
            display: none; /* OCULTO */
        }

        /* PROGRESS BAR INDIVIDUAL PARA CADA DOCUMENTO */
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
            color: #64748b;
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
            }
            
            .nav-link {
                padding: 12px 16px;
                font-size: 15px;
            }
            
            .user-info h4 {
                font-size: 15px;
            }
            
            .user-info p {
                font-size: 12px;
            }
            
            .documents-table {
                min-width: 1000px;
            }
            
            .content-wrapper {
                padding: 25px;
            }
        }

        @media (max-width: 992px) {
            .main-title {
                font-size: 28px;
            }
            
            .subtitle {
                font-size: 15px;
            }
            
            .control-panel {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
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
        }

        @media (max-width: 768px) {
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
                border-bottom: 2px solid #e2e8f0;
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
            
            .file-input-wrapper {
                flex-direction: column;
                align-items: stretch;
            }
            
            .file-input-btn {
                width: 100%;
            }
            
            .periodo-panel {
                padding: 25px;
            }
            
            .logout-button {
                padding: 10px 18px;
                font-size: 14px;
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
                min-width: 200px;
            }
        }

        @media (max-width: 480px) {
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
            
            .content-wrapper {
                padding: 20px;
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
        }

        /* CLASES PARA DOCUMENTOS */
        .has-document .btn-upload {
            display: none;
        }

        .no-document .btn-view,
        .no-document .btn-download,
        .no-document .btn-update {
            display: none;
        }
    </style>
</head>
<body>
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <!-- HEADER SUPERIOR MÁS GRANDE Y ATTRACTIVO -->
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
                    <a href="{{ route('profesor.dashboard') }}#perfil" class="nav-link">
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

            <!-- PANEL DE CONTROL -->
            <div class="control-panel">
                <div class="panel-title-section">
                    <h1 class="main-title">Gestión de Documentos Académicos</h1>
                    <p class="subtitle">Administración y control de documentos requeridos</p>
                </div>
                <div class="action-buttons">
                    <a href="{{ route('profesor.dashboard') }}" class="btn-back">
                        <i class="fas fa-arrow-left"></i>
                        Volver al Panel
                    </a>
                </div>
            </div>

            <!-- PANEL DE PERÍODO REDISEÑADO -->
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
                                Sistema de carga temporalmente deshabilitado
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
                            Progreso General de Documentos
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
                                <h4>Documentos Requeridos</h4>
                                <p>{{ $totalRequeridos }} documentos</p>
                            </div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-icon completados">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="detail-content">
                                <h4>Documentos Completados</h4>
                                <p>{{ $totalSubidos }} de {{ $totalRequeridos }}</p>
                            </div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-icon progreso">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <div class="detail-content">
                                <h4>Progreso General</h4>
                                <p>{{ $porcentaje }}% completado</p>
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

                @if(!$hayPeriodoHabilitado)
                <!-- PANEL SIN PERÍODO HABILITADO -->
                <div class="no-period-panel">
                    <div class="no-period-icon">
                        <i class="fas fa-lock"></i>
                    </div>
                    <h3 class="no-period-title">Sistema Temporalmente Deshabilitado</h3>
                    <p class="no-period-text">
                        No hay ningún período académico habilitado para la carga de documentos.
                        El sistema se activará automáticamente cuando se habilite un nuevo período.
                    </p>
                </div>
                @endif
                
                @if(count($documentosParaVista) > 0)
                <!-- FORMULARIO DE SUBIDA -->
                <form action="{{ route('profesor.subir-documentos') }}" method="POST" enctype="multipart/form-data" id="uploadForm">
                    @csrf
                    <input type="hidden" name="periodo_id" value="{{ $periodoHabilitado->id ?? '' }}">
                    
                    <!-- TABLA DE DOCUMENTOS - MÁS ATRACTIVA Y COMPACTA -->
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
                        
                        <!-- TABLA MÁS COMPACTA -->
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
                                @endphp
                                <tr data-documento-id="{{ $documento['documento_id'] ?? '' }}" class="{{ $claseDocumento }} {{ $claseFila }}">
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
                                            <!-- Botones para documentos existentes -->
                                            <button type="button" class="action-btn btn-view" onclick="verDocumento('{{ $documento['documento_id'] ?? '' }}')">
                                                <i class="fas fa-eye"></i> Ver
                                            </button>
                                            <button type="button" class="action-btn btn-download" onclick="descargarDocumento('{{ $documento['documento_id'] ?? '' }}')">
                                                <i class="fas fa-download"></i> Descargar
                                            </button>
                                            @if($hayPeriodoHabilitado && in_array($estado, ['aprobado', 'rechazado', 'pendiente']))
                                            <button type="button" class="action-btn btn-update" onclick="selectFile('{{ $documento['tipo'] }}')">
                                                <i class="fas fa-sync-alt"></i> Actualizar
                                            </button>
                                            @endif
                                            @else
                                            @if($hayPeriodoHabilitado)
                                            <button type="button" class="action-btn btn-upload" onclick="selectFile('{{ $documento['tipo'] }}')">
                                                <i class="fas fa-upload"></i> Subir
                                            </button>
                                            @endif
                                            @endif
                                        </div>
                                    </td>
                                    
                                    <!-- SUBIR ARCHIVO -->
                                    <td class="upload-cell" data-label="Subir Archivo">
                                        @if($hayPeriodoHabilitado)
                                        <div class="upload-container">
                                            <div class="file-input-wrapper">
                                                <button type="button" class="file-input-btn" onclick="selectFile('{{ $documento['tipo'] }}')">
                                                    <i class="fas fa-paperclip"></i> Seleccionar
                                                </button>
                                                <div class="file-name" id="file-name-preview-{{ $documento['tipo'] }}" title="{{ $documento['archivo'] ?? '' }}">
                                                    @if($tieneDocumento)
                                                    @php
                                                        $archivo = $documento['archivo'] ?? 'Documento subido';
                                                        echo strlen($archivo) > 25 ? substr($archivo, 0, 25) . '...' : $archivo;
                                                    @endphp
                                                    @else
                                                    Ningún archivo seleccionado
                                                    @endif
                                                </div>
                                            </div>
                                            
                                            <input type="file" 
                                                   id="{{ $documento['tipo'] }}" 
                                                   name="{{ $documento['tipo'] }}"
                                                   accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"
                                                   style="display: none;"
                                                   onchange="updateFileName('{{ $documento['tipo'] }}', this)">
                                            
                                            <div id="file-selected-{{ $documento['tipo'] }}" class="file-selected" style="display: none;">
                                                <div class="file-selected-info">
                                                    <i class="fas fa-file file-selected-icon"></i>
                                                    <span class="file-selected-name" id="file-selected-name-{{ $documento['tipo'] }}"></span>
                                                </div>
                                                <button type="button" class="file-remove" onclick="clearFile('{{ $documento['tipo'] }}')">
                                                    <i class="fas fa-times"></i>
                                                </button>
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
                    
                    <!-- BOTÓN DE ENVÍO -->
                    @if($hayPeriodoHabilitado && count($documentosParaVista) > 0)
                    <div class="submit-section">
                        <button type="submit" class="submit-button" id="submitBtn">
                            <i class="fas fa-paper-plane"></i> Enviar Documentos Seleccionados
                        </button>
                        <p style="margin-top: 10px; color: #64748b; font-size: 15px;">
                            Solo se procesarán los archivos que hayas seleccionado en la tabla
                        </p>
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

    <!-- JAVASCRIPT -->
    <script>
        // Función para mostrar observaciones completas
        function alertObservacionCompleta(observacion) {
            alert("Observaciones completas:\n\n" + observacion);
        }
        
        document.addEventListener('DOMContentLoaded', function() {
            // Manejar la selección de archivos
            window.updateFileName = function(tipo, input) {
                const fileSelected = document.getElementById('file-selected-' + tipo);
                const fileSelectedName = document.getElementById('file-selected-name-' + tipo);
                const fileNamePreview = document.getElementById('file-name-preview-' + tipo);
                const row = document.querySelector(`tr [onclick*="${tipo}"]`)?.closest('tr');
                
                if (input.files.length > 0) {
                    fileSelectedName.textContent = input.files[0].name;
                    fileSelected.style.display = 'flex';
                    fileNamePreview.textContent = 'Archivo seleccionado';
                    
                    // Resaltar la fila
                    if (row) {
                        row.style.backgroundColor = '#eff6ff';
                        row.style.borderLeft = '3px solid #3b82f6';
                        
                        // Cambiar clase para mostrar botones correctos
                        row.classList.remove('no-document');
                        row.classList.add('has-document');
                    }
                }
            };
            
            window.clearFile = function(tipo) {
                const input = document.getElementById(tipo);
                const fileSelected = document.getElementById('file-selected-' + tipo);
                const fileNamePreview = document.getElementById('file-name-preview-' + tipo);
                const row = document.querySelector(`tr [onclick*="${tipo}"]`)?.closest('tr');
                
                input.value = '';
                fileSelected.style.display = 'none';
                fileNamePreview.textContent = 'Ningún archivo seleccionado';
                
                // Quitar resaltado de la fila
                if (row) {
                    row.style.backgroundColor = '';
                    row.style.borderLeft = '';
                }
            };
            
            window.selectFile = function(tipo) {
                const input = document.getElementById(tipo);
                if (input) {
                    input.click();
                }
            };
            
            // Validar formulario de subida
            const uploadForm = document.getElementById('uploadForm');
            if (uploadForm) {
                uploadForm.addEventListener('submit', function(e) {
                    const submitBtn = document.getElementById('submitBtn');
                    const fileInputs = this.querySelectorAll('input[type="file"]');
                    let hasFile = false;
                    
                    fileInputs.forEach(input => {
                        if (input.files.length > 0) {
                            hasFile = true;
                        }
                    });
                    
                    if (!hasFile) {
                        e.preventDefault();
                        // Mostrar alerta personalizada
                        const alertDiv = document.createElement('div');
                        alertDiv.className = 'alert alert-warning';
                        alertDiv.innerHTML = `
                            <i class="fas fa-exclamation-triangle"></i>
                            <div>
                                <strong>Sin documentos seleccionados</strong>
                                <p>Por favor, selecciona al menos un documento para enviar al sistema.</p>
                            </div>
                        `;
                        
                        const firstSection = document.querySelector('.documents-table-container');
                        if (firstSection) {
                            firstSection.parentNode.insertBefore(alertDiv, firstSection);
                        }
                        
                        // Scroll al top
                        window.scrollTo({ top: 0, behavior: 'smooth' });
                        
                        // Remover alerta después de 5 segundos
                        setTimeout(() => {
                            alertDiv.remove();
                        }, 5000);
                        
                        return false;
                    }
                    
                    if (submitBtn) {
                        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Enviando...';
                        submitBtn.disabled = true;
                        
                        // Mostrar mensaje de progreso
                        const progressMsg = document.createElement('div');
                        progressMsg.className = 'alert alert-info';
                        progressMsg.innerHTML = `
                            <i class="fas fa-spinner fa-spin"></i>
                            <div>
                                <strong>Enviando documentos...</strong>
                                <p>Por favor, espera mientras se procesan tus documentos. No cierres esta página.</p>
                            </div>
                        `;
                        
                        const firstSection = document.querySelector('.documents-table-container');
                        if (firstSection) {
                            firstSection.parentNode.insertBefore(progressMsg, firstSection);
                        }
                        
                        window.scrollTo({ top: 0, behavior: 'smooth' });
                    }
                });
            }
            
            // Funciones para ver y descargar documentos
            window.verDocumento = function(documentoId) {
                if (documentoId) {
                    window.open("{{ url('documentos/ver') }}/" + documentoId, '_blank');
                } else {
                    showToast('No se puede ver el documento. ID no disponible.', 'error');
                }
            };
            
            window.descargarDocumento = function(documentoId) {
                if (documentoId) {
                    window.location.href = "{{ url('documentos/descargar') }}/" + documentoId;
                } else {
                    showToast('No se puede descargar el documento. ID no disponible.', 'error');
                }
            };
            
            // Función para mostrar toasts
            function showToast(message, type = 'info') {
                const toast = document.createElement('div');
                toast.style.cssText = `
                    position: fixed;
                    top: 20px;
                    right: 20px;
                    padding: 15px 20px;
                    background: ${type === 'error' ? '#ef4444' : '#3b82f6'};
                    color: white;
                    border-radius: 10px;
                    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
                    z-index: 1000;
                    animation: slideInRight 0.3s ease;
                    max-width: 350px;
                    font-size: 14px;
                    display: flex;
                    align-items: center;
                    gap: 10px;
                `;
                
                toast.innerHTML = `
                    <i class="fas fa-${type === 'error' ? 'exclamation-circle' : 'info-circle'}"></i>
                    <span>${message}</span>
                `;
                
                document.body.appendChild(toast);
                
                setTimeout(() => {
                    toast.style.animation = 'slideOutRight 0.3s ease';
                    setTimeout(() => {
                        document.body.removeChild(toast);
                    }, 300);
                }, 4000);
            }
            
            // Añadir estilos para animaciones de toast
            const style = document.createElement('style');
            style.textContent = `
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
                @keyframes slideOutRight {
                    from {
                        transform: translateX(0);
                        opacity: 1;
                    }
                    to {
                        transform: translateX(100%);
                        opacity: 0;
                    }
                }
            `;
            document.head.appendChild(style);
            
            // Efecto de hover para filas
            const rows = document.querySelectorAll('.documents-table tbody tr');
            rows.forEach(row => {
                row.addEventListener('mouseenter', function() {
                    if (!this.style.backgroundColor || this.style.backgroundColor === '') {
                        this.style.backgroundColor = '#f8fafc';
                    }
                });
                
                row.addEventListener('mouseleave', function() {
                    if (!this.style.borderLeft || this.style.borderLeft === '') {
                        this.style.backgroundColor = '';
                    }
                });
            });
            
            // Validar tamaño de archivo
            const fileInputs = document.querySelectorAll('input[type="file"]');
            fileInputs.forEach(input => {
                input.addEventListener('change', function() {
                    const maxSize = 10 * 1024 * 1024; // 10MB
                    if (this.files[0] && this.files[0].size > maxSize) {
                        showToast('El archivo es demasiado grande. Máximo 10MB.', 'error');
                        this.value = '';
                        const fileSelected = document.getElementById('file-selected-' + this.id);
                        if (fileSelected) {
                            fileSelected.style.display = 'none';
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>