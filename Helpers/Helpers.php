<?php

    //FUNCION para Envio de Correo Con PHPMAILER
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'Libraries/phpmailer/Exception.php';
    require 'Libraries/phpmailer/PHPMailer.php';
    require 'Libraries/phpmailer/SMTP.php';

    // Retorna la url del proyecto
    function base_url(){

        return BASE_URL;
    }
    


    // retornar los js y css
    function media(){

        return BASE_URL."/Assets";
    }


    // funcion para retornar el header_admin y footer_admin
    function headerAdmin($data=""){

        $view_header = "Views/Template/header_admin.php";
        require_once ($view_header);
    } 

    function footerAdmin($data = ""){
        $view_footer = "Views/Template/footer_admin.php";
        require_once ($view_footer);
    }


     // funcion para retornar el header_tienda y footer_tienda
     function headerTienda($data=""){

        $view_header = "Views/Template/header_tienda.php";
        require_once ($view_header);
    } 

    function footerTienda($data = ""){
        $view_footer = "Views/Template/footer_tienda.php";
        require_once ($view_footer);
    }

    // Nueva informacion formateada
    function dep($data){

        $format = print_r('<pre>');
        $format .= print_r($data);
        $format .= print_r('</pre>');

        return $format;
    }

    // Retornar modales a nivel global de una solo carpeta, se usa cada vex que se quiera mostrar un modal
    function getModal(string $nameModal, $data){
        // retorna direccion de eso y usa las extension.php para reconocer
        $view_modal = "Views/Template/Modals/{$nameModal}.php";
        require_once $view_modal;
    }

    //Imprimir los productos de carrito en html
    function getFile(string $url, $data){

        ob_start();
        require_once("Views/{$url}.php");
        //levantar el archivo en buffer algo asi
        $file = ob_get_clean();
        return $file;

    }


    //Envio por correos
    function sendEmail($data,$template){

        if(ENVIRONMENT == 1){

            $asunto = $data['asunto'];
            $emailDestino = $data['email'];
            $empresa = NOMBRE_REMITENTE;
            $remitente = EMAIL_REMITENTE;
    
            //Envio de copia a otro correo que nosotros configuremos
            $emailCopia = !empty($data['emailCopia']) ? $data['emailCopia'] : "";
    
            // ENVIO DE CORREO
    
            // encabezado para enviar correctametn y que caiga en span, /(r)retorno (n)salto
            $de = "MIME-Version: 1.0\r\n";
            $de .= "Content-type: text/html; charset=UTF-8\r\n";
            $de .= "From: {$empresa} <{$remitente}>\r\n";
    
            //Para que se envie la copia
            $de .= "Bcc: $emailCopia\r\n";
    
            // cargar menoria una archvio 
            ob_start();
            // el archivo que carga
            require_once("Views/Template/Email/".$template.".php");
            // obtiene archivo para ser uso de datos, que devuel el archivo cargado
            $mensaje =ob_get_clean();
            // mail=funcion de envios de correos con scireto parametros
            
            $send = mail($emailDestino, $asunto, $mensaje, $de);
    
            return $send;
        }else{

                // Documentacion de PHPMAILER

            //Create an instance; passing `true` enables exceptions
            $mail = new PHPMailer(true);

            //*****************HTML envio archivo html de buffer*************** */
            ob_start();
            // el archivo que carga
            require_once("Views/Template/Email/".$template.".php");
            // obtiene archivo para ser uso de datos, que devuel el archivo cargado
            $mensaje =ob_get_clean();

            try {
                //Server settings
                // $mail->SMTPDebug = 1;    
                $mail->SMTPDebug = 0;                    //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'stiveroncal@gmail.com';                     //SMTP username
                $mail->Password   = 'vzzz apje qbeb elgo';                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom('stiveroncal@gmail.com', 'Servidor Roncal');
                $mail->addAddress($data['email']);     //Add a recipient

                // Replicar Envio-----------------------------------------------------------
                // $mail->addAddress('ellen@example.com');               //Name is optional
                // $mail->addReplyTo('info@example.com', 'Information');
                // $mail->addCC('cc@example.com');

                if(!empty($data['emailCopia'])){
                    
                    $mail->addBCC($data['emailCopia']);
                }


                //Attachments
                //Archivo como adjunto comprimio imagens
                // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name


                
                //Content
                //El Mensaje
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject =  $data['asunto'];
                $mail->Body    = $mensaje;

                $mail->send();

                return true;

            } catch (Exception $e) {
                // echo "Error en El Envio de Mensaje: {$mail->ErrorInfo}";
                return false;
            }

        }

       
    }

    //Envio de Correo LocalMente(localhost)

    function sendMailLocal($data,$template){

        // Documentacion de PHPMAILER

        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        //*****************HTML envio archivo html de buffer*************** */
        ob_start();
        // el archivo que carga
        require_once("Views/Template/Email/".$template.".php");
        // obtiene archivo para ser uso de datos, que devuel el archivo cargado
        $mensaje =ob_get_clean();

        try {
            //Server settings
            $mail->SMTPDebug = 1;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'stiveroncal@gmail.com';                     //SMTP username
            $mail->Password   = 'vzzz apje qbeb elgo';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('stiveroncal@gmail.com', 'Servidor Roncal');
            $mail->addAddress($data['email']);     //Add a recipient

            // Replicar Envio-----------------------------------------------------------
            // $mail->addAddress('ellen@example.com');               //Name is optional
            // $mail->addReplyTo('info@example.com', 'Information');
            // $mail->addCC('cc@example.com');

            if(!empty($data['emailCopia'])){
                
                $mail->addBCC($data['emailCopia']);
            }


            //Attachments
            //Archivo como adjunto comprimio imagens
            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name


            
            //Content
            //El Mensaje
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject =  $data['asunto'];
            $mail->Body    = $mensaje;

            $mail->send();

            echo 'Mesaje Enviado';

        } catch (Exception $e) {
            echo "Error en El Envio de Mensaje: {$mail->ErrorInfo}";
        }

    }


    // 
    function getPermisos(int $idmodulo){
        // archivo espeficico
        require_once("Models/PermisosModel.php");
        // instancia de todo la clase a un objeto
        $objPermisos = new PermisosModel();


        if(!empty($_SESSION['userData'])){


            // obtner el id del rol deacurdo con lo que estamos logeado
            $idrol = $_SESSION['userData']['idrol'];

            $arrPermisos = $objPermisos->permisosModulo($idrol);

            // almacenar todos los permisos del rol
            $permisos = '';
            // alamcanar los permisos de cada modulo
            $permisosMod = '';

            // validad si array viene vacio, si trae registos
            if(count($arrPermisos) > 0){

                $permisos = $arrPermisos;
                // condicional short verificando  si existe en la posicion del arreglo lo que envamos como parametro osea el id
                //lo coloca todo el conjunto de elemento, si en caso no existe lo deja vacio
                $permisosMod = isset($arrPermisos[$idmodulo]) ? $arrPermisos[$idmodulo] : "";
            }
            // Creacion de varaibkes de session para alamcenar esos dos arreglos creados
            $_SESSION['permisos'] = $permisos;
            $_SESSION['permisosMod'] = $permisosMod;

        }

       
    }


    // Funcion para obtener datos de clase espeficia
    function sessionUser(int $idpersona){
        
        require_once("Models/LoginModel.php");
        // Porque tiene un metodo sessionLogin para extraer todos sus datos

        // Instanciar objrto
        $objLogin = new LoginModel();
        // usa un meto espeficio para extraer sus daots 
        $request = $objLogin->sessionLogin($idpersona);

        return $request;
    }

    // Funcio para tiempo en session limitar
    function sessionStart(){
        session_start();

        $inactive = 3000000;
        // si existe esa variable de session
        if(isset($_SESSION['timeout'])){

            $session_in = time() - $_SESSION['inicio'];


            // Validacion
            if($session_in > $inactive){

                header("Location: ".BASE_URL."/logout");
            }
        }else{

            header("Location: ".BASE_URL."/logout");

        }
    }

    //Ruta para almacenamiento de img
    function uploadImage(array $data, string $name){

        $url_temp   =  $data['tmp_name'];
        $destino    =  'Assets/images/uploads/'.$name;
        $move       = move_uploaded_file($url_temp,$destino);
        return $move;
    }

    //Eliminar img 
    function deleteFile(string $name){
        
        unlink('Assets/images/uploads/'.$name);

    }

    // Eliminar exceso de espacios entre palabras
    function strClean($strCadena){

        $string = preg_replace(['/\s+/','/^\s|\s$/'],[' ',''], $strCadena);
        $string = trim($string); //Eliminacion de espacio en blanco de inicio y fin
        $string = stripslashes($string);
        $string = str_ireplace("<script>","",$string);
        $string = str_ireplace("</script>","",$string);
        $string = str_ireplace("<script src>","",$string);
        $string = str_ireplace("<script type=>","",$string);
        $string = str_ireplace("SELECT * FROM","",$string);
        $string = str_ireplace("DELETE FROM","",$string);
        $string = str_ireplace("INSERT INTO","",$string);
        $string = str_ireplace("SELECT COUNT(*) FROM","",$string);
        $string = str_ireplace("DROP TABLE","",$string);
        $string = str_ireplace("OR '1'='1","",$string);
        $string = str_ireplace('OR "1"="1"',"",$string);
        $string = str_ireplace('OR ´1´=´1´',"",$string);
        $string = str_ireplace("is NULL; --","",$string);
        $string = str_ireplace("is NULL; --","",$string);
        $string = str_ireplace("LIKE '","",$string);
        $string = str_ireplace('LIKE "',"",$string);
        $string = str_ireplace("LIKE ´","",$string);
        $string = str_ireplace("OR 'a'='a","",$string);
        $string = str_ireplace('OR "a"="a',"",$string);
        $string = str_ireplace("OR ´a´=´a","",$string);
        $string = str_ireplace("OR ´a´=´a","",$string);
        $string = str_ireplace("--","",$string);
        $string = str_ireplace("^","",$string);
        $string = str_ireplace("[","",$string);
        $string = str_ireplace("]","",$string);
        $string = str_ireplace("==","",$string);
        
        return $string;
  
    }

    //Limpieza de caracteres como tildes de las vocales(a,e,i,o,u) y eñes
    function clear_cadena(string $cadena){
        //Reemplazamos la A y a
        $cadena = str_replace(
        array('Á', 'À', 'Â', 'Ä', 'á', 'à', 'ä', 'â', 'ª'),
        array('A', 'A', 'A', 'A', 'a', 'a', 'a', 'a', 'a'),
        $cadena
        );
 
        //Reemplazamos la E y e
        $cadena = str_replace(
        array('É', 'È', 'Ê', 'Ë', 'é', 'è', 'ë', 'ê'),
        array('E', 'E', 'E', 'E', 'e', 'e', 'e', 'e'),
        $cadena );
 
        //Reemplazamos la I y i
        $cadena = str_replace(
        array('Í', 'Ì', 'Ï', 'Î', 'í', 'ì', 'ï', 'î'),
        array('I', 'I', 'I', 'I', 'i', 'i', 'i', 'i'),
        $cadena );
 
        //Reemplazamos la O y o
        $cadena = str_replace(
        array('Ó', 'Ò', 'Ö', 'Ô', 'ó', 'ò', 'ö', 'ô'),
        array('O', 'O', 'O', 'O', 'o', 'o', 'o', 'o'),
        $cadena );
 
        //Reemplazamos la U y u
        $cadena = str_replace(
        array('Ú', 'Ù', 'Û', 'Ü', 'ú', 'ù', 'ü', 'û'),
        array('U', 'U', 'U', 'U', 'u', 'u', 'u', 'u'),
        $cadena );
 
        //Reemplazamos la N, n, C y c
        $cadena = str_replace(
        array('Ñ', 'ñ', 'Ç', 'ç',',','.',';',':'),
        array('N', 'n', 'C', 'c','','','',''),
        $cadena
        );
        
        return $cadena;
    }


    // OJITO EN EL FUTURO
    // GENERA CONTRASEÑA DE 10 CARACTERES
    function passGenerator($length = 10){

        $pass = "";
        $longitudPass = $length;
        $cadena = "ABCDFGHIJKLMNOPQRSTUVWXYZabcdfghijklmnopqrstuvwxyz1234567890";
        $longitudCadena = strlen($cadena);

        for($i=1; $i<= $longitudPass; $i++){
            $pos = rand(0,$longitudCadena-1);
            $pass .= substr($cadena,$pos,1);
        }

        return $pass;
    }

    // Generacion de token
    function token(){

        $r1 = bin2hex(random_bytes(10));
        $r2 = bin2hex(random_bytes(10));
        $r3 = bin2hex(random_bytes(10));
        $r4 = bin2hex(random_bytes(10));
        $token = $r1.'-'.$r2.'-'.$r3.'-'.$r4;
        return $token;
    }

    // Formato para valores monetarios
    function formatMoney($cantidad){

        $cantidad = number_format($cantidad,2,SPD,SPM);
        return $cantidad;
    }

    // Simbolo de moneda
    // const SMONEY = "S/";

    //TOKEN SOLO PARA PAYPAL JWT
    //Obtener token para implementacion de API CON CURL
    function getTokenPaypal(){
        //Configuracion para el Funcionamiento del API PAYPAL y OTROS MAS
        //Aun que es 
        // Iniciar Session Curl con propio PHP

        $payLogin = curl_init(URLPAYPAL."/v1/oauth2/token");

        //CURLOPT_SSL_VERIFYPEER => Verificar el certificado SSL en la conexion
        //CURLOPT_RETURNTRANSFER  => Retorno de informacion
        // Datos de Login
        curl_setopt($payLogin, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($payLogin, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($payLogin, CURLOPT_USERPWD, IDCLIENTE.":".SECRET);
        curl_setopt($payLogin, CURLOPT_POSTFIELDS, "grant_type=client_credentials");

        $result = curl_exec($payLogin);
        
        $err = curl_error($payLogin);
        
        curl_close($payLogin);

        
        if($err){

            $request = "CURL Error #:". $err;
        }else{

            //Estructurar la informacion
            $objData = json_decode($result);
            $request = $objData->access_token;
        }

        return $request;
        

    }


    //Conexion tipo GET API PAYPAL
    //HIBRIDA Y SEAS USADA EN CUALQUIER API
    function CurlConnectionGet(string $ruta, string $contentType=null, string $token){
    
        // Toma de valor
        $content_type = $contentType != null ? $contentType : "application/x-www-form-urlencoded";

        // Validar Tipo de API SEA PAYPAL U OTRO
        if($token != null){

             //Tomar Valores tipo POSTMAN
            $arrHeader = array('Content-Type:'.$content_type,
                               'Authorization: Bearer '.$token);

        }else{
             //Tomar Valores tipo POSTMAN
             $arrHeader = array('Content-Type:'.$content_type);

        }


        // Inicio
        $ch = curl_init();

        // Concepto de curl de php
        // Configuracion de API enviar Token y cosas necesarioa JWT(JSON WEB TOKEN)
        curl_setopt($ch, CURLOPT_URL, $ruta);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $arrHeader);

        $result = curl_exec($ch);
        $err = curl_error($ch);

        curl_close($ch);

        // Validar si suces algun error

        if($err){

            $request = "CURL Error #:". $err;
        }else{

            //Estructurar la informacion
            $request = json_decode($result);
            
        }

        return $request;



    }

    //POST para el reembolos
    function CurlConnectionPost(string $ruta, string $contentType=null, string $token){
    
        // Toma de valor
        $content_type = $contentType != null ? $contentType : "application/x-www-form-urlencoded";

        // Validar Tipo de API SEA PAYPAL U OTRO
        if($token != null){

             //Tomar Valores tipo POSTMAN
            $arrHeader = array('Content-Type:'.$content_type,
                               'Authorization: Bearer '.$token);

        }else{
             //Tomar Valores tipo POSTMAN
             $arrHeader = array('Content-Type:'.$content_type);

        }


        // Inicio
        $ch = curl_init();

        // Concepto de curl de php
        // Configuracion de API enviar Token y cosas necesarioa JWT(JSON WEB TOKEN)
        curl_setopt($ch, CURLOPT_URL, $ruta);

        // agrega para el post
        curl_setopt($ch, CURLOPT_POST, TRUE);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $arrHeader);

        $result = curl_exec($ch);
        $err = curl_error($ch);

        curl_close($ch);

        // Validar si suces algun error

        if($err){

            $request = "CURL Error #:". $err;
        }else{

            //Estructurar la informacion
            $request = json_decode($result);
            
        }

        return $request;



    }


    // Meses del año

    function Meses(){

        $meses = array("Enero",
                        "Febrero",
                        "Marzo",
                        "Abril",
                        "Mayo",
                        "Junio",
                        "Julio",
                        "Agosto",
                        "Setiembre",
                        "Octubre",
                        "Noviembre",
                        "Diciembre",);

        return $meses;
                
    }

    // Mostrar categorias en el footer de tienda virtual

    function getCatFooter(){

        require_once("Models/CategoriasModel.php");

        $objCategoria = new CategoriasModel();

        $request = $objCategoria->getCategoriasFooter();

        return $request;
    }


    //Mostar informacion de PAgina

    function getInfoPage(int $idpagina){

        require_once("Libraries/Core/Mysql.php");

        $con = new Mysql();

        $sql = "SELECT * FROM post WHERE idpost = $idpagina";

        $request = $con->select($sql);

        return $request;

    }

    // Obtener Ruta de Paginas

    function getPageRout(string $ruta){

        require_once("Libraries/Core/Mysql.php");

        $con = new Mysql();
        
        $sql = "SELECT * FROM post WHERE ruta = '$ruta' AND status != 0 ";

        $request = $con->select($sql);

        
        if(!empty($request)){

            $request['portada'] = $request['portada'] != "" ? media()."/images/uploads/".$request['portada'] : "";

        }

        return $request;
    }

    // Ver Pagina Con Cierto PArametros para VEr

    function viewPage(int $idpagina){

        require_once("Libraries/Core/Mysql.php");

        $con = new Mysql();
        
        $sql = "SELECT * FROM post WHERE idpost = $idpagina";

        $request = $con->select($sql);

        if( ($request['status'] == 2 AND isset($_SESSION['permisosMod']) AND $_SESSION['permisosMod']['u'] == true) OR $request['status'] == 1 ){

            return true;
    
        }else{
            
            return false;

        }

    }

?>