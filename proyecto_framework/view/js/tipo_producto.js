$(document).ready(function(){
    tipo_producto();
    cmb_tipo_producto();
});
function tipo_producto(){ 
    
    $.post
    (
	"../controller/Tipo_producto.cargar.datos.controller.php"
    ).done(function(resultado){
	var datosJSON = resultado;
        //console.log(resultado);
	
        if (datosJSON.estado===200){
            var html = "";
            
                html += '<option value=""> -- Seleccione--</option>';            
            $.each(datosJSON.datos, function(i,item) {
                html += '<option value="'+item.id+'">'+item.nombre+'</option>';
            });
            
            $("#cbtipo_producto").html(html);
	}else{
            swal("Mensaje del sistema", resultado , "warning");
        }
    }).fail(function(error){
	var datosJSON = $.parseJSON( error.responseText );
	swal("Error", datosJSON.mensaje , "error");
    });
}

function cmb_tipo_producto(){
     
    $.post
    (
	"../controller/Tipo_producto.cargar.datos.controller.php"
    ).done(function(resultado){
	var datosJSON = resultado;
        //console.log(resultado);
	
        if (datosJSON.estado===200){
            var html = "";
            
                html += '<option value="0"> -- Todos los productos --</option>';            
            $.each(datosJSON.datos, function(i,item) {
                html += '<option value="'+item.id+'">'+item.nombre+'</option>';
            });
            
            $("#cbx_selec_tipo_productos").html(html);
	}else{
            swal("Mensaje del sistema", resultado , "warning");
        }
    }).fail(function(error){
	var datosJSON = $.parseJSON( error.responseText );
	swal("Error", datosJSON.mensaje , "error");
    });
    
}






