<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Auth;

class Power
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
        if(Auth::check() && Auth::user()->checkAdmin() ){
            return $next($request);
        }
        else {
            return redirect('/')->with('message','Sorry, you lack the proper permission to access that page!');
        }

    }
}
