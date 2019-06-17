<?php
/**
 * Created by PhpStorm.
 * User: jhonny
 * Date: 09/06/19
 * Time: 10:50 PM
 */
require_once '../data/Conexion.class.php';
class Usuario extends Conexion
{

    public function read($id) {
        try {
            $sql = "              
               select
                  p.id as id_persona, u.estado,
                  (case when cl.persona_natural = true then 'p' else 'e' end)
                       as tipo_cliente,
                  p.trabajador, p.dni,cl.dni_ruc,p.apellidos, p.nombres,
                  p.fecha_nacimiento,
                  p.direccion, p.email, p.telefono, cl.razon_social, cl.id_zona
                from usuario u inner join persona p on u.id_persona = p.id
                  inner join cliente cl on p.id = cl.id_persona where u.id = :p_id
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

    public function validar_password($id,$passord){

        $sql = "select * from usuario 
                    where id = :p_id";
        $sentencia = $this->dblink->prepare($sql);
        $sentencia->bindParam(":p_id", $id);
        $sentencia->execute();
        $resultado = $sentencia->fetch();
        if ($sentencia->rowCount()) {
            $contrasenia = $resultado["password_cliente"];
            if ($contrasenia == md5($passord)) {
                return 1;
            }
            else{
                return 0;
            }
        }
        return -1;
    }


    public function editar($tipo_cliente, $area, $cargo, $usuario, $tipo_usuario, $password, $password_c, $password_t, $razon_social, $id_zona) {
        try {

            $sql = "select id from persona where dni = :p_dni ";
            $sent = $this->dblink->prepare($sql);
            $sent->bindParam(":p_dni", $this->dni);
            $sent->execute();
            $result = $sent->fetch();
            if ($sent->rowCount()) {
                return -1;
            }
            else{
                //validacion para cortar si es que ingreso RUC
                $cadena = $this->dni;

                if (strlen($this->dni) > 8) {
                    $dni = substr($cadena, 2, 8);
                    $ruc = $this->dni;
                } else {
                    $dni = $this->dni;
                    $ruc = "";
                }

                if ($this->cliente == 'c') {
                    $cliente = '1';
                } else {
                    $cliente = '0';
                }
                if ($this->trabajador == 't') {
                    $trabajador = '1';
                } else {
                    $trabajador = '0';
                }




                $sql = "insert into persona (dni,apellidos,nombres,fecha_nacimiento,direccion,telefono,email
                ,cliente,trabajador) values (:p_dni,:p_apellidos,:p_nombres,:p_fn,:p_direccion,
                :p_telefono, :p_email, :p_cliente, :p_trabajador)";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_dni", $dni);
                $sentencia->bindParam(":p_apellidos", $this->apellidos);
                $sentencia->bindParam(":p_nombres", $this->nombres);
                $sentencia->bindParam(":p_fn", $this->fecha_nacimiento);
                $sentencia->bindParam(":p_direccion", $this->direccion);
                $sentencia->bindParam(":p_telefono", $this->telefono);
                $sentencia->bindParam(":p_email", $this->email);
                $sentencia->bindParam(":p_cliente", $cliente);
                $sentencia->bindParam(":p_trabajador", $trabajador);
                $sentencia->execute();


                //Obtenemos le ultimo registro
                $sql = "select id from persona order by id desc limit 1";
                $sent = $this->dblink->prepare($sql);
                $sent->execute();
                $result = $sent->fetch();
                if ($sent->rowCount()) {
                    $id_persona = $result["id"];
                }


                //Validación para cliente
                if ($cliente == '1') {
                    if ($tipo_cliente === "p") {
                        $persona = '1';
                        $empresa = '0';
                        $dni_ruc = $dni;
                    } else {
                        $persona = '0';
                        $empresa = '1';
                        $dni_ruc = $ruc;
                    }
                    $sql = "insert into cliente (id_persona,dni_ruc,persona_natural, empresa, razon_social,id_zona)
                    values (:p_id_persona,:p_dni_ruc,:p_persona_natural,:p_empresa,:p_razon_social,:p_id_zona)";
                    $sentencia = $this->dblink->prepare($sql);
                    $sentencia->bindParam(":p_id_persona", $id_persona);
                    $sentencia->bindParam(":p_dni_ruc", $dni_ruc);
                    $sentencia->bindParam(":p_persona_natural", $persona);
                    $sentencia->bindParam(":p_empresa", $empresa);
                    $sentencia->bindParam(":p_razon_social", $razon_social);
                    $sentencia->bindParam(":p_id_zona", $id_zona);
                    $sentencia->execute();
                }

                //Valiación para Personal
                if ($trabajador == '1') {
                    $sql = "insert into personal (id_persona, id_area, id_cargo)
                    values (:p_id_persona,:p_area,:p_cargo)";
                    $sentencia = $this->dblink->prepare($sql);
                    $sentencia->bindParam(":p_id_persona", $id_persona);
                    $sentencia->bindParam(":p_area", $area);
                    $sentencia->bindParam(":p_cargo", $cargo);
                    $sentencia->execute();
                }

                if ($usuario == "si") {
                    $estado = '1';
                    $sql = "insert into usuario (id_persona,id_tipo_usuario,login,password,estado,password_cliente,
                    password_personal)
                    values (:p_id_persona,:p_tipo_usuario,:p_login,md5(:p_password),:p_estado,md5(:p_password_c), md5(:p_password_t) )";
                    $sentencia = $this->dblink->prepare($sql);
                    $sentencia->bindParam(":p_id_persona", $id_persona);
                    $sentencia->bindParam(":p_tipo_usuario", $tipo_usuario);
                    $sentencia->bindParam(":p_login", $dni);
                    $sentencia->bindParam(":p_password", $password);
                    $sentencia->bindParam(":p_estado", $estado);
                    $sentencia->bindParam(":p_password_c", $password_c);
                    $sentencia->bindParam(":p_password_t", $password_t);
                    $sentencia->execute();
                }
                return true;
            }

        } catch (Exception $ex) {
            throw $ex;
        }
    }


}