<?php

namespace InetStudio\ACL\Users\Listeners\Front;

use InetStudio\ACL\Roles\Contracts\Services\Back\ItemsServiceContract;
use InetStudio\ACL\Users\Contracts\Listeners\Front\AttachUserRoleToUserContract;

/**
 * Class AttachUserRoleToUser.
 */
class AttachUserRoleToUser implements AttachUserRoleToUserContract
{
    /**
     * @var ItemsServiceContract
     */
    protected $rolesService;

    /**
     * AttachUserRoleToUser constructor.
     *
     * @param ItemsServiceContract $rolesService
     */
    public function __construct(ItemsServiceContract $rolesService)
    {
        $this->rolesService = $rolesService;
    }

    /**
     * Handle the event.
     *
     * @param $event
     */
    public function handle($event): void
    {
        $user = $event->user;
        $userRole = $this->rolesService->getModel()->where([['name', '=', 'user']])->first();

        if ($userRole) {
            $user->addRole($userRole);
        }
    }
}
