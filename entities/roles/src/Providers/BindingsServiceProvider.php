<?php

namespace InetStudio\ACL\Roles\Providers;

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
        'InetStudio\ACL\Roles\Contracts\Events\Back\ModifyItemEventContract' => 'InetStudio\ACL\Roles\Events\Back\ModifyItemEvent',
        'InetStudio\ACL\Roles\Contracts\Http\Controllers\Back\DataControllerContract' => 'InetStudio\ACL\Roles\Http\Controllers\Back\DataController',
        'InetStudio\ACL\Roles\Contracts\Http\Controllers\Back\ResourceControllerContract' => 'InetStudio\ACL\Roles\Http\Controllers\Back\ResourceController',
        'InetStudio\ACL\Roles\Contracts\Http\Controllers\Back\UtilityControllerContract' => 'InetStudio\ACL\Roles\Http\Controllers\Back\UtilityController',
        'InetStudio\ACL\Roles\Contracts\Http\Requests\Back\SaveItemRequestContract' => 'InetStudio\ACL\Roles\Http\Requests\Back\SaveItemRequest',
        'InetStudio\ACL\Roles\Contracts\Http\Responses\Back\Data\GetIndexDataResponseContract' => 'InetStudio\ACL\Roles\Http\Responses\Back\Data\GetIndexDataResponse',
        'InetStudio\ACL\Roles\Contracts\Http\Responses\Back\Resource\CreateResponseContract' => 'InetStudio\ACL\Roles\Http\Responses\Back\Resource\CreateResponse',
        'InetStudio\ACL\Roles\Contracts\Http\Responses\Back\Resource\DestroyResponseContract' => 'InetStudio\ACL\Roles\Http\Responses\Back\Resource\DestroyResponse',
        'InetStudio\ACL\Roles\Contracts\Http\Responses\Back\Resource\EditResponseContract' => 'InetStudio\ACL\Roles\Http\Responses\Back\Resource\EditResponse',
        'InetStudio\ACL\Roles\Contracts\Http\Responses\Back\Resource\IndexResponseContract' => 'InetStudio\ACL\Roles\Http\Responses\Back\Resource\IndexResponse',
        'InetStudio\ACL\Roles\Contracts\Http\Responses\Back\Resource\SaveResponseContract' => 'InetStudio\ACL\Roles\Http\Responses\Back\Resource\SaveResponse',
        'InetStudio\ACL\Roles\Contracts\Http\Responses\Back\Resource\ShowResponseContract' => 'InetStudio\ACL\Roles\Http\Responses\Back\Resource\ShowResponse',
        'InetStudio\ACL\Roles\Contracts\Http\Responses\Back\Utility\SuggestionsResponseContract' => 'InetStudio\ACL\Roles\Http\Responses\Back\Utility\SuggestionsResponse',
        'InetStudio\ACL\Roles\Contracts\Models\RoleModelContract' => 'InetStudio\ACL\Roles\Models\RoleModel',
        'InetStudio\ACL\Roles\Contracts\Services\Back\DataTables\IndexServiceContract' => 'InetStudio\ACL\Roles\Services\Back\DataTables\IndexService',
        'InetStudio\ACL\Roles\Contracts\Services\Back\ItemsServiceContract' => 'InetStudio\ACL\Roles\Services\Back\ItemsService',
        'InetStudio\ACL\Roles\Contracts\Services\Back\UtilityServiceContract' => 'InetStudio\ACL\Roles\Services\Back\UtilityService',
        'InetStudio\ACL\Roles\Contracts\Services\Front\ItemsServiceContract' => 'InetStudio\ACL\Roles\Services\Front\ItemsService',
        'InetStudio\ACL\Roles\Contracts\Transformers\Back\Resource\IndexTransformerContract' => 'InetStudio\ACL\Roles\Transformers\Back\Resource\IndexTransformer',
        'InetStudio\ACL\Roles\Contracts\Transformers\Back\Utility\SuggestionTransformerContract' => 'InetStudio\ACL\Roles\Transformers\Back\Utility\SuggestionTransformer',
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
