<?php

    // Variables globales
    // define("BASE_URL" , "http://localhost/tienda_virtual/");
    const BASE_URL = "http://localhost/tienda_virtual_produccion";
    // const BASE_URL = "https://ferreteriaroncal.000webhostapp.com";
    


    // Zona Horaria Peru
    date_default_timezone_set('America/Lima');


    //Servidores de 000WebHost
    // variables globales para conectarmos a la BD
    // const DB_HOST="localhost";
    // const DB_NAME="id21528157_nsroncal";
    // const DB_USER="id21528157_nsroncal";
    // const DB_PASSWORD = "Stive=72560007"; 
    // const DB_CHARSET = "utf8";


    //SERVIDOR LOCAL
    const DB_HOST="localhost";
    const DB_NAME="db_tienda_virtual_produccion";
    // const DB_NAME="id21818038_tienda_virtual";
    const DB_USER="root";
    // const DB_USER="id21818038_stiveesau";
    const DB_PASSWORD = ""; 
    // const DB_PASSWORD = "Stive=72560007"; 
    const DB_CHARSET = "utf8";

    //Para envio de correo

    const ENVIRONMENT = 0; //Local: 0, Produccion: 1


    // Delimitador decimal y millar ej. 24,50.00
    const SPD = ".";
    const SPM = ',';

    // Simbolo de moneda
    // Toy triste paypal solo funciona con Dolar
    // const SMONEY = "S/";
    // const SMONEY = "E";
    // const CURRENCY = "EUR";

    const SMONEY = "S/";
    const SMONEYDOLAR = "$";
    const CURRENCY = "USD";

    const Dolar = 3.76;


    //SANBOX Paypal (PRUEBA)
    //URL PRUEBA DE Curl SANBOX
    const URLPAYPAL = "https://api-m.sandbox.paypal.com";    
    const IDCLIENTE = "AQ9MRqST3eImRVfyi9DSPF6MykZK01v2m5URn_rPg1oJLxn5p8SeRh3MwyDhtfRmc9sO1sUgJMSy0LKo";
    const SECRET = "EDjqM-I3AZ2jhz1A-d-mEWZa6SIQh1zXJrnpsirocgfYA0JsxZqDr_Hx7M2-PC-XwQB00PTa65fE6D-g";

    //LIVE PAYPAL(PRODUCCCION)

    // const IDCLIENTE = "ASQSRg2LCwn6vKuaKUx_tz0LKq11LFBWZgHQypvkE20nrq4mb2Bf_Z3xq95rswQTvy6w68A5m2HRB2_S";
    // const URLPAYPAL = "https://api-m.paypal.com";
    // const SECRET = "EN8UHeyCEfJOwWQaqcz5scMXWGtRH8Z6dMwiafgIxvs4K5TNVw-fTHUgzna6p47ulhA_JlZN3CMgiQtr";
    // Datos envio correo

    const NOMBRE_REMITENTE = "Tienda Virtual RONCAL";
    const EMAIL_REMITENTE = "no-reply@abelosh.com";


    const NOMBRE_EMPRESA = "Ferreteria Roncal";
    const WEB_EMPRESA = "www.nsroncal.com";
    const DESCRIPCION = "La mejor tienda en linea con articulos de Ferreteria Electrica e Industrial.";
    const SHAREDHASH = "TiendaVirtual";

    // const NOMBRE_REMITENTE = "Nombre Remitente de correo";
	// const EMAIL_REMITENTE = "no-reply@abelosh.com";
	// const NOMBRE_EMPESA = "Nombre Empresa";
	// const WEB_EMPRESA = "Página Web empresa";

    //datos Empresa     
    const DIRECCION = "Calle 28 de Julio Nro.725, Pangoa";
    const TELEEMPRESA = "+(51) 934027842";
    const WHATSAPP = "+51934027842";
    const EMAIL_EMPRESA = "nsroncal@gmail.com";
    const EMAIL_PEDIDO = "stiveroncal@gmail.com";

    const EMAIL_SUSCRIPTOR = "stiveroncal@gmail.com";
    const EMAIL_CONTACTO = "stiveroncal@gmail.com";


    //Categorias Eligir
    const CAT_SLIDER = "1,2,3";
    const CAT_BANNER = "4,5,6";
    const CAT_FOOTER = "1,2,3,4,5,6";





    //Recordar Stive Es para Datos Encriptar | Desencriptar
    const KEY = 'stive';
    const METHODENCRIPT = "AES-128-ECB";

    const COSTOENVIO = 0;

    //Modulos id 5 => PEDIDOS
    const MDASHBOARD = 1;
    const MUSUARIOS = 2;
    const MCLIENTES = 3;
    const MPRODUCTOS = 4;
    const MPEDIDOS = 5;
    const MCATEGORIAS = 6;
    const MSUSCRIPTORES = 7;
    const MDCONTACTOS = 8;
    const MDPAGINAS = 9;


  



    //Paginas

    const PINICIO = 1;
    const PTIENDA = 2;
    const PCARRITO = 3;
    const PNOSOTROS = 4;
    const PCONTACTO = 5;
    const PPREGUNTA= 6;
    const PTERMINOS = 7;
    const PSURCURSALES = 8;
    const PERROR = 9;

    //Roles 7 => Clientes
    const RADMINISTRADOR = 1;
    const RSUPERVISOR = 2;
    // const RCLIENTES = 7;
    const RCLIENTES = 3;



    // Tipos de Pago Todos 
    const STATUS = array('Completo','Aprobado','Cancelado','Reembolsado','Pendiente','Entregado');
    

    // Ver Cantidad de Producto por Pagina

    const CANTPORDHOME = 16;

    //Producto por pagina

    const PROPORPAGINA = 16;

    //Mostrar producto por categoria

    const PROCATEGORIA = 16 ;

    //Mostra busquedas por producto

    const PROBUSCAR = 16;


    //REdes Solciales

    const FACEBOOK = "https://facebook.com/FerreteriaRoncal";
    const GITHUB = "https://github.com/";
    const LINKEDLN = "https://pe.linkedin.com/";
    const INSTAGRAM = "";
    const TIKTOK ="";
    const TWITTER="";
    const YOUTUBE="";
    const WHATAPP="";
?>