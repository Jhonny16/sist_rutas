$(document).ready(function () {
    busqueda_rutas_reporte();

});
function busqueda_rutas_reporte() {
    listar_rutas_vista();
}

function listar_rutas_vista() {

    var fecha1 = $("#fecha1_ruta_report").val();
    var fecha2 = $("#fecha2_ruta_report").val();

    $.post
            (
                    "../controller/Reporte.ruta.vista.controller.php",
                    {
                        p_fecha1: fecha1,
                        p_fecha2: fecha2

                    }

            ).done(function (resultado) {
        var datosJSON = resultado;
        console.log(resultado);

            $("#div_rutas_vista").empty();
            $("#div_rutas_vista").append(resultado);
            $("#tbl_list_rutas_two").dataTable({
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


function mostrar_detalle(id) {
    var cantidad = $("#" + id + "").val();
    $("#dir" + id + "").removeAttr('style');
    for (var i = 0; i < cantidad; i++) {
        $("#" + i + "f2" + id + "").removeAttr('style');
    }



}

function ocultar_detalle(id) {
    var cantidad = $("#" + id + "").val();
    $("#dir" + id + "").attr('style', 'display:none');
    for (var i = 0; i < cantidad; i++) {
        $("#" + i + "f2" + id + "").attr('style', 'display:none');
    }

}
