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
                        <div class="page-title">

                        </div>
                        <div class="clearfix"></div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>Gestión Productos<small></small></h2>
                                        <ul class="nav navbar-right panel_toolbox">                                            
                                            <li><a title="Nuevo" data-toggle="modal" data-target="#mdl_producto"  id="btn_nuevo_prod"><i class="fa fa-plus" style="color: greenyellow"></i><img src='../images/producto.png' style="width:1.8em"></a></li>
                                            <li><a class="collapse-link" ><i class="fa fa-chevron-up"></i></a>
                                            </li>                                                                                      
                                        </ul>
                                        <div class="clearfix">                                                                                        
                                        </div>
                                    </div>
                                    <div class="x_content">
                                        <div class="row">
                                            <div class="col-md-3 col-sm-3 col-xs-12">
                                                <select class="form-control" id="cbx_selec_tipo_productos" style="font-size: 12px;"></select>                                                                                                                   
                                            </div>
                                            <div class="col-md-3 col-sm-3 col-xs-12">
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" placeholder="Búsqueda..." id="txt_producto_search">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-default" type="button" style="padding: 7px 12px"
                                                                ><i class="fa fa-search"></i></button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                            <!--<div id="listado_personas"></div>--> 
                                            <div class="row" id="products">

                                            </div>



                                            <!--Inicio modal-->
                                            <div id="mdl_producto" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">

                                                        <div class="modal-header">
                                                            <button type="button" id="btncerrar_prod"  class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">×</span>
                                                            </button>
                                                            <p><input type="text" name="txtid_producto" id="txtid_producto"   style="display:none"></p>
                                                            <h4 class="modal-title" id="titulomodalProd">Modal title</h4>
                                                            <p>
                                                                <input type="hidden" value="" id="txtTipoOperacionProd" name="txtTipoOperacionProd">                                            
                                                            </p>
                                                        </div>
                                                        <div class="modal-body"><small>                                                               
                                                                <div class="form-group" id="cbotipo_usuario">                                                                    
                                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">TIPO PRODUCTO</label>
                                                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                                                        <select class="form-control" style="height: 30px; font-size: 12px;"
                                                                                id="cbtipo_producto" ></select>
                                                                    </div>
                                                                </div>                                                                                                                                                                                                                                                              
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">NOMBRE</label>
                                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                                        <input type="text" 
                                                                               name="txt_nombre_prod" 
                                                                               id="txt_nombre_prod" 
                                                                               required=""
                                                                               class="form-control input-sm text-bold">
                                                                    </div>
                                                                </div>                                                                                                                                                                                                                                                                                                                      
                                                                <div class="form-group" id="cbotipo_usuario">                                                                    
                                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">UNIDAD MEDIDA</label>
                                                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                                                        <select class="form-control" style="height: 30px; font-size: 12px;"
                                                                                id="cb_unidad_medida" >
                                                                            <option value="">-- Seleccione --</option> 
                                                                            <option value="gramos">Gramos</option> 
                                                                            <option value="kilos">Kilos</option> 
                                                                            <option value="bolsa">Bolsa</option> 
                                                                            <option value="unidad">Unidad</option> 
                                                                            <option value="saco">Saco</option> 
                                                                            <option value="caja">Caja</option> 
                                                                        </select>
                                                                    </div>
                                                                </div>   
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">CANTIDAD</label>
                                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                                        <input type="number" min="0" 
                                                                               name="txt_cantidad" 
                                                                               id="txt_cantidad" 
                                                                               required=""
                                                                               class="form-control input-sm text-bold">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">PRECIO S/.</label>
                                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                                        <input type="text" 
                                                                               name="txt_precio" 
                                                                               id="txt_precio" 
                                                                               required=""
                                                                               class="form-control input-sm text-bold">
                                                                    </div>
                                                                </div>
                                                            </small>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" onclick="guardar_productos()" class="btn btn-success" aria-hidden="true">Guardar</button>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <!--Fin modal-->
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
        <script src="js/tipo_producto.js" type="text/javascript"></script>        
        <script src="js/producto.js" type="text/javascript"></script>        
        <!--<script src="js/producto.autocompletar.js" type="text/javascript"></script>-->        

    </body>
</html>
