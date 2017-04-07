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
    public function handle($request, Closure $next, $role)
    {
        if (!Auth::check() ||  Auth::user()->user_type <> $role) {
            return redirect('/');
        }
        return $next($request);
    }
}
