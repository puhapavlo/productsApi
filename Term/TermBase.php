<?php

namespace Pablo\ApiProduct\Term;

use Pablo\ApiProduct\config\Database;
use Pablo\ApiProduct\Entity\EntityBase;
use PDO;

abstract class TermBase extends EntityBase {

    public $id;

    public $name;

    public function create()
    {
        $query = "INSERT INTO " . $this::TABLE_NAME . "
                SET
                    `name` = :name";

        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $stmt->bindParam(":name", $this->name);

        if ($stmt->execute()) {
            return true;
        }

        return false;

    }

    public function getTerm($id) {
        $query = "SELECT id, `name`
            FROM " . $this::TABLE_NAME
        . " WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(":id", $this->id);

        $stmt = $this->conn->query($query);

        $num = $stmt->rowCount();

        $row = [];

        if ($num > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        }

        return $row;
    }

    public function getTerms()
    {
        $query = "SELECT id, `name`
            FROM " . $this::TABLE_NAME;

        $stmt = $this->conn->query($query);

        $num = $stmt->rowCount();

        $row = [];

        if ($num > 0) {
            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        return $row;
    }
}