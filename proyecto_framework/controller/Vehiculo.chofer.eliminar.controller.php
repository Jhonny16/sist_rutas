<?php

try {
    require_once '../logic/Vehiculo.class.php';
    require_once '../util/functions/Helper.class.php';
    
   
    
    $id = $_POST["p_id"];
    
    $obj = new Vehiculo();
    $resultado = $obj->eliminar_vehiculo_chofer($id);
    
    if ($resultado){
        Helper::imprimeJSON(200, "Se eliminó correctamente", "");
    }
    
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}


