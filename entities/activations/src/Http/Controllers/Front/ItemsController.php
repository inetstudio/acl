<?php

namespace InetStudio\ACL\Activations\Http\Controllers\Front;

use Illuminate\Http\Request;
use InetStudio\ACL\Activations\Contracts\Http\Controllers\Front\ItemsControllerContract;
use InetStudio\ACL\Activations\Contracts\Http\Responses\Front\ActivateResponseContract;
use InetStudio\AdminPanel\Base\Http\Controllers\Controller;

/**
 * Class ItemsController.
 */
class ItemsController extends Controller implements ItemsControllerContract
{
    /**
     * Активируем аккаунт.
     *
     * @param Request $request
     * @param ActivateResponseContract $response
     *
     * @return ActivateResponseContract
     */
    public function activate(Request $request, ActivateResponseContract $response): ActivateResponseContract
    {
        return $response;
    }
}
