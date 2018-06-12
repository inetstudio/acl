<?php

namespace InetStudio\ACL\Roles\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use InetStudio\ACL\Roles\Contracts\Http\Controllers\Back\RolesUtilityControllerContract;
use InetStudio\ACL\Roles\Contracts\Http\Responses\Back\Utility\SuggestionsResponseContract;

/**
 * Class RolesUtilityController.
 */
class RolesUtilityController extends Controller implements RolesUtilityControllerContract
{
    /**
     * Используемые сервисы.
     *
     * @var array
     */
    protected $services;

    /**
     * MessagesController constructor.
     */
    public function __construct()
    {
        $this->services['roles'] = app()->make(
            'InetStudio\ACL\Roles\Contracts\Services\Back\RolesServiceContract'
        );
    }

    /**
     * Возвращаем объекты для поля.
     *
     * @param Request $request
     *
     * @return SuggestionsResponseContract
     */
    public function getSuggestions(Request $request): SuggestionsResponseContract
    {
        $search = $request->get('q');
        $type = $request->get('type') ?? '';

        $suggestions = $this->services['roles']->getSuggestions($search);

        return app()->makeWith(
            'InetStudio\ACL\Roles\Contracts\Http\Responses\Back\Utility\SuggestionsResponseContract',
            compact('suggestions', 'type')
        );
    }
}
