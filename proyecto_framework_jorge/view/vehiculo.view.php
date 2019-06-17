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

        <title>Sistema Dipropan | </title>
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
                                        <h2>Gestión Vehículo(s)<small></small></h2>
                                        <ul class="nav navbar-right panel_toolbox">                                            
                                            <li><a title="Nuevo" id="btn_new_vehiculo" data-toggle="modal" data-target="#mdl_vehiculo"><span class="fa fa-plus"></span><img src='../images/bus.png' style="width:1.8em"></a></li>
                                            <li><a class="collapse-link" ><i class="fa fa-chevron-up"></i></a>
                                            </li>                                                                                      
                                        </ul>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <br />
                                        <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                            <!--<div id="listado_personas"></div>--> 
                                            <div class="row" id="list_vehiculos">

                                            </div>



                                            <!--Inicio modal VEHICULO-->
                                            <div id="mdl_vehiculo" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-sm">
                                                    <div class="modal-content">

                                                        <div class="modal-header">
                                                            <button type="button" class="close" id="btn_cerrar_vehiculo" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                                                            </button>
                                                            <p><input type="text" name="txtid_vehiculo" id="txtid_vehiculo"   style="display:none"></p>
                                                            <h4 class="modal-title" id="titulomodal"><img src="../images/bus.png" style="width: 1.5em">NUEVO VEHÍCULO</h4>
                                                            <p>
                                                                <input type="hidden" value="" id="txtOperacion" name="txtOperacion">                                            
                                                            </p>
                                                        </div>
                                                        <div class="modal-body"><small>                                                                                                                                                                                                                                                              
                                                                <label class="control-label">ESTADO</label>


                                                                <input type="radio" class="flat"
                                                                       name="rb_estado" 
                                                                       id="rb_true" 
                                                                       value="1" checked=""> Activo &nbsp;&nbsp;&nbsp;
                                                                <input type="radio" class="flat"
                                                                       name="rb_estado" 
                                                                       id="rb_false" 
                                                                       value="0" > No Activo <br>

                                                                <label class="control-label ">PLACA</label>                                                                   
                                                                <input type="text" maxlength="11"
                                                                       name="txt_placa" 
                                                                       id="txt_placa" 
                                                                       required=""
                                                                       class="form-control input-sm text-bold">                                                                                                                                                                                                    
                                                                <label class="control-label">MODELO</label>
                                                                <input type="text" 
                                                                       name="txt_modelo" 
                                                                       id="txt_modelo" 
                                                                       required=""
                                                                       class="form-control input-sm text-bold">                                                                                                                                                                                                 
                                                                <label class="control-label">MARCA</label>                                                                   
                                                                <input type="text" 
                                                                       name="txt_marca" 
                                                                       id="txt_marca" 
                                                                       required=""
                                                                       class="form-control input-sm text-bold">                                                                                                                                                                                                 
                                                                <label class="control-label ">AKA</label>                                                                
                                                                <input type="text" 
                                                                       name="txt_aka" 
                                                                       id="txt_aka" 
                                                                       required=""
                                                                       class="form-control input-sm text-bold">   
                                                                <label class="control-label ">PESO KG</label>                                                                
                                                                <input type="text" 
                                                                       name="txt_peso" 
                                                                       id="txt_peso" 
                                                                       required=""
                                                                       class="form-control input-sm text-bold">  
                                                            </small>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" onclick="guardar_datos_vehiculo()" class="btn btn-success" aria-hidden="true">Guardar</button>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <!--Fin modal VEHICULO-->
                                            <!--INICIO MODEL CHOFER-->
                                            <div id="mdl_choferes" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-sm">
                                                    <div class="modal-content">

                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn_cerrar_asignacion"><span aria-hidden="true">×</span>
                                                            </button>
                                                            <p><input type="text" name="" id=""   style="display:none"></p>
                                                            <h4 class="modal-title" id="titulomodal">Asignar Chofer a Vehículo</h4>                                                          
                                                        </div>
                                                        <div class="modal-body"><small>


                                                                <label class="control-label ">CHOFER</label>

                                                                <select class="form-control" style="height: 30px; font-size: 12px;"
                                                                        id="cbx_choferes"></select>



                                                                <label class="control-label ">FECHA</label>

                                                                <input type="date" 
                                                                       name="txt_fecha" 
                                                                       id="txt_fecha" 
                                                                       required=""
                                                                       class="form-control input-sm text-bold">


                                                                <label class="control-label ">HORA INICIO</label>

                                                                <input type="time" 
                                                                       name="txt_hora_inicio" 
                                                                       id="txt_hora_inicio" 
                                                                       required=""
                                                                       class="form-control input-sm text-bold">


                                                                <label class="control-label ">HORA FIN </label>

                                                                <input type="time" 
                                                                       name="txt_hora_fin" 
                                                                       id="txt_hora_fin" onkeyup="validar_hora_fin()"
                                                                       required=""
                                                                       class="form-control input-sm text-bold">



                                                            </small>
                                                        </div>
                                                       <div class="modal-footer">                                                                                                                        
                                                            <button type="button" onclick="save_asignar_chofer()" class="btn btn-success" aria-hidden="true">Guardar</button>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <!--FIN MODEL CHOFER-->
                                             <!--INICIO MODEL LISTA DE CHOFERES-->
                                            <div id="mdl_list_choferes" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">

                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn_cerrar_lista_choferes"><span aria-hidden="true">×</span>
                                                            </button>
                                                            <h4 class="modal-title" id="titulomodal">LISTA DE CHOFERES</h4>                                                          
                                                        </div>
                                                        <div class="modal-body"><small>
                                                                <div id="listado_choferes"></div>
                                                            </small>
                                                        </div>
                                                        <div class="modal-footer">
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <!--FIN MODEL CHOFER-->

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
        <script src="js/vehiculo.js" type="text/javascript"></script>

    </body>
</html>
