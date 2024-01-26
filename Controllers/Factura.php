<?php

  // Documentacionde GITHUB de Hmtl2PDF
  require 'Libraries/html2pdf/vendor/autoload.php'; 

  use Spipu\Html2Pdf\Html2Pdf;

  class Factura extends Controllers{

  
    public function __construct(){

        // Ejecucion de dos metodos por su herencia y constructor de libnrtaties controllers
        parent::__construct();
        session_start();

        if(empty($_SESSION['login'])){

          header('Location: '.base_url().'/login');
          die();
        }

        getPermisos(MPEDIDOS);

    }

    // 1er Metodo Principal

      public function generarFactura($idpedido){

        if($_SESSION['permisosMod']['r']){


          if(is_numeric($idpedido)){

            $idpersona = "";

            if($_SESSION['permisosMod']['r'] and $_SESSION['userData']['idrol'] == RCLIENTES){

              $idpersona = $_SESSION['userData']['idpersona'];

            }


            $data = $this->model->selectPedido($idpedido,$idpersona);

              if(empty($data)){

                  echo "Datos encontrados";

              }else{

                $idpedido = $data['orden']['idpedido'];

                ob_end_clean();

                $html = getFile("Template/Modals/comprobantePDF",$data);

                //COsas de GITHUB html2pdf
                $html2pdf = new Html2Pdf('p','A4','es','true','UTF-8');
                $html2pdf->writeHTML($html);
                // nombre o titulo del archivo
                $html2pdf->output('Comprobante-'.$idpedido.'.pdf');


              }

          
        }else{

            echo "Dato no Válido";

        }


        }else{

          header('Location: '.base_url().'/login');
          die();
            
        }
        
         

          
      }


  

  }
?>