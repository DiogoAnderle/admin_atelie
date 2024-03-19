/******************************
 * Editar categoria
 ******************************/
$(".btnEditarFornecedor").click(function () {
  var idFornecedor = $(this).attr("idFornecedor");
  var dados = new FormData();
  dados.append("idFornecedor", idFornecedor);

  $.ajax({
    url: "ajax/fornecedores.ajax.php",
    method: "POST",
    data: dados,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (response) {
      $("#editarFornecedor").val(response["nome"]);
      $("#idFornecedor").val(response["id"]);
    },
  });
});

/******************************
 * Excluir Fornecedor
*  ******************************/

$(".btnExcluirFornecedor").click(function () {
  var idFornecedor = $(this).attr("idFornecedor");
  var nomeFornecedor = $(this).attr("nomeFornecedor");
  Swal.fire({
    icon: "warning",
    title: "Tem certeza que deseja excluir o fornecedor " + nomeFornecedor,
    text: "Se não tiver certeza você pode cancelar a ação.",
    showCancelButton: true,
    confirmButtonText: "Sim, Excluir",
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.value) {
      window.location =
        "index.php?rota=fornecedores&idFornecedor=" +
        idFornecedor
    }
  });
})


/******************************
 * Verificar se  usuário já existe
 ******************************/

$("#novoFornecedor").change(function () {
  $(".alert").remove();
  $("#novoFornecedor").removeClass('vermelho');
  let novoFornecedor = $(this).val();

  var dados = new FormData();
  dados.append("validarFornecedor", novoFornecedor);
  $.ajax({
    url: "ajax/fornecedores.ajax.php",
    method: "POST",
    data: dados,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (resposta) {
      if (resposta) {
        $("#novoFornecedor")
          .parent()
          .after(
            '<div class="alert alert-danger" style="margin: 10px 0px">Este fornecedor já existe na base de dados.</div>'
          );
        $("#novoFornecedor").val("");
        $("#novoFornecedor").focus();
        $("#novoFornecedor").addClass('vermelho');

      }
    },
  });
});
