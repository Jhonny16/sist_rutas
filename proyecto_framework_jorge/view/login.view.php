<?php
header('Access-Control-Allow-Origin: *');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Sistema</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, minimun-scale=1.0 user-scalable=no" name="viewport">
        

        <title>Sistema Dipropan | </title>
        <!-- Bootstrap -->
        <?php include_once 'estilos.view.php'; ?>

    </head>

    <body class="login" style="background: url('../images/fondo.jpg');">
        <div>
            <a class="hiddenanchor" id="signup"></a>
            <a class="hiddenanchor" id="signin"></a>

            <div class="login_wrapper" >
                <div class="animate form login_form" style='border-radius: 15px ;
                     background-image: linear-gradient(154deg, rgb(42,63,84) 0px, rgb(247,211,88) 100%);'>
                    <section class="login_content">
                        <form action="../controller/sesion.validar.controller.php" method="post" >
                            <h1>INICIO DE SESIÓN</h1>
                            <div class="form-group has-feedback">
                                <input  type="usuario" class="form-control"  style="width: 90%;border-radius: 30px ;display:initial " 
                                        placeholder="Login (Ingrese DNI)" autofocus=""  
                                        name="p_login" required=""  />
                                <span class="glyphicon glyphicon-user form-control-feedback" style="width: 75px"></span>
                            </div>
                            <div>
                                <div class="form-group has-feedback">
                                    <input  type="password" class="form-control"  style="width: 90%;border-radius: 30px ;display:initial " 
                                            placeholder="Password" autofocus="" 
                                            name="p_password" required=""  />
                                    <span class="glyphicon glyphicon-lock form-control-feedback" style="width: 75px"></span>
                                </div>
                            </div>

                            <div>
                                <button type="submit" class="btn btn-default submit"
                                        style="border-radius: 15px"
                                        ><img src="../images/key.png" style="width: 1.5em">
                                    Iniciar Sesión</button>
                                <a class="reset_pass" href="#">Olvidaste tu contraseña?</a>
                            </div>

                            <div class="clearfix"></div>

                            <div class="separator">
                                <p class="change_link">Bienvenido
                                    <a href="#signup" class="to_register"> | Ahora puede iniciar sesión </a>
                                </p>

                                <div class="clearfix"></div>
                                <br />

                                <div>
                                    <h1><img src="../images/logo.png" style="width: 1.5em; height: 1.5em">ipropan|</h1>
                                    <p>©2017 </p>
                                </div>
                            </div>
                        </form>
                    </section>
                </div>

                <div id="register" class="animate form registration_form">
                    <section class="login_content">
                        <form>
                            <h1>Create Account</h1>
                            <div>
                                <input type="text" class="form-control" placeholder="Username" required="" />
                            </div>
                            <div>
                                <input type="email" class="form-control" placeholder="Email" required="" />
                            </div>
                            <div>
                                <input type="password" class="form-control" placeholder="Password" required="" />
                            </div>
                            <div>
                                <a class="btn btn-default submit" href="index.html">Submit</a>
                            </div>

                            <div class="clearfix"></div>

                            <div class="separator">
                                <p class="change_link">Already a member ?
                                    <a href="#signin" class="to_register"> Log in </a>
                                </p>

                                <div class="clearfix"></div>
                                <br />

                                <div>
                                    <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                                    <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                                </div>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </body>
</html>
