<?php

require_once "../controllers/produtos.controller.php";
require_once "../models/produtos.model.php";

require_once "../controllers/categorias.controller.php";
require_once "../models/categorias.model.php";

class TabelaProdutos
{
    /***************************************
          Produtos Dinamicos Datatables
    ***************************************/
    public function mostrarTabelaProdutos()
    {

        $item = null;
        $valor = null;
        $produtos = ControllerProdutos::ctrMostrarProdutos($item, $valor);

        $dadosJson = '{
            "data": [';

        for ($i = 0; $i < count($produtos); $i++) {

            /***************************************
                Trazemos a imagem
            ***************************************/
            $imagem = "<img src='" . $produtos[$i]["imagem"] . "' width='40px'>";

            /***************************************
                 Trazemos a categoria
            ***************************************/

            $item = 'id';
            $valor = $produtos[$i]["categoria_id"];

            $categorias = ControllerCategorias::ctrMostrarCategorias($item, $valor);

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
            $botoes = "<div class='btn-group'><button class='btn btn-warning btnEditarProduto' idProduto='" . $produtos[$i]["id"] . "' data-toggle='modal' data-target='#modalEditarProduto' title='Editar'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnExcluirProduto' idProduto='" . $produtos[$i]["id"] . "' codigo='" . $produtos[$i]["codigo"] . "' imagem='" . $produtos[$i]["imagem"] . "' descricao='" . $produtos[$i]["descricao"] . "' title='Excluir'><i class='fa fa-times'></i></button></div>";

            /***************************************
                Montamos o json de retorno
           ***************************************/

            $dadosJson .= '[
                    "' . ($i + 1) . '",
                    "' . $imagem . '",
                    "' . $produtos[$i]["codigo"] . '",
                    "' . $produtos[$i]["descricao"] . '",
                    "' . $categorias["categoria"] . '",
                    "' . $estoque . '",
                    "R$ ' . $produtos[$i]["preco_compra"] . '",
                    "R$ ' . $produtos[$i]["preco_venda"] . '",
                    "' . date('d/m/Y H:i:s', strtotime($produtos[$i]["data_inclusao"])) . '",
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
$ativarProdutos = new TabelaProdutos();
$ativarProdutos->mostrarTabelaProdutos();