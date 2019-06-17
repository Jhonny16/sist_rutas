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

<!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAFwfIZwaZScoGf8kJqRbVGjmUXDYdnyHY&libraries=places&callback=initAutocomplete"-->
        <!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDq0k2zJE1k1qMgObC4wZykYqhEVc9_Y1k&libraries=places&callback=map_optimo" async defer></script>-->



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
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left"></form>
                    <div class="">
                        <div class="clearfix"></div>
                        <div class="row">       
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_title"><img src="../images/report.png" style="width: 1.5em"> REPORTE DE RUTAS    
                                        <ul class="nav navbar-right panel_toolbox">

                                        </ul>
                                    </div>


                                    <div class="x_content"> 
                                        <form action="../controller/Reporte.ruta.vista.pdf.controller.php" method="post" >  
                                            <input type="text" style="display:none" name='p_usuario' value="<?php echo $nombreUsuario;?>">
                                        Desde: <input type="date"  id="fecha1_ruta_report"  name='p_fecha1_ruta' style="width:170px;" 
                                                      value="<?php
                                                      date_default_timezone_set("America/Lima");
                                                      echo date('Y-m-d');
                                                      ?>">
                                        Hasta: <input type="date"  id="fecha2_ruta_report" name='p_fecha2_ruta' style="width:170px;" 
                                                      value="<?php
                                                      date_default_timezone_set("America/Lima");
                                                      echo date('Y-m-d');
                                                      ?>">
                                        <button type="button" class="btn btn-default btn-xs" onclick="busqueda_rutas_reporte()"><i class="fa fa-search"></i> Vista Previa</button>
                                        <button type="submit" class="btn btn-default btn-xs" ><img src="../images/pdf.png" style="width: 1.3em"> Exportar PDF</button>
                                        <br>
                                        <br>
                                        <div class="x_panel">
                                            <div class="x_title">Lista de Rutas - Vista   
                                                <ul class="nav navbar-right panel_toolbox">

                                                </ul>
                                            </div>


                                            <div class="x_content"> 
                                            
                                                <div id="div_rutas_vista"></div>
                                            </div>
                                        </div> 
                                        </form>
                                    </div>
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

    <script src="js/ruta_reporte.js" type="text/javascript"></script>                    


</body>
</html>
