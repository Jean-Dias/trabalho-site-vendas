<?php
session_start();
require_once __DIR__ . '/../../models/Produto.php';

$produtoModel = new Produto();
$produtos = $produtoModel->listar();
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Produtos - Marketplace</title>
    <link rel="stylesheet" href="../../public/style.css">
</head>
<body>

<nav>
    <a href="../../index.php" class="nav-brand">Marketplace</a>

    <ul class="nav-links">

        <li><a href="listar.php">Produtos</a></li>
        <li><a href="../categorias/listar.php">Categorias</a></li>

        <?php if (isset($_SESSION['usuario_id'])): ?>

            <li><a href="criar.php">Anunciar</a></li>
            <li><a href="../auth/logout.php">Sair</a></li>

        <?php else: ?>

            <li><a href="../auth/login.php">Login</a></li>
            <li><a href="../auth/cadastro.php">Cadastro</a></li>

        <?php endif; ?>
    </ul>

    <?php if (isset($_SESSION['usuario_nome'])): ?>
        <span class="nav-user"><?= htmlspecialchars($_SESSION['usuario_nome']) ?></span>
    <?php endif; ?>

</nav>

<div class="container">

    <div class="page-header">

        <h1>Produtos <span>disponíveis</span></h1>

        <?php if (isset($_SESSION['usuario_id'])): ?>

            <a href="criar.php" class="btn btn-primary">+ Anunciar Produto</a>

        <?php endif; ?>

    </div>

    <?php if (empty($produtos)): ?>

        <div class="empty-state">
            <div class="icon">📦</div>

            <h3>Nenhum produto cadastrado ainda</h3>
            <p>Seja o primeiro a anunciar!</p>

            <?php if (isset($_SESSION['usuario_id'])): ?>

                <br><a href="criar.php" class="btn btn-primary">Anunciar agora</a>

            <?php endif; ?>

        </div>

    <?php else: ?>
        <div class="card-grid">

            <?php foreach ($produtos as $produto): ?>

                <div class="card">

                    <?php if ($produto['imagem']): ?>

                        <img src="<?= htmlspecialchars($produto['imagem']) ?>" alt="Imagem" class="card-img">
                    <?php else: ?>

                        <div class="card-img-placeholder"></div>

                    <?php endif; ?>

                    <span class="card-badge"><?= htmlspecialchars($produto['categoria_nome']) ?></span>

                    <h2><?= htmlspecialchars($produto['titulo']) ?></h2>
                    <p><?= htmlspecialchars(substr($produto['descricao'], 0, 80)) ?>...</p>

                    <div class="card-price">R$ <?= number_format($produto['preco'], 2, ',', '.') ?></div>

                    <div class="card-actions">

                        <a href="detalhes.php?id=<?= $produto['id'] ?>" class="btn btn-outline btn-sm">Ver detalhes</a>

                        <?php if (isset($_SESSION['usuario_id']) && $_SESSION['usuario_id'] == $produto['usuario_id']): ?>
                            
                            <a href="deletar.php?id=<?= $produto['id'] ?>" class="btn btn-danger btn-sm"
                               onclick="return confirm('Deseja deletar este produto?')">Deletar</a>
                               
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<script src="../../public/aaa.js"></script>
</body>
</html>
