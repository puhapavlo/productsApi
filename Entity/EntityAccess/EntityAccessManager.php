<?php

namespace Pablo\ApiProduct\Entity\EntityAccess;

use Pablo\ApiProduct\Entity\EntityAccess\exceptions\EntityAccessClassDoesNotExistException;
use Pablo\ApiProduct\Entity\EntityInterface;
use Pablo\ApiProduct\Entity\Enum\EntityTypeAccess;
use Pablo\ApiProduct\Entity\Product;
use Pablo\ApiProduct\Entity\User\User;
use Pablo\ApiProduct\Term\Access\TermBundleAccess\CategoryAccess;
use Pablo\ApiProduct\Term\Access\TermBundleAccess\StatusAccess;
use Pablo\ApiProduct\Term\Category;
use Pablo\ApiProduct\Term\Status;

/**
 * Entity Access Manager.
 */
class EntityAccessManager
{

    public EntityInterface $entity;

    public EntityAccessInterface $access;

    public function __construct(EntityInterface $entity)
    {
        $this->entity = $entity;
    }

    public function getEntityAccessClass()
    {
        switch ($this->entity) {
            case $this->entity instanceof Product:
                return ProductAccess::class;
            case $this->entity instanceof User:
                return UserAccess::class;
            case $this->entity instanceof Status:
                return StatusAccess::class;
            case $this->entity instanceof Category:
                return CategoryAccess::class;
            default:
                throw new EntityAccessClassDoesNotExistException($this->entity);
        }
    }

}