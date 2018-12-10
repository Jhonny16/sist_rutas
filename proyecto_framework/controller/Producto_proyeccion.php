<?php
/**
 * Created by PhpStorm.
 * User: tito_
 * Date: 24/10/2018
 * Time: 11:58 PM
 */

require_once '../logic/Producto.class.php';
require_once '../util/functions/Helper.class.php';


$id = $_POST["p_id"];;
$anio = $_POST["p_anio"];;
$cliente_id = $_POST["p_cliente"];;


try {
    $obj = new Producto();
    $resultado = $obj->details($id, $anio,$cliente_id);
    Helper::imprimeJSON(200, "", $resultado);
} catch (Exception $exc) {

    Helper::imprimeJSON(500, $exc->getMessage(), "");
}