<?php

namespace Pablo\ApiProduct\Entity\EntityAccess;

/**
 * Interface for entity access classes.
 */
interface EntityAccessInterface
{
    /**
     * Check edit access.
     * @return bool
     */
    public function editAccess(): bool;

    /**
     * Check delete access.
     * @return bool
     */
    public function deleteAccess(): bool;

    /**
     * Check add access.
     * @return bool
     */
    public function addAccess(): bool;

    /**
     * Check view access.
     * @return bool
     */
    public function viewAccess(): bool;
}
