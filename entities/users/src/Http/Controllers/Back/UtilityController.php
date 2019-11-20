<?php

namespace InetStudio\ACL\Users\Http\Controllers\Back;

use Illuminate\Http\Request;
use InetStudio\ACL\Users\Contracts\Http\Controllers\Back\UtilityControllerContract;
use InetStudio\ACL\Users\Contracts\Http\Responses\Back\Utility\SuggestionsResponseContract;
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
