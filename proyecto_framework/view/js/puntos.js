var tipo;
var direccion_inicio = "";
var direccion_fin = "";
var trafico;
var id_punto_inicio=0;
var id_punto_llegada=0;
$(document).ready(function () {
    punto_partida();
    punto_llegada();
});



function punto_partida() {
    $.post
            (
                    "../controller/Puntos.cargar.controller.php", {
                        p_tipo: 'i'
                    }

            ).done(function (resultado) {
        var datosJSON = resultado;
        if (datosJSON.estado === 200) {

            var html = "";
            html += '<table id="tbl_punto_partida" class="table table-striped table-bordered bulk_action" style="width:100%">';
            html += '<thead>';
            html += '<tr style="background-color: #ededed">';
            html += '<th style="text-align: center">SELECCIONAR</th>';
            html += '<th id="direccion">DIRECCIÓN</th>';
            html += '</tr>';
            html += '</thead>';
            html += '<tbody>';
            $.each(datosJSON.datos, function (i, item) {

                direccion_inicio = item.direccion;
                html += '<tr>';
                html += '<td align="center">';
                html += '<a  onmouseover="" style="cursor: pointer;" title="Asigna punto de partida" onclick="asignar_punto_partida('+item.id+',' + item.latitud + ',' + item.longitud + ')"><img src="../images/enviar.png" style="width:1.5em" ></a>';
                html += '</td>';
                html += '<td >' + item.direccion + '</td>';
                html += '</tr>';
            });
            html += '</tbody>';
            html += '</table>';
            $("#lst_punto_partida").html(html);
            $('#tbl_punto_partida').DataTable({
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

function punto_llegada() {
    $.post
            (
                    "../controller/Puntos.cargar.controller.php", {
                        p_tipo: 'f'
                    }

            ).done(function (resultado) {
        var datosJSON = resultado;
        if (datosJSON.estado === 200) {
            var html = "";
            html += '<table id="tbl_punto_llegada" class="table table-striped table-bordered bulk_action" style="width:100%">';
            html += '<thead>';
            html += '<tr style="background-color: #ededed">';
            html += '<th style="text-align: center">SLECCIONAR</th>';
            html += '<th id="direccion">DIRECCIÓN</th>';
            html += '</tr>';
            html += '</thead>';
            html += '<tbody>';
            $.each(datosJSON.datos, function (i, item) {
                direccion_fin = item.direccion;
                html += '<tr>';
                html += '<td align="center">';
                html += '<a  onmouseover="" style="cursor: pointer;" title="Asigna punto de llegada" onclick="asignar_punto_llegada('+item.id+',' + item.latitud + ',' + item.longitud + ')"><img src="../images/enviar.png" style="width:1.5em" ></a>';
                html += '</td>';
                html += '<td >' + item.direccion + '</td>';
                html += '</tr>';
            });
            html += '</tbody>';
            html += '</table>';
            $("#lst_punto_llegada").html(html);
            $('#tbl_punto_llegada').DataTable({
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


function asignar_punto_partida(id, latitud, longitud) {
    id_punto_inicio = id;
    var myLatLng = {lat: latitud, lng: longitud};
//    var image = {
//    url: '../images/p_inicio.png',
//    // This marker is 20 pixels wide by 32 pixels high.
//    size: new google.maps.Size(20, 32),
//    // The origin for this image is (0, 0).
//    origin: new google.maps.Point(0, 0),
//    // The anchor for this image is the base of the flagpole at (0, 32).
//    anchor: new google.maps.Point(0, 32)
//  };
    var marker = new google.maps.Marker({
        position: myLatLng,
        //map: mapa,
        map: mapa2,
        title: direccion_inicio,
        icon: {
            url: "../images/p_inicio.png",
            scaledSize: new google.maps.Size(30, 30) // scaled size                     
        }
    });
    
    
  

    //marker.setMap(mapa);
    marker.setMap(mapa2);
    //arr_markers.push(marker);
    arr_markers2.push(marker);
    $("#btn_cerrar_p_partida").click();
    
    //mostrar dato seleccionado en wizard
    $("#datos_punto_partida").val(direccion_inicio);

//      var trafficLayer = new google.maps.TrafficLayer();
//      trafficLayer.setMap(mapa);

//    markers.push(marker);
    //markers.push(marker);


}

function asignar_punto_llegada(id,latitud, longitud) {
    // console.log(latitud);
    id_punto_llegada = id;
    var myLatLng = {lat: latitud, lng: longitud};
    var marker = new google.maps.Marker({
        position: myLatLng,
        //map: mapa,
        map: mapa2,
        title: direccion_fin,
        icon: {
            url: "../images/p_final.png",
            scaledSize: new google.maps.Size(30, 30) // scaled size


        }
    });
     //mostrar dato seleccionado en wizard
    $("#datos_punto_llegada").val(direccion_fin);
    //marker.setMap(mapa);
    marker.setMap(mapa2);
    //arr_markers.push(marker);
    arr_markers2.push(marker);

    $("#btn_cerrar_p_llegada").click();

}


