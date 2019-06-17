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
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left"></form>
                    <div class="">

                        <input id="pv_id_usuario" style="display:none" value="<?php echo $id_usuario ?>">
                        <input id="pv_fecha" style="display:none" value="<?php
                        date_default_timezone_set("America/Lima");
                        echo date('Y-m-d');
                        ?>">
                        <input id="pv_hora" style="display:none" 
                               value="<?php date_default_timezone_set("America/Lima");
                               echo date('H:i:s');
                        ?>">
                        <div class="clearfix"></div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2> <img src="../images/comprobante.png" style="width: 2em">Comprobante Borrador <small></small></h2>
                                        <ul class="nav navbar-right panel_toolbox">
                                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                            </li>
                                            <li class="dropdown">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
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

                                        <section class="content invoice">
                                            <!-- title row -->
                                            <div class="row">
                                                <div class="col-xs-12 invoice-header">
                                                    <h4>
                                                        <small class="pull-right">Fecha: <?php
                                                            date_default_timezone_set("America/Mexico_City");
                                                            echo date('Y-m-d');
                                                            ?></small>
                                                    </h4>
                                                </div>
                                                <!-- /.col -->
                                            </div>
                                            <!-- info row -->
                                            <div class="row invoice-info">
                                                <div class="col-sm-5 invoice-col">
                                                    <button type="button"  class="btn btn-default btn-sm" data-toggle="modal" 
                                                            data-target="#mdl_list_clientes" >
                                                        <img src='../images/direcciones.png' style="width:2.8em">Lista Clientes
                                                    </button>   
                                                    <address>
                                                        <input id="pv_cl_codigo" style="display:none">
                                                        <strong>DNI/RUC:</strong><input class="form-control" id="pv_cl_dni_ruc" readonly="">
                                                        <br>Cliente: <input class="form-control" id="pv_cl_nc" readonly="">
                                                        <br>Dirección: <input class="form-control  " id="pv_cl_direccion"readonly="">
                                                    </address>
                                                </div>
                                                <!-- /.col -->
                                                <div class="col-sm-2 invoice-col"></div>
                                                <div class="col-sm-5 invoice-col">
                                                    <button type="button"  class="btn btn-default btn-sm " data-toggle="modal" 
                                                            data-target="#mdl_list_productos" >
                                                        <img src='../images/producto.png' style="width:1.8em">&nbsp;&nbsp;Lista Productos
                                                    </button>  
                                                    <address>
                                                        <input id="pv_pr_codigo" style="display:none">
                                                        <input id="pv_pr_stock" style="display:none">
                                                        <strong>PRODUCTO</strong><input class="form-control" id="pv_pr_nombre" readonly="">
                                                        <br>Unidad Medida<input class="form-control" id="pv_pr_unidad_medida" readonly="">
                                                        <br>Precio <input class="form-control " id="pv_pr_precio" readonly=""> 
                                                        <div class="row">
                                                            <div class="col-sm-3">
                                                                 <br>Cantidad 
                                                        <input type="number" min="0" class="form-control" id="pv_pr_cantidad" 
                                                               >   
                                                            </div>
                                                            <div class="col-sm-9" style="text-align: right"><br>
                                                                 <br><button type="button"  class="btn btn-default " id="btn_agregar_pv">
                                                            <i class="fa fa-plus"></i> Agregar
                                                        </button>  
                                                            </div>
                                                        </div>
                                                                                                           
                                                        
                                                    </address>
                                                </div>
                                                <!-- /.col -->                                                                                             
                                            </div>
                                            <!-- /.row -->

                                            <!-- Table row -->
                                            <div class="row">
                                                <div class="col-xs-12 table">
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th># Cod</th>
                                                                <th>Product</th>
                                                                <th style="text-align: right">Precio</th>
                                                                <th style="text-align: right">Cantidad</th>
                                                                <th style="text-align: right">Unidad medida</th>
                                                                <th style="text-align: right">Importe</th>
                                                                <th style="text-align: center; width: 10%">Eliminar</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="detalle">
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <!-- /.col -->
                                            </div>
                                            <!-- /.row -->

                                            <div class="row">
                                                <!-- accepted payments column -->
                                                <div class="col-xs-4">
                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <tbody>
                                                                <tr>
                                                                    <th style="width:50%">Subtotal:</th>
                                                                    <td id="txtimportesubtotal" style="text-align: right">0.0</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Importe IGV</th>
                                                                    <td id="txtimporteigv" style="text-align: right">0.0</td>
                                                                </tr>                       
                                                                <tr>
                                                                    <th>Total:</th>
                                                                    <td id="txtimporteneto" style="text-align: right">0.0</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>                                                 
                                                <div class="col-xs-4">                                                 
                                                </div>
                                                <!-- /.col -->
                                                <div class="col-xs-4">
                                                    <br><br><br>
                                                    <button class="btn btn-success pull-right"  onclick="guardar_preventa()"><i class="fa fa-credit-card" id="pv_guardar"></i> Guardar</button>
                                                </div>
                                                <!-- /.col -->
                                            </div>
                                            <!-- /.row -->                                          
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /page content --
                <!--MODAL LISTA CLIENTES-->
                <div id="mdl_list_clientes" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div class="form-group">


                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                                    </button>                                                            
                                    <h4 class="modal-title" id="titulomodal">Clientes 

                                    </h4>  
                                </div>

                            </div>
                            <div class="modal-body">                                                                       							 						 
                                <div id="list_clientes"></div>                                                                                                                                                                                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal" id="btn_pr_cliente_close">Cerrar</button>

                            </div>

                        </div>
                    </div>
                </div>
                <!--MODAL LISTA CLIENTES-->

                <!--MODAL LISTA PRODUCTOS-->
                <div id="mdl_list_productos" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div class="form-group">


                                    <button type="button" id="btn_pr_producto_close" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                                    </button>                                                            
                                    <h4 class="modal-title" id="titulomodal">Productos 

                                    </h4>  
                                </div>

                            </div>
                            <div class="modal-body">                                                                       							 						 
                                <div id="list_productos"></div>                                                                                                                                                                                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal" >Cerrar</button>

                            </div>

                        </div>
                    </div>
                </div>
                <!--MODAL LISTA PRODUCTOS-->

                <!-- footer content -->
<?php include_once 'pie.view.php'; ?>
                <!-- /footer content -->
            </div>
        </div>

<?php include_once 'scripts.view.php'; ?>
        <script src="js/pre-venta.clientes.js" type="text/javascript"></script>        
        <script src="js/pre-venta.productos.js" type="text/javascript"></script>        
        <script src="js/pre-venta.js" type="text/javascript"></script>        
        <!--<script src="js/producto.autocompletar.js" type="text/javascript"></script>-->        

    </body>
</html>
