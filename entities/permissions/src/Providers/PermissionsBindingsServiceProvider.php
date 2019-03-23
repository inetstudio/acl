<?php

namespace InetStudio\ACL\Permissions\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;

/**
 * Class PermissionsBindingsServiceProvider.
 */
class PermissionsBindingsServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
    * @var  array
    */
    public $bindings = [
        'InetStudio\ACL\Permissions\Contracts\Events\Back\ModifyPermissionEventContract' => 'InetStudio\ACL\Permissions\Events\Back\ModifyPermissionEvent',
        'InetStudio\ACL\Permissions\Contracts\Http\Controllers\Back\PermissionsControllerContract' => 'InetStudio\ACL\Permissions\Http\Controllers\Back\PermissionsController',
        'InetStudio\ACL\Permissions\Contracts\Http\Controllers\Back\PermissionsDataControllerContract' => 'InetStudio\ACL\Permissions\Http\Controllers\Back\PermissionsDataController',
        'InetStudio\ACL\Permissions\Contracts\Http\Controllers\Back\PermissionsUtilityControllerContract' => 'InetStudio\ACL\Permissions\Http\Controllers\Back\PermissionsUtilityController',
        'InetStudio\ACL\Permissions\Contracts\Http\Requests\Back\SavePermissionRequestContract' => 'InetStudio\ACL\Permissions\Http\Requests\Back\SavePermissionRequest',
        'InetStudio\ACL\Permissions\Contracts\Http\Responses\Back\Permissions\DestroyResponseContract' => 'InetStudio\ACL\Permissions\Http\Responses\Back\Permissions\DestroyResponse',
        'InetStudio\ACL\Permissions\Contracts\Http\Responses\Back\Permissions\FormResponseContract' => 'InetStudio\ACL\Permissions\Http\Responses\Back\Permissions\FormResponse',
        'InetStudio\ACL\Permissions\Contracts\Http\Responses\Back\Permissions\IndexResponseContract' => 'InetStudio\ACL\Permissions\Http\Responses\Back\Permissions\IndexResponse',
        'InetStudio\ACL\Permissions\Contracts\Http\Responses\Back\Permissions\SaveResponseContract' => 'InetStudio\ACL\Permissions\Http\Responses\Back\Permissions\SaveResponse',
        'InetStudio\ACL\Permissions\Contracts\Http\Responses\Back\Permissions\ShowResponseContract' => 'InetStudio\ACL\Permissions\Http\Responses\Back\Permissions\ShowResponse',
        'InetStudio\ACL\Permissions\Contracts\Http\Responses\Back\Utility\SuggestionsResponseContract' => 'InetStudio\ACL\Permissions\Http\Responses\Back\Utility\SuggestionsResponse',
        'InetStudio\ACL\Permissions\Contracts\Models\PermissionModelContract' => 'InetStudio\ACL\Permissions\Models\PermissionModel',
        'InetStudio\ACL\Permissions\Contracts\Repositories\PermissionsRepositoryContract' => 'InetStudio\ACL\Permissions\Repositories\PermissionsRepository',
        'InetStudio\ACL\Permissions\Contracts\Services\Back\PermissionsDataTableServiceContract' => 'InetStudio\ACL\Permissions\Services\Back\PermissionsDataTableService',
        'InetStudio\ACL\Permissions\Contracts\Services\Back\PermissionsServiceContract' => 'InetStudio\ACL\Permissions\Services\Back\PermissionsService',
        'InetStudio\ACL\Permissions\Contracts\Services\Front\PermissionsServiceContract' => 'InetStudio\ACL\Permissions\Services\Front\PermissionsService',
        'InetStudio\ACL\Permissions\Contracts\Transformers\Back\PermissionTransformerContract' => 'InetStudio\ACL\Permissions\Transformers\Back\PermissionTransformer',
        'InetStudio\ACL\Permissions\Contracts\Transformers\Back\SuggestionTransformerContract' => 'InetStudio\ACL\Permissions\Transformers\Back\SuggestionTransformer',
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
