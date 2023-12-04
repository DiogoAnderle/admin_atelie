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
          <form method="post" role="form">
            <div class="box-body">
              <div class="box">

                <!-- Vendedor -->
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input type="text" class="form-control" id="novoVendedor" name="novoVendedor"
                      value="Usuário Administrador" readonly>
                  </div>
                </div>

                <!-- Codigo Venda -->
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                    <input type="text" class="form-control" id="novaVenda" name="novaVenda" value="10125410" readonly>
                  </div>
                </div>

                <!-- Vincular Cliente -->
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-users"></i></span>

                    <select name="selecionarCliente" id="selecionarCliente" reauired class="form-control"></select>

                    <span class="input-group-addon">
                      <button type="button" class="btn btn-xs" data-toggle="modal" data-target="#modalCadastrarCliente">
                        Cadastrar Cliente
                      </button>
                    </span>

                  </div>
                </div>

                <!-- Vincular Produto -->

                <div class="row novoProduto">

                  <!-- Descricao -->
                  <div class="col-xs-6" style="padding-right: 0;">
                    <div class="input-group">
                      <span class="input-group-addon"><button class="btn btn-danger btn-xs"><i
                            class="fa fa-times"></i></button>
                      </span>
                      <input type="text" class="form-control" id="cadastrarProduto" name="cadastrarProduto"
                        placeholder="Descrição do produto" required>
                    </div>
                  </div>
                  <!-- Quantidade -->
                  <div class="col-xs-3">
                    <div class="input-group">
                      <input type="number" min="1" class="form-control" id="novoQuantidadeProduto"
                        name="novoPrnovoQuantidadeProdutoecoProduto" placeholder="0" required>
                    </div>
                  </div>

                  <!-- Preço -->
                  <div class="col-xs-3" style="padding-left: 0;">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                      <input type="number" min="1" class="form-control" id="novoPrecoProduto" name="novoPrecoProduto"
                        placeholder="0,00" readonly required>
                    </div>
                  </div>
                </div>

                <!-- Botão para Cadastrar Produto -->
                <br><br>
                <button type="button" class="btn btn-default hidden-lg"> Cadastrar Produto</button>
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
                                name="novoAcrescimoVenda" placeholder="0" required>
                              <span class="input-group-addon"> <i class="fa fa-percent"></i></span>
                            </div>
                          </td>
                          <td style="width:50%;">
                            <div class="input-group">
                              <span class="input-group-addon"> <i class="ion ion-social-usd"></i></span>
                              <input type="number" class="form-control" min="1" id="novoTotalVenda"
                                name="novoTotalVenda" placeholder="0" required readonly>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>

                <hr>

                <!-- Meio de Pagamento -->
                <div class="row">
                  <div class="col-xs-7" style="padding-right:0px ;">
                    <div class="form-group">
                      <select name="novoMetodoPagamento" id="novoMetodoPagamento" class="form-control">
                        <option value="">Selecione um método de pagamento</option>
                        <option value="a Vista">à Vista</option>
                        <option value="cartaoCredito">Cartão de Débito</option>
                        <option value="cartaoDebito">Cartão de Débito</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-xs-5" style="padding-left:0px ;">
                    <div class="input-group">
                      <input type="text" class="form-control" id="novoCodigoTransacao" name="novoCodigoTransacao"
                        required placeholder="Código da Transação">
                      <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                    </div>
                  </div>
                </div>




              </div>

            </div>
            <br>
            <div class="box-footer">
              <button type="submit" class="btn btn-primary pull-right">Criar Venda</button>
            </div>
          </form>
        </div>

      </div>
      <!-- Tabela de produtos -->
      <div class="col-lg-7 hidden-md hidden-sm hidden-xs">

        <div class="box box-warning">

          <div class="box-header with-border"></div>
          <div class="box-body">
            <table class="table table-bordered-table table-hovered striped dt-responsive tabelas">
              <thead>
                <tr>
                  <th style="width: 10px;">#</th>
                  <th>Imagem</th>
                  <th>Cód.</th>
                  <th>Descrição</th>
                  <th>Estoque</th>
                  <th>Ações</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td><img src="views/img/produtos/product-default.png" class="img-thumbnail" width="40px"></td>
                  <td>123</td>
                  <td>Lorem Ipsun dolor sit amet</td>
                  <td>20</td>
                  <td>
                    <div class="btn-group">
                      <button class="btn btn-primary btnEditarCliente" id="btnEditarCliente"
                        data-toggle="modal">Incluir</button>
                    </div>
                  </td>
                </tr>
              </tbody>

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
          //$cadastrarCliente = new ControllerClientes();
          //$cadastrarCliente->ctrCriarCliente();
          ?>
        </form>
      </div>

    </div>

  </div>


</div>