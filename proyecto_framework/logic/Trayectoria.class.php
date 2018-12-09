<?php

require_once '../data/Conexion.class.php';

class Trayectoria extends Conexion {

   public function list_trayectorias($id) {
       try {
            $sql = "select t.*, r.nodo_inicio_letra, r.nodo_inicio_valor, r.nodo_final_letra, r.nodo_final_valor
                    from recorrido t inner join ruta r on t.id_ruta = r.id 
                    where r.id = " .$id . ";
                     ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

}
