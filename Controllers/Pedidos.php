<?php

    require_once("Models/TTipoPago.php");


    class Pedidos extends Controllers{

        use TTipoPago;
        #0 Constructor
        public function __construct(){

            // Reempalzo de session_start y usar un helper con timer de session activa
            sessionStart();
            
            parent::__construct();


            if(empty($_SESSION['login'])){

                header('Location:'.base_url().'/login');
                die();

            }

            //BBDD:Modulo ID(5->Pedidos)
            getPermisos(MPEDIDOS);

        }


        #1 Configuracion de Pagina
        public function Pedidos(){

            //Acceso De Lectura
            if(empty($_SESSION['permisosMod']['r']) ){

                header("Location:".base_url().'/dashboard');

            }

            $data['page_tag'] = "Pedidos";
            $data['page_title'] = "PEDIDOS <small>Tienda Virtual</small>";
            $data['page_name'] = "pedidos";
            $data['page_functions_js'] = "functions_pedidos.js";
            
            $this->views->getView($this,"pedidos",$data);

        }

        #2 Para Seleccionar Todos lo Pedidos

        public function getPedidos(){
            
            if($_SESSION['permisosMod']['r']){
                
                $idpersona = "";

                //Validar para que cliente vea sus pedido y de los demas
                if($_SESSION['userData']['idrol'] == RCLIENTES){

                    $idpersona = $_SESSION['userData']['idpersona'];

                }


                $arrData = $this->model->selectPedidos($idpersona);
                // dep($arrData);exit;
                for($i=0; $i < count($arrData); $i++){
    
                        $btnView = '';
                        $btnEdit = '';
                        $bntDelete = '';
                    
                        // dar valor
                        $arrData[$i]['transaccion'] = $arrData[$i]['referenciacobro'];
                        
                        // valida si esta vacio
                        if($arrData[$i]['idtransaccionpaypal'] != "" ){

                            $arrData[$i]['transaccion'] = $arrData[$i]['idtransaccionpaypal'];

                        }

                        //dar valor a la moneda

                        $arrData[$i]['monto'] = SMONEY.formatMoney($arrData[$i]['monto']);
                
                    //Boton Ver DATATABLE
                    if($_SESSION['permisosMod']['r']){
                        

                        $btnView .= ' <a title="Ver Detalle" href="'.base_url().'/pedidos/orden/'.$arrData[$i]['idpedido'].'" target="_blank"
                                    class="btn btn-info btn-sm"><i class="far fa-eye"></i></a>

                                    <a title="Generar PDF" href="'.base_url().'/factura/generarFactura/'.$arrData[$i]['idpedido'].'" target="_blank"
                                    class="btn btn-danger btn-sm"><i class="fas fa-file-pdf"></i></a>
                                    
                                 ';
                        
                        // Si el Pago fue por paypal
                        //para disabled el boton
                        if($arrData[$i]['idtipopago'] == 1){

                            $btnView .= '
                                        <a title="Ver transaccion" href="'.base_url().'/pedidos/transaccion/'.$arrData[$i]['idtransaccionpaypal'].'" target="_blank"
                                        class="btn btn-info btn-sm"><i class="fa fa-paypal" aria-hidden="true"></i> </a> ';

                        }else{

                            $btnView .= '<button class="btn btn-secondary btn-sm" disabled=""><i class="fa fa-paypal"
                                        aria-hidden="true"></i></button>';

                        }
        
                    }
        
                    //Boton Actualizar DATATABLE
                    if($_SESSION['permisosMod']['u']){
        
                        $btnEdit = '<button class="btn btn-primary btn-sm" onClick="fntEditInfo(this,'.$arrData[$i]['idpedido'].')" title="Editar Pedido"><i class="fas fa-pencil-alt"></i></button>';
                
                    }
        
    
        
                    $arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$bntDelete.' </div>';
        
                }
            
                echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
    
            }
            
            die();
        }


        #3 Ver Orden del cliente su pedido pero en el Mismo Controlador

        public function orden($idpedido){

            if(!is_numeric($idpedido)){
                
                header("Location:".base_url().'/pedidos');

            }

            if(empty($_SESSION['permisosMod']['r']) ){

                header("Location:".base_url().'/dashboard');

            }

            // validar el usuario para que veo los datos de sus pedidos y tomar valores

            $idpersona = "";

            if($_SESSION['userData']['idrol'] == RCLIENTES){

                $idpersona = $_SESSION['userData']['idpersona'];

            }   


            $data['page_tag'] = "Pedidos - Tienda Virtual";
            $data['page_title'] = " PEDIDOS <small>Tienda Virtual</small>";
            $data['page_name'] = "pedidos";
            $data['arrPedido'] = $this->model->selectPedido($idpedido,$idpersona);
            
            $this->views->getView($this,"orden",$data);

            
        }

        #4 Ver Transaccion del cliente su pedido pero en el Mismo Controlador

        public function transaccion($transaccion){

        

            if(empty($_SESSION['permisosMod']['r']) ){

                header("Location:".base_url().'/dashboard');

            }

            // validar el usuario para que veo los datos de sus pedidos y tomar valores

            $idpersona = "";

            if($_SESSION['userData']['idrol'] == RCLIENTES){

                $idpersona = $_SESSION['userData']['idpersona'];

            }   

            $requestTransaccion = $this->model->selectTransPaypal($transaccion,$idpersona);
            // dep($requestTransaccion); exit;

            $data['page_tag'] = "Detalles de la transacción - Tienda Virtual";
            $data['page_title'] = " Detalles de la transacción";
            $data['page_name'] = "detalle_transaccion";
            $data['page_functions_js'] = "functions_pedidos.js";
            $data['objTransaccion'] = $requestTransaccion;
            
            $this->views->getView($this,"transaccion",$data);

            
        }

        #5 Extraer las transaccion para poder reembolsar

        public function getTransaccion(string $transaccion){

            if($_SESSION['permisosMod']['r'] and $_SESSION['userData']['idrol'] != RCLIENTES){

                if($transaccion == ""){

                    $arrResponse = array("status" => false, "msg" => 'Datos incorrectos');

                }else{

                    $transaccion = strClean($transaccion);

                    $requestTransaccion = $this->model->selectTransPaypal($transaccion);
                    
                    if(empty($requestTransaccion)){

                        $arrResponse = array("status" => false, "msg" => "Datos no Disponibles");

                    }else{

                        $htmlModal = getFile("Template/Modals/modalReembolso",$requestTransaccion);

                        $arrResponse = array("status" => true, "html" => $htmlModal);

                    }

                }

                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);

            }

            die();

        }


        #6 Hacer El Reembolso

        public function setReembolso(){

            if($_POST){

                if($_SESSION['permisosMod']['r'] and $_SESSION['userData']['idrol'] != RCLIENTES){

                    // dep($_POST);

                    //Almacenar DATOS de id y Descripcion del reembolso

                    $transaccion = strClean($_POST['idtransaccion']);

                    $observacion = strClean($_POST['observacion']);

                    $requestTransaccion = $this->model->reembolsoPaypal($transaccion,$observacion);
                    
                    if($requestTransaccion){

                        $arrResponse = array("status" => true, "msg" => "El Reembolso Se ha Procesado correctamente");

                    }else{

                        $arrResponse = array("status" => false, "msg" => "No es posible procesar el reembolso");
                        
                    }

                }else{
                    
                    $arrResponse = array("status" => false, "msg" => "No es posible realizar el proceso, consulte con el Administrador");

                }

                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);

            }
            die();

        }


        #7 obtener pedido para editar el pedido

        public function getPedido(string $pedido){

            if($_SESSION['permisosMod']['u'] and $_SESSION['userData']['idrol'] != RCLIENTES ){

                if($pedido == ""){

                    $arrResponse = array("status" => false, "msg" => 'Datos Incorrectos X(');

                }else{

                    $requestPedido = $this->model->selectPedido($pedido,"");

                    if(empty($requestPedido)){

                        $arrResponse = array("status" => false, "msg" => "Datos no Disponibles X( ");

                    }else{

                        // Para mostrar los tipos de pagos
                        $requestPedido['tipospago'] = $this->getTiposPagoT();


                        $htmlModal = getFile("Template/Modals/modalPedido",$requestPedido);

                        $arrResponse = array("status" => true, "html" => $htmlModal);

                    }
                }

                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);

            }

            die();

        }


        #8 Actualizar un Pedido 

        public function setPedido(){

          if($_POST){

            if($_SESSION['permisosMod']['u'] and $_SESSION['userData']['idrol'] != RCLIENTES ){

                $idpedido = !empty($_POST['idpedido']) ? intval($_POST['idpedido']) : "";

                $estado = !empty($_POST['listEstado']) ? strClean($_POST['listEstado']) : "";

                $idtipopago = !empty($_POST['listTipopago']) ? intval($_POST['listTipopago']) : "";

                $transaccion = !empty($_POST['txtTransaccion']) ? strClean($_POST['txtTransaccion']) : " ";


                if($idpedido == ""){

                    $arrResponse = array("status" => false, "msg" => 'Datos Incorrecto 1');

                }else{


                    if($idtipopago == ""){

                        if($estado == ""){

                            $arrResponse = array("status" => false, "msg" => 'Datos Incorrectos 2');

                        }else{

                            $requestPedido = $this->model->updatePedido($idpedido,"","",$estado);

                            if($requestPedido){

                                $arrResponse = array("status" => true, "msg" => "Datos Actualizado Correctamente");

                            }else{

                                $arrResponse = array("status" => false, "msg" => "No es posible actualizar la informacion");

                            }

                        }

                    }else{


                        if($transaccion == "" or $idpedido == "" or $estado == ""){

                            $arrResponse = array("status" => false, "msg" => 'Datos incorrectos 3');

                        }else{

                            $requestPedido = $this->model->updatePedido($idpedido,$transaccion,$idtipopago,$estado);

                            if($requestPedido){

                                $arrResponse = array("status" => true, "msg" => "Datos Actualizados Correctamente");

                            }else{

                                $arrResponse = array("status" => false, "msg" => "No es posible almacenar la informacion");

                            }
                        }


                    }


                }
                
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }

          }
        die();

        }


}

?>