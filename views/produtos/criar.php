<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../auth/login.php");
    exit;
}

require_once __DIR__ . '/../../models/Produto.php';
require_once __DIR__ . '/../../models/Categoria.php';
require_once __DIR__ . '/../../config/helpers.php';

$categoriaModel = new Categoria();
$categorias = $categoriaModel->listar();
$erro = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    validar_csrf();

    $titulo       = $_POST['titulo'];
    $descricao    = $_POST['descricao'];
    $preco        = $_POST['preco'];
    $imagem       = $_POST['imagem'];
    $categoria_id = $_POST['categoria_id'];
    $usuario_id   = $_SESSION['usuario_id'];

    $produtoModel = new Produto();
    $resultado = $produtoModel->criar($titulo, $descricao, $preco, $imagem, $usuario_id, $categoria_id);

    if ($resultado) {
        header("Location: listar.php");
        exit;
    } else {
        $erro = "Erro ao cadastrar produto.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Anunciar Produto - Marketplace</title>
    <link rel="stylesheet" href="../../public/style.css">
</head>
<body>

<nav>

    <a href="../../index.php" class="nav-brand">Marketplace</a>
    <ul class="nav-links">
        <li><a href="listar.php">Produtos</a></li>
        <li><a href="../categorias/listar.php">Categorias</a></li>
        <li><a href="../auth/logout.php">Sair</a></li>
    </ul>
    <span class="nav-user"> <?= htmlspecialchars($_SESSION['usuario_nome']) ?></span>
    
</nav>

<div class="container">
    <div class="breadcrumb">
        <a href="listar.php">Produtos</a>
        <span>›</span>
        Anunciar
    </div>

    <div class="form-card" style="max-width:600px">
        <h1>Anunciar Produto</h1>
        <p class="subtitle">Preencha as informações do seu produto</p>

        <?php if ($erro): ?>
            <div class="alert alert-error"><?= $erro ?></div>
        <?php endif; ?>

        <form method="POST">

            <?= campo_csrf() ?>

            <div class="form-group">
                <label>Título</label>
                <input type="text" name="titulo" placeholder="Ex: iPhone 14 Pro" required>
            </div>

            <div class="form-group">
                <label>Descrição</label>
                <textarea name="descricao" placeholder="Descreva o produto..." required></textarea>
            </div>

            <div class="form-group">
                <label>Preço (R$)</label>
                <input type="number" name="preco" step="0.01" min="0" placeholder="0,00" required>
            </div>

            <div class="form-group">
                <label>URL da Imagem (opcional)</label>
                <input type="text" name="imagem" placeholder="https://...">
            </div>

            <div class="form-group">
                <label>Categoria</label>
                <select name="categoria_id" required>

                    <option value="">Selecione uma categoria...</option>

                    <?php foreach ($categorias as $cat): ?>
                        <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['nome']) ?></option>
                    <?php endforeach; ?>

                </select>
            </div>
            <button type="submit" class="btn btn-primary form-submit">Publicar Anúncio</button>
        </form>
    </div>
</div>

<script src="../../public/aaa.js"></script>
</body>
</html>
