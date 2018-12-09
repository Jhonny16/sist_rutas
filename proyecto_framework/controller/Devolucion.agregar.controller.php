<?php

require_once '../logic/Devolucion.php';
require_once '../util/functions/Helper.class.php';


$datosJSONDetalle = $_POST["p_datosJSONDetalle"];

try {
    $obj = new Devolucion();
    $obj->setPedidoId( $_POST["p_pedidoid"]);
    $obj->setUsuarioId( $_POST["p_usuarioid"]);
    $obj->setFecha( $_POST["p_fecha"]);   
    $obj->setMotivo($_POST["p_motivo"]);
    $obj->setDescripcion($_POST["p_descripcion"]);
    $obj->setTiempoMaxim($_POST["p_time"]);
    $obj->setEstado($_POST["p_estado"]);
    $obj->setResponsable($_POST["p_res"]);
    $obj->setDetalle($datosJSONDetalle );
    
    $resultado = $obj->save();
    if ($resultado==true){
        Helper::imprimeJSON(200, "La devolucion  sido guardada correctamente", "");
    }else{
        Helper::imprimeJSON(203, "Problemas al registrar los datos", "");

    }
    
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}





