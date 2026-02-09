<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Sistema de Gestión de Maestros</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
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
/* ========== ESTILOS ORIGINALES DEL SEGUNDO CSS ========== */

.main-content { 
    padding: 30px 20px; 
    min-height: calc(100vh - 120px);
}

h2 { 
    color: #2C3E50; /* AZUL OSCURO PARA DIFERENCIAR DEL AZUL PRIMARIO */
    font-weight: 700; 
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
    background: linear-gradient(to right, #26E63F, #33CAE6); /* VERDE A TURQUESA */
    border-radius: 2px;
}

.welcome-state { 
    padding: 3rem 2rem; 
    text-align: center; 
    background: linear-gradient(135deg, rgba(15, 126, 230, 0.03) 0%, rgba(51, 202, 230, 0.03) 100%);
    border-radius: 12px; 
    margin-bottom: 2rem;
    border: 1px solid rgba(15, 126, 230, 0.1);
    position: relative;
    overflow: hidden;
}

.welcome-state::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 4px;
    background: linear-gradient(to right, var(--primary), var(--secondary), var(--accent));
}

.feature-card { 
    border: 1px solid rgba(15, 126, 230, 0.1); 
    border-radius: 12px; 
    padding: 2rem 1.5rem; 
    background: white; 
    transition: var(--transition); 
    cursor: pointer; 
    height: 100%;
    box-shadow: var(--card-shadow);
    position: relative;
    overflow: hidden;
}

.feature-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 4px;
    background: linear-gradient(to right, var(--primary), var(--secondary));
    transform: scaleX(0);
    transition: var(--transition);
}

.feature-card:hover { 
    transform: translateY(-8px); 
    box-shadow: 0 12px 25px rgba(15, 126, 230, 0.15); 
    border-color: rgba(15, 126, 230, 0.3);
}

.feature-card:hover::before {
    transform: scaleX(1);
}

.feature-icon { 
    font-size: 2.5rem; 
    margin-bottom: 1rem; 
    background: linear-gradient(135deg, var(--primary), var(--secondary));
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
    display: inline-block;
}

.content-card { 
    border: none; 
    border-radius: 12px; 
    box-shadow: var(--card-shadow); 
    margin-bottom: 1.5rem;
    overflow: hidden;
    border-top: 3px solid var(--primary);
}

.teacher-card { 
    border: 1px solid rgba(15, 126, 230, 0.1); 
    border-radius: 12px; 
    transition: var(--transition);
    height: 100%;
    overflow: hidden;
    box-shadow: 0 3px 10px rgba(0,0,0,0.04);
}

.teacher-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(15, 126, 230, 0.12);
    border-color: rgba(15, 126, 230, 0.3);
}

.teacher-avatar { 
    width: 90px; 
    height: 90px; 
    border-radius: 50%; 
    object-fit: cover; 
    border: 3px solid var(--secondary);
    box-shadow: 0 3px 10px rgba(51, 202, 230, 0.3);
}

.badge {
    background: linear-gradient(135deg, var(--primary), var(--secondary));
    font-weight: 500;
    padding: 0.4rem 0.8rem;
}

.btn-primary {
    background: linear-gradient(135deg, var(--primary), var(--secondary));
    border: none;
    font-weight: 500;
    transition: var(--transition);
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(15, 126, 230, 0.3);
}

.btn-outline-primary {
    color: var(--primary);
    border-color: var(--primary);
    font-weight: 500;
    transition: var(--transition);
}

.btn-outline-primary:hover {
    background: var(--primary);
    transform: translateY(-2px);
    box-shadow: 0 3px 10px rgba(15, 126, 230, 0.2);
}

.form-control:focus, .form-select:focus {
    border-color: var(--secondary);
    box-shadow: 0 0 0 0.25rem rgba(51, 202, 230, 0.25);
}

.alert {
    border-radius: 10px;
    border: none;
    box-shadow: 0 3px 10px rgba(0,0,0,0.05);
}

.alert-success {
    background: linear-gradient(135deg, rgba(38, 230, 63, 0.1), rgba(51, 202, 230, 0.1));
    color: #155724;
    border-left: 4px solid var(--accent);
}

.alert-danger {
    background: linear-gradient(135deg, rgba(220, 53, 69, 0.1), rgba(253, 126, 20, 0.1));
    color: #721c24;
    border-left: 4px solid #dc3545;
}

.pagination .page-link {
    color: var(--primary);
    border-color: rgba(15, 126, 230, 0.2);
}

.pagination .page-item.active .page-link {
    background: linear-gradient(135deg, var(--primary), var(--secondary));
    border-color: var(--primary);
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .navbar-brand {
        font-size: 1.2rem;
    }
    
    .navbar-menu .nav-link {
        padding: 0.5rem 1rem !important;
        margin: 0.1rem 0;
    }
    
    .welcome-state {
        padding: 2rem 1rem;
    }
    
    .feature-card {
        padding: 1.5rem 1rem;
    }
    
    .main-content {
        padding: 20px 15px;
    }
    
    .logo-img {
        height: 45px;
    }
}

@media (max-width: 576px) {
    h2 {
        font-size: 1.5rem;
    }
    
    .feature-icon {
        font-size: 2rem;
    }
    
    .teacher-avatar {
        width: 70px;
        height: 70px;
    }
    
    .logo-img {
        height: 40px;
    }
}
    </style>
</head>
<body>
    @php
        $hasSearchParam = request()->filled('search');
        $hasCoordinacionParam = request()->filled('coordinaciones_id') && request('coordinaciones_id') !== 'all';
        $serverWantsFiltersOpen = $hasSearchParam || $hasCoordinacionParam;
    @endphp

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

    <div class="container-fluid">
        <div class="row">
            <div class="col-12 main-content">


                @if(session('success')) 
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                
                @if(session('error'))   
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i>{{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                {{-- PANEL DE BIENVENIDA --}}
                <div class="welcome-state" id="panel-bienvenida" style="{{ $serverWantsFiltersOpen ? 'display:none;' : '' }}">
                    <h3 class="mb-3">Maestros de coordinaciones</h3>
                    <p class="lead mb-4">Desde aquí puedes buscar toda la información relacionada con los maestros del Instituto Universitario Franco Inglés.</p>

                    <div class="row mt-4">
                        <div class="col-md-4 mb-4">
                            <div class="feature-card" id="btn-mostrar-filtros" role="button">
                                <div class="feature-icon"><i class="fas fa-search"></i></div>
                                <h5>Buscar Maestros</h5>
                                <p class="text-muted">Usa los filtros para encontrar maestros específicos.</p>
                            </div>
                        </div>

                        <div class="col-md-4 mb-4">
                            <div class="feature-card" onclick="window.location.href='{{ route('maestros.create') }}'">
                                <div class="feature-icon"><i class="fas fa-user-plus"></i></div>
                                <h5>Agregar Nuevos</h5>
                                <p class="text-muted">Registra nuevos maestros en el sistema.</p>
                            </div>
                        </div>

                        <div class="col-md-4 mb-4">
                            <div class="feature-card">
                                <div class="feature-icon"><i class="fas fa-chart-bar"></i></div>
                                <h5>Gestión por Coordinación</h5>
                                <p class="text-muted">Organiza y visualiza por coordinación.</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- FILTROS --}}
                <div class="card content-card" id="filtros-container" style="{{ $serverWantsFiltersOpen ? '' : 'display:none;' }}">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <h5 class="mb-0"><i class="fas fa-filter me-2"></i>Filtros</h5>
                            <button type="button" class="btn btn-sm btn-outline-primary" id="btn-volver-inicio">
                                <i class="fas fa-arrow-left me-1"></i>Volver al inicio
                            </button>
                        </div>

                        <form action="{{ route('maestros.index') }}" method="GET" id="filtros-form">
                            <div class="row gy-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Filtrar por Coordinación:</label>
                                    <select class="form-select" name="coordinaciones_id" onchange="document.getElementById('filtros-form').submit()">
                                        <option value="all" {{ request('coordinaciones_id') === 'all' ? 'selected' : '' }}>Todas las coordinaciones</option>
                                        @foreach($coordinaciones as $coordinacion)
                                            <option value="{{ $coordinacion->id }}" {{ request('coordinaciones_id') == $coordinacion->id ? 'selected' : '' }}>
                                                {{ $coordinacion->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Buscar Maestro:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="search" placeholder="Nombre, email..." value="{{ request('search') }}">
                                        <button class="btn btn-primary" type="submit"><i class="fas fa-search me-1"></i> Buscar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- RESULTADOS --}}
                @if($hasSearchParam || $hasCoordinacionParam)
                    <div class="card content-card mt-4">
                        <div class="card-header bg-transparent">
                            <h5 class="mb-0"><i class="fas fa-users me-2"></i>Maestros Registrados</h5>
                        </div>
                        <div class="card-body">
                            @if($maestros->count() > 0)
                                <div class="row">
                                    @foreach($maestros as $maestro)
                                        <div class="col-md-6 col-lg-4 mb-4">
                                            <div class="card teacher-card h-100">
                                                <div class="card-body text-center d-flex flex-column">
                                                    <span class="badge bg-primary mb-2 align-self-center">{{ $maestro->coordinacion->nombre }}</span>
                                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($maestro->nombres . ' ' . $maestro->apellido_paterno) }}&background=0F7EE6&color=fff&size=90" alt="" class="teacher-avatar mb-3 align-self-center">
                                                    <h5 class="flex-grow-1">{{ $maestro->nombres }} {{ $maestro->apellido_paterno }} {{ $maestro->apellido_materno }}</h5>
                                                    <p class="text-muted">{{ $maestro->maximo_grado_academico }}</p>
                                                    <a href="{{ route('maestros.show', $maestro->id) }}" class="btn btn-outline-primary btn-sm mt-2">Ver perfil</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="d-flex justify-content-center mt-4">
                                    {{ $maestros->links() }}
                                </div>
                            @else
                                <div class="text-center py-5">
                                    <i class="fas fa-users fa-4x text-muted mb-3"></i>
                                    <h4>No se encontraron maestros</h4>
                                    <p class="text-muted">Intenta ajustar los filtros de búsqueda</p>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        (function(){
            const btnMostrar = document.getElementById('btn-mostrar-filtros');
            const filtros = document.getElementById('filtros-container');
            const panel = document.getElementById('panel-bienvenida');
            const btnVolver = document.getElementById('btn-volver-inicio');
            const navbar = document.querySelector('.navbar-top');

            // Efecto de scroll en navbar
            window.addEventListener('scroll', function() {
                if (window.scrollY > 50) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
            });

            if(btnMostrar){
                btnMostrar.addEventListener('click', function(){
                    filtros.style.display = 'block';
                    panel.style.display = 'none';
                    // Desplazar suavemente hacia los filtros
                    filtros.scrollIntoView({ behavior: 'smooth' });
                });
            }

            if(btnVolver){
                btnVolver.addEventListener('click', function(){
                    window.location.href = "{{ route('maestros.index') }}";
                });
            }

        })();
    </script>
</body>
</html>