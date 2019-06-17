$(document).ready(function () {
    cargar_zona();


});
var tipo_cliente = null;
var telefono = null;
function cargar_zona(){

    $.post
    (
        "../controller/Zona.cargar.datos.controller.php"
    ).done(function(resultado){
        var datosJSON = resultado;
        //console.log(resultado);

        if (datosJSON.estado===200){
            var html = "";

            html += '<option value="">Seleccione zona</option>';
            $.each(datosJSON.datos, function(i,item) {
                html += '<option value="'+item.id+'">'+item.nombre+'</option>';
            });

            $("#combo_zona").html(html);
            var id = $("#s_user_id").val();
            mis_datos(id);
        }else{
            swal("Mensaje del sistema", resultado , "warning");
        }
    }).fail(function(error){
        var datosJSON = $.parseJSON( error.responseText );
        swal("Error", datosJSON.mensaje , "error");
    });
}
var persona_id = null;
function habilitar(){

    $("#txt_dni_ruc").removeAttr('disabled');
    $("#txt_razon_social").removeAttr('disabled');
    $("#txt_apellidos").removeAttr('disabled');
    $("#txt_nombres").removeAttr('disabled');
    $("#txt_address").removeAttr('disabled');
    $("#combo_zona").removeAttr('disabled');
    $("#txt_email").removeAttr('disabled');
    $("#txt_fn").removeAttr('disabled');
    $("#divcheck_contrasenia").removeAttr('style');
}

function mis_datos(id) {
    var data = {
        id: id
    }

    $.post
    (
        "../controller/Usuario_read_controller.php",data
    ).done(function (resultado) {
        console.log(resultado);
        var jsonResultado = resultado;
        if (jsonResultado.estado === 200) {
            //habilitar();
            persona_id = jsonResultado.datos.id_persona;
            telefono = jsonResultado.datos.telefono;
            tipo_cliente = jsonResultado.datos.tipo_cliente;
            var dni_ruc = jsonResultado.datos.dni_ruc;
            console.log(dni_ruc);
            $("#txt_dni_ruc").val(jsonResultado.datos.dni);
            name();
            $("#txt_razon_social").val(jsonResultado.datos.razon_social);
            $("#txt_apellidos").val(jsonResultado.datos.apellidos);
            $("#txt_nombres").val(jsonResultado.datos.nombres);
            $("#txt_address").val(jsonResultado.datos.direccion);
            $("#combo_zona").val(jsonResultado.datos.id_zona);
            $("#txt_email").val(jsonResultado.datos.email);
            $("#txt_fn").val(jsonResultado.datos.fecha_nacimiento);
        }
    }).fail(function (error) {
        console.log(error);
        var datosJSON = $.parseJSON(error.responseText);
        swal("Error", datosJSON.mensaje, "error");
    });
}

function name(){
    var len = $("#txt_dni_ruc").val()

    if(tipo_cliente =='p'){
        $("#div_apellidos").removeAttr('style');
        $("#div_nombres").removeAttr('style');
    } else{
        $("#div_razon").removeAttr('style');
    }
}

$('#check_contrasenia').on('ifChecked', function (event) {
    $("#txtcontrasenia").removeAttr('disabled');

});

$('#check_contrasenia').on('ifUnchecked', function (event) {
    $("#txtcontrasenia").attr('disabled', 'disabled');
    $("#divnueva_contrasenia").attr('style', 'display:none');
});

function validar_password() {

    var data = {
        'id': $("#s_user_id").val(),
        'password': $("#txtcontrasenia").val()
    };
    console.log(data);
    $.ajax({
        data: data,
        url: "../controller/User_validar_password.php",
        type: "post",
        success: function (resultado) {
            console.log(resultado);
            if (resultado.datos == '1') {
                $("#divnueva_contrasenia").removeAttr('style');

                swal({title: "Exito", text: "Contraseña Valida!!", type: "success"}, function (isConfirm) {
                    if (isConfirm) {
                        $("#txtcontrasenia").attr('readonly', 'readonly');
                        $("#txtnueva_contrasenia").removeAttr('readonly');
                        $("#txtnueva_contrasenia").focus();
                    }
                });
                ;

            } else {
                if (resultado.datos == '0') {
                    swal("Nota", "Contraseña N0 Valida!!", "info");
                    $("#txtcontrasenia").val("");

                } else {
                    swal("Nota", "No hubo resultado en la búsqueda", "info");
                    $("#txtcontrasenia").val("");
                }
            }


        },
        error: function (error) {
            console.log(error);
            var datosJSON = $.parseJSON(error.responseText);
            swal("Error", datosJSON.mensaje, "error");
        }
    });


}

function editar(){
    habilitar();
}

function guardar(){
    var data =  {
        p_usuario: "si",
        p_id_persona: persona_id,
        p_tipo_usuario: 3,
        p_password: null,
        p_new_password: null,
        p_password_c: $("#txtcontrasenia").val(),
        p_new_password_c: $("#txtnueva_contrasenia").val(),
        p_password_t: null,
        p_new_password_t: null,
        p_cliente: 'c',
        p_tipo_cliente: tipo_cliente,
        p_trabajador: "",
        p_area: null,
        p_cargo: null,
        p_dni_ruc: $("#txt_dni_ruc").val(),
        p_razon_social: $("#txt_razon_social").val(),
        p_apellidos: $("#txt_apellidos").val(),
        p_nombres: $("#txt_nombres").val(),
        p_fecha_nacimiento: $("#txt_fn").val(),
        p_direccion: $("#txt_address").val(),
        p_email: $("#txt_email").val(),
        p_telefono: telefono,
        p_id_zona: $("#combo_zona").val(),
        p_operacion: "editar"


    };
    console.log(data);
    $.post(
        "../controller/Persona.agregar.editar.controller.php",data

    ).done(function (resultado) {

        //console.log(resultado);
        var datosJSON = resultado;

        if (datosJSON.estado === 200) {
            swal("Genial !", datosJSON.mensaje, "success");
        } else {
            swal("Mensaje del sistema", resultado, "info");
        }

    }).fail(function (error) {
        console.log(error);
        var datosJSON = $.parseJSON(error.responseText);
        swal("Error", datosJSON.mensaje, "error");
    });
}

function validate_address(){
    var address = $("#buscar").val();
    console.log(address);
    $("#txt_address").val(address);
    //guardar_direccion();
}