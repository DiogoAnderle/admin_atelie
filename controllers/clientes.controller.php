<?php

class ControllerClientes
{

    /*==================================
            CADASTRAR CLIENTE
    ==================================*/
    public static function ctrCriarCliente()
    {
        if (isset($_POST["novoCliente"])) {
            if (
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚçÇãõÃÕ ]+$/', $_POST["novoCliente"]) &&
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚçÇãõÃÕ ]+$/', $_POST["novaProfissao"])
            ) {
                $tabela = 'clientes';

                $dados = array(
                    "nome" => $_POST["novoCliente"],
                    "telefone" => $_POST["novoTelefone"],
                    "email" => $_POST["novoEmail"],
                    "profissao" => $_POST["novaProfissao"],
                    "data_nascimento" => $_POST["novaDataNascimento"],
                );

                $resposta = ModeloClientes::mdlCriarClientes($tabela, $dados);

                if ($resposta == 'ok') {
                    echo "<script>

                    Swal.fire({
                        icon: 'success',
                        title: 'Cliente cadastrado com sucesso',
                        confirmButtonText: 'Fechar',

                    }).then((result) => {
                        if(result.value){
                            window.location = 'clientes';}
                    });
                
                    </script>";
                }

            } else {

                echo "<script>

                    Swal.fire({
                        icon: 'error',
                        title: 'Algo deu errado!',
                        text: 'Cliente não pode estar vazio ou conter caracteres especiais.',
                        confirmButtonText: 'Fechar',

                    }).then((result) => {
                        if(result.value){
                            window.location = 'clientes';}
                    });
                
                    </script>";

            }

        }
    }
    /*==================================
            MOSTRAR CLIENTES
    ==================================*/
    public static function ctrMostrarClientes($item, $valor)
    {
        $tabela = 'clientes';

        $resposta = ModeloClientes::mdlMostrarClientes($tabela, $item, $valor);

        return $resposta;
    }

    /*==================================
        EDITAR CLIENTE
==================================*/
    public static function ctrEditarCliente()
    {
        if (isset($_POST["editarCliente"])) {
            if (
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚçÇãõÃÕ ]+$/', $_POST["editarCliente"]) &&
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚçÇãõÃÕ ]+$/', $_POST["editarProfissao"])
            ) {
                $tabela = 'clientes';

                $dados = array(
                    "id" => $_POST["idCliente"],
                    "nome" => $_POST["editarCliente"],
                    "telefone" => $_POST["editarTelefone"],
                    "email" => $_POST["editarEmail"],
                    "profissao" => $_POST["editarProfissao"],
                    "data_nascimento" => $_POST["editarDataNascimento"],
                );

                $resposta = ModeloClientes::mdlEditarCliente($tabela, $dados);

                if ($resposta == 'ok') {
                    echo "<script>

                    Swal.fire({
                        icon: 'success',
                        title: 'Cliente atualizado com sucesso',
                        confirmButtonText: 'Fechar',

                    }).then((result) => {
                        if(result.value){
                            window.location = 'clientes';}
                    });
                
                    </script>";
                }

            } else {

                echo "<script>

                    Swal.fire({
                        icon: 'error',
                        title: 'Algo deu errado!',
                        text: 'Cliente não pode estar vazio ou conter caracteres especiais.',
                        confirmButtonText: 'Fechar',

                    }).then((result) => {
                        if(result.value){
                            window.location = 'clientes';}
                    });
                
                    </script>";

            }

        }
    }

    /*==================================
    EDITAR CLIENTE
==================================*/
    public static function ctrExcluirCliente()
    {
        if (isset($_GET["idCliente"])) {

            $tabela = "clientes";
            $dados = $_GET["idCliente"];

            $resposta = ModeloClientes::mdlExcluirCliente($tabela, $dados);

            if ($resposta == 'ok') {
                echo "<script>

                    Swal.fire({
                        icon: 'success',
                        title: 'Cliente excluído com sucesso',
                        confirmButtonText: 'Fechar',

                    }).then((result) => {
                        if(result.value){
                            window.location = 'clientes';}
                    });
                
                    </script>";
            }
        }
    }

}
