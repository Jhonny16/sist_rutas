<?php

/**
 * Created by PhpStorm.
 * User: tito_
 * Date: 05/12/2018
 * Time: 12:15 PM
 */
require_once '../data/Conexion.class.php';
class Devolucion extends Conexion
{
    private $id;
    private $pedido_id;
    private $usuario_id;
    private $fecha;
    private $motivo;
    private $descripcion;
    private $tiempo_maxim;
    private $estado;
    private $code;
    private $responsable;
    private $detalle;

    /**
     * @return mixed
     */
    public function getResponsable()
    {
        return $this->responsable;
    }

    /**
     * @param mixed $responsable
     */
    public function setResponsable($responsable)
    {
        $this->responsable = $responsable;
    }



    /**
     * @return mixed
     */
    public function getDetalle()
    {
        return $this->detalle;
    }

    /**
     * @param mixed $detalle
     */
    public function setDetalle($detalle)
    {
        $this->detalle = $detalle;
    }



    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getPedidoId()
    {
        return $this->pedido_id;
    }

    /**
     * @param mixed $pedido_id
     */
    public function setPedidoId($pedido_id)
    {
        $this->pedido_id = $pedido_id;
    }

    /**
     * @return mixed
     */
    public function getUsuarioId()
    {
        return $this->usuario_id;
    }

    /**
     * @param mixed $usuario_id
     */
    public function setUsuarioId($usuario_id)
    {
        $this->usuario_id = $usuario_id;
    }

    /**
     * @return mixed
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * @param mixed $fecha
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    /**
     * @return mixed
     */
    public function getMotivo()
    {
        return $this->motivo;
    }

    /**
     * @param mixed $motivo
     */
    public function setMotivo($motivo)
    {
        $this->motivo = $motivo;
    }

    /**
     * @return mixed
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * @param mixed $descripcion
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    /**
     * @return mixed
     */
    public function getTiempoMaxim()
    {
        return $this->tiempo_maxim;
    }

    /**
     * @param mixed $tiempo_maxim
     */
    public function setTiempoMaxim($tiempo_maxim)
    {
        $this->tiempo_maxim = $tiempo_maxim;
    }

    /**
     * @return mixed
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * @param mixed $estado
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param mixed $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    public function save() {

        $this->dblink->beginTransaction();

        try {
            $sql = "select secuencia from correlativo where tabla = 'devolucion' order BY 1 desc LIMIT 1";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetch();
            $secuencia = $resultado["secuencia"];
            $secuencia = $secuencia + 1;

            if (strlen($secuencia) == 1) {
                $pad = 5;
            } else {
                if (strlen($secuencia) == 2) {
                    $pad = 4;
                } else {
                    if (strlen($secuencia) == 3) {
                        $pad = 3;
                    } else {
                        if (strlen($secuencia) == 4) {
                            $pad = 2;
                        } else {
                            if (strlen($secuencia) == 5) {
                                $pad = 1;
                            }
                        }
                    }
                }
            }

            $correlativo = str_pad($secuencia, $pad, "0", STR_PAD_LEFT);  // produce "-=-=-Alien"
            $numeracion = "DEV-" . $correlativo;

            $sql = "
                insert into devolucion (pedido_id, usuario_id, fecha, motivo, descripcion, tiempo_maximo, estado, code, responsable)
                values(:p_pedidoid,:p_usuarioid,:p_fecha,:p_motivo,:p_descripcion, :p_time, :p_estado, :p_code, :p_res)
                ";

            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_pedidoid", $this->pedido_id);
            $sentencia->bindParam(":p_usuarioid", $this->usuario_id);
            $sentencia->bindParam(":p_fecha", $this->fecha);
            $sentencia->bindParam(":p_motivo", $this->motivo);
            $sentencia->bindParam(":p_descripcion", $this->descripcion);
            $sentencia->bindParam(":p_time", $this->tiempo_maxim);
            $sentencia->bindParam(":p_estado", $this->estado);
            $sentencia->bindParam(":p_code", $numeracion);
            $sentencia->bindParam(":p_res", $this->responsable);
            $sentencia->execute();

            $sql = "select id from devolucion order by id desc limit 1";
            $sent = $this->dblink->prepare($sql);
            $sent->execute();
            $result = $sent->fetch();
            if ($sent->rowCount()) {
                $dev_id = $result["id"];
            }

            $datosDetalle = json_decode($this->detalle);


            foreach ($datosDetalle as $key => $value) {
                $sql = "insert into 
                        detalle_dev (producto_id, cantidad, devolucion_id)
                        values(
                        :p_id_producto, 
                        :p_cantidad, 
                        :p_devid
                        )";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_devid", $dev_id);
                $sentencia->bindParam(":p_id_producto", $value->producto_id);
                $sentencia->bindParam(":p_cantidad", $value->cantidad);
                $sentencia->execute();

            }
            $sql = "update correlativo set secuencia = :p_secuencia where tabla = 'devolucion' ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_secuencia", $secuencia);
            $sentencia->execute();

            $sql = "update pre_venta set estado_seguimiento = 'N' where id = :p_id ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_id", $this->pedido_id);
            $sentencia->execute();

            $this->dblink->commit();
            return true;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    public function lista($fecha_1, $fecha2, $zona, $state) {
        try {
            $sql = "select dev.id,pre.code as pedido ,dev.code as devolucion, dev.fecha, dev.motivo, dev.descripcion,dev.tiempo_maximo,
                    dev.estado, dev.responsable,
                      (case when p.apellidos = '' then cli.razon_social else p.apellidos||' '||p.cliente end ) as cliente,
                      z.nombre as zona
                    from devolucion dev inner join detalle_dev det on dev.id = det.devolucion_id
                    inner join pre_venta pre on pre.id = dev.pedido_id
                    inner join cliente cli on cli.id = pre.id_cliente inner join zona z on cli.id_zona = z.id
                    inner join persona p on cli.id_persona = p.id
                    where 
                    (dev.fecha between :p_fecha1 and :p_fecha2) and 
                    (case when :p_zona = 0 then true else z.id = :p_zona end) and 
                    (case when :p_state = '0' then true else dev.estado = :p_state end)";

            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_fecha1",$fecha_1);
            $sentencia->bindParam(":p_fecha2", $fecha2);
            $sentencia->bindParam(":p_zona", $zona);
            $sentencia->bindParam(":p_state", $state);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }



    public function detalle($id) {
        try {
            $sql = "select p.id, p.nombre, det.cantidad
                    from detalle_dev det inner join producto p on p.id = det.producto_id
                    where det.devolucion_id = :p_id ";

            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_id",$id);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }
}