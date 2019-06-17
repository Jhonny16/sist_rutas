var p_fecha = 1;
var estado = 'P';
var zona = 0;
var opc = 0;

$('#busq_all_producto').on('ifChecked', function (event) {
    opc = 0;
});
$('#busq_all_producto').on('ifUnchecked', function (event) {
    opc = 1;
});
$('#busq_ep_producto').on('ifChecked', function (event) {
    estado = $("#busq_ep_producto").val();
});
$('#busq_ee_producto').on('ifChecked', function (event) {
    estado = $("#busq_ee_producto").val();
});



$(document).ready(function () {
    cargar_zona_producto();
    ver_grafico_default_circular2();
    ver_grafico_default_barras2();
});


function ver_grafico_default_circular2() {
    var fecha1 = $("#txtFecha1_producto").val();
    var fecha2 = $("#txtFecha2_producto").val();
    var parametros =
            {
                p_fecha1: fecha1,
                p_fecha2: fecha2,
                p_zona: 0,
                p_opc: opc,
                p_estado: estado
            };
    console.log(parametros);
    $.ajax({
        data: parametros,
        url: "../controller/Producto.reportes.graficos.controller.php",
        type: "post",
        beforeSend: function () {
//            $("#visualizar_descanso_medico_por_anio").attr('style', 'display:none');
//            $("#detalle_cargando_grafico").attr('style', 'display:block');
//            $("#detalle_cargando_grafico").empty();
//            $("#detalle_cargando_grafico").append("<center><img src='../imagenes/cargando.gif' width='250px'></center>");
        },
        success: function (valor) {
            console.log(valor);
//            $("#detalle_cargando_grafico").attr('style', 'display:none');
//            $("#visualizar_descanso_medico_por_anio").attr('style', 'display:block; width: 500px; height: 500px;');
            drawChart2(valor);
        }
    });
}

function ver_graficos_two() {
    ver_grafico_circular2();
    ver_grafico_barras2();

}
function ver_grafico_circular2() {
   var fecha1 = $("#txtFecha1_producto").val();
    var fecha2 = $("#txtFecha2_producto").val();
    var parametros =
            {
                p_fecha1: fecha1,
                p_fecha2: fecha2,
                p_zona: $("#cbx_zona_producto").val(),
                p_opc: opc,
                p_estado: estado
            };
    console.log(parametros);
    $.ajax({
        data: parametros,
        url: "../controller/Producto.reportes.graficos.controller.php",
        type: "post",
        beforeSend: function () {
//            $("#visualizar_descanso_medico_por_anio").attr('style', 'display:none');
//            $("#detalle_cargando_grafico").attr('style', 'display:block');
//            $("#detalle_cargando_grafico").empty();
//            $("#detalle_cargando_grafico").append("<center><img src='../imagenes/cargando.gif' width='250px'></center>");
        },
        success: function (valor) {
            console.log(valor);
//            $("#detalle_cargando_grafico").attr('style', 'display:none');
//            $("#visualizar_descanso_medico_por_anio").attr('style', 'display:block; width: 500px; height: 500px;');
            drawChart2(valor);
        }
    });
}

function drawChart2(valor) {

    var datos = $.parseJSON(valor);
    var array2 = datos;
//    console.log(array1);
    console.log(array2);
    var data = google.visualization.arrayToDataTable(array2);
    var options = {
        legend: {position: 'top', textStyle: {color: 'blue', fontSize: 16}},
        pieSliceText: {color: 'black',fontSize: 12},
        pieStartAngle: 100
    };
    var chart = new google.visualization.PieChart(document.getElementById('producto_num_pedidos'));
    chart.draw(data, options);
}



function ver_grafico_default_barras2() {
   var fecha1 = $("#txtFecha1_producto").val();
    var fecha2 = $("#txtFecha2_producto").val();
    var parametros =
            {
                p_fecha1: fecha1,
                p_fecha2: fecha2,
                p_zona: 0,
                p_opc: opc,
                p_estado: estado
            };
    console.log(parametros);
    $.ajax({
        data: parametros,
        url: "../controller/Producto.reportes.graficos.controller.php",
        type: "post",
        beforeSend: function () {
//            $("#visualizar_descanso_medico_por_anio").attr('style', 'display:none');
//            $("#detalle_cargando_grafico").attr('style', 'display:block');
//            $("#detalle_cargando_grafico").empty();
//            $("#detalle_cargando_grafico").append("<center><img src='../imagenes/cargando.gif' width='250px'></center>");
        },
        success: function (valor) {
            console.log(valor);
//            $("#detalle_cargando_grafico").attr('style', 'display:none');
//            $("#visualizar_descanso_medico_por_anio").attr('style', 'display:block; width: 500px; height: 500px;');
            drawVisualization2(valor);
        }
    });
}
function ver_grafico_barras2() {
    var fecha1 = $("#txtFecha1_producto").val();
    var fecha2 = $("#txtFecha2_producto").val();
    var parametros =
            {
                p_fecha1: fecha1,
                p_fecha2: fecha2,
                p_zona: $("#cbx_zona_producto").val(),
                p_opc: opc,
                p_estado: estado
            };
    console.log(parametros);
    $.ajax({
        data: parametros,
        url: "../controller/Producto.reportes.graficos2.controller.php",
        type: "post",
        beforeSend: function () {
//            $("#visualizar_descanso_medico_por_anio").attr('style', 'display:none');
//            $("#detalle_cargando_grafico").attr('style', 'display:block');
//            $("#detalle_cargando_grafico").empty();
//            $("#detalle_cargando_grafico").append("<center><img src='../imagenes/cargando.gif' width='250px'></center>");
        },
        success: function (valor) {
            console.log(valor);
//            $("#detalle_cargando_grafico").attr('style', 'display:none');
//            $("#visualizar_descanso_medico_por_anio").attr('style', 'display:block; width: 500px; height: 500px;');
            drawVisualization2(valor);
        }
    });
}
function drawVisualization2(valor) {
    var datos = $.parseJSON(valor);
    var array = datos;
    //array[0].push({role: 'style'});
    //array[0] = ["Servicio","Monto"];
    console.log(array);

    // Some raw data (not necessarily accurate)
    var data = google.visualization.arrayToDataTable(array);

    var options = {
        title: '',
        vAxis: {title: 'Total S/.'},
        hAxis: {title: 'Productos'},
        seriesType: 'bars',
 
    };

    var chart = new google.visualization.ComboChart(document.getElementById('producto_total_ventas'));
    chart.draw(data, options);

}

function cargar_zona_producto() {

    $.post
            (
                    "../controller/Zona.cargar.datos.controller.php"
                    ).done(function (resultado) {
        var datosJSON = resultado;
        //console.log(resultado);

        if (datosJSON.estado === 200) {
            var html = "";

            html += '<option value="0">Todas las zonas</option>';
            $.each(datosJSON.datos, function (i, item) {
                html += '<option value="' + item.id + '">' + item.nombre + '</option>';
            });

            $("#cbx_zona_producto").html(html);
        } else {
            swal("Mensaje del sistema", resultado, "warning");
        }
    }).fail(function (error) {
        var datosJSON = $.parseJSON(error.responseText);
        swal("Error", datosJSON.mensaje, "error");
    });
}