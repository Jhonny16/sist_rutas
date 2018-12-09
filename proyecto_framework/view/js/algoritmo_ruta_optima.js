var respuesta;
var ar = [];



function ruta_optima(arreglo_all_markers) {


    ar = arreglo_all_markers;
    var directionsService = new google.maps.DirectionsService;
    var directionsDisplay = new google.maps.DirectionsRenderer({
        map: mapa2,
        //panel: document.getElementById('lista_distancias')
    });

    directionsDisplay.addListener('directions_changed', function () {
        computeTotalDistance2(directionsDisplay.getDirections());
    });

    calculateAndDisplayRoute2(directionsService, directionsDisplay, arreglo_all_markers);


}
function calculateAndDisplayRoute2(directionsService, directionsDisplay, array_markers) {
    response = "";
    var array_direcciones = [];
    var inicio = array_markers[0].title;
    var fin = array_markers[1].title;

    for (var i = 2; i < array_markers.length; i++) {
        array_direcciones.push({location: array_markers[i].position});
    }

    ar.forEach(function (marker) {
        marker.setMap(null);
    });


    directionsService.route({
        origin: inicio,
        destination: fin,
        //waypoints: [{location: item2}, {location: item3}],
        waypoints: array_direcciones,
        travelMode: 'DRIVING',
        optimizeWaypoints: true,
        avoidTolls: true,
        provideRouteAlternatives: true,
        drivingOptions: {
            departureTime: new Date(Date.now() + 10),  // for the time N milliseconds from now.
            // trafficModel: 'pessimistic'
            // trafficModel: 'bestguess'
            trafficModel: 'optimistic'
        }
//https://developers.google.com/maps/documentation/javascript/directions?hl=es-419#TravelModes
    }, function (response, status) {
        //console.log("ruta_optima");
        //console.log(response);

        if (status === 'OK') {
            directionsDisplay.setDirections(response);
            console.log(response);
            respuesta = response;
            points_optimaze(response);
            console.log(respuesta);
            //return response.routes[0].legs;

        } else {
            window.alert('Directions request failed due to ' + status);
        }
    });
    //return respuesta;

}

function computeTotalDistance2(result) {
    var total = 0;
    var myroute = result.routes[0];
    for (var i = 0; i < myroute.legs.length; i++) {
        total += myroute.legs[i].distance.value;
    }
    total = total / 1000;
    //console.log(total);
    //document.getElementById('total').innerHTML = total + ' km';
}


