<?php
header('Access-Control-Allow-Origin: *');
require_once 'validar.datos.sesion.view.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, minimun-scale=1.0 user-scalable=no" name="viewport">
        <meta name="_token" content="{{ csrf_token() }}">   
        <link rel="stylesheet" href="../util/plugins/mapa.css">

<!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAFwfIZwaZScoGf8kJqRbVGjmUXDYdnyHY&libraries=places&callback=initAutocomplete"-->
        <!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC8q92KkMnYiTt1o5MzN4QOMdB-FKmBXXI&libraries=places&callback=mapa_inicio" async defer></script>-->



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
                        <div class="clearfix"></div>
                        <div class="row">               
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <div class="row">
                                            <div class="form-group">  
                                                <div class="col-md-9 col-sm-12 col-xs-12">
                                                     Gestionar Direcciones
                                                </div>        
                                                <div class="col-md-3 col-sm-12 col-xs-12">

                                                  
                                                </div>                                                  
                                            </div>                                             
                                            <div class="clearfix"></div>
                                        </div>


                                    </div>

                                    <div class="x_content">            
                                        <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">                                          
                                            <div class="row">
                                                <div class="form-group">
                                                    <label class="control-label col-md-1 col-sm-1 col-xs-12">Cliente</label>
                                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                                        <input type="text" readonly=""                                                                 
                                                               id="txt_nombre_cliente" class="form-control input-sm text-bold">
                                                    </div>
                                                    <div class="col-md-3 col-sm-3 col-xs-12">                                                        
                                                    </div>
                                                    <div class="col-md-4 col-sm-4 col-xs-12" style="text-align: right">
                                                        <ul class="nav navbar-right panel_toolbox">
                                                        </ul>
                                                    </div>
                                                </div>                                                                                                
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <label class="control-label col-md-1 col-sm-1 col-xs-12">Dirección</label>
                                                    <div class="col-md-4 col-sm-4 col-xs-12">
                                                        <input type="text" readonly=""                                                           
                                                               id="txt_nueva_direccion" class="form-control input-sm text-bold">
                                                    </div>
                                                    <div class="col-md-4 col-sm-4 col-xs-12">                                                        
                                                    </div>                                                    
                                                    <div class="col-md-7 col-sm-7 col-xs-12" style="text-align: right">                                                        
                                                          <button type="button"  class="btn btn-default btn-sm" data-toggle="modal" 
                                                            data-target="#modal_clientes" >
                                                        <img src='../images/direcciones.png' style="width:1.2em">Direcciones
                                                    </button>   
                                                    <button type="button"  class="btn btn-default btn-sm" onclick="nuevo_limpiar()" >
                                                        <img src='../images/limpiar.png' style="width:1.2em">Nuevo
                                                    </button> 
                                                        <button type="button" onclick="guardar_direccion();" class="btn btn-success" aria-hidden="true" ><i class="fa fa-save"> Guardar</i></button>                                                    
                                                    </div>
                                                </div>
                                            </div>


                                            <!--INICO MODAL CLIENTES-->
                                            <div id="modal_clientes" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <div class="form-group">


                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                                                                </button>                                                            
                                                                <h4 class="modal-title" id="titulomodal">Clientes: 
                                                                    <small><img src="../images/persona.png" style="width: 1.5em"> Persona</small>
                                                                    <small><img src="../images/empresa.png" style="width: 1.5em"> Empresa</small>
                                                                </h4>  
                                                            </div>



                                                        </div>
                                                        <div class="modal-body">                                                                                                                                 
                                                            <div id="listado_clientes"></div>                                                                                                                                                                                                
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal" id="btn_cli_cerrar">Cerrar</button>                                                       
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>


                                        </form>
                                        <input id="pac-input" class="controls" type="text" placeholder="Ingrese Dirección">
                                        <div id="map_direcciones"></div> 
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

        <script src="js/direcciones.js" type="text/javascript"></script>   
        <script src="js/clientes.js" type="text/javascript"></script>
<!--        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB8WATS30_d-Am2k5WHWvW0TW-YdRKrK90&libraries=places&callback=mapa_direcciones" async defer></script>-->
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCruc9bYLRtwWM_Wz2psZjp8_W8teJUKEk&libraries=places&callback=mapa_direcciones" async defer></script>

    </body>
</html>
