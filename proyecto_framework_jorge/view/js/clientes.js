var direccion = "";
var cliente;
var id_cliente = 0;
var ide;
var list_cliente;
var list_clientes_dir;
var sw = 0;
var id_direccion;
var array_ids = []
var array_ids2 = [];

$(document).ready(function () {
    listar_clientes_direcciones();
    direcciones_clientes();//Direcciones de clientes para ubicarlos y generar la ruta
//    dbl_direccion();
});



function listar_clientes_direcciones() {


    $.post
            (
                    "../controller/Persona.cliente.listar.controller.php"

                    ).done(function (resultado) {

        //console.log(resultado);
        var datosJSON = resultado;
        list_cliente = resultado;
        // alert(resultado);

        if (datosJSON.estado === 200) {
            var html = "";

//            html += '<small>';
            html += '<table id="tbl_direcciones" class="table table-striped table-bordered bulk_action" style="width:100%">';
            html += '<thead>';
            html += '<tr style="background-color: #ededed">';
            html += '<th style="text-align: center">Buscar</th>';
            html += '<th>Cliente</th>';
            html += '<th id="direccion">Dirección</th>';
            html += '<th>Tipo</th>';
            html += '</tr>';
            html += '</thead>';
            html += '<tbody>';

            //Detalle
            $.each(datosJSON.datos, function (i, item) {
                //html += '<tr>';
                id_cliente = item.id;
                cliente = item.nc;
                direccion = "";


                html += '<tr>';
                html += '<td align="center">';

                html += '<a  onmouseover="" style="cursor: pointer;" title="Empezar busqueda desde mapa" onclick="empezar_busqueda(' + item.id + ',' + item.id_direccion + ')"><img src="../images/enviar.png" style="width:1.5em" ></a>';
                html += '</td>';
                html += '<td id="txt_cliente">' + item.nc + '</td>';
                html += '<td style="color:#d90a0a"  id="direccion_completa' + item.id + '" ondblclick="dbl_direccion(' + item.id + ')">' + item.direccion + '</td>';
                if (item.tipo_cliente === "p") {
                    html += '<td style="text-align:center"><img src="../images/persona.png" style="width:1.5em"></td>';

                } else {
                    html += '<td style="text-align:center"><img src="../images/empresa.png" style="width:1.5em"></td>';

                }
                html += '</tr>';
            });

            html += '</tbody>';
            html += '</table>';
//            html += '</small>';

            $("#listado_clientes").html(html);
            $('#tbl_direcciones').DataTable({
//                "sScrollX": "100%",
//                "sScrollXInner": "100%",
//                "bScrollCollapse": true,
                "bPaginate": true
            });



        } else {
            swal("Mensaje del sistema", resultado, "warning");
        }

    }).fail(function (error) {
        var datosJSON = $.parseJSON(error.responseText);
        //swal("Error", datosJSON.mensaje , "error"); 
    });
}



function dbl_direccion(id) {
    //console
    //.log(id);
    var pos = 0;
    if (id !== 0) {
        $.each(list_cliente.datos, function (i, item) {
            if (item.id === id) {
                pos = i + 1;
            }
        });

        //console.log("###");
        var valor = $("#direccion_completa" + id + "").html();
//    var valor = $(this).html();
        //console.log(valor);
        if (valor.substring(0, 6) === "<input") {
            return 0;
            //alert("no puede ser");
        }

        $("#direccion_completa" + id + "").empty().append('<input type="text" id="txtactualizar' + id + '" class="form-control" value = "' + valor + '" onkeypress="pasar_id(' + id + ',event, ' + pos + ' )"/>');
        $("#txtactualizar" + id + "").focus();
    }


}

function pasar_id(ide, evento, pos) {
    sw = 1;

    if (evento.which === 13) {
        console.log("posicion: " + pos);
        var valor = $("#txtactualizar" + ide + "").val();
        console.log(valor);
        console.log(ide);
        //$("#txtactualizar"+id+"").parents().find("td").eq(2).empty().append(valor);
        var parent = $("#tbl_direcciones").find("tr").eq(pos).find("td").eq(2).empty().append(valor);
        console.log(parent);
        $("#direccion").html("Dirección Actualizada");
        direccion = "";
        direccion = valor;
        console.log(valor);
//        calcularTotales();
    } else {
        //return validarNumeros(evento);
    }
}


function empezar_busqueda(id_client, id_dir) {
    var aux = 0;
    $.each(list_cliente.datos, function (i, item) {
        if (item.id === id_client) {
            aux = i;

        }

    });

    // console.log(aux);

    if (sw === 0) {
        direccion = list_cliente.datos[aux].direccion;
    }

    //direccion= list_cliente.datos[aux].direccion;
    cliente = list_cliente.datos[aux].nc;
    id_cliente = id_client;
    id_direccion = list_cliente.datos[aux].id_direccion;



    var nueva_direccion = $("#txt_nueva_direccion").val();
//    if (nueva_direccion === "") {
//        $("#pac-input").val(direccion);
//    }
    $("#pac-input").val("");
    $("#pac-input").val(direccion);
    $("#btn_cerrar").click();
    $("#pac-input").click();

    //$("#txt_nueva_direccion").val(direccion);
    $("#txt_nombre_cliente").val(cliente);
    $("#btn_cli_cerrar").click();
}


//LISTA DE CLIENTES CON DIRECCIONES ACTUALIZADAS


function direcciones_clientes() {
    $.post
            (
                    "../controller/Persona.cliente.direcciones.controller.php"

                    ).done(function (resultado) {

        //console.log(resultado);
        var datosJSON = resultado;
        list_clientes_dir = "";
        list_clientes_dir = resultado;
        // alert(resultado);

        if (datosJSON.estado === 200) {
            var html = "";

//            html += '<small>';
            html += '<table id="tbl_cli_direcciones" class="table table-striped table-bordered bulk_action" style="width:100%">';
            html += '<thead>';
            html += '<tr style="background-color: #ededed">';
            html += '<th style="text-align: center">Seleccionar</th>';
            html += '<th>Cliente</th>';
            html += '<th>Dirección</th>';
            html += '</tr>';
            html += '</thead>';
            html += '<tbody>';

            //Detalle
            $.each(datosJSON.datos, function (i, item) {

                html += '<tr>';
                html += '<td align="center">';
                html += '<input type="checkbox" id="id' + item.id + '" onclick="seleccion2(' + item.id + ')">';
                html += '</td>';
                html += '<td id="">' + item.cliente + '</td>';
                html += '<td style="color:#2a85a0" >' + item.direccion_completa + '</td>';
                html += '</tr>';
            });

            html += '</tbody>';
            html += '</table>';
//            html += '</small>';

            $("#listado_clientes_direcciones").html(html);
            $('#tbl_cli_direcciones').DataTable({
//                "sScrollX": "100%",
//                "sScrollXInner": "100%",
//                "bScrollCollapse": true,
                "bPaginate": true
            });



        } else {
            swal("Mensaje del sistema", resultado, "warning");
        }

    }).fail(function (error) {
        var datosJSON = $.parseJSON(error.responseText);
        //swal("Error", datosJSON.mensaje , "error"); 
    });


}

function seleccion(id) {

    array_ids2.push(id);
    marker = "";
    if (arr_markers.length < 2) {
        swal("Mensaje", "Debe asignar el punto de Partida y LLegada", "warning");
        $("#btn_cli_cerrar").click();
        $("#id" + id + "").click();
        arr_markers2 = [];
    } else {
        var aux = 0;
        $.each(list_clientes_dir.datos, function (i, item) {
            if (item.id === id) {
                aux = i;

            }
        });

        console.log(list_clientes_dir);
        var ide = list_clientes_dir.datos[aux].id_direccion;
        var direccion = list_clientes_dir.datos[aux].direccion_completa;
        var latitud = parseFloat(list_clientes_dir.datos[aux].latitud);
        var longitud = parseFloat(list_clientes_dir.datos[aux].longitud);

        console.log(direccion);

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
            draggable: false,
        });

        //marker.setMap(mapa);
        marker.setMap(mapa2);
        //arr_markers.push(marker);
        arr_markers2.push(marker);

    }

}


function seleccion2(id) {

    array_ids2.push(id);
    marker = "";
    var aux = 0;
    $.each(list_clientes_dir.datos, function (i, item) {
        if (item.id === id) {
            aux = i;

        }
    });

    //console.log(list_clientes_dir);
    var ide = list_clientes_dir.datos[aux].id_direccion;
    var direccion = list_clientes_dir.datos[aux].direccion_completa;
    var latitud = parseFloat(list_clientes_dir.datos[aux].latitud);
    var longitud = parseFloat(list_clientes_dir.datos[aux].longitud);

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
        draggable: false,
    });

    //marker.setMap(mapa);
    marker.setMap(mapa2);
    //arr_markers.push(marker);
    arr_markers2.push(marker);



}
