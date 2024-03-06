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
            { y: 'Patrícia', a: 10000 },
            { y: 'Diogo', a: 7500 },
            { y: 'Sarah', a: 15000 },

        ],
        barColors: ['#0af'],
        xkey: 'y',
        ykeys: ['a'],
        labels: ['Vendas'],
        preUnits: 'R$ ',
        hideHover: 'auto'
    });

</script>