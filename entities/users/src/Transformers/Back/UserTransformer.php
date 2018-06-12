<?php

namespace InetStudio\ACL\Users\Transformers\Back;

use League\Fractal\TransformerAbstract;
use InetStudio\ACL\Users\Contracts\Models\UserModelContract;
use InetStudio\ACL\Users\Contracts\Transformers\Back\UserTransformerContract;

/**
 * Class UserTransformer.
 */
class UserTransformer extends TransformerAbstract implements UserTransformerContract
{
    /**
     * Подготовка данных для отображения в таблице.
     *
     * @param UserModelContract $item
     *
     * @return array
     *
     * @throws \Throwable
     */
    public function transform(UserModelContract $item): array
    {
        $roles = $item->roles->pluck('display_name')->toArray();

        $rolesHTML = '';

        foreach ($roles as $role) {
            $rolesHTML .= '<p>'.$role.'</p>';
        }

        return [
            'id' => (int) $item->id,
            'name' => (string) $item->name,
            'email' => (string) $item->email,
            'roles' => $rolesHTML,
            'actions' => view('admin.module.acl.users::back.partials.datatables.actions', [
                'id' => $item->id
            ])->render(),
        ];
    }
}
