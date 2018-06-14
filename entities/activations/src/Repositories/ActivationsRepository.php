<?php

namespace InetStudio\ACL\Activations\Repositories;

use Illuminate\Database\Eloquent\Builder;
use InetStudio\ACL\Activations\Contracts\Models\ActivationModelContract;
use InetStudio\ACL\Activations\Contracts\Repositories\ActivationsRepositoryContract;

/**
 * Class ActivationsRepository.
 */
class ActivationsRepository implements ActivationsRepositoryContract
{
    /**
     * @var ActivationModelContract
     */
    private $model;

    /**
     * ActivationsRepository constructor.
     *
     * @param ActivationModelContract $model
     */
    public function __construct(ActivationModelContract $model)
    {
        $this->model = $model;
    }

    /**
     * Получаем модель репозитория.
     *
     * @return ActivationModelContract
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Возвращаем объект по id, либо создаем новый.
     *
     * @param string $token
     *
     * @return ActivationModelContract
     */
    public function getItemByToken(string $token): ActivationModelContract
    {
        return $this->model::find($token) ?? new $this->model;
    }

    /**
     * Сохраняем объект.
     *
     * @param array $data
     * @param string $token
     *
     * @return ActivationModelContract
     */
    public function save(array $data, string $token): ActivationModelContract
    {
        $item = $this->getItemByToken($token);
        $item->fill($data);
        $item->save();

        return $item;
    }

    /**
     * Удаляем объект.
     *
     * @param string $token
     *
     * @return bool
     */
    public function destroy(string $token): ?bool
    {
        return $this->getItemByToken($token)->delete();
    }

    /**
     * Ищем объекты.
     *
     * @param array $conditions
     * @param bool $returnBuilder
     *
     * @return mixed
     */
    public function searchItems(array $conditions, bool $returnBuilder = false)
    {
        $builder = $this->getItemsQuery([])->where($conditions);

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
        $builder = $this->getItemsQuery(['created_at'], [])->orderBy('created_at', 'desc');

        if ($returnBuilder) {
            return $builder;
        }

        return $builder->get();
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
        $defaultColumns = ['user_id', 'token'];

        $relations = [];

        return $this->model::select(array_merge($defaultColumns, $extColumns))
            ->with(array_intersect_key($relations, array_flip($with)));
    }
}
