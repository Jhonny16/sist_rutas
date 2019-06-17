


function ver_rutas(lat1, lng1, lat2, lng2) {
    console.log("ver rutas");
    $("#lista_rutas").empty();

    if (lat1 === 1) {
        var inicio = array_trayectorias[0].nodo_inicio_valor;

    } else {
        var inicio = {lat: lat1, lng: lng1};
    }

    if (lat2 === 2) {
        var fin = array_trayectorias[0].nodo_final_valor;
    } else {
        var fin = {lat: lat2, lng: lng2};
    }

    var directionsService = new google.maps.DirectionsService;
    var directionsDisplay = new google.maps.DirectionsRenderer({
        //map: map,
        panel: document.getElementById('lista_rutas')
    });


    directionsDisplay.addListener('directions_changed', function () {
        computeTotalDistance_two(directionsDisplay.getDirections());
    });

    calculateAndDisplayRoute_two(directionsService, directionsDisplay, inicio, fin);

}

function calculateAndDisplayRoute_two(directionsService, directionsDisplay, inicio, fin) {

    console.log(inicio);
    console.log(fin);

    directionsService.route({
        origin: inicio,
        destination: fin,
        travelMode: 'DRIVING',
        avoidTolls: true,
        provideRouteAlternatives: true

    }, function (response, status) {
        //console.log(status);
        if (status === 'OK') {
            directionsDisplay.setDirections(response);
            
        } else {
            window.alert('Directions request failed due to ' + status);
        }
    });
}

function computeTotalDistance_two(result) {
    var total = 0;
    var myroute = result.routes[0];
    for (var i = 0; i < myroute.legs.length; i++) {
        total += myroute.legs[i].distance.value;
    }
    total = total / 1000;
//    document.getElementById('total').innerHTML = total + ' km';
}



function limpiar_mapa() {
    arr_markers.forEach(function (marker) {
        marker.setMap(null);
    });
    inicio_mapa();
    arr_markers = [];

    for (var i = 0; i < array_ids.length; i++) {
        var id = array_ids[i];
        $("#id" + id + "").removeAttr('checked');
    }


}

//VER TRAFICO O NO
$('#chb_trafico').on('ifChecked', function (event) {
     trafico = new google.maps.TrafficLayer();
     //trafico.setMap(mapa);
     trafico.setMap(mapa);
});
$('#chb_trafico').on('ifUnchecked', function (event) {
     trafico.setMap(null);
});


