<?php
/**
 * Created by PhpStorm.
 * User: jhonny
 * Date: 09/06/19
 * Time: 07:05 PM
 */

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
                <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                </form>
                <div class="right_col" role="main">
                    <div class="">
                        <div class="page-title">

                        </div>
                        <div class="clearfix"></div>
                        <div class="row">
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>MIS DATOS</h2>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <br />
                                        <form class="form-horizontal form-label-left">

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-3">N° Documento</label>
                                                <div class="col-md-9 col-sm-9 col-xs-9">
                                                    <input type="text" class="form-control" id="txt_dni_ruc" maxlength="11"
                                                    onkeypress="solonumeros(Event)" onblur="name()" disabled="disabled">
                                                </div>
                                            </div>
                                            <div class="form-group" style="display:none" id="div_apellidos">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-3">Apellidos </label>
                                                <div class="col-md-9 col-sm-9 col-xs-9">
                                                    <input type="text" class="form-control" id="txt_apellidos"  disabled="disabled">
                                                </div>
                                            </div>
                                            <div class="form-group" style="display:none" id="div_nombres">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-3">Nombres </label>
                                                <div class="col-md-9 col-sm-9 col-xs-9">
                                                    <input type="text" class="form-control" id="txt_nombres"  disabled="disabled">
                                                </div>
                                            </div>
                                            <div class="form-group" style="display:none" id="div_razon">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-3">Razón Social</label>
                                                <div class="col-md-9 col-sm-9 col-xs-9">
                                                    <input type="text" class="form-control" id="txt_razon_social"  disabled="disabled">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-3">Dirección</label>
                                                <div class="col-md-9 col-sm-9 col-xs-9">
                                                    <input type="text" class="form-control" id="txt_address"  disabled="disabled">
                                                </div>
                                            </div>
                                            <div class="form-group" >
                                                <label class="control-label col-md-3 col-sm-3 col-xs-3">Zona </label>
                                                <div class="col-md-9 col-sm-9 col-xs-9">
                                                    <select name="zon" id="combo_zona" class="form-control" disabled="disabled"></select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-3">Email</label>
                                                <div class="col-md-9 col-sm-9 col-xs-9">
                                                    <input type="text" class="form-control" id="txt_email"  disabled="disabled">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-3">Fec.Nac.</label>
                                                <div class="col-md-9 col-sm-9 col-xs-9">
                                                    <input type="date" class="form-control" id="txt_fn"  disabled="disabled">
                                                </div>
                                            </div>
                                            <div class="form-group" id="divcheck_contrasenia" style="display:none">
                                                <br>
                                                <label class="control-label col-md-3 col-sm-3 col-xs-3">Cambiar Contraseña </label>
                                                <div class="col-md-9 col-sm-9 col-xs-9">
                                                    <input type="checkbox" class="flat"
                                                           id="check_contrasenia">  &nbsp;
                                                </div>
                                            </div>

                                            <div class="form-group" id="div_contrasenia" >
                                                <br>
                                                <label class="control-label col-md-3 col-sm-3 col-xs-3">Contraseña </label>
                                                <div class="col-md-9 col-sm-9 col-xs-9">
                                                    <input type="password" class="form-control" id="txtcontrasenia"
                                                           placeholder="Ingrese contraseña ..." onblur="validar_password()"
                                                           maxlength="10" disabled="disabled">
                                                </div>

                                            </div>
                                            <div class="form-group" id="divnueva_contrasenia" style="display:none">
                                                <br>
                                                <label class="control-label col-md-3 col-sm-3 col-xs-3">Nueva Contraseña </label>
                                                <div class="col-md-9 col-sm-9 col-xs-9">
                                                    <input type="password" class="form-control" id="txtnueva_contrasenia"
                                                           maxlength="10"
                                                           placeholder="Ingrese contraseña ..." readonly>
                                                </div>

                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-9 col-md-offset-3">
                                                    <button type="button" class="btn btn-primary" onclick="editar()">Editar</button>
                                                    <button type="button" class="btn btn-success" onclick="guardar()" >Guardar</button>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12" >
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>VALIDAR DIRECCIÓN</h2>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <button type="button" class="btn btn-success" onclick="validate_address()">Validar</button>
                                        <button type="button" class="btn btn-warning" onclick="limpiar()">Limpiar</button>
                                        <input id="buscar" class="controls" type="text" placeholder="Ingrese Dirección">
                                        <div id="map_direcciones"></div>
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
        <script src="js/validacion.js" type="text/javascript"></script>
        <script src="js/mis_datos.js" type="text/javascript"></script>
        <script src="js/address_cliente.js" type="text/javascript"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCruc9bYLRtwWM_Wz2psZjp8_W8teJUKEk&libraries=places&callback=address" async defer></script>
    </body>
</html>
