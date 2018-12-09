<?php

try {
    require_once '../logic/PreVenta.class.php';
    require_once '../util/functions/Helper.class.php';
    
  
    
    $id_preventa   = $_POST["p_id_preventa"];

    
    
    $obj = new PreVenta();
    $resultado = $obj->anularVenta($id_preventa);
    
    if ($resultado["res"]==1){
        Helper::imprimeJSON(200, "La Pre-venta ha sido anulada correctamente", "");
    }
    
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}


