var p_fecha = 1;
var estado = 'P';
var zona=0;
//Movimientos
$('#busq_fc_pv').on('ifChecked', function (event) {
    p_fecha = $("#busq_fc_pv").val();
});
$('#busq_fe_pv').on('ifChecked', function (event) {
    p_fecha = $("#busq_fe_pv").val();
});

$('#busq_ep_pv').on('ifChecked', function (event) {
    estado = $("#busq_ep_pv").val();
});
$('#busq_ee_pv').on('ifChecked', function (event) {
    estado = $("#busq_ee_pv").val();
});



$(document).ready(function () {
    listar_pv_reporte();
    cargar_zona_preVenta_report();
});

function busqueda_pv_reporte() {
    listar_pv_reporte();
}

function listar_pv_reporte() {

    var fecha1 = $("#txtFecha1_pv").val();
    var fecha2 = $("#txtFecha2_pv").val();
    
    var p_zona = $("#cbx_zona_pv_report").val();
    if(p_zona===null){
        p_zona = zona;
    }


    $.post
            (
                    "../controller/Reporte.preventa.vista.controller.php",
                    {
                        p_fecha: p_fecha,
                        p_fecha1: fecha1,
                        p_fecha2: fecha2,
                        p_estado : estado,
                        p_zona : p_zona
                        
                    }

            ).done(function (resultado) {
        var datosJSON = resultado;
        
            $("#listado_pv_vista").empty();
            $("#listado_pv_vista").append(resultado);
            $('#tbl_list_pv_reporte').dataTable({
               "aaSorting": [[0, "desc"]],
                "sScrollX": "100%",
                "sScrollXInner": "150%"
            });

    }).fail(function (error) {
        var datosJSON = $.parseJSON(error.responseText);
        //swal("Error", datosJSON.mensaje , "error"); 
    });
}


function cargar_zona_preVenta_report(){ 
    
    $.post
    (
	"../controller/Zona.cargar.datos.controller.php"
    ).done(function(resultado){
	var datosJSON = resultado;
        //console.log(resultado);
	
        if (datosJSON.estado===200){
            var html = "";
            
                html += '<option value="0">Todas las zonas</option>';            
            $.each(datosJSON.datos, function(i,item) {
                html += '<option value="'+item.id+'">'+item.nombre+'</option>';
            });
            
            $("#cbx_zona_pv_report").html(html);
	}else{
            swal("Mensaje del sistema", resultado , "warning");
        }
    }).fail(function(error){
	var datosJSON = $.parseJSON( error.responseText );
	swal("Error", datosJSON.mensaje , "error");
    });
}



function mostrar_detalle_pv(id) {
    var cantidad = $("#" + id + "").val();
    $("#det" + id + "").removeAttr('style');
    for (var i = 0; i < cantidad; i++) {
        $("#" + i + "f2" + id + "").removeAttr('style');
    }



}

function ocultar_detalle_pv(id) {
    var cantidad = $("#" + id + "").val();
    $("#det" + id + "").attr('style', 'display:none');
    for (var i = 0; i < cantidad; i++) {
        $("#" + i + "f2" + id + "").attr('style', 'display:none');
    }

}