var inicio2;
var fin2;
var mapita2;
var mapita3;
var mapa2;
var arr_markers2 = [];
var array_datos = [];
var contador = 1;
var nodos_enlaces = [];
var nodos = [];
var array_all_nodos = [];
var arreglo_rutas;
var position_A = 0;
var bandera = 0;
var inicializar = 0;
var puntos_optimos;
var route_optimal = [];
var directionsService;
var directionsDisplay;
var validate = false;
var cont;
var int = '';
var array_vertices = [];
function inicio_mapa2() {

    mapa2 = new google.maps.Map(document.getElementById('map'), {
        center: {lat: -6.781555, lng: -79.8840602},
        zoom: 13,
        mapTypeId: 'roadmap'
    });
    mapita2 = mapa2;
    mapita3 = mapa2;
    mapita4 = mapa2;
}

function generar_ruta() {
    generar();
}
function generar() {
    //Gif carga nodos
    $("#cargando_nodos").attr('style', 'display:block');
    $("#cargando_nodos").empty();
    $("#cargando_nodos").append("<center><img src='../images/cargando.gif' width='70px'></center>");
    //Gif carga rutas
    $("#cargando_rutas").attr('style', 'display:block');
    $("#cargando_rutas").empty();
    $("#cargando_rutas").append("<center><img src='../images/cargando.gif' width='70px'></center>");

    //Proceso
    directionsService = new google.maps.DirectionsService;
    directionsDisplay = new google.maps.DirectionsRenderer({
        map: mapita2,
        panel: document.getElementById('lista_distancias2')
    });
    var inicio = arr_markers2[0].title;
    var fin = arr_markers2[1].title;
    arr_markers2.forEach(function (marker) {
        marker.setMap(null);
    });
    var conti = 0;
    for (var i = 2; i < arr_markers2.length; i++) {


        directionsDisplay.addListener('directions_changed', function () {
            computeTotalDistance(directionsDisplay.getDirections());
        });
        calculateAndDisplayRoute(directionsService, directionsDisplay, inicio, arr_markers2[i].position, null);
        // console.log("inicio");
        conti++;
    }//Calcular distancias del nodo1 con los nodos siguientes excepto el final

    var val = arr_markers2.length - 2;
    if (conti === val) {

        setTimeout(funcAvisa, 5000);
    }



}

function calculateAndDisplayRoute(directionsService, directionsDisplay, inicio, nodo, val) {
    console.log(inicio);
    console.log(nodo);


    directionsService.route({
        origin: inicio,
        destination: nodo,
        travelMode: 'DRIVING',
        avoidTolls: true,
        provideRouteAlternatives: true

    }, function (response, status) {
        console.log(response);
        array_datos.push(response);
        var direcciones = 0;
        var count = 0;
        var nodos = arr_markers2.length - 2;
        direcciones = nodos * (arr_markers2.length - 1);
        console.log("contador: " + contador);
        console.log("num direcciones: " + direcciones);

        if (direcciones === contador && val === 1) {
            generar_nodos(array_datos, arr_markers2);
        }
        if (status === 'OK') {
            contador++;
            directionsDisplay.setDirections(response);
            // Me permite generar rutas en el mapa
        } else {
            console.log(status);
            // window.alert('Directions request failed due to ' + status);
        }
    });
}
//var myVar=null;
var myVar = null;
var c = 2;
function funcAvisa() {
    myVar = setInterval(function () {
        inter();
    }, 3000);
}//Calcular distancias de los siguientes nodos entre si, incluyendo el nodo final
//
function inter2() {
    if (c <= 5) {
        c++;
        console.log("probando");
        console.log(c);
    } else {
        clearInterval(myVar);
    }
}
var cont = 0;
function inter() {
    console.log(arr_markers2.length);
    if (c < arr_markers2.length) {
        console.log("c");
        console.log(c);
        var start = arr_markers2[c].position;
        var array = [];
        for (var k = 2; k < arr_markers2.length; k++) {
            if (arr_markers2[c].position !== arr_markers2[k].position) {
                array.push(arr_markers2[k].position);
            }
        }
        array.push(arr_markers2[1].title);
        for (var x = 0; x < array.length; x++) {
            directionsDisplay.addListener('directions_changed', function () {
// computeTotalDistance(directionsDisplay.getDirections());
            });
            calculateAndDisplayRoute(directionsService, directionsDisplay, start, array[x], 1);
        }
        cont++;
        //console.log("intermedios");
        var val = arr_markers2.length - 2;
        if (cont === val) {

            validate = true;
            //generar_nodos(array_datos, arr_markers2);
        }
        c++;
    } else {
        clearInterval(myVar);
    }


}

function computeTotalDistance(result) {
//console.log(result);
    var total = 0;
    var myroute = result.routes[0];
    for (var i = 0; i < myroute.legs.length; i++) {
        total += myroute.legs[i].distance.value; // opciones de rutas -- guardar cada una de ellas
    }
    total = total / 1000;
    //document.getElementById('total').innerHTML = total + ' km';
}

function generar_nodos(array, arr_markers2) {

    console.log(arr_markers2);
    nodos.push({datos: arr_markers2[0].title, nodo: 'A', direccion: arr_markers2[0].title});
    var tamanio = arr_markers2.length;
    var ultimo_nodo = tamanio - 1;
    //console.log(ultimo_nodo);
    ultimo_nodo = alfabeto(ultimo_nodo);
    nodos.push({datos: arr_markers2[1].title, nodo: ultimo_nodo, direccion: arr_markers2[1].title});
    for (var i = 2; i < arr_markers2.length; i++) {
        var value = i - 1;
        var nodo = alfabeto(value);
        nodos.push({datos: arr_markers2[i].position, nodo: nodo, direccion: arr_markers2[i].title});
    }

    console.log(nodos);
    var values = "";
    for (var i = 0; i < nodos.length; i++) {
        if (i === 0) {
            values += '<br><p><span class="inicio">' + nodos[i].nodo + '</span> <i class="fa fa-arrow-right"></i> ' + nodos[i].direccion + '</p>';
        } else {
            if (i === 1) {
                values += ' <p><span class="fin">' + nodos[i].nodo + '</span> <i class="fa fa-arrow-right"></i> ' + nodos[i].direccion + '</p>';
            } else {
                values += '<p> <span class="intermedios">' + nodos[i].nodo + '</span> <i class="fa fa-arrow-right"></i> ' + nodos[i].direccion + '</p>';
            }
        }
    }
    $("#nodos_referencias").html(values);
//    console.log(contador);
//    if(contador === array_datos.length){
//        console.log(array_datos);
//        console.log(array);
//    }
    console.log("array");
    console.log(array);
    array_vertices = array;
    for (var i = 0; i < array.length; i++) {
        var myroute = array[i].routes[0];
        if (array[i].request.origin.query) {
            var nodo_inicio = array[i].request.origin.query;
        } else {
            var nodo_inicio = array[i].request.origin.location;
        }
        if (array[i].request.destination.location) {
            var nodo_fin = array[i].request.destination.location;
        } else {
            var nodo_fin = array[i].request.destination.query;
        }

        for (var j = 0; j < nodos.length; j++) {
            if (nodo_inicio === nodos[j].datos) {
                nodo_inicio = nodos[j].nodo;
            }
            if (nodo_fin === nodos[j].datos) {
                nodo_fin = nodos[j].nodo;
            }

        }

        var duration = myroute.legs[0].duration.value;
        nodos_enlaces.push({nodo_inicio: nodo_inicio, distancia: duration, nodo_fin: nodo_fin});
        array_all_nodos.push({nodo_inicio: nodo_inicio, distancia: duration, nodo_fin: nodo_fin});
    }
    ruta_optima(arr_markers2);
}


function points_optimaze(respuesta) {
    puntos_optimos = respuesta;
    //console.log(respuesta);
    console.log(puntos_optimos);
    if (puntos_optimos === undefined) {
        swal("Nota", " Hubo error en la carga interna del mapa. Recargue la página por favor", "success");
    } else {
        var ultimo = puntos_optimos.geocoded_waypoints.length - 2;
        var antes = 0;
        var num = 0;
        var cantidad = puntos_optimos.geocoded_waypoints.length - 1;
        for (var i = 0; i < cantidad; i++) {//Numero total de puntos incluidos los de inicio y fin

            num = i;
            console.log("i : " + i);
            if (i === 0) {
//console.log("cero");
                var start_point = puntos_optimos.request.origin.query;
                var distancia = puntos_optimos.routes[0].legs[i].duration.value;
                //var end_point = puntos_optimos.request.waypoints[i].location.location;
                var pos = puntos_optimos.routes[0].waypoint_order[i];
                var end_point = puntos_optimos.request.waypoints[pos].location.location;
                // console.log(start_point);
                //console.log(distancia);
                //console.log(end_point);
                for (var j = 0; j < nodos.length; j++) {
                    console.log("nodos");
                    console.log(nodos[j]);
                    if (nodos[j].direccion === start_point) {
                        var start = nodos[j].nodo;
                    }
                    if (nodos[j].datos === end_point) {
                        var end = nodos[j].nodo;
                    }
                }
                route_optimal.push({nodo_inicio: start, distancia: distancia, nodo_fin: end});
                //console.log(route_optimal);

            } else {
                antes = i - 1;
                if (num === ultimo) {
                    var pos1 = puntos_optimos.routes[0].waypoint_order[antes];
                    var start_point = puntos_optimos.request.waypoints[pos1].location.location;
                    var distancia = puntos_optimos.routes[0].legs[i].duration.value;
                    var end_point = puntos_optimos.request.destination.query;
                    for (var j = 0; j < nodos.length; j++) {
                        if (nodos[j].datos === start_point) {
                            start = nodos[j].nodo;
                        }
                        if (nodos[j].direccion === end_point) {
                            end = nodos[j].nodo;
                        }
                    }
                    route_optimal.push({nodo_inicio: start, distancia: distancia, nodo_fin: end});
                } //else
                else {
                    var pos1 = puntos_optimos.routes[0].waypoint_order[antes];
                    var start_point = puntos_optimos.request.waypoints[pos1].location.location;
                    var distancia = puntos_optimos.routes[0].legs[i].duration.value;
                    //console.log(start_point);
                    var pos2 = puntos_optimos.routes[0].waypoint_order[i];
                    var end_point = puntos_optimos.request.waypoints[pos2].location.location;
                    // console.log(end_point);
                    for (var j = 0; j < nodos.length; j++) {
                        if (nodos[j].datos === start_point) {
                            var start = nodos[j].nodo;
                        }
                        if (nodos[j].datos === end_point) {
                            var end = nodos[j].nodo;
                        }
                    }
                    route_optimal.push({nodo_inicio: start, distancia: distancia, nodo_fin: end});
                }

            }
        }
        console.log("ruta optima");
        console.log("validate = " + validate);
        //console.log(route_optimal);

        if (validate === true) {
            nodos_rutas(array_all_nodos, nodos);
        }


    }
}

function alfabeto(pos) {
    var array = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J',
        'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W',
        'X', 'Y', 'Z'];
    var letra = array[pos];
    return letra;
}

function nodos_rutas(array_all_nodos, nodos) {
    arreglo_rutas = [];
    console.log(array_all_nodos);
    var array_aux = [];
//    var array = [];
    var array_temp = [];
    array_temp = nodos_enlaces; //lista de nodos de la tabla
    //console.log(array_temp);
    var nodo_inicio = nodos[0].nodo; //letra del nodo y su direccion
    var nodo_fin = nodos[1].nodo; //letra del nodo y su direccion

    var pos = 0;
//    for (var i = 0; i < array_temp.length; i++) {
//
//        if (array_temp[i].nodo_inicio === nodo_inicio || array_temp[i].nodo_fin === nodo_fin) {
//            pos = i;
//            i = i - 1;
//            array_temp.splice(pos, 1);
//        }
//    }
//    array_aux = array_temp;
//    for (var i = 0; i < array_aux.length; i++) {
//        //console.log("hola");
//        array_all_nodos.push({nodo_inicio: array_aux[i].nodo_fin, distancia: array_aux[i].distancia,
//            nodo_fin: array_aux[i].nodo_inicio});
//    }


    nodos.sort(function (a, b) {
        var nameA = a.nodo.toLowerCase(), nameB = b.nodo.toLowerCase()
        if (nameA < nameB) //sort string ascending
            return -1;
        if (nameA > nameB)
            return 1;
        return 0; //default return value (no sorting)
    });
    array_all_nodos.sort(function (a, b) {
        var nameA = a.nodo_inicio.toLowerCase(), nameB = b.nodo_inicio.toLowerCase();
        if (nameA < nameB) //sort string ascending
            return -1;
        if (nameA > nameB)
            return 1;
        return 0; //default return value (no sorting)
    });
    $("#cargando_nodos").attr('style', 'display:none');

    var html = "";
    html += '<p style="color:#005b91"><strong>LISTA DE NODOS Y DISTANCIAS</strong></p>';
    html += '<p>Nota: Las direcciones son de izquierda a derecha</p>';
    html += '<table id="tbl_list_nodos" class="table">';
    html += '<thead>';
    html += '<tr style="background-color: #ededed; height:25px;">';
    html += '<th>NODO INICIO</th>';
    html += '<th>DISTANCIA(Tiempo)</th>';
    html += '<th>NODO FIN</th>';
    html += '</tr>';
    html += '</thead>';
    html += '<tbody>';
    for (var i = 0; i < array_all_nodos.length; i++) {
        var min = 0;
        min = array_all_nodos[i].distancia / 60;
        html += '<tr>';
        html += '<td>' + array_all_nodos[i].nodo_inicio + '</td>';
        html += '<td>' + array_all_nodos[i].distancia + ' s (' + min.toFixed(0) + ' min)</td>';
        html += '<td>' + array_all_nodos[i].nodo_fin + '</td>';
        html += '</tr>';
    }

    html += '</tbody>';
    html += '</table>';
    $("#div_nodos").html(html);
    mostrar_rutas(nodos);
}


var distancia_total = 0;
function mostrar_rutas(nodos) {
    console.log("nodoooos");
    console.log(nodos);
    var total_rutas = "";
    var num_rutas = 2;
    var contador = 0;
    nodos = nodos.length - 2;
    if (2 === nodos.length) {
        num_rutas = 2;
    } else {
        for (var i = 2; i < nodos; i++) {
            contador = i + 1;
            num_rutas = contador * num_rutas;
        }
    }
    $("#cargando_rutas").attr('style', 'display:none');
    total_rutas += '<p><h4><img src="../images/si.png" style="width:1.5em" >  Se han generado un total de : <b>' + num_rutas + '</b> rutas</h4></p>';
    $("#div_num_rutas").append(total_rutas);
    var sum = 0;
    for (var i = 0; i < route_optimal.length; i++) {
        sum = sum + route_optimal[i].distancia;
    }
    distancia_total = sum;
    var html = "";
    html += '<br>';
    html += '<p><h4><img src="../images/si.png" style="width:1.5em" > La ruta óptima es la siguiente</h4></p>';
    html += '<table class="table">';
    html += '<tbody>';
    for (var i = 0; i < route_optimal.length; i++) {
        html += '<tr>';
        html += '<td> ' + route_optimal[i].nodo_inicio + ' </td>';
        html += '<td> <i class="fa fa-arrow-right"></i> </td>';
        html += '<td> ' + route_optimal[i].nodo_fin + ' </td>';
        html += '<td> = </td>';
        html += '<td> ' + route_optimal[i].distancia + ' segundos</td>';
        html += '</td>';
        html += '</tr>';
    }
    var min_total = 0;
    min_total = sum / 60;
    html += '<tr>';
    html += '<td colspan=4 style="text-align:left">Distancia Total</td>';
    html += '<td>' + sum + ' segundos (' + min_total.toFixed(0) + ' min)</td>';
    html += '</tr>';
    html += '</ttbody>';
    html += '</table>';
    $("#div_opt_rutas").html(html);
}

function guardar_ruta() {

    swal({
        title: "Confirme",
        text: "¿Esta seguro de grabar los datos de la Ruta?",
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
                    var nodos_intermedios = new Array();
                    var recorrido = new Array();
                    nodos_intermedios.splice(0, nodos_intermedios.length);
                    recorrido.splice(0, recorrido.length);
                    var nodo_inicio_letra = nodos[0].nodo;
                    var nodo_inicio_valor = nodos[0].direccion;
                    var ultimo = nodos.pop();
                    var nodo_final_letra = ultimo.nodo;
                    var nodo_final_valor = ultimo.direccion;
                    var total_distancia = distancia_total;
                    var j = 0;
                    for (var i = 1; i < nodos.length; i++) {
                        var objDetalle1 = new Object();
                        objDetalle1.letra = nodos[i].nodo;
                        objDetalle1.valor_lng = nodos[i].datos.lng();
                        objDetalle1.valor_lat = nodos[i].datos.lat();
                        objDetalle1.id_pedido = array_pedidos[j].id;
                        j++;
                        nodos_intermedios.push(objDetalle1);
                    }


                    for (var i = 0; i < route_optimal.length; i++) {
                        var objDetalle2 = new Object();
                        objDetalle2.nodo1 = route_optimal[i].nodo_inicio;
                        objDetalle2.nodo2 = route_optimal[i].nodo_fin;
                        objDetalle2.distancia = route_optimal[i].distancia;
                        recorrido.push(objDetalle2);
                    }



                    var json_nodos_intermedios = JSON.stringify(nodos_intermedios);
                    var json_recorrido = JSON.stringify(recorrido);
                    var datos_frm = {
                        p_nodo_inicio_letra: nodo_inicio_letra,
                        p_nodo_inicio_valor: nodo_inicio_valor,
                        p_nodo_final_letra: nodo_final_letra,
                        p_nodo_final_valor: nodo_final_valor,
                        p_distancia_total: distancia_total,
                        p_recorrido: json_recorrido,
                        p_nodos_intermedios: json_nodos_intermedios,
                        p_vehiculo_chofer: $("#id_vehiculo_chofer").val(),
                        p_fecha: $("#fecha_ruta").val(),
                        p_punto_inicio: id_punto_inicio,
                        p_punto_final: id_punto_llegada
                    };
                    //console.log(datos_frm);
                    $.ajax({
                        type: "post",
                        url: "../controller/Ruta.agregar.controller.php",
                        data: datos_frm,
                        success: function (resultado) {
                            console.log(resultado);
                            var datosJSON = resultado;
                            if (datosJSON.estado === 200) {
                                swal({
                                    html: true,
                                    title: "Todo Correcto",
                                    text: datosJSON.mensaje,
                                    type: "success",
                                    showCancelButton: false,
                                    confirmButtonText: 'Ok',
                                    closeOnConfirm: true
                                },
                                        function () {

                                            document.location.href = "algoritmo_mapa.php";
                                        });
                            }
                        },
                        error: function (error) {
                            var datosJSON = $.parseJSON(error.responseText);
                            swal("Error", datosJSON.mensaje, "error");
                        }
                    });
                }
            });
}

