<?php

require_once '../logic/Devolucion.php' ;
require_once '../util/functions/Helper.class.php';

try {
    
    $fecha1 = $_POST["p_fecha1"];
    $fecha2 = $_POST["p_fecha2"];
    $estado = $_POST["p_estado"];
    $zona = $_POST["p_zona"];
    
    $obj= new Devolucion();
    $resultado = $obj->lista($fecha1,$fecha2,$zona, $estado);
    if($resultado){
        Helper::imprimeJSON(200, "", $resultado);

    }else{
        Helper::imprimeJSON(203, "No se encontraron datos", "");
    }

} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}

