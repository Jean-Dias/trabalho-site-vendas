<?php

require_once __DIR__ . '/../config/database.php';

class Categoria {

    private $conn;
    private $table = "categorias";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->conectar();
    }

    public function listar() {

        $sql = "SELECT * FROM {$this->table} ORDER BY nome ASC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function buscarPorId($id) {

        $sql = "SELECT * FROM {$this->table} WHERE id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch();
    }

    public function criar($nome) {

        $sql = "INSERT INTO {$this->table} (nome) VALUES (:nome)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nome', $nome);

        return $stmt->execute();
    }

    public function atualizar($id, $nome) {

        $sql = "UPDATE {$this->table} SET nome = :nome WHERE id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }

public function deletar($id) {

    try {

        $sql = "DELETE FROM {$this->table} WHERE id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();

    } catch (PDOException $e) {

        if ($e->getCode() == '23000') {
            return "vinculado";
        }

        return false;
    }
}

}