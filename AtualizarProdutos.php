<?php
include_once("objetos/ProdutoController.php");
$controller = new ProdutoController();

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['alterar'])) {
    $a = $controller->localizarProduto($_GET['alterar']);
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['produto'])) {
    $controller->atualizarProduto($_POST['produto'],$_FILES["produto"]);
    header("Location: index.php");
    exit;
} else {
    header("Location: index.php");
    exit;
}
?>

<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Atualização de Produto</title>
</head>
<body>
<h1>Atualização de Produto</h1>
<a href="index.php">Voltar</a>

<form action="AtualizarProdutos.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="produto[id]" value="<?= $a->id_produto ?>">
    <label>Nome</label>
    <input type="text" name="produto[nome]" value="<?= $a->nome ?>"><br><br>
    <label>Descrição</label>
    <input type="text" name="produto[descricao]" value="<?= $a->descricao ?>"><br><br>
    <label>Quantidade</label>
    <input type="number" name="produto[quantidade]" value="<?= $a->quantidade ?>" min="1" step="1"><br><br>
    <label>Preço</label>
    <input type="number" name="produto[preco]" value="<?= $a->preco ?>" min="0" step="0.01"><br><br>
    <?php if($a->imagem== "") : ?>
        <td><img style="width: 20%;" src="Imagens/image-fail.png"></td>
    <?php else : ?>
        <td><img style="width: 20%;" src="uploads/<?= $a->imagem; ?>"</td>
    <?php endif; ?><br>
    <label for="fileToUpload">Selecionar Foto</label>

    <input type="file" name="produto[fileToUpload]" id="fileToUpload" value="<?= $a->img ?>"><br><br>
    <button name="atualizar">Atualizar</button>
</form>
</body>
</html>