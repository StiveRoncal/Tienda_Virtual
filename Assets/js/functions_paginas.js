let tablePaginas;

let rowTable;
//Inicio de DATATABLE 
tablePaginas = $('#tablePaginas').dataTable({

    "aProcessing":true,
    "aServerSide": true,
    "language":{
        "url":"//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
    },
    
    "ajax":{
        "url": " "+base_url+"/paginas/getPaginas",
        
        "dataSrc": ""
    },

    "columns":[

        {"data":"idpost"},
        {"data":"titulo"},
        {"data":"fecha"},
        {"data":"options"}
        
    ],

    "columnDefs": [

        {"className":"textcenter","targets": [2] }, 
        {"className":"textright","targets": [3] }
        ,
        
        

    ],
    // Botones de exportaciones
    'dom': 'lBfrtip',
    'buttons': [
        {
            "extend":"copyHtml5",
            "text":"<i class='far fa-copy'></i> Copiar",
            "titleAttr":"Copiar",
            "className": "btn btn-secondary",
            "exportOptions":{
                "columns" : [0,1,2,3]
            }

        },
        {
            "extend":"excelHtml5",
            "text":"<i class='fas fa-file-excel'></i> Excel",
            "titleAttr":"Exportar Excel",
            "className": "btn btn-success",
            "exportOptions":{
                "columns" : [0,1,2,3]
            }
        },{
            "extend":"pdfHtml5",
            "text":"<i class='fas fa-file-pdf'></i> PDF",
            "titleAttr":"Exportar PDF",
            "className": "btn btn-danger",
            "exportOptions":{
                "columns" : [0,1,2,3]
            }
        },{
            "extend":"csvHtml5",
            "text":"<i class='fas fa-file-csv'></i> CSV",
            "titleAttr":"Exportar CVS",
            "className": "btn btn-info",
            "exportOptions":{
                "columns" : [0,1,2,3]
            }

        }
    ],
    // Paginacion
    "resonsieve":"true",
    "bDestroy": true,
    "iDisplayLength": 10,
    "order":[[0,"desc"]]
});


//TinyMCE
tinymce.init({

    selector: '#txtContenido',
    with: "100%",
    height: 400,
    statubar: true,
    plugins:[

        "advlist autolink link image lists charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
        "save table contextmenu directionality emoticons template paste textcolor"

    ],

    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",

});


//Actualizar Pagina
// Validar si existe
if(document.querySelector("#formPaginas")){
         
    let formPaginas = document.querySelector("#formPaginas");

    formPaginas.onsubmit = function(e){

        e.preventDefault();

       



        //almacenar datos
        
        let strTitulo = document.querySelector('#txtTitulo').value;

        let strContenido = document.querySelector('#txtContenido').value;

        let intStatus = document.querySelector('#listStatus').value;

        if(strTitulo == '' || strContenido == '' || intStatus == ''){

            swal("Atención","Todos Los Campos Son Obligatorios. :(:(:(", "error");

            return false;

        }

        divLoading.style.display = "flex";
        tinymce.triggerSave();

        //AJAX para Guardar Producto

        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : ActiveXObject('Microsoft.XMLHTTP');

        let ajaxUrl = base_url+'/Paginas/setPagina';

        let formData = new FormData(formPaginas);

        request.open("POST",ajaxUrl,true);

        request.send(formData);

        request.onreadystatechange = function(){

            if(request.readyState == 4 && request.status == 200){   

                console.log(request.responseText);

               let objData = JSON.parse(request.responseText);

               if(objData.status){

                swal({icon:"success",
                    title: "", 
                    text: objData.msg, 
                    type: "success"
                
                }).then(function(){ 

                   location.reload();

                   }

                );

                    

               }else{

                    swal("Error",objData.msg,"error");

               }

            }

            divLoading.style.display = "none";

            return false;

        }

    }
}



//Propiedades de Fotos

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

            if(document.querySelector("#foto_remove")){
                document.querySelector("#foto_remove").value = 1;
            }

            removePhoto();
            
        }
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

//Eliminar un Pagina
function fntDelInfo(idpagina){

    // Nos scrip para preguntar si quiere eliminar
    swal({
        title: "Eliminar Pagina",
        text: "¿Realmente quieres Eliminar Esta Pagina?",
        icon: "warning",
        buttons: ["No, Cancelar","Si,Eliminar"],
        dangerMode: true,
      })
      .then((willDelete) => {
        if(willDelete){

            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/Paginas/delPagina';
            let strData = "idPagina="+idpagina;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);

            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);

                    if(objData.status){

                        swal("Eliminar!", objData.msg, "success");

                        tablePaginas.api().ajax.reload();

                    }else{
                        swal("Atención!", objData.msg, "error");
                    }
                }
            }
        }
      });
  

}
