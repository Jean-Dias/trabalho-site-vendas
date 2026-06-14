<?php

class Database {
    private static $instance = null;
    private $conn;

    private $host   = "localhost";
    private $dbname = "marketplace";
    private $user   = "root";
    private $pass   = "positivo";

    private function __construct() {
        try {
            $this->conn = new PDO(
                "mysql:host={$this->host};dbname={$this->dbname};charset=utf8",
                $this->user,
                $this->pass
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            error_log("Erro de conexão com o banco de dados: " . $e->getMessage());
            
            die("Desculpe, estamos enfrentando problemas técnicos no momento.");
        }
    }

    private function __clone() {}

    public function __wakeup() {
        throw new Exception("Não é possível desserializar um Singleton.");
    }

    public static function getConnection() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance->conn;
    }
}