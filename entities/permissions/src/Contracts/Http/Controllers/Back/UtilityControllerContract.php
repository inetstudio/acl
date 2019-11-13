<?php

namespace InetStudio\ACL\Permissions\Contracts\Http\Controllers\Back;

use Illuminate\Http\Request;
use InetStudio\ACL\Permissions\Contracts\Http\Responses\Back\Utility\SuggestionsResponseContract;

/**
 * Interface UtilityControllerContract.
 */
interface UtilityControllerContract
{
    /**
     * Возвращаем объекты для поля.
     *
     * @param  Request  $request
     * @param  SuggestionsResponseContract  $response
     *
     * @return SuggestionsResponseContract
     */
    public function getSuggestions(Request $request, SuggestionsResponseContract $response): SuggestionsResponseContract;
}
