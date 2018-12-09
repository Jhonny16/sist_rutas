$("#btn_agregar_pv").click(function () {
//    var x = $("#txtnc").val();
//fecha();
    if ($("#pv_pr_codigo").val().toString() === "") {
        alert("Debe seleccionar un Producto");
//        $("#txtproducto").val("");
//        $("#txtprecio").val("");
//        $("#txtcantidad").val("");
//        $("#ap").focus();
        return 0;
    }

    var codigo = $("#pv_pr_codigo").val();
    var nombre = $("#pv_pr_nombre").val();
    var unidad_medida = $("#pv_pr_unidad_medida").val();
    var precio = $("#pv_pr_precio").val();
    var cantidad = $("#pv_pr_cantidad").val();
    var stock = $("#pv_pr_stock").val();
    var importe = precio * cantidad;

    var fila = "<tr>" +
            "<td>" + codigo + "</td>" +
            "<td>" + nombre + "</td>" +
            "<td style=\"text-align: right\" >" + precio + "</td>" +
            "<td style=\"text-align: right\" id=\"ccantidad\" >" + cantidad + "</td>" +
            "<td style=\"text-align: right\">" + unidad_medida + "</td>" +
            "<td style=\"text-align: right\" id=>" + importe + "</td>" +
            "<td align=\"center\" id=\"celiminar\"><a href=\"javascript:void();\"><i class=\"fa fa-trash text-orange\"></i></a></td>" +
            "</tr>";


    if (parseInt(cantidad) > parseInt(stock)) {
        $("#pv_pr_cantidad").val("");
        $("#pv_pr_cantidad").focus();
        swal("Verifique", "El stock es inferior a la cantidad que desea vender", "warning");
        return 0; //detiene el programa
    }

    if (cantidad <= 0) {
        alert("Ingrese cantidad mayor a cero");
        $("#pv_pr_cantidad").focus();
    } else
    {
        $("#detalle").append(fila);

        $("#pv_pr_codigo").val("");
        $("#pv_pr_nombre").val("");
        $("#pv_pr_unidad_medida").val("");
        $("#pv_pr_precio").val("");
        $("#pv_pr_cantidad").val("");
        // $("#txtarticulo").focus();

        calcularTotales();
//     alert(co);

    }


});

$("#pv_pr_cantidad").keypress(function (evento) {
    if (evento.which === 13) {
        evento.preventDefault(); //ignore el evento
        $("#btn_agregar_pv").click();
    }
});

$(document).on("click", "#celiminar", function () {
    if (!confirm("Esta seguro de elimina el registro seleccionado")) {
        return 0;
    }
    var fila = $(this).parents().get(0); //capturar la fila que deseamos eliminar 
    fila.remove(); //eliminar la fila
    calcularTotales();
});

$(document).on("dblclick", "#ccantidad", function () {
    var cantidad = $(this).html();

    if (cantidad.substring(0, 6) === "<input") {
        return 0;
    }

    $(this).empty().append('<input type="text" id="txtactualizar" class="form-control" value = "' + cantidad + '"/>');
    $("#txtactualizar").focus();

});

$(document).on("keypress", "#txtactualizar", function (evento) {

    if (evento.which === 13) {
        var cantidad = $(this).val();
        $(this).parents().find("td").eq(4).empty().append(cantidad);
    } else {
        return validarNumeros(evento);
    }
});

function calcularTotales() {
    var importeSubTotal = 0;
    var importeIGV = 0;
    var importeNeto = 0;
    $("#detalle tr").each(function () {
        var importe = $(this).find("td").eq(5).html();
        importeNeto = importeNeto + parseFloat(importe);
    });

    importeSubTotal = importeNeto / (1 + (18 / 100));
    importeIGV = importeNeto - importeSubTotal;

    //$("#txtimporteneto").val(importeNeto.toFixed(2));
    $("#txtimporteneto").html(importeNeto.toFixed(2));
    //$("#txtimportesubtotal").val(importeSubTotal.toFixed(2));
    $("#txtimportesubtotal").html(importeSubTotal.toFixed(2));
    //$("#txtimporteigv").val(importeIGV.toFixed(2));            
    $("#txtimporteigv").html(importeIGV.toFixed(2));
}


var arrayDetalle = new Array(); //permite almacenar todos los productos agregados en el detalle de la venta

function guardar_preventa(){         
    swal({
        title: "Confirme",
        text: "¿Esta seguro de grabar los datos de la Pre-Venta?",
        showCancelButton: true,
        confirmButtonColor: '#3d9205',
        confirmButtonText: 'Si',
        cancelButtonText: "No",
        closeOnConfirm: false,
        closeOnCancel: true,
        imageUrl: "../images/pregunta.png"
    },
    function(isConfirm){ 

        if (isConfirm){ //el usuario hizo clic en el boton SI     
           
            arrayDetalle.splice(0, arrayDetalle.length);
            
            /*RECORREMOS CADA FILA DE LA TABLA DONDE ESTAN LOS PRODUCTOS VENDIDOS*/
            $("#detalle tr").each(function(){
                    var id_producto = $(this).find("td").eq(0).html();
                    var precio = $(this).find("td").eq(2).html();
                    var cantidad = $(this).find("td").eq(3).html();
                    var importe = $(this).find("td").eq(5).html();
                    
                    var objDetalle = new Object(); //Crear un objeto para almacenar los datos

                    /*declaramos y asignamos los valores a los atributos*/
                    objDetalle.id_producto = id_producto;
                    objDetalle.cantidad  = cantidad;
                    objDetalle.precio    = precio;
                    objDetalle.importe   = importe;
                    
                    //Almacenar al objeto objDetalle en el array arrayDetalle
                    arrayDetalle.push(objDetalle); 

            });

            var jsonDetalle = JSON.stringify(arrayDetalle);

            var datos_frm = {
                p_id_cliente: $("#pv_cl_codigo").val(),
                p_id_usuario: $("#pv_id_usuario").val(),
                p_fecha: $("#pv_fecha").val(),
                p_hora: $("#pv_hora").val(),
                p_subtotal: $("#txtimportesubtotal").html(),
                p_igv: $("#txtimporteigv").html(),
                p_total: $("#txtimporteneto").html(),
                p_estado: 'G',
                p_datosJSONDetalle: jsonDetalle
            }           ;
            console.log(datos_frm);
          
            $.ajax({
                type: "post",
                url: "../controller/preventa.agregar.controller.php",
                data: datos_frm,
                success: function(resultado){
                    console.log(resultado);
                    var datosJSON = resultado;
                    if (datosJSON.estado === 200){                                                                      
                        swal({
                            html:true,
                            title: "Todo Correcto",
                            text: datosJSON.mensaje,
                            type: "success",
                            showCancelButton: false,
                            confirmButtonText: 'Ok',
                            closeOnConfirm: true
                        },
                        function(){
                            document.location.href="pre-venta.lista.view.php";
                        });
                        
                    }
                },
                error: function(error){
                    var datosJSON = $.parseJSON( error.responseText );
                    swal("Error", datosJSON.mensaje , "error");
                }
            });
           
        }
    });   
}


