<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover"/>
    <title>Mis Documentos - Administrativo | GEPROC</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
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

        /* MAIN CONTENT */
        .main-content {
            flex: 1;
        }

        .content-wrapper {
            padding: 30px 35px;
            max-width: 100%;
        }

        /* FECHA BADGE */
        .date-badge {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 10px 20px;
            background-color: white;
            border: 2px solid var(--border-color);
            border-radius: 50px;
            font-size: 14px;
            font-weight: 600;
            color: var(--text-muted);
            transition: var(--transition);
        }

        .date-badge:hover {
            transform: translateY(-2px);
            box-shadow: var(--card-shadow);
            border-color: var(--primary-light);
        }

        .date-badge i {
            color: var(--primary);
            font-size: 16px;
        }

        /* BOTÓN VOLVER */
        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
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

        .back-btn:hover {
            background-color: var(--primary);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 12px rgba(7, 68, 182, 0.2);
        }

        /* HEADER DEL CONTENIDO */
        .content-header {
            margin-bottom: 5px;
        }

        .content-header h1 {
            font-size: 28px;
            font-weight: 750        ;
            color: #1e293b;
            margin: 0 0 8px 0;
            position: relative;
            padding-bottom: 8px;
        }

        .content-header h1::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 3px;
            border-radius: 2px;
        }

        .content-header p {
            color: var(--text-muted);
            font-size: 15px;
            margin: 0;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        /* CARDS GRID - ESTADÍSTICAS */
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

        .card-icon.requeridos { background: var(--gradient-primary); }
        .card-icon.subidos { background: var(--gradient-success); }
        .card-icon.aprobados { background: var(--gradient-info); }
        .card-icon.pendientes { background: var(--gradient-warning); }

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

        /* SECCIONES GENERALES */
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

        /* NOTA INFORMATIVA */
        .info-note {
            background-color: var(--primary-soft);
            border-left: 4px solid var(--primary);
            padding: 15px 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 15px;
            font-size: 14px;
            color: #2d3748;
        }

        .info-note i {
            color: var(--primary);
            font-size: 20px;
        }

        /* FORMULARIO DE SUBIDA */
        .upload-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 25px;
        }

        .upload-item {
            background-color: var(--light-bg);
            border: 2px solid var(--border-color);
            border-radius: 12px;
            padding: 18px;
            transition: var(--transition);
        }

        .upload-item:hover {
            border-color: var(--primary-light);
            transform: translateY(-2px);
            box-shadow: var(--card-shadow);
        }

        .upload-item label {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 700;
            font-size: 15px;
            color: var(--primary);
            margin-bottom: 12px;
        }

        .upload-item label i {
            font-size: 18px;
        }

        .upload-item input[type="file"] {
            width: 100%;
            padding: 10px;
            border: 2px dashed var(--border-color);
            border-radius: 10px;
            background-color: white;
            font-size: 14px;
            transition: var(--transition);
        }

        .upload-item input[type="file"]:hover {
            border-color: var(--primary);
        }

        .upload-item small {
            display: block;
            color: var(--text-muted);
            font-size: 12px;
            margin-top: 8px;
        }

        /* BOTÓN DE SUBIDA */
        .btn-upload {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 14px 32px;
            background: var(--gradient-primary);
            color: white;
            border: none;
            border-radius: 12px;
            font-weight: 700;
            font-size: 16px;
            cursor: pointer;
            transition: var(--transition);
            box-shadow: 0 5px 15px rgba(7, 68, 182, 0.25);
        }

        .btn-upload:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(7, 68, 182, 0.35);
        }

        .submit-container {
            display: flex;
            justify-content: flex-end;
            margin-top: 10px;
        }

        /* TABLA DE DOCUMENTOS */
        .documents-table-container {
            overflow-x: auto;
        }

        .documents-table {
            width: 100%;
            border-collapse: collapse;
        }

        .documents-table th {
            text-align: left;
            padding: 15px 12px;
            color: var(--text-muted);
            font-weight: 600;
            font-size: 14px;
            border-bottom: 2px solid var(--border-color);
        }

        .documents-table td {
            padding: 15px 12px;
            border-bottom: 1px solid var(--border-color);
            vertical-align: middle;
        }

        .documents-table tr:hover td {
            background-color: var(--primary-soft);
        }

        .document-name {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .document-name i {
            width: 36px;
            height: 36px;
            background: var(--primary-soft);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 16px;
        }

        .document-name span {
            font-weight: 600;
            color: #2d3748;
        }

        /* BADGES */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            border-radius: 50px;
            font-size: 13px;
            font-weight: 600;
        }

        .badge-success {
            background: var(--success-light);
            color: #065f46;
        }

        .badge-warning {
            background: var(--warning-light);
            color: #92400e;
        }

        .badge-danger {
            background: var(--danger-light);
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
            font-size: 16px;
            padding: 8px;
            transition: var(--transition);
            border-radius: 8px;
        }

        .action-btn:hover {
            background-color: var(--primary-soft);
            transform: scale(1.1);
        }

        .observaciones {
            background-color: var(--danger-light);
            color: #991b1b;
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 12px;
            display: inline-block;
            max-width: 200px;
            word-break: break-word;
        }

        .observaciones i {
            margin-right: 4px;
        }

        /* ALERTAS */
        .alert {
            padding: 15px 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 15px;
            border-left: 6px solid transparent;
            animation: slideIn 0.3s ease;
            font-size: 15px;
            box-shadow: var(--card-shadow);
        }

        .alert-success {
            background-color: var(--success-light);
            border-color: var(--success-color);
            color: #065f46;
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
            .cards-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .upload-grid {
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
            
            .header-right {
                flex-wrap: wrap;
                justify-content: flex-end;
            }
            
            .content-header h1 {
                font-size: 24px;
            }
            
            .header-actions {
                margin-top: 10px;
                width: 100%;
            }
            
            .back-btn, .date-badge {
                width: 100%;
                justify-content: center;
            }
            
            .submit-container {
                justify-content: center;
            }
            
            .btn-upload {
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
            
            .logout-button {
                padding: 10px 20px;
                font-size: 14px;
            }
            
            .badge {
                padding: 4px 10px;
                font-size: 11px;
            }
            
            .documents-table th, .documents-table td {
                padding: 10px 8px;
                font-size: 13px;
            }
        }
    </style>
</head>
<body>
    <div class="main-content">
        <!-- HEADER SUPERIOR -->
        <div class="header">
            <div class="header-left">
                <div class="header-logo">
                    <img src="{{ asset('img/logo_iufim.png') }}" alt="Logo IUFIM" class="logo-img-header">
                </div>
            </div>
            
            <div class="header-right">
                    
                <form method="POST" action="{{ route('logout') }}" class="logout-form">
                    @csrf
                    <button type="submit" class="logout-button">
                        <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                    </button>
                </form>
            </div>
        </div>

        <!-- CONTENIDO PRINCIPAL -->
        <div class="content-wrapper">
            <!-- CABECERA -->
            <div style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 20px; margin-bottom: 25px;">
                <div class="content-header">
                    <h1>Mis Documentos</h1>
                    <p>
                        <i class="fas fa-file-pdf" style="color: var(--primary); margin-right: 8px;"></i>
                        Gestiona tus documentos personales
                    </p>
                </div>
                <div class="header-actions">
                    
                    <a href="{{ route('administrativos.dashboard') }}" class="back-btn">
                        <i class="fas fa-arrow-left"></i> Volver al Panel
                    </a>
                </div>
            </div>

            <!-- ALERTAS -->
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

            <!-- NOTA INFORMATIVA SI FALTAN DOCUMENTOS -->
            @if(isset($estadisticas['faltantes']) && $estadisticas['faltantes'] > 0)
                <div class="info-note">
                    <i class="fas fa-info-circle"></i>
                    <span>Te faltan <strong>{{ $estadisticas['faltantes'] }}</strong> documento(s) por subir. Los documentos deben ser en formato <strong>PDF</strong> (máx. 4MB).</span>
                </div>
            @endif

            <!-- ESTADÍSTICAS DE DOCUMENTOS -->
            <div class="cards-grid">
                <div class="card">
                    <div class="card-header">
                        <div class="card-icon requeridos">
                            <i class="fas fa-file-pdf"></i>
                        </div>
                        <div class="card-title">
                            <h3>Documentos Requeridos</h3>
                        </div>
                    </div>
                    <div class="card-value">{{ $estadisticas['total_requeridos'] ?? 0 }}</div>
                    <div class="card-footer">Total de documentos solicitados</div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <div class="card-icon subidos">
                            <i class="fas fa-cloud-upload-alt"></i>
                        </div>
                        <div class="card-title">
                            <h3>Documentos Subidos</h3>
                        </div>
                    </div>
                    <div class="card-value">{{ $estadisticas['total_subidos'] ?? 0 }}</div>
                    <div class="card-footer">Documentos ya cargados</div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <div class="card-icon aprobados">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="card-title">
                            <h3>Aprobados</h3>
                        </div>
                    </div>
                    <div class="card-value">{{ $estadisticas['aprobados'] ?? 0 }}</div>
                    <div class="card-footer">Documentos validados</div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <div class="card-icon pendientes">
                            <i class="fas fa-hourglass-half"></i>
                        </div>
                        <div class="card-title">
                            <h3>Pendientes</h3>
                        </div>
                    </div>
                    <div class="card-value">{{ $estadisticas['pendientes'] ?? 0 }}</div>
                    <div class="card-footer">Esperando revisión</div>
                </div>
            </div>

            <!-- FORMULARIO DE SUBIDA DE DOCUMENTOS -->
            <div class="section">
                <div class="section-header">
                    <div class="section-title">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <span>Subir / Actualizar Documentos</span>
                    </div>
                </div>

                <form method="POST" action="{{ route('administrativos.subir-documentos') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="upload-grid">
                        @foreach($tiposDocumentos ?? [] as $tipo => $info)
                            <div class="upload-item">
                                <label for="{{ $tipo }}">
                                    <i class="fas fa-{{ $info['icono'] ?? 'file-pdf' }}"></i>
                                    {{ $info['nombre'] }}
                                </label>
                                <input type="file" 
                                       id="{{ $tipo }}" 
                                       name="{{ $tipo }}" 
                                       accept=".pdf">
                                <small>{{ $info['descripcion'] ?? 'Documento requerido en formato PDF' }}</small>
                            </div>
                        @endforeach
                    </div>

                    <div class="submit-container">
                        <button type="submit" class="btn-upload">
                            <i class="fas fa-upload"></i>
                            Subir Documentos
                        </button>
                    </div>
                </form>
            </div>

            <!-- TABLA DE DOCUMENTOS -->
            <div class="section">
                <div class="section-header">
                    <div class="section-title">
                        <i class="fas fa-list"></i>
                        <span>Estado de Documentos</span>
                    </div>
                </div>

                <div class="documents-table-container">
                    <table class="documents-table">
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
                                            <i class="fas fa-{{ $documento['icono'] ?? 'file-pdf' }}"></i>
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

    <script>
        (function(){
            const header = document.querySelector('.header');
            if (header) {
                window.addEventListener('scroll', function() {
                    if (window.scrollY > 50) {
                        header.classList.add('scrolled');
                    } else {
                        header.classList.remove('scrolled');
                    }
                });
            }
        })();
    </script>
</body>
</html>