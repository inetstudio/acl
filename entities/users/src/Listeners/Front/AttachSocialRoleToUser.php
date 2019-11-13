<?php

namespace InetStudio\ACL\Users\Listeners\Front;

use InetStudio\ACL\Roles\Contracts\Services\Back\ItemsServiceContract;
use InetStudio\ACL\Users\Contracts\Listeners\Front\AttachSocialRoleToUserContract;

/**
 * Class AttachSocialRoleToUser.
 */
class AttachSocialRoleToUser implements AttachSocialRoleToUserContract
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
     *
     * @return void
     */
    public function handle($event): void
    {
        $user = $event->user;
        $userRole = $this->rolesService->getModel()->where([['name', '=', 'social_user']])->first();

        if ($userRole) {
            $user->attachRole($userRole);
        }
    }
}
