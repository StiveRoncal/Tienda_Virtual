let tableSuscriptores;

// DataTables
tableSuscriptores = $('#tableSuscriptores').dataTable({

    "aProcessing":true,
    "aServerSide": true,
    "language":{
        "url":"//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
    },
    
    "ajax":{
        "url": " "+base_url+"/suscriptores/getSuscriptores",
        
        "dataSrc": ""
    },

    "columns":[
        {"data":"idsuscripcion"},
        {"data":"nombre"},
        {"data":"email"},
        {"data":"fecha"},
        
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