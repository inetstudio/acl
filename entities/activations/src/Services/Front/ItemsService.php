<?php

namespace InetStudio\ACL\Activations\Services\Front;

use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use InetStudio\ACL\Activations\Contracts\Models\ActivationModelContract;
use InetStudio\ACL\Activations\Contracts\Services\Front\ItemsServiceContract;
use InetStudio\ACL\Users\Contracts\Models\UserModelContract;
use InetStudio\ACL\Users\Contracts\Services\Front\ItemsServiceContract as UsersServiceContract;
use InetStudio\AdminPanel\Base\Services\BaseService;

/**
 * Class ItemsService.
 */
class ItemsService extends BaseService implements ItemsServiceContract
{
    /**
     * @var UsersServiceContract
     */
    protected $usersService;

    /**
     * ItemsService constructor.
     *
     * @param  ActivationModelContract  $model
     * @param  UsersServiceContract  $usersService
     */
    public function __construct(ActivationModelContract $model, UsersServiceContract $usersService)
    {
        parent::__construct($model);

        $this->usersService = $usersService;
    }

    /**
     * Получаем активацию пользователя.
     *
     * @param  UserModelContract  $user
     *
     * @return ActivationModelContract|null
     */
    public function getItemByUser(UserModelContract $user): ?ActivationModelContract
    {
        return $user['activation'];
    }

    /**
     * Получаем активацию по токену.
     *
     * @param  string  $token
     *
     * @return ActivationModelContract|null
     */
    public function getItemByToken(string $token = ''): ?ActivationModelContract
    {
        return $this->model->find($token);
    }

    /**
     * Получаем токен.
     *
     * @param  UserModelContract  $user
     *
     * @return string
     *
     * @throws Exception
     */
    public function getToken(UserModelContract $user): string
    {
        $item = $this->getItemByUser($user);

        if (! $item) {
            return $this->createToken($user);
        }

        return $this->regenerateToken($user);
    }

    /**
     * Генерация токена.
     *
     * @return string
     */
    protected function generateToken(): string
    {
        return hash_hmac('sha256', Str::random(40), config('app.key'));
    }

    /**
     * Обновление токена.
     *
     * @param  UserModelContract  $user
     *
     * @return string
     *
     * @throws Exception
     */
    protected function regenerateToken(UserModelContract $user): string
    {
        $item = $this->getItemByUser($user);
        $token = $this->generateToken();

        $item->update(
            [
                'token' => $token,
                'created_at' => new Carbon(),
            ]
        );

        return $token;
    }

    /**
     * Создание токена.
     *
     * @param  UserModelContract  $user
     *
     * @return string
     */
    public function createToken(UserModelContract $user): string
    {
        $token = $this->generateToken();

        $this->model::create(
            [
                'user_id' => $user['id'],
                'token' => $token,
            ]
        );

        return $token;
    }

    /**
     * Удаляем активацию.
     *
     * @param  string  $token
     *
     * @return bool|null
     */
    public function destroyItem(string $token = ''): ?bool
    {
        $item = $this->getItemByToken($token);

        return ($item) ? $item->delete() : null;
    }

    /**
     * Активируем пользователя.
     *
     * @param  string  $token
     *
     * @return array
     *
     * @throws BindingResolutionException
     */
    public function activate(string $token): array
    {
        $item = $this->getItemByToken($token);

        if ($item !== null) {
            $user = $item['user'];

            $this->usersService->saveModel(
                [
                    'activated' => 1,
                ],
                $user->id
            );

            $this->destroyItem($token);

            event(
                app()->make(
                    'InetStudio\ACL\Activations\Contracts\Events\Front\ActivatedEventContract',
                    [
                        'user' => $user,
                    ]
                )
            );

            if (config('acl.activations.login_after_activate')) {
                Auth::login($user, true);
                Session::flash('auth_event', 'activate_auth');

                $isLogged = true;
            } else {
                $isLogged = false;
            }

            $result = [
                'success' => true,
                'message' => trans('admin.module.acl.activations::activation.activationSuccess'),
                'isLogged' => $isLogged,
            ];
        } else {
            $result = [
                'success' => false,
                'message' => trans('admin.module.acl.activations::activation.activationFail'),
                'isLogged' => false,
            ];
        }

        return $result;
    }
}
