/************************************************************
 * Carregar produtos da tabela Dinamicamente via AJAX
 ************************************************************/
$.ajax({
    url: "ajax/datatable-vendas.ajax.php",
})
$('.tabelaVendas').DataTable({

    "ajax": "ajax/datatable-vendas.ajax.php",
    "deferRender": true,
    "retrieve": true,
    "processing": true,
    "language": {
        "decimal": ",",
        "thousands": ".",
        "processing": "Processando...",
        "loadingRecords": "Carregando...",
        "lengthMenu": "Mostrar _MENU_ registros",
        "search": "Pesquisar",
        "zeroRecords": "Desculpe, nada encontrado",
        "info": "Mostrando página _PAGE_ de _PAGES_",
        "infoEmpty": "Nenhum registro disponível",
        "infoFiltered": "(filtrados de um total de _MAX_ registros)",
        "paginate": {
            "first": "Primeira",
            "last": "Última",
            "next": "Próxima",
            "previous": "Anterior"
        }
    }

})

$("#criarVenda").on("click", function () {
    let cliente = $("#selecionarCliente").val()
    if (cliente == "") {
        Swal.fire({
            icon: 'error',
            title: 'Selecione um cliente para efetuar uma venda',
            confirmButtonText: 'Fechar',
        })

    }

})

/************************************************************
 * Incluir produtos na lista de vendas
 ************************************************************/

$(".tabelaVendas").on("click", "button.adicionarProduto", function () {
    let idProduto = $(this).attr("idProduto");
    $(this).removeClass("btn-primary adicionarProduto")
    $(this).addClass("btn-default")

    let dados = new FormData();
    dados.append("idProduto", idProduto);

    $.ajax({
        url: "ajax/produtos.ajax.php",
        method: "POST",
        data: dados,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (response) {
            let descricao = response["descricao"];
            let estoque = response["estoque"];
            let preco_venda = response["preco_venda"];

            if (estoque == 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Não é possível vender este produto. Estoque zerado',
                    confirmButtonText: 'Fechar',
                })
                $(`button[${idProduto = "idProduto"}`).addClass("adicionarProduto");

                return;
            }

            $(".novoProduto").append(`
                <div class="row" style = "padding: 2px 5px" > 
                    <div class="col-xs-6" style="padding-right: 0;"> 
                        <div class="input-group"> 
                        <span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs removerProduto" idProduto="${idProduto}"> 
                            <i class="fa fa-times"></i ></button>  
                        </span> 
                        <input type="text" class="form-control adicionarProduto novaDescricaoProduto" 
                                idProduto="${idProduto}"
                                name="adicionarProduto" value = "${descricao}" required readonly>  
                        </div> 
                    </div> 

                    <div class="col-xs-2"> 
                        <div class="input-group"> 
                        <input type="number" min="1" class="form-control novoQuantidadeProduto" name = "novoQuantidadeProduto" value = "1" estoque="${estoque}" novoEstoque="${Number(estoque - 1)}" required >  
                        </div> 
                    </div> 


                    <div class="col-xs-4 alterarPreco" style="padding-left: 0;"> 
                        <div class="input-group"> 
                            <span class="input-group-addon" style="font-size:1.1em; font-weight:700">R$</span> 
                            <input type="number" min="1" class="form-control novoPrecoProduto" 
                                    precoReal= "${preco_venda.toFixed(2)}" 
                                    name="novoPrecoProduto"  
                                    value = "${preco_venda.toFixed(2)}" 
                                    readonly required > 
                        </div> 
                    </div>`
            )
            // Somar Total Preços
            somarTotalPrecos()

            // Somar Acrescimo Preços
            calcularAcrescimo()

            agruparProdutos()


        }
    })
})


/***********************************************
 habilitar botão para incluir novamente mesmo 
 estando em outra aba da tabela de produtos
***********************************************/

$(".tabelaVendas").on("draw.dt", function () {

    if (localStorage.getItem("removerProduto") != null) {

        let listaIdProdutos = JSON.parse(localStorage.getItem("removerProduto"))

        for (let i = 0; i < listaIdProdutos.length; i++) {
            $(`button.recuperarBotao[idProduto = "${listaIdProdutos[i]["idProduto"]}"]`).removeClass("btn-default");
            $(`button.recuperarBotao[idProduto = "${listaIdProdutos[i]["idProduto"]}"]`).addClass("btn-primary adicionarProduto");

        }

    }
})

/***********************************************
 Remover produtos da lista de vendas e habilitar
 para incluir novamente
***********************************************/
let idRemoverProduto = [];


$(".formularioVenda").on("click", "button.removerProduto", function () {

    $(this).parent().parent().parent().parent().remove();

    let idProduto = $(this).attr("idProduto");

    //Armazena em Local Storage o produto a remover
    if (localStorage.getItem("removerProduto") == null) {

        idRemoverProduto = [];

    } else {

        idRemoverProduto.concat(localStorage.getItem("removerProduto"))
    }

    idRemoverProduto.push({ "idProduto": idProduto });

    localStorage.setItem("removerProduto", JSON.stringify(idRemoverProduto))


    $(`button.recuperarBotao[idProduto = "${idProduto}"]`).removeClass("btn-default");
    $(`button.recuperarBotao[idProduto = "${idProduto}"]`).addClass("btn-primary adicionarProduto");

    if ($(".novoProduto").children().length == 0) {
        $("#novoTotalVenda").val(0)
        $("#totalVenda").val(0)
        $("#novoTotalVenda").attr("totalSemAcrescimo", 0)
        $("#novoAcrescimoVenda").val(0)
    }
    else {
        // Somar Total Preços
        somarTotalPrecos()
        // Somar Acrescimo Preços
        calcularAcrescimo()
        agruparProdutos()
    }

})

/***********************************************
    Adicinar produto em dispositivos moveis
***********************************************/

let numProduto = 0;

$(".btnAdicionarProdutos").click(function () {

    numProduto++;

    let dados = new FormData();
    dados.append("carregarProdutos", "ok");

    $.ajax({
        url: "ajax/produtos.ajax.php",
        method: "POST",
        data: dados,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (response) {
            $(".novoProduto").append(`
                <div class="row" style = "padding: 2px 5px" > 
                    <div class="col-xs-6" style="padding-right: 0;"> 
                        <div class="input-group"> 
                            <span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs removerProduto" idProduto> 
                                <i class="fa fa-times"></i ></button>  
                            </span> 
                            <select type="text" 
                                    class="form-control novaDescricaoProduto"
                                    id ="produto${numProduto}"
                                    idProduto
                                    name="novaDescricaoProduto" required>
                                    <option>Selecione o produto</option>
                            </select>  
                        </div> 
                    </div> 

                    <div class="col-xs-2 alterarQuantidade"> 
                        <div class="input-group"> 
                        <input type="number" min="1" class="form-control novoQuantidadeProduto" name = "novoQuantidadeProduto" value = "1" estoque novoEstoque required >  
                        </div> 
                    </div> 


                    <div class="col-xs-4 alterarPreco" style="padding-left: 0;"> 
                        <div class="input-group"> 
                        <span class="input-group-addon" style="font-size:1.1em; font-weight:700">R$</span> 
                        <input type="number" min="1" class="form-control novoPrecoProduto" precoReal name="novoPrecoProduto"  value readonly required > 
                        </div> 
                    </div> 
                `);

            response.forEach(functionForEach);

            function functionForEach(item, index) {

                if (item.estoque != 0) {
                    $("#produto" + numProduto).append(
                        '<option value="' + item.id + '">' + item.descricao + '</option>'
                    )
                }


            }
            // Somar Total Preços
            somarTotalPrecos()
            // Somar Acrescimo Preços
            calcularAcrescimo()


        }
    })
})

/***********************************************
 Selecionar Produto
***********************************************/

$(".formularioVenda").on("change", "select.novaDescricaoProduto", function () {


    let idProduto = $(this).val();

    let novoQuantidadeProduto = $(this).parent().parent().parent().children(".alterarQuantidade").children(".input-group").children(".novoQuantidadeProduto");

    let novoPrecoProduto = $(this).parent().parent().parent().children(".alterarPreco").children(".input-group").children(".novoPrecoProduto");


    let dados = new FormData();
    dados.append("idProduto", idProduto)

    $.ajax({
        url: "ajax/produtos.ajax.php",
        method: "POST",
        data: dados,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (response) {
            $(novoQuantidadeProduto).attr("estoque", response["estoque"])
            $(novoQuantidadeProduto).attr("novoEstoque", Number(response["estoque"] - 1))
            $(novoPrecoProduto).val(response["preco_venda"].toFixed(2))
            $(novoPrecoProduto).attr("precoReal", response["preco_venda"].toFixed(2))

            // Somar Total Preços
            somarTotalPrecos()
            // Somar Acrescimo Preços
            calcularAcrescimo()

            agruparProdutos()

        }
    })

})

/***********************************************
 Calcular preço total do produto ao alterar
 a quantidade e limitar a quantidade vendida
 com base no estoque do produto.
***********************************************/

$(".formularioVenda").on("change", "input.novoQuantidadeProduto", function () {

    let precoVenda = $(this).parent().parent().parent().children(".alterarPreco").children().children(".novoPrecoProduto");

    precoFinal = $(this).val() * precoVenda.attr("precoReal");

    precoVenda.val(precoFinal.toFixed(2));

    let novoEstoque = Number($(this).attr("estoque")) - $(this).val();

    $(this).attr("novoEstoque", novoEstoque);

    if (Number($(this).val()) > Number($(this).attr("estoque"))) {

        $(this).val($(this).attr("estoque"));
        $(this).attr("novoEstoque", 0);

        let precoFinal = $(this).val() * precoVenda.attr("precoReal")

        precoVenda.val(precoFinal.toFixed(2));

        // Somar Total Preços
        somarTotalPrecos()
        // Somar Acrescimo Preços
        calcularAcrescimo()
        agruparProdutos()

        Swal.fire({
            icon: 'error',
            title: `Não é possível adicionar mais unidades desse produto. Restam apenas ${$(this).attr("estoque")} unidades.`,
            confirmButtonText: 'Fechar',
        });
    }
    // Somar Total Preços
    somarTotalPrecos()
    // Somar Acrescimo Preços
    calcularAcrescimo()
    agruparProdutos()
})


/***********************************************
Somar os preços dos produtos
***********************************************/

function somarTotalPrecos() {
    let precoProduto = $(".novoPrecoProduto");
    let arraySomaPreco = [];

    for (let i = 0; i < precoProduto.length; i++) {
        arraySomaPreco.push(Number($(precoProduto[i]).val()));
    }

    function somarArrayPrecos(total, numero) {
        return total + numero;
    }

    let somaTotalPrecos = arraySomaPreco.reduce(somarArrayPrecos)
    $("#novoTotalVenda").val(somaTotalPrecos.toFixed(2))
    $("#totalVenda").val(somaTotalPrecos)
    $("#novoTotalVenda").attr("totalSemAcrescimo", somaTotalPrecos.toFixed(2))
}

function calcularAcrescimo() {

    let acrescimo = $("#novoAcrescimoVenda").val();

    let precoTotal = $("#novoTotalVenda").attr("totalSemAcrescimo");

    let valorAcrescimo = Number(precoTotal * acrescimo / 100)

    let totalComAcrescimo = Number(valorAcrescimo) + Number(precoTotal)

    $("#novoTotalVenda").val(totalComAcrescimo.toFixed(2))
    $("#totalVenda").val(totalComAcrescimo)
    $("#novoValorAcrescimo").val(valorAcrescimo.toFixed(2))
    $("#novoValorSemAcrescimo").val(Number(precoTotal).toFixed(2))

}


$("#novoAcrescimoVenda").change(function () {
    calcularAcrescimo();
})

/***********************************************
Selecionar Metodo de Pagamento
***********************************************/
$("#novoMetodoPagamento").change(function () {
    let metodo = $(this).val();

    if (metodo == "Efetivo") {
        $(this).parent().parent().removeClass('col-xs-7')
        $(this).parent().parent().addClass('col-xs-4')
        $(this).parent().parent().parent().children('.entradaMetodoPagamento')
            .html(`
            <div class="col-xs-4" style="padding-left:0px ;">
                <div class="input-group">
                    <span class="input-group-addon" style="font-size:1.1em; font-weight:700">R$</span>
                    <input type="text" class="form-control" id="novoValorEfetivo" name="novoValorEfetivo"
                        placeholder="0,00">
                </div>
            </div>
            <div class="col-xs-4" id="capturarCambioEfetivo" style="padding-left:0px ;">
                <div class="input-group">
                    <span class="input-group-addon" style="font-size:1.1em; font-weight:700">R$</span>
                    <input type="text" class="form-control" id="novoCambioEfetivo" name="novoCambioEfetivo"
                           readonly required placeholder="0,00">
                </div>
            </div>`
            )
        listarMetodoPagamento()
    } else {

        $(this).parent().parent().removeClass('col-xs-4')
        $(this).parent().parent().addClass('col-xs-6')
        $(this).parent().parent().parent().children('.entradaMetodoPagamento')
            .html(`
            <div class="col-xs-6" style="padding-left:0px ;">
                <div class="input-group">
                    <input type="text" class="form-control" id="novoCodigoTransacao" name="novoCodigoTransacao"
                        placeholder="Código da Transação">
                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                </div>
            </div>`
            )

    }
})

/***********************************************
            Pagamento Efetivo
***********************************************/

$(".formularioVenda").on("change", "input#novoValorEfetivo", function () {

    let efetivo = ($(this).val()).replace(",", ".")
    let cambio = (Number(efetivo) - Number($("#novoTotalVenda").val())).toFixed(2);
    let novoCambioEfetivo = $(this).parent().parent().parent().children("#capturarCambioEfetivo").children('.input-group').children("#novoCambioEfetivo")

    novoCambioEfetivo.val(cambio.replace(".", ","))

})

/***********************************************
            Pagamento Cartao
***********************************************/

$(".formularioVenda").on("change", "input#novoCodigoTransacao", function () {
    listarMetodoPagamento()
})


/***********************************************
            Listar todos os produtos
***********************************************/

function agruparProdutos() {
    let listaProdutos = [];

    let descricao = $(".novaDescricaoProduto");
    let quantidade = $(".novoQuantidadeProduto");
    let preco = $(".novoPrecoProduto");

    for (let i = 0; i < descricao.length; i++) {
        listaProdutos.push(
            {
                "id": $(descricao[i]).attr("idProduto"),
                "descricao": $(descricao[i]).val(),
                "quantidade": $(quantidade[i]).val(),
                "estoque": $(quantidade[i]).attr("novoEstoque"),
                "preco": $(preco[i]).attr("precoReal"),
                "total": $(preco[i]).val(),
            }
        )
    }
    $("#listaProdutos").val(JSON.stringify(listaProdutos));
}

/***********************************************
            Listar metodo pagamento
***********************************************/

function listarMetodoPagamento() {

    let listarMetodos = "";

    if ($("#novoMetodoPagamento").val() == "Efetivo") {
        $("#listaMetodoPagamento").val("Efetivo");
    } else {
        $("#listaMetodoPagamento").val($("#novoMetodoPagamento").val() + "-" + $("#novoCodigoTransacao").val());
        alert($("#novoCodigoTransacao").val())
    }
}

$(".btnEditarVenda").click(function () {
    let idVenda = $(this).attr("idVenda");
    window.location = "index.php?rota=editar-venda&idVenda=" + idVenda;
})

/*=============================================
FUNÇÃO PARA DESATIVAR OS BOTÕES DE ADICIONAR
QUANDO UM PRODUTO JÁ ESTEJA ADICIONADO AO PEDIDO
=============================================*/

function removerAcaoAdicionarProduto() {

    //Capturamos todos los id de productos que fueron elegidos en la venta
    var idProdutos = $(".removerProduto");

    //Capturamos todos los botones de agregar que aparecen en la tabla
    var botoesTabela = $(".tabelaVendas tbody button.adicionarProduto");

    //Recorremos en un ciclo para obtener los diferentes idProductos que fueron agregados a la venta
    for (var i = 0; i < idProdutos.length; i++) {

        //Capturamos los Id de los productos agregados a la venta
        var botao = $(idProdutos[i]).attr("idProduto");

        //Hacemos un recorrido por la tabla que aparece para desactivar los botones de agregar
        for (var j = 0; j < botoesTabela.length; j++) {

            if ($(botoesTabela[j]).attr("idProduto") == botao) {

                $(botoesTabela[j]).removeClass("btn-primary adicionarProduto");
                $(botoesTabela[j]).addClass("btn-default");

            }
        }

    }

}

/*=============================================
CADA VEZ QUE A TABELA É CARREGADA A FUNÇÃO É
EXECUTADA
=============================================*/

$('.tabelaVendas').on('draw.dt', function () {

    removerAcaoAdicionarProduto();

})





/*=============================================
EXCLUIR VENDA
=============================================*/
$(".btnExcluirVenda").click(function () {
    let idVenda = $(this).attr("idVenda");

    Swal.fire({
        title: `Tem certeza que deseja excluir a venda #${idVenda}?`,
        text: "Se não está certo, pode cancelar a exclusão!",
        icon: 'error',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Sim, excluir venda'
    }).then(function (result) {
        if (result.value) {

            window.location = "index.php?rota=vendas&idVenda=" + idVenda;
        }

    })

})
