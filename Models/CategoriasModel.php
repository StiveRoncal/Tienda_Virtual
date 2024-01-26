<?php

  
    class CategoriasModel extends Mysql{

        public $intIdCategoria; 
        public $strCategoria;
        public $strDescripcion;
        public $intStatus;
        public $strRuta;
        Public $strPortada;


        #0 Constructor
        public function __construct(){

            parent::__construct();

        }


        #1 Guardar o Insertar Categoria
        public function insertCategoria(string $nombre, string $descripcion, string $portada,string $ruta,int $status){
            
            $return = 0;
            $this->strCategoria = $nombre;
            $this->strDescripcion = $descripcion;
            $this->strPortada = $portada;
            $this->strRuta = $ruta;
            $this->intStatus = $status;

            //Evita Repetir Mismo Nombre de Categoria
            $sql = "SELECT * FROM categoria WHERE nombre = '{$this->strCategoria}'";
            
            //almacena Condicion SQL
            $request = $this->select_all($sql);

          
            if(empty($request)){

                $query_insert = "INSERT INTO categoria(nombre,descripcion,portada,ruta,status) VALUES(?,?,?,?,?)";

                $arrData = array($this->strCategoria, 
                                $this->strDescripcion, 
                                $this->strPortada,
                                $this->strRuta, 
                                $this->intStatus);

                $request_insert = $this->insert($query_insert,$arrData);

                $return = $request_insert;

            }else{

                $return = false;
            }

            return $return;

        }


        #2  Seleccionar Todos Las Categorias
        public function selectCategorias(){

            $sql = "SELECT * FROM categoria 
                    WHERE status != 0 ";

            $request = $this->select_all($sql);

            return   $request;

        }

        #3 Seleccionar Una Categoria
        public function selectCategoria(int $idcategoria){

            $this->intIdCategoria = $idcategoria;

            $sql = "SELECT * FROM categoria 
                    WHERE idcategoria = $this->intIdCategoria ";

            $request = $this->select($sql);

            return $request;
            
        }

        #4 Actualizar una Categoria
        public function updateCategoria(int $idcategoria, string $categoria, string $descripcion, string $portada,string $ruta, int $status){

            $this->intIdCategoria = $idcategoria;
            $this->strCategoria = $categoria;
            $this->strDescripcion = $descripcion;
            $this->strPortada = $portada;
            $this->strRuta = $ruta;
            $this->intStatus = $status;

            //valida si existe el nombre de una categoria igual, evitar repetir nombre
            $sql = "SELECT * FROM categoria WHERE nombre = '{$this->strCategoria}' AND idcategoria != $this->intIdCategoria";

            $request = $this->select_all($sql);

            if(empty($request)){

                $sql = "UPDATE categoria SET nombre = ?, descripcion = ?, portada = ?, ruta = ?, status = ? WHERE idcategoria = $this->intIdCategoria";

                $arrData = array($this->strCategoria,
                                 $this->strDescripcion,
                                 $this->strPortada,
                                 $this->strRuta,
                                 $this->intStatus );

                $request = $this->update($sql,$arrData);

            }else{

                $request = false;

            }

            return $request;

        }


        #5 Eliminar una Categoria
        public function deleteCategoria(int $idcategoria){

            $this->intIdCategoria = $idcategoria;
            
            //valida si existe un id similiar
            $sql = "SELECT * FROM producto WHERE categoriaid = $this->intIdCategoria";
          
            $request = $this->select_all($sql);

            if(empty($request)){
            
                $sql = "UPDATE categoria SET status = ? WHERE idcategoria = $this->intIdCategoria ";
            
                $arrData = array(0);
              
                $request = $this->update($sql,$arrData);

                
                if($request){

                    $request = 'ok';

                }else{

                    $request = 'error';
                }
            }else{

                $request = false;
            }
            
            return $request;
        }


        #6 Extrear las categorias al footer

        public function getCategoriasFooter(){

            $sql = "SELECT idcategoria, nombre, descripcion, portada, ruta
                    FROM categoria WHERE status = 1 AND idcategoria IN (".CAT_FOOTER.")";

            $request = $this->select_all($sql);


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
