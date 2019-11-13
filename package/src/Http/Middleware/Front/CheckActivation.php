<?php

namespace InetStudio\ACL\Http\Middleware\Front;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use InetStudio\ACL\Contracts\Http\Middleware\Front\CheckActivationContract;

/**
 * Class RedirectIfAuthenticated.
 */
class CheckActivation implements CheckActivationContract
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
        if (Auth::guard($guard)->check() && ! Auth::user()->activated) {
            Auth::logout();
        }

        return $next($request);
    }
}
