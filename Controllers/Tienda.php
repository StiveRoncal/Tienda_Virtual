<?php

  require_once("Models/TCategoria.php");
  require_once("Models/TProducto.php");
  require_once("Models/TCliente.php");
  require_once("Models/LoginModel.php");


  class Tienda extends Controllers{

    //Uso de Trait
    use TCategoria, TProducto, TCliente;

    public $login;

    public function __construct(){

        // Ejecucion de dos metodos por su herencia y constructor de libnrtaties controllers
        parent::__construct();
        session_start();

        $this->login = new LoginModel();

    }

    // 1er Metodo Principal

      public function tienda(){
        
          $data['page_tag'] = NOMBRE_EMPRESA;
          $data['page_title'] = NOMBRE_EMPRESA;
          $data['page_name'] = "tienda";
          // $data['productos'] = $this->getProductosT();
          
          $pagina = 1;
          $cantProductos = $this->cantProductos();
          $total_registro = $cantProductos['total_registro'];
          $desde = ($pagina - 1) * PROPORPAGINA;

          //caluclar el total de paginas que vamos a tener
          $total_paginas = ceil($total_registro / PROPORPAGINA);

        

          // Para la paginacion
          $data['productos'] = $this->getProductosPage($desde,PROPORPAGINA);
          // dep($data['productos']);exit;

          $data['pagina'] = $pagina;
          $data['total_paginas'] = $total_paginas;

          // PAra filtro de productos
          $data['categorias'] = $this->getCategorias();

          $this->views->getView($this,"tienda",$data);

          
      }

    #2 Metodo de categoria

    public function categoria($params){

        // Validar
        if(empty($params)){

            header("Location: ".base_url());

        }else{
            
            // parametro en arreglo
            $arrParams = explode(",",$params);
    
            $idcategoria = intval($arrParams[0]);
            $ruta = strClean($arrParams[1]);

            $pagina = 1;

            if(count($arrParams) > 2 AND is_numeric($arrParams[2])){

              $pagina = $arrParams[2];

            }

            $cantProductos = $this->cantProductos($idcategoria);
            $total_registro = $cantProductos['total_registro'];

            $desde = ($pagina - 1) * PROCATEGORIA;
            $total_paginas = ceil($total_registro / PROCATEGORIA);
            $infoCategoria = $this->getProductosCategoriaT($idcategoria,$ruta,$desde,PROCATEGORIA);

          

            $categoria = strClean($params);
            $data['page_tag'] = NOMBRE_EMPRESA." - ".$infoCategoria['categoria'];
            $data['page_title'] = $infoCategoria['categoria'];
            $data['page_name'] = "categoria";
            $data['productos'] = $infoCategoria['productos'];
            $data['infoCategoria'] = $infoCategoria;
            $data['pagina'] = $pagina;
            $data['total_paginas'] = $total_paginas;


            $data['categorias'] = $this->getCategorias();
          
            $this->views->getView($this,"categoria",$data);

        }

    }

    #3 MEtodo de Productos

    public function producto($params){

       // Validar

        if(empty($params)){

            header("Location: ".base_url());

          }else{
            
            $arrParams = explode(",",$params);

            $idproducto = intval($arrParams[0]);
            $ruta = strClean($arrParams[1]);
            $infoProducto = $this->getProductoT($idproducto,$ruta);
            
            // Validacion
            if(empty($infoProducto)){
              
              header("Location: ".base_url());

            }
       
            $data['page_tag']   =   NOMBRE_EMPRESA." - ".$infoProducto['nombre'];
            $data['page_title'] =   $infoProducto['nombre'];
            $data['page_name']  =   "producto";
            $data['producto']   =   $infoProducto;
            //$arrProducto['id de categoria'],cantidad de fotos, r=>random a=>ascendete d=>desendente
            $data['productos']  =   $this->getProductosRandom($infoProducto['categoriaid'],8,"r");

            $this->views->getView($this,"producto",$data);

          }
          
    }


    #4 Agregar Producto al Carrito

    public function addCarrito(){

      if($_POST){

        //Limpieza carrito
        // unset($_SESSION['arrCarrito']);exit;

        $arrCarrito = array();
        $cantCarrito = 0;
        // Desencriptar ID
        $idproducto = openssl_decrypt($_POST['id'], METHODENCRIPT, KEY);
        $cantidad = $_POST['cant'];

        if(is_numeric($idproducto) and is_numeric($cantidad)){

          //Extraccion de datos de producto
          $arrInfoProducto = $this->getProductoIDT($idproducto);
          
          if(!empty($arrInfoProducto)){
            //Seleccionar Id producto, nombre producto, cantidad,precio y 1ra imagen

            $arrProducto = array('idproducto' => $idproducto,
                                  'producto' => $arrInfoProducto['nombre'],
                                  'cantidad' => $cantidad,
                                  'precio' => $arrInfoProducto['precio'],
                                  'imagen' => $arrInfoProducto['images'][0]['url_image']);

              //Iniciar Variable de Session en caso producto esta Logeado IMPORTANTE
              if(isset($_SESSION['arrCarrito'])){
                
                $on =  true;
                $arrCarrito = $_SESSION['arrCarrito'];

                for($pr=0;$pr < count($arrCarrito); $pr++){

                  if($arrCarrito[$pr]['idproducto'] == $idproducto){

                    $arrCarrito[$pr]['cantidad'] += $cantidad;

                    $on = false;

                  }

                }

                if($on){
                    
                  array_push($arrCarrito,$arrProducto);

                }

                $_SESSION['arrCarrito'] = $arrCarrito;

              }else{

                array_push($arrCarrito, $arrProducto);

                $_SESSION['arrCarrito'] = $arrCarrito;

              }

              //obtener datos de cantidad llave=>valor idproducto => 13 y producto seleccioandos
              foreach($_SESSION['arrCarrito'] as $pro){
                
                $cantCarrito += $pro['cantidad'];

              
              }
              $htmlCarrito = "";

              //arreglo de carrito
              $htmlCarrito = getFile('Template/Modals/modalCarrito',$_SESSION['arrCarrito']);
              $arrResponse = array("status" => true,
                                    "msg" => '¡Se Agrego al Carrito!',
                                    "cantCarrito" => $cantCarrito,
                                    "htmlCarrito" => $htmlCarrito);

          }else{

            $arrResponse = array("status" => false, "msg" => 'Producto no Existente');

          }

        }else{

          $arrResponse = array("status" => false, "msg" => 'Datos Incorrectos');

        }

        echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
        
      }

      die();

    }


    #5 eliminar Productos del Carrito 

    public function delCarrito(){

      if($_POST){

          $arrCarrito = array();
          $cantCarrito = 0;
          $subtotal = 0;
          // Desencriptar ID
          $idproducto = openssl_decrypt($_POST['id'], METHODENCRIPT, KEY);
          $option = $_POST['option'];

          // Validar

          if(is_numeric($idproducto) and ($option == 1 or $option == 2)){

            $arrCarrito = $_SESSION['arrCarrito'];

            // valida si el id de producto existe en el carito
            for($pr=0;$pr<count($arrCarrito); $pr++){

                if($arrCarrito[$pr]['idproducto'] == $idproducto){

                    unset($arrCarrito[$pr]);

                }

            }
            // Funcion propia de php para order arreglos
            sort($arrCarrito);

            $_SESSION['arrCarrito'] = $arrCarrito;

            foreach($_SESSION['arrCarrito'] as $pro){
                
                $cantCarrito += $pro['cantidad'];
                $subtotal += $pro['cantidad'] * $pro['precio'];
            
            }

            $htmlCarrito = "";

            if($option == 1){

              $htmlCarrito = getFile('Template/Modals/modalCarrito',$_SESSION['arrCarrito']);

            }

            $arrResponse = array("status"     => true,
                                "msg"         => '¡Producto Eliminado!',
                                "cantCarrito" => $cantCarrito,
                                "htmlCarrito" => $htmlCarrito,
                                "subTotal"    => SMONEY.formatMoney($subtotal),
                                "total"       => SMONEY.formatMoney($subtotal + COSTOENVIO));

          }else{

            $arrResponse  = array("status" => false, "msg" => 'Datos Incorrectos. ');

          }

          echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);

      } 
      die();
    }


    #6 Actualizar Los productos deseados en carrito de comprra
    
    public function updCarrito(){
      
      if($_POST){

        $arrCarrito = array();
        $totalProducto = 0;
        $subtotal = 0;
        $total = 0;

        // Desencriptar id de producto
        $idproducto = openssl_decrypt($_POST['id'], METHODENCRIPT, KEY);

        $cantidad = intval($_POST['cantidad']);

        if(is_numeric($idproducto) and $cantidad > 0){

            $arrCarrito = $_SESSION['arrCarrito'];
            // dep($arrCarrito);exit();
            for($p = 0; $p < count($arrCarrito); $p++){

              // validar para actualizar la cantidad del la session  si es igual al id
              if($arrCarrito[$p]['idproducto'] == $idproducto){
                
                $arrCarrito[$p]['cantidad'] = $cantidad;

                $totalProducto = $arrCarrito[$p]['precio'] * $cantidad;

                break;
              }

            }


            $_SESSION['arrCarrito'] = $arrCarrito;

            //calcular el total y subtotal
            foreach($_SESSION['arrCarrito'] as $pro){
                
              $subtotal += $pro['cantidad'] * $pro['precio'];
          
            }


            $arrResponse = array("status" => true,
                                "msg" => '¡Producto Actualizado!',
                                "totalProducto" => SMONEY.formatMoney($totalProducto),
                                "subTotal" => SMONEY.formatMoney($subtotal),
                                "total" => SMONEY.formatMoney($subtotal + COSTOENVIO)

                                );


        }else{
          
          $arrResponse = array("status" => false, "msg" => 'Datos Incorrectos');

        }

        echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);

      }

      die();
    }


    #7 registrar cliente desde tienda virtual 
    public function registro(){

  
      if($_POST){
      
   
        if(empty($_POST['txtNombre']) || empty($_POST['txtApellido']) 
        || empty($_POST['txtTelefono']) || empty($_POST['txtEmailCliente'])){
          
          $arrResponse = array("status" => false, "msg" => 'Datos Incorrectos');

        }else{

     
       
            $strNombre = ucwords(strClean($_POST['txtNombre']));
            $strApellido = ucwords(strClean($_POST['txtApellido']));
            $intTelefono = intval(strClean($_POST['txtTelefono']));
            $strEmail = strtolower(strClean($_POST['txtEmailCliente']));
            
            

            // Roles de los clientes Corresponden al Id=7 de  tabla rol
            $intTipoId = RCLIENTES;


            // VALOR VACIO
            $request_user = "";
            // Crear Usuario

            $strPassword = passGenerator();

            $strPasswordEncript = hash("SHA256", $strPassword);
             
              
            $request_user = $this->insertCliente( $strNombre,
                                                  $strApellido,
                                                  $intTelefono,
                                                  $strEmail,
                                                  $strPasswordEncript,
                                                  $intTipoId );
             

          

           if($request_user > 0){

                $arrResponse = array('status' => true, 'msg' =>'Datos Guardado Correctamente');

                //Variable par nombre usuario
                $nombreUsuario = $strNombre.' '.$strApellido; 
                
                // Codigo : Para El Correo Electronico Recuerda
                $dataUsuario = array('nombreUsuario'=> $nombreUsuario,
                                     'email' => $strEmail,
                                     'password' => $strPassword,
                                     'asunto' => 'Bienvenido a Tu tienda en Linea');


                $_SESSION['idUser'] = $request_user;
                $_SESSION['login'] = true;
                
                $this->login->sessionLogin($request_user);

                 sendEmail($dataUsuario,'email_bienvenida');
           
           }else if($request_user == false){

                $arrResponse = array('status' => false, 'msg' => 'Atencion El email ya Existe, ingrese otro');

           }else{

                $arrResponse = array("status" => false, "msg" => 'No es posible almacenar Datos');
           }
        }
        // sleep(3);
        echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
      }
    
      die();
    }


    #8 Procesar Una Venta

    public function procesarVenta(){



      if($_POST){

        $idtransaccionpaypal = NULL;
        $datospaypal = NULL;
        $personaid = $_SESSION['idUser'];
        $monto = 0;
        $tipopagoid = intval($_POST['inttipopago']);
        $direccionenvio = strclean($_POST['direccion']).','.strClean($_POST['ciudad']);
        $status = "Pendiente";
        $subtotal = 0;
        $costo_envio = COSTOENVIO;


        if(!empty($_SESSION['arrCarrito'])){

            foreach($_SESSION['arrCarrito'] as $pro){

              $subtotal += $pro['cantidad'] * $pro['precio'];

            }

            $monto = formatMoney($subtotal + COSTOENVIO);

            //EL PAGO CONTRA ENTREGA RECUERDA
            if(empty($_POST['datapay'])){

              //Trabajar con  Metodo de pago contra entrega recuerda una funcion para dos metodos de pago
               //Crear el Pedido
               $request_pedido = $this->insertPedido($idtransaccionpaypal,
                                                    $datospaypal,
                                                    $personaid,
                                                    $costo_envio,
                                                    $monto,
                                                    $tipopagoid,
                                                    $direccionenvio,
                                                    $status);


                if($request_pedido > 0){

                //Insertar detalle 

                foreach($_SESSION['arrCarrito'] as $producto){

                    $productoid = $producto['idproducto'];
                    $precio = $producto['precio'];
                    $cantidad = $producto['cantidad'];

                    $this->insertDetalle($request_pedido,$productoid,$precio,$cantidad);

                }


                  // Informacion de pedido deacuerdo al id de session
                  $infoOrden = $this->getPedido($request_pedido);

                  $dataEmailOrden = array('asunto' => "Se ha Creado la Orden No.".$request_pedido,
                                          'email' => $_SESSION['userData']['email_user'], 
                                          'emailCopia' => EMAIL_PEDIDO,
                                          'pedido' => $infoOrden);

                  sendEmail($dataEmailOrden,"email_notificacion_orden");


                  //encriptar orden
                  $orden = openssl_encrypt($request_pedido,METHODENCRIPT,KEY );

                  $transaccion = openssl_encrypt($idtransaccionpaypal,METHODENCRIPT,KEY);

                  $arrResponse = array("status" => true,
                                      "orden" => $orden,
                                      "transaccion" => $transaccion,
                                      "msg" => 'Pedido Realizado');

                  // Mi primera varible de session para generar pedido

                  $_SESSION['dataorden'] = $arrResponse;

                  //Destruir la varible de sessio luego de cumplir su funcion

                  unset($_SESSION['arrCarrito']);
                  session_regenerate_id(true);



                }



            }else{

              //PAGO CON EL PAYPAL
              $jsonPaypal = $_POST['datapay'];
              // convertin json a objeto
              $objPaypal = json_decode($jsonPaypal);
              $status = "Aprobado";

              if(is_object($objPaypal)){

                $datospaypal = $jsonPaypal;
                // Elemtos de paypal propio
                $idtransaccionpaypal = $objPaypal->purchase_units[0]->payments->captures[0]->id;

                // valida estado de transaccion
                if($objPaypal->status == "COMPLETED"){

                  $totalPaypal = formatMoney($objPaypal->purchase_units[0]->amount->value);

                  if($monto == $totalPaypal){

                      $status = "Completo";

                  }

                  //Arreglo para enviar datos
                  //Crear el Pedido
                  $request_pedido = $this->insertPedido($idtransaccionpaypal,
                                                        $datospaypal,
                                                        $personaid,
                                                        $costo_envio,
                                                        $monto,
                                                        $tipopagoid,
                                                        $direccionenvio,
                                                        $status);


                  if($request_pedido > 0){

                    //Insertar detalle 

                    foreach($_SESSION['arrCarrito'] as $producto){

                        $productoid = $producto['idproducto'];
                        $precio = $producto['precio'];
                        $cantidad = $producto['cantidad'];

                        $this->insertDetalle($request_pedido,$productoid,$precio,$cantidad);

                    }

                    //Para enviar al Correo del Cliente y el Correo de la empresa
                    $infoOrden = $this->getPedido($request_pedido);

                    $dataEmailOrden = array('asunto' => "Se ha Creado la Orden No.".$request_pedido,
                                            'email' => $_SESSION['userData']['email_user'], 
                                            'emailCopia' => EMAIL_PEDIDO,
                                            'pedido' => $infoOrden);
                    // Recuerda que siempre tendras este error proque no Tiene Funcion SENDEMAIL porque es un servidore local
                    //Obseracion de este script Comenta 
                    sendEmail($dataEmailOrden,"email_notificacion_orden");

                    //encriptar orden
                    $orden = openssl_encrypt($request_pedido,METHODENCRIPT,KEY );

                    $transaccion = openssl_encrypt($idtransaccionpaypal,METHODENCRIPT,KEY);

                    $arrResponse = array("status" => true,
                                          "orden" => $orden,
                                          "transaccion" => $transaccion,
                                          "msg" => 'Pedido Realizado');

                    // Mi primera varible de session para generar pedido

                    $_SESSION['dataorden'] = $arrResponse;

                    //Destruir la varible de sessio luego de cumplir su funcion

                    unset($_SESSION['arrCarrito']);
                    session_regenerate_id(true);



                  }else{

                    $arrResponse = array("status" => false, "msg" => 'No es Posible procesar el pedido.');

                  }


                }else{

                  
                    $arrResponse = array("status" => false, "msg" => 'No es Posible Completar el Pago con Paypal');

                }


              }else{
                 
                  $arrResponse = array("status" => false, "msg" => 'Hubo un error en la transacción.');

              }

            }


        }else{

          
          $arrResponse = array("status" => false, "msg" => 'No es Posible Procesar el pedido');

        }


      }else{

        $arrResponse = array("status" => false, "msg" => 'No es Posible Procesar el pedido');

      }

      echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
      die();

    }


    #9 Confirmar un pdido
    public function confirmarpedido(){

      // si estavacio se redirecicona
      if(empty($_SESSION['dataorden'])){

        header("Location: ".base_url());

      }else{

        // alamcanear varaibl de session
        $dataorden = $_SESSION['dataorden'];
        // desencriptar
        $idpedido = openssl_decrypt($dataorden['orden'],METHODENCRIPT, KEY);

        $transaccion = openssl_decrypt($dataorden['transaccion'],METHODENCRIPT, KEY);

        $data['page_tag'] = "Confirmar Pedido";
        $data['page_title'] = "Confirmar Pedido";
        $data['page_name'] = "confirmarpedido";
        $data['orden'] = $idpedido;
        $data['transaccion'] = $transaccion;

        $this->views->getView($this,"confirmarpedido",$data);

      }

      //destruir session luego de finaliar compra

      unset($_SESSION['dataorden']);

    }

    #10 paginas de paginador de productos

    public function page($pagina= null){
      
      $pagina = is_numeric($pagina) ? $pagina : 1;

      // $data['productos'] = $this->getProductosT();
      
      $cantProductos = $this->cantProductos();
      $total_registro = $cantProductos['total_registro'];
      $desde = ($pagina - 1) * PROPORPAGINA;

      //caluclar el total de paginas que vamos a tener
      $total_paginas = ceil($total_registro / PROPORPAGINA);
  
      $data['productos'] = $this->getProductosPage($desde,PROPORPAGINA);
    
      $data['page_tag'] = NOMBRE_EMPRESA;
      $data['page_title'] = NOMBRE_EMPRESA;
      $data['page_name'] = "tienda";

      $data['pagina'] = $pagina;
      $data['total_paginas'] = $total_paginas;

      // PAra filtro de productos
      $data['categorias'] = $this->getCategorias();


      $this->views->getView($this,"tienda",$data);
    }

    #11 Busqueda de Productos

    public function search(){

      if(empty($_REQUEST['s'])){

        header("Location: ".base_url());

      }else{

        $busqueda = strClean($_REQUEST['s']);

      }
      // validar si viene vacios los elemntos
      $pagina = empty($_REQUEST['p']) ? 1 : intval($_REQUEST['p']);
      
      // Extarer cantidad de producto deacuer a la busqueda
      $cantProductos = $this->cantProdSearch($busqueda);

      //PAginador

      $total_registro = $cantProductos['total_registro'];
      $desde = ($pagina - 1) * PROBUSCAR;
      $total_paginas = ceil($total_registro / PROBUSCAR);
      
      // Extraer a los producto
      $data['productos'] = $this->getProdSearch($busqueda,$desde,PROBUSCAR);

      
      $data['page_tag'] = NOMBRE_EMPRESA;
      $data['page_title'] = "Resultado de: ".$busqueda;
      $data['page_name'] = "tienda";

      $data['pagina'] = $pagina;
      $data['total_paginas'] = $total_paginas;
      $data['busqueda'] = $busqueda;

      $data['categorias'] = $this->getCategorias();
      $this->views->getView($this,"search",$data);

    }


    #12 Para registro de suscriptores

    public function suscripcion(){
      if($_POST){

          $nombre = ucwords(strtolower(strClean($_POST['nombreSuscripcion'])));

          $email =strtolower(strClean($_POST['emailSuscripcion']));

          $suscripcion = $this->setSuscripcion($nombre,$email);

          if($suscripcion > 0){

            $arrResponse = array('status' => true, 'msg' => "Gracias por tu Suscripción");

            //Enviar Correo

            
            $dataUsuario = array('asunto' => "Nueva Suscripción",
                                  'email' => EMAIL_SUSCRIPTOR , 
                                  'nombreSuscriptor' => $nombre,
                                  'emailSuscriptor' => $email);
            
            sendEmail($dataUsuario,'email_suscripcion');

            



          }else{

            $arrResponse = array('status' => false, 'msg' => "El Email ya Fue registrado");

          }

          echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
         

      } 
      die();
    }


    #13 Para Registrar a los Contactos
    public function contacto(){
      if($_POST){

          $nombre = ucwords(strtolower(strClean($_POST['nombreContacto'])));

          $email =strtolower(strClean($_POST['emailContacto']));

          $mensaje = strClean($_POST['mensaje']);

          // Tecnica para Informacion del usuario IP pc 
          $useragent = $_SERVER['HTTP_USER_AGENT'];

          $ip = $_SERVER['REMOTE_ADDR'];

          $dispositivo = "PC";  

          if(preg_match("/mobile/i",$useragent)){

            $dispositivo = "Movil";

          }else if(preg_match("/tablet/i",$useragent)){
            
            $dispositivo = "Tablet";

          }else if(preg_match("/iPhone/i",$useragent)){
            
            $dispositivo = "iPhone";
            
          }else if(preg_match("/Ipad/i",$useragent)){
            
            $dispositivo = "iPad";
            
          }

          $userContact = $this->setContacto($nombre,$email,$mensaje,$ip,$dispositivo,$useragent);



          if($userContact > 0){

            $arrResponse = array('status' => true, 'msg' => "Su Mensaje Fue Enviado Correctamente");

            //Enviar Correo

            
            $dataUsuario = array('asunto' => "Nueva Usuario en Contacto",
                                  'email' => EMAIL_CONTACTO , 
                                  'nombreContacto' => $nombre,
                                  'emailContacto' => $email,
                                  'mensaje' => $mensaje);
            
            sendEmail($dataUsuario,'email_contacto');


          }else{

            $arrResponse = array('status' => false, 'msg' => "No es posible Enviar el Mensaje");

          }

          echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
         

      } 
      die();
    }

  }
?>