<?php

namespace InetStudio\ACL\Users\Transformers\Back\Resource;

use Throwable;
use InetStudio\ACL\Users\Contracts\Models\UserModelContract;
use InetStudio\AdminPanel\Base\Transformers\BaseTransformer;
use InetStudio\ACL\Users\Contracts\Transformers\Back\Resource\IndexTransformerContract;

/**
 * Class IndexTransformer.
 */
class IndexTransformer extends BaseTransformer implements IndexTransformerContract
{
    /**
     * Подготовка данных для отображения в таблице.
     *
     * @param  UserModelContract  $item
     *
     * @return array
     *
     * @throws Throwable
     */
    public function transform(UserModelContract $item): array
    {
        return [
            'id' => (int) $item['id'],
            'name' => (string) $item['name'],
            'email' => (string) $item['email'],
            'roles' => view(
                'admin.module.acl.users::back.partials.datatables.roles',
                [
                    'roles' => $item['roles'],
                ]
            )->render(),
            'created_at' => (string) $item['created_at'],
            'actions' => view(
                'admin.module.acl.users::back.partials.datatables.actions',
                [
                    'id' => $item['id'],
                ]
            )->render(),
        ];
    }
}
