let tableCategorias;

let rowTables = "";

let divLoading = document.querySelector("#divLoading");

document.addEventListener('DOMContentLoaded', function () {

    //Carga de DataTables 
    tableCategorias = $('#tableCategorias').dataTable({

        "aProcessing":true,
        "aServerSide": true,
        "language":{
            "url":"//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        
        "ajax":{
            "url": " "+base_url+"/Categorias/getCategorias",
            
            "dataSrc": ""
        },

        "columns":[
            // nombres del formato json
            {"data":"idcategoria"},
            {"data":"nombre"},
            {"data":"descripcion"},
            {"data":"status"}, 
            // otro para acciones para sus columnas
            {"data":"options"}
            
        ],
        // Botones de exportaciones
        'dom': 'lBfrtip',
        'buttons': [
            {
                "extend":"copyHtml5",
                "text":"<i class='far fa-copy'></i> Copiar",
                "titleAttr":"Copiar",
                "className": "btn btn-secondary"

            },
            {
                "extend":"excelHtml5",
                "text":"<i class='fas fa-file-excel'></i> Excel",
                "titleAttr":"Exportar Excel",
                "className": "btn btn-success"
            },{
                "extend":"pdfHtml5",
                "text":"<i class='fas fa-file-pdf'></i> PDF",
                "titleAttr":"Exportar PDF",
                "className": "btn btn-danger"
            },{
                "extend":"csvHtml5",
                "text":"<i class='fas fa-file-csv'></i> CSV",
                "titleAttr":"Exportar CVS",
                "className": "btn btn-info"

            }
        ],
        // Paginacion
        "resonsieve":"true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order":[[0,"desc"]]
    });


    //Carga De IMG de Portada
    if(document.querySelector("#foto")){

        let foto = document.querySelector("#foto");

        foto.onchange = function(e) {

            let uploadFoto = document.querySelector("#foto").value;
            let fileimg = document.querySelector("#foto").files;
            let nav = window.URL || window.webkitURL;
            let contactAlert = document.querySelector('#form_alert');

            if(uploadFoto !=''){

                let type = fileimg[0].type;
                let name = fileimg[0].name;

                if(type != 'image/jpeg' && type != 'image/jpg' && type != 'image/png'){

                    contactAlert.innerHTML = '<p class="errorArchivo">El archivo no es válido.</p>';

                    if(document.querySelector('#img')){

                        document.querySelector('#img').remove();

                    }

                    document.querySelector('.delPhoto').classList.add("notBlock");

                    foto.value="";

                    return false;

                }else{  

                        contactAlert.innerHTML='';

                        if(document.querySelector('#img')){

                            document.querySelector('#img').remove();

                        }

                        document.querySelector('.delPhoto').classList.remove("notBlock");

                        let objeto_url = nav.createObjectURL(this.files[0]);

                        document.querySelector('.prevPhoto div').innerHTML = "<img id='img' src="+objeto_url+">";
                    }
            }else{

                alert("No selecciono foto");

                if(document.querySelector('#img')){

                    document.querySelector('#img').remove();

                }
            }
        }
    }

    // Valida exisitencia de la foto
    if(document.querySelector(".delPhoto")){

        let delPhoto = document.querySelector(".delPhoto");

        delPhoto.onclick = function(e) {

            document.querySelector("#foto_remove").value = 1;

            removePhoto();
            
        }
    }


    //NUEVA CATEGORIA
    let formCategoria = document.querySelector("#formCategoria");
    formCategoria.onsubmit = function(e){
   
        e.preventDefault();


        
        let strNombre = document.querySelector('#txtNombre').value;
        let strDescripcion = document.querySelector('#txtDescripcion').value;
        let intStatus = document.querySelector('#listStatus').value;

        if(strNombre == '' || strDescripcion == '' || intStatus == ''){

            swal("Atención", "Todos los campos son Obligatorios.", "error");
            return false;
        }
 
  
        divLoading.style.display = "flex";


        let request =(window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
     
        let ajaxUrl = base_url+'/Categorias/setCategoria';
   
        let formData = new FormData(formCategoria);
        request.open("POST",ajaxUrl,true);
        request.send(formData);
        
        request.onreadystatechange = function(){

          
            if(request.readyState == 4 && request.status == 200){

                // console.log(request.responseText);
                
                let objData = JSON.parse(request.responseText);

                if(objData.status){
                    
                    //Valida el Ajax para poner misma fila
                    if(rowTables == ""){

                        tableCategorias.api().ajax.reload();

                    }else{

                        htmlStatus = intStatus == 1 ? 
                        '<span class="badge badge-success">Activo</span>' : 
                        '<span class="badge badge-danger">Inactivo</span>';
                        
                        rowTables.cells[1].textContent = strNombre;

                        rowTables.cells[2].textContent = strDescripcion;

                        rowTables.cells[3].innerHTML = htmlStatus;

                        rowTables = "";


                    }

                    $('#modalFormCategorias').modal("hide");

                    formCategoria.reset();

                    swal("Categoria", objData.msg ,"success");

                    removePhoto();
                 

                }else{

                    swal("Error", objData.msg, "error");

                }
            }
           
           divLoading.style.display = "none";
           return false;
           
        }
        
    }

}, false);



// Ver Registro 
function fntViewInfo(idcategoria){



    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');

    let ajaxUrl = base_url+'/Categorias/getCategoria/'+idcategoria;

    request.open("GET",ajaxUrl,true);
    request.send();

    request.onreadystatechange = function(){

        if(request.readyState == 4 && request.status == 200){

            let objData = JSON.parse(request.responseText);

            if(objData.status){

                //Valor de Cada Celda

                let estado = objData.data.status == 1 ? '<span class="badge badge-success">Activo</span>' : 
                                                        '<span class="badge badge-danger">Inactivo</span>';
                
                document.querySelector("#celId").innerHTML = objData.data.idcategoria;

                document.querySelector("#celNombre").innerHTML = objData.data.nombre;

                document.querySelector("#celDescripcion").innerHTML = objData.data.descripcion;

                document.querySelector("#celEstado").innerHTML = estado;

                document.querySelector("#imgCategoria").innerHTML = '<img src="'+objData.data.url_portada+'"></img>';
                

                $('#modalViewCategoria').modal('show');

            }else{

                swal("Error", objData.msg, "error");

            }
        }
    }

  

}



// Editar Registro 
function fntEditInfo(element, idcategoria){
    
    rowTables = element.parentNode.parentNode.parentNode;
    //Cambios de Etiquetas
    document.querySelector('#titleModal').innerHTML = "Actualizar Categoría";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML = "Actualizar";

  

    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');

    let ajaxUrl = base_url+'/Categorias/getCategoria/'+idcategoria;

    request.open("GET",ajaxUrl,true);
    request.send();

    request.onreadystatechange = function(){

        if(request.readyState == 4 && request.status == 200){

            let objData = JSON.parse(request.responseText);

            if(objData.status){

                document.querySelector("#idCategoria").value = objData.data.idcategoria;
                document.querySelector("#txtNombre").value = objData.data.nombre;
                document.querySelector("#txtDescripcion").value = objData.data.descripcion;
                document.querySelector("#foto_actual").value = objData.data.portada;
                document.querySelector("#foto_remove").value = 0;

                // Validar Estado
                if(objData.data.status == 1){

                    document.querySelector("#listStatus").value = 1;

                }else{

                    document.querySelector("#listStatus").value = 2;

                }

                $('#listStatus').selectpicker('render');

                //Mostrar Portada Validad
                if(document.querySelector('#img')){
                    //ruta img exites
                    document.querySelector('#img').src = objData.data.url_portada;  

                }else{
                    //ruta img por defecto
                    document.querySelector('.prevPhoto div').innerHTML = "<img id='img' src="+objData.data.url_portada+">";

                }

                // Valida La (X) Si se muesta o no
                if(objData.data.portada == 'portada_categoria.png'){

                    document.querySelector('.delPhoto').classList.add("notBlock");

                }else{

                    document.querySelector('.delPhoto').classList.remove("notBlock");

                }


                $('#modalFormCategorias').modal('show');

            }else{

                swal("Error", objData.msg, "error");

            }
        }
    }

  

}


// Eliminar Registros
function fntDelInfo(idcategoria){

    // Nos scrip para preguntar si quiere eliminar
    swal({
        title: "Eliminar Categoria",
        text: "¿Realmente quieres Eliminar La Categoria?",
        icon: "warning",
        buttons: ["No, Cancelar","Si,Eliminar"],
        dangerMode: true,
      })
      .then((willDelete) => {
        if(willDelete){

            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/Categorias/delCategoria';
            let strData = "idCategoria="+idcategoria;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);

            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);

                    if(objData.status){

                        swal("Eliminar!", objData.msg, "success");

                        tableCategorias.api().ajax.reload();
                    }else{
                        swal("Atención!", objData.msg, "error");
                    }
                }
            }
        }
      });
  

}

//Funcion Para Remover La Foto

function removePhoto(){

    document.querySelector('#foto').value ="";
    document.querySelector('.delPhoto').classList.add("notBlock");
    //validar la eliminacion de img si tiene o no
    if(document.querySelector('#img')){

        document.querySelector('#img').remove(); 

    }
}




function openModal(){
    
    rowTables = "";
    
    document.querySelector('#idCategoria').value="";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Categoria";
    // Limpiar Campos
    document.querySelector("#formCategoria").reset();

    $('#modalFormCategorias').modal('show');
    removePhoto();

}