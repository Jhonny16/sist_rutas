<?php
require_once '../logic/Ruta.class.php';
require_once '../logic/Nodos_intermedios.class.php';
require_once '../util/functions/Helper.class.php';

$obj = new Ruta();
$obj2 = new Nodos_intermedios();
$fecha1 = $_POST['p_fecha1'];
$fecha2 = $_POST['p_fecha2'];
try {
    $registros = $obj->lista($fecha1, $fecha2);
    $fecha1;
} catch (Exception $exc) {
    Funciones::mensaje($exc->getMessage(), "e");
}
?>
<table id="tbl_list_rutas_two" class="table table-striped">
    <thead>
        <tr bgcolor='#f9f9f9'>
            <th style="color:#26B99A">Desplegar</th>
            <th style="color:#26B99A">Punto Partida</th>
            <th style="color:#26B99A">Punto LLegada</th>
            <th style="color:#26B99A">Chofer</th>
            <th style="color:#26B99A">Unidad</th>
            <th style="color:#26B99A">Distancia</th>
            <th style="color:#26B99A">Fecha</th>
            <th style="color:#26B99A">Costo Galon</th>
            <th style="color:#26B99A">Costo Total</th>
        </tr>
    </thead>
    <tbody >
        <?php
        for ($i = 0; $i < count($registros); $i++) {
            $registros2 = $obj2->list_nodos_intermedios($registros[$i]['id']);
            echo'<tr>
                    <td align="center" bgcolor="#efefef">                                     
                                <a title="Mostrar" 
                                onclick = "mostrar_detalle(' . $registros[$i]['id'] . ')" ><i class="fa fa-plus-square-o"></i></a>
                                <a title="Ocultar" 
                                onclick = "ocultar_detalle(' . $registros[$i]['id'] . ')" ><i class="fa fa-minus-square-o"></i></a>                
                                <input id="' . $registros[$i]['id'] . '" value="' . count($registros2) . '" style="display:none"></input>

                    </td>
                    <td bgcolor="#efefef"><font color="#0080c7">' . $registros[$i]['nodo_inicio_valor'] . '</font></td>
                    <td bgcolor="#efefef"><font color="#0080c7">' . $registros[$i]['nodo_final_valor'] . '</font></td>
                    <td bgcolor="#efefef"><font color="#0080c7">' . $registros[$i]['chofer'] . '</font></td>
                    <td bgcolor="#efefef"><font color="#0080c7">' . $registros[$i]['unidad'] . '</font></td>
                    <td bgcolor="#efefef"><font color="#0080c7">' . $registros[$i]['distancia_total'] . '</font></td>
                    <td bgcolor="#efefef"><font color="#0080c7">' . $registros[$i]['fecha'] . '</font></td>
                    <td bgcolor="#efefef"><font color="#0080c7">' . $registros[$i]['costo_galon'] . '</font></td>
                    <td bgcolor="#efefef"><font color="#0080c7">' . $registros[$i]['costo_total'] . '</font></td>
                </tr>';
            echo'<tr id="dir' . $registros[$i]['id'] . '" style="display:none"><td></td><td>#</td><td>Direcciones</td><td></td><td></td><td></td><td></td>
                <td></td>
               </tr>';
            for ($j = 0; $j < count($registros2); $j++) {
                echo '<tr id="' . $j . 'f2' . $registros[$i]['id'] . '" style="display:none">
                        <td></td>
                        <td><font color="#c8c8c8">Parada ' . ($j + 1). '</font></td>
                        <td><font color="#59b4e0">' . $registros2[$j]['direccion'] . '</font></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>                                                
                    </tr>';
            }
        }
        ?>
    </tbody>

</table>




