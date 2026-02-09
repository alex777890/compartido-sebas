<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Coordinacion; // AGREGAR ESTE IMPORT
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Muestra el formulario de login (NO CAMBIA)
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Procesa el login - MODIFICAR ESTE MÉTODO
    public function login(Request $request)
{
    $credentials = $request->validate([
        'email'    => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        $user = Auth::user();

        // GUARDAR EL ROL ACTUAL EN SESIÓN
        session(['user_current_role' => $user->role]);

        // Redirección por rol
        switch($user->role) {
            case 'admin':
                return redirect()->route('dashboard.admin');
            case 'profesor':
                return redirect()->route('profesor.completar-perfil');
            case 'coordinacion':
                return redirect()->route('dashboard.coordinacion');
            default:
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Rol no válido en el sistema.',
                ]);
        }
    }

    return back()->withErrors([
        'email' => 'Credenciales Incorrectas',
    ]);
}
   

    // Muestra el formulario de registro - MODIFICAR ESTE MÉTODO
    public function showRegistrationForm()
    {
        // Obtener todas las coordinaciones activas para el formulario
        $coordinaciones = Coordinacion::activas()->get();
        return view('auth.register', compact('coordinaciones'));
    }

    // Procesa el registro - MODIFICAR ESTE MÉTODO
    public function register(Request $request)
{
    $validatedData = $request->validate([
        'name'                  => 'required|string|max:255',
        'email'                 => 'required|string|email|max:255|unique:users',
        'password'              => 'required|string|min:8|confirmed',
        'role'                  => 'required|in:profesor,coordinacion', // QUITAMOS 'admin'
        'coordinaciones_id'       => 'nullable|exists:coordinaciones,id'
    ]);

    // Validar que si el rol es coordinación, tenga coordinacion_id
    if ($validatedData['role'] === 'coordinacion' && empty($validatedData['coordinaciones_id'])) {
        return back()->withErrors([
            'coordinaciones_id' => 'Debe seleccionar una coordinación para este rol.'
        ]);
    }

    // Validar que si no es coordinación, no tenga coordinacion_id
    if ($validatedData['role'] !== 'coordinacion' && !empty($validatedData['coordinaciones_id'])) {
        $validatedData['coordinaciones_id'] = null;
    }

    // Crear el usuario
    User::create([
        'name'           => $validatedData['name'],
        'email'          => $validatedData['email'],
        'password'       => Hash::make($validatedData['password']),
        'role'           => $validatedData['role'],
        'coordinaciones_id' => $validatedData['coordinaciones_id'] ?? null,
    ]);

    return redirect()->route('login')->with('success', 'Cuenta creada exitosamente. Ahora puedes iniciar sesión.');
}

    // Los demás métodos permanecen igual...
    public function logout(Request $request)
{
    // Limpiar la sesión del rol
    $request->session()->forget('user_current_role');
    
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
}
    public function actualizarRol(Request $request, User $user)
{
    $request->validate([
        'role' => 'required|in:admin,profesor,coordinacion'
    ]);

    $rolAnterior = $user->role;
    $user->update(['role' => $request->role]);

    // Aquí podrías enviar una notificación al usuario si quieres
    // o registrar el cambio en un log

    return back()->with('success', "Rol de {$user->name} cambiado de {$rolAnterior} a {$request->role}");
}
}