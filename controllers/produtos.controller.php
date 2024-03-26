<?php

class ControllerProdutos
{
    /*==============================================
                 Mostrar Produtos
    ==============================================*/

    public static function ctrMostrarProdutos($item, $valor, $ordem)
    {
        $tabela = "produtos";
        $resposta = ModelProdutos::mdlMostrarProdutos($tabela, $item, $valor, $ordem);
        return $resposta;
    }

    /*==============================================
                Criar Produtos
    ==============================================*/

    public static function ctrCriarProduto()
    {

        if (isset($_POST["novaDescricao"])) {
            if (
                preg_match('/^[a-zA-Z0-9nÑãÃõÕçÇáéíóúÁÉÍÓÚàÀ ]+$/', $_POST["novaDescricao"]) &&
                preg_match('/^[0-9]+$/', $_POST["novoEstoque"]) &&
                preg_match('/^[0-9.]+$/', $_POST["novoPrecoCompra"]) &&
                preg_match('/^[0-9.]+$/', $_POST["novoPrecoVenda"])
            ) {

                $rota = "views/img/produtos/product-default.png";
                /* *****************************
                 * validar imagem
                 **************************** */
                if (isset($_FILES["novaImagem"]["tmp_name"]) && $_FILES["novaImagem"]["tmp_name"] != "") {

                    list($largura, $altura) = getimagesize($_FILES["novaImagem"]["tmp_name"]);

                    $novaLargura = 500;
                    $novaAltura = 500;

                    /* *****************************
                     * criar diretório para salvar a imagem do usuário
                     **************************** */

                    $diretorio = "views/img/produtos/" . $_POST["novoCodigo"];

                    mkdir($diretorio, 0755);
                    /* *****************************
                     * de acordo com o tipo da imagem, aplicamos com as funções padrões do php
                     **************************** */

                    if ($_FILES["novaImagem"]["type"] == "image/jpg" || $_FILES["novaImagem"]["type"] == "image/jpeg") {
                        /* *****************************
                         * guardar a imagem no diretório
                         **************************** */
                        $aleatorio = mt_rand(100, 999);

                        $rota = "views/img/produtos/" . $_POST["novoCodigo"] . "/" . $aleatorio . ".jpg";

                        $origem = imagecreatefromjpeg($_FILES["novaImagem"]["tmp_name"]);

                        $destino = imagecreatetruecolor($novaLargura, $novaAltura);

                        imagecopyresized($destino, $origem, 0, 0, 0, 0, $novaLargura, $novaAltura, $largura, $altura);

                        imagejpeg($destino, $rota);

                    }
                    if ($_FILES["novaImagem"]["type"] == "image/png") {
                        /* *****************************
                         * guardar a imagem no diretório
                         **************************** */
                        $aleatorio = mt_rand(100, 999);

                        $rota = "views/img/produtos/" . $_POST["novoCodigo"] . "/" . $aleatorio . ".png";

                        $origem = imagecreatefrompng($_FILES["novaImagem"]["tmp_name"]);

                        $destino = imagecreatetruecolor($novaLargura, $novaAltura);

                        imagecopyresized($destino, $origem, 0, 0, 0, 0, $novaLargura, $novaAltura, $largura, $altura);

                        imagepng($destino, $rota);

                    }
                }

                $tabela = 'produtos';

                $dados = array(
                    "categoria_id" => $_POST["novaCategoria"],
                    "codigo" => $_POST["novoCodigo"],
                    "descricao" => $_POST["novaDescricao"],
                    "estoque" => $_POST["novoEstoque"],
                    "preco_compra" => $_POST["novoPrecoCompra"],
                    "preco_venda" => $_POST["novoPrecoVenda"],
                    "imagem" => $rota
                );

                $resposta = ModelProdutos::mdlCadastrarProduto($tabela, $dados);

                if ($resposta == "ok") {
                    echo "<script>

                    Swal.fire({
                        icon: 'success',
                        title: 'Produto cadastrado com sucesso!',
                        confirmButtonText: 'Fechar',

                    }).then((result) => {
                        if(result.value){
                            window.location = 'produtos';}
                    });
                
                    </script>";
                }

            } else {
                echo "<script>

                    Swal.fire({
                        icon: 'error',
                        title: 'Algo deu errado!',
                        text: 'O produto não pode conter campos vazios ou conter caracteres especiais.',
                        confirmButtonText: 'Fechar',

                    }).then((result) => {
                        if(result.value){
                            window.location = 'produtos';}
                    });
                
                    </script>";

            }
        }
    }


    /*==============================================
                Editar Produtos
    ==============================================*/
    public static function ctrEditarProduto()
    {

        if (isset($_POST["editarDescricao"])) {
            if (
                preg_match('/^[a-zA-Z0-9nÑãÃõÕçÇáéíóúÁÉÍÓÚàÀ ]+$/', $_POST["editarDescricao"]) &&
                preg_match('/^[0-9]+$/', $_POST["editarEstoque"]) &&
                preg_match('/^[0-9.]+$/', $_POST["editarPrecoCompra"]) &&
                preg_match('/^[0-9.]+$/', $_POST["editarPrecoVenda"])
            ) {

                $rota = $_POST["imagemAtual"];
                /* *****************************
                 * validar imagem
                 **************************** */
                if (isset($_FILES["editarImagem"]["tmp_name"]) && !empty($_FILES["editarImagem"]["tmp_name"])) {

                    list($largura, $altura) = getimagesize($_FILES["editarImagem"]["tmp_name"]);

                    $novaLargura = 500;
                    $novaAltura = 500;

                    /* *****************************
                     * criar diretório para salvar a imagem do produto
                     **************************** */

                    $diretorio = "views/img/produtos/" . $_POST["editarCodigo"];

                    /* *****************************
                     * criar diretório para salvar a imagem do produto
                     **************************** */

                    if (!empty($_POST["imagemAtual"])) {
                        unlink($_POST["imagemAtual"]);
                    } else {

                        mkdir($diretorio, 0755);
                    }

                    /* *****************************
                     * de acordo com o tipo da imagem, aplicamos com as funções padrões do php
                     **************************** */

                    if ($_FILES["editarImagem"]["type"] == "image/jpg" || $_FILES["editarImagem"]["type"] == "image/jpeg") {
                        /* *****************************
                         * guardar a imagem no diretório
                         **************************** */
                        $aleatorio = mt_rand(100, 999);

                        $rota = "views/img/produtos/" . $_POST["editarCodigo"] . "/" . $aleatorio . ".jpg";

                        $origem = imagecreatefromjpeg($_FILES["editarImagem"]["tmp_name"]);

                        $destino = imagecreatetruecolor($novaLargura, $novaAltura);

                        imagecopyresized($destino, $origem, 0, 0, 0, 0, $novaLargura, $novaAltura, $largura, $altura);

                        imagejpeg($destino, $rota);

                    }
                    if ($_FILES["editarImagem"]["type"] == "image/png") {
                        /* *****************************
                         * guardar a imagem no diretório
                         **************************** */
                        $aleatorio = mt_rand(100, 999);

                        $rota = "views/img/produtos/" . $_POST["editarCodigo"] . "/" . $aleatorio . ".png";

                        $origem = imagecreatefrompng($_FILES["editarImagem"]["tmp_name"]);

                        $destino = imagecreatetruecolor($novaLargura, $novaAltura);

                        imagecopyresized($destino, $origem, 0, 0, 0, 0, $novaLargura, $novaAltura, $largura, $altura);

                        imagepng($destino, $rota);

                    }
                }

                $tabela = 'produtos';

                $dados = array(
                    "categoria_id" => $_POST["editarCategoria"],
                    "codigo" => $_POST["editarCodigo"],
                    "descricao" => $_POST["editarDescricao"],
                    "estoque" => $_POST["editarEstoque"],
                    "preco_compra" => $_POST["editarPrecoCompra"],
                    "preco_venda" => $_POST["editarPrecoVenda"],
                    "imagem" => $rota
                );

                $resposta = ModelProdutos::mdlEditarProduto($tabela, $dados);

                if ($resposta == "ok") {
                    echo "<script>

                    Swal.fire({
                        icon: 'success',
                        title: 'Produto editado com sucesso!',
                        confirmButtonText: 'Fechar',

                    }).then((result) => {
                        if(result.value){
                            window.location = 'produtos';}
                    });
                
                    </script>";
                }

            } else {
                echo "<script>

                    Swal.fire({
                        icon: 'error',
                        title: 'Algo deu errado!',
                        text: 'O produto não pode conter campos vazios ou conter caracteres especiais.',
                        confirmButtonText: 'Fechar',

                    }).then((result) => {
                        if(result.value){
                            window.location = 'produtos';}
                    });
                
                    </script>";

            }
        }
    }


    /*==============================================
                Excluir Produto
    ==============================================*/

    public static function ctrExcluirProduto()
    {
        if (isset($_GET["idProduto"])) {

            $tabela = 'produtos';
            $dados = $_GET["idProduto"];

            // Verificar se produto já foi vendido caso Sim não permitir exclusão
            $tabelaVendas = "vendas";
            $produtosVendas = "produtos";
            $verificaSeProdutoVendido = ModeloVendas::mdlVerificaSeProdutoVendido($tabelaVendas, $produtosVendas, $dados);

            if(!$verificaSeProdutoVendido){
                if ($_GET["imagem"] != "" && $_GET["imagem"] != "views/img/produtos/product-default.png") {
                    unlink($_GET["imagem"]);
                    rmdir('views/img/produtos/' . $_GET["codigo"]);
                }
    
                $resposta = ModelProdutos::mdlExcluirProduto($tabela, $dados);
    
                if ($resposta == "ok") {
                    echo "<script>
    
                        Swal.fire({
                            icon: 'success',
                            title: 'Produto excluído com sucesso!',
                            confirmButtonText: 'Fechar',
    
                        }).then((result) => {
                            if(result.value){
                                window.location = 'produtos';}
                        });
                    
                        </script>";
                }
            }else{
                echo "<script>
    
                Swal.fire({
                    icon: 'error',
                    title: 'Erro!',
                    text: 'Produto vinculado em uma venda e não pode ser excluído!',
                    confirmButtonText: 'Fechar',

                }).then((result) => {
                    if(result.value){
                        window.location = 'produtos';}
                });
            
                </script>";
            }
        }
    }

    static public function crtMostrarSomaVendas()
    {
        $tabela = "produtos";
        $resposta = ModelProdutos::mdlMostrarSomaVendas($tabela);
        return $resposta;
    }
}
