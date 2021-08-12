<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next , $role)
    {
        // to check the authenticated user is admin
        // if (Auth::check() && Auth::user()->$role!=true)
        // {
        //     return redirect('/');
        // }
       
        if (\Auth::check()==false || (!(\Auth::user()->$role)))
        {
            return redirect('/');
        }
        return $next($request);
    }
}
