<?php

require_once '../logic/PreVenta.class.php';
require_once '../logic/Zona.class.php';
require_once '../util/functions/Helper.class.php';
$obj = new PreVenta();
$obj2 = new Zona();
$titulo = "LISTA DE PRE-VENTAS";
$usuario = $_POST["p_usuario"];
$p_fecha = 1;
$fecha1 = $_POST["txtFecha1_pv"];
$fecha2 = $_POST["txtFecha2_pv"];
$estado = $_POST["p_estado"];
$zona = $_POST["p_zona"];
try {

    $registros = $obj->listar($p_fecha, $fecha1, $fecha2, $zona, $estado);
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
<table id="bl_list_pv_reporte2" class="table table-striped" style="font-size:11px">
    <thead>
         <tr style="background-color: #f9f9f9; height:25px;">
            <th style="color:#26B99A"># PREV.</th>
            <th style="color:#26B99A">ZONA</th>
            <th style="color:#26B99A">FECHA CREACION</th>
            <th style="color:#26B99A">CLIENTE</th>
            <th style="color:#26B99A">DIRECCION</th>
            <th style="color:#26B99A">S.TOT</th>
            <th style="color:#26B99A">IGV</th>
            <th style="color:#26B99A">TOTAL</th>
            <th style="color:#26B99A">USUARIO</th>
        </tr>
    </thead>
    <tbody >';

for ($i = 0; $i < count($registros); $i++) {
    $registros2 = $obj->detalle($registros[$i]['id']);
    $htmlDatos .= '<tr>                   
                    <td bgcolor="#efefef" style="text-align:center"><font color="#0080c7">' . $registros[$i]['id'] . '</font></td>
                    <td bgcolor="#efefef"><font color="#0080c7">' . $registros[$i]['zona'] . '</font></td>
                    <td bgcolor="#efefef"><font color="#0080c7">' . $registros[$i]['fecha_hora'] . '</font></td>
                    <td bgcolor="#efefef"><font color="#0080c7">' . $registros[$i]['cliente'] . '</font></td>
                    <td bgcolor="#efefef"><font color="#0080c7">' . $registros[$i]['direccion'] . '</font></td>
                    <td bgcolor="#efefef"  style="text-align:right"><font color="#0080c7">' . $registros[$i]['sub_total'] . '</font></td>
                    <td bgcolor="#efefef" style="text-align:right"><font color="#0080c7">' . $registros[$i]['igv'] . '</font></td>
                    <td bgcolor="#efefef"  style="text-align:right"><font color="#0080c7">' . $registros[$i]['total'] . '</font></td>
                    <td bgcolor="#efefef"><font color="#0080c7">' . $registros[$i]['usuario'] . '</font></td>
                </tr> ';
    $htmlDatos .= '<tr>
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

//echo $htmlDatos;
if ($estado === 'P') {
    $val_estado = 'Pendiente';
} else {
    $val_estado = 'Entregado';
}
$htmlReporte = Helper::generarHTMLReporte2(utf8_encode($htmlDatos), $usuario, $fecha1, $fecha2, $titulo, $zona_name, $val_estado);
Helper::generarReporte($htmlReporte, 2, "Reporte_preventas");




