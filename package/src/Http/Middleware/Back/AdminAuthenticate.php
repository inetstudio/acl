<?php

namespace InetStudio\ACL\Http\Middleware\Back;

use Closure;
use Illuminate\Support\Facades\Auth;
use InetStudio\ACL\Contracts\Http\Middleware\Back\AdminAuthenticateContract;

class AdminAuthenticate implements AdminAuthenticateContract
{
    public function handle($request, Closure $next)
    {
        if (Auth::user() && Auth::user()->hasRole('admin')) {
            return $next($request);
        }

        Auth::logout();

        return redirect(route('back.acl.users.login.get'));
    }
}
