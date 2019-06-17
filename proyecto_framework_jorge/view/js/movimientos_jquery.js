var usuario = "si";
var tipo_usuario = "";
var cliente = "c";
var trabajador="";
var tipo_cliente = "p";

$('#rbsi').on('ifChecked', function (event) {
    $("#rbsi").iCheck('check');
    usuario = $("#rbsi").val();
    $("#cbotipo_usuario").attr('style', 'display:block');
    if (nuevo === 1) {//CUANDO AGREGO
        if ($("#chbcliente").prop('checked') && $("#chbtrabajador").prop('checked')) {
            $("#div_password_c").attr('style', 'display:block');
            $("#div_password_t").attr('style', 'display:block');
        } else {
            if ($("#chbcliente").prop('checked')) {
                $("#div_password_c").attr('style', 'display:block');
            } else {
                if ($("#chbtrabajador").prop('checked')) {
                    $("#div_password_t").attr('style', 'display:block');
                } else {
                    $("#div_password").attr('style', 'display:block');
                }

            }

        }


    } else {//CUANDO EDITO
        if ($("#chbcliente").prop('checked') && $("#chbtrabajador").prop('checked')) {
            $("#div_password_c").attr('style', 'display:block');
            $("#txt_password_c").attr('readonly', '" "');
            $("#div_chk_password1_c").attr('style', 'display:block');
            $("#div_chk_password2_c").attr('style', 'display:block');

            $("#div_password_t").attr('style', 'display:block');
            $("#txt_password_t").attr('readonly', '" "');
            $("#div_chk_password1_t").attr('style', 'display:block');
            $("#div_chk_password2_t").attr('style', 'display:block');
        } else {
            if ($("#chbcliente").prop('checked')) {
                $("#div_password_c").attr('style', 'display:block');
                $("#txt_password_c").attr('readonly', '" "');
                $("#div_chk_password1_c").attr('style', 'display:block');
                $("#div_chk_password2_c").attr('style', 'display:block');
            } else {
                if ($("#chbtrabajador").prop('checked')) {
                    $("#div_password_t").attr('style', 'display:block');
                    $("#txt_password_t").attr('readonly', '" "');
                    $("#div_chk_password1_t").attr('style', 'display:block');
                    $("#div_chk_password2_t").attr('style', 'display:block');
                } else {
                    $("#div_password").attr('style', 'display:block');
                    $("#txt_password").attr('readonly', '" "');
                    $("#div_chk_password1").attr('style', 'display:block');
                    $("#div_chk_password2").attr('style', 'display:block');
                }

            }

        }

    }

});

$('#rbno').on('ifChecked', function (event) {
    $("#rbno").iCheck('check');
    usuario = $("#rbno").val();
    $("#cbotipo_usuario").attr('style', 'display:none');
    if (nuevo === 1) {
        $("#div_password").attr('style', 'display:none');
        $("#div_password_c").attr('style', 'display:none');
        $("#div_password_t").attr('style', 'display:none');

    } else {
        $("#div_password").attr('style', 'display:none');
        $("#div_password_c").attr('style', 'display:none');
        $("#div_password_t").attr('style', 'display:none');
        $("#chb_cambiar_password").iCheck('uncheck');

    }

});

$('#chbcliente').on('ifChecked', function (event) {
    //cargar_tipo_usuario();
    $("#cbtipo_usuario").val(3);
    $("#cbtipo_usuario").attr('disabled','disabled');
    $("#rbs_tipo_cliente").attr('style', 'display:block');
    $("#div_zona").attr('style', 'display:block');
    cliente = $("#chbcliente").val();
    $("#chbcliente").iCheck('check');
    if (nuevo === 1) {
        if ($("#rbsi").prop('checked')) {
            $("#div_password").attr('style', 'display:none');
            $("#div_password_c").attr('style', 'display:block');
        }
    } else {
        if ($("#rbsi").prop('checked')) {
            $("#div_password").attr('style', 'display:none');
            $("#div_password_c").attr('style', 'display:block');
            $("#txt_password_c").attr('readonly', '" "');


            $("#div_chk_password1_c").attr('style', 'display:block');
            $("#div_chk_password2_c").attr('style', 'display:block');
        }
    }



});
$('#chbcliente').on('ifUnchecked', function (event) {
    //cargar_tipo_usuario();
    $("#cbtipo_usuario").removeAttr('disabled');
    $("#rbs_tipo_cliente").attr('style', 'display:none');
    $("#div_zona").attr('style', 'display:none');
    cliente = "";
    $("#chbcliente").iCheck('Uncheck');
    if (nuevo === 1) {
        if ($("#chbtrabajador").prop('checked')) {
            $("#div_password_c").attr('style', 'display:none');
        } else {
            if ($("#rbsi").prop('checked')) {
                $("#div_password_c").attr('style', 'display:none');
                $("#div_password").attr('style', 'display:block');
            } else {
                $("#div_password").attr('style', 'display:none');
            }
        }

    } else {
        if ($("#chbtrabajador").prop('checked')) {
            $("#div_password_c").attr('style', 'display:none');
        } else {
            if ($("#rbsi").prop('checked')) {
                $("#div_password_c").attr('style', 'display:none');
                $("#div_password").attr('style', 'display:block');
                $("#txt_password").attr('readonly', '" "');
                $("#div_chk_password1").attr('style', 'display:block');
                $("#div_chk_password2").attr('style', 'display:block');

            } else {
                $("#div_password").attr('style', 'display:none');
            }
        }
    }



});
$('#chbtrabajador').on('ifChecked', function (event) {
    //cargar_tipo_usuario();
    //var x = document.getElementById("cbtipo_usuario");
    //x.remove(2);
    //$("#cbtipo_usuario").remove(2);
    $("#cbos_cargo_area").attr('style', 'display:block');
    trabajador = $("#chbtrabajador").val();
    $("#chbtrabajador").iCheck('check');
    if (nuevo === 1) {
        if ($("#rbsi").prop('checked')) {
            $("#div_password").attr('style', 'display:none');
            $("#div_password_t").attr('style', 'display:block');
        }
    } else {
        if ($("#rbsi").prop('checked')) {
            $("#div_password").attr('style', 'display:none');
            $("#div_password_t").attr('style', 'display:block');
            $("#txt_password_t").attr('readonly', '" "');


            $("#div_chk_password1_t").attr('style', 'display:block');
            $("#div_chk_password2_t").attr('style', 'display:block');
        }
    }



});
$('#chbtrabajador').on('ifUnchecked', function (event) {
    //cargar_tipo_usuario();
    $("#cbos_cargo_area").attr('style', 'display:none');
    trabajador = "";
    if (nuevo === 1) {
        if ($("#chbcliente").prop('checked')) {
            $("#div_password_t").attr('style', 'display:none');
        } else {
            if ($("#rbsi").prop('checked')) {

                $("#div_password_t").attr('style', 'display:none');
                $("#div_password").attr('style', 'display:block');
            } else {
                $("#div_password").attr('style', 'display:none');
            }

        }
    }else {
        if ($("#chbcliente").prop('checked')) {
            $("#div_password_t").attr('style', 'display:none');
        } else {
            if ($("#rbsi").prop('checked')) {
                $("#div_password_t").attr('style', 'display:none');
                $("#div_password").attr('style', 'display:block');
                $("#txt_password").attr('readonly', '" "');
                $("#div_chk_password1").attr('style', 'display:block');
                $("#div_chk_password2").attr('style', 'display:block');

            } else {
                $("#div_password").attr('style', 'display:none');
            }
        }
    }

});
$('#rbpersona_natural').on('ifChecked', function (event) {
    tipo_cliente = $("#rbpersona_natural").val();
    $("#div_razon_social").attr('style','display:none');
    $("#div_apellidos").attr('style','display:block');
    $("#div_nombres").attr('style','display:block');
    $("#div_fn").attr('style','display:block');

});
$('#rbempresa').on('ifChecked', function (event) {
    tipo_cliente = $("#rbempresa").val();
    $("#div_razon_social").attr('style','display:block');
    $("#div_apellidos").attr('style','display:none');
    $("#div_nombres").attr('style','display:none');
    $("#div_fn").attr('style','display:none');

});

var cambio_password = 0;

$('#chb_cambiar_password').on('ifChecked', function (event) {
    cambio_password= 1;
    if (editar === 1) {
        $("#txt_password").removeAttr('readonly');
        $("#div_new_password").attr('style', 'display:block');
    }
});
$('#chb_cambiar_password').on('ifUnchecked', function (event) {
    cambio_password =0;
    if (editar === 1) {
        $("#txt_password").attr('readonly', '" "');
        $("#div_new_password").attr('style', 'display:none');
    }
});
$('#chb_cambiar_password_c').on('ifChecked', function (event) {
    cambio_password = 1;
    if (editar === 1) {
        $("#txt_password_c").removeAttr('readonly');
        $("#div_new_password_c").attr('style', 'display:block');
    }
});
$('#chb_cambiar_password_c').on('ifUnchecked', function (event) {
    cambio_password =0;
    if (editar === 1) {
        $("#txt_password_c").attr('readonly', '" "');
        $("#div_new_password_c").attr('style', 'display:none');
    }
});
$('#chb_cambiar_password_t').on('ifChecked', function (event) {
    cambio_password = 1;
    if (editar === 1) {
        $("#txt_password_t").removeAttr('readonly');
        $("#div_new_password_t").attr('style', 'display:block');
    }
});
$('#chb_cambiar_password_t').on('ifUnchecked', function (event) {
    cambio_password = 0;
    if (editar === 1) {
        $("#txt_password_t").attr('readonly', '" "');
        $("#div_new_password_t").attr('style', 'display:none');
    }
});


