<?php

class ControllerCategorias
{


    /*==================================
            CADASTRAR CATEGORIAS
    ==================================*/
    public static function ctrCriarCategoria()
    {

        if (isset ($_POST["novaCategoria"])) {
            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚçÇãõÃÕ ]+$/', $_POST["novaCategoria"])) {

                $tabela = "categorias";

                $dados = $_POST["novaCategoria"];

                $resposta = ModeloCategorias::mdlCriarCategoria($tabela, $dados);
                if ($resposta == 'ok') {
                    echo "<script>

                    Swal.fire({
                        icon: 'success',
                        title: 'Categoria cadastrada com sucesso',
                        confirmButtonText: 'Fechar',

                    }).then((result) => {
                        if(result.value){
                            window.location = 'categorias';}
                    });
                
                    </script>";
                }

            } else {
                echo "<script>

                    Swal.fire({
                        icon: 'error',
                        title: 'Algo deu errado!',
                        text: 'Categoria não pode estar vazio ou conter caracteres especiais.',
                        confirmButtonText: 'Fechar',

                    }).then((result) => {
                        if(result.value){
                            window.location = 'categorias';}
                    });
                
                    </script>";
            }
        }

    }

    /*==================================
            MOSTRAR CATEGORIAS
    ==================================*/
    public static function ctrMostrarCategorias($item, $valor)
    {

        $tabela = 'categorias';

        $resposta = ModeloCategorias::mdlMostrarCategorias($tabela, $item, $valor);

        return $resposta;

    }
    /*==================================
                EDITAR CATEGORIAS
        ==================================*/
    public static function ctrEditarCategoria()
    {

        if (isset ($_POST["editarCategoria"])) {
            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚçÇãõÃÕ ]+$/', $_POST["editarCategoria"])) {

                $tabela = "categorias";

                $dados = array(
                    "categoria" => $_POST["editarCategoria"],
                    "id" => $_POST["idCategoria"]
                );

                $response = ModeloCategorias::mdlEditarCategoria($tabela, $dados);

                if ($response == 'ok') {
                    echo
                        "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Categoria atualizada com sucesso',
                            confirmButtonText: 'Fechar'
                        }).then(function(result){
                            if(result.value){
                                window.location = 'categorias';}
                        });
                    </script>";
                }

            } else {
                echo
                    "<script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Algo deu errado!',
                            text: 'Categoria não pode estar vazio ou conter caracteres especiais.',
                            confirmButtonText: 'Fechar'
                        }).then((result) => {
                            if(result.value){
                                window.location = 'categorias';}
                        });
                
                    </script>";
            }
        }

    }

    /*==================================
            EXCLUIR CATEGORIAS
    ==================================*/

    public static function ctrExcluirCategorias()
    {
        if (isset ($_GET["idCategoria"])) {

            $tabela = "categorias";
            $dados = $_GET["idCategoria"];

            $tabelaProdutos = "produtos";
            $item = "categoria_id";
            $ordem = "id";

            $consultaProdutosCategoria = ModelProdutos::mdlMostrarProdutos($tabelaProdutos, $item, $dados, $ordem);

            if (!$consultaProdutosCategoria) {

                $response = ModeloCategorias::mdlExcluirCategoria($tabela, $dados);

                if ($response == 'ok') {
                    echo
                        "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Categoria deletada com sucesso',
                            confirmButtonText: 'Fechar'
                        }).then(function(result){
                            if(result.value){
                                window.location = 'categorias';}
                        });
                    </script>";
                }
            } else {
                echo
                    "<script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops, algo deu errado!',
                            text: 'Não é possível excluir uma categoria com produtos vinculados.',
                            confirmButtonText: 'Fechar'
                        }).then(function(result){
                            if(result.value){
                                window.location = 'categorias';}
                        });
                    </script>";
            }




        }
    }



}