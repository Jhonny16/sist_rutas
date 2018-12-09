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
                                    <input id="dev_userid" style="display:none" value="<?php echo $id_usuario ?>">
                                    <input id="date_devolucion" style="display:none" value="<?php
                                    date_default_timezone_set("America/Lima"); echo date('Y-m-d'); ?>" >
                                    <h2>Devoluciones<small></small></h2>
                                    <div class="clearfix">
                                    </div>
                                </div>
                                <div class="x_content">
                                    <div class="row">
                                        <div class="form-group" >
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Seleccione Pedido/Cliente</label>
                                            <div class="col-md-3 col-sm-3 col-xs-12">
                                                <select class="form-control select2" style="width: 100%;" id="combo_pedido">
                                                </select>
                                            </div>
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12"></label>
                                            Fecha: <?php
                                            date_default_timezone_set("America/Lima");
                                            echo date('Y-m-d');
                                            ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <hr>
                                        <div class="col-md-3 col-lg-6 col-xs-12">
                                            <table class="table table-hover">
                                                <thead>
                                                <tr><th colspan="3">Detalle</th></tr>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Producto</th>
                                                    <th>Cant. Vendida</th>
                                                    <th>Cant. devolver</th>
                                                </tr>
                                                </thead>
                                                <tbody id="detalle_venta">
                                                </tbody>
                                            </table>
                                            <div class="row">


                                            </div>
                                        </div>
                                        <div class="col-md-1 col-lg-1 col-xs-1">
                                        </div>
                                        <div class="col-md-3 col-lg-5 col-xs-12">
                                            <div class="form-group">
                                                <label >Vendedor responsable</label>
                                                <select class="select2_single form-control" id="combo_responsable">
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label >Motivo</label>
                                                <input type="text"
                                                       name="txt_motivo"
                                                       id="txt_motivo"
                                                       required=""
                                                       class="form-control input-sm text-bold">
                                            </div>
                                            <div class="form-group">
                                                <label >Tiempo máximo en horas</label>
                                                <input type="number"
                                                       name="txt_tiempo"
                                                       id="txt_tiempo"
                                                       required=""
                                                       class="form-control input-sm text-bold">
                                            </div>
                                            <div class="form-group">
                                                <label for="message">Descripcion</label>
                                                <textarea id="area_descrpcion" required="required" class="form-control" name="message" data-parsley-trigger="keyup" data-parsley-minlength="20"
                                                          data-parsley-validation-threshold="10"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                                <button type="button" class="btn btn-primary">Cancelar</button>
                                                <button type="button" class="btn btn-success" onclick="save_devolucion()">Guardar</button>
                                            </div>
                                        </div>

                                    </div>

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
<script src="js/devolucion.js" type="text/javascript"></script>



</body>
</html>
