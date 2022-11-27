<?php

namespace Pablo\ApiProduct\Controllers;

use Pablo\ApiProduct\MessageServices\EntityMessageResponseService;
use Pablo\ApiProduct\MessageServices\Enum\EntityEvents;

class EntityController extends AbstractEntityController
{
    public function addEntity($entity_type)
    {
        parent::addEntity($entity_type);
        if ($this->entity->access->addAccess()) {
            $this->prepareUpdate();
            $operation = $this->entity->save();
            EntityMessageResponseService::sendEventMessage(
                $this->response,
                $this->entity->label(),
                EntityEvents::CREATE_SUCCESS,
                EntityEvents::CREATE_FAILED,
                $operation
            );
        } else {
            EntityMessageResponseService::sendForbidden($this->response);
        }
    }

    public function updateEntity($entity_type, $id)
    {
        parent::updateEntity($entity_type, $id);
        if ($this->entity->access->updateAccess()) {
            $this->prepareUpdate($id);
            $operation = $this->entity->save(true);
            EntityMessageResponseService::sendEventMessage(
                $this->response,
                $this->entity->label(),
                EntityEvents::UPDATE_SUCCESS,
                EntityEvents::UPDATE_FAILED,
                $operation
            );
        } else {
            EntityMessageResponseService::sendForbidden($this->response);
        }
    }

    public function deleteEntity($entity_type, $id)
    {
        parent::deleteEntity($entity_type, $id);
        if ($this->entity->access->deleteAccess()) {
            $operation = $this->entity->delete($id);
            EntityMessageResponseService::sendEventMessage(
                $this->response,
                $this->entity->label(),
                EntityEvents::DELETE_SUCCESS,
                EntityEvents::DELETE_FAILED,
                $operation
            );
        } else {
            EntityMessageResponseService::sendForbidden($this->response);
        }
    }

    public function viewEntity($entity_type, $id)
    {
        parent::viewEntity($entity_type, $id);
        if ($this->entity->access->viewAccess()) {
            $operation = $this->entity->entityToArray($id);
            if ($operation) {
                EntityMessageResponseService::sendMessage(
                    $this->response,
                    '',
                    NULL,
                    $operation
                );
            } else {
                EntityMessageResponseService::sendInternalServerError($this->response);
            }
        } else {
            EntityMessageResponseService::sendForbidden($this->response);
        }
    }

    public function viewAllEntity($entity_type)
    {
        parent::viewAllEntity($entity_type);
        if ($this->entity->access->viewAccess()) {
            $operation = $this->entity->getAllEntiesArray();
            if ($operation) {
                EntityMessageResponseService::sendMessage(
                    $this->response,
                    '',
                    NULL,
                    $operation
                );
            } else {
                EntityMessageResponseService::sendInternalServerError($this->response);
            }
        } else {
            EntityMessageResponseService::sendForbidden($this->response);
        }
    }
}
