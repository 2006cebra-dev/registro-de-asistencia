<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        $roles = explode('|', $role);

        if (!auth()->check() || !in_array(auth()->user()->rol, $roles)) {
            abort(403, 'Acceso no autorizado.');
        }

        return $next($request);
    }
}
