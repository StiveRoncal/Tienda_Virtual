/*Scrip no son mios */
$(".js-select2").each(function(){
    $(this).select2({
        minimumResultsForSearch: 20,
        dropdownParent: $(this).next('.dropDownSelect2')
    });
})

$('.parallax100').parallax100();


$('.gallery-lb').each(function() { // the containers for all your galleries
    $(this).magnificPopup({
        delegate: 'a', // the selector for gallery item
        type: 'image',
        gallery: {
            enabled:true
        },
        mainClass: 'mfp-fade'
    });
});


$('.js-addwish-b2').on('click', function(e){
    e.preventDefault();
});

$('.js-addwish-b2').each(function(){
    var nameProduct = $(this).parent().parent().find('.js-name-b2').html();
    $(this).on('click', function(){
        swal(nameProduct, "¡Se Agrego Al Carrito!", "success");

        // $(this).addClass('js-addedwish-b2');
        // $(this).off('click');
    });
});

$('.js-addwish-detail').each(function(){
    var nameProduct = $(this).parent().parent().parent().find('.js-name-detail').html();

    $(this).on('click', function(){
        swal(nameProduct, "is added to wishlist !", "success");

        $(this).addClass('js-addedwish-detail');
        $(this).off('click');
    });
});

/*---------------------------------------------*/

//Esta Funcion del Cotiza que es para agregar al Carrito no es mio sino vino echo solo lo modifco para manipular 

//#1 Agregar al Carrito
$('.js-addcart-detail').each(function(){
    var nameProduct = $(this).parent().parent().parent().parent().find('.js-name-detail').html();

    let cant = 1;

    $(this).on('click', function(){

        // El Id encriptar del producto pero del carrito
        let id = this.getAttribute('id');

        if(document.querySelector('#cant-product')){

              //input capturando su valor de cantidad
            cant = document.querySelector('#cant-product').value;
        }

        if(this.getAttribute('pr')){
            cant = this.getAttribute('pr')
        }
      
      

        if(isNaN(cant) || cant < 1){

            swal("","La cantidad debe ser mayor o igual a 1","error");

            return;

        }

        //Inici de ajax como siempre

        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');

        let ajaxUrl = base_url+'/Tienda/addCarrito';

        let formData = new FormData();

        formData.append('id',id);
        formData.append('cant',cant);

        request.open("POST",ajaxUrl,true);
        request.send(formData);

        request.onreadystatechange = function(){

            if(request.readyState != 4) return;

            if(request.status == 200){
                let objData = JSON.parse(request.responseText);

                if(objData.status){

                    document.querySelector("#productosCarrito").innerHTML = objData.htmlCarrito;

                    // Aplicar cilco
                    const cants = document.querySelectorAll(".cantCarrito");
                    cants.forEach(element => {

                        element.setAttribute("data-notify",objData.cantCarrito);

                    });

                    // document.querySelectorAll(".cantCarrito")[0].setAttribute("data-notify",objData.cantCarrito);
                    // document.querySelectorAll(".cantCarrito")[1].setAttribute("data-notify",objData.cantCarrito);

                    swal(nameProduct, "¡Se agrego al Carrito !", "success");

                }else{
                    swal("",objData.msg,"error");
                }
                
            }

            return false;

        }

    

    });
});

$('.js-pscroll').each(function(){
    $(this).css('position','relative');
    $(this).css('overflow','hidden');
    var ps = new PerfectScrollbar(this, {
        wheelSpeed: 1,
        scrollingThreshold: 1000,
        wheelPropagation: false,
    });

    $(window).on('resize', function(){
        ps.update();
    })
});

//Recuerda Stive Esto Es Para Subir o Bajar Cantidad de Productos (+)(-)
//Esto Viene Como El Coza store no es mi script*/

//Disminuir la cantidad
$('.btn-num-product-down').on('click', function(){

    let numProduct = Number($(this).next().val());
    let idpr = this.getAttribute('idpr');
    //da valor a su siguente elemento
    if(numProduct > 1) $(this).next().val(numProduct - 1);

    let cant = $(this).next().val();

    if(idpr != null){

        fntUpdateCant(idpr,cant);

    }
    

});

//Aumentar la Cantidad

$('.btn-num-product-up').on('click', function(){

    let numProduct = Number($(this).prev().val());
    let idpr = this.getAttribute('idpr');

    $(this).prev().val(numProduct + 1);

    let cant = $(this).prev().val();

    if(idpr != null){

        fntUpdateCant(idpr,cant);
        
    }
});

//Actualiza cantidad de producto cuando Poner la cantidad en el input
if(document.querySelector(".num-product")){
    // asignado todos los elemento si hacer alguna interaccion
    let inputCant = document.querySelectorAll(".num-product");

    inputCant.forEach(function(inputCant){

        inputCant.addEventListener('keyup', function(){
            
            let idpr = this.getAttribute('idpr')

            let cant = this.value;
            // Ejecutar funcion
            if(idpr != null){

                fntUpdateCant(idpr,cant);
                
            }
        });

    });

}


//Crear usuario Cliente
if(document.querySelector("#formRegister")){
    let formRegister = document.querySelector("#formRegister");
    formRegister.onsubmit = function(e) {
        e.preventDefault();
        let strNombre = document.querySelector('#txtNombre').value;
        let strApellido = document.querySelector('#txtApellido').value;
        let strEmail = document.querySelector('#txtEmailCliente').value;
        let intTelefono = document.querySelector('#txtTelefono').value;

        if(strApellido == '' || strNombre == '' || strEmail == '' || intTelefono == '' )
        {
            swal("Atención", "Todos los campos son obligatorios." , "error");
            return false;
        }

        let elementsValid = document.getElementsByClassName("valid");
        for (let i = 0; i < elementsValid.length; i++) { 
            if(elementsValid[i].classList.contains('is-invalid')) { 
                swal("Atención", "Por favor verifique los campos en rojo." , "error");
                return false;
            } 
        } 
        divLoading.style.display = "flex";
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        let ajaxUrl = base_url+'/Tienda/registro'; 
        let formData = new FormData(formRegister);
        request.open("POST",ajaxUrl,true);
        request.send(formData);
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                let objData = JSON.parse(request.responseText);
                if(objData.status)
                {
                    window.location.reload(false);
                }else{
                    swal("Error", objData.msg , "error");
                }
            }
            divLoading.style.display = "none";
            return false;
        }
    }
}


//MEtodo de pago

if(document.querySelector(".methodpago")){

    let optmetodo = document.querySelectorAll(".methodpago");

    optmetodo.forEach(function(optmetodo){

        optmetodo.addEventListener('click', function(){

            if(this.value == "Paypal"){

                document.querySelector("#divpaypal").classList.remove("notBlock");
                document.querySelector("#divtipopago").classList.add("notBlock");
                
            }else{

                document.querySelector("#divpaypal").classList.add("notBlock");
                document.querySelector("#divtipopago").classList.remove("notBlock");

            }

        });

    });

}


//Eliminar productos del carrito de Compras

function fntdelItem(element){
 
    //Opciones para Eliminar Recuerda Esto

    //Option 1 = Modal
    //Option 2 = vista Carrito


    let option = element.getAttribute("op");
    let idpr = element.getAttribute("idpr");

    if(option == 1 || option == 2){

        //Inicio de ajax

        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');

        let ajaxUrl = base_url+'/Tienda/delCarrito';

        let formData = new FormData();

        formData.append('id',idpr);
        formData.append('option',option);

        request.open("POST",ajaxUrl,true);
        request.send(formData);

        request.onreadystatechange = function(){

            if(request.readyState != 4) return;

            if(request.status == 200){
                let objData = JSON.parse(request.responseText);
              
                if(objData.status){

                    if(option == 1){

                        document.querySelector("#productosCarrito").innerHTML = objData.htmlCarrito;
                        
                        const cants = document.querySelectorAll(".cantCarrito");
                        
                        cants.forEach(element => {

                            element.setAttribute("data-notify",objData.cantCarrito);

                        });

                    }else{

                        //dirigir a elemento padre y eliminar
                        element.parentNode.parentNode.remove();

                        document.querySelector("#subTotalCompra").innerHTML = objData.subTotal;
                        document.querySelector("#totalCompra").innerHTML = objData.total;

                        // Si no tenenmos productos  == 1 no hay producto 
                        if(document.querySelectorAll("#tblCarrito tr").length == 1){

                            window.location.href = base_url;

                        }


                    }
                    
              

                }else{

                    swal("",objData.msg,"error");

                }
                
            }

            return false;

        }

    }




}

//Actualizar la cantidad de Productos en Carrito

function fntUpdateCant(pro,cant){

    if(cant <= 0){

        // Agarar id de proceso de pago
        document.querySelector("#btnComprar").classList.add("notBlock");

    }else{

        document.querySelector("#btnComprar").classList.remove("notBlock");

        //AJAX
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        let ajaxUrl = base_url+'/Tienda/updCarrito';

        let formData = new FormData();

        formData.append('id',pro);
        formData.append('cantidad',cant)

        request.open("POST",ajaxUrl,true);
        request.send(formData);

        request.onreadystatechange = function(){

            if(request.readyState != 4) return;

            if(request.status == 200){

                let objData = JSON.parse(request.responseText);

                if(objData.status){

                    let colSubtotal = document.getElementsByClassName(pro)[0];

                    colSubtotal.cells[4].textContent = objData.totalProducto;

                    document.querySelector("#subTotalCompra").innerHTML = objData.subTotal;
                    document.querySelector("#totalCompra").innerHTML = objData.total;
                    
                }else{

                    swal("",objData,"error");

                }
            }

        }

       
    }

    return false

}

//Direccion de Pedido
if(document.querySelector("#txtDireccion")){

    let direccion = document.querySelector("#txtDireccion");

    direccion.addEventListener('keyup',function(){

        let dir = this.value;

        fntViewPago();

    });

}

//Para Terminos y condiciones

if(document.querySelector("#condiciones")){
    
    let opt = document.querySelector("#condiciones");

    opt.addEventListener('click', function(){

        let opcion = this.checked;
        
        if(opcion){

            document.querySelector('#optMetodoPago').classList.remove("notBlock");

        }else{

            document.querySelector('#optMetodoPago').classList.add("notBlock");
        }
    
    });

}

//Ciudad de pedido

if(document.querySelector("#txtCiudad")){
    
    let ciudad = document.querySelector("#txtCiudad");

    ciudad.addEventListener('keyup', function(){

        let c = this.value;
        
        fntViewPago();
    });

}

//Para que veo el boton de pagar en 
function fntViewPago(){

    let direccion = document.querySelector("#txtDireccion").value;

    let ciudad = document.querySelector("#txtCiudad").value;


    if(direccion == "" || ciudad == ""){

        document.querySelector('#divMetodoPago').classList.add("notBlock");

    }else{
        document.querySelector('#divMetodoPago').classList.remove("notBlock")
    }

}



if(document.querySelector("#btnComprar")){

    let btnPago = document.querySelector("#btnComprar");

    btnPago.addEventListener('click',function(){

        let dir = document.querySelector("#txtDireccion").value;

        let ciudad = document.querySelector("#txtCiudad").value;

        let inttipopago  = document.querySelector("#listtipopago").value;

        if(txtDireccion == "" || txtCiudad == "" || inttipopago == ""){

            swal("","Complete Datos de Envio","error");

            return;

        }else{

                divLoading.style.display = "flex";
                
                let request = (window.XMLHttpRequest) ? new XMLHttpRequest(): new ActiveXObject('Microsoft.XMLHTTP');

                let ajaxUrl = base_url+'/Tienda/procesarVenta';

                let formData = new FormData();

                formData.append('direccion',dir);
                formData.append('ciudad',ciudad);
                formData.append('inttipopago',inttipopago);
               

                request.open("POST",ajaxUrl,true);

                request.send(formData);

                request.onreadystatechange = function(){

                    if(request.readyState !=4 ) return;

                    if(request.status == 200){

                        let objData = JSON.parse(request.responseText);

                        if(objData.status){
                            
                            window.location = base_url+"/tienda/confirmarpedido/";

                        }else{

                            swal("",objData.msg,"error");

                        }

                    }

                    divLoading.style.display = "none";

                    return false;
                }
        }


    },false);

}


//Para suscriptores

if(document.querySelector("#frmSuscripcion")){

    let frmSuscripcion = document.querySelector("#frmSuscripcion");

    frmSuscripcion.addEventListener('submit',function(e){
        e.preventDefault();

        let nombre = document.querySelector("#nombreSuscripcion").value;

        let email = document.querySelector("#emailSuscripcion").value;

        if(nombre == ""){

            swal("","El nombre es Obligatorio","error");

            return false;

        }

        if(!fntEmailValidate(email)){

            swal("","El email no es Valido","error");

            return false;

        }

                divLoading.style.display = "flex";
                
                let request = (window.XMLHttpRequest) ? new XMLHttpRequest(): new ActiveXObject('Microsoft.XMLHTTP');

                let ajaxUrl = base_url+'/Tienda/suscripcion';

                let formData = new FormData(frmSuscripcion);
               

                request.open("POST",ajaxUrl,true);

                request.send(formData);

                request.onreadystatechange = function(){

                    if(request.readyState !=4 ) return;

                    if(request.status == 200){

                        let objData = JSON.parse(request.responseText);

                        if(objData.status){
                            
                            swal("", objData.msg,"success");

                            document.querySelector("#frmSuscripcion").reset();

                        }else{

                            swal("",objData.msg,"error");

                        }

                    }

                    divLoading.style.display = "none";

                    return false;
                
        

                }
    },false);

}


//Para Los Contactos


if(document.querySelector("#frmContacto")){

    let frmContacto = document.querySelector("#frmContacto");

    frmContacto.addEventListener('submit',function(e){
        e.preventDefault();

        let nombre = document.querySelector("#nombreContacto").value;

        let email = document.querySelector("#emailContacto").value;
        let mensaje = document.querySelector("#mensaje").value;

        if(nombre == ""){

            swal("","El nombre es Obligatorio","error");

            return false;

        }

        if(!fntEmailValidate(email)){

            swal("","El email no es Valido","error");

            return false;

        }

        if(mensaje == ""){

            swal("","Por Favor Escriba el Mensaje","error");

            return false;

        }

                divLoading.style.display = "flex";
                
                let request = (window.XMLHttpRequest) ? new XMLHttpRequest(): new ActiveXObject('Microsoft.XMLHTTP');

                let ajaxUrl = base_url+'/Tienda/contacto';

                let formData = new FormData(frmContacto);
               

                request.open("POST",ajaxUrl,true);

                request.send(formData);

                request.onreadystatechange = function(){

                    if(request.readyState !=4 ) return;

                    if(request.status == 200){

                        let objData = JSON.parse(request.responseText);

                        if(objData.status){
                            
                            swal("", objData.msg,"success");

                            document.querySelector("#frmContacto").reset();

                        }else{

                            swal("",objData.msg,"error");

                        }

                    }

                    divLoading.style.display = "none";

                    return false;
                
        

                }
    },false);

}