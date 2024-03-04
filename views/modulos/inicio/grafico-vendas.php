<?php
$item = null;
$valor = null;

$vendas = ControllerVendas::ctrSomaTotaldeVendas();

$categorias = ControllerCategorias::ctrMostrarCategorias($item, $valor);
$clientes = ControllerClientes::ctrMostrarClientes($item, $valor);
$produtos = ControllerProdutos::ctrMostrarProdutos($item, $valor);

$totalCategorias = count($categorias);
$totalClientes = count($clientes);
$totalProdutos = count($produtos);

?>