<?php

require_once "conexao.php";

class ModeloVendas
{
    public static function mdlMostrarVendas($tabela, $item, $valor)
    {
        if ($item != null) {

            $stmt = Conexao::conectar()->prepare("SELECT * FROM $tabela WHERE $item = :$item ORDER BY data_venda DESC");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetch();
        } else {
            $stmt = Conexao::conectar()->prepare("SELECT * FROM $tabela ORDER BY data_venda DESC");

            $stmt->execute();

            return $stmt->fetchAll();
        }

        $stmt->close();

        $stmt->null();
    }

    public static function mdlCriarVenda($tabela, $dados)
    {
        $stmt = Conexao::conectar()->prepare("INSERT INTO $tabela(codigo, cliente_id, vendedor_id, produtos, acrescimo, subtotal, total, metodo_pagamento) VALUES(:codigo, :cliente_id, :vendedor_id, :produtos, :acrescimo, :subtotal, :total, :metodo_pagamento)");
        $stmt->bindParam(":codigo", $dados["codigo"], PDO::PARAM_INT);
        $stmt->bindParam(":cliente_id", $dados["cliente_id"], PDO::PARAM_STR);
        $stmt->bindParam(":vendedor_id", $dados["vendedor_id"], PDO::PARAM_STR);
        $stmt->bindParam(":produtos", $dados["produtos"], PDO::PARAM_STR);
        $stmt->bindParam(":acrescimo", $dados["acrescimo"], PDO::PARAM_STR);
        $stmt->bindParam(":subtotal", $dados["subtotal"], PDO::PARAM_STR);
        $stmt->bindParam(":total", $dados["total"], PDO::PARAM_STR);
        $stmt->bindParam(":metodo_pagamento", $dados["metodo_pagamento"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt->close();

        $stmt->null();

    }

}

