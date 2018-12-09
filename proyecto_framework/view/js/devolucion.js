/**
 * Created by tito_ on 05/12/2018.
 */
$(document).ready(function () {
    list_clientes();
    list_personal();

});

function list_clientes() {

    $("#combo_pedido").empty();
    $.post
    (
        "../controller/clientepv.listar.controller.php"
    ).done(function (resultado) {
        //console.log(resultado);
        var datosJSON = resultado;
        // alert(resultado);

        if (datosJSON.estado === 200) {
            var html = "";
            html += '<option value="0">-- Seleccione Venta/Cliente --</option>';
            $.each(datosJSON.datos, function (i, item) {
                //p_lista_cliente.push({'cliente_id': item.id, 'dni_ruc': item.dni_ruc});
                html += '<option value="'+ item.id +'">' + item.code + ' / ' + item.cliente  + '</option>';
            });
            $("#combo_pedido").append(html);
        } else {
            swal("Mensaje del sistema", resultado, "warning");
        }

    }).fail(function (error) {
        var datosJSON = $.parseJSON(error.responseText);
        //swal("Error", datosJSON.mensaje , "error");
    });
}

function list_personal() {

    $("#combo_responsable").empty();
    $.post
    (
        "../controller/Personal.listar.controller.php"
    ).done(function (resultado) {
        console.log(resultado);
        var datosJSON = resultado;
        // alert(resultado);

        if (datosJSON.estado === 200) {
            var html = "";
            html += '<option value="0">-- Seleccione Responsable --</option>';
            $.each(datosJSON.datos, function (i, item) {
                //p_lista_cliente.push({'cliente_id': item.id, 'dni_ruc': item.dni_ruc});
                html += '<option value="'+ item.personal +'">' + item.cargo + ' / ' + item.personal  + '</option>';
            });
            $("#combo_responsable").append(html);
        } else {
            swal("Mensaje del sistema", resultado, "warning");
        }

    }).fail(function (error) {
        var datosJSON = $.parseJSON(error.responseText);
        //swal("Error", datosJSON.mensaje , "error");
    });
}


$("#combo_pedido").change(function () {
    var id = $("#combo_pedido").val();
    var data = {"p_id" : id};
    $("#detalle_venta").html("");
    $.ajax({
        type: "post",
        url: '../controller/Pre-venta.detalle.listar.controller.php',
        data: data,
        success: function (resultado) {
            console.log(resultado);
            var datosJSON = resultado;
            if (datosJSON.estado == 200) {

                var html = "";
                var i = 0;
                $.each(datosJSON.datos, function (i, item) {
                    i++;
                    html += '<tr>';
                    html += '<td>';html += i;html += '</td>'
                    html += '<td style="display:none">' + item.id_producto + '</td>';
                    html += '<td>' + item.nombre + '</td>';
                    html += '<td>' + item.cantidad + '</td>';
                    html += '<td id="cant_dev'+ item.id_producto +'" style="display: none"></td>';
                    html += '<td><input type="number" id="cantidad_dev'+ item.id_producto +'" min="1" maxlength="3" max="100" onblur="cant('+item.id_producto+')"/></td>';
                    html += '</tr>';
                });
                $("#detalle_venta").html(html);

            } else {
                swal({
                    type: 'info',
                    title: 'Nota!',
                    text: datosJSON.mensaje,
                })
                return 0;
            }
        },
        error: function (error) {
            console.log(error);
            var datosJSON = $.parseJSON(error.responseText);
            swal("Error", datosJSON.mensaje, "error");
        }
    });


});

function cant(id){
    var cant = $("#cantidad_dev"+id).val();
    $("#cant_dev"+ id).html(cant)

}
var arrayDetalle = new Array();
function save_devolucion(){
    if( $("#combo_responsable").val()== ''){
        swal("Nota","Debe seleccionar un responsable", "info");
        return 0;
    }

    swal({
            title: "Confirme",
            text: "¿Esta seguro de grabar los datos de la devolución?",
            showCancelButton: true,
            confirmButtonColor: '#3d9205',
            confirmButtonText: 'Si',
            cancelButtonText: "No",
            closeOnConfirm: false,
            closeOnCancel: true,
            imageUrl: "../images/pregunta.png"
        },
        function(isConfirm){

            if (isConfirm){ //el usuario hizo clic en el boton SI

                arrayDetalle.splice(0, arrayDetalle.length);

                /*RECORREMOS CADA FILA DE LA TABLA DONDE ESTAN LOS PRODUCTOS VENDIDOS*/
                $("#detalle_venta tr").each(function(){
                    var id_producto = $(this).find("td").eq(1).html();
                    var cantidad = $(this).find("td").eq(4).html();
                    console.log(cantidad);
                    if(cantidad != ""){
                        var objDetalle = new Object(); //Crear un objeto para almacenar los datos

                        objDetalle.producto_id = id_producto;
                        objDetalle.cantidad  = cantidad;
                        arrayDetalle.push(objDetalle);
                    }

                });

                var jsonDetalle = JSON.stringify(arrayDetalle);

                var datos_frm = {
                    p_pedidoid: $("#combo_pedido").val(),
                    p_usuarioid: $("#dev_userid").val(),
                    p_fecha: $("#date_devolucion").val(),
                    p_motivo: $("#txt_motivo").val(),
                    p_time: $("#txt_tiempo").val(),
                    p_descripcion: $("#area_descrpcion").val(),
                    p_estado: 'En tramite',
                    p_res: $("#combo_responsable").val(),
                    p_datosJSONDetalle: jsonDetalle
                }           ;
                console.log(datos_frm);

                $.ajax({
                    type: "post",
                    url: "../controller/Devolucion.agregar.controller.php",
                    data: datos_frm,
                    success: function(resultado){
                        console.log(resultado);
                        var datosJSON = resultado;
                        if (datosJSON.estado === 200){
                            swal({
                                    html:true,
                                    title: "Todo Correcto",
                                    text: datosJSON.mensaje,
                                    type: "success",
                                    showCancelButton: false,
                                    confirmButtonText: 'Ok',
                                    closeOnConfirm: true
                                },
                                function(){
                                    document.location.href="devolucion_seguimiento.lista.view.php";
                                });

                        }
                    },
                    error: function(error){
                        var datosJSON = $.parseJSON( error.responseText );
                        swal("Error", datosJSON.mensaje , "error");
                    }
                });

            }
        });
}
