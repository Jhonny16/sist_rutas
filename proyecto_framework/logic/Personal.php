<?php

/**
 * Created by PhpStorm.
 * User: tito_
 * Date: 05/12/2018
 * Time: 1:13 PM
 */
require_once '../data/Conexion.class.php';
class Personal extends Conexion
{
    public function lista() {
        try {
            $sql = "select p.apellidos ||' '|| p.nombres as personal, c.descripcion as cargo
                    from persona p inner join personal pe on p.id = pe.id_persona
                      inner join cargo c on c.id = pe.id_cargo
                    where c.descripcion in ('Vendedor','Chofer');";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }
}