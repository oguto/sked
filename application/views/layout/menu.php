  <!-- Sidebar -->
  <ul class="navbar-nav  sidebar saccordion toggled" id="accordionSidebar">
    <!-- Sidebar - Brand -->



            <li class="nav-item active">
              <a class="nav-link" href="<?php echo site_url("Home")  ?>">
                <i class="fas fa-fw fa-user"></i>

              </a>
              </li>

    <!-- Divider -->
    <hr class="sidebar-divider my-0" style="margin-bottom:30px !important;">

    <!-- Nav Item - Dashboard -->







        <li class="nav-item active">
          <a class="nav-link" data-href="<?php echo site_url("Agenda/listar")  ?>">
            <i class="far fa-calendar-alt"></i>
          </a>
          </li>




      <li class="nav-item ">
        <a class="nav-link" data-href="<?php echo site_url("cliente/listar")  ?>">
<i class="far fa-list-alt"></i>
        </a>
        </li>




        <li class="nav-item ">
          <a class="nav-link" data-href="<?php echo site_url("Pagamento/")  ?>">
  <i class="fas fa-money-bill-wave"></i>
          </a>
          </li>













    <?php if(empty($acesso->bloqueio(array('modulo'=>'Tansacao')))){ ?>

        <li class='nav-item'>
        <a class='nav-link collapsed' href='#' data-toggle='collapse' data-target='#menu_tansacao' aria-expanded='true' aria-controls='menu_tansacao'>
      <i class="fas fa-wrench"></i>
        </a>
        <div id='menu_tansacao' class='collapse ' aria-labelledby='headingTwo' data-parent='#accordionSidebar'>
        <div class='bg-white py-2 collapse-inner rounded sub-menu shadow'>
          <a class='collapse-item' data-home='<?php echo site_url('TansacaoTipo');  ?>' data-href='<?php echo site_url('TansacaoTipo/listar/');  ?>' data-tab='1'>Tipo de Transação</a>
          <a class='collapse-item' data-home='<?php echo site_url('PagamentoMetodo');  ?>' data-href='<?php echo site_url('PagamentoMetodo/listar/');  ?>' data-tab='1'>Método de Pagamento</a>
            <a class='collapse-item' data-home='<?php echo site_url('Grupo');  ?>' data-href='<?php echo site_url('Grupo/listar/');  ?>' data-tab='1'>Grupos de Acesso</a>
        </div>
        </li>
        <?php } ?>


<li class="nav-item ">
  <a class="nav-link" data-href="<?php echo site_url('login/sair');?>">
    <i class="fas fa-sign-out-alt fa-sm fa-fw "></i>
  </a>
  </li>





      <hr class="sidebar-divider d-none d-md-block">

    </ul>
