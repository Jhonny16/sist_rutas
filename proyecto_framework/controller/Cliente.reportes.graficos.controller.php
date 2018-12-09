<?php
require_once '../logic/Persona.class.php';
require_once '../util/functions/Helper.class.php';

$fecha1 = $_POST["p_fecha1"];
$fecha2 = $_POST["p_fecha2"];
$zona = $_POST["p_zona"];
$opc_estado = $_POST["p_opc"];
$estado = $_POST["p_estado"];

$obj = new Persona();
try {

    $resultado = $obj->clientes_preventas_cantidad($fecha1, $fecha2, $zona, $opc_estado, $estado);
} catch (Exception $exc) {
    Helper::mensaje($exc->getMessage(), "e");
}
$datoss = array();
$datoss[0] = ['Cliente', 'Nro Ventas'];
for ($i = 0; $i < count($resultado); $i++) {
    $number= floatval($resultado[$i]["cantidad"]);
    $dato = [''.$resultado[$i]["cliente"].'',$number];
    array_push($datoss, $dato);
}
echo json_encode($datoss);

