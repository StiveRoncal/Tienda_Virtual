<?php

    //Uso de TRAIT
    
    require_once("Libraries/Core/Mysql.php");

    trait TProducto{

        private $con;
        private $strCategoria;
        private $intIdcategoria;
        private $intIdProducto;
        private $strProducto;
        private $cant;
        private $option;
        private $strRuta;
        private $strRutaCategoria;

        #1 Selecccionar Productos

        public function getProductosT(){

            $this->con = new Mysql();

            $sql = "SELECT p.idproducto,
                           p.codigo,
                           p.nombre,
                           p.descripcion,
                           p.categoriaid,
                           c.nombre as categoria,
                           p.precio,
                           p.ruta,
                           p.stock
                    FROM producto p
                    INNER JOIN categoria c
                    ON p.categoriaid = c.idcategoria
                    WHERE p.status != 0 ORDER BY p.idproducto DESC LIMIT ".CANTPORDHOME;

            $request = $this->con->select_all($sql);

            if(count($request) > 0){
                
                for($c=0; $c<count($request); $c++){

                    $intIdProducto = $request[$c]['idproducto'];

                    $sqlImg = "SELECT img
                            FROM imagen
                            WHERE productoid = $intIdProducto";

                    $arrImg = $this->con->select_all($sqlImg);

                    if(count($arrImg) > 0){

                        for($i=0; $i < count($arrImg); $i++){

                            $arrImg[$i]['url_image'] = media().'/images/uploads/'.$arrImg[$i]['img'];

                        }

                    }

                    $request[$c]['images'] = $arrImg;

                }

            }

            return   $request;
        }


        #2 Seleccionar las Categorias Relacionado con los producto Stive

        public function getProductosCategoriaT(int $idcategoria, string $ruta, $desde = null, $porpagina = null){

            $this->intIdcategoria = $idcategoria    ;
            $this->strRuta = $ruta;
            $where = "";

            if(is_numeric($desde) AND  is_numeric($porpagina)){

                $where = " LIMIT ".$desde." , ".$porpagina;

            }


            $this->con = new Mysql();

            $sql_cat = "SELECT idcategoria, nombre,ruta FROM categoria WHERE idcategoria = '{$this->intIdcategoria}'";

            $request = $this->con->select($sql_cat);

            //si se encontro un registro
            if(!empty($request)){

                $this->strCategoria = $request['nombre'];
                $this->strRutaCategoria = $request['ruta'];
              

                $sql = "SELECT p.idproducto,
                            p.codigo,
                            p.nombre,
                            p.descripcion,
                            p.categoriaid,
                            c.nombre as categoria,
                            p.precio,
                            p.ruta,
                            p.stock
                        FROM producto p
                        INNER JOIN categoria c
                        ON p.categoriaid = c.idcategoria
                        WHERE p.status != 0 AND p.categoriaid = $this->intIdcategoria AND c.ruta =  '{$this->strRuta}'
                        ORDER BY p.idproducto DESC ".$where;

                $request = $this->con->select_all($sql);

                if(count($request) > 0){
                    
                    for($c=0; $c<count($request); $c++){

                        $intIdProducto = $request[$c]['idproducto'];

                        $sqlImg = "SELECT img
                                FROM imagen
                                WHERE productoid = $intIdProducto";

                        $arrImg = $this->con->select_all($sqlImg);

                        if(count($arrImg) > 0){

                            for($i=0; $i < count($arrImg); $i++){

                                $arrImg[$i]['url_image'] = media().'/images/uploads/'.$arrImg[$i]['img'];

                            }

                        }

                        $request[$c]['images'] = $arrImg;

                    }

                }

                $request = array('idcategoria' => $this->intIdcategoria,
                                'ruta' => $this->strRutaCategoria,
                                'categoria' => $this->strCategoria,
                                'productos' => $request );
            }
            
            return   $request;

        }


        #3 Seleccionar un Producto Especifico

        public function getProductoT(int $idproducto,string $ruta){

            $this->con = new Mysql();

            $this->intIdProducto = $idproducto;
            $this->strRuta = $ruta;

            $sql = "SELECT p.idproducto,
                           p.codigo,
                           p.nombre,
                           p.descripcion,
                           p.categoriaid,
                           c.nombre as categoria,
                           c.ruta as ruta_categoria,
                           p.precio,
                           p.ruta,
                           p.stock
                    FROM producto p
                    INNER JOIN categoria c
                    ON p.categoriaid = c.idcategoria
                    WHERE p.status != 0 AND p.idproducto='{$this->intIdProducto}' AND p.ruta = '{$this->strRuta}' ";

            $request = $this->con->select($sql);
         
            if(!empty($request)){
                
                    $intIdProducto = $request['idproducto'];

                    $sqlImg = "SELECT img
                            FROM imagen
                            WHERE productoid = $intIdProducto";

                    $arrImg = $this->con->select_all($sqlImg);

                    if(count($arrImg) > 0){

                        for($i=0; $i < count($arrImg); $i++){

                            $arrImg[$i]['url_image'] = media().'/images/uploads/'.$arrImg[$i]['img'];

                        }

                    }else{

                        $arrImg[0]['url_image'] = media().'/images/uploads/product.png';
                    }

                    $request['images'] = $arrImg;

            }

            return   $request;
        }

        #4 Selecionar producto de forma aleatoria
        
        public function getProductosRandom(int $idcategoria, int $cant, string $option){
            
            $this->intIdcategoria = $idcategoria;
            $this->cant = $cant;
            $this->option = $option;

            // Validar si Esta es "r" => random, "a" => ascendentes, "d" = desendente

            if($option == "r"){

                $this->option = " RAND() ";

            }else if($option == "a"){

                $this->option = " idproducto ASC ";

            }else if($option == "d"){

                $this->option = " idproducto DESC ";

            }



            $this->con = new Mysql();

        
          
            $sql = "SELECT p.idproducto,
                            p.codigo,
                            p.nombre,
                            p.descripcion,
                            p.categoriaid,
                            c.nombre as categoria,
                            p.precio,
                            p.ruta,
                            p.stock
                    FROM producto p
                    INNER JOIN categoria c
                    ON p.categoriaid = c.idcategoria
                    WHERE p.status != 0 AND p.categoriaid = $this->intIdcategoria
                    ORDER BY $this->option LIMIT $this->cant ";

                $request = $this->con->select_all($sql);

                if(count($request) > 0){
                    
                    for($c=0; $c<count($request); $c++){

                        $intIdProducto = $request[$c]['idproducto'];

                        $sqlImg = "SELECT img
                                FROM imagen
                                WHERE productoid = $intIdProducto";

                        $arrImg = $this->con->select_all($sqlImg);

                        if(count($arrImg) > 0){

                            for($i=0; $i < count($arrImg); $i++){

                                $arrImg[$i]['url_image'] = media().'/images/uploads/'.$arrImg[$i]['img'];

                            }

                        }

                        $request[$c]['images'] = $arrImg;

                    }

                }
            
            
            return   $request;


        }


        #5 Extraer datos de producto con su ID para el Carrito de Compras

        public function getProductoIDT(int $idproducto){

            $this->con = new Mysql();

            $this->intIdProducto = $idproducto;
          

            $sql = "SELECT p.idproducto,
                           p.codigo,
                           p.nombre,
                           p.descripcion,
                           p.categoriaid,
                           c.nombre as categoria,
                           p.precio,
                           p.ruta,
                           p.stock
                    FROM producto p
                    INNER JOIN categoria c
                    ON p.categoriaid = c.idcategoria
                    WHERE p.status != 0 AND p.idproducto='{$this->intIdProducto}'";

            $request = $this->con->select($sql);
         
            if(!empty($request)){
                
                    $intIdProducto = $request['idproducto'];

                    $sqlImg = "SELECT img
                            FROM imagen
                            WHERE productoid = $intIdProducto";

                    $arrImg = $this->con->select_all($sqlImg);

                    if(count($arrImg) > 0){

                        for($i=0; $i < count($arrImg); $i++){

                            $arrImg[$i]['url_image'] = media().'/images/uploads/'.$arrImg[$i]['img'];

                        }

                    }else{

                        $arrImg[0]['url_image'] = media().'/images/uploads/product.png';
                    }

                    $request['images'] = $arrImg;

            }

            return   $request;
        }

        #6 Extraer Producto por Paginador
        public function getProductosPage($desde,$porpagina){

            $this->con = new Mysql();

            $sql = "SELECT p.idproducto,
                           p.codigo,
                           p.nombre,
                           p.descripcion,
                           p.categoriaid,
                           c.nombre as categoria,
                           p.precio,
                           p.ruta,
                           p.stock
                    FROM producto p
                    INNER JOIN categoria c
                    ON p.categoriaid = c.idcategoria
                    WHERE p.status = 1 ORDER BY p.idproducto DESC LIMIT $desde,$porpagina ";

            $request = $this->con->select_all($sql);

            if(count($request) > 0){
                
                for($c=0; $c<count($request); $c++){

                    $intIdProducto = $request[$c]['idproducto'];

                    $sqlImg = "SELECT img
                            FROM imagen
                            WHERE productoid = $intIdProducto";

                    $arrImg = $this->con->select_all($sqlImg);

                    if(count($arrImg) > 0){

                        for($i=0; $i < count($arrImg); $i++){

                            $arrImg[$i]['url_image'] = media().'/images/uploads/'.$arrImg[$i]['img'];

                        }

                    }

                    $request[$c]['images'] = $arrImg;

                }

            }

            return   $request;
        }

        #7 Extraer las cantidad de productos

        public function cantProductos($categoria = null){

            $where = "";

            if($categoria != null){

                $where = " AND categoriaid =".$categoria;

            }

            $this->con = new Mysql();

            $sql = "SELECT COUNT(*) as total_registro FROM producto WHERE status = 1" .$where;

            $result_register = $this->con->select($sql);

            $total_registro = $result_register;

            return $total_registro;
        }

        #8 Extarer cantidad de producto deacuer a la busqueda

        public function cantProdSearch($busqueda){


            $this->con = new Mysql();

            $sql = "SELECT COUNT(*) as total_registro FROM producto WHERE nombre LIKE '%$busqueda%' and status = 1";

            $result_register = $this->con->select($sql);

            $total_registro = $result_register;

            return $total_registro;
        }


        # Extraer buqueda a un paginador
        public function getProdSearch($busqueda,$desde,$porpagina){

            $this->con = new Mysql();

            $sql = "SELECT p.idproducto,
                           p.codigo,
                           p.nombre,
                           p.descripcion,
                           p.categoriaid,
                           c.nombre as categoria,
                           p.precio,
                           p.ruta,
                           p.stock
                    FROM producto p
                    INNER JOIN categoria c
                    ON p.categoriaid = c.idcategoria
                    WHERE p.status = 1 AND p.nombre LIKE '%$busqueda%' ORDER BY p.idproducto DESC LIMIT $desde,$porpagina ";

            $request = $this->con->select_all($sql);

            if(count($request) > 0){
                
                for($c=0; $c<count($request); $c++){

                    $intIdProducto = $request[$c]['idproducto'];

                    $sqlImg = "SELECT img
                            FROM imagen
                            WHERE productoid = $intIdProducto";

                    $arrImg = $this->con->select_all($sqlImg);

                    if(count($arrImg) > 0){

                        for($i=0; $i < count($arrImg); $i++){

                            $arrImg[$i]['url_image'] = media().'/images/uploads/'.$arrImg[$i]['img'];

                        }

                    }

                    $request[$c]['images'] = $arrImg;

                }

            }

            return   $request;
        }

    }


?>