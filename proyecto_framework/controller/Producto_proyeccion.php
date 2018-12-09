<?php
/**
 * Created by PhpStorm.
 * User: tito_
 * Date: 24/10/2018
 * Time: 11:58 PM
 */

require_once '../logic/Producto.class.php';
require_once '../util/functions/Helper.class.php';

if (!isset($_SERVER["HTTP_TOKEN"])) {
    Funciones::imprimeJSON(500, "Debe especificar un token", "");
    exit();
}
$mes1 = $_GET["mes1"];
$mes2 = $_GET["mes2"];
$anio1 = $_GET["anio1"];
$anio2 = $_GET["anio2"];
$param = $_GET["param"];
$bajo = $_GET["bajo"];
$paciente_id = $_GET["paciente_id"];

try {
    $obj = new analisisHistory();
    $resultado = $obj->lista_vista($mes1,$mes2,$anio1,$anio2,$param , $bajo,$paciente_id);
    Funciones::imprimeJSON(200, "",$resultado);
} catch (Exception $exc) {

    Funciones::imprimeJSON(500, $exc->getMessage(), "");
}