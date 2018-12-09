$(document).ready(function () {
    listar_vehiculos_choferes_activos();
});


function listar_vehiculos_choferes_activos() {


    $.post
            (
                    "../controller/Vehiculo.chofer.lista.activos.controller.php"

                    ).done(function (resultado) {

        //console.log(resultado);
        var datosJSON = resultado;
        list_vehiculos = resultado;
        // alert(resultado);

        if (datosJSON.estado === 200) {
            var html = "";

//            html += '<small>';
            html += '<table id="tbl_vc" class="table table-striped table-bordered bulk_action" style="width:100%">';
            html += '<thead>';
            html += '<tr style="background-color: #ededed">';
            html += '<th style="text-align: center">SELEC.</th>';
            html += '<th>UNIDAD</th>';
            html += '<th>CHOFER</th>';
            html += '</tr>';
            html += '</thead>';
            html += '<tbody>';

            //Detalle
            $.each(datosJSON.datos, function (i, item) {

                html += '<tr>';
                html += '<td align="center">';
                html += '<a  onmouseover="" style="cursor: pointer;" title="Asignar vehículo a la ruta" onclick="vehiculo_chofer('+ item.id +')"><img src="../images/enviar.png" style="width:1.5em" ></a>';
                html += '</td>';
                html += '<td>' + item.unidad + '</td>';
                html += '<td>' + item.chofer + '</td>';              
                html += '</tr>';
            });
            html += '</tbody>';
            html += '</table>';
                        
            $("#listado_vehiculos_choferes_activos").html(html);
            $('#tbl_vc').DataTable({
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

function vehiculo_chofer(id){
    var aux=0;
   // alert(id);
    
     $.each(list_vehiculos.datos, function (i, item) {
        if (item.id === id) {
            aux = i;

        }
    });
     var unidad = list_vehiculos.datos[aux].unidad;
     var chofer = list_vehiculos.datos[aux].chofer;
    
    var contentString = '<b>Unidad:</b>'+unidad+'<br>\n\
                         <b>Chofer:</b>'+chofer+' ';
    
    var myLatLng = {lat: -6.78045319652979, lng: -79.83708406994054};    
    var marker = new google.maps.Marker({
        position: myLatLng,
        map: mapa2,
        //title: direccion,
        icon: {
            url: "../images/vehiculo.png",
            scaledSize: new google.maps.Size(30, 30) // scaled size
        },
        draggable: true
    });
    
    marker.addListener('click', function() {
          infowindow.open(map, marker);
        });
        
         var infowindow = new google.maps.InfoWindow({
          content: contentString
        });

    marker.setMap(mapa2);
    
    //mostrar dato seleccionado en wizard
    $("#id_vehiculo_chofer").val(id);
    $("#datos_vehiculo").val(unidad);
    $("#datos_chofer").val(chofer);
    $("#btn_vc_activos_cerrar").click();
    //arr_markers.push(marker);
    
}