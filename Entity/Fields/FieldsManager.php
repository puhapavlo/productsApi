<?php

namespace Pablo\ApiProduct\Entity\Fields;

use Pablo\ApiProduct\Entity\EntityInterface;
use Pablo\ApiProduct\exceptions\FieldTypeNotExistException;

/**
 * Fields manager.
 */
class FieldsManager
{

    public $entity;

    protected $propertyReflector;

    protected $classReflector;

    public function __construct(EntityInterface $entity)
    {
        $this->entity = $entity;
        $this->classReflector = new \ReflectionClass($entity);
    }

    /**
     * Return fields as array.
     *
     * @throws \ReflectionException
     */
    public function getFieldsArray(): array
    {
        $properties = $this->classReflector->getProperties();
        $fields_array = [];
        foreach ($properties as $property) {
            $this->propertyReflector = new \ReflectionProperty($this->entity, $property->getName());
            $fields = $this->propertyReflector->getAttributes();
            foreach ($fields as $field) {
                if (!FieldType::existFieldType($field->getArguments()[0]['name'])) {
                    throw new FieldTypeNotExistException($field->getArguments()[0]['name']);
                }
                $fields_array[] = $field->getArguments()[0];
            }
        }

        return $fields_array;
    }
}