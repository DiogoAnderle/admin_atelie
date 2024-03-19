<?php
class ControllerFornecedores
{

    static public function ctrCriarFornecedor()
    {
        if (isset ($_POST["novoFornecedor"])) {
            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚçÇãõÃÕ ]+$/', $_POST["novoFornecedor"])) {

                $tabela = "fornecedores";

                $dados = $_POST["novoFornecedor"];

                $resposta = ModeloFornecedores::mdlCriarFornecedor($tabela, $dados);
                if ($resposta == 'ok') {
                    echo "<script>

                    Swal.fire({
                        icon: 'success',
                        title: 'Fornecedor cadastrado com sucesso',
                        confirmButtonText: 'Fechar',

                    }).then((result) => {
                        if(result.value){
                            window.location = 'fornecedores';}
                    });
                
                    </script>";
                }

            } else {
                echo "<script>

                    Swal.fire({
                        icon: 'error',
                        title: 'Algo deu errado!',
                        text: 'Fornecedor não pode estar vazio ou conter caracteres especiais.',
                        confirmButtonText: 'Fechar',

                    }).then((result) => {
                        if(result.value){
                            window.location = 'fornecedores';}
                    });
                
                    </script>";
            }
        }

    }

    static public function ctrMostrarFornecedores($item, $valor)
    {
        $tabela = 'fornecedores';

        $resposta = ModeloFornecedores::mdlMostrarFornecedores($tabela, $item, $valor);

        return $resposta;
    }
    static public function ctrEditarFornecedor()
    {
        if (isset ($_POST["editarFornecedor"])) {
            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚçÇãõÃÕ ]+$/', $_POST["editarFornecedor"])) {

                $tabela = "fornecedores";

                $dados = array(
                    "nome" => $_POST["editarFornecedor"],
                    "id" => $_POST["idFornecedor"]
                );

                $resposta = ModeloFornecedores::mdlEditarFornecedor($tabela, $dados);
                if ($resposta == 'ok') {
                    echo "<script>

                    Swal.fire({
                        icon: 'success',
                        title: 'Fornecedor atualizado com sucesso',
                        confirmButtonText: 'Fechar',

                    }).then((result) => {
                        if(result.value){
                            window.location = 'fornecedores';}
                    });
                
                    </script>";
                }

            } else {
                echo "<script>

                    Swal.fire({
                        icon: 'error',
                        title: 'Algo deu errado!',
                        text: 'Fornecedor não pode estar vazio ou conter caracteres especiais.',
                        confirmButtonText: 'Fechar',

                    }).then((result) => {
                        if(result.value){
                            window.location = 'fornecedores';}
                    });
                
                    </script>";
            }
        }

    }

    public static function ctrExcluirFornecedor()
    {
        if (isset ($_GET["idFornecedor"])) {

            $tabela = "fornecedores";
            $dados = $_GET["idFornecedor"];


            $response = ModeloFornecedores::mdlExcluirFornecedor($tabela, $dados);

            if ($response == 'ok') {
                echo
                    "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Fornecedor deletado com sucesso',
                        confirmButtonText: 'Fechar'
                    }).then(function(result){
                        if(result.value){
                            window.location = 'fornecedores';}
                    });
                </script>";
            }

        }
    }

}

