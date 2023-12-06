<?php

require_once "../controllers/produtos.controller.php";

require_once "../models/produtos.model.php";

require_once "../controllers/categorias.controller.php";

require_once "../models/categorias.model.php";

class AjaxProdutos
{
    /***************************************
                Editar Categoria
    ***************************************/
    public $idCategoria;

    /***************************************
    Gerar Codigo a partir do ID da Categoria
    ***************************************/
    public function ajaxCriarCodigoProduto()
    {
        $item = "categoria_id";
        $valor = $this->idCategoria;

        $response = ControllerProdutos::ctrMostrarProdutos($item, $valor);

        echo json_encode($response);
    }

    /***************************************
                 Editar Produto
     ***************************************/
    public $idProduto;
    public $carregarProdutos;

    public function ajaxEditarProduto()
    {
        if ($this->carregarProdutos == "ok") {
            $item = null;
            $valor = null;

            $resposta = ControllerProdutos::ctrMostrarProdutos($item, $valor);

            echo json_encode($resposta);
        } else {

            $item = 'id';
            $valor = $this->idProduto;

            $resposta = ControllerProdutos::ctrMostrarProdutos($item, $valor);

            echo json_encode($resposta);
        }
    }
}

if (isset($_POST["idCategoria"])) {

    $codigoProduto = new AjaxProdutos();
    $codigoProduto->idCategoria = $_POST["idCategoria"];
    $codigoProduto->ajaxCriarCodigoProduto();

}

/***************************************
             Editar Produto
 ***************************************/
if (isset($_POST["idProduto"])) {

    $codigoProduto = new AjaxProdutos();
    $codigoProduto->idProduto = $_POST["idProduto"];
    $codigoProduto->ajaxEditarProduto();

}
/***************************************
             Carregar Produtos
 ***************************************/

if (isset($_POST["carregarProdutos"])) {

    $carregarProdutos = new AjaxProdutos();
    $carregarProdutos->carregarProdutos = $_POST["carregarProdutos"];
    $carregarProdutos->ajaxEditarProduto();

}