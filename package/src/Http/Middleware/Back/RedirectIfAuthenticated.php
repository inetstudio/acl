<?php

namespace InetStudio\ACL\Http\Middleware\Back;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use InetStudio\ACL\Contracts\Http\Middleware\Back\RedirectIfAuthenticatedContract;

class RedirectIfAuthenticated implements RedirectIfAuthenticatedContract
{
    public function handle(Request $request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check() && Auth::user()->hasRole('admin')) {
            return redirect(route('back'));
        }

        return $next($request);
    }
}
