<?php

namespace InetStudio\ACL\Permissions\Providers;

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
        'InetStudio\ACL\Permissions\Contracts\Events\Back\ModifyItemEventContract' => 'InetStudio\ACL\Permissions\Events\Back\ModifyItemEvent',
        'InetStudio\ACL\Permissions\Contracts\Http\Controllers\Back\DataControllerContract' => 'InetStudio\ACL\Permissions\Http\Controllers\Back\DataController',
        'InetStudio\ACL\Permissions\Contracts\Http\Controllers\Back\ResourceControllerContract' => 'InetStudio\ACL\Permissions\Http\Controllers\Back\ResourceController',
        'InetStudio\ACL\Permissions\Contracts\Http\Controllers\Back\UtilityControllerContract' => 'InetStudio\ACL\Permissions\Http\Controllers\Back\UtilityController',
        'InetStudio\ACL\Permissions\Contracts\Http\Requests\Back\SaveItemRequestContract' => 'InetStudio\ACL\Permissions\Http\Requests\Back\SaveItemRequest',
        'InetStudio\ACL\Permissions\Contracts\Http\Responses\Back\Data\GetIndexDataResponseContract' => 'InetStudio\ACL\Permissions\Http\Responses\Back\Data\GetIndexDataResponse',
        'InetStudio\ACL\Permissions\Contracts\Http\Responses\Back\Resource\CreateResponseContract' => 'InetStudio\ACL\Permissions\Http\Responses\Back\Resource\CreateResponse',
        'InetStudio\ACL\Permissions\Contracts\Http\Responses\Back\Resource\DestroyResponseContract' => 'InetStudio\ACL\Permissions\Http\Responses\Back\Resource\DestroyResponse',
        'InetStudio\ACL\Permissions\Contracts\Http\Responses\Back\Resource\EditResponseContract' => 'InetStudio\ACL\Permissions\Http\Responses\Back\Resource\EditResponse',
        'InetStudio\ACL\Permissions\Contracts\Http\Responses\Back\Resource\IndexResponseContract' => 'InetStudio\ACL\Permissions\Http\Responses\Back\Resource\IndexResponse',
        'InetStudio\ACL\Permissions\Contracts\Http\Responses\Back\Resource\SaveResponseContract' => 'InetStudio\ACL\Permissions\Http\Responses\Back\Resource\SaveResponse',
        'InetStudio\ACL\Permissions\Contracts\Http\Responses\Back\Resource\ShowResponseContract' => 'InetStudio\ACL\Permissions\Http\Responses\Back\Resource\ShowResponse',
        'InetStudio\ACL\Permissions\Contracts\Http\Responses\Back\Utility\SuggestionsResponseContract' => 'InetStudio\ACL\Permissions\Http\Responses\Back\Utility\SuggestionsResponse',
        'InetStudio\ACL\Permissions\Contracts\Models\PermissionModelContract' => 'InetStudio\ACL\Permissions\Models\PermissionModel',
        'InetStudio\ACL\Permissions\Contracts\Services\Back\DataTables\IndexServiceContract' => 'InetStudio\ACL\Permissions\Services\Back\DataTables\IndexService',
        'InetStudio\ACL\Permissions\Contracts\Services\Back\ItemsServiceContract' => 'InetStudio\ACL\Permissions\Services\Back\ItemsService',
        'InetStudio\ACL\Permissions\Contracts\Services\Back\UtilityServiceContract' => 'InetStudio\ACL\Permissions\Services\Back\UtilityService',
        'InetStudio\ACL\Permissions\Contracts\Services\Front\ItemsServiceContract' => 'InetStudio\ACL\Permissions\Services\Front\ItemsService',
        'InetStudio\ACL\Permissions\Contracts\Transformers\Back\Resource\IndexTransformerContract' => 'InetStudio\ACL\Permissions\Transformers\Back\Resource\IndexTransformer',
        'InetStudio\ACL\Permissions\Contracts\Transformers\Back\Utility\SuggestionTransformerContract' => 'InetStudio\ACL\Permissions\Transformers\Back\Utility\SuggestionTransformer',
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
