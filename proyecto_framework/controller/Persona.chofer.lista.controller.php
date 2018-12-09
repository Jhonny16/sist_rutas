<?php

require_once '../logic/Persona.class.php';
require_once '../util/functions/Helper.class.php';

try {
    $obj = new Persona();
    $resultado = $obj->lista_choferes();
    Helper::imprimeJSON(200, "", $resultado);
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}

