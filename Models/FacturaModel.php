<?php



    class FacturaModel extends Mysql{




        public function __construct(){

            
            parent::__construct();

          

        }


        #1 Extraer Datos de un Solo Pedido
        
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
    }

?>
