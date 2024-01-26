<?php

    // require_once("CategoriasModel.php");

    class PedidosModel extends Mysql{


        private $objCategoria;


        public function __construct(){

            // echo "Mensaje desde el modelo Home";
            parent::__construct();

           

        }

        #1 Seleccionar todo de la tabla pedidos

        public function selectPedidos($idpersona = NULL){

            // Validar el ID es o no es enviado
            $where = "";

            // Condicion en caso que trai id 
            if($idpersona != null){

                $where = " WHERE p.personaid = ".$idpersona;

            }

            $sql = "SELECT p.idpedido,
                            p.referenciacobro,
                            p.idtransaccionpaypal,
                            DATE_FORMAT(p.fecha, '%d/%m/%Y') as fecha,
                            p.monto,
                            tp.tipopago,
                            tp.idtipopago,
                            p.status
                    FROM pedido p
                    INNER JOIN tipopago tp
                    ON p.tipopagoid = tp.idtipopago $where";

            $request = $this->select_all($sql);

            return $request;

        }

        #2 Seleccionar el Pedido de un Cliente unico

        public function selectPedido(int $idpedido, $idpersona = NULL){

            $busqueda = "";

            // validar en caso se mande id
            if($idpersona != NULL){

                $busqueda = " AND p.personaid=".$idpersona;

            }

            $request =array();

            $sql = "SELECT p.idpedido,
                        p.referenciacobro,
                        p.idtransaccionpaypal,
                        p.personaid,
                        DATE_FORMAT(p.fecha, '%d/%m/%Y' ) as fecha,
                        p.costo_envio,
                        p.monto,
                        p.tipopagoid,
                        t.tipopago,
                        p.direccion_envio,
                        p.status
                    FROM pedido as p
                    INNER JOIN tipopago t
                    ON p.tipopagoid = t.idtipopago
                    WHERE p.idpedido = $idpedido ".$busqueda;
            
            $requestPedido = $this->select($sql);

            if(!empty($requestPedido)){

                $idpersona = $requestPedido['personaid'];

                $sql_cliente = "SELECT idpersona,
                                        nombres,
                                        apellidos,
                                        telefono,
                                        email_user,
                                        dni,
                                        nombrefiscal,
                                        direccionfiscal 
                                FROM persona WHERE idpersona = $idpersona";

                $requestCliente = $this->select($sql_cliente);

                // Consulta para productos extraccion 
                $sql_detalle = "SELECT p.idproducto,
                                        p.nombre as producto,
                                        d.precio,
                                        d.cantidad
                                FROM detalle_pedido d
                                INNER JOIN producto p
                                ON d.productoid = p.idproducto
                                WHERE d.pedidoid = $idpedido";

                $requestProductos = $this->select_all($sql_detalle);

                $request = array('cliente' => $requestCliente,
                                'orden' => $requestPedido,
                                'detalle' => $requestProductos);

            }

            return $request;

        }

        #3 Seleccionar La transaccion Del Cliente que hizieron pago en paypal

        public function selectTransPaypal(string $idtransaccion, $idpersona  = NULL){


            $busqueda = "";

            // validar en caso se mande id
            if($idpersona != NULL){

                $busqueda = " AND personaid=".$idpersona;

            }

            $objTransaccion = array();

            $sql = "SELECT datospaypal FROM pedido WHERE idtransaccionpaypal = '{$idtransaccion}' ". $busqueda;
            // acceso a JSON formato    
            $requestData = $this->select($sql);


            if(!empty($requestData)){

               
                // Conversion de json a obj
                $objData = json_decode($requestData['datospaypal']);
         
                //Chequear estos datos deacuero a las aposciones del arreglo recuerda pueden estar mal o hallan cam
                // hallan cambiado por el tiempo
                // accesso a los objeto de los datos
                // $urlTransaccion = $objData->purchase_units[0]->payments->captures[0]->links[0]->href;
                
                $urlTransaccion = $objData->purchase_units[0]->payments->captures[0];

                // accceso a las posiciones
                // $urlOrden = $objData->purchase_units[0]->payments->captures[0]->links[2]->href;
                $urlOrden = $objData->links[0]->href;

                $objTransaccion = CurlConnectionGet($urlOrden,"application/json",getTokenPaypal());

            }

            return $objTransaccion;
            
        }


        #4 Reembolsar API de Paypal

        public function reembolsoPaypal(string $idtransaccion, string $observacion){

            $response = false;

            $sql = "SELECT idpedido,datospaypal FROM pedido WHERE idtransaccionpaypal = '{$idtransaccion}' ";

            $requestData = $this->select($sql);

            if(!empty($requestData)){
                
                $objData = json_decode($requestData['datospaypal']);

                //*************************************** */
                // GET de REEMBOLSO, Informacion que Tiene todos los GET y POST

                $urlOrden = $objData->links[0]->href;

                $objTransaccion = CurlConnectionGet($urlOrden,"application/json",getTokenPaypal());

                //Guardar informacion de GET y POST, Maldito JSON envio tengo que jugar con la informacion para el reembolso correcto
                $objData = $objTransaccion;

                // Jugar con la informacion
                /************************************************ */

                // REEMBOLSO
                $urlReembolso = $objData->purchase_units[0]->payments->captures[0]->links[1]->href;

                $objTransaccion = CurlConnectionPost($urlReembolso,"application/json",getTokenPaypal());

                if(isset($objTransaccion->status) and $objTransaccion->status == "COMPLETED"){
                    // Informacion de json devulto por paypal 
                    $idpedido = $requestData['idpedido'];
                    // obtener id de transaccion en el json obtenido
                    $idtransaccion = $objTransaccion->id;
                    // stado
                    $status = $objTransaccion->status;
                    // Convertir en json la inforamcion
                    $jsonData = json_encode($objTransaccion);
                    // lo que se observo para el correcto reembolo
                    $observacion = $observacion;

                    $query_insert = "INSERT INTO reembolso(pedidoid,
                                                        idtransaccion,
                                                        datosreembolso,
                                                        observacion,
                                                        status)
                                    VALUES(?,?,?,?,?)";

                    $arrData = array($idpedido,
                                    $idtransaccion,
                                    $jsonData,
                                    $observacion,
                                    $status);

                    $request_insert = $this->insert($query_insert,$arrData);

                    // validar si hay algun regustro

                    if($request_insert > 0){

                        $updatePedido = "UPDATE pedido SET status = ? WHERE idpedido = $idpedido";
                        // poner el valor reembolsado en status
                        $arrPedido = array("Reembolsado");

                        $request = $this->update($updatePedido,$arrPedido);

                        $response = true;


                    }

                }

                return $response;

                
            }

        }



        #5 Para poder actualizar el pedido

        public function updatePedido(int $idpedido, $transaccion = NULL, $idtipopago = NULL, string $estado){
            
            if($transaccion == NULL){

                $query_insert = "UPDATE pedido SET status = ? WHERE idpedido = $idpedido";

                $arrData = array($estado);

            }else{

                $query_insert = "UPDATE pedido SET referenciacobro = ?, tipopagoid = ?, status = ? WHERE idpedido = $idpedido";

                $arrData = array($transaccion,
                                $idtipopago,
                                $estado);

            }

            $request_insert = $this->update($query_insert,$arrData);

            return $request_insert;

        }


    }

?>
