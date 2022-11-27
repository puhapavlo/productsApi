<?php

namespace Pablo\ApiProduct\Controllers;

use Pablo\ApiProduct\Controllers\exceptions\EntityClassDoesNotExist;
use Pablo\ApiProduct\Entity\EntityAccess\exceptions\EntityAccessClassDoesNotExistException;
use Pablo\ApiProduct\Entity\EntityAccess\exceptions\FieldIsNotExist;
use Pablo\ApiProduct\Entity\EntityInterface;
use Pablo\ApiProduct\Entity\Enum\EntityTypeEnum;
use Pablo\ApiProduct\Entity\Fields\FieldsManager;
use Pablo\ApiProduct\MessageServices\MessageResponseService;
use Pablo\ApiProduct\Term\Term;

class AbstractEntityController extends AbstractController implements EntityControllerInterface
{
    protected EntityInterface $entity;
    protected FieldsManager $fieldsManager;


    /**
     * @throws EntityClassDoesNotExist
     */
    public function setEntity(string $entity_type)
    {
        switch ($entity_type) {
            case 'user':
                $this->entity = EntityTypeEnum::USER->class();
                break;
            case 'product':
                $this->entity = EntityTypeEnum::PRODUCT->class();
                break;
            case 'status':
                $this->entity = EntityTypeEnum::STATUS->class();
                break;
            case 'category':
                $this->entity = EntityTypeEnum::CATEGORY->class();
                break;
            default:
                throw new EntityClassDoesNotExist($entity_type);
        }
        $this->fieldsManager = new FieldsManager($this->entity);
    }

    public function addEntity($entity_type)
    {
        $this->setEntity($entity_type);
    }

    public function updateEntity($entity_type, $id)
    {
        $this->setEntity($entity_type);
    }

    public function deleteEntity($entity_type, $id)
    {
        $this->setEntity($entity_type);
    }

    public function viewEntity($entity_type, $id)
    {
        $this->setEntity($entity_type);
    }

    public function viewAllEntity($entity_type)
    {
        $this->setEntity($entity_type);
    }

    /**
     * @throws \ReflectionException
     * @throws FieldIsNotExist
     */
    public function prepareUpdate($id = null)
    {
        $current_fields = $this->fieldsManager->getFieldsArray();
        $new_fields = $this->request->fields;
        foreach ($current_fields as $key => $value) {
            $field = $current_fields[$key]['name'];
            if (array_key_exists($field, $new_fields)) {
                $this->entity->{$field} = $new_fields[$field];
            }
        }
        if ($id) {
            $this->id = $id;
        }
    }
}
