/******************************
 * Editar Cliente
 ******************************/
$(".btnEditarCliente").click(function () {
  let idCliente = $(this).attr("idCliente");
  let dados = new FormData();
  dados.append("idCliente", idCliente);

  $.ajax({
    url: "ajax/clientes.ajax.php",
    method: "POST",
    data: dados,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (response) {
      $("#idCliente").val(response["id"]);
      $("#editarCliente").val(response["nome"]);
      $("#editarTelefone").val(response["telefone"]);
      $("#editarEmail").val(response["email"]);
      $("#editarProfissao").val(response["profissao"]);
      $("#editarDataNascimento").val(response["data_nascimento"]);

    }
  });
});

/******************************
 * Excluir Cliente
******************************/

$(".btnExcluirCliente").click(function () {
  var idCliente = $(this).attr("idCliente");
  var nomeCliente = $(this).attr("nomeCliente");
  Swal.fire({
    icon: "warning",
    title: "Tem certeza que deseja excluir o cliente " + nomeCliente,
    text: "Se não tiver certeza você pode cancelar a ação.",
    showCancelButton: true,
    confirmButtonText: "Sim, Excluir",
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.value) {
      window.location =
        "index.php?rota=clientes&idCliente=" +
        idCliente
    }
  });
})

/******************************
 * Validar Cliente
 ******************************/
$("#novoCliente").change(function () {
  $(".alert").remove();
  $("#novoCliente").removeClass('vermelho');

  var validarCliente = $(this).val();
  console.log(validarCliente)
  var dados = new FormData();
  dados.append("validarCliente", validarCliente);
  $.ajax({
    url: "ajax/clientes.ajax.php",
    method: "POST",
    data: dados,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (resposta) {
      console.log(resposta)
      if (resposta) {
        $("#novoCliente")
          .parent()
          .after(
            '<div class="alert alert-warning m-2">Este cliente já existe na base de dados.</div>'
          );
        $("#novoCliente").val("");
        $("#novoCliente").focus();
        $("#novoCliente").addClass('vermelho');
      }
    },
  });
});

