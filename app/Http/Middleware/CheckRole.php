<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // 1. Comprovar si l'usuari està loguejat
        if (!auth()->check()) {
            return redirect('dashboard');
        }

        // 2. Obtenir el rol del professional associat a l'usuari
        $userRole = auth()->user()->role;
            // 3. Comprovar si el rol de l'usuari està dins dels rols permesos
            if (in_array($userRole, $roles)) {
                return $next($request);
        }

        // Si no té permís, llançar un error 403
        abort(403, 'Aquesta acció només la pot fer: ' . implode(', ', $roles));
    }
}
