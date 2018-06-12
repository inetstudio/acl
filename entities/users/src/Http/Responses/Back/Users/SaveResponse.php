<?php

namespace InetStudio\ACL\Users\Http\Responses\Back\Users;

use Illuminate\Contracts\Support\Responsable;
use InetStudio\ACL\Users\Contracts\Models\UserModelContract;
use InetStudio\ACL\Users\Contracts\Http\Responses\Back\Users\SaveResponseContract;

/**
 * Class SaveResponse.
 */
class SaveResponse implements SaveResponseContract, Responsable
{
    /**
     * @var UserModelContract
     */
    private $item;

    /**
     * SaveResponse constructor.
     *
     * @param UserModelContract $item
     */
    public function __construct(UserModelContract $item)
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
            return response()->redirectToRoute('back.acl.users.edit', [
                $this->item->id,
            ]);
        }
    }
}
