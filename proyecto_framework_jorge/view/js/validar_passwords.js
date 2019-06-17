function validar_password() {
    if (editar === 1) {

        var password = $("#txt_password").val();
        $.post(
            "../controller/Persona.password.validar.controller.php",
            {
                p_type_user: 1,
                p_password: password
            }
        ).done(function (resultado) {

            //console.log(resultado);
            var datosJSON = resultado;

            if (datosJSON.estado === 200) {

                console.log(datosJSON.datos);
                if (datosJSON.datos[0].valor === "1") {
                    swal("Info", "Password Correcto", "success");
                    $("#txt_new_password").focus();
                } else {
                    swal("Alerta", "El password ingresado es incorrecto", "success");
                    $("#txt_password").focus();
                }
            } else {
                swal("Mensaje del sistema", resultado, "warning");
            }

        }).fail(function (error) {
            var datosJSON = $.parseJSON(error.responseText);
            swal("Error", datosJSON.mensaje, "error");
        });
    }
}


function validar_password_cliente() {
    if (editar === 1) {

        var password = $("#txt_password_c").val();
        $.post(
            "../controller/Persona.password.validar.controller.php",
            {
                p_type_user: 2,
                p_password: password
            }
        ).done(function (resultado) {

            //console.log(resultado);
            var datosJSON = resultado;

            if (datosJSON.estado === 200) {

                console.log(datosJSON.datos);
                if (datosJSON.datos[0].valor === "1") {
                    swal("Info", "Password Correcto", "success");
                    $("#txt_new_password_c").focus();
                } else {
                    swal("Alerta", "El password ingresado es incorrecto", "success");
                    $("#txt_password_c").focus();
                }
            } else {
                swal("Mensaje del sistema", resultado, "warning");
            }

        }).fail(function (error) {
            var datosJSON = $.parseJSON(error.responseText);
            swal("Error", datosJSON.mensaje, "error");
        });
    }
}
var count = 0;
function validar_password_personal() {
    console.log(count);
    if(count==0){
        if (editar === 1) {

            var password = $("#txt_password_t").val();
            var persona_id = $("#txtid_persona").val();

            var data = {
                p_type_user: 5,
                p_password: password,
                persona_id : persona_id
            };
            console.log(data);
            $.post(
                "../controller/Persona.password.validar.controller.php",
                data
            ).done(function (resultado) {

                console.log(resultado);
                var datosJSON = resultado;

                if (datosJSON.estado === 200) {

                    console.log(datosJSON.datos);
                    if (datosJSON.datos.length==0){
                        count=1;
                        swal("Nota", "Ingrese password y repita el password en la siguiente casilla", "info");
                        $("#txt_password_t").focus();
                    }else{
                        if (datosJSON.datos[0].valor == 1) {
                            swal("Info", "Password Correcto", "success");
                            $("#txt_new_password_t").focus();
                        } else {
                            swal("Alerta", "El password ingresado es incorrecto", "success");
                            $("#txt_password_t").focus();
                        }
                    }


                } else {
                    swal("Mensaje del sistema", resultado, "warning");
                }

            }).fail(function (error) {
                var datosJSON = $.parseJSON(error.responseText);
                swal("Error", datosJSON.mensaje, "error");
            });
        }
    }
}