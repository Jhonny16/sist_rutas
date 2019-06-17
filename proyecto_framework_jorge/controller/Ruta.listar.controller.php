<?php

require_once '../logic/Ruta.class.php';
require_once '../util/functions/Helper.class.php';

try {
    
     $obj = new Ruta();
    $fecha1 = $_POST['p_fecha1'];
    $fecha2 = $_POST['p_fecha2'];
    $tipo_usuario = $_POST['tipo_usuario'];
    $usuario = $_POST['usuario'];
    $resultado = $obj->lista($fecha1, $fecha2, $tipo_usuario, $usuario);
    Helper::imprimeJSON(200, "", $resultado);
    
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}

