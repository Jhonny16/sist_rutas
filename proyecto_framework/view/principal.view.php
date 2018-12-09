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
                    <div class="">
                        <div class="clearfix"></div>
                        <div class="row">               
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_title">                                       
                                    </div>

                                    <div class="x_content">            

                                        <form>
                                            <div class="row">
                                                <div class="col-md-3 col-xs-12 widget widget_tally_box">
                                                    <div class="x_panel fixed_height_390">
                                                        <div class="x_content">

                                                            <div class="flex">
                                                                <ul class="list-inline widget_profile_box">
                                                                    <li>
                                                                        <a>
                                                                            <i class="fa fa-users"></i>
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <img src="../images/userss.png" alt="..." class="img-circle profile_img">
                                                                    </li>
                                                                    <li>
                                                                        <a>
                                                                            <i class="fa fa-users"></i>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>

                                                            <h3 class="name">Gestión Usuarios</h3>

                                                            <div class="flex">
                                                                <ul class="list-inline count2">
                                                                    <li>
                                                                        <h3>90</h3>
                                                                        <span>Clientes</span>
                                                                    </li>
                                                                    <li>
                                                                        <h3>20</h3>
                                                                        <span>Trab.</span>
                                                                    </li>
                                                                    <li>
                                                                        <h3>10</h3>
                                                                        <span>Usuarios</span>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <p>
                                                                Puede agregar nuevos trabajadores, clientes y definirlos si serán usuarios para el sistema.
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-xs-12 widget widget_tally_box">
                                                    <div class="x_panel fixed_height_390">
                                                        <div class="x_content">

                                                            <div class="flex">
                                                                <ul class="list-inline widget_profile_box">
                                                                    <li>
                                                                        <a>
                                                                            <i class="fa fa-map-marker"></i>
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <img src="../images/address.png" alt="..." class="img-circle profile_img">
                                                                    </li>
                                                                    <li>
                                                                        <a>
                                                                            <i class="fa fa-map-marker"></i>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>

                                                            <h3 class="name">Gestión Direcciones</h3>

                                                            <div class="flex">
                                                                <ul class="list-inline count2">
                                                                    <li>
                                                                    </li>
                                                                    <li>
                                                                        <h3><i class="fa fa-search"></i></h3>
                                                                        <span>Direcciones</span>
                                                                    </li>
                                                                    <li>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <p>
                                                                Seleccione el cliente y determine la dirección por medio de un mapa.
                                                                Además puede precisar a través de un marker arrastrable su ubicación exacta.
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-xs-12 widget widget_tally_box">
                                                    <div class="x_panel fixed_height_390">
                                                        <div class="x_content">

                                                            <div class="flex">
                                                                <ul class="list-inline widget_profile_box">
                                                                    <li>
                                                                        <a>
                                                                            <i class="fa fa-bus"></i>
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <img src="../images/vehiculos.png" alt="..." class="img-circle profile_img">
                                                                    </li>
                                                                    <li>
                                                                        <a>
                                                                            <i class="fa fa-bus"></i>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>

                                                            <h3 class="name">Gestión Vehículos</h3>

                                                            <div class="flex">
                                                                <ul class="list-inline count2">
                                                                    <li>
                                                                    </li>
                                                                    <li>
                                                                        <h3>+ 18</h3>
                                                                        <span>Vehículos.</span>
                                                                    </li>
                                                                    <li>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <p>
                                                                Puede agregar agregar nuevos vehiculos y designarles un trabajador cuyo cargo sea chofer.
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-xs-12 widget widget_tally_box">
                                                    <div class="x_panel fixed_height_390">
                                                        <div class="x_content">

                                                            <div class="flex">
                                                                <ul class="list-inline widget_profile_box">
                                                                    <li>
                                                                        <a>
                                                                            <i class="fa fa-exchange"></i>
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <img src="../images/rutas.png" alt="..." class="img-circle profile_img">
                                                                    </li>
                                                                    <li>
                                                                        <a>
                                                                            <i class="fa fa-exchange"></i>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>

                                                            <h3 class="name">Gestión Rutas</h3>

                                                            <div class="flex">
                                                                <ul class="list-inline count2">
                                                                    <li>
                                                                        <h3>1</h3>
                                                                        <span>Nodo Inicial.</span>
                                                                    </li>
                                                                    <li>
                                                                        <h3>+ 2</h3>
                                                                        <span>Nodos Inter.</span>
                                                                    </li>
                                                                    <li>
                                                                        <h3>1</h3>
                                                                        <span>Nodo Final.</span>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <p>
                                                                Puede determinar el punto de partida y llegada, además seleccionar los
                                                                clientes para precisar la ruta por el cual el vehículo destinado hará su trayecto.
                                                            </p>
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
