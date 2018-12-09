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
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, minimun-scale=1.0 user-scalable=no"
          name="viewport">

    <title>Sistema AlvarezBohl | </title>
    <!-- Bootstrap -->
    <?php include_once 'estilos.view.php'; ?>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        var data ;
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawVisualization);
        function drawVisualization() {

        }
    </script>

</head>

<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <?php include_once 'menu-izquierda.view.php'; ?>

        <!-- top navigation -->
        <?php include_once 'menu-arriba.view.php'; ?>
        <!-- /top navigation -->

        <!-- page content -->
        <!-- page content -->
        <div class="right_col" role="main">
            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left"></form>
            <div class="">

                <div class="clearfix"></div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="x_panel">
                            <form>
                                <div class="x_title"><img src="../images/report.png" style="width: 1.5em"> REPORTE DE
                                    PROYECCIÓN DE DEMANDA
                                    <ul class="nav navbar-right panel_toolbox">

                                    </ul>
                                </div>
                                <div class="x_content">
                                    <div class="row">
                                        <!-- form input mask -->
                                        <div class="col-md-8 col-sm-12 col-xs-12">
                                            <div class="x_panel">
                                                <div class="x_title">
                                                    <h2>Búsqueda por Fecha</h2>
                                                    <div class="clearfix">
                                                    </div>
                                                </div>
                                                <div class="x_content">
                                                    <div class="row">
                                                        <div class="col-md-4 col-xs-12">
                                                            Desde: <input type="date" id="txt_fecha1"
                                                                          style="width:170px;"
                                                                          value="<?php
                                                                          date_default_timezone_set("America/Lima");
                                                                          echo date('Y-m-d');
                                                                          ?>">
                                                        </div>
                                                        <div class="col-md-4 col-xs-12">
                                                            Hasta: <input type="date" id="txt_fecha2"
                                                                          style="width:170px;"
                                                                          value="<?php
                                                                          date_default_timezone_set("America/Lima");
                                                                          echo date('Y-m-d');
                                                                          ?>">

                                                        </div>
                                                        <div class="col-md-4 col-xs-12">
                                                            <button type="button" class="btn btn-default btn-xs pull-right" onclick="listado()"><i class="fa fa-search"></i> Buscar</button>


                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /form input mask -->

                                        <!-- form color picker -->
                                    </div>
                                    <br>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="x_panel">
                                                    <div class="x_title">
                                                        <h2>Button Example
                                                            <small>Users</small>
                                                        </h2>
                                                        <ul class="nav navbar-right panel_toolbox">
                                                            <li><a class="collapse-link"><i
                                                                            class="fa fa-chevron-up"></i></a>
                                                            </li>
                                                            <li class="dropdown">
                                                                <a href="#" class="dropdown-toggle"
                                                                   data-toggle="dropdown" role="button"
                                                                   aria-expanded="false"><i
                                                                            class="fa fa-wrench"></i></a>
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
                                                        <table id="datatable" class="table table-striped table-bordered">
                                                            <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>PRODUCTO</th>
                                                                <th>MONTO TOTAL</th>
                                                                <th>CANTIDAD VENDIDA</th>
                                                                <th>NUM VENTAS</th>
                                                                <th>PROYECCION</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody id="detalle_productos">
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php require_once 'modal_proyeccion.php'?>
        </div>
    </div>
    <!-- /page content -->

    <!-- footer content -->
    <?php include_once 'pie.view.php'; ?>

    <!-- /footer content -->

</div>
</div>

<?php include_once 'scripts.view.php'; ?>

<!--<script src="js/zona.js" type="text/javascript"></script>-->
<script src="js/producto_proyeccion.js" type="text/javascript"></script>


</body>
</html>
