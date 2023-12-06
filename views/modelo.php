<?php
session_start();
?>

<!DOCTYPE html>

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>Admin - 4 de Nós Ateliê</title>
  <!--===========================
      CSS PLUGINS
=============================-->
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="views/bower_components/bootstrap/dist/css/bootstrap.min.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="views/bower_components/font-awesome/css/font-awesome.min.css">

  <!-- Ionicons -->
  <link rel="stylesheet" href="views/bower_components/Ionicons/css/ionicons.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="views/dist/css/AdminLTE.css">

  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="views/dist/css/skins/_all-skins.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="views/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="views/bower_components/datatables.net-bs/css/responsive.dataTables.min.css">
  <link rel="stylesheet" href="views/bower_components/datatables.net-bs/css/responsive.bootstrap.min.css">
  <link rel="stylesheet" href="views/plugins/iCheck/all.css">

  <!-- Google Font -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <link rel="icon" href="views\bower_components\Ionicons\png\512\xbox.png">

  <!--===========================
      JAVASCRIPT PLUGINS
=============================-->

  <!-- jQuery 3 -->
  <script src="views/bower_components/jquery/dist/jquery.min.js"></script>

  <!-- Bootstrap 3.3.7 -->
  <script src="views/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

  <!-- SlimScroll -->
  <script src="views/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>

  <!-- FastClick -->
  <script src="views/bower_components/fastclick/lib/fastclick.js"></script>

  <!-- AdminLTE App -->
  <script src="views/dist/js/adminlte.min.js"></script>

  <!-- DataTables -->
  <script src="views/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="views/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <script src="views/bower_components/datatables.net-bs/js/dataTables.responsive.min.js"></script>
  <script src="views/bower_components/datatables.net-bs/js/responsive.bootstrap.min.js"></script>

  <!-- SweetAlert 2 -->
  <script src="views/plugins/sweetalert2/sweetalert2.all.min.js"></script>
  <script src="views/plugins/iCheck/icheck.min.js"></script>


  <!-- InputMask -->
  <script src="views/plugins/input-mask/jquery.inputmask.js"></script>
  <script src="views/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
  <script src="views/plugins/input-mask/jquery.inputmask.extensions.js"></script>


</head>
<!--===========================
      Body
=============================-->

<body class="hold-transition skin-blue sidebar-collapse sidebar-mini login-page">
  <!-- Site wrapper -->

  <?php

  if (isset($_SESSION["initSession"]) && $_SESSION["initSession"] == "ok") {

    echo "<div class='wrapper'>";
    /* =============================================== 
       Header
      =============================================== */
    include("modulos/header.php");

    /* =============================================== 
     Menu
    =============================================== */

    include("modulos/menu.php");


    /* =============================================== */
    /* Conteúdo */
    /* =============================================== */

    if (isset($_GET["rota"])) {
      if (
        $_GET["rota"] == 'inicio' ||
        $_GET["rota"] == 'usuarios' ||
        $_GET["rota"] == 'categorias' ||
        $_GET["rota"] == 'clientes' ||
        $_GET["rota"] == 'produtos' ||
        $_GET["rota"] == 'vendas' ||
        $_GET["rota"] == 'criar-venda' ||
        $_GET["rota"] == 'relatorios' ||
        $_GET["rota"] == 'sair'
      ) {

        include("modulos/" . $_GET["rota"] . ".php");
      } else {
        include("modulos/404.php");
      }
    } else {
      include("modulos/inicio.php");
    }

    /* =============================================== */
    /* Footer */
    /* =============================================== */

    include("modulos/footer.php");

    echo "</div>";
  } else {
    include("modulos/login.php");
  }
  ?>

  <script src="views/js/modulos.js"></script>
  <script src="views/js/usuarios.js"></script>
  <script src="views/js/categorias.js"></script>
  <script src="views/js/produtos.js"></script>
  <script src="views/js/clientes.js"></script>
  <script src="views/js/vendas.js"></script>
</body>

</html>