<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
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
            if(Auth::check()){

                if(Auth::user()->role == 2){
                    return redirect(route('teacher'));
                }elseif(Auth::user()->role == 3){
                    return redirect(route('parents'));
                }elseif(Auth::user()->role ==4){
                    return redirect(route('student'));
                }
            }
        return $next($request);
    }
}