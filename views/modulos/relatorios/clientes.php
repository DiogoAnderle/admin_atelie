<?php
$item = null;
$valor = null;
$vendas = ControllerVendas::ctrMostrarVendas($item, $valor);
$clientes = ControllerClientes::ctrMostrarClientes($item, $valor);
$arrayClientes = array();
$arrayListaClientes = array();
$somarTotalClientes = [];

foreach ($vendas as $key => $valueVendas) {

    foreach ($clientes as $key => $valueClientes) {
        if ($valueClientes["id"] == $valueVendas["cliente_id"]) {

            array_push($arrayClientes, $valueClientes["nome"]);

            $arrayListaClientes = array($valueClientes["nome"] => $valueVendas["total"]);
            foreach ($arrayListaClientes as $key => $value) {
                $somarTotalClientes[$key] += $value;
            }
        }
    }
}

$naoRepetirClientes = array_unique($arrayClientes);

?>
<div class="box box-primary">
    <div class="box-header with-border">
        <h3>Clientes</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
    </div>
    <div class="chart-responsive">
        <div class="chart" id="bar-chart-clientes" style="height: 300px;"></div>
    </div>
</div>

<script>
    let barClientes = new Morris.Bar({
        element: 'bar-chart-clientes',
        resize: true,
        data: [
            <?php
            foreach ($naoRepetirClientes as $key => $value) {
                echo "
                { y: '" . $value . "', a: " . $somarTotalClientes[$value] . " },";
            }
            ?>

        ],
        barColors: ['#f6a'],
        xkey: 'y',
        ykeys: ['a'],
        labels: ['Clientes'],
        preUnits: 'R$ ',
        hideHover: 'auto',
        yLabelFormat: function (y) { return new Intl.NumberFormat("pt-BR", { style: "currency", currency: 'BRL' }).format(y); },
    });

</script>