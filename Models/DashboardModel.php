<?php

   

    class DashboardModel extends Mysql{


        private $objCategoria;


        public function __construct(){

         
            parent::__construct();

        }

        #1 Contar cantidad de usuario

        public function cantUsuarios(){

            $sql = "SELECT COUNT(*) as total FROM persona WHERE status != 0";

            $request = $this->select($sql);

            $total = $request['total'];

            return $total;

        }

        #2 Contar Cantidad de Cliente

        public function cantClientes(){

            $sql = "SELECT COUNT(*) as total FROM persona WHERE status != 0 AND rolid = ".RCLIENTES;

            $request = $this->select($sql);

            $total = $request['total'];

            return $total;

        }

        #3 Contar la cantidad de Producto

        public function cantProductos(){

            $sql = "SELECT COUNT(*) as total FROM producto WHERE status != 0";

            $request = $this->select($sql);

            $total = $request['total'];

            return $total;

        }

        #4 contar la cantidad de pedidos

        public function cantPedidos(){

            $rolid =  $_SESSION['userData']['idrol'];
            $idUser = $_SESSION['userData']['idpersona'];
            $where = "";

            if($rolid == RCLIENTES){

                $where = " WHERE personaid = ".$idUser;

            }

            $sql = "SELECT COUNT(*) as total FROM pedido".$where;

            $request = $this->select($sql);

            $total = $request['total'];

            return $total;

        }

        #5 Contar las 10 ultimas orden de pedido

        public function lastOrders(){


            $rolid =  $_SESSION['userData']['idrol'];
            $idUser = $_SESSION['userData']['idpersona'];
            $where = "";

            if($rolid == RCLIENTES){

                $where = " WHERE p.personaid = ".$idUser;

            }

            $sql = "SELECT p.idpedido, CONCAT(pr.nombres,' ',pr.apellidos) as nombre, p.monto, p.status
                    FROM pedido p
                    INNER JOIN persona pr
                    ON p.personaid = pr.idpersona
                    $where
                    ORDER BY p.idpedido DESC LIMIT 10";

            $request = $this->select_all($sql);

            return $request;

        }

        #6 Seleccionar los tipos de pago por mes

        public function selectPagosMes(int $anio, int $mes){

            $sql = "SELECT p.tipopagoid, tp.tipopago, COUNT(p.tipopagoid) as cantidad, SUM(p.monto) as total 
                    FROM pedido p 
                    INNER JOIN tipopago tp
                    ON p.tipopagoid = tp.idtipopago 
                    WHERE MONTH(p.fecha) = $mes AND YEAR(p.fecha) = $anio GROUP BY tipopagoid";

            $pagos = $this->select_all($sql);
            $meses = Meses();
            $arrData = array('anio' => $anio, 'mes' => $meses[intval($mes-1)], 'tipospago' => $pagos);

            return $arrData;

        }


        #7 Seleccionar las Ventas de  productos por mes y año

        public function selectVentasMes(int $anio, int $mes){


            $rolid =  $_SESSION['userData']['idrol'];
            $idUser = $_SESSION['userData']['idpersona'];
            $where = "";

            if($rolid == RCLIENTES){

                $where = " AND personaid = ".$idUser;

            }

            $totalVentasMes = 0;

            $arrVentaDias = array();
            //CAlcular los Dias de cada mes exactos
            $dias = cal_days_in_month(CAL_GREGORIAN,$mes,$anio);

            $n_dia = 1;

            for($i=0;$i<$dias;$i++){

                $date = date_create($anio."-".$mes."-".$n_dia);

                $fechaVenta = date_format($date,"Y-m-d");

                $sql = "SELECT DAY(fecha) AS dia, COUNT(idpedido) AS cantidad, SUM(monto) as total
                        FROM pedido
                        WHERE DATE(fecha) = '$fechaVenta' AND status = 'Completo' ".$where;

                $ventaDia = $this->select($sql);
                $ventaDia['dia'] = $n_dia;
                $ventaDia['total'] = $ventaDia['total'] == "" ? 0 : $ventaDia['total'];

                //Total 
                $totalVentasMes += $ventaDia['total'];

                //Colocar elemetro dentro de un arreglo
                array_push($arrVentaDias, $ventaDia);  

                $n_dia++;
            }

            $meses = Meses();
            $arrData = array('anio' => $anio, 'mes' => $meses[intval($mes-1)], 'total' => $totalVentasMes ,'ventas' => $arrVentaDias);

            return $arrData;

      

        }


        #8 Selecionar venta del año para dashboard

        public function selectVentasAnio(int $anio){

            $arrMVentas = array();

            $arrMeses = Meses();

            for($i = 1 ; $i <= 12 ; $i++){

                $arrData = array('anio' => '', 'no_mes' => '', 'mes' => '', 'venta' => '');

                $sql = "SELECT $anio as anio, $i as mes, SUM(monto) as venta
                        FROM pedido WHERE MONTH(fecha) = $i AND YEAR(fecha) = $anio AND status = 'Completo' GROUP BY MONTH(fecha)";

                $ventaMes = $this->select($sql);

                $arrData['mes'] = $arrMeses[$i-1];

                //Valiar si esta vacio el ano de venta
                if(empty($ventaMes)){

                    $arrData['anio'] = $anio;
                    $arrData['no_mes'] = $i;
                    $arrData['venta'] = 0;

                }else{

                    $arrData['anio'] = $ventaMes['anio'];
                    $arrData['no_mes'] = $ventaMes['mes'];
                    $arrData['venta'] = $ventaMes['venta'];


                }

                array_push($arrMVentas, $arrData);
                
            }

            
            $arrVentas = array('anio' => $anio, 'meses' => $arrMVentas);
            return $arrVentas;
        }


        #9 Mostrar los 10 ultimos Productos

        public function productosTen(){

            $sql = "SELECT * FROM producto WHERE status = 1 ORDER BY idproducto DESC LIMIT 10";

            $request = $this->select_all($sql);

            return $request;

        }


      

    }

?>
