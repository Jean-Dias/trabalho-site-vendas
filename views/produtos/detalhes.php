<?php
session_start();

require_once __DIR__ . '/../../models/Produto.php';

$id = $_GET['id'];

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
    <title><?= htmlspecialchars($produto['titulo']) ?> - Marketplace</title>
</head>
<body>

<a href="listar.php">Voltar para produtos</a>

<hr>

<h1><?= htmlspecialchars($produto['titulo']) ?></h1>

<p><?= htmlspecialchars($produto['descricao']) ?></p>

<p><strong>Preço:</strong> R$ <?= number_format($produto['preco'], 2, ',', '.') ?></p>

<p><strong>Categoria:</strong> <?= htmlspecialchars($produto['categoria_nome']) ?></p>

<?php if ($produto['imagem']): ?>
    <img src="<?= htmlspecialchars($produto['imagem']) ?>" alt="Imagem do produto" width="300">
<?php endif; ?>

<?php if (isset($_SESSION['usuario_id']) && $_SESSION['usuario_id'] == $produto['usuario_id']): ?>
    <br><br>
    <a href="listar.php?action=deletar&id=<?= $produto['id'] ?>">Deletar produto</a>
<?php endif; ?>

</body>
</html>