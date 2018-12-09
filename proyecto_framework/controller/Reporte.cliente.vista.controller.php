<?php
require_once '../logic/Persona.class.php';
require_once '../logic/PreVenta.class.php';
require_once '../util/functions/Helper.class.php';

$obj = new Persona();
$obj2 = new PreVenta();
$fecha1 = $_POST['p_fecha1'];
$fecha2 = $_POST['p_fecha2'];
$zona = $_POST['p_zona'];
try {
    $registros = $obj->clientes_one_pedido($fecha1, $fecha2, $zona);
} catch (Exception $exc) {
    Helper::mensaje($exc->getMessage(), "e");
}
?>
<table id="tbl_list_cliente_one_pedido" class="table table-striped">
    <thead>
        <tr bgcolor=' #f9f9f9'>
            <th style="color:#26B99A">Desplegar</th>
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
    <tbody >
        <?php
       for ($i = 0; $i < count($registros); $i++) {
            $registros2 = $obj2->detalle($registros[$i]['id']);
            echo'<tr>
                    <td align="center" bgcolor="#efefef">                                     
                                <a title="Mostrar" 
                                onclick = "mostrar_detalle_cliente(' . $registros[$i]['id'] . ')" ><i class="fa fa-plus-square-o"></i></a>
                                <a title="Ocultar" 
                                onclick = "ocultar_detalle_cliente(' . $registros[$i]['id'] . ')" ><i class="fa fa-minus-square-o"></i></a>                
                                <input id="' . $registros[$i]['id'] . '" value="' . count($registros2) . '" style="display:none"></input>

                    </td>
                    <td bgcolor="#efefef"><font color="#0080c7">' . $registros[$i]['cliente'] . '</font></td>
                    <td bgcolor="#efefef"><font color="#0080c7">' . $registros[$i]['id'] . '</font></td>
                    <td bgcolor="#efefef"><font color="#0080c7">' . $registros[$i]['direccion'] . '</font></td>
                    <td bgcolor="#efefef"><font color="#0080c7">' . $registros[$i]['fecha_hora'] . '</font></td>
                    <td bgcolor="#efefef"><font color="#0080c7">' . $registros[$i]['sub_total'] . '</font></td>
                    <td bgcolor="#efefef"><font color="#0080c7">' . $registros[$i]['igv'] . '</font></td>
                    <td bgcolor="#efefef"><font color="#0080c7">' . $registros[$i]['total'] . '</font></td>
                    <td bgcolor="#efefef"><font color="#0080c7">' . $registros[$i]['usuario'] . '</font></td>

                </tr>';
            echo'<tr id="detalle' . $registros[$i]['id'] . '" style="display:none">
                <td></td>
                <td></td>
                <td>Cod</td>
                <td>Producto</td>
                <td>Cantidad</td>
                <td>Unid.Med.</td>
                <td>Precio</td>
                <td>Importe</td>
                <td></td>
               </tr>';
            for ($j = 0; $j < count($registros2); $j++) {
                echo '<tr id="' . $j . 'd2' . $registros[$i]['id'] . '" style="display:none">
                        <td></td>
                        <td></td>
                        <td><font color="#59b4e0">' . $registros2[$j]['id_producto'] . '</font></td>
                        <td><font color="#59b4e0">' . $registros2[$j]['nombre'] . '</font></td>
                        <td><font color="#59b4e0">' . $registros2[$j]['cantidad'] . '</font></td>
                        <td><font color="#59b4e0">' . $registros2[$j]['unidad_medida'] . '</font></td>
                        <td><font color="#59b4e0">' . $registros2[$j]['precio'] . '</font></td>
                        <td><font color="#59b4e0">' . $registros2[$j]['importe'] . '</font></td>
                        <td></td>
                       
                         
                    </tr>';
            }
        }
        ?>
    </tbody>

</table>




