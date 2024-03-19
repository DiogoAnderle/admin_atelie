<div id="back"></div>
<div class="login-box">

  <div class="login-logo">

    <a href="#"><b>4 de Nós</b> Ateliê</a>

  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Faça login para iniciar sua sessão.</p>

    <form method="post">

      <div class="form-group">
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-user" style="width:20px;"></i></span>
          <input type="text" class="form-control" placeholder="Usuário" name="usuario" id="usuarioLogin" required>
        </div>
      </div>

      <div class="form-group">
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-lock" style="width:20px;"></i> </span>
          <span style="position:relative;">
            <input type="password" class="form-control" placeholder="Senha" name="senha" id="senhaLogin" required>
            <i style="position:absolute; margin:10px -25px; z-index:10; font-size:1.2em" class="fa fa-eye-slash"
              id="mostrarOcultarSenha"></i>
          </span>

        </div>
      </div>

      <div class="row">
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Entrar</button>
        </div>
      </div>

      <?php
      $login = new ControllerUsuarios();
      $login->ctrLoginUsuario();

      ?>

    </form>

  </div>

</div>


<script>

  let mostrarSenha = document.getElementById("mostrarOcultarSenha");

  function alterarTipo() {

    let inputSenha = document.getElementById("senhaLogin")
    if (inputSenha.type === "password") {
      inputSenha.type = "text"
      mostrarSenha.classList.toggle("fa-eye-slash")
      mostrarSenha.classList.toggle("fa-eye")
    } else if (inputSenha.type === "text") {
      inputSenha.type = "password"
      mostrarSenha.classList.toggle("fa-eye-slash")
      mostrarSenha.classList.toggle("fa-eye")
    }

  }

  mostrarSenha.onclick = () => {
    alterarTipo()
  }




</script>