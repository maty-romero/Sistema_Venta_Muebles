<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class UsuarioEsCliente
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::user() != null && Auth::user()->rol_usuario != 'cliente'){
            return to_route('administrador_usuarios');
        } else if(Auth::user() == null){
            return to_route('home');
        }

        return $next($request);
    }
}
