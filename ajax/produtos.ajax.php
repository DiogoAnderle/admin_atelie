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
    public $idProduto;

    public function ajaxEditarProduto()
    {
        $item = 'id';
        $valor = $this->idProduto;

        $resposta = ControllerProdutos::ctrMostrarProdutos($item, $valor);

        echo json_encode($resposta);
    }
}



/***************************************
               Editar Categoria
   ***************************************/
if (isset($_POST["idCategoria"])) {

    $codigoProduto = new AjaxProdutos();
    $codigoProduto->idCategoria = $_POST["idCategoria"];
    $codigoProduto->ajaxCriarCodigoProduto();

}

if (isset($_POST["idProduto"])) {

    $codigoProduto = new AjaxProdutos();
    $codigoProduto->idProduto = $_POST["idProduto"];
    $codigoProduto->ajaxEditarProduto();

}