<?php

namespace InetStudio\ACL\Users\Http\Controllers\Back;

use Illuminate\Http\Request;
use InetStudio\AdminPanel\Base\Http\Controllers\Controller;
use Cviebrock\EloquentSluggable\Services\SlugService;
use InetStudio\ACL\Users\Contracts\Http\Responses\Back\Utility\SlugResponseContract;
use InetStudio\ACL\Users\Contracts\Http\Controllers\Back\UsersUtilityControllerContract;
use InetStudio\ACL\Users\Contracts\Http\Responses\Back\Utility\SuggestionsResponseContract;

/**
 * Class UsersUtilityController.
 */
class UsersUtilityController extends Controller implements UsersUtilityControllerContract
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
        $this->services['users'] = app()->make(
            'InetStudio\ACL\Users\Contracts\Services\Back\UsersServiceContract'
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

        $suggestions = $this->services['users']->getSuggestions($search);

        return app()->makeWith(
            'InetStudio\ACL\Users\Contracts\Http\Responses\Back\Utility\SuggestionsResponseContract',
            compact('suggestions', 'type')
        );
    }
}
