<?php
require_once "../../models/clientes.model.php";
require_once "../../models/usuarios.model.php";
require_once "../../models/vendas.model.php";
require_once "../../controllers/clientes.controller.php";
require_once "../../controllers/usuarios.controller.php";
require_once "../../controllers/vendas.controller.php";


$relatorio = new ControllerVendas();
$relatorio->ctrBaixarRelatorio();
