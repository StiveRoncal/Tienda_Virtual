
//#1 funcion de login para mover tipo flp de login a resetear login
$('.login-content [data-toggle="flip"]').click(function() {
    $('.login-box').toggleClass('flipped');
    return false;
});



// Funcion para animacion de carga cuando ingresa el usuario
var divLoading = document.querySelector("#divLoading");

// documento de recarga a todos las funciones

document.addEventListener('DOMContentLoaded', function(){


    //#1 Valicion de Login
    // condicional
    //si existe ese elemento en el documento
    if(document.querySelector("#formLogin")){

        let formLogin = document.querySelector("#formLogin");

        formLogin.onsubmit = function(e){

            e.preventDefault();
            // relaciona a los dos unicos campos
            let strEmail = document.querySelector('#txtEmail').value;
            let strPassword = document.querySelector('#txtPassword').value;

            if(strEmail == "" || strPassword == ""){

                swal("Por favor","Escribe Usuario y Contraseña","error");
                return false;

            }else{


                // antes de ingresar al dashboard en moento de logeo
                divLoading.style.display="flex";

                // Enviar los datos al controlador
                var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                var ajaxUrl = base_url+'/Login/loginUser';
                var formData = new FormData(formLogin);

                // ajax

                request.open("POST",ajaxUrl,true);
                request.send(formData);

                request.onreadystatechange = function(){
                    
                if(request.readyState != 4) return;
        
                if(request.status == 200){

                    // Si el envio es exito convertir el json en objeto
                    var objData = JSON.parse(request.responseText);

                    // si es verdadero hizo login de forma correcta
                    if(objData.status){
                        // redirecionar
                        // window.location = base_url+'/dashboard';
                        window.location.reload(false);

                    }else{

                        swal("Atencion", objData.msg, "error");

                        document.querySelector('#txtPassword').value="";
                    }
                }else{
                    swal("Atencion", "Error en el Proceso", "error");
                }

                // OCULTAR LOADING DUESPUES DE RESPUESTA
                divLoading.style.display="none";

                return false;
            }

            }
        }
    }


    //#2 Validacion de resetar Usuario para recuprar cuenta

    if(document.querySelector("#formRecetPass")){

        let formRecetPass = document.querySelector("#formRecetPass");

        formRecetPass.onsubmit = function(e){
            e.preventDefault();

            let strEmail = document.querySelector('#txtEmailReset').value;

            if(strEmail == ""){

                swal("Porfavor", "Escriba Tu Correo Electrónico", "error");
                return false;
            }else{
                divLoading.style.display="flex";

                var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');

                var ajaxUrl = base_url+'/Login/resetPass';

                var formData = new FormData(formRecetPass);

                request.open("POST",ajaxUrl,true);
                request.send(formData);
                
                request.onreadystatechange = function(){

                    // console.log(request);

                    // Validcaion de envio
                    if(request.readyState != 4) return;
                    
                    // si fue exito la peticion
                    if(request.status == 200){

                        // Converti json a objeto
                        var objData = JSON.parse(request.responseText);

                        if(objData.status){

                            swal({
                                title: "",
                                text: objData.msg,
                                type: "success",
                                confirmButtonText: "Aceptar",
                                closeOnConfirm: false,
                            }, function(isConfirm){

                                if(isConfirm){

                                    window.location = base_url;
                                }
                            });

                        }else{
                            swal("Atención", objData.msg, "error");
                        }
                    }else{
                        swal("Atención","Error en el Proceso","error");
                    }
                    divLoading.style.display="none";

                    return false;

                }
            }
        }
    }

    // Envio de datos atraves de ajax

    if(document.querySelector("#formCambiarPass")){

        let formCambiarPass = document.querySelector("#formCambiarPass");

        formCambiarPass.onsubmit = function(e){

            e.preventDefault();

            let strPassword = document.querySelector('#txtPassword').value;
            let strPasswordConfirm = document.querySelector('#txtPasswordConfirm').value;
            let idUsuario = document.querySelector('#idUsuario').value;

            if(strPassword == "" || strPasswordConfirm == ""){

                swal("Porfavor","Escriba la nueva Contraseña","error");
                return false;
            }else{
                if(strPassword.length < 5){

                    swal("Atencion","La contraseña debe tener un minimo de 5 caracteres","info");
                    return false;
                }

                if(strPassword != strPasswordConfirm){
                    swal("Atencion","La contraseña no son iguales","error");
                    return false;
                }
                divLoading.style.display="flex";
                var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');

                var ajaxUrl = base_url+'/Login/setPassword';
                var formData = new FormData(formCambiarPass);
                request.open("POST",ajaxUrl,true);
                request.send(formData);

                request.onreadystatechange = function(){

                    if(request.readyState != 4) return;

                    if(request.status == 200){
                        
                        var objData = JSON.parse(request.responseText);

                        if(objData.status){

                            swal({
                                title: "",
                                text: objData.msg,
                                type: "success",
                                confirmButtonText: "Iniciar sessión",
                                closeOnConfirm: false,
                            }, function(isConfirm){
                                if(isConfirm){
                                    window.location = base_url+'/login';
                                }
                               
                            });
                        }else{
                            swal("Atencion",objData.msg,);
                        }
                    }else{
                        swal("Atencion","Error en el Proceso","error");
                    }

                    divLoading.style.display="none";
                }
            }
        }
    }
}, false);