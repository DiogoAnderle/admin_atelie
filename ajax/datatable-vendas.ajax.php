<?php

require_once "../controllers/produtos.controller.php";
require_once "../models/produtos.model.php";

class TabelaProdutosVendas
{
    /***************************************
          Produtos Dinamicos Datatables
    ***************************************/
    public function mostrarTabelaProdutosVendas()
    {

        $item = null;
        $valor = null;
        $ordem = "id";
        $produtos = ControllerProdutos::ctrMostrarProdutos($item, $valor, $ordem);

        $dadosJson = '{
            "data": [';

        for ($i = 0; $i < count($produtos); $i++) {

            /***************************************
                Trazemos a imagem
            ***************************************/
            $imagem = "<img src='" . $produtos[$i]["imagem"] . "' width='40px'>";

            /***************************************
                 Estoque
            ***************************************/

            if ($produtos[$i]["estoque"] <= 10) {
                $estoque = "<button class='btn btn-danger'>" . $produtos[$i]["estoque"] . "</button>";
            } else if ($produtos[$i]["estoque"] > 10 && $produtos[$i]["estoque"] <= 15) {
                $estoque = "<button class='btn btn-warning'>" . $produtos[$i]["estoque"] . "</button>";
            } else {

                $estoque = "<button class='btn btn-success'>" . $produtos[$i]["estoque"] . "</button>";
            }

            /***************************************
                Trazemos as ações
           ***************************************/
            if ($produtos[$i]["estoque"] <= 0) {
                $botoes = "<div class='btn-group'><button class='btn btn-default adicionarProduto' idProduto='" . $produtos[$i]["id"] . "'>Adicionar</button></div>";
            } else {
                $botoes = "<div class='btn-group'><button class='btn btn-primary adicionarProduto recuperarBotao' idProduto='" . $produtos[$i]["id"] . "'>Adicionar</button></div>";

            }

            /***************************************
                Montamos o json de retorno
           ***************************************/

            $dadosJson .= '[
                    "' . ($i + 1) . '",
                    "' . $imagem . '",
                    "' . $produtos[$i]["codigo"] . '",
                    "' . $produtos[$i]["descricao"] . '",
                    "' . $estoque . '",
                    "R$ ' . number_format($produtos[$i]["preco_venda"], 2, ",", ".") . '",
                    "' . $botoes . '"
                ],';
        }
        $dadosJson = substr($dadosJson, 0, -1);

        $dadosJson .= '] }';

        echo $dadosJson;

    }

}

/***************************************
         Ativa tabela Produtos
***************************************/
$ativarProdutosVendas = new TabelaProdutosVendas();
$ativarProdutosVendas->mostrarTabelaProdutosVendas();