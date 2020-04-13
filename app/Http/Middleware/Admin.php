<?php

namespace App\Http\Middleware;

use Closure;

class Admin
{
    public function handle($request, Closure $next)
    {
        if(auth()->user()->is_admin == 1)
        {
            return $next($request);
        } else {
            return redirect('home')->with('error','You don\'t have admin access');
        }
    }
}
