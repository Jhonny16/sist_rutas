$(document).ready(function(){
    cargar_zona();    
   cargar_zona_preVenta();
   cargar_zona_algoritmo();
});

function cargar_zona_algoritmo(){ 
    
    $.post
    (
	"../controller/Zona.cargar.datos.controller.php"
    ).done(function(resultado){
	var datosJSON = resultado;
        //console.log(resultado);
	
        if (datosJSON.estado===200){
            var html = "";
            
                html += '<option value="0">Todas las zonas</option>';            
            $.each(datosJSON.datos, function(i,item) {
                html += '<option value="'+item.id+'">'+item.nombre+'</option>';
            });
            
            $("#cbx_zona_pv_algoritmo").html(html);
	}else{
            swal("Mensaje del sistema", resultado , "warning");
        }
    }).fail(function(error){
	var datosJSON = $.parseJSON( error.responseText );
	swal("Error", datosJSON.mensaje , "error");
    });
}

function cargar_zona_preVenta(){ 
    
    $.post
    (
	"../controller/Zona.cargar.datos.controller.php"
    ).done(function(resultado){
	var datosJSON = resultado;
        //console.log(resultado);
	
        if (datosJSON.estado===200){
            var html = "";
            
                html += '<option value="0">Todas las zonas</option>';            
            $.each(datosJSON.datos, function(i,item) {
                html += '<option value="'+item.id+'">'+item.nombre+'</option>';
            });
            
            $("#cbx_zona_pv").html(html);
	}else{
            swal("Mensaje del sistema", resultado , "warning");
        }
    }).fail(function(error){
	var datosJSON = $.parseJSON( error.responseText );
	swal("Error", datosJSON.mensaje , "error");
    });
}


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
            
            $("#cbx_zona").html(html);
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



