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
                                    <div class="x_title">LISTA DE RUTAS    
                                        <ul class="nav navbar-right panel_toolbox">
                                            <p>
                                                Desde: <input type="date"  id="fecha1_ruta"  style="width:170px;" 
                                                              value="<?php
                                                              date_default_timezone_set("America/Lima");
                                                              echo date('Y-m-d');
                                                              ?>">
                                                Hasta: <input type="date"  id="fecha2_ruta"  style="width:170px;" 
                                                              value="<?php
                                                              date_default_timezone_set("America/Lima");
                                                              echo date('Y-m-d');
                                                              ?>">
                                                <button type="button" style="background: white" id="btn_buscar_list_pv"  onclick="busqueda_rutas()">...<i class="fa fa-search"></i></button>


                                            </p>  
                                        </ul>
                                    </div>


                                    <div class="x_content">            
                                        <div id="div_rutas"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">TRAYECTORIA                                      
                                </div>

                                <div class="x_content">                                              
                                    <div id="div_trayectoria"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">MAPA                                       
                                </div>

                                <div class="x_content">            
                                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">                                          
                                        <div class="row">
                                            <ul class="nav navbar-right panel_toolbox">
                                                Ver Tráfico
                                                <input id="chb_trafico" type="checkbox" class="flat">   
                                            </ul>                                                                                       
                                        </div>
                                    </form>
                                    <div id="mapa_optimo"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--MODAL DETALLE PREVENTA-->
                    <div id="mdl_list_detalle_pv_ruta" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <div class="form-group">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                                        </button>                                                            
                                        <h4 class="modal-title" id="titulomodal">Detalle Pre-Venta</h4>  
                                        <p><input type="text" id="id_pre_venta" style="display:none"></p>
                                        Fecha Entrega
                                        <input type="date"  id="fecha_entrega" readonly="" value="<?php
                                        date_default_timezone_set("America/Lima");
                                        echo date('Y-m-d');
                                        ?>">

                                    </div>

                                </div>
                                <div class="modal-body">  
                                    <div class="row">
                                        <div class="form-group">
                                            <label class="control-label col-md-1 col-sm-1 col-xs-12">Cliente</label>
                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                <input type="text" readonly=""                                                                 
                                                       id="txt_detalle_cliente" class="form-control input-sm text-bold">
                                            </div>
                                            <div class="col-md-4 col-sm-12 col-xs-12">    
                                                <ul class="nav navbar-right panel_toolbox">
                                                    Entregado
                                                    <input id="chb_entrega" type="checkbox" class="flat">   
                                                </ul>    
                                            </div>                                       
                                        </div>                                                                                                
                                    </div>
                                    <br>
                                    <br>
                                    <div id="list_detalle"></div>                                                                                                                                                                                                
                                </div>
                                <div class="modal-footer">
                                    <button type="button" onclick="actualizar_entrega();" class="btn btn-success" aria-hidden="true">Actualizar</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal" id="btn_pr_cliente_close">Cerrar</button>

                                </div>

                            </div>
                        </div>
                    </div>
                    <!--MODAL DETALLE PREVENTA-->
                    <!--MODAL RUTAS-->
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
                                    <div id="lista_rutas">
                                        <!--<p>Distancia Total: <span id="total"></span></p>-->
                                    </div>                                                                                                                                                                                               
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal" id="btn_cli_cerrar">Cerrar</button>                                                         
                                </div>

                            </div>
                        </div>
                    </div>

                    <!--FIN MODAL RUTAS-->


                </div>
            </div>
            <!-- /page content -->

            <!-- footer content -->
            <?php include_once 'pie.view.php'; ?>

            <!-- /footer content -->

        </div>
    </div>

    <?php include_once 'scripts.view.php'; ?>

    <script src="js/algoritmo_rutas_lista.js" type="text/javascript"></script>                    
    <script src="js/algoritmo_ruta_map.js" type="text/javascript"></script>                    
    <script src="js/algoritmo_rutas_alternativas.js" type="text/javascript"></script> 
<!--    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB8WATS30_d-Am2k5WHWvW0TW-YdRKrK90&libraries=places&callback=init_mapa" async defer></script>-->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCruc9bYLRtwWM_Wz2psZjp8_W8teJUKEk&libraries=places&callback=init_mapa" async defer></script>


</body>
</html>
