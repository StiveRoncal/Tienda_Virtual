<?php

    // require_once("CategoriasModel.php");

    class HomeModel extends Mysql{


        private $objCategoria;


        public function __construct(){

            // echo "Mensaje desde el modelo Home";
            parent::__construct();

            // $this->objCategoria = new CategoriasModel();

        }


        public function getCategorias(){

            // return $this->objCategoria->selectCategorias();

        }

    }

?>
