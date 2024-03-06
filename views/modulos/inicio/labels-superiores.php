<?php
$item = null;
$valor = null;
$ordem = "id";

$vendas = ControllerVendas::ctrSomaTotaldeVendas();

$categorias = ControllerCategorias::ctrMostrarCategorias($item, $valor);
$clientes = ControllerClientes::ctrMostrarClientes($item, $valor);

$produtos = ControllerProdutos::ctrMostrarProdutos($item, $valor, $ordem);

$totalCategorias = count($categorias);
$totalClientes = count($clientes);
$totalProdutos = count($produtos);

?>


<div class="col-lg-3 col-xs-6">

    <div class="small-box bg-aqua">

        <div class="inner">

            <h3>R$
                <?php echo number_format($vendas["total"], 2, ",", "."); ?>
            </h3>

            <p>Vendas</p>

        </div>

        <div class="icon">

            <i class="ion ion-social-usd"></i>

        </div>

        <a href="vendas" class="small-box-footer">

            Mais informações <i class="fa fa-arrow-circle-right"></i>

        </a>

    </div>

</div>

<div class="col-lg-3 col-xs-6">

    <div class="small-box bg-green">

        <div class="inner">

            <h3>
                <?php echo number_format($totalCategorias); ?>
            </h3>

            <p>Categorias</p>

        </div>

        <div class="icon">

            <i class="ion ion-clipboard"></i>

        </div>

        <a href="categorias" class="small-box-footer">

            Mais informações <i class="fa fa-arrow-circle-right"></i>

        </a>

    </div>

</div>

<div class="col-lg-3 col-xs-6">

    <div class="small-box bg-yellow">

        <div class="inner">

            <h3>
                <?php echo number_format($totalClientes); ?>
            </h3>

            <p>Clientes</p>

        </div>

        <div class="icon">

            <i class="ion ion-person-add"></i>

        </div>

        <a href="clientes" class="small-box-footer">

            Mais informações <i class="fa fa-arrow-circle-right"></i>

        </a>

    </div>

</div>

<div class="col-lg-3 col-xs-6">

    <div class="small-box bg-red">

        <div class="inner">

            <h3>
                <?php echo number_format($totalProdutos); ?>
            </h3>

            <p>Produtos</p>

        </div>

        <div class="icon">

            <i class="ion ion-ios-cart"></i>

        </div>

        <a href="produtos" class="small-box-footer">

            Mais informações <i class="fa fa-arrow-circle-right"></i>

        </a>

    </div>

</div>