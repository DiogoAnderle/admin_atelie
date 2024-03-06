/************************************************************
 * VARIAVEL LOCAL STORAGE
 ************************************************************/
if (localStorage.getItem("capturarPeriodoRelatorio") != null) {
    $("#daterange-btn-relatorio span").html(localStorage.getItem("capturarPeriodoRelatorio"));
} else {
    $("#daterange-btn-relatorio span").html('<i class="fa fa-calendar"></i> Filtrar por período');
}

/*=============================================
    FILTRAR POR PERÍODO
=============================================*/
$("#daterange-btn-relatorio").daterangepicker(
    {
        locale: {
            format: "DD/MM/YYYY",
            daysOfWeek: [
                "Dom",
                "Seg",
                "Ter",
                "Qua",
                "Qui",
                "Sex",
                "Sab",
            ],
            monthNames: [
                "Jan",
                "Fev",
                "Mar",
                "Abr",
                "Mai",
                "Jun",
                "Jul",
                "Ago",
                "Out",
                "Set",
                "Nov",
                "Dez",
            ]
        },
        ranges: {
            'Hoje': [moment(), moment()],
            'Ontem': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Últimos 7 dias': [moment().subtract(6, "days"), moment()],
            'Últimos 30 dias': [moment().subtract(29, "days"), moment()],
            'Mês Atual': [moment().startOf("month"), moment().endOf("month")],
            'Mês anterior': [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf("month")],
        },
        startDate: moment(),
        endDate: moment()
    },
    function (start, end) {
        $("#daterange-btn-relatorio span").html(start.format("DD/MM/YYYY") + ' - ' + end.format("DD/MM/YYYY"))

        let dataInicial = start.format('YYYY-MM-DD')

        let dataFinal = end.format('YYYY-MM-DD')

        let capturarPeriodoRelatorio = $("#daterange-btn-relatorio span").html();

        localStorage.setItem("capturarPeriodoRelatorio", capturarPeriodoRelatorio);

        window.location = "index.php?rota=relatorios&dataInicial=" + dataInicial + "&dataFinal=" + dataFinal;

    }
)

/*=============================================
FILTRAR POR PERÍODO
=============================================*/
$(".daterangepicker.opensright .range_inputs .cancelBtn").on("click", function () {
    localStorage.removeItem("capturarPeriodoRelatorio");
    localStorage.clear();
    window.location = "relatorios";
})

/*=============================================
CAPTURAR HOJE
=============================================*/
$(".daterangepicker.opensright .ranges li").on("click", function () {
    let dataInicial = ""
    let dataFinal = ""
    let textoHoje = ($(this).attr("data-range-key"))

    if (textoHoje == "Hoje") {
        let dataAtual = new Date();
        let dia = dataAtual.getDate();
        let mes = dataAtual.getMonth() + 1;
        let ano = dataAtual.getFullYear();

        if (mes < 10 && dia < 10) {
            dataInicial = ano + "-0" + mes + "-0" + dia
            dataFinal = ano + "-0" + mes + "-0" + dia
        }
        else if (mes < 10) {
            dataInicial = ano + "-0" + mes + "-" + dia
            dataFinal = ano + "-0" + mes + "-" + dia

        } else if (dia < 10) {
            dataInicial = ano + "-" + mes + "-0" + dia
            dataFinal = ano + "-" + mes + "-0" + dia

        } else {
            dataInicial = ano + "-" + mes + "-" + dia
            dataFinal = ano + "-" + mes + "-" + dia
        }


        localStorage.setItem("capturarPeriodoRelatorio", "Hoje")
        window.location = "index.php?rota=relatorios&dataInicial=" + dataInicial + "&dataFinal=" + dataFinal;
    }
})