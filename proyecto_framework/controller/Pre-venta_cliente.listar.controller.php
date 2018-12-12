<?php

require_once '../logic/PreVenta.class.php' ;
require_once '../util/functions/Helper.class.php';

try {
    
    if 
        (
            !isset($_POST["p_fecha1"]) ||
            empty($_POST["p_fecha1"]) ||
            
            !isset($_POST["p_fecha2"]) ||
            empty($_POST["p_fecha2"])
            
        )
    {
            Helper::imprimeJSON(500, "Falta enviar parametros", "");
            exit();
    }
    
    $p_fecha = $_POST["p_fecha"];
    $fecha1 = $_POST["p_fecha1"];
    $fecha2 = $_POST["p_fecha2"];
    $estado = $_POST["p_estado"];
    $persona_id = $_POST["p_personaid"];
    
    $obj= new PreVenta();
    $resultado = $obj->listarxlciente($p_fecha, $fecha1, $fecha2, $persona_id, $estado);
    Helper::imprimeJSON(200, "", $resultado);
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}

