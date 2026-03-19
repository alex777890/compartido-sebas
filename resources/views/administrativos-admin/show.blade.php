<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de Administrativo - Sistema GEPROC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
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
    }

    body { 
        background: white; 
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
        color: #333; 
        line-height: 1.6;
        padding: 0;
        margin: 0;
    }

    /* Barra superior */
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

    /* Barra de menú */
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
        font-size: 1.3rem;
        color: rgba(255, 255, 255, 0.9);
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
    }

    .content-container {
        background: white;
        border-radius: 6px;
        padding: 2rem;
        margin-bottom: 2rem;
        border: 1px solid var(--border-color);
        box-shadow: var(--card-shadow);
        max-width: 1200px;
        margin: 0 auto;
    }

    h2 { 
        color: var(--primary);
        margin-bottom: 1rem; 
        padding-bottom: 0.8rem;
        position: relative;
        font-size: 1.5rem;
    }
    
    h2::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 50px;
        height: 2px;
        background: var(--primary);
    }

    h3 {
        font-size: 1.2rem;
        margin-bottom: 1rem;
        color: var(--primary);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    /* Header */
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .back-btn {
        background: white;
        border: 1px solid var(--border-color);
        color: var(--text-muted);
        padding: 0.5rem 1.2rem;
        border-radius: 4px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: var(--transition);
    }

    .back-btn:hover {
        background: var(--light-bg);
        color: var(--primary);
        border-color: var(--primary);
    }

    /* Profile card */
    .profile-card {
        background: white;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        display: flex;
        gap: 2rem;
        align-items: center;
        flex-wrap: wrap;
    }

    .profile-avatar {
        width: 100px;
        height: 100px;
        background: linear-gradient(135deg, var(--primary), #2c6ae5);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 2.5rem;
    }

    .profile-info h4 {
        font-size: 1.5rem;
        margin-bottom: 0.5rem;
    }

    .profile-info p {
        color: var(--text-muted);
        margin-bottom: 0.25rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .profile-info i {
        color: var(--primary);
        width: 20px;
    }

    .profile-badge {
        background: rgba(7, 68, 182, 0.05);
        padding: 0.5rem 1rem;
        border-radius: 4px;
        border-left: 3px solid var(--primary);
        margin-top: 1rem;
    }

    /* Stats grid */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: white;
        padding: 1.2rem;
        border-radius: 8px;
        text-align: center;
        border: 1px solid var(--border-color);
    }

    .stat-card.success { border-left: 3px solid #28a745; }
    .stat-card.warning { border-left: 3px solid #ffc107; }
    .stat-card.danger { border-left: 3px solid #dc3545; }
    .stat-card.info { border-left: 3px solid var(--primary); }

    .stat-value {
        font-size: 2rem;
        font-weight: 700;
        color: var(--primary);
        line-height: 1.2;
    }

    .stat-label {
        color: var(--text-muted);
        font-size: 0.9rem;
    }

    /* Info grid */
    .info-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .info-item {
        background: var(--light-bg);
        padding: 1rem;
        border-radius: 6px;
        border: 1px solid var(--border-color);
    }

    .info-label {
        font-size: 0.8rem;
        color: var(--text-muted);
        text-transform: uppercase;
        margin-bottom: 0.25rem;
    }

    .info-value {
        font-weight: 600;
        color: var(--primary);
    }

    /* Documentos table */
    .documents-section {
        background: white;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        padding: 1.5rem;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
    }

    .table th {
        text-align: left;
        padding: 1rem 0.5rem;
        background: rgba(7, 68, 182, 0.05);
        color: var(--primary);
        font-weight: 600;
        border-bottom: 2px solid var(--border-color);
    }

    .table td {
        padding: 1rem 0.5rem;
        border-bottom: 1px solid var(--border-color);
        vertical-align: middle;
    }

    .badge {
        padding: 0.4rem 0.8rem;
        border-radius: 4px;
        font-size: 0.8rem;
        font-weight: 500;
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

    .badge-info {
        background: #dbeafe;
        color: #1e40af;
    }

    .action-btn {
        padding: 0.4rem 0.8rem;
        border: none;
        border-radius: 4px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        transition: var(--transition);
        font-size: 0.85rem;
    }

    .view-btn {
        background: rgba(7, 68, 182, 0.1);
        color: var(--primary);
        border: 1px solid rgba(7, 68, 182, 0.3);
    }

    .view-btn:hover {
        background: var(--primary);
        color: white;
    }

    .approve-btn {
        background: rgba(40, 167, 69, 0.1);
        color: #28a745;
        border: 1px solid rgba(40, 167, 69, 0.3);
    }

    .approve-btn:hover {
        background: #28a745;
        color: white;
    }

    .reject-btn {
        background: rgba(220, 53, 69, 0.1);
        color: #dc3545;
        border: 1px solid rgba(220, 53, 69, 0.3);
    }

    .reject-btn:hover {
        background: #dc3545;
        color: white;
    }

    .download-btn {
        background: rgba(255, 193, 7, 0.1);
        color: #ffc107;
        border: 1px solid rgba(255, 193, 7, 0.3);
    }

    .download-btn:hover {
        background: #ffc107;
        color: #212529;
    }

    .observaciones {
        font-size: 0.8rem;
        color: #dc3545;
        background: #fee2e2;
        padding: 0.25rem 0.5rem;
        border-radius: 4px;
        margin-top: 0.25rem;
    }

    .modal-content {
        border-radius: 8px;
    }

    .modal-header {
        background: var(--primary);
        color: white;
    }

    .modal-header .btn-close {
        filter: brightness(0) invert(1);
    }

    .btn-primary-custom {
        background: var(--primary);
        border: none;
        color: white;
        padding: 0.5rem 1.5rem;
        border-radius: 4px;
        transition: var(--transition);
    }

    .btn-primary-custom:hover {
        background: #063a9b;
    }

    .empty-state {
        text-align: center;
        padding: 3rem;
        color: var(--text-muted);
    }

    .empty-state i {
        font-size: 3rem;
        margin-bottom: 1rem;
        color: var(--border-color);
    }

    @media (max-width: 768px) {
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .info-grid {
            grid-template-columns: 1fr;
        }
        
        .profile-card {
            flex-direction: column;
            text-align: center;
        }
        
        .table-responsive {
            overflow-x: auto;
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
                    Sistema GEPROC
                </a>
            </div>
        </div>
    </nav>

    <!-- Segunda barra - Menú -->
    <nav class="navbar navbar-expand-lg navbar-menu">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('coordinaciones.*') ? 'active' : '' }}" href="{{ route('coordinaciones.index') }}">Coordinaciones</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('maestros.*') ? 'active' : '' }}" href="{{ route('maestros.index') }}">Maestros</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('contratos.*') ? 'active' : '' }}" href="{{ route('contracts.index') }}">Contratos</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}">Accesos</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.administrativos.*') ? 'active' : '' }}"href="{{ route('admin.administrativos.index') }}">Administrativos</a></ul>
                </ul>
                
                <div class="user-info-container">
                    <div class="user-info">
                        <span class="user-name">{{ Auth::user()->name }}</span>
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

    <div class="container-fluid">
        <div class="row">
            <div class="col-12 main-content">
                <div class="content-container">
                    <!-- Header -->
                    <div class="page-header">
                        <h2>
                            <i class="fas fa-user-cog me-2"></i>
                            Detalle del Administrativo
                        </h2>
                        <a href="{{ route('admin.administrativos.index') }}" class="back-btn">
                            <i class="fas fa-arrow-left"></i> Volver al listado
                        </a>
                    </div>

                    <!-- Alertas -->
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(session('warning'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            {{ session('warning') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <!-- Perfil -->
                    <div class="profile-card">
                        <div class="profile-avatar">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <div class="profile-info">
                            <h4>{{ $administrativo->nombre_completo }}</h4>
                            <p><i class="fas fa-envelope"></i> {{ $administrativo->user->email }}</p>
                            <p><i class="fas fa-phone"></i> {{ $administrativo->telefono }}</p>
                            <p><i class="fas fa-map-marker-alt"></i> {{ $administrativo->direccion }}</p>
                            <div class="profile-badge">
                                <strong>N° Empleado:</strong> {{ $administrativo->numero_empleado }} | 
                                <strong>Puesto:</strong> {{ $administrativo->puesto }} | 
                                <strong>Área:</strong> {{ $administrativo->area_adscripcion }}
                            </div>
                        </div>
                    </div>

                    <!-- Estadísticas de documentos -->
                    <div class="stats-grid">
                        <div class="stat-card info">
                            <div class="stat-value">{{ $totalDocumentos }}</div>
                            <div class="stat-label">Total Documentos</div>
                        </div>
                        <div class="stat-card success">
                            <div class="stat-value">{{ $documentosAprobados }}</div>
                            <div class="stat-label">Aprobados</div>
                        </div>
                        <div class="stat-card warning">
                            <div class="stat-value">{{ $documentosPendientes }}</div>
                            <div class="stat-label">Pendientes</div>
                        </div>
                        <div class="stat-card danger">
                            <div class="stat-value">{{ $documentosRechazados }}</div>
                            <div class="stat-label">Rechazados</div>
                        </div>
                    </div>

                    <!-- Información Personal Detallada -->
                    <h3><i class="fas fa-id-card"></i> Información Personal</h3>
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-label">CURP</div>
                            <div class="info-value">{{ $administrativo->curp }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">RFC</div>
                            <div class="info-value">{{ $administrativo->rfc }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Fecha Nacimiento</div>
                            <div class="info-value">{{ $administrativo->fecha_nacimiento->format('d/m/Y') }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Email Personal</div>
                            <div class="info-value">{{ $administrativo->email_personal }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Fecha Ingreso</div>
                            <div class="info-value">{{ $administrativo->fecha_ingreso->format('d/m/Y') }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Grado Máximo</div>
                            <div class="info-value">{{ $administrativo->maximo_grado_estudios ?? 'No especificado' }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Escolaridad</div>
                            <div class="info-value">{{ $administrativo->escolaridad ?? 'No especificada' }}</div>
                        </div>
                    </div>

                    <!-- Documentos -->
                    <div class="documents-section">
                        <h3><i class="fas fa-file-pdf"></i> Documentos Subidos</h3>

                        @if($documentos->count() > 0)
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Tipo</th>
                                            <th>Archivo</th>
                                            <th>Fecha Subida</th>
                                            <th>Estado</th>
                                            <th>Revisado por</th>
                                            <th>Observaciones</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($documentos as $doc)
                                            <tr>
                                                <td>
                                                    @if($doc->tipo == 'identificacion_oficial')
                                                        <i class="fas fa-id-card"></i> Identificación Oficial
                                                    @elseif($doc->tipo == 'comprobante_domicilio')
                                                        <i class="fas fa-home"></i> Comprobante Domicilio
                                                    @elseif($doc->tipo == 'curriculum')
                                                        <i class="fas fa-file-alt"></i> Currículum Vitae
                                                    @elseif($doc->tipo == 'acta_nacimiento')
                                                        <i class="fas fa-file"></i> Acta de Nacimiento
                                                    @else
                                                        {{ $doc->tipo }}
                                                    @endif
                                                </td>
                                                <td>{{ $doc->nombre_archivo }}</td>
                                                <td>{{ $doc->created_at->format('d/m/Y H:i') }}</td>
                                                <td>
                                                    @if($doc->estado == 'aprobado')
                                                        <span class="badge badge-success">
                                                            <i class="fas fa-check-circle"></i> Aprobado
                                                        </span>
                                                    @elseif($doc->estado == 'rechazado')
                                                        <span class="badge badge-danger">
                                                            <i class="fas fa-times-circle"></i> Rechazado
                                                        </span>
                                                    @else
                                                        <span class="badge badge-warning">
                                                            <i class="fas fa-clock"></i> Pendiente
                                                        </span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($doc->revisadoPor)
                                                        {{ $doc->revisadoPor->name }}<br>
                                                        <small>{{ $doc->fecha_revision->format('d/m/Y H:i') }}</small>
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($doc->observaciones_admin)
                                                        <div class="observaciones">
                                                            <i class="fas fa-comment"></i>
                                                            {{ $doc->observaciones_admin }}
                                                        </div>
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex gap-2">
                                                        <a href="{{ route('admin.documentos.ver', $doc->id) }}" target="_blank" class="action-btn view-btn" title="Ver documento">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('admin.documentos.descargar', $doc->id) }}" class="action-btn download-btn" title="Descargar">
                                                            <i class="fas fa-download"></i>
                                                        </a>
                                                        @if($doc->estado != 'aprobado')
                                                            <button onclick="abrirModalAprobar({{ $doc->id }})" class="action-btn approve-btn" title="Aprobar">
                                                                <i class="fas fa-check"></i>
                                                            </button>
                                                        @endif
                                                        @if($doc->estado != 'rechazado')
                                                            <button onclick="abrirModalRechazar({{ $doc->id }})" class="action-btn reject-btn" title="Rechazar">
                                                                <i class="fas fa-times"></i>
                                                            </button>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="empty-state">
                                <i class="fas fa-file-pdf"></i>
                                <h4>No hay documentos subidos</h4>
                                <p>Este administrativo aún no ha subido ningún documento.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Aprobar -->
    <div class="modal fade" id="modalAprobar" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-check-circle me-2"></i>
                        Aprobar Documento
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form method="POST" action="" id="formAprobar">
                    @csrf
                    <div class="modal-body">
                        <p>¿Está seguro de aprobar este documento?</p>
                        <p class="text-muted">Una vez aprobado, el documento aparecerá como válido para el administrativo.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-check"></i> Aprobar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Rechazar -->
    <div class="modal fade" id="modalRechazar" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-times-circle me-2"></i>
                        Rechazar Documento
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form method="POST" action="" id="formRechazar">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="observaciones" class="form-label">
                                Observaciones <span class="text-danger">*</span>
                            </label>
                            <textarea class="form-control" 
                                      id="observaciones" 
                                      name="observaciones" 
                                      rows="3" 
                                      required
                                      placeholder="Indique el motivo del rechazo..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-times"></i> Rechazar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function abrirModalAprobar(documentoId) {
            const form = document.getElementById('formAprobar');
            form.action = `{{ url('admin/documentos') }}/${documentoId}/aprobar`;
            
            const modal = new bootstrap.Modal(document.getElementById('modalAprobar'));
            modal.show();
        }

        function abrirModalRechazar(documentoId) {
            const form = document.getElementById('formRechazar');
            form.action = `{{ url('admin/documentos') }}/${documentoId}/rechazar`;
            
            const modal = new bootstrap.Modal(document.getElementById('modalRechazar'));
            modal.show();
        }

        setTimeout(() => {
            document.querySelectorAll('.alert').forEach(alert => {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
    </script>
</body>
</html>