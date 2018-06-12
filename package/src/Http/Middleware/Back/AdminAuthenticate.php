<?php

namespace InetStudio\ACL\Http\Middleware\Back;

use Closure;
use Illuminate\Support\Facades\Auth;
use InetStudio\ACL\Contracts\Http\Middleware\Back\AdminAuthenticateContract;

/**
 * Class AdminAuthenticate.
 */
class AdminAuthenticate implements AdminAuthenticateContract
{
    /**
     * @param $request
     * @param Closure $next
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user() && Auth::user()->hasRole('admin')) {
            return $next($request);
        }

        Auth::logout();

        return redirect(route('back.acl.users.login.get'));
    }
}
