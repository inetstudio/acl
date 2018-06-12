<?php

namespace InetStudio\ACL\Passwords\Services\Front;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Contracts\Auth\PasswordBroker;
use InetStudio\ACL\Users\Contracts\Models\UserModelContract;
use InetStudio\ACL\Users\Contracts\Repositories\UsersRepositoryContract;
use InetStudio\ACL\Passwords\Contracts\Services\Front\PasswordsServiceContract;
use InetStudio\ACL\Passwords\Contracts\Http\Requests\Front\ResetPasswordRequestContract;

/**
 * Class PasswordsService.
 */
class PasswordsService implements PasswordsServiceContract
{
    /**
     * @var array
     */
    private $repositories;

    /**
     * PasswordsService constructor.
     *
     * @param UsersRepositoryContract $userRepository
     */
    public function __construct(UsersRepositoryContract $userRepository)
    {
        $this->repositories['users'] = $userRepository;
    }

    /**
     * Сбрасываем пароль пользователя.
     *
     * @param ResetPasswordRequestContract $request
     * @param PasswordBroker $broker
     *
     * @return string
     */
    public function reset(ResetPasswordRequestContract $request, PasswordBroker $broker): string
    {
        $result = $broker->reset(
            $this->credentialsFields($request), function ($user, $password) {
                $this->resetPasswordWithoutLogin($user, $password);
            }
        );

        return $result;
    }

    /**
     * Получаем необходимые поля из запроса.
     *
     * @param ResetPasswordRequestContract $request
     *
     * @return array
     */
    protected function credentialsFields(ResetPasswordRequestContract $request): array
    {
        return $request->only(
            'email', 'password', 'password_confirmation', 'token'
        );
    }

    /**
     * Сохраняем новый пользовательский пароль.
     *
     * @param UserModelContract $user
     * @param string $password
     */
    protected function resetPasswordWithoutLogin(UserModelContract $user, string $password): void
    {
        $user = $this->repositories['users']->save([
            'password' => $password,
        ], $user->id);

        event(new PasswordReset($user));
    }
}
