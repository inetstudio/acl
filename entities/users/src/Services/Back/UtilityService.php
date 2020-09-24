<?php

namespace InetStudio\ACL\Users\Services\Back;

use Illuminate\Support\Collection;
use InetStudio\ACL\Users\Contracts\Models\UserModelContract;
use InetStudio\ACL\Users\Contracts\Services\Back\UtilityServiceContract;
use InetStudio\AdminPanel\Base\Services\BaseService;

/**
 * Class UtilityService.
 */
class UtilityService extends BaseService implements UtilityServiceContract
{
    /**
     * UtilityService constructor.
     *
     * @param  UserModelContract  $model
     */
    public function __construct(UserModelContract $model)
    {
        parent::__construct($model);
    }

    /**
     * Получаем подсказки.
     *
     * @param  string  $search
     * @param  array  $roles
     *
     * @return Collection
     */
    public function getSuggestions(string $search, array $roles = []): Collection
    {
        $builder = $this->model::where(
                [
                    ['email', 'LIKE', '%'.$search.'%'],
                ]
            )
            ->orWhere(
                [
                    ['name', 'LIKE', '%'.$search.'%'],
                ]
            );

        if (! empty($roles)) {
            $builder = $builder->whereRoleIs($roles);
        }

        return $builder->get();
    }
}
