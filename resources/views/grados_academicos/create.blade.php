<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Grado Académico - {{ $maestro->nombres }}</title>
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

        /* ========== ESTILOS DEL CUERPO MEJORADOS ========== */
        
        .main-content {
            padding: 25px;
            background: #f8fafc;
            min-height: calc(100vh - 136px);
        }
        
        .breadcrumb {
            background-color: white;
            border-radius: 8px;
            padding: 12px 20px;
            box-shadow: var(--card-shadow);
            margin-bottom: 20px;
        }
        
        .breadcrumb-item a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
        }
        
        .breadcrumb-item a:hover {
            color: #03308a;
        }
        
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            background: white;
            padding: 18px 25px;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
        }
        
        .page-title {
            color: var(--primary);
            font-weight: 600;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 1.5rem;
        }
        
        .page-title i {
            color: var(--primary);
            font-size: 1.6rem;
        }
        
        .btn-back {
            background-color: white;
            color: var(--primary);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 8px 16px;
            font-weight: 500;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            text-decoration: none;
        }
        
        .btn-back:hover {
            background-color: var(--primary);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(7, 68, 182, 0.2);
        }
        
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
        
        .alert-danger {
            border-radius: 10px;
            border-left: 4px solid var(--danger-color);
            box-shadow: 0 4px 12px rgba(220, 53, 69, 0.1);
            padding: 15px;
            margin-bottom: 20px;
        }
        
        .form-card {
            border-radius: 12px;
            border: none;
            box-shadow: var(--card-shadow);
            margin-bottom: 25px;
            overflow: hidden;
        }
        
        .card-header {
            background: white;
            color: var(--primary);
            border-bottom: 1px solid var(--border-color);
            padding: 16px 25px;
            font-weight: 600;
            font-size: 1.2rem;
        }
        
        .card-header i {
            margin-right: 10px;
            font-size: 1.2rem;
        }
        
        .card-body {
            padding: 25px;
        }
        
        .form-section {
            border-left: 3px solid #e9ecef;
            padding-left: 15px;
            margin-bottom: 25px;
            position: relative;
        }
        
        .form-section h5 {
            color: #495057;
            font-weight: 600;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1.1rem;
        }
        
        .form-section h5 i {
            color: var(--primary);
            font-size: 1.2rem;
        }
        
        .form-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 8px;
            font-size: 1rem;
        }
        
        .required-field::after {
            content: " *";
            color: var(--danger-color);
        }
        
        .form-control, .form-select {
            border-radius: 8px;
            border: 1px solid var(--border-color);
            padding: 10px 12px;
            transition: var(--transition);
            box-shadow: 0 1px 3px rgba(0,0,0,0.03);
            font-size: 1rem;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.25rem rgba(7, 68, 182, 0.15);
        }
        
        .file-upload-container {
            border: 2px dashed var(--border-color);
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            background-color: var(--light-bg);
            transition: var(--transition);
            cursor: pointer;
        }
        
        .file-upload-container:hover {
            border-color: var(--primary);
            background-color: #eef5ff;
        }
        
        .file-upload-container.dragover {
            border-color: var(--primary);
            background-color: #e6f0ff;
        }
        
        .document-icon {
            font-size: 2.2rem;
            color: var(--primary);
            margin-bottom: 10px;
        }
        
        .file-preview {
            margin-top: 12px;
            display: none;
            background: white;
            padding: 10px 12px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            border: 1px solid var(--border-color);
        }
        
        .btn-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid var(--border-color);
        }
        
        .btn-cancel {
            background-color: white;
            color: var(--text-muted);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 8px 16px;
            font-weight: 500;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            font-size: 0.9rem;
        }
        
        .btn-cancel:hover {
            background-color: #f8f9fa;
            color: var(--danger-color);
            border-color: var(--danger-color);
        }
        
        .btn-reset {
            background-color: white;
            color: var(--text-muted);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 8px 16px;
            font-weight: 500;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9rem;
        }
        
        .btn-reset:hover {
            background-color: #f8f9fa;
            color: var(--warning-color);
            border-color: var(--warning-color);
        }
        
        .btn-submit {
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 8px 20px;
            font-weight: 500;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9rem;
        }
        
        .btn-submit:hover {
            background: #063a9d;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(7, 68, 182, 0.3);
        }
        
        .btn-toggle-grados {
            background: white;
            color: var(--primary);
            border: 1px solid var(--primary);
            border-radius: 8px;
            padding: 8px 16px;
            font-weight: 500;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 15px;
            font-size: 0.9rem;
        }
        
        .btn-toggle-grados:hover {
            background: var(--primary);
            color: white;
        }
        
        .degrees-table {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: var(--card-shadow);
            margin-top: 15px;
            display: none;
        }
        
        .degrees-table .card-header {
            background: white;
            color: var(--primary);
            border-bottom: 1px solid var(--border-color);
        }
        
        .table {
            margin-bottom: 0;
            font-size: 0.9rem;
        }
        
        .table thead th {
            background-color: #f8f9fa;
            color: var(--primary);
            font-weight: 600;
            border-bottom: 2px solid var(--border-color);
            padding: 12px 10px;
        }
        
        .table tbody td {
            padding: 10px;
            vertical-align: middle;
            border-color: var(--border-color);
        }
        
        .table tbody tr {
            transition: var(--transition);
        }
        
        .table tbody tr:hover {
            background-color: #f8fbff;
        }
        
        .badge {
            font-weight: 500;
            padding: 5px 8px;
            border-radius: 6px;
            font-size: 0.8rem;
        }
        
        .btn-download {
            border-radius: 6px;
            padding: 5px 8px;
            transition: var(--transition);
        }
        
        .btn-download:hover {
            background-color: var(--primary);
            color: white;
        }
        
        .info-alert {
            border-radius: 10px;
            border-left: 4px solid var(--secondary);
            background-color: #e8f7fa;
            padding: 12px;
            font-size: 0.9rem;
        }
        
        /* Nuevos estilos para el diseño de dos columnas */
        .form-columns {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
        }
        
        .full-width-section {
            grid-column: 1 / -1;
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
        
        /* Estilos para los botones de acción más arriba */
        .top-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid var(--border-color);
        }
        
        /* Responsive adjustments */
        @media (max-width: 992px) {
            .form-columns {
                grid-template-columns: 1fr;
            }
        }
        
        @media (max-width: 768px) {
            .main-content {
                padding: 15px;
            }
            
            .page-header {
                flex-direction: column;
                gap: 12px;
                align-items: flex-start;
            }
            
            .btn-actions, .top-actions {
                flex-direction: column;
                gap: 12px;
            }
            
            .action-buttons {
                display: flex;
                flex-direction: column;
                width: 100%;
                gap: 8px;
            }
            
            .action-buttons button {
                width: 100%;
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
    
    <!-- Contenido Principal -->
    <div class="main-content">
        <div class="container-fluid">

            <!-- Header -->
            <div class="page-header">
                <h2 class="page-title">
                    <i class="fas fa-graduation-cap"></i> Grados Académico
                </h2>
                <a href="{{ route('maestros.show', $maestro->id) }}" class="btn-back">
                    <i class="fas fa-arrow-left"></i> Volver al perfil
                </a>
            </div>

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

            @if ($errors->any())
                <div class="alert alert-danger">
                    <h5><i class="fas fa-exclamation-triangle me-2"></i>Error en el formulario</h5>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Botón para mostrar/ocultar grados existentes -->
<button class="btn-toggle-grados" id="toggleGradosBtn">
    <i class="fas fa-list me-2"></i>Ver Grados Académicos Registrados
</button>

<!-- Información de grados existentes -->
<div class="degrees-table card" id="gradosTable">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-list me-2"></i>Grados Académicos Registrados</h5>
    </div>
    <div class="card-body p-0">
        @if($maestro->gradosAcademicos->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Nivel</th>
                            <th>Título</th>
                            <th>Institución</th>
                            <th>Año</th>
                            <th>Documento</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($maestro->gradosAcademicos as $grado)
                        <tr>
                            <td>
                                <span class="badge 
                                    @if($grado->nivel == 'Licenciatura') bg-success
                                    @elseif($grado->nivel == 'Especialidad') bg-info
                                    @elseif($grado->nivel == 'Maestría') bg-warning
                                    @else bg-danger @endif">
                                    {{ $grado->nivel }}
                                </span>
                            </td>
                            <td>{{ Str::limit($grado->nombre_titulo, 40) }}</td>
                            <td>{{ $grado->institucion ? Str::limit($grado->institucion, 30) : 'N/A' }}</td>
                            <td>{{ $grado->ano_obtencion ?? 'N/A' }}</td>
                            <td>
                                @if($grado->documento)
                                    <div class="btn-group">
                                        <a href="{{ route('grados-academicos.show-document', $grado->id) }}" 
                                           class="btn btn-sm btn-outline-info" 
                                           target="_blank"
                                           title="Ver documento">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </div>
                                @else
                                    <span class="text-muted">Sin documento</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-4">
                <i class="fas fa-graduation-cap fa-2x text-muted mb-3"></i>
                <p class="text-muted">No hay grados académicos registrados</p>
            </div>
        @endif
    </div>
</div>

            <!-- Formulario -->
            <div class="form-card">
                <div class="card-header">
                    <i class=""></i> Agrega un nuevo Grado Academico
                <div class="card-body">
                    <form action="{{ route('grados-academicos.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="maestro_id" value="{{ $maestro->id }}">
                        
                        <!-- Botones de acción en la parte superior -->
                        <div class="top-actions">
                            <a href="{{ route('maestros.show', $maestro->id) }}" class="btn-cancel">
                                <i class="fas fa-times me-2"></i>Cancelar
                            </a>
                            <div class="action-buttons">
                                <button type="submit" class="btn-submit">
                                    <i class="fas fa-save me-2"></i>Guardar 
                            </div>
                        </div>
                        
                        <div class="form-columns">
                            <!-- Columna izquierda: Información Básica -->
                            <div>
                                <!-- Sección: Información Básica -->
                                <div class="form-section">
                                    <h5><i class="fas fa-graduation-cap me-2"></i>Información Básica</h5>
                                    
                                    <div class="mb-3">
                                        <label for="nivel" class="form-label required-field">Nivel Académico</label>
                                        <select class="form-select @error('nivel') is-invalid @enderror" 
                                                id="nivel" name="nivel" required>
                                            <option value="">Seleccionar nivel académico</option>
                                            <option value="Licenciatura" {{ old('nivel') == 'Licenciatura' ? 'selected' : '' }}>
                                                Licenciatura
                                            </option>
                                            <option value="Especialidad" {{ old('nivel') == 'Especialidad' ? 'selected' : '' }}>
                                                Especialidad
                                            </option>
                                            <option value="Maestría" {{ old('nivel') == 'Maestría' ? 'selected' : '' }}>
                                                Maestría
                                            </option>
                                            <option value="Doctorado" {{ old('nivel') == 'Doctorado' ? 'selected' : '' }}>
                                                Doctorado
                                            </option>
                                        </select>
                                        @error('nivel')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="ano_obtencion" class="form-label">Año de Obtención</label>
                                        <input type="number" class="form-control @error('ano_obtencion') is-invalid @enderror" 
                                               id="ano_obtencion" name="ano_obtencion" 
                                               value="{{ old('ano_obtencion') }}" 
                                               min="1900" max="{{ date('Y') }}"
                                               placeholder="Ej. 2020">
                                        <small class="form-text text-muted">Año en que obtuvo el grado</small>
                                        @error('ano_obtencion')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="nombre_titulo" class="form-label required-field">Nombre del Título o Grado</label>
                                        <input type="text" class="form-control @error('nombre_titulo') is-invalid @enderror" 
                                               id="nombre_titulo" name="nombre_titulo" 
                                               value="{{ old('nombre_titulo') }}" required
                                               placeholder="Ej: Licenciado en Administración de Empresas, Maestro en Ciencias, Doctor en Educación, etc.">
                                        @error('nombre_titulo')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="institucion" class="form-label">Institución Educativa</label>
                                        <input type="text" class="form-control @error('institucion') is-invalid @enderror" 
                                               id="institucion" name="institucion" 
                                               value="{{ old('institucion') }}"
                                               placeholder="Ej: Universidad Nacional Autónoma de México, Instituto Politécnico Nacional, etc.">
                                        @error('institucion')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Columna derecha: Documento -->
                            <div>
                                <!-- Sección: Documento -->
                                <div class="form-section">
                                    <h5><i class="fas fa-file-upload me-2"></i>Documento del Grado Académico</h5>
                                    
                                    <div class="file-upload-container" id="upload-area">
                                        <div class="mb-3">
                                            <i class="fas fa-cloud-upload-alt document-icon"></i>
                                            <h5>Subir Documento</h5>
                                            <p class="text-muted">Arrastra y suelta tu archivo aquí o haz clic para seleccionar</p>
                                            <p class="text-muted small">Formatos permitidos: PDF, JPG, JPEG, PNG (Máx. 2MB)</p>
                                            
                                            <input type="file" class="form-control @error('documento') is-invalid @enderror" 
                                                   id="documento" name="documento" 
                                                   accept=".pdf,.jpg,.jpeg,.png" style="display: none;">
                                            @error('documento')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            
                                            <div id="file-preview" class="file-preview">
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-file-pdf text-danger me-2"></i>
                                                    <span id="file-name"></span>
                                                    <button type="button" class="btn btn-sm btn-outline-danger ms-2" id="remove-file">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="info-alert p-3 mt-3">
                                        <small>
                                            <i class="fas fa-info-circle me-2"></i>
                                            <strong>Recomendación:</strong> Suba una copia digitalizada de su título, cédula profesional o documento que acredite el grado académico.
                                        </small>
                                    </div>
                                </div>
                            </div>

                            <!-- Secciones de ancho completo -->
                            <div class="full-width-section">
                                <!-- Sección: Cédula Profesional -->
                                <div class="form-section">
                                    <h5><i class="fas fa-id-card me-2"></i>Cédula Profesional (Opcional)</h5>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="cedula_profesional" class="form-label">Número de Cédula Profesional</label>
                                                <input type="text" class="form-control @error('cedula_profesional') is-invalid @enderror" 
                                                       id="cedula_profesional" name="cedula_profesional" 
                                                       value="{{ old('cedula_profesional') }}"
                                                       placeholder="Ej: 1234567">
                                                <small class="form-text text-muted">Número oficial de cédula profesional</small>
                                                @error('cedula_profesional')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="fecha_expedicion_cedula" class="form-label">Fecha de Expedición</label>
                                                <input type="date" class="form-control @error('fecha_expedicion_cedula') is-invalid @enderror" 
                                                       id="fecha_expedicion_cedula" name="fecha_expedicion_cedula" 
                                                       value="{{ old('fecha_expedicion_cedula') }}">
                                                <small class="form-text text-muted">Fecha cuando se expidió la cédula</small>
                                                @error('fecha_expedicion_cedula')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Sección: Observaciones -->
                                <div class="form-section">
                                    <h5><i class="fas fa-sticky-note me-2"></i>Información Adicional</h5>
                                    
                                    <div class="mb-3">
                                        <label for="observaciones" class="form-label">Observaciones o Comentarios</label>
                                        <textarea class="form-control @error('observaciones') is-invalid @enderror" 
                                                  id="observaciones" name="observaciones" rows="3"
                                                  placeholder="Observaciones adicionales sobre este grado académico, especializaciones, reconocimientos, etc.">{{ old('observaciones') }}</textarea>
                                        @error('observaciones')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Validaciones en tiempo real
        document.addEventListener('DOMContentLoaded', function() {
            // Validar año de obtención
            const añoInput = document.getElementById('ano_obtencion');
            if (añoInput) {
                añoInput.addEventListener('change', function() {
                    const añoActual = new Date().getFullYear();
                    if (this.value > añoActual) {
                        alert('El año de obtención no puede ser mayor al año actual');
                        this.value = añoActual;
                    }
                    if (this.value < 1900) {
                        alert('El año de obtención no puede ser menor a 1900');
                        this.value = 1900;
                    }
                });
            }

            // Validar fecha de expedición
            const fechaInput = document.getElementById('fecha_expedicion_cedula');
            if (fechaInput) {
                fechaInput.addEventListener('change', function() {
                    const fechaSeleccionada = new Date(this.value);
                    const hoy = new Date();
                    
                    if (fechaSeleccionada > hoy) {
                        alert('La fecha de expedición no puede ser futura');
                        this.value = '';
                    }
                });
            }

            // Convertir a mayúsculas el título automáticamente
            const tituloInput = document.getElementById('nombre_titulo');
            if (tituloInput) {
                tituloInput.addEventListener('input', function() {
                    this.value = this.value.toUpperCase();
                });
            }

            // Manejo de la subida de archivos
            const fileInput = document.getElementById('documento');
            const filePreview = document.getElementById('file-preview');
            const fileName = document.getElementById('file-name');
            const removeFileBtn = document.getElementById('remove-file');
            const uploadArea = document.getElementById('upload-area');

            // Hacer que el área de subida sea clickeable
            if (uploadArea) {
                uploadArea.addEventListener('click', function() {
                    fileInput.click();
                });
            }

            // Mostrar vista previa del archivo
            if (fileInput) {
                fileInput.addEventListener('change', function() {
                    if (this.files && this.files[0]) {
                        fileName.textContent = this.files[0].name;
                        filePreview.style.display = 'block';
                        
                        // Cambiar icono según tipo de archivo
                        const fileIcon = filePreview.querySelector('i');
                        const fileExtension = this.files[0].name.split('.').pop().toLowerCase();
                        
                        if (fileExtension === 'pdf') {
                            fileIcon.className = 'fas fa-file-pdf text-danger me-2';
                        } else if (['jpg', 'jpeg', 'png'].includes(fileExtension)) {
                            fileIcon.className = 'fas fa-file-image text-success me-2';
                        } else {
                            fileIcon.className = 'fas fa-file text-primary me-2';
                        }
                    }
                });
            }

            // Eliminar archivo seleccionado
            if (removeFileBtn) {
                removeFileBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    fileInput.value = '';
                    filePreview.style.display = 'none';
                });
            }

            // Drag & Drop functionality
            if (uploadArea) {
                ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                    uploadArea.addEventListener(eventName, preventDefaults, false);
                });

                function preventDefaults(e) {
                    e.preventDefault();
                    e.stopPropagation();
                }

                ['dragenter', 'dragover'].forEach(eventName => {
                    uploadArea.addEventListener(eventName, highlight, false);
                });

                ['dragleave', 'drop'].forEach(eventName => {
                    uploadArea.addEventListener(eventName, unhighlight, false);
                });

                function highlight() {
                    uploadArea.classList.add('dragover');
                }

                function unhighlight() {
                    uploadArea.classList.remove('dragover');
                }

                uploadArea.addEventListener('drop', handleDrop, false);

                function handleDrop(e) {
                    const dt = e.dataTransfer;
                    const files = dt.files;
                    fileInput.files = files;
                    
                    // Disparar evento change para procesar el archivo
                    const event = new Event('change');
                    fileInput.dispatchEvent(event);
                }
            }

            // Validar tamaño de archivo antes de enviar
            const form = document.querySelector('form');
            if (form) {
                form.addEventListener('submit', function(e) {
                    const fileInput = document.getElementById('documento');
                    if (fileInput && fileInput.files.length > 0) {
                        const fileSize = fileInput.files[0].size / 1024 / 1024; // Tamaño en MB
                        if (fileSize > 2) {
                            e.preventDefault();
                            alert('El archivo es demasiado grande. El tamaño máximo permitido es 2MB.');
                            return false;
                        }
                    }
                });
            }

            // Toggle para mostrar/ocultar la tabla de grados
            const toggleGradosBtn = document.getElementById('toggleGradosBtn');
            const gradosTable = document.getElementById('gradosTable');
            
            if (toggleGradosBtn && gradosTable) {
                toggleGradosBtn.addEventListener('click', function() {
                    if (gradosTable.style.display === 'none' || gradosTable.style.display === '') {
                        gradosTable.style.display = 'block';
                        this.innerHTML = '<i class="fas fa-eye-slash me-2"></i>Ocultar Grados Académicos Registrados';
                    } else {
                        gradosTable.style.display = 'none';
                        this.innerHTML = '<i class="fas fa-list me-2"></i>Ver Grados Académicos Registrados';
                    }
                });
            }
        });
    </script>
</body>
</html>