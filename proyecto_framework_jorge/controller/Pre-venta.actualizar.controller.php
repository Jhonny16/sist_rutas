<?php

try {

    require_once '../logic/PreVenta.class.php';
    require_once '../util/functions/Helper.class.php';

    $id_preventa = $_POST["p_id"];
    $fecha = $_POST["p_fecha"];
    $estado = $_POST["p_estado"];


    $obj = new PreVenta();

        $resultado = $obj->actualizar($id_preventa, $fecha, $estado);
        if ($resultado) {
            if($fecha === ''){
                Helper::imprimeJSON(200, "Pre Venta actualizada", "");
            }else{
                Helper::imprimeJSON(200, "Pre Venta entregada", "");
            }
            
        }
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}
