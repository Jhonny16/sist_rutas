/*INICIO: BUSQUEDA DE CLIENTES*/
var term = "";
$("#txt_producto_search").autocomplete({
    serviceUrl: "../controller/Producto.autocompletar.controller.php",    
    minChars: 1,
    paramName: 'term',
    deferRequestBy: 3,
    dataType: 'jsonp',
    onSearchStart: function (query) {
        console.log("hol");
        console.log(query);
    }
//   lookup: function (query, done) {
//        // Do ajax call or lookup locally, when done,
//        // call the callback and pass your results:
//        console.log(done)
////        var result = {
////            suggestions: [
////                { "value": "United Arab Emirates", "data": "AE" },
////                { "value": "United Kingdom",       "data": "UK" },
////                { "value": "United States",        "data": "US" }
////            ]
////        };
////
////        done(result);
//    },
//    onSelect: function (suggestion) {
//        alert('You selected: ' + suggestion.value + ', ' + suggestion.data);
//    }
});


function f_enfocar_registro(event, ui){
    var registro = ui.item.value;
    console.log(registro);
    $("#txt_producto_search").val(registro.nombre);
    
    
    event.preventDefault();
}

function f_seleccionar_registro(event, ui){
    var registro = ui.item.value;
    $("#txt_producto_search").val(registro.nombre);

    event.preventDefault();
}

function listado_productos() {
    //alert(param);

    $.post
            (
                    "../controller/Producto.listar.controller.php",
                    {p_param: parametro}

            ).done(function (resultado) {

        //console.log(resultado);
        var datosJSON = resultado;
        // alert(resultado);

        if (datosJSON.estado === 200) {
            var html = "";
            html += '';
            html += '<div class="col-md-12">';
            html += '<div class="x_panel">';
            html += '<div class="x_content">';
            html += '<div class="row">';
            html += '<div class="col-md-12 col-sm-12 col-xs-12 text-center"></div>';
            html += ' <div class="clearfix" ></div> ';
            $.each(datosJSON.datos, function (i, item) {
                //html += '<tr>';
                html += ' <div class="col-md-4 col-sm-4 col-xs-12 profile_details">';
                html += ' <div class="well profile_view">';
                html += ' <div class="col-sm-12">';      //12  


                html += '  <h4 class="brief">' + item.tipo + '</h4>';
                html += '   <div class="left col-xs-9">';
                html += '   <h2>' + item.nombre + '</h2>';
                html += '    <ul class="list-unstyled">';
                html += '     <li><i class="fa fa-area-chart"></i> Unidad medida: ' + item.unidad_medida + '</li>';
                html += '     <li><i class="fa fa-money"></i> Precio: S/.' + item.precio + '</li>';
                html += '     <li><i class="fa fa-th"></i> Cantidad #: ' + item.cantidad + '</li>';
                html += '    </ul>';
                html += ' </div>';
                html += '  <div class="right col-xs-3 text-center">';
                html += ' <img src="../images/dipropan.png" alt="" class="img-circle img-responsive">';
                html += ' </div>';
                html += ' </div>';//Fin 12

                html += '  <div class="col-xs-12 bottom text-center">';//bottom
                html += ' <div class="col-xs-12 col-sm-6 emphasis">';
                html += ' <p class="ratings">';
                html += ' </p>';
                html += ' </div>';
                html += '  <div class="col-xs-12 col-sm-6 emphasis">';
                html += '  <button type="button" class="btn btn-success btn-xs" onclick="leerDatos_producto(' + item.id + ')" data-toggle="modal" data-target="#mdl_producto"><i class="fa fa-edit"> </i> Editar</button>';

                html += ' </div>';
                html += ' </div>';//bottom

                html += ' </div>';
                html += ' </div>';

            });

            html += '</div>';
            html += '</div>';
            html += '</div>';
            html += '</div>';


            $("#products").html(html);


        } else {
            swal("Mensaje del sistema", resultado, "warning");
        }

    }).fail(function (error) {
        var datosJSON = $.parseJSON(error.responseText);
        //swal("Error", datosJSON.mensaje , "error"); 
    });
}

/*FIN: BUSQUEDA DE CLIENTES*/


