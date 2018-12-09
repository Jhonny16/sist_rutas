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
                <div class="page-title">

                </div>
                <div class="clearfix"></div>
                <div class="row">
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Gestión Usuarios<small></small>
                                </h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <br/>
                                <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                    <input type="text" id="user_id" style="display: none">
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nombre Completo <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="name_user" required="required" class="form-control col-md-7 col-xs-12" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Esta activo?</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" class="flat"  name="pass" id="active_si"> Si
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" class="flat" name="pass" id="active_no" checked> No
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Usuario<span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="login_user" name="last-name" required="required" class="form-control col-md-7 col-xs-12">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Cambiar password?</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" class="flat"  name="iCheck" id="password_si"> Si
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" class="flat" name="iCheck" id="password_no" checked> No
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Password</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="password_user" class="form-control col-md-7 col-xs-12" type="password" name="middle-name"
                                                   onblur="validar_password()" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group" style="display: none" id="div_new_password">
                                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Nuevo Password</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="new_password_user" class="form-control col-md-7 col-xs-12" type="password" name="middle-name">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Tipo Usuario <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select class="form-control" id="combo_tipouser" required>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                            <button class="btn btn-primary" type="reset">Limpiar</button>
                                            <button type="submit" class="btn btn-success">Guardar</button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Lista Usuarios<small></small>
                                </h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <br/>
                                <div id="lista_usuarios"></div>
                            </div>
                        </div>
                    </div>

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
<script src="js/usuarios.js" type="text/javascript"></script>

</body>
</html>
