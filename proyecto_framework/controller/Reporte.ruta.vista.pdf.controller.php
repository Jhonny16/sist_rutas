<?php

require_once '../logic/Ruta.class.php';
require_once '../logic/Nodos_intermedios.class.php';
require_once '../util/functions/Helper.class.php';
require_once '../functions/Help.php';

$obj = new Ruta();
$obj2 = new Nodos_intermedios();
$titulo = "LISTA DE RUTAS";
$usuario = $_POST["p_usuario"];
$fecha1 = $_POST['p_fecha1_ruta'];
$fecha2 = $_POST['p_fecha2_ruta'];
try {
    $registros = $obj->lista($fecha1, $fecha2);
} catch (Exception $exc) {
    Helper::mensaje($exc->getMessage(), "e");
}

$htmlDatos = '  
<table id="tbl_list_rutas2" class="table table-striped" style="font-size:11px">
    <thead>
        <tr bgcolor="#f9f9f9">
            <th style="color:#26B99A">Nro</th>
            <th style="color:#26B99A">Punto Partida</th>
            <th style="color:#26B99A">Punto LLegada</th>
            <th style="color:#26B99A">Chofer</th>
            <th style="color:#26B99A">Unidad</th>
            <th style="color:#26B99A">Distancia</th>
            <th style="color:#26B99A">Fecha</th>
            <th style="color:#26B99A">Çosto Galon</th>
            <th style="color:#26B99A">Costo Total</th>
        </tr>
    </thead>
    <tbody >';

for ($i = 0; $i < count($registros); $i++) {
    $registros2 = $obj2->list_nodos_intermedios($registros[$i]['id']);
    $htmlDatos .= '<tr>                   
                    <td style="text-align:center" bgcolor="#efefef"><font color="#0080c7">' . ($i + 1) . '</font></td>
                    <td bgcolor="#efefef"><font color="#0080c7">' . $registros[$i]['nodo_inicio_valor'] . '</font></td>
                    <td bgcolor="#efefef"><font color="#0080c7">' . $registros[$i]['nodo_final_valor'] . '</font></td>
                    <td bgcolor="#efefef"><font color="#0080c7">' . $registros[$i]['chofer'] . '</font></td>
                    <td bgcolor="#efefef"><font color="#0080c7">' . $registros[$i]['unidad'] . '</font></td>
                    <td bgcolor="#efefef"><font color="#0080c7">' . number_format($registros[$i]['distancia_total'], 2) . '</font></td>
                    <td bgcolor="#efefef"><font color="#0080c7">' . $registros[$i]['fecha'] . '</font></td>
                    <td bgcolor="#efefef"><font color="#0080c7">' . $registros[$i]['costo_galon'] . '</font></td>
                    <td bgcolor="#efefef"><font color="#0080c7">' . $registros[$i]['costo_total'] . '</font></td>
                </tr> ';
    $htmlDatos .= '<tr id="dir' . $registros[$i]['id'] . '" >
                    <td></td>
                    <td colspan="5">Nodos Intermedios</td><td></td>
                    <td></td>
                    <td></td>
                    <td></td>
               </tr>';
    for ($j = 0; $j < count($registros2); $j++) {
        $htmlDatos .= '<tr >
                        <td></td>
                        <td colspan="8"><font color="#59b4e0"><img src="../images/check.png" style="width:1em">' . $registros2[$j]['direccion'] . '</font></td>                                                                         
                    </tr>';
    }
}

$htmlDatos .= '
                </tbody>
                </table>';

//echo $htmlDatos;
$htmlReporte = Help::generarHTMLReporte(utf8_encode($htmlDatos), $usuario, $fecha1, $fecha2, $titulo);
Help::generarReporte($htmlReporte, 2, "Reporte_rutas");




