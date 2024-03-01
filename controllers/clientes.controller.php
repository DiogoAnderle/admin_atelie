<?php

class ControllerClientes
{

    /*==================================
            CADASTRAR CLIENTE
    ==================================*/
    public static function ctrCriarCliente()
    {
        $dadosTemp = @array(
            "nome" => $_POST["novoCliente"],
            "telefone" => $_POST["novoTelefone"],
            "email" => $_POST["novoEmail"],
            "profissao" => $_POST["novaProfissao"],
            "data_nascimento" => $_POST["novaDataNascimento"],
        );

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

                if ($_POST["novaDataNascimento"] == null || $_POST["novaDataNascimento" == '']) {
                    $dados["data_nascimento"] = null;
                }
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

                echo "
                    <script>

                        let nomeCliente = document.getElementById('novoCliente');
                        let telefoneCliente = document.getElementById('novoTelefone');
                        let emailCliente = document.getElementById('novoEmail');
                        let profissaoCliente = document.getElementById('novaProfissao');
                        let dataNascimentoCliente = document.getElementById('novaDataNascimento');
                        
                        Swal.fire({
                            icon: 'error',
                            title: 'Ops! Algo deu errado!',
                            text: 'Nome ou Profissão não informados.',
                            confirmButtonText: 'Fechar',

                        }).then((result) => {
                            if(result.value){
                                let btnCadastrar = document.getElementById('btnCadastrarCliente');
                                btnCadastrar.click();
                                mensagem = '';
                            }
                        })

                        nomeCliente.value = " . "\"" . ($dadosTemp['nome']) . "\"" . "
                        telefoneCliente.value = " . "\"" . ($dadosTemp['telefone']) . "\"" . "
                        emailCliente.value = " . "\"" . ($dadosTemp['email']) . "\"" . "
                        profissaoCliente.value = " . "\"" . ($dadosTemp['profissao']) . "\"" . "
                        dataNascimentoCliente.value = " . "\"" . ($dadosTemp['data_nascimento']) . "\"" . "

                        if(nomeCliente.value == ''){
                            nomeCliente.classList.toggle('vermelho')
                        }
                        if(profissaoCliente.value == ''){
                            profissaoCliente.classList.toggle('vermelho')
                        }

                    </script>";
            }
            echo 'h1' . json_encode($dadosTemp) . '</h1>';
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
            $dadosTemp = @array(
                "nome" => $_POST["editarCliente"],
                "telefone" => $_POST["editarTelefone"],
                "email" => $_POST["editarEmail"],
                "profissao" => $_POST["editarProfissao"],
                "data_nascimento" => $_POST["editarDataNascimento"],
            );
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
                        text: 'Nome ou Profissão não informados!',
                        confirmButtonText: 'Fechar',

                    })
                      const idUsuario = document.querySelector(" . "\"[idCliente='" . strval($_POST["idCliente"]) . "']\").click()

                        editarCliente.value = " . "\"" . ($dadosTemp['nome']) . "\"" . "
                        editarTelefone.value = " . "\"" . ($dadosTemp['telefone']) . "\"" . "
                        editarEmail.value = " . "\"" . ($dadosTemp['email']) . "\"" . "
                        editarProfissao.value = " . "\"" . ($dadosTemp['profissao']) . "\"" . "
                        editarDataNascimento.value = " . "\"" . ($dadosTemp['data_nascimento']) . "\"" . "

                        if(editarCliente.value == ''){
                            editarCliente.classList.toggle('vermelho')
                        }
                        if(editarProfissao.value == ''){
                            editarProfissao.classList.toggle('vermelho')
                        }

                    </script>";
                unset($dadosTemp);

            }

        }
    }

    /*==================================
        EXCLUIR CLIENTE
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
