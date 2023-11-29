<?php

require_once "../controllers/usuarios.controller.php";
require_once "../models/usuarios.model.php";
class AjaxUsuarios
{
    /***************************************
                Editar Usuário
    ***************************************/
    public $idUsuario;
    public function ajaxEditarUsuario()
    {
        $item = "id";
        $valor = $this->idUsuario;

        $resposta = ControllerUsuarios::crtMostrarUsuarios($item, $valor);

        echo json_encode($resposta);
    }

    /***************************************
                Ativar Usuário
    ***************************************/

    public $ativarUsuario;
    public $ativarId;

    public function ajaxAtivarUsuario()
    {
        $tabela = "usuarios";
        $item1 = "estado";
        $valor1 = $this->ativarUsuario;
        $item2 = "id";
        $valor2 = $this->ativarId;
        $resposta = ModeloUsuarios::mdlAtualizarUsuario($tabela, $item1, $valor1, $item2, $valor2);
        echo json_encode($resposta);
    }
    /***************************************
            Ativar Usuário
    ***************************************/
    public $validarUsuario;
    public function ajaxValidarUsuario(){

        $item = "usuario";
        $valor = $this->validarUsuario;

        $resposta = ControllerUsuarios::crtMostrarUsuarios($item, $valor);

        echo json_encode($resposta);

    }

}


/***************************************
            Editar Usuário
***************************************/
if (isset($_POST["idUsuario"])) {

    $editarUsuario = new AjaxUsuarios();
    $editarUsuario->idUsuario = $_POST["idUsuario"];
    $editarUsuario->ajaxEditarUsuario();

}

/***************************************
            Ativar Usuário
***************************************/
if (isset($_POST["ativarUsuario"])) {

    $ativarUsuario = new AjaxUsuarios();
    $ativarUsuario->ativarUsuario = $_POST["ativarUsuario"];
    $ativarUsuario->ativarId = $_POST["ativarId"];
    $ativarUsuario->ajaxAtivarUsuario();

}

/***************************************
            Validar Usuário
***************************************/
if (isset($_POST["validarUsuario"])) {

    $valUsuario = new AjaxUsuarios();
    $valUsuario->validarUsuario = $_POST["validarUsuario"];
    $valUsuario->ajaxValidarUsuario();
}