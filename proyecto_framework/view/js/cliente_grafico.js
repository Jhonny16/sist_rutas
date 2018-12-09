var p_fecha = 1;
var estado = 'P';
var zona = 0;
var opc = 0;

$('#busq_all_cliente').on('ifChecked', function (event) {
    opc = 0;
});
$('#busq_all_cliente').on('ifUnchecked', function (event) {
    opc = 1;
});
$('#busq_ep_cliente').on('ifChecked', function (event) {
    estado = $("#busq_ep_cliente").val();
});
$('#busq_ee_cliente').on('ifChecked', function (event) {
    estado = $("#busq_ee_cliente").val();
});



$(document).ready(function () {
    // cargar_zona_cliente();
    cargar_zona_cliente();
    ver_grafico_default_circular();
    ver_grafico_default_barras();
});


function ver_grafico_default_circular() {
    var fecha1 = $("#txtFecha1_cliente").val();
    var fecha2 = $("#txtFecha2_cliente").val();
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
        url: "../controller/Cliente.reportes.graficos.controller.php",
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
            drawChart(valor);
        }
    });
}

function ver_graficos() {
    ver_grafico_circular();
    ver_grafico_barras();

}
function ver_grafico_circular() {
    var fecha1 = $("#txtFecha1_cliente").val();
    var fecha2 = $("#txtFecha2_cliente").val();
    var parametros =
            {
                p_fecha1: fecha1,
                p_fecha2: fecha2,
                p_zona: $("#cbx_zona_cliente").val(),
                p_opc: opc,
                p_estado: estado
            };
    console.log(parametros);
    $.ajax({
        data: parametros,
        url: "../controller/Cliente.reportes.graficos.controller.php",
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
            drawChart(valor);
        }
    });
}

function drawChart(valor) {

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
    var chart = new google.visualization.PieChart(document.getElementById('clientes_num_pedidos'));
    chart.draw(data, options);
}



function ver_grafico_default_barras() {
    var fecha1 = $("#txtFecha1_cliente").val();
    var fecha2 = $("#txtFecha2_cliente").val();
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
        url: "../controller/Cliente.reportes.graficos2.controller.php",
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
            drawVisualization(valor);
        }
    });
}
function ver_grafico_barras() {
    var fecha1 = $("#txtFecha1_cliente").val();
    var fecha2 = $("#txtFecha2_cliente").val();
    var parametros =
            {
                p_fecha1: fecha1,
                p_fecha2: fecha2,
                p_zona: $("#cbx_zona_cliente").val(),
                p_opc: opc,
                p_estado: estado
            };
    console.log(parametros);
    $.ajax({
        data: parametros,
        url: "../controller/Cliente.reportes.graficos2.controller.php",
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
            drawVisualization(valor);
        }
    });
}
function drawVisualization(valor) {
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
        hAxis: {title: 'Clientes'},
        seriesType: 'bars',
        series: {1: {type: 'line'}}
    };

    var chart = new google.visualization.ComboChart(document.getElementById('clientes_total_ventas'));
    chart.draw(data, options);

}

function cargar_zona_cliente() {

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

            $("#cbx_zona_cliente").html(html);
        } else {
            swal("Mensaje del sistema", resultado, "warning");
        }
    }).fail(function (error) {
        var datosJSON = $.parseJSON(error.responseText);
        swal("Error", datosJSON.mensaje, "error");
    });
}