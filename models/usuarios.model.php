<?php

require_once "conexao.php";
class ModeloUsuarios
{
    /*==================================
            MOSTRAR USUÁRIOS
    ==================================*/
    public static function mdlMostrarUsuarios($tabela, $item, $valor)
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

        $stmt->null();
    }
    /* ********************************* 
           Cadastrar Usuário
   ********************************* */

    public static function mdlCriarUsuario($tabela, $dados)
    {

        $stmt = Conexao::conectar()
            ->prepare("INSERT INTO 
            $tabela(nome, usuario, senha, perfil, estado, ultimo_login, imagem) 
            VALUES(:nome, :usuario, :senha, :perfil, 1, null, :imagem)");

        $stmt->bindParam(":nome", $dados["nome"], PDO::PARAM_STR);
        $stmt->bindParam(":usuario", $dados["usuario"], PDO::PARAM_STR);
        $stmt->bindParam(":senha", $dados["senha"], PDO::PARAM_STR);
        $stmt->bindParam(":perfil", $dados["perfil"], PDO::PARAM_STR);
        $stmt->bindParam(":imagem", $dados["imagem"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt->close();

        $stmt->null();
    }

    /* ********************************* 
           Editar Usuário
   ********************************* */
    public static function mdlEditarUsuario($tabela, $dados)
    {
        $stmt = Conexao::conectar()
            ->prepare("UPDATE $tabela
        SET nome = :nome, senha = :senha, perfil = :perfil, imagem = :imagem 
        WHERE usuario = :usuario");

        $stmt->bindParam(":nome", $dados["nome"], PDO::PARAM_STR);
        $stmt->bindParam(":senha", $dados["senha"], PDO::PARAM_STR);
        $stmt->bindParam(":perfil", $dados["perfil"], PDO::PARAM_STR);
        $stmt->bindParam(":imagem", $dados["imagem"], PDO::PARAM_STR);

        $stmt->bindParam(":usuario", $dados["usuario"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {

            return "error";
        }

        $stmt->close();

        $stmt->null();
    }

    /* ********************************* 
            Atualizar Usuário
    ********************************* */
    static public function mdlAtualizarUsuario($tabela, $item1, $valor1, $item2, $valor2)
    {

        $stmt = Conexao::conectar()->prepare("UPDATE $tabela SET $item1 = :$item1 WHERE $item2 = :$item2");

        $stmt->bindParam(":" . $item1, $valor1, PDO::PARAM_STR);
        $stmt->bindParam(":" . $item2, $valor2, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {

            return "error";
        }

        $stmt->close();

        $stmt->null();

    }


    /* ********************************* 
            Excluir Usuário
    ********************************* */
    static public function mdlExcluirUsuario($tabela, $dados)
    {

        $stmt = Conexao::conectar()->prepare("DELETE FROM $tabela WHERE id = :id");

        $stmt->bindParam(":id", $dados, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {

            return "error";
        }

        $stmt->close();

        $stmt->null();

    }





}