<?php

namespace Pablo\ApiProduct\exceptions;

/**
 * Exception for FieldTypeNotExist.
 */
class FieldTypeNotExistException extends \Exception
{
    protected $fieldType;

    public function __construct($fieldType)
    {
        $this->fieldType = $fieldType;
        parent::__construct();
    }

    public function __toString()
    {
        return "Field type $this->fieldType does not exist";
    }
}