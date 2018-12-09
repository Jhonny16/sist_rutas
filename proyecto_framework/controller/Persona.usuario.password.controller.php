<?php

try {
    require_once '../logic/Persona.class.php';
    require_once '../util/functions/Helper.class.php';
        
    $id = $_POST["p_id"];            
    $obj = new Persona();
    $resultado = $obj->leerDatos_persona($id);
    
    Helper::imprimeJSON(200, "", $resultado);
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}


