/******************************
 * Editar categoria
 ******************************/
$(".btnEditarCategoria").click(function () {
  var idCategoria = $(this).attr("idCategoria");
  var dados = new FormData();
  dados.append("idCategoria", idCategoria);

  $.ajax({
    url: "ajax/categorias.ajax.php",
    method: "POST",
    data: dados,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (response) {
      $("#editarCategoria").val(response["categoria"]);
      $("#idCategoria").val(response["id"]);
      console.log((response["categoria"]));
      console.log(response["id"]);
    },
  });
});

/******************************
 * Editar categoria
 ******************************/
$(".btnExcluirCategoria").click(function(){
  var idCategoria = $(this).attr("idCategoria");
  var nomeCategoria = $(this).attr("nomeCategoria");
  Swal.fire({
    icon: "warning",
    title: "Tem certeza que deseja excluir a categoria " + nomeCategoria,
    text: "Se não tiver certeza você pode cancelar a ação.",
    showCancelButton: true,
    confirmButtonText: "Sim, Excluir",
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.value) {
      window.location =
        "index.php?rota=categorias&idCategoria=" +
        idCategoria
    }
  });
})
