<?php
if ($_SESSION["perfil"] != "Administrador") {
  echo "<script>
          window.location = 'inicio';
      </script>";
}
?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Relatórios
    </h1>
    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Relatórios</li>
    </ol>
  </section>


  <!-- Main content -->
  <section class="content">
    <div class="box-header with-border">

      <div class="input-group">
        <button type="button" class="btn btn-default" id="daterange-btn-relatorio">
          <span>
            <i class="fa fa-calendar"></i> Filtrar por período
          </span>
          <i class="fa fa-caret-down"></i>
        </button>
      </div>

      <div class="box-tools pull-right">
        <?php
        if (isset ($_GET["dataInicial"])) {
          echo '<a href="views/modulos/baixar-relatorio-excel.php?relatorio=relatorio&dataInicial=' . $_GET["dataInicial"] . '&dataFinal=' . $_GET["dataFinal"] . '">';

        } else {
          echo '<a href="views/modulos/baixar-relatorio-excel.php?relatorio=relatorio">';
        }


        ?>
        <button type="button" class="btn btn-success">
          <span>
            <i class="fa fa-file-excel-o"></i> Baixar Relatório
          </span>
        </button>
        </a>
      </div>
    </div>


    <div class="row">
      <!------------------ 
        Grafico de Vendas
       ------------------>
      <div class="col-lg-12">
        <?php
        if ($_SESSION["perfil"] == "Administrador") {
          include "relatorios/grafico-vendas.php";
        }
        ?>
      </div>
      <div class="col-lg-6">
        <?php
        if ($_SESSION["perfil"] == "Administrador") {
          include "relatorios/vendedores.php";
        }
        ?>

      </div>

      <div class="col-lg-6">
        <?php
        if ($_SESSION["perfil"] == "Administrador") {
          include "relatorios/clientes.php";
        }
        ?>

      </div>

      <!----------------------------
        Produtos Mais Vendidos
      ------------------------------>
      <div class="col-lg-6">
        <?php
        if ($_SESSION["perfil"] == "Administrador") {
          include "relatorios/produtos-mais-vendidos.php";
        }
        ?>

      </div>

      <div class="col-lg-6">
        <!-------------------------------- 
        Produtos Adicionados Recentemente
      ------------------------------------>
        <?php
        if ($_SESSION["perfil"] == "Administrador") {
          include "inicio/produtos-adicionados-recentemente.php";
        }
        ?>

      </div>
    </div>
  </section>
  <!-- /.content -->
</div>