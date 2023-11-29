<header class="main-header">
  <!-- Logo -->
  <a href="" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>4</b>DN</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>4 de Nós</b> Atêlie</span>
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>

    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">

            <?php 
              if ($_SESSION["imagem"] != "") {
                echo '<img src="'.$_SESSION["imagem"].'" class="user-image" alt="User Image">';
              }else {
                echo '<img src="views\img\usuarios\user-default.png" class="user-image" alt="User Image">';
              }
            ?>
            

            <span class="hidden-xs">
              <?php echo $_SESSION["nome"] ?>
            </span>
          </a>
          <ul class="dropdown-menu">
            <li class="user-body">
              <div class="pull-right">
                <a href="sair" class="btn btn-default btn-flat">Sair</a>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>

    <!--Dropdown toogle-->
  </nav>
</header>