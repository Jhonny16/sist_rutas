<?php

require_once '../logic/Tipo_usuario.class.php';
require_once '../util/functions/Helper.class.php';

try {
    $obj = new Tipo_usuario();
    $resultado = $obj->cargar_tipo_usuario();
    Helper::imprimeJSON(200, "", $resultado);
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}

