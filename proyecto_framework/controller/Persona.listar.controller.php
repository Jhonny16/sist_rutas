<?php

require_once '../logic/Persona.class.php';
require_once '../util/functions/Helper.class.php';

try {
    
    $obj = new Persona();
    $param = $_POST['p_param'];
    $resultado = $obj->listar_persona($param);
    Helper::imprimeJSON(200, "", $resultado);
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}

