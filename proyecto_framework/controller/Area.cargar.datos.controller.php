<?php

require_once '../logic/Area.class.php';
require_once '../util/functions/Helper.class.php';

try {
    $obj = new Area();
    $resultado = $obj->cargar_area();
    Helper::imprimeJSON(200, "", $resultado);
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}

