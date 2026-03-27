<?php
include_once "objetos/ProdutoController.php";

$controller = new ProdutoController();
$produtos = $controller->index();
global $produtos;
$a = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST["pesquisar"])){
        $a = $controller->pesquisarProduto($_POST["tipo"], $_POST["pesquisar"]);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if(isset($_GET["excluir"])){
        $a = $controller->excluirProduto($_GET["excluir"]);
    }
}

?>

<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Loja</title>
    <style>
        table,tr,td{
            border: 1px solid black;
            /*border-collapse: collapse;*/
        }
    </style>
</head>
<body>

<h1>Loja do LUFE</h1>
<a href="CadastroProdutos.php">Cadastrar produto</a>
<h3>Pesquisar Produto</h3>
<form method="POST" action="index.php">
    <label>Pesquise:</label>
    <input type="text" name="pesquisar">
    <select name="tipo">
        <option value="id">ID</option>
        <option value="nome">Nome</option>
    </select>
    <button>Pesquisar</button>
</form>
<table>
    <tr>
        <td>ID</td>
        <td>Nome</td>
        <td>Preço</td>
    </tr>
    <?php if($a):?>
    <?php foreach($a as $produto):?>
        <tr>
            <td><a href="ver-produto.php?id= <?= $produto->id_produto; ?>"><?= $produto->id_produto; ?></a></td>
            <td><a href="ver-produto.php?id= <?= $produto->id_produto; ?>"><?= $produto->nome; ?></a></td>
            <td><a href="ver-produto.php?id= <?= $produto->id_produto; ?>"><?= $produto->preco; ?></a></td>
        </tr>
    <?php endforeach;?>
    <?php endif;?>
</table>
<h2>Produtos cadastrados</h2>

<table>
    <tr>
        <td>ID</td>
        <td>Nome</td>
        <td>Descrição</td>
        <td>Quantidade</td>
        <td>Preço</td>
    </tr>
    <?php if($produtos) : ?>
        <?php foreach($produtos as $produto) : ?>
            <tr>
                <td><a href="ver-produto.php?id= <?= $produto->id_produto; ?>"><?= $produto->id_produto; ?></a></td>
                <td><a href="ver-produto.php?id= <?= $produto->id_produto; ?>"><?= $produto->nome; ?></a></td>
                <td><a href="ver-produto.php?id= <?= $produto->id_produto; ?>"><?= $produto->descricao; ?></a></td>
                <td><a href="ver-produto.php?id= <?= $produto->id_produto; ?>"><?= $produto->quantidade; ?></a></td>
                <td><a href="ver-produto.php?id= <?= $produto->id_produto; ?>"><?= $produto->preco; ?></a></td>

                <td><a href="AtualizarProdutos.php?alterar=<?= $produto->id_produto ?>">Alterar</a></td>
                <td><a href="index.php?excluir=<?= $produto->id_produto ?>">Excluir</a></td>
                <td><a href="ver-produto.php?id=<?= $produto->id_produto ?>">Visualizar</a></td>
            </tr>
        <?php endforeach; ?>
    <?php endif;?>
</table>

</body>
</html>