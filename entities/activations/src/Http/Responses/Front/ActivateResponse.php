<?php

namespace InetStudio\ACL\Activations\Http\Responses\Front;

use Illuminate\Contracts\Support\Responsable;
use InetStudio\ACL\Activations\Contracts\Http\Responses\Front\ActivateResponseContract;

/**
 * Class ActivateResponse.
 */
class ActivateResponse implements ActivateResponseContract, Responsable
{
    /**
     * Результат активации.
     *
     * @var array
     */
    private $result;

    /**
     * Используемые сервисы.
     *
     * @var array
     */
    protected $services;

    /**
     * ActivateResponse constructor.
     *
     * @param array $result
     */
    public function __construct(array $result)
    {
        $this->result = $result;

        $this->services['SEO'] = app()->make('InetStudio\Meta\Contracts\Services\Front\MetaServiceContract');
    }

    /**
     * Возвращаем ответ при активации пользователя.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     */
    public function toResponse($request)
    {
        if ($request->ajax()) {
            return response()->json($this->result, 200);
        } else {
            return view('admin.module.acl.activations::front.activate', [
                'SEO' => $this->services['SEO']->getAllTags(null),
                'activation' => $this->result,
            ]);
        }
    }
}
