<?php

require_once __DIR__ . '/../models/Categoria.php';
require_once __DIR__ . '/../config/helpers.php';

class CategoriaController {

    public function listar() {

        $categoriaModel = new Categoria();
        $categorias = $categoriaModel->listar();

        include __DIR__ . '/../views/categorias/listar.php';
    }

    public function criar() {

        if (!isset($_SESSION['usuario_id'])) {
            header("Location: /trabalho-site-vendas-master/views/auth/login.php");
            exit;
        }

        $mensagem = null;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            validar_csrf();

            $nome = $_POST['nome'];

            $categoriaModel = new Categoria();
            $resultado = $categoriaModel->criar($nome);

            if ($resultado) {
                header("Location: /trabalho-site-vendas-master/views/categorias/listar.php");
                exit;
            } else {
                $mensagem = "Erro ao cadastrar categoria.";
            }
        }

        include __DIR__ . '/../views/categorias/criar.php';
    }

    public function editar() {

        if (!isset($_SESSION['usuario_id'])) {
            header("Location: /trabalho-site-vendas-master/views/auth/login.php");
            exit;
        }

        $id = $_GET['id'];
        $categoriaModel = new Categoria();
        $categoria = $categoriaModel->buscarPorId($id);
        $mensagem = null;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            validar_csrf();

            $nome = $_POST['nome'];
            $resultado = $categoriaModel->atualizar($id, $nome);

            if ($resultado) {
                header("Location: /trabalho-site-vendas-master/views/categorias/listar.php");
                exit;
            } else {
                $mensagem = "Erro ao atualizar categoria.";
            }
        }

        include __DIR__ . '/../views/categorias/editar.php';
    }

    public function deletar() {

        if (!isset($_SESSION['usuario_id'])) {
            header("Location: /trabalho-site-vendas-master/views/auth/login.php");
            exit;
        }

        $id = $_GET['id'];

        $categoriaModel = new Categoria();
        $categoriaModel->deletar($id);

        header("Location: /trabalho-site-vendas-master/views/categorias/listar.php");
        exit;
    }
}
