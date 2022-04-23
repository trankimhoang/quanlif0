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
        if ($guard == 'admin') {
            if (!Auth::guard('admin')->check()) {
                return $next($request);
            }

            return redirect()->route('admin.index');
        } else if ($guard == 'sv') {
            if (!Auth::guard('sv')->check()) {
                return $next($request);
            }

            return redirect()->route('sv.index');
        } else if ($guard == 'gv') {
            if (!Auth::guard('gv')->check()) {
                return $next($request);
            }

            return redirect()->route('gv.index');
        }
    }
}
