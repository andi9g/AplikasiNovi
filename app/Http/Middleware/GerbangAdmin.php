<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class GerbangAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->session()->get('login')==true) {
            return $next($request);
        }else {
            return redirect('/rental');
        }
    }
}
