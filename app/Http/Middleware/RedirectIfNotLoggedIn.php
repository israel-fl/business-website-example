<?php

namespace App\Http\Middleware;

use Closure;
use Auth;


class RedirectIfNotLoggedIn
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
        // check if the user is logged in
        if (Auth::check()) {
            return $next($request);
        } else {
            return redirect('/login');
        }
    }
}
