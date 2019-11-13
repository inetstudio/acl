<?php

namespace InetStudio\ACL\Permissions\Services\Back;

use Illuminate\Support\Collection;
use InetStudio\AdminPanel\Base\Services\BaseService;
use InetStudio\ACL\Permissions\Contracts\Models\PermissionModelContract;
use InetStudio\ACL\Permissions\Contracts\Services\Back\UtilityServiceContract;

/**
 * Class UtilityService.
 */
class UtilityService extends BaseService implements UtilityServiceContract
{
    /**
     * UtilityService constructor.
     *
     * @param  PermissionModelContract  $model
     */
    public function __construct(PermissionModelContract $model)
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
