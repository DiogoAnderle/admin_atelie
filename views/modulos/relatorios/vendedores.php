<?php
$item = null;
$valor = null;
$vendas = ControllerVendas::ctrMostrarVendas($item, $valor);
$usuarios = ControllerUsuarios::crtMostrarUsuarios($item, $valor);
$arrayVendedores = array();
$arrayListaVendedores = array();

foreach ($vendas as $key => $valueVendas) {

    foreach ($usuarios as $key => $valueUsuarios) {
        if ($valueUsuarios["id"] == $valueVendas["vendedor_id"]) {

            array_push($arrayVendedores, $valueUsuarios["nome"]);

            $arrayListaVendedores = array($valueUsuarios["nome"] => $valueVendas["total"]);
            foreach ($arrayListaVendedores as $key => $value) {
                $somarTotalVendedores[$key] += $value;
            }
        }
    }
}

$naoRepetirVendedores = array_unique($arrayVendedores);



?>

<div class="box box-success">
    <div class="box-header with-border">
        <h3>Vendedores</h3>
    </div>
    <div class="chart-responsive">
        <div class="chart" id="bar-chart-vendedores" style="height: 300px;"></div>
    </div>
</div>

<script>
    let barVendedores = new Morris.Bar({
        element: 'bar-chart-vendedores',
        resize: true,
        data: [
            <?php
            foreach ($naoRepetirVendedores as $key => $value) {
                echo "
                { y: '" . $value . "', a: " . $somarTotalVendedores[$value] . " },";
            }
            ?>


        ],
        barColors: ['#0af'],
        xkey: 'y',
        ykeys: ['a'],
        labels: ['Vendas'],
        preUnits: 'R$ ',
        hideHover: 'auto',
        yLabelFormat: function (y) {
            return new Intl.NumberFormat("pt-BR", { style: "currency", currency: 'BRL' }).format(y);
        },
    });

</script>