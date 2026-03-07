<?php
Class Produto{
    public $idProduto;
    public $nomeProduto;
    public $precoProduto;
    public $descricaoProduto;
    public $quantidadeProduto;
    public $img;
    public $bd;

    public function __construct($bd){
        $this->bd = $bd;

    }
    public function lerTodos(){
        $sql = "SELECT * FROM produtos";
        $resultado = $this->bd->query($sql);
        $resultado->execute();

        return $resultado->fetchAll(PDO::FETCH_OBJ);
    }
    public function pesquisarProduto($tipo, $valor) {
        if ($tipo == 'id') {
            $sql = "SELECT * FROM produtos WHERE id_produto = :busca";
        } else if ($tipo == 'nome') {
            $sql = "SELECT * FROM produtos WHERE nome LIKE :busca";
            $valor = "%$valor%";
        } else {
            return null;
        }

        $resultado = $this->bd->prepare($sql);
        $resultado->bindParam(':busca', $valor);
        $resultado->execute();
        return $resultado->fetchAll(PDO::FETCH_OBJ);
    }

    public function cadastrarProduto(){
        $sql = "INSERT INTO produtos (nome, descricao, quantidade, preco) VALUES (:nome, :descricao, :quantidade, :preco)";
        $stmt = $this->bd->prepare($sql);

        $stmt->bindParam(":nome", $this->nomeProduto, PDO::PARAM_STR);
        $stmt->bindParam(":descricao", $this->descricaoProduto, PDO::PARAM_STR);
        $stmt->bindParam(":quantidade", $this->quantidadeProduto, PDO::PARAM_INT);
        $stmt->bindParam(":preco", $this->precoProduto);

        return $stmt->execute();
    }

    public function excluirProduto(){
        $sql = "DELETE FROM produtos WHERE id_produto = :id";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(":id", $this->idProduto, PDO::PARAM_INT);

        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function atualizarProduto(){
        $sql = "UPDATE produtos SET nome = :nome, descricao = :descricao, preco = :preco, quantidade= :quantidade WHERE id_produto = :id";

        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(":nome", $this->nomeProduto, PDO::PARAM_STR);
        $stmt->bindParam(":descricao", $this->descricaoProduto, PDO::PARAM_STR);
        $stmt->bindParam(":preco", $this->precoProduto, PDO::PARAM_STR);
        $stmt->bindParam(":quantidade", $this->quantidadeProduto, PDO::PARAM_INT);
        $stmt->bindParam(":id", $this->idProduto, PDO::PARAM_INT);

        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function buscarProduto($id){
        $sql = "SELECT * FROM produtos WHERE id_produto = :id";
        $resultado = $this->bd->prepare($sql);
        $resultado->bindParam(":id", $id);
        $resultado->execute();

        return $resultado->fetch(PDO::FETCH_OBJ);
    }
}