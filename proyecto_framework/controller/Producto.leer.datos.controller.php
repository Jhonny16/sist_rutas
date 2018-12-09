<?php

try {
    require_once '../logic/Producto.class.php';
    require_once '../util/functions/Helper.class.php';

    $id = $_POST["p_id"];            
    $obj = new Producto();
    $resultado = $obj->leerDatos_producto($id);
    
    Helper::imprimeJSON(200, "", $resultado);
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}


