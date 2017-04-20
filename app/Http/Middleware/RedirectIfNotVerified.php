<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class RedirectIfNotVerified
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
        // user must be logged in because of previous middleware
        $user = Auth::user();
        if ($user->verified === "true") {
            return $next($request);
        } else {
            // user is not verified, display verfified page
            return redirect('/verify');
        }
    }
}
