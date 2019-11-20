<?php

namespace InetStudio\ACL\Roles\Http\Controllers\Back;

use Illuminate\Http\Request;
use InetStudio\ACL\Roles\Contracts\Http\Controllers\Back\DataControllerContract;
use InetStudio\ACL\Roles\Contracts\Http\Responses\Back\Data\GetIndexDataResponseContract;
use InetStudio\AdminPanel\Base\Http\Controllers\Controller;

/**
 * Class DataController.
 */
class DataController extends Controller implements DataControllerContract
{
    /**
     * Получаем данные для отображения в таблице.
     *
     * @param  Request  $request
     * @param  GetIndexDataResponseContract  $response
     *
     * @return GetIndexDataResponseContract
     */
    public function getIndexData(Request $request, GetIndexDataResponseContract $response): GetIndexDataResponseContract
    {
        return $response;
    }
}
