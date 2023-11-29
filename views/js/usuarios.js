/******************************
 * Upload de imagem
 ******************************/

$(".novaImagem").change(function () {
  var imagem = this.files[0];
  /******************************
   * validando tipo de imagem
   ******************************/
  if (
    imagem["type"] != "image/jpeg" &&
    imagem["type"] != "image/jpg" &&
    imagem["type"] != "image/png"
  ) {
    Swal.fire({
      icon: "error",
      title: "Algo deu errado!",
      text: "Imagem deve estar no formato JPG ou PNG.",
      confirmButtonText: "Fechar",
    });
  } else if (imagem["size"] > 20000000) {
    Swal.fire({
      icon: "error",
      title: "Algo deu errado!",
      text: "Imagem deve ser menor que 20MB.",
      confirmButtonText: "Fechar",
    });
  } else {
    var dadosImagem = new FileReader();

    dadosImagem.readAsDataURL(imagem);

    $(dadosImagem).on("load", function (event) {
      const rotaImagem = event.target.result;

      $(".previsualizar").attr("src", rotaImagem);
    });
  }
});

/******************************
 * Editar usuário
 ******************************/
$(document).on("click", ".btnEditarUsuario", function () {
  const idUsuario = $(this).attr("idUsuario");

  const dados = new FormData();
  dados.append("idUsuario", idUsuario);

  $.ajax({
    url: "ajax/usuarios.ajax.php",
    method: "POST",
    data: dados,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (resposta) {
      $("#editarNome").val(resposta["nome"]);
      $("#editarUsuario").val(resposta["usuario"]);

      $("#editarPerfil").html(resposta["perfil"]);
      $("#editarPerfil").val(resposta["perfil"]);

      $("#imagemAtual").val(resposta["imagem"]);

      $("#senhaAtual").val(resposta["senha"]);

      if (resposta["imagem"]) {
        $(".previsualizar").attr("src", resposta["imagem"]);
      }
    },
  });
});

/******************************
 * Ativar usuário
 ******************************/
$(document).on("click", ".btnAtivar", function () {
  let idUsuario = $(this).attr("idUsuario");
  let estadoUsuario = $(this).attr("estadoUsuario");

  var dados = new FormData();
  dados.append("ativarId", idUsuario);
  dados.append("ativarUsuario", estadoUsuario);

  $.ajax({
    url: "ajax/usuarios.ajax.php",
    method: "POST",
    data: dados,
    cache: false,
    contentType: false,
    processData: false,
    success: function (resposta) {
      if (window.matchMedia("(max-width:767px)").matches) {
        Swal.fire({
          icon: "success",
          title: "Usuário atualizado com sucesso.",
          confirmButtonText: "Fechar",
        }).then(function(result){
          if (result.value) {
            window.location = "usuarios";
          }
        });
      }
    },
  });

  if (estadoUsuario == 0) {
    $(this).removeClass("btn-success");
    $(this).addClass("btn-danger");
    $(this).html("Inativo");
    $(this).attr("estadoUsuario", 1);
  } else {
    $(this).addClass("btn-success");
    $(this).removeClass("btn-danger");
    $(this).html("Ativo");
    $(this).attr("estadoUsuario", 0);
  }
});

/******************************
 * Verificar se  usuário já existe
 ******************************/

$("#usuario").change(function () {
  $(".alert").remove();

  let usuario = $(this).val();

  var dados = new FormData();
  dados.append("validarUsuario", usuario);
  $.ajax({
    url: "ajax/usuarios.ajax.php",
    method: "POST",
    data: dados,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (resposta) {
      if (resposta) {
        $("#usuario")
          .parent()
          .after(
            '<div class="alert alert-warning">Este usuário já existe na base de dados.</div>'
          );
        $("#usuario").val("");
      }
    },
  });
});

/******************************
 * Excluir usuário
 ******************************/
$(document).on("click", ".btnExcluirUsuario", function () {
  let idUsuario = $(this).attr("idUsuario");
  let imagemUsuario = $(this).attr("imagemUsuario");
  let nomeUsuario = $(this).attr("nomeUsuario");
  let usuario = $(this).attr("usuario");
  Swal.fire({
    icon: "warning",
    title: "Tem certeza que deseja excluir o usuário " + nomeUsuario,
    text: "Se não tiver certeza você pode cancelar a ação.",
    showCancelButton: true,
    confirmButtonText: "Sim, Excluir",
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.value) {
      window.location =
        "index.php?rota=usuarios&idUsuario=" +
        idUsuario +
        "&imagemUsuario=" +
        imagemUsuario +
        "&usuario=" +
        usuario;
    }
  });
});
