<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../auth/login.php");
    exit;
}

require_once __DIR__ . '/../../models/Categoria.php';
require_once __DIR__ . '/../../config/helpers.php';

$id = $_GET['id'] ?? null;
if (!$id) { header("Location: listar.php"); exit; }

$categoriaModel = new Categoria();
$categoria = $categoriaModel->buscarPorId($id);
$erro = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    validar_csrf();

    $nome = $_POST['nome'];
    $resultado = $categoriaModel->atualizar($id, $nome);

    if ($resultado) {
        header("Location: listar.php");
        exit;
    } else {
        $erro = "Erro ao atualizar categoria.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Categoria - Marketplace</title>
    <link rel="stylesheet" href="../../public/style.css">
</head>
<body>

<nav>
    <a href="../../index.php" class="nav-brand">🛒 Marketplace</a>
    <ul class="nav-links">
        <li><a href="../produtos/listar.php">Produtos</a></li>
        <li><a href="listar.php">Categorias</a></li>
        <li><a href="../auth/logout.php">Sair</a></li>
    </ul>
    <span class="nav-user"><?= htmlspecialchars($_SESSION['usuario_nome']) ?></span>
</nav>

<div class="container">
    <div class="breadcrumb">
        <a href="listar.php">Categorias</a>
        <span>›</span>
        Editar
    </div>

    <div class="form-card">
        <h1>Editar Categoria </h1>
        <p class="subtitle">Atualize o nome da categoria</p>

        <?php if ($erro): ?>
            <div class="alert alert-error"><?= $erro ?></div>
        <?php endif; ?>

        <form method="POST">
            <?= campo_csrf() ?>
            <div class="form-group">
                <label>Nome da Categoria</label>
                <input type="text" name="nome" value="<?= htmlspecialchars($categoria['nome']) ?>" required>
            </div>
            <button type="submit" class="btn btn-primary form-submit">Salvar Alterações</button>
        </form>

        <div class="form-footer">
            <a href="listar.php">← Voltar para categorias</a>
        </div>
    </div>
</div>

<script src="../../public/aaa.js"></script>
</body>
</html>
