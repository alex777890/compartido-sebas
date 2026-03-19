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
        return view('inicio');
    }

    // Procesa el login - ACTUALIZADO con nuevo rol
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

            // Redirección por rol - AGREGADO ADMINISTRATIVOS
            switch($user->role) {
                case 'admin':
                    return redirect()->route('dashboard.admin');
                case 'profesor':
                    return redirect()->route('profesor.completar-perfil');
                case 'coordinacion':
                    return redirect()->route('dashboard.coordinacion');
                case 'directivos':
                    return redirect()->route('directivos.dashboard');
                case 'administrativos': // NUEVO ROL
                    // Verificar si ya completó su perfil
                    if ($user->perfilAdministrativoCompleto()) {
                        return redirect()->route('administrativos.dashboard');
                    } else {
                        return redirect()->route('administrativos.completar-perfil');
                    }
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
   
    // Muestra el formulario de registro - SIN CAMBIOS
    public function showRegistrationForm()
    {
        $coordinaciones = Coordinacion::activas()->get();
        return view('auth.register', compact('coordinaciones'));
    }

    // Procesa el registro - SIN CAMBIOS
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name'                  => 'required|string|max:255',
            'email'                 => 'required|string|email|max:255|unique:users',
            'password'              => 'required|string|min:8|confirmed',
            'coordinaciones_id'     => 'nullable|exists:coordinaciones,id'
        ]);

        $role = !empty($validatedData['coordinaciones_id']) ? 'coordinacion' : 'profesor';

        if ($role === 'coordinacion') {
            $coordinacion = Coordinacion::find($validatedData['coordinaciones_id']);
            if (!$coordinacion || !$coordinacion->activa) {
                return back()->withErrors([
                    'coordinaciones_id' => 'La coordinación seleccionada no es válida o no está activa.'
                ])->withInput();
            }
        }

        $user = User::create([
            'name'           => $validatedData['name'],
            'email'          => $validatedData['email'],
            'password'       => Hash::make($validatedData['password']),
            'role'           => $role,
            'coordinaciones_id' => $validatedData['coordinaciones_id'] ?? null,
        ]);

        if ($role === 'profesor') {
            Auth::login($user);
            return redirect()->route('profesor.completar-perfil')
                ->with('success', 'Cuenta creada exitosamente. Por favor completa tu perfil.');
        } else {
            return redirect()->route('login')
                ->with('success', 'Cuenta de coordinación creada exitosamente. Ahora puedes iniciar sesión.');
        }
    }

    // Logout
    public function logout(Request $request)
    {
        $request->session()->forget('user_current_role');
        
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    // Actualizar rol de usuario (solo para admin) - ACTUALIZADO
    public function actualizarRol(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:admin,profesor,coordinacion,directivos,administrativos' // AGREGADO administrativos
        ]);

        $rolAnterior = $user->role;
        $user->update(['role' => $request->role]);

        return back()->with('success', "Rol de {$user->name} cambiado de {$rolAnterior} a {$request->role}");
    }
}