<?php

namespace Pablo\ApiProduct\MessageServices\exceptions;

/**
 * Exception for BundleNotExist.
 */
class EntityEventDoesNotExist extends \Exception
{
    protected $entityEvent;

    public function __construct($entityEvent)
    {
        $this->entityEvent = $entityEvent;
        parent::__construct();
    }

    public function __toString()
    {
        return "Entity event $this->entityEvent does not exist";
    }
}