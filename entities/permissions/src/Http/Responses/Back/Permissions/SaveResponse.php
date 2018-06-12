<?php

namespace InetStudio\ACL\Permissions\Http\Responses\Back\Permissions;

use Illuminate\Contracts\Support\Responsable;
use InetStudio\ACL\Permissions\Contracts\Models\PermissionModelContract;
use InetStudio\ACL\Permissions\Contracts\Http\Responses\Back\Permissions\SaveResponseContract;

/**
 * Class SaveResponse.
 */
class SaveResponse implements SaveResponseContract, Responsable
{
    /**
     * @var PermissionModelContract
     */
    private $item;

    /**
     * SaveResponse constructor.
     *
     * @param PermissionModelContract $item
     */
    public function __construct(PermissionModelContract $item)
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
            return response()->redirectToRoute('back.acl.permissions.edit', [
                $this->item->id,
            ]);
        }
    }
}
