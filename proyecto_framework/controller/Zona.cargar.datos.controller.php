<?php

require_once '../logic/Zona.class.php';
require_once '../util/functions/Helper.class.php';

try {
    $obj = new Zona();
    $resultado = $obj->cargar_zona();
    Helper::imprimeJSON(200, "", $resultado);
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}

