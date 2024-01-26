<?php

  require_once("Models/TCategoria.php");
  require_once("Models/TProducto.php");

  class Home extends Controllers{

    //Uso de Trait
    use TCategoria, TProducto;

    public function __construct(){

        // Ejecucion de dos metodos por su herencia y constructor de libnrtaties controllers
        parent::__construct();
        session_start();
    }

    // 1er Metodo Principal

      public function home(){
        
          $pageContent = getPageRout('inicio');

          $data['page_tag'] = NOMBRE_EMPRESA;
          $data['page_title'] = NOMBRE_EMPRESA;
          $data['page_name'] = "tienda_virtual";

          $data['page'] = $pageContent;

          $data['slider'] = $this->getCategoriasT(CAT_SLIDER);
          $data['banner'] = $this->getCategoriasT(CAT_BANNER);
          $data['productos'] = $this->getProductosT();
          $this->views->getView($this,"home",$data);

          
      }


  

  }
?>