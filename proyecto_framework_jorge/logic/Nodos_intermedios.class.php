<?php

require_once '../data/Conexion.class.php';

class Nodos_intermedios extends Conexion {
   

   public function list_nodos_intermedios($id) {
       try {
            $sql = "select n.id, n.id_pedido, n.nodo_letra, 
                    (case when di.direccion_completa != '' then di.direccion_completa else per.direccion end)
                    as direccion, n.nodo_valor_lat as latitud,n.nodo_valor_lng as longitud
                    from nodos_intermedios n 
                    inner join pre_venta p on n.id_pedido = p.id
                    inner join cliente c on c.id = p.id_cliente
                    left join direccion di on di.id_cliente = c.id
                    inner join persona per on c.id_persona = per.id
                    where n.id_ruta = ". $id ."
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
