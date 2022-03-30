<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Administracion Clientes
    </h1>
    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li><a href="clientes">Administracion Clientes</a></li>
    </ol>
  </section>
  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarClientes">Añadir clientes</button>
      </div>
      <div class="box-body">
        <table class="table table-bordered table-striped dt-responsive tablas">
          <thead>
            <tr>
              <th>Nº</th>
              <th>Id</th>
              <th>Nombre</th>
              <th>Documento</th>
              <th>Email</th>
              <th>Telefono</th>
              <th>Direccion</th>
              <th>Fecha_nacimiento</th>
              <th>Compras</th>
              <th>Fecha</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
          <?php
          $campo = null;
          $valor = null;

          $mostrar_clientes = new ControladorClientes();
          $clientes = $mostrar_clientes->ctrMostrarClientes($campo, $valor);

          foreach ($clientes as $clave => $valor) {
            ?>
            <tr>
              <td><?php echo $clave + 1 ?></td>
              <td><?php echo $valor["id"] ?></td>
              <td><?php echo $valor["nombre"] ?></td>
              <td><?php echo $valor["documento"] ?></td>
              <td><?php echo $valor["email"] ?></td>
              <td><?php echo $valor["telefono"] ?></td>
              <td><?php echo $valor["direccion"] ?></td>
              <td><?php echo $valor["fecha_nacimiento"] ?></td>
              <td><?php echo $valor["compras"] ?></td>
              <td><?php echo $valor["fecha"] ?></td>
              <td>
                <div class="btn-group">
                  <button class="btn btn-warning btnEditarCliente" idCliente="<?php echo $valor["id"]; ?>" data-toggle="modal" data-target="#modalEditarCliente" >
                    <i class="fa fa-pencil"></i>
                  </button>
                  <button class="btn btn-danger btnEliminarCliente" idCliente="<?php echo $valor["id"]; ?>">
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

<!-- VENTANA MODAL AGREGAR CLIENTES -->

<!-- MODAL -->
<div id="modalAgregarClientes" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="POST" action="" enctype="multipart/form-data">
        <div class="modal-header" style="background: #3c8dbc; color: white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Añadir clientes</h4>
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
            <!-- Documento -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                <i class="fa fa-address-card"></i>
                </span>
                <input type="text" class="form-control input-lg" name="nuevoDocumento" id="nuevoDocumento" placeholder="Introduzca el DNI. Ejem: 99.999.999-A" maxlength="12" required>
              </div>
            </div>
            <!-- Email -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                <i class="fa fa-at"></i>
                </span>
                <input type="email" class="form-control input-lg" name="nuevoEmail" id="nuevoEmail" placeholder="Introduzca el email" required="">
              </div>
            </div>
            <!-- Telefono -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-phone"></i>
                </span>
                <input type="text" class="form-control input-lg" name="nuevoTelefono" placeholder="Introduzca el telefono. Ejem: 999-99-99-99" maxlength="12" required>
              </div>
            </div>
            <!-- Direccion -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-address-book"></i>
                </span>
                <input type="text" class="form-control input-lg" name="nuevoDireccion" placeholder="Introduzca el direccion" required>
              </div>
            </div>
            <!-- Fecha nacimiento -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </span>
                <input type="date" class="form-control input-lg" name="nuevoFecha_nac" required>
              </div>
            </div>  
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
        <?php 
        $crearClientes = new ControladorClientes();
        $crearClientes->ctrCrearClientes();
        ?>
      </form>
    </div>
  </div>
</div>


<!-- VENTANA MODAL EDITAR CLIENTE -->

<!-- MODAL -->
<div id="modalEditarCliente" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="POST" action="" enctype="multipart/form-data">
        <div class="modal-header" style="background: #3c8dbc; color: white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar clientes</h4>
        </div>
        <div class="modal-body">
          <div class="box-body">
            <!-- Nombre -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-user"></i>
                </span>
                <input type="text" class="form-control input-lg" name="editarNombre" id="editarNombre" placeholder="Introduzca el nombre" required="">
                <input type="hidden" name="editarId" id="editarId">
              </div>
            </div>
            <!-- Documento -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                <i class="fa fa-address-card"></i>
                </span>
                <input type="text" class="form-control input-lg" name="editarDocumento" id="editarDocumento" placeholder="Introduzca el DNI. Ejem: 99.999.999-A" maxlength="12" readOnly>
              </div>
            </div>
            <!-- Email -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                <i class="fa fa-at"></i>
                </span>
                <input type="email" class="form-control input-lg" name="editarEmail" id="editarEmail" placeholder="Introduzca el email" readOnly>
              </div>
            </div>
            <!-- Telefono -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-phone"></i>
                </span>
                <input type="text" class="form-control input-lg" name="editarTelefono" id="editarTelefono" placeholder="Introduzca el telefono. Ejem: 999-99-99-99" maxlength="12" required>
              </div>
            </div>
            <!-- Direccion -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-address-book"></i>
                </span>
                <input type="text" class="form-control input-lg" name="editarDireccion" id="editarDireccion" placeholder="Introduzca el direccion" required>
              </div>
            </div>
            <!-- Fecha nacimiento -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </span>
                <input type="date" class="form-control input-lg" name="editarFecha_nac" id="editarFecha_nac" required>
              </div>
            </div>  
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Editar cliente</button>
        </div>
        <?php 
        $editarClientes = new ControladorClientes();
        $editarClientes->ctrEditarClientes();
        ?>
      </form>
    </div>
  </div>
</div>
<?php 
$BorrarCliente = new ControladorClientes();
$BorrarCliente->ctrBorrarClientes();
?>