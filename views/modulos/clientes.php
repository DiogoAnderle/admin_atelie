<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Administrar Clientes
    </h1>
    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Clientes</li>
    </ol>
  </section>


  <section class="content">


    <div class="box">
      <div class="box-header with-border">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalCadastrarCliente">
          Cadastrar Cliente
        </button>

        <div class="box-body">
          <table class="table table-bordered table-hover tabelas table-responsive">
            <thead>
              <tr>
                <th style="width: 10px;">#</th>
                <th>Nome</th>
                <th>Telefone</th>
                <th>E-mail</th>
                <th>Profissão</th>
                <th>Data de Nascimento</th>
                <th>Total de Compras</th>
                <th>Última Compra</th>
                <th>Data de Cadastro</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody>

              <?php


              $item = null;
              $valor = null;

              $clientes = ControllerClientes::ctrMostrarClientes($item, $valor);

              foreach ($clientes as $cliente) {
                echo ' <tr>
                <td>' . $cliente["id"] . '</td>
                <td>' . $cliente["nome"] . '</td>
                <td>' . $cliente["telefone"] . '</td>
                <td>' . $cliente["email"] . '</td>
                <td>' . $cliente["profissao"] . '</td>
                <td>' . date('d/m/Y', strtotime($cliente["data_nascimento"])) . '</td>
                <td>' . $cliente["compras"] . '</td>
                <td>23/11/2023 09:40:22</td>
                <td>' . date('d/m/Y H:i:s', strtotime($cliente["data_cadastro"])) . '</td>
                <td> <div class="btn-group">
                            <button class="btn btn-warning btnEditarCliente" id="btnEditarCliente" idCliente="' . $cliente["id"] . '" data-toggle="modal" data-target="#modalEditarCliente" title="Editar"><i
                                class="fa fa-pencil"></i></button>

                            <button class="btn btn-danger btnExcluirCliente" 
                                    idCliente = "' . $cliente["id"] . '" 
                                    nomeCliente = "' . $cliente["nome"] . '" 
                                    title="Excluir">
                                    
                                    <i class="fa fa-times"></i></button>
                          </div></td>
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
MODAL CADASTRAR CLIENTE
***************************************/-->
<div class="modal fade" id="modalCadastrarCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">

      <form role="form" method="post">

        <div class="modal-header bg-primary">

          <h4 class="modal-title">Cadastrar Cliente</h4>

          <button style="position: absolute; top: -1%; right:2%; font-size=25px; border-radius:50%;" type="button"
            class="btn btn-sm btn-danger" data-dismiss="modal" aria-label="Close">
            x
          </button>

        </div>

        <div class="modal-body">
          <div class="box-body">

            <!-- Nome -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" id="novoCliente" name="novoCliente" placeholder="Nome:"
                  required>
              </div>
            </div>

            <!-- Telefone -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                <input type="tel" class="form-control input-lg" id="novoTelefone" name="novoTelefone"
                  onkeyup="handlePhone(event)" maxlength="15" placeholder="Telefone:">
              </div>
            </div>

            <!-- Email -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                <input type="email" class="form-control input-lg" id="novoEmail" name="novoEmail" placeholder="Email:">
              </div>
            </div>

            <!-- Profissão -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" id="novaProfissao" name="novaProfissao"
                  placeholder="Profissão:">
              </div>
            </div>

            <!-- Data Nascimento -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <input type="date" class="form-control input-lg" id="novaDataNascimento" name="novaDataNascimento"
                  placeholder="Data Nascimento:">
              </div>
            </div>


          </div>
          <!-- end box body -->


        </div>
        <!-- end modal body -->

        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal"
            aria-label="Close">Cancelar</button>
          <button type="submit" class="btn btn-primary">Cadastrar Cliente</button>
        </div>
        <?php
        $cadastrarCliente = new ControllerClientes();
        $cadastrarCliente->ctrCriarCliente();
        ?>
      </form>
    </div>

  </div>

</div>


<!--/***************************************
MODAL EDITAR CLIENTE
***************************************/-->
<div class="modal fade" id="modalEditarCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">

      <form role="form" method="post">

        <div class="modal-header bg-primary">

          <h4 class="modal-title">Editar Cliente</h4>

          <button style="position: absolute; top: -1%; right:2%; font-size=25px; border-radius:50%;" type="button"
            class="btn btn-sm btn-danger" data-dismiss="modal" aria-label="Close">
            x
          </button>

        </div>

        <div class="modal-body">
          <div class="box-body">

            <!-- Nome -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="hidden" id="idCliente" name="idCliente">
                <input type="text" class="form-control input-lg" id="editarCliente" name="editarCliente" required>
              </div>
            </div>

            <!-- Telefone -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                <input type="tel" class="form-control input-lg" id="editarTelefone" name="editarTelefone"
                  onkeyup="handlePhone(event)" maxlength="15">
              </div>
            </div>

            <!-- Email -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                <input type="email" class="form-control input-lg" id="editarEmail" name="editarEmail">
              </div>
            </div>

            <!-- Profissão -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" id="editarProfissao" name="editarProfissao">
              </div>
            </div>

            <!-- Data Nascimento -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <input type="date" class="form-control input-lg" id="editarDataNascimento" name="editarDataNascimento">
              </div>
            </div>


          </div>
          <!-- end box body -->


        </div>
        <!-- end modal body -->

        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal"
            aria-label="Close">Cancelar</button>
          <button type="submit" class="btn btn-primary">Salvar Cliente</button>
        </div>
        <?php
        $editarCliente = new ControllerClientes();
        $editarCliente->ctrEditarCliente();
        ?>
      </form>
    </div>

  </div>

</div>
<?php
$excluirCliente = new ControllerClientes();
$excluirCliente->ctrExcluirCliente();
?>




<!--/***************************************
Máscara campo telefone
***************************************/-->
<script>
  const handlePhone = (event) => {
    let input = event.target
    input.value = phoneMask(input.value)
  }

  const phoneMask = (value) => {
    if (!value) return ""
    value = value.replace(/\D/g, '')
    value = value.replace(/(\d{2})(\d)/, "($1) $2")
    value = value.replace(/(\d)(\d{4})$/, "$1-$2")
    return value
  }
</script>