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
    }

    /***********************************************
     * MOSTRAR VENDAS
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

                $novasVendas = ModelProdutos::mdlAtualizarProduto($tabelaProdutos, $item1a, $valor1a, $valor);

                $item1b = "estoque";
                $valor1b = $produto["estoque"];

                $novasVendas = ModelProdutos::mdlAtualizarProduto($tabelaProdutos, $item1b, $valor1b, $valor);

            }

            $tabelaClientes = 'clientes';

            $item = "id";
            $valor = $_POST["selecionarCliente"];

            $trazerCliente = ModeloClientes::mdlMostrarClientes($tabelaClientes, $item, $valor);

            $item1 = "compras";
            $valor1 = array_sum($totalProdutosComprados) + $trazerCliente["compras"];

            $comprasCliente = ModeloClientes::mdlAtualizarCliente($tabelaClientes, $item1, $valor1, $valor);

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

}
