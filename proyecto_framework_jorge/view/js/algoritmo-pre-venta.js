var zona = 0;
var list_pedidos;
var array_ids2 = [];
var array_pedidos = [];
var array_ides_pedidos = [];
$(document).ready(function () {
    listar_pedidos_algoritmo();
});
function busqueda_pv_algoritmo() {
    listar_pedidos_algoritmo();
}

function listar_pedidos_algoritmo() {

    var fecha1 = $("#txtFecha1_algorimto").val();
    var fecha2 = $("#txtFecha2_algoritmo").val();
    var p_zona = $("#cbx_zona_pv_algoritmo").val();

    if (p_zona === null) {
        p_zona = zona;
    }

    $.post
            (
                    "../controller/preventa.algoritmo.listar.controller.php",
                    {
                        p_fecha1: fecha1,
                        p_fecha2: fecha2,
                        p_zona: p_zona

                    }

            ).done(function (resultado) {
        var datosJSON = resultado;
        //console.log(resultado);
        list_pedidos = "";
        list_pedidos = resultado;

        if (datosJSON.estado === 200) {
            var html = "";


            html += '<table id="tabla-listado-pv-algoritmo" class="table table-striped" >';
            html += '<thead>';
            html += '<tr style="background-color: #f9f9f9; height:25px;">';
            html += '<th style="text-align: center">Selec.</th>';
            html += '<th style="color:#26B99A">#</th>';
            html += '<th style="color:#26B99A">ZONA</th>';
            html += '<th style="color:#26B99A">FECHA </th>';
            html += '<th style="color:#26B99A">CLIENTE</th>';
            html += '<th style="color:#26B99A">DIRECCION</th>';
            html += '<th style="color:#26B99A">TOTAL</th>';
            html += '</tr>';
            html += '</thead>';
            html += '<tbody>';

            $.each(datosJSON.datos, function (i, item) {

                html += '<tr>';
                html += '<td align="center">';
                html += '<input type="checkbox" id="id' + item.id + '" onclick="seleccion_pedido(' + item.id + ')">';
                html += '</td>';
                html += '<td>' + item.id + '</td>';
                html += '<td>' + item.zona + '</td>';
                html += '<td>' + item.fecha_hora + '</td>';
                html += '<td>' + item.cliente + '</td>';
                html += '<td>' + item.direccion_completa + '</td>';
                html += '<td>' + item.total + '</td>';
                html += '</tr>';
            });
            html += '</tbody>';
            html += '</table>';
            $("#listado_pv_algoritmo").html(html);
            $('#tabla-listado-pv-algoritmo').dataTable({
                "aaSorting": [[0, "asc"]],
                "sScrollX": "100%",
                "sScrollXInner": "200%"
            });
        } else {
            //swal("Mensaje del sistema", resultado , "warning");
        }

    }).fail(function (error) {
        var datosJSON = $.parseJSON(error.responseText);
        //swal("Error", datosJSON.mensaje , "error"); 
    });
}


function seleccion_pedido(id) {
    //pedidos_seleccionados(id);

    array_ids2.push(id);
    marker = "";
    var aux = 0;
    $.each(list_pedidos.datos, function (i, item) {
        if (item.id === id) {
            aux = i;

        }
    });

    //console.log(list_clientes_dir);
    var ide = list_pedidos.datos[aux].id_direccion;
    var direccion = list_pedidos.datos[aux].direccion_completa;
    var latitud = parseFloat(list_pedidos.datos[aux].latitud);
    var longitud = parseFloat(list_pedidos.datos[aux].longitud);

    //console.log(direccion);

    var myLatLng = {lat: latitud, lng: longitud};
    var marker = new google.maps.Marker({
        position: myLatLng,
        //map: mapa,
        map: mapa2,
        title: direccion,
        icon: {
            url: "../images/p_cliente.png",
            scaledSize: new google.maps.Size(30, 30) // scaled size
        },
        draggable: false
    });

    //marker.setMap(mapa);
    marker.setMap(mapa2);
    //arr_markers.push(marker);
    actualizar_array2(marker, id);




}
function pedidos_seleccionados(id, param) {

    if (param === 1) {
        var aux = 0;
        $.each(list_pedidos.datos, function (i, item) {
            if (item.id === id) {
                aux = i;
            }
        });

        var ide = list_pedidos.datos[aux].id;
        var cliente = list_pedidos.datos[aux].cliente;
        var direccion = list_pedidos.datos[aux].direccion_completa;

        var fila = "<tr>" +
                "<td>" + ide + "</td>" +
                "<td>" + cliente + "</td>" +
                "<td>" + direccion + "</td>" +
                "</tr>";


        array_pedidos.push({id: id, fila: fila});

    } else
    {

        var sw = 0;
        var pos = 0;
        for (var i = 0; i < array_pedidos.length; i++) {
            if (id === array_pedidos[i].id) {
                sw = 1;
                pos = i;

            }
        }
        if (sw === 1) {
            console.log("elemento a eliminar");
            array_pedidos.splice(pos, 1);
        } else {
            console.log("elemento a agregar");
            var aux = 0;
            $.each(list_pedidos.datos, function (i, item) {
                if (item.id === id) {
                    aux = i;
                }
            });

            var ide = list_pedidos.datos[aux].id;
            var cliente = list_pedidos.datos[aux].cliente;
            var direccion = list_pedidos.datos[aux].direccion_completa;

            var fila = "<tr>" +
                    "<td>" + ide + "</td>" +
                    "<td>" + cliente + "</td>" +
                    "<td>" + direccion + "</td>" +
                    "</tr>";


            array_pedidos.push({id: id, fila: fila});
        }

    }
    var array = [];
    console.log(array_pedidos);
    for (var i = 0; i < array_pedidos.length; i++) {
        array.push(array_pedidos[i].fila);
    }
    array_ides_pedidos = array;
    $("#data_pedidos").empty();
    $("#data_pedidos").append(array);



}
function actualizar_array2(marker, id) {
    var sw = 0;
    var pos = 0;
    for (var i = 0; i < arr_markers2.length; i++) {
        if (arr_markers2[i].position.lat() === marker.position.lat() && arr_markers2[i].position.lng() === marker.position.lng()) {
            sw = 1;
            pos = i;

        }
    }
    if (sw === 1) {
        console.log(pos);
        arr_markers2.splice(pos, 1);
        pedidos_seleccionados(id, 2);
    } else
    {
        
        console.log("agregar");
        console.log(pos);
        arr_markers2.push(marker);
        //console.log(arr_markers2);
        pedidos_seleccionados(id, 1);
    }


}
