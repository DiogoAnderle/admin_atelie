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
            Efetuar Venda
          </button>
        </a>

        <button type="button" class="btn btn-default pull-right" id="daterange-btn">
          <span>
            <i class="fa fa-calendar"></i> Filtrar por período
          </span>
          <i class="fa fa-caret-down"></i>
        </button>

        <div class="box-body">
          <table class="table table-bordered table-hover tabelas table-responsive">
            <thead>
              <tr>
                <th style="width: 10px;">#</th>
                <th>Código fatura</th>
                <th>Cliente</th>
                <th>Vendedor</th>
                <th>Total</th>
                <th>Data</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if (isset($_GET["dataInicial"])) {
                $dataInicial = $_GET["dataInicial"];
                $dataFinal = $_GET["dataFinal"];
              } else {
                $dataInicial = null;
                $dataFinal = null;
              }

              $vendas = ControllerVendas::ctrPeriodoDatasVendas($dataInicial, $dataFinal);

              foreach (@$vendas as $key => $venda) {
                echo '
                <tr>
                  <td style="width: 10px;">' . $venda["id"] . '</td>
                  <td>' . $venda["codigo"] . '</td>';
                $itemCliente = "id";
                $valorCliente = $venda["cliente_id"];
                $cliente = ControllerClientes::ctrMostrarClientes($itemCliente, $valorCliente);
                echo '<td>' . $cliente["nome"] . '</td>';
                $itemVendedor = "id";
                $valorVendedor = $venda["vendedor_id"];
                $vendedor = ControllerUsuarios::crtMostrarUsuarios($itemVendedor, $valorVendedor);
                $nomeVendedor = explode(" ", $vendedor["nome"]);
                echo '
                  <td>' . $nomeVendedor[0] . '</td>
                  <td>R$ ' . number_format($venda["total"], 2, ",", ".") . '</td>
                  <td>' . date('d/m/Y H:i:s', strtotime($venda["data_venda"])) . '</td>
                  <td>
                    <div class="btn-group">
                      <button class="btn btn-primary btnImprimirFatura" codigoVenda ="' . $venda["codigo"] . '" title="Imprimir">
                        <i class="fa fa-print"></i>
                      </button>

                        <button class="btn btn-warning btnEditarVenda" 
                                idVenda ="' . $venda["id"] . '"
                                title="Editar"><i class="fa fa-pencil"></i>
                        </button>

                      <button class="btn btn-danger btnExcluirVenda" 
                              idVenda ="' . $venda["id"] . '"
                              title="Excluir"><i class="fa fa-times"></i>
                      </button>
                    </div>
                  </td>
                </tr>';
              }
              ?>

            </tbody>
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

          <?php
          $excluirVenda = new ControllerVendas();
          $excluirVenda->ctrExcluirVenda();
          ?>

        </div>

      </div>


  </section>

</div>