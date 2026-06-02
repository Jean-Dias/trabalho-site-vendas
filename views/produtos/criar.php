<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../auth/login.php");
    exit;
}

require_once __DIR__ . '/../../models/Produto.php';
require_once __DIR__ . '/../../config/database.php';

$database = new Database();
$conn = $database->conectar();
$categorias = $conn->query("SELECT * FROM categorias")->fetch_all(MYSQLI_ASSOC);

$mensagem = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $titulo       = $_POST['titulo'];
    $descricao    = $_POST['descricao'];
    $preco        = $_POST['preco'];
    $imagem       = $_POST['imagem'];
    $categoria_id = $_POST['categoria_id'];
    $usuario_id   = $_SESSION['usuario_id'];

    $produtoModel = new Produto();

    $resultado = $produtoModel->criar(
        $titulo,
        $descricao,
        $preco,
        $imagem,
        $usuario_id,
        $categoria_id
    );

    if ($resultado) {
        header("Location: listar.php");
        exit;
    } else {
        $mensagem = "Erro ao cadastrar produto.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Produto - Marketplace</title>
</head>
<body>

<h1>Cadastrar Produto</h1>

<a href="listar.php">Voltar para produtos</a>

<hr>

<?php if ($mensagem): ?>
    <p><?= $mensagem ?></p>
<?php endif; ?>

<form method="POST">

    <label>Título:</label><br>
    <input type="text" name="titulo" required><br><br>

    <label>Descrição:</label><br>
    <textarea name="descricao" required></textarea><br><br>

    <label>Preço:</label><br>
    <input type="number" name="preco" step="0.01" min="0" required><br><br>

    <label>Imagem (URL):</label><br>
    <input type="text" name="imagem"><br><br>

    <label>Categoria:</label><br>
    <select name="categoria_id" required>
        <option value="">Selecione...</option>
        <?php foreach ($categorias as $categoria): ?>
            <option value="<?= $categoria['id'] ?>"><?= htmlspecialchars($categoria['nome']) ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <button type="submit">Cadastrar</button>

</form>

</body>
</html>