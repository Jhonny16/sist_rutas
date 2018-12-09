var p_fecha = 1;
var estado = 'P';
var zona=0;
//Movimientos
$('#busq_fc').on('ifChecked', function (event) {
    p_fecha = $("#busq_fc").val();
});
$('#busq_fe').on('ifChecked', function (event) {
    p_fecha = $("#busq_fe").val();
});

$('#busq_ep').on('ifChecked', function (event) {
    estado = $("#busq_ep").val();
});
$('#busq_ee').on('ifChecked', function (event) {
    estado = $("#busq_ee").val();
});



$(document).ready(function () {
    listar();
});

function busqueda_pv() {
    listar();
}


function listar() {

    var fecha1 = $("#txtFecha1").val();
    var fecha2 = $("#txtFecha2").val();
    
    var p_zona = $("#cbx_zona_pv").val();
    if(p_zona===null){
        p_zona = zona;
    }


    $.post
            (
                    "../controller/Pre-venta.listar.controller.php",
                    {
                        p_fecha: p_fecha,
                        p_fecha1: fecha1,
                        p_fecha2: fecha2,
                        p_estado : estado,
                        p_zona : p_zona
                        
                    }

            ).done(function (resultado) {
        var datosJSON = resultado;

        if (datosJSON.estado === 200) {
            var html = "";


            html += '<table id="tabla-listado-pv" class="table table-bordered" >';
            html += '<thead>';
            html += '<tr style="background-color: #f9f9f9; height:25px;">';
            html += '<th style="text-align: center; color:#26B99A" >DETALLE</th>';
            html += '<th style="color:#26B99A"># PREV.</th>';
            html += '<th style="color:#26B99A">ZONA</th>';
            html += '<th style="color:#26B99A">FECHA CREACION</th>';
            html += '<th style="color:#26B99A">FECHA ENTREGA</th>';
            html += '<th style="color:#26B99A">CLIENTE</th>';
            html += '<th style="color:#26B99A">DIRECCION</th>';
            html += '<th style="color:#26B99A">S.TOT</th>';
            html += '<th style="color:#26B99A">IGV</th>';
            html += '<th style="color:#26B99A">TOTAL</th>';
            html += '<th style="color:#26B99A">USUARIO</th>';
            html += '<th style="color:#26B99A">ESTADO</th>';
            html += '</tr>';
            html += '</thead>';
            html += '<tbody>';

            //Detalle
            $.each(datosJSON.datos, function (i, item) {
                //html += '<tr>';
                if (item.estado === "Guardado") {
                    html += '<tr>';
                    html += '<td align="center">';
                       if(item.fecha_entrega === null){
                                             html += '<a title="Anular Pre-Venta"  onclick="anular(' + item.id + ')" onmouseover="" style="cursor: pointer;" ><img src="../images/eliminar.png" style="width:1.5em"></a>';

                     }else{
                         
                     }
                    html += '<a title="Ver detalle de Pre-Venta"  data-toggle="modal" data-target="#mdl_list_detalle_pv" onclick="ver_detalle_pv(' + item.id + ')" onmouseover="" style="cursor: pointer;" ><img src="../images/detalle.png" style="width:1.5em"></a>';
                    html += '</td>';
                } else {
                    html += '<tr style="text-decoration:line-through; color:red">';
                    html += '<td align="center">-';
                    html += '</td>';
                }
                html += '<td>' + item.id + '</td>';
                html += '<td>' + item.zona + '</td>';
                html += '<td>' + item.fecha_hora + '</td>';
                if(item.fecha_entrega === null){
                    html += '<td> No entregado</td>';
                }else{
                    html += '<td>' + item.fecha_entrega + '</td>';
                }                
                html += '<td>' + item.cliente + '</td>';
                html += '<td>' + item.direccion + '</td>';
                html += '<td>' + item.sub_total + '</td>';
                html += '<td>' + item.igv + '</td>';
                html += '<td>' + item.total + '</td>';
                html += '<td>' + item.usuario + '</td>';
                html += '<td>' + item.estado + '</td>';
                html += '</tr>';
            });
            html += '</tbody>';
            html += '</table>';
            $("#listado_pv").html(html);
            $('#tabla-listado-pv').dataTable({
                "aaSorting": [[0, "desc"]],
                "sScrollX": "100%",
                "sScrollXInner": "150%"
            });
        } else {
            //swal("Mensaje del sistema", resultado , "warning");
        }

    }).fail(function (error) {
        var datosJSON = $.parseJSON(error.responseText);
        //swal("Error", datosJSON.mensaje , "error"); 
    });
}


$("#btn_new_pv").click(function () {
    document.location.href = "pre-venta.view.php";
});


function anular(id) {
    console.log(id);


    swal({
        title: "Confirme",
        text: "¿Esta seguro de anular la Pre-Venta?",
        showCancelButton: true,
        confirmButtonColor: '#3d9205',
        confirmButtonText: 'Si',
        cancelButtonText: "No",
        closeOnConfirm: false,
        closeOnCancel: true,
        imageUrl: "../images/pregunta.png"
    },
            function (isConfirm) {

                if (isConfirm) {

                    $.post
                            (
                                    "../controller/Pre-venta.anular.controller.php",
                                    {
                                        p_id_preventa: id
                                    }

                            ).done(function (resultado) {
                        var datosJSON = resultado;

                        if (datosJSON.estado === 200) {

                            swal({
                                html: true,
                                title: "Todo Correcto",
                                text: datosJSON.mensaje,
                                type: "success",
                                showCancelButton: false,
                                confirmButtonText: 'Ok',
                                closeOnConfirm: true
                            },
                                    function () {
                                        listar();
                                    });

                        } else {
                            swal("Mensaje del sistema", resultado, "warning");
                        }

                    }).fail(function (error) {
                        var datosJSON = $.parseJSON(error.responseText);
                    });

                }
            }
    );


}

function ver_detalle_pv(id) {


    $.post
            (
                    "../controller/Pre-venta.detalle.listar.controller.php",
                    {
                        p_id: id
                    }

            ).done(function (resultado) {
        var datosJSON = resultado;

        if (datosJSON.estado === 200) {
            console.log(datosJSON);
            
            $("#txt_detalle_cliente").val(datosJSON.datos[0].cliente);
            
            var html = "";


            html += '<table id="tabla-detalle-pv" class="table table-bordered" >';
            html += '<thead>';
            html += '<tr style="background-color: #f9f9f9; height:25px;">';
            html += '<th style="color:#26B99A">COD.</th>';
            html += '<th style="color:#26B99A">NOMBRE</th>';
            html += '<th style="color:#26B99A">CANTIDAD</th>';
            html += '<th style="color:#26B99A">UNI. MED.</th>';
            html += '<th style="color:#26B99A">PRECIO</th>';
            html += '<th style="color:#26B99A">IMPORTE</th>';   
            html += '</tr>';
            html += '</thead>';
            html += '<tbody>';

            //Detalle
            $.each(datosJSON.datos, function (i, item) {
                html += '<tr>';               
                html += '<td>' + item.id_producto + '</td>';
                html += '<td>' + item.nombre + '</td>';
                html += '<td>' + item.cantidad + '</td>';
                html += '<td>' + item.unidad_medida + '</td>';
                html += '<td>' + item.precio + '</td>';
                html += '<td>' + item.importe + '</td>';              
                html += '</tr>';
            });
            html += '</tbody>';
            html += '</table>';
            $("#list_detalle").html(html);
            $('#tabla-detalle-pv').dataTable({
                "aaSorting": [[0, "asc"]]
            });
        } else {
            swal("Mensaje del sistema", resultado, "warning");
        }

    }).fail(function (error) {
        var datosJSON = $.parseJSON(error.responseText);
    });


}


