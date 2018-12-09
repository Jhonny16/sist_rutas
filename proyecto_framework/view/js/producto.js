var parametro = 0;

$(document).ready(function () {
    //listar_persona();
    listado_productos();

});

function limpiar(){
    $("#cbtipo_producto").val("");
    $("#txt_nombre_prod").val("");
    $("#cb_unidad_medida").val("");
    $("#txt_precio").val("");
    $("#txt_cantidad").val("");
}

$("#btn_nuevo_prod").click(function () {

    $("#txtTipoOperacionProd").val("agregar");
    $("#titulomodalProd").html("Nuevo Producto");
    limpiar();
});


$("#cbx_selec_tipo_productos").change(function () {
    parametro = $("#cbx_selec_tipo_productos").val();
    listado_productos();
});



//Producto
function guardar_productos() {

    var tipo_producto = $("#cbtipo_producto").val();
    var unidad_medida = $("#cb_unidad_medida").val();


    swal({
        title: "Confirme",
        text: "¿Esta seguro de grabar los datos del producto?",
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
                    if (tipo_producto === "") {
                        swal("Alerta", "Debe seleccionar el tipo de prodcuto", "Ojo");
                    } else {
                        if (unidad_medida === "") {
                            swal("Alerta", "Debe seleccionar la unidad de medida el producto", "Ojo");
                        } else {
                            agregar_editar_producto();

                        }

                    }


                }
            });
}
function agregar_editar_producto() {
    var operacion = $("#txtTipoOperacionProd").val();
    $.post(
            "../controller/Producto.agregar.editar.controller.php",
            {
                p_tipo: $("#cbtipo_producto").val(),
                p_nombre: $("#txt_nombre_prod").val(),
                p_um: $("#cb_unidad_medida").val(),
                p_cantidad: $("#txt_cantidad").val(),
                p_precio: $("#txt_precio").val(),
                p_id_producto: $("#txtid_producto").val(),
                p_operacion: operacion


            }
    ).done(function (resultado) {

        //console.log(resultado);
        var datosJSON = resultado;

        if (datosJSON.estado === 200) {
            swal("Exito", datosJSON.mensaje, "success");
            listado_productos();
            $("#btncerrar_prod").click(); //Cerrar la ventana 
            
        } else {
            swal("Mensaje del sistema", resultado, "warning");
        }

    }).fail(function (error) {
        var datosJSON = $.parseJSON(error.responseText);
        swal("Error", datosJSON.mensaje, "error");
    });

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

function leerDatos_producto(id) {
    limpiar();

    $.post
            (
                    "../controller/Producto.leer.datos.controller.php",
                    {
                        p_id: id
                    }
            ).done(function (resultado) {
        //console.log("Leyendo datos");
        console.log(resultado);
        var jsonResultado = resultado;
        if (jsonResultado.estado === 200) {
            $("#txtTipoOperacion").val("editar");
            $("#titulomodal").html("Editar datos");
            $("#txtid_producto").val(jsonResultado.datos.id);
                       
            $("#cbtipo_producto").val(jsonResultado.datos.id_tipo);
            $("#txt_nombre_prod").val(jsonResultado.datos.nombre);
            $("#cb_unidad_medida").val(jsonResultado.datos.unidad_medida);
            $("#txt_precio").val(jsonResultado.datos.precio);
            $("#txt_cantidad").val(jsonResultado.datos.cantidad);
       


        }
    }).fail(function (error) {
        var datosJSON = $.parseJSON(error.responseText);
        swal("Error", datosJSON.mensaje, "error");
    });
}