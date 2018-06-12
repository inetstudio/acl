<?php

namespace InetStudio\ACL\Roles\Http\Responses\Back\Roles;

use Illuminate\Contracts\Support\Responsable;
use InetStudio\ACL\Roles\Contracts\Models\RoleModelContract;
use InetStudio\ACL\Roles\Contracts\Http\Responses\Back\Roles\SaveResponseContract;

/**
 * Class SaveResponse.
 */
class SaveResponse implements SaveResponseContract, Responsable
{
    /**
     * @var RoleModelContract
     */
    private $item;

    /**
     * SaveResponse constructor.
     *
     * @param RoleModelContract $item
     */
    public function __construct(RoleModelContract $item)
    {
        $this->item = $item;
    }

    /**
     * Возвращаем ответ при сохранении объекта.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     */
    public function toResponse($request)
    {
        $this->item = $this->item->fresh();

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'id' => $this->item->id,
            ], 200);
        } else {
            return response()->redirectToRoute('back.acl.roles.edit', [
                $this->item->id,
            ]);
        }
    }
}
