<?php

namespace InetStudio\ACL\Users\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class UsersBindingsServiceProvider.
 */
class UsersBindingsServiceProvider extends ServiceProvider
{
    protected $defer = true;

    public $bindings = [
        // Controllers
        'InetStudio\ACL\Users\Contracts\Http\Controllers\Back\LoginControllerContract' => 'InetStudio\ACL\Users\Http\Controllers\Back\LoginController',
        'InetStudio\ACL\Users\Contracts\Http\Controllers\Back\UsersControllerContract' => 'InetStudio\ACL\Users\Http\Controllers\Back\UsersController',
        'InetStudio\ACL\Users\Contracts\Http\Controllers\Back\UsersDataControllerContract' => 'InetStudio\ACL\Users\Http\Controllers\Back\UsersDataController',
        'InetStudio\ACL\Users\Contracts\Http\Controllers\Back\UsersUtilityControllerContract' => 'InetStudio\ACL\Users\Http\Controllers\Back\UsersUtilityController',
        'InetStudio\ACL\Users\Contracts\Http\Controllers\Front\LoginControllerContract' => 'InetStudio\ACL\Users\Http\Controllers\Front\LoginController',
        'InetStudio\ACL\Users\Contracts\Http\Controllers\Front\RegisterControllerContract' => 'InetStudio\ACL\Users\Http\Controllers\Front\RegisterController',
        'InetStudio\ACL\Users\Contracts\Http\Controllers\Front\SocialLoginControllerContract' => 'InetStudio\ACL\Users\Http\Controllers\Front\SocialLoginController',

        // Events
        'InetStudio\ACL\Users\Contracts\Events\Back\ModifyUserEventContract' => 'InetStudio\ACL\Users\Events\Back\ModifyUserEvent',
        'InetStudio\ACL\Users\Contracts\Events\Front\SocialRegisteredEventContract' => 'InetStudio\ACL\Users\Events\Front\SocialRegisteredEvent',

        // Listeners
        'InetStudio\ACL\Users\Contracts\Listeners\Front\AttachSocialRoleToUserContract' => 'InetStudio\ACL\Users\Listeners\Front\AttachSocialRoleToUser',
        'InetStudio\ACL\Users\Contracts\Listeners\Front\AttachUserRoleToUserContract' => 'InetStudio\ACL\Users\Listeners\Front\AttachUserRoleToUser',

        // Mails
        'InetStudio\ACL\Users\Contracts\Mail\NewUserMailContract' => 'InetStudio\ACL\Users\Mail\NewUserMail',

        // Models
        'InetStudio\ACL\Users\Contracts\Models\UserModelContract' => 'InetStudio\ACL\Users\Models\UserModel',

        // Notifications
        'InetStudio\ACL\Users\Contracts\Notifications\NewUserNotificationContract' => 'InetStudio\ACL\Users\Notifications\NewUserNotification',
        'InetStudio\ACL\Users\Contracts\Notifications\NewUserQueueableNotificationContract' => 'InetStudio\ACL\Users\Notifications\NewUserQueueableNotification',

        // Observers
        'InetStudio\ACL\Users\Contracts\Observers\UserObserverContract' => 'InetStudio\ACL\Users\Observers\UserObserver',
        
        // Repositories
        'InetStudio\ACL\Users\Contracts\Repositories\UsersRepositoryContract' => 'InetStudio\ACL\Users\Repositories\UsersRepository',
        
        // Requests
        'InetStudio\ACL\Users\Contracts\Http\Requests\Back\SaveUserRequestContract' => 'InetStudio\ACL\Users\Http\Requests\Back\SaveUserRequest',
        'InetStudio\ACL\Users\Contracts\Http\Requests\Front\EmailRequestContract' => 'InetStudio\ACL\Users\Http\Requests\Front\EmailRequest',
        'InetStudio\ACL\Users\Contracts\Http\Requests\Front\LoginRequestContract' => 'InetStudio\ACL\Users\Http\Requests\Front\LoginRequest',
        'InetStudio\ACL\Users\Contracts\Http\Requests\Front\RegisterRequestContract' => 'InetStudio\ACL\Users\Http\Requests\Front\RegisterRequest',
        
        // Responses
        'InetStudio\ACL\Users\Contracts\Http\Responses\Back\Users\DestroyResponseContract' => 'InetStudio\ACL\Users\Http\Responses\Back\Users\DestroyResponse',
        'InetStudio\ACL\Users\Contracts\Http\Responses\Back\Users\FormResponseContract' => 'InetStudio\ACL\Users\Http\Responses\Back\Users\FormResponse',
        'InetStudio\ACL\Users\Contracts\Http\Responses\Back\Users\IndexResponseContract' => 'InetStudio\ACL\Users\Http\Responses\Back\Users\IndexResponse',
        'InetStudio\ACL\Users\Contracts\Http\Responses\Back\Users\LoginResponseContract' => 'InetStudio\ACL\Users\Http\Responses\Back\Users\LoginResponse',
        'InetStudio\ACL\Users\Contracts\Http\Responses\Back\Users\SaveResponseContract' => 'InetStudio\ACL\Users\Http\Responses\Back\Users\SaveResponse',
        'InetStudio\ACL\Users\Contracts\Http\Responses\Back\Users\ShowResponseContract' => 'InetStudio\ACL\Users\Http\Responses\Back\Users\ShowResponse',
        'InetStudio\ACL\Users\Contracts\Http\Responses\Back\Utility\SlugResponseContract' => 'InetStudio\ACL\Users\Http\Responses\Back\Utility\SlugResponse',
        'InetStudio\ACL\Users\Contracts\Http\Responses\Back\Utility\SuggestionsResponseContract' => 'InetStudio\ACL\Users\Http\Responses\Back\Utility\SuggestionsResponse',
        'InetStudio\ACL\Users\Contracts\Http\Responses\Front\RegisterResponseContract' => 'InetStudio\ACL\Users\Http\Responses\Front\RegisterResponse',
        'InetStudio\ACL\Users\Contracts\Http\Responses\Front\SocialRegisterApproveEmailResponseContract' => 'InetStudio\ACL\Users\Http\Responses\Front\SocialRegisterApproveEmailResponse',
        'InetStudio\ACL\Users\Contracts\Http\Responses\Front\SocialRegisterAskEmailResponseContract' => 'InetStudio\ACL\Users\Http\Responses\Front\SocialRegisterAskEmailResponse',

        // Services
        'InetStudio\ACL\Users\Contracts\Services\Back\UsersDataTableServiceContract' => 'InetStudio\ACL\Users\Services\Back\UsersDataTableService',
        'InetStudio\ACL\Users\Contracts\Services\Back\UsersObserverServiceContract' => 'InetStudio\ACL\Users\Services\Back\UsersObserverService',
        'InetStudio\ACL\Users\Contracts\Services\Back\UsersServiceContract' => 'InetStudio\ACL\Users\Services\Back\UsersService',
        'InetStudio\ACL\Users\Contracts\Services\Front\UsersServiceContract' => 'InetStudio\ACL\Users\Services\Front\UsersService',
        
        // Transformers
        'InetStudio\ACL\Users\Contracts\Transformers\Back\UserTransformerContract' => 'InetStudio\ACL\Users\Transformers\Back\UserTransformer',
        'InetStudio\ACL\Users\Contracts\Transformers\Back\SuggestionTransformerContract' => 'InetStudio\ACL\Users\Transformers\Back\SuggestionTransformer',
    ];

    /**
     * Получить сервисы от провайдера.
     *
     * @return array
     */
    public function provides(): array
    {
        return [
            'InetStudio\ACL\Users\Contracts\Http\Controllers\Back\LoginControllerContract',
            'InetStudio\ACL\Users\Contracts\Http\Controllers\Back\UsersControllerContract',
            'InetStudio\ACL\Users\Contracts\Http\Controllers\Back\UsersDataControllerContract',
            'InetStudio\ACL\Users\Contracts\Http\Controllers\Back\UsersUtilityControllerContract',
            'InetStudio\ACL\Users\Contracts\Http\Controllers\Front\LoginControllerContract',
            'InetStudio\ACL\Users\Contracts\Http\Controllers\Front\RegisterControllerContract',
            'InetStudio\ACL\Users\Contracts\Http\Controllers\Front\SocialLoginControllerContract',
            'InetStudio\ACL\Users\Contracts\Events\Back\ModifyUserEventContract',
            'InetStudio\ACL\Users\Contracts\Events\Front\SocialRegisteredEventContract',
            'InetStudio\ACL\Users\Contracts\Listeners\Front\AttachSocialRoleToUserContract',
            'InetStudio\ACL\Users\Contracts\Listeners\Front\AttachUserRoleToUserContract',
            'InetStudio\ACL\Users\Contracts\Mail\NewUserMailContract',
            'InetStudio\ACL\Users\Contracts\Models\UserModelContract',
            'InetStudio\ACL\Users\Contracts\Notifications\NewUserNotificationContract',
            'InetStudio\ACL\Users\Contracts\Notifications\NewUserQueueableNotificationContract',
            'InetStudio\ACL\Users\Contracts\Observers\UserObserverContract',
            'InetStudio\ACL\Users\Contracts\Repositories\UsersRepositoryContract',
            'InetStudio\ACL\Users\Contracts\Http\Requests\Back\SaveUserRequestContract',
            'InetStudio\ACL\Users\Contracts\Http\Requests\Front\EmailRequestContract',
            'InetStudio\ACL\Users\Contracts\Http\Requests\Front\LoginRequestContract',
            'InetStudio\ACL\Users\Contracts\Http\Requests\Front\RegisterRequestContract',
            'InetStudio\ACL\Users\Contracts\Http\Responses\Back\Users\DestroyResponseContract',
            'InetStudio\ACL\Users\Contracts\Http\Responses\Back\Users\FormResponseContract',
            'InetStudio\ACL\Users\Contracts\Http\Responses\Back\Users\IndexResponseContract',
            'InetStudio\ACL\Users\Contracts\Http\Responses\Back\Users\LoginResponseContract',
            'InetStudio\ACL\Users\Contracts\Http\Responses\Back\Users\SaveResponseContract',
            'InetStudio\ACL\Users\Contracts\Http\Responses\Back\Users\ShowResponseContract',
            'InetStudio\ACL\Users\Contracts\Http\Responses\Back\Utility\SlugResponseContract',
            'InetStudio\ACL\Users\Contracts\Http\Responses\Back\Utility\SuggestionsResponseContract',
            'InetStudio\ACL\Users\Contracts\Http\Responses\Front\RegisterResponseContract',
            'InetStudio\ACL\Users\Contracts\Http\Responses\Front\SocialRegisterApproveEmailResponseContract',
            'InetStudio\ACL\Users\Contracts\Http\Responses\Front\SocialRegisterAskEmailResponseContract',
            'InetStudio\ACL\Users\Contracts\Services\Back\UsersDataTableServiceContract',
            'InetStudio\ACL\Users\Contracts\Services\Back\UsersObserverServiceContract',
            'InetStudio\ACL\Users\Contracts\Services\Back\UsersServiceContract',
            'InetStudio\ACL\Users\Contracts\Services\Front\UsersServiceContract',
            'InetStudio\ACL\Users\Contracts\Transformers\Back\UserTransformerContract',
            'InetStudio\ACL\Users\Contracts\Transformers\Back\SuggestionTransformerContract',
        ];
    }
}
