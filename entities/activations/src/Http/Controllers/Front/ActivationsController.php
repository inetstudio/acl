<?php

namespace InetStudio\ACL\Activations\Http\Controllers\Front;

use InetStudio\AdminPanel\Base\Http\Controllers\Controller;
use InetStudio\ACL\Activations\Contracts\Http\Responses\Front\ActivateResponseContract;
use InetStudio\ACL\Activations\Contracts\Http\Controllers\Front\ActivationsControllerContract;

/**
 * Class ActivationsController.
 */
class ActivationsController extends Controller implements ActivationsControllerContract
{
    /**
     * Используемые сервисы.
     *
     * @var array
     */
    protected $services;

    /**
     * ActivationsController constructor.
     */
    public function __construct()
    {
        $this->services['activations'] = app()->make('InetStudio\ACL\Activations\Contracts\Services\Front\ActivationsServiceContract');
    }

    /**
     * Активируем аккаунт.
     *
     * @param string $token
     *
     * @return ActivateResponseContract
     */
    public function activate(string $token = ''): ActivateResponseContract
    {
        $result = $this->services['activations']->activate($token);

        return app()->makeWith('InetStudio\ACL\Activations\Contracts\Http\Responses\Front\ActivateResponseContract', [
            'result' => $result,
        ]);
    }
}
