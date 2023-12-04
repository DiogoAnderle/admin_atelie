<?php

require_once "conexao.php";

class ModeloClientes
{
    /*==================================
        CADASTRAR CLIENTES
    ==================================*/
    public static function mdlCriarClientes($tabela, $dados)
    {
        $stmt = Conexao::conectar()->prepare(
            "INSERT INTO  $tabela(nome, telefone, email, profissao, data_nascimento) 
            VALUES(:nome, :telefone, :email, :profissao, :data_nascimento)"
        );

        $stmt->bindParam(":nome", $dados["nome"], PDO::PARAM_STR);
        $stmt->bindParam(":telefone", $dados["telefone"], PDO::PARAM_STR);
        $stmt->bindParam(":email", $dados["email"], PDO::PARAM_STR);
        $stmt->bindParam(":profissao", $dados["profissao"], PDO::PARAM_STR);
        $stmt->bindParam(":data_nascimento", $dados["data_nascimento"], PDO::PARAM_STR);

        echo json_encode($stmt);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt->close();

        $stmt->null();

    }

    public static function mdlMostrarClientes($tabela, $item, $valor)
    {
        if ($item != null) {

            $stmt = Conexao::conectar()->prepare("SELECT * FROM  $tabela WHERE $item = :$item");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_INT);

            $stmt->execute();

            return $stmt->fetch();
        } else {

            $stmt = Conexao::conectar()->prepare("SELECT * FROM  $tabela");

            $stmt->execute();

            return $stmt->fetchAll();
        }

        $stmt->close();

        $stmt->null();
    }

    public static function mdlEditarCliente($tabela, $dados)
    {
        $stmt = Conexao::conectar()->prepare(
            "UPDATE $tabela SET nome = :nome, telefone = :telefone, email = :email, profissao = :profissao, data_nascimento = :data_nascimento WHERE id = :id"
        );

        $stmt->bindParam(":id", $dados["id"], PDO::PARAM_INT);
        $stmt->bindParam(":nome", $dados["nome"], PDO::PARAM_STR);
        $stmt->bindParam(":telefone", $dados["telefone"], PDO::PARAM_STR);
        $stmt->bindParam(":email", $dados["email"], PDO::PARAM_STR);
        $stmt->bindParam(":profissao", $dados["profissao"], PDO::PARAM_STR);
        $stmt->bindParam(":data_nascimento", $dados["data_nascimento"], PDO::PARAM_STR);

        echo json_encode($stmt);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt->close();

        $stmt->null();

    }

    public static function mdlExcluirCliente($tabela, $dados)
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