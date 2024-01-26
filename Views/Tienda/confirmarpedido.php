<?php 

    headerTienda($data);

?>
<br><br><br>

<?php

    // dep($_SESSION['dataorden']);

?>


<div class="jumbotron text-center">
  <h1 class="display-4">¡Gracias Por Tu Compra!</h1>
  <p class="lead">Tu pedido fue procesado con Éxito</p>
  <p>No. Orden: <strong><?= $data['orden']?></strong> </p>

  <?php
  
    if(!empty($data['transaccion'])){

  ?>

  <p>Transacción: <strong><?= $data['transaccion']?> </strong></p>

  <?php
  
    }
  ?>

  <hr class="my-4">
  <p>Estaremos en contacto para cordinar la entrega. Comunicase al: +51 934027842 Whatsapp</p>
  <p>Puedes ver el estado de tu pedido en la sección pedidos de tu usuario</p>
  <p></p>
  <br>
  <a class="btn btn-primary btn-lg" href="<?= base_url(); ?>/login" role="button">Continuar E Iniciar Sessión</a>
</div>

<?php 
	footerTienda($data);
 ?>