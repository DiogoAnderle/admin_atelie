<?php

require_once "conexao.php";

class ModeloCategorias
{

    /*==================================
            CADASTRAR CATEGORIAS
    ==================================*/
    public static function mdlCriarCategoria($tabela, $dados)
    {
        $stmt = Conexao::conectar()->prepare("INSERT INTO $tabela(categoria) VALUES(:categoria)");

        $stmt->bindParam(":categoria", $dados, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt->close();

        $stmt->null();
    }

    /*==================================
            MOSTRAR CATEGORIAS
    ==================================*/
    public static function mdlMostrarCategorias($tabela, $item, $valor)
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

        $stmt->close();

        $stmt = null;

    }

    /*==================================
         EDITAR CATEGORIAS
     ==================================*/
    public static function mdlEditarCategoria($tabela, $dados)
    {
        $stmt = Conexao::conectar()->prepare(
            "UPDATE $tabela 
                SET categoria = :categoria 
                WHERE id = :id"
        );

        $stmt->bindParam(":categoria", $dados["categoria"], PDO::PARAM_STR);
        $stmt->bindParam(":id", $dados["id"], PDO::PARAM_INT);



        if ($stmt->execute()) {
            return "ok";

        } else {

            return "error";

        }

        $stmt->close();

        $stmt = null;

    }

    public static function mdlExcluirCategoria($tabela, $dados)
    {
        $stmt = Conexao::conectar()->prepare("DELETE FROM $tabela WHERE id = :id");
        $stmt->bindParam(":id", $dados, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";

        } else {

            return "error";

        }

        $stmt->close();

        $stmt = null;


    }










}