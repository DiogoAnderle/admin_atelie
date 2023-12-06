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

}

