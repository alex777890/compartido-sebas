<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRoleChange
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();
            $sessionRole = session('user_current_role');
            
            // Si no hay rol en sesión, guardar el actual
            if (!$sessionRole) {
                session(['user_current_role' => $user->role]);
                return $next($request);
            }
            
            // Si el rol en la base de datos es diferente al de la sesión
            if ($user->role !== $sessionRole) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                
                return redirect()->route('login')
                    ->with('role_changed', 'Tu rol ha sido actualizado. Por favor, inicia sesión nuevamente.');
            }
        }

        return $next($request);
    }
}