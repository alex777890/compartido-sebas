<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // 1. Verificar si el usuario está autenticado
        if (!Auth::check()) {
            // Si no está autenticado, redirigir al login
            return redirect()->route('login')
                ->with('error', 'Por favor, inicia sesión primero.');
        }

        // 2. Obtener el usuario autenticado
        $user = Auth::user();
        
        // 3. Verificar si tiene rol de admin
        if ($user->role !== 'admin') {
            // Si NO es admin, mostrar error 403
            abort(403, 'Acceso denegado. Solo administradores pueden acceder a esta sección.');
        }

        // 4. Si es admin, permitir acceso
        return $next($request);
    }
}