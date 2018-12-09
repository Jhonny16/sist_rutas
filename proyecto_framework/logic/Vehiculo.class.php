<?php

require_once '../data/Conexion.class.php';

class Vehiculo extends Conexion {

    public function agregar($placa, $modelo, $marca, $aka, $peso, $estado) {
        try {

            //Obtenemos le ultimo registro                          
            $sql = "select * from vehiculo where placa = '" . $placa . "' ";
            $sent = $this->dblink->prepare($sql);
            $sent->execute();
            $result = $sent->fetch();
            $sw = 0;
            if ($sent->rowCount()) {
                $sw = 1;
            }
            if ($sw === 1) {
                return false;
            } else {
                $sql = "insert into vehiculo (placa,modelo,marca,aka,peso,estado) values
                (:p_placa,:p_modelo,:p_marca,:p_aka,:p_peso,:p_estado)";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_placa", $placa);
                $sentencia->bindParam(":p_modelo", $modelo);
                $sentencia->bindParam(":p_marca", $marca);
                $sentencia->bindParam(":p_aka", $aka);
                $sentencia->bindParam(":p_peso", $peso);
                $sentencia->bindParam(":p_estado", $estado);
                $sentencia->execute();
                return true;
            }
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function listar_vehiculo() {
        try {
            $sql = "select * from vehiculo";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function list_choferes_vehiculo($id) {
        try {
            $sql = "
              select vc.id,per.dni, per.apellidos ||' '|| per.nombres as chofer,vc.fecha, vc.hora_inicio, vc.hora_fin 
              from vehiculo v left join vehiculo_chofer vc on v.id=vc.id_vehiculo inner join personal p on vc.id_personal = p.id inner join persona per on p.id_persona = per.id
              where v.id= :p_id ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_id", $id);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    public function leerdDatos_vehiculo($id) {
        try {
            $sql = "
              Select * from vehiculo where id=:p_id   ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_id", $id);
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    public function editar($id_vehiculo, $placa, $modelo, $marca, $aka, $peso, $estado) {

        $this->dblink->beginTransaction();

        try {
            $sql = " update 
                    vehiculo 
                set 
                    placa = :p_placa,                    
                    modelo= :p_modelo,                    
                    marca= :p_marca,                    
                    aka= :p_aka,                    
                    peso= :p_peso,                    
                    estado = :p_estado                    
                where
                    id = :p_id";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_id", $id_vehiculo);
            $sentencia->bindParam(":p_placa", $placa);
            $sentencia->bindParam(":p_modelo", $modelo);
            $sentencia->bindParam(":p_marca", $marca);
            $sentencia->bindParam(":p_aka", $aka);
            $sentencia->bindParam(":p_peso", $peso);
            $sentencia->bindParam(":p_estado", $estado);
            $sentencia->execute();

            $this->dblink->commit();

            return true;
        } catch (Exception $exc) {
            $this->dblink->rollBack();
            throw $exc;
        }
        return false;
    }

    public function agregar_chofer($id_vehiculo, $id_personal, $fecha, $hora_inicio, $hora_fin) {
        try {

            if ($hora_inicio > $hora_fin) {
                return false;
            } else {
                $sql = "insert into vehiculo_chofer (id_vehiculo,id_personal,fecha,hora_inicio,hora_fin) values
                (:p_vehiculo,:p_personal,:p_fecha,:p_hora_inicio,:p_hora_fin)";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_vehiculo", $id_vehiculo);
                $sentencia->bindParam(":p_personal", $id_personal);
                $sentencia->bindParam(":p_fecha", $fecha);
                $sentencia->bindParam(":p_hora_inicio", $hora_inicio);
                $sentencia->bindParam(":p_hora_fin", $hora_fin);
                $sentencia->execute();
                return true;
            }
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function eliminar_vehiculo_chofer($id) {
        try {
            $sql = "
                delete from 
                    vehiculo_chofer 
                where
                    id = :p_id
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_id", $id);
            $sentencia->execute();
            return true;
        } catch (Exception $exc) {
            throw $exc;
        }
        return false;
    }

    public function lista_vehiculos_choferes_activos() {
        try {
            $sql = " select vc.id,
                    x.apellidos ||' '|| x.nombres as chofer, 
                    ('Placa:' ||v.placa || ' / Marca:' || v.marca  || ' / Modelo:' || v.modelo ) as unidad,
                    vc.fecha, vc.hora_inicio,vc.hora_fin
                    from
                    persona x inner join personal p on x.id = p.id_persona inner join cargo
                    c on c.id = p.id_cargo inner join
                    vehiculo_chofer vc on vc.id_personal = p.id inner join vehiculo v on vc.id_vehiculo = v.id
                    where c.descripcion = 'Chofer' and v.estado = true";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

}
