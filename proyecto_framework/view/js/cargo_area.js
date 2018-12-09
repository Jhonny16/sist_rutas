$(document).ready(function(){
    cargar_area();
    cargar_cargo();
    
});



function cargar_area(){ 
    
    $.post
    (
	"../controller/Area.cargar.datos.controller.php"
    ).done(function(resultado){
	var datosJSON = resultado;
        //console.log(resultado);
	
        if (datosJSON.estado===200){
            var html = "";
            
                html += '<option value="">Seleccione Área</option>';            
            $.each(datosJSON.datos, function(i,item) {
                html += '<option value="'+item.id+'">'+item.nombre+'</option>';
            });
            
            $("#cbarea").html(html);
	}else{
            swal("Mensaje del sistema", resultado , "warning");
        }
    }).fail(function(error){
	var datosJSON = $.parseJSON( error.responseText );
	swal("Error", datosJSON.mensaje , "error");
    });
}

function cargar_cargo(){
    $.post
    (
	"../controller/Cargo.cargar.datos.controller.php"
    ).done(function(resultado){
	var datosJSON = resultado;
        //console.log(resultado);
	
        if (datosJSON.estado===200){
            var html = "";
            
                html += '<option value="">Seleccione Cargo</option>';            
            $.each(datosJSON.datos, function(i,item) {
                html += '<option value="'+item.id+'">'+item.descripcion+'</option>';
            });
            
            $("#cbcargo").html(html);
	}else{
            swal("Mensaje del sistema", resultado , "warning");
        }
    }).fail(function(error){
	var datosJSON = $.parseJSON( error.responseText );
	swal("Error", datosJSON.mensaje , "error");
    });
}