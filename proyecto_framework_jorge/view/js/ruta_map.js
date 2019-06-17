var inicio;
var fin;
var item2;
var item3;
var mapita;

var cliente_latitud;
var cliente_longitud;


var mapa;
var arr_markers = [];


function inicio_mapa() {


    var m;
    mapa = new google.maps.Map(document.getElementById('map'), {
        center: {lat: -6.781555, lng: -79.8840602},
        zoom: 13,
        mapTypeId: 'roadmap'
    });
    // Create the search box and link it to the UI element.
    mapita = mapa;
    
    
 
}

function generar_ruta() {
//      var directionsService = new google.maps.DirectionsService;
//        var directionsDisplay = new google.maps.DirectionsRenderer;
//        directionsDisplay.setMap(mapita);
//        //console.log()
//        calculateAndDisplayRoute(directionsService, directionsDisplay, inicio, fin);              
    var directionsService = new google.maps.DirectionsService;
    var directionsDisplay = new google.maps.DirectionsRenderer({
        //draggable: true, //Arrastrable
        map: mapita,
        panel: document.getElementById('lista_distancias')
    });

    var stepDisplay = new google.maps.InfoWindow;

    directionsDisplay.addListener('directions_changed', function () {
        computeTotalDistance(directionsDisplay.getDirections());
    });
    // directionsDisplay.setMap(mapita);
    //console.log()
    calculateAndDisplayRoute(directionsService, directionsDisplay, arr_markers);

}

function calculateAndDisplayRoute(directionsService, directionsDisplay, array_markers) {

    var array_direcciones = [];
    var inicio = array_markers[0].title;
    var fin = array_markers[1].title;

    for (var i = 2; i < array_markers.length; i++) {
        array_direcciones.push({location: array_markers[i].position});
    }

    arr_markers.forEach(function (marker) {
        marker.setMap(null);
    });

//    console.log(inicio.lat());
//    console.log(inicio.lng());
//    console.log(fin);
//    console.log(array_direcciones);

    directionsService.route({
        origin: inicio,
        destination: fin,
        //waypoints: [{location: item2}, {location: item3}],
        waypoints: array_direcciones,
        travelMode: 'DRIVING',
        optimizeWaypoints: true,
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

function computeTotalDistance(result) {
    var total = 0;
    var myroute = result.routes[0];
    for (var i = 0; i < myroute.legs.length; i++) {
        total += myroute.legs[i].distance.value;
    }
    total = total / 1000;
    document.getElementById('total').innerHTML = total + ' km';
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