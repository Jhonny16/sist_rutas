/**
 * Created by tito_ on 09/12/2018.
 */
$('#password_si').on('ifChecked', function (event) {
   $("#password_user").removeAttr('readonly');
   $("#div_new_password").removeAttr('style');
});
$('#password_no').on('ifChecked', function (event) {
    $("#password_user").val("");
    $("#new_password_user").val("");
    $("#password_user").attr('readonly','readonly');
    $("#div_new_password").attr('style','display:none');
});

function validar_password(){
    if(editar===1){

        var password= $("#txt_password").val();
        $.post(
            "../controller/Persona.password.validar.controller.php",
            {
                p_type_user: 1,
                p_password: password}
        ).done(function (resultado) {

            //console.log(resultado);
            var datosJSON = resultado;

            if (datosJSON.estado === 200) {

                console.log(datosJSON.datos);
                // if($("#txtTipoOperacion").val() == 'editar'){
                //     $("#txt_password").attr('style','display:none');
                //     $("#txt_new_password").focus();
                // }
                if (datosJSON.datos[0].valor === "1"){
                    $("#txt_password").val(datosJSON.datos.password)
                    swal("Bien!","Password Correcto", "success");
                    $("#txt_new_password").focus();
                }else{
                    swal("Alerta","El password ingresado es incorrecto.", "warning");
                    return 0;
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

