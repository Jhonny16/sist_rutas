var zona = 0;
$(document).ready(function () {
    cargar_zona_cliente_report();
    busqueda_clientes_one_pedido();

});
function busqueda_clientes_one_pedido() {
    listar_cliente_one_pedido();
}

function listar_cliente_one_pedido() {

    var fecha1 = $("#txtFecha1_cliente").val();
    var fecha2 = $("#txtFecha2_cliente").val();
    var p_zona = $("#cbx_zona_cliente_report").val();
    if (p_zona === null) {
        p_zona = zona;
    }

    $.post
            (
                    "../controller/Reporte.cliente.vista.controller.php",
                    {
                        p_fecha1: fecha1,
                        p_fecha2: fecha2,
                        p_zona: p_zona

                    }

            ).done(function (resultado) {
        var datosJSON = resultado;
        console.log(resultado);

        $("#listado_pv_vista").empty();
        $("#listado_pv_vista").append(resultado);
        $('#tbl_list_cliente_one_pedido').dataTable({
            "aaSorting": [],
            "sScrollX": "100%",
            "sScrollXInner": "100%",
            "bScrollCollapse": true,
            "bPaginate": true
        });


    }).fail(function (error) {
        var datosJSON = $.parseJSON(error.responseText);
        //swal("Error", datosJSON.mensaje , "error"); 
    });
}


function mostrar_detalle_cliente(id) {
    var cantidad = $("#" + id + "").val();
    $("#detalle" + id + "").removeAttr('style');
    for (var i = 0; i < cantidad; i++) {
        $("#" + i + "d2" + id + "").removeAttr('style');
    }



}

function ocultar_detalle_cliente(id) {
    var cantidad = $("#" + id + "").val();
    $("#detalle" + id + "").attr('style', 'display:none');
    for (var i = 0; i < cantidad; i++) {
        $("#" + i + "d2" + id + "").attr('style', 'display:none');
    }

}

function cargar_zona_cliente_report(){ 
    
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
            
            $("#cbx_zona_cliente_report").html(html);
	}else{
            swal("Mensaje del sistema", resultado , "warning");
        }
    }).fail(function(error){
	var datosJSON = $.parseJSON( error.responseText );
	swal("Error", datosJSON.mensaje , "error");
    });
}