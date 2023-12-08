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
                <?php
                $item = 'id';
                $valor = $_GET["idVenda"];
                $venda = ControllerVendas::ctrMostrarVendas($item, $valor);

                $itemVendedor = 'id';
                $valorVendedor = $venda["vendedor_id"];
                $vendedor = ControllerUsuarios::crtMostrarUsuarios($itemVendedor, $valorVendedor);

                $itemCliente = 'id';
                $valorCliente = $venda["cliente_id"];
                $cliente = ControllerClientes::ctrMostrarClientes($itemCliente, $valorCliente);
                $porcentagemAcrescimo = $venda["acrescimo"] * 100 / $venda["subtotal"];
                ?>

                <!-- Vendedor -->
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input type="text" class="form-control" id="novoVendedor" name="novoVendedor"
                      value="<?php echo $vendedor["nome"]; ?>" readonly>
                    <input type="hidden" name="idVendedor" value="<?php echo $vendedor["id"]; ?>">
                  </div>
                </div>

                <!-- Codigo Venda -->
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                    <input type="text" class="form-control" id="editarCodigo" name="editarCodigo"
                      value="<?php echo $venda["codigo"]; ?>" readonly>
                  </div>
                </div>

                <!-----------------------------------------
                 Vincular Cliente 
                ------------------------------------------>
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-users"></i></span>

                    <select name="selecionarCliente" id="selecionarCliente" required class="form-control">
                      <option value="<?php echo $cliente["id"]; ?>">
                        <?php echo $cliente["nome"]; ?>
                      </option>
                      <?php
                      $item = null;
                      $valor = null;
                      $clientes = ControllerClientes::ctrMostrarClientes($item, $valor);


                      foreach ($clientes as $key => $cliente) {
                        echo '<option value="' . $cliente["id"] . '">' . $cliente["nome"] . '</option>';

                      }


                      ?>
                    </select>
                  </div>
                </div>

                <!-----------------------------------------
                        Adicionar Produto 
                ------------------------------------------>

                <div class="form-group row novoProduto">
                  <?php
                  $listaProduto = json_decode($venda["produtos"], true);


                  foreach ($listaProduto as $key => $produto) {

                    $item = "id";
                    $valor = $produto["id"];
                    $resposta = ControllerProdutos::ctrMostrarProdutos($item, $valor);

                    $estoqueAntigo = $produto["quantidade"] + $resposta["estoque"];
                    echo '
                    <div class="row" style=" padding: 2px 5px"> 
                      <div class="col-xs-6" style="padding-right: 0;"> 
                          <div class="input-group"> 
                            <span class="input-group-addon">
                                <button type="button" class="btn btn-danger btn-xs removerProduto" idProduto="' . $produto["id"] . '"><i class="fa fa-times"></i>
                                </button>  
                            </span> 
                            <input type="text" class="form-control adicionarProduto novaDescricaoProduto" 
                                  idProduto="' . $produto["id"] . '"
                                  name="adicionarProduto" value = "' . $produto["descricao"] . '" required readonly>  
                          </div> 
                      </div>

                      <div class="col-xs-2"> 
                          <div class="input-group"> 
                           <input type="number" min="1" class="form-control novoQuantidadeProduto" name = "novoQuantidadeProduto" value = "' . $produto["quantidade"] . '" estoque="' . $estoqueAntigo . '" novoEstoque="' . $produto["estoque"] . '" required >  
                          </div> 
                      </div> 


                      <div class="col-xs-4 alterarPreco" style="padding-left: 0;"> 
                          <div class="input-group"> 
                              <span class="input-group-addon" style="font-size:1.1em; font-weight:700">R$</span> 
                              <input type="number" min="1" class="form-control novoPrecoProduto" 
                                      precoReal= "' . $resposta["preco_venda"] . '" 
                                      name="novoPrecoProduto"  
                                      value = "' . $produto["total"] . '" 
                                      readonly required> 
                          </div> 
                      </div>
                    </div>
                      
                      ';
                  }

                  ?>
                </div>
                <input type="hidden" id="listaProdutos" name="listaProdutos">

                <!-- Botão para Cadastrar Produto -->
                <br><br>
                <button type="button" class="btn btn-default hidden-lg btnAdicionarProdutos"> Adicionar
                  Produto</button>
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
                                name="novoAcrescimoVenda" value="<?php echo $porcentagemAcrescimo; ?>">

                              <input type="hidden" name="novoValorAcrescimo" id="novoValorAcrescimo"
                                value="<?php echo $venda["acrescimo"]; ?>">
                              <input type="hidden" name="novoValorSemAcrescimo" id="novoValorSemAcrescimo"
                                value="<?php echo $venda["subtotal"]; ?>">

                              <span class="input-group-addon"> <i class="fa fa-percent"></i></span>
                            </div>
                          </td>

                          <td style="width:50%;">
                            <div class="input-group">
                              <span class="input-group-addon" style="font-size:1.1em; font-weight:700">R$</span>
                              <input type="number" class="form-control" min="1" id="novoTotalVenda"
                                totalSemAcrescimo="0" name="novoTotalVenda" value="<?php echo $venda["total"]; ?>"
                                readonly>
                              <input type="hidden" name="totalVenda" id="totalVenda"
                                value="<?php echo $venda["total"]; ?>">
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>

                <hr>

                <!-----------------------------------------
                          Método de Pagamento 
                ------------------------------------------>
                <div class="row">
                  <div class="col-xs-7" style="padding-right:0px ;">
                    <div class="form-group">
                      <select name="novoMetodoPagamento" id="novoMetodoPagamento" class="form-control" required>
                        <option value="">Selecione um método de pagamento</option>
                        <option value="Efetivo">Efetivo</option>
                        <option value="CC">Cartão de Crédito</option>
                        <option value="CD">Cartão de Débito</option>
                      </select>
                    </div>
                  </div>

                  <div class="entradaMetodoPagamento"></div>

                  <input type="hidden" name="listaMetodoPagamento" id="listaMetodoPagamento">

                </div>

              </div>

            </div>
            <br>
            <div class="box-footer">
              <button type="submit" class="btn btn-primary pull-right" id="criarVenda">Atualizar Venda</button>
            </div>

            <?php
            $editarVenda = new ControllerVendas();
            $editarVenda->ctrEditarVenda();
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