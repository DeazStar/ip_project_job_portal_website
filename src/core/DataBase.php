<?php
session_start();


class DataBase {
    private string $url = "mysql:host=localhost;dbname=job_portal";
    private string $username = "admin";
    private string $password = "password";

    private ?PDO $connection;

    public function __construct() {
        try {
            $this->connection = new PDO($this->url, $this->username, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Error connecting to database: " . $e->getMessage();
        }
    }

    public function getConnection():PDO {
        return $this->connection; 
    }


    public function close():void {
        $this->connection = null;
    }
}