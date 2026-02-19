<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Coordinacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Muestra el formulario de login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Procesa el login
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
   
    // Muestra el formulario de registro
    public function showRegistrationForm()
    {
        // Obtener todas las coordinaciones activas para el formulario
        $coordinaciones = Coordinacion::activas()->get();
        return view('auth.register', compact('coordinaciones'));
    }

    // Procesa el registro - VERSIÓN CORREGIDA
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name'                  => 'required|string|max:255',
            'email'                 => 'required|string|email|max:255|unique:users',
            'password'              => 'required|string|min:8|confirmed',
            'coordinaciones_id'     => 'nullable|exists:coordinaciones,id'
        ]);

        // Crear el usuario con rol 'profesor' por defecto
        // Si se seleccionó una coordinación, asumimos que es de coordinación
        $role = !empty($validatedData['coordinaciones_id']) ? 'coordinacion' : 'profesor';

        // Validar que si se seleccionó coordinación, sea válida
        if ($role === 'coordinacion') {
            // Verificar que la coordinación existe y está activa
            $coordinacion = Coordinacion::find($validatedData['coordinaciones_id']);
            if (!$coordinacion || !$coordinacion->activa) {
                return back()->withErrors([
                    'coordinaciones_id' => 'La coordinación seleccionada no es válida o no está activa.'
                ])->withInput();
            }
        }

        // Crear el usuario
        $user = User::create([
            'name'           => $validatedData['name'],
            'email'          => $validatedData['email'],
            'password'       => Hash::make($validatedData['password']),
            'role'           => $role,
            'coordinaciones_id' => $validatedData['coordinaciones_id'] ?? null,
        ]);

        // Redirigir según el rol
        if ($role === 'profesor') {
            // Iniciar sesión automáticamente y redirigir a completar perfil
            Auth::login($user);
            return redirect()->route('profesor.completar-perfil')
                ->with('success', 'Cuenta creada exitosamente. Por favor completa tu perfil.');
        } else {
            // Para coordinación, redirigir al login
            return redirect()->route('login')
                ->with('success', 'Cuenta de coordinación creada exitosamente. Ahora puedes iniciar sesión.');
        }
    }

    // Logout
    public function logout(Request $request)
    {
        // Limpiar la sesión del rol
        $request->session()->forget('user_current_role');
        
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    // Actualizar rol de usuario (solo para admin)
    public function actualizarRol(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:admin,profesor,coordinacion'
        ]);

        $rolAnterior = $user->role;
        $user->update(['role' => $request->role]);

        return back()->with('success', "Rol de {$user->name} cambiado de {$rolAnterior} a {$request->role}");
    }
}