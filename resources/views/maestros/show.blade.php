<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil del Maestro - {{ $maestro->nombres }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #0744b6ff;
            --secondary: #33CAE6;
            --accent: #28a745;
            --light-bg: #F8F9FA;
            --border-color: #E9ECEF;
            --text-muted: #6C757D;
            --card-shadow: 0 5px 15px rgba(7, 68, 182, 0.08);
            --transition: all 0.3s ease;
            --success-color: #28a745;
            --warning-color: #FFC107;
            --danger-color: #dc3545;
        }
        
        body { 
            background: white; 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            color: #333; 
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }
        
        /* ========== ESTILOS DE BARRA Y MENÚ DEL PRIMER CSS CON COLORES DEL SEGUNDO ========== */

        /* Primera barra - Logo y título */
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
        
        /* ========== ESTILOS PARA EL CONTENIDO PRINCIPAL ========== */
        .main-content {
            padding: 30px;
            background-color: #f8f9fa;
        }
        
        .profile-header {
            background: white;
            color: #333;
            border-radius: 12px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: var(--card-shadow);
            border-left: 5px solid var(--primary);
        }
        
        .section-card {
            background: white;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            margin-bottom: 25px;
            border: none;
            overflow: hidden;
            border-left: 4px solid var(--primary);
        }
        
        .section-card .card-header {
            background-color: white;
            color: var(--primary);
            padding: 15px 20px;
            border-bottom: 1px solid var(--border-color);
        }
        
        .section-card .card-body {
            padding: 25px;
        }
        
        .info-card {
            border-left: 4px solid var(--primary);
            padding-left: 15px;
            margin-bottom: 20px;
        }
        
        .badge-coordinacion {
            background-color: var(--primary);
            color: white;
            font-size: 0.9rem;
        }
        
        .grado-card {
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            transition: transform 0.2s;
            background: white;
        }
        
        .grado-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }
        
        .nivel-licenciatura { border-left: 4px solid #28a745; }
        .nivel-especialidad { border-left: 4px solid #17a2b8; }
        .nivel-maestria { border-left: 4px solid #ffc107; }
        .nivel-doctorado { border-left: 4px solid #dc3545; }
        
        .summary-card {
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            color: white;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        .summary-card h3 {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }
        
        .summary-card h5 {
            margin-bottom: 10px;
            font-weight: 500;
        }
        
        .summary-card i {
            font-size: 2rem;
            margin-bottom: 15px;
        }
        
        .summary-licenciatura { background: linear-gradient(135deg, #28a745, #20c997); }
        .summary-especialidad { background: linear-gradient(135deg, #17a2b8, #0dcaf0); }
        .summary-maestria { background: linear-gradient(135deg, #ffc107, #ffcd39); color: #333; }
        .summary-doctorado { background: linear-gradient(135deg, #dc3545, #fd7e14); }
        
        .accordion-button:not(.collapsed) {
            background-color: rgba(7, 68, 182, 0.1);
            color: var(--primary);
            font-weight: 600;
        }
        
        .accordion-button:focus {
            box-shadow: 0 0 0 0.25rem rgba(7, 68, 182, 0.25);
        }
        
        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
        }
        
        .btn-primary:hover {
            background-color: #063a9e;
            border-color: #063a9e;
        }
        
        .btn-outline-primary {
            color: var(--primary);
            border-color: var(--primary);
        }
        
        .btn-outline-primary:hover {
            background-color: var(--primary);
            border-color: var(--primary);
        }
        
        .text-primary {
            color: var(--primary) !important;
        }
        
        .border-primary {
            border-color: var(--primary) !important;
        }
        
        .bg-primary {
            background-color: var(--primary) !important;
        }
        
        .spacing-section {
            margin-bottom: 40px;
        }
        
        .action-dropdown .dropdown-menu {
            min-width: 200px;
        }
        
        .quick-actions {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }
        
        .quick-action-btn {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 15px;
            border-radius: 8px;
            background: white;
            border: 1px solid var(--border-color);
            transition: all 0.3s;
            text-decoration: none;
            color: #333;
        }
        
        .quick-action-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            color: #333;
        }
        
        .quick-action-btn i {
            font-size: 1.5rem;
            margin-bottom: 8px;
        }
        
        .quick-action-btn.primary {
            border-color: var(--primary);
            color: var(--primary);
        }
        
        .quick-action-btn.success {
            border-color: var(--success-color);
            color: var(--success-color);
        }
        
        .quick-action-btn.warning {
            border-color: var(--warning-color);
            color: var(--warning-color);
        }
        
        .quick-action-btn.danger {
            border-color: var(--danger-color);
            color: var(--danger-color);
        }
        
        /* Estilos para el botón desplegable de resumen */
        .resumen-toggle {
            background: white;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 15px 20px;
            margin-bottom: 20px;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .resumen-toggle:hover {
            background: #f8f9fa;
        }
        
        .resumen-toggle .btn {
            font-weight: 500;
        }
        
        .resumen-grados {
            transition: all 0.3s ease;
        }
        
        /* Estilos para la sección de antigüedad */
        .antiguedad-resumen {
            border-left: 4px solid var(--primary);
            background-color: rgba(7, 68, 182, 0.05);
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        
        .antiguedad-card {
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            background: white;
        }
        
        .antiguedad-card.primary {
            border-left: 4px solid var(--primary);
        }
        
        .antiguedad-card.success {
            border-left: 4px solid var(--success-color);
        }
        
        .antiguedad-card.warning {
            border-left: 4px solid var(--warning-color);
        }
/* Estilos para las tarjetas de resumen */
.summary-card {
    background: white;
    border-radius: 10px;
    padding: 20px;
    text-align: center;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
    border: 1px solid #e9ecef;
    height: 100%;
}

.summary-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 15px rgba(0,0,0,0.15);
}

.summary-card i {
    font-size: 2.5rem;
    margin-bottom: 15px;
    display: block;
}

.summary-card h5 {
    font-size: 0.9rem;
    color: #6c757d;
    margin-bottom: 10px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-weight: 600;
}

.summary-card h3 {
    font-size: 2.2rem;
    font-weight: 700;
    margin: 0;
    color: #343a40;
}

/* Colores específicos para cada nivel */
.summary-licenciatura i { 
    color: #28a745; 
    background: rgba(40, 167, 69, 0.1);
    padding: 15px;
    border-radius: 50%;
    width: 70px;
    height: 70px;
    margin: 0 auto 15px;
}

.summary-especialidad i { 
    color: #17a2b8; 
    background: rgba(23, 162, 184, 0.1);
    padding: 15px;
    border-radius: 50%;
    width: 70px;
    height: 70px;
    margin: 0 auto 15px;
}

.summary-maestria i { 
    color: #ffc107; 
    background: rgba(255, 193, 7, 0.1);
    padding: 15px;
    border-radius: 50%;
    width: 70px;
    height: 70px;
    margin: 0 auto 15px;
}

.summary-doctorado i { 
    color: #dc3545; 
    background: rgba(220, 53, 69, 0.1);
    padding: 15px;
    border-radius: 50%;
    width: 70px;
    height: 70px;
    margin: 0 auto 15px;
}

/* Estilos para el botón desplegable */
.resumen-toggle {
    cursor: pointer;
    padding: 15px;
    background: #f8f9fa;
    border-radius: 8px;
    border: 1px solid #e9ecef;
    transition: all 0.3s ease;
    margin-bottom: 20px;
}

.resumen-toggle:hover {
    background: #e9ecef;
}

/* Estilos para la tabla */
.table-responsive {
    border-radius: 8px;
    border: 1px solid #e9ecef;
    overflow: hidden;
}

.table th {
    background-color: #f8f9fa;
    border-bottom: 2px solid #dee2e6;
    font-weight: 600;
    color: #495057;
    padding: 12px 15px;
}

.table td {
    vertical-align: middle;
    padding: 12px 15px;
    border-top: 1px solid #e9ecef;
}

.table tbody tr:hover {
    background-color: #f8f9fa;
}

/* Estilos para los badges */
.badge {
    padding: 6px 12px;
    font-weight: 500;
    font-size: 0.85rem;
}

.bg-success { background-color: #28a745 !important; }
.bg-info { background-color: #17a2b8 !important; }
.bg-warning { background-color: #ffc107 !important; color: #212529 !important; }
.bg-danger { background-color: #dc3545 !important; }
.bg-primary { background-color: #007bff !important; }

/* Estilos para los botones de acción */
.btn-group .btn {
    padding: 5px 10px;
    border-radius: 4px;
    margin-right: 5px;
}

.btn-outline-success:hover { background-color: #28a745; color: white; }
.btn-outline-info:hover { background-color: #17a2b8; color: white; }
.btn-outline-warning:hover { background-color: #ffc107; color: #212529; }
.btn-outline-danger:hover { background-color: #dc3545; color: white; }

/* Responsive */
@media (max-width: 768px) {
    .summary-card {
        padding: 15px;
        margin-bottom: 15px;
    }
    
    .summary-card i {
        font-size: 2rem;
        width: 60px;
        height: 60px;
        padding: 12px;
    }
    
    .summary-card h3 {
        font-size: 1.8rem;
    }
    
    .table-responsive {
        font-size: 0.85rem;
    }
    
    .btn-group .btn {
        padding: 3px 6px;
        font-size: 0.75rem;
    }
}

@media (max-width: 576px) {
    .summary-card h3 {
        font-size: 1.5rem;
    }
    
    .summary-card h5 {
        font-size: 0.8rem;
    }
    
    .table th, .table td {
        padding: 8px 10px;
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
    
    <!-- Segunda barra - Menú con información de usuario y cerrar sesión -->
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
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('contratos.*') ? 'active' : '' }}" href="{{ route('users.index') }}">Accesos</a></li>
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
    
    <div class="container-fluid p-0">
        <!-- Main Content -->
        <div class="main-content">
            <!-- Botones de acción -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <a href="{{ route('maestros.index') }}" class="btn btn-outline-primary">
                        <i class="fas fa-arrow-left"></i> Volver a la lista
                    </a>
                </div>
                <div class="action-dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-cog me-2"></i> Acciones
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item text-warning" href="{{ route('maestros.edit', $maestro->id) }}">
                                <i class="fas fa-edit me-2"></i> Editar
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('maestros.destroy', $maestro->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="dropdown-item text-danger" 
                                        onclick="return confirm('¿Estás seguro de eliminar este maestro?')">
                                    <i class="fas fa-trash me-2"></i> Eliminar
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Header del perfil -->
            <div class="profile-header">
                <div class="row align-items-center">
                    <div class="col-md-3 text-center">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($maestro->nombres . ' ' . $maestro->apellido_paterno) }}&background=ffffff&color=667eea&size=150" 
                             alt="{{ $maestro->nombres }}" class="rounded-circle img-thumbnail">
                    </div>
                    <div class="col-md-9">
                        <h1 class="display-5">{{ $maestro->nombres }} {{ $maestro->apellido_paterno }} {{ $maestro->apellido_materno }}</h1>
                        <p class="lead mb-2">
                            <span class="badge badge-coordinacion">{{ $maestro->coordinacion->nombre }}</span>
                            <span class="badge bg-success">{{ $maestro->maximo_grado_academico }}</span>
                            <span class="badge bg-info">{{ $maestro->gradosAcademicos->count() }} Grados</span>
                        </p>
                        <p class="mb-1"><i class="fas fa-envelope me-2"></i> {{ $maestro->email }}</p>
                        <p class="mb-0"><i class="fas fa-phone me-2"></i> {{ $maestro->telefono ?? 'No especificado' }}</p>
                    </div>
                </div>
            </div>

            <!-- Acciones rápidas -->
            <div class="quick-actions">
                <a href="{{ route('grados-academicos.create', $maestro->id) }}" class="quick-action-btn success">
                    <i class="fas fa-graduation-cap"></i>
                    <span>Grados Academicos</span>
                </a>
                <a href="{{ route('horarios.formulario', $maestro->id) }}" class="quick-action-btn primary">
                    <i class="fas fa-calculator"></i>
                    <span>Horario Clase</span>
                </a>
                <a href="{{ route('maestros.calcular-antiguedad', $maestro) }}" class="quick-action-btn">
                    <i class="fas fa-history"></i>
                    <span>Antigüedad</span>
                </a>
                <a href="{{ route('maestros.historial-documentos-desde-maestro', $maestro->id) }}" class="quick-action-btn primary">
                    <i class="fas fa-file-pdf"></i>
                    <span>Documentos</span>
                </a>
            </div>

            <!-- Información Personal -->
            <div class="section-card spacing-section">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-user me-2"></i>Información Personal</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-card">
                                <h6 class="text-primary mb-3">Datos Personales</h6>
                                <p><strong>Nombre completo:</strong> {{ $maestro->nombres }} {{ $maestro->apellido_paterno }} {{ $maestro->apellido_materno }}</p>
                                <p><strong>Fecha de nacimiento:</strong> {{ \Carbon\Carbon::parse($maestro->fecha_nacimiento)->format('d/m/Y') }}</p>
                                <p><strong>Edad:</strong> {{ $maestro->edad }} años</p>
                                <p><strong>Sexo:</strong> {{ $maestro->sexo ?? 'No especificado' }}</p>
                                <p><strong>Estado civil:</strong> {{ $maestro->estado_civil ?? 'No especificado' }}</p>
                                <p><strong>Año de Ingreso al Instituto:</strong> {{ $maestro->anio_ingreso }}</p>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="info-card mb-4">
                                <h6 class="text-primary mb-3">Información de Contacto</h6>
                                <p><strong>Email:</strong> {{ $maestro->email }}</p>
                                <p><strong>Teléfono:</strong> {{ $maestro->telefono ?? 'No especificado' }}</p>
                                <p><strong>Dirección:</strong> {{ $maestro->direccion ?? 'No especificada' }}</p>
                            </div>
                            
                            <div class="info-card">
                                <h6 class="text-primary mb-3">Documentos Oficiales</h6>
                                <p><strong>RFC:</strong> {{ $maestro->rfc }}</p>
                                <p><strong>CURP:</strong> {{ $maestro->curp }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sección de Grados Académicos -->
<div class="section-card spacing-section">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="fas fa-graduation-cap me-2"></i>Grados Académicos</h5>
            <div class="action-dropdown">
                <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-cog me-1"></i> Acciones
                </button>
                <ul class="dropdown-menu">
                    <li>
                        <a class="dropdown-item text-success" href="{{ route('grados-academicos.create', $maestro->id) }}">
                            <i class="fas fa-plus me-2"></i> Nuevo Grado
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="card-body">
        <!-- Botón desplegable para mostrar resumen -->
        <div class="resumen-toggle d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#resumenGrados" aria-expanded="false" aria-controls="resumenGrados">
            <div>
                <h6 class="mb-1 text-primary">
                    <i class="fas fa-chart-bar me-2"></i>
                    Resumen de Grados Académicos
                </h6>
                <p class="mb-0 text-muted small">Haz clic para ver el resumen por niveles académicos</p>
            </div>
            <button class="btn btn-sm btn-outline-primary">
                <i class="fas fa-chevron-down"></i>
            </button>
        </div>

        <!-- Resumen de Grados Académicos (colapsable) -->
        <div class="collapse" id="resumenGrados">
            <div class="resumen-grados">
                <div class="row mb-4">
                    <div class="col-md-3 mb-3">
                        <div class="summary-card summary-licenciatura">
                            <i class="fas fa-user-graduate"></i>
                            <h5>Licenciaturas</h5>
                            <h3>{{ $maestro->gradosAcademicos->where('nivel', 'Licenciatura')->count() }}</h3>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="summary-card summary-especialidad">
                            <i class="fas fa-certificate"></i>
                            <h5>Especialidades</h5>
                            <h3>{{ $maestro->gradosAcademicos->where('nivel', 'Especialidad')->count() }}</h3>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="summary-card summary-maestria">
                            <i class="fas fa-graduation-cap"></i>
                            <h5>Maestrías</h5>
                            <h3>{{ $maestro->gradosAcademicos->where('nivel', 'Maestría')->count() }}</h3>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="summary-card summary-doctorado">
                            <i class="fas fa-user-tie"></i>
                            <h5>Doctorados</h5>
                            <h3>{{ $maestro->gradosAcademicos->where('nivel', 'Doctorado')->count() }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- LISTA DE GRADOS ACADÉMICOS -->
        <div class="mt-4">
            <h6 class="mb-3 text-primary">
                <i class="fas fa-list-alt me-2"></i>
                Grados Académicos Registrados
            </h6>
            
            @if($maestro->gradosAcademicos && $maestro->gradosAcademicos->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nivel</th>
                                <th>Título</th>
                                <th>Institución</th>
                                <th>Año Obtención</th>
                                <th>Cédula Profesional</th>
                                <th>Documento</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($maestro->gradosAcademicos as $grado)
                                <tr>
                                    <td>
                                        @php
                                            // Determinar la clase CSS basada en el nivel
                                            $badgeClass = 'bg-success'; // Por defecto para Licenciatura
                                            if ($grado->nivel == 'Doctorado') {
                                                $badgeClass = 'bg-danger';
                                            } elseif ($grado->nivel == 'Maestría') {
                                                $badgeClass = 'bg-warning';
                                            } elseif ($grado->nivel == 'Especialidad') {
                                                $badgeClass = 'bg-info';
                                            }
                                        @endphp
                                        <span class="badge {{ $badgeClass }}">
                                            {{ $grado->nivel }}
                                        </span>
                                    </td>
                                    <td>{{ $grado->nombre_titulo }}</td>
                                    <td>{{ $grado->institucion ?? 'No especificada' }}</td>
                                    <td>{{ $grado->ano_obtencion ?? 'N/A' }}</td>
                                    <td>
                                        @if($grado->cedula_profesional)
                                            <span class="badge bg-primary">{{ $grado->cedula_profesional }}</span>
                                            @if($grado->fecha_expedicion_cedula)
                                                <small class="text-muted d-block">Exp: {{ \Carbon\Carbon::parse($grado->fecha_expedicion_cedula)->format('d/m/Y') }}</small>
                                            @endif
                                        @else
                                            <span class="text-muted">Sin cédula</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <form action="{{ route('grados-academicos.destroy', $grado->id) }}" 
                                                  method="POST" 
                                                  class="d-inline"
                                                  onsubmit="return confirm('¿Estás seguro de eliminar este grado académico?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Eliminar">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <!-- Estadísticas adicionales -->
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="alert alert-info">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="fas fa-chart-pie me-2"></i>
                                    <strong>Resumen Total:</strong> 
                                    {{ $maestro->gradosAcademicos->count() }} grado(s) académico(s) registrado(s)
                                </div>
                                <div>
                                    @php
                                        $gradosConCedula = $maestro->gradosAcademicos->whereNotNull('cedula_profesional')->count();
                                        $gradosConDocumento = $maestro->gradosAcademicos->whereNotNull('documento')->count();
                                    @endphp
                                    <small class="text-muted">
                                        Con cédula: {{ $gradosConCedula }} | 
                                        Con documento: {{ $gradosConDocumento }}
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    No se han registrado grados académicos para este maestro.
                    <a href="{{ route('grados-academicos.create', $maestro->id) }}" class="alert-link ms-2">
                        Agregar primer grado académico
                    </a>
                </div>
            @endif
        </div>
        <!-- FIN LISTA DE GRADOS ACADÉMICOS -->
    </div>
</div>

            <!-- Sección de Antigüedad -->
            <div class="section-card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="fas fa-calculator me-2"></i>
                            Cálculo de Antigüedad
                        </h5>
                        <div class="action-dropdown">
                            <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-cog me-1"></i> Acciones
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="{{ route('maestros.calcular-antiguedad', $maestro) }}">
                                        <i class="fas fa-plus-circle me-2"></i> Agregar Período
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('maestros.historial-antiguedad', $maestro) }}">
                                        <i class="fas fa-history me-2"></i> Ver Historial
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Resumen de Antigüedad -->
                    @if(isset($antiguedadTotal) && !isset($antiguedadTotal['error']) && $antiguedadTotal['total_meses_trabajados'] > 0)
                    <!-- Cuando HAY datos de antigüedad -->
                    <div class="row">
                        <div class="col-12">
                            <div class="antiguedad-resumen">
                                <h5 class="text-primary mb-3">
                                    <i class="fas fa-chart-bar me-2"></i>
                                    Resumen General de Antigüedad
                                </h5>
                                
                                <!-- Año de ingreso -->
                                <div class="alert alert-primary mb-4">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-calendar-check fa-2x me-3"></i>
                                        <div>
                                            <h6 class="mb-1">Año de Ingreso: <strong>{{ $antiguedadTotal['anio_ingreso'] }}</strong></h6>
                                            <p class="mb-0">Cálculo basado en los meses trabajados registrados en el sistema</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="row text-center mb-4">
                                    <div class="col-md-4 mb-3">
                                        <div class="antiguedad-card primary">
                                            <h6 class="text-muted">Total Meses Trabajados</h6>
                                            <h2 class="text-primary display-6">{{ $antiguedadTotal['total_meses_trabajados'] }}</h2>
                                            <small class="text-muted">meses acumulados</small>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="antiguedad-card success">
                                            <h6 class="text-muted">Años Completos</h6>
                                            <h2 class="text-success display-6">{{ $antiguedadTotal['anios'] }}</h2>
                                            <small class="text-muted">años de servicio</small>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="antiguedad-card warning">
                                            <h6 class="text-muted">Antigüedad Total</h6>
                                            <h4 class="mb-0">{{ $antiguedadTotal['anios'] }} años y {{ $antiguedadTotal['meses'] }} meses</h4>
                                        </div>
                                    </div>
                                </div>

                                <!-- Detalle de Periodos (colapsable) -->
                                @if(isset($antiguedadTotal['detalle_periodos']) && count($antiguedadTotal['detalle_periodos']) > 0)
                                <div class="mt-4">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h6 class="text-muted mb-0">
                                            <i class="fas fa-list me-2"></i>Detalle de Periodos Registrados ({{ count($antiguedadTotal['detalle_periodos']) }} periodos)
                                        </h6>
                                        <button class="btn btn-sm btn-outline-primary" type="button" data-bs-toggle="collapse" data-bs-target="#detallePeriodos" aria-expanded="false" aria-controls="detallePeriodos">
                                            <i class="fas fa-chevron-down me-1"></i> Ver Detalles
                                        </button>
                                    </div>
                                    
                                    <div class="collapse" id="detallePeriodos">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>Año</th>
                                                        <th>Periodo</th>
                                                        <th>Meses Trabajados</th>
                                                        <th>Total Meses</th>
                                                        <th>Detalle de Meses</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($antiguedadTotal['detalle_periodos'] as $detalle)
                                                    <tr>
                                                        <td>
                                                            @if(isset($detalle['anio']))
                                                                <strong class="text-primary">{{ $detalle['anio'] }}</strong>
                                                            @elseif(isset($detalle['anio_periodo']))
                                                                <strong class="text-primary">{{ $detalle['anio_periodo'] }}</strong>
                                                            @else
                                                                <span class="text-muted">N/A</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if(isset($detalle['periodo']))
                                                                <small>{{ $detalle['periodo'] }}</small>
                                                            @else
                                                                <span class="text-muted">-</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if(isset($detalle['meses']))
                                                                <span class="badge bg-info">{{ count($detalle['meses']) }}</span>
                                                                <small class="text-muted d-block">meses trabajados</small>
                                                            @else
                                                                <span class="text-muted">0</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <strong>{{ $detalle['total_meses'] ?? 0 }}</strong>
                                                        </td>
                                                        <td>
                                                            <small class="text-muted">
                                                                @if(isset($detalle['meses_nombres']) && count($detalle['meses_nombres']) > 0)
                                                                    {{ implode(', ', $detalle['meses_nombres']) }}
                                                                @else
                                                                    No especificado
                                                                @endif
                                                            </small>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @else
                    <!-- Cuando NO HAY datos de antigüedad -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card bg-light border-0">
                                <div class="card-body text-center py-5">
                                    <i class="fas fa-calculator fa-4x text-muted mb-4"></i>
                                    <h4 class="text-muted mb-3">No hay datos de antigüedad registrados</h4>
                                    <p class="text-muted mb-4">Comience calculando la antigüedad del maestro para ver el resumen aquí.</p>
                                    <a href="{{ route('maestros.calcular-antiguedad', $maestro) }}" class="btn btn-primary">
                                        <i class="fas fa-plus me-2"></i> Calcular Antigüedad
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <script>
        // Animación para el botón de resumen
        document.querySelector('.resumen-toggle').addEventListener('click', function() {
            const icon = this.querySelector('.fa-chevron-down');
            if (this.getAttribute('aria-expanded') === 'true') {
                icon.classList.remove('fa-chevron-down');
                icon.classList.add('fa-chevron-up');
            } else {
                icon.classList.remove('fa-chevron-up');
                icon.classList.add('fa-chevron-down');
            }
        });
    </script>
</body>
</html>