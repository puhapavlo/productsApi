<?php

namespace Pablo\ApiProduct\Entity\Enum;

enum EntityTypeAccess: string
{
    case ADD = 'add';
    case DELETE = 'delete';
    case EDIT = 'edit';
    case VIEW = 'view';
}
