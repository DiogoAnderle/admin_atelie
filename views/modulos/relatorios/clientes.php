<div class="box box-primary">
    <div class="box-header with-border">
        <h3>Clientes</h3>
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
            { y: 'Patrícia', a: 10000 },
            { y: 'Diogo', a: 7500 },
            { y: 'Sarah', a: 15000 },

        ],
        barColors: ['#f6a'],
        xkey: 'y',
        ykeys: ['a'],
        labels: ['Clientes'],
        preUnits: 'R$ ',
        hideHover: 'auto'
    });

</script>