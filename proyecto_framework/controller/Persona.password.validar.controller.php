<?php

try {
    require_once '../logic/Persona.class.php';
    require_once '../util/functions/Helper.class.php';

    $type_user = $_POST['p_type_user'];
    $password = $_POST["p_password"];
    $obj = new Persona();

    if ($type_user == 1) {        
        $resultado = $obj->validar_password($password,1);
    } else {
        if ($type_user == 2) {
            $resultado = $obj->validar_password($password,2);
        }else{
            if ($type_user == 3) {
            $resultado = $obj->validar_password($password,3);
        }
        }
    }

    Helper::imprimeJSON(200, "", $resultado);
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}


