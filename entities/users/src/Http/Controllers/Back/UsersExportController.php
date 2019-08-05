<?php

namespace InetStudio\ACL\Users\Http\Controllers\Back;

use Maatwebsite\Excel\Facades\Excel;
use InetStudio\AdminPanel\Base\Http\Controllers\Controller;
use InetStudio\ACL\Users\Contracts\Http\Controllers\Back\UsersExportControllerContract;

/**
 * Class UsersExportController.
 */
class UsersExportController extends Controller implements UsersExportControllerContract
{
    /**
     * Экспортируем пользователей.
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function exportUsers()
    {
        $export = app()->makeWith('InetStudio\ACL\Users\Contracts\Exports\UsersExportContract');

        return Excel::download($export, time().'.xlsx');
    }
}
