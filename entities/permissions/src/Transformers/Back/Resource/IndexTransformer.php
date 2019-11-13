<?php

namespace InetStudio\ACL\Permissions\Transformers\Back\Resource;

use Throwable;
use InetStudio\AdminPanel\Base\Transformers\BaseTransformer;
use InetStudio\ACL\Permissions\Contracts\Models\PermissionModelContract;
use InetStudio\ACL\Permissions\Contracts\Transformers\Back\Resource\IndexTransformerContract;

/**
 * Class IndexTransformer.
 */
class IndexTransformer extends BaseTransformer implements IndexTransformerContract
{
    /**
     * Подготовка данных для отображения в таблице.
     *
     * @param  PermissionModelContract  $item
     *
     * @return array
     *
     * @throws Throwable
     */
    public function transform(PermissionModelContract $item): array
    {
        return [
            'id' => (int) $item['id'],
            'display_name' => (string) $item['display_name'],
            'name' => (string) $item['name'],
            'description' => (string) $item['description'],
            'actions' => view(
                'admin.module.acl.permissions::back.partials.datatables.actions',
                [
                    'id' => $item['id'],
                ]
            )->render(),
        ];
    }
}
