<?php

namespace InetStudio\ACL\Users\Contracts\Services\Back;

use Illuminate\Support\Collection;
use InetStudio\AdminPanel\Base\Contracts\Services\BaseServiceContract;

/**
 * Interface UtilityServiceContract.
 */
interface UtilityServiceContract extends BaseServiceContract
{
    /**
     * Получаем подсказки.
     *
     * @param  string  $search
     * @param  array  $roles
     *
     * @return Collection
     */
    public function getSuggestions(string $search, array $roles = []): Collection;
}
