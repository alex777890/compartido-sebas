<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdministrativosMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'administrativos') {
            return $next($request);
        }
        
        // Si no es administrativo, redirigir al dashboard correspondiente
        $user = Auth::user();
        
        if ($user) {
            switch($user->role) {
                case 'admin':
                    return redirect()->route('dashboard.admin');
                case 'profesor':
                    return redirect()->route('profesor.dashboard');
                case 'coordinacion':
                    return redirect()->route('dashboard.coordinacion');
                case 'directivos':
                    return redirect()->route('directivos.dashboard');
                default:
                    Auth::logout();
                    return redirect()->route('login')->with('error', 'Acceso no autorizado');
            }
        }
        
        return redirect()->route('login')->with('error', 'Debes iniciar sesión');
    }
}