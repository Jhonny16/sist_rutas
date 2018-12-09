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
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left"></form>
                    <div class="">

                        <div class="clearfix"></div>
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
                                                Desde: <input type="date" name="txt_fecha1" id="fecha1" class="form-control" style="width:190px;"
                                                              value="2017-07-01">
                                            </div>
                                            <div class="col-md-6 col-xs-12">
                                                Hasta: <input type="date" name="txt_fecha2" id="fecha2" class="form-control" style="width:190px;"
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
                            <div class="col-md-3 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>Búsqueda por Zona</h2>                                       
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">                                      
                                        <div class="row">
                                            Seleccione
                                            <select class="form-control" style="height: 30px; font-size: 12px;"
                                                    id="combo_zona" ></select>
                                        </div>                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>Búsqueda por Estado</h2>                                       
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">                                      
                                        <div class="row">
                                            Seleccione
                                            <select class="form-control" style="height: 30px; font-size: 12px;"
                                                    id="combo_estado" >
                                                <option value="0">Todos</option>
                                                <option value="En Tramite">En Tramite</option>
                                                <option value="Entregado">Entregado</option>
                                            </select>
                                        </div>                                        
                                    </div>
                                </div>
                            </div>
                            <!-- /form color picker -->

                        </div>


                        <div class="row">
                            <div class="col-md-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2> <img src="../images/comprobante.png" style="width: 2em">Lista Devoluciones<small></small></h2>
                                        <ul class="nav navbar-right panel_toolbox">
<!--                                            <button type="button" class="btn btn-success btn-sm" id="btn_new_pv"><i class="fa fa-copy"></i> Nueva Pre-venta</button>  -->
                                            <button type="button" class="btn btn-success" onclick="listar_dev()">Buscar <i class="fa fa-search"></i></button>

                                        </ul>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">


                                        <div id="listado_devoluciones">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /page content --
                <!--MODAL DETALLE PREVENTA-->
                <div id="mdl_list_detalle_pv" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div class="form-group">


                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                                    </button>                                                            
                                    <h4 class="modal-title" id="titulomodal">Detalle Pre-Venta 

                                    </h4>  
                                </div>

                            </div>
                            <div class="modal-body">  
                                <div class="row">
                                    <div class="form-group">
                                        <label class="control-label col-md-1 col-sm-1 col-xs-12">Cliente</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" readonly=""                                                                 
                                                   id="txt_detalle_cliente" class="form-control input-sm text-bold">
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">                                                        
                                        </div>                                       
                                    </div>                                                                                                
                                </div>
                                <br>
                                <br>
                                <div id="list_detalle"></div>                                                                                                                                                                                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal" id="btn_pr_cliente_close">Cerrar</button>

                            </div>

                        </div>
                    </div>
                </div>
                <!--MODAL DETALLE PREVENTA-->
                <!-- footer content -->
                <?php include_once 'pie.view.php'; ?>
                <!-- /footer content -->
            </div>
        </div>

        <?php include_once 'scripts.view.php'; ?>
        <script src="js/devolucion_list.js" type="text/javascript"></script>
<!--        <script src="js/zona.js" type="text/javascript"></script>        -->

  <!--<script src="js/producto.autocompletar.js" type="text/javascript"></script>-->        

    </body>
</html>
