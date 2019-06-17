<?php

require_once '../logic/PreVenta.class.php';
require_once '../util/functions/Helper.class.php';

try {
    
    $obj = new PreVenta();
    $id = $_POST['p_id'];
    $resultado = $obj->detalle($id);
    Helper::imprimeJSON(200, "", $resultado);
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}

