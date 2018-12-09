<?php

require_once '../data/Conexion.class.php';

class Ruta extends Conexion {

    private $ni_letra;
    private $ni_valor;
    private $nf_letra;
    private $nf_valor;
    private $distancia_total;
    private $nintermedios;
    private $recorrido;
    private $id_vehiculo_chofer;
    private $fecha;
    private $costo_galon;
    private $costo_total;
    private $km;

    /**
     * @return mixed
     */
    public function getKm()
    {
        return $this->km;
    }

    /**
     * @param mixed $km
     */
    public function setKm($km)
    {
        $this->km = $km;
    }



    /**
     * @return mixed
     */
    public function getCostoGalon()
    {
        return $this->costo_galon;
    }

    /**
     * @param mixed $costo_galon
     */
    public function setCostoGalon($costo_galon)
    {
        $this->costo_galon = $costo_galon;
    }

    /**
     * @return mixed
     */
    public function getCostoTotal()
    {
        return $this->costo_total;
    }

    /**
     * @param mixed $costo_total
     */
    public function setCostoTotal($costo_total)
    {
        $this->costo_total = $costo_total;
    }



    function getFecha() {
        return $this->fecha;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function getId_vehiculo_chofer() {
        return $this->id_vehiculo_chofer;
    }

    function setId_vehiculo_chofer($id_vehiculo_chofer) {
        $this->id_vehiculo_chofer = $id_vehiculo_chofer;
    }

    function getRecorrido() {
        return $this->recorrido;
    }

    function setRecorrido($recorrido) {
        $this->recorrido = $recorrido;
    }

    function getNintermedios() {
        return $this->nintermedios;
    }

    function setNintermedios($nintermedios) {
        $this->nintermedios = $nintermedios;
    }

    function getNi_letra() {
        return $this->ni_letra;
    }

    function getNi_valor() {
        return $this->ni_valor;
    }

    function getNf_letra() {
        return $this->nf_letra;
    }

    function getNf_valor() {
        return $this->nf_valor;
    }

    function getDistancia_total() {
        return $this->distancia_total;
    }

    function setNi_letra($ni_letra) {
        $this->ni_letra = $ni_letra;
    }

    function setNi_valor($ni_valor) {
        $this->ni_valor = $ni_valor;
    }

    function setNf_letra($nf_letra) {
        $this->nf_letra = $nf_letra;
    }

    function setNf_valor($nf_valor) {
        $this->nf_valor = $nf_valor;
    }

    function setDistancia_total($distancia_total) {
        $this->distancia_total = $distancia_total;
    }

    public function save_ruta($id_punto_inicio, $id_punto_final) {

        try {
            $sql = "
                insert into ruta (nodo_inicio_letra,nodo_inicio_valor,nodo_final_letra,nodo_final_valor,distancia_total,
                 id_vehiculo_chofer, fecha, costo_total, costo_galon,km_recorrido)
                values(:p_nil,:p_niv,:p_nfl,:p_nfv,:p_distancia_total,:p_vc,:p_fecha,:p_costo_total, :p_costo_galon,:p_km)
                ";

            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_nil", $this->ni_letra);
            $sentencia->bindParam(":p_niv", $this->ni_valor);
            $sentencia->bindParam(":p_nfl", $this->nf_letra);
            $sentencia->bindParam(":p_nfv", $this->nf_valor);
            $sentencia->bindParam(":p_distancia_total", $this->distancia_total);
            $sentencia->bindParam(":p_vc", $this->id_vehiculo_chofer);
            $sentencia->bindParam(":p_fecha", $this->fecha);
            $sentencia->bindParam(":p_costo_total", $this->costo_total);
            $sentencia->bindParam(":p_costo_galon", $this->costo_galon);
            $sentencia->bindParam(":p_km", $this->km);

            $sentencia->execute();

            $sql = "select id from ruta order by id desc limit 1";
            $sent = $this->dblink->prepare($sql);
            $sent->execute();
            $result = $sent->fetch();
            if ($sent->rowCount()) {
                $id_ruta = $result["id"];
            }
            
            //INGRESANDO PUNTO DE INICIO
             $sql = "
                insert into ruta_puntos(id_ruta,id_puntos)
                values(:p_id_ruta,:p_punto_inicio)
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_id_ruta", $id_ruta);
            $sentencia->bindParam(":p_punto_inicio", $id_punto_inicio);
            $sentencia->execute();
            
             //INGRESANDO PUNTO DE FINAL
             $sql = "
                insert into ruta_puntos(id_ruta,id_puntos)
                values(:p_id_ruta,:p_punto_inicio)
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_id_ruta", $id_ruta);
            $sentencia->bindParam(":p_punto_inicio", $id_punto_final);
            $sentencia->execute();

            $nodos_intermedios = json_decode($this->getNintermedios());
            foreach ($nodos_intermedios as $key => $value) {
                $sql = "insert into 
                        nodos_intermedios (nodo_letra,nodo_valor_lng,nodo_valor_lat, id_ruta, id_pedido)
                        values(
                        :p_nl, 
                        :p_nvlng, 
                        :p_nvlat, 
                        :p_id_ruta,
                        :p_id_pedido
                        )";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_nl", $value->letra);
                $sentencia->bindParam(":p_nvlng", $value->valor_lng);
                $sentencia->bindParam(":p_nvlat", $value->valor_lat);
                $sentencia->bindParam(":p_id_ruta", $id_ruta);
                $sentencia->bindParam(":p_id_pedido", $value->id_pedido);
                $sentencia->execute();
            }

            $recorrido = json_decode($this->getRecorrido());
            foreach ($recorrido as $key => $value) {
                $sql = "insert into 
                        recorrido (nodo1,nodo2,distancia,id_ruta)
                        values(
                        :p_n1, 
                        :p_n2, 
                        :p_distancia,
                        :p_id
                        )";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_n1", $value->nodo1);
                $sentencia->bindParam(":p_n2", $value->nodo2);
                $sentencia->bindParam(":p_distancia", $value->distancia);
                $sentencia->bindParam(":p_id", $id_ruta);
                $sentencia->execute();
            }


            return true;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    public function lista($fecha1, $fecha2) {
        try {
            $sql = "
               select r.id, r.nodo_inicio_valor, r.nodo_final_valor, r.fecha, r.distancia_total, r.costo_galon,r.costo_total,r.km_recorrido,
               x.apellidos ||' '|| x.nombres as chofer, 
                ('Placa:' ||v.placa || ' / Marca:' || v.marca  || ' / Modelo:' || v.modelo ) as unidad
                from ruta r 
                inner join vehiculo_chofer vc on r.id_vehiculo_chofer = vc.id
                inner join vehiculo v on vc.id_vehiculo=v.id 
                inner join personal p on vc.id_personal=p.id
                inner join persona x on x.id = p.id_persona
                where r.fecha between :p_fecha1 and :p_fecha2
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_fecha1", $fecha1);
            $sentencia->bindParam(":p_fecha2", $fecha2);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
        return false;
    }

}
