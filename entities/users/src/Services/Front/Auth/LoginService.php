<?php

namespace InetStudio\ACL\Users\Services\Front\Auth;

use Illuminate\Support\Facades\Auth;
use InetStudio\ACL\Users\Contracts\Models\UserModelContract;
use InetStudio\ACL\Users\Contracts\Services\Front\Auth\LoginServiceContract;
use InetStudio\AdminPanel\Base\Services\BaseService;

/**
 * Class LoginService.
 */
class LoginService extends BaseService implements LoginServiceContract
{
    /**
     * ItemsService constructor.
     *
     * @param  UserModelContract  $model
     */
    public function __construct(UserModelContract $model)
    {
        parent::__construct($model);
    }

    /**
     * Производим выход пользователя.
     */
    public function logout(): void
    {
        Auth::guard()->logout();
        request()->session()->invalidate();
    }
}
