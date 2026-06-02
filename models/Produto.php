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

        $result = $this->conn->query($sql);

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function buscarPorId($id) {

        $sql = "SELECT produtos.*, categorias.nome AS categoria_nome
                FROM {$this->table}
                JOIN categorias ON produtos.categoria_id = categorias.id
                WHERE produtos.id = ?";

        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param("i", $id);

        $stmt->execute();

        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    public function criar($titulo, $descricao, $preco, $imagem, $usuario_id, $categoria_id) {

        $sql = "INSERT INTO {$this->table}
                (titulo, descricao, preco, imagem, usuario_id, categoria_id)
                VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param(
            "ssdsii",
            $titulo,
            $descricao,
            $preco,
            $imagem,
            $usuario_id,
            $categoria_id
        );

        return $stmt->execute();
    }

    public function deletar($id) {

        $sql = "DELETE FROM {$this->table} WHERE id = ?";

        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }
}