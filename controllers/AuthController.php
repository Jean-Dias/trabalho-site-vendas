<?php


require_once __DIR__ . '/../models/Usuario.php';

class AuthController {

    public function login() {

        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            $email = $_POST['email'];
            $senha = $_POST['senha'];

            $usuarioModel = new Usuario();

            $usuario = $usuarioModel->login($email, $senha);

            if($usuario) {

                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['usuario_nome'] = $usuario['nome'];

                header("Location: /trabalho-site-vendas-master/index.php");
                exit;

            } else {

                echo "Email ou senha inválidos";
            }
        }
    }

    public function cadastrar() {

        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $senha = $_POST['senha'];
            $cpf = $_POST['cpf'];
            $data_nascimento = $_POST['data_nascimento'];

            $usuarioModel = new Usuario();

            $resultado = $usuarioModel->cadastrar(
                $nome,
                $email,
                $senha,
                $cpf,
                $data_nascimento
            );

            if($resultado) {
                echo "Usuário cadastrado com sucesso!";
            } else {
                echo "Erro ao cadastrar";
            }
        }
    }

    public function logout() {

        session_destroy();

        header("Location: /trabalho-site-vendas-master/index.php");
    }
}