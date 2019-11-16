<?php

namespace InetStudio\ACL\Users\Http\Controllers\Back;

use Illuminate\Http\Request;
use InetStudio\AdminPanel\Base\Http\Controllers\Controller;
use InetStudio\ACL\Users\Contracts\Http\Controllers\Back\ExportControllerContract;
use InetStudio\ACL\Users\Contracts\Http\Responses\Back\Export\ItemsExportResponseContract;

/**
 * Class ExportController.
 */
class ExportController extends Controller implements ExportControllerContract
{
    /**
     * Экспортируем записи.
     *
     * @param  Request  $request
     * @param  ItemsExportResponseContract  $response
     *
     * @return ItemsExportResponseContract
     */
    public function exportItems(Request $request, ItemsExportResponseContract $response): ItemsExportResponseContract
    {
        return $response;
    }
}
