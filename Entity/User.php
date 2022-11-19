<?php

namespace Pablo\ApiProduct\Entity;

use PDO;

class User extends EntityBase {

    const TABLE_NAME = "users";

    public $id;

    public $username;

    public $password;

    public function create()
    {
        $query = "INSERT INTO " . $this::TABLE_NAME . "
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

    public function passwordVerify($username, $password) {
        $query = "SELECT id, username, password
            FROM " . self::TABLE_NAME . "
            WHERE username = ?
            LIMIT 0,1";

        $stmt = $this->conn->prepare($query);

        $this->username = htmlspecialchars(strip_tags($username));

        $stmt->bindParam(1, $username);

        $stmt->execute();

        $num = $stmt->rowCount();

        if ($num > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->id = $row["id"];
            $this->username = $row["username"];
            $this->password = $row["password"];

            if (password_verify($password, $this->password)) {
                return true;
            }

            return false;
        }

        return false;
    }
}
