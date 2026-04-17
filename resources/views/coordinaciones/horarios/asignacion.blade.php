<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asignar Horario - {{ $maestro->nombre_completo }} | GEPROC</title>
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
            /* Colores para materias */
            --materia-color-1: #1a4cba;
            --materia-color-2: #dc3545;
            --materia-color-3: #fd7e14;
            --materia-color-4: #ffc107;
            --materia-color-5: #17a2b8;
            --materia-color-6: #6c757d;
            --materia-color-7: #198754;
            --materia-color-8: #8b5cf6;
            /* Tabla */
            --table-header-bg: #2c3e50;
            --table-header-text: #ffffff;
            --table-time-col-bg: #34495e;
            --table-time-col-text: #ffffff;
            --table-cell-occupied-bg: #e8f0fe;
            --table-cell-occupied-border: #0744b6ff;
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

        /* BREADCRUMB */
        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            flex-wrap: wrap;
        }

        .breadcrumb a {
            color: var(--text-muted);
            text-decoration: none;
            transition: var(--transition);
        }

        .breadcrumb a:hover {
            color: var(--primary);
        }

        .breadcrumb i {
            font-size: 12px;
            color: var(--text-muted);
        }

        .breadcrumb .active {
            color: var(--primary);
            font-weight: 600;
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

        /* SELECTOR DE PERÍODO */
        .periodo-selector {
            background-color: var(--light-bg);
            border-radius: 12px;
            padding: 15px 20px;
            margin-bottom: 20px;
        }

        .periodo-selector label {
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 8px;
            display: block;
        }

        .periodo-selector select {
            width: 100%;
            max-width: 350px;
            padding: 12px 16px;
            border: 2px solid var(--border-color);
            border-radius: 10px;
            font-size: 14px;
            transition: var(--transition);
        }

        .periodo-selector select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(7, 68, 182, 0.1);
        }

        /* MENSAJE SIN PERÍODO */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            background-color: var(--light-bg);
            border-radius: 12px;
        }

        .empty-state i {
            font-size: 64px;
            color: var(--text-muted);
            opacity: 0.5;
            margin-bottom: 15px;
        }

        .empty-state h5 {
            font-size: 18px;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 8px;
        }

        .empty-state p {
            color: var(--text-muted);
        }

        /* FORMULARIO DE MATERIAS */
        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 8px;
        }

        .form-group label i {
            color: var(--primary);
        }

        .input-group-custom {
            display: flex;
            gap: 10px;
        }

        .input-group-custom input {
            flex: 1;
            padding: 12px 16px;
            border: 2px solid var(--border-color);
            border-radius: 10px;
            font-size: 14px;
            transition: var(--transition);
        }

        .input-group-custom input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(7, 68, 182, 0.1);
        }

        /* CONFIGURACIÓN AULA/GRUPO */
        .config-box {
            background-color: var(--light-bg);
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .config-box h6 {
            font-size: 16px;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .config-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 15px;
        }

        .config-grid input {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid var(--border-color);
            border-radius: 10px;
            font-size: 14px;
            transition: var(--transition);
        }

        .config-grid input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(7, 68, 182, 0.1);
        }

        /* LISTA DE MATERIAS */
        .materias-list {
            max-height: 200px;
            overflow-y: auto;
        }

        .materia-item {
            background-color: var(--light-bg);
            border-radius: 10px;
            padding: 12px 15px;
            margin-bottom: 8px;
            cursor: pointer;
            transition: var(--transition);
            border: 2px solid transparent;
        }

        .materia-item:hover {
            transform: translateX(5px);
            background-color: #eef2f7;
        }

        .materia-item.materia-seleccionada {
            border-color: var(--primary);
            background-color: var(--primary-soft);
        }

        .materia-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .materia-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            color: white;
        }

        .materia-badge.color-1 { background: var(--materia-color-1); }
        .materia-badge.color-2 { background: var(--materia-color-2); }
        .materia-badge.color-3 { background: var(--materia-color-3); }
        .materia-badge.color-4 { background: var(--materia-color-4); color: #333; }
        .materia-badge.color-5 { background: var(--materia-color-5); }
        .materia-badge.color-6 { background: var(--materia-color-6); }
        .materia-badge.color-7 { background: var(--materia-color-7); }
        .materia-badge.color-8 { background: var(--materia-color-8); }

        .materia-nombre {
            font-weight: 600;
            color: #2d3748;
        }

        .materia-horas {
            font-size: 12px;
            color: var(--text-muted);
        }

        .btn-eliminar-materia {
            background: transparent;
            border: none;
            color: var(--danger-color);
            cursor: pointer;
            padding: 5px;
            border-radius: 5px;
            transition: var(--transition);
        }

        .btn-eliminar-materia:hover {
            background-color: var(--danger-light);
            transform: scale(1.1);
        }

        /* TABLA DE HORARIOS */
        .table-container {
            overflow-x: auto;
        }

        .horarios-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }

        .horarios-table th {
            background: var(--table-header-bg);
            color: var(--table-header-text);
            padding: 12px 8px;
            text-align: center;
            font-weight: 600;
            border: 1px solid var(--border-color);
        }

        .horarios-table td {
            border: 1px solid var(--border-color);
            padding: 8px 4px;
            vertical-align: middle;
            text-align: center;
            min-height: 65px;
            height: 65px;
        }

        .horarios-table td:first-child {
            background: var(--table-time-col-bg);
            color: var(--table-time-col-text);
            font-weight: 600;
            text-align: center;
        }

        .hora-cell {
            cursor: pointer;
            transition: var(--transition);
            position: relative;
        }

        .hora-cell.vacia {
            background-color: white;
        }

        .hora-cell.vacia:hover {
            background-color: var(--primary-soft);
        }

        .hora-cell.ocupada {
            background-color: var(--table-cell-occupied-bg);
            border: 2px solid var(--table-cell-occupied-border) !important;
            position: relative;
        }

        .hora-cell.ocupada:hover {
            background-color: #e1f0fd;
        }

        .celda-contenido {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 40px;
        }

        .btn-eliminar-celda {
            position: absolute;
            top: -8px;
            right: -8px;
            width: 22px;
            height: 22px;
            background: var(--danger-color);
            color: white;
            border: none;
            border-radius: 50%;
            font-size: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            opacity: 0;
            transition: opacity 0.2s ease;
            z-index: 10;
        }

        .hora-cell.ocupada:hover .btn-eliminar-celda {
            opacity: 1;
        }

        .btn-eliminar-celda:hover {
            transform: scale(1.15);
        }

        /* RESULTADO DE HORAS */
        .horas-resumen {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
            gap: 15px;
            text-align: center;
        }

        .hora-dia-card {
            background-color: var(--light-bg);
            border-radius: 10px;
            padding: 12px;
        }

        .hora-dia-card small {
            display: block;
            color: var(--text-muted);
            font-size: 12px;
            margin-bottom: 5px;
        }

        .hora-dia-card .horas-totales {
            font-size: 24px;
            font-weight: 700;
            color: var(--primary);
        }

        .total-semanal {
            background: var(--gradient-primary);
            color: white;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
        }

        .total-semanal small {
            display: block;
            font-size: 12px;
            opacity: 0.9;
        }

        .total-semanal .total-number {
            font-size: 32px;
            font-weight: 800;
        }

        /* BOTONES */
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

        .btn-clear {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            background: transparent;
            color: var(--danger-color);
            border: 2px solid var(--danger-color);
            border-radius: 10px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: var(--transition);
        }

        .btn-clear:hover {
            background-color: var(--danger-color);
            color: white;
            transform: translateY(-2px);
        }

        .btn-save {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 32px;
            background: var(--gradient-success);
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: 700;
            font-size: 15px;
            cursor: pointer;
            transition: var(--transition);
        }

        .btn-save:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(16, 185, 129, 0.3);
        }

        .btn-primary-custom {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            background: var(--gradient-primary);
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: var(--transition);
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(7, 68, 182, 0.3);
        }

        /* SECCIÓN DE ARCHIVO */
        .file-section {
            background-color: var(--light-bg);
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .file-section h6 {
            font-size: 16px;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .file-upload {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            align-items: flex-start;
        }

        .file-upload input {
            flex: 1;
            padding: 10px;
            border: 2px solid var(--border-color);
            border-radius: 10px;
            font-size: 14px;
        }

        .current-file {
            margin-top: 15px;
            padding: 15px;
            background: white;
            border-radius: 10px;
            border: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
        }

        .file-actions {
            display: flex;
            gap: 8px;
        }

        /* ALERTAS */
        .alert-floating {
            position: fixed;
            top: 100px;
            right: 20px;
            padding: 15px 20px;
            background-color: white;
            border-left: 4px solid var(--success-color);
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            z-index: 1000;
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
            .config-grid {
                grid-template-columns: 1fr;
            }
            
            .horas-resumen {
                grid-template-columns: repeat(2, 1fr);
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
            
            .horas-resumen {
                grid-template-columns: 1fr;
            }
            
            .action-buttons {
                flex-direction: column;
            }
            
            .btn-back, .btn-clear, .btn-save {
                width: 100%;
                justify-content: center;
            }
            
            .file-upload {
                flex-direction: column;
            }
            
            .file-upload button {
                width: 100%;
            }
        }
    </style>
</head>
<body>

@php
    use Illuminate\Support\Facades\Auth;
    use App\Models\Coordinacion;
    use Illuminate\Support\Facades\Storage;
    
    $user = Auth::user();
    $coordinacion = $user->coordinaciones_id ? Coordinacion::find($user->coordinaciones_id) : null;
    
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

    $fotoActual = null;
    $fotoUrl = null;
    if (isset($periodoId) && $periodoId) {
        $horarioExistente = \App\Models\Horario::where('maestro_id', $maestro->id)
            ->where('periodo_id', $periodoId)
            ->whereNotNull('horario_foto')
            ->first();
        if ($horarioExistente && $horarioExistente->horario_foto) {
            $fotoActual = $horarioExistente->horario_foto;
            $fotoUrl = Storage::url($fotoActual);
        }
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
            <span class="active">Asignar Horario</span>
        </div>

        <!-- HEADER -->
        <div class="content-header">
            <h1>Asignar Horario</h1>
            <p><i class="fas fa-calendar-alt" style="color: var(--primary); margin-right: 8px;"></i>{{ $maestro->nombres ?? '' }} {{ $maestro->apellido_paterno ?? '' }} {{ $maestro->apellido_materno ?? '' }}</p>
        </div>

        <!-- FORMULARIO PRINCIPAL -->
        <div class="section">
            <form action="{{ route('horarios.save') }}" method="POST" id="formHorario" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="maestro_id" value="{{ $maestro->id }}">

                <!-- SELECTOR DE PERÍODO -->
                <div class="periodo-selector">
                    <label><i class="fas fa-calendar-alt"></i> Seleccionar Período</label>
                    <select name="periodo_id" id="periodo_id" required>
                        <option value="">Seleccionar Período</option>
                        @foreach($periodos as $periodo)
                            <option value="{{ $periodo->id }}" 
                                {{ ($periodoId ?? '') == $periodo->id ? 'selected' : '' }}>
                                {{ $periodo->nombre }}
                                @if(in_array($periodo->id, $periodosConHorario ?? []))
                                    (Con horario asignado)
                                @endif
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- MENSAJE SIN PERÍODO -->
                <div id="sin-periodo" style="display: {{ $periodoId ? 'none' : 'block' }};">
                    <div class="empty-state">
                        <i class="fas fa-calendar-plus"></i>
                        <h5>Primero selecciona un período académico</h5>
                        <p>Selecciona un período de la lista para comenzar a ingresar el horario.</p>
                    </div>
                </div>

                <!-- CONTENIDO CON PERÍODO -->
                <div id="con-periodo" style="display: {{ $periodoId ? 'block' : 'none' }};">
                    <!-- Agregar Materias -->
                    <div class="section-header">
                        <div class="section-title">
                            <i class="fas fa-book"></i>
                            <span>Agregar Materias</span>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="input-group-custom">
                            <input type="text" id="input-nueva-materia" placeholder="Nombre de la materia...">
                            <button type="button" class="btn-primary-custom" id="btn-agregar-materia">
                                <i class="fas fa-plus"></i> Agregar
                            </button>
                        </div>
                        <small class="text-muted">Escribe materias y luego selecciona en las celdas del horario</small>
                    </div>

                    <!-- Configuración Aula y Grupo -->
                    <div class="config-box">
                        <h6><i class="fas fa-school"></i> Aula y Grupo</h6>
                        <div class="config-grid">
                            <input type="text" id="aula-global" placeholder="Aula (Ej: AULA Tlaxcala)">
                            <input type="text" id="grupo-global" placeholder="Grupo (Ej: GRUPO A)">
                        </div>
                    </div>

                    <!-- Lista de Materias -->
                    <div class="section-header">
                        <div class="section-title">
                            <i class="fas fa-list-check"></i>
                            <span>Materias Agregadas</span>
                        </div>
                        <span class="badge" id="contador-materias" style="background: var(--primary); color: white; padding: 5px 12px;">0</span>
                    </div>
                    
                    <div id="lista-materias" class="materias-list">
                        <div class="empty-state" style="padding: 30px;">
                            <i class="fas fa-book-open"></i>
                            <p>No hay materias agregadas.</p>
                        </div>
                    </div>

                    <!-- Tabla de Horarios -->
                    <div class="section-header" style="margin-top: 25px;">
                        <div class="section-title">
                            <i class="fas fa-table"></i>
                            <span>Distribución Horaria Semanal</span>
                        </div>
                        <span class="badge" id="contador-clases" style="background: var(--success-color); color: white; padding: 5px 12px;">0 clases</span>
                    </div>

                    <div class="table-container">
                        <table class="horarios-table">
                            <thead>
                                <tr>
                                    <th style="width: 15%">Horario</th>
                                    <th style="width: 17%">Lunes</th>
                                    <th style="width: 17%">Martes</th>
                                    <th style="width: 17%">Miércoles</th>
                                    <th style="width: 17%">Jueves</th>
                                    <th style="width: 17%">Viernes</th>
                                </tr>
                            </thead>
                            <tbody id="tabla-horarios-body">
                                @php
                                    $horasDisponibles = ['7-8', '8-9', '9-10', '10-11', '11-12', '12-13', '13-14', '14-15', '15-16', '16-17', '17-18'];
                                    $diasSemana = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes'];
                                @endphp

                                @foreach($horasDisponibles as $hora)
                                    <tr>
                                        <td class="fw-bold text-center">
                                            {{ $hora }}
                                        </td>
                                        @foreach($diasSemana as $dia)
                                            <td class="hora-cell vacia" 
                                                data-hora="{{ $hora }}" 
                                                data-dia="{{ $dia }}"
                                                id="celda-{{ $dia }}-{{ $hora }}"
                                                onclick="asignarMateriaACelda(this)">
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Resumen de Horas -->
                    <div class="section-header" style="margin-top: 25px;">
                        <div class="section-title">
                            <i class="fas fa-chart-bar"></i>
                            <span>Resumen de Horas por Día</span>
                        </div>
                    </div>

                    <div class="horas-resumen">
                        <div class="hora-dia-card">
                            <small>Lunes</small>
                            <div class="horas-totales" id="horas-lunes">0</div>
                        </div>
                        <div class="hora-dia-card">
                            <small>Martes</small>
                            <div class="horas-totales" id="horas-martes">0</div>
                        </div>
                        <div class="hora-dia-card">
                            <small>Miércoles</small>
                            <div class="horas-totales" id="horas-miercoles">0</div>
                        </div>
                        <div class="hora-dia-card">
                            <small>Jueves</small>
                            <div class="horas-totales" id="horas-jueves">0</div>
                        </div>
                        <div class="hora-dia-card">
                            <small>Viernes</small>
                            <div class="horas-totales" id="horas-viernes">0</div>
                        </div>
                    </div>

                    <div class="total-semanal" style="margin-top: 15px;">
                        <small>Total Semanal de Horas Clase</small>
                        <div class="total-number" id="total-semanal">0</div>
                    </div>

                    <!-- Sección de Archivo del Nombramiento -->
                    <div class="file-section" style="margin-top: 25px;">
                        <h6><i class="fas fa-file-alt"></i> Archivo del Nombramiento</h6>
                        
                        <div class="file-upload">
                            <input type="file" name="horario_foto" id="horario_foto" accept=".jpg,.jpeg,.png,.pdf,.xlsx,.xls,.csv,.doc,.docx">
                            <input type="hidden" name="accion_foto" id="accion_foto" value="">
                            <button type="submit" name="subir_foto" class="btn-primary-custom" onclick="document.getElementById('accion_foto').value='subir'">
                                <i class="fas fa-upload"></i> Subir archivo
                            </button>
                        </div>
                        <small class="text-muted">Formatos: JPG, PNG, PDF, Excel, Word. Máximo 5MB</small>

                        @if($fotoActual && $fotoUrl)
                        <div class="current-file">
                            <div>
                                <i class="fas fa-file-pdf"></i>
                                <strong>Archivo actual:</strong> {{ basename($fotoActual) }}
                            </div>
                            <div class="file-actions">
                                <a href="{{ route('horarios.ver-foto', ['maestroId' => $maestro->id, 'periodoId' => $periodoId]) }}" class="btn-primary-custom" style="padding: 6px 12px; font-size: 12px;" target="_blank">
                                    <i class="fas fa-eye"></i> Ver
                                </a>
                                <a href="{{ route('horarios.ver-foto', ['maestroId' => $maestro->id, 'periodoId' => $periodoId]) }}?download=1" class="btn-primary-custom" style="padding: 6px 12px; font-size: 12px; background: var(--gradient-success);">
                                    <i class="fas fa-download"></i> Descargar
                                </a>
                                <form action="{{ route('horarios.save') }}" method="POST" style="display:inline;">
                                    @csrf
                                    <input type="hidden" name="maestro_id" value="{{ $maestro->id }}">
                                    <input type="hidden" name="periodo_id" value="{{ $periodoId }}">
                                    <input type="hidden" name="eliminar_foto" value="1">
                                    <button type="submit" class="btn-clear" style="padding: 6px 12px; font-size: 12px;" onclick="return confirm('¿Eliminar el archivo?')">
                                        <i class="fas fa-trash"></i> Eliminar
                                    </button>
                                </form>
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- Campos ocultos -->
                    <div id="hidden-fields-container"></div>
                </div>

                <!-- Botones de acción -->
                <div class="action-buttons" style="margin-top: 25px;">
                    <a href="{{ route('coordinaciones.maestros-detalle') }}" class="btn-back">
                        <i class="fas fa-arrow-left"></i> Volver a la lista
                    </a>
                    <button type="button" id="btn-limpiar-todo" class="btn-clear">
                        <i class="fas fa-trash-alt"></i> Limpiar Todo
                    </button>
                    <button type="submit" id="btn-guardar" class="btn-save">
                        <i class="fas fa-save"></i> Guardar Horario
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ALERTA FLOTANTE -->
<div id="alertMessage" class="alert-floating"></div>

<script>
    // ========== VARIABLES GLOBALES ==========
    let materiasSeleccionadas = [];
    let horariosSeleccionados = [];
    let siguienteColor = 1;
    let siguienteId = 1;
    let materiaActiva = null;

    // ========== DATOS INICIALES DESDE PHP ==========
    @if(isset($periodoId) && $periodoId)
        @if(isset($materias) && count($materias) > 0)
            materiasSeleccionadas = @json(array_values($materias));
            console.log('✅ Materias cargadas:', materiasSeleccionadas.length);
            
            if (materiasSeleccionadas.length > 0) {
                siguienteId = Math.max(...materiasSeleccionadas.map(m => m.id || 0)) + 1;
                siguienteColor = (Math.max(...materiasSeleccionadas.map(m => m.color || 0)) % 8) + 1;
            }
        @endif
        
        @if(isset($horariosAgrupados) && count($horariosAgrupados) > 0)
            horariosSeleccionados = @json($horariosAgrupados);
            console.log('✅ Horarios cargados:', horariosSeleccionados.length);
        @endif
    @endif

    // ========== FUNCIONES ==========
    function mostrarAlerta(mensaje, tipo = 'success') {
        const alertDiv = document.getElementById('alertMessage');
        alertDiv.textContent = mensaje;
        alertDiv.style.borderLeftColor = tipo === 'success' ? '#10b981' : (tipo === 'warning' ? '#f59e0b' : '#ef4444');
        alertDiv.style.display = 'block';
        
        setTimeout(() => {
            alertDiv.style.display = 'none';
        }, 3000);
    }

    function getColorHex(colorIndex) {
        const colores = ['#1a4cba', '#dc3545', '#fd7e14', '#ffc107', '#17a2b8', '#6c757d', '#198754', '#8b5cf6'];
        return colores[colorIndex - 1] || '#1a4cba';
    }

    function actualizarTablaDesdeDatos() {
        console.log('🔄 Actualizando tabla...');
        
        document.querySelectorAll('.hora-cell').forEach(celda => {
            celda.innerHTML = '';
            celda.classList.remove('ocupada', 'celda-con-materia');
            celda.classList.add('vacia');
            celda.title = '';
        });
        
        horariosSeleccionados.forEach(horario => {
            const celdaId = `celda-${horario.dia}-${horario.horario}`;
            const celda = document.getElementById(celdaId);
            
            if (celda) {
                const materia = materiasSeleccionadas.find(m => m.nombre === horario.materia_nombre);
                if (materia) {
                    celda.innerHTML = `
                        <div class="celda-contenido">
                            <span class="materia-badge color-${materia.color}">${materia.nombre.substring(0,12)}</span>
                            <button type="button" class="btn-eliminar-celda" onclick="event.stopPropagation(); eliminarHorarioCelda('${horario.dia}', '${horario.horario}')">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    `;
                    celda.classList.remove('vacia');
                    celda.classList.add('ocupada', 'celda-con-materia');
                    celda.title = `${materia.nombre} - ${horario.dia} ${horario.horario}`;
                } else {
                    celda.innerHTML = `
                        <div class="celda-contenido">
                            <span class="materia-badge color-1">${horario.materia_nombre.substring(0,12)}</span>
                            <button type="button" class="btn-eliminar-celda" onclick="event.stopPropagation(); eliminarHorarioCelda('${horario.dia}', '${horario.horario}')">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    `;
                    celda.classList.remove('vacia');
                    celda.classList.add('ocupada', 'celda-con-materia');
                }
            }
        });
        
        actualizarContadorClases();
        console.log(`✅ Tabla actualizada: ${horariosSeleccionados.length} clases`);
    }

    function eliminarHorarioCelda(dia, horario) {
        event.stopPropagation();
        
        if (!confirm(`¿Eliminar la clase de ${dia} ${horario}?`)) return;
        
        horariosSeleccionados = horariosSeleccionados.filter(h => 
            !(h.dia === dia && h.horario === horario)
        );
        
        const celdaId = `celda-${dia}-${horario}`;
        const celda = document.getElementById(celdaId);
        if (celda) {
            celda.innerHTML = '';
            celda.classList.remove('ocupada', 'celda-con-materia');
            celda.classList.add('vacia');
        }
        
        actualizarResumenHoras();
        actualizarCamposOcultos();
        actualizarContadorClases();
        actualizarListaMaterias();
        
        mostrarAlerta(`🗑️ Clase eliminada de ${dia} ${horario}`, 'success');
    }

    function actualizarContadorClases() {
        const contador = document.getElementById('contador-clases');
        if (contador) {
            contador.textContent = `${horariosSeleccionados.length} clases`;
        }
    }

    function actualizarListaMaterias() {
        const listaContainer = document.getElementById('lista-materias');
        const contador = document.getElementById('contador-materias');
        
        contador.textContent = materiasSeleccionadas.length;
        
        if (materiasSeleccionadas.length === 0) {
            listaContainer.innerHTML = `<div class="empty-state" style="padding: 30px;"><i class="fas fa-book-open"></i><p>No hay materias agregadas.</p></div>`;
            materiaActiva = null;
            return;
        }
        
        listaContainer.innerHTML = '';
        
        materiasSeleccionadas.forEach((materia) => {
            const esActiva = materiaActiva && materiaActiva.id === materia.id;
            const horariosMateria = horariosSeleccionados.filter(h => h.materia_nombre === materia.nombre).length;
            
            const div = document.createElement('div');
            div.className = `materia-item ${esActiva ? 'materia-seleccionada' : ''}`;
            div.style.borderLeft = `4px solid ${getColorHex(materia.color)}`;
            div.style.marginBottom = '8px';
            div.onclick = () => seleccionarMateria(materia.id);
            
            div.innerHTML = `
                <div class="materia-info">
                    <div>
                        <span class="materia-badge color-${materia.color}">${materia.nombre.substring(0,3).toUpperCase()}</span>
                        <span class="materia-nombre">${materia.nombre}</span>
                        <div class="materia-horas">${horariosMateria} hora(s) asignada(s)</div>
                    </div>
                    <button type="button" class="btn-eliminar-materia" title="Eliminar materia">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            `;
            
            div.querySelector('.btn-eliminar-materia').addEventListener('click', (e) => {
                e.stopPropagation();
                eliminarMateria(materia.id);
            });
            
            listaContainer.appendChild(div);
        });
    }

    function seleccionarMateria(materiaId) {
        materiaActiva = materiasSeleccionadas.find(m => m.id === materiaId);
        if (!materiaActiva) return;
        
        actualizarListaMaterias();
        mostrarAlerta(`🔵 Materia "<strong>${materiaActiva.nombre}</strong>" seleccionada`, 'info');
    }

    function eliminarMateria(materiaId) {
        const materia = materiasSeleccionadas.find(m => m.id === materiaId);
        const horariosMateria = horariosSeleccionados.filter(h => h.materia_nombre === materia.nombre).length;
        
        if (!confirm(`¿Eliminar "${materia.nombre}"? Se eliminarán ${horariosMateria} horario(s).`)) return;
        
        materiasSeleccionadas = materiasSeleccionadas.filter(m => m.id !== materiaId);
        if (materiaActiva && materiaActiva.id === materiaId) materiaActiva = null;
        
        horariosSeleccionados = horariosSeleccionados.filter(h => h.materia_nombre !== materia.nombre);
        
        actualizarTablaDesdeDatos();
        actualizarListaMaterias();
        actualizarResumenHoras();
        actualizarCamposOcultos();
        
        mostrarAlerta(`🗑️ "${materia.nombre}" eliminada`, 'success');
    }

    function actualizarResumenHoras() {
        const horasPorDia = { 'Lunes': 0, 'Martes': 0, 'Miércoles': 0, 'Jueves': 0, 'Viernes': 0 };
        
        horariosSeleccionados.forEach(h => { 
            if(horasPorDia[h.dia] !== undefined) horasPorDia[h.dia]++; 
        });
        
        document.getElementById('horas-lunes').textContent = horasPorDia['Lunes'];
        document.getElementById('horas-martes').textContent = horasPorDia['Martes'];
        document.getElementById('horas-miercoles').textContent = horasPorDia['Miércoles'];
        document.getElementById('horas-jueves').textContent = horasPorDia['Jueves'];
        document.getElementById('horas-viernes').textContent = horasPorDia['Viernes'];
        
        const totalHoras = Object.values(horasPorDia).reduce((a,b) => a+b, 0);
        document.getElementById('total-semanal').textContent = totalHoras;
    }

    function actualizarCamposOcultos() {
        const container = document.getElementById('hidden-fields-container');
        container.innerHTML = '';
        
        horariosSeleccionados.forEach((h, i) => {
            container.innerHTML += `
                <input type="hidden" name="clases[${i}][materia_nombre]" value="${h.materia_nombre.replace(/'/g, "&apos;")}">
                <input type="hidden" name="clases[${i}][dia]" value="${h.dia}">
                <input type="hidden" name="clases[${i}][horario]" value="${h.horario}">
                <input type="hidden" name="clases[${i}][aula]" value="${h.aula || ''}">
                <input type="hidden" name="clases[${i}][grupo]" value="${h.grupo || ''}">
            `;
        });
    }

    function asignarMateriaACelda(celda) {
        if (!materiaActiva) {
            mostrarAlerta('⚠️ Selecciona una materia primero', 'warning');
            return;
        }
        
        const dia = celda.dataset.dia;
        const horario = celda.dataset.hora;
        
        const tieneMateria = celda.classList.contains('ocupada');
        if (tieneMateria) {
            if (!confirm(`¿Reemplazar en ${dia} ${horario}?`)) return;
            horariosSeleccionados = horariosSeleccionados.filter(h => 
                !(h.dia === dia && h.horario === horario)
            );
        }
        
        celda.innerHTML = `
            <div class="celda-contenido">
                <span class="materia-badge color-${materiaActiva.color}">${materiaActiva.nombre.substring(0,12)}</span>
                <button type="button" class="btn-eliminar-celda" onclick="event.stopPropagation(); eliminarHorarioCelda('${dia}', '${horario}')">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;
        celda.classList.remove('vacia');
        celda.classList.add('ocupada', 'celda-con-materia');
        celda.title = `${materiaActiva.nombre} - ${dia} ${horario}`;
        
        horariosSeleccionados.push({
            materia_nombre: materiaActiva.nombre,
            dia: dia,
            horario: horario,
            aula: document.getElementById('aula-global').value || '',
            grupo: document.getElementById('grupo-global').value || ''
        });
        
        actualizarResumenHoras();
        actualizarCamposOcultos();
        actualizarContadorClases();
        actualizarListaMaterias();
        
        mostrarAlerta(`✅ "${materiaActiva.nombre}" asignada a ${dia} ${horario}`, 'success');
    }

    // ========== EVENT LISTENERS ==========
    document.getElementById('btn-agregar-materia').addEventListener('click', function() {
        const input = document.getElementById('input-nueva-materia');
        const nombreMateria = input.value.trim();
        
        if (!nombreMateria) {
            mostrarAlerta('⚠️ Escribe un nombre', 'warning');
            return;
        }
        
        if (materiasSeleccionadas.some(m => m.nombre.toLowerCase() === nombreMateria.toLowerCase())) {
            mostrarAlerta('❌ Ya existe', 'danger');
            input.value = '';
            return;
        }
        
        const nuevaMateria = {
            id: siguienteId++,
            nombre: nombreMateria,
            color: siguienteColor
        };
        
        siguienteColor = (siguienteColor % 8) + 1;
        materiasSeleccionadas.push(nuevaMateria);
        materiaActiva = nuevaMateria;
        
        input.value = '';
        actualizarListaMaterias();
        mostrarAlerta(`✅ "${nombreMateria}" agregada`, 'success');
    });

    document.getElementById('input-nueva-materia').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            document.getElementById('btn-agregar-materia').click();
        }
    });

    document.getElementById('btn-limpiar-todo').addEventListener('click', function() {
        if (!confirm('¿Limpiar todas las materias y horarios? Esta acción no se puede deshacer.')) return;
        
        materiasSeleccionadas = [];
        horariosSeleccionados = [];
        siguienteColor = 1;
        siguienteId = 1;
        materiaActiva = null;
        
        document.getElementById('aula-global').value = '';
        document.getElementById('grupo-global').value = '';
        
        actualizarTablaDesdeDatos();
        actualizarListaMaterias();
        actualizarResumenHoras();
        actualizarCamposOcultos();
        
        mostrarAlerta('🧹 Todos los datos han sido limpiados', 'success');
    });

    document.getElementById('periodo_id').addEventListener('change', function() {
        const periodoId = this.value;
        
        if (periodoId) {
            const url = new URL(window.location.href);
            url.searchParams.set('periodo_id', periodoId);
            window.location.href = url.toString();
        } else {
            const url = new URL(window.location.href);
            url.searchParams.delete('periodo_id');
            window.location.href = url.toString();
        }
    });

    document.getElementById('formHorario').addEventListener('submit', function(e) {
        const periodoId = document.getElementById('periodo_id').value;
        const accionFoto = document.getElementById('accion_foto').value;
        const submitter = document.activeElement;
        
        if (!periodoId) {
            e.preventDefault();
            mostrarAlerta('⚠️ Debes seleccionar un periodo académico', 'danger');
            return false;
        }
        
        if (accionFoto === 'subir' || (submitter && submitter.name === 'subir_foto')) {
            return true;
        }
        
        if (materiasSeleccionadas.length === 0) {
            e.preventDefault();
            mostrarAlerta('⚠️ Debes agregar al menos una materia', 'danger');
            return false;
        }
        
        if (horariosSeleccionados.length === 0) {
            e.preventDefault();
            mostrarAlerta('⚠️ Debes asignar al menos un horario', 'danger');
            return false;
        }
        
        if (!confirm(`¿Guardar el horario con ${materiasSeleccionadas.length} materias y ${horariosSeleccionados.length} horario(s)?`)) {
            e.preventDefault();
            return false;
        }
        
        return true;
    });

    // ========== INICIALIZACIÓN ==========
    document.addEventListener('DOMContentLoaded', function() {
        console.log('📱 Sistema inicializado');
        
        actualizarTablaDesdeDatos();
        actualizarListaMaterias();
        actualizarResumenHoras();
        actualizarCamposOcultos();
    });

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