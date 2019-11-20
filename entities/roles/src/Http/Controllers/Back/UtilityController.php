<?php

namespace InetStudio\ACL\Roles\Http\Controllers\Back;

use Illuminate\Http\Request;
use InetStudio\ACL\Roles\Contracts\Http\Controllers\Back\UtilityControllerContract;
use InetStudio\ACL\Roles\Contracts\Http\Responses\Back\Utility\SuggestionsResponseContract;
use InetStudio\AdminPanel\Base\Http\Controllers\Controller;

/**
 * Class UtilityController.
 */
class UtilityController extends Controller implements UtilityControllerContract
{
    /**
     * Возвращаем объекты для поля.
     *
     * @param  Request  $request
     * @param  SuggestionsResponseContract  $response
     *
     * @return SuggestionsResponseContract
     */
    public function getSuggestions(Request $request, SuggestionsResponseContract $response): SuggestionsResponseContract
    {
        return $response;
    }
}
