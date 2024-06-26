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
      Administrar Fornecedores
    </h1>
    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Fornecedores</li>
    </ol>
  </section>


  <section class="content">


    <div class="box">
      <div class="box-header with-border">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalCadastrarFornecedor">
          Cadastrar Fornecedor
        </button>

        <div class="box-body">
          <table class="table table-bordered table-hover tabelas table-responsive">
            <thead>
              <tr>
                <th style="width: 10px;">#</th>
                <th>Fornecedor</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $item = null;
              $valor = null;

              $fornecedores = ControllerFornecedores::ctrMostrarFornecedores($item, $valor);

              foreach ($fornecedores as $key => $fornecedor) {
                echo '<tr>
                        <td>' . $fornecedor["id"] . '</td>
                        <td>' . $fornecedor["nome"] . '</td>
                        <td>
                          <div class="btn-group">
                            <button class="btn btn-warning btnEditarFornecedor" idFornecedor="' . $fornecedor["id"] . '" data-toggle="modal" data-target="#modalEditarFornecedor" title="Editar"><i
                                class="fa fa-pencil"></i></button>';
                if ($_SESSION["perfil"] == "Administrador") {
                  echo '

                            <button class="btn btn-danger btnExcluirFornecedor" 
                                    idFornecedor = "' . $fornecedor["id"] . '" 
                                    nomeFornecedor = "' . $fornecedor["nome"] . '" 
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
MODAL CRIAR FORNECEDOR
***************************************/-->
<div class="modal fade" id="modalCadastrarFornecedor" tabindex="-1" role="dialog"
  aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">

      <form role="form" method="post">

        <div class="modal-header bg-primary">

          <h4 class="modal-title">Cadastrar Fornecedor</h4>

          <button style="position: absolute; top: -1%; right:2%; font-size=25px; border-radius:50%;" type="button"
            class="btn btn-sm btn-danger" data-dismiss="modal" aria-label="Close">
            x
          </button>

        </div>

        <div class="modal-body">
          <div class="box-body">

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-building"></i></span>
                <input type="text" class="form-control input-lg" id="novoFornecedor" name="novoFornecedor"
                  placeholder="Fornecedor">
              </div>
            </div>

          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal"
            aria-label="Close">Cancelar</button>
          <button type="submit" class="btn btn-primary">Salvar Fornecedor</button>


        </div>
        <?php
        $criarFornecedor = new ControllerFornecedores();
        $criarFornecedor->ctrCriarFornecedor();
        ?>
      </form>
    </div>

  </div>

</div>

<!--/***************************************
MODAL EDITAR FORNECEDOR
***************************************/-->
<div class="modal fade" id="modalEditarFornecedor" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">

      <form role="form" method="post">

        <div class="modal-header bg-primary">

          <h4 class="modal-title">Editar Fornecedor</h4>

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
                <input type="text" class="form-control input-lg" id="editarFornecedor" name="editarFornecedor" value=""
                  required>
                <input type="hidden" id="idFornecedor" name="idFornecedor" required>
              </div>
            </div>

          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal"
            aria-label="Close">Cancelar</button>
          <button type="submit" class="btn btn-primary">Atualizar Fornecedor</button>
        </div>
        <?php

        $editarFornecedor = new ControllerFornecedores();
        $editarFornecedor->ctrEditarFornecedor();
        ?>
      </form>
    </div>

  </div>

</div>

<?php

$excluirFornecedor = new ControllerFornecedores();
$excluirFornecedor->ctrExcluirFornecedor();
?>