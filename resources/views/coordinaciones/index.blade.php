<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coordinaciones</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #0744b6ff;
            --secondary: #33CAE6;
            --accent: #28a745; /* Verde */
            --light-bg: #F8F9FA;
            --border-color: #E9ECEF;
            --text-muted: #6C757D;
            --card-shadow: 0 5px 15px rgba(40, 167, 69, 0.08); /* Cambiado a verde */
            --transition: all 0.3s ease;
            --success-color: #28a745; /* Verde para elementos activos */
            --info-color: #17a2b8; /* Azul turquesa para complementar */
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

        .main-content { 
            padding: 20px 20px;
            min-height: calc(100vh - 120px);
        }
        
        h2 { 
            color: var(--primary);
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
            background: linear-gradient(to right, var(--accent), var(--info-color));
            border-radius: 2px;
        }
        
        /* Menú desplegable de coordinaciones */
        .accordion-coordinaciones {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: var(--card-shadow);
            border: 1px solid var(--border-color);
        }
        
        .accordion-item {
            border: none;
            border-bottom: 1px solid var(--border-color);
            background: white;
        }
        
        .accordion-item:last-child {
            border-bottom: none;
        }
        
        .accordion-header {
            margin: 0;
        }
        
        .accordion-button {
            background: white;
            color: var(--primary);
            font-weight: 600;
            padding: 1.25rem 1.5rem;
            border: none;
            transition: var(--transition);
            position: relative;
        }
        
        .accordion-button:not(.collapsed) {
            background: linear-gradient(135deg, rgba(40, 167, 69, 0.05) 0%, rgba(23, 162, 184, 0.05) 100%);
            color: var(--primary);
            box-shadow: none;
            border-left: 4px solid var(--accent);
        }
        
        .accordion-button::after {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%230744b6'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
            transition: var(--transition);
        }
        
        .accordion-button:not(.collapsed)::after {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%230744b6'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
            transform: rotate(-180deg);
        }
        
        .accordion-button:hover {
            background: linear-gradient(135deg, rgba(40, 167, 69, 0.08) 0%, rgba(23, 162, 184, 0.08) 100%);
        }
        
        .coordinacion-info {
            display: flex;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
        }
        
        .coordinacion-badge {
            background: var(--accent);
            color: white;
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
        }
        
        .coordinacion-badge-secondary {
            background: var(--info-color);
        }
        
        .accordion-body {
            padding: 1.5rem;
            background: linear-gradient(135deg, rgba(40, 167, 69, 0.02) 0%, rgba(23, 162, 184, 0.02) 100%);
            border-top: 1px solid var(--border-color);
        }
        
        .acciones-coordinacion {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 1rem;
        }
        
        .btn-primary {
            background: var(--primary);
            border: none;
            font-weight: 500;
            transition: var(--transition);
            color: white;
            padding: 0.5rem 1rem;
        }
        
        .btn-primary:hover {
            background: #06389c;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(7, 68, 182, 0.2);
            color: white;
        }
        
        .btn-info {
            background: var(--info-color);
            border: none;
            font-weight: 500;
            transition: var(--transition);
            color: white;
            padding: 0.5rem 1rem;
        }
        
        .btn-info:hover {
            background: #138496;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(23, 162, 184, 0.2);
            color: white;
        }
        
        .btn-outline-secondary {
            border: 2px solid var(--info-color);
            color: var(--info-color);
            background: transparent;
            transition: var(--transition);
            padding: 0.5rem 1rem;
        }
        
        .btn-outline-secondary:hover {
            background: var(--info-color);
            color: white;
            transform: translateY(-2px);
        }
        
        .btn-outline-danger {
            border: 2px solid #dc3545;
            color: #dc3545;
            background: transparent;
            transition: var(--transition);
            padding: 0.5rem 1rem;
        }
        
        .btn-outline-danger:hover {
            background: #dc3545;
            color: white;
            transform: translateY(-2px);
        }
        
        /* Alertas mejoradas */
        .alert-success {
            background: linear-gradient(135deg, rgba(40, 167, 69, 0.1) 0%, rgba(40, 167, 69, 0.05) 100%);
            border: 1px solid rgba(40, 167, 69, 0.2);
            color: var(--success-color);
            border-radius: 12px;
        }
        
        .alert-danger {
            background: linear-gradient(135deg, rgba(220, 53, 69, 0.1) 0%, rgba(220, 53, 69, 0.05) 100%);
            border: 1px solid rgba(220, 53, 69, 0.2);
            color: #dc3545;
            border-radius: 12px;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .navbar-brand {
                font-size: 1.2rem;
            }
            
            .nav-link {
                padding: 0.5rem 0.8rem !important;
                margin: 0.1rem 0;
            }
            
            .main-content {
                padding: 15px 15px;
            }
            
            .coordinacion-info {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
            }
            
            .acciones-coordinacion {
                flex-direction: column;
            }
            
            .acciones-coordinacion .btn {
                width: 100%;
                justify-content: center;
            }
        }
        
        @media (max-width: 576px) {
            h2 {
                font-size: 1.5rem;
            }
            
            .accordion-button {
                padding: 1rem 1.25rem;
            }
            
            .accordion-body {
                padding: 1.25rem;
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

    <div class="container main-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Coordinaciones</h2>
            <a href="{{ route('coordinaciones.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Nueva Coordinación
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- Menú desplegable de coordinaciones -->
        <div class="accordion accordion-coordinaciones" id="accordionCoordinaciones">
            @foreach($coordinaciones as $index => $coordinacion)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading{{ $index }}">
                        <button class="accordion-button {{ $index > 0 ? 'collapsed' : '' }}" 
                                type="button" 
                                data-bs-toggle="collapse" 
                                data-bs-target="#collapse{{ $index }}" 
                                aria-expanded="{{ $index === 0 ? 'true' : 'false' }}" 
                                aria-controls="collapse{{ $index }}">
                            <div class="coordinacion-info">
                                <span>{{ $coordinacion->nombre }}</span>
                            </div>
                        </button>
                    </h2>
                    <div id="collapse{{ $index }}" 
                         class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}" 
                         aria-labelledby="heading{{ $index }}" 
                         data-bs-parent="#accordionCoordinaciones">
                        <div class="accordion-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <h6 class="mb-3" style="color: var(--primary);">Información de la Coordinación</h6>
                                    <div class="d-flex gap-3 mb-3">
                                        <span class="coordinacion-badge">
                                            {{ $coordinacion->maestros_count }} Maestro(s)
                                        </span>

                                    </div>
                                    </p>
                                </div>
                                <div class="col-md-4">
                                    <div class="acciones-coordinacion">
                                        <a href="{{ route('coordinaciones.show', $coordinacion->id) }}" class="btn btn-primary">
                                            <i class="fas fa-eye"></i> Ver Maestros
                                        </a>
                                        <a href="{{ route('coordinaciones.estadisticas', $coordinacion->id) }}" class="btn btn-info">
                                            <i class="fas fa-chart-bar"></i> Estadisticas
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        @if($coordinaciones->isEmpty())
            <div class="text-center py-5">
                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                <h4 class="text-muted">No hay coordinaciones registradas</h4>
                <p class="text-muted">Comienza creando tu primera coordinación</p>
                <a href="{{ route('coordinaciones.create') }}" class="btn btn-primary mt-2">
                    <i class="fas fa-plus"></i> Crear Coordinación
                </a>
            </div>
        @endif
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