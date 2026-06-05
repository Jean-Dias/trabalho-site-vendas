<?php

require_once __DIR__ . '/../config/database.php';

class Produto {

    private $conn;
    private $table = "produtos";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->conectar();
    }

    public function listar() {

        $sql = "SELECT produtos.*, categorias.nome AS categoria_nome
                FROM {$this->table}
                JOIN categorias ON produtos.categoria_id = categorias.id
                ORDER BY produtos.created_at DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function buscarPorId($id) {

        $sql = "SELECT produtos.*, categorias.nome AS categoria_nome
                FROM {$this->table}
                JOIN categorias ON produtos.categoria_id = categorias.id
                WHERE produtos.id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch();
    }

    public function criar($titulo, $descricao, $preco, $imagem, $usuario_id, $categoria_id) {

        $sql = "INSERT INTO {$this->table}
                (titulo, descricao, preco, imagem, usuario_id, categoria_id)
                VALUES (:titulo, :descricao, :preco, :imagem, :usuario_id, :categoria_id)";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':preco', $preco);
        $stmt->bindParam(':imagem', $imagem);
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->bindParam(':categoria_id', $categoria_id);

        return $stmt->execute();
    }

    public function deletar($id) {

        $sql = "DELETE FROM {$this->table} WHERE id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }
}
