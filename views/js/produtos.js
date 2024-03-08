/************************************************************
 * Carregar produtos da tabela Dinamicamente via AJAX
 ************************************************************/
/*$.ajax({
  url: "ajax/datatable-produtos.ajax.php",
  success: function (response) {
    console.log("Resposta", response);
  }
})*/

const perfilOculto = $('#perfilOculto').val();


var table = $('.tabelaProdutos').DataTable({

  "ajax": "ajax/datatable-produtos.ajax.php?perfil=" + perfilOculto,
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
         Ativar os botões com os ID correspondentes
 ************************************************************/
$('.tabelaProdutos tbody').on('click', 'button', function () {
  let data = table.row($(this).parents('tr')).data();
  $(this).attr('idProduto')
})


/************************************************************
         * Montar Código do produto com base na 
         * categoria e ultimo codigo cadastrado
 ************************************************************/

$("#novaCategoria").change(function () {
  let idCategoria = $(this).val();
  let dados = new FormData();
  dados.append("idCategoria", idCategoria);

  $.ajax({
    url: "ajax/produtos.ajax.php",
    method: "POST",
    data: dados,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (response) {

      if (!response) {

        let novoCodigo = idCategoria + "01";
        $("#novoCodigo").val(novoCodigo);

      } else {

        let novoCodigo = Number(response["codigo"]) + 1;
        $("#novoCodigo").val(novoCodigo);

      }
    }
  })
})


/************************************************************
         <Montar preço de venda com base na porcentagem
         e na alteração do campo preço de compra
 ************************************************************/
$(".porcentagem").on("ifUnchecked", function () {
  $("#novoPrecoVenda").prop("readonly", false)
  $("#editarPrecoVenda").prop("readonly", false)
})

$(".porcentagem").on("ifChecked", function () {
  $("#novoPrecoVenda").prop("readonly", true);
  $("#editarPrecoVenda").prop("readonly", true);
})

$("#novoPrecoCompra").change(function () {

  if ($(".porcentagem").prop("checked")) {

    let valorPorcentagem = $("#novaPorcentagem").val();


    let porcentagem = Number(($("#novoPrecoCompra").val() * valorPorcentagem / 100)) + Number($("#novoPrecoCompra").val())

    $("#novoPrecoVenda").val(porcentagem);

  };

})

$("#editarPrecoCompra").change(function () {

  if ($("#utilizarEditarPorcentagem").prop("checked")) {

    let valorPorcentagem = $("#editarPorcentagem").val();

    let editarPorcentagem = Number(($("#editarPrecoCompra").val() * valorPorcentagem / 100)) + Number($("#editarPrecoCompra").val())

    $("#editarPrecoVenda").val(editarPorcentagem);

  };

})

/************************************************************
         Montar preço de venda com base na porcentagem
         e na alteração do campo porcentagem
 ************************************************************/

$("#novaPorcentagem").change(function () {

  if ($(".porcentagem").prop("checked")) {

    let valorPorcentagem = $("#novaPorcentagem").val();


    let porcentagem = Number(($("#novoPrecoCompra").val() * valorPorcentagem / 100)) + Number($("#novoPrecoCompra").val())

    $("#novoPrecoVenda").val(porcentagem);

  };

})

$("#editarPorcentagem").change(function () {

  if ($("#utilizarEditarPorcentagem").prop("checked")) {

    let valorPorcentagem = $("#editarPorcentagem").val();

    let editarPorcentagem = Number(($("#editarPrecoCompra").val() * valorPorcentagem / 100)) + Number($("#editarPrecoCompra").val())

    $("#editarPrecoVenda").val(editarPorcentagem);


  };

})

/******************************
 * Upload de imagem
 ******************************/

$(".novaImagem").change(function () {
  let imagem = this.files[0];
  /******************************
   * validando tipo de imagem
   ******************************/
  if (
    imagem["type"] != "image/jpeg" &&
    imagem["type"] != "image/jpg" &&
    imagem["type"] != "image/png"
  ) {

    $(".novaImagem").val("")

    Swal.fire({
      icon: "error",
      title: "Algo deu errado!",
      text: "Imagem deve estar no formato JPG ou PNG.",
      confirmButtonText: "Fechar",
    });
  } else if (imagem["size"] > 20000000) {

    $(".novaImagem").val("")

    Swal.fire({
      icon: "error",
      title: "Algo deu errado!",
      text: "Imagem deve ser menor que 20MB.",
      confirmButtonText: "Fechar",
    });
  } else {

    let dadosImagem = new FileReader();
    dadosImagem.readAsDataURL(imagem);

    $(dadosImagem).on("load", function (event) {
      const rotaImagem = event.target.result;

      $(".previsualizar").attr("src", rotaImagem);
    });
  }
});

$(".tabelaProdutos tbody").on("click", "button.btnEditarProduto", function () {
  let idProduto = $(this).attr('idProduto');
  let dados = new FormData();
  dados.append("idProduto", idProduto);

  $.ajax({
    url: "ajax/produtos.ajax.php",
    method: "POST",
    data: dados,
    cache: false,
    processData: false,
    contentType: false,
    dataType: "json",
    success: function (response) {
      let dadosCategoria = new FormData();
      dadosCategoria.append("idCategoria", response["categoria_id"]);

      $.ajax({
        url: "ajax/categorias.ajax.php",
        method: "POST",
        data: dadosCategoria,
        cache: false,
        processData: false,
        contentType: false,
        dataType: "json",
        success: function (response) {

          $("#editarCategoria").val(response["id"]);
          $("#editarCategoria").html(response["categoria"]);

        }
      })
      $("#editarCodigo").val(response["codigo"]);
      $("#editarDescricao").val(response["descricao"]);
      $("#editarEstoque").val(response["estoque"]);
      $("#editarPrecoCompra").val(response["preco_compra"]);
      $("#editarPrecoVenda").val(response["preco_venda"]);

      if (response["imagem"] != "") {
        $("#imagemAtual").val(response["imagem"]);
        $(".previsualizar").attr("src", response["imagem"]);

      }

    }
  });
})

$(".tabelaProdutos tbody").on("click", "button.btnExcluirProduto", function () {
  let idProduto = $(this).attr('idProduto');
  let codigo = $(this).attr('codigo');
  let imagem = $(this).attr('imagem');
  let descricao = $(this).attr('descricao');

  console.log(descricao)

  Swal.fire({
    icon: "warning",
    title: "Tem certeza que deseja excluir o produto " + descricao,
    text: "Se não tiver certeza você pode cancelar a ação.",
    showCancelButton: true,
    confirmButtonText: "Sim, Excluir",
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.value) {
      window.location =
        "index.php?rota=produtos&idProduto=" +
        idProduto +
        "&imagem=" +
        imagem +
        "&codigo=" +
        codigo;
    }
  });

})

