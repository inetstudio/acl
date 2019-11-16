<?php

namespace InetStudio\ACL\Users\Services\Front;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use InetStudio\AdminPanel\Base\Services\BaseService;
use InetStudio\ACL\Users\Contracts\Models\UserModelContract;
use InetStudio\ACL\Users\Contracts\Services\Front\ItemsServiceContract;

/**
 * Class ItemsService.
 */
class ItemsService extends BaseService implements ItemsServiceContract
{
    /**
     * @var UserModelContract
     */
    protected $user;

    /**
     * ItemsService constructor.
     *
     * @param  UserModelContract  $model
     */
    public function __construct(UserModelContract $model)
    {
        parent::__construct($model);

        $this->user = Auth::user();
    }

    /**
     * Проверяем принадлежность пользователя к администрации.
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        $user = $this->user;

        return ($user && $user->hasRole('admin'));
    }

    /**
     * Возвращаем пользователя.
     *
     * @return UserModelContract|null
     */
    public function getUser(): ?UserModelContract
    {
        return $this->user;
    }

    /**
     * Возвращаем id пользователя.
     *
     * @param string $email
     *
     * @return int
     */
    public function getUserId(string $email = ''): int
    {
        $user = $this->user;

        if ($email) {
            $user = $this->model->where([['email', '=', $email]])->first();
        }

        return ($user) ? $user->id : 0;
    }

    /**
     * Возвращаем id пользователя или хэш гостя.
     *
     * @return mixed
     */
    public function getUserIdOrHash()
    {
        $userId = $this->getUserId();

        if (! $userId) {
            $cookieData = request()->cookie('guest_user_hash');

            if ($cookieData) {
                return $cookieData;
            } else {
                $uuid = Str::uuid();

                Cookie::queue('guest_user_hash', $uuid, 5256000);

                return $uuid;
            }
        }

        return $userId;
    }

    /**
     * Возвращаем имя пользователя.
     *
     * @param null $request
     *
     * @return string
     */
    public function getUserName($request = null): string
    {
        $user = $this->user;

        return ($request && $request->has('name')) ? strip_tags($request->get('name')) : (($user) ? $user['name'] : '');
    }

    /**
     * Возвращаем email пользователя.
     *
     * @param null $request
     *
     * @return string
     */
    public function getUserEmail($request = null): string
    {
        $user = $this->user;

        return ($request && $request->has('email')) ? strip_tags(strtolower($request->get('email'))) : (($user) ? $user['email'] : '');
    }
}
