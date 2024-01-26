<?php

    headerTienda($data);

    // Validar si existe session
    $subtotal = 0;
    $total = 0; 
   
    foreach($_SESSION['arrCarrito'] as $producto){

        $subtotal += $producto['precio'] * $producto['cantidad'];  

    } 


    $total = $subtotal + COSTOENVIO;

    $Dtotal = $total/Dolar;

    $dolarFormat = number_format($Dtotal,2,'.','');

    $tituloTermino = !empty(getInfoPage(PTERMINOS)) ? getInfoPage(PTERMINOS)['titulo'] : "";

	$infoTerminos = !empty(getInfoPage(PTERMINOS)) ? getInfoPage(PTERMINOS)['contenido'] : "";

    
    // $num = 17.52365;
    // echo "<br>";
    // echo $num;
    // echo "<br>";
    // $resuido = number_format($num,2,'.','');
    // echo $resuido;

?>

<!-- Script de Paypal  y Clave ID generado por Paypal  -->

<!-- Prueba SanDBOx -->
<script 

    src="https://www.paypal.com/sdk/js?client-id=<?= IDCLIENTE?>&currency=<?= CURRENCY ?>"> 
</script>


<!-- DE Verdad Pagas  -->
<!-- <script 

    src="https://www.paypal.com/sdk/js?client-id=ASQSRg2LCwn6vKuaKUx_tz0LKq11LFBWZgHQypvkE20nrq4mb2Bf_Z3xq95rswQTvy6w68A5m2HRB2_S"> 

</script> -->
    

<script>
    paypal.Buttons({
    createOrder: function(data,actions) {
        return actions.order.create({
            purchase_units: [{

                amount:{
                    value: <?= $dolarFormat; ?>
                },

                description: "Compra de artículos en <?= NOMBRE_EMPRESA ?> por <?= SMONEYDOLAR.$dolarFormat?>",

            }]

        });

        },
        
        onApprove: function(data,actions){

            return actions.order.capture().then(function(details){

                // console.log(details);

                let base_url = "<?= base_url(); ?>";

                let dir = document.querySelector("#txtDireccion").value;

                let ciudad = document.querySelector("#txtCiudad").value;

                // PAYPAL BD tipoPago paypal = 1
                let inttipopago=1;

                let request = (window.XMLHttpRequest) ? new XMLHttpRequest(): new ActiveXObject('Microsoft.XMLHTTP');

                let ajaxUrl = base_url+'/Tienda/procesarVenta';

                let formData = new FormData();

                formData.append('direccion',dir);
                formData.append('ciudad',ciudad);
                formData.append('inttipopago',inttipopago);
                formData.append('datapay',JSON.stringify(details));

                request.open("POST",ajaxUrl,true);

                request.send(formData);

                request.onreadystatechange = function(){

                    if(request.readyState !=4 ) return;

                    if(request.status == 200){

                        let objData = JSON.parse(request.responseText);

                        if(objData.status){
                            
                            window.location = base_url+"/tienda/confirmarpedido/";

                        }else{

                            swal("",objData.msg,"error");

                        }

                    }

                }

            

            });

        }

    }).render('#paypal-btn-container');
</script>

<!-- Modal de Terminos y Condiciones -->

<div class="modal fade" id="modalTerminos" tabindex="-1" aria-hidden="true">

  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title"><?= $tituloTermino; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

          <span aria-hidden="true">&times;</span>

        </button>

      </div>

      <div class="modal-body">

            <div class="page-content">

                <?= $infoTerminos; ?>

            </div>

      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<br><br><br>
<hr>
<!-- breadcrumb -->
<div class="container">
		<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
			<a href="<?= base_url(); ?>" class="stext-109 cl8 hov-cl1 trans-04">
				Inicio
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>

			<span class="stext-109 cl4">
				<?= $data['page_title'];?>
			</span>
		</div>
	</div>
	<br>

	<!-- Shoping Cart -->
	
		<div class="container">
			<div class="row">
				<div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
					<div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-l-25 m-r--38 m-lr-0-xl">
						<div>
                            <?php
                                //Creacion de variable de ssion
                                if(isset($_SESSION['login'])){    
                            ?>

                            <div>

                                <label for="tipopago">Dirección de Envio</label>

                                <div class="bor8 bg0 m-b-12">
                                    <input id="txtDireccion" class="stext-111 cl8 plh3 size-111  p-lr-15" type="text" 
                                    name="state" placeholder="Dirección de Envío">
                                </div>

                                <div class="bor8 bg0 m-b-22">
                                    <input id="txtCiudad" class="stext-111 cl8 plh3 size-111  p-lr-15" type="text" 
                                    name="postcode" placeholder="Ciudad / Estado">
                                </div>

                            </div>
							<?php
                            
                                }else{

                            ?>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">

                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#login" role="tab" aria-controls="home" aria-selected="true">Iniciar Sesión</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#registro" role="tab" aria-controls="profile" aria-selected="false">Crear Cuenta</a>
                                </li>

                            </ul>

                            <div class="tab-content" id="myTabContent">

                                <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="home-tab">
                                    <br>
                                    <form id="formLogin">

                                        <div class="form-group">

                                            <label for="txtEmail">Correo Electrónico</label>
                                            <input type="email" class="form-control" id="txtEmail" name="txtEmail">

                                        </div>

                                        <div class="form-group">

                                            <label for="txtPassword">Contraseña</label>
                                            <input type="password" class="form-control" id="txtPassword" name="txtPassword">
                                        </div>
                    
                                        <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
                                        
                                    </form>
                                </div>

                                <div class="tab-pane fade" id="registro" role="tabpanel" aria-labelledby="profile-tab">
                                    <br>

                                    <form id="formRegister">

                                        <div class="row">

                                            <div class="col col-md-6 form-group">

                                                <label for="txtNombre">Nombres</label>
                                                <input type="text" class="form-control validText" id="txtNombre" name="txtNombre" requierd="">

                                            </div>

                                            <div class="col col-md-6 form-group">

                                                <label for="txtApellido">Apellidos</label>
                                                <input type="text" class="form-control validText" id="txtApellido" name="txtApellido" requierd="">

                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col col-md-6 form-group">

                                                <label for="txtTelefono">Teléfono</label>
                                                <input type="text" class="form-control valid validNumber" id="txtTelefono" name="txtTelefono" 
                                                requierd="" onkeypress="return controlTag(event);">

                                            </div>

                                            <div class="col col-md-6 form-group">

                                                <label for="txtEmailCliente">Correo</label>
                                                <input type="email" class="form-control valid validEmail" id="txtEmailCliente" name="txtEmailCliente" 
                                                requierd="">

                                            </div>

                                            <!-- <div class="col col-md-6 form-group">

                                                <label for="txtcontrasenia">Contraseña</label>
                                                <input type="password" class="form-control valid validEmail" id="txtcontrasenia" name="txtcontrasenia" 
                                                requierd="">

                                            </div>

                                            
                                            <div class="col col-md-6 form-group">

                                                <label for="txtrepetircontrasenia">Confirma Tu Contraseña</label>
                                                <input type="password" class="form-control valid validEmail" id="txtrepetircontrasenia" name="txtrepetircontrasenia" 
                                                requierd="">

                                            </div> -->

                                        </div>
                                        <p><strong>Importante: </strong>Al Momento de Crear una Cuenta la Contraseña Se Enviara Al Correo Del Usuario</p>

                                        <button type="submit" class="btn btn-primary">Regístrate</button>
                                    </form>
                                </div>

                            </div>

                            <?php
                            
                            }
                            ?>

						</div>

					</div>
				</div>

				<div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
					<div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
						<h4 class="mtext-109 cl2 p-b-30">
							Resumen
						</h4>

						<div class="flex-w flex-t bor12 p-b-13">
							<div class="size-208">
								<span class="stext-110 cl2">
									Subtotal:
								</span>
							</div>

							<div class="size-209">
								<span id="subTotalCompra" class="mtext-110 cl2">
                                    <?= SMONEY.formatMoney($subtotal) ?>
								</span>
							</div>

                            <div class="size-208">
								<span class="stext-110 cl2">
                                   Envio:
								</span>
							</div>

							<div class="size-209">
								<span class="mtext-110 cl2">
                                    <?= SMONEY.formatMoney(COSTOENVIO) ?>
								</span>
							</div>
						</div>

				
						<div class="flex-w flex-t p-t-27 p-b-33">
							<div class="size-208">
								<span class="mtext-101 cl2">
									Total:
								</span>
							</div>

							<div class="size-209 p-t-1">
								<span id="totalCompra" class="mtext-110 cl2">
                                    <?= SMONEY.formatMoney($total) ?>
								</span>
							</div>
						</div>
                        <hr>
                        <?php
                            //Creacion de variable de ssion
                            if(isset($_SESSION['login'])){    
                        ?>
                        <div id="divMetodoPago" class="notBlock">

                                <div id="divCondiciones">
                                    <input type="checkbox" id="condiciones">
                                    <label for="condiciones"> Aceptar </label>
                                    <a href="#" data-toggle="modal" data-target="#modalTerminos">Términos y Condiciones</a>
                                </div>  
                          
                                <div id="optMetodoPago" class="notBlock">
                                    <hr>

                                    <h4 class="mtext-109 cl2 p-b-30">

                                        Método de Pago

                                    </h4>

                                    <div class="divmetodpago">

                                        <div>
                                            <label for="paypal">

                                                <input type="radio" id="paypal" class="methodpago" name="payment-method" checked="" value="Paypal">
                                                
                                                <img src="<?= media()?>/images/img-paypal.jpg" alt="Icono de Paypal" class="ml-space-sm" width="74" height="20">

                                            </label>

                                        </div>

                                        <div>
                                            <label for="contraentrega">
                                                <input type="radio" id="contraentrega" class="methodpago" name="payment-method" value="CT">
                                                <span>Contra Entrega</span>

                                            </label>

                                        </div>

                                        <div id="divtipopago" class="notBlock">

                                            <label for="listtipopago">Tipo de Pago</label>
                                            
                                            <div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
                                                <!-- Consulta de todos los tipos de pago en Combox -->
                                                <select  id="listtipopago" class="js-select2" name="listtipopago" >
                                                <?php

                                                    if(count($data['tiposPago'])){

                                                        foreach($data['tiposPago'] as $tipopago){
                                                            // Valir la seleccion de paypal
                                                            if($tipopago['idtipopago'] != 1){

                                                ?>
                                                    <option value="<?= $tipopago['idtipopago']?>"><?= $tipopago['tipopago']?></option>

                                                <?php     
                                                    }
                                                    }                               
                                                    }
                                                ?>
                                                </select>
                                                <div class="dropDownSelect2"></div>
                                            </div>
                                            <br>
                                            <button type="submit" id="btnComprar" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
                                                Procesar Pedido
                                            </button>

                                        </div>
                                        
                                        <div id="divpaypal">

                                            <div>
                                                <p>Para Completar la transacción, Te enviaremos a los servidores seguros de Paypal</p>
                                            </div>
                                            <br>
                                            <!-- Renderizar Paypal -->
                                            <div id="paypal-btn-container"></div>

                                        </div>

                                    
                                    </div>

                                </div>
                        </div>
                       
                        <?php } ?>
					</div>
				</div>
			</div>
		</div>
	

<?php 
    
	footerTienda($data);
 ?>