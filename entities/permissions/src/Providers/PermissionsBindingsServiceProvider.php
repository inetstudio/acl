<?php

namespace InetStudio\ACL\Permissions\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class PermissionsBindingsServiceProvider.
 */
class PermissionsBindingsServiceProvider extends ServiceProvider
{
    protected $defer = true;

    public $bindings = [
        // Controllers
        'InetStudio\ACL\Permissions\Contracts\Http\Controllers\Back\PermissionsControllerContract' => 'InetStudio\ACL\Permissions\Http\Controllers\Back\PermissionsController',
        'InetStudio\ACL\Permissions\Contracts\Http\Controllers\Back\PermissionsDataControllerContract' => 'InetStudio\ACL\Permissions\Http\Controllers\Back\PermissionsDataController',
        'InetStudio\ACL\Permissions\Contracts\Http\Controllers\Back\PermissionsUtilityControllerContract' => 'InetStudio\ACL\Permissions\Http\Controllers\Back\PermissionsUtilityController',
        
        // Events
        'InetStudio\ACL\Permissions\Contracts\Events\Back\ModifyPermissionEventContract' => 'InetStudio\ACL\Permissions\Events\Back\ModifyPermissionEvent',

        // Models
        'InetStudio\ACL\Permissions\Contracts\Models\PermissionModelContract' => 'InetStudio\ACL\Permissions\Models\PermissionModel',

        // Observers
        'InetStudio\ACL\Permissions\Contracts\Observers\PermissionObserverContract' => 'InetStudio\ACL\Permissions\Observers\PermissionObserver',
        
        // Repositories
        'InetStudio\ACL\Permissions\Contracts\Repositories\PermissionsRepositoryContract' => 'InetStudio\ACL\Permissions\Repositories\PermissionsRepository',
        
        // Requests
        'InetStudio\ACL\Permissions\Contracts\Http\Requests\Back\SavePermissionRequestContract' => 'InetStudio\ACL\Permissions\Http\Requests\Back\SavePermissionRequest',
        
        // Responses
        'InetStudio\ACL\Permissions\Contracts\Http\Responses\Back\Permissions\DestroyResponseContract' => 'InetStudio\ACL\Permissions\Http\Responses\Back\Permissions\DestroyResponse',
        'InetStudio\ACL\Permissions\Contracts\Http\Responses\Back\Permissions\FormResponseContract' => 'InetStudio\ACL\Permissions\Http\Responses\Back\Permissions\FormResponse',
        'InetStudio\ACL\Permissions\Contracts\Http\Responses\Back\Permissions\IndexResponseContract' => 'InetStudio\ACL\Permissions\Http\Responses\Back\Permissions\IndexResponse',
        'InetStudio\ACL\Permissions\Contracts\Http\Responses\Back\Permissions\SaveResponseContract' => 'InetStudio\ACL\Permissions\Http\Responses\Back\Permissions\SaveResponse',
        'InetStudio\ACL\Permissions\Contracts\Http\Responses\Back\Permissions\ShowResponseContract' => 'InetStudio\ACL\Permissions\Http\Responses\Back\Permissions\ShowResponse',
        'InetStudio\ACL\Permissions\Contracts\Http\Responses\Back\Utility\SuggestionsResponseContract' => 'InetStudio\ACL\Permissions\Http\Responses\Back\Utility\SuggestionsResponse',
        
        // Services
        'InetStudio\ACL\Permissions\Contracts\Services\Back\PermissionsDataTableServiceContract' => 'InetStudio\ACL\Permissions\Services\Back\PermissionsDataTableService',
        'InetStudio\ACL\Permissions\Contracts\Services\Back\PermissionsObserverServiceContract' => 'InetStudio\ACL\Permissions\Services\Back\PermissionsObserverService',
        'InetStudio\ACL\Permissions\Contracts\Services\Back\PermissionsServiceContract' => 'InetStudio\ACL\Permissions\Services\Back\PermissionsService',
        'InetStudio\ACL\Permissions\Contracts\Services\Front\PermissionsServiceContract' => 'InetStudio\ACL\Permissions\Services\Front\PermissionsService',
        
        // Transformers
        'InetStudio\ACL\Permissions\Contracts\Transformers\Back\PermissionTransformerContract' => 'InetStudio\ACL\Permissions\Transformers\Back\PermissionTransformer',
        'InetStudio\ACL\Permissions\Contracts\Transformers\Back\SuggestionTransformerContract' => 'InetStudio\ACL\Permissions\Transformers\Back\SuggestionTransformer',
    ];

    /**
     * Получить сервисы от провайдера.
     *
     * @return array
     */
    public function provides(): array
    {
        return [
            'InetStudio\ACL\Permissions\Contracts\Http\Controllers\Back\PermissionsControllerContract',
            'InetStudio\ACL\Permissions\Contracts\Http\Controllers\Back\PermissionsDataControllerContract',
            'InetStudio\ACL\Permissions\Contracts\Http\Controllers\Back\PermissionsUtilityControllerContract',
            'InetStudio\ACL\Permissions\Contracts\Events\Back\ModifyPermissionEventContract',
            'InetStudio\ACL\Permissions\Contracts\Models\PermissionModelContract',
            'InetStudio\ACL\Permissions\Contracts\Observers\PermissionObserverContract',
            'InetStudio\ACL\Permissions\Contracts\Repositories\PermissionsRepositoryContract',
            'InetStudio\ACL\Permissions\Contracts\Http\Requests\Back\SavePermissionRequestContract',
            'InetStudio\ACL\Permissions\Contracts\Http\Responses\Back\Permissions\DestroyResponseContract',
            'InetStudio\ACL\Permissions\Contracts\Http\Responses\Back\Permissions\FormResponseContract',
            'InetStudio\ACL\Permissions\Contracts\Http\Responses\Back\Permissions\IndexResponseContract',
            'InetStudio\ACL\Permissions\Contracts\Http\Responses\Back\Permissions\SaveResponseContract',
            'InetStudio\ACL\Permissions\Contracts\Http\Responses\Back\Permissions\ShowResponseContract',
            'InetStudio\ACL\Permissions\Contracts\Http\Responses\Back\Utility\SuggestionsResponseContract',
            'InetStudio\ACL\Permissions\Contracts\Services\Back\PermissionsDataTableServiceContract',
            'InetStudio\ACL\Permissions\Contracts\Services\Back\PermissionsObserverServiceContract',
            'InetStudio\ACL\Permissions\Contracts\Services\Back\PermissionsServiceContract',
            'InetStudio\ACL\Permissions\Contracts\Services\Front\PermissionsServiceContract',
            'InetStudio\ACL\Permissions\Contracts\Transformers\Back\PermissionTransformerContract',
            'InetStudio\ACL\Permissions\Contracts\Transformers\Back\SuggestionTransformerContract',
        ];
    }
}
