<?php
if ($_SESSION["perfil"] == "Vendedor") {
  echo "<script>
          window.location = 'inicio';
      </script>";
}
?>

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
              <?php
              $item = null;
              $valor = null;

              $categorias = ControllerCategorias::ctrMostrarCategorias($item, $valor);

              foreach ($categorias as $key => $categoria) {
                echo '<tr>
                        <td>' . $categoria["id"] . '</td>
                        <td>' . $categoria["categoria"] . '</td>
                        <td>
                          <div class="btn-group">
                            <button class="btn btn-warning btnEditarCategoria" idCategoria="' . $categoria["id"] . '" data-toggle="modal" data-target="#modalEditarCategoria" title="Editar"><i
                                class="fa fa-pencil"></i></button>';
                if ($_SESSION["perfil"] == "Administrador") {
                  echo '

                            <button class="btn btn-danger btnExcluirCategoria" 
                                    idCategoria = "' . $categoria["id"] . '" 
                                    nomeCategoria = "' . $categoria["categoria"] . '" 
                                    title="Excluir">
                                    
                                    <i class="fa fa-times"></i></button>';
                }
                echo '</div>
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
MODAL CRIAR CATEGORIA
***************************************/-->
<div class="modal fade" id="modalCadastrarCategoria" tabindex="-1" role="dialog"
  aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                <input type="text" class="form-control input-lg" id="novaCategoria" name="novaCategoria"
                  placeholder="Categoria">
              </div>
            </div>

          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal"
            aria-label="Close">Cancelar</button>
          <button type="submit" class="btn btn-primary">Salvar Categoria</button>
        </div>
        <?php
        $criarCategoria = new ControllerCategorias();
        $criarCategoria->ctrCriarCategoria();
        ?>
      </form>
    </div>

  </div>

</div>


<!--/***************************************
MODAL EDITAR CATEGORIA
***************************************/-->
<div class="modal fade" id="modalEditarCategoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">

      <form role="form" method="post">

        <div class="modal-header bg-primary">

          <h4 class="modal-title">Editar Categoria</h4>

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
                <input type="text" class="form-control input-lg" id="editarCategoria" name="editarCategoria" value=""
                  required>
                <input type="hidden" id="idCategoria" name="idCategoria" required>
              </div>
            </div>

          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal"
            aria-label="Close">Cancelar</button>
          <button type="submit" class="btn btn-primary">Atualizar Categoria</button>
        </div>
        <?php

        $editarCategoria = new ControllerCategorias();
        $editarCategoria->ctrEditarCategoria();
        ?>
      </form>
    </div>

  </div>

</div>

<?php

$excluirCategoria = new ControllerCategorias();
$excluirCategoria->ctrExcluirCategorias();
?>