<?php
session_start();

require_once __DIR__ . '/../../models/Produto.php';

$id = $_GET['id'] ?? null;

if (!$id) { header("Location: listar.php"); exit; }

$produtoModel = new Produto();
$produto = $produtoModel->buscarPorId($id);

if (!$produto) {

    echo "Produto não encontrado.";
    exit;
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>

        <?= htmlspecialchars($produto['titulo']) ?> - Marketplace</title>

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
            
        <?php endif; ?>

    </ul>

    <?php if (isset($_SESSION['usuario_nome'])): ?>

        <span class="nav-user"><?= htmlspecialchars($_SESSION['usuario_nome']) ?></span>

    <?php endif; ?>

</nav>

<div class="container">
    <div class="breadcrumb">

        <a href="listar.php">Produtos</a>
        <span>›</span>
        <?= htmlspecialchars($produto['titulo']) ?>

    </div>

    <div class="produto-detalhe">
        <div>
            <?php if ($produto['imagem']): ?>

                <img src="<?= htmlspecialchars($produto['imagem']) ?>" alt="Imagem do produto">

            <?php else: ?>

                <div class="card-img-placeholder" style="height:350px;border-radius:16px"></div>

            <?php endif; ?>
        </div>

        <div class="produto-info">
            
            <span class="card-badge"><?= htmlspecialchars($produto['categoria_nome']) ?></span>

            <h1><?= htmlspecialchars($produto['titulo']) ?></h1>

            <div class="preco">R$ <?= number_format($produto['preco'], 2, ',', '.') ?></div>
            
            <p class="descricao"><?= nl2br(htmlspecialchars($produto['descricao'])) ?></p>

            <div style="display:flex;gap:1rem;flex-wrap:wrap">

                <a href="listar.php" class="btn btn-outline">← Voltar</a>
                <?php if (isset($_SESSION['usuario_id']) && $_SESSION['usuario_id'] == $produto['usuario_id']): ?>

                    <a href="deletar.php?id=<?= $produto['id'] ?>" class="btn btn-danger"
                
                       onclick="return confirm('Deseja deletar este produto?')">Deletar</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script src="../../public/aaa.js"></script>

</body>
</html>
