<?php

namespace Pablo\ApiProduct\Entity\User;

use Pablo\ApiProduct\Entity\EntityBase;
use Pablo\ApiProduct\Entity\Fields\Field;
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

    /**
     * Verify method for password and username.
     *
     * @param $username
     * @param $password
     *
     * @return bool
     */
    public function passwordVerify($username, $password)
    {
        $table_name = self::TABLE_NAME;
        $query = "SELECT * FROM $table_name WHERE username = '$username'";

        $result = $this->db->queryExecute($query)[0];

        if ($result) {
            $this->id = $result["id"];
            $this->username = $result["username"];
            $this->password = $result["password"];

            if (password_verify($password, $this->password)) {
                return true;
            }

            return false;
        }

        return false;
    }

    /**
     * Return current user id.
     */
    public static function getCurrentUserId()
    {
        return Router::router()->getRequest()?->uid;
    }

    /**
     * @inheritDoc
     */
    public function label(): string
    {
        return $this->username;
    }
}
