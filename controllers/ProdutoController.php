<?php

session_start();

require_once __DIR__ . '/../models/Produto.php';

class ProdutoController {

    public function listar() {

        $produtoModel = new Produto();

        $produtos = $produtoModel->listar();

        include __DIR__ . '/../views/produtos/listar.php';
    }

    public function detalhes() {

        $id = $_GET['id'];

        $produtoModel = new Produto();

        $produto = $produtoModel->buscarPorId($id);

        if (!$produto) {
            echo "Produto não encontrado.";
            return;
        }

        include __DIR__ . '/../views/produtos/detalhes.php';
    }

    public function criar() {

        if (!isset($_SESSION['usuario_id'])) {
            header("Location: ../views/auth/login.php");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $titulo       = $_POST['titulo'];
            $descricao    = $_POST['descricao'];
            $preco        = $_POST['preco'];
            $imagem       = $_POST['imagem'];
            $categoria_id = $_POST['categoria_id'];
            $usuario_id   = $_SESSION['usuario_id'];

            $produtoModel = new Produto();

            $resultado = $produtoModel->criar(
                $titulo,
                $descricao,
                $preco,
                $imagem,
                $usuario_id,
                $categoria_id
            );

            if ($resultado) {
                header("Location: ../views/produtos/listar.php");
                exit;
            } else {
                echo "Erro ao cadastrar produto.";
            }
        }

        include __DIR__ . '/../views/produtos/criar.php';
    }

    public function deletar() {

        if (!isset($_SESSION['usuario_id'])) {
            header("Location: ../views/auth/login.php");
            exit;
        }

        $id = $_GET['id'];

        $produtoModel = new Produto();

        $produtoModel->deletar($id);

        header("Location: ../views/produtos/listar.php");
        exit;
    }
}