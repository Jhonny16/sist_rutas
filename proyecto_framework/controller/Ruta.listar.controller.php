<?php

require_once '../logic/Ruta.class.php';
require_once '../util/functions/Helper.class.php';

try {
    
     $obj = new Ruta();
    $fecha1 = $_POST['p_fecha1'];
    $fecha2 = $_POST['p_fecha2'];
    $resultado = $obj->lista($fecha1, $fecha2);
    Helper::imprimeJSON(200, "", $resultado);
    
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}

