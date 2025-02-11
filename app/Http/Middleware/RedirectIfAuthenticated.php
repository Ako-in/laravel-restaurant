<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards; //$guards が空の場合 null を設定

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return redirect($guard === 'admin' ? RouteServiceProvider::ADMIN_HOME : RouteServiceProvider::HOME);
                // if ($guard === 'admin') {
                //     return redirect(RouteServiceProvider::ADMIN_HOME);
                }
            }
            return $next($request);
            // return redirect(RouteServiceProvider::HOME);
        }

        // foreach ($guards as $guard) {
        //     if (Auth::guard($guard)->check()) {
        //         return redirect($guard === 'admin' ? RouteServiceProvider::ADMIN_HOME : RouteServiceProvider::HOME);
        //     }
        //     return redirect(RouteServiceProvider::HOME);
        // }

        // return $next($request);
    
}
