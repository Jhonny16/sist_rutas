<?php

require_once '../logic/Trayectoria.class.php';
require_once '../util/functions/Helper.class.php';

try {
    
    $obj = new Trayectoria();
    $id = $_POST['p_id'];
    $resultado = $obj->list_trayectorias($id);
    Helper::imprimeJSON(200, "", $resultado);
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}

