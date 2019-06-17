<?php
    require_once '../logic/Producto.class.php';
    $obj = new Producto();
    
    /*Obtiene el valor de busqueda*/
    $valorBusqueda = $_GET["term"];
    $resultado = $obj->cargarDatosProducto($valorBusqueda);

    /*Variable para elaborar el resultado que se imprime en formato JSON*/
//    $datos = array();
//    for ($i = 0; $i < count($resultado); $i++) {
//        $registro = array
//                (
//                    "label" => $resultado[$i]["nombre"],
//                    "value" => array
//                        (
//                            "id" => $resultado[$i]["id"],
//                            "nombre" => $resultado[$i]["nombre"],
//                            "precio" => $resultado[$i]["precio"],
//                            "cantidad" => $resultado[$i]["cantidad"],
//                            "unidad_medida" => $resultado[$i]["unidad_medida"]
//                
//                        
//                        )
//                );
//
//        $datos[$i] = $registro;
//    }

   // header('Content-Type: application/json');
  header('Content-Type: application/json; charset=utf8');
    //echo json_encode($resultado);
    echo json_encode($resultado);
    
    


    