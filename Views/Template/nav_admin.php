  <!-- Sidebar menu-->
  <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="<?= media();?>/images/avatar.png" alt="User Image">
        <div>
          <p class="app-sidebar__user-name"><?= $_SESSION['userData']['nombres'];?></p>
          <p class="app-sidebar__user-designation"><?= $_SESSION['userData']['nombrerol'];?></p>
        </div>
      </div>
      <ul class="app-menu">

      <li>
            <a class="app-menu__item" href="<?= base_url();?>" target="_blank">
                <i class="app-menu__icon fa fas fa-globe" aria-hidden="true"></i>
                <span class="app-menu__label">Ver Sitio Web</span>
            </a>
        </li>



      <!-- Validacion de Existen los permisos para mostrar en barra de menu -->

        <!-- Configuracion para Usuarios de Tabla Modulo en Dashboard(idmodulo=1) -->
        <!-- Condicinal si existe la session con otros parametros -->
        <?php if(!empty($_SESSION['permisos'][1]['r'])){ ?>
        <li>
            <a class="app-menu__item" href="<?= base_url();?>/dashboard">
                <i class="app-menu__icon fa fa-dashboard"></i>
                <span class="app-menu__label">Dashboard</span>
            </a>
        </li>
        <?php } ?>
        
        
        <!-- Configuracion para Usuarios de Tabla Modulo  en Usuarios(idmodulo=2) -->
        <?php if(!empty($_SESSION['permisos'][2]['r'])){ ?>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-users"></i><span class="app-menu__label"> Usuarios</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
          <!-- <i class="fa-solid fa-user"></i> -->
            <li><a class="treeview-item" href="<?= base_url();?>/usuarios"><i class="icon fa fa-id-badge"></i> Usuarios</a></li>
            <!-- <i class="fa-solid fa-users-gear"></i> -->
            <li><a class="treeview-item" href="<?= base_url();?>/roles"><i class="icon fa-solid fa-users-gear"></i> Roles</a></li>
          </ul>
        </li>
        <?php } ?>

        <!-- Configuracion para Usuarios de Tabla Modulo  en Clientes(idmodulo=3) -->
        <?php if(!empty($_SESSION['permisos'][3]['r'])){ ?>
        <li>
            <a class="app-menu__item" href="<?= base_url();?>/clientes">
                <i class="app-menu__icon fa fa-user"></i>
                <span class="app-menu__label">Clientes</span>
            </a>
        </li>
        <?php } ?>

        
        <!-- Configuracion para Usuarios de Tabla Modulo  en Productos(idmodulo=4) y categoria(idmodulo=6) -->
        <?php if(!empty($_SESSION['permisos'][4]['r']) || !empty($_SESSION['permisos'][6]['r'])){ ?>

        <li class="treeview">

          <a class="app-menu__item" href="#" data-toggle="treeview">

            <i class="app-menu__icon fa fa-archive"></i>

            <span class="app-menu__label">Tienda</span>

            <i class="treeview-indicator fa fa-angle-right"></i></a>

            <ul class="treeview-menu">
              <!-- Validacion Producto -->
              <?php if(!empty($_SESSION['permisos'][4]['r'])){ ?>
                
              <li><a class="treeview-item" href="<?= base_url();?>/productos"><i class="icon fas fa-box-open"></i> Productos</a></li>
              <?php } ?>

              <!-- Validacion de Categorias -->
              <?php if(!empty($_SESSION['permisos'][6]['r'])){ ?>
              <li><a class="treeview-item" href="<?= base_url();?>/categorias"><i class="icon fas fa-boxes"></i> Categorías</a></li>
              <?php } ?>
            </ul>
        </li>
        <?php } ?>


        <!-- Configuracion para Usuarios de Tabla Modulo  en Pedidos(idmodulo=5) -->
        <?php if(!empty($_SESSION['permisos'][5]['r'])){ ?>
        <li>
            <a class="app-menu__item" href="<?= base_url();?>/pedidos">
                <i class="app-menu__icon fa fa-shopping-cart"></i>
                <span class="app-menu__label">Pedidos</span>
            </a>
        </li>
        <?php } ?>
        

          <!-- Para SUSCRIPOTRES -->

        <?php if(!empty($_SESSION['permisos'][MSUSCRIPTORES]['r'])){ ?>
        <li>
            <a class="app-menu__item" href="<?= base_url();?>/suscriptores">
                <!-- <i class="app-menu__icon fas fa-user-tie"></i> -->
                <i class="app-menu__icon fa-solid fa-person-walking-arrow-loop-left"></i>
                <span class="app-menu__label">Suscriptores</span>
            </a>
        </li>
        <?php } ?>


        <!-- CONCTACTOS -->

        
        <?php if(!empty($_SESSION['permisos'][MDCONTACTOS]['r'])){ ?>
        <li>
            <a class="app-menu__item" href="<?= base_url();?>/contactos">
                <i class="app-menu__icon fa-solid fa-envelope-open-text"></i>
                <!-- <i class="fa-solid fa-envelope-open-text"></i> -->
                <!-- <i class="app-menu__icon fas fa-mailbox"></i> -->
                <span class="app-menu__label">Mensajes</span>
            </a>
        </li>
        <?php } ?>


          <!-- ADministrar Paginas -->

        
          <?php if(!empty($_SESSION['permisos'][MDPAGINAS]['r'])){ ?>
        <li>
            <a class="app-menu__item" href="<?= base_url();?>/paginas">
                <i class="app-menu__icon  fa-solid fa-paperclip"></i>
                <!-- <i class="app-menu__icon fa fa-file-alt"></i> -->
                <span class="app-menu__label">Paginas</span>
            </a>
        </li>
        <?php } ?>
        <li>
            <a class="app-menu__item" href="<?= base_url();?>/logout">
                <i class="app-menu__icon fa fa-sign-out" aria-hidden="true"></i>
                <span class="app-menu__label">Logout</span>
            </a>
        </li>
    
      
      </ul>
    </aside>