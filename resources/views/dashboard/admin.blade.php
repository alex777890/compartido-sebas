<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Inicio - Sistema GEPROC</title>
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
    
    /* Variables de tamaño de fuente para mejor legibilidad */
    --font-size-base: 1.1rem;      /* Tamaño base aumentado */
    --font-size-lg: 1.3rem;        /* Texto grande */
    --font-size-sm: 1rem;           /* Texto pequeño pero aún legible */
    --font-size-h1: 2.2rem;         /* Títulos principales */
    --font-size-h2: 1.9rem;         /* Títulos secundarios */
    --font-size-h3: 1.6rem;         /* Subtítulos */
    --font-size-h4: 1.4rem;         /* Encabezados de sección */
}

body { 
    background: white; 
    font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
    color: #333; 
    line-height: 1.6;
    font-size: var(--font-size-base); /* Tamaño base aplicado */
}

/* ========== ESTILOS DE BARRA Y MENÚ DEL PRIMER CSS CON COLORES DEL SEGUNDO ========== */

/* ========== BARRA DE NAVEGACIÓN - VERSIÓN ORIGINAL ========== */

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
    font-size: 0.95rem;
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

.main-content { 
    padding: 30px 20px;
    min-height: calc(100vh - 140px);
}

h1, h2, h3, h4, h5, h6 {
    font-weight: 600;
    line-height: 1.3;
}

h1 { font-size: var(--font-size-h1); }
h2 { font-size: var(--font-size-h2); }
h3 { font-size: var(--font-size-h3); }
h4 { font-size: var(--font-size-h4); }
h5 { font-size: var(--font-size-lg); }
h6 { font-size: var(--font-size-base); }

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
    width: 60px; /* Ligeramente más ancho */
    height: 3px; /* Más grueso */
    background: var(--primary);
}

/* Información de bienvenida */
.welcome-section {
    background: white;
    border-radius: 6px;
    padding: 3rem 2.5rem; /* Más padding */
    margin-bottom: 2rem;
    border: 1px solid var(--border-color);
}

.welcome-title {
    color: var(--primary);
    font-weight: 600;
    margin-bottom: 1.2rem;
    font-size: var(--font-size-h1);
}

.welcome-subtitle {
    color: var(--text-muted);
    font-weight: 500;
    margin-bottom: 1.5rem;
    font-size: var(--font-size-h3);
}

.welcome-section p {
    font-size: var(--font-size-lg);
}

/* Tarjetas de estadísticas - si las agregas después */
.stats-card {
    border: none;
    border-radius: 6px;
    box-shadow: var(--card-shadow);
    margin-bottom: 1.5rem;
    overflow: hidden;
    transition: var(--transition);
    border-top: 4px solid; /* Más grueso */
    background: white;
    border: 1px solid var(--border-color);
}

.stats-number {
    font-size: 2.5rem; /* Aumentado */
    font-weight: 600;
}

.stats-icon {
    font-size: 2rem; /* Aumentado */
    margin-bottom: 1rem;
    color: var(--text-muted);
}

/* Acciones rápidas */
.quick-action {
    background: white;
    border-radius: 6px;
    padding: 2.5rem; /* Más padding */
    margin-bottom: 2rem;
    border: 1px solid var(--border-color);
}

.quick-action h4 {
    font-size: var(--font-size-h4);
    margin-bottom: 2rem !important;
}

/* Botones de acción */
.action-btn {
    background: transparent;
    border: 2px solid var(--primary);
    font-weight: 500;
    transition: var(--transition);
    color: var(--primary);
    border-radius: 6px;
    padding: 1.2rem; /* Más padding */
    font-size: 1.2rem; /* Aumentado significativamente */
}

.action-btn i {
    font-size: 2.2rem; /* Iconos más grandes */
    margin-bottom: 0.8rem;
}

.action-btn:hover {
    background: rgba(7, 68, 182, 0.05);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(7, 68, 182, 0.15);
    color: var(--primary);
}

/* Tarjetas de módulos */
.dashboard-card { 
    border: 1px solid var(--border-color); 
    border-radius: 6px; 
    padding: 2.2rem 1.8rem; /* Más padding */ 
    background: white; 
    transition: var(--transition); 
    cursor: pointer; 
    height: 100%;
    box-shadow: var(--card-shadow);
    position: relative;
    overflow: hidden;
}

.dashboard-card h5 {
    font-size: var(--font-size-h5);
    margin-bottom: 1rem;
}

.dashboard-card p {
    font-size: var(--font-size-base);
    line-height: 1.5;
    color: var(--text-muted);
}

.dashboard-icon { 
    font-size: 2.5rem; /* Aumentado */ 
    margin-bottom: 1.2rem; 
    display: inline-block;
    color: var(--primary);
}

.badge {
    font-weight: 500;
    padding: 0.5rem 1rem; /* Más padding */
    font-size: 0.95rem; /* Aumentado */
    border-radius: 4px;
}

/* Información adicional */
.info-section {
    background: white;
    border-radius: 6px;
    padding: 2.5rem; /* Más padding */
    margin-top: 2rem;
    border: 1px solid var(--border-color);
}

.info-section h4 {
    font-size: var(--font-size-h4);
    margin-bottom: 2rem !important;
}

.info-item {
    display: flex;
    align-items: center;
    margin-bottom: 1.2rem;
    padding: 1rem; /* Más padding */
    border-radius: 6px;
    transition: var(--transition);
}

.info-item h6 {
    font-size: var(--font-size-lg);
    margin-bottom: 0.3rem;
}

.info-item p {
    font-size: var(--font-size-base);
}

.info-icon {
    width: 50px; /* Más grande */
    height: 50px; /* Más grande */
    background: var(--primary);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 1.2rem;
    color: white;
    font-size: 1.3rem; /* Icono más grande */
}

/* Responsive adjustments */
@media (max-width: 768px) {
    :root {
        --font-size-base: 1rem;
        --font-size-h1: 1.9rem;
        --font-size-h2: 1.6rem;
        --font-size-h3: 1.4rem;
        --font-size-h4: 1.2rem;
    }
    
    .navbar-brand {
        font-size: 1.3rem;
    }
    
    .navbar-menu .nav-link {
        padding: 0.6rem 1.2rem !important;
        font-size: 1rem;
    }
    
    .main-content {
        padding: 20px 15px;
    }
    
    .welcome-section {
        padding: 2rem 1.5rem;
    }
    
    .action-btn {
        padding: 1rem;
        font-size: 1rem;
    }
    
    .action-btn i {
        font-size: 1.8rem;
    }
    
    .dashboard-card {
        padding: 1.8rem 1.2rem;
    }
    
    .logo-img {
        height: 45px;
    }
}

@media (max-width: 576px) {
    :root {
        --font-size-base: 0.95rem;
        --font-size-h1: 1.7rem;
        --font-size-h2: 1.4rem;
    }
    
    .navbar-brand {
        font-size: 1.1rem;
    }
    
    .logo-img {
        height: 40px;
    }
    
    .dashboard-icon {
        font-size: 2rem;
    }
    
    .stats-number {
        font-size: 2rem;
    }
    
    .info-icon {
        width: 40px;
        height: 40px;
        font-size: 1rem;
    }
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
            
            .main-content {
                padding: 20px 15px;
            }
            
            .dashboard-card {
                padding: 1.5rem 1rem;
            }
            
            .welcome-section {
                padding: 1.5rem;
            }
            
            .navbar-menu {
                top: 60px;
            }
            
            .logo-img {
                height: 45px;
            }
            
            .navbar-menu .user-info-container {
                flex-direction: column;
                gap: 10px;
                align-items: flex-end;
                margin-top: 10px;
                padding-top: 10px;
                border-top: 1px solid rgba(255, 255, 255, 0.2);
            }
        }
        
        @media (max-width: 576px) {
            h2 {
                font-size: 1.3rem;
            }
            
            .dashboard-icon {
                font-size: 1.8rem;
            }
            
            .stats-number {
                font-size: 1.8rem;
            }
            
            .welcome-section {
                padding: 1.5rem 1rem;
            }
            
            .logo-img {
                height: 40px;
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
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 main-content">
                <!-- Información de bienvenida -->
                <div class="welcome-section">
                    <div class="row align-items-center">
                        <div class="col-md-12 text-center">
                            <h1 class="welcome-title">Gestion de Promedios y Contratos</h1>
                            <p class="welcome-subtitle">Instituto Universitario Franco Inglés de Mexico</p>
                            <p class="mb-0" style="color: var(--text-muted);">Administra de manera eficiente toda la información de maestros, coordinaciones y contratos académicos.</p>
                        </div>
                    </div>
                </div>
                
                <!-- Acciones rápidas -->
                <div class="quick-action">
                    <h4 class="mb-4">Acciones Rápidas</h4>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <button class="btn action-btn w-100 py-3" onclick="window.location.href='{{ route('users.index') }}'">
                                <i class="fas fa-user-plus fa-2x mb-2"></i><br>
                                Agregar Maestro
                            </button>
                        </div>
                        <div class="col-md-4 mb-3">
                            <button class="btn action-btn w-100 py-3" onclick="window.location.href='{{ route('contracts.index') }}'">
                                <i class="fas fa-file-contract fa-2x mb-2"></i><br>
                                Nuevo Contrato
                            </button>
                        </div>
                        <div class="col-md-4 mb-3">
                            <button class="btn action-btn w-100 py-3" onclick="window.location.href='{{ route('periodos.index') }}'">
                                <i class="fas fa-toggle-on fa-2x mb-2"></i><br>
                                Habilitar Periodos
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Módulos principales -->
                <div class="row mb-4">
                    <div class="col-md-4 mb-4">
                        <div class="dashboard-card card-1" onclick="window.location.href='{{ route('maestros.index') }}'">
                            <h5 style="color: --card-shadow">Gestión de Maestros</h5>
                            <p class="text-muted">Administra toda la información de los maestros, sus datos personales, académicos y de contacto.</p>
                            <div class="mt-3">
                                <span class="badge badge-primary">156 registros</span>
                                <span class="badge badge-secondary ms-2">24 activos</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mb-4">
                        <div class="dashboard-card card-2" onclick="window.location.href=''">
                            <h5 style="color: --card-shadow">Gestión de Contratos</h5>
                            <p class="text-muted">Controla los contratos laborales, fechas de vigencia, renovaciones y documentación legal.</p>
                            <div class="mt-3">
                                <span class="badge badge-primary">89 activos</span>
                                <span class="badge badge-warning ms-2">12 por vencer</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mb-4">
                        <div class="dashboard-card card-3" onclick="window.location.href='{{ route('coordinaciones.index') }}'">
                            <h5 style="color: --card-shadow">Coordinaciones</h5>
                            <p class="text-muted">Organiza los maestros por áreas académicas y coordina las diferentes especialidades.</p>
                            <div class="mt-3">
                                <span class="badge badge-primary">24 coordinaciones</span>
                                <span class="badge badge-success ms-2">8 departamentos</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Información adicional -->
                <div class="info-section">
                    <h4 class="mb-4">Información del Sistema</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-item">
                                <div class="info-icon">
                                    <i class="fas fa-info"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">Fecha de Lanzamiento</h6>
                                    <p class="mb-0 text-muted"> Marzo, 2026</p>
                                </div>
                            </div>
                            <div class="info-item">
                                <div class="info-icon">
                                    <i class="fas fa-database"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">Base de Datos</h6>
                                    <p class="mb-0 text-muted">Se cuenta con respaldo de base de datos</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <div class="info-icon">
                                    <i class="fas fa-shield-alt"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">Seguridad</h6>
                                    <p class="mb-0 text-muted">Sistema protegido mediante el servidor </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        (function(){
            const navbar = document.querySelector('.navbar-top');

            // Efecto de scroll en navbar
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