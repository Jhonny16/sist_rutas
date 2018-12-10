<?php

require_once '../data/Conexion.class.php';

class PreVenta extends Conexion {

    private $id_cliente;
    private $id_usuario;
    private $fecha;
    private $hora;
    private $sub_total;
    private $igv;
    private $total;
    private $estado;
    private $detalle;

    function getDetalle() {
        return $this->detalle;
    }

    function setDetalle($detalle) {
        $this->detalle = $detalle;
    }

    function getId_cliente() {
        return $this->id_cliente;
    }

    function getId_usuario() {
        return $this->id_usuario;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getHora() {
        return $this->hora;
    }

    function getSub_total() {
        return $this->sub_total;
    }

    function getIgv() {
        return $this->igv;
    }

    function getTotal() {
        return $this->total;
    }

    function getEstado() {
        return $this->estado;
    }

    function setId_cliente($id_cliente) {
        $this->id_cliente = $id_cliente;
    }

    function setId_usuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setHora($hora) {
        $this->hora = $hora;
    }

    function setSub_total($sub_total) {
        $this->sub_total = $sub_total;
    }

    function setIgv($igv) {
        $this->igv = $igv;
    }

    function setTotal($total) {
        $this->total = $total;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    public function listar($p_fecha, $p_fecha1, $p_fecha2,$zona, $estado) {
        try {
            $sql = "
                    select                     
                    pv.id, ( case when p.apellidos = '' then c.razon_social else p.apellidos ||' '|| p.nombres  end ) as cliente,
                    (case when di.direccion_completa != '' then di.direccion_completa else p.direccion end) as direccion,
                    pv.fecha ||' / '|| pv.hora as fecha_hora , pv.igv, pv.sub_total,pv.total,
                    (case when pv.estado = 'G' then 'Guardado' else 'Anulado' end ) as estado,
                     per.apellidos ||' '|| per.nombres as usuario, z.nombre as zona,pv.fecha_entrega
                    from
                    pre_venta pv 
                    inner join cliente c on c.id = pv.id_cliente
                    left join direccion di on di.id_cliente = c.id
                    inner join persona p on c.id_persona = p.id
                    inner join usuario u on u.id = pv.id_usuario
                    inner join persona per on u.id_persona = per.id
                    inner join zona z on c.id_zona = z.id
                    where 
                     (case when  :p_fecha=1 then  (pv.fecha between :p_fecha1 and :p_fecha2)
                     else (pv.fecha_entrega between :p_fecha1 and :p_fecha2 )end) and
                    (case when  :p_zona = 0 then true else z.id = :p_zona end) and
                    (pv.estado_seguimiento = :p_estado)
                    order by 1 desc
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_fecha", $p_fecha);
            $sentencia->bindParam(":p_fecha1", $p_fecha1);
            $sentencia->bindParam(":p_fecha2", $p_fecha2);
            $sentencia->bindParam(":p_zona", $zona);
            $sentencia->bindParam(":p_estado", $estado);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    public function registrarPreVenta() {

        $this->dblink->beginTransaction();

        try {

            $pre_venta = 'PV';
            $sql = "
                insert into pre_venta (id_cliente,id_usuario,fecha,hora,sub_total,igv,total,estado,code)
                values(:p_cliente,:p_usuario,:p_fecha,:p_hora,:p_subtotal, :p_igv, :p_total, :p_estado,:p_code)
                ";

            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_cliente", $this->id_cliente);
            $sentencia->bindParam(":p_usuario", $this->id_usuario);
            $sentencia->bindParam(":p_fecha", $this->fecha);
            $sentencia->bindParam(":p_hora", $this->hora);
            $sentencia->bindParam(":p_subtotal", $this->sub_total);
            $sentencia->bindParam(":p_igv", $this->igv);
            $sentencia->bindParam(":p_total", $this->total);
            $sentencia->bindParam(":p_estado", $this->estado);
            $sentencia->bindParam(":p_code", $pre_venta);
            $sentencia->execute();

            $sql = "select id from pre_venta order by id desc limit 1";
            $sent = $this->dblink->prepare($sql);
            $sent->execute();
            $result = $sent->fetch();
            if ($sent->rowCount()) {
                $id_preventa = $result["id"];
            }

            $datosDetalle = json_decode($this->detalle);


            foreach ($datosDetalle as $key => $value) {
                $sql = "insert into 
                        detalle (id_pre_venta,id_producto,cantidad,precio,importe)
                        values(
                        :p_id_pv, 
                        :p_id_producto, 
                        :p_cantidad, 
                        :p_precio,
                        :p_importe
                        )";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_id_pv", $id_preventa);
                $sentencia->bindParam(":p_id_producto", $value->id_producto);
                $sentencia->bindParam(":p_cantidad", $value->cantidad);
                $sentencia->bindParam(":p_precio", $value->precio);
                $sentencia->bindParam(":p_importe", $value->importe);
                $sentencia->execute();

                $sql = "update producto 
                                    set cantidad = cantidad - :p_can 
                            where   
                                    id = :p_cp";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_can", $value->cantidad);
                $sentencia->bindParam(":p_cp", $value->id_producto);
                $sentencia->execute();
            }

            $this->dblink->commit();




            return true;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    public function anularVenta($id_preventa) {
        try {
            $sql = "
                    select * from f_anular_preventa(:p_preventa) as res;
                ";

            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_preventa", $id_preventa);
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }
    public function preventa_cliente() {
        try {
            $sql = "
                    select pv.id, pv.code,
                    p.apellidos || ' '|| p.nombres as cliente
                    from pre_venta pv inner join cliente c on pv.id_cliente = c.id
                    inner join persona p on p.id = c.id_persona

                ";

            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    public function detalle($id_preventa) {
        try {
            $sql = "select estado_seguimiento from pre_venta where id = :p_id";

            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_id", $id_preventa);
            $sentencia->execute();
            $resultado = $sentencia->fetch();
            $state = '';
            if ($sentencia->rowCount()) {
                $state = $resultado["estado_seguimiento"];
            }

            if($state == 'N'){
                $sql = "
                   select
                      pv.id, pv.estado_seguimiento, p.id as id_producto, p.nombre,det.cantidad
                      , p.unidad_medida, p.precio, (p.precio * det.cantidad) as importe,
                      det.id as det_id,
                     ( case when pe.apellidos = '' then c.razon_social else pe.apellidos ||' '|| pe.nombres  end ) as cliente
                    from pre_venta pv
                      inner join cliente c on c.id = pv.id_cliente
                      inner join persona pe on c.id_persona = pe.id
                      inner join devolucion dev on dev.pedido_id = pv.id
                      inner join detalle_dev det on det.devolucion_id = dev.id
                      inner join producto p on det.producto_id = p.id
                    where
                      pv.id = :p_id_pv
                ";

                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_id_pv", $id_preventa);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
                return $resultado;
            }else{
                $sql = "
                   select                                       
                    pv.id, pv.estado_seguimiento, p.id as id_producto, p.nombre, d.cantidad, p.unidad_medida, p.precio, d.importe,
                    d.id as det_id,
                    ( case when pe.apellidos = '' then c.razon_social else pe.apellidos ||' '|| pe.nombres  end ) as cliente
                    from pre_venta pv 
                    inner join detalle d on pv.id = d.id_pre_venta
                    inner join producto p on d.id_producto = p.id
                     inner join cliente c on c.id = pv.id_cliente
                     inner join persona pe on c.id_persona = pe.id
                    where 
                    pv.id = :p_id_pv
                ";

                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_id_pv", $id_preventa);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
                return $resultado;
            }


        } catch (Exception $exc) {
            throw $exc;
        }
    }
    
    
       public function listar_pedidos_algoritmo( $p_fecha1,$p_fecha2,$zona) {
        try {
            $sql = "
                   select                     
                    pv.id, ( case when p.apellidos = '' then c.razon_social else p.apellidos ||' '|| p.nombres  end ) as cliente,
                    (case when di.direccion_completa != '' then di.direccion_completa else p.direccion end) as direccion_completa,
                    di.latitud, di.longitud,
                    pv.fecha as fecha_hora,pv.total,               
                     per.apellidos ||' '|| per.nombres as usuario, z.nombre as zona,
                     pv.code, dev.code
                    from
                    pre_venta pv 
                    inner join cliente c on c.id = pv.id_cliente
                    left join direccion di on di.id_cliente = c.id
                    inner join persona p on c.id_persona = p.id
                    inner join usuario u on u.id = pv.id_usuario
                    inner join persona per on u.id_persona = per.id
                    inner join zona z on c.id_zona = z.id
                    left join devolucion dev on pv.id = dev.pedido_id
                    where 
                    ((pv.fecha between :p_fecha1 and :p_fecha2) or (dev.fecha between :p_fecha1 and :p_fecha2)) and
                    (case when  :p_zona=0 then true else z.id = :p_zona end) and 
                    (pv.estado_seguimiento='P' or pv.code = 'PV' or dev.code != NULL)
                     and pv.estado != 'A'
                    order by 1 desc
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_fecha1", $p_fecha1);
            $sentencia->bindParam(":p_fecha2", $p_fecha2);
            $sentencia->bindParam(":p_zona", $zona);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }
    
      public function actualizar($id_preventa, $fecha, $estado) {

        $this->dblink->beginTransaction();

        try {

            $sql = "select secuencia from correlativo where tabla = 'venta' order BY 1 desc LIMIT 1";
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
            $numeracion = "PED-" . $correlativo;
            if($fecha===''){
                $fecha = Null;
            }

            $sql = "
                    update 
                        pre_venta 
                    set 
                        estado_seguimiento = :p_es,                    
                        fecha_entrega = :p_fecha_entrega,
                        code = :p_code
                    where
                        id = :p_id_pv
                    ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_es", $estado);
            $sentencia->bindParam(":p_fecha_entrega", $fecha);
            $sentencia->bindParam(":p_code", $numeracion);
            $sentencia->bindParam(":p_id_pv", $id_preventa);
            $sentencia->execute();

            $sql = "update correlativo set secuencia = :p_secuencia where tabla = 'venta' ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_secuencia", $secuencia);
            $sentencia->execute();

            $this->dblink->commit();

            return true;
        } catch (Exception $exc) {
            $this->dblink->rollBack();
            throw $exc;
        }
        return false;
    }

    public function actualizar_entrega($id_preventa, $fecha, $estado) {

        $this->dblink->beginTransaction();

        try {

            $sql = "select secuencia from correlativo where tabla = 'venta' order BY 1 desc LIMIT 1";
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
            $numeracion = "PED-" . $correlativo;
            if($fecha===''){
                $fecha = Null;
            }
            $sql = "
                    update 
                        pre_venta 
                    set 
                        estado_seguimiento = :p_es,                    
                        fecha_entrega = :p_fecha_entrega,
                        code = :p_code
                        where
                        id = :p_id_pv
                    ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_es", $estado);
            $sentencia->bindParam(":p_code", $numeracion);
            $sentencia->bindParam(":p_fecha_entrega", $fecha);
            $sentencia->bindParam(":p_id_pv", $id_preventa);
            $sentencia->execute();


            $sql = "update devolucion set estado = 'Entregado' where pedido_id = :p_id ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_id", $id_preventa);
            $sentencia->execute();


            $this->dblink->commit();

            return true;
        } catch (Exception $exc) {
            $this->dblink->rollBack();
            throw $exc;
        }
        return false;
    }

}
