<?php

namespace Pablo\ApiProduct\Entity\User\UserRoles;

use Pablo\ApiProduct\config\Database;
use Pablo\ApiProduct\Entity\User\User;
use Pablo\ApiProduct\Entity\User\UserRoles\Enum\UserRoles;

/**
 * Class provide service for user roles.
 */
class UserRoleService
{
    protected $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    /**
     * Return role for user.
     * @param $user_id
     *  User ID.
     * @return int
     *  Return role id for user.
     */
    public function getUserRoleId($user_id): int
    {
        if ($user_id) {
            $user_table_name = User::TABLE_NAME;
            $query = "SELECT `role` FROM $user_table_name WHERE id = $user_id";
            $role = $this->db->queryExecute($query);
            return $role[0]['role'];
        } else {
            return UserRoles::Anonymous->value;
        }
    }
}
