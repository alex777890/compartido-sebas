<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documentos de Administrativo - Sistema GEPROC</title>
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

    .navbar-menu { 
        background: var(--primary); 
        padding: 0.7rem 0;
        position: sticky;
        top: 68px;
        z-index: 999;
    }

    .navbar-menu .nav-link {
        font-weight: 500;
        color: rgba(255, 255, 255, 0.9) !important;
        padding: 0.6rem 1.5rem !important;
        border-radius: 4px;
        transition: var(--transition);
        font-size: 0.95rem;
    }

    .navbar-menu .nav-link:hover, 
    .navbar-menu .nav-link.active {
        color: white !important;
        background-color: rgba(255, 255, 255, 0.12);
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

    .navbar-menu .logout-btn {
        background: transparent;
        border: 1px solid rgba(255, 255, 255, 0.4);
        color: rgba(255, 255, 255, 0.9);
        padding: 0.4rem 1rem;
        border-radius: 4px;
        transition: var(--transition);
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.9rem;
    }

    .navbar-menu .logout-btn:hover {
        background: rgba(255, 255, 255, 0.1);
        color: white;
    }

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
        margin: 2rem 0 1rem;
        color: var(--primary);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

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

    .info-card {
        background: var(--light-bg);
        border: 1px solid var(--border-color);
        border-radius: 8px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
        gap: 2rem;
        flex-wrap: wrap;
    }

    .info-avatar {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, var(--primary), #2c6ae5);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 2rem;
    }

    .info-details h4 {
        font-size: 1.3rem;
        margin-bottom: 0.5rem;
    }

    .info-details p {
        color: var(--text-muted);
        margin-bottom: 0.25rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .info-details i {
        color: var(--primary);
        width: 20px;
    }

    .periodo-section {
        background: white;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        padding: 1.5rem;
        margin-bottom: 2rem;
    }

    .periodo-title {
        font-weight: 600;
        color: var(--primary);
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid var(--border-color);
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
        .info-card {
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

    <nav class="navbar navbar-expand-lg navbar-menu">
        <div class="container">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('coordinaciones.index') }}">Coordinaciones</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('maestros.index') }}">Maestros</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('contracts.index') }}">Contratos</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('users.index') }}">Accesos</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.administrativos.*') ? 'active' : '' }}"href="{{ route('admin.administrativos.index') }}">Administrativos</a></ul>
                </ul>
                
                <div class="user-info-container">
                    <div class="user-info">
                        <span class="user-name">{{ Auth::user()->name }}</span>
                        <div class="user-avatar">
                            <i class="fas fa-user-circle"></i>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
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
                    <div class="page-header">
                        <h2>
                            <i class="fas fa-file-pdf me-2"></i>
                            Documentos de {{ $administrativo->nombre_completo }}
                        </h2>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.administrativos.show', $administrativo->id) }}" class="back-btn">
                                <i class="fas fa-user"></i> Ver Perfil
                            </a>
                            <a href="{{ route('admin.administrativos.index') }}" class="back-btn">
                                <i class="fas fa-arrow-left"></i> Volver
                            </a>
                        </div>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="info-card">
                        <div class="info-avatar">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <div class="info-details">
                            <h4>{{ $administrativo->nombre_completo }}</h4>
                            <p><i class="fas fa-id-badge"></i> {{ $administrativo->numero_empleado }}</p>
                            <p><i class="fas fa-briefcase"></i> {{ $administrativo->puesto }} - {{ $administrativo->area_adscripcion }}</p>
                            <p><i class="fas fa-envelope"></i> {{ $administrativo->user->email }}</p>
                        </div>
                    </div>

                    @forelse($documentosPorPeriodo as $periodo => $documentos)
                        <div class="periodo-section">
                            <h4 class="periodo-title">
                                <i class="fas fa-calendar-alt"></i>
                                {{ $periodo }}
                            </h4>
                            
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
                                                        <i class="fas fa-id-card"></i> Identificación
                                                    @elseif($doc->tipo == 'comprobante_domicilio')
                                                        <i class="fas fa-home"></i> Comprobante
                                                    @elseif($doc->tipo == 'curriculum')
                                                        <i class="fas fa-file-alt"></i> Currículum
                                                    @elseif($doc->tipo == 'acta_nacimiento')
                                                        <i class="fas fa-file"></i> Acta
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
                                                        <a href="{{ route('admin.documentos.ver', $doc->id) }}" target="_blank" class="action-btn view-btn" title="Ver">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('admin.documentos.descargar', $doc->id) }}" class="action-btn download-btn" title="Descargar">
                                                            <i class="fas fa-download"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @empty
                        <div class="empty-state">
                            <i class="fas fa-file-pdf"></i>
                            <h4>No hay documentos disponibles</h4>
                            <p>Este administrativo aún no ha subido ningún documento.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        setTimeout(() => {
            document.querySelectorAll('.alert').forEach(alert => {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
    </script>
</body>
</html>