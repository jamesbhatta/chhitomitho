<?php

namespace App\Http\Middleware;

use Closure;
use Auth;


class CustomerMiddleware
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
            return redirect()->route('login');
        }
        
        if (Auth::user()->role == 'customer') {
            return $next($request);
        }
        
        abort( response('Unauthorized', 401) );
    }
}
