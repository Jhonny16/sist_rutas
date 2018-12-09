<?php

    require_once '../util/functions/Helper.class.php';

    session_name("sistema_dipropan");
    session_start();
    
    if ( ! isset($_SESSION["s_usuario"])){
        //No inició sesión
        Help::mensaje("Para ingresar a esta página primero debe iniciar sesión", "e", "login.view.php", 5);
    }
    
    
    //Si ha iniciado sesiòn, entonces se carga en 2 variables los datos del usuario (nombre y el cargo)
    $id_usuario =  $_SESSION["s_id_usuario"];
    $nombreUsuario = ucwords(strtolower($_SESSION["s_usuario"]));
    $tipoUsuario  = $_SESSION["s_tipo_usuario"];
    $codigoTipoUsuario = $_SESSION["s_cod_tipo_usuario"];
    

    
    
    