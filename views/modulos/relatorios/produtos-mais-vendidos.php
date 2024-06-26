<?php
$item = null;
$valor = null;
$ordem = "vendas";

$produtos = ControllerProdutos::ctrMostrarProdutos($item, $valor, $ordem);

$colors = array("red", "green", "yellow", "aqua", "purple", "blue", "cyan", "magenta", "orange", "gold");

$totalVendas = ControllerProdutos::crtMostrarSomaVendas();

?>

<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">Produtos Mais Vendidos</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-md-7">
                <div class="chart-responsive">
                    <canvas id="pieChart" height="150"></canvas>
                </div>
                <!-- ./chart-responsive -->
            </div>
            <!-- /.col -->
            <div class="col-md-5">
                <ul class="chart-legend clearfix">

                    <?php
                    for ($i = 0; $i < 10; $i++) {
                        if ($produtos[$i]["vendas"] > 0) {
                            echo "  <li><i class='fa fa-circle text-$colors[$i]'></i> " . $produtos[$i]["descricao"] . "</li>";
                        }

                    }
                    ?>

                </ul>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.box-body -->
    <div class="box-footer no-padding">

        <ul class="nav nav-pills nav-stacked">
            <?php
            for ($i = 0; $i < 5; $i++) {
                echo "   <li>
                <a href='#'>" . $produtos[$i]["descricao"] . "
                    <span class='pull-right text-$colors[$i]'>
                    <i class='fa fa-angle-down'></i>
                    " . floor($produtos[$i]["vendas"] * 100 / $totalVendas["total"]) . "%</span>
                </a>
            </li>";
            }
            ?>
        </ul>
    </div>
    <!-- /.footer -->
</div>
<!-- /.box -->

<script>


    // -------------
    // - PIE CHART -
    // -------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d');
    var pieChart = new Chart(pieChartCanvas);
    var PieData = [
        <?php
        for ($i = 0; $i < 10; $i++) {
            echo " {
            value: " . $produtos[$i]["vendas"] . ",
            color: '" . $colors[$i] . "',
            highlight: '" . $colors[$i] . "',
            label: '" . substr($produtos[$i]["descricao"], 0, 30) . "'
        },";
        }
        ?>
    ];
    var pieOptions = {
        // Boolean - Whether we should show a stroke on each segment
        segmentShowStroke: true,
        // String - The colour of each segment stroke
        segmentStrokeColor: '#fff',
        // Number - The width of each segment stroke
        segmentStrokeWidth: 1,
        // Number - The percentage of the chart that we cut out of the middle
        percentageInnerCutout: 50, // This is 0 for Pie charts
        // Number - Amount of animation steps
        animationSteps: 100,
        // String - Animation easing effect
        animationEasing: 'easeOutBounce',
        // Boolean - Whether we animate the rotation of the Doughnut
        animateRotate: true,
        // Boolean - Whether we animate scaling the Doughnut from the centre
        animateScale: false,
        // Boolean - whether to make the chart responsive to window resizing
        responsive: true,
        // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
        maintainAspectRatio: false,
        // String - A legend template
        legendTemplate: '<ul class=\'<%=name.toLowerCase()%>-legend\'><% for (var i=0; i<segments.length; i++){%>< li > <span style=\'background-color:<%=segments[i].fillColor%>\'></span><%if (segments[i].label) {%><%=segments[i].label %><%}%></li ><%}%></ul > ',

    };
    // Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    pieChart.Doughnut(PieData, pieOptions);
    // -----------------
    // - END PIE CHART -
    // -----------------
</script>