<?php

    class Productos extends Controllers{

    #0 Constructor
    public function __construct(){

        // Reempalzo de session_start y usar un helper con timer de session activa
        sessionStart();
        
        parent::__construct();
        if(empty($_SESSION['login'])){

            header('Location:'.base_url().'/login');
            die();

        }

        //BBDD:Modulo ID(4->Productos)
        getPermisos(MPRODUCTOS);

    }


    #1 Configuracion de Pagina
    public function Productos(){

        //Acceso De Lectura
        if(empty($_SESSION['permisosMod']['r']) ){

            header("Location:".base_url().'/dashboard');

        }

        $data['page_tag'] = "Productos";
        $data['page_title'] = "PRODUCTOS <small>Tienda Virtual</small>";
        $data['page_name'] = "productos";
        $data['page_functions_js'] = "functions_productos.js";
        
        $this->views->getView($this,"productos",$data);

    }


    #2 Extrear todos los productos
    public function getProductos(){
        
      if($_SESSION['permisosMod']['r']){

            $arrData = $this->model->selectProductos();
    
            for($i=0; $i < count($arrData); $i++){

                $btnView = '';
                $btnEdit = '';
                $bntDelete = '';
            
            //Validar Status Porque es NUMERO por HTML
            if($arrData[$i]['status'] == 1){

                $arrData[$i]['status'] = '<span class="badge badge-success">Activo</span>';

            }else{

                $arrData[$i]['status'] = '<span class="badge badge-danger">Inactivo</span>';
            }

            //Formato de moneda
            $arrData[$i]['precio'] = SMONEY.' '.formatMoney($arrData[$i]['precio']);
        
            //Boton Ver DATATABLE
            if($_SESSION['permisosMod']['r']){

                $btnView = '<button class="btn btn-info btn-sm" onClick="fntViewInfo('.$arrData[$i]['idproducto'].')" title="Ver Producto"><i class="far fa-eye"></i></button>';

            }

            //Boton Actualizar DATATABLE
            if($_SESSION['permisosMod']['u']){

                $btnEdit = '<button class="btn btn-primary btn-sm" onClick="fntEditInfo(this,'.$arrData[$i]['idproducto'].')" title="Editar Producto"><i class="fas fa-pencil-alt"></i></button>';
        
            }

            //Boton Eliminar DATATABLE
            if($_SESSION['permisosMod']['d']){
                
                $bntDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo('.$arrData[$i]['idproducto'].')" title="Eliminar Producto"><i class="far fa-trash-alt"></i></button>';

            }

            $arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$bntDelete.' </div>';

            }
        
            echo json_encode($arrData,JSON_UNESCAPED_UNICODE);

        }
        
        die();
    }


    #3 Guardar o Actualizar Producto  
    public function setProducto(){

        if($_POST){

          if(empty($_POST['txtNombre']) || empty($_POST['txtCodigo']) || empty($_POST['listCategoria']) ||  empty($_POST['txtDescripcion']) || 
             empty($_POST['txtPrecio']) || empty($_POST['txtStock'])  || empty($_POST['listStatus'])){

            $arrResponse = array("status" => false, "msg" => 'Datos Incorrectos, Estan Vacio Algunos, Todos Los Campos Deben Rellenarse');

          }else{


            $idProducto     = intval($_POST['idProducto']);
            $strNombre      = strClean($_POST['txtNombre']);
            $strDescripcion = strClean($_POST['txtDescripcion']);
            $strCodigo      = strClean($_POST['txtCodigo']);
            $intCategoriaId = intval($_POST['listCategoria']);
            $strPrecio      = strClean($_POST['txtPrecio']);
            $intStock       = intval($_POST['txtStock']);
            $intStatus      = intval($_POST['listStatus']);

            $request_producto = "";

            //Ruta Sin Espacio De Producto
            $ruta = strtolower(clear_cadena($strNombre));
            //str_replace : limpiar caracteres como ñ y tildes
            $ruta = str_replace(" ","-",$ruta);

            //GUARDAR PRODUCTO
            if($idProducto == 0){

                $option = 1;

                if($_SESSION['permisosMod']['w']){

                    $request_producto = $this->model->insertProducto($strNombre,
                                                                $strDescripcion,
                                                                $strCodigo,
                                                                $intCategoriaId,
                                                                $strPrecio,
                                                                $intStock,
                                                                $ruta,
                                                                $intStatus);
                }

            }else{

                $option = 2;

                if($_SESSION['permisosMod']['w']){

                    $request_producto = $this->model->updateProducto($idProducto,
                                                                    $strNombre,
                                                                    $strDescripcion,
                                                                    $strCodigo,
                                                                    $intCategoriaId,
                                                                    $strPrecio,
                                                                    $intStock,
                                                                    $ruta,
                                                                    $intStatus);

                }
            }

            //Validar envio de datos de insertProducto 

            if($request_producto > 0){

                if($option == 1){

                    $arrResponse = array('status' => true, 'idproducto' => $request_producto, 'msg' => 'Datos de Producto Guardados Correctamente =) ');

                }else{

                    $arrResponse = array('status' => true, 'idproducto' => $idProducto ,'msg' => 'Datos de Producto Actualizado Correctamente. X)');

                }

            }else if($request_producto == false){

                $arrResponse = array('status' => false, 'msg' => '!Atención¡ Ya Existe un Producto Con el Mismo Código Ingresado, Hay Repetición En Codigo en Barra, Cambialo para evitar repeticion');

            }else{

                $arrResponse = array("status" => false, "msg" => 'No es Posible Almacenar los Datos');

            }

          }

          echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
  
        }

        die();

    }


    #4 Guardar Images de Productos

    public function setImage(){

        // dep($_POST);dep($_FILES);

        if($_POST){

            //valor de id de producto
            if(empty($_POST['idproducto'])){
                
                $arrResponse = array('status' => false, 'msg' => 'Error en Carga');

            }else{

                $idProducto = intval($_POST['idproducto']);
         
                //arreglo inf de foto
                $foto = $_FILES['foto'];
                //nombre img 
                $imgNombre = 'prod_'.md5(date('d-m-Y H:m:s')).'.jpg';
                //insercion a BBDD
                $request_image = $this->model->insertImage($idProducto,$imgNombre);

                //Condicional si se envio
                if($request_image){

                    $uploadImage = uploadImage($foto,$imgNombre);

                    $arrResponse = array('status' => true, 'imgname' => $imgNombre, 'msg' => 'Archivo Cargado Roncal');

                }else{

                    $arrResponse = array('status' => false, 'msg' => 'Error en Carga');

                }
            }

            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            
        }
       
        die();

    }

    #5 Obtener Producto

    public function getProducto($idproducto){

        if($_SESSION['permisosMod']['r']){

            $idproducto = intval($idproducto);
        
            //id existente en BD
            if($idproducto  > 0){

                //Extraer Datos de 1 Producto Por Su ID
                $arrData = $this->model->selectProducto($idproducto);

                if(empty($arrData)){

                    $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');

                }else{

                    //Extraer images por ID

                    $arrImg = $this->model->selectImages($idproducto);

                    // nro registros
                    if(count($arrImg) > 0){

                        //recorrer todo registro de img
                        for($i=0; $i < count($arrImg); $i++){
                            // poscion 1 - todo [elemetno] con direrecion con renombre img con ruta de imagen
                            $arrImg[$i]['url_image'] = media().'/images/uploads/'.$arrImg[$i]['img'];

                        }

                    }

                    $arrData['images'] = $arrImg;

                    $arrResponse = array('status' => true, 'data' => $arrData);


                }
                
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
        }
            

        }
        die();

    }


    #Eliminar Foto de Producto

    public function delFile(){

        if($_POST){

            if(empty($_POST['idproducto']) || empty($_POST['file'])){

                $arrResponse = array("status" => false, "msg" => 'Datos Incorrectos');

            }else{

                //eliminar de BBDD

                $idProducto = intval($_POST['idproducto']);

                $imgNombre = strClean($_POST['file']);

                $request_image = $this->model->deleteImage($idProducto,$imgNombre);

                if($request_image){

                    $deleteFile = deleteFile($imgNombre);

                    $arrResponse = array('status' => true, 'msg' => 'Archivo Eliminado');

                }else{

                    $arrResponse = array('status' => false, 'msg' => 'Error al Eliminar');

                }   

            }
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
        }

        die();
    }

    #Eliminar Producto pero Actualizando El Estado

    public function delProducto(){

        if($_POST){
            
                if($_SESSION['permisosMod']['d']){

                    $intIdproducto = intval($_POST['idProducto']);

                    $requestDelete = $this->model->deleteProducto($intIdproducto);

                    if($requestDelete){
                        
                        $arrResponse = array('status' => true, 'msg' => 'Se Ha Eliminado Correctamente El Producto');

                    }else{

                        $arrResponse = array('status' => false, 'msg' => 'Error al Eliminar El Producto');

                    }

                    echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
                }    

        }

        die();

    }

}
?>