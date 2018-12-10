<?php
header('Access-Control-Allow-Origin: *');
$ubicacion = true;
require_once 'validar.datos.sesion.view.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Sistema AlvarezBohl | </title>
        <!-- Bootstrap -->
        <?php include_once 'estilos.view.php'; ?>
    </head>

    <body class="nav-md">
        <div class="container body">
            <div class="main_container">
                <?php include_once 'menu-izquierda.view.php'; ?>

                <!-- top navigation -->
                <?php include_once 'menu-arriba.view.php'; ?>
                <!-- /top navigation -->

                <!-- page content -->
                <div class="right_col" role="main">
                    <div class="">
                        <div class="page-title">

                        </div>
                        <div class="clearfix"></div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>Gestión Cliente / Trabajador / Usuario<small></small></h2>
                                        <ul class="nav navbar-right panel_toolbox">                                            
                                            <li><a title="Nuevo" data-toggle="modal" data-target="#myModal"  id="btn_nuevo"><img src='../images/nuevo_usuario.png' style="width:1.8em"></a></li>
                                            <li><a class="collapse-link" ><i class="fa fa-chevron-up"></i></a>
                                            </li>                                                                                      
                                        </ul>
                                        <div class="clearfix">                                                                                        
                                        </div>
                                    </div>
                                    <div class="x_content">
                                        <div class="row">
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" class="flat" checked name="rb_tipo_persona" id="rb_todos" value="0"> Todos
                                                </label>
                                            </div>
                                             <div class="radio">
                                                <label>
                                                    <input type="radio" class="flat" name="rb_tipo_persona" id="rb_usuarios" value="u"> Usuarios
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" class="flat" name="rb_tipo_persona" id="rb_clientes" value="c"> Clientes
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" class="flat" name="rb_tipo_persona" id="rb_trabajadores" value="t"> Trabajadores
                                                </label>
                                            </div>
                                        </div>
                                        <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                            <!--<div id="listado_personas"></div>--> 
                                            <div class="row" id="users">

                                            </div>



                                            <!--Inicio modal-->
                                            <div id="myModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">

                                                        <div class="modal-header">
                                                            <button type="button" id="btncerrar"  class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">×</span>
                                                            </button>
                                                            <p><input type="text" name="txtid_persona" id="txtid_persona"   style="display:none"></p>
                                                            <h4 class="modal-title" id="titulomodal">Modal title</h4>
                                                            <p>
                                                                <input type="hidden" value="" id="txtTipoOperacion" name="txtTipoOperacion">                                            
                                                            </p>
                                                        </div>
                                                        <div class="modal-body"><small>
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">USUARIO DEL SIST.</label>
                                                                    <div class="col-md-2 col-sm-2 col-xs-12">

                                                                        <input type="radio" class="flat"
                                                                               name="rbusuario" 
                                                                               id="rbsi" 
                                                                               value="si" checked=""> Si &nbsp;&nbsp;&nbsp;
                                                                        <input type="radio" class="flat"
                                                                               name="rbusuario" 
                                                                               id="rbno" 
                                                                               value="no" > No
                                                                    </div>

                                                                </div>
                                                                <div class="form-group" id="cbotipo_usuario">                                                                    
                                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">TIPO USUARIO</label>
                                                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                                                        <select class="form-control" style="height: 30px; font-size: 12px;"
                                                                                id="cbtipo_usuario" ></select>
                                                                    </div>
                                                                </div>   
                                                                <div class="form-group" id="div_password">                                                                    
                                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" id="lbl_pass">PASSWORD</label>
                                                                    <div class="col-md-3 col-sm-3 col-xs-12" >
                                                                        <input type="password"
                                                                               name="txt_password" 
                                                                               id="txt_password" 
                                                                               required=""
                                                                               class="form-control input-sm text-bold" onblur="validar_password();">                                                                       
                                                                    </div>
                                                                    <span class="control-label col-md-3 col-sm-3 col-xs-12" id="div_chk_password1" style="display:none">Cambiar Password</span>
                                                                    <div class="col-md-3 col-sm-3 col-xs-12" id="div_chk_password2" style="display:none">
                                                                        <input type="checkbox" class="flat"                                                          
                                                                               id="chb_cambiar_password" 
                                                                               value="1" >                                                                     
                                                                    </div>
                                                                </div>
                                                                <div class="form-group" id="div_new_password" style="display:none">                                                                    
                                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" >NUEVO PASSWORD</label>
                                                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                                                        <input type="password"
                                                                               name="txt_new_password" 
                                                                               id="txt_new_password" 
                                                                               required=""
                                                                               class="form-control input-sm text-bold">                                                                       
                                                                    </div>
                                                                </div>

                                                                <div class="form-group" >
                                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">SELECCIONE</label>
                                                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                                                        <input type="checkbox" class="flat"                                                          
                                                                               id="chbcliente" 
                                                                               value="c" checked=""> Cliente &nbsp;&nbsp;&nbsp;
                                                                        <input type="checkbox"                                                   
                                                                               id="chbtrabajador" 
                                                                               value="t" class="flat"> Trabajador
                                                                    </div>
                                                                </div>
                                                                <div class="form-group" id="div_password_c">                                                                    
                                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" id="p_1bl_c">PASSWORD CLIENTE</label>
                                                                    <div class="col-md-3 col-sm-3 col-xs-12" id="p_txt_c">
                                                                        <input type="password"
                                                                               name="txt_password_c" 
                                                                               id="txt_password_c" 
                                                                               required="" onblur="validar_password_cliente();" 
                                                                               class="form-control input-sm text-bold">                                                                       
                                                                    </div>
                                                                    <span class="control-label col-md-3 col-sm-3 col-xs-12" id="div_chk_password1_c" style="display:none">Cambiar Password</span>
                                                                    <div class="col-md-3 col-sm-3 col-xs-12" id="div_chk_password2_c" style="display:none">
                                                                        <input type="checkbox" class="flat"                                                          
                                                                               id="chb_cambiar_password_c" 
                                                                               value="1" >                                                                     
                                                                    </div>
                                                                </div>
                                                                <div class="form-group" id="div_new_password_c" style="display:none">                                                                    
                                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" >NUEVO PASSWORD</label>
                                                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                                                        <input type="password"
                                                                               name="txt_new_password" 
                                                                               id="txt_new_password_c" 
                                                                               required=""
                                                                               class="form-control input-sm text-bold">                                                                       
                                                                    </div>
                                                                </div>
                                                                <div class="form-group" id="div_password_t" style="display:none">                                                                    
                                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" id="p_1bl_t">PASSWORD TRABAJADOR</label>
                                                                    <div class="col-md-3 col-sm-3 col-xs-12" id="p_txt_t">
                                                                        <input type="password"
                                                                               name="txt_password_t" 
                                                                               id="txt_password_t" 
                                                                               required="" onblur="validar_password_personal();"
                                                                               class="form-control input-sm text-bold">                                                                       
                                                                    </div>
                                                                    <span class="control-label col-md-3 col-sm-3 col-xs-12" id="div_chk_password1_t" style="display:none">Cambiar Password</span>
                                                                    <div class="col-md-3 col-sm-3 col-xs-12" id="div_chk_password2_t" style="display:none">
                                                                        <input type="checkbox" class="flat"                                                          
                                                                               id="chb_cambiar_password_t" 
                                                                               value="1" >                                                                     
                                                                    </div>
                                                                </div>
                                                                <div class="form-group" id="div_new_password_t" style="display:none">                                                                    
                                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" >NUEVO PASSWORD</label>
                                                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                                                        <input type="password"
                                                                               name="txt_new_password" 
                                                                               id="txt_new_password_t" 
                                                                               required=""
                                                                               class="form-control input-sm text-bold">                                                                       
                                                                    </div>
                                                                </div>
                                                                <div class="form-group" id="rbs_tipo_cliente">
                                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">TIPO CLIENTE</label>
                                                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                                                        <input type="radio" class="flat"
                                                                               name="rbtipo_cliente" 
                                                                               id="rbpersona_natural" 
                                                                               value="p" checked=""> Persona Natural &nbsp;&nbsp;&nbsp;
                                                                        <input type="radio" class="flat"
                                                                               name="rbtipo_cliente" 
                                                                               id="rbempresa" 
                                                                               value="e" > Empresa
                                                                    </div>
                                                                </div>
                                                              <div class="form-group" id="div_zona">                                                                    
                                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">ZONA</label>
                                                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                                                        <select class="form-control" style="height: 30px; font-size: 12px;"
                                                                                id="cbx_zona" ></select>
                                                                    </div>
                                                                </div>   
                                                                <div class="form-group" id="cbos_cargo_area" style="display: none">        
                                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                                                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                                                        <select class="form-control" id="cbcargo" style="font-size: 12px;"></select>
                                                                    </div>
                                                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                                                        <select class="form-control" id="cbarea" style="font-size: 12px;"></select> 
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">DNI - RUC</label>
                                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                                        <input type="text" maxlength="11"
                                                                               name="txtdni_ruc" 
                                                                               id="txtdni_ruc" 
                                                                               required=""
                                                                               class="form-control input-sm text-bold">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group" id="div_razon_social" style="display:none">
                                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">RAZÓN SOCIAL</label>
                                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                                        <input type="text" 
                                                                               name="txtrazon_social" 
                                                                               id="txtrazon_social" 
                                                                               
                                                                               class="form-control input-sm text-bold">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group" id="div_apellidos">
                                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">APELLIDOS</label>
                                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                                        <input type="text" 
                                                                               name="txtapellidos" 
                                                                               id="txtapellidos" 
                                                                               
                                                                               class="form-control input-sm text-bold">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group" id="div_nombres">
                                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">NOMBRES</label>
                                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                                        <input type="text" 
                                                                               name="txtnombres" 
                                                                               id="txtnombres" 
                                                                               
                                                                               class="form-control input-sm text-bold">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group" id="div_fn">
                                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">FECHA NACIMIENTO</label>
                                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                                        <input type="date" 
                                                                               name="txtfecha_nacimiento" 
                                                                               id="txtfecha_nacimiento" 
                                                                               value="<?php date_default_timezone_set("America/Mexico_City"); echo date('d-m-Y'); ?>"
                                                                               class="form-control input-sm text-bold">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">DIRECCION</label>
                                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                                        <input type="text" 
                                                                               name="txtdireccion" 
                                                                               id="txtdireccion" 
                                                                               required=""
                                                                               class="form-control input-sm text-bold">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">EMAIL</label>
                                                                    <div class="col-md-6 col-sm-6 col-xs-12">

                                                                        <input type="text" 
                                                                               name="txtemail" 
                                                                               id="txtemail" 
                                                                               required=""
                                                                               class="form-control input-sm text-bold">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">TELEFONO</label>
                                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                                        <input type="text" 
                                                                               name="txttelefono" 
                                                                               id="txttelefono"
                                                                               class="form-control input-sm text-bold">
                                                                    </div>
                                                                </div>
                                                            </small>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal" id="btn_close_persona">Cerrar</button>
                                                            <button type="button" onclick="guardar_datos()" class="btn btn-success" aria-hidden="true">Guardar</button>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <!--Fin modal-->
                                        </form>                                      
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /page content -->

                <!-- footer content -->
                <?php include_once 'pie.view.php'; ?>
                <!-- /footer content -->
            </div>
        </div>

        <?php include_once 'scripts.view.php'; ?>
        <script src="js/cargo_area.js" type="text/javascript"></script>
        <script src="js/zona.js" type="text/javascript"></script>
        <script src="js/tipo_usuario.js" type="text/javascript"></script>
        <script src="js/persona.js" type="text/javascript"></script>
        <script src="js/movimientos_jquery.js" type="text/javascript"></script>
        <script src="js/validar_passwords.js" type="text/javascript"></script>

    </body>
</html>
