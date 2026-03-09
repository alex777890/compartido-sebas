<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documentos del Maestro | GEPROC GP</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
            
            /* Colores profesionales para la barra de progreso */
            --progress-blue: #2a5cd4;
            --progress-light-blue: #6b8ed9;
            --progress-gray: #94a3b8;
            --progress-light-gray: #e2e8f0;
            --progress-warning: #f97316;
            --progress-danger: #ef4444;
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

        /* Top Navigation - Barra azul profesional */
        .top-nav {
            background: linear-gradient(135deg, var(--primary) 0%, #2d5fd4 100%);
            position: fixed;
            top: 70px;
            left: 0;
            right: 0;
            z-index: 1000;
            box-shadow: 0 4px 20px rgba(26, 76, 186, 0.3);
            border-bottom: 1px solid rgba(255,255,255,0.1);
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
            background: rgba(255, 255, 255, 0.2);
            border-radius: 2px;
        }

        .nav-menu {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 20px;
            color: rgba(255, 255, 255, 0.85);
            text-decoration: none;
            border-radius: 12px;
            transition: all 0.2s ease;
            font-weight: 500;
            font-size: 0.95rem;
            position: relative;
            backdrop-filter: blur(5px);
        }

        .nav-item i {
            font-size: 1.1rem;
            transition: transform 0.2s ease;
        }

        .nav-item:hover {
            background: rgba(255, 255, 255, 0.15);
            color: white;
            transform: translateY(-2px);
        }

        .nav-item:hover i {
            transform: scale(1.1);
        }

        .nav-item.active {
            color: white;
            background: rgba(255, 255, 255, 0.2);
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .nav-item.active::after {
            content: '';
            position: absolute;
            bottom: -18px;
            left: 50%;
            transform: translateX(-50%);
            width: 30px;
            height: 3px;
            background: white;
            border-radius: 3px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }

        .nav-right {
            display: flex;
            align-items: center;
        }

        .logout-btn {
            background: rgba(255, 255, 255, 0.1);
            border: none;
            padding: 10px 22px;
            border-radius: 30px;
            color: white;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.95rem;
            font-weight: 500;
            border: 1px solid rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(5px);
        }

        .logout-btn i {
            font-size: 1rem;
            transition: transform 0.2s ease;
        }

        .logout-btn:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
            border-color: rgba(255, 255, 255, 0.3);
            box-shadow: 0 6px 12px rgba(0,0,0,0.1);
        }

        .logout-btn:hover i {
            transform: translateX(3px);
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

        /* ===== ESTILOS PARA EL PERÍODO - AGREGADOS ===== */
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

        /* Botón de volver mejorado */
        .btn-volver {
            background: white;
            border: 1px solid var(--border-color);
            color: var(--primary);
            padding: 10px 20px;
            border-radius: 30px;
            font-weight: 600;
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
            text-decoration: none;
            margin-bottom: 25px;
            box-shadow: var(--shadow-sm);
        }

        .btn-volver:hover {
            background: var(--light-primary);
            border-color: var(--primary);
            transform: translateX(-5px);
            box-shadow: var(--shadow-md);
        }

        .btn-volver i {
            transition: transform 0.3s ease;
        }

        .btn-volver:hover i {
            transform: translateX(-3px);
        }

        /* Perfil del maestro */
        .maestro-profile-card {
            background: var(--card-bg);
            border-radius: 24px;
            padding: 30px;
            margin-bottom: 25px;
            box-shadow: var(--shadow-lg);
            border: 1px solid var(--border-color);
            position: relative;
            overflow: hidden;
        }

        .maestro-profile-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--secondary), var(--primary));
            background-size: 200% 100%;
            animation: gradientMove 3s linear infinite;
        }

        @keyframes gradientMove {
            0% { background-position: 0% 0%; }
            100% { background-position: 200% 0%; }
        }

        .avatar-lg {
            width: 100px;
            height: 100px;
            border-radius: 24px;
            background: linear-gradient(135deg, var(--light-primary), white);
            border: 3px solid var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 2.5rem;
            box-shadow: var(--shadow-md);
            transition: var(--transition);
        }

        .maestro-profile-card:hover .avatar-lg {
            transform: scale(1.05) rotate(5deg);
        }

        .maestro-name-large {
            font-size: 2rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 10px;
        }

        .maestro-contact {
            display: flex;
            gap: 25px;
            flex-wrap: wrap;
            margin-bottom: 15px;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--text-muted);
            font-size: 1rem;
            padding: 5px 12px;
            background: var(--light-primary);
            border-radius: 30px;
            transition: var(--transition);
        }

        .contact-item:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-2px);
        }

        .contact-item:hover i {
            color: white;
        }

        .contact-item i {
            color: var(--primary);
            transition: var(--transition);
        }

        /* ===== BARRA DE PROGRESO REDISEÑADA - PROFESIONAL ===== */
        .progress-card {
            background: var(--card-bg);
            border-radius: 24px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: var(--shadow-lg);
            border: 1px solid var(--border-color);
            position: relative;
            overflow: hidden;
        }

        .progress-card::after {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(26, 76, 186, 0.03) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        .progress-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .progress-title i {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white;
            padding: 10px;
            border-radius: 14px;
            font-size: 1.2rem;
            box-shadow: 0 4px 10px rgba(26, 76, 186, 0.3);
        }

        /* Barra de progreso estilo profesional */
        .progress-custom {
            height: 36px;
            border-radius: 18px;
            background-color: var(--progress-light-gray);
            overflow: hidden;
            box-shadow: inset 0 2px 4px rgba(0,0,0,0.05);
            display: flex;
        }

        .progress-bar-custom {
            font-size: 0.85rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-shadow: 0 1px 2px rgba(0,0,0,0.2);
            transition: width 0.5s ease;
            position: relative;
            overflow: hidden;
        }

        .progress-bar-custom::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(90deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.2) 50%, rgba(255,255,255,0.1) 100%);
            animation: shimmer 2s infinite;
        }

        @keyframes shimmer {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }

        /* Colores profesionales para la barra */
        .progress-bar-blue {
            background: linear-gradient(135deg, var(--progress-blue), #3b6be0);
        }

        .progress-bar-light-blue {
            background: linear-gradient(135deg, var(--progress-light-blue), #8bb1f0);
        }

        .progress-bar-gray {
            background: linear-gradient(135deg, var(--progress-gray), #a5b4cb);
        }

        .progress-bar-warning {
            background: linear-gradient(135deg, var(--progress-warning), #fb923c);
        }

        .progress-bar-danger {
            background: linear-gradient(135deg, var(--progress-danger), #f87171);
        }

        /* Stats badges - CORREGIDO: MÁS PEQUEÑOS */
        .stats-badges {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            justify-content: flex-start;
            margin-top: 5px;
        }

        .stat-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 0.8rem;
            background: white;
            border: 1px solid var(--border-color);
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
            min-width: auto;
        }

        .stat-badge:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .stat-badge i {
            font-size: 0.9rem;
        }

        .stat-badge.approved {
            background: linear-gradient(135deg, #e8f5e9, #c8e6c9);
            color: #2e7d32;
            border-color: #a5d6a7;
        }

        .stat-badge.pending {
            background: linear-gradient(135deg, #fff3e0, #ffe0b2);
            color: #e65100;
            border-color: #ffb74d;
        }

        .stat-badge.rejected {
            background: linear-gradient(135deg, #ffebee, #ffcdd2);
            color: #c62828;
            border-color: #ef9a9a;
        }

        .stat-badge.faltantes {
            background: linear-gradient(135deg, #f1f5f9, #e2e8f0);
            color: #475569;
            border-color: #cbd5e1;
        }

        /* Badges para tipos de documento */
        .badge-custom {
            padding: 6px 12px;
            border-radius: 30px;
            font-weight: 600;
            font-size: 0.8rem;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            white-space: nowrap;
            background: var(--light-primary);
            color: var(--primary);
            border: 1px solid rgba(26, 76, 186, 0.2);
            transition: var(--transition);
        }

        .badge-custom:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-2px);
        }

        /* Tabla de documentos */
        .historial-card {
            background: var(--card-bg);
            border-radius: 24px;
            padding: 30px;
            margin-top: 30px;
            box-shadow: var(--shadow-lg);
            border: 1px solid var(--border-color);
        }

        .historial-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .historial-title i {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white;
            padding: 10px;
            border-radius: 14px;
            font-size: 1.2rem;
            box-shadow: 0 4px 10px rgba(26, 76, 186, 0.3);
        }

        .table-custom {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 8px;
            font-size: 0.9rem;
        }

        .table-custom th {
            padding: 12px 10px;
            background: linear-gradient(135deg, #f8fafc 0%, #ffffff 100%);
            color: var(--primary);
            font-weight: 700;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid var(--border-color);
        }

        .table-custom td {
            padding: 12px 10px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.02);
            vertical-align: middle;
            transition: var(--transition);
        }

        .table-custom tbody tr {
            transition: var(--transition);
        }

        .table-custom tbody tr:hover td {
            background: var(--light-primary);
            box-shadow: var(--shadow-md);
        }

        /* Estado de documento no subido - estilo elegante */
        .badge-not-uploaded {
            padding: 6px 12px;
            border-radius: 30px;
            font-weight: 600;
            font-size: 0.8rem;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(148, 163, 184, 0.1);
            color: rgba(100, 116, 139, 0.8);
            border: 1px dashed rgba(148, 163, 184, 0.3);
            backdrop-filter: blur(5px);
            transition: var(--transition);
        }

        .badge-not-uploaded i {
            color: rgba(100, 116, 139, 0.5);
            font-size: 0.8rem;
        }

        .badge-not-uploaded:hover {
            background: rgba(148, 163, 184, 0.15);
            border-color: rgba(148, 163, 184, 0.5);
        }

        /* Observaciones */
        .observaciones-text {
            max-width: 250px;
            white-space: normal;
            word-wrap: break-word;
            font-size: 0.8rem;
            color: var(--text-dark);
            background: #f8f9fa;
            padding: 6px 10px;
            border-radius: 8px;
            border-left: 3px solid var(--primary);
            box-shadow: 0 2px 4px rgba(0,0,0,0.02);
        }

        .observaciones-text i {
            color: var(--primary);
            margin-right: 4px;
            font-size: 0.75rem;
        }

        .sin-observaciones {
            font-size: 0.75rem;
            color: rgba(100, 116, 139, 0.4);
            font-style: italic;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .sin-observaciones i {
            font-size: 0.7rem;
            color: rgba(100, 116, 139, 0.3);
        }

        /* Botones de acción */
        .document-actions {
            display: flex;
            gap: 5px;
        }

        .btn-icon {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
            border: 1px solid var(--border-color);
            color: var(--text-muted);
            transition: all 0.3s ease;
            cursor: pointer;
            text-decoration: none;
            font-size: 0.9rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.02);
        }

        .btn-icon:hover {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(26, 76, 186, 0.2);
        }

        .btn-icon i {
            transition: transform 0.3s ease;
            font-size: 0.9rem;
        }

        .btn-icon:hover i {
            transform: scale(1.1);
        }

        /* Modal */
        .modal-content-custom {
            border: none;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: var(--shadow-lg);
        }

        .modal-header-custom {
            background: linear-gradient(135deg, #f44336 0%, #d32f2f 100%);
            color: white;
            padding: 20px 25px;
            border: none;
        }

        .modal-header-custom .btn-close {
            filter: brightness(0) invert(1);
            opacity: 0.8;
            transition: var(--transition);
        }

        .modal-header-custom .btn-close:hover {
            opacity: 1;
            transform: rotate(90deg);
        }

        .modal-body-custom {
            padding: 30px;
        }

        .modal-footer-custom {
            padding: 20px 30px;
            border-top: 1px solid var(--border-color);
            background: #f8fafc;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .main-content {
                padding: 20px;
            }

            .nav-menu {
                display: none;
            }

            .maestro-profile-card .d-flex {
                flex-direction: column;
                text-align: center;
            }

            .maestro-contact {
                justify-content: center;
            }

            .stats-badges {
                justify-content: center;
            }

            .table-responsive {
                overflow-x: auto;
            }
            
            .observaciones-text {
                max-width: 150px;
            }
        }
    </style>
</head>
<body>

    @php
        use Illuminate\Support\Facades\Auth;
        use App\Models\Coordinacion;
        
        $user = Auth::user();
        $coordinacion = $user->coordinaciones_id ? Coordinacion::find($user->coordinaciones_id) : null;
        
        if (isset($coordinacionControlador) && $coordinacionControlador) {
            $coordinacion = $coordinacionControlador;
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
        
        // CORRECCIÓN: Total de documentos requeridos = 6
        $totalDocumentosRequeridos = 6;
    @endphp

    <!-- Top Bar Superior -->
    <div class="top-bar">
        <div class="top-bar-content">
            <div class="header-logo">
                <img src="{{ asset('img/logo_iufim.png') }}" alt="Logo IUFIM" class="logo-img-header">
            </div>
        </div>
    </div>

    <!-- Top Navigation - Barra azul profesional -->
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
                    <a href="{{ route('coordinaciones.estadisticas', $coordinacion->id ?? '#') }}" class="nav-item">
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

            <!-- Botón Volver mejorado -->
            <a href="{{ route('coordinaciones.maestros') }}" class="btn-volver">
                <i class="fas fa-arrow-left"></i> Volver a la lista de maestros
            </a>

            <!-- ===== ALERTAS DE PERÍODO - CON DISEÑO CORREGIDO ===== -->
            @if(isset($periodoHabilitado) && $periodoHabilitado)
                @if($periodoHabilitado->activo == 1)
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
                        <div class="periodo-status status-activo">
                            <i class="fas fa-check-circle"></i> ACTIVO
                        </div>
                    </div>
                @else
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
                        <div class="periodo-status status-inactivo">
                            <i class="fas fa-times-circle"></i> INACTIVO
                        </div>
                    </div>
                @endif
            @else
                <div class="periodo-mensaje">
                    <i class="fas fa-info-circle"></i>
                    <div>
                        <strong>Sin período activo</strong>
                        <p style="margin: 5px 0 0 0; font-size: 0.9rem;">
                            Mostrando todos los documentos disponibles.
                        </p>
                    </div>
                </div>
            @endif

            <!-- ===== ENCABEZADO CON DATOS DEL MAESTRO ===== -->
            <div class="maestro-profile-card">
                <div class="d-flex align-items-center flex-wrap gap-4">
                    <div class="flex-shrink-0">
                        <div class="avatar-lg">
                            <i class="fas fa-user"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1">
                        <h2 class="maestro-name-large">{{ $maestro->nombres ?? '' }} {{ $maestro->apellido_paterno ?? '' }} {{ $maestro->apellido_materno ?? '' }}</h2>
                        <div class="maestro-contact">
                            <span class="contact-item">
                                <i class="fas fa-envelope"></i> {{ $maestro->email ?? 'No especificado' }}
                            </span>
                            <span class="contact-item">
                                <i class="fas fa-phone"></i> {{ $maestro->telefono ?? 'No especificado' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ===== BARRA DE PROGRESO REDISEÑADA - PROFESIONAL ===== -->
            <div class="progress-card">
                <div class="progress-title">
                    <i class="fas fa-chart-pie"></i> Progreso de Documentos
                </div>
                <div class="row align-items-center">
                    <div class="col-md-8">
                        @php
                            // Asegurarse de que todas las variables tengan valores por defecto
                            $aprobados = $estadoMaestro['aprobados'] ?? 0;
                            $pendientes = $estadoMaestro['pendientes'] ?? 0;
                            $rechazados = $estadoMaestro['rechazados'] ?? 0;
                            // CORRECCIÓN: Usar 6 como total fijo
                            $total = 6;
                            $subidos = $aprobados + $pendientes + $rechazados;
                            $faltantes = max(0, $total - $subidos);
                        @endphp
                        <div class="progress-custom progress">
                            @if($aprobados > 0)
                            <div class="progress-bar-custom progress-bar-blue" role="progressbar" 
                                 style="width: {{ ($aprobados/$total)*100 }}%" 
                                 data-bs-toggle="tooltip" title="{{ $aprobados }} aprobados">
                                {{ $aprobados }}
                            </div>
                            @endif
                            
                            @if($pendientes > 0)
                            <div class="progress-bar-custom progress-bar-light-blue" role="progressbar" 
                                 style="width: {{ ($pendientes/$total)*100 }}%" 
                                 data-bs-toggle="tooltip" title="{{ $pendientes }} pendientes">
                                {{ $pendientes }}
                            </div>
                            @endif
                            
                            @if($rechazados > 0)
                            <div class="progress-bar-custom progress-bar-warning" role="progressbar" 
                                 style="width: {{ ($rechazados/$total)*100 }}%" 
                                 data-bs-toggle="tooltip" title="{{ $rechazados }} rechazados">
                                {{ $rechazados }}
                            </div>
                            @endif
                            
                            @if($faltantes > 0)
                            <div class="progress-bar-custom progress-bar-gray" role="progressbar" 
                                 style="width: {{ ($faltantes/$total)*100 }}%" 
                                 data-bs-toggle="tooltip" title="{{ $faltantes }} faltantes">
                                {{ $faltantes }}
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stats-badges">
                            <span class="stat-badge approved">
                                <i class="fas fa-check-circle"></i> {{ $aprobados }} Aprobados
                            </span>
                            <span class="stat-badge pending">
                                <i class="fas fa-clock"></i> {{ $pendientes }} Pendientes
                            </span>
                            <span class="stat-badge rejected">
                                <i class="fas fa-times-circle"></i> {{ $rechazados }} Rechazados
                            </span>
                            <span class="stat-badge faltantes">
                                <i class="fas fa-cloud-upload-alt"></i> {{ $faltantes }} Faltantes
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- ===== SECCIÓN DE DOCUMENTOS ===== -->
            <div class="historial-card">
                <div class="historial-title">
                    <i class="fas fa-file-alt"></i> Documentos del Maestro
                </div>
                <div class="table-responsive">
                    <table class="table-custom">
                        <thead>
                            <tr>
                                <th>Tipo de Documento</th>
                                <th>Fecha de subida</th>
                                <th>Estado</th>
                                <th>Observaciones</th>
                                <th>Revisado por</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                // Definir el orden específico de los documentos con nombres personalizados
                                $tiposOrdenados = [
                                    'cst' => 'CST',
                                    'iufim' => 'IUFIM',
                                    'comprobante_domicilio' => 'Comprobante Domicilio',
                                    'oficio_ingresos' => 'Oficio Ingresos',
                                    'declaracion_anual' => 'Declaración Anual',
                                    'comprobante_seguro_social' => 'Seguro Social'
                                ];
                            @endphp
                            
                            @foreach($tiposOrdenados as $tipo => $nombreMostrar)
                                @php
                                    // Obtener el documento más reciente de este tipo (si existe)
                                    $documento = isset($documentosPorTipo[$tipo]) && count($documentosPorTipo[$tipo]) > 0 
                                        ? $documentosPorTipo[$tipo][0] 
                                        : null;
                                    
                                    // Obtener el ícono del tipo de documento
                                    $icono = $tiposDocumentos[$tipo]['icono'] ?? 'fa-file';
                                @endphp
                                <tr>
                                    <td>
                                        <span class="badge-custom">
                                            <i class="fas {{ $icono }} me-1"></i>
                                            {{ $nombreMostrar }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($documento)
                                            <small>{{ \Carbon\Carbon::parse($documento->created_at)->format('d/m/Y H:i') }}</small>
                                        @else
                                            <small class="text-muted">-</small>
                                        @endif
                                    </td>
                                    <td>
                                        @if($documento)
                                            @if($documento->estado == 'aprobado')
                                                <span class="badge-custom" style="background: rgba(38, 230, 63, 0.15); color: #1a9c2a; border: 1px solid rgba(38, 230, 63, 0.3);">
                                                    <i class="fas fa-check-circle fa-xs"></i> Aprobado
                                                </span>
                                            @elseif($documento->estado == 'rechazado')
                                                <span class="badge-custom" style="background: rgba(244, 67, 54, 0.15); color: #f44336; border: 1px solid rgba(244, 67, 54, 0.3);">
                                                    <i class="fas fa-times-circle fa-xs"></i> Rechazado
                                                </span>
                                            @else
                                                <span class="badge-custom" style="background: rgba(255, 193, 7, 0.15); color: #ff9800; border: 1px solid rgba(255, 193, 7, 0.3);">
                                                    <i class="fas fa-clock fa-xs"></i> Pendiente
                                                </span>
                                            @endif
                                        @else
                                            <!-- ✅ ESTILO MEJORADO PARA DOCUMENTOS NO SUBIDOS -->
                                            <span class="badge-not-uploaded">
                                                <i class="fas fa-times-circle fa-xs"></i> No subido
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($documento && $documento->observaciones_admin)
                                            <div class="observaciones-text">
                                                <i class="fas fa-comment fa-xs"></i> {{ Str::limit($documento->observaciones_admin, 50) }}
                                            </div>
                                        @else
                                            <span class="sin-observaciones">
                                                <i class="fas fa-comment-slash"></i> Sin observaciones
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($documento && $documento->revisadoPor)
                                            <small>
                                                {{ $documento->revisadoPor->name }}
                                                @if($documento->fecha_revision)
                                                    <br><span style="color: var(--text-muted); font-size: 0.7rem;">{{ \Carbon\Carbon::parse($documento->fecha_revision)->format('d/m/Y') }}</span>
                                                @endif
                                            </small>
                                        @else
                                            <small class="text-muted">-</small>
                                        @endif
                                    </td>
                                    <td>
    @if($documento)
        <div class="document-actions">
            <!-- ✅ RUTAS CORREGIDAS CON TUS NOMBRES -->
            <a href="{{ route('documentos.view', $documento->id) }}" class="btn-icon" target="_blank" title="Ver documento">
                <i class="fas fa-eye"></i>
            </a>
            <a href="{{ route('documentos.download', $documento->id) }}" class="btn-icon" title="Descargar documento">
                <i class="fas fa-download"></i>
            </a>
        </div>
    @else
        <small class="text-muted">-</small>
    @endif
</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>

    <!-- ===== MODAL PARA RECHAZAR CON OBSERVACIONES ===== -->
    <div class="modal fade" id="modalRechazar" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content modal-content-custom">
                <div class="modal-header modal-header-custom">
                    <h5 class="modal-title">
                        <i class="fas fa-exclamation-triangle me-2"></i>Rechazar Documento
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="formRechazar" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body modal-body-custom">
                        <p style="color: var(--text-dark); margin-bottom: 15px;">Por favor, indica el motivo del rechazo:</p>
                        <div class="mb-3">
                            <label for="observaciones" class="form-label" style="font-weight: 600; color: var(--text-dark);">Observaciones</label>
                            <textarea class="form-control" id="observaciones" name="observaciones" rows="3" required style="border: 2px solid var(--border-color); border-radius: 12px; padding: 12px;"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer modal-footer-custom">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius: 30px; padding: 10px 25px;">Cancelar</button>
                        <button type="submit" class="btn btn-danger" style="border-radius: 30px; padding: 10px 25px; background: linear-gradient(135deg, #f44336 0%, #d32f2f 100%); border: none;">Rechazar Documento</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Alert Container -->
    <div id="alertMessage" style="position: fixed; top: 160px; right: 25px; padding: 15px 25px; background: white; border-radius: 12px; box-shadow: 0 8px 20px rgba(0,0,0,0.15); border-left: 5px solid #26E63F; z-index: 10000; display: none; font-size: 1rem; font-weight: 500; animation: slideIn 0.3s ease;"></div>

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

        // Inicializar tooltips
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });

        // Función para cambiar estado del documento
        function cambiarEstadoDocumento(documentoId, estado) {
            if (estado === 'rechazado') {
                const modal = new bootstrap.Modal(document.getElementById('modalRechazar'));
                document.getElementById('formRechazar').action = `/coordinacion/documentos/${documentoId}/estado`;
                
                let inputEstado = document.getElementById('estadoInput');
                if (!inputEstado) {
                    inputEstado = document.createElement('input');
                    inputEstado.type = 'hidden';
                    inputEstado.name = 'estado';
                    inputEstado.id = 'estadoInput';
                    document.getElementById('formRechazar').appendChild(inputEstado);
                }
                inputEstado.value = 'rechazado';
                
                modal.show();
            } else {
                if (confirm('¿Estás seguro de aprobar este documento?')) {
                    fetch(`/coordinacion/documentos/${documentoId}/estado`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            estado: 'aprobado'
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            showAlert(data.message, 'success');
                            setTimeout(() => location.reload(), 1500);
                        } else {
                            showAlert(data.message, 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showAlert('Error al cambiar el estado', 'error');
                    });
                }
            }
        }

        // Manejar envío del formulario de rechazo
        document.getElementById('formRechazar')?.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const data = Object.fromEntries(formData.entries());
            
            fetch(this.action, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showAlert(data.message, 'success');
                    setTimeout(() => location.reload(), 1500);
                    bootstrap.Modal.getInstance(document.getElementById('modalRechazar')).hide();
                } else {
                    showAlert(data.message, 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert('Error al rechazar el documento', 'error');
            });
        });

        // Mostrar notificaciones de sesión
        @if(session('success'))
            showAlert('{{ session('success') }}', 'success');
        @endif
        @if(session('error'))
            showAlert('{{ session('error') }}', 'error');
        @endif
        @if(session('warning'))
            showAlert('{{ session('warning') }}', 'warning');
        @endif
        @if(session('info'))
            showAlert('{{ session('info') }}', 'info');
        @endif
    </script>
</body>
</html>