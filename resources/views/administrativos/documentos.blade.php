<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Mis Documentos - Administrativo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #0744b6ff;
            --secondary: #33CAE6;
            --accent: #26E63F;
            --light-bg: #F8F9FA;
            --border-color: #E9ECEF;
            --text-muted: #6C757D;
            --card-shadow: 0 5px 15px rgba(15, 126, 230, 0.08);
            --transition: all 0.3s ease;
            
            --font-size-base: 1.1rem;
            --font-size-lg: 1.3rem;
            --font-size-sm: 1rem;
            --font-size-h1: 2.2rem;
            --font-size-h2: 1.9rem;
            --font-size-h3: 1.6rem;
            --font-size-h4: 1.4rem;
        }

        body { 
            background: white; 
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            color: #333; 
            line-height: 1.6;
            font-size: var(--font-size-base);
        }

        /* ========== BARRA DE NAVEGACIÓN ========== */
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

        .navbar-brand { 
            color: var(--primary) !important; 
            font-weight: 600; 
            font-size: 1.4rem;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .navbar-brand::before {
            content: "";
            display: block;
            width: 6px;
            height: 28px;
            background: var(--primary);
            border-radius: 2px;
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .logo-img {
            height: 50px;
            width: auto;
            object-fit: contain;
        }

        /* Segunda barra - Menú */
        .navbar-menu { 
            background: var(--primary); 
            padding: 0.7rem 0;
            position: sticky;
            top: 68px;
            z-index: 999;
        }

        .navbar-menu .navbar-toggler {
            border: 1px solid rgba(255, 255, 255, 0.3);
            padding: 0.25rem 0.5rem;
        }

        .navbar-menu .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 0.8%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        .navbar-menu .nav-link {
            font-weight: 500;
            color: rgba(255, 255, 255, 0.9) !important;
            padding: 0.6rem 1.5rem !important;
            margin: 0 0.1rem;
            border-radius: 4px;
            transition: var(--transition);
            position: relative;
            font-size: 0.95rem;
        }

        .navbar-menu .nav-link:hover, 
        .navbar-menu .nav-link.active {
            color: white !important;
            background-color: rgba(255, 255, 255, 0.12);
        }

        .navbar-menu .nav-link::after {
            content: '';
            position: absolute;
            bottom: -7px;
            left: 50%;
            width: 0;
            height: 2px;
            background: white;
            transition: var(--transition);
            transform: translateX(-50%);
        }

        .navbar-menu .nav-link:hover::after, 
        .navbar-menu .nav-link.active::after {
            width: 60%;
        }

        /* Estilo para el botón de Cerrar Sesión en el menú */
        .navbar-menu .user-info-container {
            display: flex;
            align-items: center;
            margin-left: auto;
            gap: 15px;
        }

        .navbar-menu .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
            color: white;
        }

        .navbar-menu .user-name {
            font-weight: 500;
            color: rgba(255, 255, 255, 0.9);
        }

        .navbar-menu .user-avatar {
            width: 36px;
            height: 36px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        .navbar-menu .logout-form {
            margin: 0;
        }

        .navbar-menu .logout-btn {
            background: transparent;
            border: 1px solid rgba(255, 255, 255, 0.4);
            color: rgba(255, 255, 255, 0.9);
            padding: 0.4rem 1rem;
            border-radius: 4px;
            font-weight: 500;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9rem;
        }

        .navbar-menu .logout-btn:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border-color: rgba(255, 255, 255, 0.6);
        }

        /* Contenido principal */
        .main-content { 
            padding: 30px 20px;
            min-height: calc(100vh - 140px);
            background: #f8fafc;
        }

        h1, h2, h3, h4, h5, h6 {
            font-weight: 600;
            line-height: 1.3;
        }

        h1 { font-size: var(--font-size-h1); }
        h2 { font-size: var(--font-size-h2); }
        h3 { font-size: var(--font-size-h3); }
        h4 { font-size: var(--font-size-h4); }

        h2 { 
            color: var(--primary);
            margin-bottom: 1.5rem; 
            padding-bottom: 0.8rem;
            position: relative;
        }

        h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 3px;
            background: var(--primary);
        }

        /* Grid de estadísticas */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stats-card {
            background: white;
            border-radius: 6px;
            padding: 1.8rem 1.5rem;
            border: 1px solid var(--border-color);
            box-shadow: var(--card-shadow);
            display: flex;
            align-items: center;
            gap: 1.2rem;
            transition: var(--transition);
        }

        .stats-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(7, 68, 182, 0.12);
        }

        .stats-icon {
            width: 60px;
            height: 60px;
            background: #e8f0fe;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 1.8rem;
        }

        .stats-content h4 {
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 0.3rem;
        }

        .stats-number {
            font-size: 2rem;
            font-weight: 700;
            color: #333;
        }

        /* Sección de subida de documentos */
        .upload-section {
            background: white;
            border-radius: 6px;
            padding: 2rem;
            margin-bottom: 2rem;
            border: 1px solid var(--border-color);
            box-shadow: var(--card-shadow);
        }

        .upload-section h3 {
            font-size: var(--font-size-h4);
            color: var(--primary);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .upload-form {
            background: var(--light-bg);
            padding: 2rem;
            border-radius: 6px;
            border: 1px solid var(--border-color);
        }

        .upload-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .upload-item {
            background: white;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            padding: 1.2rem;
        }

        .upload-item label {
            display: block;
            font-weight: 600;
            margin-bottom: 0.8rem;
            color: #333;
            font-size: 1rem;
        }

        .upload-item label i {
            color: var(--primary);
            margin-right: 0.5rem;
        }

        .upload-item input[type="file"] {
            width: 100%;
            padding: 0.7rem;
            border: 1px dashed var(--border-color);
            border-radius: 4px;
            background: var(--light-bg);
            font-size: 0.9rem;
        }

        .upload-item small {
            display: block;
            color: var(--text-muted);
            font-size: 0.8rem;
            margin-top: 0.5rem;
        }

        .submit-btn {
            text-align: right;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
            border: none;
            padding: 0.8rem 2rem;
            border-radius: 6px;
            font-weight: 500;
            font-size: 1rem;
            cursor: pointer;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 0.8rem;
            border: 2px solid var(--primary);
        }

        .btn-primary:hover {
            background: #052d7a;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(7, 68, 182, 0.3);
        }

        /* Tabla de documentos */
        .documents-table {
            background: white;
            border-radius: 6px;
            padding: 2rem;
            border: 1px solid var(--border-color);
            box-shadow: var(--card-shadow);
        }

        .documents-table h3 {
            font-size: var(--font-size-h4);
            color: var(--primary);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            text-align: left;
            padding: 1rem 0.5rem;
            color: var(--text-muted);
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border-bottom: 1px solid var(--border-color);
        }

        td {
            padding: 1rem 0.5rem;
            border-bottom: 1px solid var(--border-color);
        }

        tr:last-child td {
            border-bottom: none;
        }

        .document-name {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .document-name i {
            width: 35px;
            height: 35px;
            background: #e8f0fe;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
        }

        .badge {
            padding: 0.4rem 1rem;
            border-radius: 4px;
            font-size: 0.85rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
        }

        .badge-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .badge-warning {
            background: #fff3cd;
            color: #856404;
            border: 1px solid #ffeeba;
        }

        .badge-danger {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .badge-secondary {
            background: #e2e3e5;
            color: #383d41;
            border: 1px solid #d6d8db;
        }

        .action-btn {
            background: none;
            border: none;
            color: var(--primary);
            cursor: pointer;
            font-size: 1rem;
            padding: 0.3rem 0.5rem;
            transition: var(--transition);
        }

        .action-btn:hover {
            color: #052d7a;
            transform: scale(1.1);
        }

        .observaciones {
            font-size: 0.85rem;
            color: #721c24;
            background: #f8d7da;
            padding: 0.4rem 0.8rem;
            border-radius: 4px;
            margin-top: 0.3rem;
            display: inline-block;
            border: 1px solid #f5c6cb;
        }

        /* Alertas */
        .alert {
            padding: 1.2rem;
            border-radius: 6px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            border: 1px solid;
        }

        .alert-success {
            background: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
        }

        .alert-info {
            background: #d1ecf1;
            border-color: #bee5eb;
            color: #0c5460;
        }

        .alert-warning {
            background: #fff3cd;
            border-color: #ffeeba;
            color: #856404;
        }

        .alert-danger {
            background: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
        }

        .info-note {
            background: #e8f0fe;
            border-left: 4px solid var(--primary);
            padding: 1.2rem;
            border-radius: 6px;
            margin-bottom: 1.5rem;
            font-size: 1rem;
            color: #333;
            display: flex;
            align-items: center;
            gap: 0.8rem;
            border: 1px solid rgba(7, 68, 182, 0.2);
        }

        .info-note i {
            color: var(--primary);
            font-size: 1.2rem;
        }

        .back-btn {
            background: transparent;
            border: 2px solid var(--primary);
            color: var(--primary);
            padding: 0.6rem 1.5rem;
            border-radius: 6px;
            font-weight: 500;
            transition: var(--transition);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .back-btn:hover {
            background: rgba(7, 68, 182, 0.05);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(7, 68, 182, 0.15);
        }

        .date-badge {
            background: white;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            padding: 0.7rem 1.5rem;
            font-size: 0.95rem;
            color: var(--text-muted);
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .upload-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            :root {
                --font-size-base: 1rem;
                --font-size-h1: 1.9rem;
                --font-size-h2: 1.6rem;
                --font-size-h3: 1.4rem;
                --font-size-h4: 1.2rem;
            }
            
            .navbar-menu {
                top: 60px;
            }
            
            .navbar-menu .nav-link {
                padding: 0.6rem 1.2rem !important;
            }
            
            .navbar-menu .user-info-container {
                flex-direction: column;
                gap: 10px;
                align-items: flex-start;
                margin-top: 10px;
                padding-top: 10px;
                border-top: 1px solid rgba(255, 255, 255, 0.2);
            }
            
            .main-content {
                padding: 20px 15px;
            }
            
            .page-header {
                flex-direction: column;
                gap: 1rem;
                align-items: flex-start;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
            
            .upload-form {
                padding: 1.5rem;
            }
            
            .upload-grid {
                gap: 1rem;
            }
            
            table {
                font-size: 0.9rem;
            }
            
            .logo-img {
                height: 45px;
            }
        }
    </style>
</head>
<body>
    <!-- Primera barra - Logo y título -->
    <nav class="navbar navbar-expand-lg navbar-top">
        <div class="container">
            <div class="logo-container">
                <img src="{{ asset('img/logo_iufim.png') }}" alt="Logo" class="logo-img">
                <a class="navbar-brand" href="{{ route('dashboard') }}">
                    GEPROC | Administrativos
                </a>
            </div>
        </div>
    </nav>

    <!-- Segunda barra - Menú con información de usuario y cerrar sesión -->
    <nav class="navbar navbar-expand-lg navbar-menu">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
                
                <!-- Información de usuario y cerrar sesión -->
                <div class="user-info-container">
                    <div class="user-info">
                        <span class="user-name">{{ Auth::user()->name }}</span>
                        <div class="user-avatar">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
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
    
    <!-- Contenido principal -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 main-content">
                <div class="container">
                    <!-- Cabecera con fecha y botón volver -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h2>Mis Documentos</h2>
                            <p style="color: var(--text-muted); font-size: 1rem;">
                                <i class="fas fa-file-pdf" style="color: var(--primary);"></i>
                                Gestiona tus documentos personales
                            </p>
                        </div>
                        <div class="d-flex gap-3">
                            <div class="date-badge">
                                <i class="fas fa-calendar-alt"></i>
                                {{ now()->format('d F, Y') }}
                            </div>
                            <a href="{{ route('administrativos.dashboard') }}" class="back-btn">
                                <i class="fas fa-arrow-left"></i> Volver
                            </a>
                        </div>
                    </div>

                    <!-- Alertas -->
                    @if(session('success'))
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle"></i>
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ session('error') }}
                        </div>
                    @endif

                    @if(session('info'))
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i>
                            {{ session('info') }}
                        </div>
                    @endif

                    <!-- Nota informativa si faltan documentos -->
                    @if($estadisticas['faltantes'] > 0)
                        <div class="info-note">
                            <i class="fas fa-info-circle"></i>
                            Te faltan <strong>{{ $estadisticas['faltantes'] }}</strong> documento(s) por subir. Los documentos deben ser en formato PDF (máx. 5MB).
                        </div>
                    @endif

                    <!-- Estadísticas de documentos -->
                    <div class="stats-grid">
                        <div class="stats-card">
                            <div class="stats-icon">
                                <i class="fas fa-file-pdf"></i>
                            </div>
                            <div class="stats-content">
                                <h4>Requeridos</h4>
                                <div class="stats-number">{{ $estadisticas['total_requeridos'] }}</div>
                            </div>
                        </div>

                        <div class="stats-card">
                            <div class="stats-icon">
                                <i class="fas fa-cloud-upload-alt"></i>
                            </div>
                            <div class="stats-content">
                                <h4>Subidos</h4>
                                <div class="stats-number">{{ $estadisticas['total_subidos'] }}</div>
                            </div>
                        </div>

                        <div class="stats-card">
                            <div class="stats-icon">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="stats-content">
                                <h4>Aprobados</h4>
                                <div class="stats-number">{{ $estadisticas['aprobados'] }}</div>
                            </div>
                        </div>

                        <div class="stats-card">
                            <div class="stats-icon">
                                <i class="fas fa-hourglass-half"></i>
                            </div>
                            <div class="stats-content">
                                <h4>Pendientes</h4>
                                <div class="stats-number">{{ $estadisticas['pendientes'] }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Formulario de subida -->
                    <div class="upload-section">
                        <h3>
                            <i class="fas fa-cloud-upload-alt"></i>
                            Subir / Actualizar Documentos
                        </h3>

                        <form method="POST" action="{{ route('administrativos.subir-documentos') }}" enctype="multipart/form-data" class="upload-form">
                            @csrf

                            <div class="upload-grid">
                                @foreach($tiposDocumentos as $tipo => $info)
                                    <div class="upload-item">
                                        <label for="{{ $tipo }}">
                                            <i class="fas fa-{{ $info['icono'] }}"></i>
                                            {{ $info['nombre'] }}
                                        </label>
                                        <input type="file" 
                                               id="{{ $tipo }}" 
                                               name="{{ $tipo }}" 
                                               accept=".pdf">
                                        <small>{{ $info['descripcion'] }}</small>
                                    </div>
                                @endforeach
                            </div>

                            <div class="submit-btn">
                                <button type="submit" class="btn-primary">
                                    <i class="fas fa-upload"></i>
                                    Subir Documentos
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Tabla de documentos -->
                    <div class="documents-table">
                        <h3>
                            <i class="fas fa-list"></i>
                            Estado de Documentos
                        </h3>

                        <table>
                            <thead>
                                <tr>
                                    <th>Documento</th>
                                    <th>Estado</th>
                                    <th>Fecha Subida</th>
                                    <th>Observaciones</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($documentosParaVista as $documento)
                                    <tr>
                                        <td>
                                            <div class="document-name">
                                                <i class="fas fa-{{ $documento['icono'] }}"></i>
                                                {{ $documento['nombre'] }}
                                            </div>
                                        </td>
                                        <td>
                                            @if($documento['estado'] == 'aprobado')
                                                <span class="badge badge-success">
                                                    <i class="fas fa-check-circle"></i> Aprobado
                                                </span>
                                            @elseif($documento['estado'] == 'rechazado')
                                                <span class="badge badge-danger">
                                                    <i class="fas fa-times-circle"></i> Rechazado
                                                </span>
                                            @elseif($documento['estado'] == 'pendiente')
                                                <span class="badge badge-warning">
                                                    <i class="fas fa-clock"></i> Pendiente
                                                </span>
                                            @else
                                                <span class="badge badge-secondary">
                                                    <i class="fas fa-hourglass"></i> Faltante
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($documento['tiene_documento'])
                                                {{ $documento['fecha_subida']->format('d/m/Y H:i') }}
                                            @else
                                                <span style="color: #95a5a6;">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($documento['observaciones'])
                                                <div class="observaciones">
                                                    <i class="fas fa-comment"></i>
                                                    {{ $documento['observaciones'] }}
                                                </div>
                                            @else
                                                <span style="color: #95a5a6;">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($documento['tiene_documento'])
                                                <a href="{{ route('administrativos.documentos.ver', $documento['documento_id']) }}" target="_blank" class="action-btn" title="Ver documento">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('administrativos.documentos.descargar', $documento['documento_id']) }}" class="action-btn" title="Descargar">
                                                    <i class="fas fa-download"></i>
                                                </a>
                                            @else
                                                <span style="color: #95a5a6;">-</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        (function(){
            const navbar = document.querySelector('.navbar-top');

            window.addEventListener('scroll', function() {
                if (window.scrollY > 50) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
            });
        })();
    </script>
</body>
</html>