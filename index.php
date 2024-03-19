<?php
/*Controllers*/
require_once "controllers/modelo.controller.php";
require_once "controllers/usuarios.controller.php";
require_once "controllers/categorias.controller.php";
require_once "controllers/produtos.controller.php";
require_once "controllers/clientes.controller.php";
require_once "controllers/vendas.controller.php";
require_once "controllers/fornecedores.controller.php";
/*Models*/
require_once "models/usuarios.model.php";
require_once "models/categorias.model.php";
require_once "models/produtos.model.php";
require_once "models/clientes.model.php";
require_once "models/vendas.model.php";
require_once "models/fornecedores.model.php";

$modelo = new ModeloController();

$modelo->ctrModelo();