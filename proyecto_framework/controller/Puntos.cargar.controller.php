<?php

require_once '../logic/Puntos.class.php';
require_once '../util/functions/Helper.class.php';

$tipo = $_POST['p_tipo'];

try {
    
    $obj = new Puntos();
    
    if($tipo === 'i'){
        $resultado = $obj->punto_partida();
    }else
    {
        $resultado = $obj->punto_final();
    }
    
    Helper::imprimeJSON(200, "", $resultado);
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}

