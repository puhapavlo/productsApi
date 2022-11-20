<?php

namespace Pablo\ApiProduct\Entity\User;

use Attribute;
use Pablo\ApiProduct\Entity\EntityBase;
use Pablo\ApiProduct\Entity\Enum\EntityTypeAccess;
use Pablo\ApiProduct\Entity\Fields\Field;
use PDO;
use Pecee\SimpleRouter\SimpleRouter as Router;

/**
 * User entity class.
 */
class User extends EntityBase
{
    const TABLE_NAME = "users";

    #[Field(['name' => 'id', 'type' => 'id'])]
    public $id;

    #[Field(['name' => 'username', 'type' => 'string'])]
    public $username;

    #[Field(['name' => 'password', 'type' => 'password'])]
    public $password;

    #[Field(['name' => 'role', 'type' => 'int'])]
    public $role;

    public function update()
    {
        $password_set = "";
        $this->username = htmlspecialchars(strip_tags($this->username));

        $query = "UPDATE $this::TABLE_NAME SET
                `username` = $this->username,
                {$password_set}
            WHERE id = $this->id";

        if (!empty($this->password)) {
            $this->password = htmlspecialchars(strip_tags($this->password));
            $password_hash = password_hash($this->password, PASSWORD_BCRYPT);
            $password_set = $password_hash;
        }

        if ($this->db->queryExecute($query)) {
            return true;
        }

        return false;
    }

    public function passwordVerify($username, $password)
    {
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

    public function getUsers()
    {
        return $this->db->getTableData($this::TABLE_NAME);
    }

    public static function getCurrentUserId()
    {
        return Router::router()->getRequest()?->uid;
    }

    public function label(): string
    {
        return $this->username;
    }
}
