<?php

namespace Pablo\ApiProduct\config;

use Pablo\ApiProduct\Helper\Helper;
use PDO;
use PDOException;

class Database
{
    /**
     * Configs for database.
     */
    private $host = "localhost";
    private $db_name = "product_api_db";
    private $username = "root";
    private $password = "";

    /**
     * Connection to database.
     */
    public $conn;

    /**
     * Method that return connection to database.
     *
     * @return PDO|null
     */
    public function getConnection()
    {
        $this->conn = null;
        $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->db_name;
        try {
            $this->conn = new PDO($dsn, $this->username, $this->password);
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }

    public function queryExecute($query)
    {
        $this->getConnection();
        $stmt = $this->conn->query($query);

        if ($stmt === false) {
            return $stmt;
        }

        $num = $stmt->rowCount();

        if ($num > 0) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }

    public function getTableData($table_name)
    {
        $query = "SELECT * FROM $table_name";

        return $this->queryExecute($query);
    }

    public function getRowInTable($table_name, $id)
    {
        $query = "SELECT * FROM $table_name WHERE id = $id";

        return $this->queryExecute($query);
    }

    public function deleteRowInTable($table_name, $id)
    {
        $query = "DELETE FROM $table_name WHERE id = $id";

        return $this->queryExecute($query);
    }

    public function insertRowToTable($table_name, $row)
    {
        $row_keys = array_keys($row);
        $row = Helper::addQuotesToArrayValue($row);
        $columns = implode(',', $row_keys);
        $values = implode(',', $row);

        $query = "INSERT INTO $table_name ($columns) VALUES ($values)";

        return $this->queryExecute($query);
    }


    public function updateRowToTable($table_name, $row, $id)
    {
        $row = Helper::addQuotesToArrayValue($row);
        $update_string = '';
        foreach ($row as $key => $value) {
            $update_string .= "$key = $value, ";
        }

        $query = "UPDATE $table_name SET $update_string WHERE id = $id";

        return $this->queryExecute($query);
    }
}
