<?php

require_once '../data/Conexion.class.php';

class Sesion extends Conexion
{

    private $login;
    private $password;
    private $password_personal;

    function getLogin()
    {
        return $this->login;
    }

    function getPassword()
    {
        return $this->password;
    }

    function getPassword_personal()
    {
        return $this->password_personal;
    }

    function setLogin($login)
    {
        $this->login = $login;
    }

    function setPassword($password)
    {
        $this->password = $password;
    }

    function setPassword_personal($password_personal)
    {
        $this->password_personal = $password_personal;
    }

    public function validar_sesion()
    {
        try {


            $sql = "
                    select u.id as id_usuario, tu.id as cod_tipo_usuario, p.id, p.dni, p.apellidos ||' '||p.nombres as nc, 
                    tu.nombre as tipo_usuario,a.nombre, c.descripcion,
                    u.password, u.estado, (case when p.trabajador = true then 'trabajador' else 'no_trabajador'end) as type
                    from persona p 
                    left join personal pl on p.id=pl.id_persona 
                    inner join usuario u on p.id = u.id_persona
                    left join tipo_usuario tu on u.id_tipo_usuario= tu.id
                    left join area a on pl.id_area = a.id 
                    left join cargo c on pl.id_cargo = c.id
                    where u.password = md5(:p_password) and login = :p_login
                    and u.estado = true
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_login", $this->login);
            $sentencia->bindParam(":p_password", $this->password);
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC); //Utilizo fetch cuando se recupera 1 solo registro
            if ($sentencia->rowCount()) {
                //El usuario si existe
                if ($resultado["password"] == md5($this->password)) {
                    if ($resultado["estado"] == 'true') {
                        session_name("sistema_dipropan");
                        session_start();
                        $_SESSION["s_id_usuario"] = $resultado["id_usuario"];
                        $_SESSION["s_usuario"] = $resultado["nc"];
                        $_SESSION["s_tipo_usuario"] = $resultado["tipo_usuario"];
                        $_SESSION["s_cod_tipo_usuario"] = $resultado["cod_tipo_usuario"];
                        $_SESSION["s_type"] = $resultado["type"];
                        return "SI"; //Si Ingresa
                    } else {
                        return "UI"; //Usuario Inactivo
                    }
                } else {
                    return "CI"; //Clave Incorrecta
                }
            } else {
                $sql = "
                    select u.id as id_usuario,tu.id as cod_tipo_usuario, p.id, p.dni, p.apellidos ||' '||p.nombres as nc, 
                    tu.nombre as tipo_usuario,a.nombre, c.descripcion,
                    u.password_personal, u.estado,  (case when p.trabajador = true then 'trabajador' else 'no_trabajador' end) as type
                    from persona p 
                    left join personal pl on p.id=pl.id_persona 
                    inner join usuario u on p.id = u.id_persona
                    left join tipo_usuario tu on u.id_tipo_usuario= tu.id
                    left join area a on pl.id_area = a.id 
                    left join cargo c on pl.id_cargo = c.id
                    where u.password_personal = md5(:p_password) and login = :p_login
                    and u.estado = true
                ";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_login", $this->login);
                $sentencia->bindParam(":p_password", $this->password);
                $sentencia->execute();
                $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
                if ($sentencia->rowCount()) {
                    //El usuario si existe
                    if ($resultado["password_personal"] == md5($this->password)) {
                        if ($resultado["estado"] == 'true') {
                            session_name("sistema_dipropan");
                            session_start();

                            $_SESSION["s_id_usuario"] = $resultado["id_usuario"];
                            $_SESSION["s_usuario"] = $resultado["nc"];
                            $_SESSION["s_tipo_usuario"] = $resultado["tipo_usuario"];
                            $_SESSION["s_cod_tipo_usuario"] = $resultado["cod_tipo_usuario"];
                            $_SESSION["s_type"] = $resultado["type"];
                            return "SI"; //Si Ingresa
                        } else {
                            return "UI"; //Usuario Inactivo
                        }
                    } else {
                        return "CI"; //No Existe

                    }
                } else {
                    $sql = "select u.id as id_usuario, tu.id as cod_tipo_usuario, p.id,
                             p.apellidos ||' '||p.nombres as nc,
                            tu.nombre as tipo_usuario, u.estado, 
                             (case when p.cliente = true then 'cliente' else 'no_cliente' end) as type, 
                             u.password_cliente
                            from persona p left join cliente c on p.id = c.id_persona
                            inner join usuario u on p.id = u.id_persona
                            inner join tipo_usuario tu on u.id_tipo_usuario = tu.id
                            where u.password_cliente = md5(:p_password) and login = :p_login
                            and u.estado = true ";
                    $sentencia = $this->dblink->prepare($sql);
                    $sentencia->bindParam(":p_login", $this->login);
                    $sentencia->bindParam(":p_password", $this->password);
                    $sentencia->execute();
                    $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
                    if ($sentencia->rowCount()) {
                        //El usuario si existe
                        if ($resultado["password_cliente"] == md5($this->password)) {
                            if ($resultado["estado"] == 'true') {
                                session_name("sistema_dipropan");
                                session_start();
                                $_SESSION["s_id_usuario"] = $resultado["id_usuario"];
                                $_SESSION["s_usuario"] = $resultado["nc"];
                                $_SESSION["s_tipo_usuario"] = $resultado["tipo_usuario"];
                                $_SESSION["s_cod_tipo_usuario"] = $resultado["cod_tipo_usuario"];
                                $_SESSION["s_type"] = $resultado["type"];
                                return "CLI"; //Si Ingresa
                            } else {
                                return "UI"; //Usuario Inactivo
                            }
                        } else {
                            return "CI";
                        }
                    } else {
                        return "NE"; //No Existe
                    }
                }
                //El usuario si existe

            }
        } catch (Exception $exc) {
            throw $exc;
        }
    }

}
