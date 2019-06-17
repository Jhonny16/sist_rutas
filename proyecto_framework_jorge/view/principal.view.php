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
                                    </div>

                                    <div class="x_content">            
                                        <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">                                          
                                            <img src="../images/dipropan.png" style="width: 9em"><br>
                                            <strong>Bienvenido al Sistema:</strong><br>

                                            <p style="color:#00909b">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                                                 
                                                <?php echo $tipoUsuario . '. ' . $nombreUsuario; ?></p>
                                            <br>
                                            <p ALIGN="justify">Ud. ahora podrá gestionar usuarios del sistema, trabajadores y clientes; además
                                                tendrá la posibilidad de definir de manera precisa la locación de los clientes, para que luego
                                                a través del algoritmo de la ruta más corta optimize la ruta del vehículo.</p>                                                                                        
                                        </form>
                                        <form>
                                            <div class="row">
                                                <div class="col-md-6 col-xs-12">
                                                    <div class="x_panel">
                                                        <div class="x_title">
                                                            <h2>Gestión Usuarios</h2>
                                                            <ul class="nav navbar-right panel_toolbox">
                                                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                                                </li>
                                                                <li class="dropdown">
                                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                                                    <ul class="dropdown-menu" role="menu">
                                                                        <li><a href="persona.view.php">Gestionar Cliente/Trab./Usuario</a>
                                                                        </li>
                                                                    </ul>
                                                                </li>

                                                            </ul>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                        <div class="x_content">
                                                            <img src="../images/gestion_usuarios.PNG" style="width: 90%; height: 70%">
                                                            <p>Puede agregar nuevos trabajadores, clientes y definirlos si serán usuarios para el sistema.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-xs-12">
                                                    <div class="x_panel">
                                                        <div class="x_title">
                                                            <h2>Gestión Direcciones</h2>
                                                            <ul class="nav navbar-right panel_toolbox">
                                                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                                                </li>
                                                                <li class="dropdown">
                                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                                                    <ul class="dropdown-menu" role="menu">
                                                                        <li><a href="cliente.ubicacion.view.php">Defina direccion</a>
                                                                        </li>
                                                                    </ul>
                                                                </li>
                                                               
                                                            </ul>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                      <div class="x_content">
                                                          <img src="../images/gestion_direcciones.PNG" style="width: 90%; height: 70%">
                                                            <p>Seleccione el cliente y determine la dirección por medio de un mapa.
                                                                Además puede precisar a travéz de un marker arrastrable su ubicación exacta.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 col-xs-12">
                                                    <div class="x_panel">
                                                        <div class="x_title">
                                                            <h2>Gestión Vehículos</h2>
                                                            <ul class="nav navbar-right panel_toolbox">
                                                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                                                </li>
                                                                <li class="dropdown">
                                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                                                    <ul class="dropdown-menu" role="menu">
                                                                        <li><a href="vehiculo.view.php">Gestionar Vehículos</a>
                                                                        </li>
                                                                    </ul>
                                                                </li>

                                                            </ul>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                        <div class="x_content">
                                                            <img src="../images/gestion_vehiculos.PNG" style="width: 90%; height: 70%">
                                                            <p>Puede agregar agregar nuevos vehiculos y designarles un trabajador cuyo cargo sea chofer.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-xs-12">
                                                    <div class="x_panel">
                                                        <div class="x_title">
                                                            <h2>Gestión Rutas</h2>
                                                            <ul class="nav navbar-right panel_toolbox">
                                                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                                                </li>
                                                                <li class="dropdown">
                                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                                                    <ul class="dropdown-menu" role="menu">
                                                                        <li><a href="rutas.view.php">Generar Rutas</a>
                                                                        </li>
                                                                    </ul>
                                                                </li>
                                                                
                                                            </ul>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                      <div class="x_content">
                                                          <img src="../images/gestion_rutas.PNG" style="width: 90%; height: 70%">
                                                            <p>Puede determinar el punto de partida y llegada, además seleccionar los clientes para precisar la ruta por el cual el vehículo destinado hará su trayecto.</p>
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

        <script src="js/direcciones.js" type="text/javascript"></script>   
        <script src="js/clientes.js" type="text/javascript"></script>
    </body>
</html>
