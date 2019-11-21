<?php

namespace App\Http\Middleware;

use Closure;

class CheckTeam
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
        if (auth()->user()->admin == 0) {
            return $next($request);
        } else {
            return redirect()->route('permissionError');
        }
    }
}
