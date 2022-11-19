<?php

namespace Pablo\ApiProduct\Entity;

use Pablo\ApiProduct\config\Database;

class User {
    private $conn;

    private $table_name = "users";

    public $id;

    public $username;

    public $password;

    public function __construct()
    {
        $this->conn = (new Database())->getConnection();
    }

    public function create()
    {
        $query = "INSERT INTO " . $this->table_name . "
                SET
                    username = :username,
                    password = :password";

        $stmt = $this->conn->prepare($query);

        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->password = htmlspecialchars(strip_tags($this->password));

        $stmt->bindParam(":username", $this->username);

        $password_hash = password_hash($this->password, PASSWORD_BCRYPT);
        $stmt->bindParam(":password", $password_hash);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function update()
    {
        $password_set = !empty($this->password) ? ", password = :password" : "";

        $query = "UPDATE " . $this->table_name . "
            SET
                username = :username,
                {$password_set}
            WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $this->username = htmlspecialchars(strip_tags($this->username));

        $stmt->bindParam(":username", $this->username);

        if (!empty($this->password)) {
            $this->password= htmlspecialchars(strip_tags($this->password));
            $password_hash = password_hash($this->password, PASSWORD_BCRYPT);
            $stmt->bindParam(":password", $password_hash);
        }

        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
