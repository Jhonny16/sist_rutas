<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <!--<a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Gentelella Alela!</span></a>-->
            <a href="" class="site_title"><img src="../images/logo.png"
                                               style="width: 2em; height: 2em"><span>ipropan</span></a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <div class="profile_pic">
                <img src="images/img.jpg" alt="..." class="img-circle profile_img">
                <input type="text" style="display: none" id="s_user_id" value="<?php echo $id_usuario; ?>">
                <input type="text" style="display: none" id="s_tipo_usuario" value="<?php echo $codigoTipoUsuario; ?>">
            </div>
            <div class="profile_info">
                <span>Bienvenido,</span><br>
                <h2 style="color: #62de03; "><?php echo $nombreUsuario; ?></h2>
            </div>
        </div>
        <!-- /menu profile quick info -->

        <br/>
        <?php
        if ($type == 'cliente') {
            echo '
                  <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                       <div class="menu_section">
                        <h3></h3>
                        <ul class="nav side-menu">
                            <li><a><i class="fa fa-desktop"></i> Modo Cliente </a>
                            </li>
                            <li><a href="mis_datos.view.php"><i class="fa fa-user-md"></i>Mis datos<span class="fa fa-chevron-down"></span></a>                               
                            </li>      
                             <li><a href="historial.view.php"><i class="fa fa-user-md"></i>Historial<span class="fa fa-chevron-down"></span></a>                               
                            </li>                       
                        </ul>
                    </div>               
                        </div>
                    <div>
                
                ';
        } else {

            if ($codigoTipoUsuario == 6) {
                echo '
                  <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                       <div class="menu_section">
                            <h3></h3>
                            <ul class="nav side-menu">
                            <li><a href="principal.view.php"><i class="fa fa-desktop"></i> Principal </a>
                            </li>         
                              <li><a><i class="fa fa-arrows"></i>Gestión Direcciones<span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="cliente.ubicacion.view.php">Defina la dirección</a></li>
        
                                </ul>
                            </li>                                          
                            <li><a><i class="fa fa-file-archive-o"></i>Gestión Pre-ventas<span
                                            class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="pre-venta.view.php">Nueva Pre Venta</a></li>
                                    <li><a href="pre-venta.lista.view.php">Lista Pre Ventas</a></li>
        
                                </ul>
                            </li>                                                 
                        </ul>
                        </div>               
                   </div>                                  
                ';
            } else {
                if ($codigoTipoUsuario == 7) {
                    echo '
                  <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                       <div class="menu_section">
                            <h3></h3>
                            <ul class="nav side-menu">
                            <li><a href="principal.view.php"><i class="fa fa-desktop"></i> Principal </a>
                            </li>                           
                            <li><a><i class="fa fa-arrows"></i>Gestión Direcciones<span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="cliente.ubicacion.view.php">Defina la dirección</a></li>
        
                                </ul>
                            </li>                          
                            <li><a><i class="fa fa-map-marker"></i>Gestión Rutas<span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">                                 
                                    <li><a href="algoritmo_mapa.php">Lista Rutas</a></li>        
                                </ul>
                            </li>                           
                        </ul>
                        </div>                                      
                   </div>
                
                ';
                } else {
                    echo '
                  <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                       <div class="menu_section">
                        <h3></h3>
                        <ul class="nav side-menu">
                            <li><a href="principal.view.php"><i class="fa fa-desktop"></i> Principal </a>
                            </li>
                            <li><a><i class="fa fa-users"></i>Gestión Mants<span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="persona.view.php">Cliente/Trab./Usuario</a></li>
                                    <li><a href="producto.view.php">Productos</a></li>
                                    <li><a href="vehiculo.view.php">Vehículos</a></li>
                                </ul>
                            </li>
                            <li><a><i class="fa fa-arrows"></i>Gestión Direcciones<span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="cliente.ubicacion.view.php">Defina la dirección</a></li>
        
                                </ul>
                            </li>
                            <li><a><i class="fa fa-file-archive-o"></i>Gestión Pre-ventas<span
                                            class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="pre-venta.view.php">Nueva Pre Venta</a></li>
                                    <li><a href="pre-venta.lista.view.php">Lista Pre Ventas</a></li>
        
                                </ul>
                            </li>
                            <li><a><i class="fa fa-map-marker"></i>Gestión Rutas<span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">                                                             
                                    <li><a href="algoritmo_wizard.php">Generar Ruta</a></li>
                                    <li><a href="algoritmo_mapa.php">Lista Rutas</a></li>        
                                </ul>
                            </li>
                            <li><a><i class="fa fa-file-pdf-o"></i>Reportes<span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <!--                            <li><a href="rutas.view.php">Generar Rutas</a></li>
                                                                <li><a href="rutas.view_algoritmo.php">Información</a></li>-->
                                    <li><a href="ruta_reporte.php">Reporte Rutas</a></li>
                                    <li><a href="pre-venta_reporte.php">Reporte Pre-ventas</a></li>
                                    <li><a href="cliente_reporte.php">Gráfico Clientes N°Pedidos/Montos</a></li>
                                    <li><a href="cliente_reporte_two.php">Reporte Clientes con Un Pedido</a></li>
                                    <li><a href="producto_reporte.php">Gráfico Articulos N°Pedidos/Montos</a></li>
        
                                </ul>
                            </li>
                        </ul>
                    </div>               
                        </div>
                    <div>
                
                ';
                }
            }
        }
        ?>

        <!-- sidebar menu -->

        <a href="" class="site_title" style="text-align: center"><img src="../images/dipropan.png"
                                                                      style="width: 6em;"></a>

    </div>
    <div class="sidebar-footer hidden-small">
        <a data-toggle="tooltip" data-placement="top" title="Settings">
            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
        </a>
        <a data-toggle="tooltip" data-placement="top" title="FullScreen">
            <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
        </a>
        <a data-toggle="tooltip" data-placement="top" title="Lock">
            <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
        </a>
        <a data-toggle="tooltip" data-placement="top" title="Logout"
           href="../controller/sesion.cerrar.controller.php">
            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
        </a>
    </div>
    <!-- /menu footer buttons -->
</div>
</div>