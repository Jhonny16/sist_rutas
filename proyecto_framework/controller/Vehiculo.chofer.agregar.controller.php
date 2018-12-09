<?php

try {

    require_once '../logic/Vehiculo.class.php';
    require_once '../util/functions/Helper.class.php';

    $id_vehiculo = $_POST["p_id_vehiculo"];
    $id_personal = $_POST["p_id_personal"];
    $fecha = $_POST["p_fecha"];
    $hora_inicio = $_POST["p_hora_inicio"];
    $hora_fin = $_POST["p_hora_fin"];

    $obj = new Vehiculo();


    $resultado = $obj->agregar_chofer($id_vehiculo, $id_personal, $fecha, $hora_inicio, $hora_fin);
    if ($resultado==true) {
        Helper::imprimeJSON(200, "Agregado correctamente", "");
    }else{
        Helper::imprimeJSON(false, "La hora de Fin no puede ser mayor a la hora de inicio","");
    }
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}
