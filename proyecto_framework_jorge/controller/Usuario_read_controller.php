<?php
/**
 * Created by PhpStorm.
 * User: jhonny
 * Date: 13/06/19
 * Time: 10:50 AM
 */
try {
    require_once '../logic/Usuario.php';
    require_once '../util/functions/Helper.class.php';

    $id = $_POST["id"];
    $obj = new Usuario();
    $resultado = $obj->read($id);

    Helper::imprimeJSON(200, "", $resultado);

} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}
