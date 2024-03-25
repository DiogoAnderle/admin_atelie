<?php

require_once "../controllers/clientes.controller.php";

require_once "../models/clientes.model.php";

class AjaxClientes
{
    /*****************************************
                Editar Cliente
    *****************************************/
    public $idCliente;
    public function ajaxEditarCliente()
    {
        $item = "id";
        $valor = $this->idCliente;

        $resposta = ControllerClientes::ctrMostrarClientes($item, $valor);

        echo json_encode($resposta);

    }

    /***************************************
          Validar Cliente
  ***************************************/
    public $validarCliente;
    public function ajaxValidarCliente()
    {
        $item = "nome";
        $valor = $this->validarCliente;

        $resposta = ControllerClientes::ctrMostrarClientes($item, $valor);

        echo json_encode($resposta);
    }
}


/***************************************
               Editar Cliente
   ***************************************/
if (isset ($_POST["idCliente"])) {

    $cliente = new AjaxClientes();
    $cliente->idCliente = $_POST["idCliente"];
    $cliente->ajaxEditarCliente();

}


/***************************************
            Validar Cliente
***************************************/


if (isset ($_POST["validarCliente"])) {

    $valCliente = new AjaxClientes();
    $valCliente->validarCliente = $_POST["validarCliente"];
    $valCliente->ajaxValidarCliente();
}