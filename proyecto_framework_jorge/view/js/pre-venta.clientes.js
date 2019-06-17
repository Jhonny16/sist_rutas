var list_clientes;

$(document).ready(function () {
    list_clientes();

});


function list_clientes() {
    $.post
   (
                    "../controller/Persona.cliente.listar.controller.php"

                    ).done(function (resultado) {

        //console.log(resultado);
        var datosJSON = resultado;
        list_clientes="";
        list_clientes = resultado;
        // alert(resultado);

        if (datosJSON.estado === 200) {
            var html = "";

//            html += '<small>';
            html += '<table id="tbl_list_clientes" class="table table-striped table-bordered bulk_action" style="width:100%">';
            html += '<thead>';
            html += '<tr style="background-color: #ededed">';
            html += '<th style="text-align: center">Seleccionar</th>';
            html += '<th>Cliente</th>';
            html += '<th>Dirección</th>';
            html += '</tr>';
            html += '</thead>';
            html += '<tbody>';

            //Detalle
            $.each(datosJSON.datos, function (i, item) {

                html += '<tr>';
                html += '<td align="center">';
                html += '<input type="checkbox" id="id_cli'+item.id+'" onclick="pr_seleccion_cliente('+item.id+')">';
                html += '</td>';
                html += '<td id="">' + item.nc + '</td>';
                html += '<td style="color:#2a85a0" >' + item.direccion + '</td>';
                html += '</tr>';
            });

            html += '</tbody>';
            html += '</table>';
//            html += '</small>';

            $("#list_clientes").html(html);
            $('#tbl_list_clientes').DataTable({
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

function pr_seleccion_cliente(id){
    var pos=0;
    $.each(list_clientes.datos, function (i, item) {
        if (item.id === id) {
            pos = i;

        }
    });
    
     $("#id_cli"+id+"").click();
    
    $("#pv_cl_codigo").val(list_clientes.datos[pos].id);
    $("#pv_cl_dni_ruc").val(list_clientes.datos[pos].dni_ruc);
    $("#pv_cl_nc").val(list_clientes.datos[pos].nc);
    $("#pv_cl_direccion").val(list_clientes.datos[pos].direccion);
    $("#btn_pr_cliente_close").click();
     
    
}