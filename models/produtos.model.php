<?php
require_once "conexao.php";

class ModelProdutos
{


    /*==============================================
                Mostrar Produtos
    ==============================================*/
    public static function mdlMostrarProdutos($tabela, $item, $valor, $ordem)
    {

        if ($item != null) {

            $stmt = Conexao::conectar()->prepare("SELECT * FROM $tabela WHERE $item = :$item ORDER BY $ordem DESC");
            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();

        } else {

            $stmt = Conexao::conectar()->prepare("SELECT * FROM $tabela ORDER BY $ordem DESC");
            $stmt->execute();
            return $stmt->fetchAll();


        }


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

    }
    /* ********************************* 
            Atualizar Produto
    ********************************* */
    static public function mdlAtualizarProduto($tabela, $item1, $valor1, $valor)
    {

        $stmt = Conexao::conectar()->prepare("UPDATE $tabela SET $item1 = :$item1 WHERE id = :id");

        $stmt->bindParam(":" . $item1, $valor1, PDO::PARAM_STR);
        $stmt->bindParam(":id", $valor, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {

            return "error";
        }


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


    }

    public static function mdlMostrarSomaVendas($tabela)
    {
        $stmt = Conexao::conectar()->prepare("SELECT SUM(vendas) AS total FROM $tabela");
        $stmt->execute();

        return $stmt->fetch();
    }
}
