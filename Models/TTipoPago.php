<?php

    //Uso de TRAIT
    
    require_once("Libraries/Core/Mysql.php");

    trait TTipoPago{

        private $con;


        #1 Extraer Tipo Pago

        public function getTiposPagoT(){

            $this->con = new Mysql();

            $sql = "SELECT * FROM tipopago WHERE status != 0";

            $request = $this->con->select_all($sql);

            return $request;


        }

      


    }


?>