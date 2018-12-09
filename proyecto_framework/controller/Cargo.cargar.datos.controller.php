<?php

require_once '../logic/Cargo.class.php';
require_once '../util/functions/Helper.class.php';

try {
    $obj = new Cargo();
    $resultado = $obj->cargar_cargo();
    Helper::imprimeJSON(200, "", $resultado);
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}

