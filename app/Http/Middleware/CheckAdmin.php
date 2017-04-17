<?php

namespace App\Http\Middleware;

use Closure;

class CheckAdmin
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
        $user = Auth::user();
        $level = $user->level;
        if ($level == 2) {
            return $next($request);
        } else {  // user not authorized to see endpoint
            return view('unauth');
        }
    }
}
