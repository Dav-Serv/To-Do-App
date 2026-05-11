<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Login
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!session('is_login')) {
            return redirect('/login')->with('error', 'Silahkan login terlebih dahulu');
        }
        
        return $next($request);
    }
}
