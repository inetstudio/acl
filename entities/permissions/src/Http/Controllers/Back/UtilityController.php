<?php

namespace InetStudio\ACL\Permissions\Http\Controllers\Back;

use Illuminate\Http\Request;
use InetStudio\ACL\Permissions\Contracts\Http\Controllers\Back\UtilityControllerContract;
use InetStudio\ACL\Permissions\Contracts\Http\Responses\Back\Utility\SuggestionsResponseContract;
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
