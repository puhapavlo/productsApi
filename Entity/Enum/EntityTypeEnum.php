<?php

namespace Pablo\ApiProduct\Entity\Enum;

use Pablo\ApiProduct\Entity\EntityInterface;
use Pablo\ApiProduct\Entity\Product;
use Pablo\ApiProduct\Entity\User\User;
use Pablo\ApiProduct\exceptions\EntityClassDoesNotExist;
use Pablo\ApiProduct\Term\Category;
use Pablo\ApiProduct\Term\Status;
use Pablo\ApiProduct\Term\Term;

enum EntityTypeEnum
{
    case USER;
    case PRODUCT;
    case STATUS;
    case CATEGORY;

    public function class(): EntityInterface
    {
        return match ($this) {
            EntityTypeEnum::USER => new User(),
            EntityTypeEnum::PRODUCT => new Product(),
            EntityTypeEnum::STATUS => new Status(),
            EntityTypeEnum::CATEGORY => new Category()
        };
    }
}
