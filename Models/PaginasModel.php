<?php


    class PaginasModel extends Mysql{

        private $intIdPagina;
        private $strTitulo;
        private $strContenido;
        private $intStatus;
        private $strRuta;
        private $strImage;

    


        public function __construct(){

          
            parent::__construct();

        

        }

        #1 Seleccionar PAginas
        public function selectPaginas(){

            $sql = "SELECT idpost, titulo , DATE_FORMAT(datecreated, '%d/%m/%Y') as fecha, ruta, status
                    FROM post
                    WHERE status != 0 ";

            $request = $this->select_all($sql);

            return $request;
        

        }

        #2 Actualizar Paginas

        public function updatePost(int $idPost, string $titulo, string $contenido, string $portada, int $status){

            $this->intIdPagina = $idPost;
            $this->strTitulo = $titulo;
            $this->strContenido = $contenido;
            $this->strImage = $portada;
            $this->intStatus = $status;

            $sql = "UPDATE post SET titulo = ?, contenido = ?, portada=?, status = ? WHERE idpost = $this->intIdPagina";

            $arrData = array($this->strTitulo,
                            $this->strContenido ,
                            $this->strImage,
                            $this->intStatus);

            $request = $this->update($sql,$arrData);

            return $request;

        }


        #3 Crear PAgina

        public function insertPost(string $titulo, string $contenido, string $portada,string $ruta, int $status){

            
            $this->strTitulo = $titulo;
            $this->strContenido = $contenido;
            $this->strImage = $portada;
            $this->strRuta = $ruta;
            $this->intStatus = $status;

            $sql = "SELECT * FROM post WHERE ruta = '{$this->strRuta}'";

            $request = $this->select_all($sql);

            if(empty($request)){

                $query_insert = "INSERT INTO post(titulo,
                                                    contenido,
                                                    portada,
                                                    ruta,
                                                    status)
                                VALUES(?,?,?,?,?)";

                $arrData = array( $this->strTitulo,
                                    $this->strContenido,
                                    $this->strImage,
                                    $this->strRuta,
                                    $this->intStatus);

                $request_insert = $this->insert($query_insert,$arrData);

                $return = $request_insert;

            }else{
                $return = 0;
            }

            return $return;

        }


        #4 Eliminar pagian

        public function deletePagina(int $idpagina){

            $this->intIdPagina = $idpagina;

            $sql = "UPDATE post SET status = ? WHERE idpost = $this->intIdPagina";

            $arrData = array(0);

            $request = $this->update($sql,$arrData);

            return $request;
        }

    }

?>
