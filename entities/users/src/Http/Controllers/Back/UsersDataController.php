<?php

namespace InetStudio\ACL\Users\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use InetStudio\ACL\Users\Contracts\Http\Controllers\Back\UsersDataControllerContract;

/**
 * Class UsersDataController.
 */
class UsersDataController extends Controller implements UsersDataControllerContract
{
    /**
     * Используемые сервисы.
     *
     * @var array
     */
    private $services;

    /**
     * UsersController constructor.
     */
    public function __construct()
    {
        $this->services['dataTables'] = app()->make('InetStudio\ACL\Users\Contracts\Services\Back\UsersDataTableServiceContract');
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
