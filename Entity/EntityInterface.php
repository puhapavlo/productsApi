<?php

namespace Pablo\ApiProduct\Entity;

use Pablo\ApiProduct\Entity\Enum\EntityTypeAccess;

/**
 * Interface for entity.
 */
interface EntityInterface
{
    /**
     * Method for create entity.
     * @return mixed
     */
    public function create();

    /**
     * Method for update entity.
     * @return mixed
     */
    public function update();

    /**
     * Method for delete entity.
     * @return mixed
     */
    public function delete();

    /**
     * Method for return label entity.
     * @return string
     *   Return label entity.
     */
    public function label(): string;

    /**
     * Method for return all entities as array.
     * @return array
     *   Return entities as array.
     */
    public function getAllEntiesArray(): array;

    /**
     * Method for return entity as array.
     * @param $id
     *  Entity id.
     * @return array
     *  Return entity as array.
     */
    public function entityToArray($id): array;

    /**
     * Method for return entity as object.
     * @param $id
     *  Entity id.
     * @return EntityInterface
     *  Return entity object.
     */
    public function load($id): EntityInterface;
}
