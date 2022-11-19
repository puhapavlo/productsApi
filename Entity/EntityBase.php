<?php

namespace Pablo\ApiProduct\Entity;

use Pablo\ApiProduct\config\Database;

abstract class EntityBase {

    const TABLE_NAME = self::TABLE_NAME;

    protected $conn;

    public function __construct()
    {
        $this->conn = (new Database())->getConnection();
    }

    public abstract function create();

    public abstract function update();
}
