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
}


/***************************************
               Editar Categoria
   ***************************************/
if (isset($_POST["idCliente"])) {

    $cliente = new AjaxClientes();
    $cliente->idCliente = $_POST["idCliente"];
    $cliente->ajaxEditarCliente();

} else {
    echo 'não veio';
}
