<?php

    class ProductosModel extends Mysql{

        private $intIdProducto;
        private $strNombre;
        private $strDescripcion;
        private $intCodigo;
        private $intCategoriaId;
        private $intPrecio;
        private $intStock;
        private $strRuta;
        private $intStatus;
        private $strImagen;
       



        #0 Constructor
        public function __construct(){

            parent::__construct();

        }

        #1 Seleccionar Todos los Productos

        public function selectProductos(){

            $sql = "SELECT p.idproducto,
                           p.codigo,
                           p.nombre,
                           p.descripcion,
                           p.categoriaid,
                           c.nombre as categoria,
                           p.precio,
                           p.stock,
                           p.status
                    FROM producto p
                    INNER JOIN categoria c
                    ON p.categoriaid = c.idcategoria
                    WHERE p.status != 0 ";

            $request = $this->select_all($sql);

            return   $request;
        }

        #2 Insertar un Producto

        public function insertProducto(string $nombre, string $descripcion, string $codigo, int $categoriaid, string $precio, int $stock,string $ruta, int $status){

            $this->strNombre = $nombre;
            $this->strDescripcion = $descripcion;
            $this->intCodigo = $codigo;
            $this->intCategoriaId = $categoriaid;
            $this->strPrecio = $precio;
            $this->intStock = $stock;
            $this->strRuta = $ruta;
            $this->intStatus = $status;

            $return = 0;

            $sql = "SELECT * FROM producto WHERE codigo = '{$this->intCodigo}' ";

            $request = $this->select_all($sql);

            if(empty($request)){

                $query_insert = "INSERT INTO producto(categoriaid,
                                                        codigo,
                                                        nombre,
                                                        descripcion,
                                                        precio,
                                                        stock,
                                                        ruta,
                                                        status)
                                VALUES(?,?,?,?,?,?,?,?)";
                
                $arrData = array($this->intCategoriaId,
                                $this->intCodigo,
                                $this->strNombre,
                                $this->strDescripcion,
                                $this->strPrecio,
                                $this->intStock,
                                $this->strRuta,
                                $this->intStatus);

                $request_insert = $this->insert($query_insert,$arrData);

                $return = $request_insert;

            }else{

                $return = false;

            }

            return $return;
        }


        #3 Guardar imagenes de Producto

        public function insertImage(int $idproducto, string $imagen){

            $this->intIdProducto = $idproducto;

            $this->strImagen = $imagen;

            $query_insert = "INSERT INTO imagen(productoid,img) VALUES(?,?)";

            $arrData = array($this->intIdProducto,
                            $this->strImagen);
            
            $request_insert = $this->insert($query_insert,$arrData);

            return $request_insert;

        }



        #4 Seleccionar un Producto

        public function selectProducto(int $idproducto){
            // Valor Recibo de Controlador
            $this->intIdProducto = $idproducto;

            $sql = "SELECT p.idproducto,
                            p.codigo,
                            p.nombre,
                            p.descripcion,
                            p.precio,
                            p.stock,
                            p.categoriaid,
                            c.nombre as categoria,
                            p.status
                    FROM producto p
                    INNER JOIN categoria c
                    ON p.categoriaid = c.idcategoria
                    WHERE idproducto = $this->intIdProducto";

            $request = $this->select($sql);

            return $request;

        }


        #5 Extraer imagenes de producto por id

        public function selectImages(int $idproducto){

            $this->intIdProducto = $idproducto;

            $sql = "SELECT productoid, img
                    FROM imagen
                    WHERE productoid = $this->intIdProducto";

            $request = $this->select_all($sql);

            return $request;
        }


        #6 Actualizar Producto

        public function updateProducto(int $idproducto, string $nombre, string $descripcion, string $codigo, int $categoriaid, string $precio, int $stock,string $ruta, int $status){

            $this->intIdProducto = $idproducto;
            $this->strNombre = $nombre;
            $this->strDescripcion = $descripcion;
            $this->intCodigo = $codigo;
            $this->intCategoriaId = $categoriaid;
            $this->strPrecio = $precio;
            $this->intStock = $stock;
            $this->strRuta = $ruta;
            $this->intStatus = $status;

            $return = 0;

            $sql = "SELECT * FROM producto WHERE codigo = '{$this->intCodigo}' AND idproducto != $this->intIdProducto ";

            $request = $this->select_all($sql);

            if(empty($request)){

                $sql = "UPDATE producto
                        SET categoriaid = ?,
                            codigo = ?,
                            nombre = ?,
                            descripcion = ?,
                            precio = ?,
                            stock = ?,
                            ruta = ?,
                            status = ?
                        WHERE idproducto = $this->intIdProducto";
                
                $arrData = array(
                                $this->intCategoriaId,
                                $this->intCodigo,
                                $this->strNombre,
                                $this->strDescripcion,
                                $this->strPrecio,
                                $this->intStock,
                                $this->strRuta,
                                $this->intStatus);
                
                $request = $this->update($sql,$arrData);

                $return =  $request;

            }else{

                $return = false;
            }

            return $return;
        }

        # 7 Eliminar Foto de Producto

        public function deleteImage(int $idproducto, string $imagen){

            $this->intIdProducto = $idproducto;

            $this->strImagen = $imagen;

            $query = "DELETE FROM imagen
                    WHERE productoid = $this->intIdProducto
                    AND img = '{$this->strImagen}'";

            $request_delete = $this->delete($query);

            return $request_delete;

        }


        #8 Eliminar Producto

        public function deleteProducto(int $idproducto){

            $this->intIdProducto = $idproducto;

            $sql = "UPDATE producto SET status = ? WHERE idproducto = $this->intIdProducto";

            $arrData = array(0);

            $request = $this->update($sql,$arrData);

            return $request;
            
        }
    }

?>