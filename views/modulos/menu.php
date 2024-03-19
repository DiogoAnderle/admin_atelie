<aside class="main-sidebar">
  <section class="sidebar">
    <ul class="sidebar-menu">
      <?php
      if ($_SESSION["perfil"] == "Administrador") {

        echo '


      <li class="active">
        <a href="inicio">
          <i class="fa fa-home"></i>
          <span>Início</span>
        </a>
      </li>

      <li>
        <a href="usuarios">
          <i class="fa fa-user"></i>
          <span>Usuários</span>
        </a>
      </li>';
      }
      if ($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Especial") {
        echo '
                <li class="">
                  <a href="categorias">
                    <i class="fa fa-th"></i>
                    <span>Categorias</span>
                  </a>
                </li>

                <li class="">
                  <a href="produtos">
                    <i class="fa fa-product-hunt"></i>
                    <span>Produtos</span>
                  </a>
                </li>
                <li class="">
                  <a href="fornecedores">
                    <i class="fa fa-th"></i>
                    <span>Fornecedores</span>
                  </a>
                </li>
                ';
      }

      if ($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Vendedor") {
        echo '
          <li class="">
            <a href="clientes">
              <i class="fa fa-users"></i>
              <span>Clientes</span>
            </a>
          </li>

          <li class="treeview">
            <a href="">
              <i class="fa fa-list-ul"></i>
              <span>Vendas</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li>
                <a href="criar-venda">
                  <i class="fa fa-circle-o"></i>
                  <span>Criar Venda</span>
                </a>
              </li>
              <li>
                <a href="vendas">
                  <i class="fa fa-circle-o"></i>
                  <span>Administrar Vendas</span>
                </a>
              </li>';
      }
      if ($_SESSION["perfil"] == "Administrador") {

        echo '
         

          <li>
            <a href="relatorios">
              <i class="fa fa-circle-o"></i>
              <span>Relatório de Vendas</span>
            </a>
          </li>';
      }

      echo '</ul>
            </li>';
      ?>

    </ul>
  </section>
</aside>