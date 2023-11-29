<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Administrar Categorias
    </h1>
    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Categorias</li>
    </ol>
  </section>


  <section class="content">


    <div class="box">
      <div class="box-header with-border">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalCadastrarCategoria">
          Cadastrar Categoria
        </button>

        <div class="box-body">
          <table class="table table-bordered table-hover tabelas table-responsive">
            <thead>
              <tr>
                <th style="width: 10px;">#</th>
                <th>Categoria</th>
                <th>Ações</th>
              </tr>
            </thead>

            <tbody>
              <tr>
                <td>1</td>
                <td>SUBLIMAÇÃO</td>
                <td>
                  <div class="btn-group">
                    <button class="btn btn-warning btnEditarUsuario" title="Editar"><i class="fa fa-pencil"></i></button>
                    <button class="btn btn-danger btnExcluirUsuario" title="Excluir"><i class="fa fa-times"></i></button>
                  </div>
                </td>
              </tr>
              <tr>
                <td>1</td>
                <td>SUBLIMAÇÃO</td>
                <td>
                  <div class="btn-group">
                    <button class="btn btn-warning btnEditarUsuario" title="Editar"><i class="fa fa-pencil"></i></button>
                    <button class="btn btn-danger btnExcluirUsuario" title="Excluir"><i class="fa fa-times"></i></button>
                  </div>
                </td>
              </tr>
              <tr>
                <td>1</td>
                <td>SUBLIMAÇÃO</td>
                <td>
                  <div class="btn-group">
                    <button class="btn btn-warning btnEditarUsuario" title="Editar"><i class="fa fa-pencil"></i></button>
                    <button class="btn btn-danger btnExcluirUsuario" title="Excluir"><i class="fa fa-times"></i></button>
                  </div>
                </td>
              </tr>
              <tr>
                <td>1</td>
                <td>SUBLIMAÇÃO</td>
                <td>
                  <div class="btn-group">
                    <button class="btn btn-warning btnEditarUsuario" title="Editar"><i class="fa fa-pencil"></i></button>
                    <button class="btn btn-danger btnExcluirUsuario" title="Excluir"><i class="fa fa-times"></i></button>
                  </div>
                </td>
              </tr>
              <tr>
                <td>1</td>
                <td>SUBLIMAÇÃO</td>
                <td>
                  <div class="btn-group">
                    <button class="btn btn-warning btnEditarUsuario" title="Editar"><i class="fa fa-pencil"></i></button>
                    <button class="btn btn-danger btnExcluirUsuario" title="Excluir"><i class="fa fa-times"></i></button>
                  </div>
                </td>
              </tr>

            </tbody>
          </table>
        </div>

      </div>


  </section>

</div>

/***************************************
MODAL CRIAR CATEGORIA
***************************************/
<div class="modal fade" id="modalCadastrarCategoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">

      <form role="form" method="post">

        <div class="modal-header bg-primary">

          <h4 class="modal-title">Cadastrar Categoria</h4>

          <button style="position: absolute; top: -1%; right:2%; font-size=25px; border-radius:50%;" type="button"
            class="btn btn-sm btn-danger" data-dismiss="modal" aria-label="Close">
            x
          </button>

        </div>

        <div class="modal-body">
          <div class="box-body">

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input type="text" class="form-control input-lg" id="novaCategoria" name="novaCategoria" placeholder="Categoria">
              </div>
            </div>

            </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal"
            aria-label="Close">Cancelar</button>
          <button type="submit" class="btn btn-primary">Salvar Categoria</button>
        </div>
      </form>
    </div>

  </div>

</div>

/***************************************
MODAL EDITAR USUARIO
***************************************/
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