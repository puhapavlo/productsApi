<?php

namespace Pablo\ApiProduct\Term\Access;

use Pablo\ApiProduct\Entity\EntityAccess\AbstractEntityAccess;
use Pablo\ApiProduct\Entity\User\UserRoles\Enum\UserRoles;

class TermAccess extends AbstractEntityAccess
{

    public function editAccess() :bool
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
        }
    }

    public function deleteAccess() :bool
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
        }
    }

    public function addAccess() :bool
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
        }
    }

    public function viewAccess() :bool
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
        }
    }
}
