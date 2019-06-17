<?php

require_once '../logic/Producto.class.php';
require_once '../util/functions/Helper.class.php';

try {
    
    $obj = new Producto();
    $param = $_POST['p_param'];
    $resultado = $obj->listar_productos($param);
    Helper::imprimeJSON(200, "", $resultado);
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}

