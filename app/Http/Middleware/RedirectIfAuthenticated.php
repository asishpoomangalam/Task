<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
			if ($guard == "admin" && Auth::guard($guard)->check()) {
				return redirect('/admin');
			}
	 
			if ($guard == "customer" && Auth::guard($guard)->check()) {
				return redirect('/customer');
			}
	 
			if ($guard == "marketing" && Auth::guard($guard)->check()) {
				return redirect('/marketing');
			}
	 
			if ($guard == "support" && Auth::guard($guard)->check()) {
				return redirect('/support');
			}
	 
			if (Auth::guard($guard)->check()) {
				return redirect('/home');
			}
	 
			return $next($request);
    }
}
