<?php

namespace Pablo\ApiProduct\Entity;

use Pablo\ApiProduct\config\Database;
use PDO;

class Product extends EntityBase {

    const TABLE_NAME = 'products';

    public $id;

    public $name;

    public $price;

    public $description;

    public $category;

    public $created;

    public $picture;

    public $status;

    public function create()
    {
        $query = "INSERT INTO " . $this::TABLE_NAME . "
                SET
                    `name` = :name,
                    price = :price,
                    description = :description,
                    category = :category,
                    created = :created,
                    picture = :picture,
                    status = :status";

        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->picture = htmlspecialchars(strip_tags($this->picture));
        $this->created = date('Y-m-d H:i:s');


        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":picture", $this->picture);
        $stmt->bindParam(":created", $this->created);
        $stmt->bindParam(":category", $this->category);
        $stmt->bindParam(":status", $this->status);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function update()
    {
        // TODO: Implement update() method.
    }
}
