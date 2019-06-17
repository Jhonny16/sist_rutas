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
                                    <form action="../controller/Reporte.cliente.vista.pdf.controller.php" method="post" >
                                    <div class="x_title"><img src="../images/report.png" style="width: 1.5em"> REPORTE CLIENTES CON SOLO 1 COMPRA   
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
                                                                Desde: <input type="date" name="txtFecha1_cliente" id="txtFecha1_cliente"  style="width:170px;" 
                                                                              value="2017-07-01">
                                                            </div>
                                                            <div class="col-md-5 col-xs-12">
                                                                Hasta: <input type="date" name="txtFecha2_cliente" id="txtFecha2_cliente"  style="width:170px;" 
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
                                                                    id="cbx_zona_cliente_report" name="cbx_zona_cliente_report"></select>                                        
                                                        </div>                                        
                                                    </div>
                                                </div>
                                            </div>                                           
                                            <!-- /form color picker -->

                                        </div>
                                        <br>
                                        <br>
                                        <div class="x_panel">
                                            <div class="x_title">Lista de Clientes con un pedido 
                                                <ul class="nav navbar-right panel_toolbox">
                                                    <button type="button" class="btn btn-default btn-xs" onclick="busqueda_clientes_one_pedido()"><i class="fa fa-search"></i> Vista Previa</button>
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

    <script src="js/cliente_reporte_two.js" type="text/javascript"></script>                    


</body>
</html>
