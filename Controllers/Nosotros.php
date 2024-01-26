<?php



  class Nosotros extends Controllers{

  

    public function __construct(){

        parent::__construct();
        session_start();

        getPermisos(MDPAGINAS);

      

    }

    // 1er Metodo Principal

      public function nosotros(){
        


          $data['page_tag'] = NOMBRE_EMPRESA;
          $data['page_title'] = NOMBRE_EMPRESA;
          $data['page_name'] = "tienda_virtual";
          // Ruta en la Base de datos
          $data['page'] = getPageRout('nosotros');

          if(empty($data['page'])){

              header("Location: ".base_url());

          }
  

    
          $this->views->getView($this,"nosotros",$data);

          
      }


  

  }
?>