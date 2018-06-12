<?php

namespace InetStudio\ACL\Roles\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class RolesBindingsServiceProvider.
 */
class RolesBindingsServiceProvider extends ServiceProvider
{
    protected $defer = true;

    public $bindings = [
        // Controllers
        'InetStudio\ACL\Roles\Contracts\Http\Controllers\Back\RolesControllerContract' => 'InetStudio\ACL\Roles\Http\Controllers\Back\RolesController',
        'InetStudio\ACL\Roles\Contracts\Http\Controllers\Back\RolesDataControllerContract' => 'InetStudio\ACL\Roles\Http\Controllers\Back\RolesDataController',
        'InetStudio\ACL\Roles\Contracts\Http\Controllers\Back\RolesUtilityControllerContract' => 'InetStudio\ACL\Roles\Http\Controllers\Back\RolesUtilityController',
        
        // Events
        'InetStudio\ACL\Roles\Contracts\Events\Back\ModifyRoleEventContract' => 'InetStudio\ACL\Roles\Events\Back\ModifyRoleEvent',

        // Models
        'InetStudio\ACL\Roles\Contracts\Models\RoleModelContract' => 'InetStudio\ACL\Roles\Models\RoleModel',

        // Observers
        'InetStudio\ACL\Roles\Contracts\Observers\RoleObserverContract' => 'InetStudio\ACL\Roles\Observers\RoleObserver',
        
        // Repositories
        'InetStudio\ACL\Roles\Contracts\Repositories\RolesRepositoryContract' => 'InetStudio\ACL\Roles\Repositories\RolesRepository',
        
        // Requests
        'InetStudio\ACL\Roles\Contracts\Http\Requests\Back\SaveRoleRequestContract' => 'InetStudio\ACL\Roles\Http\Requests\Back\SaveRoleRequest',
        
        // Responses
        'InetStudio\ACL\Roles\Contracts\Http\Responses\Back\Roles\DestroyResponseContract' => 'InetStudio\ACL\Roles\Http\Responses\Back\Roles\DestroyResponse',
        'InetStudio\ACL\Roles\Contracts\Http\Responses\Back\Roles\FormResponseContract' => 'InetStudio\ACL\Roles\Http\Responses\Back\Roles\FormResponse',
        'InetStudio\ACL\Roles\Contracts\Http\Responses\Back\Roles\IndexResponseContract' => 'InetStudio\ACL\Roles\Http\Responses\Back\Roles\IndexResponse',
        'InetStudio\ACL\Roles\Contracts\Http\Responses\Back\Roles\SaveResponseContract' => 'InetStudio\ACL\Roles\Http\Responses\Back\Roles\SaveResponse',
        'InetStudio\ACL\Roles\Contracts\Http\Responses\Back\Roles\ShowResponseContract' => 'InetStudio\ACL\Roles\Http\Responses\Back\Roles\ShowResponse',
        'InetStudio\ACL\Roles\Contracts\Http\Responses\Back\Utility\SuggestionsResponseContract' => 'InetStudio\ACL\Roles\Http\Responses\Back\Utility\SuggestionsResponse',
        
        // Services
        'InetStudio\ACL\Roles\Contracts\Services\Back\RolesDataTableServiceContract' => 'InetStudio\ACL\Roles\Services\Back\RolesDataTableService',
        'InetStudio\ACL\Roles\Contracts\Services\Back\RolesObserverServiceContract' => 'InetStudio\ACL\Roles\Services\Back\RolesObserverService',
        'InetStudio\ACL\Roles\Contracts\Services\Back\RolesServiceContract' => 'InetStudio\ACL\Roles\Services\Back\RolesService',
        'InetStudio\ACL\Roles\Contracts\Services\Front\RolesServiceContract' => 'InetStudio\ACL\Roles\Services\Front\RolesService',
        
        // Transformers
        'InetStudio\ACL\Roles\Contracts\Transformers\Back\RoleTransformerContract' => 'InetStudio\ACL\Roles\Transformers\Back\RoleTransformer',
        'InetStudio\ACL\Roles\Contracts\Transformers\Back\SuggestionTransformerContract' => 'InetStudio\ACL\Roles\Transformers\Back\SuggestionTransformer',
    ];

    /**
     * Получить сервисы от провайдера.
     *
     * @return array
     */
    public function provides(): array
    {
        return [
            'InetStudio\ACL\Roles\Contracts\Http\Controllers\Back\RolesControllerContract',
            'InetStudio\ACL\Roles\Contracts\Http\Controllers\Back\RolesDataControllerContract',
            'InetStudio\ACL\Roles\Contracts\Http\Controllers\Back\RolesUtilityControllerContract',
            'InetStudio\ACL\Roles\Contracts\Events\Back\ModifyRoleEventContract',
            'InetStudio\ACL\Roles\Contracts\Models\RoleModelContract',
            'InetStudio\ACL\Roles\Contracts\Observers\RoleObserverContract',
            'InetStudio\ACL\Roles\Contracts\Repositories\RolesRepositoryContract',
            'InetStudio\ACL\Roles\Contracts\Http\Requests\Back\SaveRoleRequestContract',
            'InetStudio\ACL\Roles\Contracts\Http\Responses\Back\Roles\DestroyResponseContract',
            'InetStudio\ACL\Roles\Contracts\Http\Responses\Back\Roles\FormResponseContract',
            'InetStudio\ACL\Roles\Contracts\Http\Responses\Back\Roles\IndexResponseContract',
            'InetStudio\ACL\Roles\Contracts\Http\Responses\Back\Roles\SaveResponseContract',
            'InetStudio\ACL\Roles\Contracts\Http\Responses\Back\Roles\ShowResponseContract',
            'InetStudio\ACL\Roles\Contracts\Http\Responses\Back\Utility\SuggestionsResponseContract',
            'InetStudio\ACL\Roles\Contracts\Services\Back\RolesDataTableServiceContract',
            'InetStudio\ACL\Roles\Contracts\Services\Back\RolesObserverServiceContract',
            'InetStudio\ACL\Roles\Contracts\Services\Back\RolesServiceContract',
            'InetStudio\ACL\Roles\Contracts\Services\Front\RolesServiceContract',
            'InetStudio\ACL\Roles\Contracts\Transformers\Back\RoleTransformerContract',
            'InetStudio\ACL\Roles\Contracts\Transformers\Back\SuggestionTransformerContract',
        ];
    }
}
