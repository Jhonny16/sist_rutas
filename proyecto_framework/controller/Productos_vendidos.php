<?php
require_once '../logic/Producto.class.php';
require_once '../util/functions/Helper.class.php';

$fecha1 = $_POST["p_fecha1"];
$fecha2 = $_POST["p_fecha2"];
$cliente_id = $_POST["p_cliente"];

$obj = new Producto();

try {

    $resultado = $obj->lista($fecha1, $fecha2,$cliente_id);
    Helper::imprimeJSON(200, "", $resultado);

} catch (Exception $exc) {
    Helper::mensaje($exc->getMessage(), "e");
}


