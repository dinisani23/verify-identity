<?php

namespace App\Http\Middleware;
use Illuminate\Http\Request;

use Closure;

class AuthenticatedMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('/');
        }
    
        return $next($request);
    }
}
