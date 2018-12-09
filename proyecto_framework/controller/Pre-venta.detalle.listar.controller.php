<?php

require_once '../logic/PreVenta.class.php';
require_once '../util/functions/Helper.class.php';

try {
    
    $obj = new PreVenta();
    $id = $_POST['p_id'];
    $resultado = $obj->detalle($id);
    if($resultado){
        Helper::imprimeJSON(200, "Datos encontrados", $resultado);
    }else{
        Helper::imprimeJSON(203, "No se encontro detalle de esta venta", "");
    }

} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}

