<?php



  class Contacto extends Controllers{

  

    public function __construct(){

        parent::__construct();
        session_start();
        getPermisos(MDPAGINAS);

    }

    // 1er Metodo Principal

      public function contacto(){
        


          $data['page_tag'] = NOMBRE_EMPRESA;
          $data['page_title'] = NOMBRE_EMPRESA;
          $data['page_name'] = "tienda_virtual";
          $data['page'] = getPageRout('contacto');

          if(empty($data['page'])){

            header("Location: ".base_url());

        }
          
          $this->views->getView($this,"contacto",$data);

          
      }


  

  }
?>