<?php

require_once "conexao.php";

class ModeloVendas
{
    /***********************************************
     * MOSTRAR VENDAS
     ***********************************************/
    public static function mdlMostrarVendas($tabela, $item, $valor)
    {
        if ($item != null) {

            $stmt = Conexao::conectar()->prepare("SELECT * FROM $tabela WHERE $item = :$item ORDER BY id ASC");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetch();
        } else {
            $stmt = Conexao::conectar()->prepare("SELECT * FROM $tabela ORDER BY id ASC");

            $stmt->execute();

            return $stmt->fetchAll();
        }

        $stmt->close();

        $stmt->null();
    }
    /***********************************************
     * CRIAR VENDA
     ***********************************************/
    public static function mdlCriarVenda($tabela, $dados)
    {
        $stmt = Conexao::conectar()->prepare("INSERT INTO $tabela(codigo, cliente_id, vendedor_id, produtos, acrescimo, subtotal, total) VALUES(:codigo, :cliente_id, :vendedor_id, :produtos, :acrescimo, :subtotal, :total)");
        $stmt->bindParam(":codigo", $dados["codigo"], PDO::PARAM_INT);
        $stmt->bindParam(":cliente_id", $dados["cliente_id"], PDO::PARAM_STR);
        $stmt->bindParam(":vendedor_id", $dados["vendedor_id"], PDO::PARAM_STR);
        $stmt->bindParam(":produtos", $dados["produtos"], PDO::PARAM_STR);
        $stmt->bindParam(":acrescimo", $dados["acrescimo"], PDO::PARAM_STR);
        $stmt->bindParam(":subtotal", $dados["subtotal"], PDO::PARAM_STR);
        $stmt->bindParam(":total", $dados["total"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt->close();

        $stmt->null();

    }
    /***********************************************
     * EDITAR VENDA
     ***********************************************/
    public static function mdlEditarVenda($tabela, $dados)
    {
        $stmt = Conexao::conectar()->prepare("UPDATE $tabela SET codigo = :codigo, cliente_id = :cliente_id, vendedor_id = :vendedor_id, produtos = :produtos, acrescimo =  :acrescimo, subtotal = :subtotal, total = :total WHERE codigo = :codigo");
        $stmt->bindParam(":codigo", $dados["codigo"], PDO::PARAM_INT);
        $stmt->bindParam(":cliente_id", $dados["cliente_id"], PDO::PARAM_STR);
        $stmt->bindParam(":vendedor_id", $dados["vendedor_id"], PDO::PARAM_STR);
        $stmt->bindParam(":produtos", $dados["produtos"], PDO::PARAM_STR);
        $stmt->bindParam(":acrescimo", $dados["acrescimo"], PDO::PARAM_STR);
        $stmt->bindParam(":subtotal", $dados["subtotal"], PDO::PARAM_STR);
        $stmt->bindParam(":total", $dados["total"], PDO::PARAM_STR);


        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt->close();

        $stmt->null();

    }


    /***********************************************
     * EXCLUIR VENDA
     ***********************************************/

    public static function mdlExcluirVenda($tabela, $dados)
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

    public static function mdlSomaTotaldeVendas($tabela)
    {
        $stmt = Conexao::conectar()->prepare("SELECT SUM(total) as total FROM $tabela");

        $stmt->execute();

        return $stmt->fetch();

        $stmt->close();

        $stmt->null;

    }
}

