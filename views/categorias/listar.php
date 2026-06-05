<?php
session_start();
require_once __DIR__ . '/../../models/Categoria.php';

$categoriaModel = new Categoria();
$categorias = $categoriaModel->listar();
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Categorias - Marketplace</title>
    <link rel="stylesheet" href="../../public/style.css">
</head>
<body>

<nav>
    <a href="../../index.php" class="nav-brand">Marketplace</a>
    <ul class="nav-links">
        <li><a href="../produtos/listar.php">Produtos</a></li>
        <li><a href="listar.php">Categorias</a></li>

        <?php if (isset($_SESSION['usuario_id'])): ?>

            <li><a href="criar.php">Nova Categoria</a></li>
            <li><a href="../auth/logout.php">Sair</a></li>

        <?php else: ?>
            <li><a href="../auth/login.php">Login</a></li>
        <?php endif; ?>

    </ul>
</nav>

<div class="container">

    <?php if (isset($_GET['erro'])): ?>
        <div class="alert alert-error">Não é possível deletar esta categoria pois ela possui produtos vinculados.</div>
    <?php endif; ?>

    <div class="page-header">
        <h1>Categorias</h1>
        <?php if (isset($_SESSION['usuario_id'])): ?>
            <a href="criar.php" class="btn btn-primary">+ Nova Categoria</a>
        <?php endif; ?>
    </div>

    <?php if (empty($categorias)): ?>
        <p>Nenhuma categoria cadastrada.</p>
    <?php else: ?>
        
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <?php if (isset($_SESSION['usuario_id'])): ?><th>Ações</th><?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categorias as $categoria): ?>
                        <tr>
                            <td><?= $categoria['id'] ?></td>
                            <td><?= htmlspecialchars($categoria['nome']) ?></td>
                            <?php if (isset($_SESSION['usuario_id'])): ?>
                                <td>
                                    <a href="editar.php?id=<?= $categoria['id'] ?>" class="btn btn-outline btn-sm">Editar</a>
                                    <a href="deletar.php?id=<?= $categoria['id'] ?>" class="btn btn-danger btn-sm"
                                       onclick="return confirm('Deletar?')">Deletar</a>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>

</div>

<script src="../../public/aaa.js"></script>
</body>
</html>