<?php

namespace InetStudio\ACL\Roles\Repositories;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use InetStudio\ACL\Roles\Contracts\Models\RoleModelContract;
use InetStudio\ACL\Roles\Contracts\Repositories\RolesRepositoryContract;
use InetStudio\ACL\Roles\Contracts\Http\Requests\Back\SaveRoleRequestContract;

/**
 * Class RolesRepository.
 */
class RolesRepository implements RolesRepositoryContract
{
    /**
     * @var RoleModelContract
     */
    private $model;

    /**
     * RolesRepository constructor.
     *
     * @param RoleModelContract $model
     */
    public function __construct(RoleModelContract $model)
    {
        $this->model = $model;
    }

    /**
     * Получаем модель репозитория.
     *
     * @return RoleModelContract
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Возвращаем объект по id, либо создаем новый.
     *
     * @param int $id
     *
     * @return RoleModelContract
     */
    public function getItemByID(int $id): RoleModelContract
    {
        return $this->model::find($id) ?? new $this->model;
    }

    /**
     * Возвращаем объекты по списку id.
     *
     * @param $ids
     * @param bool $returnBuilder
     *
     * @return mixed
     */
    public function getItemsByIDs($ids, bool $returnBuilder = false)
    {
        $builder = $this->getItemsQuery()->whereIn('id', (array) $ids);

        if ($returnBuilder) {
            return $builder;
        }

        return $builder->get();
    }

    /**
     * Сохраняем объект.
     *
     * @param array $data
     * @param int $id
     *
     * @return RoleModelContract
     */
    public function save(array $data, int $id): RoleModelContract
    {
        $item = $this->getItemByID($id);
        $item->fill($data);
        $item->save();

        return $item;
    }

    /**
     * Удаляем объект.
     *
     * @param int $id
     *
     * @return bool
     */
    public function destroy($id): ?bool
    {
        return $this->getItemByID($id)->delete();
    }

    /**
     * Ищем объекты.
     *
     * @param string $field
     * @param $value
     * @param bool $returnBuilder
     *
     * @return mixed
     */
    public function searchItemsByField(string $field, string $value, bool $returnBuilder = false)
    {
        $builder = $this->getItemsQuery([])->where($field, 'LIKE', '%'.$value.'%');

        if ($returnBuilder) {
            return $builder;
        }

        return $builder->get();
    }

    /**
     * Получаем все объекты.
     *
     * @param bool $returnBuilder
     *
     * @return mixed
     */
    public function getAllItems(bool $returnBuilder = false)
    {
        $builder = $this->getItemsQuery(['created_at', 'updated_at']);

        if ($returnBuilder) {
            return $builder;
        }

        return $builder->get();
    }

    /**
     * Получаем объекты по slug.
     *
     * @param string $slug
     * @param bool $returnBuilder
     *
     * @return mixed
     */
    public function getItemBySlug(string $slug, bool $returnBuilder = false)
    {
        $builder = $this->getItemsQuery()->whereSlug($slug);

        if ($returnBuilder) {
            return $builder;
        }

        $item = $builder->first();

        return $item;
    }

    /**
     * Возвращаем запрос на получение объектов.
     *
     * @param array $extColumns
     * @param array $with
     *
     * @return Builder
     */
    protected function getItemsQuery($extColumns = [], $with = []): Builder
    {
        $defaultColumns = ['id', 'name', 'display_name'];

        $relations = [];

        return $this->model::select(array_merge($defaultColumns, $extColumns))
            ->with(array_intersect_key($relations, array_flip($with)));
    }
}
