<?php

namespace InetStudio\ACL\Users\Listeners\Front;

use InetStudio\ACL\Roles\Contracts\Repositories\RolesRepositoryContract;
use InetStudio\ACL\Users\Contracts\Listeners\Front\AttachSocialRoleToUserContract;

/**
 * Class AttachSocialRoleToUser.
 */
class AttachSocialRoleToUser implements AttachSocialRoleToUserContract
{
    /**
     * @var RolesRepositoryContract
     */
    private $repository;

    /**
     * AttachUserRoleToUser constructor.
     *
     * @param RolesRepositoryContract $repository
     */
    public function __construct(RolesRepositoryContract $repository)
    {
        $this->repository = $repository;
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
        $userRole = $this->repository->searchItemsByField('name', 'social_user')->first();

        if ($userRole) {
            $user->attachRole($userRole);
        }
    }
}
