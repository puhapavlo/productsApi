<?php

namespace Pablo\ApiProduct\Entity\User\UserRoles;

/**
 * Interface for User role.
 *
 * @property string @name.
 * @property int @id.
 */
interface UserRoleInterface
{
    /**
     * Get Role name.
     */
    public function getRoleName();

    /**
     * Get Role id.
     */
    public function getRoleId();
}