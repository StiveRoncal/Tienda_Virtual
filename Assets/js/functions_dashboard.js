// Recurso de DatePicker

$('.date-picker').datepicker( {
    closeText: 'Cerrar',
	prevText: '<Ant',
	nextText: 'Sig>',
	currentText: 'Hoy',
	monthNames: ['1 -', '2 -', '3 -', '4 -', '5 -', '6 -', '7 -', '8 -', '9 -', '10 -', '11 -', '12 -'],
	monthNamesShort: ['Enero','Febrero','Marzo','Abril', 'Mayo','Junio','Julio','Agosto','Setiembre', 'Octubre','Noviembre','Diciembre'],
    changeMonth: true,
    changeYear: true,
    showButtonPanel: true,
    dateFormat: ' MM yy',
    showDays: false,
    onClose: function(dateText, inst) {
        $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
    }
});

//#1 Busqueda de  Tipo pago por Mes

function fntSearchPagos(){

    let fecha = document.querySelector(".pagoMes").value;

    if(fecha == ""){

        swal("","Seleccionar Mes y Año", "error");

        return false;

    }else{

        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');

        let ajaxUrl = base_url+"/Dashboard/tipoPagoMes";

        divLoading.style.display = "flex";

        let formData = new FormData();

        formData.append('fecha',fecha);

        request.open("POST",ajaxUrl,true);

        request.send(formData);

        request.onreadystatechange = function(){

            if(request.readyState != 4) return;

            if(request.status == 200){

                $("#pagosMesAnio").html(request.responseText);

                divLoading.style.display = "none";

                return false;

            }
        }

    }

}


//#2 Busqueda de Ventas por Mes
function fntSearchVMes(){

    let fecha = document.querySelector(".ventasMes").value;

    if(fecha == ""){

        swal("","Seleccionar Mes y Año", "error");

        return false;

    }else{

        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');

        let ajaxUrl = base_url+"/Dashboard/ventasMes";

        divLoading.style.display = "flex";

        let formData = new FormData();

        formData.append('fecha',fecha);

        request.open("POST",ajaxUrl,true);

        request.send(formData);

        request.onreadystatechange = function(){

            if(request.readyState != 4) return;

            if(request.status == 200){

                $("#graficaMes").html(request.responseText);

                divLoading.style.display = "none";

                return false;

            }
        }

    }

}


//#3 Busqueda Ventas por Año

function fntSearchVAnio(){

    let anio = document.querySelector(".ventasAnio").value;

    if(anio == ""){

        swal("","Ingrese Año", "error");

        return false;

    }else{

        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');

        let ajaxUrl = base_url+"/Dashboard/ventasanio";

        divLoading.style.display = "flex";

        let formData = new FormData();

        formData.append('anio',anio);

        request.open("POST",ajaxUrl,true);

        request.send(formData);

        request.onreadystatechange = function(){

            if(request.readyState != 4) return;

            if(request.status == 200){

                $("#graficaAnio").html(request.responseText);

                divLoading.style.display = "none";

                return false;

            }
        }

    }

}