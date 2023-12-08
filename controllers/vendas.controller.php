<?php

class ControllerVendas
{

    /***********************************************
     * MOSTRAR VENDAS
     ***********************************************/
    public static function ctrMostrarVendas($item, $valor)
    {
        $tabela = "vendas";
        $resposta = ModeloVendas::mdlMostrarVendas($tabela, $item, $valor);

        return $resposta;
    }

    /***********************************************
     * CRIAR VENDAS
     ***********************************************/

    public static function ctrCriarVenda()
    {

        if (isset($_POST["novoCodigo"])) {
            /***********************************************
             * Atualizar as vendas do cliente, reduzir o estoque
             * do produto e aumentar a venda dos produtos
             ***********************************************/
            $listaProdutos = json_decode($_POST["listaProdutos"], true);

            $totalProdutosComprados = array();

            foreach ($listaProdutos as $key => $produto) {

                array_push($totalProdutosComprados, $produto["quantidade"]);

                $tabelaProdutos = "produtos";
                $item = "id";
                $valor = $produto["id"];

                $trazerProduto = ModelProdutos::mdlMostrarProdutos($tabelaProdutos, $item, $valor);

                $item1a = "vendas";
                $valor1a = $produto["quantidade"] + $trazerProduto["vendas"];

                ModelProdutos::mdlAtualizarProduto($tabelaProdutos, $item1a, $valor1a, $valor);

                $item1b = "estoque";
                $valor1b = $produto["estoque"];

                ModelProdutos::mdlAtualizarProduto($tabelaProdutos, $item1b, $valor1b, $valor);

            }

            $tabelaClientes = 'clientes';

            $item = "id";
            $valor = $_POST["selecionarCliente"];

            $trazerCliente = ModeloClientes::mdlMostrarClientes($tabelaClientes, $item, $valor);

            $item1a = "compras";
            $valor1a = array_sum($totalProdutosComprados) + $trazerCliente["compras"];

            $item1b = "ultima_compra";
            date_default_timezone_set("America/Sao_Paulo");

            $data = date('Y-m-d');
            $hora = date('H:m:s');
            $valor1b = $data . ' ' . $hora;


            ModeloClientes::mdlAtualizarCliente($tabelaClientes, $item1a, $valor1a, $valor);
            ModeloClientes::mdlAtualizarCliente($tabelaClientes, $item1b, $valor1b, $valor);

            /***********************************************
             * Atualizar as vendas do cliente, reduzir o estoque
             * do produto e aumentar a venda dos produtos
             ***********************************************/
            $tabela = "vendas";

            $dados = array(
                "codigo" => $_POST["novoCodigo"],
                "cliente_id" => $_POST["selecionarCliente"],
                "vendedor_id" => $_POST["idVendedor"],
                "produtos" => $_POST["listaProdutos"],
                "acrescimo" => $_POST["novoValorAcrescimo"],
                "subtotal" => $_POST["novoValorSemAcrescimo"],
                "total" => $_POST["totalVenda"],
                "metodo_pagamento" => $_POST["novoMetodoPagamento"],
            );

            $resposta = ModeloVendas::mdlCriarVenda($tabela, $dados);

            if ($resposta == "ok") {
                echo "<script>

                Swal.fire({
                        icon: 'success',
                        title: 'Venda cadastrada com sucesso!',
                        confirmButtonText: 'Fechar',

                    }).then((result) => {
                        if(result.value){
                            window.location = 'vendas';}
                    });
            
                </script>";
            }
        }

    }


    /***********************************************
     * EDITAR VENDAS
     ***********************************************/


    public static function ctrEditarVenda()
    {

        if (isset($_POST["editarCodigo"])) {

            /***********************************************
             * Formatar tabela de Produtos e Clientes
             ***********************************************/
            $tabela = "vendas";
            $item = "codigo";
            $valor = $_POST["editarCodigo"];

            $trazerVenda = ModeloVendas::mdlMostrarVendas($tabela, $item, $valor);

            $produtos = json_decode($trazerVenda["produtos"], true);

            $totalProdutosComprados = array();

            foreach ($produtos as $key => $produto) {

                array_push($totalProdutosComprados, $produto["quantidade"]);

                $tabelaProdutos = "produtos";
                $item = "id";
                $valor = $produto["id"];

                $trazerProduto = ModelProdutos::mdlMostrarProdutos($tabela, $item, $valor);
                //Reverter a quantidade de itens vendidos antes  
                // de salvar novamente no banco após a edição
                $item1a = "vendas";

                $valor1a = $trazerProduto["vendas"] - $produto["quantidade"];

                ModelProdutos::mdlAtualizarProduto($tabelaProdutos, $item1a, $valor1a, $valor);

                //Reverter a quantidade de itens no estoque antes  
                // de salvar novamente no banco após a edição
                $item1b = "estoque";
                $valor1b = $produto["quantidade"] + $trazerProduto["estoque"];

                ModelProdutos::mdlAtualizarProduto($tabelaProdutos, $item1b, $valor1b, $valor);

            }
            //Reverter a quantidade comprada pelo cliente antes  
            // de salvar novamente no banco após a edição
            $tabelaClientes = 'clientes';

            $itemCliente = "id";
            $valorCliente = $_POST["selecionarCliente"];

            $trazerCliente = ModeloClientes::mdlMostrarClientes($tabelaClientes, $itemCliente, $valorCliente);

            $item1a = "compras";

            $valor1a = $trazerCliente["compras"] - array_sum($totalProdutosComprados) + $trazerCliente["compras"];

            ModeloClientes::mdlAtualizarCliente($tabelaClientes, $item1a, $valor1a, $valor);

            /***********************************************
             * Atualizar as vendas do cliente, reduzir o estoque
             * do produto e aumentar a venda dos produtos
             ***********************************************/
            $listaProdutos_2 = json_decode($_POST["listaProdutos"], true);

            $totalProdutosComprados_2 = array();

            foreach ($listaProdutos_2 as $key => $produto) {

                array_push($totalProdutosComprados_2, $produto["quantidade"]);

                $tabelaProdutos_2 = "produtos";
                $item_2 = "id";
                $valor_2 = $produto["id"];

                $trazerProduto_2 = ModelProdutos::mdlMostrarProdutos($tabelaProdutos_2, $item_2, $valor_2);

                $item1a_2 = "vendas";
                $valor1a_2 = $produto["quantidade"] + $trazerProduto["vendas"];

                ModelProdutos::mdlAtualizarProduto($tabelaProdutos, $item1a_2, $valor1a_2, $valor_2);

                $item1b_2 = "estoque";
                $valor1b_2 = $produto["estoque"];

                ModelProdutos::mdlAtualizarProduto($tabelaProdutos_2, $item1b_2, $valor1b_2, $valor_2);

            }

            $tabelaClientes_2 = 'clientes';

            $item_2 = "id";
            $valor_2 = $_POST["selecionarCliente"];

            $trazerCliente_2 = ModeloClientes::mdlMostrarClientes($tabelaClientes_2, $item_2, $valor_2);

            $item1a_2 = "compras";
            $valor1a_2 = array_sum($totalProdutosComprados_2) + $trazerCliente["compras"];
            ModeloClientes::mdlAtualizarCliente($tabelaClientes_2, $item1a_2, $valor1a_2, $valor_2);

            $item1b_2 = "ultima_compra";
            date_default_timezone_set("America/Sao_Paulo");

            $data_2 = date('Y-m-d');
            $hora_2 = date('H:m:s');
            $valor1b_2 = $data_2 . ' ' . $hora_2;


            ModeloClientes::mdlAtualizarCliente($tabelaClientes_2, $item1b_2, $valor1b_2, $valor_2);

            /***********************************************
             * Atualizar as vendas do cliente, reduzir o estoque
             * do produto e aumentar a venda dos produtos
             ***********************************************/


            $dados = array(
                "codigo" => $_POST["editarCodigo"],
                "cliente_id" => $_POST["selecionarCliente"],
                "vendedor_id" => $_POST["idVendedor"],
                "produtos" => $_POST["listaProdutos"],
                "acrescimo" => $_POST["novoValorAcrescimo"],
                "subtotal" => $_POST["novoValorSemAcrescimo"],
                "total" => $_POST["totalVenda"],
                "metodo_pagamento" => $_POST["novoMetodoPagamento"],
            );

            $resposta = ModeloVendas::mdlEditarVenda($tabela, $dados);

            if ($resposta == "ok") {
                echo "<script>

                Swal.fire({
                        icon: 'success',
                        title: 'Venda atualizada com sucesso!',
                        confirmButtonText: 'Fechar',

                    }).then((result) => {
                        if(result.value){
                            window.location = 'vendas';}
                    });

                </script>";
            }
        }

    }

}
