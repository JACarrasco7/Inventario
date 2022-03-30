<div class="login-box">
    <div class="login-logo">
        <center>
            <img class="img-responsive" src="vistas/img/plantilla/logo-login.png" alt="Logo login">
        </center>
    </div>
    <div class="login-box-body">
        <p class="login-box-msg">Accede al sistema</p>

        <form action="" method="post">
            <div class="form-group has-feedback">
                <input type="text" name="usuario" class="form-control" placeholder="Usuario">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" name="password" class="form-control" placeholder="Constraseña">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Acceder</button>
                </div>
            </div>
            <?php 
            $login = new ControladorUsuarios();
            $login->ctrIngresoUsuario();
            ?>
        </form>
    </div>
</div>