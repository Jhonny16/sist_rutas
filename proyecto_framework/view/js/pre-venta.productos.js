var param= 0;
var list_productos;
$(document).ready(function () {
    list_productos();

});


function list_productos() {
    $.post
   (
                    "../controller/Producto.listar.controller.php",{
                       p_param: param
                    }

                    ).done(function (resultado) {

        //console.log(resultado);
        var datosJSON = resultado;
        list_productos="";
        list_productos = resultado;
        // alert(resultado);

        if (datosJSON.estado === 200) {
            var html = "";

//            html += '<small>';
            html += '<table id="tbl_list_productos" class="table table-striped table-bordered bulk_action" style="width:100%">';
            html += '<thead>';
            html += '<tr style="background-color: #ededed">';
            html += '<th style="text-align: center">Seleccionar</th>';
            html += '<th>Producto</th>';
            html += '<th>Precio</th>';
            html += '<th>Stock</th>';
            html += '<th>Unidad Medida</th>';
            html += '<th>Tipo</th>';
            html += '</tr>';
            html += '</thead>';
            html += '<tbody>';

            //Detalle
            $.each(datosJSON.datos, function (i, item) {

                html += '<tr>';
                html += '<td align="center">';
                html += '<input type="checkbox" id="id_pro'+item.id+'" onclick="pr_seleccion_producto('+item.id+')">';
                html += '</td>';
                html += '<td>' + item.nombre + '</td>';
                html += '<td>' + item.precio + '</td>';
                html += '<td>' + item.cantidad + '</td>';
                html += '<td>' + item.unidad_medida + '</td>';
                html += '<td>' + item.tipo + '</td>';
                html += '</tr>';
            });

            html += '</tbody>';
            html += '</table>';
//            html += '</small>';

            $("#list_productos").html(html);
            $('#tbl_list_productos').DataTable({
//                "sScrollX": "100%",
//                "sScrollXInner": "100%",
//                "bScrollCollapse": true,
                "bPaginate": true
            });



        } else {
            swal("Mensaje del sistema", resultado, "warning");
        }

    }).fail(function (error) {
        var datosJSON = $.parseJSON(error.responseText);
        //swal("Error", datosJSON.mensaje , "error"); 
    });


}

function pr_seleccion_producto(id){
    var pos=0;
    $.each(list_productos.datos, function (i, item) {
        if (item.id === id) {
            pos = i;

        }
    });
    
    $("#id_pro"+id+"").click();
    
    $("#pv_pr_codigo").val(list_productos.datos[pos].id);
    $("#pv_pr_nombre").val(list_productos.datos[pos].nombre);
    $("#pv_pr_unidad_medida").val(list_productos.datos[pos].unidad_medida);
    $("#pv_pr_precio").val(list_productos.datos[pos].precio);    
    $("#pv_pr_stock").val(list_productos.datos[pos].cantidad);    
    
    
    $("#btn_pr_producto_close").click();
    
    $("#pv_pr_cantidad").focus();
    
     
    
}

