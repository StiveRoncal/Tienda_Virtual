let tableContactos;

// DataTables
tableContactos = $('#tableContactos').dataTable({

    "aProcessing":true,
    "aServerSide": true,
    "language":{
        "url":"//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
    },
    
    "ajax":{
        "url": " "+base_url+"/contactos/getContactos",
        
        "dataSrc": ""
    },

    "columns":[
        {"data":"id"},
        {"data":"nombre"},
        {"data":"email"},
        {"data":"mensaje"},
        {"data":"ip"},
        {"data":"dispositivo"},
        {"data":"agente_usuario"},
        {"data":"fecha"},
        {"data":"options"}
        
    ],

    "columnDefs": [

        {
            "className":"textcenter","targets": [5], 
        },
        {
            "className":"textcenter","targets": [4], 
        },
      
       

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

    "resonsieve":"true",
    "bDestroy": true,
    "iDisplayLength": 10,
    "order":[[0,"desc"]]
});

//Boton Ojo Detalle de Producto
function fntViewInfo(idmensaje){

    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');

    let ajaxUrl = base_url+'/Contactos/getMensaje/'+idmensaje;

    request.open("GET",ajaxUrl,true);

    request.send();


    request.onreadystatechange = function(){

        if(request.readyState == 4 && request.status == 200){

         
            let objData = JSON.parse(request.responseText);
            

            if(objData.status){

                let objMensaje = objData.data;

                document.querySelector("#celID").innerHTML = objMensaje.id;
                document.querySelector("#celNombre").innerHTML = objMensaje.nombre;
                document.querySelector("#celEmail").innerHTML = objMensaje.email;
                document.querySelector("#celMensaje").innerHTML = objMensaje.mensaje;
                document.querySelector("#celIp").innerHTML = objMensaje.ip;
                document.querySelector("#celDispositivo").innerHTML = objMensaje.dispositivo;
                document.querySelector("#celAgenteUsuario").innerHTML = objMensaje.agente_usuario;
                document.querySelector("#celFecha").innerHTML = objMensaje.fecha;
               
                $('#modalViewMensaje').modal('show');

            }else{
                
                swal("Error", objData.msg, "error");

            }

        }
    }


   

}