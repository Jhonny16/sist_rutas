<?php

require_once '../data/Conexion.class.php';

class Producto extends Conexion {

   private $tipo;
   private $nombre;
   private $unidad_medida;
   private $cantidad;
   private $precio;
   
   function getTipo() {
       return $this->tipo;
   }

   function getNombre() {
       return $this->nombre;
   }

   function getUnidad_medida() {
       return $this->unidad_medida;
   }

   function getCantidad() {
       return $this->cantidad;
   }

   function getPrecio() {
       return $this->precio;
   }

   function setTipo($tipo) {
       $this->tipo = $tipo;
   }

   function setNombre($nombre) {
       $this->nombre = $nombre;
   }

   function setUnidad_medida($unidad_medida) {
       $this->unidad_medida = $unidad_medida;
   }

   function setCantidad($cantidad) {
       $this->cantidad = $cantidad;
   }

   function setPrecio($precio) {
       $this->precio = $precio;
   }
      
  
    public function agregar() {
        try {

            $sql = "insert into producto (id_tipo,nombre,unidad_medida,cantidad,precio) values
                (:p_tipo,:p_nombre,:p_um,:p_cantidad,:p_precio)";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_tipo", $this->tipo);
            $sentencia->bindParam(":p_nombre", $this->nombre);
            $sentencia->bindParam(":p_um", $this->unidad_medida);
            $sentencia->bindParam(":p_cantidad", $this->cantidad);
            $sentencia->bindParam(":p_precio", $this->precio);
            $sentencia->execute();
            return true;
            
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    
      public function editar($id_producto) {

        $this->dblink->beginTransaction();

        try {
   

            $sql = "
                    update 
                        producto 
                    set 
                        id_tipo = :p_tipo,                    
                        nombre = :p_nombre,                    
                        unidad_medida = :p_um,                    
                        cantidad = :p_cantidad,                    
                        precio = :p_precio
                    where
                        id = :p_id_producto
                    ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_id_producto", $id_producto);
            $sentencia->bindParam(":p_tipo", $this->tipo);
            $sentencia->bindParam(":p_nombre", $this->nombre);
            $sentencia->bindParam(":p_um", $this->unidad_medida);
            $sentencia->bindParam(":p_cantidad", $this->cantidad);
            $sentencia->bindParam(":p_precio", $this->precio);
            $sentencia->execute();

            $this->dblink->commit();

            return true;
        } catch (Exception $exc) {
            $this->dblink->rollBack();
            throw $exc;
        }
        return false;
    }

    
       public function listar_productos($param) {
        try {
           
                $sql = " 
                        select p.id,p.nombre, p.unidad_medida,p.cantidad,p.precio,t.nombre as tipo
                        from producto p inner join tipo_producto t on p.id_tipo = t.id
                        where (case when :p_param = 0 then true else t.id=:p_param end)
                            ";
                $sentencia = $this->dblink->prepare($sql);
                 $sentencia->bindParam(":p_param", $param);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
                return $resultado;
            
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    
     public function leerDatos_producto($id) {
        try {
            $sql = "              
              select p.id,p.nombre, p.unidad_medida,p.cantidad,p.precio,t.nombre as tipo, p.id_tipo
                from producto p inner join tipo_producto t on p.id_tipo = t.id
                where p.id = :p_id
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_id", $id);
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }
    
        public function cargarDatosProducto($nombre) {
        try {
            $sql = "
                select
                        id,
                        nombre,
                        precio,
                        cantidad,
                        unidad_medida
                from
                        producto
                where
                        lower(nombre) like '%".$nombre."%'";
            
            $sentencia = $this->dblink->prepare($sql);
            //$nombre = '%'.strtolower($nombre).'%';
            //$sentencia->bindParam(":p_nombre", $nombre);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
            
    }
    
        public function unidadesvendidas_monto($fecha1, $fecha2, $zona, $opc_estado, $estado) {
        try {
            $sql = "
                    select de.id_producto, pr.nombre, SUM(de.importe)as total, COUNT(de.id_producto) as cantidad
                    from 
                    pre_venta pv 
                    inner join cliente c on c.id = pv.id_cliente
                    inner join detalle de on de.id_pre_venta = pv.id
                    inner join producto pr on de.id_producto=pr.id
                    inner join zona z on c.id_zona = z.id
                     where 
                    (pv.fecha between :p_fecha1 and :p_fecha2) and
                    (case when  :p_zona = 0 then true else z.id = :p_zona end) and
                    (case when :p_opc_estado=0 then true else  (case when  :p_estado = 'P' then pv.estado_seguimiento='P' else pv.estado_seguimiento='E' end) end)
                    group by de.id_producto, pr.nombre
                    order by 1 desc";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_fecha1", $fecha1);
            $sentencia->bindParam(":p_fecha2", $fecha2);
            $sentencia->bindParam(":p_zona", $zona);
            $sentencia->bindParam(":p_opc_estado", $opc_estado);
            $sentencia->bindParam(":p_estado", $estado);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    public function lista($fecha1, $fecha2) {
        try {
            $sql = "
                  select p.id, p.nombre,SUM(d.importe) as monto_total,SUM(d.cantidad) as cantidad_vendida, count(pv.*) as num_ventas
                from pre_venta pv
                  inner join detalle d on d.id_pre_venta =pv.id
                inner join producto p on d.id_producto= p.id
                  where pv.estado_seguimiento = 'E' and (pv.fecha BETWEEN :p_fecha1 and :p_fecha2)
                  GROUP BY p.id, p.nombre ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_fecha1", $fecha1);
            $sentencia->bindParam(":p_fecha2", $fecha2);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }



}
