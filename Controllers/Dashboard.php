<?php



  class Dashboard extends Controllers{

    public function __construct(){

        // Ejecucion de dos metodos por su herencia y constructor de libnrtaties controllers
        // Reempalzo de session_start y usar un helper con timer de session activa

        sessionStart();

        parent::__construct();

      
      
      // condicional si no esxiste la variabe¿le seesion
      if(empty($_SESSION['login'])){

        //redireciona 
        header('location: '.base_url().'/login');
        die();
      }

      getPermisos(MDASHBOARD);

  
    }

    // 1er Metodo

    public function dashboard(){
        // arreglo de un parametro $data
        $data['page_id'] = 2;
        $data['page_tag'] = "Dashboard - Tienda Virtual";
        $data['page_title'] = "Dashboard - Tienda Virtual";
        $data['page_name'] = "dashboard";
        $data['page_functions_js'] = "functions_dashboard.js";

        $data['usuarios']= $this->model->cantUsuarios();
        $data['clientes'] = $this->model->cantClientes();
        $data['productos'] = $this->model->cantProductos();
        $data['pedidos'] = $this->model->cantPedidos();
        $data['pedidos'] = $this->model->cantPedidos();
        $data['lastOrders'] = $this->model->lastOrders();
        $data['productosTen'] = $this->model->productosTen();
       


        $anio = date('Y');
        $mes = date('m');

        $data['pagosMes'] = $this->model->selectPagosMes($anio,$mes);
      
        $data['ventasMDia'] = $this->model->selectVentasMes($anio,$mes);

        $data['ventasAnio'] = $this->model->selectVentasAnio($anio);

        // dep(json_encode($data['ventasMDia']));exit;

        // dep($data['ventasAnio']);exit;

        if($_SESSION['userData']['idrol'] == RCLIENTES){

          $this->views->getView($this,"dashboardCliente",$data);

        }else{

          $this->views->getView($this,"dashboard",$data);

        }

       
    }

    #2 Metodo para obtener los tipos de pagos realizados cada mes

    public function tipoPagoMes(){

      if($_POST){

        $grafica = "tipoPagoMes";

        $nFecha = str_replace("","",$_POST['fecha']);

        $arrFecha = explode('-',$nFecha);

        $mes = $arrFecha[0];

        $anio = $arrFecha[1];

        $pagos = $this->model->selectPagosMes($anio,$mes);

        $script = getFile("Template/Modals/graficas",$pagos);

        echo $script;

        die();

      }

    }


    #3 Metodo para obtener los Meses y los dias 

    public function ventasMes(){

      if($_POST){

        $grafica = "ventasMes";

        $nFecha = str_replace("","",$_POST['fecha']);

        $arrFecha = explode('-',$nFecha);

        $mes = $arrFecha[0];

        $anio = $arrFecha[1];

        $pagos = $this->model->selectVentasMes($anio,$mes);

        $script = getFile("Template/Modals/graficas",$pagos);

        echo $script;

        die();

      }

    }

    #4 Metoro para obtener las ventas del Año y Meses

    public function ventasanio(){

      if($_POST){

        $grafica = "ventasAnio";

        $anio = intval($_POST['anio']);

        $pagos = $this->model->selectVentasAnio($anio);

        $script = getFile("Template/Modals/graficas",$pagos);

        echo $script;

        die();

      }

    }

    

  

  }
?>