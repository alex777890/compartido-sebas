<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documentos del Maestro - {{ $maestro->nombres }}</title>
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
        
        /* ========== ESTILOS DE BARRA Y MENÚ ========== */

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
        
        /* ESTILOS DEL CARD DE PERFIL DEL PRIMER CÓDIGO */
        .profile-card {
            background: white;
            color: #333;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 25px;
            box-shadow: var(--card-shadow);
            border-left: 4px solid var(--primary);
        }
        
        .profile-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            border: 3px solid var(--border-color);
            padding: 3px;
            background: white;
        }
        
        .profile-info h4 {
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--primary);
            font-size: 1.3rem;
        }
        
        .profile-info p {
            margin-bottom: 5px;
            color: var(--text-muted);
            font-size: 0.95rem;
        }
        
        .profile-info i {
            width: 20px;
            text-align: center;
            margin-right: 8px;
            color: var(--primary);
        }
        
        /* Estilos para la información del maestro compacta */
        .maestro-compact-info {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
        }
        
        .maestro-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            border: 2px solid var(--border-color);
        }
        
        .maestro-details h5 {
            margin: 0;
            font-weight: 600;
            color: var(--primary);
            font-size: 1.1rem;
        }
        
        .maestro-details p {
            margin: 0;
            color: var(--text-muted);
            font-size: 0.95rem;
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
        
        /* Estilos específicos para documentos */
        .document-status {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 15px;
            border: 1px solid var(--border-color);
            background: white;
        }
        
        .document-status.completed {
            border-left: 4px solid var(--success-color);
        }
        
        .document-status.pending {
            border-left: 4px solid var(--warning-color);
        }
        
        .documento-card {
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }
        
        .documento-subido {
            border-left: 4px solid var(--success-color);
        }
        
        .documento-pendiente {
            border-left: 4px solid var(--warning-color);
        }
        
        .status-badge {
            font-size: 0.8rem;
        }
        
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
        
        .summary-completo { 
            background: linear-gradient(135deg, #28a745, #20c997); 
        }
        
        .summary-pendiente { 
            background: linear-gradient(135deg, #ffc107, #ffcd39); 
            color: #333; 
        }
        
        .summary-subidos { 
            background: linear-gradient(135deg, #17a2b8, #0dcaf0); 
        }
        
        .summary-totales { 
            background: linear-gradient(135deg, #6f42c1, #a370f7); 
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
            <!-- Botón de regresar -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <a href="{{ route('maestros.show', $maestro->id) }}" class="btn btn-outline-primary">
                        <i class="fas fa-arrow-left"></i> Volver al Perfil
                    </a>
                </div>
                <div class="action-dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-cog me-2"></i> Acciones
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#subirDocumentosModal">
                                <i class="fas fa-upload me-2"></i> Subir Documentos
                            </button>
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

            <!-- Información del Maestro (versión compacta) -->
            <div class="profile-card">
                <div class="maestro-compact-info">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($maestro->nombres . ' ' . $maestro->apellido_paterno) }}&background=ffffff&color=667eea&size=80" 
                         alt="{{ $maestro->nombres }}" class="maestro-avatar">
                    <div class="maestro-details">
                        <h5>{{ $maestro->nombres }} {{ $maestro->apellido_paterno }} {{ $maestro->apellido_materno }}</h5>
                        <p><i class="fas fa-envelope me-1"></i> {{ $maestro->email }}</p>
                    </div>
                </div>
            </div>

            <!-- Resumen de documentos -->
            <div class="section-card spacing-section">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-chart-pie me-2"></i>Resumen de Documentos</h5>
                </div>
                <div class="card-body">
                    @php
                        $documentosTotales = 6;
                        $documentosSubidos = $maestro->documentos->count();
                        $documentosPendientes = $documentosTotales - $documentosSubidos;
                        $porcentajeCompletado = $documentosTotales > 0 ? round(($documentosSubidos / $documentosTotales) * 100) : 0;
                    @endphp
                    
                    <div class="row">
                        <div class="col-md-3">
                            <div class="summary-card summary-completo">
                                <i class="fas fa-check-circle"></i>
                                <h5>Completado</h5>
                                <h3>{{ $porcentajeCompletado }}%</h3>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="summary-card summary-subidos">
                                <i class="fas fa-file-upload"></i>
                                <h5>Subidos</h5>
                                <h3>{{ $documentosSubidos }}</h3>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="summary-card summary-pendiente">
                                <i class="fas fa-clock"></i>
                                <h5>Pendientes</h5>
                                <h3>{{ $documentosPendientes }}</h3>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="summary-card summary-totales">
                                <i class="fas fa-folder"></i>
                                <h5>Totales</h5>
                                <h3>{{ $documentosTotales }}</h3>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Barra de progreso -->
                    <div class="mt-4">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Progreso de documentación</span>
                            <span class="text-primary fw-bold">{{ $porcentajeCompletado }}%</span>
                        </div>
                        <div class="progress" style="height: 12px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: {{ $porcentajeCompletado }}%;" 
                                 aria-valuenow="{{ $porcentajeCompletado }}" aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Estado general -->
                    <div class="mt-4">
                        <div class="document-status {{ $documentosSubidos == $documentosTotales ? 'completed' : 'pending' }}">
                            <div>
                                <i class="fas {{ $documentosSubidos == $documentosTotales ? 'fa-check-circle text-success' : 'fa-exclamation-circle text-warning' }} fa-2x"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">
                                    {{ $documentosSubidos == $documentosTotales ? 'Todos los documentos están completos' : 'Faltan documentos por subir' }}
                                </h6>
                                <p class="mb-0 text-muted">
                                    {{ $documentosSubidos }} de {{ $documentosTotales }} documentos subidos
                                </p>
                            </div>
                            <div class="text-end">
                                <span class="badge {{ $documentosSubidos == $documentosTotales ? 'bg-success' : 'bg-warning' }} status-badge">
                                    {{ $documentosSubidos == $documentosTotales ? 'Completo' : 'Pendiente' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <!-- Gestión de documentos -->
<div class="section-card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="fas fa-file-pdf me-2"></i>
                Gestión de Documentos
            </h5>
            <div class="action-dropdown">
                <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-cog me-1"></i> Acciones
                </button>
                <ul class="dropdown-menu">
                    <li>
                        <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#subirDocumentosModal">
                            <i class="fas fa-upload me-2"></i> Subir Documentos
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="card-body">
        @if(session('document_success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('document_success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Formulario para subir documentos -->
        <div class="mt-4">
            <form action="{{ route('maestros.subir-documentos', $maestro->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                @php
                    $tiposDocumentos = [
                        'cst' => ['nombre' => 'CST (Constancia de Situación Fiscal)', 'icono' => 'file-contract'],
                        'iufim' => ['nombre' => 'IUFIM', 'icono' => 'file-invoice'],
                        'comprobante_domicilio' => ['nombre' => 'Comprobante de Domicilio', 'icono' => 'home'],
                        'oficio_ingresos' => ['nombre' => 'Oficio de Ingresos Percibidos', 'icono' => 'money-bill-wave'],
                        'declaracion_anual' => ['nombre' => 'Declaración Anual', 'icono' => 'file-alt'],
                        'comprobante_seguro_social' => ['nombre' => 'Comprobante de Seguro Social', 'icono' => 'shield-alt']
                    ];
                @endphp
                
                <div class="row">
                    @foreach($tiposDocumentos as $tipo => $info)
                        <div class="col-md-6 mb-4">
                            <div class="documento-card @if($maestro->documentos->where('tipo', $tipo)->first()) documento-subido @else documento-pendiente @endif">
                                <h6 class="mb-3">
                                    <i class="fas {{ $info['icono'] }} me-2"></i>
                                    {{ $info['nombre'] }}
                                </h6>
                                
                                @if($maestro->documentos->where('tipo', $tipo)->first())
                                    @php $doc = $maestro->documentos->where('tipo', $tipo)->first(); @endphp
                                    <div class="mb-3">
                                        <div class="alert alert-success py-2">
                                            <i class="fas fa-check-circle me-2"></i>
                                            Documento subido el {{ $doc->created_at->format('d/m/Y') }}
                                        </div>
                                        <div class="btn-group-vertical w-100">
                                            <div class="dropdown">
                                                <button class="btn btn-outline-primary dropdown-toggle w-100 text-start" type="button" data-bs-toggle="dropdown">
                                                    <i class="fas fa-file-pdf me-2"></i> Acciones del documento
                                                </button>
                                                <ul class="dropdown-menu w-100">
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('documentos.ver', $doc->id) }}" target="_blank">
                                                            <i class="fas fa-eye me-2"></i> Ver documento
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('documentos.descargar', $doc->id) }}">
                                                            <i class="fas fa-download me-2"></i> Descargar
                                                        </a>
                                                    </li>
                                                    <li><hr class="dropdown-divider"></li>
                                                    <li>
                                                        <button type="button" class="dropdown-item text-warning" onclick="document.getElementById('{{ $tipo }}').click()">
                                                            <i class="fas fa-sync me-2"></i> Reemplazar
                                                        </button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                
                                <div class="mb-3">
                                    <label for="{{ $tipo }}" class="form-label">Subir {{ $info['nombre'] }} (PDF)</label>
                                    <input type="file" class="form-control" id="{{ $tipo }}" name="{{ $tipo }}" accept=".pdf">
                                    <div class="form-text">Tamaño máximo: 5MB</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Botón de Enviar -->
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="fas fa-paper-plane me-2"></i> Enviar Documentos
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <script>
        // Mostrar nombre de archivo seleccionado
        document.querySelectorAll('input[type="file"]').forEach(input => {
            input.addEventListener('change', function() {
                const fileName = this.files[0] ? this.files[0].name : 'No se seleccionó ningún archivo';
                const label = this.parentElement.querySelector('.form-label');
                const originalText = label.textContent;
                label.textContent = originalText.split(' (')[0] + ' (' + fileName + ')';
            });
        });
    </script>
</body>
</html>