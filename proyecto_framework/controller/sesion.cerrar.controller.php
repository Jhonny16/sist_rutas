<?php

    session_name("sistema_dipropan");
    session_start();
    
    unset($_SESSION["s_usuario"]);
    unset($_SESSION["s_tipo_usuario"]);
    unset($_SESSION["s_cod_tipo_usuario"]);
    
    session_destroy();
    
    header("location:../view/login.view.php");
    
    
