<?php

namespace Pablo\ApiProduct\Entity\User\UserRoles;

use Pablo\ApiProduct\Entity\User\UserRoles\Enum\UserRoles;

/**
 * Class for Editor User role.
 */
class Editor extends UserRoleBase
{
    public function __construct()
    {
        $this->id = UserRoles::Editor->value;
        $this->name = UserRoles::Editor->name;
    }
}