<?php

try {

    require_once '../logic/Producto.class.php';
    require_once '../util/functions/Helper.class.php';

    $operacion = $_POST["p_operacion"];
    $tipo_producto = $_POST["p_tipo"];
    $nombre = $_POST["p_nombre"];
    $unidad_medida= $_POST["p_um"];
    $cantidad = $_POST["p_cantidad"];
    $precio = $_POST["p_precio"];

    $obj = new Producto();

    $obj->setTipo($tipo_producto);
    $obj->setNombre($nombre);
    $obj->setUnidad_medida($unidad_medida);
    $obj->setCantidad($cantidad);
    $obj->setPrecio($precio);


    if ($operacion == "agregar") {
        $resultado = $obj->agregar();
        if ($resultado) {
            Helper::imprimeJSON(200, "Agregado correctamente", "");
        }
    } else { //Editar
        $id_producto= $_POST["p_id_producto"];
        $resultado = $obj->editar($id_producto);
        if ($resultado) {
            Helper::imprimeJSON(200, "Datos del Producto actualizados", "");
        }
    }
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}
