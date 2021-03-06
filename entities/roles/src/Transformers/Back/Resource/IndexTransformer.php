<?php

namespace InetStudio\ACL\Roles\Transformers\Back\Resource;

use InetStudio\ACL\Roles\Contracts\Models\RoleModelContract;
use InetStudio\ACL\Roles\Contracts\Transformers\Back\Resource\IndexTransformerContract;
use InetStudio\AdminPanel\Base\Transformers\BaseTransformer;
use Throwable;

/**
 * Class IndexTransformer.
 */
class IndexTransformer extends BaseTransformer implements IndexTransformerContract
{
    /**
     * Подготовка данных для отображения в таблице.
     *
     * @param RoleModelContract $item
     *
     * @return array
     *
     * @throws Throwable
     */
    public function transform(RoleModelContract $item): array
    {
        return [
            'id' => (int) $item['id'],
            'display_name' => (string) $item['display_name'],
            'name' => (string) $item['name'],
            'description' => (string) $item['description'],
            'actions' => view(
                'admin.module.acl.roles::back.partials.datatables.actions',
                [
                    'id' => $item['id'],
                ]
            )->render(),
        ];
    }
}
