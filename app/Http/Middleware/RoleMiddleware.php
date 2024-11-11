<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // Verifica si el usuario está autenticado y si tiene el rol requerido
        if (!Auth::check() || !$request->user()->roles->contains('Nombre', $role)) {
            // Redirige si el usuario no tiene el rol necesario
            return redirect('/')->withErrors(['No tienes permiso para acceder a esta página.']);
        }

        return $next($request);
    }
}
