<?php
require_once '../negocio/Trabajador.class.php';
require_once '../util/funciones/Funciones.class.php';
$titulo = "TRABAJADORES";
$usuario = $_POST["p_usuario"];
$fecha_inicio = $_POST["p_fecha_inicio"];
$fecha_fin = $_POST["p_fecha_fin"];
$cod_servicio = $_POST["p_cod_servicio"];
$obj = new Trabajador();            
try {
    $registros = $obj->lista_descansos_trabajadores($cod_servicio, $fecha_inicio, $fecha_fin);
} catch (Exception $exc) {
    Funciones::mensaje($exc->getMessage(), "e");
}
$htmlDatos .= '    
    <br>
    <table class="table table-bordered table-striped" style="width:100%">
        <thead>
            <tr>
                <th bgcolor= "#0080c7"><center><font color="white">#</font></center></th> 
                <th bgcolor= "#0080c7"><center><font color="white">COD.PLAN.</font></center></th> 
                <th bgcolor= "#0080c7"><center><font color="white">NOMBRE COMPLETO</font></center></th> 
                <th bgcolor= "#0080c7"><center><font color="white">CARGO</font></center></th> 
                <th bgcolor= "#0080c7" <center><font color="white">SERVICIO</font></center></th> 
                <th bgcolor= "#0080c7"><center><font color="white">ANTIG.</font></center></th> 
            </tr>
        </thead>
        <tbody>';
for ($i = 0; $i < count($registros); $i++) {    
    $htmlDatos .= '<tr>
                    <td style="text-align:center" bgcolor="#efefef"><font color="#0080c7">' . $i . '</font></td>
                    <td style="text-align:center" bgcolor="#efefef"><font color="#0080c7">' . $registros[$i]["cod_planilla"] . '</font></td>
                    <td style="text-align:left" bgcolor="#efefef"><font color="#0080c7">' . ucwords(strtolower($registros[$i]["nombre_completo"])) . '</font></td>
                    <td style="text-align:left" bgcolor="#efefef"><font color="#0080c7">' . ucwords(strtolower($registros[$i]["cargo"])) . '</font></td>
                    <td style="text-align:left" bgcolor="#efefef"><font color="#0080c7">' . ucwords(strtolower($registros[$i]["servicio"])) . '</font></td>
                    <td style="text-align:center" bgcolor="#efefef"><font color="#0080c7">' . $registros[$i]["anios"] . ' anios</font></td>
                  </tr>';
    $registros2 = $obj->atencion_por_medico($registros[$i]["cod_planilla"], $cod_servicio, $fecha_inicio, $fecha_fin);
    $htmlDatos .= '<tr><td></td><td colspan="2">Atendido por</td><td><center>Fecha Inicio</center></td><td>Fecha Fin</td><td style="text-align:right">S/. Hrs. Pagadas.</td>
                   </tr>'; 
    for ($j = 0; $j < count($registros2); $j++) {        
        $htmlDatos .= '<tr>
                        <td></td>
                        <td style="text-align:left" colspan="2"><font color="#59b4e0">' . ucwords(strtolower($registros2[$j]["nombres_completo"])) .'</font></td>
                        <td style="text-align:center"><font color="#59b4e0">' . $registros2[$j]["fecha_inicio"] . '</font></td>
                        <td style="text-align:center"><font color="#59b4e0">' . $registros2[$j]["fecha_fin"] . '</font></td>
                        <td style="text-align:right" ><font color="#59b4e0">s/. '. number_format($registros2[$j]["horas_descanso_pagadas"] , 2). '</font></td>
                       </tr>';
        $nombre_servicio=$registros2[$j]["descripcion"];
    }      
}
$htmlDatos .= '
                </tbody>
                </table>';
//echo $htmlDatos;
$htmlReporte_one = Funciones::generarHTMLReporte(utf8_decode($htmlDatos), $usuario, $fecha_inicio, $fecha_fin,$titulo,$nombre_servicio);
////    $tipo_reporte = $_POST["tipo_reporte"];
Funciones::generarReporte($htmlReporte_one, 2, "reporte_citt_trabajadores");





