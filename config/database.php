<?php

class Database {

    private $host = "localhost";
    private $dbname = "marketplace";
    private $user = "root";
    private $pass = "";

    public $conn;

    public function conectar() {

        $this->conn = new mysqli(
            $this->host,
            $this->user,
            $this->pass,
            $this->dbname
        );

        if ($this->conn->connect_error) {
            die("Erro na conexão: " . $this->conn->connect_error);
        }

        return $this->conn;
    }
}