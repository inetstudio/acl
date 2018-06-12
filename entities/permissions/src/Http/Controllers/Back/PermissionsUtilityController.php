<?php

namespace InetStudio\ACL\Permissions\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cviebrock\EloquentSluggable\Services\SlugService;
use InetStudio\ACL\Permissions\Contracts\Http\Responses\Back\Utility\SlugResponseContract;
use InetStudio\ACL\Permissions\Contracts\Http\Controllers\Back\PermissionsUtilityControllerContract;
use InetStudio\ACL\Permissions\Contracts\Http\Responses\Back\Utility\SuggestionsResponseContract;

/**
 * Class PermissionsUtilityController.
 */
class PermissionsUtilityController extends Controller implements PermissionsUtilityControllerContract
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
        $this->services['permissions'] = app()->make(
            'InetStudio\ACL\Permissions\Contracts\Services\Back\PermissionsServiceContract'
        );
    }

    /**
     * Получаем slug для модели по строке.
     *
     * @param Request $request
     *
     * @return SlugResponseContract
     */
    public function getSlug(Request $request): SlugResponseContract
    {
        $name = $request->get('name');
        $slug = ($name) ? SlugService::createSlug(app()->make('InetStudio\ACL\Permissions\Contracts\Http\Responses\Back\Utility\SlugResponseContract'), 'slug', $name) : '';

        return app()->makeWith('InetStudio\Categories\Contracts\Http\Responses\Back\Utility\SlugResponseContract', [
            'slug' => $slug,
        ]);
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

        $suggestions = $this->services['permissions']->getSuggestions($search);

        return app()->makeWith(
            'InetStudio\ACL\Permissions\Contracts\Http\Responses\Back\Utility\SuggestionsResponseContract',
            compact('suggestions', 'type')
        );
    }
}
