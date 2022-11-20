<?php

namespace Pablo\ApiProduct\Entity\User\UserRoles\Enum;

enum UserRoles: int
{
    case Admin = 1;
    case Editor = 2;
    case Anonymous = 3;
}
