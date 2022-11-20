<?php

namespace Pablo\ApiProduct\Entity;

use Pablo\ApiProduct\config\Database;
use Pablo\ApiProduct\Entity\Fields\Field;
use PDO;

/**
 * Product entity class.
 */
class Product extends EntityBase
{
    const TABLE_NAME = 'products';

    #[Field(['name' => 'id', 'type' => 'int'])]
    public $id;

    #[Field(['name' => 'name', 'type' => 'string'])]
    public $name;

    #[Field(['name' => 'price', 'type' => 'float'])]
    public $price;

    #[Field(['name' => 'description', 'type' => 'string'])]
    public $description;

    #[Field(['name' => 'category', 'type' => 'int'])]
    public $category;

    #[Field(['name' => 'created', 'type' => 'current_time', 'format' => 'Y-m-d H:i:s'])]
    public $created;

    #[Field(['name' => 'picture', 'type' => 'string'])]
    public $picture;

    #[Field(['name' => 'status', 'type' => 'int'])]
    public $status;

    public function getProducts()
    {
        $db_data = $this->db->getTableData($this::TABLE_NAME);
        $products = [];
        foreach ($db_data as $product) {
            $products[] = $this->load($product['id']);
        }
        return $products;
    }

    public function update()
    {
        $query = "UPDATE INTO " . $this::TABLE_NAME . "
                SET
                    `name` = :name,
                    price = :price,
                    description = :description,
                    category = :category,
                    picture = :picture,
                    status = :status 
                    WHERE id = $this->id";

        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->picture = htmlspecialchars(strip_tags($this->picture));


        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":picture", $this->picture);
        $stmt->bindParam(":category", $this->category);
        $stmt->bindParam(":status", $this->status);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function label(): string
    {
        return $this->name;
    }

}
