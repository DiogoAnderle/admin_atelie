<?php
$item = null;
$valor = null;
$ordem = 'id';

$produtos = ControllerProdutos::ctrMostrarProdutos($item, $valor, $ordem);
?>


<!-- PRODUCT LIST -->
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Produtos Adicionados Recentemente</h3>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <ul class="products-list product-list-in-box">
            <?php
            for ($i = 0; $i < 5; $i++) {
                echo "
                <li class='item'>
                    <div class='product-img'>
                        <img src=' " . $produtos[$i]["imagem"] . "' alt='Product Image'>
                    </div>
                    <div class='product-info'>
                        <span class='product-title' style='padding-top:5px;'>" . $produtos[$i]["descricao"] . "</span>
                            <span class='label label-primary pull-right'>R$ " . number_format($produtos[$i]["preco_venda"], 2, ",", ".") . "</span>
                        
                    </div>
                </li>
                ";
            }


            ?>
        </ul>
    </div>
    <!-- /.box-body -->
    <div class="box-footer text-center" style="padding:15px;">
        <a href="produtos" class="uppercase">Ver todos os produtos</a>
    </div>
    <!-- /.box-footer -->
</div>
<!-- /.box -->