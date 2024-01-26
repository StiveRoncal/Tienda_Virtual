<?php

    class SuscriptoresModel extends Mysql{


        
        public function __construct(){

            parent::__construct();

        }

        

        #1 seleccinar los pedidos
        public function selectSuscriptores(){

            $sql = "SELECT idsuscripcion, nombre, email, DATE_FORMAT(datecreated, '%d/%m/%Y') as fecha
                    FROM suscripciones ORDER BY idsuscripcion DESC";

            $request = $this->select_all($sql);

            return $request;

        }


    }
?>