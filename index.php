<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Marketplace</title>
    <link rel="stylesheet" href="public/style.css">
</head>
<body>

<nav>
    <a href="index.php" class="nav-brand">Marketplace</a>

    <ul class="nav-links">
        <li><a href="views/produtos/listar.php">Produtos</a></li>
        <li><a href="views/categorias/listar.php">Categorias</a></li>

        <?php if (isset($_SESSION['usuario_id'])): ?>

            <li><a href="views/produtos/criar.php">Anunciar</a></li>
            <li><a href="views/auth/logout.php">Sair</a></li>

        <?php else: ?>

            <li><a href="views/auth/login.php">Login</a></li>
            <li><a href="views/auth/cadastro.php">Cadastro</a></li>

        <?php endif; ?>
    </ul>

    <?php if (isset($_SESSION['usuario_nome'])): ?>
        <span class="nav-user">
            <?= htmlspecialchars($_SESSION['usuario_nome']) ?>
        </span>
    <?php endif; ?>

</nav>

<div class="hero">

    <h1>Marketplace de Compra e Venda</h1>

    <p>
        Encontre produtos de diversas categorias e anuncie seus itens
        de forma rápida, simples e segura.
    </p>

    <p class="hero-info">
        Produtos • Categorias • Anúncios
    </p>

    <a href="views/produtos/listar.php" class="btn btn-primary">
        Ver Produtos
    </a>

    <?php if (isset($_SESSION['usuario_id'])): ?>

        <a href="views/produtos/criar.php" class="btn btn-outline">
            Anunciar Agora
        </a>

    <?php else: ?>

        <a href="views/auth/cadastro.php" class="btn btn-outline">
            Criar Conta
        </a>

    <?php endif; ?>

    <small>
        Navegue pelos produtos disponíveis ou anuncie seus próprios itens.
    </small>

</div>

</body>
</html>