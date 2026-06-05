<?php
session_start();
require_once __DIR__ . '/../../controllers/AuthController.php';
require_once __DIR__ . '/../../config/helpers.php';

$controller = new AuthController();
$resultado = $controller->recuperarSenha();
$erro = null;
$sucesso = null;

if ($resultado === "sucesso") {
    $sucesso = "Senha alterada com sucesso! Faça login.";
} elseif ($resultado !== null) {
    $erro = $resultado;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Recuperar Senha - Marketplace</title>
    <link rel="stylesheet" href="../../public/style.css">
</head>
<body>

<nav>
    <a href="../../index.php" class="nav-brand">Marketplace</a>
    <ul class="nav-links">
        <li><a href="login.php">Login</a></li>
        <li><a href="cadastro.php">Cadastro</a></li>
    </ul>
</nav>

<div class="form-card">
    <h1>Recuperar Senha</h1>
    <p class="subtitle">Informe seu CPF e data de nascimento para redefinir a senha</p>

    <?php if ($erro): ?>
        <div class="alert alert-error"><?= $erro ?></div>
    <?php endif; ?>
    <?php if ($sucesso): ?>
        <div class="alert alert-success"><?= $sucesso ?></div>
    <?php endif; ?>

    <form method="POST">
        <?= campo_csrf() ?>
        <div class="form-group">
            <label>CPF</label>
            <input type="text" name="cpf" placeholder="000.000.000-00" required>
        </div>
        <div class="form-group">
            <label>Data de Nascimento</label>
            <input type="date" name="data_nascimento" required>
        </div>
        <div class="form-group">
            <label>Nova Senha</label>
            <input type="password" name="nova_senha" placeholder="••••••••" required>
        </div>
        <button type="submit" class="btn btn-primary form-submit">Redefinir Senha</button>
    </form>

    <div class="form-footer">
        Lembrou a senha? <a href="login.php">Faça login</a>
    </div>
</div>

<script src="../../public/aaa.js"></script>
</body>
</html>
