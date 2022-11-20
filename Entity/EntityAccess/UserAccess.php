<?php

namespace Pablo\ApiProduct\Entity\EntityAccess;

use Pablo\ApiProduct\Entity\User\UserRoles\Enum\UserRoles;

class UserAccess extends AbstractEntityAccess
{
    public function editAccess(): bool
    {
        switch ($this->currentUserRole) {
            case UserRoles::Admin->value:
                return true;
                break;
            case UserRoles::Editor->value:
                return false;
                break;
            case UserRoles::Anonymous->value:
                return false;
            default:
                return false;
        }
    }

    public function deleteAccess(): bool
    {
        switch ($this->currentUserRole) {
            case UserRoles::Admin->value:
                return true;
                break;
            case UserRoles::Editor->value:
                return false;
                break;
            case UserRoles::Anonymous->value:
                return false;
            default:
                return false;
        }
    }

    public function addAccess(): bool
    {
        switch ($this->currentUserRole) {
            case UserRoles::Admin->value:
                return true;
                break;
            case UserRoles::Editor->value:
                return false;
                break;
            case UserRoles::Anonymous->value:
                return false;
            default:
                return false;
        }
    }

    public function viewAccess(): bool
    {
        switch ($this->currentUserRole) {
            case UserRoles::Admin->value:
                return true;
                break;
            case UserRoles::Editor->value:
                return false;
                break;
            case UserRoles::Anonymous->value:
                return false;
            default:
                return false;
        }
    }
}
