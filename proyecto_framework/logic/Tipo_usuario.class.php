<?php

require_once '../data/Conexion.class.php';

class Tipo_usuario extends Conexion {
   

   public function cargar_tipo_usuario() {
       try {
            $sql = "select * from tipo_usuario where id not in(0,1)order by 1";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }
   
}
