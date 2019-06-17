<?php
header('Access-Control-Allow-Origin: *');
$ubicacion = true;
require_once 'validar.datos.sesion.view.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Sistema</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, minimun-scale=1.0 user-scalable=no" name="viewport">
        <meta name="_token" content="{{ csrf_token() }}">   
        <link rel="stylesheet" href="../util/plugins/mapa.css">
        <link rel="stylesheet" href="../util/plugins/nodos.css">

<!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAFwfIZwaZScoGf8kJqRbVGjmUXDYdnyHY&libraries=places&callback=initAutocomplete"-->

        <title>Sistema Dipropan | </title>
        <!-- Bootstrap -->
        <?php include_once 'estilos.view.php'; ?>
    </head>
    <body class="nav-md">
        <div class="container body">
            <div class="main_container">
                <?php include_once 'menu-izquierda.view.php'; ?>
                <?php include_once 'menu-arriba.view.php'; ?>

                <!-- page content -->
                <div class="right_col" role="main">
                    <div class="">
                        <div class="page-title">                            
                        </div>
                        <div class="clearfix"></div>

                        <div class="row"  >

                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>Generar Ruta <small></small></h2>
                                        <ul class="nav navbar-right panel_toolbox">
                                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                            </li>
                                            <li class="dropdown">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li><a href="#">Settings 1</a>
                                                    </li>
                                                    <li><a href="#">Settings 2</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                                            </li>
                                        </ul>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">                                         
                                            <div id="map" style="display:none"></div> 
                                            <div id="mapu" style="display:none"></div> 
                                            <input type="date" id="fecha_ruta" style="display:none"
                                                   value="<?php
                                                   date_default_timezone_set("America/Lima");
                                                   echo date('Y-m-d');
                                                   ?>">
                                        </form> 
                                        <div id="wizard" class="form_wizard wizard_horizontal">
                                            <ul class="wizard_steps">
                                                <li>
                                                    <a href="#step-1">
                                                        <span class="step_no">1</span>
                                                        <span class="step_descr">
                                                            Paso 1<br />
                                                            <small>Información</small>
                                                        </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#step-2">
                                                        <span class="step_no">2</span>
                                                        <span class="step_descr">
                                                            Paso 2<br />
                                                            <small>Selección de Puntos y Vehículo</small>
                                                        </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#step-3">
                                                        <span class="step_no">3</span>
                                                        <span class="step_descr">
                                                            Paso 3<br />
                                                            <small>Seleccione Pedidos</small>
                                                        </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#step-4">
                                                        <span class="step_no">4</span>
                                                        <span class="step_descr">
                                                            Paso 4<br />
                                                            <small>Generar Ruta</small>
                                                        </span>
                                                    </a>
                                                </li>
                                            </ul>
                                            <div id="step-1">
                                                <div class="row top_tiles">
                                                    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                                        <div class="tile-stats">
                                                            <div class="icon"><i class="fa fa-comments-o"></i></div>
                                                            <div class="count">Lunes</div>
                                                            <p>Zona.</p>
                                                            <h3>LAMBAYEQUE</h3>

                                                        </div>
                                                    </div>
                                                    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                                        <div class="tile-stats">
                                                            <div class="icon"><i class="fa fa-comments-o"></i></div>
                                                            <div class="count">Martes</div>
                                                            <p>Zona Urbana</p>
                                                            <h3>CHICLAYO</h3>

                                                        </div>
                                                    </div>
                                                    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                                        <div class="tile-stats">
                                                            <div class="icon"><i class="fa fa-comments-o"></i></div>
                                                            <div class="count">Miercoles</div>
                                                            <p>Zona Mayoristas</p>
                                                            <h3>CHICLAYO B </h3>
                                                        </div>
                                                    </div>
                                                    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                                        <div class="tile-stats">
                                                            <div class="icon"><i class="fa fa-comments-o"></i></div>
                                                            <div class="count">Jueves</div>
                                                            <p>Zona Moshoqueque</p>
                                                            <h3>JOSÉ LEONARDO ORTIZ</h3>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div id="step-2">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="x_panel" style="height: 300px">
                                                            <div class="x_title">
                                                                <h2>Seleccione Puntos <small>Partida / Llegada</small></h2>                                                                
                                                                <div class="clearfix"></div>
                                                            </div>
                                                            <div class="x_content">
                                                                <div class="row">
                                                                    <ul class="nav navbar-left panel_toolbox">
                                                                        <li><a data-toggle="modal" data-target="#mdl_punto_partida"><img src="../images/p_inicio.png" style="width: 1.5em"> Punto Partida</a> </li>                                                                                                                                                                                    
                                                                    </ul>
                                                                </div>
                                                                <div class="row">
                                                                    <ul class="nav navbar-left panel_toolbox">
                                                                        <li><a data-toggle="modal" data-target="#mdl_punto_llegada"><img src="../images/p_final.png" style="width: 1.5em"> Punto LLegada</a> </li>                                                                                                                                                                                    
                                                                    </ul> 

                                                                </div>    
                                                                <br><br> 
                                                            </div>                                                           

                                                            <div class="x_title">

                                                                <h2>Asignar Vehículo <small></small></h2>                                                                
                                                                <div class="clearfix"></div>
                                                            </div>
                                                            <div class="x_content">
                                                                <div class="row">
                                                                    <ul class="nav navbar-left panel_toolbox">
                                                                        <li><a data-toggle="modal" data-target="#modal_vehiculos_choferes"> <img src='../images/vehiculo.png' style="width:1.7em"> Vehículos</a> </li>                                                                                                                                                                                    
                                                                    </ul>
                                                                </div>                                                              

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1">                                                       
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="x_panel" style="height: 300px">
                                                            <div class="x_title">
                                                                <h2>Datos seleccionados <small></small></h2>                                                                
                                                                <div class="clearfix"></div>
                                                            </div>
                                                            <div class="x_content">
                                                                Punto Partida 
                                                                <input class="form-control" type="text" id="datos_punto_partida" readonly="">
                                                                Punto Llegada 
                                                                <input class="form-control" type="text" id="datos_punto_llegada" readonly="">
                                                                Vehículo 
                                                                <input class="form-control" type="text" id="id_vehiculo_chofer" style="display:none">
                                                                <input class="form-control" type="text" id="datos_vehiculo" readonly="">
                                                                Chofer 
                                                                <input class="form-control" type="text" id="datos_chofer" readonly="">                                                                                                                                                                                                                                                                      
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div id="step-3" >
                                                <div class="row">
                                                    <!-- form input mask -->
                                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                                        <div class="x_panel">
                                                            <div class="x_title">
                                                                <h2>Búsqueda por Fecha</h2>                                                                  
                                                                <div class="clearfix">                                            
                                                                </div>
                                                            </div>
                                                            <div class="x_content">                                       
                                                                <div class="row">
                                                                    <div class="col-md-6 col-xs-12">
                                                                        Desde: <input type="date" name="txtFecha1" id="txtFecha1_algorimto" class="form-control" style="width:170px;" 
                                                                                    value="<?php
                                                                                      date_default_timezone_set("America/Lima");
                                                                                      echo date('Y-m-d');
                                                                                      ?>" >
                                                                    </div>
                                                                    <div class="col-md-6 col-xs-12">
                                                                        Hasta: <input type="date" name="txtFecha2" id="txtFecha2_algoritmo" class="form-control" style="width:170px;" 
                                                                                      value="<?php
                                                                                      date_default_timezone_set("America/Lima");
                                                                                      echo date('Y-m-d');
                                                                                      ?>">
                                                                    </div>                                           
                                                                </div>



                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- /form input mask -->

                                                    <!-- form color picker -->
                                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                                        <div class="x_panel">
                                                            <div class="x_title">
                                                                <h2>Búsqueda por Zona</h2>                                       
                                                                <div class="clearfix"></div>
                                                            </div>
                                                            <div class="x_content">                                      
                                                                <div class="col-md-6 col-sm-12 col-xs-12">
                                                                    Seleccione
                                                                    <select class="form-control" style="height: 30px; font-size: 12px;"
                                                                            id="cbx_zona_pv_algoritmo" ></select>                                        
                                                                </div>                                        
                                                            </div>
                                                        </div>
                                                    </div>                                                                                                        
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                                        <div class="x_panel">
                                                            <div class="x_title">
                                                                <h2> <img src="../images/comprobante.png" style="width: 1.3em">Lista Pre-Ventas <small></small></h2>
                                                                <ul class="nav navbar-right panel_toolbox">
                                                                    <button type="button" class="btn btn-success btn-sm" id="btn_new_pv"><i class="fa fa-copy"></i> Nueva Pre-venta</button>  
                                                                    <button type="button" class="btn btn-default btn-sm"  onclick="busqueda_pv_algoritmo()">...<i class="fa fa-search"></i></button>

                                                                </ul>
                                                                <div class="clearfix"></div>
                                                            </div>
                                                            <div class="x_content">


                                                                <div id="listado_pv_algoritmo">

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>      
                                                    <div class="col-md-6">
                                                        <div class="x_panel" style="height: 200px">
                                                            <div class="x_title">
                                                                <h2>Pedidos seleccionados <small></small></h2>                                                                
                                                                <div class="clearfix"></div>
                                                            </div>
                                                            <div class="x_content">
                                                                <div class="row">
                                                                    <div class="col-xs-12 table">
                                                                        <table class="table table-striped">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>ID Pedido</th>
                                                                                    <th>Cliente</th>
                                                                                    <th>Dirección</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody id="data_pedidos">
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                    <!-- /.col -->
                                                                </div>                                                                                                                                                                                                                                                                 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="step-4" style="height: 400px">
                                                <div class="row">
                                                    <div class="col-xs-12">
                                                        <button type="button" class="btn btn-success btn-sm" id="btn_buscar_direccion" 
                                                                onclick="generar_ruta();"
                                                                ><img src="../images/generar_ruta.png" style="width: 1.5em">
                                                            Generar Ruta</button>                                                          
                                                        <button type="button"  class="btn btn-default btn-sm" onclick="guardar_ruta()" >
                                                            <img src='../images/save.png' style="width:1.8em"> Guardar
                                                        </button>                                                       
                                                    </div>
                                                </div>     
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <div class="col-md-2 col-sm-12 col-xs-12"> 
                                                                <strong>Leyenda:</strong>
                                                            </div>
                                                            <div class="col-md-10 col-sm-12 col-xs-12" id="nodos_referencias">   
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12 col-sm-12 col-xs-12"> 
                                                                <br><br>
                                                                <div id="div_nodos" ></div> 
                                                                <div id="cargando_nodos" ></div> 
                                                            </div>

                                                        </div>

                                                    </div>
                                                    <div class="col-md-6">
                                                        <p style="color: #005b91"><img src="../images/ruta.png" style="width:2em" >
                                                            <strong> RUTAS</strong></p>
                                                        <div class="col-md-1 col-sm-12 col-xs-12"></div>
                                                        <div class="col-md-11 col-sm-12 col-xs-12" >
                                                            <div class="row" id="div_num_rutas">

                                                            </div>
                                                            <div class="row" id="div_opt_rutas">
                                                            </div>
                                                             <div id="cargando_rutas" ></div> 

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <!-- End SmartWizard Content -->

                                    </div>
                                </div>
                            </div>
                        </div>



                        <!--MODALES-->
                        <!--INICIO MODAL PUNTO PARTIDA-->
                        <div id="mdl_punto_partida" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <div class="form-group">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                                            </button>                                                            
                                            <h4 class="modal-title" id="titulomodal">
                                                <img src="../images/p_inicio.png" style="width: 1.5em">Punto Partida                                                                     
                                            </h4>  
                                        </div>
                                    </div>
                                    <div class="modal-body">                                                                                                                                 
                                        <div id="lst_punto_partida"></div>                                                                                                                                                                                                                                                         
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal" id="btn_cerrar_p_partida">Cerrar</button>

                                    </div>

                                </div>
                            </div>
                        </div>
                        <!--FIN MODAL PUNTO DE PARTIDA-->

                        <!--INICIO MODAL PUNTO LLEGADA-->
                        <div id="mdl_punto_llegada" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <div class="form-group">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                                            </button>                                                            
                                            <h4 class="modal-title" id="titulomodal">
                                                <img src="../images/p_final.png" style="width: 1.5em">Punto Llegada                                                                     
                                            </h4>  
                                        </div>
                                    </div>
                                    <div class="modal-body">                                                                                                                                 
                                        <div id="lst_punto_llegada"></div>                                                                                                                                                                                                                                                         
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal" id="btn_cerrar_p_llegada">Cerrar</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!--FIN MODAL PUNTO DE LLEGADA-->

                        <!--MODAL LISTA DE VEHICULOS CON SUS RESPECTIVOS CHOFERES-->
                        <div id="modal_vehiculos_choferes" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <div class="form-group">


                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">×</span>
                                            </button>                                                            
                                            <h4 class="modal-title" id="titulomodal"><strong>VEHÍCULOS </strong>

                                            </h4>  
                                        </div>

                                    </div>
                                    <div class="modal-body">                                                                       							 						 
                                        <div id="listado_vehiculos_choferes_activos"></div>                                                                                                                                                                                                
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal" id="btn_vc_activos_cerrar">Cerrar</button>

                                    </div>

                                </div>
                            </div>
                        </div>
                        <!--FIN DE MODAL LISTA DE VEHICULOS CON SUS RESPECTIVOS CHOFERES-->
                    </div>
                </div>
                <!-- /page content -->






                <?php include_once 'pie.view.php'; ?>                  

            </div>
        </div>

        <?php include_once 'scripts.view.php'; ?>
        <script src="../util/vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js"></script>
        <script src="js/algorittmo_dijskstra.js" type="text/javascript"></script>                    
        <script src="js/algoritmo_ruta_optima.js" type="text/javascript"></script>                    
        <!--<script src="js/algoritmo_rutas_probables.js" type="text/javascript"></script>-->  
        <script src="js/puntos.js" type="text/javascript"></script> 
        <script src="js/vehiculos_choferes.js" type="text/javascript"></script> 
        <script src="js/algoritmo-pre-venta.js" type="text/javascript"></script>        
        <script src="js/zona.js" type="text/javascript"></script>
        <script defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC1tYRnU5g2qjah1m3xQkChP_POIAS_VMU&callback=inicio_mapa2" ></script>

    </body>
</html>
