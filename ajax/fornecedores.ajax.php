<?php

require_once "../controllers/fornecedores.controller.php";

require_once "../models/fornecedores.model.php";

class AjaxFornecedores
{
    /***************************************
                Editar Fornecedores
    ***************************************/
    public $idFornecedor;

    public function ajaxEditarFornecedor()
    {
        $item = "id";
        $valor = $this->idFornecedor;

        $response = ControllerFornecedores::ctrMostrarFornecedores($item, $valor);

        echo json_encode($response);
    }

    /***************************************
            Validar Usuário
    ***************************************/
    public $validarFornecedor;
    public function ajaxValidarFornecedor()
    {

        $item = "nome";
        $valor = $this->validarFornecedor;

        $resposta = ControllerFornecedores::ctrMostrarFornecedores($item, $valor);

        echo json_encode($resposta);

    }
}

/***************************************
               Editar Fornecedores
   ***************************************/
if (isset ($_POST["idFornecedor"])) {

    $fornecedor = new Ajaxfornecedores();
    $fornecedor->idFornecedor = $_POST["idFornecedor"];
    $fornecedor->ajaxEditarFornecedor();

}



/***************************************
            Validar Usuário
***************************************/
if (isset ($_POST["validarFornecedor"])) {

    $valFornecedor = new AjaxFornecedores();
    $valFornecedor->validarFornecedor = $_POST["validarFornecedor"];
    $valFornecedor->ajaxValidarFornecedor();
}