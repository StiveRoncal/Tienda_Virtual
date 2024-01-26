<?php


class Contactos extends Controllers{

    
    public function __construct(){

        // Reempalzo de session_start y usar un helper con timer de session activa
        sessionStart();
        
        
        parent::__construct();
    
        if(empty($_SESSION['login'])){

            header('Location:'.base_url().'/login');
            die();

        }

        getPermisos(MDCONTACTOS);

    }


    # DAr Vista 
    public function Contactos(){

        
        if(empty($_SESSION['permisosMod']['r']) ){

          header("Location:".base_url().'/dashboard');

        }
    
        $data['page_tag'] = "Contactos";
        $data['page_title'] = "CONTACTOS <small>Tienda Virtual</small>";
        $data['page_name'] = "contactos";
        $data['page_functions_js'] = "functions_contactos.js";

        $this->views->getView($this,"contactos",$data);
    }


    // # 1 Obtener los Contactos

    public function getContactos(){

        if($_SESSION['permisosMod']['r']){

            $arrData = $this->model->selectContactos();
            
            for($i=0; $i < count($arrData);$i++){

                $btnView= '';

                if($_SESSION['permisosMod']['r']){

                    $btnView = '<button class="btn btn-info btn-sm" onClick="fntViewInfo('.$arrData[$i]['id'].')" title="Ver mensaje"><i class="far fa-eye"></i></button>';

                }

                $arrData[$i]['options'] = '<div class="text-center">'.$btnView.'</div>';

            }
            

            echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
        }

            die();

        }


    // #2 obtener mensaje
    
    public function getMensaje($idmensaje){


        if($_SESSION['permisosMod']['r']){

            $idmensaje = intval($idmensaje);
        
            //id existente en BD
            if($idmensaje  > 0){

                //Extraer Datos de 1 Producto Por Su ID
                $arrData = $this->model->selectMensaje($idmensaje);


                if(empty($arrData)){

                    $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');

                }else{

                    $arrResponse = array('status' => true, 'data' => $arrData);


                }
                
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
        }
            

        }
        die();


    }
    
        




    }
?>
