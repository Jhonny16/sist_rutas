<?php
require_once '../negocio/Trabajador.class.php';
require_once '../util/funciones/Funciones.class.php';

$fecha_inicio = $_POST["p_fecha_inicio"];
$fecha_fin = $_POST["p_fecha_fin"];
$cod_servicio = $_POST["p_cod_servicio"];
$obj = new Trabajador();

try {
    $registros = $obj->lista_descansos_trabajadores($cod_servicio, $fecha_inicio, $fecha_fin);
} catch (Exception $exc) {
    Funciones::mensaje($exc->getMessage(), "e");
}
?>


<table id="tabla-listado-vista" class="table table-striped">
    <thead>
        <tr style="background-color: #f9f9f9">
            <th style="color:#26B99A">DETALLE</th>
            <th style="color:#26B99A">COD.PLANILLA</th>
            <th style="color:#26B99A">NOMBRE COMPLETO</th>
            <th style="color:#26B99A">CARGO</th>
            <th style="color:#26B99A">SERVICIO</th>
            <th style="color:#26B99A">ANTIGUEDAD</th>
        </tr>
    </thead>
    <tbody >
        <?php
        for ($i = 0; $i < count($registros); $i++) {                        
            $registros2 = $obj->atencion_por_medico($registros[$i][0], $cod_servicio, $fecha_inicio, $fecha_fin);
            echo'<tr>
                    <td align="center" bgcolor="#efefef">                                     
                                <a title="Mostrar" 
                                onclick = "mostrar1(' . $registros[$i][0] . ')" ><i class="fa fa-plus-square-o"></i></a>
                                <a title="Ocultar" 
                                onclick = "ocultar1(' . $registros[$i][0] . ')" ><i class="fa fa-minus-square-o"></i></a>                
                                <input id="' . $registros[$i][0] .'" value="' . count($registros2) .'" style="display:none"></input>

                    </td>
                    <td bgcolor="#efefef"><font color="#0080c7">' . $registros[$i][0] . '</font></td>
                    <td bgcolor="#efefef"><font color="#0080c7">' . ucwords(strtolower($registros[$i][1])) . '</font></td>
                    <td bgcolor="#efefef"><font color="#0080c7">' . ucwords(strtolower($registros[$i][2])) . '</font></td>
                    <td bgcolor="#efefef"><font color="#0080c7">' . ucwords(strtolower($registros[$i][3])) . '</font></td>
                    <td bgcolor="#efefef"><font color="#0080c7">' . $registros[$i][4] . ' Anios</font></td>
                </tr>';
            echo'<tr id="f1' . $registros[$i][0] . '" style="display:none"><td></td><td>Atendido por</td><td>Servicio atención</td>
                <td>Hrs Descanso</td><td>Días Descanso</td><td>Monto total x días descanso</td></tr>';
            for ($j = 0; $j < count($registros2); $j++) {  
                echo '<tr id="'. $j.'f2' . $registros[$i][0] . '" style="display:none">
                        <td></td>
                        <td><font color="#59b4e0">'. ucwords(strtolower($registros2[$j][5])) .'</font></td>
                        <td><font color="#59b4e0">'. ucwords(strtolower($registros2[$j][6])) .'</font></td>
                        <td><font color="#59b4e0">'. $registros2[$j][3].'</font></td>
                        <td><font color="#59b4e0">'. $registros2[$j][4] .'</font></td>
                        <td style="text-align:center"><font color="#59b4e0">S/.'. number_format($registros2[$j][7], 2, ".", ",").'</font></td>                    
                    </tr>';
            }
            
            
        }
        ?>
    </tbody>

</table>


