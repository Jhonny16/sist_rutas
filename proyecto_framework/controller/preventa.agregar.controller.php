<?php

require_once '../logic/PreVenta.class.php';
require_once '../util/functions/Helper.class.php';


$datosJSONDetalle = $_POST["p_datosJSONDetalle"];

try {
    $obj = new PreVenta();
    $obj->setId_cliente( $_POST["p_id_cliente"]);   
    $obj->setId_usuario( $_POST["p_id_usuario"]);   
    $obj->setFecha( $_POST["p_fecha"]);   
    $obj->setHora($_POST["p_hora"]);   
    $obj->setSub_total($_POST["p_subtotal"]);   
    $obj->setIgv($_POST["p_igv"]);   
    $obj->setTotal($_POST["p_total"]);   
    $obj->setEstado($_POST["p_estado"]);   
    $obj->setDetalle($datosJSONDetalle ); 
    
    $resultado = $obj->registrarPreVenta();
    
    if ($resultado==true){
        Helper::imprimeJSON(200, "La Pre- venta ha sido guardada correctamente", "");
    }
    
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}





