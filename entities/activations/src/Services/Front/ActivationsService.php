<?php

namespace InetStudio\ACL\Activations\Services\Front;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use InetStudio\ACL\Users\Contracts\Models\UserModelContract;
use InetStudio\ACL\Activations\Contracts\Models\ActivationModelContract;
use InetStudio\ACL\Users\Contracts\Repositories\UsersRepositoryContract;
use InetStudio\ACL\Activations\Contracts\Services\Front\ActivationsServiceContract;
use InetStudio\ACL\Activations\Contracts\Repositories\ActivationsRepositoryContract;

/**
 * Class ActivationsService.
 */
class ActivationsService implements ActivationsServiceContract
{
    /**
     * @var array
     */
    private $repositories;

    /**
     * ActivationsService constructor.
     * 
     * @param ActivationsRepositoryContract $activationsRepository
     * @param UsersRepositoryContract $usersRepository
     */
    public function __construct(ActivationsRepositoryContract $activationsRepository, UsersRepositoryContract $usersRepository)
    {
        $this->repositories['activations'] = $activationsRepository;
        $this->repositories['users'] = $usersRepository;
    }

    /**
     * Получаем активацию пользователя.
     *
     * @param UserModelContract $user
     *
     * @return ActivationModelContract|null
     */
    public function getActivationByUser(UserModelContract $user): ?ActivationModelContract
    {
        return $user->activation;
    }

    /**
     * Получаем активацию по токену.
     *
     * @param string $token
     * 
     * @return ActivationModelContract|null
     */
    public function getActivationByToken(string $token = ''): ?ActivationModelContract
    {
        return $this->repositories['activations']->searchItems([['token', '=', $token]])->first();
    }

    /**
     * Создаем активацию.
     *
     * @param UserModelContract $user
     *
     * @return string
     */
    public function createActivation(UserModelContract $user): string
    {
        $activation = $this->getActivationByUser($user);

        if (! $activation) {
            return $this->createToken($user);
        }

        return $this->regenerateToken($user);
    }

    /**
     * Генерация токена.
     *
     * @return string
     */
    protected function getToken(): string
    {
        return hash_hmac('sha256', Str::random(40), config('app.key'));
    }

    /**
     * Обновление токена.
     *
     * @param UserModelContract $user
     * 
     * @return string
     */
    private function regenerateToken(UserModelContract $user): string
    {
        $activation = $this->getActivationByUser($user);
        $token = $this->getToken();
        
        $this->repositories['activations']->save([
            'token' => $token,
            'created_at' => new Carbon(),
        ], $activation->token);

        return $token;
    }

    /**
     * Создание токена.
     *
     * @param UserModelContract $user
     * 
     * @return string
     */
    private function createToken(UserModelContract $user): string
    {
        $token = $this->getToken();

        $this->repositories['activations']->save([
            'user_id' => $user->id,
            'token' => $token,
        ], 0);

        return $token;
    }

    /**
     * Удаляем активацию.
     *
     * @param string $token
     *
     * @return bool|null
     */
    public function destroy(string $token = ''): ?bool
    {
        $activation = $this->getActivationByToken($token);

        return $this->repositories['activations']->destroy(($activation) ? $activation->token : '');
    }

    /**
     * Активируем пользователя.
     * 
     * @param string $token
     * 
     * @return array
     */
    public function activate(string $token): array
    {
        $activation = $this->getActivationByToken($token);

        if ($activation !== null) {
            $user = $activation->user;

            $this->repositories['users']->save([
                'activated' => 1,
            ], $user->id);

            $this->destroy($token);

            event(app()->makeWith('InetStudio\ACL\Activations\Contracts\Events\Front\ActivatedEventContract', [
                'user' => $user,
            ]));

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
