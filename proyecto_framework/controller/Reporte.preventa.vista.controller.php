<?php
require_once '../logic/PreVenta.class.php';
require_once '../util/functions/Helper.class.php';

$p_fecha = $_POST["p_fecha"];
$fecha1 = $_POST["p_fecha1"];
$fecha2 = $_POST["p_fecha2"];
$estado = $_POST["p_estado"];
$zona = $_POST["p_zona"];
$obj = new PreVenta();
try {
    $registros = $obj->listar($p_fecha, $fecha1, $fecha2, $zona, $estado);
} catch (Exception $exc) {
    Funciones::mensaje($exc->getMessage(), "e");
}
?>
<table id="tbl_list_pv_reporte" class="table table-striped">
    <thead>
        <tr style="background-color: #f9f9f9; height:25px;">
            <th style="text-align: center; color:#26B99A" >Desple.</th>
            <th style="color:#26B99A">ID</th>
            <th style="color:#26B99A">Zona</th>
            <th style="color:#26B99A">Creada</th>
            <th style="color:#26B99A">Entregada</th>
            <th style="color:#26B99A">Cliente</th>
            <th style="color:#26B99A">Direccion</th>
            <th style="color:#26B99A">Sub Total</th>
            <th style="color:#26B99A">Igv</th>
            <th style="color:#26B99A">Total</th>
            <th style="color:#26B99A">Usuario</th>
            <th style="color:#26B99A">Estado</th>
        </tr>
    </thead>
    <tbody >
        <?php
        for ($i = 0; $i < count($registros); $i++) {
            $registros2 = $obj->detalle($registros[$i]['id']);
            echo'<tr>
                    <td align="center" bgcolor="#efefef">                                     
                                <a title="Mostrar" 
                                onclick = "mostrar_detalle_pv(' . $registros[$i]['id'] . ')" ><i class="fa fa-plus-square-o"></i></a>
                                <a title="Ocultar" 
                                onclick = "ocultar_detalle_pv(' . $registros[$i]['id'] . ')" ><i class="fa fa-minus-square-o"></i></a>                
                                <input id="' . $registros[$i]['id'] . '" value="' . count($registros2) . '" style="display:none"></input>

                    </td>
                    <td bgcolor="#efefef"><font color="#0080c7">' . $registros[$i]['id'] . '</font></td>
                    <td bgcolor="#efefef"><font color="#0080c7">' . $registros[$i]['zona'] . '</font></td>
                    <td bgcolor="#efefef"><font color="#0080c7">' . $registros[$i]['fecha_hora'] . '</font></td>';
            if ($registros[$i]['fecha_entrega'] === null) {
                echo'      <td bgcolor="#efefef"><font color="#0080c7">No entregado</font></td>';
            } else {
                echo'      <td bgcolor="#efefef"><font color="#0080c7">' . $registros[$i]['fecha_entrega'] . '</font></td>';
            }

            echo'      
                    <td bgcolor="#efefef"><font color="#0080c7">' . $registros[$i]['cliente'] . '</font></td>
                    <td bgcolor="#efefef"><font color="#0080c7">' . $registros[$i]['direccion'] . '</font></td>
                    <td bgcolor="#efefef"><font color="#0080c7">' . $registros[$i]['sub_total'] . '</font></td>
                    <td bgcolor="#efefef"><font color="#0080c7">' . $registros[$i]['igv'] . '</font></td>
                    <td bgcolor="#efefef"><font color="#0080c7">' . $registros[$i]['total'] . '</font></td>
                    <td bgcolor="#efefef"><font color="#0080c7">' . $registros[$i]['usuario'] . '</font></td>
                    <td bgcolor="#efefef"><font color="#0080c7">' . $registros[$i]['estado'] . '</font></td>
                </tr>';
            echo'<tr id="det' . $registros[$i]['id'] . '" style="display:none">
                <td></td>
                <td>Cod</td>
                <td>Producto</td>
                <td>Cantidad</td>
                <td>Unid.Med.</td>
                <td>Precio</td>
                <td>Importe</td>
               </tr>';
            for ($j = 0; $j < count($registros2); $j++) {
                echo '<tr id="' . $j . 'f2' . $registros[$i]['id'] . '" style="display:none">
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
        ?>
    </tbody>

</table>




