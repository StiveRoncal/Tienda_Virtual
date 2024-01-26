<?php

    //Uso de TRAIT
    
    require_once("Libraries/Core/Mysql.php");

    trait TCategoria{

        private $con;


        #1 Extraer Categorias

        public function getCategoriasT(string $categorias){

            $this->con = new Mysql();
            //Extraccion de mas de una categorias
            $sql = "SELECT idcategoria, nombre, descripcion, portada, ruta
                    FROM categoria WHERE status != 0 AND idcategoria IN ($categorias)";

            
            $request = $this->con->select_all($sql);

            if( count($request) > 0 ){

                //imprimir todos las categorias seleccionas
                for($c = 0; $c < count($request) ; $c ++){

                    $request[$c]['portada'] = BASE_URL.'/Assets/images/uploads/'.$request[$c]['portada'];

                }

            }

            return $request;

        }


        #2 Obtener categorais Para Filtro de Categorias
        public function getCategorias(){

            $this->con = new Mysql();
            //Extraccion de mas de una categorias
            $sql = "SELECT c.idcategoria, c.nombre, c.portada, c.ruta, count(p.categoriaid) AS cantidad
                    FROM producto p
                    INNER JOIN categoria c
                    ON p.categoriaid = c.idcategoria
                    WHERE c.status = 1
                    GROUP BY p.categoriaid, c.idcategoria";

            
            $request = $this->con->select_all($sql);

            if( count($request) > 0 ){

                //imprimir todos las categorias seleccionas
                for($c = 0; $c < count($request) ; $c ++){

                    $request[$c]['portada'] = BASE_URL.'/Assets/images/uploads/'.$request[$c]['portada'];

                }

            }

            return $request;

        }
    }


?>