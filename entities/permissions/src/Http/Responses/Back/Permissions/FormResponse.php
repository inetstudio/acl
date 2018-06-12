<?php

namespace InetStudio\ACL\Permissions\Http\Responses\Back\Permissions;

use Illuminate\View\View;
use Illuminate\Contracts\Support\Responsable;
use InetStudio\ACL\Permissions\Contracts\Http\Responses\Back\Permissions\FormResponseContract;

/**
 * Class FormResponse.
 */
class FormResponse implements FormResponseContract, Responsable
{
    /**
     * @var array
     */
    private $data;

    /**
     * FormResponse constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Возвращаем ответ при открытии формы объекта.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return View
     */
    public function toResponse($request): View
    {
        return view('admin.module.acl.permissions::back.pages.form', $this->data);
    }
}
