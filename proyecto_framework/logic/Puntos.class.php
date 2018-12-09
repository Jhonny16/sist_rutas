<?php

require_once '../data/Conexion.class.php';

class Puntos extends Conexion {
 

   public function punto_partida() {
       try {
            $sql = "select * from puntos where tipo = 'i'";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }
    
     public function punto_final() {
       try {
            $sql = "select * from puntos where tipo = 'f'";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }
   
}
