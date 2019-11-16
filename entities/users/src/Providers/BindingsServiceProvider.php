<?php

namespace InetStudio\ACL\Users\Providers;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

/**
 * Class BindingsServiceProvider.
 */
class BindingsServiceProvider extends BaseServiceProvider implements DeferrableProvider
{
    /**
    * @var  array
    */
    public $bindings = [
        'InetStudio\ACL\Users\Contracts\Events\Back\ModifyItemEventContract' => 'InetStudio\ACL\Users\Events\Back\ModifyItemEvent',
        'InetStudio\ACL\Users\Contracts\Events\Front\SocialRegisteredEventContract' => 'InetStudio\ACL\Users\Events\Front\SocialRegisteredEvent',
        'InetStudio\ACL\Users\Contracts\Exports\ItemsExportContract' => 'InetStudio\ACL\Users\Exports\ItemsExport',
        'InetStudio\ACL\Users\Contracts\Http\Controllers\Back\DataControllerContract' => 'InetStudio\ACL\Users\Http\Controllers\Back\DataController',
        'InetStudio\ACL\Users\Contracts\Http\Controllers\Back\ExportControllerContract' => 'InetStudio\ACL\Users\Http\Controllers\Back\ExportController',
        'InetStudio\ACL\Users\Contracts\Http\Controllers\Back\LoginControllerContract' => 'InetStudio\ACL\Users\Http\Controllers\Back\LoginController',
        'InetStudio\ACL\Users\Contracts\Http\Controllers\Back\ResourceControllerContract' => 'InetStudio\ACL\Users\Http\Controllers\Back\ResourceController',
        'InetStudio\ACL\Users\Contracts\Http\Controllers\Back\UtilityControllerContract' => 'InetStudio\ACL\Users\Http\Controllers\Back\UtilityController',
        'InetStudio\ACL\Users\Contracts\Http\Controllers\Front\LoginControllerContract' => 'InetStudio\ACL\Users\Http\Controllers\Front\LoginController',
        'InetStudio\ACL\Users\Contracts\Http\Controllers\Front\RegisterControllerContract' => 'InetStudio\ACL\Users\Http\Controllers\Front\RegisterController',
        'InetStudio\ACL\Users\Contracts\Http\Controllers\Front\SocialLoginControllerContract' => 'InetStudio\ACL\Users\Http\Controllers\Front\SocialLoginController',
        'InetStudio\ACL\Users\Contracts\Http\Requests\Back\SaveItemRequestContract' => 'InetStudio\ACL\Users\Http\Requests\Back\SaveItemRequest',
        'InetStudio\ACL\Users\Contracts\Http\Requests\Front\EmailRequestContract' => 'InetStudio\ACL\Users\Http\Requests\Front\EmailRequest',
        'InetStudio\ACL\Users\Contracts\Http\Requests\Front\LoginRequestContract' => 'InetStudio\ACL\Users\Http\Requests\Front\LoginRequest',
        'InetStudio\ACL\Users\Contracts\Http\Requests\Front\RegisterRequestContract' => 'InetStudio\ACL\Users\Http\Requests\Front\RegisterRequest',
        'InetStudio\ACL\Users\Contracts\Http\Responses\Back\Data\GetIndexDataResponseContract' => 'InetStudio\ACL\Users\Http\Responses\Back\Data\GetIndexDataResponse',
        'InetStudio\ACL\Users\Contracts\Http\Responses\Back\Export\ItemsExportResponseContract' => 'InetStudio\ACL\Users\Http\Responses\Back\Export\ItemsExportResponse',
        'InetStudio\ACL\Users\Contracts\Http\Responses\Back\Login\LoginResponseContract' => 'InetStudio\ACL\Users\Http\Responses\Back\Login\LoginResponse',
        'InetStudio\ACL\Users\Contracts\Http\Responses\Back\Resource\CreateResponseContract' => 'InetStudio\ACL\Users\Http\Responses\Back\Resource\CreateResponse',
        'InetStudio\ACL\Users\Contracts\Http\Responses\Back\Resource\DestroyResponseContract' => 'InetStudio\ACL\Users\Http\Responses\Back\Resource\DestroyResponse',
        'InetStudio\ACL\Users\Contracts\Http\Responses\Back\Resource\EditResponseContract' => 'InetStudio\ACL\Users\Http\Responses\Back\Resource\EditResponse',
        'InetStudio\ACL\Users\Contracts\Http\Responses\Back\Resource\IndexResponseContract' => 'InetStudio\ACL\Users\Http\Responses\Back\Resource\IndexResponse',
        'InetStudio\ACL\Users\Contracts\Http\Responses\Back\Resource\SaveResponseContract' => 'InetStudio\ACL\Users\Http\Responses\Back\Resource\SaveResponse',
        'InetStudio\ACL\Users\Contracts\Http\Responses\Back\Resource\ShowResponseContract' => 'InetStudio\ACL\Users\Http\Responses\Back\Resource\ShowResponse',
        'InetStudio\ACL\Users\Contracts\Http\Responses\Back\Utility\SuggestionsResponseContract' => 'InetStudio\ACL\Users\Http\Responses\Back\Utility\SuggestionsResponse',
        'InetStudio\ACL\Users\Contracts\Http\Responses\Front\Login\LogoutResponseContract' => 'InetStudio\ACL\Users\Http\Responses\Front\Login\LogoutResponse',
        'InetStudio\ACL\Users\Contracts\Http\Responses\Front\Register\RegisterResponseContract' => 'InetStudio\ACL\Users\Http\Responses\Front\Register\RegisterResponse',
        'InetStudio\ACL\Users\Contracts\Http\Responses\Front\Social\ApproveEmailResponseContract' => 'InetStudio\ACL\Users\Http\Responses\Front\Social\ApproveEmailResponse',
        'InetStudio\ACL\Users\Contracts\Http\Responses\Front\Social\AskEmailResponseContract' => 'InetStudio\ACL\Users\Http\Responses\Front\Social\AskEmailResponse',
        'InetStudio\ACL\Users\Contracts\Http\Responses\Front\Social\HandleProviderCallbackResponseContract' => 'InetStudio\ACL\Users\Http\Responses\Front\Social\HandleProviderCallbackResponse',
        'InetStudio\ACL\Users\Contracts\Http\Responses\Front\Social\RedirectToProviderResponseContract' => 'InetStudio\ACL\Users\Http\Responses\Front\Social\RedirectToProviderResponse',
        'InetStudio\ACL\Users\Contracts\Listeners\Front\AttachSocialRoleToUserContract' => 'InetStudio\ACL\Users\Listeners\Front\AttachSocialRoleToUser',
        'InetStudio\ACL\Users\Contracts\Listeners\Front\AttachUserRoleToUserContract' => 'InetStudio\ACL\Users\Listeners\Front\AttachUserRoleToUser',
        'InetStudio\ACL\Users\Contracts\Mail\NewUserMailContract' => 'InetStudio\ACL\Users\Mail\NewUserMail',
        'InetStudio\ACL\Users\Contracts\Models\UserModelContract' => 'InetStudio\ACL\Users\Models\UserModel',
        'InetStudio\ACL\Users\Contracts\Notifications\NewUserNotificationContract' => 'InetStudio\ACL\Users\Notifications\NewUserNotification',
        'InetStudio\ACL\Users\Contracts\Notifications\NewUserQueueableNotificationContract' => 'InetStudio\ACL\Users\Notifications\NewUserQueueableNotification',
        'InetStudio\ACL\Users\Contracts\Services\Back\DataTables\IndexServiceContract' => 'InetStudio\ACL\Users\Services\Back\DataTables\IndexService',
        'InetStudio\ACL\Users\Contracts\Services\Back\ItemsServiceContract' => 'InetStudio\ACL\Users\Services\Back\ItemsService',
        'InetStudio\ACL\Users\Contracts\Services\Back\UtilityServiceContract' => 'InetStudio\ACL\Users\Services\Back\UtilityService',
        'InetStudio\ACL\Users\Contracts\Services\Front\Auth\LoginServiceContract' => 'InetStudio\ACL\Users\Services\Front\Auth\LoginService',
        'InetStudio\ACL\Users\Contracts\Services\Front\Auth\RegisterServiceContract' => 'InetStudio\ACL\Users\Services\Front\Auth\RegisterService',
        'InetStudio\ACL\Users\Contracts\Services\Front\Auth\SocialServiceContract' => 'InetStudio\ACL\Users\Services\Front\Auth\SocialService',
        'InetStudio\ACL\Users\Contracts\Transformers\Back\Resource\IndexTransformerContract' => 'InetStudio\ACL\Users\Transformers\Back\Resource\IndexTransformer',
        'InetStudio\ACL\Users\Contracts\Transformers\Back\Utility\SuggestionTransformerContract' => 'InetStudio\ACL\Users\Transformers\Back\Utility\SuggestionTransformer',
    ];

    /**
     * @var  array
     */
    public $singletons = [
        'InetStudio\ACL\Users\Contracts\Services\Front\ItemsServiceContract' => 'InetStudio\ACL\Users\Services\Front\ItemsService',
    ];

    /**
     * Получить сервисы от провайдера.
     *
     * @return  array
     */
    public function provides()
    {
        return array_merge(
            array_keys($this->bindings),
            array_keys($this->singletons)
        );
    }
}
