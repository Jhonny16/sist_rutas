function evaluar_password(){
    var id_persona=$("#txtid_persona").val();
    var password = $("#txt_password").val();
    
    
    if(auxiliar === 1){
         $.post
            (
                    "../controller/Puntos.cargar.controller.php", {
                        p_tipo: 'i'
                    }

            ).done(function (resultado) {
        var datosJSON = resultado;
        if (datosJSON.estado === 200) {
                        
           


        } else {
            swal("Mensaje del sistema", resultado, "warning");
        }

    }).fail(function (error) {
        var datosJSON = $.parseJSON(error.responseText);
        //swal("Error", datosJSON.mensaje , "error"); 
    });
        
        
    }
}

