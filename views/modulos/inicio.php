<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Dashboard
      <small>Painel de Controle</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <?php

      if ($_SESSION["perfil"] == "Administrador") {
        include "inicio/labels-superiores.php";
      }

      ?>
    </div>

    <div class="row">
      <div class="col-lg-12">
        <?php
        if ($_SESSION["perfil"] == "Administrador") {
          include "relatorios/grafico-vendas.php";
        }
        ?>

      </div>
      <div class="col-lg-7">
        <?php
        if ($_SESSION["perfil"] == "Administrador") {
          include "relatorios/produtos-mais-vendidos.php";
        }
        ?>

      </div>

      <div class="col-lg-5">
        <?php
        if ($_SESSION["perfil"] == "Administrador") {
          include "inicio/produtos-adicionados-recentemente.php";
        }
        ?>

      </div>
      <div class="col-lg-12">
        <?php
        if ($_SESSION["perfil"] == "Vendedor" || $_SESSION["perfil"] == "Especial") {
          echo
            "<div class='box box-success'>
            <div class='box-header'>
              <h1>Bem vindo, " . $_SESSION["nome"] . ".</>
            </div>
          </div>
          ";
        }
        ?>
      </div>


    </div>



  </section>
  <!-- /.content -->
</div>