<?php

require_once '../logic/Nodos_intermedios.class.php';
require_once '../util/functions/Helper.class.php';

try {
    
    $obj = new Nodos_intermedios();
    $id = $_POST['p_id'];
    $resultado = $obj->list_nodos_intermedios($id);
    Helper::imprimeJSON(200, "", $resultado);
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}

