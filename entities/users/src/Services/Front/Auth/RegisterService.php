<?php

namespace InetStudio\ACL\Users\Services\Front\Auth;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use InetStudio\ACL\Users\Contracts\Models\UserModelContract;
use InetStudio\ACL\Users\Contracts\Services\Front\Auth\RegisterServiceContract;
use InetStudio\AdminPanel\Base\Services\BaseService;

/**
 * Class RegisterService.
 */
class RegisterService extends BaseService implements RegisterServiceContract
{
    /**
     * ItemsService constructor.
     *
     * @param  UserModelContract  $model
     */
    public function __construct(UserModelContract $model)
    {
        parent::__construct($model);
    }

    /**
     * Регистрируем пользователя.
     *
     * @param array $data
     *
     * @return UserModelContract
     */
    public function register(array $data): UserModelContract
    {
        $itemData = Arr::only($data, $this->model->getFillable());
        $itemData['activated'] = (int) (! config('acl.activations.enabled'));

        if (config('acl.passwords.generate')) {
            $itemData['password'] = Str::random(8);
        }

        $item = $this->saveModel($itemData);

        return $item;
    }
}
