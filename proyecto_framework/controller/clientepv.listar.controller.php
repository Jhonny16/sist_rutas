
<?php

require_once '../logic/PreVenta.class.php' ;
require_once '../util/functions/Helper.class.php';

try {

    $obj= new PreVenta();
    $resultado = $obj->preventa_cliente();
    Helper::imprimeJSON(200, "", $resultado);
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}

