<?php

require_once '../data/Conexion.class.php';

class Tipo_producto extends Conexion {
   

   public function cargar_tipo_producto() {
       try {
            $sql = "select * from tipo_producto order by 1";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }
   
}
