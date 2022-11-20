<?php

namespace Pablo\ApiProduct\Entity\EntityAccess;

use Pablo\ApiProduct\Entity\User\User;
use Pablo\ApiProduct\Entity\User\UserRoles\UserRoleService;

abstract class AbstractEntityAccess implements EntityAccessInterface
{

    public $userId;

    protected $userRoleService;

    protected $currentUserRole;

    public function __construct()
    {
        $this->userId = User::getCurrentUserId();
        $this->userRoleService = new UserRoleService();
        $this->currentUserRole = $this->userRoleService->getUserRoleId($this->userId);
    }
}
