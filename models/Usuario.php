<?php

require_once __DIR__ . '/../config/database.php';

class Usuario {

    private $conn;
    private $table = "usuarios";

    public function __construct() {
        $this->conn = Database::getConnection();
    }

    public function cadastrar($nome, $email, $senha, $cpf, $data_nascimento) {

        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

        $sql = "INSERT INTO {$this->table}
                (nome, email, senha, cpf, data_nascimento)
                VALUES (:nome, :email, :senha, :cpf, :data_nascimento)";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senhaHash);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->bindParam(':data_nascimento', $data_nascimento);

        return $stmt->execute();
    }

    public function login($email, $senha) {

        $sql = "SELECT * FROM {$this->table} WHERE email = :email";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(':email', $email);

        $stmt->execute();

        $usuario = $stmt->fetch();

        if ($usuario && password_verify($senha, $usuario['senha'])) {
            return $usuario;
        }

        return false;
    }

    public function buscarPorCpfEData($cpf, $data_nascimento) {

        $sql = "SELECT * FROM {$this->table}
                WHERE cpf = :cpf AND data_nascimento = :data_nascimento";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(':cpf', $cpf);
        $stmt->bindParam(':data_nascimento', $data_nascimento);

        $stmt->execute();

        return $stmt->fetch();
    }

    public function atualizarSenha($id, $novaSenha) {

        $senhaHash = password_hash($novaSenha, PASSWORD_DEFAULT);

        $sql = "UPDATE {$this->table} SET senha = :senha WHERE id = :id";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(':senha', $senhaHash);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }
}
