<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Coordinacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    /**
     * Mostrar la lista de usuarios con paginación y filtros.
     */
   public function index(Request $request)
{
    // Iniciar query cargando explícitamente la relación
    $query = User::with(['coordinacion' => function($query) {
        // Especifica qué columnas necesitas
        $query->select('id', 'nombre');
    }]);
    
    // DEPURACIÓN: Registrar información
    \Log::info('Iniciando consulta de usuarios', [
        'search' => $request->search,
        'role' => $request->role,
        'coordinacion' => $request->coordinacion
    ]);
    
    // Aplicar filtro por nombre/apellidos si se proporciona
    if ($request->has('search') && !empty($request->search)) {
        $searchTerm = $request->search;
        $query->where(function($q) use ($searchTerm) {
            $q->where('name', 'like', "%{$searchTerm}%")
              ->orWhere('email', 'like', "%{$searchTerm}%");
        });
    }
    
    // Aplicar filtro por rol si se proporciona
    if ($request->has('role') && !empty($request->role)) {
        $query->where('role', $request->role);
    }
    
    // Aplicar filtro por coordinación si se proporciona
    if ($request->has('coordinacion') && !empty($request->coordinacion)) {
        $query->where('coordinaciones_id', $request->coordinacion);
    }
    
    // Ordenar por defecto
    $query->orderBy('created_at', 'desc');
    
    // Obtener usuarios con paginación
    $users = $query->paginate(10)->withQueryString();
    
    // DEPURACIÓN: Verificar qué obtuvimos
    if ($users->count() > 0) {
        $firstUser = $users->first();
        \Log::info('Primer usuario obtenido', [
            'id' => $firstUser->id,
            'name' => $firstUser->name,
            'coordinaciones_id' => $firstUser->coordinaciones_id,
            'tiene_relacion' => $firstUser->relationLoaded('coordinacion') ? 'SÍ' : 'NO',
            'coordinacion' => $firstUser->coordinacion ? $firstUser->coordinacion->toArray() : 'NULL'
        ]);
    }
    
    // Obtener todas las coordinaciones activas para el filtro
    $coordinaciones = Coordinacion::where('activo', true)
        ->select('id', 'nombre')
        ->get();
    
    // Estadísticas
    $totalQuery = User::query();
    $totalUsers = $totalQuery->count();
    $activeUsers = $totalUsers;
    $inactiveUsers = 0;
    $adminUsers = $totalQuery->clone()->where('role', 'admin')->count();
    $profesorUsers = $totalQuery->clone()->where('role', 'profesor')->count();
    $coordinacionUsers = $totalQuery->clone()->where('role', 'coordinacion')->count();

    return view('crud.index', compact(
        'users',
        'coordinaciones',
        'totalUsers',
        'activeUsers',
        'inactiveUsers',
        'adminUsers',
        'profesorUsers',
        'coordinacionUsers'
    ));
}

    /**
     * Mostrar formulario para crear un nuevo usuario.
     */
    public function create()
    {
        $coordinaciones = Coordinacion::where('activo', true)
            ->select('id', 'nombre') // Remover 'display_name' si no existe
            ->get();
        return view('crud.create', compact('coordinaciones'));
    }

    /**
     * Guardar un nuevo usuario.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => 'required|in:admin,profesor,coordinacion',
            'coordinaciones_id' => 'nullable|exists:coordinaciones,id'
        ]);

        if ($request->role === 'coordinacion' && empty($request->coordinaciones_id)) {
            return back()->withErrors([
                'coordinaciones_id' => 'Debe seleccionar una coordinación para este rol.'
            ])->withInput();
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'coordinaciones_id' => $request->role === 'coordinacion' ? $request->coordinaciones_id : null,
        ]);

        return redirect()->route('users.index')->with('success', 'Usuario creado exitosamente.');
    }

    /**
     * Mostrar formulario de edición de usuario.
     */
    public function edit(User $user)
    {
        $coordinaciones = Coordinacion::where('activo', true)
            ->select('id', 'nombre') // Remover 'display_name' si no existe
            ->get();
        return view('crud.edit', compact('user', 'coordinaciones'));
    }

    /**
     * Actualizar un usuario existente.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,profesor,coordinacion',
            'coordinaciones_id' => 'nullable|exists:coordinaciones,id',
            'password' => 'nullable|confirmed|min:8'
        ]);

        if ($request->role === 'coordinacion' && empty($request->coordinaciones_id)) {
            return back()->withErrors([
                'coordinaciones_id' => 'Debe seleccionar una coordinación para este rol.'
            ])->withInput();
        }

        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'coordinaciones_id' => $request->role === 'coordinacion' ? $request->coordinaciones_id : null,
        ];

        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        $user->update($updateData);

        return redirect()->route('users.index')->with('success', 'Usuario actualizado exitosamente.');
    }

    /**
     * Eliminar un usuario.
     */
    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return redirect()->route('users.index')->with('error', 'No puedes eliminar tu propio usuario.');
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'Usuario eliminado exitosamente.');
    }
}