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
        if (auth()->user()->role == 2) {
            return $next($request);
        } else {
            if (!$request->ajax()) {
                return redirect()->route('permissionError');
            } else {
                return response()->json(["status" => false, "msgError" => "Usted no tiene permiso!"]);
            }
        }
    }
}
