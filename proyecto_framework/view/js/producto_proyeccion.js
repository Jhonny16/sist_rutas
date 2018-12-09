/**
 * Created by tito_ on 09/12/2018.
 */




function listado(){
    var fecha1 = $("#txt_fecha1").val();
    var fecha2 = $("#txt_fecha2").val();
    var parametros =
        {
            p_fecha1: fecha1,
            p_fecha2: fecha2
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
    var fecha1 = $("#txt_fecha1").val();
    var fecha2 = $("#txt_fecha2").val();
    var parametros =
        {
            p_fecha1: fecha1,
            p_fecha2: fecha2
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

    //var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
    //chart.draw(data, options);
}

