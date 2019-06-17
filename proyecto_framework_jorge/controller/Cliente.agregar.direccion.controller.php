<?php

try {

    require_once '../logic/Persona.class.php';
    require_once '../util/functions/Helper.class.php';

    $id_direccion = $_POST["p_id_direccion"];
    $id = $_POST["p_id_cliente"];
    $direccion = $_POST["p_direccion_completa"];
    $latitud = $_POST["p_latitud"];
    $longitud = $_POST["p_longitud"];

    $obj = new Persona();
    $resultado = $obj->insertar_direcccion_cliente($id, $direccion, $latitud, $longitud, $id_direccion);
    if ($resultado == true) {
        Helper::imprimeJSON(200, "Agregado correctamente", "");
    } else {
        if ($resultado == 2) {
            Helper::imprimeJSON(200, "Se han actualizado los datos de ubicación", "");
        }
    }
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}
