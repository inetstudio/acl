<?php

namespace InetStudio\ACL\Http\Middleware\Back;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use InetStudio\ACL\Contracts\Http\Middleware\Back\RedirectIfAuthenticatedContract;

/**
 * Class RedirectIfAuthenticated.
 */
class RedirectIfAuthenticated implements RedirectIfAuthenticatedContract
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  Closure  $next
     * @param  string|null  $guard
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check() && Auth::user()->hasRole('admin')) {
            return redirect(route('back'));
        }

        return $next($request);
    }
}
