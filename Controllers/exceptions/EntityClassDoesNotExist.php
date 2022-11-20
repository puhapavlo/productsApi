<?php

namespace Pablo\ApiProduct\exceptions;

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
        return "Field type $this->entityType does not exist";
    }
}