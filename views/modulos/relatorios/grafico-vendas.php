<?php

error_reporting(0);

if (isset($_GET["dataInicial"])) {

    $dataInicial = $_GET["dataInicial"];
    $dataFinal = $_GET["dataFinal"];
} else {
    $dataInicial = null;
    $dataFinal = null;
}

$resposta = ControllerVendas::ctrPeriodoDatasVendas($dataInicial, $dataFinal);

$arrayDatas = array();
$arrayVendas = array();
$somaPagosMes = array();

foreach ($resposta as $key => $value) {

    #capturar o ano e mes
    $data_venda = substr($value["data_venda"], 0, 7);

    #Incluir as datas ao array de datas
    array_push($arrayDatas, $data_venda);

    #capturar vendas
    $arrayVendas = array($data_venda => $value["total"]);

    foreach ($arrayVendas as $key => $value) {
        $somaPagosMes[$key] += $value;
    }


}
$naoRepetirDatas = array_unique($arrayDatas);

?>

<!-- ==================================================== 
        GRAFICO DE VENDAS
 ==================================================== -->

<div class="box box-solid bg-teal-gradient">
    <div class="box-header">
        <i class="fa fa-th"></i>
        <h3 class="box-title">Gráfico de Vendas</h3>
    </div>
    <div class="box-body border-radius-none novoGraficoVendas">

        <div class="chart" id="line-chart-vendas" style="height:250px">
        </div>


    </div>
</div>

<script>
    let line = new Morris.Line({
        element: 'line-chart-vendas',
        resize: true,
        data: [
            <?php
            if ($naoRepetirDatas != null) {

                foreach ($naoRepetirDatas as $key) {
                    echo "{ y: '" . $key . "', vendas: " . $somaPagosMes[$key] . "},";
                }
                echo "{ y: '" . $key . "', vendas: " . $somaPagosMes[$key] . " },";
            } else {
                echo "{ y: '0', vendas: '0'},";
            }


            ?>

        ],
        xkey: 'y',
        ykeys: ['vendas'],
        labels: ['Vendas'],
        lineColors: ['#efefef'],
        lineWidth: 2,
        hideHover: 'auto',
        gridTextColor: '#fff',
        gridStrokeWidth: 0.4,
        pointSize: 4,
        pointStrokeColors: ['#efefef'],
        gridLineColor: '#efefef',
        gridTextFamily: 'Roboto',
        preUnits: 'R$ ',
        gridTextSize: 10,
        yLabelFormat: function (y) { return new Intl.NumberFormat("pt-BR", { style: "currency", currency: 'BRL' }).format(y); },
        dateFormat: function (x) { return new Date(x).toLocaleDateString('pt-BR').substring(3); },
    });
</script>