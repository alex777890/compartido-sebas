<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Administrativo - GEPROC</title>
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

        /* Header */
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

        /* Contenido principal */
        .main-content {
            margin-top: 80px;
            padding: 2rem 2rem 3rem;
        }

        .container {
            max-width: 1280px;
            margin: 0 auto;
        }

        /* Cabecera de página */
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
            font-size: 0.9rem;
        }

        .date-badge {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 40px;
            padding: 0.5rem 1.25rem;
            font-size: 0.85rem;
            color: #64748b;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .date-badge i {
            color: #10b981;
        }

        /* Tarjetas de bienvenida y perfil */
        .welcome-card {
            background: white;
            border-radius: 20px;
            padding: 1.5rem;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -1px rgba(0,0,0,0.03);
            border: 1px solid #e2e8f0;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .welcome-avatar {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2rem;
        }

        .welcome-content h3 {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .welcome-content p {
            color: #64748b;
            margin-bottom: 0.5rem;
        }

        .profile-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: #ecfdf5;
            color: #065f46;
            padding: 0.35rem 1rem;
            border-radius: 40px;
            font-size: 0.85rem;
            font-weight: 500;
            border: 1px solid #a7f3d0;
        }

        .profile-badge i {
            font-size: 0.8rem;
        }

        /* Grid de estadísticas */
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

        /* Tarjeta de perfil */
        .profile-card {
            background: white;
            border-radius: 20px;
            padding: 1.5rem;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -1px rgba(0,0,0,0.03);
            border: 1px solid #e2e8f0;
            margin-bottom: 2rem;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #e2e8f0;
        }

        .card-header h3 {
            font-size: 1.1rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .card-header h3 i {
            color: #10b981;
        }

        .edit-btn {
            background: none;
            border: 1px solid #e2e8f0;
            color: #64748b;
            padding: 0.4rem 1rem;
            border-radius: 30px;
            font-size: 0.8rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
        }

        .edit-btn:hover {
            background: #f8fafc;
            color: #10b981;
            border-color: #10b981;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
        }

        .info-item {
            display: flex;
            flex-direction: column;
        }

        .info-label {
            font-size: 0.7rem;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 0.25rem;
        }

        .info-value {
            font-weight: 500;
            color: #0f172a;
            font-size: 0.95rem;
        }

        /* Tabla de documentos */
        .documents-section {
            background: white;
            border-radius: 20px;
            padding: 1.5rem;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -1px rgba(0,0,0,0.03);
            border: 1px solid #e2e8f0;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .btn-primary {
            background: #10b981;
            color: white;
            border: none;
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
            box-shadow: 0 4px 6px -1px rgba(16,185,129,0.2);
        }

        .btn-primary:hover {
            background: #059669;
            transform: translateY(-1px);
            box-shadow: 0 10px 15px -3px rgba(16,185,129,0.3);
        }

        .btn-outline {
            background: white;
            color: #10b981;
            border: 1px solid #10b981;
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

        .btn-outline:hover {
            background: #ecfdf5;
        }

        .documents-table {
            width: 100%;
            border-collapse: collapse;
        }

        .documents-table th {
            text-align: left;
            padding: 1rem 0.5rem;
            color: #64748b;
            font-weight: 600;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border-bottom: 1px solid #e2e8f0;
        }

        .documents-table td {
            padding: 1rem 0.5rem;
            border-bottom: 1px solid #e2e8f0;
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
            padding: 0.25rem;
            transition: color 0.2s;
        }

        .action-btn:hover {
            color: #059669;
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

        /* Actividades recientes */
        .activities-section {
            margin-top: 2rem;
        }

        .activity-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            border-bottom: 1px solid #e2e8f0;
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }

        .activity-icon.success {
            background: #d1fae5;
            color: #065f46;
        }

        .activity-icon.warning {
            background: #fed7aa;
            color: #9a3412;
        }

        .activity-icon.info {
            background: #dbeafe;
            color: #1e40af;
        }

        .activity-content {
            flex: 1;
        }

        .activity-title {
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .activity-desc {
            font-size: 0.85rem;
            color: #64748b;
        }

        .activity-time {
            font-size: 0.75rem;
            color: #94a3b8;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .info-grid {
                grid-template-columns: repeat(2, 1fr);
            }
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
                grid-template-columns: 1fr;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .welcome-card {
                flex-direction: column;
                text-align: center;
            }

            .section-header {
                flex-direction: column;
                gap: 1rem;
                align-items: flex-start;
            }

            .documents-table {
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
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

    <!-- Contenido principal -->
    <main class="main-content">
        <div class="container">
            <!-- Cabecera con fecha -->
            <div class="page-header">
                <div>
                    <h2>Panel Administrativo</h2>
                    <p>
                        <i class="fas fa-user-cog"></i>
                        Gestiona tu información y documentos personales
                    </p>
                </div>
                <div class="date-badge">
                    <i class="fas fa-calendar-alt"></i>
                    {{ now()->format('d F, Y') }}
                </div>
            </div>

            <!-- Alertas -->
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('info'))
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i>
                    {{ session('info') }}
                </div>
            @endif

            @if(session('warning'))
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle"></i>
                    {{ session('warning') }}
                </div>
            @endif

            <!-- Tarjeta de bienvenida con información del perfil -->
            <div class="welcome-card">
                <div class="welcome-avatar">
                    <i class="fas fa-user-tie"></i>
                </div>
                <div class="welcome-content">
                    <h3>¡Bienvenido, {{ $administrativo->nombres }}!</h3>
                    <p>{{ $administrativo->puesto }} • {{ $administrativo->area_adscripcion }}</p>
                    <span class="profile-badge">
                        <i class="fas fa-id-card"></i>
                        N° Empleado: {{ $administrativo->numero_empleado }}
                    </span>
                </div>
            </div>

            <!-- Estadísticas de documentos -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-file-pdf"></i>
                    </div>
                    <div class="stat-content">
                        <h4>Documentos Requeridos</h4>
                        <div class="number">{{ $estadisticas['total_requeridos'] }}</div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-cloud-upload-alt"></i>
                    </div>
                    <div class="stat-content">
                        <h4>Documentos Subidos</h4>
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

            <!-- Información del Perfil -->
            <div class="profile-card">
                <div class="card-header">
                    <h3>
                        <i class="fas fa-id-card"></i>
                        Información Personal
                    </h3>
                    <a href="{{ route('administrativos.editar-perfil') }}" class="edit-btn">
                        <i class="fas fa-edit"></i> Editar Perfil
                    </a>
                </div>

                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label">Nombre Completo</span>
                        <span class="info-value">{{ $administrativo->nombre_completo }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">CURP</span>
                        <span class="info-value">{{ $administrativo->curp }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">RFC</span>
                        <span class="info-value">{{ $administrativo->rfc }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Fecha Nacimiento</span>
                        <span class="info-value">{{ $administrativo->fecha_nacimiento->format('d/m/Y') }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Teléfono</span>
                        <span class="info-value">{{ $administrativo->telefono }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Email Personal</span>
                        <span class="info-value">{{ $administrativo->email_personal }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Dirección</span>
                        <span class="info-value">{{ $administrativo->direccion }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Fecha Ingreso</span>
                        <span class="info-value">{{ $administrativo->fecha_ingreso->format('d/m/Y') }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Grado Máximo</span>
                        <span class="info-value">{{ $administrativo->maximo_grado_estudios ?? 'No especificado' }}</span>
                    </div>
                </div>
            </div>

            <!-- Documentos -->
            <div class="documents-section">
                <div class="section-header">
                    <h3>
                        <i class="fas fa-file-pdf"></i>
                        Documentos Requeridos
                        <span style="font-size: 0.8rem; color: #64748b; margin-left: 0.5rem;">
                            ({{ $estadisticas['total_subidos'] }}/{{ $estadisticas['total_requeridos'] }})
                        </span>
                    </h3>
                    <a href="{{ route('administrativos.documentos') }}" class="btn-outline">
                        <i class="fas fa-arrow-right"></i> Ver Todos
                    </a>
                </div>

                <table class="documents-table">
                    <thead>
                        <tr>
                            <th>Documento</th>
                            <th>Estado</th>
                            <th>Fecha Subida</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(array_slice($documentosParaVista, 0, 3) as $documento)
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
                                        {{ $documento['fecha_subida']->format('d/m/Y') }}
                                    @else
                                        <span style="color: #94a3b8;">No subido</span>
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

                @if(count($documentosParaVista) > 3)
                    <div style="text-align: center; margin-top: 1rem;">
                        <a href="{{ route('administrativos.documentos') }}" style="color: #10b981; text-decoration: none; font-size: 0.9rem;">
                            Ver todos los documentos ({{ count($documentosParaVista) - 3 }} más)
                        </a>
                    </div>
                @endif
            </div>

            <!-- Actividades Recientes -->
            @if(isset($actividadesRecientes) && count($actividadesRecientes) > 0)
                <div class="activities-section">
                    <h3 style="margin-bottom: 1rem; font-size: 1rem;">
                        <i class="fas fa-history" style="color: #10b981; margin-right: 0.5rem;"></i>
                        Actividades Recientes
                    </h3>

                    @foreach($actividadesRecientes as $actividad)
                        <div class="activity-item">
                            <div class="activity-icon {{ $actividad['tipo'] }}">
                                @if($actividad['tipo'] == 'aprobado')
                                    <i class="fas fa-check-circle"></i>
                                @elseif($actividad['tipo'] == 'rechazado')
                                    <i class="fas fa-times-circle"></i>
                                @else
                                    <i class="fas fa-clock"></i>
                                @endif
                            </div>
                            <div class="activity-content">
                                <div class="activity-title">{{ $actividad['titulo'] }}</div>
                                <div class="activity-desc">{{ $actividad['descripcion'] }}</div>
                            </div>
                            <div class="activity-time">{{ $actividad['tiempo'] }}</div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </main>
</body>
</html>