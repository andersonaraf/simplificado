<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AcessoRestritoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (! $request->expectsJson()) {
            if (!auth()->check()) return redirect()->route('login');
            if (strtoupper(auth()->user()->tipo) != 'ADMIN' && strtoupper(auth()->user()->tipo) != 'REVISOR' && strtoupper(auth()->user()->tipo) != 'AVALIADOR') return redirect()->route('inicio');
            return $next($request);
        }

        if (!auth()->check()) return redirect()->route('login');
        if (strtoupper(auth()->user()->tipo) != 'ADMIN') return redirect()->route('inicio');
        return $next($request);
    }
}
