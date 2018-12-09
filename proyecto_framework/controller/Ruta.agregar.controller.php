<?php

require_once '../logic/Ruta.class.php';
require_once '../util/functions/Helper.class.php';


$nodos_intermedios = $_POST["p_nodos_intermedios"];
$recorrido = $_POST["p_recorrido"];

try {
    $obj = new Ruta();
    $obj->setNi_letra( $_POST["p_nodo_inicio_letra"]);   
    $obj->setNi_valor( $_POST["p_nodo_inicio_valor"]);   
    $obj->setNf_letra( $_POST["p_nodo_final_letra"]);   
    $obj->setNf_valor($_POST["p_nodo_final_valor"]);   
    $obj->setDistancia_total($_POST["p_distancia_total"]);   
    $obj->setNintermedios($nodos_intermedios ); 
    $obj->setRecorrido($recorrido ); 
    $obj->setId_vehiculo_chofer($_POST["p_vehiculo_chofer"]);
    $obj->setFecha($_POST["p_fecha"]);
    $obj->setCostoGalon($_POST["p_costo_galon"]);
    $obj->setCostoTotal($_POST["p_costo_total"]);
    $obj->setKm($_POST["p_km"]);
    $id_punto_inicio = $_POST['p_punto_inicio'];
    $id_punto_final = $_POST['p_punto_final'];

    $resultado = $obj->save_ruta($id_punto_inicio, $id_punto_final);
    
    if ($resultado==true){
        Helper::imprimeJSON(200, "La RUTA, el RECORRIDO y sus NODOS se han guardado correctamente", "");
    }
    
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}





