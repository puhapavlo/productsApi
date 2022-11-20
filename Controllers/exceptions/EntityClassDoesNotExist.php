<?php

namespace Pablo\ApiProduct\Controllers\exceptions;

/**
 * Exception for FieldTypeNotExist.
 */
class EntityClassDoesNotExist extends \Exception
{
    protected $entityType;

    public function __construct($entityType)
    {
        $this->$entityType = $entityType;
        parent::__construct();
    }

    public function __toString()
    {
        return "Entity type $this->entityType does not exist";
    }
}