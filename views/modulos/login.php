<div id="back"></div>
<div class="login-box">

  <div class="login-logo">
  
    <a href="#"><b>4 de Nós</b> Ateliê</a>
  
</div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Faça login para iniciar sua sessão.</p>

    <form method="post">

      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Usuário" name="usuario" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Senha" name="senha" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      
      <div class="row">
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Entrar</button>
        </div>
      </div>

      <?php
        $login = new ControllerUsuarios();
        $login -> ctrLoginUsuario();

      ?>

    </form>

  </div>

</div>
