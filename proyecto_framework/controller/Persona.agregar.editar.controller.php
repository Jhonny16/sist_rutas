<?php

try {

    require_once '../logic/Persona.class.php';
    require_once '../util/functions/Helper.class.php';

    $operacion = $_POST["p_operacion"];
    $usuario = $_POST["p_usuario"];
    $tipo_usuario = $_POST["p_tipo_usuario"];
    $password = $_POST["p_password"];

    $password_c = $_POST["p_password_c"];

    $password_t = $_POST["p_password_t"];

    $cliente = $_POST["p_cliente"];
    $tipo_cliente = $_POST["p_tipo_cliente"];
    $trabajador = $_POST["p_trabajador"];
    $area = $_POST["p_area"];
    $cargo = $_POST["p_cargo"];
    $dni_ruc = $_POST["p_dni_ruc"];
    $apellidos = $_POST["p_apellidos"];
    $nombres = $_POST["p_nombres"];
    $fecha_nacimiento = $_POST["p_fecha_nacimiento"];
    $direccion = $_POST["p_direccion"];
    $email = $_POST["p_email"];
    $telefono = $_POST["p_telefono"];
    $razon_social = $_POST["p_razon_social"];
    $id_zona = $_POST["p_id_zona"];

    $objPersona = new Persona();

    $objPersona->setDni($dni_ruc);
    $objPersona->setApellidos($apellidos);
    $objPersona->setNombres($nombres);
    $objPersona->setFecha_nacimiento($fecha_nacimiento);
    $objPersona->setDireccion($direccion);
    $objPersona->setTelefono($telefono);
    $objPersona->setEmail($email);
    $objPersona->setCliente($cliente);
    $objPersona->setTrabajador($trabajador);
    $objPersona->setRazonSocial($razon_social);

    if ($operacion == "agregar") {


        $resultado = $objPersona->agregar($tipo_cliente, $area, $cargo, $usuario, $tipo_usuario, $password,$password_c, $password_t, $razon_social,$id_zona);
        if ($resultado) {
            Helper::imprimeJSON(200, "Agregado correctamente", "");
        }
    } else { //Editar
        $id_persona = $_POST["p_id_persona"];
        $new_password = $_POST["p_new_password"];
        $new_password_c = $_POST["p_new_password_c"];
        $new_password_t = $_POST["p_new_password_t"];

        $resultado = $objPersona->editar_persona($id_persona, $usuario, $tipo_usuario, $area, $cargo, $tipo_cliente, $new_password, $new_password_c, $new_password_t,$id_zona , $password);
        if ($resultado) {
            Helper::imprimeJSON(200, "Actualizado correctamente", "");
        }
    }
} catch (Exception $exc) {
    print_r($exc);
    //Help.phpimprimeJSON(500, $exc->getMessage(), "");
}
