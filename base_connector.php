<?php

class Database {

    // MySQL database credentials
    private $servername = "localhost";
    private $username = "mafia26";
    private $password = "admin123";
    private $dbname = "apply_smart_db";
    private $pdo;

    public function __construct() {
        $dsn = "mysql:host={$this->servername};dbname={$this->dbname}";
        try {
            $this->pdo = new PDO($dsn, $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

    public function getConnection() {
        return $this->pdo;
    }

    public function getEnumColumnType($table_name, $enum_column)
    {
        // Query to get ENUM options
        $sql = "SELECT COLUMN_TYPE 
        FROM information_schema.COLUMNS 
        WHERE TABLE_SCHEMA = 'apply_smart_db' 
        AND TABLE_NAME = :table 
        AND COLUMN_NAME = :column";

        // Prepare and execute the statement
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
        ':table' => $table_name,
        ':column' => $enum_column
        ]);

        $marital_status = $stmt->fetchColumn();

        if ($marital_status) {
            // Extract ENUM options
            preg_match_all("/'([^']+)'/", $marital_status, $matches);
            $enumOptions = $matches[1];

            return $enumOptions;
        }else {
            echo "No ENUM column found.";
            return null;
        }
    }
}




?>