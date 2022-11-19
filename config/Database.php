<?php

namespace Pablo\ApiProduct\config;

use PDO;
use PDOException;

class Database
{
    private $host = "localhost";
    private $db_name = "product_api_db";
    private $username = "root";
    private $password = "";
    public $conn;

    public function getConnection()
    {

        $this->conn = null;
        $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->db_name;
        $opt = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        try {
            $this->conn = new PDO($dsn, $this->username, $this->password, $opt);
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
