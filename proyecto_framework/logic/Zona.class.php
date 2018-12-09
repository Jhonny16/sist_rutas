<?php

require_once '../data/Conexion.class.php';

class Zona extends Conexion {
 

   public function cargar_zona() {
       try {
            $sql = "select * from zona order by 1";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }
   
}
