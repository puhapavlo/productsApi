<?php

namespace Pablo\ApiProduct\Entity\User\UserRoles;

use Pablo\ApiProduct\Entity\User\UserRoles\Enum\UserRoles;

/**
 * Class for Admin user role.
 */
class Admin extends UserRoleBase
{
    public function __construct()
    {
        $this->id = UserRoles::Admin->value;
        $this->name = UserRoles::Editor->name;
    }
}
