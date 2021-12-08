<?php

namespace InetStudio\ACL\Activations\Http\Middleware\Front;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use InetStudio\ACL\Contracts\Http\Middleware\Front\CheckActivationContract;

class CheckActivation implements CheckActivationContract
{
    public function handle(Request $request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check() && ! Auth::user()->activated) {
            Auth::logout();
        }

        return $next($request);
    }
}
