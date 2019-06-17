$(document).ready(function(){
    cargar_tipo_usuario();
    });



function cargar_tipo_usuario(){
    $.post
    (
	"../controller/TipoUsuario.cargar.datos.controller.php"
    ).done(function(resultado){
	var datosJSON = resultado;
        console.log(resultado);
	
        if (datosJSON.estado===200){
            var html = "";
            
                html += '<option value="">Seleccione tipo usuario</option>';            
            $.each(datosJSON.datos, function(i,item) {
                html += '<option value="'+item.id+'">'+item.nombre+'</option>';
            });
            
            $("#cbtipo_usuario").html(html);
	}else{
            swal("Mensaje del sistema", resultado , "warning");
        }
    }).fail(function(error){
	var datosJSON = $.parseJSON( error.responseText );
	swal("Error", datosJSON.mensaje , "error");
    });
}
