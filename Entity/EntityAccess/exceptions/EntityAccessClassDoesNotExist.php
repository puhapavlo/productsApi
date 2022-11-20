<?php

namespace Pablo\ApiProduct\Entity\EntityAccess\exceptions;

/**
 * Exception for EntityTypeAccessDoesNotExist.
 */
class EntityAccessClassDoesNotExistException extends \Exception
{
    protected $entityType;

    public function __construct($entity)
    {
        $this->entityType = $entity::class;
        parent::__construct();
    }

    public function __toString()
    {
        return "Entity access class for $this->entityType does not exist";
    }
}