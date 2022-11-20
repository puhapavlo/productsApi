<?php

namespace Pablo\ApiProduct\Controllers;

use Pablo\ApiProduct\Entity\Enum\EntityTypeEnum;
use Pablo\ApiProduct\exceptions\EntityClassDoesNotExist;

class EntityController extends AbstractEntityController
{

    public function addEntity($entity_type)
    {
        parent::addEntity($entity_type);
    }

    public function updateEntity($entity_type, $id)
    {
        parent::updateEntity($entity_type, $id);
    }

    public function deleteEntity($entity_type, $id)
    {
        parent::deleteEntity($entity_type, $id);
        if ($this->entity->access->deleteAccess()) {
            $this->entity->delete($id);
        }
    }

    public function viewEntity($entity_type, $id)
    {
        parent::viewEntity($entity_type, $id);
    }

    public function viewAllEntity($entity_type)
    {
        parent::viewAllEntity($entity_type);
    }
}
