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
</head>
<body>

<h1>Produtos</h1>

<a href="../../index.php">Voltar ao início</a>

<?php if (isset($_SESSION['usuario_id'])): ?>
    <a href="criar.php">Cadastrar novo produto</a>
<?php endif; ?>

<hr>

<?php if (empty($produtos)): ?>
    <p>Nenhum produto cadastrado ainda.</p>
<?php else: ?>
    <?php foreach ($produtos as $produto): ?>
        <div>
            <h2><?= htmlspecialchars($produto['titulo']) ?></h2>
            <p><?= htmlspecialchars($produto['descricao']) ?></p>
            <p><strong>Preço:</strong> R$ <?= number_format($produto['preco'], 2, ',', '.') ?></p>
            <p><strong>Categoria:</strong> <?= htmlspecialchars($produto['categoria_nome']) ?></p>
            <a href="detalhes.php?id=<?= $produto['id'] ?>">Ver detalhes</a>

            <?php if (isset($_SESSION['usuario_id']) && $_SESSION['usuario_id'] == $produto['usuario_id']): ?>
                <a href="../../controllers/ProdutoController.php?action=deletar&id=<?= $produto['id'] ?>">Deletar</a>
            <?php endif; ?>
        </div>
        <hr>
    <?php endforeach; ?>
<?php endif; ?>

</body>
</html>