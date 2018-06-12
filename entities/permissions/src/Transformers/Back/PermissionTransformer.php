<?php

namespace InetStudio\ACL\Permissions\Transformers\Back;

use League\Fractal\TransformerAbstract;
use InetStudio\ACL\Permissions\Contracts\Models\PermissionModelContract;
use InetStudio\ACL\Permissions\Contracts\Transformers\Back\PermissionTransformerContract;

/**
 * Class PermissionTransformer.
 */
class PermissionTransformer extends TransformerAbstract implements PermissionTransformerContract
{
    /**
     * Подготовка данных для отображения в таблице.
     *
     * @param PermissionModelContract $item
     *
     * @return array
     *
     * @throws \Throwable
     */
    public function transform(PermissionModelContract $item): array
    {
        return [
            'id' => (int) $item->id,
            'display_name' => (string) $item->display_name,
            'name' => (string) $item->name,
            'description' => (string) $item->description,
            'actions' => view('admin.module.acl.permissions::back.partials.datatables.actions', [
                'id' => $item->id
            ])->render(),
        ];
    }
}
