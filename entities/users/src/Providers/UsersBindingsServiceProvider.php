<?php

namespace InetStudio\ACL\Users\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class UsersBindingsServiceProvider.
 */
class UsersBindingsServiceProvider extends ServiceProvider
{
    /**
    * @var  bool
    */
    protected $defer = true;

    /**
    * @var  array
    */
    public $bindings = [
        'InetStudio\ACL\Users\Contracts\Events\Back\ModifyUserEventContract' => 'InetStudio\ACL\Users\Events\Back\ModifyUserEvent',
        'InetStudio\ACL\Users\Contracts\Events\Front\SocialRegisteredEventContract' => 'InetStudio\ACL\Users\Events\Front\SocialRegisteredEvent',
        'InetStudio\ACL\Users\Contracts\Http\Controllers\Back\LoginControllerContract' => 'InetStudio\ACL\Users\Http\Controllers\Back\LoginController',
        'InetStudio\ACL\Users\Contracts\Http\Controllers\Back\UsersControllerContract' => 'InetStudio\ACL\Users\Http\Controllers\Back\UsersController',
        'InetStudio\ACL\Users\Contracts\Http\Controllers\Back\UsersDataControllerContract' => 'InetStudio\ACL\Users\Http\Controllers\Back\UsersDataController',
        'InetStudio\ACL\Users\Contracts\Http\Controllers\Back\UsersUtilityControllerContract' => 'InetStudio\ACL\Users\Http\Controllers\Back\UsersUtilityController',
        'InetStudio\ACL\Users\Contracts\Http\Controllers\Front\LoginControllerContract' => 'InetStudio\ACL\Users\Http\Controllers\Front\LoginController',
        'InetStudio\ACL\Users\Contracts\Http\Controllers\Front\RegisterControllerContract' => 'InetStudio\ACL\Users\Http\Controllers\Front\RegisterController',
        'InetStudio\ACL\Users\Contracts\Http\Controllers\Front\SocialLoginControllerContract' => 'InetStudio\ACL\Users\Http\Controllers\Front\SocialLoginController',
        'InetStudio\ACL\Users\Contracts\Http\Requests\Back\SaveUserRequestContract' => 'InetStudio\ACL\Users\Http\Requests\Back\SaveUserRequest',
        'InetStudio\ACL\Users\Contracts\Http\Requests\Front\EmailRequestContract' => 'InetStudio\ACL\Users\Http\Requests\Front\EmailRequest',
        'InetStudio\ACL\Users\Contracts\Http\Requests\Front\LoginRequestContract' => 'InetStudio\ACL\Users\Http\Requests\Front\LoginRequest',
        'InetStudio\ACL\Users\Contracts\Http\Requests\Front\RegisterRequestContract' => 'InetStudio\ACL\Users\Http\Requests\Front\RegisterRequest',
        'InetStudio\ACL\Users\Contracts\Http\Responses\Back\Users\DestroyResponseContract' => 'InetStudio\ACL\Users\Http\Responses\Back\Users\DestroyResponse',
        'InetStudio\ACL\Users\Contracts\Http\Responses\Back\Users\FormResponseContract' => 'InetStudio\ACL\Users\Http\Responses\Back\Users\FormResponse',
        'InetStudio\ACL\Users\Contracts\Http\Responses\Back\Users\IndexResponseContract' => 'InetStudio\ACL\Users\Http\Responses\Back\Users\IndexResponse',
        'InetStudio\ACL\Users\Contracts\Http\Responses\Back\Users\LoginResponseContract' => 'InetStudio\ACL\Users\Http\Responses\Back\Users\LoginResponse',
        'InetStudio\ACL\Users\Contracts\Http\Responses\Back\Users\SaveResponseContract' => 'InetStudio\ACL\Users\Http\Responses\Back\Users\SaveResponse',
        'InetStudio\ACL\Users\Contracts\Http\Responses\Back\Users\ShowResponseContract' => 'InetStudio\ACL\Users\Http\Responses\Back\Users\ShowResponse',
        'InetStudio\ACL\Users\Contracts\Http\Responses\Back\Utility\SuggestionsResponseContract' => 'InetStudio\ACL\Users\Http\Responses\Back\Utility\SuggestionsResponse',
        'InetStudio\ACL\Users\Contracts\Http\Responses\Front\LogoutResponseContract' => 'InetStudio\ACL\Users\Http\Responses\Front\LogoutResponse',
        'InetStudio\ACL\Users\Contracts\Http\Responses\Front\RegisterResponseContract' => 'InetStudio\ACL\Users\Http\Responses\Front\RegisterResponse',
        'InetStudio\ACL\Users\Contracts\Http\Responses\Front\SocialRegisterApproveEmailResponseContract' => 'InetStudio\ACL\Users\Http\Responses\Front\SocialRegisterApproveEmailResponse',
        'InetStudio\ACL\Users\Contracts\Http\Responses\Front\SocialRegisterAskEmailResponseContract' => 'InetStudio\ACL\Users\Http\Responses\Front\SocialRegisterAskEmailResponse',
        'InetStudio\ACL\Users\Contracts\Http\Responses\Front\SocialRegisterHandleResponseContract' => 'InetStudio\ACL\Users\Http\Responses\Front\SocialRegisterHandleResponse',
        'InetStudio\ACL\Users\Contracts\Listeners\Front\AttachSocialRoleToUserContract' => 'InetStudio\ACL\Users\Listeners\Front\AttachSocialRoleToUser',
        'InetStudio\ACL\Users\Contracts\Listeners\Front\AttachUserRoleToUserContract' => 'InetStudio\ACL\Users\Listeners\Front\AttachUserRoleToUser',
        'InetStudio\ACL\Users\Contracts\Mail\NewUserMailContract' => 'InetStudio\ACL\Users\Mail\NewUserMail',
        'InetStudio\ACL\Users\Contracts\Models\UserModelContract' => 'InetStudio\ACL\Users\Models\UserModel',
        'InetStudio\ACL\Users\Contracts\Notifications\NewUserNotificationContract' => 'InetStudio\ACL\Users\Notifications\NewUserNotification',
        'InetStudio\ACL\Users\Contracts\Notifications\NewUserQueueableNotificationContract' => 'InetStudio\ACL\Users\Notifications\NewUserQueueableNotification',
        'InetStudio\ACL\Users\Contracts\Observers\UserObserverContract' => 'InetStudio\ACL\Users\Observers\UserObserver',
        'InetStudio\ACL\Users\Contracts\Repositories\UsersRepositoryContract' => 'InetStudio\ACL\Users\Repositories\UsersRepository',
        'InetStudio\ACL\Users\Contracts\Services\Back\UsersDataTableServiceContract' => 'InetStudio\ACL\Users\Services\Back\UsersDataTableService',
        'InetStudio\ACL\Users\Contracts\Services\Back\UsersObserverServiceContract' => 'InetStudio\ACL\Users\Services\Back\UsersObserverService',
        'InetStudio\ACL\Users\Contracts\Services\Back\UsersServiceContract' => 'InetStudio\ACL\Users\Services\Back\UsersService',
        'InetStudio\ACL\Users\Contracts\Services\Front\UsersServiceContract' => 'InetStudio\ACL\Users\Services\Front\UsersService',
        'InetStudio\ACL\Users\Contracts\Transformers\Back\SuggestionTransformerContract' => 'InetStudio\ACL\Users\Transformers\Back\SuggestionTransformer',
        'InetStudio\ACL\Users\Contracts\Transformers\Back\UserTransformerContract' => 'InetStudio\ACL\Users\Transformers\Back\UserTransformer',
        'InetStudio\ACL\Users\Contracts\Validation\Rules\CheckPasswordContract' => 'InetStudio\ACL\Users\Validation\Rules\CheckPassword',
    ];

    /**
     * Получить сервисы от провайдера.
     *
     * @return  array
     */
    public function provides()
    {
        return array_keys($this->bindings);
    }
}
