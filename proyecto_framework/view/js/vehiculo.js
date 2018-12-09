var estado = 1;
var id_vehiculo;

$(document).ready(function () {
    //listar_persona();
    listado_vehiculos();
    cargar_lista_choferes();

});

function limpiar_form_vehiculo() {
    $("#rb_false").iCheck('uncheck');
    $("#rb_true").iCheck('uncheck');
    $("#rb_true").iCheck('check');

    $("#txt_placa").val("");
    $("#txt_modelo").val("");
    $("#txt_marca").val("");
    $("#txt_aka").val("");
    $("#txt_peso").val("");


}
function limpiar_form_vehiculo_chofer() {
    $("#cbx_choferes").val("");
    $("#txt_fecha").val("");
    $("#txt_hora_inicio").val("");
    $("#txt_hora_fin").val("");

}
$("#btn_cerrar_vehiculo").click(function () {
    limpiar_form_vehiculo();
});

$("#btn_vehiculo_chofer").click(function () {
    limpiar_form_vehiculo_chofer();
});


$("#btn_new_vehiculo").click(function () {
    limpiar_form_vehiculo();
    $("#txtOperacion").val("agregar");
    $("#titulomodal").html("NUEVO VEHÍCULO");
});

$("#rb_true").on('ifClicked', function (e) {
    estado = $("#rb_true").val();
    //alert(estado);
});

$("#rb_false").on('ifClicked', function (e) {
    estado = $("#rb_false").val();
//    alert(usuario);
});

//Trabajador

function guardar_datos_vehiculo() {
    swal({
        title: "Confirme",
        text: "¿Esta seguro de grabar los datos ingresados?",
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
                    var operacion = $("#txtOperacion").val();
                    $.post(
                            "../controller/Vehiculo.agregar.editar.controller.php",
                            {
                                p_id_vehiculo: $("#txtid_vehiculo").val(),
                                p_placa: $("#txt_placa").val(),
                                p_modelo: $("#txt_modelo").val(),
                                p_marca: $("#txt_marca").val(),
                                p_aka: $("#txt_aka").val(),
                                p_peso: $("#txt_peso").val(),
                                p_estado: estado,
                                p_operacion: operacion


                            }
                    ).done(function (resultado) {

                        console.log(resultado);
                        var datosJSON = resultado;

                        if (datosJSON.estado === 200) {
                            swal("Exito", datosJSON.mensaje, "success");
                            $("#btn_cerrar_vehiculo").click(); //Cerrar la ventana 
                            listado_vehiculos();

                        } else {
                            swal("Mensaje del sistema", datosJSON.mensaje, "warning");
                        }

                    }).fail(function (error) {
                        var datosJSON = $.parseJSON(error.responseText);
                        swal("Error", datosJSON.mensaje, "error");
                    });

                }
            });
}


function listado_vehiculos() {
    var data;

    $.post
            (
                    "../controller/Vehiculo.listar.controller.php"

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
                html += ' <div class="col-md-4 col-sm-4 col-xs-12 profile_details">';
                html += ' <div class="well profile_view">';
                html += ' <div class="col-sm-12">';      //12           
                html += '  <h4 class="brief"><strong>PLACA</strong>: ' + item.placa + '</h4>';
                html += '   <div class="left col-xs-7">';
                html += '<p style="color:#007c85">MODELO: ' + item.modelo + '</p>';
                html += '<p style="color:#007c85">MARCA : ' + item.marca + '</p>';
                html += '<p style="color:#007c85">AKA   : ' + item.aka + '</p>';
                html += '<p style="color:#007c85">PESO  : ' + item.peso + ' Kg</p>';              
                if (item.estado === true){
                     html += '<p style="color:#007c85">ACTIVO: <img src="../images/si.png" style="width:1.5em"> </p>';              

                }else{
                   html += '<p style="color:#007c85">ACTIVO: <img src="../images/no.png" style="width:1.5em"> </p>';              
                }
                html += ' </div>';
                html += '  <div class="right col-xs-5 text-center">';
                html += ' <img src="../images/bus_img.png" alt="" class="img-circle img-responsive">';
                html += ' </div>';
                html += ' </div>';//Fin 12

                html += '  <div class="col-xs-12 bottom text-center">';//bottom
                html += ' <div class="col-xs-12 col-sm-6 emphasis">';
                html += '   <button  title="Lista de Choferes" type="button" class="btn btn-default btn-xs" onclick="listado_choferes(' + item.id + ')" data-toggle="modal" data-target="#mdl_list_choferes"><i class="fa fa-male"></i> Lista Chofer(es)</button>';

                html += ' </div>';
                html += '  <div class="col-xs-12 col-sm-6 emphasis">';
                html += '   <button id="btn_vehiculo_chofer" title="Asignar Chofer" type="button" class="btn btn-info btn-xs" onclick="id_vehiculo_elegido(' + item.id + ')" data-toggle="modal" data-target="#mdl_choferes"><i class="fa fa-plus"></i>  <i class="fa fa-male"></i> Chofer</button>';
                html += '  <button type="button" class="btn btn-success btn-xs" onclick="leerDatos_vehiculo(' + item.id + ')" data-toggle="modal" data-target="#mdl_vehiculo"><i class="fa fa-edit"> </i> Editar</button>';

                html += ' </div>';
                html += ' </div>';//bottom

                html += ' </div>';
                html += ' </div>';
            });

            html += '</div>';
            html += '</div>';
            html += '</div>';
            html += '</div>';


            $("#list_vehiculos").html(html);




        } else {
            swal("Mensaje del sistema", resultado, "warning");
        }


    }).fail(function (error) {
        var datosJSON = $.parseJSON(error.responseText);
        //swal("Error", datosJSON.mensaje , "error"); 
    });

}


function leerDatos_vehiculo(id) {
    //alert(id);
    $.post
            (
                    "../controller/Vehiculo.leer.datos.controller.php",
                    {
                        p_id: id
                    }
            ).done(function (resultado) {
        //console.log("Leyendo datos");
        limpiar_form_vehiculo();
        var jsonResultado = resultado;
        if (jsonResultado.estado === 200) {
            $("#txtTipoOperacion").val("editar");
            $("#titulomodal").html("EDITAR DATOS");
            $("#txtid_vehiculo").val(jsonResultado.datos.id);

            if (jsonResultado.datos.estado === true) {
                $("#rb_true").iCheck('check');
            } else {
                $("#rb_false").iCheck('check');
            }
            $("#txt_placa").val(jsonResultado.datos.placa);
            $("#txt_modelo").val(jsonResultado.datos.modelo);
            $("#txt_marca").val(jsonResultado.datos.marca);
            $("#txt_aka").val(jsonResultado.datos.aka);
            $("#txt_peso").val(jsonResultado.datos.peso);
            $("#txtemail").val(jsonResultado.datos.email);
            $("#txttelefono").val(jsonResultado.datos.telefono);
        }
    }).fail(function (error) {
        var datosJSON = $.parseJSON(error.responseText);
        swal("Error", datosJSON.mensaje, "error");
    });
}

function cargar_lista_choferes() {

    $.post
            (
                    "../controller/Persona.chofer.lista.controller.php"
                    ).done(function (resultado) {
        var datosJSON = resultado;
        //console.log(resultado);

        if (datosJSON.estado === 200) {
            var html = "";

            html += '<option value=""> -- Seleccione --</option>';
            $.each(datosJSON.datos, function (i, item) {
                html += '<option value="' + item.id_personal + '">' + item.nc + '</option>';
            });

            $("#cbx_choferes").html(html);
        } else {
            swal("Mensaje del sistema", resultado, "warning");
        }
    }).fail(function (error) {
        var datosJSON = $.parseJSON(error.responseText);
        swal("Error", datosJSON.mensaje, "error");
    });
}


function id_vehiculo_elegido(item) {
    id_vehiculo = "";
    id_vehiculo = item;
}

function save_asignar_chofer() {
    swal({
        title: "Confirme",
        text: "¿Esta seguro de grabar los datos ingresados?",
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
                    var operacion = $("#txtOperacion").val();
                    $.post(
                            "../controller/Vehiculo.chofer.agregar.controller.php",
                            {
                                p_id_vehiculo: id_vehiculo,
                                p_id_personal: $("#cbx_choferes").val(),
                                p_fecha: $("#txt_fecha").val(),
                                p_hora_inicio: $("#txt_hora_inicio").val(),
                                p_hora_fin: $("#txt_hora_fin").val()
                            }
                    ).done(function (resultado) {

                        console.log(resultado);
                        var datosJSON = resultado;

                        if (datosJSON.estado === 200) {
                            swal("Exito", datosJSON.mensaje, "success");
                            $("#btn_cerrar_asignacion").click(); //Cerrar la ventana
                            limpiar_form_vehiculo_chofer();
                            //listado_vehiculos();

                        } else {
                            swal("Mensaje del sistema", resultado.mensaje, "warning");
                        }

                    }).fail(function (error) {
                        var datosJSON = $.parseJSON(error.responseText);
                        swal("Error", datosJSON.mensaje, "error");
                    });

                }
            });


}

function listado_choferes(id) {

    $.post
            (
                    "../controller/Vehiculo.choferes.listar.controller.php",
                    {
                        p_id: id
                    }
            ).done(function (resultado) {
                var datosJSON = resultado;
        if (datosJSON.estado === 200) {
            var html = "";

//            html += '<small>';
            html += '<table id="tbl_lista_choferes" class="table table-striped table-bordered bulk_action" style="width:100%">';
            html += '<thead>';
            html += '<tr style="background-color: #ededed">';
            html += '<th style="text-align: center">ELIMINAR</th>';
            html += '<th style="text-align: center">DNI</th>';
            html += '<th>CHOFER</th>';
            html += '<th>FECHA</th>';
            html += '<th>HORA INICIO</th>';
            html += '<th>HORA FIN</th>';
            html += '</tr>';
            html += '</thead>';
            html += '<tbody>';
            //Detalle
            $.each(datosJSON.datos, function (i, item) {

                html += '<tr>';              
		html += '<td style="text-align:center"><button type="button" class="btn btn-danger btn-xs" onclick="eliminar(' + item.id + ')"><i class="fa fa-close"></i></button></td>';
                html += '<td style="text-align:center">' + item.dni + '</td>';
                html += '<td>' + item.chofer + '</td>';
                html += '<td>' + item.fecha + '</td>';
                html += '<td>' + item.hora_inicio + '</td>';
                html += '<td>' + item.hora_fin + '</td>';
                html += '</tr>';
            });
            html += '</tbody>';
            html += '</table>';

            $("#listado_choferes").html(html);
            $('#tbl_lista_choferes').DataTable({
                "bPaginate": true
            });



        } else {
            swal("Mensaje del sistema", resultado, "warning");
        }

    }).fail(function (error) {
        var datosJSON = $.parseJSON(error.responseText);
        swal("Error", datosJSON.mensaje, "error");
    });
//        
}


function eliminar(id){
    swal({
        title: "Confirme",
        text: "¿Esta seguro de eliminar este registro?",
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
                    var operacion = $("#txtOperacion").val();
                    $.post(
                            "../controller/Vehiculo.chofer.eliminar.controller.php",
                            {
                                p_id: id                             
                            }
                    ).done(function (resultado) {

                        console.log(resultado);
                        var datosJSON = resultado;

                        if (datosJSON.estado === 200) {
                            swal("Exito", datosJSON.mensaje, "success");
                            $("#btn_cerrar_lista_choferes").click(); //Cerrar la ventana 

                        } else {
                            swal("Mensaje del sistema", resultado, "warning");
                        }

                    }).fail(function (error) {
                        var datosJSON = $.parseJSON(error.responseText);
                        swal("Error", datosJSON.mensaje, "error");
                    });

                }
            });
}

function validar_horas(){
    var hora_inicio = $("#txt_hora_inicio").val();
    var hora_fin = $("#txt_hora_fin").val();
    
    alert(hora_inicio);
    alert(hora_fin);
}