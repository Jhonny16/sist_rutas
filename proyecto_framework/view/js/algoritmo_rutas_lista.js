var array_trayectorias = [];
var array_nodos = [];

var array_ruta;

var array_mark = [];

var estado;
var fecha;
var carro;
$(document).ready(function () {
    busqueda_rutas();

});
function busqueda_rutas() {
    listar_rutas();
}

function listar_rutas() {

    var fecha1 = $("#fecha1_ruta").val();
    var fecha2 = $("#fecha2_ruta").val();

    $.post
            (
                    "../controller/Ruta.listar.controller.php",
                    {
                        p_fecha1: fecha1,
                        p_fecha2: fecha2

                    }

            ).done(function (resultado) {
        var datosJSON = resultado;
        console.log(resultado);
        array_ruta = resultado;

        if (datosJSON.estado === 200) {
            var html = "";


            html += '<table id="tbl_list_rutas" class="table table-striped" >';
            html += '<thead>';
            html += '<tr style="background-color: #f9f9f9; height:25px;">';
            html += '<th style="text-align: center">SELECCIONAR</th>';
            html += '<th style="color:#26B99A">Punto Inicio</th>';
            html += '<th style="color:#26B99A">Punto Fin</th>';
            html += '<th style="color:#26B99A">Chofer</th>';
            html += '<th style="color:#26B99A">Unidad</th>';
            html += '<th style="color:#26B99A">Tiempo</th>';
            html += '<th style="color:#26B99A">Fecha</th>';
            html += '<th style="color:#26B99A">Costo x Galón</th>';
            html += '<th style="color:#26B99A">Costo Total </th>';
            html += '<th style="color:#26B99A">Km Recorrido</th>';
            html += '</tr>';
            html += '</thead>';
            html += '<tbody>';

            $.each(datosJSON.datos, function (i, item) {
                var min = Math.round(item.distancia_total / 60, 1);
                html += '<tr>';
                html += '<td align="center">';
                html += '<a  onmouseover="" style="cursor: pointer;" title="Ver Ruta" onclick="lista_trayectoria(' + item.id + ')"><img src="../images/enviar.png" style="width:1.5em" ></a>';
                html += '</td>';
                html += '<td>' + item.nodo_inicio_valor + '</td>';
                html += '<td>' + item.nodo_final_valor + '</td>';
                html += '<td>' + item.chofer + '</td>';
                html += '<td>' + item.unidad + '</td>';
                html += '<td>' + Math.round(item.distancia_total, 1) + ' s (' + min + 'min)</td>';
                html += '<td>' + item.fecha + '</td>';
                html += '<td>' + item.costo_galon + '</td>';
                html += '<td>' + item.costo_total + '</td>';
                html += '<td>' + item.km_recorrido + '</td>';
                html += '</tr>';
            });
            html += '</tbody>';
            html += '</table>';
            $("#div_rutas").html(html);
            $('#tbl_list_rutas').dataTable({
                "aaSorting": [[0, "asc"]],
                "sScrollX": "150%",
                "sScrollXInner": "150%",
                "bScrollCollapse": true,
                "bPaginate": true
            });
        } else {
            //swal("Mensaje del sistema", resultado , "warning");
        }

    }).fail(function (error) {
        var datosJSON = $.parseJSON(error.responseText);
        //swal("Error", datosJSON.mensaje , "error"); 
    });
}

var contentString = '';
var unidad = '';
var chofer = '';
function lista_trayectoria(id) {
    array_mark = [];
    init_mapa();
    cont=0;
    step=0;
    //clearInterval(myVar);
    //myTimer();
    //carro.setMap(null);
    var aux = 0;
    $.each(array_ruta.datos, function (i, item) {
        if (item.id === id) {
            aux = i;

        }
    });
    var nodo_inicio = array_ruta.datos[aux].nodo_inicio_valor;
    var nodo_final = array_ruta.datos[aux].nodo_final_valor;
    array_mark.push(nodo_inicio);
    array_mark.push(nodo_final);
    


    unidad = array_ruta.datos[aux].unidad;
    chofer = array_ruta.datos[aux].chofer;
    contentString = '<b>Unidad:</b>' + unidad + '<br>\n\
                        \<b>Chofer:</b>' + chofer + '<br>\n\
                          ';

    var myLatLng = {lat: -6.78045319652979, lng: -79.83708406994054};
    carro = new google.maps.Marker({
        position: myLatLng,
        //map: mapa,
        //title: direccion,
        icon: {
            url: "../images/vehiculo.png",
            scaledSize: new google.maps.Size(20, 20) // scaled size
        },
        draggable: true
    });

    carro.addListener('click', function () {
        infowindow.open(mapa, carro);
    });

    var infowindow = new google.maps.InfoWindow({
        content: contentString
    });

    //carro.setMap(mapa);
    
    $.post
            (
                    "../controller/Ruta.trayectoria.listar.controller.php",
                    {
                        p_id: id

                    }

            ).done(function (resultado) {
        var datosJSON = resultado;
        console.log(resultado);
        array_trayectorias = resultado.datos;

    }).fail(function (error) {
        var datosJSON = $.parseJSON(error.responseText);
    });

    $.post
            (
                    "../controller/Ruta.nodos-intermedios.listar.controller.php",
                    {
                        p_id: id

                    }

            ).done(function (resultado) {
        var datosJSON = resultado;
        array_nodos = resultado.datos;
        for (var i = 0; i < array_nodos.length; i++) {
            array_mark.push({titulo: array_nodos[i].direccion, posicion: {lat: parseFloat(array_nodos[i].latitud), lng: parseFloat(array_nodos[i].longitud)}});
        }

        console.log(array_mark);

        mostrando_ruta();
        console.log(array_trayectorias);
        var html = "";
        html += '<table id="tbl_trayectoria" class="table" >';
        html += '<thead>';
        html += '<tr style="background-color: #f9f9f9; height:25px;">';
        html += '<th style="color:#26B99A">Desde</th>';
        html += '<th style="color:#26B99A; text-align:center"><i class="fa fa-arrow-right"></th>';
        html += '<th style="color:#26B99A">Entrega</th>';
        html += '<th style="color:#26B99A">Hasta</th>';
        html += '<th style="color:#26B99A">Rutas</th>';
        html += '</tr>';
        html += '</thead>';
        html += '<tbody>';

        for (var i = 0; i < array_trayectorias.length; i++) {

            if (array_trayectorias[i].nodo1 === array_trayectorias[i].nodo_inicio_letra) {

                // console.log(array_trayectorias[i].nodo_inicio_valor);
                var lat1 = 1;
                var lng1 = 1;

                html += '<tr>';
                html += '<td>' + array_trayectorias[i].nodo_inicio_valor + '</td>';

            } else {
                for (var j = 0; j < array_nodos.length; j++) {
                    if (array_trayectorias[i].nodo1 === array_nodos[j].nodo_letra) {
                        //   console.log(array_nodos[j].direccion);
                        var lat1 = array_nodos[j].latitud;
                        var lng1 = array_nodos[j].longitud;
                        if (i >= 1) {
                            html += '<tr>';
                            html += '<td>' + array_nodos[j].direccion + '</td>';
                        } else {
                            html += '<td style="text-align:center"><i class="fa fa-arrow-right"></td>';
                            html += '<td>' + array_nodos[j].direccion + '</td>';
                            html += '</tr>';
                        }

                    }
                }
            }

            if (array_trayectorias[i].nodo2 === array_trayectorias[i].nodo_final_letra) {
                var lat2 = 2;
                var lng2 = 2;
                //console.log(array_trayectorias[i].nodo_final_valor);
                html += '<td style="text-align:center"><i class="fa fa-arrow-right"></td>';
                html += '<td style="text-align:center;color:red">Regreso</td>';
                html += '<td>' + array_trayectorias[i].nodo_final_valor + '</td>';
                html += '<td style="text-align:center"><a title="Ver detalle de Ruta"  \n\
                        data-toggle="modal" data-target="#modal_rutas" onclick="ver_rutas( ' + lat1 + ' , ' + lng1 + ',' + lat2 + ' , ' + lng2 + ' )" \n\
                        onmouseover="" style="cursor: pointer;" ><img src="../images/camino.png" style="width:2em"></a></td>';
                html += '</tr>';
            } else {
                for (var j = 0; j < array_nodos.length; j++) {
                    if (array_trayectorias[i].nodo2 === array_nodos[j].nodo_letra) {
                        //      console.log(array_nodos[j].direccion);
                        var lat2 = array_nodos[j].latitud;
                        var lng2 = array_nodos[j].longitud;
                        html += '<td style="text-align:center"><i class="fa fa-arrow-right"></td>';
                        html += '<td style="text-align:center"><a title="Ver detalle de Pre-Venta"  \n\
                        data-toggle="modal" data-target="#mdl_list_detalle_pv_ruta" onclick="ver_detalle_pv_ruta(' + array_nodos[j].id_pedido + ')" \n\
                        onmouseover="" style="cursor: pointer;" ><img src="../images/detalle.png" style="width:1.5em"></a></td>';
                        html += '<td>' + array_nodos[j].direccion + '</td>';
                        html += '<td style="text-align:center"><a title="Ver detalle de Ruta"  \n\
                        data-toggle="modal" data-target="#modal_rutas" onclick="ver_rutas(' + lat1 + ',' + lng1 + ',' + lat2 + ',' + lng2 + ')" \n\
                        onmouseover="" style="cursor: pointer;" ><img src="../images/camino.png" style="width:2em"></a></td>';
                        html += '</tr>';


                    }
                }
            }


        }

        html += '</tbody>';
        html += '</table>';

        $("#div_trayectoria").html(html);
        $('#tbl_trayectoria').dataTable({
            "aaSorting": [[2, "asc"]],
            "sScrollX": "100%",
            "sScrollXInner": "100%"
        });

    }).fail(function (error) {
        var datosJSON = $.parseJSON(error.responseText);
    });


}


function ver_detalle_pv_ruta(id) {

    $.post
            (
                    "../controller/Pre-venta.detalle.listar.controller.php",
                    {
                        p_id: id
                    }

            ).done(function (resultado) {
        var datosJSON = resultado;

        if (datosJSON.estado === 200) {
            // console.log(datosJSON);
            $("#id_pre_venta").val(id);

            $("#txt_detalle_cliente").val(datosJSON.datos[0].cliente);
            console.log(datosJSON.datos[0].estado_seguimiento);
            if (datosJSON.datos[0].estado_seguimiento === 'E') {
                $("#chb_entrega").iCheck('Check');
            } else {
                $("#chb_entrega").iCheck('uncheck');
            }

            var html = "";


            html += '<table id="tabla-detalle-pv" class="table table-bordered" >';
            html += '<thead>';
            html += '<tr style="background-color: #f9f9f9; height:25px;">';
            html += '<th style="color:#26B99A">COD.</th>';
            html += '<th style="color:#26B99A">NOMBRE</th>';
            html += '<th style="color:#26B99A">CANTIDAD</th>';
            html += '<th style="color:#26B99A">UNI. MED.</th>';
            html += '<th style="color:#26B99A">PRECIO</th>';
            html += '<th style="color:#26B99A">IMPORTE</th>';
            html += '</tr>';
            html += '</thead>';
            html += '<tbody>';

            //Detalle
            $.each(datosJSON.datos, function (i, item) {
                html += '<tr>';
                html += '<td>' + item.id_producto + '</td>';
                html += '<td>' + item.nombre + '</td>';
                html += '<td>' + item.cantidad + '</td>';
                html += '<td>' + item.unidad_medida + '</td>';
                html += '<td>' + item.precio + '</td>';
                html += '<td>' + item.importe + '</td>';
                html += '</tr>';
            });
            html += '</tbody>';
            html += '</table>';
            $("#list_detalle").html(html);
            $('#tabla-detalle-pv').dataTable({
                "aaSorting": [[0, "asc"]]
            });
        } else {
            swal("Mensaje del sistema", resultado, "warning");
        }

    }).fail(function (error) {
        var datosJSON = $.parseJSON(error.responseText);
    });


}

//ENTREGA DE PEDIDO
$('#chb_entrega').on('ifChecked', function (event) {
    estado = 'E';
    fecha = $("#fecha_entrega").val();
});
$('#chb_entrega').on('ifUnchecked', function (event) {
    estado = 'P';
    fecha = '';
});

function actualizar_entrega() {


    swal({
        title: "Confirme",
        text: "¿Desea actualizar este Pedido?",
        showCancelButton: true,
        confirmButtonColor: '#3d9205',
        confirmButtonText: 'Si',
        cancelButtonText: "No",
        closeOnConfirm: false,
        closeOnCancel: true,
        imageUrl: "../images/pregunta.png"
    },
            function (isConfirm) {
                if (isConfirm) { //el usuario hizo clic en el boton SI                                             
                    $.post(
                            "../controller/Pre-venta.actualizar.controller.php",
                            {
                                p_id: $("#id_pre_venta").val(),
                                p_fecha: fecha,
                                p_estado: estado
                            }
                    ).done(function (resultado) {

                        //console.log(resultado);
                        var datosJSON = resultado;

                        if (datosJSON.estado === 200) {
                            swal("Exito", datosJSON.mensaje, "success");
                        } else {
                            swal("Mensaje del sistema", resultado, "warning");
                        }

                    }).fail(function (error) {
                        var datosJSON = $.parseJSON(error.responseText);
                        swal("Error", datosJSON.mensaje, "error");
                    });

                }
            });

}

function actualizar_entrega_2() {


    swal({
            title: "Confirme",
            text: "¿Desea actualizar este Pedido?",
            showCancelButton: true,
            confirmButtonColor: '#3d9205',
            confirmButtonText: 'Si',
            cancelButtonText: "No",
            closeOnConfirm: false,
            closeOnCancel: true,
            imageUrl: "../images/pregunta.png"
        },
        function (isConfirm) {
            if (isConfirm) { //el usuario hizo clic en el boton SI
                $.post(
                    "../controller/Pre-venta.actualizar_entrega.controller.php",
                    {
                        p_id: $("#id_pre_venta").val(),
                        p_fecha: fecha,
                        p_estado: estado
                    }
                ).done(function (resultado) {

                    //console.log(resultado);
                    var datosJSON = resultado;

                    if (datosJSON.estado === 200) {
                        swal("Exito", datosJSON.mensaje, "success");
                    } else {
                        swal("Mensaje del sistema", resultado, "warning");
                    }

                }).fail(function (error) {
                    var datosJSON = $.parseJSON(error.responseText);
                    swal("Error", datosJSON.mensaje, "error");
                });

            }
        });

}

