<?php

namespace Pablo\ApiProduct\Entity\EntityAccess\exceptions;

/**
 * Exception for EntityTypeAccessDoesNotExist.
 */
class EntityTypeAccessDoesNotExistException extends \Exception
{
    protected $entityType;

    public function __construct($entityType)
    {
        $this->entityType = $entityType;
        parent::__construct();
    }

    public function __toString()
    {
        return "Bundle $this->entityType does not exist";
    }
}