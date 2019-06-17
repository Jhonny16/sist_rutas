<?php

require_once '../data/Conexion.class.php';

class Area extends Conexion {
 

   public function cargar_area() {
       try {
            $sql = "select * from area where id !=0  order by 1";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }
   
}
