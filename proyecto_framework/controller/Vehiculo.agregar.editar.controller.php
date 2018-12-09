<?php

try {
    
    require_once '../logic/Vehiculo.class.php';
    require_once '../util/functions/Helper.class.php';
    
    $placa= $_POST["p_placa"];    
    $modelo= $_POST["p_modelo"];
    $marca= $_POST["p_marca"];
    $aka= $_POST["p_aka"];
    $peso= $_POST["p_peso"];
    $estado= $_POST["p_estado"];
    $operacion= $_POST["p_operacion"];

    
    $obj = new Vehiculo();
    
    if ($operacion == "agregar"){                              
        $resultado = $obj->agregar($placa, $modelo, $marca, $aka, $peso, $estado);
        if ($resultado==True){
            Helper::imprimeJSON(200, "Agregado correctamente", "");
        }
        else{
            Helper::imprimeJSON(false, "Esta Placa ya existe!", "");
        }
    }else{ //Editar

        $id_vehiculo = $_POST["p_id_vehiculo"];
        $resultado = $obj->editar($id_vehiculo, $placa, $modelo, $marca, $aka, $peso, $estado);
        if ($resultado){
            Helper::imprimeJSON(200, "Actualizado correctamente", "");
        }
    }
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}
