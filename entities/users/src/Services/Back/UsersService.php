<?php

namespace InetStudio\ACL\Users\Services\Back;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use InetStudio\ACL\Users\Contracts\Models\UserModelContract;
use InetStudio\ACL\Users\Contracts\Services\Back\UsersServiceContract;
use InetStudio\ACL\Users\Contracts\Repositories\UsersRepositoryContract;
use InetStudio\ACL\Users\Contracts\Http\Requests\Back\SaveUserRequestContract;

/**
 * Class UsersService.
 */
class UsersService implements UsersServiceContract
{
    /**
     * @var UsersRepositoryContract
     */
    private $repository;

    /**
     * UsersService constructor.
     *
     * @param UsersRepositoryContract $repository
     */
    public function __construct(UsersRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Получаем объект модели.
     *
     * @param int $id
     *
     * @return UserModelContract
     */
    public function getUserObject(int $id = 0)
    {
        return $this->repository->getItemByID($id);
    }

    /**
     * Получаем объекты по списку id.
     *
     * @param array|int $ids
     * @param bool $returnBuilder
     *
     * @return mixed
     */
    public function getUsersByIDs($ids, bool $returnBuilder = false)
    {
        return $this->repository->getItemsByIDs($ids, $returnBuilder);
    }

    /**
     * Сохраняем модель.
     *
     * @param SaveUserRequestContract $request
     * @param int $id
     *
     * @return UserModelContract
     */
    public function save(SaveUserRequestContract $request, int $id): UserModelContract
    {
        $action = ($id) ? 'отредактирован' : 'создан';
        $item = $this->repository->save($request->only($this->repository->getModel()->getFillable()), $id);

        app()->make('InetStudio\ACL\Roles\Contracts\Services\Back\RolesServiceContract')
            ->attachToObject($request, $item);

        app()->make('InetStudio\ACL\Permissions\Contracts\Services\Back\PermissionsServiceContract')
            ->attachToObject($request, $item);

        event(app()->makeWith('InetStudio\ACL\Users\Contracts\Events\Back\ModifyUserEventContract', [
            'object' => $item,
        ]));

        Session::flash('success', 'Пользователь «'.$item->name.'» успешно '.$action);

        return $item;
    }

    /**
     * Удаляем модель.
     *
     * @param $id
     *
     * @return bool
     */
    public function destroy(int $id): ?bool
    {
        return $this->repository->destroy($id);
    }

    /**
     * Получаем подсказки.
     *
     * @param string $search
     *
     * @return Collection
     */
    public function getSuggestions(string $search): Collection
    {
        $items = $this->repository->searchItemsByField('email', $search);

        return $items;
    }
}
