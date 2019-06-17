<?php

require_once '../data/Conexion.class.php';

class Cargo extends Conexion {
   

   public function cargar_cargo() {
       try {
            $sql = "select * from cargo where id !=0 order by 1";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }
   
}
