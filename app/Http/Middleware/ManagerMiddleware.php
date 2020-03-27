<?php

namespace App\Http\Middleware;

use Closure;
use Auth;


class ManagerMiddleware
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
        
        if (Auth::user()->role == 'manager') {
            return $next($request);
        }
        
        abort( response('Unauthorized', 401) );
    }
}
