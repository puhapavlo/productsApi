<?php

namespace Pablo\ApiProduct\Entity\EntityAccess\exceptions;

/**
 * Exception for Field Is Not Exist.
 */
class FieldIsNotExist extends \Exception
{
    protected $field;

    public function __construct($field)
    {
        $this->entityType = $field;
        parent::__construct();
    }

    public function __toString()
    {
        return "Field $this->field does not exist";
    }
}