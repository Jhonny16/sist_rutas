<?php

require_once '../logic/Personal.php';
require_once '../util/functions/Helper.class.php';

try {
    
    $obj = new Personal();
    $resultado = $obj->lista();
    Helper::imprimeJSON(200, "", $resultado);
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}

