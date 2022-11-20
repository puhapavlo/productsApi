<?php

namespace Pablo\ApiProduct\Entity\EntityAccess;

use Pablo\ApiProduct\Entity\User\UserRoles\Enum\UserRoles;

class ProductAccess extends AbstractEntityAccess
{

    public function editAccess(): bool
    {
        switch ($this->currentUserRole) {
            case UserRoles::Editor->value:
            case UserRoles::Admin->value:
                return true;
                break;
            case UserRoles::Anonymous->value:
                return false;
        }
    }

    public function deleteAccess():bool
    {
        switch ($this->currentUserRole) {
            case UserRoles::Editor->value:
            case UserRoles::Admin->value:
                return true;
                break;
            case UserRoles::Anonymous->value:
                return false;
        }
    }

    public function addAccess(): bool
    {
        switch ($this->currentUserRole) {
            case UserRoles::Editor->value:
            case UserRoles::Admin->value:
                return true;
                break;
            case UserRoles::Anonymous->value:
                return false;
        }
    }

    public function viewAccess(): bool
    {
        switch ($this->currentUserRole) {
            case UserRoles::Editor->value:
            case UserRoles::Admin->value:
                return true;
                break;
            case UserRoles::Anonymous->value:
                return false;
        }
    }
}
