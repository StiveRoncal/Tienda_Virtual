<?php


    
class Paginas extends Controllers{

    
    public function __construct(){

        // Reempalzo de session_start y usar un helper con timer de session activa
        sessionStart();
        
        
        parent::__construct();
    
        if(empty($_SESSION['login'])){

            header('Location:'.base_url().'/login');
            die();

        }

        getPermisos(MDPAGINAS);

    }


    #1 DAr Vista 
    public function paginas(){

        
        if(empty($_SESSION['permisosMod']['r']) ){

          header("Location:".base_url().'/dashboard');

        }
    
        $data['page_tag'] = "páginas";
        $data['page_title'] = "PÁGINAS <small>Tienda Virtual</small>";
        $data['page_name'] = "paginas";
        $data['page_functions_js'] = "functions_paginas.js";

        $this->views->getView($this,"paginas",$data);
    }


    #2 Obtener paginas

    public function getPaginas(){

        if($_SESSION['permisosMod']['r']){

            $arrData = $this->model->selectPaginas();

            for($i=0; $i < count($arrData); $i++){

                $btnView = '';
                $btnEdit = '';
                $bntDelete = '';
            
                $urlPage = base_url()."/".$arrData[$i]['ruta'];

                
                
                    //Boton Ver DATATABLE
                    if($_SESSION['permisosMod']['r']){

                      $btnView = '<a title="Ver página" href="'.$urlPage.'" target="_blank" class="btn btn-info btn-sm"><i class="far fa-eye"></i></a>';

                    }

                    //Boton Actualizar DATATABLE
                    if($_SESSION['permisosMod']['u']){

                      $btnEdit = '<a title="Editar página" href="'.base_url().'/paginas/editar/'.$arrData[$i]['idpost'].'" target="_blank" class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i></a>';
                    
                    }

                    //Boton Eliminar DATATABLE
                    if($_SESSION['permisosMod']['d']){
                        
                        $bntDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo('.$arrData[$i]['idpost'].')" title="Eliminar Pagina"><i class="far fa-trash-alt"></i></button>';

                    }

                    $arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$bntDelete.' </div>';

                    }
                
                    echo json_encode($arrData,JSON_UNESCAPED_UNICODE);

        }

    }


    #3 Editar Pagina

    public function editar($idpost){


        if(empty($_SESSION['permisosMod']['u']) ){

            header("Location:".base_url().'/dashboard');
  
        }

        $idpost = intval($idpost);

        if($idpost > 0){

            $data['page_tag'] = "Actualizar páginas";
            $data['page_title'] = "ACTUALIZAR PÁGINA <small>Tienda Virtual</small>";
            $data['page_name'] = "actualizar-paginas";
            $data['page_functions_js'] = "functions_paginas.js";

            $infoPage = getInfoPage($idpost);
            
            if(empty($infoPage)){

                header("Location: ".base_url().'/paginas');

            }else{

                $data['infoPage'] = $infoPage;

            }

            $this->views->getView($this,"editarpagina",$data);

        }else{

            header("Location: ".base_url().'/paginas');

        }

        die();

    }

    #4 Actualizar Pagina

    public function setPagina(){

        if($_POST){
            // dep($_POST);
            // dep($_FILES);
            // exit();
            if(empty($_POST['txtTitulo']) || empty($_POST['txtContenido']) || empty($_POST['listStatus'])){

                $arrResponse = array("status" => false, "msg" => 'Datos Incorrectos, Estan Vacio Algunos');

              }else{

                $intIdPost   =   empty($_POST['idPost']) ? 0 : intval($_POST['idPost']);
                $strTitulo     =   strClean($_POST['txtTitulo']);
                $strContenido   =   strClean($_POST['txtContenido']);
                $intStatus        =   intval($_POST['listStatus']);

                //Ruta Sin Espacio De Producto
                $ruta = strtolower(clear_cadena($strTitulo));
                //str_replace : limpiar caracteres como ñ y tildes
                $ruta = str_replace(" ","-",$ruta);

                
                //Almacen Datos IMG
                $foto        =  $_FILES['foto'];
                $nombre_foto =  $foto['name'];
                $type        =  $foto['type'];
                $url_temp    =  $foto['tmp_name'];
                $imgPortada = '';
                $request = "";

                //Valia si o no se envia
                if($nombre_foto != ''){

                  $imgPortada = 'img_'.md5(date('d-m-Y H:i:s')).'.jpg';

                }

                     
                //Guardar Categoria Nueva
                if($intIdPost == 0){
                  
                    //crear
                    $option = 1;

                    $request = $this->model->insertPost($strTitulo,
                                                        $strContenido,
                                                        $imgPortada,
                                                        $ruta,
                                                        $intStatus);
                
                //Actualiza Categoria Existente
                }else{
                  
                  if($_SESSION['permisosMod']['u']){

                    if($nombre_foto == ''){

                        if($_POST['foto_actual'] != '' AND $_POST['foto_remove'] == 0){

                            $imgPortada = $_POST['foto_actual'];

                        }

                    }
               
                    $request = $this->model->updatePost($intIdPost,$strTitulo,$strContenido,$imgPortada,$intStatus);
                    $option = 2; 

                  }

                }


                if($request > 0){

                    //Crear 
                    if($option == 1){

                        $arrResponse = array('status'=>true, 'msg'=> 'Datos Guardados Correctamente');

                        if($nombre_foto != ''){
                            uploadImage($foto,$imgPortada);
                        }
                        
                    }else{

                      $arrResponse = array('status'=>true, 'msg'=> 'Datos Actualizados Correctamente');
                      // enruta foto  subiendo a server
                      if($nombre_foto != ''){
                            uploadImage($foto,$imgPortada);
                      }

                        //   Eliminar Foto
                      if(($nombre_foto == '' AND $_POST['foto_remove'] == 1 AND 
                        $_POST['foto_actual'] != '') || ($nombre_foto != '' AND $_POST['foto_actual'] != '')){
                            deleteFile($_POST['foto_actual']);
                      }

                     
                    }

                } else if($request == 0) {

                    $arrResponse = array("status" => false, 'msg' => 'La Pagina ya Existe');

                   
                }else{
                    $arrResponse = array("status" => false, 'msg' => 'No es posible almacenar los datos');

                }

              }

              echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
        }

        die();

    }

    #5 Crear Pagina

    public function crear(){


        if(empty($_SESSION['permisosMod']['w']) ){

            header("Location:".base_url().'/dashboard');
  
        }


            $data['page_tag'] = "Crear Página";
            $data['page_title'] = "CREAR PÁGINA <small>Tienda Virtual</small>";
            $data['page_name'] = "crear-paginas";
            $data['page_functions_js'] = "functions_paginas.js";


            $this->views->getView($this,"crearpagina",$data);

       

        die();

    }


    #6 Eliminar Pagina

    public function delPagina(){
        if($_POST){
            
            if($_SESSION['permisosMod']['d']){

                $intIdpagina = intval($_POST['idPagina']);

                $requestDelete = $this->model->deletePagina($intIdpagina);

                if($requestDelete){
                    
                    $arrResponse = array('status' => true, 'msg' => 'Se Ha Eliminado Correctamente La Pagina');

                }else{

                    $arrResponse = array('status' => false, 'msg' => 'Error al Eliminar La Pagina');

                }

                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }    

    }

    die();

    }

}


?>
