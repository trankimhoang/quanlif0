<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function handle($request, Closure $next, ...$guards)
    {
        if (array_search('admin', $guards) !== false) {
            if (Auth::guard('admin')->check()) {
                return $next($request);
            }

            return redirect()->route('login_admin');
        } else if (array_search('sv', $guards) !== false) {
            if (Auth::guard('sv')->check()) {
                return $next($request);
            }

            return redirect()->route('login_user');
        } else if (array_search('gv', $guards) !== false) {
            if (Auth::guard('gv')->check()) {
                return $next($request);
            }

            return redirect()->route('login_user');
        }
    }
}
