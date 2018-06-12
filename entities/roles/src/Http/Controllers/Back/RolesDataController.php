<?php

namespace InetStudio\ACL\Roles\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use InetStudio\ACL\Roles\Contracts\Http\Controllers\Back\RolesDataControllerContract;

/**
 * Class RolesDataController.
 */
class RolesDataController extends Controller implements RolesDataControllerContract
{
    /**
     * Используемые сервисы.
     *
     * @var array
     */
    private $services;

    /**
     * RolesController constructor.
     */
    public function __construct()
    {
        $this->services['dataTables'] = app()->make('InetStudio\ACL\Roles\Contracts\Services\Back\RolesDataTableServiceContract');
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
