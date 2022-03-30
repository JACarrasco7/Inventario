<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Administracion Usuarios
    </h1>
    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li><a href="usuario">Administracion Usuarios</a></li>
    </ol>
  </section>
  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario">Añadir usuarios</button>
      </div>
      <div class="box-body">
        <table class="table table-bordered table-striped dt-responsive tablas">
          <thead>
            <tr>
              <th>Nº</th>
              <th>Id</th>
              <th>Nombre</th>
              <th>Usuario</th>
              <th>Foto</th>
              <th>Perfil</th>
              <th>Estado</th>
              <th>Ultimo acceso</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
          <?php
          $campo = null;
          $valor = null;

          $mostrar_usuario = new ControladorUsuarios();
          $usuarios = $mostrar_usuario->ctrMostrarUsuarios($campo, $valor);
          //var_dump($usuarios);
          foreach ($usuarios as $clave => $valor) {
            ?>
            <tr>
              <td><?php echo $clave + 1 ?></td>
              <td><?php echo $valor["id"] ?></td>
              <td><?php echo $valor["nombre"] ?></td>
              <td><?php echo $valor["usuario"] ?></td>
              <td><?php 
                  if ($valor["foto"] != "") {
                    echo ' <img src="' . $valor["foto"] . '" class="user-image" alt="Imagen de usuario" width="35px">';
                  } else {
                    echo ' <img src="vistas/img/usuarios/user-anonimo.png" class="user-image" alt="Imagen de usuario" width="35px">';
                  }
                  ?></td>
              <td><?php echo $valor["perfil"] ?></td>
                  <?php 
                  if ($valor["estado"] != 0) {
                    echo '<td><button class="btn btn-success btn-xs btnActivar" idUsuario="' . $valor["id"] . '" estadoUsuario="0">Activado</button></td>';
                  } else {
                    echo '<td><button class="btn btn-danger btn-xs btnActivar" idUsuario="' . $valor["id"] . '" estadoUsuario="1">Desactivado</button></td>';
                  }
                  ?>
              <td><?php echo $valor["ultimo_login"] ?></td>
              <td>
                <div class="btn-group">
                  <button class="btn btn-warning btnEditarUsuario" idUsuario="<?php echo $valor["id"]; ?>" data-toggle="modal" data-target="#modalEditarUsuario" >
                    <i class="fa fa-pencil"></i>
                  </button>
                  <button class="btn btn-danger btnEliminarUsuario" idUsuario="<?php echo $valor["id"]; ?>" fotoUsuario="<?php echo $valor["foto"]; ?>" usuario="<?php echo $valor["usuario"]; ?>">
                    <i class="fa fa-times"></i>
                  </button>
                </div>
              </td>
            </tr>
          <?php 
        } ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</div>

<!-- VENTANA MODAL AGREGAR USUARIO -->

<!-- MODAL -->
<div id="modalAgregarUsuario" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="POST" action="" enctype="multipart/form-data">
        <div class="modal-header" style="background: #3c8dbc; color: white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Añadir usuario</h4>
        </div>
        <div class="modal-body">
          <div class="box-body">
            <!-- Nombre -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-user"></i>
                </span>
                <input type="text" class="form-control input-lg" name="nuevoNombre" placeholder="Introduzca el nombre" required="">
              </div>
            </div>
            <!-- usuario -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-lock"></i>
                </span>
                <input type="text" class="form-control input-lg" name="nuevoUsuario" id="nuevoUsuario" placeholder="Introduzca el usuario" required="">
              </div>
            </div>
            <!-- password -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-key"></i>
                </span>
                <input type="password" class="form-control input-lg" name="nuevoPassword" placeholder="Introduzca la contraseña" required="">
              </div>
            </div>
            <!-- perfil -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-users"></i>
                </span>
                <select class="form-control input-lg" name="nuevoPerfil">
                  <option value="">Seleccionar el perfil</option>
                  <option value="Administrador">Administrador</option>
                  <option value="Especial">Especial</option>
                  <option value="Venderdor">Vendedor</option>
                </select>
              </div>
            </div>
            <!-- subir foto -->
            <div class="form-group">
              <div class="panel">Subir foto</div>
              <input type="file" class="nuevaFoto" name="nuevaFoto">
              <p class="help-block">Peso maximo de la foto: 5Mb</p>
              <img src="vistas/img/usuarios/user-anonimo.png" class="thumbnail previsualizar" width="100px">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
        <?php 
        $crearUsuario = new ControladorUsuarios();
        $crearUsuario->ctrCrearUsuario();
        ?>
      </form>
    </div>
  </div>
</div>


<!-- VENTANA MODAL EDITAR USUARIO -->

<!-- MODAL -->
<div id="modalEditarUsuario" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="POST" action="" enctype="multipart/form-data">
        <div class="modal-header" style="background: #3c8dbc; color: white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar usuario</h4>
        </div>
        <div class="modal-body">
          <div class="box-body">
            <!-- Nombre -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-user"></i>
                </span>
                <input type="text" class="form-control input-lg" id="editarNombre" name="editarNombre" value="">
              </div>
            </div>
            <!-- usuario -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-lock"></i>
                </span>
                <input type="text" class="form-control input-lg" id="editarUsuario" name="editarUsuario" readonly>
              </div>
            </div>
            <!-- password -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-key"></i>
                </span>
                <input type="password" class="form-control input-lg" name="editarPassword" placeholder="escriba la nueva contraseña">
                <input type="hidden" id="passwordActual" name="passwordActual" >
              </div>
            </div>
            <!-- perfil -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-users"></i>
                </span>
                <select class="form-control input-lg" name="editarPerfil">
                  <option value="" id="editarPerfil"></option>
                  <option value="Administrador">Administrador</option>
                  <option value="Especial">Especial</option>
                  <option value="Venderdor">Vendedor</option>
                </select>
              </div>
            </div>
            <!-- subir foto -->
            <div class="form-group">
              <div class="panel">Subir foto</div>
              <input type="file" class="nuevaFoto" name="editarFoto">
              <p class="help-block">Peso maximo de la foto: 5Mb</p>
              <img src="vistas/img/usuarios/user-anonimo.png" class="thumbnail previsualizar" width="100px">
              <input type="hidden" name="fotoActual" id=fotoActual>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary miboton">Editar usuario</button>
        </div>
        <?php 
        $editarUsuario = new ControladorUsuarios();
        $editarUsuario->ctrEditarUsuario();
        ?>
      </form>
    </div>
  </div>
</div>
        <?php 
        $BorrarUsuario = new ControladorUsuarios();
        $BorrarUsuario->ctrBorrarUsuario();
        ?>