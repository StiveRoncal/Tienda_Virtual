<?php


    // Heredacion
  class Errors extends Controllers{

    public function __construct(){
        // Ejecucion de dos metodos por su herencia y constructor de libnrtaties controllers
    parent::__construct();

 
    }

    public function notFound(){

        $pageContent = getPageRout('not-found');

        if(empty($pageContent)){

          header("Location: ".base_url());

        }else{

         
          $data['page_tag'] = NOMBRE_EMPRESA;
          $data['page_title'] = NOMBRE_EMPRESA." - ".$pageContent['titulo'];
          $data['page_name'] = $pageContent['titulo'];
          // Ruta en la Base de datos
          $data['page'] = $pageContent;
    
          $this->views->getView($this,"error",$data);

        }
       
    }
  }

// Creacion de instancia fuera de la clase
$notFound = new Errors();    
// Ejecutar el metodo de la clase fuera
$notFound->notFound();  
?>