<?php

require_once __DIR__ . '/../config/database.php';

class Usuario {

    private $conn;
    private $table = "usuarios";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->conectar();
    }

    public function cadastrar($nome, $email, $senha, $cpf, $data_nascimento) {

        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

        $sql = "INSERT INTO {$this->table}
        (nome, email, senha, cpf, data_nascimento)
        VALUES (?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param(
            "sssss",
            $nome,
            $email,
            $senhaHash,
            $cpf,
            $data_nascimento
        );

        return $stmt->execute();
    }

    public function login($email, $senha) {

        $sql = "SELECT * FROM {$this->table} WHERE email = ?";

        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param("s", $email);

        $stmt->execute();

        $result = $stmt->get_result();

        if($result->num_rows > 0) {

            $usuario = $result->fetch_assoc();

            if(password_verify($senha, $usuario['senha'])) {
                return $usuario;
            }
        }

        return false;
    }
}