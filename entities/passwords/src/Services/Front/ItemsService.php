<?php

namespace InetStudio\ACL\Passwords\Services\Front;

use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Contracts\Container\BindingResolutionException;
use InetStudio\ACL\Passwords\Contracts\Services\Front\ItemsServiceContract;
use InetStudio\ACL\Users\Contracts\Models\UserModelContract;
use InetStudio\ACL\Users\Contracts\Services\Front\ItemsServiceContract as UsersServiceContract;

/**
 * Class ItemsService.
 */
class ItemsService implements ItemsServiceContract
{
    /**
     * @var UsersServiceContract
     */
    protected $usersService;

    /**
     * PasswordsService constructor.
     *
     * @param  UsersServiceContract  $usersService
     */
    public function __construct(UsersServiceContract $usersService)
    {
        $this->usersService = $usersService;
    }

    /**
     * Сбрасываем пароль пользователя.
     *
     * @param $request
     * @param  PasswordBroker  $broker
     *
     * @return string
     */
    public function reset($request, PasswordBroker $broker): string
    {
        $result = $broker->reset(
            $this->credentialsFields($request),
            function ($user, $password) {
                $this->resetPasswordWithoutLogin($user, $password);
            }
        );

        return $result;
    }

    /**
     * Получаем необходимые поля из запроса.
     *
     * @param $request
     *
     * @return array
     */
    protected function credentialsFields($request): array
    {
        return $request->only(
            'email', 'password', 'password_confirmation', 'token'
        );
    }

    /**
     * Сохраняем новый пользовательский пароль.
     *
     * @param  UserModelContract  $user
     * @param  string  $password
     *
     * @throws BindingResolutionException
     */
    protected function resetPasswordWithoutLogin(UserModelContract $user, string $password): void
    {
        $user = $this->usersService->saveModel(
            [
                'password' => $password,
            ],
            $user['id']
        );

        event(
            app()->make(
                'InetStudio\ACL\Passwords\Contracts\Events\PasswordResetContract',
                compact('user', 'password')
            )
        );
    }
}
