<?php

namespace InetStudio\ACL\Roles\Services\Back;

use Illuminate\Support\Collection;
use InetStudio\ACL\Roles\Contracts\Models\RoleModelContract;
use InetStudio\ACL\Roles\Contracts\Services\Back\UtilityServiceContract;
use InetStudio\AdminPanel\Base\Services\BaseService;

/**
 * Class UtilityService.
 */
class UtilityService extends BaseService implements UtilityServiceContract
{
    /**
     * UtilityService constructor.
     *
     * @param  RoleModelContract  $model
     */
    public function __construct(RoleModelContract $model)
    {
        parent::__construct($model);
    }

    /**
     * Получаем подсказки.
     *
     * @param  string  $search
     *
     * @return Collection
     */
    public function getSuggestions(string $search): Collection
    {
        $items = $this->model::where(
            [
                ['display_name', 'LIKE', '%'.$search.'%'],
            ]
        )->get();

        return $items;
    }
}
