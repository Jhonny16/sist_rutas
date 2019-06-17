<?php
/**
 * Created by PhpStorm.
 * User: jhonny
 * Date: 09/06/19
 * Time: 10:50 PM
 */

require_once '../logic/Usuario.php';
require_once '../util/functions/Helper.class.php';

try {
    $user_id = $_POST["id"];
    $password = $_POST["password"];

    $objUsuario = new Usuario();


    $resultado = $objUsuario->validar_password($user_id,$password);
    if($resultado == 1){
        Helper::imprimeJSON(200, "Contraseña Válida", $resultado);
        //Funciones::imprimeJSON(200, "Contraseña Válida", $resultado);// JSON permite compartir datos entre aplicaciones; 200 CORRECTO
    }else{
        Helper::imprimeJSON(200, "Password no válido", $resultado);
        //Funciones::imprimeJSON(200, "Password no válido",  "");
    }

} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}