<?php
require_once "conexao.php";

class ModelProdutos
{


    /*==============================================
                Mostrar Produtos
    ==============================================*/
    public static function mdlMostrarProdutos($tabela, $item, $valor)
    {

        if ($item != null) {

            $stmt = Conexao::conectar()->prepare("SELECT * FROM $tabela WHERE $item = :$item ORDER BY id DESC");
            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();

        } else {

            $stmt = Conexao::conectar()->prepare("SELECT * FROM $tabela");
            $stmt->execute();
            return $stmt->fetchAll();


        }
        $stmt->close();
        $stmt = null;

    }


    /*==============================================
                Cadastrar Produto
    ==============================================*/
    public static function mdlCadastrarProduto($tabela, $dados)
    {

        $stmt = Conexao::conectar()->prepare(
            "INSERT INTO $tabela(categoria_id, codigo, descricao, imagem, estoque, preco_compra, preco_venda) VALUES(:categoria_id, :codigo, :descricao, :imagem, :estoque, :preco_compra, :preco_venda)"
        );

        $stmt->bindParam(":categoria_id", $dados["categoria_id"], PDO::PARAM_INT);
        $stmt->bindParam(":codigo", $dados["codigo"], PDO::PARAM_STR);
        $stmt->bindParam(":descricao", $dados["descricao"], PDO::PARAM_STR);
        $stmt->bindParam(":imagem", $dados["imagem"], PDO::PARAM_STR);
        $stmt->bindParam(":estoque", $dados["estoque"], PDO::PARAM_STR);
        $stmt->bindParam(":preco_compra", $dados["preco_compra"], PDO::PARAM_STR);
        $stmt->bindParam(":preco_venda", $dados["preco_venda"], PDO::PARAM_STR);

        echo json_encode($stmt);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt->close();

        $stmt->null();

    }

    /*==============================================
             Editar Produto
 ==============================================*/
    public static function mdlEditarProduto($tabela, $dados)
    {

        $stmt = Conexao::conectar()->prepare(
            "UPDATE $tabela SET categoria_id = :categoria_id, codigo = :codigo, descricao = :descricao, imagem = :imagem, estoque = :estoque, preco_compra = :preco_compra, preco_venda = :preco_venda WHERE codigo = :codigo"
        );

        $stmt->bindParam(":categoria_id", $dados["categoria_id"], PDO::PARAM_INT);
        $stmt->bindParam(":codigo", $dados["codigo"], PDO::PARAM_STR);
        $stmt->bindParam(":descricao", $dados["descricao"], PDO::PARAM_STR);
        $stmt->bindParam(":imagem", $dados["imagem"], PDO::PARAM_STR);
        $stmt->bindParam(":estoque", $dados["estoque"], PDO::PARAM_STR);
        $stmt->bindParam(":preco_compra", $dados["preco_compra"], PDO::PARAM_STR);
        $stmt->bindParam(":preco_venda", $dados["preco_venda"], PDO::PARAM_STR);

        echo json_encode($stmt);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt->close();

        $stmt->null();
    }

    /*==============================================
         Excluir Produto
    ==============================================*/
    public static function mdlExcluirProduto($tabela, $dados)
    {
        $stmt = Conexao::conectar()->prepare("DELETE FROM $tabela WHERE id = :id");

        $stmt->bindParam(":id", $dados, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt->close();

        $stmt->null();

    }
}
