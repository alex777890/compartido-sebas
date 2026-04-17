<!DOCTYPE html>
<html>
<head>
    <title>Diagnóstico - Coordinación</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        table { border-collapse: collapse; width: 100%; margin: 20px 0; }
        th, td { border: 1px solid #ddd; padding: 8px; }
        th { background: #f2f2f2; }
        .success { color: green; font-weight: bold; }
        .error { color: red; font-weight: bold; }
    </style>
</head>
<body>
    <h1>Diagnóstico de Coordinación</h1>
    
    @php
        $user = Auth::user();
        $coordinacion = $user->coordinaciones_id ? \App\Models\Coordinacion::find($user->coordinaciones_id) : null;
        $totalCoordinaciones = \App\Models\Coordinacion::count();
        $totalMaestros = $coordinacion ? \App\Models\Maestro::where('coordinaciones_id', $coordinacion->id)->count() : 0;
    @endphp
    
    <h2>Usuario</h2>
    <table>
        <tr><td><strong>ID:</strong></td><td>{{ $user->id }}</td></tr>
        <tr><td><strong>Nombre:</strong></td><td>{{ $user->name }}</td></tr>
        <tr><td><strong>Email:</strong></td><td>{{ $user->email }}</td></tr>
        <tr><td><strong>Rol:</strong></td><td class="{{ $user->role ? 'success' : 'error' }}">{{ $user->role ?? 'NO TIENE' }}</td></tr>
        <tr><td><strong>coordinaciones_id:</strong></td>
            <td class="{{ $user->coordinaciones_id ? 'success' : 'error' }}">
                {{ $user->coordinaciones_id ?: 'NO TIENE' }}
            </td>
        </tr>
    </table>
    
    <h2>Coordinación</h2>
    @if($coordinacion)
        <table>
            <tr><td><strong>ID:</strong></td><td>{{ $coordinacion->id }}</td></tr>
            <tr><td><strong>Nombre:</strong></td><td>{{ $coordinacion->nombre }}</td></tr>
            <tr><td><strong>Responsable:</strong></td><td>{{ $coordinacion->responsable ?? 'N/A' }}</td></tr>
            <tr><td><strong>Email responsable:</strong></td><td>{{ $coordinacion->responsable_email ?? 'N/A' }}</td></tr>
            <tr><td><strong>Maestros en coordinación:</strong></td><td>{{ $totalMaestros }}</td></tr>
        </table>
    @else
        <p class="error">No tienes coordinación asignada</p>
    @endif
    
    <h2>Sistema</h2>
    <table>
        <tr><td><strong>Total coordinaciones:</strong></td><td>{{ $totalCoordinaciones }}</td></tr>
        <tr><td><strong>Total maestros en sistema:</strong></td><td>{{ \App\Models\Maestro::count() }}</td></tr>
    </table>
    
    <h2>Acciones</h2>
    <ul>
        <li><a href="{{ route('coordinacion.dashboard') }}">Ir al Dashboard</a></li>
        <li><a href="{{ url('/asignar-coordinacion/' . $user->id . '/1') }}" 
               onclick="return confirm('¿Asignar primera coordinación?')">
               Asignarme Primera Coordinación
            </a>
        </li>
        <li><a href="#" onclick="location.reload()">Refrescar</a></li>
    </ul>
</body>
</html>