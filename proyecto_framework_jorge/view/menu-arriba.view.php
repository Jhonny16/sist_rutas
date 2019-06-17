<div class="top_nav" >
    <div class="nav_menu" 
         style="text-align: center;background:#2A3F54">
         <!--style="text-align: center;background: linear-gradient(#2A3F54, #f7d358, #2A3F54);">-->
     <!-- style="text-align: center;background-image: linear-gradient(154deg, rgb(42,63,84) 0px, rgb(247,211,88) 100%);">-->
      
        <nav>
            <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>

            <ul class="nav navbar-nav navbar-right">
                <li class="">
                    
                    <a href="javascript:;" class="user-profile dropdown-toggle" style="color:white"data-toggle="dropdown" aria-expanded="false">
                       <font color="#f7d358"><?php echo $nombreUsuario;?></font> <img src="images/img.jpg" alt="">
                        <span class=" fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">                       
                        <li><a href="javascript:;"><?php echo $tipoUsuario?></a></li>
                        <li><a href="../controller/sesion.cerrar.controller.php"><i class="fa fa-sign-out pull-right"></i> Salir</a></li>
                    </ul>
                </li>

                
            </ul>
        </nav>
    </div>
</div>