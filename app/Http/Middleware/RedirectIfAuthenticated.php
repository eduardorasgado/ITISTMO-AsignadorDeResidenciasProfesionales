<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        // proteccion del register para todo el que no
        // sea asignador
        if (Auth::guard($guard)->check() && Auth::user()->cargo != 0) {
            return redirect('/home');
        }

        return $next($request);
    }
}
