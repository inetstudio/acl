<?php

namespace InetStudio\ACL\Users\Services\Front;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Config;
use Illuminate\Contracts\Auth\Authenticatable;
use InetStudio\ACL\Users\Contracts\Models\UserModelContract;
use Illuminate\Contracts\Container\BindingResolutionException;
use InetStudio\ACL\Users\Contracts\Services\Front\ItemsServiceContract;
use InetStudio\AdminPanel\Base\Services\BaseService;

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
     * Получаем имя класса пользователя.
     *
     * @return Authenticatable
     *
     * @throws BindingResolutionException
     */
    public function resolveUserModel(): Authenticatable
    {
        $userClassName = Config::get('auth.model');

        if (is_null($userClassName)) {
            $userClassName = Config::get('auth.providers.users.model');
        }

        return app()->make($userClassName);
    }

    /**
     * Проверяем принадлежность пользователя к администрации.
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        $user = $this->user;

        return $user && $user->hasRole('admin');
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
     * @param  null  $userId
     *
     * @return array|int|\Ramsey\Uuid\UuidInterface|string|null
     */
    public function getUserIdOrHash($userId = null)
    {
        if (is_null($userId)) {
            $userId = $this->getUserId();
        }

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
