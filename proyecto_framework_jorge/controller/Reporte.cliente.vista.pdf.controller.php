<?php

require_once '../logic/Persona.class.php';
require_once '../logic/PreVenta.class.php';
require_once '../logic/Zona.class.php';
require_once '../util/functions/Helper.class.php';

$obj = new Persona();
$objpv = new PreVenta();
$obj2 = new Zona();

$titulo = "LISTA DE CLIENTE CON UN PEDIDO";

$usuario = $_POST["p_usuario"];
$p_fecha = 1;
$fecha1 = $_POST["txtFecha1_cliente"];
$fecha2 = $_POST["txtFecha2_cliente"];
$estado = $_POST["p_estado"];
$zona = $_POST["cbx_zona_cliente_report"];
try {

    $registros = $obj->clientes_one_pedido($fecha1, $fecha2, $zona);
    $resultado = $obj2->cargar_zona();
} catch (Exception $exc) {
    Helper::mensaje($exc->getMessage(), "e");
}
if ($zona === '0') {
    $zona_name = "Todas las Zonas";
} else {
    for ($i = 0; $i < count($resultado); $i++) {
        if ( (integer)$zona === $resultado[$i]['id']) {
            $zona_name = $resultado[$i]['nombre'];
        }
    }
}


$htmlDatos = '  
<table id="bl_list_cliente_reporte2" class="table table-striped" style="font-size:11px">
    <thead>
         <tr style="background-color: #f9f9f9; height:25px;">
            <th style="color:#26B99A">#</th>
            <th style="color:#26B99A">Cliente</th>
            <th style="color:#26B99A"># Preventa</th>
            <th style="color:#26B99A">Dirección</th>
            <th style="color:#26B99A">Fecha/Hora</th>
            <th style="color:#26B99A">Igv</th>
            <th style="color:#26B99A">Sub Total</th>
            <th style="color:#26B99A">Total</th>
            <th style="color:#26B99A">Usuario</th>
        </tr>
    </thead>
    <tbody >';

for ($i = 0; $i < count($registros); $i++) {
    $registros2 = $objpv->detalle($registros[$i]['id']);
    $htmlDatos .= '<tr>                   
                     <td bgcolor="#efefef"><font color="#0080c7">' . ($i + 1) . '</font></td>
                     <td bgcolor="#efefef"><font color="#0080c7">' . $registros[$i]['cliente'] . '</font></td>
                    <td bgcolor="#efefef"><font color="#0080c7">' . $registros[$i]['id'] . '</font></td>
                    <td bgcolor="#efefef"><font color="#0080c7">' . $registros[$i]['direccion'] . '</font></td>
                    <td bgcolor="#efefef"><font color="#0080c7">' . $registros[$i]['fecha_hora'] . '</font></td>
                    <td bgcolor="#efefef"><font color="#0080c7">' . $registros[$i]['sub_total'] . '</font></td>
                    <td bgcolor="#efefef"><font color="#0080c7">' . $registros[$i]['igv'] . '</font></td>
                    <td bgcolor="#efefef"><font color="#0080c7">' . $registros[$i]['total'] . '</font></td>
                    <td bgcolor="#efefef"><font color="#0080c7">' . $registros[$i]['usuario'] . '</font></td>
                </tr> ';
    $htmlDatos .= '<tr>
                <td></td>
                <td></td>
                <td>Cod</td>
                <td>Producto</td>
                <td>Cantidad</td>
                <td>Unid.Med.</td>
                <td>Precio</td>
                <td>Importe</td>
               </tr>';
    for ($j = 0; $j < count($registros2); $j++) {
        $htmlDatos .= '<tr >
                        <td></td>
                        <td></td>
                        <td><font color="#59b4e0">' . $registros2[$j]['id_producto'] . '</font></td>
                        <td><font color="#59b4e0">' . $registros2[$j]['nombre'] . '</font></td>
                        <td><font color="#59b4e0">' . $registros2[$j]['cantidad'] . '</font></td>
                        <td><font color="#59b4e0">' . $registros2[$j]['unidad_medida'] . '</font></td>
                        <td><font color="#59b4e0">' . $registros2[$j]['precio'] . '</font></td>
                        <td><font color="#59b4e0">' . $registros2[$j]['importe'] . '</font></td>                                                
                    </tr>';
    }
}

$htmlDatos .= '
                </tbody>
                </table>';


$htmlReporte = Helper::generarHTMLReporte3(utf8_encode($htmlDatos), $usuario, $fecha1, $fecha2, $titulo, $zona_name);
Helper::generarReporte($htmlReporte, 2, "Reporte_clienteone_pedido");




