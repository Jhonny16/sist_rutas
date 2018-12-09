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
            <div class="right_col" role="main" style="display: block;
                        max-height: 600px;
                        overflow-y: auto;
                        -ms-overflow-style: -ms-autohiding-scrollbar;">
                <div class="row">
                    <div class="clearfix">
                        <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left"></form>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Devoluciones<small></small></h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a title="Nuevo" data-toggle="modal" data-target="#modal_devolucion"  id="btn_nuevadev"><i class="fa fa-plus" style="color: greenyellow"></i><img src='../images/devolucion.png' style="width:1.8em"></a></li>
                                        <li><a class="collapse-link" ><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix">
                                    </div>
                                </div>
                                <div class="x_content">
                                    <p>
                                        Desde: <input type="date" id="date1_dev" value="<?php
                                        date_default_timezone_set("America/Lima");
                                        echo date('Y-m-d');
                                        ?>">
                                        Hasta: <input type="date" id="date2_dev" class=""
                                                      value="<?php
                                                      date_default_timezone_set("America/Lima");
                                                      echo date('Y-m-d');
                                                      ?>">
                                        <button type="button" class="btn btn-success" id="btn_buscar_list_pv"
                                                onclick=""> Buscar<i class="fa fa-search"></i></button>
                                    </p>
                                    <div id="lista_devoluciones"></div>
                                    <!--Inicio modal-->
                                    <div id="modal_devolucion" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">

                                                <div class="modal-header">
                                                    <button type="button" id="btncerrar_dev"  class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">×</span>
                                                    </button>
                                                    <p><input type="text" name="text_pedidoid" id="text_pedidoid"   style="display:none"></p>
                                                    <h4 class="modal-title" id="titulomodalProd">Devolución de productos</h4>
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
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Devoluciones<small></small></h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a title="Nuevo" data-toggle="modal" data-target="#modal_devolucion"  id="btn_nuevadev"><i class="fa fa-plus" style="color: greenyellow"></i><img src='../images/devolucion.png' style="width:1.8em"></a></li>
                                        <li><a class="collapse-link" ><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix">
                                    </div>
                                </div>
                                <div class="x_content">
                                    <p>
                                        Desde: <input type="date" id="date1_dev" value="<?php
                                        date_default_timezone_set("America/Lima");
                                        echo date('Y-m-d');
                                        ?>">
                                        Hasta: <input type="date" id="date2_dev" class=""
                                                      value="<?php
                                                      date_default_timezone_set("America/Lima");
                                                      echo date('Y-m-d');
                                                      ?>">
                                        <button type="button" class="btn btn-success" id="btn_buscar_list_pv"
                                                onclick=""> Buscar<i class="fa fa-search"></i></button>
                                    </p>
                                    <div id="lista_devoluciones"></div>
                                    <!--Inicio modal-->
                                    <div id="modal_devolucion" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">

                                                <div class="modal-header">
                                                    <button type="button" id="btncerrar_dev"  class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">×</span>
                                                    </button>
                                                    <p><input type="text" name="text_pedidoid" id="text_pedidoid"   style="display:none"></p>
                                                    <h4 class="modal-title" id="titulomodalProd">Devolución de productos</h4>
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
                                </div>
                            </div>
                        </div>
                    </div>


                </div>

                <!--MODAL DETALLE PREVENTA-->

            </div>
        </div>
        <!-- /page content -->
        <!-- footer content -->
        <?php include_once 'pie.view.php'; ?>
        <!-- /footer content -->
    </div>
<?php include_once 'scripts.view.php'; ?>

<script src="" type="text/javascript"></script>


</body>
</html>
