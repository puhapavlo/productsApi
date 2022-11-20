<?php

namespace Pablo\ApiProduct\Controllers;

use Pablo\ApiProduct\Entity\EntityInterface;
use Pablo\ApiProduct\Entity\Enum\EntityTypeEnum;
use Pablo\ApiProduct\Entity\Fields\FieldsManager;
use Pablo\ApiProduct\exceptions\EntityClassDoesNotExist;
use Pablo\ApiProduct\Term\Term;

class AbstractEntityController extends AbstractController implements EntityControllerInterface
{

    protected EntityInterface $entity;

    protected FieldsManager $fieldsManager;


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

    public function setBundleTerm($type)
    {
        if ($this->entity instanceof Term) {
            $this->entity = $this->entity->getTermBundle($type);
        }
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
}
