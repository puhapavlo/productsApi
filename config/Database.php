<?php

namespace Pablo\ApiProduct\config;

use Pablo\ApiProduct\Helper\Helper;
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

    public function queryExecute($query)
    {
        $stmt = $this->conn->query($query);

        if ($stmt === false) {
            return $stmt;
        }

        $num = $stmt->rowCount();

        $row = [];

        if ($num > 0) {
            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $row = true;
        }

        return $row;
    }

    public function getTableData($table_name)
    {
        $query = "SELECT * FROM $table_name";

        return $this->queryExecute($query);
    }

    public function getRowInTable($table_name, $id) {
        $query = "SELECT * FROM $table_name WHERE id = $id";

        return $this->queryExecute($query);
    }

    public function deleteRowInTable($table_name, $id) {
        $query = "DELETE FROM $table_name WHERE id = $id";

        return $this->queryExecute($query);
    }

    public function insertRowToTable($table_name, $row) {
        $row_keys = array_keys($row);
        $row = Helper::addQuotesToArrayValue($row);
        $columns = implode(',', $row_keys);
        $values = implode(',', $row);

        $query = "INSERT INTO $table_name ($columns) VALUES ($values)";

        return $this->queryExecute($query);
    }
}
