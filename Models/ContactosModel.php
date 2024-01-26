<?php

    class ContactosModel extends Mysql{


        
        public function __construct(){

            parent::__construct();

        }

        

        #1 seleccinar los contactos
        public function selectContactos(){

            $sql = "SELECT id, nombre, email, mensaje,ip,dispositivo,useragent as agente_usuario,DATE_FORMAT(datecreated, '%d/%m/%Y') as fecha
                    FROM contacto ORDER BY id DESC";

            $request = $this->select_all($sql);

            return $request;

        }


        #2 Seleccionar Mensaje

        public function selectMensaje(int $idmensaje){

            $sql = "SELECT id, nombre, email, mensaje,ip,dispositivo,useragent as agente_usuario,DATE_FORMAT(datecreated, '%d/%m/%Y') as fecha
            FROM contacto WHERE id = {$idmensaje} ";

            $request = $this->select($sql);

            return $request;
        }


    }
?>