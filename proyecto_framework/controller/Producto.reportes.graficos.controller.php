<?php
require_once '../logic/Producto.class.php';
require_once '../util/functions/Helper.class.php';

$fecha1 = $_POST["p_fecha1"];
$fecha2 = $_POST["p_fecha2"];
$zona = $_POST["p_zona"];
$opc_estado = $_POST["p_opc"];
$estado = $_POST["p_estado"];

$obj = new Producto();
try {

    $resultado = $obj->unidadesvendidas_monto($fecha1, $fecha2, $zona, $opc_estado, $estado);
} catch (Exception $exc) {
    Helper::mensaje($exc->getMessage(), "e");
}
$datoss = array();
$datoss[0] = ['Producto', 'Nro Ventas'];
for ($i = 0; $i < count($resultado); $i++) {
    $number= floatval($resultado[$i]["cantidad"]);
    $dato = [''.$resultado[$i]["nombre"].'',$number];
    array_push($datoss, $dato);
}
echo json_encode($datoss);

