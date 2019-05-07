<?php

namespace InetStudio\ACL\Users\Http\Responses\Front;

use Illuminate\Contracts\Support\Responsable;
use InetStudio\ACL\Users\Contracts\Http\Responses\Front\RegisterResponseContract;

/**
 * Class RegisterResponse.
 */
class RegisterResponse implements RegisterResponseContract, Responsable
{
    /**
     * Результат регистрации.
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
     * RegisterResponse constructor.
     *
     * @param array $result
     */
    public function __construct(array $result)
    {
        $this->result = $result;

        $this->services['SEO'] = app()->make('InetStudio\MetaPackage\Meta\Contracts\Services\Front\ItemsServiceContract');
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
            return view('admin.module.acl.users::front.register', [
                'SEO' => $this->services['SEO']->getAllTags(null),
                'registration' => $this->result,
            ]);
        }
    }
}
