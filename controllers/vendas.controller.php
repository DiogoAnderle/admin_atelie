<?php

class ControllerVendas
{
    public static function ctrMostrarVendas($item, $valor)
    {
        $tabela = "vendas";
        $resposta = ModeloVendas::mdlMostrarVendas($tabela, $item, $valor);
    }

}
