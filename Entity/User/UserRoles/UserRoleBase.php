<?php

namespace Pablo\ApiProduct\Entity\User\UserRoles;

use Pablo\ApiProduct\config\Database;
use Pablo\ApiProduct\Entity\User\User;

/**
 * Main abstract class for User role.
 */
abstract class UserRoleBase implements UserRoleInterface
{

    const TABLE_NAME = 'user_roles';

    protected int $id;

    protected string $name;

    protected $db;

    public function __construct()
    {
        $this->db = new Database();
    }
}