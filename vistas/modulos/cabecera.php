<header class="main-header">
    <!-- Logo -->
    <a href="inicio" class="logo">
        <!-- mini logo -->
        <span class="logo-mini">
            <img class="img-responsive" src="vistas/img/plantilla/logo-mini.png" alt="" style="padding-top: 7px;padding-left: 7px;">
        </span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">
            <img class="img-responsive" src="vistas/img/plantilla/logo-maxi.png" alt="" style="padding-top: 7px;">
        </span>
    </a>
    <!-- BARRA DE NAVEGACION -->
    <nav class="navbar navbar-static-top">
        <!-- BOTON DE NAVEGACION -->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <!-- PERFIL DE USUARIO -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                       <?php 
                        if ($_SESSION["foto"] != "") {
                            echo ' <img src="' . $_SESSION["foto"] . '" class="user-image" alt="Imagen de usuario">';
                        } else {
                            echo ' <img src="vistas/img/usuarios/user-anonimo.png" class="user-image" alt="Imagen de usuario">';
                        }
                        ?>
                        <span class="hidden-xs"><?php echo $_SESSION["nombre"] ?></span>
                    </a>
                    <!-- SALIR -->
                    <ul class="dropdown-menu">
                        <li class="user-footer">
                            <div class="pull-right">
                                <a href="salir" class="btn btn-default btn-flat">Salir</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>