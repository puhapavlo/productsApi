<?php

namespace Pablo\ApiProduct\Controllers;

interface EntityControllerInterface
{
    public function addEntity($entity_type);
    public function updateEntity($entity_type, $id);
    public function deleteEntity($entity_type, $id);
    public function viewEntity($entity_type, $id);
    public function viewAllEntity($entity_type);
}
