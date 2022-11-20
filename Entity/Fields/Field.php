<?php

namespace Pablo\ApiProduct\Entity\Fields;

use Attribute;
use Pablo\ApiProduct\exceptions\FieldTypeNotExistException;

#[Attribute(Attribute::TARGET_ALL)]
class Field implements FieldInterface
{
    public string $name;

    public string $type;

    /**
     * @throws FieldTypeNotExistException
     */
    public function __construct(array $field)
    {
        if (FieldType::existFieldType($field['type'])) {
            $this->name = $field['name'];
            $this->type = $field['type'];
        } else {
            throw new FieldTypeNotExistException($field['type']);
        }
    }
}
