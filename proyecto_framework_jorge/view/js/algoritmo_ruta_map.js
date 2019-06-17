var mapa;
var arr_markers = [];
var infowindow;
var data_all = [];

function init_mapa_cli() {
    mapa = new google.maps.Map(document.getElementById('mapa_optimo'), {
        center: {lat: -6.781555, lng: -79.8840602},
        zoom: 13,
        mapTypeId: 'roadmap'
    });

    infowindow = new google.maps.InfoWindow();


}

function mostrando_ruta() {
    console.log("dibujando ruta");


    var directionsService = new google.maps.DirectionsService;
    var directionsDisplay = new google.maps.DirectionsRenderer({
        //draggable: true, //Arrastrable
        suppressMarkers: true,
        map: mapa,
        //panel: document.getElementById('lista_distancias')
    });

    var stepDisplay = new google.maps.InfoWindow;

    directionsDisplay.addListener('directions_changed', function () {
        computeTotalDistance(directionsDisplay.getDirections());
    });
    // directionsDisplay.setMap(mapita);
    //console.log()
    calculateAndDisplayRoute(directionsService, directionsDisplay, array_mark);

}

function calculateAndDisplayRoute(directionsService, directionsDisplay, array_markers) {

    var array_direcciones = [];
    var inicio = array_markers[0];
    var fin = array_markers[1];

    //MARKER PUNTO DE INICIO
    var position_inicio = {lat: -6.78045319652979, lng: -79.83708406994054};
    var marker1 = new google.maps.Marker({
        position: position_inicio,
        //map: mapa,
        map: mapa,
        title: 'Los Tumbos 518, Chiclayo',
        icon: {
            url: "../images/p_inicio.png",
            scaledSize: new google.maps.Size(30, 30) // scaled size                     
        }
    });
    google.maps.event.addListener(marker1, 'click', function () {
        infowindow.setContent('Los Tumbos 518, Chiclayo');
        infowindow.open(mapa, marker1);
    });


    //MARKER PUNTO DE LLEGADA
    var position_inicio = {lat: -6.784408407419345, lng: -79.83675938650816};
    var marker2 = new google.maps.Marker({
        position: position_inicio,
        //map: mapa,
        map: mapa,
        title: 'Avenida la Libertad 853, Chiclayo',
        icon: {
            url: "../images/p_final.png",
            scaledSize: new google.maps.Size(30, 30) // scaled size


        }
    });
    google.maps.event.addListener(marker2, 'click', function () {
        infowindow.setContent('Avenida la Libertad 853, Chiclayo');
        infowindow.open(mapa, marker2);
    });



    for (var i = 2; i < array_markers.length; i++) {
        array_direcciones.push({location: array_markers[i].posicion});
        console.log("markers");
        console.log(array_markers[i].titulo);
        var lat = array_markers[i].posicion.lat;
        var lng = array_markers[i].posicion.lng;
        var pos = new google.maps.LatLng(lat, lng);
        createMarker(pos, array_markers[i].titulo);
    }
    console.log(array_direcciones);
//
//    arr_markers.forEach(function (marker) {
//        marker.setMap(null);
//    });

    // createMarker(start, 'start');
    // createMarker(end, 'end');


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
            console.log(response);
            data_all = response.routes[0].legs;
            // dibujar_carro(data);

        } else {
            window.alert('Directions request failed due to ' + status);
        }
    });



}
function createMarkerInicio(latlng, title) {

    var marker = new google.maps.Marker({
        position: latlng,
        title: title,
        map: mapa,

    });

    google.maps.event.addListener(marker, 'click', function () {
        infowindow.setContent(latlng);
        infowindow.open(mapa, marker);
    });
}

function createMarker(latlng, title) {

    var marker = new google.maps.Marker({
        position: latlng,
        title: title,
        map: mapa
    });

    google.maps.event.addListener(marker, 'click', function () {
        infowindow.setContent(title);
        infowindow.open(mapa, marker);
    });
}

function computeTotalDistance(result) {
    var total = 0;
    var myroute = result.routes[0];
    for (var i = 0; i < myroute.legs.length; i++) {
        total += myroute.legs[i].distance.value;
    }
    total = total / 1000;
    //document.getElementById('total').innerHTML = total + ' km';
}


var myVar = setInterval(myTimer, 10000);
var step = 0;
var cont = 0;
function myTimer() {
    //cont++;
    
    var data = [];
    data = data_all;
    console.log(data);

    if (data.length > 1) {
        console.log(cont);
        if (data.length === step) {
            alert("Ruta terminada");
            clearInterval(myVar);
        } else {
            if (data[step].steps.length === cont) {
                step++;
                cont = 0;
            }
            var postion_step = data[step].steps[cont].start_location;

            //console.log(postion_step);
            carro.setMap(null);
//    var d = new Date();
//    var a = d.toLocaleTimeString();

            carro = new google.maps.Marker({
                position: postion_step,
                map: mapa,
                //title: direccion,
                icon: {
                    url: "../images/vehiculo.png",
                    scaledSize: new google.maps.Size(20, 20) // scaled size
                },
                //draggable: true
            });

            carro.setMap(mapa);
            cont++;

        }


    }





}

//var myVar = setInterval(myTimer ,1000);
//function myTimer() {
//    var d = new Date();
//    var a = d.toLocaleTimeString();
//   // console.log(a);
//    
//    //document.getElementById("demo").innerHTML = d.toLocaleTimeString();
//}



//function limpiar_mapa() {
//    arr_markers.forEach(function (marker) {
//        marker.setMap(null);
//    });
//    inicio_mapa();
//    arr_markers = [];
//
//    for (var i = 0; i < array_ids.length; i++) {
//        var id = array_ids[i];
//        $("#id" + id + "").removeAttr('checked');
//    }
//
//
//}

