<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Administrar Vendas
    </h1>
    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Vendas</li>
    </ol>
  </section>


  <section class="content">


    <div class="box">
      <div class="box-header with-border">
        <a href="criar-venda">
          <button class="btn btn-primary" data-toggle="modal" data-target="#modalCadastrarCliente">
            Cadastrar Cliente
          </button>
        </a>

        <div class="box-body">
          <table class="table table-bordered table-hover tabelas table-responsive">
            <thead>
              <tr>
                <th style="width: 10px;">#</th>
                <th>Código fatura</th>
                <th>Cliente</th>
                <th>Vendedor</th>
                <th>Forma de Pagamento</th>
                <th>Subtotal</th>
                <th>Total</th>
                <th>Data</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody>

              <tr>
                <td style="width: 10px;">1</td>
                <td>10000123</td>
                <td>Diogo Anderle</td>
                <td>Patrícia de Souza Costa</td>
                <td>TC-12412425346</td>
                <td>R$ 850,00</td>
                <td>R$ 1.190,00</td>
                <td>11/12/2023 08:05:44</td>
                <td>
                  <div class="btn-group">
                    <button class="btn btn-primary btnEditarCliente" id="btnEditarCliente" data-toggle="modal"
                      data-target="#modalEditarCliente" title="Editar"><i class="fa fa-print"></i></button>

                    <button class="btn btn-danger btnExcluirCliente" title="Excluir">
                      <i class="fa fa-times"></i></button>
                  </div>
                </td>
              </tr>
              </thead>
              <!--
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
-->
            </tbody>
          </table>
        </div>

      </div>


  </section>

</div>

<?php
//$excluirCliente = new ControllerClientes();
//$excluirCliente->ctrExcluirCliente();
?>