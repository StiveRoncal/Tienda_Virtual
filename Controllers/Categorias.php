<?php

class Categorias extends Controllers{



    #0 Constructor
    public function __construct(){

        // Reempalzo de session_start y usar un helper con timer de session activa
        sessionStart();
        
        parent::__construct();
        if(empty($_SESSION['login'])){

            header('Location:'.base_url().'/login');
            die();

        }
        //BBDD:Modulo ID(6->Categorias)
        getPermisos(MCATEGORIAS);

    }


    #1 Configuracion de Pagina
    public function Categorias(){

        //Acceso De Lectura
        if(empty($_SESSION['permisosMod']['r']) ){

            header("Location:".base_url().'/dashboard');

        }

        $data['page_tag'] = "Categorias";
        $data['page_title'] = "CATEGORIAS <small>Tienda Virtual</small>";
        $data['page_name'] = "categorias";
        $data['page_functions_js'] = "functions_categorias.js";
        
        $this->views->getView($this,"categorias",$data);

    }

    #2 Guardar o Actualiza Categoria
    public function setCategoria(){

            if($_POST){

             
              if(empty($_POST['txtNombre']) || empty($_POST['txtDescripcion']) || empty($_POST['listStatus'])){

                $arrResponse = array("status" => false, "msg" => 'Datos Incorrectos, Estan Vacio Algunos');

              }else{

                $intIdCategoria   =   intval($_POST['idCategoria']);
                $strCategoria     =   strClean($_POST['txtNombre']);
                $strDescripcion   =   strClean($_POST['txtDescripcion']);
                $intStatus        =   intval($_POST['listStatus']);

                //Ruta Sin Espacio De Producto
                $ruta = strtolower(clear_cadena($strCategoria));
                //str_replace : limpiar caracteres como ñ y tildes
                $ruta = str_replace(" ","-",$ruta);

                
                //Almacen Datos IMG
                $foto        =  $_FILES['foto'];
                $nombre_foto =  $foto['name'];
                $type        =  $foto['type'];
                $url_temp    =  $foto['tmp_name'];
                $imgPortada = 'portada_categoria.png';
                $request_categoria = "";

                //Valia si o no se envia
                if($nombre_foto != ''){

                  $imgPortada = 'img_'.md5(date('d-m-Y H:i:s')).'.jpg';

                }
                
                //Guardar Categoria Nueva
                if($intIdCategoria == 0){
                  
                  if($_SESSION['permisosMod']['w']){

                    $request_categoria = $this->model->insertCategoria($strCategoria,$strDescripcion,$imgPortada,$ruta,$intStatus);
                    
                    $option = 1; 
                    
                  }
                
                //Actualiza Categoria Existente
                }else{
                  
                  if($_SESSION['permisosMod']['u']){
               
                    //valida La img de la portada
                      if($nombre_foto == ''){

                        if($_POST['foto_actual'] != 'portada_categoria.png' && $_POST['foto_remove'] == 0){

                          $imgPortada = $_POST['foto_actual'];

                        }

                      }

                    $request_categoria = $this->model->updateCategoria($intIdCategoria,$strCategoria,$strDescripcion,$imgPortada,$ruta,$intStatus);
                    $option = 2; 
                  }

                }


                if($request_categoria > 0){

                    //Crear Categoria
                    if($option == 1){
        
                      $arrResponse = array('status'=>true, 'msg'=> 'Datos Guardados Correctamente');

                      //subir IMG a servidor
                      if($nombre_foto != ''){

                        uploadImage($foto,$imgPortada);

                      }
                    //Actualizo Categoria  
                    }else{

                      $arrResponse = array('status'=>true, 'msg'=> 'Datos Actualizados Correctamente');

                      //Subir img si se envia una nueva
                      if($nombre_foto != ''){

                          uploadImage($foto,$imgPortada);

                      }

                      //si se elimina foto actual=0 a 1 
                      if( ($nombre_foto == '' && $_POST['foto_remove'] == 1 && $_POST['foto_actual'] != 'portada_categoria.png') ||
                          ($nombre_foto != '' && $_POST['foto_actual'] != 'portada_categoria.png')){

                          deleteFile($_POST['foto_actual']);

                      }
                    }

                } else if ($request_categoria == false){
      
                    $arrResponse = array('status' => false, 'msg' => '¡Atencion! La Categoria Ya existe');

                } else {
      
                    $arrResponse = array("status" => false, 'msg' => 'No es posible almacenar los datos');

                }

              }

              echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
      
            }

            die();
  
    }


    #3 Extraer Todas Las Categorias
    public function getCategorias(){

      if($_SESSION['permisosMod']['r']){

        $arrData = $this->model->selectCategorias();
  
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
     
          //Boton Ver DATATABLE
          if($_SESSION['permisosMod']['r']){

            $btnView = '<button class="btn btn-info btn-sm" onClick="fntViewInfo('.$arrData[$i]['idcategoria'].')" title="Ver Categoría"><i class="far fa-eye"></i></button>';

          }

          //Boton Actualizar DATATABLE
          if($_SESSION['permisosMod']['u']){

              $btnEdit = '<button class="btn btn-primary btn-sm" onClick="fntEditInfo(this,'.$arrData[$i]['idcategoria'].')" title="Editar Categoría"><i class="fas fa-pencil-alt"></i></button>';
    
          }

          //Boton Eliminar DATATABLE
          if($_SESSION['permisosMod']['d']){
            
              $bntDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo('.$arrData[$i]['idcategoria'].')" title="Eliminar Categoría"><i class="far fa-trash-alt"></i></button>';

          }

          $arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$bntDelete.' </div>';

        }
      
      echo json_encode($arrData,JSON_UNESCAPED_UNICODE);

      }
    
      die();

    }

    #4 Extraer Una Categoria
    public function getCategoria($idcategoria){

      if($_SESSION['permisosMod']['r']){

          $intIdCategoria = intval($idcategoria);

          if($intIdCategoria > 0){

            $arrData = $this->model->selectCategoria($intIdCategoria);
    
            if(empty($arrData)){

              $arrResponse = array('status' => false, 'msg' => 'Datos No Encontrados.');

            }else{

              // Nuevo Arreglo para Ruta de IMG
              $arrData['url_portada'] = media().'/images/uploads/'.$arrData['portada'];

              $arrResponse = array('status'=> true, 'data' => $arrData);

            }

              echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);

            }
      }

        die();

    }


    #5 Eliminar Una Categoria
    public function delCategoria(){
    
     
      if($_POST){

        if($_SESSION['permisosMod']['d']){

              $intIdCategoria = intval($_POST['idCategoria']);

            
              $requestDelete = $this->model->deleteCategoria($intIdCategoria);

            
              if($requestDelete == 'ok'){

                
                $arrResponse = array('status' => true, 'msg' => 'Se Ha Eliminado La Categoria');
            
              }else if($requestDelete == false){

                $arrResponse = array('status' => false, 'msg' => 'No es posible eliminar Categoria con Un Producto Asociado o Relacionado.');
              
              }else{

                $arrResponse = array('status' => false, 'msg' => 'Error al Eliminar Categoria' );

              }

              echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
      }
          
        die();

    }


    #6 Selecionar Todas las Categoria OJO=>usamos para Selected input en modalproductos
    public function getSelectCategorias(){
      
      $htmlOptions = "";

      $arrData = $this->model->selectCategorias();

      if(count($arrData) > 0){

        for($roncal = 0 ; $roncal < count($arrData); $roncal++){

          if($arrData[$roncal]['status'] == 1){

            $htmlOptions .= '<option value="'.$arrData[$roncal]['idcategoria'].'">'.$arrData[$roncal]['nombre'].'</option>';

          }

        }

      }

      echo $htmlOptions;
  
      die();
      
    }

}