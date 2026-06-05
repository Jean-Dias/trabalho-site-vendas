<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../auth/login.php");
    exit;
}

require_once __DIR__ . '/../../models/Produto.php';

$id = $_GET['id'] ?? null;
if ($id) {
    $produtoModel = new Produto();
    $produtoModel->deletar($id);
}

header("Location: listar.php");
exit;
