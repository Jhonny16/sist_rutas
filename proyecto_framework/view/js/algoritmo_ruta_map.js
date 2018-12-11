var mapa;
var arr_markers = [];
var infowindow;
var data_all = [];

function init_mapa() {
    mapa = new google.maps.Map(document.getElementById('mapa_optimo'), {
        center: {lat: -5.1817117, lng: -80.6725207},
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
    var position_inicio = {lat: -5.1851762, lng: -80.6492977};
    var marker1 = new google.maps.Marker({
        position: position_inicio,
        //map: mapa,
        map: mapa,
        title: 'Av. Sanchez Cerro (lateral) 252, Piura',
        icon: {
            url: "../images/p_inicio.png",
            scaledSize: new google.maps.Size(35, 35) // scaled size
        }
    });
    google.maps.event.addListener(marker1, 'click', function () {
        infowindow.setContent('Av. Sanchez Cerro (lateral) 252, Piura');
        infowindow.open(mapa, marker1);
    });


    //MARKER PUNTO DE LLEGADA
    var position_inicio = {lat: -5.1851637, lng: -80.6469828};
    var marker2 = new google.maps.Marker({
        position: position_inicio,
        //map: mapa,
        map: mapa,
        title: 'Av. Sanchez Cerro (lateral) 252, Piura',
        icon: {
            url: "../images/p_final.png",
            scaledSize: new google.maps.Size(35, 35) // scaled size
        }
    });

    google.maps.event.addListener(marker2, 'click', function () {
        infowindow.setContent('Av. Sanchez Cerro (lateral) 252, Piura');
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
        map: mapa,
        icon: {
            url: "../images/marker_cliente.png",
            scaledSize: new google.maps.Size(29, 29) // scaled size


        }
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
var ubicacion_carro = "";
function myTimer() {
    var data = [];
    data = data_all;
    //console.log(data);

//     if (data.length > 1) {
//         console.log(cont);
//         if (data.length === step) {
//             alert("Ruta terminada");
//             clearInterval(myVar);
//         } else {
//             if (data[step].steps.length === cont) {
//                 step++;
//                 cont = 0;
//             }
//             var postion_step = data[step].steps[cont].start_location;
//             //console.log(postion_step);
//             carro.setMap(null);
// //    var d = new Date();
// //    var a = d.toLocaleTimeString();
//
//             carro = new google.maps.Marker({
//                 position: postion_step,
//                 map: mapa,
//                 //title: direccion,
//                 icon: {
//                     url: "../images/vehiculo.png",
//                     scaledSize: new google.maps.Size(20, 20) // scaled size
//                 },
//                 //draggable: true
//             });
//
//             carro.setMap(mapa);
//             cont++;
//
//         }
//
//
//     }
    if (data.length > 1) {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                geocoder = new google.maps.Geocoder();
                geocoder.geocode({'latLng': pos}, function(results, status) {
                    if (status == 'OK') {
                        //console.log(results[0]);
                        mapa.setCenter(results[0].geometry.location);
                        ubicacion_carro =  results[0].formatted_address;
                        carro = new google.maps.Marker({
                            //position: postion_step,
                            position: pos,
                            map: mapa,
                            title: contentString + '' + results[0].formatted_address,
                            icon: {
                                url: "../images/vehiculo.png",
                                scaledSize: new google.maps.Size(20, 20) // scaled size
                            },

                            //draggable: true
                        });
                        console.log("move");
                        //carro.setMap(mapa);


                    } else {
                        alert('Geocode was not successful for the following reason: ' + status);
                    }
                });


                //console.log(carro);

                //
                // var geocoder = new google.maps.Geocoder();
                // // le asignamos una funcion al eventos dragend del marcado;
                // google.maps.event.addListener(carro, 'dragend', function() {
                //     geocoder.geocode({'latLng': pos}, function(results, status) {
                //         console.log("ento1");
                //         if (status == google.maps.GeocoderStatus.OK) {
                //             var address=results[0]['formatted_address'];
                //             console.log(address);
                //
                //             //alert(address);
                //         }
                //     });
                // });

            }, function () {
                handleLocationError(true, infoWindow, map.getCenter());
            });
        } else {
            handleLocationError(false, infoWindow, map.getCenter());
        }

        function handleLocationError(browserHasGeolocation, infoWindow, pos) {
            infoWindow.setPosition(pos);
            infoWindow.setContent(browserHasGeolocation ?
                'Error: The Geolocation service failed.' :
                'Error: Your browser doesn\'t support geolocation.');
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

