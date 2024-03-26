<?php

require_once "conexao.php";

class ModeloFornecedores
{

    /*==================================
            CADASTRAR CATEGORIAS
    ==================================*/
    public static function mdlCriarFornecedor($tabela, $dados)
    {
        $stmt = Conexao::conectar()->prepare("INSERT INTO $tabela(nome) VALUES(:fornecedor)");

        $stmt->bindParam(":fornecedor", $dados, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
    }

    /*==================================
    
            MOSTRAR FORNECEDORES
    ==================================*/

    public static function mdlMostrarFornecedores($tabela, $item, $valor)
    {

        if ($item != null) {
            $stmt = Conexao::conectar()->prepare("SELECT * FROM $tabela WHERE $item = :$item");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetch();

        } else {

            $stmt = Conexao::conectar()->prepare("SELECT * FROM $tabela");

            $stmt->execute();

            return $stmt->fetchAll();
        }

    }

    /*==================================
         EDITAR CATEGORIAS
     ==================================*/
    public static function mdlEditarFornecedor($tabela, $dados)
    {
        $stmt = Conexao::conectar()->prepare(
            "UPDATE $tabela 
                SET nome = :nome 
                WHERE id = :id"
        );

        $stmt->bindParam(":nome", $dados["nome"], PDO::PARAM_STR);
        $stmt->bindParam(":id", $dados["id"], PDO::PARAM_INT);



        if ($stmt->execute()) {
            return "ok";

        } else {

            return "error";

        }

    }

    public static function mdlExcluirFornecedor($tabela, $dados)
    {
        $stmt = Conexao::conectar()->prepare("DELETE FROM $tabela WHERE id = :id");
        $stmt->bindParam(":id", $dados, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";

        } else {

            return "error";

        }


    }

}