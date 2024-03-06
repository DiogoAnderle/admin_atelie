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


  <section class="content">


    <div class="box">
      <div class="box-header with-border">
        <button type="button" class="btn btn-default" id="daterange-btn-relatorio">
          <span>
            <i class="fa fa-calendar"></i> Filtrar por período
          </span>
          <i class="fa fa-caret-down"></i>
        </button>
        <div class="box-tools pull-right">

        </div>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-xs-12">
            <?php
            include "relatorios/grafico-vendas.php"
              ?>
          </div>
        </div>

      </div>

    </div>


  </section>

</div>