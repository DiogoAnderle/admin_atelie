<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Criar Venda
    </h1>
    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Venda</li>
    </ol>
  </section>

  <section class="content">

    <div class="row">
      <!-- Formulário -->
      <div class="col-lg-5 col-xs-12">
        <div class="box box-success">
          <div class="box-header with-border"></div>
          <form method="post" role="form" class="formularioVenda">
            <div class="box-body">
              <div class="box">

                <!-- Vendedor -->
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input type="text" class="form-control" id="novoVendedor" name="novoVendedor"
                      value="<?php echo $_SESSION["nome"]; ?>" readonly>
                    <input type="hidden" name="idVendedor" value="<?php echo $_SESSION["id"]; ?>">
                  </div>
                </div>

                <!-- Codigo Venda -->
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-key"></i></span>

                    <?php
                    $item = null;
                    $valor = null;
                    $vendas = ControllerVendas::ctrMostrarVendas($item, $valor);

                    if (!$vendas) {
                      echo '<input type="text" class="form-control" id="novoCodigo" name="novoCodigo" value="10001" readonly>';

                    } else {
                      foreach ($vendas as $key => $venda) {

                      }
                      $codigo = $venda["codigo"] + 1;
                      echo '<input type="text" class="form-control" id="novoCodigo" name="novoCodigo" value="' . $codigo . '" readonly>';
                    }
                    ?>

                  </div>
                </div>

                <!-----------------------------------------
                 Vincular Cliente 
                ------------------------------------------>
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-users"></i></span>

                    <select name="selecionarCliente" id="selecionarCliente" required class="form-control">
                      <option value="">Selecionar Cliente</option>

                      <?php
                      $item = null;
                      $valor = null;
                      $clientes = ControllerClientes::ctrMostrarClientes($item, $valor);


                      foreach ($clientes as $key => $cliente) {
                        echo '<option value="' . $cliente["id"] . '">' . $cliente["nome"] . '</option>';

                      }


                      ?>
                    </select>

                    <span class="input-group-addon">
                      <button type="button" class="btn btn-xs" data-toggle="modal" data-target="#modalCadastrarCliente">
                        Cadastrar Cliente
                      </button>
                    </span>

                  </div>
                </div>

                <!-----------------------------------------
                        Adicionar Produto 
                ------------------------------------------>

                <div class="form-group row novoProduto">



                </div>
                <input type="hidden" id="listaProdutos" name="listaProdutos">

                <!-- Botão para Cadastrar Produto -->
                <br><br>
                <button type="button" class="btn btn-default hidden-lg btnAdicionarProdutos"> Adicionar Produto</button>
                <hr>

                <!-- Acréscimos e Total -->
                <div class="row">
                  <div class="col-xs-8 pull-right">
                    <table>
                      <thead>
                        <tr>
                          <th>Acréscimo</th>
                          <th>Total</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>

                          <td style="width:50%;">
                            <div class="input-group">
                              <input type="number" class="form-control" min="0" id="novoAcrescimoVenda"
                                name="novoAcrescimoVenda" placeholder="0">
                              <input type="hidden" name="novoValorAcrescimo" id="novoValorAcrescimo">
                              <input type="hidden" name="novoValorSemAcrescimo" id="novoValorSemAcrescimo">
                              <span class="input-group-addon"> <i class="fa fa-percent"></i></span>
                            </div>
                          </td>

                          <td style="width:50%;">
                            <div class="input-group">
                              <span class="input-group-addon" style="font-size:1.1em; font-weight:700">R$</span>
                              <input type="number" class="form-control" min="1" id="novoTotalVenda"
                                totalSemAcrescimo="0" name="novoTotalVenda" placeholder="0,00" readonly>
                              <input type="hidden" name="totalVenda" id="totalVenda">
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>

                <hr>

              </div>

            </div>
            <br>
            <div class="box-footer">
              <button type="submit" class="btn btn-primary pull-right" id="criarVenda">Criar Venda</button>
            </div>

            <?php
            $criarVenda = new ControllerVendas();
            $criarVenda->ctrCriarVenda();
            ?>
          </form>


        </div>

      </div>


      <!-----------------------------------------
                  Tabela de Produtos 
       ------------------------------------------>
      <div class="col-lg-7 hidden-md hidden-sm hidden-xs">

        <div class="box box-warning">

          <div class="box-header with-border"></div>
          <div class="box-body">
            <table class="table table-bordered-table table-hovered striped dt-responsive tabelaVendas">
              <thead>
                <tr>
                  <th style="width: 10px;">#</th>
                  <th>Imagem</th>
                  <th>Cód.</th>
                  <th>Descrição</th>
                  <th>Estoque</th>
                  <th>Valor</th>
                  <th>Ações</th>
                </tr>
              </thead>
            </table>
          </div>

        </div>

      </div>
    </div>

  </section>
  <!--/***************************************
MODAL CADASTRAR CLIENTE
***************************************/-->
  <div class="modal fade" id="modalCadastrarCliente" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                  <input type="text" class="form-control input-lg" id="novoCliente" name="novoCliente"
                    placeholder="Nome:" required>
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
                  <input type="email" class="form-control input-lg" id="novoEmail" name="novoEmail"
                    placeholder="Email:">
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


</div>