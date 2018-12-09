<?php

require_once '../logic/Sesion.class.php';
require_once '../util/functions/Helper.class.php';

try {
    
    /*Obtener los datos ingresados en el formulario*/
    
    if (!isset($_POST["p_login"]) || $_POST["p_login"] == ""  ){
        Helper::mensaje("Debe ingresar su login", "e", "../view/login.view.php", 5);
    }else if (!isset($_POST["p_password"]) || $_POST["p_password"] == ""  ){
        Helper::mensaje("Debe ingresar su clave", "e", "../view/login.view.php", 5);
    }
    
    $login = $_POST["p_login"];
    $password = $_POST["p_password"];
    /*Obtener los datos ingresados en el formulario*/
    
    $objSesion = new Sesion();
    $objSesion->setLogin($login);
    $objSesion->setPassword($password);
    
    $resultado = $objSesion->validar_sesion();
    
    //echo $resultado;
    
    switch ($resultado) {
        case "NE":
            Helper::mensaje("Usuario no existe", "a", "../view/login.view.php", 3);
            break;
        
        case "CI":
            Helper::mensaje("La clave es incorrecta", "e", "../view/login.view.php", 3);
            break;
        
        case "UI":
            Helper::mensaje("Usuario inactivo", "a", "../view/login.view.php", 3);
            break;
        
        default: //SI
            header("location:../view/principal.view.php");
            break;
    }
    
} catch (Exception $exc) {
    echo $exc->getTraceAsString();
}


