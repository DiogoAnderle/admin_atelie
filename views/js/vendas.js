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
                        <input type="text" class="form-control adicionarProduto" 
                                name="adicionarProduto" value = "${descricao}" required readonly>  
                        </div> 
                    </div> 

                    <div class="col-xs-3"> 
                        <div class="input-group"> 
                        <input type="number" min="1" class="form-control novoQuantidadeProduto" name = "novoQuantidadeProduto" value = "1" estoque="${estoque}" required >  
                        </div> 
                    </div> 


                    <div class="col-xs-3" style="padding-left: 0;"> 
                        <div class="input-group"> 
                        <span class="input-group-addon" style="font-size:1.1em; font-weight:700">R$</span> 
                        <input type="number" min="1" class="form-control novoPrecoProduto" name="novoPrecoProduto"  value = "${preco_venda.toFixed(2)}" readonly required > 
                        </div> 
                    </div> 
                </ > `
            )


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

                    <div class="col-xs-3 alterarQuantidade"> 
                        <div class="input-group"> 
                        <input type="number" min="1" class="form-control novoQuantidadeProduto" name = "novoQuantidadeProduto" value = "1" estoque required >  
                        </div> 
                    </div> 


                    <div class="col-xs-3 alterarPreco" style="padding-left: 0;"> 
                        <div class="input-group"> 
                        <span class="input-group-addon" style="font-size:1.1em; font-weight:700">R$</span> 
                        <input type="number" min="1" class="form-control novoPrecoProduto" name="novoPrecoProduto"  value readonly required > 
                        </div> 
                    </div> 
                </ > `);

            response.forEach(functionForEach);

            function functionForEach(item, index) {

                if (item.estoque != 0) {
                    $("#produto" + numProduto).append(
                        '<option value="' + item.id + '">' + item.descricao + '</option>'
                    )
                }
            }
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
            $(novoPrecoProduto).val(response["preco_venda"].toFixed(2))

        }
    })
})