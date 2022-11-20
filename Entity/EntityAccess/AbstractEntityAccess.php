<?php

namespace Pablo\ApiProduct\Entity\EntityAccess;

use Pablo\ApiProduct\Entity\User\User;
use Pablo\ApiProduct\Entity\User\UserRoles\UserRoleService;

abstract class AbstractEntityAccess implements EntityAccessInterface
{
    public $user;

    public $userId;

    public $userRole;

    protected $userRoleService;

    protected $currentUserRole;

    public function __construct()
    {
        $this->user = new User();
        $userId = $this->user::getCurrentUserId();
        $this->userRoleService = new UserRoleService();
        $this->currentUserRole = $this->userRoleService->getUserRoleId($this->userId);
    }
}
