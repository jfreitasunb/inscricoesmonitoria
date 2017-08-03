<?php

namespace Monitoriamat\Http\Middleware;

use Auth;
use Closure;

class UserRoles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        
        foreach ($roles as $role ) {
            if (!Auth::check()){
                if (Auth::user()->user_type <> $role) {
                     return redirect('/');
                }
            } 
               
            }
            return $next($request);
        }

        
    }
}
