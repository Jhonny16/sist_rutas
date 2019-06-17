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
                            <div class="col-md-12">
                                <div class="x_panel">
                                    <form action="../controller/Reporte.preventa.vista.pdf.controller.php" method="post" >
                                    <div class="x_title"><img src="../images/report.png" style="width: 1.5em"> REPORTE DE PRE-VENTAS   
                                        <ul class="nav navbar-right panel_toolbox">

                                        </ul>
                                    </div>
                                    <div class="x_content">
                                        <div class="row">
                                            <!-- form input mask -->
                                            <div class="col-md-5 col-sm-12 col-xs-12">
                                                <div class="x_panel">
                                                    <div class="x_title">
                                                        <h2>Búsqueda por Fecha</h2>   
                                                        <div class="clearfix">                                            
                                                        </div>
                                                    </div>
                                                    <div class="x_content"> 
                                                         <input type="text" style="display:none" name='p_usuario' value="<?php echo $nombreUsuario;?>">
                                                        <div class="row">
                                                            <div class="col-md-5 col-xs-12">
                                                                Desde: <input type="date" name="txtFecha1_pv" id="txtFecha1_pv"  style="width:170px;" 
                                                                              value="2017-07-01">
                                                            </div>
                                                            <div class="col-md-5 col-xs-12">
                                                                Hasta: <input type="date" name="txtFecha2_pv" id="txtFecha2_pv"  style="width:170px;" 
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
                                                                    id="cbx_zona_pv_report" name="p_zona"></select>                                        
                                                        </div>                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-12 col-xs-12">
                                                <div class="x_panel">
                                                    <div class="x_title">
                                                        <h2>Búsqueda por Estado</h2>                                       
                                                        <div class="clearfix"></div>
                                                    </div>
                                                    <div class="x_content">                                      
                                                        <div class="row">
                                                            Seleccione
                                                            <p>
                                                                Pendiente:<input type="radio" class="flat" name="p_estado" id="busq_ep_pv" value="P" checked="" required /> 
                                                                Entregado:<input type="radio" class="flat" name="p_estado" id="busq_ee_pv" value="E" />
                                                            </p>                                 
                                                        </div>                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /form color picker -->

                                        </div>
                                        <br>
                                        <br>
                                        <div class="x_panel">
                                            <div class="x_title">Lista de Pre-ventas Vista   
                                                <ul class="nav navbar-right panel_toolbox">
                                                    <button type="button" class="btn btn-default btn-xs" onclick="busqueda_pv_reporte()"><i class="fa fa-search"></i> Vista Previa</button>
                                                    <button type="submit" class="btn btn-default btn-xs" ><img src="../images/pdf.png" style="width: 1.3em"> Exportar PDF</button>
                                                </ul>
                                            </div>


                                            <div class="x_content"> 

                                                <div id="listado_pv_vista">

                                                </div>
                                            </div>
                                        </div> 



                                    </div>
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

    <script src="js/pre-venta_reporte.js" type="text/javascript"></script>                    


</body>
</html>
