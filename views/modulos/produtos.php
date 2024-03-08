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
      Administrar Produtos
    </h1>
    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Produtos</li>
    </ol>
  </section>


  <section class="content">


    <div class="box">
      <div class="box-header with-border">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalCadastrarProduto">
          Cadastrar Produto
        </button>

        <div class="box-body">
          <table class="table table-bordered table-hovered responsive tabelaProdutos">
            <thead>
              <tr>
                <th style="width: 10px;">#</th>
                <th>Imagem</th>
                <th>Código</th>
                <th>Descrição</th>
                <th>Categoria</th>
                <th>Estoque</th>
                <th nowrap>Preço compra</th>
                <th nowrap>Preço venda</th>
                <th>Dt Cadastro</th>
                <th style="width: 80px;">Ações</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th style="width: 10px;">#</th>
                <th>Imagem</th>
                <th>Código</th>
                <th>Descrição</th>
                <th>Categoria</th>
                <th>Estoque</th>
                <th>Preço de compra</th>
                <th>Preço de venda</th>
                <th>Dt Cadastro</th>
                <th>Ações</th>
              </tr>
            </tfoot>
          </table>
          <input type="hidden" value="<?php echo $_SESSION['perfil'] ?>" id="perfilOculto">
        </div>

      </div>


  </section>

</div>


<!--/***************************************
          MODAL CRIAR PRODUTO
***************************************/-->
<div class="modal fade" id="modalCadastrarProduto" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <div class="modal-header bg-primary">

          <h4 class="modal-title">Cadastrar Produto</h4>

          <button style="position: absolute; top: -1%; right:2%; font-size=25px; border-radius:50%;" type="button"
            class="btn btn-sm btn-danger" data-dismiss="modal" aria-label="Close">
            x
          </button>

        </div>

        <div class="modal-body">
          <div class="box-body">

            <!-- Selecionar Categoria -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <select class="form-control input-lg" id="novaCategoria" name="novaCategoria" required>
                  <option value="">--Selecione uma Categoria--</option>

                  <?php
                  $item = null;
                  $valor = null;
                  $categorias = ControllerCategorias::ctrMostrarCategorias($item, $valor);

                  foreach ($categorias as $key => $categoria) {
                    echo ' <option value="' . $categoria["id"] . '">' . $categoria["categoria"] . '</option>';
                  }


                  ?>

                </select>
              </div>
            </div>

            <!-- Informar Código -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-code"></i></span>
                <input type="text" class="form-control input-lg" id="novoCodigo" name="novoCodigo"
                  placeholder="Código do Produto" readonly required>
              </div>
            </div>

            <!-- Informar Descrição -->

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>
                <input type="text" class="form-control input-lg" name="novaDescricao" id="novaDescricao"
                  placeholder="Descrição">
              </div>
            </div>



            <!-- Informar Estoque -->

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-check"></i></span>
                <input type="number" min="0" class="form-control input-lg" name="novoEstoque" id="novoEstoque"
                  placeholder="Estoque" required>
              </div>
            </div>



            <div class="form-group row">
              <!-- Informar Preço de Compra -->
              <div class="col-xs-12 col-sm-6">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>
                  <input type="number" min="0" step="any" class="form-control input-lg" name="novoPrecoCompra"
                    id="novoPrecoCompra" placeholder="Preço de Compra" required>
                </div>

              </div>

              <!-- Informar Preço de Venda -->
              <div class="col-xs-12 col-sm-6">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>
                  <input type="number" min="0" step="any" class="form-control input-lg" name="novoPrecoVenda"
                    id="novoPrecoVenda" placeholder="Preço de Venda" readonly required>
                </div>
                <br>

                <!-- Checkbox para porcentagem -->

                <div class="col-xs-12 col-sm-6">
                  <div class="form-group">
                    <label for="utilizarPorcentagem">
                      <input type="checkbox" id="utilizarPorcentagem" name="utilizarPorcentagem"
                        class="minimal porcentagem" checked>
                      Utilizar porcentagem
                    </label>
                  </div>
                </div>
                <!-- Entrada para porcentagem -->
                <div class="col-xs-6" style="padding:0;">
                  <div class="input-group">
                    <input type="number" class="form-control input-lg" id="novaPorcentagem" name="novaPorcentagem"
                      min="0" value="50" required>
                    <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                  </div>
                </div>
              </div>
            </div>

            <!-- Adicionar Foto -->
            <div class="form-group">
              <div class="panel">Enviar Imagem</div>
              <input type="file" class="form-control input-lg novaImagem" name="novaImagem">
              <p class="help-block">Tamanho máximo da imagem 20MB</p>
              <img src="views/img/produtos/product-default.png" class="img-thumbnail previsualizar" width="100px">
            </div>


          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal"
            aria-label="Close">Cancelar</button>
          <button type="submit" class="btn btn-primary">Cadastrar Produto</button>
        </div>
        <?php
        $criarProduto = new ControllerProdutos();
        $criarProduto->ctrCriarProduto();
        ?>
      </form>
    </div>

  </div>

</div>

<!--/***************************************
          MODAL EDITAR PRODUTO
***************************************/-->
<div class="modal fade" id="modalEditarProduto" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <div class="modal-header bg-primary">

          <h4 class="modal-title">Editar Produto</h4>

          <button style="position: absolute; top: -1%; right:2%; font-size=25px; border-radius:50%;" type="button"
            class="btn btn-sm btn-danger" data-dismiss="modal" aria-label="Close">
            x
          </button>

        </div>

        <div class="modal-body">
          <div class="box-body">

            <!-- Selecionar Categoria -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <select class="form-control input-lg" name="editarCategoria" readonly required>
                  <option id="editarCategoria" value=""></option>

                </select>
              </div>
            </div>

            <!-- Informar Código -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-code"></i></span>
                <input type="text" class="form-control input-lg" id="editarCodigo" name="editarCodigo" readonly
                  required>
              </div>
            </div>

            <!-- Informar Descrição -->

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>
                <input type="text" class="form-control input-lg" name="editarDescricao" id="editarDescricao">
              </div>
            </div>



            <!-- Informar Estoque -->

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-check"></i></span>
                <input type="number" min="0" class="form-control input-lg" name="editarEstoque" id="editarEstoque"
                  required>
              </div>
            </div>



            <div class="form-group row">
              <!-- Informar Preço de Compra -->
              <div class="col-xs-12 col-sm-6">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>
                  <input type="number" min="0" step="any" class="form-control input-lg" name="editarPrecoCompra"
                    id="editarPrecoCompra" required>
                </div>

              </div>

              <!-- Informar Preço de Venda -->
              <div class="col-xs-12 col-sm-6">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>
                  <input type="number" min="0" step="any" class="form-control input-lg" name="editarPrecoVenda"
                    id="editarPrecoVenda" readonly required>
                </div>
                <br>

                <!-- Checkbox para porcentagem -->

                <div class="col-xs-12 col-sm-6">
                  <div class="form-group">
                    <label for="utilizarEditarPorcentagem">
                      <input type="checkbox" id="utilizarEditarPorcentagem" name="utilizarEditarPorcentagem"
                        class="minimal porcentagem" checked>
                      Utilizar porcentagem
                    </label>
                  </div>
                </div>
                <!-- Entrada para porcentagem -->
                <div class="col-xs-6" style="padding:0;">
                  <div class="input-group">
                    <input type="number" class="form-control input-lg" id="editarPorcentagem" name="editarPorcentagem"
                      min="0" value="50" required>
                    <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                  </div>
                </div>
              </div>
            </div>

            <!-- Adicionar Foto -->
            <div class="form-group">
              <div class="panel">Enviar Imagem</div>
              <input type="file" class="form-control input-lg novaImagem" name="editarImagem">
              <p class="help-block">Tamanho máximo da imagem 20MB</p>
              <img src="views/img/produtos/product-default.png" class="img-thumbnail previsualizar" width="100px">
              <input type="hidden" name="imagemAtual" id="imagemAtual">

            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal"
            aria-label="Close">Cancelar</button>
          <button type="submit" class="btn btn-primary">Salvar Edição</button>
        </div>

        <?php
        $editarProduto = new ControllerProdutos();
        $editarProduto->ctrEditarProduto();
        ?>
      </form>
    </div>

  </div>

</div>

<?php
$excluirProduto = new ControllerProdutos();
$excluirProduto->ctrExcluirProduto();
?>