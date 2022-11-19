<?php

namespace Pablo\ApiProduct\Term;

use Pablo\ApiProduct\config\Database;
use Pablo\ApiProduct\Entity\EntityBase;

abstract class TermBase extends EntityBase {

    public $name;

    public function create()
    {
        $query = "INSERT INTO " . $this->table_name . "
                SET
                    `name` = :`name`";

        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));

        if ($stmt->execute()) {
            return true;
        }

        return false;

    }
}