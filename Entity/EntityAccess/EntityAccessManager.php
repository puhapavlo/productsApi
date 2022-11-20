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

    public function getEntityAccessObj()
    {
        switch ($this->entity) {
            case $this->entity instanceof Product:
                return new ProductAccess();
            case $this->entity instanceof User:
                return new UserAccess();
            case $this->entity instanceof Status:
                return new StatusAccess();
            case $this->entity instanceof Category:
                return new CategoryAccess();
            default:
                throw new EntityAccessClassDoesNotExistException($this->entity);
        }
    }

}