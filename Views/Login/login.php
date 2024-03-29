<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Stive Roncal">
    <meta name="theme-color" content="#009688">
    <link rel="shortcut icon" href="<?= media();?>/images/ns.ico" type="image/x-icon">
    
    <link rel="stylesheet" type="text/css" href="<?= media();?>/css/main.css">
    <link rel="stylesheet" type="text/css" href="<?= media();?>/css/styles.css">


    <title><?= $data['page_tag'];?></title>
  </head>
  <body>
    <section class="material-half-bg">
      <div class="cover"></div>
    </section>

    <!-- Formulario login -->
    <section class="login-content">
      <div class="logo">
        <h1><?= $data['page_title'];?></h1>
      </div>
      <div class="login-box">

      <div id="divLoading">
        <div >
          <img src="<?= media();?>/images/loading.svg" alt="Loading">
        </div>
      </div>      

        <form class="login-form" name="formLogin" id="formLogin" action="">

          <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>INICIAR SESIÓN</h3>

          <div class="form-group">
            <label class="control-label">CORREO ELECTRÓNICO</label>
            <input id="txtEmail" name="txtEmail" class="form-control" type="email" placeholder="Correo Electrónico" autofocus>
          </div>

          <div class="form-group">
            <label class="control-label">CONSTRASEÑA</label>
            <input  id="txtPassword" name="txtPassword" class="form-control" type="password" placeholder="Constraseña">
          </div>

          <div class="form-group">

            <div class="utility">
              
              <p class="semibold-text mb-2"><a href="#" data-toggle="flip">¿Olvidaste Tu Contraseña? </a></p>
            </div>

          </div>

          <!-- alerta -->
          <div id="alertLogin" class="text-center"></div>

          <div class="form-group btn-container">

            <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-sign-in-alt"></i> INICIAR SESIÓN</button>

          </div>
          <BR>

          <div class="form-group btn-container">

            <a href="<?= base_url(); ?>" class="btn btn-secondary btn-block"><i class="fas fa-door-open"></i> REGRESAR </a>

          </div>

          

          

          
          
        </form>

        <!-- Formulario 2 recuperacion de usuario -->
        <form name="formRecetPass" id="formRecetPass" class="forget-form" action="">
          <h3 class="login-head"><i class="fa fa-lg fa-fw fa-lock"></i>¿Olvidaste Tu Contraseña?</h3>
          <div class="form-group">
            <label class="control-label">CORREO ELECTRÓNICO</label>
            <input id="txtEmailReset" name="txtEmailReset" class="form-control" type="email" placeholder="Correo Electrónico">
          </div>
          <div class="form-group btn-container">
            <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-unlock fa-lg fa-fw"></i>ENVIAR CODIGO</button>
          </div>
          <div class="form-group mt-3">
            <p class="semibold-text mb-0"><a href="#" data-toggle="flip"><i class="fa fa-angle-left fa-fw"></i> Iniciar sesión</a></p>
          </div>
          
        </form>
      </div>
    </section>

    <script>
      const base_url = "<?= base_url();?>";
    </script>
    <!-- Essential javascripts for application to work-->
    <script src="<?= media(); ?>/js/jquery-3.3.1.min.js"></script>
    <script src="<?= media(); ?>/js/popper.min.js"></script>
    <script src="<?= media(); ?>/js/bootstrap.min.js"></script>
    <script src="<?= media(); ?>/js/fontawesome.js"></script>
    <script src="<?= media(); ?>/js/plugins/sweetalert.min.js"></script>
    <script src="<?= media(); ?>/js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="<?= media(); ?>/js/plugins/pace.min.js"></script>
    
    
    <!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
    <!-- php al de alto nivel recuerda que es una condenacion solo php no te asustes -->
    <script src="<?= media(); ?>/js/<?= $data['page_functions_js'];?>"></script>
    
  </body>
</html>