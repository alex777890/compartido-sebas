<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Administrativos - Sistema GEPROC</title>
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

    .navbar-menu .logout-btn:active {
        background: rgba(255, 255, 255, 0.2);
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
    }

    h1, h2, h3, h4, h5, h6 {
        font-weight: 600;
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

    /* Estadísticas */
    .stats-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        margin: 2rem 0;
    }

    .stat-card {
        background: white;
        padding: 1.2rem;
        border-radius: 8px;
        text-align: center;
        border: 1px solid var(--border-color);
        transition: var(--transition);
    }

    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(7, 68, 182, 0.1);
        border-color: var(--primary);
    }

    .stat-icon {
        font-size: 2rem;
        margin-bottom: 0.5rem;
    }

    .stat-value {
        font-size: 1.6rem;
        font-weight: 650;
        margin-bottom: 0.2rem;
        color: var(--primary);
    }

    .stat-label {
        color: var(--text-muted);
        font-size: 0.9rem;
        font-weight: 500;
    }

    .total-icon { color: var(--primary); }
    .completos-icon { color: #28a745; }
    .pendientes-icon { color: #ffc107; }
    .rechazados-icon { color: #dc3545; }

    /* Filtros */
    .filter-card {
        background: white;
        border-radius: 8px;
        border: 1px solid var(--border-color);
        box-shadow: var(--card-shadow);
        margin-bottom: 1.5rem;
    }

    .form-label-filter {
        font-weight: 500;
        color: var(--primary);
        font-size: 0.9rem;
        margin-bottom: 0.3rem;
    }

    /* Tabla */
    .table-responsive {
        border-radius: 6px;
        overflow: hidden;
        border: 1px solid var(--border-color);
    }

    .table {
        margin-bottom: 0;
    }

    .table thead th {
        background: rgba(7, 68, 182, 0.05);
        color: var(--primary);
        font-weight: 600;
        padding: 1rem;
        border-bottom: 2px solid var(--border-color);
    }

    .table tbody td {
        padding: 1rem;
        vertical-align: middle;
        border-bottom: 1px solid var(--border-color);
    }

    .table tbody tr:hover {
        background: rgba(7, 68, 182, 0.02);
    }

    /* Badges */
    .badge {
        font-weight: 500;
        padding: 0.4rem 0.8rem;
        font-size: 0.8rem;
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

    /* Botones de acción */
    .action-btn {
        padding: 0.4rem 0.8rem;
        border: none;
        border-radius: 4px;
        font-size: 0.85rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        transition: var(--transition);
        font-weight: 500;
    }

    .view-btn {
        background: rgba(7, 68, 182, 0.1);
        color: var(--primary);
        border: 1px solid rgba(7, 68, 182, 0.3);
    }

    .view-btn:hover {
        background: var(--primary);
        color: white;
        transform: translateY(-2px);
    }

    .btn-primary-custom {
        background: var(--primary);
        border: none;
        color: white;
        font-weight: 500;
        padding: 0.75rem 1.5rem;
        border-radius: 5px;
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 1rem;
    }

    .btn-primary-custom:hover {
        background: #063a9b;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(7, 68, 182, 0.2);
    }

    /* Paginación */
    .pagination-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 1rem 0;
        padding: 1rem 0;
        border-top: 1px solid var(--border-color);
    }

    .pagination-custom .page-link {
        color: var(--primary);
        border: 1px solid var(--border-color);
        margin: 0 2px;
        border-radius: 4px !important;
    }

    .pagination-custom .page-item.active .page-link {
        background-color: var(--primary);
        border-color: var(--primary);
        color: white;
    }

    /* Progress bar */
    .progress {
        height: 8px;
        border-radius: 4px;
        background: #e9ecef;
    }

    .progress-bar {
        background: var(--primary);
        border-radius: 4px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .main-content {
            padding: 20px 15px;
        }
        
        .content-container {
            padding: 1.5rem;
        }
        
        .stats-container {
            grid-template-columns: 1fr;
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
                
                <!-- Información de usuario y cerrar sesión -->
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
                    <!-- Header del contenido -->
                    <div class="content-header">
                        <div>
                            <h2><i class="fas fa-user-cog me-2"></i>Gestión de Administrativos</h2>
                            <p class="page-subtitle">Administra los perfiles y documentos del personal administrativo</p>
                        </div>
                        <a href="{{ route('admin.administrativos.estadisticas') }}" class="btn-primary-custom">
                            <i class="fas fa-chart-bar me-2"></i>Ver Estadísticas
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

                    <!-- Estadísticas rápidas -->
                    <div class="stats-container">
                        <div class="stat-card">
                            <div class="stat-icon total-icon"><i class="fas fa-users"></i></div>
                            <div class="stat-value">{{ $totalAdministrativos }}</div>
                            <div class="stat-label">Total Administrativos</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon completos-icon"><i class="fas fa-check-circle"></i></div>
                            <div class="stat-value">{{ $conDocumentosCompletos }}</div>
                            <div class="stat-label">Documentos Completos</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon pendientes-icon"><i class="fas fa-clock"></i></div>
                            <div class="stat-value">{{ $conDocumentosPendientes }}</div>
                            <div class="stat-label">Con Pendientes</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon rechazados-icon"><i class="fas fa-times-circle"></i></div>
                            <div class="stat-value">{{ $conDocumentosRechazados }}</div>
                            <div class="stat-label">Con Rechazos</div>
                        </div>
                    </div>

                    <!-- Filtros de búsqueda -->
                    <div class="filter-card">
                        <div class="card-body">
                            <form method="GET" action="{{ route('admin.administrativos.index') }}" class="row g-3">
                                <div class="col-md-4">
                                    <label for="search" class="form-label-filter">
                                        <i class="fas fa-search me-1"></i>Buscar
                                    </label>
                                    <input type="text" 
                                           class="form-control" 
                                           id="search" 
                                           name="search" 
                                           placeholder="Nombre, apellido o número de empleado..." 
                                           value="{{ request('search') }}">
                                </div>
                                
                                <div class="col-md-3">
    <label for="puesto" class="form-label-filter">
        <i class="fas fa-briefcase me-1"></i>Puesto
    </label>
    <select class="form-select" id="puesto" name="puesto">
        <option value="">Todos los puestos</option>
        @foreach($puestos as $puesto)
            <option value="{{ $puesto }}" {{ request('puesto') == $puesto ? 'selected' : '' }}>
                {{ $puesto }}
            </option>
        @endforeach
    </select>
</div>
                                
                                <div class="col-md-3">
                                    <label for="estado" class="form-label-filter">
                                        <i class="fas fa-tag me-1"></i>Estado
                                    </label>
                                    <select class="form-select" id="estado" name="estado">
                                        <option value="">Todos</option>
                                        <option value="completos" {{ request('estado') == 'completos' ? 'selected' : '' }}>Documentos Completos</option>
                                        <option value="incompletos" {{ request('estado') == 'incompletos' ? 'selected' : '' }}>Documentos Incompletos</option>
                                        <option value="pendientes" {{ request('estado') == 'pendientes' ? 'selected' : '' }}>Con Pendientes</option>
                                        <option value="rechazados" {{ request('estado') == 'rechazados' ? 'selected' : '' }}>Con Rechazos</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-2 d-flex align-items-end">
                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="fas fa-filter"></i> Filtrar
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Información de paginación -->
                    @if($administrativos->total() > 0)
                    <div class="pagination-container">
                        <div class="pagination-info">
                            Mostrando {{ $administrativos->firstItem() ?? 0 }} - {{ $administrativos->lastItem() ?? 0 }} de {{ $administrativos->total() }} administrativos
                        </div>
                    </div>
                    @endif

                    <!-- Tabla de administrativos -->
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Nombre Completo</th>
            <th>Puesto</th>
            <th>Documentos</th>
            <th>Progreso</th>
            <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($administrativos as $admin)
                                    @php
                                        $documentos = $admin->documentosAdmin;
                $totalDocs = $documentos->count();
                $aprobados = $documentos->where('estado', 'aprobado')->count();
                $pendientes = $documentos->where('estado', 'pendiente')->count();
                $rechazados = $documentos->where('estado', 'rechazado')->count();
                $totalRequeridos = count(\App\Models\Administrativo::TIPOS_DOCUMENTOS);
                $porcentaje = $totalDocs > 0 ? round(($aprobados / $totalRequeridos) * 100) : 0;
                                    @endphp
                                    <tr>
                <td><strong>{{ $admin->nombre_completo }}</strong></td>
                <td>{{ $admin->puesto }}</td>
                <td>
                    <div class="d-flex gap-1 flex-wrap">
                        @if($aprobados > 0)
                            <span class="badge badge-success" title="Aprobados">
                                <i class="fas fa-check-circle"></i> {{ $aprobados }}
                            </span>
                        @endif
                        @if($pendientes > 0)
                            <span class="badge badge-warning" title="Pendientes">
                                <i class="fas fa-clock"></i> {{ $pendientes }}
                            </span>
                        @endif
                        @if($rechazados > 0)
                            <span class="badge badge-danger" title="Rechazados">
                                <i class="fas fa-times-circle"></i> {{ $rechazados }}
                            </span>
                        @endif
                        @if($totalDocs == 0)
                            <span class="badge bg-secondary">Sin documentos</span>
                        @endif
                    </div>
                </td>
                <td style="min-width: 120px;">
                    <div class="progress" title="{{ $aprobados }}/{{ $totalRequeridos }} documentos aprobados">
                        <div class="progress-bar" role="progressbar" 
                             style="width: {{ $porcentaje }}%;" 
                             aria-valuenow="{{ $porcentaje }}" 
                             aria-valuemin="0" 
                             aria-valuemax="100">
                        </div>
                    </div>
                    <small class="text-muted">{{ $aprobados }}/{{ $totalRequeridos }} aprobados</small>
                </td>
                <td>
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.administrativos.show', $admin->id) }}" class="action-btn view-btn" title="Ver detalles">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.administrativos.documentos', $admin->id) }}" class="action-btn view-btn" title="Ver documentos">
                            <i class="fas fa-file-pdf"></i>
                        </a>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center py-4">
                    <div class="empty-state">
                        <i class="fas fa-users fa-3x mb-3"></i>
                        <h4>No hay administrativos registrados</h4>
                        <p class="text-muted">Los administrativos aparecerán aquí cuando completen su perfil.</p>
                    </div>
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
                    </div>

                    <!-- Paginación inferior -->
                    @if($administrativos->hasPages())
                        <div class="pagination-container">
                            <div class="pagination-info">
                                Página {{ $administrativos->currentPage() }} de {{ $administrativos->lastPage() }}
                            </div>
                            <div>
                                <nav>
                                    <ul class="pagination pagination-custom mb-0">
                                        {{ $administrativos->withQueryString()->links('pagination::bootstrap-5') }}
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Cerrar alertas automáticamente
        setTimeout(() => {
            document.querySelectorAll('.alert').forEach(alert => {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
    </script>
</body>
</html>