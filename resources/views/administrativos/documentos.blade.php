<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Documentos - Administrativo</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f8fafc;
            color: #0f172a;
            line-height: 1.5;
        }

        .header {
            background: white;
            padding: 0.75rem 2rem;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -1px rgba(0,0,0,0.03);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 100;
            border-bottom: 1px solid #e2e8f0;
        }

        .logo-area {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .logo-img {
            height: 45px;
            width: auto;
        }

        .logo-area h1 {
            font-size: 1.35rem;
            font-weight: 600;
            color: #0f172a;
            letter-spacing: -0.025em;
        }

        .logo-area span {
            color: #10b981;
            font-weight: 700;
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            background: #f8fafc;
            padding: 0.5rem 1rem;
            border-radius: 40px;
            border: 1px solid #e2e8f0;
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 1rem;
            box-shadow: 0 2px 4px rgba(16,185,129,0.3);
        }

        .user-details {
            line-height: 1.4;
        }

        .user-name {
            font-weight: 600;
            font-size: 0.9rem;
            color: #0f172a;
        }

        .user-role {
            font-size: 0.75rem;
            color: #64748b;
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .user-role i {
            font-size: 0.7rem;
            color: #10b981;
        }

        .logout-btn {
            background: none;
            border: 1px solid #e2e8f0;
            color: #64748b;
            padding: 0.5rem 1.25rem;
            border-radius: 40px;
            cursor: pointer;
            font-size: 0.85rem;
            font-weight: 500;
            transition: all 0.2s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .logout-btn:hover {
            background: #fef2f2;
            border-color: #ef4444;
            color: #ef4444;
        }

        .main-content {
            margin-top: 80px;
            padding: 2rem 2rem 3rem;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
        }

        .page-header {
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .page-header h2 {
            font-size: 1.8rem;
            font-weight: 700;
            color: #0f172a;
            letter-spacing: -0.025em;
            margin-bottom: 0.25rem;
        }

        .page-header p {
            color: #64748b;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .page-header p i {
            color: #10b981;
        }

        .back-btn {
            background: white;
            color: #64748b;
            border: 1px solid #e2e8f0;
            padding: 0.6rem 1.5rem;
            border-radius: 30px;
            font-weight: 500;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
        }

        .back-btn:hover {
            background: #f8fafc;
            color: #0f172a;
            border-color: #cbd5e1;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            border-radius: 16px;
            padding: 1.25rem;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -1px rgba(0,0,0,0.03);
            border: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            background: #ecfdf5;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #10b981;
            font-size: 1.5rem;
        }

        .stat-content h4 {
            font-size: 0.8rem;
            font-weight: 600;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 0.25rem;
        }

        .stat-content .number {
            font-size: 1.5rem;
            font-weight: 700;
            color: #0f172a;
        }

        .upload-section {
            background: white;
            border-radius: 20px;
            padding: 1.5rem;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -1px rgba(0,0,0,0.03);
            border: 1px solid #e2e8f0;
            margin-bottom: 2rem;
        }

        .upload-section h3 {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .upload-section h3 i {
            color: #10b981;
        }

        .upload-form {
            background: #f8fafc;
            padding: 1.5rem;
            border-radius: 12px;
        }

        .upload-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
        }

        .upload-item {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 1rem;
        }

        .upload-item label {
            display: block;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #0f172a;
            font-size: 0.9rem;
        }

        .upload-item label i {
            color: #10b981;
            margin-right: 0.3rem;
        }

        .upload-item input[type="file"] {
            width: 100%;
            padding: 0.5rem;
            border: 1px dashed #e2e8f0;
            border-radius: 8px;
            background: #f8fafc;
            font-size: 0.85rem;
        }

        .upload-item small {
            display: block;
            color: #64748b;
            font-size: 0.7rem;
            margin-top: 0.25rem;
        }

        .submit-btn {
            margin-top: 1.5rem;
            text-align: right;
        }

        .btn-primary {
            background: #10b981;
            color: white;
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 30px;
            font-weight: 500;
            font-size: 0.95rem;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            box-shadow: 0 4px 6px -1px rgba(16,185,129,0.2);
        }

        .btn-primary:hover {
            background: #059669;
            transform: translateY(-1px);
            box-shadow: 0 10px 15px -3px rgba(16,185,129,0.3);
        }

        .documents-table {
            background: white;
            border-radius: 20px;
            padding: 1.5rem;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -1px rgba(0,0,0,0.03);
            border: 1px solid #e2e8f0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            text-align: left;
            padding: 1rem 0.5rem;
            color: #64748b;
            font-weight: 600;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border-bottom: 1px solid #e2e8f0;
        }

        td {
            padding: 1rem 0.5rem;
            border-bottom: 1px solid #e2e8f0;
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
            width: 30px;
            height: 30px;
            background: #f1f5f9;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #10b981;
        }

        .badge {
            padding: 0.25rem 0.75rem;
            border-radius: 30px;
            font-size: 0.75rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
        }

        .badge-success {
            background: #d1fae5;
            color: #065f46;
        }

        .badge-warning {
            background: #fed7aa;
            color: #9a3412;
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
            color: #10b981;
            cursor: pointer;
            font-size: 1rem;
            padding: 0.25rem 0.5rem;
            transition: color 0.2s;
        }

        .action-btn:hover {
            color: #059669;
        }

        .observaciones {
            font-size: 0.8rem;
            color: #991b1b;
            background: #fee2e2;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            margin-top: 0.25rem;
        }

        .alert {
            padding: 1rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .alert-success {
            background: #d1fae5;
            border: 1px solid #a7f3d0;
            color: #065f46;
        }

        .alert-info {
            background: #dbeafe;
            border: 1px solid #bfdbfe;
            color: #1e40af;
        }

        .alert-warning {
            background: #fed7aa;
            border: 1px solid #fdba74;
            color: #9a3412;
        }

        .alert-danger {
            background: #fee2e2;
            border: 1px solid #fecaca;
            color: #991b1b;
        }

        .info-note {
            background: #ecfdf5;
            border-left: 4px solid #10b981;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
            color: #065f46;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        @media (max-width: 768px) {
            .header {
                padding: 0.75rem 1rem;
                flex-direction: column;
                gap: 0.75rem;
            }

            .user-menu {
                width: 100%;
                justify-content: space-between;
            }

            .main-content {
                padding: 1rem;
                margin-top: 120px;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .upload-grid {
                grid-template-columns: 1fr;
            }

            table {
                font-size: 0.85rem;
            }

            .action-btn {
                padding: 0.25rem;
            }
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="logo-area">
            <img src="{{ asset('img/logo_iufim.png') }}" alt="Logo IUFIM" class="logo-img">
            <h1>GEPROC <span>| Administrativos</span></h1>
        </div>

        <div class="user-menu">
            <div class="user-info">
                <div class="user-avatar">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div class="user-details">
                    <div class="user-name">{{ Auth::user()->name }}</div>
                    <div class="user-role">
                        <i class="fas fa-circle"></i>
                        Administrativo
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Salir</span>
                </button>
            </form>
        </div>
    </header>

    <main class="main-content">
        <div class="container">
            <div class="page-header">
                <div>
                    <h2>Mis Documentos</h2>
                    <p>
                        <i class="fas fa-file-pdf"></i>
                        Gestiona tus documentos personales
                    </p>
                </div>
                <a href="{{ route('administrativos.dashboard') }}" class="back-btn">
                    <i class="fas fa-arrow-left"></i> Volver al Dashboard
                </a>
            </div>

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

            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-file-pdf"></i>
                    </div>
                    <div class="stat-content">
                        <h4>Requeridos</h4>
                        <div class="number">{{ $estadisticas['total_requeridos'] }}</div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-cloud-upload-alt"></i>
                    </div>
                    <div class="stat-content">
                        <h4>Subidos</h4>
                        <div class="number">{{ $estadisticas['total_subidos'] }}</div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="stat-content">
                        <h4>Aprobados</h4>
                        <div class="number">{{ $estadisticas['aprobados'] }}</div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-hourglass-half"></i>
                    </div>
                    <div class="stat-content">
                        <h4>Pendientes</h4>
                        <div class="number">{{ $estadisticas['pendientes'] }}</div>
                    </div>
                </div>
            </div>

            @if($estadisticas['faltantes'] > 0)
                <div class="info-note">
                    <i class="fas fa-info-circle"></i>
                    Te faltan <strong>{{ $estadisticas['faltantes'] }}</strong> documento(s) por subir. Los documentos deben ser en formato PDF (máx. 5MB).
                </div>
            @endif

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
                <h3 style="margin-bottom: 1.5rem;">
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
                                        <span style="color: #94a3b8;">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if($documento['observaciones'])
                                        <div class="observaciones">
                                            <i class="fas fa-comment"></i>
                                            {{ $documento['observaciones'] }}
                                        </div>
                                    @else
                                        <span style="color: #94a3b8;">-</span>
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
                                        <span style="color: #94a3b8;">-</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>
</html>