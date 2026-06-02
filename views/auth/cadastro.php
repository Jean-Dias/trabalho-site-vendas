<?php
session_start();

require_once __DIR__ . '/../../controllers/AuthController.php';

$controller = new AuthController();
$controller->cadastrar();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro - Marketplace</title>
</head>
<body>

<h1>Cadastro</h1>

<a href="../../index.php">Voltar ao início</a>

<hr>

<form method="POST">

    <label>Nome:</label><br>
    <input type="text" name="nome" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label>Senha:</label><br>
    <input type="password" name="senha" required><br><br>

    <label>CPF:</label><br>
    <input type="text" name="cpf" required><br><br>

    <label>Data de Nascimento:</label><br>
    <input type="date" name="data_nascimento" required><br><br>

    <button type="submit">Cadastrar</button>

</form>

</body>
</html>