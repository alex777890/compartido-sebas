<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asignar Horario - {{ $maestro->nombre_completo }} | GEPROC GP</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #1a4cba;
            --primary-dark: #0a3a9e;
            --primary-light: #2a5cd4;
            --secondary: #33CAE6;
            --accent: #26E63F;
            --dark-primary: #052e7a;
            --light-primary: rgba(26, 76, 186, 0.08);
            --light-bg: #f8fafc;
            --card-bg: #ffffff;
            --border-color: #e1e5eb;
            --text-muted: #64748b;
            --text-dark: #1e293b;
            --shadow-sm: 0 2px 8px rgba(26, 76, 186, 0.05);
            --shadow-md: 0 4px 12px rgba(26, 76, 186, 0.08);
            --shadow-lg: 0 8px 24px rgba(26, 76, 186, 0.12);
            --gradient-primary: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            --sky-blue: #3498db; /* Azul cielo sólido */
            --sky-blue-dark: #2980b9;
            --transition: all 0.3s ease;
            --success-bg: #dcfce7;
            --success-text: #166534;
            --success-border: #bbf7d0;
            --warning-bg: #fef3c7;
            --warning-text: #92400e;
            --warning-border: #fde68a;
            --danger-bg: #fee2e2;
            --danger-text: #991b1b;
            --danger-border: #fecaca;
            --info-bg: #dbeafe;
            --info-text: #1e40af;
            --info-border: #bfdbfe;
            /* Nuevos colores para la tabla */
            --table-header-bg: #2c3e50; /* Gris azulado oscuro para encabezados */
            --table-header-text: #ffffff;
            --table-time-col-bg: #34495e; /* Gris ligeramente más claro para la columna de horas */
            --table-time-col-text: #ffffff;
            --table-border: #dee2e6;
            --table-cell-occupied-bg: #f0f7ff; /* Azul muy claro para celdas ocupadas */
            --table-cell-occupied-border: #3498db;
            --table-cell-hover-bg: #e8f0fe; /* Color de hover más suave */
            --table-cell-vacia-hover-bg: #f1f5f9; /* Gris muy claro para hover de celdas vacías */
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', 'Segoe UI', system-ui, sans-serif;
        }

        body {
            background: #f5f7fb;
            color: var(--text-dark);
            min-height: 100vh;
        }

        /* Top Bar Superior */
        .top-bar {
            background: white;
            height: 70px;
            border-bottom: 2px solid #e0e7ef;
            display: flex;
            align-items: center;
            padding: 0 40px;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1001;
            box-shadow: 0 2px 10px rgba(0,0,0,0.03);
        }

        .top-bar-content {
            max-width: 1400px;
            margin: 0 auto;
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-logo {
            display: flex;
            align-items: center;
            padding: 0;
            background: transparent;
            border-radius: 0;
            box-shadow: none;
            border: none;
        }

        .logo-img-header {
            width: 80px;
            height: 80px;
            object-fit: contain;
            margin-right: 12px;
        }

        .header-logo span {
            color: var(--primary);
            font-weight: 700;
            font-size: 1.3rem;
            letter-spacing: 0.5px;
        }

        .top-bar-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .top-bar-divider {
            width: 1px;
            height: 30px;
            background: #e0e7ef;
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            background: var(--light-primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-weight: 600;
            font-size: 1rem;
            border: 2px solid white;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        /* Top Navigation */
        .top-nav {
            background: var(--gradient-primary);
            position: fixed;
            top: 70px;
            left: 0;
            right: 0;
            z-index: 1000;
            box-shadow: 0 4px 20px rgba(26, 76, 186, 0.25);
        }

        .nav-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 40px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 70px;
        }

        .nav-left {
            display: flex;
            align-items: center;
            gap: 30px;
        }

        .divider-white {
            width: 2px;
            height: 40px;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 2px;
        }

        .nav-menu {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 24px;
            color: rgba(255, 255, 255, 0.85);
            text-decoration: none;
            border-radius: 10px;
            transition: all 0.2s ease;
            font-weight: 500;
            font-size: 1rem;
            position: relative;
        }

        .nav-item i {
            font-size: 1.1rem;
        }

        .nav-item:hover {
            background: rgba(255, 255, 255, 0.15);
            color: white;
            transform: translateY(-2px);
        }

        .nav-item.active {
            color: white;
            background: rgba(255, 255, 255, 0.12);
            font-weight: 600;
        }

        .nav-item.active::after {
            content: '';
            position: absolute;
            bottom: -18px;
            left: 0;
            width: 100%;
            height: 3px;
            background: white;
            border-radius: 3px 3px 0 0;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .nav-right {
            display: flex;
            align-items: center;
        }

        .logout-btn {
            background: rgba(255, 255, 255, 0.15);
            border: none;
            padding: 10px 20px;
            border-radius: 30px;
            color: white;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.95rem;
            font-weight: 500;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .logout-btn i {
            font-size: 1rem;
        }

        .logout-btn:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: translateY(-2px);
            border-color: rgba(255, 255, 255, 0.3);
        }

        /* Main Content - Ajustado por las dos barras */
        .main-content {
            margin-top: 140px; /* 70px (top bar) + 70px (nav) */
            padding: 30px 40px;
            min-height: calc(100vh - 140px);
        }

        .content-container {
            max-width: 1400px;
            margin: 0 auto;
        }

        /* Breadcrumb */
        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
            font-size: 0.9rem;
        }

        .breadcrumb a {
            color: var(--text-muted);
            text-decoration: none;
        }

        .breadcrumb a:hover {
            color: var(--primary);
        }

        .breadcrumb i {
            font-size: 0.7rem;
            color: var(--text-muted);
        }

        .breadcrumb .active {
            color: var(--primary);
            font-weight: 600;
        }

        /* Card Horario - Manteniendo estructura original */
        .card-horario {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            background: white;
        }

        /* ========== ESTILOS MEJORADOS PARA LA TABLA DE HORARIOS ========== */
        .table-horarios {
            font-size: 0.8rem;
            margin-bottom: 0;
            border-collapse: collapse; /* Cambiado a collapse para bordes más definidos */
            width: 100%;
            border: 1px solid var(--table-border);
            border-radius: 8px;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
        }

        /* Encabezado de la tabla (días de la semana) - Ahora en mayúsculas y con mejor contraste */
        .table-horarios thead th {
            background: var(--table-header-bg) !important;
            color: var(--table-header-text);
            font-weight: 600;
            padding: 12px 8px;
            text-align: center;
            border: 1px solid var(--table-border);
            font-size: 0.9rem;
            letter-spacing: 0.5px;
            text-transform: uppercase; /* DÍAS EN MAYÚSCULAS */
            white-space: nowrap;
        }

        /* Columna de horas (primera columna) - Mejor contraste */
        .table-horarios tbody td:first-child {
            background: var(--table-time-col-bg) !important;
            color: var(--table-time-col-text);
            font-weight: 600;
            border: 1px solid var(--table-border);
            text-align: center;
            vertical-align: middle;
        }

        .table-horarios tbody td:first-child .badge {
            background: rgba(255, 255, 255, 0.2) !important;
            color: white;
            padding: 6px 10px;
            font-size: 0.8rem;
            border-radius: 4px;
        }

        /* Estilos generales para las celdas de contenido */
        .table-horarios td {
            padding: 8px 4px;
            vertical-align: middle;
            border: 1px solid var(--table-border);
            text-align: center;
            min-height: 60px;
            height: 60px;
            transition: background-color 0.2s ease;
        }

        /* Celda de hora normal (vacía) */
        .hora-cell.vacia {
            background-color: #ffffff;
            cursor: pointer;
        }

        .hora-cell.vacia:hover {
            background-color: var(--table-cell-vacia-hover-bg);
            cursor: pointer;
        }

        /* Celda ocupada (con materia) - AHORA CON MEJOR CONTRASTE */
        .hora-cell.ocupada {
            background-color: var(--table-cell-occupied-bg);
            border: 2px solid var(--table-cell-occupied-border) !important; /* Borde más visible */
            position: relative;
            cursor: pointer;
            box-shadow: inset 0 0 0 1px rgba(52, 152, 219, 0.2); /* Sutil brillo interno */
        }

        .hora-cell.ocupada:hover {
            background-color: #e1f0fd; /* Un tono más oscuro al hacer hover */
        }

        /* Contenedor del contenido de la celda */
        .celda-contenido {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 40px;
            width: 100%;
            height: 100%;
        }

        /* Botón de eliminar dentro de la celda - Mejorado */
        .btn-eliminar-celda {
            position: absolute;
            top: -6px;
            right: -6px;
            width: 22px;
            height: 22px;
            background: #e74c3c;
            color: white;
            border: none;
            border-radius: 50%;
            font-size: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            opacity: 0;
            transition: opacity 0.2s ease, transform 0.2s ease;
            z-index: 10;
            box-shadow: 0 2px 6px rgba(231, 76, 60, 0.4);
            padding: 0;
            line-height: 1;
        }

        .hora-cell.ocupada:hover .btn-eliminar-celda {
            opacity: 1;
        }

        .btn-eliminar-celda:hover {
            transform: scale(1.15);
            background: #c0392b;
        }

        /* Indicador de celda vacía al hacer hover (para dar feedback de que se puede hacer clic) */
        .hora-cell.vacia:hover::after {
            content: '➕';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 1.2rem;
            opacity: 0.3;
            color: var(--primary);
            pointer-events: none;
        }

        /* Colores originales para las materias (se mantienen) */
        .materia-badge {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 600;
            color: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.15);
            max-width: 100%;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            border: 1px solid rgba(255,255,255,0.2);
        }

        .color-1 { background-color: #1a4cba; }
        .color-2 { background-color: #dc3545; }
        .color-3 { background-color: #fd7e14; }
        .color-4 { background-color: #ffc107; color: #000; }
        .color-5 { background-color: #17a2b8; }
        .color-6 { background-color: #6c757d; }
        .color-7 { background-color: #198754; }
        .color-8 { background-color: #6610f2; }

        .btn-agregar-materia {
            background: var(--gradient-primary);
            color: white;
            border: none;
        }

        .btn-agregar-materia:hover {
            background: var(--primary-dark);
            color: white;
        }

        .materia-item {
            border-left: 4px solid;
            margin-bottom: 0.5rem;
            cursor: pointer;
            transition: all 0.3s;
            border-radius: 5px;
            background: white;
        }

        .materia-item:hover {
            transform: translateX(3px);
            box-shadow: 0 3px 6px rgba(0,0,0,0.08);
        }

        .materia-seleccionada {
            background-color: rgba(26, 76, 186, 0.05);
            border: 2px solid var(--primary);
            border-left: 4px solid var(--primary);
        }

        .lista-materias-container {
            max-height: 150px;
            overflow-y: auto;
            padding-right: 5px;
        }

        .configuracion-aula-grupo {
            background-color: rgba(26, 76, 186, 0.03);
            padding: 1rem;
            border-radius: 8px;
            border: 1px solid rgba(26, 76, 186, 0.1);
        }

        /* Estilos para la sección de foto del horario */
        .foto-horario-container {
            background-color: rgba(26, 76, 186, 0.03);
            padding: 1rem;
            border-radius: 8px;
            border: 1px solid rgba(26, 76, 186, 0.1);
        }

        .foto-preview {
            max-width: 200px;
            max-height: 150px;
            border-radius: 8px;
            border: 2px solid var(--primary);
            box-shadow: var(--shadow-sm);
            object-fit: cover;
        }

        .btn-foto {
            padding: 0.25rem 0.75rem;
            font-size: 0.8rem;
            border-radius: 4px;
            transition: all 0.2s ease;
        }

        .btn-ver-foto {
            background-color: var(--primary);
            color: white;
            border: none;
        }

        .btn-ver-foto:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: var(--shadow-sm);
        }

        .btn-descargar-foto {
            background-color: #27ae60;
            color: white;
            border: none;
        }

        .btn-descargar-foto:hover {
            background-color: #219a52;
            transform: translateY(-2px);
            box-shadow: var(--shadow-sm);
        }

        .btn-subir-foto {
            background-color: var(--sky-blue);
            color: white;
            border: none;
            margin-top: 5px;
        }

        .btn-subir-foto:hover {
            background-color: var(--sky-blue-dark);
            transform: translateY(-2px);
            box-shadow: var(--shadow-sm);
        }

        /* Resumen más compacto */
        .resumen-horas .horas-totales {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--primary);
        }

        .horas-dia-container {
            background: white;
            padding: 0.3rem;
            border-radius: 5px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }

        .horas-dia-container small {
            font-size: 0.7rem;
        }

        .alert-temporal {
            position: fixed;
            top: 150px;
            right: 20px;
            z-index: 1050;
            min-width: 300px;
            box-shadow: 0 3px 15px rgba(0,0,0,0.1);
            border-left: 4px solid;
        }

        .periodo-con-horario {
            font-weight: 600;
            color: var(--primary);
        }

        /* Badge de período habilitado mejorado */
        .periodo-badge {
            background-color: #27ae60;
            color: white;
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 0.7rem;
            margin-left: 8px;
            display: inline-flex;
            align-items: center;
            gap: 3px;
            font-weight: 500;
        }

        .periodo-badge i {
            font-size: 0.6rem;
        }

        /* Botones mejorados */
        .btn-outline-secondary {
            border: 1px solid var(--border-color);
            color: var(--text-muted);
        }

        .btn-outline-secondary:hover {
            background: var(--light-primary);
            border-color: var(--primary);
            color: var(--primary);
        }

        .btn-success {
            background: var(--gradient-primary);
            border: none;
            padding: 10px 25px;
        }

        .btn-success:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.9rem;
            text-decoration: none;
            transition: var(--transition);
            border: none;
            cursor: pointer;
        }

        .btn-primary {
            background: var(--gradient-primary);
            color: white;
            box-shadow: 0 4px 12px rgba(26, 76, 186, 0.2);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(26, 76, 186, 0.3);
        }

        .btn-secondary {
            background: white;
            color: var(--text-dark);
            border: 1px solid var(--border-color);
        }

        .btn-secondary:hover {
            background: var(--light-primary);
            border-color: var(--primary);
            color: var(--primary);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .main-content {
                padding: 20px;
                margin-top: 140px;
            }
            
            .nav-menu {
                display: none;
            }

            .table-horarios thead th {
                font-size: 0.7rem;
                padding: 8px 4px;
            }
            
            .table-horarios tbody td:first-child {
                font-size: 0.7rem;
            }
        }
    </style>
</head>
<body>
    <!-- El contenido del body se mantiene EXACTAMENTE IGUAL -->
    <!-- ... (todo el contenido PHP y HTML del body permanece sin cambios) ... -->
    @php
        use Illuminate\Support\Facades\Auth;
        use App\Models\Coordinacion;
        use Illuminate\Support\Facades\Storage;
        
        $user = Auth::user();
        $coordinacion = $user->coordinaciones_id ? Coordinacion::find($user->coordinaciones_id) : null;
        
        // Iniciales del usuario para el avatar
        $userInitials = '';
        if ($user && $user->name) {
            $names = explode(' ', $user->name);
            foreach ($names as $name) {
                if (!empty($name)) {
                    $userInitials .= strtoupper(substr($name, 0, 1));
                }
            }
            $userInitials = substr($userInitials, 0, 2);
        }

        // Obtener la foto actual del horario si existe
        $fotoActual = null;
        $fotoUrl = null;
        if (isset($periodoId) && $periodoId) {
            $horarioExistente = \App\Models\Horario::where('maestro_id', $maestro->id)
                ->where('periodo_id', $periodoId)
                ->whereNotNull('horario_foto')
                ->first();
            if ($horarioExistente && $horarioExistente->horario_foto) {
                $fotoActual = $horarioExistente->horario_foto;
                $fotoUrl = Storage::url($fotoActual);
            }
        }
    @endphp

    <!-- Top Bar Superior -->
    <div class="top-bar">
        <div class="top-bar-content">
            <div class="header-logo">
                <img src="{{ asset('img/logo_iufim.png') }}" alt="Logo IUFIM" class="logo-img-header">
            </div>
        </div>
    </div>

    <!-- Top Navigation -->
    <nav class="top-nav">
        <div class="nav-container">
            <div class="nav-left">
                <div class="divider-white"></div>
                
                <div class="nav-menu">
                    <a href="{{ route('coordinacion.dashboard') }}" class="nav-item">
                        <i class="fas fa-home"></i>
                        <span>Inicio</span>
                    </a>
                    <a href="{{ route('coordinaciones.maestros-detalle') }}" class="nav-item active">
                        <i class="fas fa-users"></i>
                        <span>Maestros</span>
                    </a>
                    <a href="{{ route('coordinaciones.maestros') }}" class="nav-item">
                        <i class="fas fa-file-alt"></i>
                        <span>Documentos</span>
                    </a>
                    <a href="{{ route('coordinaciones.estadisticas', $coordinacion->id ?? '#') }}" class="nav-item">
                        <i class="fas fa-chart-bar"></i>
                        <span>Estadísticas</span>
                    </a>
                    <a href="{{ route('coordinaciones.show', $coordinacion->id ?? '#') }}" class="nav-item">
                        <i class="fas fa-building"></i>
                        <span>Mi Coordinación</span>
                    </a>
                </div>
            </div>
            
            <div class="nav-right">                
                <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Cerrar sesión</span>
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        <div class="content-container">
                        <!-- Action Buttons -->
            <div class="action-buttons">
                <a href="{{ route('coordinaciones.maestros-detalle') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Volver a la lista
                </a>
            </div>

            <!-- Alertas de sesión -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Card Principal -->
            <div class="card card-horario">
                <div class="card-body">
                    <form action="{{ route('horarios.save') }}" method="POST" id="formHorario" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="maestro_id" value="{{ $maestro->id }}">

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div>
                                <h4 class="mb-1">
                                    <i class="fas fa-edit text-primary me-2"></i>
                                    Asignar Horario - {{ $maestro->nombres ?? '' }} {{ $maestro->apellido_paterno ?? '' }} {{ $maestro->apellido_materno ?? '' }}
                                </h4>
                                <p class="text-muted mb-0">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Agrega materias y haz clic en las celdas para asignarlas
                                </p>
                            </div>
                            <div>
                                <select name="periodo_id" id="periodo_id" class="form-select" style="width: 300px;" required>
                                    <option value="">Seleccionar Período</option>
                                    @foreach($periodos as $periodo)
                                        <option value="{{ $periodo->id }}" 
                                            {{ ($periodoId ?? '') == $periodo->id ? 'selected' : '' }}
                                            class="{{ in_array($periodo->id, $periodosConHorario ?? []) ? 'periodo-con-horario' : '' }}">
                                            {{ $periodo->nombre }}
                                            @if(in_array($periodo->id, $periodosConHorario ?? []))
                                                <span class="periodo-badge">
                                                    <i class="fas fa-check-circle"></i> Habilitado
                                                </span>
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Mensaje cuando NO hay periodo seleccionado -->
                        <div id="sin-periodo" class="text-center py-4 bg-light rounded mb-4" style="display: {{ $periodoId ? 'none' : 'block' }};">
                            <div class="mb-3">
                                <i class="fas fa-calendar-plus fa-3x text-muted"></i>
                            </div>
                            <h5 class="mb-2">📋 Primero selecciona un periodo académico</h5>
                            <p class="mb-0 text-muted">Selecciona un período de la lista para comenzar a ingresar el horario.</p>
                        </div>

                        <!-- Contenido cuando SÍ hay periodo seleccionado -->
                        <div id="con-periodo" style="display: {{ $periodoId ? 'block' : 'none' }};">
                            <!-- Agregar Materias -->
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">
                                        <i class="fas fa-book me-2 text-primary"></i>Agregar Materias
                                    </label>
                                    <div class="input-group">
                                        <input type="text" id="input-nueva-materia" class="form-control" placeholder="Nombre de la materia...">
                                        <button type="button" class="btn btn-agregar-materia" id="btn-agregar-materia">
                                            <i class="fas fa-plus me-1"></i> Agregar
                                        </button>
                                    </div>
                                    <small class="text-muted">Escribe materias y luego selecciona en las celdas del horario</small>
                                </div>
                            </div>

                            <!-- Configuración de Aula y Grupo -->
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <div class="configuracion-aula-grupo">
                                        <h6 class="mb-3">
                                            <i class="fas fa-school me-2 text-primary"></i> Aula y Grupo
                                        </h6>
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label for="aula-global" class="form-label">Aula</label>
                                                <input type="text" class="form-control" id="aula-global" placeholder="Ej: AULA Tlaxcala">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="grupo-global" class="form-label">Grupo</label>
                                                <input type="text" class="form-control" id="grupo-global" placeholder="Ej: GRUPO A">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Foto del Horario - Sección corregida con Excel y Word -->
<div class="row mb-4">
    <div class="col-md-12">
        <div class="foto-horario-container">
            <h6 class="mb-3">
                <i class="fas fa-camera me-2 text-primary"></i> Archivo del Nombramiento
            </h6>
            
            <!-- SECCIÓN PARA SUBIR ARCHIVO -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Subir archivo del nombramiento para verificar el horario</label>
                    <div class="input-group">
                        <input type="file" name="horario_foto" id="horario_foto" class="form-control" accept=".jpg,.jpeg,.png,.pdf,.xlsx,.xls,.csv,.doc,.docx">
                        <input type="hidden" name="accion_foto" id="accion_foto" value="">
                        <button type="submit" name="subir_foto" class="btn btn-subir-foto" onclick="document.getElementById('accion_foto').value='subir'">
                            <i class="fas fa-upload"></i> Subir
                        </button>
                    </div>
                    <small class="text-muted">Formatos: JPG, PNG, PDF, Excel (XLSX, XLS, CSV), Word (DOC, DOCX). Máximo 5MB</small>
                </div>
            </div>
            
            <!-- SECCIÓN PARA MOSTRAR ARCHIVO EXISTENTE -->
            @if($fotoActual && $fotoUrl)
            <div class="row">
                <div class="col-md-12">
                    <div class="card border-success">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    @php
                                        $extension = strtolower(pathinfo($fotoActual, PATHINFO_EXTENSION));
                                    @endphp
                                    
                                    @if(in_array($extension, ['pdf']))
                                        <i class="fas fa-file-pdf fa-3x text-danger"></i>
                                    @elseif(in_array($extension, ['xlsx', 'xls', 'csv']))
                                        <i class="fas fa-file-excel fa-3x text-success"></i>
                                    @elseif(in_array($extension, ['doc', 'docx']))
                                        <i class="fas fa-file-word fa-3x text-primary" style="color: #2b5797 !important;"></i>
                                    @elseif(in_array($extension, ['jpg', 'jpeg', 'png', 'gif']))
                                        <i class="fas fa-file-image fa-3x text-primary"></i>
                                    @else
                                        <i class="fas fa-file fa-3x text-secondary"></i>
                                    @endif
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1">Archivo actual:</h6>
                                    <p class="mb-1 text-break">{{ basename($fotoActual) }}</p>
                                    <small class="text-muted">
                                        <i class="fas fa-calendar-alt me-1"></i> 
                                        {{ $horarioExistente->updated_at ? $horarioExistente->updated_at->format('d/m/Y H:i') : 'Fecha no disponible' }}
                                    </small>
                                </div>
                                <div class="ms-3">
                                    <a href="{{ route('horarios.ver-foto', ['maestroId' => $maestro->id, 'periodoId' => $periodoId]) }}" 
       class="btn btn-ver-foto btn-sm" target="_blank">
                                        <i class="fas fa-eye"></i> Ver
                                    </a>
                                    <a href="{{ route('horarios.ver-foto', ['maestroId' => $maestro->id, 'periodoId' => $periodoId]) }}?download=1" 
                                       class="btn btn-descargar-foto btn-sm">
                                        <i class="fas fa-download"></i> Descargar
                                    </a>
                                    <form action="{{ route('horarios.save') }}" method="POST" style="display:inline;">
                                        @csrf
                                        <input type="hidden" name="maestro_id" value="{{ $maestro->id }}">
                                        <input type="hidden" name="periodo_id" value="{{ $periodoId }}">
                                        <input type="hidden" name="eliminar_foto" value="1">
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Eliminar el archivo?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
                            <!-- Lista de Materias -->
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <div class="card border-0 shadow-sm">
                                        <div class="card-header text-white py-2" style="background: var(--gradient-primary);">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h6 class="mb-0">
                                                    <i class="fas fa-list-check me-2"></i> Materias Agregadas
                                                </h6>
                                                <span class="badge bg-light text-primary" id="contador-materias">0</span>
                                            </div>
                                        </div>
                                        <div class="card-body p-2">
                                            <div id="lista-materias" class="lista-materias-container">
                                                <p class="text-muted mb-0 text-center py-3" id="sin-materias">
                                                    <i class="fas fa-book-open me-1"></i> No hay materias agregadas.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Tabla de Horarios -->
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <div class="card border-0 shadow-sm">
                                        <div class="card-header py-2" style="background: var(--table-header-bg);">
                                            <h6 class="mb-0 text-white">
                                                <i class="fas fa-table me-2"></i> Distribución Horaria Semanal
                                                <span id="contador-clases" class="badge bg-light text-dark ms-2">0 clases</span>
                                            </h6>
                                        </div>
                                        <div class="card-body p-0">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-horarios m-0">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 15%">Horario</th>
                                                            <th style="width: 17%">Lunes</th>
                                                            <th style="width: 17%">Martes</th>
                                                            <th style="width: 17%">Miércoles</th>
                                                            <th style="width: 17%">Jueves</th>
                                                            <th style="width: 17%">Viernes</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tabla-horarios-body">
                                                        @php
                                                            $horasDisponibles = ['7-8', '8-9', '9-10', '10-11', '11-12', '12-13', '13-14', '14-15', '15-16', '16-17', '17-18'];
                                                            $diasSemana = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes'];
                                                        @endphp

                                                        @foreach($horasDisponibles as $hora)
                                                            <tr>
                                                                <td class="fw-bold text-center align-middle">
                                                                    <span class="badge">{{ $hora }}</span>
                                                                </td>
                                                                @foreach($diasSemana as $dia)
                                                                    <td class="hora-cell vacia" 
                                                                        data-hora="{{ $hora }}" 
                                                                        data-dia="{{ $dia }}"
                                                                        id="celda-{{ $dia }}-{{ $hora }}"
                                                                        onclick="asignarMateriaACelda(this)">
                                                                        <!-- Vacío intencionalmente -->
                                                                    </td>
                                                                @endforeach
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Resumen de Horas -->
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <div class="card resumen-horas border-0 shadow-sm">
                                        <div class="card-header text-white py-2" style="background: var(--gradient-primary);">
                                            <h6 class="mb-0">
                                                <i class="fas fa-chart-bar me-2"></i> Resumen de Horas por Día
                                            </h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="row text-center">
                                                <div class="col">
                                                    <div class="horas-dia-container">
                                                        <small class="d-block text-muted">Lunes</small>
                                                        <div id="horas-lunes" class="horas-totales">0</div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="horas-dia-container">
                                                        <small class="d-block text-muted">Martes</small>
                                                        <div id="horas-martes" class="horas-totales">0</div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="horas-dia-container">
                                                        <small class="d-block text-muted">Miércoles</small>
                                                        <div id="horas-miercoles" class="horas-totales">0</div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="horas-dia-container">
                                                        <small class="d-block text-muted">Jueves</small>
                                                        <div id="horas-jueves" class="horas-totales">0</div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="horas-dia-container">
                                                        <small class="d-block text-muted">Viernes</small>
                                                        <div id="horas-viernes" class="horas-totales">0</div>
                                                    </div>
                                                </div>
                                                <div class="col-12 mt-3">
                                                    <div class="p-3 bg-light rounded">
                                                        <small class="d-block text-muted">Total Semanal de Horas Clase</small>
                                                        <div id="total-semanal" class="horas-totales" style="color: var(--primary);">
                                                            0 <small>horas</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Campos ocultos para enviar datos -->
                            <div id="hidden-fields-container"></div>
                        </div>

                        <!-- Botones -->
                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <button type="button" id="btn-limpiar-todo" class="btn btn-outline-secondary me-2">
                                <i class="fas fa-trash-alt me-2"></i>Limpiar Todo
                            </button>
                            <button type="submit" class="btn btn-success" id="btn-guardar">
                                <i class="fas fa-save me-2"></i>Guardar Horario
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // ========== VARIABLES GLOBALES ==========
        let materiasSeleccionadas = [];
        let horariosSeleccionados = [];
        let siguienteColor = 1;
        let siguienteId = 1;
        let materiaActiva = null;

        // ========== DATOS INICIALES DESDE PHP ==========
        @if(isset($periodoId) && $periodoId)
            @if(isset($materias) && count($materias) > 0)
                // Convertir materias del formato asociativo a indexed
                materiasSeleccionadas = @json(array_values($materias));
                console.log('✅ Materias cargadas:', materiasSeleccionadas.length);
                
                // Calcular siguienteId y siguienteColor
                if (materiasSeleccionadas.length > 0) {
                    siguienteId = Math.max(...materiasSeleccionadas.map(m => m.id || 0)) + 1;
                    siguienteColor = (Math.max(...materiasSeleccionadas.map(m => m.color || 0)) % 8) + 1;
                }
            @endif
            
            @if(isset($horariosAgrupados) && count($horariosAgrupados) > 0)
                horariosSeleccionados = @json($horariosAgrupados);
                console.log('✅ Horarios cargados:', horariosSeleccionados.length);
            @endif
        @endif

        // ========== FUNCIONES PRINCIPALES ==========
        function actualizarTablaDesdeDatos() {
            console.log('🔄 Actualizando tabla...');
            
            // Limpiar todas las celdas
            document.querySelectorAll('.hora-cell').forEach(celda => {
                celda.innerHTML = '';
                celda.classList.remove('ocupada', 'celda-con-materia');
                celda.classList.add('vacia');
                celda.title = '';
            });
            
            // Llenar con datos existentes
            horariosSeleccionados.forEach(horario => {
                const celdaId = `celda-${horario.dia}-${horario.horario}`;
                const celda = document.getElementById(celdaId);
                
                if (celda) {
                    const materia = materiasSeleccionadas.find(m => m.nombre === horario.materia_nombre);
                    if (materia) {
                        // Crear contenido con botón de eliminar
                        celda.innerHTML = `
                            <div class="celda-contenido">
                                <span class="materia-badge color-${materia.color}">${materia.nombre.substring(0,12)}</span>
                                <button type="button" class="btn-eliminar-celda" onclick="event.stopPropagation(); eliminarHorarioCelda('${horario.dia}', '${horario.horario}')">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        `;
                        celda.classList.remove('vacia');
                        celda.classList.add('ocupada', 'celda-con-materia');
                        celda.title = `${materia.nombre} - ${horario.dia} ${horario.horario}`;
                    } else {
                        // Si no encuentra la materia en la lista actual, usar color por defecto
                        celda.innerHTML = `
                            <div class="celda-contenido">
                                <span class="materia-badge color-1">${horario.materia_nombre.substring(0,12)}</span>
                                <button type="button" class="btn-eliminar-celda" onclick="event.stopPropagation(); eliminarHorarioCelda('${horario.dia}', '${horario.horario}')">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        `;
                        celda.classList.remove('vacia');
                        celda.classList.add('ocupada', 'celda-con-materia');
                    }
                }
            });
            
            actualizarContadorClases();
            console.log(`✅ Tabla actualizada: ${horariosSeleccionados.length} clases`);
        }

        // Función para eliminar un horario específico desde la celda
        function eliminarHorarioCelda(dia, horario) {
            event.stopPropagation();
            
            if (!confirm(`¿Eliminar la clase de ${dia} ${horario}?`)) return;
            
            // Eliminar el horario del array
            horariosSeleccionados = horariosSeleccionados.filter(h => 
                !(h.dia === dia && h.horario === horario)
            );
            
            // Actualizar la celda visualmente
            const celdaId = `celda-${dia}-${horario}`;
            const celda = document.getElementById(celdaId);
            if (celda) {
                celda.innerHTML = '';
                celda.classList.remove('ocupada', 'celda-con-materia');
                celda.classList.add('vacia');
            }
            
            actualizarResumenHoras();
            actualizarCamposOcultos();
            actualizarContadorClases();
            actualizarListaMaterias(); // Para actualizar contadores
            
            mostrarAlerta(`🗑️ Clase eliminada de ${dia} ${horario}`, 'success');
        }

        function actualizarContadorClases() {
            const contador = document.getElementById('contador-clases');
            if (contador) {
                contador.textContent = `${horariosSeleccionados.length} clases`;
            }
        }

        function actualizarListaMaterias() {
            const listaContainer = document.getElementById('lista-materias');
            const contador = document.getElementById('contador-materias');
            
            contador.textContent = materiasSeleccionadas.length;
            
            if (materiasSeleccionadas.length === 0) {
                listaContainer.innerHTML = `<p class="text-muted mb-0 text-center py-3"><i class="fas fa-book-open me-1"></i> No hay materias agregadas.</p>`;
                materiaActiva = null;
                return;
            }
            
            listaContainer.innerHTML = '';
            
            materiasSeleccionadas.forEach((materia) => {
                const esActiva = materiaActiva && materiaActiva.id === materia.id;
                const horariosMateria = horariosSeleccionados.filter(h => h.materia_nombre === materia.nombre).length;
                
                const div = document.createElement('div');
                div.className = `card materia-item ${esActiva ? 'materia-seleccionada' : ''}`;
                div.style.borderLeftColor = getColorHex(materia.color);
                div.style.marginBottom = '8px';
                div.onclick = () => seleccionarMateria(materia.id);
                
                div.innerHTML = `
                    <div class="card-body py-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="flex-grow-1">
                                <span class="badge materia-badge color-${materia.color} me-2">${materia.nombre.substring(0,3).toUpperCase()}</span>
                                <small class="fw-bold">${materia.nombre}</small><br>
                                <small class="text-muted">${horariosMateria} hora(s) asignada(s)</small>
                            </div>
                            <button type="button" class="btn btn-sm btn-outline-danger" title="Eliminar materia">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                `;
                
                div.querySelector('button').addEventListener('click', (e) => {
                    e.stopPropagation();
                    eliminarMateria(materia.id);
                });
                
                listaContainer.appendChild(div);
            });
        }

        function getColorHex(colorIndex) {
            const colores = ['#1a4cba', '#dc3545', '#fd7e14', '#ffc107', '#17a2b8', '#6c757d', '#198754', '#6610f2'];
            return colores[colorIndex - 1] || '#1a4cba';
        }

        function seleccionarMateria(materiaId) {
            materiaActiva = materiasSeleccionadas.find(m => m.id === materiaId);
            if (!materiaActiva) return;
            
            actualizarListaMaterias();
            mostrarAlerta(`🔵 Materia "<strong>${materiaActiva.nombre}</strong>" seleccionada`, 'info');
        }

        function eliminarMateria(materiaId) {
            const materia = materiasSeleccionadas.find(m => m.id === materiaId);
            const horariosMateria = horariosSeleccionados.filter(h => h.materia_nombre === materia.nombre).length;
            
            if (!confirm(`¿Eliminar "${materia.nombre}"? Se eliminarán ${horariosMateria} horario(s).`)) return;
            
            materiasSeleccionadas = materiasSeleccionadas.filter(m => m.id !== materiaId);
            if (materiaActiva && materiaActiva.id === materiaId) materiaActiva = null;
            
            horariosSeleccionados = horariosSeleccionados.filter(h => h.materia_nombre !== materia.nombre);
            
            actualizarTablaDesdeDatos();
            actualizarListaMaterias();
            actualizarResumenHoras();
            actualizarCamposOcultos();
            
            mostrarAlerta(`🗑️ "${materia.nombre}" eliminada`, 'success');
        }

        function actualizarResumenHoras() {
            const horasPorDia = { 'Lunes': 0, 'Martes': 0, 'Miércoles': 0, 'Jueves': 0, 'Viernes': 0 };
            
            horariosSeleccionados.forEach(h => { 
                if(horasPorDia[h.dia] !== undefined) horasPorDia[h.dia]++; 
            });
            
            document.getElementById('horas-lunes').textContent = horasPorDia['Lunes'];
            document.getElementById('horas-martes').textContent = horasPorDia['Martes'];
            document.getElementById('horas-miercoles').textContent = horasPorDia['Miércoles'];
            document.getElementById('horas-jueves').textContent = horasPorDia['Jueves'];
            document.getElementById('horas-viernes').textContent = horasPorDia['Viernes'];
            
            const totalHoras = Object.values(horasPorDia).reduce((a,b) => a+b, 0);
            const totalEl = document.getElementById('total-semanal');
            totalEl.innerHTML = `${totalHoras} <small>horas</small>`;
            totalEl.style.color = 'var(--primary)';
        }

        function actualizarCamposOcultos() {
            const container = document.getElementById('hidden-fields-container');
            container.innerHTML = '';
            
            horariosSeleccionados.forEach((h, i) => {
                container.innerHTML += `
                    <input type="hidden" name="clases[${i}][materia_nombre]" value="${h.materia_nombre.replace(/'/g, "&apos;")}">
                    <input type="hidden" name="clases[${i}][dia]" value="${h.dia}">
                    <input type="hidden" name="clases[${i}][horario]" value="${h.horario}">
                    <input type="hidden" name="clases[${i}][aula]" value="${h.aula || ''}">
                    <input type="hidden" name="clases[${i}][grupo]" value="${h.grupo || ''}">
                `;
            });
        }

        function asignarMateriaACelda(celda) {
            if (!materiaActiva) {
                mostrarAlerta('⚠️ Selecciona una materia primero', 'warning');
                return;
            }
            
            const dia = celda.dataset.dia;
            const horario = celda.dataset.hora;
            
            // Verificar si ya hay materia
            const tieneMateria = celda.classList.contains('ocupada');
            if (tieneMateria) {
                if (!confirm(`¿Reemplazar en ${dia} ${horario}?`)) return;
                // Eliminar horario existente
                horariosSeleccionados = horariosSeleccionados.filter(h => 
                    !(h.dia === dia && h.horario === horario)
                );
            }
            
            // Actualizar visualmente con botón de eliminar
            celda.innerHTML = `
                <div class="celda-contenido">
                    <span class="materia-badge color-${materiaActiva.color}">${materiaActiva.nombre.substring(0,12)}</span>
                    <button type="button" class="btn-eliminar-celda" onclick="event.stopPropagation(); eliminarHorarioCelda('${dia}', '${horario}')">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            `;
            celda.classList.remove('vacia');
            celda.classList.add('ocupada', 'celda-con-materia');
            celda.title = `${materiaActiva.nombre} - ${dia} ${horario}`;
            
            // Agregar a horarios
            horariosSeleccionados.push({
                materia_nombre: materiaActiva.nombre,
                dia: dia,
                horario: horario,
                aula: document.getElementById('aula-global').value || '',
                grupo: document.getElementById('grupo-global').value || ''
            });
            
            actualizarResumenHoras();
            actualizarCamposOcultos();
            actualizarContadorClases();
            actualizarListaMaterias(); // Para actualizar contadores
            
            mostrarAlerta(`✅ "${materiaActiva.nombre}" asignada a ${dia} ${horario}`, 'success');
        }

        function mostrarAlerta(mensaje, tipo = 'info') {
            document.querySelectorAll('.alert-temporal').forEach(a => a.remove());
            
            const alerta = document.createElement('div');
            alerta.className = `alert alert-${tipo} alert-dismissible fade show alert-temporal`;
            
            let icono = 'info-circle';
            if (tipo === 'success') icono = 'check-circle';
            if (tipo === 'warning') icono = 'exclamation-triangle';
            if (tipo === 'danger') icono = 'exclamation-circle';
            
            alerta.innerHTML = `
                <i class="fas fa-${icono} me-2"></i>
                ${mensaje}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
            
            document.querySelector('.card-body').insertBefore(alerta, document.querySelector('.card-body').firstChild);
            
            setTimeout(() => alerta.remove(), 5000);
        }

        // ========== EVENT LISTENERS ==========
        document.getElementById('btn-agregar-materia').addEventListener('click', function() {
            const input = document.getElementById('input-nueva-materia');
            const nombreMateria = input.value.trim();
            
            if (!nombreMateria) {
                mostrarAlerta('⚠️ Escribe un nombre', 'warning');
                return;
            }
            
            if (materiasSeleccionadas.some(m => m.nombre.toLowerCase() === nombreMateria.toLowerCase())) {
                mostrarAlerta('❌ Ya existe', 'danger');
                input.value = '';
                return;
            }
            
            const nuevaMateria = {
                id: siguienteId++,
                nombre: nombreMateria,
                color: siguienteColor
            };
            
            siguienteColor = (siguienteColor % 8) + 1;
            materiasSeleccionadas.push(nuevaMateria);
            materiaActiva = nuevaMateria;
            
            input.value = '';
            actualizarListaMaterias();
            mostrarAlerta(`✅ "${nombreMateria}" agregada`, 'success');
        });

        document.getElementById('input-nueva-materia').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                document.getElementById('btn-agregar-materia').click();
            }
        });

        document.getElementById('btn-limpiar-todo').addEventListener('click', function() {
            if (!confirm('¿Limpiar todas las materias y horarios? Esta acción no se puede deshacer.')) return;
            
            materiasSeleccionadas = [];
            horariosSeleccionados = [];
            siguienteColor = 1;
            siguienteId = 1;
            materiaActiva = null;
            
            document.getElementById('aula-global').value = '';
            document.getElementById('grupo-global').value = '';
            
            actualizarTablaDesdeDatos();
            actualizarListaMaterias();
            actualizarResumenHoras();
            actualizarCamposOcultos();
            
            mostrarAlerta('🧹 Todos los datos han sido limpiados', 'success');
        });

        document.getElementById('periodo_id').addEventListener('change', function() {
            const periodoId = this.value;
            
            if (periodoId) {
                const url = new URL(window.location.href);
                url.searchParams.set('periodo_id', periodoId);
                window.location.href = url.toString();
            } else {
                const url = new URL(window.location.href);
                url.searchParams.delete('periodo_id');
                window.location.href = url.toString();
            }
        });

        document.getElementById('formHorario').addEventListener('submit', function(e) {
    const periodoId = document.getElementById('periodo_id').value;
    const accionFoto = document.getElementById('accion_foto').value;
    const submitter = document.activeElement;
    
    if (!periodoId) {
        e.preventDefault();
        mostrarAlerta('⚠️ Debes seleccionar un periodo académico', 'danger');
        return false;
    }
    
    // Si es acción de subir foto, no validar materias
    if (accionFoto === 'subir' || (submitter && submitter.name === 'subir_foto')) {
        return true;
    }
    
    // Validaciones normales para guardar horario
    if (materiasSeleccionadas.length === 0) {
        e.preventDefault();
        mostrarAlerta('⚠️ Debes agregar al menos una materia', 'danger');
        return false;
    }
    
    if (horariosSeleccionados.length === 0) {
        e.preventDefault();
        mostrarAlerta('⚠️ Debes asignar al menos un horario', 'danger');
        return false;
    }
    
    if (!confirm(`¿Guardar el horario con ${materiasSeleccionadas.length} materias y ${horariosSeleccionados.length} horario(s)?`)) {
        e.preventDefault();
        return false;
    }
    
    return true;
});

        // ========== INICIALIZACIÓN ==========
        document.addEventListener('DOMContentLoaded', function() {
            console.log('📱 Sistema inicializado');
            
            actualizarTablaDesdeDatos();
            actualizarListaMaterias();
            actualizarResumenHoras();
            actualizarCamposOcultos();
        });
    </script>
</body>
</html>