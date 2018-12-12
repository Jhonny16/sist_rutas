<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <!--<a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Gentelella Alela!</span></a>-->
            <a href="" class="site_title"><img src="../images/logitoa.png" style="width: 2em; height: 2em"><span>lvarez <img
                            src="../images/imageb.png" style="width: 2em; height: 2em" alt="">ohl</span></a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <div class="profile_pic">
                <img src="../images/userrrr.png" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>Bienvenido,</span><br>
                <h2 style="color: #62de03; "><?php echo $nombreUsuario; ?></h2>
            </div>
        </div>
        <!-- /menu profile quick info -->

        <br/>

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3></h3>

                <ul class="nav side-menu">
                    <li><a href="principal.view.php"><i class="fa fa-desktop"></i> Principal </a>
                    </li>
                    <?php
                    if ($codigoTipoUsuario != 4 ) {
                        echo '<li><a><i class="fa fa-user-plus"></i>Mantenimientos<span class="fa fa-chevron-down"></span></a><ul class="nav child_menu">';


                        if ($codigoTipoUsuario == 1 || $codigoTipoUsuario == 2 || $codigoTipoUsuario == 3 || $codigoTipoUsuario == 5) {
                            echo '   <li><a href="persona.view.php">Cliente/Trab./Usuario</a></li>  ';
                        }


                        if ($codigoTipoUsuario == '1' || $codigoTipoUsuario == '2' || $codigoTipoUsuario == '3' || $codigoTipoUsuario == '5' || $codigoTipoUsuario == '6') {
                            echo '  <li><a href="producto.view.php">Productos</a></li> ';
                        }


                        if ($codigoTipoUsuario == '1' || $codigoTipoUsuario == '2' || $codigoTipoUsuario == '3' || $codigoTipoUsuario == '5') {
                            echo '   <li><a href="vehiculo.view.php">Vehículos</a></li>  ';
                        }

                        echo '</ul></li>';
                    }
                ?>

                    <?php
                    if ($codigoTipoUsuario == '1' || $codigoTipoUsuario == '2' || $codigoTipoUsuario == '3' || $codigoTipoUsuario == '5') {
                        echo '   <li><a><i class="fa fa-hand-o-down"></i>Localizaciones<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="cliente.ubicacion.view.php">Validar dirección</a></li>
                        </ul>
                    </li>      ';

                    }
                    ?>


                    <li><a><i class="fa fa-shopping-cart"></i>Pre Ventas<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <?php
                            if ($codigoTipoUsuario == '1' || $codigoTipoUsuario == '2' || $codigoTipoUsuario == '3' || $codigoTipoUsuario == '5') {

                                echo '<li><a href="pre-venta.view.php">Nueva Pre-Venta</a></li>
                                 <li><a href="pre-venta.lista.view.php">Lista Pre Ventas</a></li>';
                            }

                            if ($codigoTipoUsuario == '4') {

                            echo '<li><a href="preventa_cliente.lista.view.php">Lista Pre-Ventas</a></li>';
                            }
                            ?>

                        </ul>
                    </li>


                    <?php
                    if ($codigoTipoUsuario == '1' || $codigoTipoUsuario == '2' || $codigoTipoUsuario == '5' || $codigoTipoUsuario == '3') {
                        echo '   <li><a><i class="fa fa-truck"></i>Devolución<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="devolucion.php">Nueva Devolución</a></li>
                            <li><a href="devolucion_seguimiento.lista.view.php">Seguimiento Devoluciones</a></li>';
                echo ' </ul>
                    </li> ';

                    }
                    ?>
                    <?php
                    if ($codigoTipoUsuario != 4 ) {
                        echo '<li><a><i class="fa fa-map-marker"></i>Rutas<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">';
                        if ($codigoTipoUsuario == '1' || $codigoTipoUsuario == '2' || $codigoTipoUsuario == '6') {
                            echo '   <li><a href="algoritmo_wizard.php">Generar Ruta</a></li> ';
                        }
                        if ($codigoTipoUsuario == '1' || $codigoTipoUsuario == '2' || $codigoTipoUsuario == '6' || $codigoTipoUsuario == '7') {
                            echo ' <li><a href="algoritmo_mapa.php">Lista Rutas</a></li>';
                        }
                        echo '</ul>
                    </li>   ';
                    }
                    ?>
                    <?php
                    if ($codigoTipoUsuario == '1' || $codigoTipoUsuario == '2') {
                        echo '   <li><a><i class="fa fa-file-pdf-o"></i>Reportes<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="ruta_reporte.php">Reporte Rutas</a></li>                          
                            <li><a href="pre-venta_reporte.php">Reporte Pre-ventas</a></li>
                            <li><a href="cliente_reporte.php">Gráfico Clientes N°Pedidos/Montos</a></li>
                            <li><a href="cliente_reporte_two.php">Reporte Clientes con Un Pedido</a></li>
                            <li><a href="producto_reporte.php">Gráfico Articulos N°Pedidos/Montos</a></li>
                            <li><a href="proyeccion_demanda.php">Proyeccion de Demanda</a></li>
                        </ul>
                    </li>  ';

                    }
                    ?>
                    <?php
                    if ($codigoTipoUsuario == '1' || $codigoTipoUsuario == '2') {
                        echo '   <li><a><i class="fa fa-users"></i>Conf. Usuarios<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="persona.view.php">Usuarios</a></li>
                        </ul>
                    </li>';
                    }
                    ?>
                </ul>
            </div>


        </div>
        <!-- /sidebar menu -->

        <!-- /menu footer buttons -->
        <!--        <div >-->
        <!--             <a href="" class="site_title" style="text-align: center"><img src="../images/dipropan.png" style="width: 6em;"></a>-->
        <!---->
        <!--        </div>-->
        <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Settings" style="background: #1d76d0">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>

        </div>
        <!-- /menu footer buttons -->
    </div>
</div>