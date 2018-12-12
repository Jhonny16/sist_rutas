/**
 * Created by tito_ on 06/12/2018.
 */

$(document).ready(function () {
    cargar_zona();
    listar_dev();
});
function cargar_zona(){

    $.post
    (
        "../controller/Zona.cargar.datos.controller.php"
    ).done(function(resultado){
        var datosJSON = resultado;
        //console.log(resultado);

        if (datosJSON.estado===200){
            var html = "";

            html += '<option value="">Seleccione zona</option>';
            $.each(datosJSON.datos, function(i,item) {
                html += '<option value="'+item.id+'">'+item.nombre+'</option>';
            });

            $("#combo_zona").html(html);
        }else{
            swal("Mensaje del sistema", resultado , "warning");
        }
    }).fail(function(error){
        var datosJSON = $.parseJSON( error.responseText );
        swal("Error", datosJSON.mensaje , "error");
    });
}

function listar_dev() {
    $("#listado_devoluciones").html("");

    var fecha1 = $("#fecha1").val();
    var fecha2 = $("#fecha2").val();
    var state = $("#combo_estado").val();
    //var p_zona = $("#combo_zona").val();

    var p_persona = $("#devpersona_id").val();
    var data = {
        p_fecha1: fecha1,
        p_fecha2: fecha2,
        p_estado : state,
        p_persona : parseInt(p_persona)

    };
    console.log(data);
    $.post
    (
        "../controller/Devolcioncliente_seguimiento_listar_controller.php",data


    ).done(function (resultado) {
        var datosJSON = resultado;

        if (datosJSON.estado === 200) {
            var html = "";


            html += '<table id="tabla_lista_dev" class="table table-bordered" >';
            html += '<thead>';
            html += '<tr style="background-color: #f9f9f9; height:25px;">';
            html += '<th style="text-align: center; color:#26B99A" >DET</th>';
            html += '<th style="color:#26B99A">N-PEDIDO</th>';
            html += '<th style="color:#26B99A">N-DEVOCION</th>';
            html += '<th style="color:#26B99A">FECHA</th>';
            html += '<th style="color:#26B99A">MOTIVO</th>';
            html += '<th style="color:#26B99A">DESCRIPCION</th>';
            html += '<th style="color:#26B99A">TIEMPO MAX.</th>';
            html += '<th style="color:#26B99A">ESTADO</th>';
            html += '<th style="color:#26B99A">RESPONSABLE</th>';
            html += '<th style="color:#26B99A">CLIENTE</th>';
            html += '<th style="color:#26B99A">ZONA</th>';
            html += '</tr>';
            html += '</thead>';
            html += '<tbody>';
            //Detalle
            $.each(datosJSON.datos, function (i, item) {

                html += '<td style="text-align: center"><a title="Ver detalle de Pre-Venta"  data-toggle="modal" data-target="#mdl_det_devolucion" ' +
                    'onclick="detail_dev(' + item.id + ')" onmouseover="" style="cursor: pointer;" >' +
                    '<i class="fa fa-th-list text-success"></i></a></td>';
                html += '<td>' + item.pedido + '</td>';
                html += '<td>' + item.devolucion+ '</td>';
                html += '<td>' + item.fecha + '</td>';
                html += '<td>' + item.motivo+ '</td>';
                html += '<td>' + item.descripcion+ '</td>';
                html += '<td>' + item.tiempo_maximo + '</td>';
                html += '<td>' + item.estado + '</td>';
                html += '<td>' + item.responsable + '</td>';
                html += '<td>' + item.cliente + '</td>';
                html += '<td>' + item.zona + '</td>';
                html += '</tr>';
            });
            html += '</tbody>';
            html += '</table>';
            $("#listado_devoluciones").html(html);
            $('#tabla_lista_dev').dataTable({
                "aaSorting": [[0, "desc"]],
                "sScrollX": "100%",
                "sScrollXInner": "130%"
            });
        } else {
            swal("Nota", "No se encontraron resultados en la búsqueda", "info");
        }

    }).fail(function (error) {
        var datosJSON = $.parseJSON(error.responseText);
        //swal("Error", datosJSON.mensaje , "error");
    });
}

function detail_dev(id) {
    //$("#detail_devolucion").empty();
    $("#detail_devolucion").html("");
    $.post
    (
        "../controller/Devolucion.detalle.listar.controller.php",{'p_id': id}


    ).done(function (resultado) {
        var datosJSON = resultado;

        if (datosJSON.estado === 200) {
            var html = "";
            //Detalle
            $.each(datosJSON.datos, function (i, item) {

                html += '<td>' + item.id + '</td>';
                html += '<td>' + item.nombre + '</td>';
                html += '<td>' + item.cantidad + '</td>';
                html += '</tr>';
            });
            html += '</tbody>';
            html += '</table>';
            $("#detail_devolucion").html(html);
        } else {
            swal("Nota", "No se encontraron resultados en la búsqueda", "info");
        }

    }).fail(function (error) {
        var datosJSON = $.parseJSON(error.responseText);
        //swal("Error", datosJSON.mensaje , "error");
    });
    
}

