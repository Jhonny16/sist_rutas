/**
 * Created by tito_ on 09/12/2018.
 */


var anio = 0;

$(document).ready(function () {
    list_clientes();
});


function list_clientes() {
    $("#combo_clientes").empty();

    $.post
    (
        "../controller/Persona.cliente.listar.controller.php"

    ).done(function (resultado) {

        //console.log(resultado);
        var datosJSON = resultado;
        list_cliente = resultado;
        // alert(resultado);

        if (datosJSON.estado === 200) {
            var html = "";
            html += '<option value="0">-- Seleccione Cliente --</option>';
            $.each(datosJSON.datos, function (i, item) {
                html += '<option value="' + item.id + '">' + item.dni_ruc + ' - ' + item.nc + '</option>';
            });
            $("#combo_clientes").append(html);
        } else {
            swal("Mensaje del sistema", resultado, "warning");
        }

    }).fail(function (error) {
        var datosJSON = $.parseJSON(error.responseText);
        //swal("Error", datosJSON.mensaje , "error");
    });
}

function listado(){
    var fecha1 = $("#txt_fecha1").val();
    var fecha2 = $("#txt_fecha2").val();
     anio = parseInt(fecha1.substr(0,4));
    console.log(anio);
    var cliente_id = $("#combo_clientes").val();
    if (cliente_id =='0'){
        swal("Nota", "Debe seleccionar un cliente", "info");
        return 0;
    }
    var parametros =
        {
            p_fecha1: fecha1,
            p_fecha2: fecha2,
            p_cliente: cliente_id
        };
    console.log(parametros);
    $.ajax({
        data: parametros,
        url: "../controller/Productos_vendidos.php",
        type: "post",
        beforeSend: function () {

//            $("#visualizar_descanso_medico_por_anio").attr('style', 'display:none');
//            $("#detalle_cargando_grafico").attr('style', 'display:block');
//            $("#detalle_cargando_grafico").empty();
//            $("#detalle_cargando_grafico").append("<center><img src='../imagenes/cargando.gif' width='250px'></center>");
        },
        success: function (data) {
            console.log(data);
            //detalle_productos
            if (data.estado == 200) {
                var html = "";
                var i = 0;
                $.each(data.datos, function (i, item) {
                    html += '<tr>';
                    html += '<td>' + (i+1) + '</td>';
                    html += '<td>' + item.nombre + '</td>';
                    html += '<td>' + item.monto_total + '</td>';
                    html += '<td style="text-align: right">' + item.cantidad_vendida + '</td>';
                    html += '<td style="text-align: center">' + item.num_ventas + '</td>';
                    html += '<td style="text-align: center"><a href="" onclick="detail_proyeccion('+ item.id+')" data-toggle="modal" data-target="#mdl_pry_producto"' +
                        '><i class="fa fa-area-chart text-blue"></i></a></td>';
                    html += '</tr>';

                });
                $("#detalle_productos").html(html);
            }
        }
    });

}

function detail_proyeccion(id){

    var parametros =
        {
            p_id: id,
            p_anio: anio,
            p_cliente: $("#combo_clientes").val()
        };
    console.log(parametros);
    $.ajax({
        data: parametros,
        url: "../controller/Producto_proyeccion.php",
        type: "post",
        beforeSend: function () {

        },
        success: function (result) {
            console.log(result);
            //detalle_productos
            if (result.estado == 200) {
                var data = result.datos;
                var array = [];

                array[0]=['Mes', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio','Julio',
                    'Agosto','Setiembre','Octubre','Noviembre','Diciembre'];
                for(var i= 0; i < data.length; i++){
                    var array2 = [];
                    array2[0] = ''+ anio +'';
                    if(data[i].enero == null){array2[1] = 0}else{array2[1] = parseFloat(data[i].enero);}
                    if(data[i].febrero == null){array2[2] = 0}else{array2[2] = parseFloat(data[i].febrero);}
                    if(data[i].marzo == null){array2[3] = 0}else{array2[3] = parseFloat(data[i].marzo);}
                    if(data[i].abril == null){array2[4] = 0}else{array2[4] = parseFloat(data[i].abril);}
                    if(data[i].mayo == null){array2[5] = 0}else{array2[5] = parseFloat(data[i].mayo);}
                    if(data[i].junio == null){array2[6] = 0}else{array2[6] = parseFloat(data[i].junio);}
                    if(data[i].julio == null){array2[7] = 0}else{array2[7] = parseFloat(data[i].julio);}
                    if(data[i].agosto == null){array2[8] = 0}else{array2[8] = parseFloat(data[i].agosto);}
                    if(data[i].setiembre == null){array2[9] = 0}else{array2[9] = parseFloat(data[i].setiembre);}
                    if(data[i].octubre == null){array2[10] = 0}else{array2[10] = parseFloat(data[i].octubre);}
                    if(data[i].noviembre == null){array2[11] = 0}else{array2[11] = parseFloat(data[i].noviembre);}
                    if(data[i].diciembre == null){array2[12] = 0}else{array2[12] = parseFloat(data[i].diciembre);}

                    array.push(array2);
                }
                console.log(array);
                drawVisualization2(array);            }
        }
    });




}
var data ;
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawVisualization);
function drawVisualization(array) {
    // Some raw data (not necessarily accurate)
    data = google.visualization.arrayToDataTable([
        ['Month', 'Bolivia', 'Ecuador', 'Madagascar', 'Papua New Guinea', 'Rwanda', 'Average'],
        ['2004/05',  165,      938,         522,             998,           450,      614.6],
        ['2005/06',  135,      1120,        599,             1268,          288,      682],
        ['2006/07',  157,      1167,        587,             807,           397,      623],
        ['2007/08',  139,      1110,        615,             968,           215,      609.4],
        ['2008/09',  136,      691,         629,             1026,          366,      569.6]
    ]);

    var options = {
        title : 'Monthly Coffee Production by Country',
        vAxis: {title: 'Cups'},
        hAxis: {title: 'Month'},
        seriesType: 'bars',
        series: {12: {type: 'line'}}
    };

    var chart = new google.visualization.ComboChart(document.getElementById('chart_proyeccion'));
    chart.draw(data, options);
}

var data ;
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawVisualization);
function drawVisualization2(array) {
    var data = array;
    // Some raw data (not necessarily accurate)
    data = google.visualization.arrayToDataTable(data);

    var options = {
        title : 'Proyeccion de Demanda',
        vAxis: {title: 'Valor'},
        hAxis: {title: 'Año'},
        seriesType: 'bars',
        series: {12: {type: 'line'}}
    };

    var chart = new google.visualization.ComboChart(document.getElementById('chart_proyeccion'));
    chart.draw(data, options);
}