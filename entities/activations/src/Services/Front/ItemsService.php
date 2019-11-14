<?php

namespace InetStudio\ACL\Activations\Services\Front;

use Exception;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use InetStudio\AdminPanel\Base\Services\BaseService;
use InetStudio\ACL\Users\Contracts\Models\UserModelContract;
use Illuminate\Contracts\Container\BindingResolutionException;
use InetStudio\ACL\Activations\Contracts\Models\ActivationModelContract;
use InetStudio\ACL\Activations\Contracts\Services\Front\ItemsServiceContract;

/**
 * Class ItemsService.
 */
class ItemsService extends BaseService implements ItemsServiceContract
{
    /**
     * ItemsService constructor.
     *
     * @param  ActivationModelContract  $model
     */
    public function __construct(ActivationModelContract $model)
    {
        parent::__construct($model);
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

            $this->repositories['users']->save([
                'activated' => 1,
            ], $user->id);

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
