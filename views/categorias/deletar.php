<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../auth/login.php");
    exit;
}

require_once __DIR__ . '/../../models/Categoria.php';

$id = $_GET['id'] ?? null;

if ($id) {
    $categoriaModel = new Categoria();
    $resultado = $categoriaModel->deletar($id);

    if ($resultado === "vinculado") {
        header("Location: listar.php?erro=vinculado");
        exit;
    }
}

header("Location: listar.php");
exit;