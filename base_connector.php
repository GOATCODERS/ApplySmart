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
}




?>