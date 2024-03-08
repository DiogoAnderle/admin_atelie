<?php
if ($_SESSION["perfil"] != "Administrador") {
  echo "<script>
          window.location = 'inicio';
      </script>";
}
?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Administrar Usuários
    </h1>
    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Usuários</li>
    </ol>
  </section>


  <section class="content">


    <div class="box">
      <div class="box-header with-border">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalCadastrarUsuario">
          Cadastrar Usuário
        </button>

        <div class="box-body">
          <table class="table table-bordered table-hover tabelas table-responsive">
            <thead>
              <tr>
                <th style="width: 10px;">#</th>
                <th>Nome</th>
                <th>Usuário</th>
                <th>Foto</th>
                <th>Perfil</th>
                <th>Estado</th>
                <th>Último Login</th>
                <th>Ações</th>
              </tr>
            </thead>

            <tbody>
              <?php

              $item = null;
              $valor = null;
              $usuarios = ControllerUsuarios::crtMostrarUsuarios($item, $valor);

              foreach ($usuarios as $key => $usuario) {

                echo '<tr>
                <td>' . $usuario["id"] . '</td>
                <td>' . $usuario["nome"] . '</td>
                <td>' . $usuario["usuario"] . '</td>';
                if ($usuario["imagem"] != "") {
                  echo '<td><img src="' . $usuario["imagem"] . '" width="40px" alt="user-image" userId="' . $usuario["id"] . '"srcset=""></td>';
                } else {

                  echo '<td><img src="views\img\usuarios\user-default.png" width="40px" alt="user-image"></td>';
                }

                echo '<td>' . $usuario["perfil"] . '</td>';
                if ($usuario["estado"] != 0) {

                  echo ' <td><button class="btn btn-success btn-xs btnAtivar" idUsuario="' . $usuario['id'] . '" estadoUsuario="0">Ativo</button></td>';
                } else {

                  echo ' <td><button class="btn btn-danger btn-xs btnAtivar" idUsuario="' . $usuario['id'] . '" estadoUsuario="1">Inativo</button></td>';
                }

                if ($usuario["ultimo_login"] != null) {

                  echo '<td>' . date('d/m/Y h:m:s', strtotime($usuario["ultimo_login"])) . '</td>';
                } else {

                  echo '<td>Usuário ainda não fez login</td>';
                }

                echo '<td>
                  <div class="btn-group">
                    <button class="btn btn-warning btnEditarUsuario" id="' . $usuario["id"] . '" idUsuario="' . $usuario["id"] . '"  title="Editar" data-toggle="modal" data-target="#modalEditarUsuario"><i class="fa fa-pencil"></i></button>
                    <button class="btn btn-danger btnExcluirUsuario" 
                      idUsuario="' . $usuario["id"] . '" 
                      imagemUsuario="' . $usuario["imagem"] . '" 
                      nomeUsuario="' . $usuario["nome"] . '"
                      usuario="' . $usuario["usuario"] . '"
                      title="Excluir"><i class="fa fa-times"></i></button>
                  </div>
                </td>
              </tr>';
              }


              ?>


            </tbody>
          </table>
        </div>

      </div>


  </section>

</div>


<!--/***************************************
MODAL CRIAR USUÁRIO
***************************************/-->
<div class="modal fade" id="modalCadastrarUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">
        <input type="hidden">

        <div class="modal-header bg-primary">

          <h4 class="modal-title">Cadastrar Usuário</h4>

          <button style="position: absolute; top: -1%; right:2%; font-size=25px; border-radius:50%;" type="button"
            class="btn btn-sm btn-danger" data-dismiss="modal" aria-label="Close">
            x
          </button>

        </div>

        <div class="modal-body">
          <div class="box-body">

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" id="nome" name="nome" placeholder="Nome Completo">
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                <input type="text" class="form-control input-lg" name="usuario" id="usuario" placeholder="Usuario"
                  required>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input type="password" class="form-control input-lg" name="senha" placeholder="Senha" required>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select class="form-control input-lg" name="perfil" required>
                  <option value="" id="perfil">--Selecione um perfil--</option>
                  <option value="Administrador">Administrador</option>
                  <option value="Especial">Especial</option>
                  <option value="Vendedor">Vendedor</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <div class="panel">Enviar Imagem</div>
              <input type="file" class="form-control input-lg novaImagem" name="novaImagem">
              <p class="help-block">Tamanho máximo da imagem 20MB</p>
              <img src="views\img\usuarios\user-default.png" class="img-thumbnail previsualizar" width="100px">
            </div>


          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal"
            aria-label="Close">Cancelar</button>
          <button type="submit" class="btn btn-primary">Salvar Usuário</button>
        </div>
        <?php
        $criarUsuario = new ControllerUsuarios();
        $criarUsuario->ctrCriarUsuario();
        ?>
      </form>
    </div>

  </div>

</div>

<!--/***************************************
MODAL EDITAR USUÁRIO
***************************************/-->
<div class="modal fade" id="modalEditarUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <div class="modal-header bg-primary">

          <h4 class="modal-title">Editar Usuário</h4>

          <button style="position: absolute; top: -1%; right:2%; font-size=25px; border-radius:50%;" type="button"
            class="btn btn-sm btn-danger" data-dismiss="modal" aria-label="Close">
            x
          </button>

        </div>

        <div class="modal-body">
          <div class="box-body">
            <input type="hidden" class="form-control input-lg" id="editarIdUsuario" name="editarIdUsuario" value="">
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" id="editarNome" name="editarNome" value="">
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                <input type="text" class="form-control input-lg" readonly id="editarUsuario" name="editarUsuario">
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input type="password" class="form-control input-lg" name="editarSenha" id="editarSenha"
                  placeholder="Insira uma nova senha">
                <input type="hidden" name="senhaAtual" id="senhaAtual">
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select class="form-control input-lg" name="editarPerfil">
                  <option value="" id="editarPerfil"></option>
                  <option value="Administrador">Administrador</option>
                  <option value="Especial">Especial</option>
                  <option value="Vendedor">Vendedor</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <div class="panel">Enviar Imagem</div>
              <input type="file" class="form-control input-lg novaImagem" name="editarImagem">
              <p class="help-block">Tamanho máximo da imagem 20MB</p>
              <img src="views\img\usuarios\user-default.png" class="img-thumbnail previsualizar" width="100px">
              <input type="hidden" name="imagemAtual" id="imagemAtual">
            </div>


          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal"
            aria-label="Close">Cancelar</button>
          <button type="submit" class="btn btn-primary">Atualizar Usuário</button>
        </div>
        <?php
        $editarUsuario = new ControllerUsuarios();
        $editarUsuario->ctrEditarUsuario();
        ?>
      </form>
    </div>

  </div>

</div>
<?php
$excluirUsuario = new ControllerUsuarios();
$excluirUsuario->ctrExcluirUsuario();
?>