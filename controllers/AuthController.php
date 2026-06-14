<?php

require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../config/helpers.php';

class AuthController {

    public function login() {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            validar_csrf();

            $email = $_POST['email'];
            $senha = $_POST['senha'];

            $usuarioModel = new Usuario();
            $usuario = $usuarioModel->login($email, $senha);

            if ($usuario) {

                $_SESSION['usuario_id']   = $usuario['id'];
                $_SESSION['usuario_nome'] = $usuario['nome'];

                definir_cookie_usuario($usuario['nome']);

                header("Location: /trabalho-site-vendas/index.php");
                exit;

            } else {
                return "Email ou senha inválidos.";
            }
        }

        return null;
    }

    public function cadastrar() {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            validar_csrf();

            $nome            = $_POST['nome'];
            $email           = $_POST['email'];
            $senha           = $_POST['senha'];
            $cpf             = $_POST['cpf'];
            $data_nascimento = $_POST['data_nascimento'];

            $usuarioModel = new Usuario();
            $resultado = $usuarioModel->cadastrar($nome, $email, $senha, $cpf, $data_nascimento);

            if ($resultado) {
                header("Location: /trabalho-site-vendas/views/auth/login.php?cadastro=sucesso");
                exit;
            } else {
                return "Erro ao cadastrar. Tente novamente.";
            }
        }

        return null;
    }

    public function recuperarSenha() {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            validar_csrf();

            $cpf             = $_POST['cpf'];
            $data_nascimento = $_POST['data_nascimento'];
            $nova_senha      = $_POST['nova_senha'];

            $usuarioModel = new Usuario();
            $usuario = $usuarioModel->buscarPorCpfEData($cpf, $data_nascimento);

            if ($usuario) {
                $usuarioModel->atualizarSenha($usuario['id'], $nova_senha);
                return "sucesso";
            } else {
                return "CPF ou data de nascimento incorretos.";
            }
        }

        return null;
    }

    public function logout() {

        remover_cookie_usuario();
        session_destroy();

        header("Location: /trabalho-site-vendas/index.php");
        exit;
    }
}
