<?php
$item = null;
$valor = null;
$ordem = 'id';

$vendas = ControllerVendas::ctrSomaTotaldeVendas();

$categorias = ControllerCategorias::ctrMostrarCategorias($item, $valor);
$clientes = ControllerClientes::ctrMostrarClientes($item, $valor);
$produtos = ControllerProdutos::ctrMostrarProdutos($item, $valor, $ordem);

$totalCategorias = count($categorias);
$totalClientes = count($clientes);
$totalProdutos = count($produtos);

?>