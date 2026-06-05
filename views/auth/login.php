<?php
session_start();
require_once __DIR__ . '/../../controllers/AuthController.php';
require_once __DIR__ . '/../../config/helpers.php';

$controller = new AuthController();
$erro = $controller->login();
$sucesso = isset($_GET['cadastro']) ? "Cadastro realizado! Faça login." : null;

$ultimoUsuario = obter_cookie_usuario();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login - Marketplace</title>
    <link rel="stylesheet" href="../../public/style.css">
</head>
<body>

<nav>
    <a href="../../index.php" class="nav-brand">Marketplace</a>

    <ul class="nav-links">
        <li><a href="../../views/produtos/listar.php">Produtos</a></li>
        <li><a href="cadastro.php">Cadastro</a></li>
    </ul>

</nav>

<div class="form-card">
    <h1>Bem-vindo</h1>

    <p class="subtitle">

        <?php if ($ultimoUsuario): ?>
            Olá de volta, <strong><?= htmlspecialchars($ultimoUsuario) ?></strong>!
        <?php else: ?>
            Entre na sua conta para continuar
        <?php endif; ?>

    </p>

    <?php if ($erro): ?>

        <div class="alert alert-error"><?= $erro ?></div>

    <?php endif; ?>

    <?php if ($sucesso): ?>

        <div class="alert alert-success"><?= $sucesso ?></div>

    <?php endif; ?>

    <form method="POST">

        <?= campo_csrf() ?>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" placeholder="seu@email.com" required>
        </div>

        <div class="form-group">
            <label>Senha</label>
            <input type="password" name="senha" placeholder="••••••••" required>
        </div>
        
        <button type="submit" class="btn btn-primary form-submit">Entrar</button>
    </form>

    <div class="form-footer">
        Não tem conta? <a href="cadastro.php">Cadastre-se</a><br><br>
        <a href="recuperar.php">Esqueceu a senha?</a>
    </div>

</div>

<script src="../../public/aaa.js"></script>
</body>
</html>
