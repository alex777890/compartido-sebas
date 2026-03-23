<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
    <title>Grados Académicos - Sistema GEPROC</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
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
            --card-shadow: 0 5px 20px rgba(7, 68, 182, 0.08);
            --card-shadow-hover: 0 10px 30px rgba(7, 68, 182, 0.12);
            --transition: all 0.3s ease;
            --success-color: #10b981;
            --danger-color: #ef4444;
            
            --green-color: #10b981;
            --green-light: #d1fae5;
            --green-dark: #059669;
            
            --blue-color: #3b82f6;
            --blue-light: #dbeafe;
            --blue-dark: #2563eb;
            
            --orange-color: #f97316;
            --orange-light: #ffedd5;
            --orange-dark: #ea580c;
            
            --delete-color: #3b82f6;
            --delete-light: #dbeafe;
            --delete-dark: #2563eb;
            --delete-gradient: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            
            --border-radius: 12px;
            --sidebar-width: 280px;
            --header-height: 80px;
            --gradient-primary: linear-gradient(135deg, #0744b6ff 0%, #3a6bd3 100%);
            --gradient-success: linear-gradient(135deg, #10b981 0%, #34d399 100%);
            --gradient-warning: linear-gradient(135deg, #f59e0b 0%, #fbbf24 100%);
            --gradient-danger: linear-gradient(135deg, #ef4444 0%, #f87171 100%);
            --gradient-info: linear-gradient(135deg, #3b82f6 0%, #60a5fa 100%);
            --gradient-purple: linear-gradient(135deg, #8b5cf6 0%, #a78bfa 100%);
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

        /* ===== PRIMERA BARRA (HEADER SUPERIOR) - ESTILO DASHBOARD ===== */
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

        /* ===== SEGUNDA BARRA (MENÚ DE NAVEGACIÓN) - ESTILO DASHBOARD ===== */
        .navbar-menu { 
            background: var(--primary); 
            padding: 8px 0;
            position: sticky;
            top: 73px;
            z-index: 999;
        }

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
            width: 100%;
            max-width: 1400px;
            margin: 0 auto;
        }

        .content-wrapper {
            padding: 25px 20px;
        }

        /* ===== MEDIA QUERIES PARA EL MENÚ HAMBURGUESA ===== */
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
            
            .content-wrapper {
                padding: 15px;
            }
        }

        /* ===== TODOS LOS ESTILOS DEL CONTENIDO ORIGINAL (SIN MODIFICAR) ===== */
        .dashboard-card {
            background: white;
            border-radius: 16px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: var(--card-shadow);
            border: 2px solid var(--border-color);
            transition: var(--transition);
        }

        .dashboard-card:hover {
            box-shadow: var(--card-shadow-hover);
        }

        .card-header-flex {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--light-bg);
        }

        .card-title {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 22px;
            color: var(--primary);
            font-weight: 700;
            margin: 0;
        }

        .card-title i {
            font-size: 24px;
            color: var(--primary);
        }

        .header-description {
            color: var(--text-muted);
            margin-bottom: 20px;
            font-size: 14px;
            padding-bottom: 12px;
            border-bottom: 1px dashed var(--border-color);
        }

        .btn-add-grado {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 10px 22px;
            background: var(--gradient-primary);
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: var(--transition);
            box-shadow: 0 4px 12px rgba(7, 68, 182, 0.2);
            text-decoration: none;
        }

        .btn-add-grado:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(7, 68, 182, 0.3);
            color: white;
        }

        .stats-compact {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));  /* Mínimo 200px cada tarjeta */
            gap: 15px;
            margin-bottom: 25px;
        }

        .stat-card-compact {
            background: white;
            border-radius: 12px;
            padding: 15px;
            box-shadow: var(--card-shadow);
            border: 2px solid var(--border-color);
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }

        .stat-card-compact::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
        }

        .stat-card-compact:nth-child(1)::before { background: var(--gradient-primary); }
        .stat-card-compact:nth-child(2)::before { background: var(--orange-color); }
        .stat-card-compact:nth-child(3)::before { background: var(--blue-color); }
        .stat-card-compact:nth-child(4)::before { background: var(--green-color); }

        .stat-card-compact:hover {
            transform: translateY(-3px);
            box-shadow: var(--card-shadow-hover);
        }

        .stat-icon-compact {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 12px;
            font-size: 18px;
            color: white;
        }

        .stat-card-compact:nth-child(1) .stat-icon-compact { background: var(--gradient-primary); }
        .stat-card-compact:nth-child(2) .stat-icon-compact { background: var(--orange-color); }
        .stat-card-compact:nth-child(3) .stat-icon-compact { background: var(--blue-color); }
        .stat-card-compact:nth-child(4) .stat-icon-compact { background: var(--green-color); }

        .stat-value-compact {
            font-size: 28px;
            font-weight: 800;
            color: #1e293b;
            line-height: 1;
            margin-bottom: 4px;
        }

        .stat-label-compact {
            color: var(--text-muted);
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-card {
            background: white;
            border-radius: 16px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: var(--card-shadow);
            border: 2px solid var(--border-color);
            transition: var(--transition);
        }

        .form-header {
            border-bottom: 2px solid var(--light-bg);
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .form-title {
            color: var(--primary);
            font-weight: 700;
            font-size: 18px;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .form-label {
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 6px;
            font-size: 13px;
        }

        .required::after {
            content: " *";
            color: var(--orange-dark);
            font-weight: 700;
        }

        .form-control, .form-select {
            border: 2px solid var(--border-color);
            border-radius: 10px;
            padding: 10px 14px;
            font-size: 13px;
            transition: var(--transition);
            background: white;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(7, 68, 182, 0.08);
            outline: none;
        }

        .btn-success {
            background: linear-gradient(135deg, var(--green-color) 0%, var(--green-dark) 100%);
            border: none;
            padding: 10px 24px;
            font-weight: 600;
            font-size: 14px;
            border-radius: 10px;
            color: white;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(16, 185, 129, 0.25);
            color: white;
        }

        .btn-outline {
            background: white;
            border: 2px solid var(--border-color);
            color: var(--text-muted);
            padding: 10px 24px;
            font-weight: 600;
            font-size: 14px;
            border-radius: 10px;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-outline:hover {
            background: var(--light-bg);
            border-color: var(--primary);
            color: var(--primary);
            transform: translateY(-2px);
        }

        .file-preview {
            background: var(--green-light);
            border: 2px solid var(--green-color);
            border-radius: 8px;
            padding: 8px 12px;
            margin-top: 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            animation: slideIn 0.3s ease;
            color: var(--green-dark);
            font-weight: 600;
            font-size: 12px;
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

        .btn-outline-light {
            background: white;
            border: 1.5px solid var(--green-light);
            color: var(--green-dark);
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 11px;
            transition: var(--transition);
            font-weight: 600;
        }

        .grados-container {
            margin-top: 25px;
            padding-top: 20px;
            border-top: 2px solid var(--light-bg);
        }

        .section-title {
            font-size: 18px;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .grados-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 18px;
        }

        .grado-card-compact {
            background: white;
            border-radius: 12px;
            padding: 16px;
            box-shadow: var(--card-shadow);
            border: 2px solid var(--border-color);
            border-left: 4px solid;
            transition: var(--transition);
        }

        .grado-card-compact[data-nivel="Doctorado"] { border-left-color: var(--orange-color); }
        .grado-card-compact[data-nivel="Maestría"] { border-left-color: var(--blue-color); }
        .grado-card-compact[data-nivel="Especialidad"],
        .grado-card-compact[data-nivel="Licenciatura"] { border-left-color: var(--green-color); }

        .grado-card-compact:hover {
            transform: translateY(-2px);
            box-shadow: var(--card-shadow-hover);
        }

        .grado-header-compact {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 10px;
            flex-wrap: wrap;
            gap: 8px;
        }

        .grado-title-compact {
            font-weight: 700;
            color: #1e293b;
            font-size: 15px;
            margin-bottom: 4px;
            line-height: 1.3;
        }

        .grado-nivel-compact {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 50px;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .grado-card-compact[data-nivel="Doctorado"] .grado-nivel-compact {
            background: var(--orange-light);
            color: var(--orange-dark);
        }
        
        .grado-card-compact[data-nivel="Maestría"] .grado-nivel-compact {
            background: var(--blue-light);
            color: var(--blue-dark);
        }
        
        .grado-card-compact[data-nivel="Especialidad"] .grado-nivel-compact,
        .grado-card-compact[data-nivel="Licenciatura"] .grado-nivel-compact {
            background: var(--green-light);
            color: var(--green-dark);
        }

        .action-buttons-compact {
            display: flex;
            gap: 6px;
        }

        .btn-action-sm {
            padding: 6px 12px;
            font-size: 12px;
            border-radius: 6px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: var(--transition);
            font-weight: 600;
            border: none;
            cursor: pointer;
            text-decoration: none;
        }

        .btn-action-sm.btn-outline {
            background: white;
            border: 1.5px solid var(--border-color);
            color: var(--text-muted);
        }

        .btn-action-sm.btn-outline:hover {
            background: var(--blue-light);
            border-color: var(--blue-color);
            color: var(--blue-dark);
            transform: translateY(-1px);
        }

        .btn-action-sm.btn-delete {
            background: white;
            border: 1.5px solid var(--delete-light);
            color: var(--delete-color);
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .btn-action-sm.btn-delete::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: var(--delete-gradient);
            transition: left 0.3s ease;
            z-index: -1;
        }

        .btn-action-sm.btn-delete:hover {
            color: white;
            border-color: transparent;
            transform: translateY(-1px);
        }

        .btn-action-sm.btn-delete:hover::before {
            left: 0;
        }

        .btn-action-sm.btn-delete i {
            color: var(--delete-color);
            transition: var(--transition);
        }

        .btn-action-sm.btn-delete:hover i {
            color: white;
        }

        .grado-info-compact {
            color: #2d3748;
            font-size: 12px;
            margin-bottom: 6px;
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 2px 0;
        }

        .grado-info-compact i {
            width: 14px;
            text-align: center;
            color: var(--green-color);
            font-size: 12px;
        }

        .grado-divider {
            height: 1px;
            background: linear-gradient(to right, transparent, var(--green-light), transparent);
            margin: 10px 0 8px 0;
        }

        .text-primary {
            color: var(--green-dark) !important;
            font-weight: 600;
            text-decoration: none;
            font-size: 12px;
        }

        .empty-state {
            text-align: center;
            padding: 40px 25px;
            background: var(--light-bg);
            border-radius: 16px;
            border: 2px dashed var(--border-color);
        }

        .empty-state i {
            font-size: 48px;
            color: var(--primary);
            margin-bottom: 15px;
        }

        .empty-state h5 {
            font-size: 18px;
            margin-bottom: 8px;
        }

        .empty-state p {
            font-size: 13px;
        }

        .alert {
            padding: 12px 18px;
            border-radius: 12px;
            margin-bottom: 20px;
            display: flex;
            align-items: flex-start;
            gap: 12px;
            border-left: 4px solid;
            font-size: 13px;
            box-shadow: var(--card-shadow);
        }

        .alert-success {
            background: var(--green-light);
            border-color: var(--green-color);
            color: var(--green-dark);
        }

        .alert-danger {
            background: var(--orange-light);
            border-color: var(--orange-color);
            color: var(--orange-dark);
        }

        .modal-content {
            border-radius: 16px;
            border: none;
            box-shadow: var(--card-shadow-hover);
        }

        .modal-header {
            background: var(--gradient-primary);
            color: white;
            border-radius: 16px 16px 0 0;
            padding: 16px 20px;
            border-bottom: none;
        }

        .modal-header.bg-delete {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%) !important;
        }

        @media (max-width: 991px) {
            .stats-compact {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .card-header-flex {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .btn-add-grado {
                width: 100%;
                justify-content: center;
            }
            
            .grados-grid {
                grid-template-columns: 1fr;
            }
            
            .dashboard-card {
                padding: 18px;
            }
            
            .form-card {
                padding: 18px;
            }
            
            .btn-success, .btn-outline {
                width: 100%;
                justify-content: center;
            }
            
            .d-flex {
                flex-direction: column;
                gap: 10px;
            }
        }

        @media (max-width: 576px) {
            .stats-compact {
                grid-template-columns: 1fr;
            }
            
            .card-title {
                font-size: 18px;
            }
            
            .stat-value-compact {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <!-- PRIMERA BARRA - Logo y título (ESTILO DASHBOARD) -->
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

    <!-- SEGUNDA BARRA - Menú con información de usuario (ESTILO DASHBOARD CON HAMBURGUESA) -->
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
                        <a href="{{ route('profesor.documentos') }}" class="nav-link">
                            <i class="fas fa-folder"></i> Documentos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('maestros.grados.index') }}" class="nav-link active">
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
                        <span class="user-name">{{ $maestro->nombres ?? 'Profesor' }}</span>
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

    <!-- MAIN CONTENT - CONTENIDO ORIGINAL COMPLETO (SIN MODIFICAR) -->
    <div class="main-content">
        <div class="content-wrapper">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle"></i>
                    <div style="flex: 1;">{{ session('success') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle"></i>
                    <div style="flex: 1;">{{ session('error') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif

            <div class="dashboard-card">
                <div class="card-header-flex">
                    <div class="card-title">
                        <i class="fas fa-graduation-cap"></i> Mis Grados Académicos
                    </div>
                    <button type="button" class="btn-add-grado" id="toggleFormBtn">
                        <i class="fas fa-plus-circle"></i> Agregar Grado
                    </button>
                </div>
                <p class="header-description">Sube la información de tus grados académicos que tengas</p>
                
                @php
                    $totalGrados = $gradosAcademicos->count();
                    $doctorados = $gradosAcademicos->where('nivel', 'Doctorado')->count();
                    $maestrias = $gradosAcademicos->where('nivel', 'Maestría')->count();
                    $licenciaturas = $gradosAcademicos->where('nivel', 'Licenciatura')->count();
                    $especialidades = $gradosAcademicos->where('nivel', 'Especialidad')->count();
                @endphp
                
                <div class="stats-compact">
                    <div class="stat-card-compact">
                        <div class="stat-icon-compact">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <div class="stat-value-compact">{{ $totalGrados }}</div>
                        <div class="stat-label-compact">Total de Grados</div>
                    </div>
                    
                    <div class="stat-card-compact">
                        <div class="stat-icon-compact">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <div class="stat-value-compact">{{ $doctorados }}</div>
                        <div class="stat-label-compact">Doctorados</div>
                    </div>
                    
                    <div class="stat-card-compact">
                        <div class="stat-icon-compact">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <div class="stat-value-compact">{{ $maestrias }}</div>
                        <div class="stat-label-compact">Maestrías</div>
                    </div>
                    
                    <div class="stat-card-compact">
                        <div class="stat-icon-compact">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <div class="stat-value-compact">{{ $licenciaturas + $especialidades }}</div>
                        <div class="stat-label-compact">Lic/Esp</div>
                    </div>
                </div>

                <!-- Formulario de Agregar (oculto inicialmente) -->
                <div class="form-card" id="gradoFormContainer" style="display: none;">
                    <div class="form-header">
                        <h5 class="form-title">
                            <i class="fas fa-plus-circle"></i> Agregar Nuevo Grado Académico
                        </h5>
                    </div>
                    
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-triangle"></i>
                            <div style="flex: 1;">
                                <strong>Error en el formulario</strong>
                                <ul class="mb-0 mt-2" style="font-size: 12px;">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    @endif

                    <form action="{{ route('maestros.grados.store') }}" method="POST" enctype="multipart/form-data" id="gradoForm">
                        @csrf
                        
                        <input type="hidden" name="maestro_id" value="{{ $maestro->id ?? '' }}">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nivel" class="form-label required">Nivel Académico</label>
                                    <select name="nivel" id="nivel" class="form-select @error('nivel') is-invalid @enderror" required>
                                        <option value="">Seleccione un nivel</option>
                                        <option value="Licenciatura" {{ old('nivel') == 'Licenciatura' ? 'selected' : '' }}>Licenciatura</option>
                                        <option value="Especialidad" {{ old('nivel') == 'Especialidad' ? 'selected' : '' }}>Especialidad</option>
                                        <option value="Maestría" {{ old('nivel') == 'Maestría' ? 'selected' : '' }}>Maestría</option>
                                        <option value="Doctorado" {{ old('nivel') == 'Doctorado' ? 'selected' : '' }}>Doctorado</option>
                                    </select>
                                    @error('nivel')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="nombre_titulo" class="form-label required">Nombre del Título</label>
                                    <input type="text" name="nombre_titulo" id="nombre_titulo" 
                                           class="form-control @error('nombre_titulo') is-invalid @enderror" 
                                           value="{{ old('nombre_titulo') }}" 
                                           placeholder="Ej: Licenciado en Sistemas Computacionales" required>
                                    @error('nombre_titulo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="institucion" class="form-label">Institución Educativa</label>
                                    <input type="text" name="institucion" id="institucion" 
                                           class="form-control @error('institucion') is-invalid @enderror" 
                                           value="{{ old('institucion') }}"
                                           placeholder="Ej: Universidad Nacional Autónoma de México">
                                    @error('institucion')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="ano_obtencion" class="form-label">Año de Obtención</label>
                                    <input type="number" name="ano_obtencion" id="ano_obtencion" 
                                           class="form-control @error('ano_obtencion') is-invalid @enderror" 
                                           value="{{ old('ano_obtencion') }}" 
                                           min="1900" max="{{ date('Y') }}"
                                           placeholder="Ej: 2015">
                                    @error('ano_obtencion')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="cedula_profesional" class="form-label">Cédula Profesional</label>
                                    <input type="text" name="cedula_profesional" id="cedula_profesional" 
                                           class="form-control @error('cedula_profesional') is-invalid @enderror" 
                                           value="{{ old('cedula_profesional') }}"
                                           placeholder="Ej: 12345678">
                                    @error('cedula_profesional')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="documento" class="form-label">Documento Comprobatorio</label>
                                    <input type="file" name="documento" id="documento" 
                                           class="form-control @error('documento') is-invalid @enderror" 
                                           accept=".pdf,.jpg,.jpeg,.png">
                                    @error('documento')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Formatos: PDF, JPG, PNG. Máx: 2MB</small>
                                    <div id="filePreview" class="file-preview" style="display: none;">
                                        <span><i class="fas fa-file me-2"></i><span id="fileName"></span></span>
                                        <button type="button" class="btn-outline-light" onclick="clearFile()">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="observaciones" class="form-label">Observaciones</label>
                                    <textarea name="observaciones" id="observaciones" 
                                              class="form-control @error('observaciones') is-invalid @enderror" 
                                              rows="2"
                                              placeholder="Observaciones adicionales">{{ old('observaciones') }}</textarea>
                                    @error('observaciones')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-3">
                            <button type="button" class="btn-outline" id="cancelFormBtn">
                                <i class="fas fa-times"></i> Cancelar
                            </button>
                            <button type="submit" class="btn-success">
                                <i class="fas fa-save"></i> Guardar Grado
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Modal de Edición -->
                <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel">
                                    <i class="fas fa-edit"></i> Editar Grado Académico
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            <form action="" method="POST" enctype="multipart/form-data" id="editForm">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="edit_nivel" class="form-label required">Nivel Académico</label>
                                                <select name="nivel" id="edit_nivel" class="form-select" required>
                                                    <option value="">Seleccione un nivel</option>
                                                    <option value="Licenciatura">Licenciatura</option>
                                                    <option value="Especialidad">Especialidad</option>
                                                    <option value="Maestría">Maestría</option>
                                                    <option value="Doctorado">Doctorado</option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="edit_nombre_titulo" class="form-label required">Nombre del Título</label>
                                                <input type="text" name="nombre_titulo" id="edit_nombre_titulo" 
                                                       class="form-control" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="edit_institucion" class="form-label">Institución Educativa</label>
                                                <input type="text" name="institucion" id="edit_institucion" 
                                                       class="form-control">
                                            </div>

                                            <div class="mb-3">
                                                <label for="edit_ano_obtencion" class="form-label">Año de Obtención</label>
                                                <input type="number" name="ano_obtencion" id="edit_ano_obtencion" 
                                                       class="form-control" min="1900" max="{{ date('Y') }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="edit_cedula_profesional" class="form-label">Cédula Profesional</label>
                                                <input type="text" name="cedula_profesional" id="edit_cedula_profesional" 
                                                       class="form-control">
                                            </div>

                                            <div class="mb-3">
                                                <label for="edit_documento" class="form-label">Documento Comprobatorio</label>
                                                <input type="file" name="documento" id="edit_documento" 
                                                       class="form-control" accept=".pdf,.jpg,.jpeg,.png">
                                                <small class="text-muted">Formatos: PDF, JPG, PNG. Máx: 2MB</small>
                                            </div>

                                            <div class="mb-3">
                                                <label for="edit_observaciones" class="form-label">Observaciones</label>
                                                <textarea name="observaciones" id="edit_observaciones" 
                                                          class="form-control" rows="2"
                                                          placeholder="Observaciones adicionales"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn-outline" data-bs-dismiss="modal">
                                        <i class="fas fa-times"></i> Cancelar
                                    </button>
                                    <button type="submit" class="btn-success">
                                        <i class="fas fa-save"></i> Actualizar Grado
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Lista de Grados Académicos -->
                <div class="grados-container">
                    <div class="section-title">
                        <i class="fas fa-list"></i> Grados Registrados
                    </div>
                    
                    @if($gradosAcademicos->count() > 0)
                        <div class="grados-grid">
                            @foreach($gradosAcademicos as $grado)
                                <div class="grado-card-compact" data-nivel="{{ $grado->nivel }}" data-grado-id="{{ $grado->id }}">
                                    <div class="grado-header-compact">
                                        <div>
                                            <div class="grado-title-compact">{{ Str::limit($grado->nombre_titulo, 40) }}</div>
                                            <span class="grado-nivel-compact">{{ $grado->nivel }}</span>
                                        </div>
                                        <div class="action-buttons-compact">
                                            <button type="button" class="btn-action-sm btn-outline edit-grado-btn" 
                                                    data-id="{{ $grado->id }}"
                                                    data-nivel="{{ $grado->nivel }}"
                                                    data-nombre_titulo="{{ $grado->nombre_titulo }}"
                                                    data-institucion="{{ $grado->institucion }}"
                                                    data-ano_obtencion="{{ $grado->ano_obtencion }}"
                                                    data-cedula_profesional="{{ $grado->cedula_profesional }}"
                                                    data-observaciones="{{ $grado->observaciones }}">
                                                <i class="fas fa-edit"></i> Editar
                                            </button>
                                            <form action="{{ route('maestros.grados.destroy', $grado->id) }}" method="POST" class="d-inline delete-grado-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-action-sm btn-delete">
                                                    <i class="fas fa-trash-alt"></i> Eliminar
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    
                                    <div class="grado-divider"></div>
                                    
                                    <div class="grado-info-compact">
                                        <i class="fas fa-university"></i>
                                        <span>{{ $grado->institucion ?? 'Sin institución' }}</span>
                                    </div>
                                    
                                    <div class="grado-info-compact">
                                        <i class="fas fa-calendar"></i>
                                        <span>Año: {{ $grado->ano_obtencion ?? 'N/E' }}</span>
                                    </div>
                                    
                                    @if($grado->cedula_profesional)
                                        <div class="grado-info-compact">
                                            <i class="fas fa-id-card"></i>
                                            <span>Cédula: {{ Str::limit($grado->cedula_profesional, 12) }}</span>
                                        </div>
                                    @endif
                                    
                                    @if($grado->documento)
                                        <div class="grado-info-compact">
                                            <i class="fas fa-file"></i>
                                            <span>
                                                <a href="{{ route('maestros.grados.show-document', $grado->id) }}" target="_blank" class="text-primary">
                                                    <i class="fas fa-eye"></i> Ver archivo
                                                </a>
                                                <a href="{{ route('maestros.grados.download-document', $grado->id) }}" class="text-primary ms-2" title="Descargar documento">
                                                    <i class="fas fa-download"></i>
                                                </a>
                                            </span>
                                        </div>
                                    @endif
                                    
                                    @if($grado->observaciones)
                                        <div class="grado-info-compact">
                                            <i class="fas fa-comment"></i>
                                            <span>{{ Str::limit($grado->observaciones, 35) }}</span>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-state">
                            <i class="fas fa-graduation-cap"></i>
                            <h5>No tienes grados académicos registrados</h5>
                            <p>Comienza agregando tu primer grado académico usando el botón superior</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Confirmación para Eliminar -->
    <div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-delete">
                    <h5 class="modal-title" id="deleteConfirmModalLabel">
                        <i class="fas fa-exclamation-triangle"></i> Confirmar Eliminación
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-4">
                        <i class="fas fa-trash-alt" style="font-size: 42px; color: #3b82f6; margin-bottom: 12px;"></i>
                        <h5 style="color: #1e293b; font-weight: 600; font-size: 18px;">¿Estás seguro?</h5>
                        <p style="color: #64748b; margin: 8px 0;">Esta acción eliminará permanentemente:</p>
                        <p style="color: #1e293b; font-weight: 600; background: #f1f5f9; padding: 8px; border-radius: 8px; font-size: 14px;" id="gradoInfoEliminar"></p>
                    </div>
                    <div class="alert" style="background: #dbeafe; border-left: 4px solid #3b82f6; color: #1e40af; font-size: 13px;">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>¡Esta acción no se puede deshacer!</strong>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-outline" data-bs-dismiss="modal">
                        <i class="fas fa-times"></i> Cancelar
                    </button>
                    <form action="" method="POST" id="deleteGradoForm" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-success" style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);">
                            <i class="fas fa-trash-alt"></i> Sí, eliminar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
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

        // Función para actualizar saludo
        function actualizarSaludoMexico() {
            const welcomeText = document.getElementById('welcomeText');
            if (!welcomeText) return;
            
            const opciones = { timeZone: 'America/Mexico_City', hour: 'numeric', hour12: false };
            const formatter = new Intl.DateTimeFormat('es-MX', opciones);
            const horaMexico = parseInt(formatter.format(new Date()));
            
            const nombre = "{{ $maestro->nombres ?? 'Profesor' }}";
            let saludo, emoji;
            
            if (horaMexico >= 0 && horaMexico < 12) {
                emoji = '🌅';
                saludo = 'Buenos días';
            } else if (horaMexico >= 12 && horaMexico < 19) {
                emoji = '☀️';
                saludo = 'Buenas tardes';
            } else {
                emoji = '🌙';
                saludo = 'Buenas noches';
            }
            
            welcomeText.innerHTML = `${emoji} ¡${saludo}, ${nombre}! Bienvenido/a al Sistema`;
        }

        actualizarSaludoMexico();
        setInterval(actualizarSaludoMexico, 60000);

        // Mostrar/ocultar formulario al hacer clic en "Agregar Grado"
        const toggleFormBtn = document.getElementById('toggleFormBtn');
        const gradoFormContainer = document.getElementById('gradoFormContainer');
        const cancelFormBtn = document.getElementById('cancelFormBtn');
        
        if (toggleFormBtn) {
            toggleFormBtn.addEventListener('click', function() {
                if (gradoFormContainer.style.display === 'none') {
                    gradoFormContainer.style.display = 'block';
                    gradoFormContainer.scrollIntoView({ behavior: 'smooth', block: 'start' });
                } else {
                    gradoFormContainer.style.display = 'none';
                }
            });
        }
        
        if (cancelFormBtn) {
            cancelFormBtn.addEventListener('click', function() {
                gradoFormContainer.style.display = 'none';
            });
        }

        // Mostrar nombre del archivo seleccionado
        const fileInput = document.getElementById('documento');
        if (fileInput) {
            fileInput.addEventListener('change', function(e) {
                const fileName = this.files[0] ? this.files[0].name : '';
                const filePreview = document.getElementById('filePreview');
                const fileNameSpan = document.getElementById('fileName');
                
                if (fileName) {
                    fileNameSpan.textContent = fileName;
                    filePreview.style.display = 'flex';
                } else {
                    filePreview.style.display = 'none';
                }
            });
        }

        window.clearFile = function() {
            const fileInput = document.getElementById('documento');
            if (fileInput) {
                fileInput.value = '';
            }
            document.getElementById('filePreview').style.display = 'none';
        };

        // Mostrar formulario si hay errores
        document.addEventListener('DOMContentLoaded', function() {
            const hasErrors = {{ $errors->any() ? 'true' : 'false' }};
            if (hasErrors && gradoFormContainer) {
                gradoFormContainer.style.display = 'block';
            }
        });

        // Función para cargar datos en el modal de edición
        document.querySelectorAll('.edit-grado-btn').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.dataset.id;
                const nivel = this.dataset.nivel;
                const nombreTitulo = this.dataset.nombre_titulo;
                const institucion = this.dataset.institucion || '';
                const anoObtencion = this.dataset.ano_obtencion || '';
                const cedula = this.dataset.cedula_profesional || '';
                const observaciones = this.dataset.observaciones || '';

                const editForm = document.getElementById('editForm');
                editForm.action = `{{ route('maestros.grados.update', '') }}/${id}`;

                document.getElementById('edit_nivel').value = nivel;
                document.getElementById('edit_nombre_titulo').value = nombreTitulo;
                document.getElementById('edit_institucion').value = institucion;
                document.getElementById('edit_ano_obtencion').value = anoObtencion;
                document.getElementById('edit_cedula_profesional').value = cedula;
                document.getElementById('edit_observaciones').value = observaciones;
                document.getElementById('edit_documento').value = '';

                const editModal = new bootstrap.Modal(document.getElementById('editModal'));
                editModal.show();
            });
        });

        // Modal de confirmación para eliminar
        document.querySelectorAll('.delete-grado-form button[type="submit"]').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const form = this.closest('form');
                const gradoCard = this.closest('.grado-card-compact');
                const gradoTitulo = gradoCard.querySelector('.grado-title-compact').textContent;
                const gradoNivel = gradoCard.querySelector('.grado-nivel-compact').textContent;
                
                document.getElementById('gradoInfoEliminar').textContent = `${gradoNivel}: ${gradoTitulo}`;
                document.getElementById('deleteGradoForm').action = form.action;
                
                const deleteModal = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));
                deleteModal.show();
            });
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
    </script>
</body>
</html>