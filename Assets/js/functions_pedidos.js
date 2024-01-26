
let tablePedidos;

let rowTable;
//Inicio de DATATABLE 
tablePedidos = $('#tablePedidos').dataTable({

    "aProcessing":true,
    "aServerSide": true,
    "language":{
        "url":"//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
    },
    
    "ajax":{
        "url": " "+base_url+"/Pedidos/getPedidos",
        
        "dataSrc": ""
    },

    "columns":[
        // nombres del formato json
        {"data":"idpedido"},
        {"data":"transaccion"},
        {"data":"fecha"},
        {"data":"monto"},
        {"data":"tipopago"},
        {"data":"status"}, 
        // otro para acciones para sus columnas
        {"data":"options"}
        
    ],

    "columnDefs": [

            {
                "className":"textcenter","targets": [3], 
            },
            {
                "className":"textright","targets": [4], 
            },
            {
                "className":"textcenter","targets": [5], 
            }
            

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
                "columns" : [0,1,2,3,4,5]
            }

        },
        {
            "extend":"excelHtml5",
            "text":"<i class='fas fa-file-excel'></i> Excel",
            "titleAttr":"Exportar Excel",
            "className": "btn btn-success",
            "exportOptions":{
                "columns" : [0,1,2,3,4,5]
            }
        },{
            "extend":"pdfHtml5",
            "text":"<i class='fas fa-file-pdf'></i> PDF",
            "titleAttr":"Exportar PDF",
            "className": "btn btn-danger",
            "exportOptions":{
                "columns" : [0,1,2,3,4,5]
            }
        },{
            "extend":"csvHtml5",
            "text":"<i class='fas fa-file-csv'></i> CSV",
            "titleAttr":"Exportar CVS",
            "className": "btn btn-info",
            "exportOptions":{
                "columns" : [0,1,2,3,4,5]
            }

        }
    ],
    // Paginacion
    "resonsieve":"true",
    "bDestroy": true,
    "iDisplayLength": 10,
    "order":[[0,"desc"]]
});


//#1 abrir modal de rremboslos

function fntTransaccion(idtransaccion){

    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');

    let ajaxUrl = base_url+'/Pedidos/getTransaccion/'+idtransaccion;

    divLoading.style.display="flex";

    request.open("GET", ajaxUrl,true);

    request.send();

    request.onreadystatechange = function(){

        if(request.readyState == 4 && request.status == 200){

            let objData = JSON.parse(request.responseText);

            if(objData.status){

                document.querySelector("#divModal").innerHTML = objData.html;

                $('#modalReembolso').modal('show');

            }else{

                swal("Error", objData.msg, "error");

            }

            divLoading.style.display = "none";

            return false;

        }
    }

}



//#2 boton para reembolsar del modal

function fntReembolsar(){

    let idtransaccion = document.querySelector("#idtransaccion").value;

    let observacion = document.querySelector("#txtObservacion").value;

    if(idtransaccion == '' || observacion == ''){

        swal("", "Complete los Datos para Continuar","error");

        return false;

    }

    swal({
        title: "Hacer Reembolso",
        text: "¿Realmente quiere realizar el Reembolso?",
        icon: "warning",
        buttons: ["No, Cancelar El Proceso","Si, Realizar Remmbolso"],
        dangerMode: true,
      })
      .then((willDelete) => {
        if(willDelete){

            $('#modalReembolso').modal('hide');

            divLoading.style.display = "flex";

            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');

            let ajaxUrl = base_url+'/Pedidos/setReembolso';

            let formData = new FormData();

            formData.append('idtransaccion',idtransaccion);

            formData.append('observacion',observacion);

            request.open("POST",ajaxUrl,true);

            request.send(formData);

            request.onreadystatechange = function(){

                if(request.readyState != 4) return;

                if(request.status == 200){
                    
                    let objData = JSON.parse(request.responseText);

                    if(objData.status){

                        window.location.reload();

                    }else{

                        swal("Error", objData.msg, "error");

                    }

                    divLoading.style.display = "none";

                    return false;

                }


            }

        }
      });
}



//  #3 Editar Pedidos

function fntEditInfo(element, idpedido){

    rowTable = element.parentNode.parentNode.parentNode;
 

    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');

    let ajaxUrl = base_url+'/Pedidos/getPedido/'+idpedido;

    divLoading.style.display="flex";

    request.open("GET", ajaxUrl,true);

    request.send();

    request.onreadystatechange = function(){

        if(request.readyState == 4 && request.status == 200){

            let objData = JSON.parse(request.responseText);

            if(objData.status){

                document.querySelector("#divModal").innerHTML = objData.html;

                $('#modalFormPedido').modal('show')

                $('select').selectpicker();

                // Funcion a ejecutarse
                fntUpdateInfo();
                

            }else{

                swal("Error", objData.msg, "error");

            }

            divLoading.style.display = "none";

            return false;

        }

    }
}

function fntUpdateInfo(){


    let formUpdatePedido = document.querySelector("#formUpdatePedido"); 

    formUpdatePedido.onsubmit = function(e){

        e.preventDefault();

        let transaccion;

        if(document.querySelector("#txtTransaccion")){

            transaccion = document.querySelector("#txtTransaccion").value;

            if(transaccion == ""){

                swal("", "Complete los datos para continuar.","error");

                return false;

            }

        }


        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');

        let ajaxUrl = base_url+'/Pedidos/setPedido/';

        divLoading.style.display="flex";

        let formData = new FormData(formUpdatePedido);

        request.open("POST",ajaxUrl,true);

        request.send(formData);

        request.onreadystatechange = function(){

            if(request.readyState != 4 ) return;
            if(request.status == 200){

                let objData = JSON.parse(request.responseText);

                if(objData.status){

                    swal("",objData.msg,"success");

                    $('#modalFormPedido').modal('hide');

                    if(document.querySelector("#txtTransaccion")){

                        rowTable.cells[1].textContent = document.querySelector("#txtTransaccion").value;

                        rowTable.cells[4].textContent = document.querySelector("#listTipopago").selectedOptions[0].innerHTML;

                        rowTable.cells[5].textContent = document.querySelector("#listEstado").value;

                    }else{

                        rowTable.cells[5].textContent = document.querySelector("#listEstado").value;

                    }

                    

                }else{

                    swal("Error", objData.msg, "error");
                }


                divLoading.style.display = "none";

                return false;

            }

        }



    }

}