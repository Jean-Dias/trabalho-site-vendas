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
        <span class="nav-user"><?= htmlspecialchars($_SESSION['usuario_nome']) ?></span>
    <?php endif; ?>
    
</nav>

<div class="hero">
    
    <h1>Compre e Venda com Facilidade</h1>
    <p>O melhor marketplace para encontrar produtos incríveis ou anunciar o que você tem.</p>
    
    <a href="views/produtos/listar.php" class="btn btn-primary">Ver Produtos</a>
    
    &nbsp;
    
    <?php if (isset($_SESSION['usuario_id'])): ?>
        
        <a href="views/produtos/criar.php" class="btn btn-outline">Anunciar Agora</a>
    
        <?php else: ?>
        
            <a href="views/auth/cadastro.php" class="btn btn-outline">Criar Conta</a>
    
        <?php endif; ?>
</div>

</body>
</html>
