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
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
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