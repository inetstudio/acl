<?php

namespace InetStudio\ACL\Permissions\Http\Controllers\Back;

use InetStudio\AdminPanel\Base\Http\Controllers\Controller;
use InetStudio\ACL\Permissions\Contracts\Http\Controllers\Back\PermissionsDataControllerContract;

/**
 * Class PermissionsDataController.
 */
class PermissionsDataController extends Controller implements PermissionsDataControllerContract
{
    /**
     * Используемые сервисы.
     *
     * @var array
     */
    private $services;

    /**
     * PermissionsController constructor.
     */
    public function __construct()
    {
        $this->services['dataTables'] = app()->make('InetStudio\ACL\Permissions\Contracts\Services\Back\PermissionsDataTableServiceContract');
    }

    /**
     * Получаем данные для отображения в таблице.
     *
     * @return mixed
     */
    public function data()
    {
        return $this->services['dataTables']->ajax();
    }
}
