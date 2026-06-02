<?php
session_start();

require_once __DIR__ . '/../../controllers/AuthController.php';

$controller = new AuthController();
$controller->login();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login - Marketplace</title>
</head>
<body>

<h1>Login</h1>

<a href="../../index.php">Voltar ao início</a>

<hr>

<form method="POST">

    <input type="email" name="email" placeholder="Email" required>
    <br><br>

    <input type="password" name="senha" placeholder="Senha" required>
    <br><br>

    <button type="submit">Entrar</button>

</form>

</body>
</html>