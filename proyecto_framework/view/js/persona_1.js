var usuario = "si";
var tipo_usuario;
var cliente = "c";
var aux_cliente = false;
var tipo_cliente = "p";
var trabajador = "";
var aux_trabajador = false;
var editar = 0;
var aux_usuario = false;

$(document).ready(function () {
    //listar_persona();
    listado_persona();

});

function limpiar() {

    $("#rbsi").iCheck('check');
    $("#rbno").iCheck('uncheck');

    $("#chbcliente").iCheck('check');
    $("#chbtrabajador").iCheck('uncheck');

    $("#rbpersona_natural").iCheck('check');
    $("#rbempresa").iCheck('uncheck');

    $("#cbarea").val("");
    $("#cbcargo").val("");

    $("#txtdni_ruc").val("");
    $("#txtnombres").val("");
    $("#txtapellidos").val("");
    $("#txtfecha_nacimiento").val("");
    $("#txtdireccion").val("");
    $("#txtemail").val("");
    $("#txttelefono").val("");

}


$('#chb_cambiar_password').on('ifChecked', function (event) {
    $("#div_new_password").removeAttr('style');
    $("#txt_password").removeAttr('readonly');
});
$('#chb_cambiar_password').on('ifUnchecked', function (event) {
    $("#txt_password").attr('readonly', '""');
    $("#div_new_password").attr('style', 'display:none');
});

$('#chb_cambiar_password_c').on('ifChecked', function (event) {
    $("#div_new_password_c").attr('style', 'display:block');
    $("#txt_password_c").removeAttr('readonly');
});
$('#chb_cambiar_password_c').on('ifUnchecked', function (event) {
    $("#txt_password_c").attr('readonly', '""');
    $("#div_new_password_c").removeAttr('style');
    $("#div_new_password_c").attr('style', 'display:none');
});


$('#chb_cambiar_password_t').on('ifChecked', function (event) {
    $("#div_new_password_t").attr('style', 'display:block');
    $("#txt_password_t").removeAttr('readonly');
});
$('#chb_cambiar_password_t').on('ifUnchecked', function (event) {
    $("#txt_password_t").attr('readonly', '""');
    //$("#div_new_password_t").removeAttr('style');
    $("#div_new_password_t").attr('style', 'display:none');
});


function habilitar_trabajador() {

    if ($("#chbtrabajador").prop('checked')) {
        $("#cbos_cargo_area").removeAttr('style');
        trabajador = $("#chbtrabajador").val();

        //$("#div_password_t").attr('style', 'display:block');
        //$("#p_1bl_t").attr('style', 'display:block');
        //$("#p_txt_t").attr('style', 'display:block');
    } else {
        $("#cbos_cargo_area").attr('style', 'display:none');
        trabajador = "";
        //$("#div_password_t").attr('style', 'display:none');
        //$("#p_1bl_t").attr('style', 'display:none');
        //$("#p_txt_t").attr('style', 'display:none');

    }

}
function habilitar_cliente() {

    if ($("#chbcliente").prop('checked')) {
        $("#rbs_tipo_cliente").removeAttr('style');
        // $("#div_password_c").attr('style', 'display:block');
        // $("#p_1bl_c").attr('style', 'display:block');
        //$("#p_txt_c").attr('style', 'display:block');

        cliente = $("#chbcliente").val();

    } else {
        $("#rbs_tipo_cliente").attr('style', 'display:none');
        // $("#div_password_c").attr('style', 'display:none');
        //$("#p_1bl_c").attr('style', 'display:none');
        //$("#p_txt_c").attr('style', 'display:none');

        cliente = "";
        tipo_cliente = "";
    }

}

$("#btn_nuevo").click(function () {
    limpiar();
    $("#txtTipoOperacion").val("agregar");
    $("#titulomodal").html("Nuevo Cliente / Trabajador");


    $("#div_chk_password1").attr('style', 'display:none');
    $("#div_chk_password2").attr('style', 'display:none');

    $("#div_password").attr('style', 'display:block');
    $("#p_1bl").attr('style', 'display:none');
    $("#p_txt").attr('style', 'display:none');

    editar = 0;
});

$("#rbsi").on('ifClicked', function (e) {
    $("#cbotipo_usuario").removeAttr('style');
    usuario = $("#rbsi").val();
    $("#div_password").removeAttr('style');
    if (aux_trabajador === true || trabajador === 't') {
        $("#div_password_c").attr('style', 'display:none');
        $("#div_password_t").attr('style', 'display:block');
        if (editar === 1) {
            alert('yeah');
            $("#div_password_t").attr('style', 'display:block');
            $("#div_chk_password1_t").attr('style', 'display:block');
            $("#div_chk_password2_t").attr('style', 'display:block');
        }
    }
    if (aux_cliente === true) {
        $("#div_password_t").attr('style', 'display:none');
        $("#div_password_c").attr('style', 'display:block');
        if (editar === 1) {
            $("#div_password_c").attr('style', 'display:block');
            $("#div_chk_password1_c").attr('style', 'display:block');
            $("#div_chk_password2_c").attr('style', 'display:block');
        }
    }
    if (aux_trabajador === true && aux_cliente === true) {

        $("#div_password_t").attr('style', 'display:block');
        $("#div_password_c").attr('style', 'display:block');
    } else {
        if (trabajador === 't' && cliente === 'c') {

            $("#div_password_t").attr('style', 'display:block');
            $("#div_password_c").attr('style', 'display:block');
        } else {
            if (aux_trabajador === false || trabajador == "" && aux_cliente === false || cliente == "") {
                $("#div_password_t").attr('style', 'display:none');
                $("#div_password_c").attr('style', 'display:none');
            }
        }

    }


});

$("#rbno").on('ifClicked', function (e) {
    $("#cbotipo_usuario").attr('style', 'display:none');
    $("#div_password").attr('style', 'display:none');
    $("#txt_password").val("");
    usuario = $("#rbno").val();
    $("#div_password_c").attr('style', 'display:none');
    $("#div_password_t").attr('style', 'display:none');
    $("#div_password").attr('style', 'display:none');
    $("#txt_password").val("");

//    alert(usuario);
});

$("#rbpersona_natural").on('ifClicked', function (e) {
    tipo_cliente = $("#rbpersona_natural").val();
    $("#txtdni_ruc").focus();
//   alert(tipo_cliente);
});

$("#rbempresa").on('ifClicked', function (e) {
    tipo_cliente = $("#rbempresa").val();
    $("#txtdni_ruc").focus();
//    alert(tipo_cliente);
});




//Trabajador

function guardar_datos() {
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
                habilitar_cliente();
                habilitar_trabajador();

                if (isConfirm) { //el usuario hizo clic en el boton SI     
                    //procedo a grabar
                    //Llamar al controlador para grabar los datos

                    //var codLab = ($("#txtTipoOperacion").val()==="agregar")? 
                    //$("#txtTipoOperacion").val("agregar");
                    var operacion = $("#txtTipoOperacion").val();


//             var json = {
//                    p_usuario: usuario,
//                    p_id_persona: $("#txtid_persona").val(),
//                    p_tipo_usuario: $("#cbtipo_usuario").val(),
//                    p_cliente: cliente,
//                    p_tipo_cliente: tipo_cliente,
//                    p_trabajador: trabajador,
//                    p_area: $("#cbarea").val(),
//                    p_cargo: $("#cbcargo").val(),
//                    p_dni_ruc: $("#txtdni_ruc").val(),
//                    p_apellidos: $("#txtapellidos").val(),
//                    p_nombres: $("#txtnombres").val(),
//                    p_fecha_nacimiento: $("#txtfecha_nacimiento").val(),
//                    p_direccion: $("#txtdireccion").val(),
//                    p_email: $("#txtemail").val(),
//                    p_telefono: $("#txttelefono").val(),
//                    p_operacion: operacion
//                 
                    //     }

                    // console.log(json);
                    $.post(
                            "../controller/Persona.agregar.editar.controller.php",
                            {
                                p_usuario: usuario,
                                p_id_persona: $("#txtid_persona").val(),
                                p_tipo_usuario: $("#cbtipo_usuario").val(),
                                p_password: $("#txt_password").val(),
                                p_new_password: $("#txt_new_password").val(),
                                p_password_c: $("#txt_password_c").val(),
                                p_new_password_c: $("#txt_new_password").val(),
                                p_password_t: $("#txt_password_t").val(),
                                p_new_password_t: $("#txt_new_password").val(),
                                p_cliente: cliente,
                                p_tipo_cliente: tipo_cliente,
                                p_trabajador: trabajador,
                                p_area: $("#cbarea").val(),
                                p_cargo: $("#cbcargo").val(),
                                p_dni_ruc: $("#txtdni_ruc").val(),
                                p_apellidos: $("#txtapellidos").val(),
                                p_nombres: $("#txtnombres").val(),
                                p_fecha_nacimiento: $("#txtfecha_nacimiento").val(),
                                p_direccion: $("#txtdireccion").val(),
                                p_email: $("#txtemail").val(),
                                p_telefono: $("#txttelefono").val(),
                                p_operacion: operacion


                            }
                    ).done(function (resultado) {

                        //console.log(resultado);
                        var datosJSON = resultado;

                        if (datosJSON.estado === 200) {
                            swal("Exito", datosJSON.mensaje, "success");
                            $("#btncerrar").click(); //Cerrar la ventana 
                            listado_persona();
                            //listar_persona(); //actualizar la lista
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

function listar_persona() {

    $.post
            (
                    "../controller/Persona.listar.controller.php"

                    ).done(function (resultado) {

        //console.log(resultado);
        var datosJSON = resultado;
        // alert(resultado);

        if (datosJSON.estado === 200) {
            var html = "";

            html += '<small>';
            html += '<table id="tabla-listado-personas" class="table table-striped table-bordered bulk_action">';
            html += '<thead>';
            html += '<tr style="background-color: #ededed; height:25px;">';
            html += '<th style="text-align: center">EDITAR</th>';
            html += '<th>Dni</th>';
            html += '<th>Nombre Completo</th>';
            html += '<th>Cliente</th>';
            html += '<th>Ruc</th>';
            html += '<th>Tipo Cliente</th>';
            html += '<th>Trabajador</th>';
            html += '<th>Area</th>';
            html += '<th>Cargo</th>';
            html += '<th>Usuario</th>';
            html += '<th>Tipo de Usuario</th>';
            html += '<th>Dirección</th>';
            html += '<th>Teléfono</th>';
            html += '</tr>';
            html += '</thead>';
            html += '<tbody>';

            //Detalle
            $.each(datosJSON.datos, function (i, item) {
                //html += '<tr>';
                html += '<tr>';
                html += '<td align="center">';
                html += ' <a title="Editar "  \n\
//                    onclick = "leerDatos_persona(' + item.id_persona + ')" data-toggle="modal"   \n\
                    data-target=".bs-example-modal-lg"><img src="../images/edit.png" style="width:1.5em" ></a>';
                html += '</td>';


                html += '<td>' + item.dni + '</td>';
                html += '<td>' + item.nombre_completo + '</td>';
                if (item.cliente === true) {
                    html += '<td style="text-align:center">\n\
                        <img src="../images/si.png" style="width:1.5em">\n\
                        <a><img title="Aquí puede validar su dirección" src="../images/ubicacion_cliente.png" style="width:1.5em" onclick="validar_direccion()"></a>\n\
                        </td>';

                } else {
                    html += '<td style="text-align:center"><img src="../images/no.png" style="width:1.5em"></td>';

                }

                if (item.cliente === true) {
                    if (item.dni_ruc !== null) {
                        html += '<td>' + item.dni_ruc + '</td>';
                    } else {
                        html += '<td>Ninguno</td>';
                    }
                } else {
                    html += '<td>Ninguno</td>';
                }


                if (item.cliente === true) {
                    html += '<td>' + item.tipo_cliente + '</td>';
                } else {
                    html += '<td>Ninguno</td>';
                }

                if (item.trabajador === true) {
                    html += '<td style="text-align:center"><img src="../images/si.png" style="width:1.5em"></td>';
                    html += '<td>' + item.area + '</td>';
                    html += '<td>' + item.cargo + '</td>';
                } else {
                    html += '<td style="text-align:center"><img src="../images/no.png" style="width:1.5em"></td>';
                    html += '<td>Ninguno</td>';
                    html += '<td>Ninguno</td>';
                }

                if (item.es_usuario === true) {
                    html += '<td style="text-align:center"><img src="../images/si.png" style="width:1.5em"></td>';
                    html += '<td>' + item.tipo_usuario + '</td>';
                } else {
                    html += '<td style="text-align:center"><img src="../images/no.png" style="width:1.5em"></td>';
                    html += '<td>Ninguno</td>';
                }

                html += '<td>' + item.direccion + '</td>';
                html += '<td>' + item.telefono + '</td>';
                html += '</tr>';
            });

            html += '</tbody>';
            html += '</table>';
            html += '</small>';

            $("#listado_personas").html(html);


            $('#tabla-listado-personas').DataTable({
                "aaSorting": [[0, "desc"]],
                "sScrollX": "100%",
                "sScrollXInner": "100%"
            })



        } else {
            swal("Mensaje del sistema", resultado, "warning");
        }

    }).fail(function (error) {
        var datosJSON = $.parseJSON(error.responseText);
        //swal("Error", datosJSON.mensaje , "error"); 
    });
}

function listado_persona() {

    $.post
            (
                    "../controller/Persona.listar.controller.php"

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
                html += '  <h4 class="brief">' + item.dni + '</h4>';
                html += '   <div class="left col-xs-9">';

                if (item.cliente === true) {
                    if (item.tipo_cliente === 'Empresa') {
                        html += '<img title="Tipo de Cliente: Empresa" src="../images/empresa.png" style="width:1.5em"> ';
                    } else {
                        html += '<img title="Tipo de Cliente: Persona Natural" src="../images/persona.png" style="width:1.5em"> ';
                    }

                }
                if (item.es_usuario === true) {
                    html += '<br><p style="color:#007c85">' + item.tipo_usuario + '</p><br>';
                } else {
                    html += '<br><p style="color:#007c85">-</p><br>';
                }
                if (item.trabajador === true) {
                    html += '' + item.area + '';
                    html += '/' + item.cargo + '';
                }


                html += '   <h2>' + item.nombre_completo + '</h2>';
                if (item.cliente === true) {
                    html += '   <p><strong>Cliente: <img src="../images/si.png" style="width:1.5em"> </strong> </p>';

                } else {
                    html += '   <p><strong>Cliente: <img src="../images/no.png" style="width:1.5em"> </strong> </p>';
                }
                if (item.trabajador === true) {
                    html += '   <p><strong>Trabajador: <img src="../images/si.png" style="width:1.5em"> </strong> </p>';

                } else {
                    html += '   <p><strong>Trabajador: <img src="../images/no.png" style="width:1.5em"> </strong> </p>';
                }
                if (item.es_usuario === true) {
                    html += '   <p><strong>Usuario: <img src="../images/si.png" style="width:1.5em"> </strong> </p>';

                } else {
                    html += '   <p><strong>Usuario: <img src="../images/no.png" style="width:1.5em"> </strong> </p>';
                }


                html += '    <ul class="list-unstyled">';
                html += '     <li><i class="fa fa-building"></i> Dirección: ' + item.direccion + '</li>';
                html += '     <li><i class="fa fa-phone"></i> Teléfono #: ' + item.telefono + '</li>';
                html += '    </ul>';
                html += ' </div>';
                html += '  <div class="right col-xs-3 text-center">';
                html += ' <img src="../images/users.png" alt="" class="img-circle img-responsive">';
                html += ' </div>';
                html += ' </div>';//Fin 12

                html += '  <div class="col-xs-12 bottom text-center">';//bottom
                html += ' <div class="col-xs-12 col-sm-6 emphasis">';
                html += ' <p class="ratings">';

//                html += ' <a href="#"><span class="fa fa-star"></span></a>';//bottom
//                html += ' <a href="#"><span class="fa fa-star"></span></a>';//bottom
//                html += ' <a href="#"><span class="fa fa-star"></span></a>';//bottom
//                html += ' <a href="#"><span class="fa fa-star"></span></a>';//bottom
//                html += ' <a href="#"><span class="fa fa-star"></span></a>';//bottom
                html += ' </p>';
                html += ' </div>';
                html += '  <div class="col-xs-12 col-sm-6 emphasis">';
                html += '  <button type="button" class="btn btn-success btn-xs" onclick="leerDatos_persona(' + item.id_persona + ')" data-toggle="modal" data-target="#myModal"><i class="fa fa-edit"> </i> Editar</button>';

                html += ' </div>';
                html += ' </div>';//bottom

                html += ' </div>';
                html += ' </div>';

            });

            html += '</div>';
            html += '</div>';
            html += '</div>';
            html += '</div>';


            $("#users").html(html);


        } else {
            swal("Mensaje del sistema", resultado, "warning");
        }

    }).fail(function (error) {
        var datosJSON = $.parseJSON(error.responseText);
        //swal("Error", datosJSON.mensaje , "error"); 
    });
}


function leerDatos_persona(id) {
    //alert(id);
    editar = 1;
    $.post
            (
                    "../controller/Persona.leer.datos.controller.php",
                    {
                        p_id: id
                    }
            ).done(function (resultado) {
        //console.log("Leyendo datos");
        //console.log(resultado);
        var jsonResultado = resultado;
        if (jsonResultado.estado === 200) {
            $("#txtTipoOperacion").val("editar");
            $("#titulomodal").html("Editar datos");
            $("#txtid_persona").val(jsonResultado.datos.id_persona);


            $("#div_chk_password1_c").removeAttr('style');
            $("#div_chk_password2_c").removeAttr('style');
            $("#div_chk_password1_t").removeAttr('style');
            $("#div_chk_password2_t").removeAttr('style');

            usuario = "";
            tipo_usuario = "";
            cliente = "";
            tipo_cliente = "";
            trabajador = "";

            if (jsonResultado.datos.estado === true) {

                aux_usuario = true;
                //$("#rbsi").click();
                $("#rbsi").iCheck('check');
                $("#cbtipo_usuario").val(jsonResultado.datos.tipo_usuario);
            } else {
                //$("#rbno").click();
                $("#rbno").iCheck('check');
                $("#cbotipo_usuario").attr('style', 'display:none');
            }

            if (jsonResultado.datos.cliente === true) {
                aux_cliente = true;
                //$("#chbcliente").removeAttr('checked');
                $("#txt_password_c").attr('readonly', '" "');
                if (jsonResultado.datos.estado === true) {
                    $("#div_chk_password1_c").attr('style', 'display:block');
                    $("#div_chk_password2_c").attr('style', 'display:block');
                    $("#div_password_c").attr('style', 'display:block');

                } else {
                    //$("#div_password_t").removeAttr('style');
                    $("#div_password_c").attr('style', 'display:none');
                }


                $("#chbcliente").iCheck('uncheck');
                $("#chbcliente").iCheck('check');

                $("#txt_password_c").attr('readonly', '" "');
                //$("#chbcliente").click();
                //$("#chbcliente").iCheck();
                if (jsonResultado.datos.tipo_cliente === 'e') {
                    //$("#rbempresa").click();
                    $("#rbempresa").iCheck('check');
                } else {
                    //$("#rbpersona_natural").click();
                    $("#rbpersona_natural").iCheck('check');
                }
            } else {
                //$("#chbcliente").removeAttr('checked');
                $("#chbcliente").iCheck('uncheck');
                $("#rbs_tipo_cliente").attr('style', 'display:none');

                $("#div_password_c").attr('style', 'display:none');
                $("#txt_password_c").attr('readonly', '" "');
            }

            if (jsonResultado.datos.trabajador === true) {
                aux_trabajador = true;
                //$("#chbtrabajador").removeAttr('checked');
                $("#txt_password_t").attr('readonly', '" "');
                if (jsonResultado.datos.estado === true) {
                    alert('si');
                    $("#div_chk_password1_t").attr('style', 'display:block');
                    $("#div_chk_password2_t").attr('style', 'display:block');
                    $("#div_password_t").attr('style', 'display:block');

                } else {
                    // alert("yeah");
                    //$("#div_password_t").removeAttr('style');
                    $("#div_password_t").attr('style', 'display:none');
                }


                $("#chbtrabajador").iCheck('uncheck');
                //$("#chbtrabajador").click();
                $("#chbtrabajador").iCheck('check');
                $("#cbarea").val(jsonResultado.datos.area);
                $("#cbcargo").val(jsonResultado.datos.cargo);
            } else {
                //$("#chbtrabajador").removeAttr('checked');
                $("#chbtrabajador").iCheck('uncheck');
                $("#cbos_cargo_area").attr('style', 'display:none');

                $("#div_password_t").attr('style', 'display:none');

            }
            var dni_ruc = jsonResultado.datos.dni_ruc;

            $("#txtdni_ruc").val(jsonResultado.datos.dni);

            $("#txtapellidos").val(jsonResultado.datos.apellidos);
            $("#txtnombres").val(jsonResultado.datos.nombres);
            $("#txtfecha_nacimiento").val(jsonResultado.datos.fecha_nacimiento);
            $("#txtdireccion").val(jsonResultado.datos.direccion);
            $("#txtemail").val(jsonResultado.datos.email);
            $("#txttelefono").val(jsonResultado.datos.telefono);


        }
    }).fail(function (error) {
        var datosJSON = $.parseJSON(error.responseText);
        swal("Error", datosJSON.mensaje, "error");
    });
}


function validar_direccion() {

    swal({
        title: "Confirme",
        text: "¿Desea validar la dirección de este cliente ?",
        showCancelButton: true,
        confirmButtonColor: '#3d9205',
        confirmButtonText: 'Si',
        cancelButtonText: "No",
        closeOnConfirm: false,
        closeOnCancel: true,
        imageUrl: "../images/pregunta.png"
    },
            function (isConfirm) {


            });

}

$('#chbcliente').on('ifChanged', function (e) {
    habilitar_cliente();

});
$('#chbcliente').on('ifChecked', function (event) {
    $("#div_new_password").attr('style', 'display:none');//Nuevo Password
    $("#div_password").attr('style', 'display:none');
    $("#p_1bl").attr('style', 'display:none');
    $("#p_txt").attr('style', 'display:none');

    if (usuario === 'si') {
        $("#div_password_c").attr('style', 'display:block');
    }
//    alert(editar);
//    alert(aux_usuario);
    if (editar === 1) {
        if (aux_usuario === true || usuario === 'si') {

            $("#div_password_c").attr('style', 'display:block');
            $("#div_chk_password1_c").attr('style', 'display:block');
            $("#div_chk_password2_c").attr('style', 'display:block');

        } else {
            if (aux_usuario === false || usuario === 'no') {
                $("#div_password_c").attr('style', 'display:none');
                $("#div_chk_password1_c").attr('style', 'display:none');
                $("#div_chk_password2_c").attr('style', 'display:none');
            }

        }
//        $("#txt_password_c").attr('readonly', '" "');
//        $("#div_chk_password1_c").attr('style', 'display_block');
//        $("#div_chk_password2_c").attr('style', 'display_block');
    }
});
$('#chbcliente').on('ifUnchecked', function (event) {

    if (trabajador === 't') {
        $("#div_new_password").attr('style', 'display:none');//Nuevo Password
        $("#div_password").attr('style', 'display:none');
        $("#p_1bl").attr('style', 'display:none');
        $("#p_txt").attr('style', 'display:none');

        if (editar === 1) {
            //alert(editar);
            $("#txt_password").attr('readonly', '" "');
            $("#div_chk_password1").attr('style', 'display:block');
            $("#div_chk_password2").attr('style', 'display:block');

            $("#chb_cambiar_password_c").iCheck('uncheck');
            $("#div_new_password_c").attr('style', 'display:none');
            $("#div_password_c").attr('style', 'display:none');
        }
    } else {
        $("#div_password").attr('style', 'display:block');
        $("#p_1bl").attr('style', 'display:block');
        $("#p_txt").attr('style', 'display:block');
        if (editar === 1) {

            $("#txt_password").attr('readonly', '" "');
            $("#chb_cambiar_password_c").iCheck('uncheck');
            $("#div_new_password_c").attr('style', 'display:none');
            $("#div_password_c").attr('style', 'display:none');
        }
        if (usuario === 'si') {
            $("#div_password").attr('style', 'display:block');
            $("#p_1bl").attr('style', 'display:block');
            $("#p_txt").attr('style', 'display:block');
            $("#div_password_c").attr('style', 'display:none');
            $("#div_chk_password1").attr('style', 'display:block');
            $("#div_chk_password2").attr('style', 'display:block')
        } else {
            $("#div_password").attr('style', 'display:none');
        }
    }

});

$('#chbtrabajador').on('ifChanged', function (e) {
    habilitar_trabajador();

});
$('#chbtrabajador').on('ifChecked', function (event) {
    $("#div_new_password").attr('style', 'display:none');//Nuevo Password
    $("#div_password").attr('style', 'display:none');
    $("#p_1bl").attr('style', 'display:none');
    $("#p_txt").attr('style', 'display:none');
    if (usuario === 'si') {
        //alert("1");
        $("#div_password_t").attr('style', 'display:block');
    }
    if (editar === 1) {
//        if(aux_usuario===true){
        if (aux_usuario === true || usuario === 'si') {
            //alert("2");
            $("#div_password_t").attr('style', 'display:block');
            $("#div_chk_password1_t").attr('style', 'display:block');
            $("#div_chk_password2_t").attr('style', 'display:block');
        } else {
            if (aux_usuario === false || usuario === 'no') {
                $("#div_password_t").attr('style', 'display:none');
                $("#div_chk_password1_t").attr('style', 'display:none');
                $("#div_chk_password2_t").attr('style', 'display:none');
            }

        }

//        }

    }
});
$('#chbtrabajador').on('ifUnchecked', function (event) {
    if (cliente === 'c') {
        $("#div_new_password").attr('style', 'display:none');//Nuevo Password
        $("#div_password").attr('style', 'display:none');
        $("#p_1bl").attr('style', 'display:none');
        $("#p_txt").attr('style', 'display:none');
        if (editar === 1) {
            $("#txt_password").attr('readonly', '" "');
            $("#div_chk_password1").attr('style', 'display:block');
            $("#div_chk_password2").attr('style', 'display:block');

            $("#chb_cambiar_password_t").iCheck('uncheck');
            $("#div_new_password_t").attr('style', 'display:none');
            $("#div_password_t").attr('style', 'display:none');
        }
    } else {

        if (editar === 1) {
            alert(editar);
            $("#txt_password").attr('readonly', '" "');
            $("#chb_cambiar_password_t").iCheck('uncheck');
            $("#div_new_password_t").attr('style', 'display:none');
            $("#div_password_t").attr('style', 'display:none');
        }
        if (usuario === 'si') {
            $("#div_password").attr('style', 'display:block');
            $("#p_1bl").attr('style', 'display:block');
            $("#p_txt").attr('style', 'display:block');
            $("#div_password_t").attr('style', 'display:none');
            $("#div_chk_password1").attr('style', 'display:block');
            $("#div_chk_password2").attr('style', 'display:block')
        } else {
            $("#div_password").attr('style', 'display:none');
        }


    }
});