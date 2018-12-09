<?php

require_once '../data/Conexion.class.php';

class Persona extends Conexion {

    private $dni;
    private $apellidos;
    private $nombres;
    private $fecha_nacimiento;
    private $direccion;
    private $telefono;
    private $email;
    private $cliente;
    private $trabajador;
    private $razon_social;

    /**
     * @return mixed
     */
    public function getRazonSocial()
    {
        return $this->razon_social;
    }

    /**
     * @param mixed $razon_social
     */
    public function setRazonSocial($razon_social)
    {
        $this->razon_social = $razon_social;
    }



    public function getCliente() {
        return $this->cliente;
    }

    public function getTrabajador() {
        return $this->trabajador;
    }

    public function setCliente($cliente) {
        $this->cliente = $cliente;
    }

    public function setTrabajador($trabajador) {
        $this->trabajador = $trabajador;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getDni() {
        return $this->dni;
    }

    public function getApellidos() {
        return $this->apellidos;
    }

    public function getNombres() {
        return $this->nombres;
    }

    public function getFecha_nacimiento() {
        return $this->fecha_nacimiento;
    }

    public function getDireccion() {
        return $this->direccion;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function setDni($dni) {
        $this->dni = $dni;
    }

    public function setApellidos($apellidos) {
        $this->apellidos = $apellidos;
    }

    public function setNombres($nombres) {
        $this->nombres = $nombres;
    }

    public function setFecha_nacimiento($fecha_nacimiento) {
        $this->fecha_nacimiento = $fecha_nacimiento;
    }

    public function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    public function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    public function agregar($tipo_cliente, $area, $cargo, $usuario, $tipo_usuario, $password, $password_c, $password_t, $razon_social, $id_zona) {
        try {
            //validacion para cortar si es que ingreso RUC
            $cadena = $this->getDni();

            if (strlen($this->getDni()) > 8) {
                $dni = substr($cadena, 2, 8);
                $ruc = $this->getDni();
            } else {
                $dni = $this->getDni();
                $ruc = "";
            }

            if ($this->getCliente() == 'c') {
                $cliente = '1';
            } else {
                $cliente = '0';
            }
            if ($this->getTrabajador() == 't') {
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
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function listar_persona($param) {
        try {
            if ($param == '0') {
                $sql = " 
            select p.id as id_persona, p.dni, ( case when p.apellidos = '' then cl.razon_social else p.apellidos ||' '|| p.nombres  end ) as nombre_completo, p.cliente ,
            cl.dni_ruc as dni_ruc,
            (case when cl.persona_natural = True then 'Persona Natural' else 'Empresa' end)
            as tipo_cliente,
            p.trabajador,a.nombre as area,c.descripcion as cargo, 
            u.estado as es_usuario ,(case when tu.nombre= '' then '-' else tu.nombre end) as tipo_usuario, 
            p.direccion, p.telefono
            from tipo_usuario tu 
            inner join usuario u on u.id_tipo_usuario = tu.id
            right outer join persona p on u.id_persona = p.id 
            left outer join personal pl on p.id = pl.id_persona
            left join area a on pl.id_area = a.id 
            left join cargo c on pl.id_cargo = c.id
            left outer join cliente cl on cl.id_persona= p.id 

                            ";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
                return $resultado;
            } else {
                if ($param == 'u') {
//                    select p.id as id_persona, p.dni,p.apellidos ||' '|| p.nombres as nombre_completo, p.cliente,

                    $sql = "
                        select p.id as id_persona, p.dni, ( case when p.apellidos = '' then cl.razon_social else p.apellidos ||' '|| p.nombres  end ) as nombre_completo, p.cliente ,
            cl.dni_ruc as dni_ruc,
            (case when cl.persona_natural = True then 'Persona Natural' else 'Empresa' end)
            as tipo_cliente,
            p.trabajador,a.nombre as area,c.descripcion as cargo, 
            u.estado as es_usuario ,(case when tu.nombre= '' then '-' else tu.nombre end) as tipo_usuario, 
            p.direccion, p.telefono
            from tipo_usuario tu 
            inner join usuario u on u.id_tipo_usuario = tu.id
            right outer join persona p on u.id_persona = p.id 
            left outer join personal pl on p.id = pl.id_persona
            left join area a on pl.id_area = a.id 
            left join cargo c on pl.id_cargo = c.id
            left outer join cliente cl on cl.id_persona= p.id 
                        where u.estado=true
                        ";
                    $sentencia = $this->dblink->prepare($sql);
                    $sentencia->execute();
                    $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
                    return $resultado;
                } else {
                    if ($param == 'c') {
                        $sql = "
                         select p.id as id_persona, p.dni, ( case when p.apellidos = '' then cl.razon_social else p.apellidos ||' '|| p.nombres  end ) as nombre_completo, p.cliente ,
            cl.dni_ruc as dni_ruc,
            (case when cl.persona_natural = True then 'Persona Natural' else 'Empresa' end)
            as tipo_cliente,
            p.trabajador,a.nombre as area,c.descripcion as cargo, 
            u.estado as es_usuario ,(case when tu.nombre= '' then '-' else tu.nombre end) as tipo_usuario, 
            p.direccion, p.telefono
            from tipo_usuario tu 
            inner join usuario u on u.id_tipo_usuario = tu.id
            right outer join persona p on u.id_persona = p.id 
            left outer join personal pl on p.id = pl.id_persona
            left join area a on pl.id_area = a.id 
            left join cargo c on pl.id_cargo = c.id
            left outer join cliente cl on cl.id_persona= p.id  
                        where p.cliente=true
                        ";
                        $sentencia = $this->dblink->prepare($sql);
                        $sentencia->execute();
                        $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
                        return $resultado;
                    }
                    if ($param == 't') {
                        $sql = "
                        select p.id as id_persona, p.dni, ( case when p.apellidos = '' then cl.razon_social else p.apellidos ||' '|| p.nombres  end ) as nombre_completo, p.cliente ,
            cl.dni_ruc as dni_ruc,
            (case when cl.persona_natural = True then 'Persona Natural' else 'Empresa' end)
            as tipo_cliente,
            p.trabajador,a.nombre as area,c.descripcion as cargo, 
            u.estado as es_usuario ,(case when tu.nombre= '' then '-' else tu.nombre end) as tipo_usuario, 
            p.direccion, p.telefono
            from tipo_usuario tu 
            inner join usuario u on u.id_tipo_usuario = tu.id
            right outer join persona p on u.id_persona = p.id 
            left outer join personal pl on p.id = pl.id_persona
            left join area a on pl.id_area = a.id 
            left join cargo c on pl.id_cargo = c.id
            left outer join cliente cl on cl.id_persona= p.id 
                        where p.trabajador=true
                        ";
                        $sentencia = $this->dblink->prepare($sql);
                        $sentencia->execute();
                        $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
                        return $resultado;
                    }
                }
            }
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function lista_clientes() {
        try {
            $sql = " 
              select c.id, ( case when p.apellidos = '' then c.razon_social else p.apellidos ||' '|| p.nombres  end ) as nc, 
                (case when d.direccion_completa != '' then d.id else 0 end) as id_direccion,
               (case when d.direccion_completa != '' then d.direccion_completa else p.direccion end) as direccion,
               (case when c.persona_natural = 't' then 'p' else 'e 'end) as tipo_cliente, 
               (case when c.persona_natural  = 't' then p.dni else c.dni_ruc end )as dni_ruc
               from persona p inner join cliente c on p.id = c.id_persona left join direccion d on d.id_cliente = c.id
               where p.cliente = 't'
            ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function leerDatos_persona($id) {
        try {
            $sql = "              
               select p.id as id_persona, u.estado, tu.id as tipo_usuario, p.cliente,
              (case when cl.persona_natural = true then 'p' else 'e' end) 
                as tipo_cliente,
                p.trabajador, c.id as cargo, a.id as area,p.dni,cl.dni_ruc,p.apellidos, p.nombres,
                p.fecha_nacimiento,
                 p.direccion, p.email, p.telefono, cl.razon_social, cl.id_zona
                 from tipo_usuario tu 
            inner join usuario u on u.id_tipo_usuario = tu.id
            right outer join persona p on u.id_persona = p.id 
            left outer join personal pl on p.id = pl.id_persona
            left join area a on pl.id_area = a.id 
            left join cargo c on pl.id_cargo = c.id
            left outer join cliente cl on cl.id_persona= p.id  where p.id = :p_id
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

    public function editar_persona($id_persona, $usuario, $tipo_usuario, $area, $cargo, $tipo_cliente, $new_password, $new_password_c, $new_password_t, $id_zona) {

        $this->dblink->beginTransaction();

        try {
            $cadena = $this->dni;

            if (strlen($this->dni) > 8) {
                $dni = substr($cadena, 2, 8);
                $ruc = $this->dni;
            } else {
                $dni = $this->dni;
                $ruc = null;
            }

            if ($this->cliente == 'c') {
                $cliente = '1';
                if ($tipo_cliente === "p") {
                    $persona = '1';
                    $empresa = '0';
                    $dni_ruc = $ruc;
                } else {
                    $persona = '0';
                    $empresa = '1';
                    $dni_ruc = $ruc;
                }
            } else {
                $cliente = '0';
                $persona = '0';
                $empresa = '0';
                $dni_ruc = $dni;
            }
            if ($this->trabajador == 't') {
                $trabajador = '1';
            } else {
                $trabajador = '0';
                $area = 0;
                $cargo = 0;
            }

            //Actualizo tabla usuario
            if ($usuario == "si") {
                $estado = '1';
            } else {
                $estado = '0';
                $tipo_usuario = 0;
            }

            if ($usuario == "si") {
                if ($this->getCliente() === 'c' || $this->getTrabajador() === 't') {
                    if ($this->getTrabajador() === 't') {
                        $sql = " update 
                    usuario 
                set 
                    id_tipo_usuario = :p_tipo_usuario,                    
                    estado = :p_estado,
                    password_personal= md5(:p_password_t)
                where
                    id_persona = :p_id_persona";
                        $sentencia = $this->dblink->prepare($sql);
                        $sentencia->bindParam(":p_id_persona", $id_persona);
                        $sentencia->bindParam(":p_tipo_usuario", $tipo_usuario);
                        $sentencia->bindParam(":p_estado", $estado);
                        $sentencia->bindParam(":p_password_t", $new_password_t);
                        $sentencia->execute();
                    }
                    if ($this->getCliente() == 'c') {
                        $sql = " update 
                    usuario 
                set 
                    id_tipo_usuario = :p_tipo_usuario,                    
                    estado = :p_estado,
                    password_cliente= md5(:p_password_c)
                where
                    id_persona = :p_id_persona";
                        $sentencia = $this->dblink->prepare($sql);
                        $sentencia->bindParam(":p_id_persona", $id_persona);
                        $sentencia->bindParam(":p_tipo_usuario", $tipo_usuario);
                        $sentencia->bindParam(":p_estado", $estado);
                        $sentencia->bindParam(":p_password_c", $new_password_c);
                        $sentencia->execute();
                    }
                } else {
                    $sql = " update 
                    usuario 
                set 
                    id_tipo_usuario = :p_tipo_usuario,                    
                    estado = :p_estado,
                    password= md5(:p_password)
                where
                    id_persona = :p_id_persona";
                    $sentencia = $this->dblink->prepare($sql);
                    $sentencia->bindParam(":p_id_persona", $id_persona);
                    $sentencia->bindParam(":p_tipo_usuario", $tipo_usuario);
                    $sentencia->bindParam(":p_estado", $estado);
                    $sentencia->bindParam(":p_password", $new_password);
                    $sentencia->execute();
                }
            } else {


                $sql = " update 
                    usuario 
                set 
                    id_tipo_usuario = :p_tipo_usuario,                    
                    estado = :p_estado,
                    password= md5(:p_password)
                where
                    id_persona = :p_id_persona";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_id_persona", $id_persona);
                $sentencia->bindParam(":p_tipo_usuario", $tipo_usuario);
                $sentencia->bindParam(":p_estado", $estado);
                $sentencia->bindParam(":p_password", $new_password);
                $sentencia->execute();


            }



            $sw_cliente=0;
            //Actualizo tabla Cliente
            $sql = "select * from cliente where id_persona = :p_id_persona";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_id_persona", $id_persona);
            $sentencia->execute();
            $result = $sentencia->fetch();
            if ($sentencia->rowCount()) {
                $sw_cliente = 1;
            }

            if($sw_cliente==1){
                $sql = "
                    update 
                        cliente 
                    set 
                        dni_ruc = :p_dni_ruc,                    
                        persona_natural = :p_persona_natural,                    
                        empresa = :p_empresa,     
                        razon_social = :p_razon_social,            
                        id_zona = :p_id_zona
                    where
                        id_persona = :p_id_persona
                    ";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_id_persona", $id_persona);
                $sentencia->bindParam(":p_dni_ruc", $dni_ruc);
                $sentencia->bindParam(":p_persona_natural", $persona);
                $sentencia->bindParam(":p_empresa", $empresa);
                $sentencia->bindParam(":p_razon_social", $this->razon_social);
                $sentencia->bindParam(":p_id_zona", $id_zona);
                $sentencia->execute();
            }



            //Actualizo tabla Personal
            $sw_personal = 0;
            $sql = "select * from personal where id_persona = :p_id_persona";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_id_persona", $id_persona);
            $sentencia->execute();
            $result = $sentencia->fetch();
            if ($sentencia->rowCount()) {
                $sw_personal = 1;
            }

            if($sw_personal==1){
                $sql = "
                    update 
                        personal 
                    set 
                        id_area = :p_id_area,                    
                        id_cargo = :p_id_cargo
                    where
                        id_persona = :p_id_persona
                    ";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_id_persona", $id_persona);
                $sentencia->bindParam(":p_id_area", $area);
                $sentencia->bindParam(":p_id_cargo", $cargo);
                $sentencia->execute();

            }

            $sql = "
                update 
                    persona 
                set 
                    dni = :p_dni,
                    apellidos = :p_apellidos,
                    nombres = :p_nombres,
                    fecha_nacimiento = :p_fn,
                    direccion = :p_direccion,
                    telefono = :p_telefono,
                    email = :p_email,
                    cliente = :p_cliente,
                    trabajador = :p_trabajador                    
                where
                    id = :p_id_persona
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_id_persona", $id_persona);
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
            $this->dblink->commit();

            return true;
        } catch (Exception $exc) {
            $this->dblink->rollBack();
            throw $exc;
        }
        return false;
    }

    //Actualizamos la direccion del cliente
    public function insertar_direcccion_cliente($id, $direccion, $latitud, $longitud, $id_direccion) {


        try {
            $sw = 0;
            $sql = "select * from direccion where id = " . $id_direccion . " ";
            $sent = $this->dblink->prepare($sql);
            $sent->execute();
            $result = $sent->fetch();

            if ($sent->rowCount()) {
                $sw = 1;
            }
            if ($sw == 1) {
                $this->dblink->beginTransaction();

                $sql = "
                update 
                    direccion 
                set 
                    direccion_completa = :p_direccion_completa,
                    latitud = :p_latitud,
                    longitud = :p_longitud                                    
                where
                    id = :p_id_direccion
                ";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_id_direccion", $id_direccion);
                $sentencia->bindParam(":p_direccion_completa", $direccion);
                $sentencia->bindParam(":p_latitud", $latitud);
                $sentencia->bindParam(":p_longitud", $longitud);
                $sentencia->execute();
                $this->dblink->commit();

                return 2;
            } else {
                $sql = "insert into direccion (id_cliente,direccion_completa,latitud,longitud)
                 values (:p_id_cliente,:p_direccion_completa,:p_latitud,:p_longitud)";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_id_cliente", $id);
                $sentencia->bindParam(":p_direccion_completa", $direccion);
                $sentencia->bindParam(":p_latitud", $latitud);
                $sentencia->bindParam(":p_longitud", $longitud);
                $sentencia->execute();

                return True;
            }
        } catch (Exception $ex) {
            $this->dblink->rollBack();
            throw $ex;
        }
    }

    public function direcciones_clientes() {
        try {
            $sql = "
                     select d.id as id_direccion, c.id, ( case when p.apellidos = '' then c.razon_social else p.apellidos ||' '|| p.nombres  end ) as cliente, 
                    (case when d.direccion_completa != '' then d.direccion_completa else p.direccion end ) 
                    as direccion_completa,d.latitud, d.longitud
                    from cliente c left join direccion d on d.id_cliente = c.id 
                    inner join persona p on c.id_persona=p.id";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    public function lista_choferes() {
        try {
            $sql = "select per.id as id_personal,p.apellidos ||' '|| p.nombres as nc, a.nombre as area, c.descripcion as cargo 
                from
                persona p inner  join personal per on p.id=per.id_persona inner join area a on per.id_area = a.id inner join cargo c on per.id_cargo = c.id
                where c.descripcion = 'Chofer' ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    //VALIDACION DE CONTRASEÑAS

    public function validar_password($password, $tipo) {
        try {
            if ($tipo === 1) {
                $sql = "
                    select 
                    count(*) as valor
                    from usuario
                    where password = md5('" . $password . "')";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            } else {
                if ($tipo === 2) {
                    $sql = "
                    select 
                    count(*) as valor
                    from usuario
                    where password_cliente = md5('" . $password . "')";
                    $sentencia = $this->dblink->prepare($sql);
                    $sentencia->execute();
                    $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
                } else {
                    if ($tipo === 3) {
                        $sql = "
                    select 
                    count(*) as valor
                    from usuario
                    where password_personal = md5('" . $password . "')";
                        $sentencia = $this->dblink->prepare($sql);
                        $sentencia->execute();
                        $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
                    }
                }
            }


            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    public function clientes_preventas_cantidad($fecha1, $fecha2, $zona, $opc_estado, $estado) {
        try {
            $sql = "
                    select                     
                    (case  when p.apellidos = '' then c.razon_social else p.apellidos ||' '|| p.nombres  end ) as cliente,SUM(pv.total) as total,
                    z.nombre as zona,count(pv.id_cliente) as cantidad
                    from
                    pre_venta pv 
                    inner join cliente c on c.id = pv.id_cliente
                    left join direccion di on di.id_cliente = c.id
                    inner join persona p on c.id_persona = p.id
                    inner join usuario u on u.id = pv.id_usuario
                    inner join persona per on u.id_persona = per.id
                    inner join zona z on c.id_zona = z.id
                    where 
                    (pv.fecha between :p_fecha1 and :p_fecha2) and
                    (case when  :p_zona = 0 then true else z.id = :p_zona end) and
                    (case when :p_opc_estado=0 then true else  (case when  :p_estado = 'P' then pv.estado_seguimiento='P' else pv.estado_seguimiento='E' end) end)
                     group by   p.apellidos,  p.nombres , z.nombre, c.razon_social
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

    public function clientes_one_pedido($fecha1, $fecha2, $zona) {
        try {
            $sql = "                     
                    Select                     
                    pv.id, ( case when p.apellidos = '' then c.razon_social else p.apellidos ||' '|| 
                    p.nombres  end ) as cliente,
                    (case when di.direccion_completa != '' then di.direccion_completa else p.direccion end)
                    as direccion,
                    pv.fecha ||' / '|| pv.hora as fecha_hora , pv.igv, pv.sub_total,pv.total,
                     per.apellidos ||' '|| per.nombres as usuario
                    from
                    pre_venta pv 
                    inner join cliente c on c.id = pv.id_cliente
                    left join direccion di on di.id_cliente = c.id
                    inner join persona p on c.id_persona = p.id
                    inner join usuario u on u.id = pv.id_usuario
                    inner join persona per on u.id_persona = per.id
                    inner join zona z on c.id_zona = z.id
                    where 
                     pv.fecha between :p_fecha1 and :p_fecha2 and
                    (case when  :p_zona = 0 then true else z.id = :p_zona end)
                    group by  pv.id,p.apellidos,c.razon_social, p.nombres, di.direccion_completa, p.direccion, pv.fecha,  pv.hora,  pv.igv, pv.sub_total,pv.total,per.apellidos, per.nombres
                    having count(pv.id_cliente) = 1
                    order by 1 desc";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_fecha1", $fecha1);
            $sentencia->bindParam(":p_fecha2", $fecha2);
            $sentencia->bindParam(":p_zona", $zona);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

}
