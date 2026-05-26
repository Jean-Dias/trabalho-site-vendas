<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Marketplace</title>
</head>
<body>

<h1>Marketplace</h1>

<ul>

    <li>
        <a href="views/auth/login.php">
            Login
        </a>
    </li>

    <li>
        <a href="views/auth/cadastro.php">
            Cadastro
        </a>
    </li>

    <li>
        <a href="views/produtos/listar.php">
            Produtos
        </a>
    </li>

</ul>

<?php if(isset($_SESSION['usuario_nome'])): ?>

    <p>
        Bem-vindo,
        <?= $_SESSION['usuario_nome'] ?>
    </p>

<?php endif; ?>

</body>
</html>