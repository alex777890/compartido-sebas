<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover"/>
    <title>Mis Documentos - Administrativo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #0744b6ff;
            --primary-light: #3a6bd3;
            --secondary: #33CAE6;
            --accent: #26E63F;
            --light-bg: #F8F9FA;
            --border-color: #E9ECEF;
            --text-muted: #6C757D;
            --card-shadow: 0 5px 15px rgba(15, 126, 230, 0.08);
            --transition: all 0.3s ease;
            --danger-color: #ef4444;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            
            --font-size-base: 1rem;
            --font-size-lg: 1.1rem;
            --font-size-sm: 0.9rem;
            --font-size-h1: 1.8rem;
            --font-size-h2: 1.5rem;
            --font-size-h3: 1.3rem;
            --font-size-h4: 1.1rem;
        }

        body { 
            background: #f8fafc; 
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            color: #333; 
            line-height: 1.6;
            font-size: var(--font-size-base);
        }

        /* ========== BARRA SUPERIOR - LOGO Y TÍTULO ========== */
        .navbar-top { 
            background: white; 
            border-bottom: 1px solid var(--border-color);
            padding: 0.6rem 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            transition: var(--transition);
        }

        .navbar-top.scrolled {
            padding: 0.4rem 0;
            box-shadow: 0 5px 20px rgba(15, 126, 230, 0.15);
        }

        .navbar-brand { 
            color: var(--primary) !important; 
            font-weight: 600; 
            font-size: 1.2rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .navbar-brand::before {
            content: "";
            display: block;
            width: 4px;
            height: 24px;
            background: var(--primary);
            border-radius: 2px;
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo-img {
            height: 45px;
            width: auto;
            object-fit: contain;
        }

        /* ========== BARRA SECUNDARIA - SOLO USUARIO Y CERRAR SESIÓN ========== */
        .navbar-menu { 
            background: var(--primary); 
            padding: 0.6rem 0;
            position: sticky;
            top: 60px;
            z-index: 999;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        /* Contenedor de usuario - alineado a la derecha */
        .user-info-container {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 15px;
            flex-wrap: wrap;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
            color: white;
            background: rgba(255, 255, 255, 0.1);
            padding: 0.4rem 1rem;
            border-radius: 40px;
        }

        .user-name {
            font-weight: 500;
            font-size: 0.9rem;
            color: white;
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            background: rgba(255, 255, 255, 0.25);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            color: white;
            font-weight: 600;
        }

        .logout-btn {
            background: transparent;
            border: 1px solid rgba(255, 255, 255, 0.4);
            color: rgba(255, 255, 255, 0.9);
            padding: 0.4rem 1rem;
            border-radius: 40px;
            font-weight: 500;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9rem;
            text-decoration: none;
        }

        .logout-btn:hover {
            background: rgba(255, 255, 255, 0.15);
            color: white;
            border-color: rgba(255, 255, 255, 0.6);
        }

        /* Contenido principal */
        .main-content { 
            padding: 20px 16px;
            min-height: calc(100vh - 110px);
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
            margin-bottom: 0.8rem;
        }

        /* Grid de estadísticas */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .stats-card {
            background: white;
            border-radius: 16px;
            padding: 1.2rem;
            border: 1px solid var(--border-color);
            box-shadow: var(--card-shadow);
            display: flex;
            align-items: center;
            gap: 1rem;
            transition: var(--transition);
        }

        .stats-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(7, 68, 182, 0.12);
        }

        .stats-icon {
            width: 50px;
            height: 50px;
            background: #e8f0fe;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 1.4rem;
            flex-shrink: 0;
        }

        .stats-content h4 {
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 0.2rem;
        }

        .stats-number {
            font-size: 1.6rem;
            font-weight: 700;
            color: #1e293b;
            line-height: 1.2;
        }

        /* Sección de subida de documentos */
        .upload-section {
            background: white;
            border-radius: 16px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border: 1px solid var(--border-color);
            box-shadow: var(--card-shadow);
        }

        .upload-section h3 {
            font-size: var(--font-size-h4);
            color: var(--primary);
            margin-bottom: 1.2rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .upload-form {
            background: var(--light-bg);
            padding: 1.5rem;
            border-radius: 12px;
            border: 1px solid var(--border-color);
        }

        .upload-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.2rem;
            margin-bottom: 1.2rem;
        }

        .upload-item {
            background: white;
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 1rem;
        }

        .upload-item label {
            display: block;
            font-weight: 600;
            margin-bottom: 0.6rem;
            color: #333;
            font-size: 0.9rem;
        }

        .upload-item label i {
            color: var(--primary);
            margin-right: 0.5rem;
        }

        .upload-item input[type="file"] {
            width: 100%;
            padding: 0.6rem;
            border: 1px dashed var(--border-color);
            border-radius: 8px;
            background: var(--light-bg);
            font-size: 0.85rem;
        }

        .upload-item small {
            display: block;
            color: var(--text-muted);
            font-size: 0.7rem;
            margin-top: 0.4rem;
        }

        .submit-btn {
            text-align: right;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
            border: none;
            padding: 0.7rem 1.8rem;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
        }

        .btn-primary:hover {
            background: var(--primary-light);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(7, 68, 182, 0.3);
        }

        /* Tabla de documentos */
        .documents-table {
            background: white;
            border-radius: 16px;
            padding: 1.5rem;
            border: 1px solid var(--border-color);
            box-shadow: var(--card-shadow);
        }

        .documents-table h3 {
            font-size: var(--font-size-h4);
            color: var(--primary);
            margin-bottom: 1.2rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        /* Tabla responsiva */
        .table-responsive-custom {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 600px;
        }

        th {
            text-align: left;
            padding: 0.8rem 0.5rem;
            color: var(--text-muted);
            font-weight: 600;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border-bottom: 1px solid var(--border-color);
        }

        td {
            padding: 0.8rem 0.5rem;
            border-bottom: 1px solid var(--border-color);
            vertical-align: middle;
        }

        tr:last-child td {
            border-bottom: none;
        }

        .document-name {
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }

        .document-name i {
            width: 32px;
            height: 32px;
            background: #e8f0fe;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 0.9rem;
            flex-shrink: 0;
        }

        .badge {
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
        }

        .badge-success {
            background: #d1fae5;
            color: #065f46;
        }

        .badge-warning {
            background: #fef3c7;
            color: #92400e;
        }

        .badge-danger {
            background: #fee2e2;
            color: #991b1b;
        }

        .badge-secondary {
            background: #f1f5f9;
            color: #475569;
        }

        .action-btn {
            background: none;
            border: none;
            color: var(--primary);
            cursor: pointer;
            font-size: 0.9rem;
            padding: 0.3rem 0.5rem;
            transition: var(--transition);
            display: inline-block;
        }

        .action-btn:hover {
            color: var(--primary-light);
            transform: scale(1.1);
        }

        .observaciones {
            font-size: 0.75rem;
            color: #991b1b;
            background: #fee2e2;
            padding: 0.3rem 0.6rem;
            border-radius: 6px;
            display: inline-block;
            max-width: 200px;
            word-break: break-word;
        }

        /* Alertas */
        .alert {
            padding: 0.8rem 1rem;
            border-radius: 12px;
            margin-bottom: 1.2rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            border: 1px solid;
            font-size: 0.85rem;
        }

        .alert-success {
            background: #d1fae5;
            border-color: #a7f3d0;
            color: #065f46;
        }

        .alert-info {
            background: #dbeafe;
            border-color: #bfdbfe;
            color: #1e40af;
        }

        .alert-warning {
            background: #fef3c7;
            border-color: #fde68a;
            color: #92400e;
        }

        .alert-danger {
            background: #fee2e2;
            border-color: #fecaca;
            color: #991b1b;
        }

        .info-note {
            background: #e8f0fe;
            border-left: 4px solid var(--primary);
            padding: 1rem;
            border-radius: 12px;
            margin-bottom: 1.2rem;
            font-size: 0.85rem;
            color: #333;
            display: flex;
            align-items: center;
            gap: 0.8rem;
            border: 1px solid rgba(7, 68, 182, 0.2);
        }

        .info-note i {
            color: var(--primary);
            font-size: 1rem;
        }

        .back-btn {
            background: transparent;
            border: 2px solid var(--primary);
            color: var(--primary);
            padding: 0.5rem 1.2rem;
            border-radius: 10px;
            font-weight: 500;
            transition: var(--transition);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.85rem;
        }

        .back-btn:hover {
            background: rgba(7, 68, 182, 0.05);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(7, 68, 182, 0.15);
        }

        .date-badge {
            background: white;
            border: 1px solid var(--border-color);
            border-radius: 40px;
            padding: 0.5rem 1rem;
            font-size: 0.85rem;
            color: var(--text-muted);
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .page-header {
            margin-bottom: 1.5rem;
        }

        /* ===== MEDIA QUERIES RESPONSIVAS ===== */
        
        /* Tablets */
        @media (max-width: 992px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 1rem;
            }
            
            .upload-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
            
            .navbar-menu {
                top: 57px;
            }
        }

        /* Móviles */
        @media (max-width: 768px) {
            :root {
                --font-size-base: 0.95rem;
                --font-size-h1: 1.6rem;
                --font-size-h2: 1.4rem;
                --font-size-h3: 1.2rem;
                --font-size-h4: 1rem;
            }
            
            .navbar-top {
                padding: 0.5rem 0;
            }
            
            .logo-img {
                height: 40px;
            }
            
            .navbar-brand {
                font-size: 1rem;
            }
            
            .navbar-menu {
                top: 53px;
            }
            
            .user-info-container {
                justify-content: center;
                width: 100%;
                flex-direction: column;
                align-items: stretch;
            }
            
            .user-info {
                justify-content: center;
                width: 100%;
            }
            
            .logout-btn {
                justify-content: center;
                width: 100%;
            }
            
            .main-content {
                padding: 15px 12px;
            }
            
            .page-header {
                flex-direction: column;
                gap: 1rem;
                align-items: flex-start;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
                gap: 0.8rem;
            }
            
            .stats-card {
                padding: 1rem;
            }
            
            .stats-icon {
                width: 45px;
                height: 45px;
                font-size: 1.2rem;
            }
            
            .stats-number {
                font-size: 1.4rem;
            }
            
            .upload-section, .documents-table {
                padding: 1.2rem;
            }
            
            .upload-form {
                padding: 1.2rem;
            }
            
            .upload-item {
                padding: 0.8rem;
            }
            
            .submit-btn {
                text-align: center;
            }
            
            .btn-primary {
                width: 100%;
                justify-content: center;
            }
            
            .d-flex.justify-content-between {
                flex-direction: column;
                gap: 0.8rem;
                align-items: flex-start;
            }
            
            .d-flex.gap-3 {
                flex-direction: column;
                width: 100%;
            }
            
            .date-badge, .back-btn {
                justify-content: center;
                width: 100%;
            }
        }

        /* Móviles pequeños */
        @media (max-width: 480px) {
            .logo-img {
                height: 35px;
            }
            
            .navbar-brand {
                font-size: 0.9rem;
            }
            
            .stats-icon {
                width: 40px;
                height: 40px;
                font-size: 1rem;
            }
            
            .stats-number {
                font-size: 1.2rem;
            }
            
            .stats-content h4 {
                font-size: 0.65rem;
            }
            
            .badge {
                font-size: 0.7rem;
                padding: 0.25rem 0.6rem;
            }
            
            .document-name i {
                width: 28px;
                height: 28px;
                font-size: 0.8rem;
            }
            
            .document-name span {
                font-size: 0.85rem;
            }
            
            .observaciones {
                font-size: 0.7rem;
                max-width: 150px;
            }
        }
    </style>
</head>
<body>
    <!-- Primera barra - Solo Logo y título -->
    <nav class="navbar navbar-expand-lg navbar-top">
        <div class="container">
            <div class="logo-container">
                <img src="{{ asset('img/logo_iufim.png') }}" alt="Logo" class="logo-img">
                <a class="navbar-brand" href="{{ route('administrativos.dashboard') }}">
                    GEPROC | Administrativos
                </a>
            </div>
        </div>
    </nav>

    <!-- Segunda barra - Solo Usuario y Cerrar Sesión -->
    <nav class="navbar navbar-menu">
        <div class="container">
            <div class="user-info-container">
                <div class="user-info">
                    <div class="user-avatar">
                        {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                    </div>
                    <span class="user-name">{{ Auth::user()->name ?? 'Administrador' }}</span>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="logout-form">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                    </button>
                </form>
            </div>
        </div>
    </nav>
    
    <!-- Contenido principal -->
    <div class="main-content">
        <div class="container">
            <!-- Cabecera con fecha y botón volver -->
            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3 page-header">
                <div>
                    <h2>Mis Documentos</h2>
                    <p style="color: var(--text-muted); font-size: 0.9rem; margin: 0;">
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
            @if(isset($estadisticas['faltantes']) && $estadisticas['faltantes'] > 0)
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
                        <div class="stats-number">{{ $estadisticas['total_requeridos'] ?? 0 }}</div>
                    </div>
                </div>

                <div class="stats-card">
                    <div class="stats-icon">
                        <i class="fas fa-cloud-upload-alt"></i>
                    </div>
                    <div class="stats-content">
                        <h4>Subidos</h4>
                        <div class="stats-number">{{ $estadisticas['total_subidos'] ?? 0 }}</div>
                    </div>
                </div>

                <div class="stats-card">
                    <div class="stats-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="stats-content">
                        <h4>Aprobados</h4>
                        <div class="stats-number">{{ $estadisticas['aprobados'] ?? 0 }}</div>
                    </div>
                </div>

                <div class="stats-card">
                    <div class="stats-icon">
                        <i class="fas fa-hourglass-half"></i>
                    </div>
                    <div class="stats-content">
                        <h4>Pendientes</h4>
                        <div class="stats-number">{{ $estadisticas['pendientes'] ?? 0 }}</div>
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
                        @foreach($tiposDocumentos ?? [] as $tipo => $info)
                            <div class="upload-item">
                                <label for="{{ $tipo }}">
                                    <i class="fas fa-{{ $info['icono'] ?? 'file' }}"></i>
                                    {{ $info['nombre'] }}
                                </label>
                                <input type="file" 
                                       id="{{ $tipo }}" 
                                       name="{{ $tipo }}" 
                                       accept=".pdf">
                                <small>{{ $info['descripcion'] ?? 'Documento requerido' }}</small>
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

                <div class="table-responsive-custom">
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
                            @foreach($documentosParaVista ?? [] as $documento)
                                <tr>
                                    <td>
                                        <div class="document-name">
                                            <i class="fas fa-{{ $documento['icono'] ?? 'file' }}"></i>
                                            <span>{{ $documento['nombre'] }}</span>
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
                                        @if($documento['tiene_documento'] && isset($documento['fecha_subida']))
                                            {{ \Carbon\Carbon::parse($documento['fecha_subida'])->format('d/m/Y H:i') }}
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        (function(){
            const navbar = document.querySelector('.navbar-top');
            if (navbar) {
                window.addEventListener('scroll', function() {
                    if (window.scrollY > 50) {
                        navbar.classList.add('scrolled');
                    } else {
                        navbar.classList.remove('scrolled');
                    }
                });
            }
        })();
    </script>
</body>
</html>