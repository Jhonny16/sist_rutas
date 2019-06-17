<?php
header('Access-Control-Allow-Origin: *');
require_once 'validar.datos.sesion.view.php';
?>
<!DOCTYPE html>
<html>
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
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB8WATS30_d-Am2k5WHWvW0TW-YdRKrK90&libraries=places&callback=inicio_mapa2" async defer></script>
        <!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC8q92KkMnYiTt1o5MzN4QOMdB-FKmBXXI&libraries=places&callback=mapa_inicio" async defer></script>-->



        <title>Sistema Dipropan | </title>
        <!-- Bootstrap -->
        <?php include_once 'estilos.view.php'; ?>
    </head>

    <body class="nav-md">
        <div class="container body">
            <div class="main_container" >
                <?php include_once 'menu-izquierda.view.php'; ?>

                <!-- top navigation -->
                <?php include_once 'menu-arriba.view.php'; ?>
                <!-- /top navigation -->

                <!-- page content -->
                <div class="right_col" role="main">
                    <div class="">
                        <div class="clearfix"></div>
                        <div class="row">               
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>Algoritmo Dijskstra</h2>
                                        <div class="clearfix"></div>

                                    </div>

                                    <div class="x_content">            
                                        <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">  
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-6 col-sm-6 col-xs-12 ">
                                                        <button type="button" class="btn btn-success btn-sm" id="btn_buscar_direccion" 
                                                                onclick="generar_ruta();"
                                                                ><img src="../images/generar_ruta.png" style="width: 1.5em">
                                                            Generar Ruta</button>
                                                        <button type="button"  class="btn btn-default btn-sm" data-toggle="modal" 
                                                                data-target="#modal_clientes_direcciones" >
                                                            <img src='../images/direcciones.png' style="width:2.8em"> Clientes
                                                        </button>  
                                                        <button type="button"  class="btn btn-default btn-sm" onclick="guardar_ruta()" >
                                                            <img src='../images/save.png' style="width:1.8em"> Guardar
                                                        </button> 

                                                    </div>
                                                    <div class="col-md-6 col-sm-6 col-xs-12 ">                                                       
                                                        <ul class="nav navbar-right panel_toolbox">
                                                            <li><a data-toggle="modal" data-target="#mdl_punto_llegada"> Punto LLegada<img src="../images/p_final.png" style="width: 1.5em"></a> </li>                                                                                                                                                                                    
                                                        </ul> 
                                                        <ul class="nav navbar-right panel_toolbox">
                                                            <li><a data-toggle="modal" data-target="#mdl_punto_partida"> Punto Partida<img src="../images/p_inicio.png" style="width: 1.5em"></a> </li>                                                                                                                                                                                    
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row"><br>
                                                <div class="col-md-6 col-sm-1 col-xs-12">
                                                    <div class="row">
                                                        <div class="col-md-2 col-sm-1 col-xs-12"> 
                                                            <strong>Leyenda:</strong>
                                                        </div>
                                                        <div class="col-md-10 col-sm-1 col-xs-12" id="nodos_referencias">   
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12 col-sm-12 col-xs-12"> 
                                                            <br><br>
                                                            <div id="div_nodos" ></div> 
                                                        </div>

                                                    </div>

                                                </div> 
                                                <div class="col-md-1 col-sm-1 col-xs-12"></div>
                                                <div class="col-md-5 col-sm-1 col-xs-12">
                                                    <p style="color: #005b91"><img src="../images/ruta.png" style="width:2em" ><strong> RUTAS</strong></p>
                                                    <div class="col-md-1 col-sm-1 col-xs-12"></div>
                                                    <div class="col-md-11 col-sm-1 col-xs-12" >
                                                        <div class="row" id="div_num_rutas">

                                                        </div>
                                                        <div class="row" id="div_opt_rutas">

                                                        </div>

                                                    </div>
                                                </div>


                                            </div>

                                            <!--MODAL LISTA DE CLIENTES CON SUS RESPECTIVAS DIRECCIONES-->
                                            <div id="modal_clientes_direcciones" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <div class="form-group">


                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                                                                </button>                                                            
                                                                <h4 class="modal-title" id="titulomodal">Clientes 

                                                                </h4>  
                                                            </div>

                                                        </div>
                                                        <div class="modal-body">                                                                       							 						 
                                                            <div id="listado_clientes_direcciones"></div>                                                                                                                                                                                                
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal" id="btn_cli_cerrar">Cerrar</button>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <!--MODAL TRAYERCTORIAS--->
                                            <div id="modal_rutas" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                                                            </button>
                                                            <h4 class="modal-title" id="titulomodal"><img src="../images/mapa.png" style="width: 2em">Distancias:
                                                                <small>Podrás ver la trayectoria, distancia y tiempo</small></h4>


                                                        </div>
                                                        <div class="modal-body">                                                                                                                                 
                                                            <div id="lista_distancias2">
                                                                <p>Distancia Total: <span id="total"></span></p>
                                                            </div>                                                                                                                                                                                               
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal" id="btn_cli_cerrar">Cerrar</button>                                                         
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

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


                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn_vc_activos_cerrar"><span aria-hidden="true">×</span>
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
                                        </form>
                                        <div id="map" style="display:none"></div> 
                                        <div id="mapu" style="display:none"></div> 

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
        <script src="js/algorittmo_dijskstra.js" type="text/javascript"></script>                    
        <script src="js/algoritmo_ruta_optima.js" type="text/javascript"></script>                    
        <script src="js/algoritmo_rutas_probables.js" type="text/javascript"></script>                    
        <script src="js/clientes.js" type="text/javascript"></script>
        <script src="js/puntos.js" type="text/javascript"></script>  
       
        <!--<script src="js/vehiculos_choferes.js" type="text/javascript"></script>-->  
    </body>
</html>
