<?php

require_once '../logic/Tipo_producto.class.php';
require_once '../util/functions/Helper.class.php';

try {
    $obj = new Tipo_producto();
    $resultado = $obj->cargar_tipo_producto();
    Helper::imprimeJSON(200, "", $resultado);
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}

