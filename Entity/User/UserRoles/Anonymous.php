<?php

namespace Pablo\ApiProduct\Entity\User\UserRoles;

use Pablo\ApiProduct\Entity\User\UserRoles\Enum\UserRoles;

/**
 * Class for Editor User role.
 */
class Anonymous extends UserRoleBase
{
    public function __construct()
    {
        $this->id = UserRoles::Anonymous->value;
        $this->name = UserRoles::Anonymous->name;
    }
}