<?php

try {
    require_once '../logic/Vehiculo.class.php';
    require_once '../util/functions/Helper.class.php';

    $id = $_POST["p_id"];            
    $obj = new Vehiculo();
    $resultado = $obj->leerdDatos_vehiculo($id);
    
    Helper::imprimeJSON(200, "", $resultado);
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}


